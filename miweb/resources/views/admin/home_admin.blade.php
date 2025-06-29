@include('partials.header_admin')

<div class="container-fluid bg-dark text-light mt-4 p-4 rounded">
    <h2 class="text-center mb-4">Editar contenido de la página principal</h2>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Título principal --}}
        <div class="mb-3">
            <label for="main_title" class="form-label">Título principal</label>
            <input type="text" class="form-control" id="main_title" name="content[main_title]"
                value="{{ $sections['main_title']->content ?? '' }}">
        </div>

        {{-- Subtítulo principal --}}
        <div class="mb-3">
            <label for="main_subtitle" class="form-label">Subtítulo principal</label>
            <input type="text" class="form-control" id="main_subtitle" name="content[main_subtitle]"
                value="{{ $sections['main_subtitle']->content ?? '' }}">
        </div>

        {{-- Imagen principal --}}
        <div class="mb-3">
            <label for="main_image" class="form-label">Imagen principal (Slide 1)</label>
            @if (!empty($sections['main_image']->image_path))
                <img src="{{ asset('storage/' . $sections['main_image']->image_path) }}" alt="Imagen Principal"
                    class="img-fluid mb-2" style="max-width: 100%;">
            @endif
            <input type="file" class="form-control" id="main_image" name="image[main_image]" accept="image/*">
        </div>

        {{-- Slide 2 --}}
        <div class="mb-3">
            <label for="second_image" class="form-label">Segunda imagen (Slide 2)</label>
            @if (!empty($sections['second_image']->image_path))
                <img src="{{ asset('storage/' . $sections['second_image']->image_path) }}" alt="Segunda Imagen"
                    class="img-fluid mb-2" style="max-width: 100%;">
            @endif
            <input type="file" class="form-control" id="second_image" name="image[second_image]" accept="image/*">
        </div>

        {{-- Slide 3 --}}
        <div class="mb-3">
            <label for="third_image" class="form-label">Tercera imagen (Slide 3)</label>
            @if (!empty($sections['third_image']->image_path))
                <img src="{{ asset('storage/' . $sections['third_image']->image_path) }}" alt="Tercera Imagen"
                    class="img-fluid mb-2" style="max-width: 100%;">
            @endif
            <input type="file" class="form-control" id="third_image" name="image[third_image]" accept="image/*">
        </div>

        {{-- Título equipo --}}
        <div class="mb-3">
            <label for="team_title" class="form-label">Título equipo</label>
            <input type="text" class="form-control" id="team_title" name="content[team_title]"
                value="{{ $sections['team_title']->content ?? '' }}">
        </div>

        {{-- ¿Quiénes somos? --}}
        <div class="mb-3">
            <label for="about_title" class="form-label">Título ¿Quiénes somos?</label>
            <input type="text" class="form-control" id="about_title" name="content[about_title]"
                value="{{ $sections['about_title']->content ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="about_description" class="form-label">Descripción ¿Quiénes somos?</label>
            <textarea class="form-control" id="about_description" name="content[about_description]" rows="2">{{ $sections['about_description']->content ?? '' }}</textarea>
        </div>

        {{-- ¿Qué ofrecemos? --}}
        <div class="mb-3">
            <label for="offer_title" class="form-label">Título ¿Qué ofrecemos?</label>
            <input type="text" class="form-control" id="_offer_title" name="content[offer_title]"
                value="{{ $sections['offer_title']->content ?? '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Lista de ofertas</label>
            <div id="offers-list">
                @php
                    $offers = [];
                    if (!empty($sections['offer_list']->content)) {
                        preg_match_all('/<li>(.*?)<\/li>/', $sections['offer_list']->content, $matches);
                        $offers = $matches[1] ?? [];
                    }
                @endphp
                @foreach ($offers as $offer)
                    <div class="input-group mb-2 offer-item">
                        <input type="text" name="offer_list[]" class="form-control" value="{{ $offer }}"
                            required>
                    </div>
                @endforeach
                @if (empty($offers))
                    <div class="input-group mb-2 offer-item">
                        <input type="text" name="offer_list[]" class="form-control" placeholder="Nueva oferta"
                            required>
                    </div>
                @endif
            </div>
        </div>

        {{-- Misión --}}
        <div class="mb-3">
            <label for="mission_title" class="form-label">Título Misión</label>
            <input type="text" class="form-control" id="mission_title" name="content[mission_title]"
                value="{{ $sections['mission_title']->content ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="mission" class="form-label">Misión</label>
            <textarea class="form-control" id="mission" name="content[mission]" rows="2">{{ $sections['mission']->content ?? '' }}</textarea>
        </div>

        {{-- Visión --}}
        <div class="mb-3">
            <label for="vision_title" class="form-label">Título Visión</label>
            <input type="text" class="form-control" id="vision_title" name="content[vision_title]"
                value="{{ $sections['vision_title']->content ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="vision" class="form-label">Visión</label>
            <textarea class="form-control" id="vision" name="content[vision]" rows="2">{{ $sections['vision']->content ?? '' }}</textarea>
        </div>

        {{-- Contacto --}}
        <div class="mb-3">
            <label for="contact_title" class="form-label">Título contacto</label>
            <input type="text" class="form-control" id="contact_title" name="content[contact_title]"
                value="{{ $sections['contact_title']->content ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="contact_description" class="form-label">Descripción contacto</label>
            <textarea class="form-control" id="contact_description" name="content[contact_description]" rows="2">{{ $sections['contact_description']->content ?? '' }}</textarea>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg">Guardar cambios</button>
        </div>
    </form>
</div>

@include('partials.footer_admin')
