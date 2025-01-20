<footer class="container-fluid">
    <div class="row bg-primary py-5">
        <div class="col">
            <div class="container text-light">
                <div class="row">
                    <section class="col">
                        <img class="mb-4" src="<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) ) ?>" alt="Imagotipo de SuperGIROS Norte del Valle." height="52px">
                        <ul class="d-flex flex-column gap-3 list-unstyled mb-4">
                            <li class="opacity-75">
                                <i class="bi bi-geo-alt"></i>
                                <?php echo esc_attr(get_theme_mod( 'supergiros_info_direccion', 'Carrera 5 No. 10-93 Cartago, Valle del Cauca, Colombia' )) ?>
                            </li>
                            <li class="opacity-75">
                                <i class="bi bi-telephone"></i>
                                <?php echo esc_attr(get_theme_mod( 'supergiros_info_tel', 'PBX (602) 214 7100 ext 141' )) ?>
                            </li>
                            <li class="opacity-75">
                                <i class="bi bi-envelope-at"></i>
                                <?php echo esc_attr(get_theme_mod( 'supergiros_info_mail', 'info@ganesuperservicios.co' )) ?>
                            </li>
                        </ul>
                    </section>
                    <section class="col">
                        <div class="align-content-center mb-4" style="height: 52px;">
                            <h5 class="mb-0">Información</h5>
                        </div>
                        <?php get_template_part( '/template-parts/navigation/nav', 'footer' ) ?>
                    </section>
                    <section class="col">
                        <div class="align-content-center mb-4" style="height: 52px;">
                            <h5 class="mb-0">
                                Mesa de Ayuda
                            </h5>
                        </div>
                        <ul class="d-flex flex-column gap-3 list-unstyled mb-4">
                            <li class="opacity-75">
                                <i class="bi bi-telephone"></i>
                                <?php echo esc_attr(get_theme_mod( 'mesa_de_ayuda_tel', '318 734 704' )) ?>
                            </li>
                            <li class="opacity-75">
                                <i class="bi bi-whatsapp"></i>
                                <?php echo esc_attr(get_theme_mod( 'mesa_de_ayuda_whatsapp', '+57 318 547 8633' )) ?>
                            </li>
                        </ul>
                    </section>
                    <section class="col">
                        <img class="mb-4" src="<?php echo sgnv_get_image_url( 'logos/logo-sic.png' ); ?>" alt="Imagotipo de Superintendencia de Industria y Comercio." height="52px">
                        <ul class="d-flex flex-column gap-3 list-unstyled mb-4">
                            <li class="opacity-75">
                                <i class="bi bi-geo-alt"></i>
                                <?php echo esc_attr(get_theme_mod( 'sic_info_direccion', 'Carrera 13 No. 27-00 Piso 1-2-4-6-7-10 Bogotá D.C, Colombia' )) ?>
                            </li>
                            <li class="opacity-75">
                                <i class="bi bi-telephone"></i>
                                <?php echo esc_attr(get_theme_mod( 'sic_info_tel', 'Linea Gratuita 018000910165' )) ?>
                            </li>
                            <li class="opacity-75">
                                <i class="bi bi-envelope-at"></i>
                                <?php echo esc_attr(get_theme_mod( 'sic_info_mail', 'contactenos@sic.gov.co' )) ?>
                            </li>
                        </ul>
                    </section>
                </div>
                <hr class="my-4">
                <section class="row">
                    <div class="col">
                        <p class="opacity-75 mb-0">Super Servicios del Valle S.A. © 2025</p>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end gap-1">
                            <p class="opacity-75 mb-0">Desarrollado por</p>
                            <a class="link-light link-opacity-75 link-opacity-100-hover link-underline-opacity-0 link-underline-opacity-100-hover" href="#">John Rivera</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>

</body>
</html> 