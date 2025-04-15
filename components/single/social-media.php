<?php
$social_media = array(
	array( 'name' 	=> 'Instagram', 	'icon' 	=> 'instagram', 	'color' => 'C7507C', 	'url' 	=> '' ),
	array( 'name' 	=> 'Facebook', 		'icon' 	=> 'facebook', 		'color' => '1877F2', 	'url' 	=> '' ),
	array( 'name' 	=> 'YouTube', 		'icon' 	=> 'youtube', 		'color' => 'FE0034', 	'url' 	=> '' ),
	array( 'name' 	=> 'Twitter (X)', 	'icon' 	=> 'twitter-x', 	'color' => '000000', 	'url' 	=> '' ),
);
?>
<div class="bg-body rounded border shadow">
	<div class="border-bottom py-2 px-3">
		<p class="fw-semibold mb-0">Redes Sociales</p>
	</div>
	<div class="p-3">
		<div class="hstack gap-3">
			<?php
			foreach ( $social_media as $item ) {
				?>
				<a href="#<?php echo $item['url']; ?>" title="<?php echo $item['name']; ?>" class="position-relative rounded p-3" style="background-color: #<?php echo $item['color']; ?>;" target="_blank">
					<i class="bi bi-<?php echo $item['icon']; ?> position-absolute top-50 start-50 translate-middle text-white fs-5"></i>
				</a>
				<?php
			}
			?>
		</div>
	</div>
</div>
