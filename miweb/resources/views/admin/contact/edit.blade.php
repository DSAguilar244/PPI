@include('partials.header_admin')
<div class="container bg-dark text-light mt-4 p-4 rounded">
    <h1>Editar Sección de Contacto</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.contact.update') }}">
        @csrf
        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="contact_title" class="form-control" value="{{ $sections['contact_title']->text ?? '' }}">
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="contact_description" class="form-control">{{ $sections['contact_description']->text ?? '' }}</textarea>
        </div>
        <div class="mb-3">
            <label>Label Nombre Completo</label>
            <input type="text" name="contact_label_fullname" class="form-control" value="{{ $sections['contact_label_fullname']->text ?? 'Nombre Completo' }}">
        </div>
        <div class="mb-3">
            <label>Placeholder Nombre Completo</label>
            <input type="text" name="contact_placeholder_fullname" class="form-control" value="{{ $sections['contact_placeholder_fullname']->text ?? 'Ingresa tu nombre completo' }}">
        </div>
        <div class="mb-3">
            <label>Label Correo Electrónico</label>
            <input type="text" name="contact_label_email" class="form-control" value="{{ $sections['contact_label_email']->text ?? 'Correo Electrónico' }}">
        </div>
        <div class="mb-3">
            <label>Placeholder Correo Electrónico</label>
            <input type="text" name="contact_placeholder_email" class="form-control" value="{{ $sections['contact_placeholder_email']->text ?? 'Ingresa tu correo electrónico' }}">
        </div>
        <div class="mb-3">
            <label>Label Número de Teléfono</label>
            <input type="text" name="contact_label_phone" class="form-control" value="{{ $sections['contact_label_phone']->text ?? 'Número de Teléfono' }}">
        </div>
        <div class="mb-3">
            <label>Placeholder Número de Teléfono</label>
            <input type="text" name="contact_placeholder_phone" class="form-control" value="{{ $sections['contact_placeholder_phone']->text ?? 'Ingresa tu número de teléfono' }}">
        </div>
        <div class="mb-3">
            <label>Label Nombre de la Empresa</label>
            <input type="text" name="contact_label_company" class="form-control" value="{{ $sections['contact_label_company']->text ?? 'Nombre de la Empresa (si aplica)' }}">
        </div>
        <div class="mb-3">
            <label>Placeholder Nombre de la Empresa</label>
            <input type="text" name="contact_placeholder_company" class="form-control" value="{{ $sections['contact_placeholder_company']->text ?? 'Ingresa el nombre de la empresa' }}">
        </div>
        <div class="mb-3">
            <label>Label Tipo de Consulta</label>
            <input type="text" name="contact_label_consultationType" class="form-control" value="{{ $sections['contact_label_consultationType']->text ?? 'Tipo de Consulta' }}">
        </div>
        <div class="mb-3">
            <label>Opción Asesoría Tributaria</label>
            <input type="text" name="contact_option_tax_advisory" class="form-control" value="{{ $sections['contact_option_tax_advisory']->text ?? 'Asesoría Tributaria' }}">
        </div>
        <div class="mb-3">
            <label>Opción Consultoría Jurídica Empresarial</label>
            <input type="text" name="contact_option_legal_consulting" class="form-control" value="{{ $sections['contact_option_legal_consulting']->text ?? 'Consultoría Jurídica Empresarial' }}">
        </div>
        <div class="mb-3">
            <label>Opción Planeación Fiscal Estratégica</label>
            <input type="text" name="contact_option_fiscal_planning" class="form-control" value="{{ $sections['contact_option_fiscal_planning']->text ?? 'Planeación Fiscal Estratégica' }}">
        </div>
        <div class="mb-3">
            <label>Opción Otro</label>
            <input type="text" name="contact_option_other" class="form-control" value="{{ $sections['contact_option_other']->text ?? 'Otro' }}">
        </div>
        <div class="mb-3">
            <label>Label Mensaje</label>
            <input type="text" name="contact_label_message" class="form-control" value="{{ $sections['contact_label_message']->text ?? 'Mensaje' }}">
        </div>
        <div class="mb-3">
            <label>Placeholder Mensaje</label>
            <textarea name="contact_placeholder_message" class="form-control">{{ $sections['contact_placeholder_message']->text ?? 'Escribe tu mensaje aquí' }}</textarea>
        </div>
        <div class="mb-3">
            <label>Texto del Botón Enviar</label>
            <input type="text" name="contact_button_submit" class="form-control" value="{{ $sections['contact_button_submit']->text ?? 'Enviar Consulta' }}">
        </div>
        <div class="mb-3">
            <label>Título del Modal</label>
            <input type="text" name="contact_modal_title" class="form-control" value="{{ $sections['contact_modal_title']->text ?? '¡Consulta Enviada Exitosamente!' }}">
        </div>
        <div class="mb-3">
            <label>Mensaje del Modal</label>
            <textarea name="contact_modal_message" class="form-control">{{ $sections['contact_modal_message']->text ?? 'Tu consulta ha sido enviada correctamente. Nos pondremos en contacto contigo a la mayor brevedad posible.' }}</textarea>
        </div>
        <div class="mb-3">
            <label>Texto del Botón Cerrar Modal</label>
            <input type="text" name="contact_modal_close" class="form-control" value="{{ $sections['contact_modal_close']->text ?? 'Cerrar' }}">
        </div>
        <div class="mb-3">
            <label>Mensaje de Error de Correo</label>
            <input type="text" name="contact_email_error" class="form-control" value="{{ $sections['contact_email_error']->text ?? 'Por favor, introduzca un correo electrónico válido.' }}">
        </div>
        <button class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@include('partials.footer_admin')