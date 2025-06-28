@extends('layouts.app')

@section('title', $sections['contact_title']->text ?? 'Contáctanos')

@section('styles')
    <link href="{{ asset('css/contacto.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="contact-section">
        <div class="container py-5">
            <h1 class="mb-3">{{ $sections['contact_title']->text ?? 'Contáctanos' }}</h1>
            <p class="text-center mb-4">{{ $sections['contact_description']->text ?? 'Estamos para ayudarte con todas tus consultas legales. Completa el formulario y nos pondremos en contacto contigo lo antes posible.' }}</p>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form id="contactForm" method="POST" action="{{ route('contactanos.enviar') }}">
                @csrf
                <div class="mb-3">
                    <label for="fullName" class="form-label">
                        {{ $sections['contact_label_fullname']->text ?? 'Nombre Completo' }}
                    </label>
                    <input type="text" class="form-control" id="fullName" name="fullName"
                           placeholder="{{ $sections['contact_placeholder_fullname']->text ?? 'Ingresa tu nombre completo' }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">
                        {{ $sections['contact_label_email']->text ?? 'Correo Electrónico' }}
                    </label>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="{{ $sections['contact_placeholder_email']->text ?? 'Ingresa tu correo electrónico' }}" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">
                        {{ $sections['contact_label_phone']->text ?? 'Número de Teléfono' }}
                    </label>
                    <input type="tel" class="form-control" id="phone" name="phone"
                           placeholder="{{ $sections['contact_placeholder_phone']->text ?? 'Ingresa tu número de teléfono' }}" required>
                </div>
                <div class="mb-3">
                    <label for="company" class="form-label">
                        {{ $sections['contact_label_company']->text ?? 'Nombre de la Empresa (si aplica)' }}
                    </label>
                    <input type="text" class="form-control" id="company" name="company"
                           placeholder="{{ $sections['contact_placeholder_company']->text ?? 'Ingresa el nombre de la empresa' }}">
                </div>
                <div class="mb-3">
                    <label for="consultationType" class="form-label">
                        {{ $sections['contact_label_consultationType']->text ?? 'Tipo de Consulta' }}
                    </label>
                    <select class="form-control" id="consultationType" name="consultationType" required>
                        <option value="Asesoría Tributaria">{{ $sections['contact_option_tax_advisory']->text ?? 'Asesoría Tributaria' }}</option>
                        <option value="Consultoría Jurídica Empresarial">{{ $sections['contact_option_legal_consulting']->text ?? 'Consultoría Jurídica Empresarial' }}</option>
                        <option value="Planeación Fiscal Estratégica">{{ $sections['contact_option_fiscal_planning']->text ?? 'Planeación Fiscal Estratégica' }}</option>
                        <option value="Otro">{{ $sections['contact_option_other']->text ?? 'Otro' }}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">
                        {{ $sections['contact_label_message']->text ?? 'Mensaje' }}
                    </label>
                    <textarea class="form-control" id="message" name="message" rows="4"
                              placeholder="{{ $sections['contact_placeholder_message']->text ?? 'Escribe tu mensaje aquí' }}" required></textarea>
                </div>
                <button type="submit" class="submit-btn">{{ $sections['contact_button_submit']->text ?? 'Enviar Consulta' }}</button>
            </form>
        </div>
    </section>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">{{ $sections['contact_modal_title']->text ?? '¡Consulta Enviada Exitosamente!' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ $sections['contact_modal_message']->text ?? 'Tu consulta ha sido enviada correctamente. Nos pondremos en contacto contigo a la mayor brevedad posible.' }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ $sections['contact_modal_close']->text ?? 'Cerrar' }}</button>
                </div>
            </div>
        </div>
    </div>

    <a href="https://api.whatsapp.com/send/?phone=593989362522&text&type=phone_number&app_absent=0" target="_blank" class="whatsapp-btn">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            const email = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                event.preventDefault();
                alert('{{ $sections['contact_email_error']->text ?? 'Por favor, introduzca un correo electrónico válido.' }}');
                return;
            }
        });

        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                modal.show();
            });
        @endif
    </script>
@endsection