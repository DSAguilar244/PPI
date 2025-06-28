@include('partials.header_admin')

<div class="container bg-dark text-light mt-4 p-4 rounded">
    <h2>Editar Servicio</h2>
    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control" required>{{ $service->description }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Imagen actual</label><br>
            @if($service->image)
                <img src="{{ asset('storage/'.$service->image) }}" alt="Imagen actual" style="max-width: 200px;">
            @else
                <span>No hay imagen</span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Cambiar Imagen</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@include('partials.footer_admin')