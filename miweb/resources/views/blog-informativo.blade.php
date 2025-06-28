@extends('layouts.app')

@section('title', 'Blog Informativo')

@section('styles')
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
@endsection

@php
    $posts = \App\Models\BlogPost::latest()->get();
    $testimonials = \App\Models\Testimonial::all();
@endphp

@section('content')
    <!-- Hero Section -->
    <section class="hero-blog">
        <div class="container">
            <h1>{{ $sections['hero_title']->text ?? 'Blog Informativo' }}</h1>
            <p>{{ $sections['hero_description']->text ?? 'Lee nuestras últimas actualizaciones, noticias y consejos sobre el ámbito jurídico tributario.' }}
            </p>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-us">
        <div class="container">
            <h2>{{ $sections['about_title']->text ?? 'Sobre ASESORO' }}</h2>
            <p>{{ $sections['about_description']->text ?? 'En ASESORO Estudio Jurídico Tributario, nos especializamos en ofrecer soluciones legales integrales en el ámbito tributario, asesorando a empresas y particulares para asegurar el cumplimiento normativo y optimizar su carga fiscal.' }}
            </p>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section">
        <div class="container">
            <h2>{{ $sections['posts_title']->text ?? 'Últimas publicaciones' }}</h2>
            <div class="blog-posts">
                @foreach ($posts as $post)
                    <div class="blog-post">
                        <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('static/img/default_post.jpg') }}"
                            alt="{{ $post->title }}" onerror="this.src='{{ asset('static/img/placeholder.jpg') }}';">
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->content }}</p>
                    </div>
                @endforeach

                <!-- Static Posts for Reference -->
                <div class="blog-post">
                    <img src="{{ asset('static/img/optimizar_impuestos.jpg') }}"
                        alt="{{ $sections['post1_title']->text ?? '¿Cómo optimizar tus impuestos en tiempos de incertidumbre económica?' }}"
                        onerror="this.src='{{ asset('static/img/placeholder.jpg') }}';">
                    <h3>{{ $sections['post1_title']->text ?? '¿Cómo optimizar tus impuestos en tiempos de incertidumbre económica?' }}
                    </h3>
                    <p>{{ $sections['post1_description']->text ?? 'En este artículo exploramos las mejores estrategias para gestionar tus impuestos durante periodos de crisis económica. Desde la planificación fiscal hasta la optimización de deducciones, te ofrecemos consejos prácticos para reducir tu carga tributaria sin comprometer tu cumplimiento fiscal.' }}
                    </p>
                </div>
                <div class="blog-post">
                    <img src="{{ asset('static/img/pequenas_empresas.jpg') }}"
                        alt="{{ $sections['post2_title']->text ?? 'Impacto de la reforma tributaria en las pequeñas empresas' }}"
                        onerror="this.src='{{ asset('static/img/placeholder.jpg') }}';">
                    <h3>{{ $sections['post2_title']->text ?? 'Impacto de la reforma tributaria en las pequeñas empresas' }}
                    </h3>
                    <p>{{ $sections['post2_description']->text ?? 'La reciente reforma tributaria ha afectado a muchas pequeñas empresas. En este post analizamos cómo estos cambios impactan las operaciones diarias de los pequeños empresarios y qué medidas pueden tomar para adaptarse a las nuevas regulaciones fiscales sin comprometer su crecimiento.' }}
                    </p>
                </div>
                <div class="blog-post">
                    <img src="{{ asset('static/img/transparencia_sector.jpg') }}"
                        alt="{{ $sections['post3_title']->text ?? 'La importancia de la transparencia fiscal en el sector corporativo' }}"
                        onerror="this.src='{{ asset('static/img/placeholder.jpg') }}';">
                    <h3>{{ $sections['post3_title']->text ?? 'La importancia de la transparencia fiscal en el sector corporativo' }}
                    </h3>
                    <p>{{ $sections['post3_description']->text ?? 'La transparencia fiscal es un tema crucial en el mundo corporativo. Este artículo aborda la importancia de una política fiscal clara y abierta para fortalecer la confianza de los inversores, mejorar la reputación de la empresa y asegurar el cumplimiento de la normativa tributaria.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2>{{ $sections['testimonials_title']->text ?? 'Testimonios' }}</h2>
            <div class="row">
                @foreach ($testimonials as $testimonial)
                    <div class="col-md-6 mb-3">
                        <div class="testimonial card">
                            <blockquote class="blockquote card-body">
                                <p>{{ $testimonial->text }}</p>
                                <footer class="blockquote-footer">{{ $testimonial->name }}</footer>
                            </blockquote>
                        </div>
                    </div>
                @endforeach

                <!-- Static Testimonials for Reference -->
                <div class="col-md-6 mb-3">
                    <div class="testimonial card">
                        <blockquote class="blockquote card-body">
                            <p>{{ $sections['testimonial1_text']->text ?? 'Gracias a ASESORO, pudimos resolver un conflicto tributario de forma rápida y eficaz. ¡Recomiendo sus servicios ampliamente!' }}
                            </p>
                            <footer class="blockquote-footer">
                                {{ $sections['testimonial1_name']->text ?? 'Juan Pérez, Cliente' }}</footer>
                        </blockquote>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="testimonial card">
                        <blockquote class="blockquote card-body">
                            <p>{{ $sections['testimonial2_text']->text ?? 'El equipo de ASESORO nos brindó un excelente asesoramiento fiscal, lo que nos permitió mejorar nuestra rentabilidad fiscal. Profesionales de confianza.' }}
                            </p>
                            <footer class="blockquote-footer">
                                {{ $sections['testimonial2_name']->text ?? 'Laura Martínez, Cliente Corporativo' }}
                            </footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter">
        <div class="container">
            <h2>{{ $sections['newsletter_title']->text ?? 'Suscríbete a nuestro blog' }}</h2>
            <p>{{ $sections['newsletter_description']->text ?? 'Recibe las últimas novedades y consejos directamente en tu correo.' }}
            </p>
            <form id="subscribeForm" action="{{ route('blog-informativo.subscribe') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" class="form-control"
                        placeholder="{{ $sections['newsletter_placeholder']->text ?? 'Ingresa tu email' }}" required>
                </div>
                <button type="submit"
                    class="btn btn-primary">{{ $sections['newsletter_button']->text ?? 'Suscribirse' }}</button>
            </form>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subscribeModalLabel">
                        {{ $sections['modal_title']->text ?? '¡Te has suscrito correctamente!' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ $sections['modal_body']->text ?? '¡Gracias por suscribirte a nuestro blog! Estás listo para recibir las últimas noticias y actualizaciones.' }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ $sections['modal_close_button']->text ?? 'Cerrar' }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <section class="cta">
        <div class="container">
            <h2>{{ $sections['cta_title']->text ?? '¿Necesitas asesoría legal?' }}</h2>
            <p>{{ $sections['cta_description']->text ?? 'Haz clic en el botón para consultar con nosotros directamente.' }}
            </p>
            <a href="{{ route('contactanos') }}"
                class="btn-cta">{{ $sections['cta_button']->text ?? 'Consultar con Nosotros' }}</a>
        </div>
    </section>

    <script>
        document.getElementById("subscribeForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('subscribeModal'));
            modal.show();
            this.reset();
        });
    </script>
@endsection
