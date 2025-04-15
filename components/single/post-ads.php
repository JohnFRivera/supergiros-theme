<?php
$post_type = get_post_type();
?>
<div class="position-relative">
	<img class="img-fluid rounded border shadow" src="<?php echo get_theme_mod("img_{$post_type}_ads"); ?>" alt="Anuncio">
	<a href="<?php echo get_theme_mod("url_{$post_type}_ads"); ?>" class="stretched-link" target="_blank"></a>
</div>
