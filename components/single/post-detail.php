<?php
$author_name = implode(' ', array_map('ucfirst', explode('.', get_the_author_meta('display_name', get_post()->post_author))));
?>
<div class="hstack gap-3">
	<p class="text-black-50 mb-0">
		<i class="bi bi-person"></i>
		Por <?php echo $author_name; ?>
	</p>
	<div class="vr"></div>
	<p class="text-black-50 mb-0">
		<i class="bi bi-calendar4"></i>
		<?php echo ucfirst( get_the_modified_date('F j, Y') ); ?>
	</p>
	<div class="vr"></div>
	<p class="text-black-50 mb-0">
		<i class="bi bi-clock"></i>
		<?php echo get_the_modified_time('g:i a'); ?>
	</p>
</div>
