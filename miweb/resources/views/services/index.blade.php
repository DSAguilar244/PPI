@extends('layouts.app')

@section('title', 'Nuestros Servicios')

@section('styles')
    <link href="{{ asset('css/servicios.css') }}" rel="stylesheet">
@endsection

@php
    $services = \App\Models\Service::all();
@endphp

@section('content')
    <section class="hero-services">
        <div class="container text-center">
            <h1>{{ $sections['services_title']->content ?? 'Servicios Especializados en Derecho Tributario' }}</h1>
            <p>{{ $sections['services_description']->content ?? 'En ASESORO, ofrecemos soluciones personalizadas en derecho tributario, consultoría jurídica y defensa en casos penales. Conoce nuestros servicios.' }}
            </p>
        </div>
    </section>

    <section class="services-list-section">
        <div class="container">
            <h2 class="text-center">{{ $sections['services_list_title']->content ?? 'Nuestros Servicios' }}</h2>
            <div class="row g-4">
                @foreach ($services as $service)
                    <div class="col-md-4">
                        <div class="service-card h-100">
                            @if ($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" class="d-block w-100"
                                    alt="{{ $service->name }}">
                            @else
                                <img src="{{ asset('static/img/default_service.jpg') }}" class="d-block w-100"
                                    alt="{{ $service->name }}">
                            @endif
                            <div class="service-info">
                                <h3>{{ $service->name }}</h3>
                                <p>{{ $service->description }}</p>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#serviceModal{{ $service->id }}">Ver más</button>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Static Services for Reference -->
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="{{ asset('static/img/ase_tributario.jpeg') }}" class="d-block w-100"
                            alt="Asesoría Tributaria">
                        <div class="service-info">
                            <h3>{{ $sections['service1_title']->content ?? 'Consultoría legal, tributaria, contable y financiera' }}
                            </h3>
                            <p>{{ $sections['service1_description']->content ?? 'Somos su aliado estratégico para la toma de decisiones en su negocio, brindamos asesoría preventiva y concurrente, en: contabilidad, tributos, finanzas, laboral, conforme al marco legal vigente. Ofrecemos planificación estratégica adaptada a la necesidad del cliente, facilitando procedimientos a su empresa a fin de mitigar riesgos.' }}
                            </p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal1">Ver
                                más</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="{{ asset('static/img/consul_juridica.webp') }}" class="d-block w-100"
                            alt="Consultoría Empresarial">
                        <div class="service-info">
                            <h3>{{ $sections['service2_title']->content ?? 'Patrocinio legal ante tribunales y órganos jurisdiccionales' }}
                            </h3>
                            <p>{{ $sections['service2_description']->content ?? 'Nos encargamos de ejercer la defensa técnica en procesos administrativos y judiciales en materia: tributaria, penal económica, administrativa, constitucional, laboral, civil, minera, entre otras. Gestionamos trámites notariales y registrales.' }}
                            </p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal2">Ver
                                más</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="{{ asset('static/img/fiscal_estrategica.jpg') }}" class="d-block w-100"
                            alt="Planeación Fiscal">
                        <div class="service-info">
                            <h3>{{ $sections['service3_title']->content ?? 'Gestión de cobranza preventiva, extrajudicial y judicial' }}
                            </h3>
                            <p>{{ $sections['service3_description']->content ?? 'Conocida la empresa y la relación comercial que ésta mantiene con sus clientes, procedemos a cobrar diligentemente al deudor, a través de acciones judiciales y extrajudiciales.' }}
                            </p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal3">Ver
                                más</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="{{ asset('static/img/asistencia_juridica.webp') }}" class="d-block w-100"
                            alt="Planeación jurídica">
                        <div class="service-info">
                            <h3>{{ $sections['service4_title']->content ?? 'Consultoría legal empresarial' }}</h3>
                            <p>{{ $sections['service4_description']->content ?? 'Acompañamiento puntual y permanente desde el inicio y durante toda la gestión de su negocio. Nuestra propuesta de acciones lícitas le permitirá administrar e invertir los recursos económicos dentro del negocio, generando la correcta determinación de tributos.' }}
                            </p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal4">Ver
                                más</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="{{ asset('static/img/acompañamiento_abogado.webp') }}" class="d-block w-100"
                            alt="Acompañamiento en procesos">
                        <div class="service-info">
                            <h3>{{ $sections['service5_title']->content ?? 'Acompañamiento en procesos de determinación de tributos' }}
                            </h3>
                            <p>{{ $sections['service5_description']->content ?? 'Te acompañamos en todas las etapas del proceso de control de parte de las administraciones tributarias, desde requerimientos de información, liquidaciones de impuestos, facilidades de pago, reclamos en vía administrativa y judicial.' }}
                            </p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal5">Ver
                                más</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="{{ asset('static/img/defensa_casos.jpg') }}" class="d-block w-100" alt="Defensa casos">
                        <div class="service-info">
                            <h3>{{ $sections['service6_title']->content ?? 'Defensa en casos penales económicos' }}</h3>
                            <p>{{ $sections['service6_description']->content ?? 'Patrocinio legal en asuntos penales en materia económica por denuncias en casos de presunta defraudación tributaria.' }}
                            </p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal6">Ver
                                más</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section text-center">
        <div class="container">
            <h2>{{ $sections['cta_title']->content ?? '¿Listo para mejorar tu situación fiscal?' }}</h2>
            <p>{{ $sections['cta_description']->content ?? 'Contáctanos hoy mismo y encuentra soluciones adaptadas a tus necesidades.' }}
            </p>
            <button onclick="window.location.href='{{ route('contactanos') }}'">Contáctanos</button>
        </div>
    </section>

    <!-- Modals for Dynamic Services -->
    @foreach ($services as $service)
        <div class="modal fade" id="serviceModal{{ $service->id }}" tabindex="-1"
            aria-labelledby="serviceModal{{ $service->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="serviceModal{{ $service->id }}Label">{{ $service->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-100">
                        @else
                            <img src="{{ asset('static/img/default_service.jpg') }}" alt="{{ $service->name }}"
                                class="w-100">
                        @endif
                        <p>Para solicitar este servicio, por favor, completa el siguiente formulario:</p>
                        <form id="formService{{ $service->id }}">
                            <div class="mb-3">
                                <label for="name{{ $service->id }}" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="name{{ $service->id }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email{{ $service->id }}" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email{{ $service->id }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="company{{ $service->id }}" class="form-label">Nombre de la Empresa</label>
                                <input type="text" class="form-control" id="company{{ $service->id }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description{{ $service->id }}" class="form-label">Descripción del
                                    Caso</label>
                                <textarea class="form-control" id="description{{ $service->id }}" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar Requisitos</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modals for Static Services -->
    <div class="modal fade" id="serviceModal1" tabindex="-1" aria-labelledby="serviceModal1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModal1Label">
                        {{ $sections['service1_title']->content ?? 'Consultoría legal, tributaria, contable y financiera' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('static/img/ase_tributario.jpeg') }}" alt="Asesoría Tributaria" class="w-100">
                    <p>Para realizar el proceso de asesoría tributaria, por favor, ingresa los siguientes datos:</p>
                    <form id="formService1">
                        <div class="mb-3">
                            <label for="name1" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="name1" required>
                        </div>
                        <div class="mb-3">
                            <label for="email1" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email1" required>
                        </div>
                        <div class="mb-3">
                            <label for="company1" class="form-label">Nombre de la Empresa</label>
                            <input type="text" class="form-control" id="company1" required>
                        </div>
                        <div class="mb-3">
                            <label for="description1" class="form-label">Descripción del Caso</label>
                            <textarea class="form-control" id="description1" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Requisitos</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="serviceModal2" tabindex="-1" aria-labelledby="serviceModal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModal2Label">
                        {{ $sections['service2_title']->content ?? 'Patrocinio legal ante tribunales y órganos jurisdiccionales' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('static/img/consul_juridica.webp') }}" alt="Consultoría Empresarial"
                        class="w-100">
                    <p>Para comenzar el proceso de patrocinio legal, por favor, llena los siguientes campos:</p>
                    <form id="formService2">
                        <div class="mb-3">
                            <label for="name2" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="name2" required>
                        </div>
                        <div class="mb-3">
                            <label for="email2" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email2" required>
                        </div>
                        <div class="mb-3">
                            <label for="company2" class="form-label">Nombre de la Empresa</label>
                            <input type="text" class="form-control" id="company2" required>
                        </div>
                        <div class="mb-3">
                            <label for="caseDescription2" class="form-label">Descripción del Caso</label>
                            <textarea class="form-control" id="caseDescription2" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Requisitos</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="serviceModal3" tabindex="-1" aria-labelledby="serviceModal3Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModal3Label">
                        {{ $sections['service3_title']->content ?? 'Gestión de cobranza preventiva, extrajudicial y judicial' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('static/img/fiscal_estrategica.jpg') }}" alt="Planeación Fiscal" class="w-100">
                    <p>Para solicitar una gestión de cobranza, por favor, llena los siguientes datos:</p>
                    <form id="formService3">
                        <div class="mb-3">
                            <label for="name3" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="name3" required>
                        </div>
                        <div class="mb-3">
                            <label for="email3" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email3" required>
                        </div>
                        <div class="mb-3">
                            <label for="company3" class="form-label">Nombre de la Empresa</label>
                            <input type="text" class="form-control" id="company3" required>
                        </div>
                        <div class="mb-3">
                            <label for="fiscalDescription3" class="form-label">Descripción de la Necesidad</label>
                            <textarea class="form-control" id="fiscalDescription3" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Requisitos</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="serviceModal4" tabindex="-1" aria-labelledby="serviceModal4Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModal4Label">
                        {{ $sections['service4_title']->content ?? 'Consultoría legal empresarial' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('static/img/asistencia_juridica.webp') }}" alt="Planeación jurídica"
                        class="w-100">
                    <p>Para comenzar el proceso de consultoría legal empresarial, por favor, llena los siguientes campos:
                    </p>
                    <form id="formService4">
                        <div class="mb-3">
                            <label for="name4" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="name4" required>
                        </div>
                        <div class="mb-3">
                            <label for="email4" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email4" required>
                        </div>
                        <div class="mb-3">
                            <label for="company4" class="form-label">Nombre de la Empresa</label>
                            <input type="text" class="form-control" id="company4" required>
                        </div>
                        <div class="mb-3">
                            <label for="legalDescription4" class="form-label">Descripción del Caso</label>
                            <textarea class="form-control" id="legalDescription4" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Requisitos</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="serviceModal5" tabindex="-1" aria-labelledby="serviceModal5Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModal5Label">
                        {{ $sections['service5_title']->content ?? 'Acompañamiento en procesos de determinación de tributos' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('static/img/acompañamiento_abogado.webp') }}" alt="Acompañamiento en procesos"
                        class="w-100">
                    <p>Para solicitar nuestro acompañamiento en procesos de determinación de tributos, por favor, completa
                        el siguiente formulario:</p>
                    <form id="formService5">
                        <div class="mb-3">
                            <label for="name5" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="name5" required>
                        </div>
                        <div class="mb-3">
                            <label for="email5" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email5" required>
                        </div>
                        <div class="mb-3">
                            <label for="company5" class="form-label">Nombre de la Empresa</label>
                            <input type="text" class="form-control" id="company5" required>
                        </div>
                        <div class="mb-3">
                            <label for="processDescription5" class="form-label">Descripción del Proceso</label>
                            <textarea class="form-control" id="processDescription5" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Requisitos</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="serviceModal6" tabindex="-1" aria-labelledby="serviceModal6Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModal6Label">
                        {{ $sections['service6_title']->content ?? 'Defensa en casos penales económicos' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('static/img/defensa_casos.jpg') }}" alt="Defensa casos" class="w-100">
                    <p>Para solicitar nuestra defensa en casos penales económicos, por favor, llena el siguiente formulario:
                    </p>
                    <form id="formService6">
                        <div class="mb-3">
                            <label for="name6" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="name6" required>
                        </div>
                        <div class="mb-3">
                            <label for="email6" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email6" required>
                        </div>
                        <div class="mb-3">
                            <label for="caseDescription6" class="form-label">Descripción del Caso</label>
                            <textarea class="form-control" id="caseDescription6" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Requisitos</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Alert Modal -->
    <div class="modal fade custom-alert-modal" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">¡Éxito!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Los requisitos para el servicio han sido enviados.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Agregar event listeners para todos los formularios en los modals
        ['formService1', 'formService2', 'formService3', 'formService4', 'formService5', 'formService6'].forEach(formId => {
            document.getElementById(formId).addEventListener('submit', function(event) {
                event.preventDefault();
                this.reset();
                const modal = bootstrap.Modal.getInstance(this.closest('.modal'));
                modal.hide();
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            });
        });

        @foreach ($services as $service)
            document.getElementById('formService{{ $service->id }}').addEventListener('submit', function(event) {
                event.preventDefault();
                this.reset();
                const modal = bootstrap.Modal.getInstance(this.closest('.modal'));
                modal.hide();
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            });
        @endforeach
    </script>
@endsection
