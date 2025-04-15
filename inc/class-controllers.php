<?php
/**
 * Clase ThemeSuperGIROS_Controllers
 * 
 * Se encarga de contener los controladores de las diferentes rutas del tema.
 * 
 * @package supergiros
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/../queries/sorteos_y_loterias.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/../queries/raspa_y_listo.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/../queries/utilidades.php';

class ThemeSuperGIROS_Controllers {

	public function __construct() {
		//
	}

	/**
	 * Obtiene las publicaciones buscadas en la seccion se "search".
	 * 
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function get_search( WP_REST_Request $request ) {
		$response = array(
			'found_posts' 	=> 0,
			'posts' 		=> array(),
		);

		$params = $request->get_params();
		$args 	= array(
			'post_type'         => array('post', 'page', 'portafolio', 'noticias', 'resultados-y-secos', 'planes-de-premios', 'documentos'),
			'orderby'           => 'modified',
			'order'             => 'DESC',
			'posts_per_page'    => -1,
			's' 				=> $params['s'] ?: '',
		);
		$the_query = new WP_Query($args);

		if( $the_query->have_posts() ) {
			$response['found_posts'] = $the_query->found_posts;

			while( $the_query->have_posts() ) {
				$the_query->the_post();
				$ID				= get_the_ID();
				$post_type 		= implode(' ', explode('-', get_post_type()));
				$thumbnail_url	= get_the_post_thumbnail_url();
				$title 			= get_the_title();
				switch($post_type) {
					case 'page':
						$post_type = 'página';
						break;
					case 'post':
						$post_type = 'publicación';
						break;
					case 'resultados y secos':
						$lottery 		= get_the_terms($ID, 'loterias')[0];
						$thumbnail_url	= get_term_meta($lottery->term_id, '_loteria_logotipo', true);
						$title 			= $lottery->name;
						break;
					case 'planes de premios':
						$lottery 		= get_the_terms($ID, 'loterias')[0];
						$thumbnail_url	= get_term_meta($lottery->term_id, '_loteria_logotipo', true);
						$title 			= $lottery->name;
						break;
				}
				$response['posts'][] = array(
					'id'        	=> $ID,
					'thumbnail_url' => !empty($thumbnail_url) ? $thumbnail_url : supergiros_image_url( 'thumbnails/thumbnail-noticias.webp' ),
					'post_type'     => ucfirst($post_type),
					'title'     	=> $title,
					'excerpt'     	=> wp_trim_words(get_the_excerpt(), 10),
					'date'      	=> get_the_date('j \d\e F, Y'),
					'permalink'     => get_the_permalink(),
				);
			}

		}

		return new WP_REST_Response($response, 200);
	}

	/**
	 * Obtiene las publicaciones de los post de WordPress.
	 * 
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function get_post( WP_REST_Request $request ) {
		$response 	= array(
			'found_posts' 	=> 0,
			'posts' 		=> array(),
		);

		$params = $request->get_params();
		$args 	= array(
			'post_type'         => 'post',
			'orderby'           => 'modified',
			'order'             => 'DESC',
			'posts_per_page'    => 15,
			'paged' 			=> $params['paged'] ?: 1,
		);
		if( !empty($params['term']) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy'  => 'category',
					'terms'     => $params['term'],
					'field'     => 'slug',
					'operators'	=> 'IN',
				),
			);
		}
		$the_query = new WP_Query($args);

		if( $the_query->have_posts() ) {
			$response['found_posts'] = $the_query->found_posts;

			while( $the_query->have_posts() ) {
				$the_query->the_post();
				$thumbnail_url = get_the_post_thumbnail_url();
				$response['posts'][] = array(
					'id'        	=> get_the_ID(),
					'thumbnail_url' => !empty($thumbnail_url) ? $thumbnail_url : supergiros_image_url('thumbnails/thumbnail-noticias.webp'),
					'title'     	=> get_the_title(),
					'excerpt' 		=> wp_trim_words(get_the_excerpt(), 8, '...'),
					'modified_date' => get_the_modified_date('j \d\e F, Y'),
					'permalink'     => get_the_permalink(),
				);
			}

		}

		return new WP_REST_Response($response, 200);
	}

	/**
	 * Elimina una publicación de WordPress.
	 * 
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function delete_post( WP_REST_Request $request ) {
		$response 	= array(
			'deleted' => false,
		);

		$post_id = $request->get_param('post_id');
		if( $post_id ) {
			$post = wp_delete_post($post_id, true);
			if( $post ) $response['deleted'] = $post->post_title;
		}

		return new WP_REST_Response($response, 200);
	}

	/**
	 * Obtiene la data del tipo de contenido Portafolio.
	 * 
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function get_portafolio( WP_REST_Request $request ) {
		$response = array(
			'found_posts' 	=> 0,
			'posts' 		=> array(),
		);

		$params = $request->get_params();
		$args 	= array(
			'post_type'         => 'portafolio',
			'orderby'           => 'modified',
			'order'             => 'DESC',
			'posts_per_page'    => -1,
		);
		if( !empty($params['term']) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy'  => 'categorias_portafolio',
					'terms'     => $params['term'],
					'field'     => 'slug',
					'operators'	=> 'IN',
				),
			);
		}
		$the_query = new WP_Query($args);

		if( $the_query->have_posts() ) {
			$response['found_posts'] = $the_query->found_posts;

			while( $the_query->have_posts() ) {
				$the_query->the_post();
				$thumbnail_url	= get_the_post_thumbnail_url();
				$response['posts'][] = array(
					'id'        	=> get_the_ID(),
					'thumbnail_url' => !empty($thumbnail_url) ? $thumbnail_url : supergiros_image_url('thumbnails/thumbnail-logo.webp'),
					'title'     	=> get_the_title(),
					'excerpt'      	=> wp_trim_words(get_the_excerpt(), 15, '...'),
					'permalink'     => get_the_permalink(),
				);
			}

		}

		return new WP_REST_Response($response, 200);
	}

	/**
	 * Obtiene la data del tipo de contenido Noticias.
	 * 
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function get_noticias( WP_REST_Request $request ) {
		$response 	= array(
			'found_posts' 	=> 0,
			'posts' 		=> array(),
		);

		$params = $request->get_params();
		$args 	= array(
			'post_type'         => 'noticias',
			'orderby'           => 'modified',
			'order'             => 'DESC',
			'posts_per_page'    => $params['posts_per_page'] 	?: 15,
			'paged'             => $params['paged'] 			?: 1,
			's'             	=> $params['s'] 				?: '',
		);
		if( !empty($params['term']) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy'  => 'tipos_noticias',
					'terms'     => $params['term'],
					'field'     => 'slug',
					'operators'	=> 'IN',
				),
			);
		}
		$the_query = new WP_Query($args);

		if( $the_query->have_posts() ) {
			$i = 0;
			$response['found_posts'] = $the_query->found_posts;

			while( $the_query->have_posts() ) {
				$the_query->the_post();
				$ID				= get_the_ID();
				$thumbnail_url	= get_the_post_thumbnail_url();
				$response['posts'][] = array(
					'id'        	=> $ID,
					'thumbnail_url' => !empty($thumbnail_url) ? $thumbnail_url : supergiros_image_url('thumbnails/thumbnail-noticias.webp'),
					'title'     	=> get_the_title(),
					'modified_date' => get_the_modified_date('j \d\e F, Y'),
					'permalink'     => get_the_permalink(),
				);
				if( $i === 0 ) $response['posts'][$i]['excerpt'] = wp_trim_words(get_the_excerpt(), 18, '...');
				if( empty($params['term']) ) $response['posts'][$i]['term_name'] = get_the_terms($ID, 'tipos_noticias')[0]->name; $i++;
			}

		}

		return new WP_REST_Response($response, 200);
	}

	/**
	 * Obtiene las publicaciones de los resultados y secos.
	 * 
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function get_resultados_y_secos( WP_REST_Request $request ) {
		$response 	= array(
			'found_posts' 	=> 0,
			'filters' 		=> array(
				'year' 	=> array(),
				'month' => array(),
				'day' 	=> array(),
			),
			'posts' 		=> array(),
		);

		// Filters
		$params = $request->get_params();
		$args 	= array(
			'post_type'         => 'resultados-y-secos',
			'orderby'           => 'date',
			'order'             => 'ASC',
			'posts_per_page'    => -1,
		);
		if( !empty($params['term']) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy'  => 'loterias',
					'terms'     => $params['term'],
					'field'     => 'slug',
					'operators'	=> 'IN',
				),
			);
		}
		if( !empty($params['year']) ) 		$args['year'] 		= intval($params['year']);
		if( !empty($params['monthnum']) ) 	$args['monthnum'] 	= intval($params['monthnum']);
		if( !empty($params['day']) ) 		$args['day'] 		= intval($params['day']);
		$the_query = new WP_Query($args);

		if( $the_query->have_posts() ) {
			$response['found_posts'] = $the_query->found_posts;

			while( $the_query->have_posts() ) {
				$the_query->the_post();
				// Years
				$year = intval(get_the_date('Y'));
				if( !in_array($year, $response['filters']['year']) ) {
					$response['filters']['year'][] = $year;
				}
				// Months
				$month = array(
					'text'  => ucfirst(get_the_date('F')),
					'value' => intval(get_the_date('m')),
				);
				if( !in_array($month, $response['filters']['month']) ) {
					$response['filters']['month'][] = $month;
				}
				// Days
				$day = intval(get_the_date('d'));
				if( !in_array($day, $response['filters']['day']) ) {
					$response['filters']['day'][] = $day;
				}
			}

		}

		// Posts
		$args['posts_per_page'] = 10;
		$args['order'] 			= 'DESC';
		$args['paged'] 			= $params['paged'] ?: 1;
		$the_query = new WP_Query($args);

		if( $the_query->have_posts() ) {

			while( $the_query->have_posts() ) {
				$the_query->the_post();
				$ID 			= get_the_ID();
				$term 			= get_the_terms($ID, 'loterias')[0];
				$logotipo_url	= get_term_meta($term->term_id, '_loteria_logotipo', true);
				$response['posts'][] = array(
					'id'        	=> $ID,
					'logotipo_url'  => !empty($logotipo_url) ? $logotipo_url : supergiros_image_url('thumbnails/thumbnail-logo.webp'),
					'term_name' 	=> $term->name,
					'date'      	=> get_the_date('j \d\e F, Y'),
					'permalink' 	=> get_the_permalink(),
				);
			}

		}

		return new WP_REST_Response($response, 200);
	}

	/**
	 * Obtiene las publicaciones de los planes de premios.
	 * 
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function get_planes_de_premios( WP_REST_Request $request ) {
		$response = array(
			'found_posts' 	=> 0,
			'posts' 		=> array(),
		);

		$params = $request->get_params();
		$args 	= array(
			'post_type'         => 'planes-de-premios',
			'orderby'           => 'modified',
			'order'             => 'DESC',
			'posts_per_page'    => 10,
			'paged' 			=> $params['paged'] ?: 1,
		);
		$the_query = new WP_Query($args);

		if( $the_query->have_posts() ) {
			$response['found_posts'] = $the_query->found_posts;

			while( $the_query->have_posts() ) {
				$the_query->the_post();
				$ID 			= get_the_ID();
				$term 			= get_the_terms($ID, 'loterias')[0];
				$logotipo_url	= get_term_meta($term->term_id, '_loteria_logotipo', true);
				$response['posts'][] = array(
					'id'        	=> $ID,
					'logotipo_url'  => !empty($logotipo_url) ? $logotipo_url : supergiros_image_url('thumbnails/thumbnail-logo.webp'),
					'term_name' 	=> $term->name,
					'modified_date' => get_the_modified_date('j \d\e F, Y'),
					'permalink' 	=> get_the_permalink(),
				);
			}

		}

		return new WP_REST_Response($response, 200);
	}

	/**
	 * Obtiene las publicaciones de los documentos.
	 * 
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function get_documentos( WP_REST_Request $request ) {
		$response = array(
			'found_posts' 	=> 0,
			'posts' 		=> array(),
		);

		$params = $request->get_params();
		$args = array(
			'post_type'         => 'documentos',
			'posts_per_page'    => 15,
			'orderby'           => $params['orderby'] 	?: 'modified',
			'order'             => $params['order'] 	?: 'DESC',
			'paged' 			=> $params['paged'] 	?: 1,
			's' 				=> $params['s'] 		?: '',
		);
		if( !empty($params['term']) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy'  => 'clasificaciones_documentos',
					'terms'     => $params['term'],
					'field'     => 'slug',
					'operators'	=> 'IN',
				),
			);
		}
		$the_query = new WP_Query($args);

		if( $the_query->have_posts() ) {
			$i = 0;
			$response['found_posts'] = $the_query->found_posts;

			while( $the_query->have_posts() ) {
				$the_query->the_post();
				$ID				= get_the_ID();
				$thumbnail_url	= get_the_post_thumbnail_url();
				$response['posts'][] = array(
					'id'        	=> $ID,
					'thumbnail_url' => !empty($thumbnail_url) ? $thumbnail_url : supergiros_image_url('thumbnails/thumbnail-documentos.webp'),
					'title'     	=> get_the_title(),
					'modified_date' => get_the_modified_date('j \d\e F, Y'),
					'permalink'     => get_the_permalink(),
				);
				if( empty($params['term']) ) $response['posts'][$i]['term_name'] = get_the_terms($ID, 'clasificaciones_documentos')[0]->name; $i++;
			}

		}

		return new WP_REST_Response($response, 200);
	}

	// CONSULTAS EXTERNAS

	/**
	 * Obtiene los resultados de los sorteos y loterías.
	 * 
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function get_sorteos_y_loterias_resultados( WP_REST_Request $request ) {
		$resultados = ctrl_sorteos_y_loterias_resultados(array(
			'fecha' => $request->get_param('fecha'),
		));
		$response = array(
			'results'	=> $resultados,
		);
		return new WP_REST_Response($response, 200);
	}

	/**
	 * Obtiene el inventario de los raspa y listo.
	 * 
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function get_raspa_y_listo_inventario( WP_REST_Request $request ) {
		$inventario = ctrl_raspa_y_listo_inventario(array(
			'cedula' => $request->get_param('cedula'),
		));
		$response = array(
			'inventario'	=> $inventario,
		);
		return new WP_REST_Response($response, 200);
	}

	/**
	 * Obtiene los premios pagados de raspa y listo.
	 * 
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function get_raspa_y_listo_premios( WP_REST_Request $request ) {
		$premios_pagados = ctrl_raspa_y_listo_premios_pagados(array(
			'cedula' => $request->get_param('cedula'),
		));
		$response = array(
			'premios_pagados'	=> $premios_pagados,
		);
		return new WP_REST_Response($response, 200);
	}

	/**
	 * Obtiene la validación de una fracción de raspa y listo.
	 * 
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function get_raspa_y_listo_fracciones( WP_REST_Request $request ) {
		$validacion = ctrl_raspa_y_listo_validar_fracciones(array(
			'cedula' => $request->get_param('cedula'),
		));
		$response = array(
			'validacion'	=> $validacion,
		);
		return new WP_REST_Response($response, 200);
	}

	/**
	 * Obtiene las utilidades disponibles del usuario.
	 * 
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function get_utilidades( WP_REST_Request $request ) {
		$utilidades = ctrl_utilidades(array(
			'username' => $request->get_param('u'),
		));
		$response = array(
			'utilidades'	=> $utilidades,
		);
		return new WP_REST_Response($response, 200);
	}

}
