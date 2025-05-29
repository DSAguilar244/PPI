<?php
// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Initialize session data for services if not set
if (!isset($_SESSION['services'])) {
    $_SESSION['services'] = [
        [
            'id' => 1,
            'name' => 'Consultoría legal, tributaria, contable y financiera',
            'description' => 'Somos su aliado estratégico para la toma de decisiones en su negocio, brindamos asesoría preventiva y concurrente, en: contabilidad, tributos, finanzas, laboral, conforme al marco legal vigente. Ofrecemos planificación estratégica adaptada a la necesidad del cliente, facilitando procedimientos a su empresa a fin de mitigar riesgos.',
            'image' => '../../static/img/ase_tributario.jpeg'
        ],
        [
            'id' => 2,
            'name' => 'Patrocinio legal ante tribunales y órganos jurisdiccionales',
            'description' => 'Nos encargamos de ejercer la defensa técnica en procesos administrativos y judiciales en materia: tributaria, penal económica, administrativa, constitucional, laboral, civil, minera, entre otras. Gestionamos trámites notariales y registrales.',
            'image' => '../../static/img/consul_juridica.webp'
        ],
        [
            'id' => 3,
            'name' => 'Gestión de cobranza preventiva, extrajudicial y judicial',
            'description' => 'Conocida la empresa y la relación comercial que ésta mantiene con sus clientes, procedemos a cobrar diligentemente al deudor, a través de acciones judiciales y extrajudiciales.',
            'image' => '../../static/img/fiscal_estrategica.jpg'
        ],
        [
            'id' => 4,
            'name' => 'Consultoría legal empresarial',
            'description' => 'Acompañamiento puntual y permanente desde el inicio y durante toda la gestión de su negocio. Nuestra propuesta de acciones lícitas le permitirá administrar e invertir los recursos económicos dentro del negocio, generando la correcta determinación de tributos.',
            'image' => '../../static/img/asistencia_juridica.webp'
        ],
        [
            'id' => 5,
            'name' => 'Acompañamiento en procesos de determinación de tributos',
            'description' => 'Te acompañamos en todas las etapas del proceso de control de parte de las administraciones tributarias, desde requerimientos de información, liquidaciones de impuestos, facilidades de pago, reclamos en vía administrativa y judicial.',
            'image' => '../../static/img/acompañamiento_abogado.webp'
        ],
        [
            'id' => 6,
            'name' => 'Defensa en casos penales económicos',
            'description' => 'Patrocinio legal en asuntos penales en materia económica por denuncias en casos de presunta defraudación tributaria.',
            'image' => '../../static/img/defensa_casos.jpg'
        ]
    ];
}

