@include('partials.header_admin')
<div class="container bg-dark text-light mt-4 p-4 rounded">
    <h2>Blog Informativo</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulario para nueva publicación --}}
    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" class="form-control mb-2" placeholder="Título" required>
        <textarea name="content" class="form-control mb-2" rows="3" placeholder="Contenido" required></textarea>
        <input type="file" name="image" class="form-control mb-2">
        <button class="btn btn-primary">Agregar Publicación</button>
    </form>

    <hr>

    {{-- Lista de publicaciones --}}
    <h3>Publicaciones</h3>
    @foreach ($posts as $post)
        <div class="mb-3">
            <h4>{{ $post->title }}</h4>
            <p>{{ $post->content }}</p>
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" style="max-width:200px;">
            @endif
            <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </div>
    @endforeach

    <hr>

    {{-- Testimonios --}}
    <h3>Testimonios</h3>
    <form action="{{ route('admin.testimonial.store') }}" method="POST">
        @csrf
        <textarea name="text" class="form-control mb-2" placeholder="Testimonio" required></textarea>
        <input type="text" name="name" class="form-control mb-2" placeholder="Nombre del Cliente" required>
        <button class="btn btn-primary">Agregar Testimonio</button>
    </form>
    @foreach ($testimonials as $testimonial)
        <div class="mb-2">
            <p>"{{ $testimonial->text }}" - {{ $testimonial->name }}</p>
            <form action="{{ route('admin.testimonial.destroy', $testimonial->id) }}" method="POST"
                style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </div>
    @endforeach

    <hr>

    {{-- Suscripciones --}}
    <h3>Suscripciones</h3>
    <form id="subscribeForm" action="{{ route('blog-informativo.subscribe') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="form-control"
                placeholder="{{ $sections['newsletter_placeholder']->text ?? 'Ingresa tu email' }}" required>
        </div>
        <button type="submit"
            class="btn btn-primary">{{ $sections['newsletter_button']->text ?? 'Suscribirse' }}</button>
    </form>
    <ul>
        @foreach ($subscriptions as $sub)
            <li>
                {{ $sub->email }}
                <form action="{{ route('admin.subscription.destroy', $sub->id) }}" method="POST"
                    style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@include('partials.footer_admin')
