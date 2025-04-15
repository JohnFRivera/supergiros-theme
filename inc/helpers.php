<?php
/**
 * Obtiene la url de una imagen
 * @param string $src
 */
function supergiros_image_url( $src ) {
	return get_template_directory_uri() . '/assets/images/' . $src;
}

/**
 * Obtiene el slug del tipo de contenido actual
 * @return string
 */
function supergiros_get_post_type() {
	$post_type = get_post_type();
	if( empty($post_type) ) {
		$queried_object 	= get_queried_object();
		$taxonomy 			= get_taxonomy($queried_object->taxonomy);
		$post_type 			= $taxonomy->object_type[0];
	}
	return $post_type;
}

/**
 * Obtiene el nombre de la taxonomía actual
 * @return string
 */
function supergiros_get_taxonomy() {
	$taxonomy = '';
	if( is_archive() ) {
		$post_type 		= $this->get_post_type();
		$taxonomy 		= get_object_taxonomies($post_type)[0];
	}
	if( is_tax() ) {
		$queried_object = get_queried_object();
		$taxonomy 		= $queried_object->taxonomy;
	}
	return $taxonomy;
}

/**
 * Obtiene el slug del termino actual
 * @return string
 */
function supergiros_get_term() {
	$term = '';
	if( is_tax() ) {
		$queried_object = get_queried_object();
		$term 			= $queried_object->slug;
	}
	return $term;
}

/**
 * Encripta un texto en base64
 * @param string $text
 * @param string $key
 * @return string
 */
function supergiros_encrypt( $text, $key ) {
	$iv_length 			= openssl_cipher_iv_length('aes-256-cbc');
	$iv 				= openssl_random_pseudo_bytes($iv_length);
	$encrypted_text 	= openssl_encrypt($text, 'aes-256-cbc', $key, 0, $iv);
	return base64_encode($encrypted_text . '::' . $iv);
}