// Initialize session for service form submissions and messages
if (!isset($_SESSION['service_submissions'])) {
    $_SESSION['service_submissions'] = [];
}
if (!isset($_SESSION['messages'])) {
    $_SESSION['messages'] = [];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add new service
    if (isset($_POST['add_service'])) {
        $serviceName = filter_input(INPUT_POST, 'serviceName', FILTER_SANITIZE_STRING);
        $serviceDescription = filter_input(INPUT_POST, 'serviceDescription', FILTER_SANITIZE_STRING);

        if (empty($serviceName) || empty($serviceDescription)) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'El nombre y la descripción del servicio son obligatorios.'];
        } elseif (!isset($_FILES['serviceImage']) || $_FILES['serviceImage']['error'] === UPLOAD_ERR_NO_FILE) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Debe seleccionar una imagen para el servicio.'];
        } else {
            $target_dir = __DIR__ . '/Uploads/';
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
            $ext = strtolower(pathinfo($_FILES['serviceImage']['name'], PATHINFO_EXTENSION));
            $filename = 'service_' . time() . '.' . $ext;
            $target_file = $target_dir . $filename;
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $max_size = 5 * 1024 * 1024; // 5MB

            if (!in_array($ext, $allowed_types)) {
                $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Tipo de archivo no permitido. Use JPG, PNG, GIF o WebP.'];
            } elseif ($_FILES['serviceImage']['size'] > $max_size) {
                $_SESSION['messages'][] = ['type' => 'error', 'text' => 'La imagen excede el tamaño máximo de 5MB.'];
            } elseif (move_uploaded_file($_FILES['serviceImage']['tmp_name'], $target_file)) {
                $newId = max(array_column($_SESSION['services'], 'id')) + 1;
                $_SESSION['services'][] = [
                    'id' => $newId,
                    'name' => $serviceName,
                    'description' => $serviceDescription,
                    'image' => 'Uploads/' . $filename
                ];
                $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Servicio agregado exitosamente.'];
            } else {
                $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Error al subir la imagen. Verifique los permisos del directorio.'];
            }
        }
        header("Location: services-admin.php");
        exit;
    }

    // Delete service
    if (isset($_POST['delete_service'])) {
        $serviceId = filter_input(INPUT_POST, 'service_id', FILTER_VALIDATE_INT);
        if ($serviceId === false || $serviceId === null) {
            $_SESSION['messages'][] = ['type' => 'error', 'text' => 'ID de servicio inválido.'];
        } else {
            $found = false;
            foreach ($_SESSION['services'] as $key => $service) {
                if ($service['id'] == $serviceId) {
                    $found = true;
                    // Delete associated image if it exists and is not a default image
                    if (file_exists(__DIR__ . '/' . $service['image']) && strpos($service['image'], '../../static/img/') !== 0) {
                        unlink(__DIR__ . '/' . $service['image']);
                    }
                    // Remove service from session
                    unset($_SESSION['services'][$key]);
                    // Reindex array to avoid gaps
                    $_SESSION['services'] = array_values($_SESSION['services']);
                    $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Servicio eliminado exitosamente.'];
                    break;
                }
            }
            if (!$found) {
                $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Servicio no encontrado.'];
            }
        }
        header("Location: services-admin.php");
        exit;
    }

    // Handle service inquiry forms
    foreach ($_SESSION['services'] as $service) {
        $formId = 'submit_service_' . $service['id'];
        if (isset($_POST[$formId])) {
            $name = filter_input(INPUT_POST, 'name' . $service['id'], FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email' . $service['id'], FILTER_SANITIZE_EMAIL);
            $company = filter_input(INPUT_POST, 'company' . $service['id'], FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description' . $service['id'], FILTER_SANITIZE_STRING);

            if (empty($name) || empty($email) || empty($description) || ($service['id'] != 6 && empty($company))) {
                $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Por favor, complete todos los campos requeridos para el servicio.'];
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['messages'][] = ['type' => 'error', 'text' => 'Correo electrónico inválido.'];
            } else {
                $_SESSION['service_submissions'][] = [
                    'service' => $service['name'],
                    'name' => $name,
                    'email' => $email,
                    'company' => $company,
                    'description' => $description,
                    'timestamp' => date('Y-m-d H:i:s')
                ];
                $_SESSION['messages'][] = ['type' => 'success', 'text' => 'Requisitos para el servicio enviados exitosamente.'];
            }
            header("Location: services-admin.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - ASESORO Estudio Jurídico Tributario</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="/css/servicios.css" rel="stylesheet">
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
                            <a class="nav-link active" href="services-admin.php">
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

    <section class="hero-services">
        <div class="container text-center">
            <h1>Servicios Especializados en Derecho Tributario</h1>
            <p>En ASESORO, ofrecemos soluciones personalizadas en derecho tributario, consultoría jurídica y planeación fiscal. Conoce nuestros servicios.</p>
        </div>
    </section>

    <section class="services-list-section">
        <div class="container">
            <h2 class="text-center">Nuestros Servicios</h2>
            <!-- Display messages -->
            <?php if (!empty($_SESSION['messages'])): ?>
                <?php foreach ($_SESSION['messages'] as $message): ?>
                    <div class="alert alert-<?php echo $message['type'] === 'success' ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($message['text']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endforeach; ?>
                <?php $_SESSION['messages'] = []; // Clear messages after display ?>
            <?php endif; ?>
            <button type="button" class="btn btn-primary" style="background-color: #cda42b; border-color: #cda42b; --bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                + Agregar Servicios
            </button>
            <div class="row g-4">
                <?php foreach ($_SESSION['services'] as $service): ?>
                    <div class="col-md-4">
                        <div class="service-card">
                            <img src="<?php echo htmlspecialchars($service['image']); ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($service['name']); ?>">
                            <div class="service-info">
                                <h3><?php echo htmlspecialchars($service['name']); ?></h3>
                                <p><?php echo htmlspecialchars($service['description']); ?></p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal<?php echo $service['id']; ?>">
                                    Solicitar Servicio
                                </button>
                                <button type="button" class="btn btn-danger btn-sm mt-2 delete-service-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteServiceModal" 
                                        data-service-id="<?php echo $service['id']; ?>" 
                                        data-service-name="<?php echo htmlspecialchars($service['name']); ?>">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Modal for Adding Service -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Agregar Nuevo Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="serviceName" class="form-label">Nombre del Servicio</label>
                            <input type="text" class="form-control" id="serviceName" name="serviceName" required>
                        </div>
                        <div class="mb-3">
                            <label for="serviceDescription" class="form-label">Descripción del Servicio</label>
                            <textarea class="form-control" id="serviceDescription" name="serviceDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="serviceImage" class="form-label">Imagen del Servicio</label>
                            <input type="file" class="form-control" id="serviceImage" name="serviceImage" accept="image/*" required>
                        </div>
                        <button type="submit" name="add_service" class="btn btn-primary">Guardar Servicio</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Deleting Service -->
    <div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-labelledby="deleteServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteServiceModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar el servicio "<span id="delete-service-name"></span>"? Esta acción no se puede deshacer.</p>
                    <form id="deleteServiceForm" method="post">
                        <input type="hidden" name="service_id" id="delete-service-id">
                        <button type="submit" name="delete_service" class="btn btn-danger">Confirmar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="cta-section text-center">
        <div class="container">
            <h2>¿Listo para mejorar tu situación fiscal?</h2>
            <p>Contáctanos hoy mismo y encuentra soluciones integrales.</p>
            <button onclick="window.location.href='../contact-admin/contactes-admin.php'">Contáctanos</button>
        </div>
    </section>

    <footer>
        <p>© 2025 ASESORO Estudio Jurídico Tributario | Todos los derechos reservados.</p>
    </footer>

    <!-- Service Modals -->
    <?php foreach ($_SESSION['services'] as $service): ?>
        <div class="modal fade" id="serviceModal<?php echo $service['id']; ?>" tabindex="-1" aria-labelledby="serviceModal<?php echo $service['id']; ?>Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="serviceModal<?php echo $service['id']; ?>Label"><?php echo htmlspecialchars($service['name']); ?></h5>
                        <button type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="<?php echo htmlspecialchars($service['image']); ?>" alt="<?php echo htmlspecialchars($service['name']); ?>" class="w-100">
                        <p>Para solicitar este servicio, por favor completa el siguiente formulario:</p>
                        <form method="post">
                            <div class="mb-3">
                                <label for="name<?php echo $service['id']; ?>" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="name<?php echo $service['id']; ?>" name="name<?php echo $service['id']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email<?php echo $service['id']; ?>" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email<?php echo $service['id']; ?>" name="email<?php echo $service['id']; ?>" required>
                            </div>
                            <?php if ($service['id'] != 6): ?>
                                <div class="mb-3">
                                    <label for="company<?php echo $service['id']; ?>" class="form-label">Nombre de la Empresa</label>
                                    <input type="text" class="form-control" id="company<?php echo $service['id']; ?>" name="company<?php echo $service['id']; ?>" required>
                                </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label for="description<?php echo $service['id']; ?>" class="form-label">Descripción del Caso</label>
                                <textarea class="form-control" id="description<?php echo $service['id']; ?>" name="description<?php echo $service['id']; ?>" rows="3" required></textarea>
                            </div>
                            <button type="submit" name="submit_service_<?php echo $service['id']; ?>" class="btn btn-primary">Enviar Requisitos</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle delete service modal
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-service-btn');
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteServiceModal'));
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const serviceId = this.getAttribute('data-service-id');
                    const serviceName = this.getAttribute('data-service-name');
                    document.getElementById('delete-service-id').value = serviceId;
                    document.getElementById('delete-service-name').textContent = serviceName;
                    deleteModal.show();
                });
            });
        });
    </script>
</body>
</html>