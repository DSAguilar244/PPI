<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactSection;

class ContactSectionController extends Controller
{
    public function edit()
    {
        $sections = ContactSection::all()->keyBy('key');
        return view('admin.contact.edit', compact('sections'));
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token') as $key => $text) {
            ContactSection::updateOrCreate(['key' => $key], ['text' => $text]);
        }
        return back()->with('success', 'Sección actualizada correctamente.');
    }
}
