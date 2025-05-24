<?php
// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Initialize session data for blog posts, testimonials, and subscriptions
if (!isset($_SESSION['blog_posts'])) {
    $_SESSION['blog_posts'] = [
        [
            'title' => '¿Cómo optimizar tus impuestos en tiempos de incertidumbre económica?',
            'content' => 'En este artículo exploramos las mejores estrategias para gestionar tus impuestos durante periodos de crisis económica. Desde la planificación fiscal hasta la optimización de deducciones, te ofrecemos consejos prácticos para reducir tu carga tributaria sin comprometer tu cumplimiento fiscal.',
            'image' => '../../static/img/optimizar_impuestos.jpg'
        ],
        [
            'title' => 'Impacto de la reforma tributaria en las pequeñas empresas',
            'content' => 'La reciente reforma tributaria ha afectado a muchas pequeñas empresas. En este post analizamos cómo estos cambios impactan las operaciones diarias de los pequeños empresarios y qué medidas pueden tomar para adaptarse a las nuevas regulaciones fiscales sin comprometer su crecimiento.',
            'image' => '../../static/img/pequenas_empresas.jpg'
        ],
        [
            'title' => 'La importancia de la transparencia fiscal en el sector corporativo',
            'content' => 'La transparencia fiscal es un tema crucial en el mundo corporativo. Este artículo aborda la importancia de una política fiscal clara y abierta para fortalecer la confianza de los inversores, mejorar la reputación de la empresa y asegurar el cumplimiento de la normativa tributaria.',
            'image' => '../../static/img/transparencia_sector.jpg'
        ]
    ];
}

if (!isset($_SESSION['testimonials'])) {
    $_SESSION['testimonials'] = [
        [
            'text' => 'Gracias a ASESORO, pudimos resolver un conflicto tributario de forma rápida y eficaz. ¡Recomiendo sus servicios ampliamente!',
            'name' => 'Juan Pérez, Cliente'
        ],
        [
            'text' => 'El equipo de ASESORO nos brindó un excelente asesoramiento fiscal, lo que nos permitió mejorar nuestra rentabilidad fiscal. Profesionales de confianza.',
            'name' => 'Laura Martínez, Cliente Corporativo'
        ]
    ];
}

if (!isset($_SESSION['subscriptions'])) {
    $_SESSION['subscriptions'] = [];
}

