@include('partials.header_admin')

<div class="container bg-dark text-light mt-4 p-4 rounded">
    <h2>Administrar Servicios</h2>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">+ Agregar Servicio</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row g-4">
        @foreach ($services as $service)
            <div class="col-md-4">
                <div class="card h-100">
                    @if ($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-dark">{{ $service->name }}</h5>
                        <p class="card-text text-dark">{{ $service->description }}</p>
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Eliminar este servicio?')">Eliminar</button>
                        </form>
                    </div>
                </div>
        @endforeach
    </div>
</div>

@include('partials.footer_admin')
