<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public function edit()
    {
        $abouts = About::all()->keyBy('section');
        return view('admin.about.edit', compact('abouts'));
    }

    public function update(Request $request)
    {
        foreach ($request->input('about') as $section => $data) {
            $update = ['text' => $data['text']];
            if (request()->hasFile("about.$section.image")) {
                $file = request()->file("about.$section.image");
                $update['image'] = $file->store('about', 'public');
            }
            About::updateOrCreate(['section' => $section], $update);
        }
        return back()->with('success', 'Información actualizada correctamente.');
    }
}