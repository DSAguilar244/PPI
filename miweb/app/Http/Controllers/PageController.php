<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('contactanos');
    }

    public function login()
    {
        return view('login');
    }
}