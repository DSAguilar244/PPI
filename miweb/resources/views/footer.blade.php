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
                <li><a href="{{ route('home') }}">Inicio</a></li>
                <li><a href="{{ route('nuestros-servicios') }}">Nuestros Servicios</a></li>
                <li><a href="{{ route('sobre-nosotros') }}">Sobre Nosotros</a></li>
                <li><a href="{{ route('blog-informativo') }}">Blog Informativo</a></li>
                <li><a href="{{ route('contactanos') }}">Contáctanos</a></li>
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

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <p>Te has suscrito correctamente.</p>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <p>Por favor, introduce un correo electrónico válido.</p>
        </div>
    </div>

    <script>
        document.getElementById("submit-newsletter").addEventListener("click", function () {
            const emailInput = document.getElementById("newsletter").value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const successModal = document.getElementById("successModal");
            const errorModal = document.getElementById("errorModal");

            if (emailRegex.test(emailInput)) {
                successModal.style.display = "block";
            } else {
                errorModal.style.display = "block";
            }

            // Close modals
            document.querySelectorAll(".close").forEach(closeBtn => {
                closeBtn.onclick = function () {
                    successModal.style.display = "none";
                    errorModal.style.display = "none";
                };
            });

            // Close modal when clicking outside
            window.onclick = function (event) {
                if (event.target === successModal) {
                    successModal.style.display = "none";
                } else if (event.target === errorModal) {
                    errorModal.style.display = "none";
                }
            };
        });
    </script>
</footer>