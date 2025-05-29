<?php
include 'header_admin.php';

// Directory for images
$uploadDir = '../static/img/';
$teamDataFile = '../static/data/team_data.json';

// Get list of hero carousel images
$carouselImages = glob($uploadDir . 'fondo_*.jpg');
if (empty($carouselImages)) {
    $carouselImages = [
        '../static/img/fondo_1.jpg',
        '../static/img/fondo_2.jpg',
        '../static/img/fondo_3.jpg'
    ];
}

// Load team data
$teamData = [];
if (file_exists($teamDataFile)) {
    $teamData = json_decode(file_get_contents($teamDataFile), true) ?: [];
}

// Fallback team data
if (empty($teamData)) {
    $teamData = [
        [
            'image' => '../static/img/abogado_1.jpg',
            'name' => 'Dr. Carlos Ordeñana Carrión',
            'title' => 'Doctor en Jurisprudencia',
            'description' => 'Doctor en Jurisprudencia y abogado de los tribunales de la justicia de la República por la Universidad de Cuenca, estudios de postgrado en Tributación en la Universidad de Cuenca y estudios de postgrado en Derecho Procesal en la Universidad San Antonio de Machala. Cuenta con más de 18 años de experiencia en Administración Pública como asesor, coordinador jurídico y depositario fiscal en el SRI y asesor jurídico en la Subscretaría de Minas Zona 7, y en la empresa privada como Gerente general de la Cooperativa de Producción y Comercialización La Clementina.'
        ],
        [
            'image' => '../static/img/abogado_2.jpg',
            'name' => 'Ab. Carla Veintemilla Zambrano',
            'title' => 'Derecho Penal Económico',
            'description' => 'Abogada de la Universidad Técnica Particular de Loja. Egresada de la Universidad Internacional de la Rioja de la maestría Derecho Penal Económico. Trabajó en la Administración Tributaria durante 13 años, desempeñando funciones de analista de cobranzas y de gestión tributaria en el SRI. Ejercicio de defensa técnica en procesos tributarios, administrativos, civiles, laborales, de familia y penal tributario.'
        ],
        [
            'image' => '../static/img/abogado_3.jpg',
            'name' => 'Econ. Daniel Gutierrez Jaramillo',
            'title' => 'Economista',
            'description' => 'Economista por la Escuela Politécnica del Litoral, Contador público autorizado por la Universidad Técnica Particular de Loja, Magister en Administración de Empresas por la Universidad de Guayaquil. Doctor en Ciencias Contables y Empresariales por la Universidad nacional Mayor de San Marcos. Fue funcionario de la Administración Tributaria durante 11 años, desempeñando funciones de jefe de auditoría y jefe de reclamos en el SRI. Docente de la Universidad Técnica de Machala desde hace 8 años.'
        ],
        [
            'image' => '../static/img/abogado_4.jpg',
            'name' => 'Ing. Maria Dolores Niemes',
            'title' => 'Contadora e Ingeniera comercial',
            'description' => 'Contadora e Ingeniera comercial en contabilidad por la Universidad Técnica de Machala. Diploma Superior en Tributación y Magister en Tributación y Finanzas por la Universidad de Guayaquil. Egresada del diplomado superior de Perito Contable Tributario por Universidad Metropolitana. Laboró 14 años en la Administración Tributaria, desempeñando funciones de especialista de auditoría, de reclamos, de gestión tributaria y contadora regional en el SRI El Oro.'
        ]
    ];
}
?>

<section class="hero">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators">
            <?php foreach ($carouselImages as $index => $image): ?>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $index; ?>" <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?php echo $index + 1; ?>"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach ($carouselImages as $index => $image): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <img src="<?php echo htmlspecialchars($image); ?>" class="d-block w-100" alt="Imagen <?php echo $index + 1; ?>">
                </div>
            <?php endforeach; ?>
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
        <button onclick="window.location.href='../admin_paginas/contact-admin/contact-admin.php'">Contáctanos</button>
        <form id="imageUploadForm" enctype="multipart/form-data" style="display: inline;">
            <input type="file" id="imageUpload" name="images[]" accept="image/*" multiple style="display: none;">
            <button type="button" onclick="document.getElementById('imageUpload').click()">Cambiar Imagen</button>
        </form>
    </div>
</section>

