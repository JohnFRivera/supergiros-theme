<?php
get_header();
?>

<main class="container py-5">
    <div class="row">
        <div class="col">
            <h1 class="text-primary text-center fw-bold mb-0" style="font-size: 12rem;">404</h1>
            <h2 class="text-black-50 text-center fw-bold mb-3">Página no encontrada</h2>
            <h5 class="text-black-50 text-center fw-normal mb-4">La página a la que intentas acceder no existe o ha sido movida</h5>
            <div class="d-flex justify-content-center">
                <a class="btn btn-primary rounded-pill" href="/">Regresar al inicio</a>
            </div>
        </div>
        <div class="col d-flex align-items-center justify-content-center">
            <i class="bi bi-emoji-frown text-primary" style="font-size: 12rem;"></i>
        </div>
    </div>
</main>

<?php
get_footer();
?>