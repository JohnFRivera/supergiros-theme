<?php get_header(); ?>
<main>
	<?php 
	get_template_part('/components/index/searcher'); 
	get_template_part('/components/index/carousel');
	?>
    <section class="bg-body-tertiary">
		<div class="container">
			<div class="row">
				<div class="col">
					<?php get_template_part('/components/index/archive-noticias'); ?>
				</div>
			</div>
		</div>
    </section>
    <section class="bg-body-secondary">
		<div class="container">
			<div class="row">
				<div class="col">
					<?php get_template_part('/components/index/archive-resultados-y-secos'); ?>
				</div>
			</div>
		</div>
    </section>
    <section class="background-balls">
		<div class="container">
			<div class="row">
				<div class="col col-xxl-11 z-1 mx-auto">
					<?php get_template_part('/components/index/archive-sorteos-y-loterias'); ?>
				</div>
			</div>
		</div>
    </section>
    <section class="background-coins">
		<div class="container">
			<div class="row">
				<div class="col col-sm-10 col-md-9 col-lg-8 col-xl-7 col-xxl-6 z-1 mx-auto">
					<?php get_template_part('/components/index/chance-simulator'); ?>
				</div>
			</div>
		</div>
    </section>
	<?php get_template_part('/components/index/nav-section'); ?>
</main>
<?php get_footer(); ?>
