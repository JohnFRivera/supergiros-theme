<?php
$carousel_images = [];
for($i=0; $i < 4; $i++) {
    $mod_key = 'carousel_image_' . ($i + 1);
    $mod = get_theme_mod($mod_key);
    if($mod) {
        $carousel_images[$i] = $mod;
    }
}
?>

<article class="carousel slide" id="carouselHome" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php
        for($i=0; $i < count($carousel_images); $i++) { 
            ?>
            <button type="button" data-bs-target="#carouselHomeIndicators" data-bs-slide-to="<?php echo $i ?>" aria-label="<?php echo 'Slide ' . $i ?>" <?php echo $i === 0 ? 'class="active" aria-current="true"' : '' ?>></button>
            <?php
        }
        ?>
    </div>
    <div class="carousel-inner" style="min-height: 82vh;max-height: 82vh;">
        <?php
        if($carousel_images) {
            foreach($carousel_images as $key => $value) {
                $active = $key === 0 ? ' active' : '';
                ?>
                <div class="carousel-item<?php echo $active ?>">
                    <img src="<?php echo esc_url( $value ) ?>" class="d-block w-100" alt="<?php echo 'Imagen #' . ($key + 1) ?>">
                </div>
                <?php
            }
        } else {
            ?>
            <div class="carousel-item active">
                <img src="<?php echo esc_url( sgnv_get_image_url('thumbnail-index.webp') ) ?>" class="d-block w-100" alt="Imagenes no disponibles">
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    if(count($carousel_images) > 0) {
        ?>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselHome" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselHome" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        <?php
    }
    ?>
</article>