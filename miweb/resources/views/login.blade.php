@php
session_start();

// Validation in PHP
$loginError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username'];
    $password = $_POST['password'];

    // Validate against hardcoded credentials (replace with database in production)
    if ($email === "admin@asesoro.com" && $password === "Admin123!") {
        $_SESSION['usuario'] = $email;
        header("Location: " . route('admin.home'));
        exit();
    } else {
        $loginError = true; // Set flag for error modal
    }
}
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - ASESORO</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('static/img/Logo asesoro.png') }}" type="image/x-icon">
</head>
<body>
    <div class="login-container">
        <div class="btn-back">
            <button onclick="window.location.href='{{ route('home') }}'">Volver</button>
        </div>
        <div class="logo-container">
            <img src="{{ asset('static/img/Logo asesoro.png') }}" alt="Logo">
        </div>
        <div class="login-header">
            <h1>Bienvenido a ASESORO</h1>
            <p>Inicia sesión para continuar</p>
        </div>
        <form id="loginForm" method="post" action="">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <div class="input-group">
                    <input type="email" class="form-control" id="username" name="username" placeholder="Ingresa tu correo" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Introduce un correo electrónico válido.">
                    <span class="input-group-text icon-container">
                        <i class="fa-solid fa-user-large"></i>
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required 
                        pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}" 
                        title="La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula, una minúscula, un número y un carácter especial.">
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()">
                        <i class="fa fa-eye" id="toggleEye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-login">Iniciar Sesión</button>
        </form>

        <div class="login-footer">
            <p>
                ¿Olvidaste tu contraseña? <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Recupérala aquí</a>
            </p>
            <p>
                ¿No tienes una cuenta? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Regístrate</a>
            </p>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="loginErrorModal" tabindex="-1" aria-labelledby="loginErrorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginErrorModalLabel">Error de Inicio de Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Has ingresado datos incorrectamente. Por favor, verifica tu usuario y contraseña.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Recuperar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="forgotPasswordForm">
                        <div class="mb-3">
                            <label for="forgotEmail" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="forgotEmail" placeholder="Ingresa tu correo" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password Success Modal -->
    <div class="modal fade" id="forgotPasswordSuccessModal" tabindex="-1" aria-labelledby="forgotPasswordSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordSuccessModalLabel">Correo Enviado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Se ha enviado un enlace de recuperación a tu correo electrónico.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Registrarse</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm">
                        <div class="mb-3">
                            <label for="registerName" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="registerName" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="registerEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="registerPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Success Modal -->
    <div class="modal fade" id="registerSuccessModal" tabindex="-1" aria-labelledby="registerSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerSuccessModalLabel">Registro Exitoso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¡Te has registrado exitosamente! Ahora puedes iniciar sesión.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleEye = document.getElementById('toggleEye');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleEye.classList.remove('fa-eye');
                toggleEye.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleEye.classList.remove('fa-eye-slash');
                toggleEye.classList.add('fa-eye');
            }
        }

        // Show error modal if login failed
        @if ($loginError)
            document.addEventListener('DOMContentLoaded', function () {
                const loginErrorModal = new bootstrap.Modal(document.getElementById('loginErrorModal'));
                loginErrorModal.show();
            });
        @endif

        // Handle forgot password form
        document.getElementById('forgotPasswordForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const forgotPasswordModal = bootstrap.Modal.getInstance(document.getElementById('forgotPasswordModal'));
            forgotPasswordModal.hide();
            const forgotPasswordSuccessModal = new bootstrap.Modal(document.getElementById('forgotPasswordSuccessModal'));
            forgotPasswordSuccessModal.show();
        });

        // Handle register form
        document.getElementById('registerForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const registerModal = bootstrap.Modal.getInstance(document.getElementById('registerModal'));
            registerModal.hide();
            const registerSuccessModal = new bootstrap.Modal(document.getElementById('registerSuccessModal'));
            registerSuccessModal.show();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>