if (!isset($_SESSION['messages'])) {
    $_SESSION['messages'] = [];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add Blog Post
    if (isset($_POST['add_post'])) {
        $title = filter_input(INPUT_POST, 'postTitle', FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST, 'postContent', FILTER_SANITIZE_STRING);

        if (empty($title) || empty($content)) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'El título y el contenido son obligatorios.'];
        } elseif (!isset($_FILES['postImage']) || $_FILES['postImage']['error'] === UPLOAD_ERR_NO_FILE) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Debe seleccionar una imagen para la publicación.'];
        } else {
            $target_dir = __DIR__ . '/uploads/';
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
            $ext = strtolower(pathinfo($_FILES['postImage']['name'], PATHINFO_EXTENSION));
            $filename = 'post_' . time() . '.' . $ext;
            $target_file = $target_dir . $filename;
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $max_size = 5 * 1024 * 1024; // 5MB

            if (!in_array($ext, $allowed_types)) {
                $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Tipo de archivo no permitido. Use JPG, PNG, GIF o WebP.'];
            } elseif ($_FILES['postImage']['size'] > $max_size) {
                $_SESSION['messages'][] = ['type' => 'error', 'text' => 'La imagen excede el tamaño máximo de 5MB.'];
            } elseif (move_uploaded_file($_FILES['postImage']['tmp_name'], $target_file)) {
                $_SESSION['blog_posts'][] = [
                    'title' => $title,
                    'content' => $content,
                    'image' => 'uploads/' . $filename
                ];
                $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Publicación agregada exitosamente.'];
            } else {
                $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Error al subir la imagen. Verifique los permisos del directorio.'];
            }
        }
        header("Location: blog-admin.php");
        exit;
    }

    // Add Testimonial
    if (isset($_POST['add_testimonial'])) {
        $text = filter_input(INPUT_POST, 'testimonialText', FILTER_SANITIZE_STRING);
        $name = filter_input(INPUT_POST, 'testimonialName', FILTER_SANITIZE_STRING);

        if (empty($text) || empty($name)) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'El testimonio y el nombre son obligatorios.'];
        } else {
            $_SESSION['testimonials'][] = [
                'text' => $text,
                'name' => $name
            ];
            $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Testimonio agregado exitosamente.'];
        }
        header("Location: blog-admin.php");
        exit;
    }

    // Newsletter Subscription
    if (isset($_POST['subscribe'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Por favor, ingrese un correo electrónico válido.'];
        } elseif (in_array($email, $_SESSION['subscriptions'])) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Este correo ya está suscrito.'];
        } else {
            $_SESSION['subscriptions'][] = $email;
            $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Suscripción realizada exitosamente.'];
        }
        header("Location: blog-admin.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Informativo - ASESORO Estudio Jurídico Tributario</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="/css/blog.css" rel="stylesheet">
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
                            <a class="nav-link active" href="blog-admin.php">
                                <i class="fa-solid fa-blog me-2"></i>Blog Informativo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../contact-admin/contact-admin.php">
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

    <!-- Hero Section -->
    <section class="hero-blog">
        <div class="container">
            <h1>Blog Informativo</h1>
            <p>Lee nuestras últimas actualizaciones, noticias y consejos sobre el ámbito jurídico tributario.</p>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section">
        <div class="container">
            <h2>Últimas publicaciones</h2>
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
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addPostModal" style="background-color: #cda42b; border-color: #cda42b; --bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                + Añadir publicaciones
            </button>
            <div class="blog-posts">
                <?php foreach ($_SESSION['blog_posts'] as $post): ?>
                    <div class="blog-post">
                        <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                        <p><?php echo htmlspecialchars($post['content']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2>Testimonios</h2>
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addTestimonialModal" style="background-color: #cda42b; border-color: #cda42b; --bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                + Agregar Testimonios
            </button>
            <?php foreach ($_SESSION['testimonials'] as $testimonial): ?>
                <div class="testimonial">
                    <p>"<?php echo htmlspecialchars($testimonial['text']); ?>"</p>
                    <p>- <?php echo htmlspecialchars($testimonial['name']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter">
        <div class="container">
            <h2>Suscríbete a nuestro blog</h2>
            <p>Recibe las últimas novedades y consejos directamente en tu correo.</p>
            <form method="post">
                <input type="email" name="email" placeholder="Ingresa tu email" required>
                <button type="submit" name="subscribe">Suscribirse</button>
            </form>
        </div>
    </section>

    <!-- Modal for Adding Post -->
    <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPostModalLabel">Añadir nueva publicación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">Título</label>
                            <input type="text" class="form-control" id="postTitle" name="postTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="postContent" class="form-label">Contenido</label>
                            <textarea class="form-control" id="postContent" name="postContent" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="postImage" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="postImage" name="postImage" accept="image/*" required>
                        </div>
                        <button type="submit" name="add_post" class="btn btn-primary">Agregar Publicación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Testimonial -->
    <div class="modal fade" id="addTestimonialModal" tabindex="-1" aria-labelledby="addTestimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTestimonialModalLabel">Añadir Testimonio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="testimonialText" class="form-label">Testimonio</label>
                            <textarea class="form-control" id="testimonialText" name="testimonialText" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="testimonialName" class="form-label">Nombre del Cliente</label>
                            <input type="text" class="form-control" id="testimonialName" name="testimonialName" required>
                        </div>
                        <button type="submit" name="add_testimonial" class="btn btn-primary">Agregar Testimonio</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <section class="cta">
        <div class="container">
            <h2>¿Necesitas asesoría legal?</h2>
            <p>Haz clic en el botón para consultar con nosotros directamente.</p>
            <a href="../contact-admin/contact-admin.php" class="btn-cta">Consultar con Nosotros</a>
        </div>
    </section>

    <footer>
        <p>© 2025 ASESORO Estudio Jurídico Tributario | Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>