<section class="team-section">
    <h2 class="text-center mb-4">Nuestro Equipo de Trabajo</h2>
    <div id="teamCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            <?php foreach ($teamData as $index => $member): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?> text-center">
                    <img src="<?php echo htmlspecialchars($member['image']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" class="d-block mx-auto rounded-circle" style="width: 180px; height: 180px; object-fit: cover;">
                    <h3 class="mt-3"><?php echo htmlspecialchars($member['name']); ?></h3>
                    <p class="fst-italic"><?php echo htmlspecialchars($member['title']); ?></p>
                    <p class="px-3 mx-auto" style="max-width: 600px; text-align: justify;">
                        <?php echo htmlspecialchars($member['description']); ?>
                    </p>
                </div>
            <?php endforeach; ?>
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
            <?php foreach ($teamData as $index => $member): ?>
                <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="<?php echo $index; ?>" <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?php echo $index + 1; ?>"></button>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="team-edit-form mt-4">
        <h3 class="text-center">Agregar Nuevo Miembro</h3>
        <form id="teamEditForm" enctype="multipart/form-data" style="max-width: 600px; margin: 0 auto;">
            <div class="mb-3">
                <label for="teamImage" class="form-label">Imagen del Miembro</label>
                <input type="file" id="teamImage" name="teamImage" accept="image/*" class="form-control">
            </div>
            <div class="mb-3">
                <label for="teamName" class="form-label">Nombre</label>
                <input type="text" id="teamName" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="teamTitle" class="form-label">Título</label>
                <input type="text" id="teamTitle" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="teamDescription" class="form-label">Descripción</label>
                <textarea id="teamDescription" name="description" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Miembro</button>
        </form>
    </div>
</section>

