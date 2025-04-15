<section class="banner-search py-5">
	<div class="container">
		<div class="row">
			<div class="col">
				<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
					<p class="text-white text-center fw-semibold fs-2 mb-4">¿Estás buscando algo?</p>
					<div class="hstack rounded-pill shadow overflow-hidden">
						<input type="search" id="s" name="s" class="form-control rounded-0 border-0 shadow-none fs-5 py-2 px-4" placeholder="Buscar..." value="<?php echo get_search_query(); ?>" required>
						<button type="submit" class="btn btn-secondary rounded-0 border-0 fs-5 py-2 px-3">
							<i class="bi bi-search"></i>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
