<?php
session_start();

// Initialize session data if not set
if (!isset($_SESSION['content'])) {
    $_SESSION['content'] = [
        'team-title' => 'Nuestro Equipo de Trabajo',
        'team-name-1' => 'Dr. Carlos Ordeñana Carrión',
        'team-title-1' => 'Doctor en Jurisprudencia',
        'team-bio-1' => 'Doctor en Jurisprudencia y abogado de los tribunales de la justicia de la República por la Universidad de Cuenca, estudios de postgrado en Tributación en la Universidad de Cuenca y estudios de postgrado en Derecho Procesal en la Universidad San Antonio de Machala. Cuenta con más de 18 años de experiencia en Administración Pública como asesor, coordinador jurídico y depositario fiscal en el SRI y asesor jurídico en la Subscretaría de Minas Zona 7, y en la empresa privada como Gerente general de la Cooperativa de Producción y Comercialización La Clementina.',
        'team-name-2' => 'Ab. Carla Veintemilla Zambrano',
        'team-title-2' => 'Derecho Penal Económico',
        'team-bio-2' => 'Abogada de la Universidad Técnica Particular de Loja. Egresada de la Universidad Internacional de la Rioja de la maestría Derecho Penal Económico. Trabajó en la Administración Tributaria durante 13 años, desempeñando funciones de analista de cobranzas y de gestión tributaria en el SRI. Ejercicio de defensa técnica en procesos tributarios, administrativos, civiles, laborales, de familia y penal tributario.',
        'team-name-3' => 'Econ. Daniel Gutierrez Jaramillo',
        'team-title-3' => 'Economista',
        'team-bio-3' => 'Economista por la Escuela Politécnica del Litoral, Contador público autorizado por la Universidad Técnica Particular de Loja, Magister en Administración de Empresas por la Universidad de Guayaquil. Doctor en Ciencias Contables y Empresariales por la Universidad nacional Mayor de San Marcos. Fue funcionario de la Administración Tributaria durante 11 años, desempeñando funciones de jefe de auditoría y jefe de reclamos en el SRI. Docente de la Universidad Técnica de Machala desde hace 8 años.',
        'team-name-4' => 'Ing. Maria Dolores Niemes',
        'team-title-4' => 'Contadora e Ingeniera comercial',
        'team-bio-4' => 'Contadora e Ingeniera comercial en contabilidad por la Universidad Técnica de Machala. Diploma Superior en Tributación y Magister en Tributación y Finanzas por la Universidad de Guayaquil. Egresada del diplomado superior de Perito Contable Tributario por Universidad Metropolitana. Laboró 14 años en la Administración Tributaria, desempeñando funciones de especialista de auditoría, de reclamos, de gestión tributaria y contadora regional en el SRI El Oro.',
        'quienes-title' => '¿Quiénes Somos?',
        'quienes-description' => 'ASESORO nació con la finalidad de apoyar al cumplimiento legal de las empresas. Brindamos asesoría a nuestros clientes, previo a la implementación del negocio y durante la gestión, permitiendo así, que su atención se centre en la producción y generación de recursos para su empresa. Nuestros socios mantienen una destacada trayectoria a nivel de asesoría tributaria empresarial.',
        'ofertas-title' => '¿Qué Ofrecemos?',
        'ofertas-item-1' => 'Consultoría legal, tributaria, contable y financiera',
        'ofertas-item-2' => 'Patrocinio legal ante tribunales y órganos jurisdiccionales',
        'ofertas-item-3' => 'Gestión de cobranza preventiva, extrajudicial y judicial',
        'ofertas-item-4' => 'Planificación jurídica, tributaria y contable',
        'ofertas-item-5' => 'Acompañamiento en procesos de determinación de tributos',
        'ofertas-item-6' => 'Defensa en casos penales económicos',
        'mision-title' => 'Nuestra Misión',
        'mision-text' => 'Proporcionar soluciones integrales y personalizadas en el ámbito jurídico, tributario y financiero, garantizando el cumplimiento normativo y la optimización de recursos para el éxito de nuestros clientes.',
        'vision-title' => 'Nuestra Visión',
        'vision-text' => 'Ser el estudio jurídico tributario líder en Ecuador, reconocido por nuestra excelencia, innovación y compromiso con el desarrollo empresarial.'
    ];
    $_SESSION['images'] = [
        'team-image-1' => 'static/img/abogado_1.jpg',
        'team-image-2' => 'static/img/abogado_2.jpg',
        'team-image-3' => 'static/img/abogado_3.jpg',
        'team-image-4' => 'static/img/abogado_4.jpg'
    ];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save team changes
    if (isset($_POST['save_team'])) {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'team-') === 0) {
                $_SESSION['content'][$key] = htmlspecialchars($value);
            }
        }
        // Handle image uploads
        foreach ($_FILES as $key => $file) {
            if ($file['name']) {
                $target_dir = "uploads/";
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = $key . '_' . time() . '.' . $ext;
                $target_file = $target_dir . $filename;
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                $max_size = 5 * 1024 * 1024; // 5MB

                if (in_array(strtolower($ext), $allowed_types) && $file['size'] <= $max_size) {
                    if (move_uploaded_file($file['tmp_name'], $target_file)) {
                        $_SESSION['images'][$key] = $target_file;
                    }
                }
            }
        }
        header("Location: index.php?saved=team");
        exit;
    }

    // Save quienes somos changes
    if (isset($_POST['save_quienes'])) {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'quienes-') === 0 || strpos($key, 'ofertas-') === 0 || strpos($key, 'mision-') === 0 || strpos($key, 'vision-') === 0) {
                $_SESSION['content'][$key] = htmlspecialchars($value);
            }
        }
        header("Location: index.php?saved=quienes");
        exit;
    }

    // Add new list item
    if (isset($_POST['add_list_item'])) {
        $itemCount = count(array_filter(array_keys($_SESSION['content']), function($key) {
            return strpos($key, 'ofertas-item-') === 0;
        })) + 1;
        $_SESSION['content']['ofertas-item-' . $itemCount] = 'Nuevo servicio';
        header("Location: index.php");
        exit;
    }

    // Remove last list item
    if (isset($_POST['remove_list_item'])) {
        $items = array_filter(array_keys($_SESSION['content']), function($key) {
            return strpos($key, 'ofertas-item-') === 0;
        });
        if (count($items) > 1) {
            $lastItem = end($items);
            unset($_SESSION['content'][$lastItem]);
        }
        header("Location: index.php");
        exit;
    }
}

