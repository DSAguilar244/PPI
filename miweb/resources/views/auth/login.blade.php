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
            <a href="{{ route('home') }}" class="btn btn-secondary">Volver</a>
        </div>
        <div class="logo-container">
            <img src="{{ asset('static/img/Logo asesoro.png') }}" alt="Logo">
        </div>
        <div class="login-header">
            <h1>Bienvenido a ASESORO</h1>
            <p>Inicia sesión para continuar</p>
        </div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Usuario</label>
                <div class="input-group">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Ingresa tu correo" required value="{{ old('email') }}">
                    <span class="input-group-text icon-container">
                        <i class="fa-solid fa-user-large"></i>
                    </span>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()">
                        <i class="fa fa-eye" id="toggleEye"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Recordar contraseña</label>
            </div>
            <button type="submit" class="btn btn-login">Iniciar Sesión</button>
        </form>
        <div class="login-footer">
            <p>
                ¿Olvidaste tu contraseña? <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Recupérala aquí</a>
            </p>
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
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="forgotEmail" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="forgotEmail" name="email" placeholder="Ingresa tu correo" required value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>