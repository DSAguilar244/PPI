<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\ContactSection;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function nuestrosServicios()
    {
        return view('nuestros-servicios');
    }

    public function sobreNosotros()
    {
        return view('sobre-nosotros');
    }

    public function blogInformativo()
    {
        return view('blog-informativo');
    }

    public function contactanos()
    {
        $sections = ContactSection::all()->keyBy('key');
        return view('contactanos', compact('sections'));
    }

    public function enviarContacto(Request $request)
    {
        
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);
        
        return back()->with('success', '¡Consulta enviada correctamente!');
    }

    public function login()
    {
        return view('login');
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        Subscription::create(['email' => $request->email]);
        return back()->with('success', '¡Te has suscrito correctamente!');
    }
}
