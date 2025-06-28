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

        // Handle text content
        $content = $request->input('content', []);
        foreach ($content as $section => $value) {
            HomeContent::updateOrCreate(
                ['section' => $section],
                ['content' => $value, 'image_path' => null] // Clear image_path for non-image sections
            );
        }

        // Handle image uploads
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