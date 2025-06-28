{{-- filepath: resources/views/admin/about/edit.blade.php --}}
@include('partials.header_admin')

<div class="container-fluid bg-dark text-light mt-4 p-4 rounded">
    <h2 class="text-center mb-4">Editar Sobre Nosotros</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Historia --}}
        <div class="mb-5">
            <h4 class="mb-3">Historia</h4>
            <input type="text" name="about[history_title][text]" class="form-control mb-2" value="{{ $abouts['history_title']->text ?? 'Historia' }}" placeholder="Título de Historia">
            <textarea name="about[history][text]" class="form-control mb-2" rows="3" required>{{ $abouts['history']->text ?? '' }}</textarea>
            @if(!empty($abouts['history']->image))
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$abouts['history']->image) }}" alt="Historia" class="img-fluid" style="max-width: 100%; height: auto;">
                </div>
            @endif
            <input type="file" name="about[history][image]" class="form-control mt-2">
        </div>

        {{-- Misión --}}
        <div class="mb-5">
            <h4 class="mb-3">Misión</h4>
            <input type="text" name="about[mission_title][text]" class="form-control mb-2" value="{{ $abouts['mission_title']->text ?? 'Misión' }}" placeholder="Título de Misión">
            <textarea name="about[mission][text]" class="form-control mb-2" rows="3" required>{{ $abouts['mission']->text ?? '' }}</textarea>
            @if(!empty($abouts['mission']->image))
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$abouts['mission']->image) }}" alt="Misión" class="img-fluid" style="max-width: 100%; height: auto;">
                </div>
            @endif
            <input type="file" name="about[mission][image]" class="form-control mt-2">
        </div>

        {{-- Visión --}}
        <div class="mb-5">
            <h4 class="mb-3">Visión</h4>
            <input type="text" name="about[vision_title][text]" class="form-control mb-2" value="{{ $abouts['vision_title']->text ?? 'Visión' }}" placeholder="Título de Visión">
            <textarea name="about[vision][text]" class="form-control mb-2" rows="3" required>{{ $abouts['vision']->text ?? '' }}</textarea>
            @if(!empty($abouts['vision']->image))
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$abouts['vision']->image) }}" alt="Visión" class="img-fluid" style="max-width: 100%; height: auto;">
                </div>
            @endif
            <input type="file" name="about[vision][image]" class="form-control mt-2">
        </div>

        <div class="d-grid">
            <button class="btn btn-primary btn-lg">Guardar cambios</button>
        </div>
    </form>
</div>

@include('partials.footer_admin')