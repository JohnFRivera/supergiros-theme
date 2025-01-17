<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
    <?php wp_head(); ?>
</head>
<body>

<div class="container-fluid fixed-top">
    <div class="row bg-primary py-3">
        <div class="col">
            <header class="container">
                <div class="position-relative d-flex align-items-center justify-content-center">
                    <a href="<?php echo esc_url( home_url() ) ?>">
                        <img src="<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) ) ?>" alt="Imagotipo de SuperGIROS Norte del Valle" height="50px">
                    </a>
                    <?php get_template_part( '/template-parts/components/account-menu' ) ?>
                </div>
            </header>
        </div>
    </div>
    <div class="row bg-body shadow">
        <div class="col">
            <?php get_template_part( '/template-parts/navigation/nav', 'header' ) ?>
        </div>
    </div>
</div>
<div class="container-fluid" style="height: 125px;">
</div>