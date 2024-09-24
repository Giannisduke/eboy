<?php 
/**
 * Grab latest post title by an author!
 *
 * @param array $data Options for the function.
 * @return string|null Post title for the latest,
 * or null if none.
 */
add_action( 'rest_api_init', 'register_testimonial_rest_route' );
 
function register_testimonial_rest_route(){
	register_rest_route(
		'custom/v2',
		'/testimonials',
		array(
			'methods' => 'GET',
			'callback' => 'get_testimonials',
		)
	);
}

