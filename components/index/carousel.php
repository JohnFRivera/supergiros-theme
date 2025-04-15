<?php
$carousel_items = array();
for($i=0; $i < 5; $i++) {
	// Get mods
    $carousel_image = get_theme_mod('img_banner_'. ($i + 1));
	$carousel_url 	= get_theme_mod('url_banner_'. ($i + 1));
	// Validate
    if( isset($carousel_image) && !empty($carousel_image) ) $carousel_items[$i]['image'] 	= $carousel_image;
	if( isset($carousel_url) && !empty($carousel_url) ) 	$carousel_items[$i]['url'] 		= $carousel_url;
}
?>
<article class="carousel slide" id="carouselHome" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php
		// Generate indicators
        for($i=0; $i < count( $carousel_items ); $i++) { 
            ?>
            <button type="button" data-bs-target="#carouselHome" data-bs-slide-to="<?php echo $i; ?>" aria-label="Slide <?php echo $i; ?>"<?php echo $i === 0 ? ' class="active" aria-current="true"' : '' ?>></button>
            <?php
        }
        ?>
    </div>
    <div class="carousel-inner" style="min-height: 82vh;max-height: 82vh;">
        <?php
		// Validate images
        if( !empty($carousel_items) ) {
            foreach( $carousel_items as $key => $value ) {
                $active = $key === 0 ? ' active' : '';
				$file_name = explode( '/', $value['image'] );
                ?>
                <div class="position-relative carousel-item<?php echo $active ?>">
                    <img src="<?php echo $value['image']; ?>" class="d-block w-100" alt="<?php echo array_pop($file_name); ?>">
					<?php
					// Validate URL
					if( isset($value['url']) ) {
						?>
						<div class="carousel-action">
							<div class="h-100 d-flex align-items-end justify-content-center">
								<p class="text-white text-center fw-bold fs-1 mb-5">Ver más <i class="bi bi-arrow-right"></i></p>
							</div>
						</div>
						<a class="stretched-link" href="<?php echo $value['url']; ?>" target="_Blank"></a>
						<?php
					}
					?>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="carousel-item active">
                <img src="<?php echo supergiros_image_url('thumbnails/thumbnail-index.webp'); ?>" class="d-block w-100" alt="Imagenes no disponibles">
            </div>
            <?php
        }
        ?>
    </div>
    <?php
	// Generate buttons
    if( count($carousel_items) > 0 ) {
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
