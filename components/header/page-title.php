<title>
	<?php
	if ( is_home() ) {
		bloginfo( 'name' );
	} else {
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
	}
	?>
</title>