<section class="seccion-quienes">
    <div class="contenido">
        <h2 class="titulo-seccion">¿Quiénes Somos?</h2>
        <p class="descripcion-seccion">
            ASESORO nació con la finalidad de apoyar al cumplimiento legal de las empresas. Brindamos asesoría a nuestros clientes, previo a la implementación del negocio y durante la gestión, permitiendo así, que su atención se centre en la producción y generación de recursos para su empresa. Nuestros socios mantienen una destacada trayectoria a nivel de asesoría tributaria empresarial.
        </p>
        <div class="grid-seccion">
            <div class="caja-info">
                <h3 class="subtitulo">¿Qué Ofrecemos?</h3>
                <ul class="lista-ofertas">
                    <li><i class="fas fa-check"></i> Consultoría legal, tributaria, contable y financiera</li>
                    <li><i class="fas fa-check"></i> Patrocinio legal ante tribunales y órganos jurisdiccionales</li>
                    <li><i class="fas fa-check"></i> Gestión de cobranza preventiva, extrajudicial y judicial</li>
                    <li><i class="fas fa-check"></i> Planificación jurídica, tributaria y contable</li>
                    <li><i class="fas fa-check"></i> Acompañamiento en procesos de determinación de tributos</li>
                    <li><i class="fas fa-check"></i> Defensa en casos penales económicos</li>
                </ul>
            </div>
            <div class="caja-info">
                <h3 class="subtitulo">Nuestra Misión</h3>
                <p class="texto-justificado">
                    Ofrecer asistencia jurídica judicial y extrajudicial, brindando seguridad y confianza a través de soluciones integrales y adecuadas a las necesidades de cada cliente.
                </p>
                <h3 class="subtitulo">Nuestra Visión</h3>
                <p class="texto-justificado">
                    Ser un estudio jurídico líder en la prestación de Servicios Jurídicos, consolidando su crecimiento con experiencia y eficiencia profesional, ofreciendo un servicio integral de calidad en asesoría y consultoría legal, con resultados ágiles y eficientes, cumpliendo siempre con las expectativas de nuestros clientes, en base a valores y principios fundamentales.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="seccion-contacto" id="contact">
    <div class="contenido">
        <h2 class="titulo-seccion">Contáctanos</h2>
        <p class="descripcion-seccion">
            Estamos aquí para ayudarte. Completa el formulario o conéctate con nosotros a través de nuestras redes sociales.
        </p>
        <form class="formulario-contacto" id="form-contacto">
            <input type="text" id="name" placeholder="Nombre" required>
            <input type="email" id="email" placeholder="Correo Electrónico" required>
            <textarea id="message" placeholder="Mensaje" rows="5" required></textarea>
            <button type="submit" id="submit-contact">Enviar Mensaje</button>
        </form>

        <div id="modalConfirmacion" class="modal">
            <div class="modal-contenido">
                <span class="cerrar">×</span>
                <p>¡Tu mensaje ha sido enviado correctamente!</p>
            </div>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Bootstrap carousels
    let heroCarousel = new bootstrap.Carousel(document.querySelector('#carouselExampleIndicators'), {
        interval: 3000,
        ride: 'carousel'
    });

    let teamCarousel = new bootstrap.Carousel(document.querySelector('#teamCarousel'), {
        interval: 5000,
        ride: 'carousel'
    });

    // Handle hero image upload
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const files = event.target.files;
        if (files.length > 0) {
            const formData = new FormData(document.getElementById('imageUploadForm'));
            fetch('upload_handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Hero image upload response:', data); // Debug log
                if (data.success) {
                    const carouselInner = document.querySelector('#carouselExampleIndicators .carousel-inner');
                    const indicators = document.querySelector('#carouselExampleIndicators .carousel-indicators');
                    const currentItems = carouselInner.querySelectorAll('.carousel-item').length;

                    // Remove active class from current items and indicators
                    carouselInner.querySelectorAll('.carousel-item').forEach(item => item.classList.remove('active'));
                    indicators.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));

                    // Add new images
                    data.data.forEach((imagePath, index) => {
                        const carouselItem = document.createElement('div');
                        carouselItem.className = 'carousel-item' + (index === 0 && currentItems === 0 ? ' active' : '');
                        carouselItem.innerHTML = `<img src="${imagePath}" class="d-block w-100" alt="Imagen ${currentItems + index + 1}">`;
                        carouselInner.appendChild(carouselItem);

                        const indicator = document.createElement('button');
                        indicator.type = 'button';
                        indicator.dataset.bsTarget = '#carouselExampleIndicators';
                        indicator.dataset.bsSlideTo = currentItems + index;
                        indicator.setAttribute('aria-label', `Slide ${currentItems + index + 1}`);
                        if (index === 0 && currentItems === 0) {
                            indicator.className = 'active';
                            indicator.setAttribute('aria-current', 'true');
                        }
                        indicators.appendChild(indicator);
                    });

                    // Refresh carousel
                    heroCarousel.dispose();
                    heroCarousel = new bootstrap.Carousel(document.querySelector('#carouselExampleIndicators'), {
                        interval: 3000,
                        ride: 'carousel'
                    });
                    document.getElementById('imageUploadForm').reset();
                } else {
                    alert(data.message || 'Error al cargar las imágenes.');
                }
            })
            .catch(error => {
                console.error('Hero image upload error:', error);
                alert('Error al procesar la solicitud de carga de imágenes.');
            });
        }
    });

    // Handle team form submission
    document.getElementById('teamEditForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('upload_handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log('Team member add response:', data); // Debug log
            if (data.success) {
                const carouselInner = document.querySelector('#teamCarousel .carousel-inner');
                const indicators = document.querySelector('#teamCarousel .carousel-indicators');
                const currentItems = carouselInner.querySelectorAll('.carousel-item').length;

                // Remove active class from current items and indicators
                carouselInner.querySelectorAll('.carousel-item').forEach(item => item.classList.remove('active'));
                indicators.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));

                // Create new team member carousel item
                const member = data.data;
                const carouselItem = document.createElement('div');
                carouselItem.className = 'carousel-item active text-center';
                carouselItem.innerHTML = `
                    <img src="${member.image}" alt="${member.name}" class="d-block mx-auto rounded-circle" style="width: 180px; height: 180px; object-fit: cover;">
                    <h3 class="mt-3">${member.name}</h3>
                    <p class="fst-italic">${member.title}</p>
                    <p class="px-3 mx-auto" style="max-width: 600px; text-align: justify;">${member.description}</p>
                `;
                carouselInner.appendChild(carouselItem);

                // Create new indicator
                const indicator = document.createElement('button');
                indicator.type = 'button';
                indicator.dataset.bsTarget = '#teamCarousel';
                indicator.dataset.bsSlideTo = currentItems;
                indicator.className = 'active';
                indicator.setAttribute('aria-current', 'true');
                indicator.setAttribute('aria-label', `Slide ${currentItems + 1}`);
                indicators.appendChild(indicator);

                // Refresh carousel and navigate to the new slide
                teamCarousel.dispose();
                teamCarousel = new bootstrap.Carousel(document.querySelector('#teamCarousel'), {
                    interval: 5000,
                    ride: 'carousel'
                });
                teamCarousel.to(currentItems); // Navigate to the new slide

                // Reset form
                this.reset();
            } else {
                alert(data.message || 'Error al agregar el miembro del equipo.');
            }
        })
        .catch(error => {
            console.error('Team member add error:', error);
            alert('Error al procesar la solicitud de agregar miembro.');
        });
    });

    // Handle contact form submission
    document.getElementById('form-contacto').addEventListener('submit', function(e) {
        e.preventDefault();
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
        if (name && email && message) {
            document.getElementById('modalConfirmacion').style.display = 'block';
            this.reset();
        }
    });

    document.querySelector('.cerrar').addEventListener('click', function() {
        document.getElementById('modalConfirmacion').style.display = 'none';
    });

    window.addEventListener('click', function(e) {
        const modal = document.getElementById('modalConfirmacion');
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    });
});
</script>

<?php
include '../footer.php';
?>