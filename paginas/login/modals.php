<!-- Modal Forgot Password -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Recuperar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="forgotPasswordForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Ingresa tu correo electrónico</label>
                        <input type="email" class="form-control" id="email" placeholder="Correo electrónico" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar enlace de recuperación</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Forgot Password Success -->
<div class="modal fade" id="forgotPasswordSuccessModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Éxito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Se ha enviado un enlace de recuperación a tu correo electrónico.</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Register -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear una Cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm">
                    <div class="mb-3">
                        <label for="newUsername" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="newUsername" placeholder="Ingresa tu usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="newPassword" placeholder="Ingresa tu contraseña" required>
                    </div>
                    <div class="mb-3">
                        <label for="newEmail" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="newEmail" placeholder="Ingresa tu correo electrónico" required>
                    </div>
                    <div class="mb-3">
                        <label for="newCedula" class="form-label">Cédula</label>
                        <input type="text" class="form-control" id="newCedula" placeholder="Ingresa tu cédula" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPhone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="newPhone" placeholder="Ingresa tu teléfono" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Crear Cuenta</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Register Success -->
<div class="modal fade" id="registerSuccessModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¡Registro Exitoso!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Te has registrado correctamente. ¡Bienvenido!</p>
            </div>
        </div>
    </div>
</div>