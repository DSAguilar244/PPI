@include('partials.header_admin')

<div class="container bg-dark text-light mt-4 p-4 rounded">
    <h2>Agregar Servicio</h2>
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button class="btn btn-primary">Guardar</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@include('partials.footer_admin')