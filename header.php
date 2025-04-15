<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
	get_template_part('/components/header/page-title');
	wp_head();
	?>
</head>
<body>

<div class="container-fluid fixed-top">
    <div class="row bg-primary py-3">
        <div class="col">
            <header class="container">
                <div class="position-relative d-flex align-items-center justify-content-center">
                    <?php get_template_part('/components/header/page-logo'); ?>
					<div class="position-absolute end-0">
						<?php get_template_part('/components/header/profile-menu'); ?>
					</div>
                </div>
            </header>
        </div>
    </div>
    <div class="row bg-body shadow-md">
        <div class="col px-0">
            <?php get_template_part( '/components/header/nav-menu' ) ?>
        </div>
    </div>
</div>
<div class="container-fluid" style="height: 125px;">
</div>