// Get list items for ¿Qué Ofrecemos?
$ofertasItems = array_filter($_SESSION['content'], function($key) {
    return strpos($key, 'ofertas-item-') === 0;
}, ARRAY_FILTER_USE_KEY);
ksort($ofertasItems);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asesoro - Estudio Jurídico Tributario</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
            <div class="container d-flex align-items-center justify-content-between">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="../static/img/logo asesoro mediano.webp" alt="Logo de Asesoro" style="height: 50px; margin-right: 10px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
                    <ul class="navbar-nav text-center" id="navbar-links">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <i class="fas fa-home me-2"></i>Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin_paginas/services-admin/services-admin.php">
                                <i class="fa-solid fa-screwdriver-wrench me-2"></i>Nuestros Servicios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin_paginas/about-admin/about-admin.php">
                                <i class="fa-solid fa-address-card me-2"></i>Sobre Nosotros
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin_paginas/blog-admin/blog-admin.php">
                                <i class="fa-solid fa-blog me-2"></i>Blog Informativo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin_paginas/contact-admin/contact-admin.php">
                                <i class="fa-solid fa-address-book me-2"></i>Contáctanos
                            </a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <a href="../index.html" class="btn btn-warning btn-lg px-4 py-2 fw-bold text-dark shadow-sm me-3">
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

    <section class="hero">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../static/img/fondo_1.jpg" class="d-block w-100" alt="Imagen 1">
                </div>
                <div class="carousel-item">
                    <img src="../static/img/fondo_2.jpg" class="d-block w-100" alt="Imagen 2">
                </div>
                <div class="carousel-item">
                    <img src="../static/img/fondo_3.jpg" class="d-block w-100" alt="Imagen 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="hero-content">
            <h1>ASESORO</h1>
            <h2>Estudio Jurídico Tributario</h2>
            <button onclick="window.location.href='paginas/contactanos/contactanos.html'">Contáctanos</button>
            <div class="mt-3">
                <form method="post" enctype="multipart/form-data">
                    <label for="carouselImage" class="form-label">Seleccionar nueva imagen para el carrusel:</label>
                    <input type="file" id="carouselImage" name="carouselImage" class="form-control" accept="image/*">
                    <button type="submit" name="upload_carousel" class="btn btn-primary mt-2">Subir Imagen</button>
                </form>
            </div>
        </div>
    </section>

    <section class="team-section">
        <form method="post" enctype="multipart/form-data">
            <h2 class="text-center mb-4" contenteditable="true" data-key="team-title"><?php echo $_SESSION['content']['team-title']; ?></h2>
            <div id="teamCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active text-center">
                        <div class="editable-image-container">
                            <img src="<?php echo $_SESSION['images']['team-image-1']; ?>" alt="Team Member 1" class="d-block mx-auto rounded-circle editable-image" data-key="team-image-1">
                            <input type="file" name="team-image-1" class="image-upload" accept="image/*">
                        </div>
                        <h3 class="mt-3" contenteditable="true" data-key="team-name-1"><?php echo $_SESSION['content']['team-name-1']; ?></h3>
                        <p class="fst-italic" contenteditable="true" data-key="team-title-1"><?php echo $_SESSION['content']['team-title-1']; ?></p>
                        <p class="px-3 mx-auto" style="max-width: 600px; text-align: justify;" contenteditable="true" data-key="team-bio-1"><?php echo $_SESSION['content']['team-bio-1']; ?></p>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item text-center">
                        <div class="editable-image-container">
                            <img src="<?php echo $_SESSION['images']['team-image-2']; ?>" alt="Team Member 2" class="d-block mx-auto rounded-circle editable-image" data-key="team-image-2">
                            <input type="file" name="team-image-2" class="image-upload" accept="image/*">
                        </div>
                        <h3 class="mt-3" contenteditable="true" data-key="team-name-2"><?php echo $_SESSION['content']['team-name-2']; ?></h3>
                        <p class="fst-italic" contenteditable="true" data-key="team-title-2"><?php echo $_SESSION['content']['team-title-2']; ?></p>
                        <p class="px-3 mx-auto" style="max-width: 600px; text-align: justify;" contenteditable="true" data-key="team-bio-2"><?php echo $_SESSION['content']['team-bio-2']; ?></p>
                    </div>
                    <!-- Slide 3 -->
                    <div class="carousel-item text-center">
                        <div class="editable-image-container">
                            <img src="<?php echo $_SESSION['images']['team-image-3']; ?>" alt="Team Member 3" class="d-block mx-auto rounded-circle editable-image" data-key="team-image-3">
                            <input type="file" name="team-image-3" class="image-upload" accept="image/*">
                        </div>
                        <h3 class="mt-3" contenteditable="true" data-key="team-name-3"><?php echo $_SESSION['content']['team-name-3']; ?></h3>
                        <p class="fst-italic" contenteditable="true" data-key="team-title-3"><?php echo $_SESSION['content']['team-title-3']; ?></p>
                        <p class="px-3 mx-auto" style="max-width: 600px; text-align: justify;" contenteditable="true" data-key="team-bio-3"><?php echo $_SESSION['content']['team-bio-3']; ?></p>
                    </div>
                    <!-- Slide 4 -->
                    <div class="carousel-item text-center">
                        <div class="editable-image-container">
                            <img src="<?php echo $_SESSION['images']['team-image-4']; ?>" alt="Team Member 4" class="d-block mx-auto rounded-circle editable-image" data-key="team-image-4">
                            <input type="file" name="team-image-4" class="image-upload" accept="image/*">
                        </div>
                        <h3 class="mt-3" contenteditable="true" data-key="team-name-4"><?php echo $_SESSION['content']['team-name-4']; ?></h3>
                        <p class="fst-italic" contenteditable="true" data-key="team-title-4"><?php echo $_SESSION['content']['team-title-4']; ?></p>
                        <p class="px-3 mx-auto" style="max-width: 600px; text-align: justify;" contenteditable="true" data-key="team-bio-4"><?php echo $_SESSION['content']['team-bio-4']; ?></p>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#teamCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#teamCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
                <div class="carousel-indicators mt-3">
                    <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
            </div>
            <button type="submit" name="save_team" class="save-button">Guardar Cambios del Equipo</button>
        </form>
    </section>

    <section class="seccion-quienes">
        <div class="contenido">
            <form method="post">
                <h2 class="titulo-seccion" contenteditable="true" data-key="quienes-title"><?php echo $_SESSION['content']['quienes-title']; ?></h2>
                <p class="descripcion-seccion" contenteditable="true" data-key="quienes-description"><?php echo $_SESSION['content']['quienes-description']; ?></p>
                <div class="grid-seccion">
                    <div class="caja-info">
                        <h3 class="subtitulo" contenteditable="true" data-key="ofertas-title"><?php echo $_SESSION['content']['ofertas-title']; ?></h3>
                        <ul class="lista-ofertas" id="ofertas-list">
                            <?php foreach ($ofertasItems as $key => $item): ?>
                                <li contenteditable="true" data-key="<?php echo $key; ?>"><i class="fas fa-check"></i> <?php echo $item; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="list-controls">
                            <button type="submit" name="add_list_item" class="add-item">Agregar Ítem</button>
                            <button type="submit" name="remove_list_item" class="remove-item">Eliminar Último Ítem</button>
                        </div>
                    </div>
                    <div class="caja-info">
                        <h3 class="subtitulo" contenteditable="true" data-key="mision-title"><?php echo $_SESSION['content']['mision-title']; ?></h3>
                        <p class="texto-justificado" contenteditable="true" data-key="mision-text"><?php echo $_SESSION['content']['mision-text']; ?></p>
                        <h3 class="subtitulo" contenteditable="true" data-key="vision-title"><?php echo $_SESSION['content']['vision-title']; ?></h3>
                        <p class="texto-justificado" contenteditable="true" data-key="vision-text"><?php echo $_SESSION['content']['vision-text']; ?></p>
                    </div>
                </div>
                <button type="submit" name="save_quienes" class="save-button">Guardar Cambios de Quienes Somos</button>
            </form>
        </div>
    </section>

    <section class="seccion-contacto" id="contact">
        <div class="contenido">
            <h2 class="titulo-seccion">Contáctanos</h2>
            <p class="descripcion-seccion">
                Estamos aquí para ayudarte. Completa el formulario o conéctate con nosotros a través de nuestras redes sociales.
            </p>
            <div class="formulario-contacto">
                <input type="text" id="name" placeholder="Nombre" required>
                <input type="email" id="email" placeholder="Correo Electrónico" required>
                <textarea id="message" placeholder="Mensaje" rows="5" required></textarea>
                <button id="submit-contact">Enviar Mensaje</button>
            </div>
            <div class="redes-sociales">
                <h3 class="subtitulo">Conéctate con Nosotros</h3>
                <div class="iconos-redes">
                    <a href="https://www.instagram.com/asesoro.oficial/" target="_blank">
                        <img src="../static/img/icon/instagram.png" alt="Instagram">
                    </a>
                    <a href="https://www.linkedin.com" target="_blank">
                        <img src="../static/img/icon/linkedin.png" alt="LinkedIn">
                    </a>
                    <a href="https://www.twitter.com" target="_blank">
                        <img src="../static/img/icon/X.png" alt="X (Twitter)">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3 class="footer-title">ASESORO</h3>
                <p>
                    Estudio Jurídico Tributario comprometido con el éxito de tu empresa. Brindamos soluciones integrales en el ámbito legal, tributario y financiero.
                </p>
            </div>
            <div class="footer-column">
                <h3 class="footer-title">Enlaces Rápidos</h3>
                <ul class="footer-links">
                    <li><a href="#home">Inicio</a></li>
                    <li><a href="paginas/nuestros_servicios/nuestros_servicios.php">Nuestros Servicios</a></li>
                    <li><a href="paginas/sobre_nosotros/sobre_nosotros.php">Sobre Nosotros</a></li>
                    <li><a href="paginas/blog_informativo/blog_informativo.php">Blog Informativo</a></li>
                    <li><a href="paginas/contactanos/contactanos.php">Contáctanos</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3 class="footer-title">Suscríbete</h3>
                <p class="footer-text">Recibe las últimas noticias y actualizaciones directamente en tu correo.</p>
                <div class="footer-newsletter">
                    <input type="email" id="newsletter" placeholder="Tu correo electrónico">
                    <button id="submit-newsletter">Suscribir</button>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 ASESORO Estudio Jurídico Tributario | Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Client-side script to update form fields with edited content
        document.querySelectorAll('[contenteditable="true"]').forEach(element => {
            element.addEventListener('input', () => {
                const key = element.getAttribute('data-key');
                const form = element.closest('form');
                let input = form.querySelector(`input[name="${key}"]`);
                if (!input) {
                    input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    form.appendChild(input);
                }
                input.value = element.innerText;
            });
        });

        // Display save confirmation
        <?php if (isset($_GET['saved'])): ?>
            alert('Cambios de <?php echo $_GET['saved'] === 'team' ? 'equipo' : '¿Quiénes Somos?'; ?> guardados exitosamente.');
        <?php endif; ?>
    </script>
</body>
</html>