<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index() {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function create() {
        return view('admin.services.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:5120'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Servicio agregado correctamente.');
    }

    public function edit(Service $service) {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service) {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:5120'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy(Service $service) {
        $service->delete();
        return back()->with('success', 'Servicio eliminado correctamente.');
    }
}
