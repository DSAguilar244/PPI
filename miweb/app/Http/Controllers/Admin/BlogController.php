<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Models\Subscription;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->get();
        $testimonials = Testimonial::all();
        $subscriptions = Subscription::all();
        return view('admin.blog.index', compact('posts', 'testimonials', 'subscriptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:5120',
        ]);
        $data = $request->only('title', 'content');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog', 'public');
        }
        BlogPost::create($data);
        return back()->with('success', 'Publicación agregada exitosamente.');
    }

    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        if ($post->image) Storage::disk('public')->delete($post->image);
        $post->delete();
        return back()->with('success', 'Publicación eliminada exitosamente.');
    }

    public function destroySubscription($id)
    {
        \App\Models\Subscription::destroy($id);
        return back()->with('success', 'Suscripción eliminada exitosamente.');
    }

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'name' => 'required',
        ]);
        Testimonial::create($request->only('text', 'name'));
        return back()->with('success', 'Testimonio agregado exitosamente.');
    }

    public function destroyTestimonial($id)
    {
        Testimonial::destroy($id);
        return back()->with('success', 'Testimonio eliminado exitosamente.');
    }

    public function storeSubscription(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);
        Subscription::create(['email' => $request->email]);
        return back()->with('success', 'Suscripción realizada exitosamente.');
    }
}
