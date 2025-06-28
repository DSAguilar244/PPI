@extends('layouts.app')

@section('title', 'Inicio')

@section('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@php
    $sections = \App\Models\HomeContent::all()->keyBy('section');
@endphp

@section('content')
    <section class="hero">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    @if(isset($sections['main_image']) && !empty($sections['main_image']->image_path))
                        <img src="{{ asset('storage/' . $sections['main_image']->image_path) }}" class="d-block w-100" alt="Imagen Principal">
                    @else
                        <img src="{{ asset('static/img/fondo_1.jpg') }}" class="d-block w-100" alt="Imagen Principal por defecto">
                    @endif
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    @if(isset($sections['second_image']) && !empty($sections['second_image']->image_path))
                        <img src="{{ asset('storage/' . $sections['second_image']->image_path) }}" class="d-block w-100" alt="Segunda Imagen">
                    @else
                        <img src="{{ asset('static/img/fondo_2.jpg') }}" class="d-block w-100" alt="Segunda Imagen por defecto">
                    @endif
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item">
                    @if(isset($sections['third_image']) && !empty($sections['third_image']->image_path))
                        <img src="{{ asset('storage/' . $sections['third_image']->image_path) }}" class="d-block w-100" alt="Tercera Imagen">
                    @else
                        <img src="{{ asset('static/img/fondo_3.jpg') }}" class="d-block w-100" alt="Tercera Imagen por defecto">
                    @endif
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="hero-content">
            <h1>{{ $sections['main_title']->content ?? 'ASESORO' }}</h1>
            <h2>{{ $sections['main_subtitle']->content ?? 'Estudio Jurídico Tributario' }}</h2>
            <button onclick="window.location.href='{{ route('contactanos') }}'">Contáctanos</button>
        </div>
    </section>

    <section class="team-section">
        <h2 class="text-center mb-4">{{ $sections['team_title']->content ?? 'Nuestro Equipo de Trabajo' }}</h2>
        <div id="teamCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active text-center">
                    <img src="{{ asset('static/img/abogado_1.jpg') }}" alt="Dr. Carlos Ordeñana Carrión" class="d-block mx-auto rounded-circle" style="width: 180px; height: 180px; object-fit: cover;">
                    <h3 class="mt-3">Dr. Carlos Ordeñana Carrión</h3>
                    <p class="fst-italic">Doctor en Jurisprudencia</p>
                    <p class="px-3 mx-auto" style="max-width: 600px; text-align: justify;">
                        Doctor en Jurisprudencia y abogado de los tribunales de la justicia de la República por la Universidad de Cuenca, estudios de postgrado en Tributación en la Universidad de Cuenca y estudios de postgrado en Derecho Procesal en la Universidad San Antonio de Machala. Cuenta con más de 18 años de experiencia en Administración Pública como asesor, coordinador jurídico y depositario fiscal en el SRI y asesor jurídico en la Subscretaría de Minas Zona 7, y en la empresa privada como Gerente general de la Cooperativa de Producción y Comercialización La Clementina.
                    </p>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item text-center">
                    <img src="{{ asset('static/img/abogado_2.jpg') }}" alt="Ab. Carla Veintemilla Zambrano" class="d-block mx-auto rounded-circle" style="width: 180px; height: 180px; object-fit: cover;">
                    <h3 class="mt-3">Ab. Carla Veintemilla Zambrano</h3>
                    <p class="fst-italic">Derecho Penal Económico</p>
                    <p class="px-3 mx-auto" style="max-width: 600px; text-align: justify;">
                        Abogada de la Universidad Técnica Particular de Loja. Egresada de la Universidad Internacional de la Rioja de la maestría Derecho Penal Económico. Trabajó en la Administración Tributaria durante 13 años, desempeñando funciones de analista de cobranzas y de gestión tributaria en el SRI. Ejercicio de defensa técnica en procesos tributarios, administrativos, civiles, laborales, de familia y penal tributario.
                    </p>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item text-center">
                    <img src="{{ asset('static/img/abogado_3.jpg') }}" alt="Econ. Daniel Gutierrez Jaramillo" class="d-block mx-auto rounded-circle" style="width: 180px; height: 180px; object-fit: cover;">
                    <h3 class="mt-3">Econ. Daniel Gutierrez Jaramillo</h3>
                    <p class="fst-italic">Economista</p>
                    <p class="px-3 mx-auto" style="max-width: 600px; text-align: justify;">
                        Economista por la Escuela Politécnica del Litoral, Contador público autorizado por la Universidad Técnica Particular de Loja, Magister en Administración de Empresas por la Universidad de Guayaquil. Doctor en Ciencias Contables y Empresariales por la Universidad nacional Mayor de San Marcos. Fue funcionario de la Administración Tributaria durante 11 años, desempeñando funciones de jefe de auditoría y jefe de reclamos en el SRI. Docente de la Universidad Técnica de Machala desde hace 8 años.
                    </p>
                </div>
                <!-- Slide 4 -->
                <div class="carousel-item text-center">
                    <img src="{{ asset('static/img/abogado_4.jpg') }}" alt="Ing. Maria Dolores Niemes" class="d-block mx-auto rounded-circle" style="width: 180px; height: 180px; object-fit: cover;">
                    <h3 class="mt-3">Ing. Maria Dolores Niemes</h3>
                    <p class="fst-italic">Contadora e Ingeniera comercial</p>
                    <p class="px-3 mx-auto" style="max-width: 600px; text-align: justify;">
                        Contadora e Ingeniera comercial en contabilidad por la Universidad Técnica de Machala. Diploma Superior en Tributación y Magister en Tributación y Finanzas por la Universidad de Guayaquil. Egresada del diplomado superior de Perito Contable Tributario por Universidad Metropolitana. Laboró 14 años en la Administración Tributaria, desempeñando funciones de especialista de auditoría, de reclamos, de gestión tributaria y contadora regional en el SRI El Oro.
                    </p>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#teamCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#teamCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
            <div class="carousel-indicators mt-3">
                <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
        </div>
    </section>

    <section class="seccion-quienes">
        <div class="contenido">
            <h2 class="titulo-seccion">{{ $sections['about_title']->content ?? '¿Quiénes Somos?' }}</h2>
            <p class="descripcion-seccion">
                {{ $sections['about_description']->content ?? 'ASESORO nació con la finalidad de apoyar al cumplimiento legal de las empresas. Brindamos asesoría a nuestros clientes, previo a la implementación del negocio y durante la gestión, permitiendo así, que su atención se centre en la producción y generación de recursos para su empresa. Nuestros socios mantienen una destacada trayectoria a nivel de asesoría tributaria empresarial.' }}
            </p>
            <div class="grid-seccion">
                <div class="caja-info">
                    <h3 class="subtitulo">{{ $sections['offer_title']->content ?? '¿Qué Ofrecemos?' }}</h3>
                    <ul class="lista-ofertas">
                        {!! $sections['offer_list']->content ?? '
                        <li><i class="fas fa-check"></i> Consultoría legal, tributaria, contable y financiera</li>
                        <li><i class="fas fa-check"></i> Patrocinio legal ante tribunales y órganos jurisdiccionales</li>
                        <li><i class="fas fa-check"></i> Gestión de cobranza preventiva, extrajudicial y judicial</li>
                        <li><i class="fas fa-check"></i> Planificación jurídica, tributaria y contable</li>
                        <li><i class="fas fa-check"></i> Acompañamiento en procesos de determinación de tributos</li>
                        <li><i class="fas fa-check"></i> Defensa en casos penales económicos</li>
                        ' !!}
                    </ul>
                </div>
                <div class="caja-info">
                    <h3 class="subtitulo">{{ $sections['mission_title']->content ?? 'Nuestra Misión' }}</h3>
                    <p class="texto-justificado">
                        {{ $sections['mission']->content ?? 'Ofrecer asistencia jurídica judicial y extrajudicial, brindando seguridad y confianza a través de soluciones integrales y adecuadas a las necesidades de cada cliente.' }}
                    </p>
                    <h3 class="subtitulo">{{ $sections['vision_title']->content ?? 'Nuestra Visión' }}</h3>
                    <p class="texto-justificado">
                        {{ $sections['vision']->content ?? 'Ser un estudio jurídico líder en la prestación de Servicios Jurídicos, consolidando su crecimiento con experiencia y eficiencia profesional, ofreciendo un servicio integral de calidad en asesoría y consultoría legal, con resultados ágiles y eficientes, cumpliendo siempre con las expectativas de nuestros clientes, en base a valores y principios fundamentales.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="seccion-contacto" id="contact">
        <div class="contenido">
            <h2 class="titulo-seccion">{{ $sections['contact_title']->content ?? 'Contáctanos' }}</h2>
            <p class="descripcion-seccion">
                {{ $sections['contact_description']->content ?? 'Estamos aquí para ayudarte. Completa el formulario o conéctate con nosotros a través de nuestras redes sociales.' }}
            </p>
            <form class="formulario-contacto" id="form-contacto">
                <input type="text" id="name" placeholder="Nombre" required>
                <input type="email" id="email" placeholder="Correo Electrónico" required>
                <textarea id="message" placeholder="Mensaje" rows="5" required></textarea>
                <button type="submit" id="submit-contact">Enviar Mensaje</button>
            </form>

            <div id="modalConfirmacion" class="modal">
                <div class="modal-contenido">
                    <span class="cerrar">×</span>
                    <p>¡Tu mensaje ha sido enviado correctamente!</p>
                </div>
            </div>

            <div class="redes-sociales">
                <h3 class="subtitulo">Conéctate con Nosotros</h3>
                <div class="iconos-redes">
                    <a href="https://www.instagram.com/asesoro.oficial/" target="_blank">
                        <img src="{{ asset('static/img/icon/instagram.png') }}" alt="Instagram">
                    </a>
                    <a href="https://www.linkedin.com" target="_blank">
                        <img src="{{ asset('static/img/icon/linkedin.png') }}" alt="LinkedIn">
                    </a>
                    <a href="https://www.twitter.com" target="_blank">
                        <img src="{{ asset('static/img/icon/X.png') }}" alt="X (Twitter)">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('form-contacto').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const message = document.getElementById('message').value.trim();
            if (name && email && message) {
                document.getElementById('modalConfirmacion').style.display = 'block';
                this.reset();
            }
        });

        document.querySelector('.cerrar').addEventListener('click', function() {
            document.getElementById('modalConfirmacion').style.display = 'none';
        });

        window.addEventListener('click', function(e) {
            const modal = document.getElementById('modalConfirmacion');
            if (e.target == modal) {
                modal.style.display = 'none';
            }
        });
    </script>
@endsection