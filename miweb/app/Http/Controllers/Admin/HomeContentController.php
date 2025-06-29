<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeContent;

class HomeContentController extends Controller
{
    public function edit()
    {
        $sections = HomeContent::all()->keyBy('section');
        return view('admin.home_admin', compact('sections'));
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'content.*' => 'nullable|string',
            'image.main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image.second_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image.third_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Procesar lista de ofertas (offer_list[])
        if ($request->has('offer_list')) {
            $offers = $request->input('offer_list', []);
            $html = '<ul>';
            foreach ($offers as $offer) {
                $html .= '<li>' . e($offer) . '</li>';
            }
            $html .= '</ul>';
            // Sobrescribe el campo en content para que se guarde como HTML
            $content = $request->input('content', []);
            $content['offer_list'] = $html;
        } else {
            $content = $request->input('content', []);
        }

        // Guardar contenido de texto
        foreach ($content as $section => $value) {
            HomeContent::updateOrCreate(
                ['section' => $section],
                ['content' => $value, 'image_path' => null] // Clear image_path for non-image sections
            );
        }

        // Guardar imágenes
        $images = $request->file('image', []);
        foreach ($images as $section => $file) {
            if ($file && $file->isValid()) {
                $path = $file->store('images', 'public');
                HomeContent::updateOrCreate(
                    ['section' => $section],
                    ['image_path' => $path, 'content' => null] // Clear content for image sections
                );
            }
        }

        return redirect()->back()->with('success', 'Contenido actualizado correctamente.');
    }
}