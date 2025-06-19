@extends('layouts.app')

@section('title', 'Contáctanos')

@section('styles')
    <link href="{{ asset('css/contacto.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="contact-section">
        <div class="container">
            <h1>Contáctanos</h1>
            <p class="text-center mb-4">Estamos para ayudarte con todas tus consultas legales. Completa el formulario y nos pondremos en contacto contigo lo antes posible.</p>

            <form id="contactForm">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="fullName" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Número de Teléfono</label>
                    <input type="tel" class="form-control" id="phone" required>
                </div>

                <div class="mb-3">
                    <label for="company" class="form-label">Nombre de la Empresa (si aplica)</label>
                    <input type="text" class="form-control" id="company">
                </div>

                <div class="mb-3">
                    <label for="consultationType" class="form-label">Tipo de Consulta</label>
                    <select class="form-control" id="consultationType" required>
                        <option value="Asesoría Tributaria">Asesoría Tributaria</option>
                        <option value="Consultoría Jurídica Empresarial">Consultoría Jurídica Empresarial</option>
                        <option value="Planeación Fiscal Estratégica">Planeación Fiscal Estratégica</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="message" rows="4" required></textarea>
                </div>

                <button type="submit" class="submit-btn">Enviar Consulta</button>
            </form>
        </div>
    </section>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">¡Consulta Enviada Exitosamente!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tu consulta ha sido enviada correctamente. Nos pondremos en contacto contigo a la mayor brevedad posible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <a href="https://api.whatsapp.com/send/?phone=593989362522&text&type=phone_number&app_absent=0" target="_blank" class="whatsapp-btn">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const email = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Por favor, introduzca un correo electrónico válido.');
                return;
            }
            const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            modal.show();
            this.reset();
        });
    </script>
@endsection