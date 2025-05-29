<?php
// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Initialize session data for about sections and FAQs
if (!isset($_SESSION['about_content'])) {
    $_SESSION['about_content'] = [
        'history' => [
            'text' => 'ASESORO nació con la finalidad de apoyar al cumplimiento legal de las empresas. Brindamos asesoría a nuestros clientes, previo a la implementación del negocio y durante la gestión, permitiendo así, que su atención se centre en la producción y generación de recursos para su empresa. Nuestros socios mantienen una destacada trayectoria a nivel de asesoría tributaria empresarial.',
            'image' => '../../static/img/logo asesoro mediano.webp'
        ],
        'mission' => [
            'text' => 'Ofrecer asistencia jurídica judicial y extrajudicial, brindando seguridad y confianza a través de soluciones integrales y adecuadas a las necesidades de cada cliente.',
            'image' => '../../static/img/mision_asesoro.jpg'
        ],
        'vision' => [
            'text' => 'Ser un estudio jurídico líder en la prestación de Servicios Jurídicos, consolidando su crecimiento con experiencia y eficiencia profesional, ofreciendo un servicio integral de calidad en asesoría y consultoría legal, con resultados ágiles y eficientes, cumpliendo siempre con las expectativas de nuestros clientes, en base a valores y principios fundamentales.',
            'image' => '../../static/img/vision_asesoro.jpg'
        ]
    ];
}

if (!isset($_SESSION['faqs'])) {
    $_SESSION['faqs'] = [
        [
            'question' => '¿Qué servicios ofrece ASESORO?',
            'answer' => 'Ofrecemos asesoría jurídica y tributaria, planificación fiscal, defensa legal y consultoría empresarial personalizada para empresas y particulares.'
        ],
        [
            'question' => '¿Cómo puedo contactar a ASESORO?',
            'answer' => 'Puede contactarnos a través de nuestro formulario en la página "Contáctanos" o llamándonos directamente a nuestro número de atención. WhatsApp +593 98 936 2522'
        ],
        [
            'question' => '¿Dónde se encuentran ubicados?',
            'answer' => 'Nuestra oficina principal está ubicada en la Ciudad de Machala, Ecuador. También ofrecemos servicios virtuales para clientes en todo el país. Nos Ubicamos en Ayacucho entre 25 de Junio y Rocafuerte.'
        ]
    ];
}

