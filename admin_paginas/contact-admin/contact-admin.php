<?php
// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Initialize session data for custom questions and contact submissions
if (!isset($_SESSION['custom_questions'])) {
    $_SESSION['custom_questions'] = [];
}

if (!isset($_SESSION['contact_submissions'])) {
    $_SESSION['contact_submissions'] = [];
}

if (!isset($_SESSION['messages'])) {
    $_SESSION['messages'] = [];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add Custom Question
    if (isset($_POST['add_question'])) {
        $question = filter_input(INPUT_POST, 'questionInput', FILTER_SANITIZE_STRING);
        if (empty($question)) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'La pregunta es obligatoria.'];
        } else {
            $_SESSION['custom_questions'][] = $question;
            $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Pregunta agregada exitosamente.'];
        }
        header("Location: contact-admin.php");
        exit;
    }

    // Contact Form Submission
    if (isset($_POST['submit_contact'])) {
        $fullName = filter_input(INPUT_POST, 'fullName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        $company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
        $consultationType = filter_input(INPUT_POST, 'consultationType', FILTER_SANITIZE_STRING);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
        $customAnswers = [];
        foreach ($_SESSION['custom_questions'] as $index => $question) {
            $answer = filter_input(INPUT_POST, 'custom_' . $index, FILTER_SANITIZE_STRING);
            $customAnswers[$question] = $answer ?: '';
        }

        // Validate required fields
        if (empty($fullName) || empty($email) || empty($phone) || empty($consultationType) || empty($message)) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Por favor, complete todos los campos requeridos.'];
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Correo electrónico inválido.'];
        } elseif (!preg_match('/^\+?\d{7,15}$/', $phone)) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Número de teléfono inválido.'];
        } else {
            $submission = [
                'fullName' => $fullName,
                'email' => $email,
                'phone' => $phone,
                'company' => $company,
                'consultationType' => $consultationType,
                'message' => $message,
                'customAnswers' => $customAnswers,
                'timestamp' => date('Y-m-d H:i:s')
            ];
            $_SESSION['contact_submissions'][] = $submission;
            $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Consulta enviada exitosamente. Nos pondremos en contacto pronto.'];
        }
        header("Location: contact-admin.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos - ASESORO Estudio Jurídico Tributario</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="/css/contacto.css" rel="stylesheet">
    <link rel="icon" href="/static/img/Logo asesoro.png" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
            <div class="container d-flex align-items-center justify-content-between">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="../../static/img/logo asesoro mediano.webp" alt="Logo de Asesoro" style="height: 50px; margin-right: 10px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
                    <ul class="navbar-nav text-center">
                        <li class="nav-item">
                            <a class="nav-link" href="../home_admin.php">
                                <i class="fas fa-home me-2"></i>Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../services-admin/services-admin.php">
                                <i class="fa-solid fa-screwdriver-wrench me-2"></i>Nuestros Servicios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../about-admin/about-admin.php">
                                <i class="fa-solid fa-address-card me-2"></i>Sobre Nosotros
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../blog-admin/blog-admin.php">
                                <i class="fa-solid fa-blog me-2"></i>Blog Informativo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="contact-admin.php">
                                <i class="fa-solid fa-address-book me-2"></i>Contáctanos
                            </a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <a href="../../index.php" class="btn btn-warning btn-lg px-4 py-2 fw-bold text-dark shadow-sm me-3">
                            <i class="fa-solid fa-sign-out-alt me-2"></i>Salir
                        </a>
                        <a href="#" class="btn btn-dark btn-lg px-4 py-2">
                            <i class="fa-solid fa-cogs me-2"></i>Panel Administrativo
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <section class="contact-section">
        <div class="container">
            <h1>Contáctanos</h1>
            <p class="text-center mb-4">Estamos para ayudarte con todas tus consultas legales. Completa el formulario y nos pondremos en contacto contigo lo antes posible.</p>
            <!-- Display messages -->
            <?php if (!empty($_SESSION['messages'])): ?>
                <div class="mt-3">
                    <?php foreach ($_SESSION['messages'] as $message): ?>
                        <div class="alert alert-<?php echo $message['type'] === 'success' ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($message['text']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endforeach; ?>
                    <?php $_SESSION['messages'] = []; // Clear messages after display ?>
                </div>
            <?php endif; ?>
            <button type="button" class="btn btn-primary float-end mb-4" style="background-color: #cda42b; border-color: #cda42b; --bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                + Agregar Campos
            </button>

            <form method="post">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Número de Teléfono</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="company" class="form-label">Nombre de la Empresa (si aplica)</label>
                    <input type="text" class="form-control" id="company" name="company">
                </div>
                <div class="mb-3">
                    <label for="consultationType" class="form-label">Tipo de Consulta</label>
                    <select class="form-control" id="consultationType" name="consultationType" required>
                        <option value="Asesoría Tributaria">Asesoría Tributaria</option>
                        <option value="Consultoría Jurídica Empresarial">Consultoría Jurídica Empresarial</option>
                        <option value="Planeación Fiscal Estratégica">Planeación Fiscal Estratégica</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <!-- Custom Questions -->
                <?php foreach ($_SESSION['custom_questions'] as $index => $question): ?>
                    <div class="mb-3">
                        <label for="custom_<?php echo $index; ?>" class="form-label"><?php echo htmlspecialchars($question); ?></label>
                        <input type="text" class="form-control" id="custom_<?php echo $index; ?>" name="custom_<?php echo $index; ?>" placeholder="Escribe tu respuesta aquí...">
                    </div>
                <?php endforeach; ?>
                <button type="submit" name="submit_contact" class="submit-btn">Enviar Consulta</button>
            </form>
        </div>
    </section>

    <!-- Modal for Adding Question -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuestionModalLabel">Agregar Pregunta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="questionInput" class="form-label">Pregunta</label>
                            <input type="text" class="form-control" id="questionInput" name="questionInput" placeholder="Escribe la pregunta aquí..." required>
                        </div>
                        <button type="submit" name="add_question" class="btn btn-primary">Agregar Pregunta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2025 ASESORO Estudio Jurídico Tributario | Todos los derechos reservados.</p>
    </footer>

    <a href="https://api.whatsapp.com/send/?phone=593989362522&text&type=phone_number&app_absent=0" target="_blank" class="whatsapp-btn">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>