if (!isset($_SESSION['messages'])) {
    $_SESSION['messages'] = [];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Edit History
    if (isset($_POST['edit_history'])) {
        $text = filter_input(INPUT_POST, 'historyText', FILTER_SANITIZE_STRING);
        if (empty($text)) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'El texto de la historia es obligatorio.'];
        } else {
            $_SESSION['about_content']['history']['text'] = $text;
            if (isset($_FILES['historyImage']) && $_FILES['historyImage']['error'] === UPLOAD_ERR_OK) {
                $target_dir = __DIR__ . '/Uploads/';
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }
                $ext = strtolower(pathinfo($_FILES['historyImage']['name'], PATHINFO_EXTENSION));
                $filename = 'history_' . time() . '.' . $ext;
                $target_file = $target_dir . $filename;
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $max_size = 5 * 1024 * 1024; // 5MB

                if (!in_array($ext, $allowed_types)) {
                    $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Tipo de archivo no permitido para la imagen de historia. Use JPG, PNG, GIF o WebP.'];
                } elseif ($_FILES['historyImage']['size'] > $max_size) {
                    $_SESSION['messages'][] = ['type' => 'error', 'text' => 'La imagen de historia excede el tamaño máximo de 5MB.'];
                } elseif (move_uploaded_file($_FILES['historyImage']['tmp_name'], $target_file)) {
                    $_SESSION['about_content']['history']['image'] = 'Uploads/' . $filename;
                } else {
                    $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Error al subir la imagen de historia. Verifique los permisos del directorio.'];
                }
            }
            $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Historia actualizada exitosamente.'];
        }
        header("Location: about-admin.php");
        exit;
    }

    // Edit Mission
    if (isset($_POST['edit_mission'])) {
        $text = filter_input(INPUT_POST, 'missionText', FILTER_SANITIZE_STRING);
        if (empty($text)) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'El texto de la misión es obligatorio.'];
        } else {
            $_SESSION['about_content']['mission']['text'] = $text;
            if (isset($_FILES['missionImage']) && $_FILES['missionImage']['error'] === UPLOAD_ERR_OK) {
                $target_dir = __DIR__ . '/Uploads/';
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }
                $ext = strtolower(pathinfo($_FILES['missionImage']['name'], PATHINFO_EXTENSION));
                $filename = 'mission_' . time() . '.' . $ext;
                $target_file = $target_dir . $filename;
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $max_size = 5 * 1024 * 1024; // 5MB

                if (!in_array($ext, $allowed_types)) {
                    $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Tipo de archivo no permitido para la imagen de misión. Use JPG, PNG, GIF o WebP.'];
                } elseif ($_FILES['missionImage']['size'] > $max_size) {
                    $_SESSION['messages'][] = ['type' => 'error', 'text' => 'La imagen de misión excede el tamaño máximo de 5MB.'];
                } elseif (move_uploaded_file($_FILES['missionImage']['tmp_name'], $target_file)) {
                    $_SESSION['about_content']['mission']['image'] = 'Uploads/' . $filename;
                } else {
                    $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Error al subir la imagen de misión. Verifique los permisos del directorio.'];
                }
            }
            $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Misión actualizada exitosamente.'];
        }
        header("Location: about-admin.php");
        exit;
    }

    // Edit Vision
    if (isset($_POST['edit_vision'])) {
        $text = filter_input(INPUT_POST, 'visionText', FILTER_SANITIZE_STRING);
        if (empty($text)) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'El texto de la visión es obligatorio.'];
        } else {
            $_SESSION['about_content']['vision']['text'] = $text;
            if (isset($_FILES['visionImage']) && $_FILES['visionImage']['error'] === UPLOAD_ERR_OK) {
                $target_dir = __DIR__ . '/Uploads/';
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }
                $ext = strtolower(pathinfo($_FILES['visionImage']['name'], PATHINFO_EXTENSION));
                $filename = 'vision_' . time() . '.' . $ext;
                $target_file = $target_dir . $filename;
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $max_size = 5 * 1024 * 1024; // 5MB

                if (!in_array($ext, $allowed_types)) {
                    $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Tipo de archivo no permitido para la imagen de visión. Use JPG, PNG, GIF o WebP.'];
                } elseif ($_FILES['visionImage']['size'] > $max_size) {
                    $_SESSION['messages'][] = ['type' => 'error', 'text' => 'La imagen de visión excede el tamaño máximo de 5MB.'];
                } elseif (move_uploaded_file($_FILES['visionImage']['tmp_name'], $target_file)) {
                    $_SESSION['about_content']['vision']['image'] = 'Uploads/' . $filename;
                } else {
                    $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Error al subir la imagen de visión. Verifique los permisos del directorio.'];
                }
            }
            $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Visión actualizada exitosamente.'];
        }
        header("Location: about-admin.php");
        exit;
    }

    // Add FAQ
    if (isset($_POST['add_faq'])) {
        $question = filter_input(INPUT_POST, 'questionText', FILTER_SANITIZE_STRING);
        $answer = filter_input(INPUT_POST, 'answerText', FILTER_SANITIZE_STRING);
        if (empty($question) || empty($answer)) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'La pregunta y la respuesta son obligatorias.'];
        } else {
            $_SESSION['faqs'][] = [
                'question' => $question,
                'answer' => $answer
            ];
            $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Pregunta frecuente agregada exitosamente.'];
        }
        header("Location: about-admin.php");
        exit;
    }

    // Delete FAQ
    if (isset($_POST['delete_faq'])) {
        $faqIndex = filter_input(INPUT_POST, 'faq_index', FILTER_VALIDATE_INT);
        if ($faqIndex === false || $faqIndex === null || !isset($_SESSION['faqs'][$faqIndex])) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Índice de pregunta inválido.'];
        } else {
            unset($_SESSION['faqs'][$faqIndex]);
            $_SESSION['faqs'] = array_values($_SESSION['faqs']); // Reindex array
            $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Pregunta frecuente eliminada exitosamente.'];
        }
        header("Location: about-admin.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - ASESORO Estudio Jurídico Tributario</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="/css/nosotros.css" rel="stylesheet">
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
                            <a class="nav-link active" href="about-admin.php">
                                <i class="fa-solid fa-address-card me-2"></i>Sobre Nosotros
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../blog-admin/blog-admin.php">
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
    <section class="hero-about">
        <div class="container">
            <h1>Sobre Nosotros</h1>
            <p>Conoce nuestra historia, misión y visión de ASESORO Estudio Jurídico Tributario.</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" style="text-align: justify;">
        <div class="container">
            <h2>Nuestra historia, misión y visión</h2>
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
            <div class="section-content">
                <!-- History Section -->
                <div>
                    <h3>Historia</h3>
                    <p><?php echo htmlspecialchars($_SESSION['about_content']['history']['text']); ?></p>
                    <img src="<?php echo htmlspecialchars($_SESSION['about_content']['history']['image']); ?>" alt="Historia" class="img-fluid mt-3">
                    <button class="btn btn-warning btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#editHistoryModal">Editar Historia</button>
                </div>
                <!-- Mission Section -->
                <div>
                    <h3>Misión</h3>
                    <p><?php echo htmlspecialchars($_SESSION['about_content']['mission']['text']); ?></p>
                    <img src="<?php echo htmlspecialchars($_SESSION['about_content']['mission']['image']); ?>" alt="Misión" class="img-fluid mt-3">
                    <button class="btn btn-warning btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#editMissionModal">Editar Misión</button>
                </div>
                <!-- Vision Section -->
                <div>
                    <h3>Visión</h3>
                    <p><?php echo htmlspecialchars($_SESSION['about_content']['vision']['text']); ?></p>
                    <img src="<?php echo htmlspecialchars($_SESSION['about_content']['vision']['image']); ?>" alt="Visión" class="img-fluid mt-3">
                    <button class="btn btn-warning btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#editVisionModal">Editar Visión</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Modals -->
    <!-- Edit History -->
    <div class="modal fade" id="editHistoryModal" tabindex="-1" aria-labelledby="editHistoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editHistoryModalLabel">Editar Historia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="historyText" class="form-label">Texto de la Historia</label>
                            <textarea class="form-control" id="historyText" name="historyText" rows="5" required><?php echo htmlspecialchars($_SESSION['about_content']['history']['text']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="historyImage" class="form-label">Imagen de la Historia</label>
                            <input type="file" class="form-control" id="historyImage" name="historyImage" accept="image/*">
                        </div>
                        <button type="submit" name="edit_history" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Mission -->
    <div class="modal fade" id="editMissionModal" tabindex="-1" aria-labelledby="editMissionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMissionModalLabel">Editar Misión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="missionText" class="form-label">Texto de la Misión</label>
                            <textarea class="form-control" id="missionText" name="missionText" rows="5" required><?php echo htmlspecialchars($_SESSION['about_content']['mission']['text']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="missionImage" class="form-label">Imagen de la Misión</label>
                            <input type="file" class="form-control" id="missionImage" name="missionImage" accept="image/*">
                        </div>
                        <button type="submit" name="edit_mission" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Vision -->
    <div class="modal fade" id="editVisionModal" tabindex="-1" aria-labelledby="editVisionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVisionModalLabel">Editar Visión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="visionText" class="form-label">Texto de la Visión</label>
                            <textarea class="form-control" id="visionText" name="visionText" rows="5" required><?php echo htmlspecialchars($_SESSION['about_content']['vision']['text']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="visionImage" class="form-label">Imagen de la Visión</label>
                            <input type="file" class="form-control" id="visionImage" name="visionImage" accept="image/*">
                        </div>
                        <button type="submit" name="edit_vision" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2>Preguntas Frecuentes</h2>
            <button type="button" class="btn btn-primary mb-4" style="background-color: #cda42b; border-color: #cda42b; --bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#addQuestionModal">+ Agregar Preguntas</button>
            <?php foreach ($_SESSION['faqs'] as $index => $faq): ?>
                <div class="faq-item">
                    <h3><?php echo htmlspecialchars($faq['question']); ?></h3>
                    <p style="display: none;"><?php echo htmlspecialchars($faq['answer']); ?></p>
                    <button type="button" class="btn btn-danger btn-sm mt-2 delete-faq-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteFaqModal" 
                            data-faq-index="<?php echo $index; ?>" 
                            data-faq-question="<?php echo htmlspecialchars($faq['question']); ?>">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Modal for Adding FAQ -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuestionModalLabel">Agregar Nueva Pregunta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="questionText" class="form-label">Pregunta</label>
                            <input type="text" class="form-control" id="questionText" name="questionText" required>
                        </div>
                        <div class="mb-3">
                            <label for="answerText" class="form-label">Respuesta</label>
                            <textarea class="form-control" id="answerText" name="answerText" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="add_faq" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Deleting FAQ -->
    <div class="modal fade" id="deleteFaqModal" tabindex="-1" aria-labelledby="deleteFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFaqModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar la pregunta "<span id="delete-faq-question"></span>"? Esta acción no se puede deshacer.</p>
                    <form id="deleteFaqForm" method="post">
                        <input type="hidden" name="faq_index" id="delete-faq-index">
                        <button type="submit" name="delete_faq" class="btn btn-danger">Confirmar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <h2>Ubicación</h2>
            <p>En la Ciudad de Machala, Ayacucho entre 25 de Junio y Rocafuerte, Edificio Veintemilla Segundo Piso.</p>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1184.2623739986!2d-79.96087038031185!3d-3.258500555885565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x90330e59d7571303%3A0xad08c0e640483ae3!2sAyacucho%201619%2C%20Machala!5e0!3m2!1ses-419!2sec!4v1736816850739!5m2!1ses-419!2sec" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2025 ASESORO Estudio Jurídico Tributario | Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle FAQ answers
        document.querySelectorAll('.faq-item h3').forEach(item => {
            item.addEventListener('click', () => {
                const parent = item.parentElement;
                parent.classList.toggle('active');
                const answer = parent.querySelector('p');
                answer.style.display = parent.classList.contains('active') ? 'block' : 'none';
            });
        });

        // Initialize modal textareas with current content
        document.getElementById('editHistoryModal').addEventListener('show.bs.modal', function () {
            document.getElementById('historyText').value = '<?php echo addslashes($_SESSION['about_content']['history']['text']); ?>';
        });
        document.getElementById('editMissionModal').addEventListener('show.bs.modal', function () {
            document.getElementById('missionText').value = '<?php echo addslashes($_SESSION['about_content']['mission']['text']); ?>';
        });
        document.getElementById('editVisionModal').addEventListener('show.bs.modal', function () {
            document.getElementById('visionText').value = '<?php echo addslashes($_SESSION['about_content']['vision']['text']); ?>';
        });

        // Handle delete FAQ modal
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-faq-btn');
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteFaqModal'));
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const faqIndex = this.getAttribute('data-faq-index');
                    const faqQuestion = this.getAttribute('data-faq-question');
                    document.getElementById('delete-faq-index').value = faqIndex;
                    document.getElementById('delete-faq-question').textContent = faqQuestion;
                    deleteModal.show();
                });
            });
        });
    </script>
</body>
</html>