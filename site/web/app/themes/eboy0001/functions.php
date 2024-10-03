<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'delivry'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

if (! function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'delivry'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'delivry'),
        ]
    );
}

\Roots\bootloader()->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters', 'cpt', 'wp_nav_menu', 'customizer', 'endpoints/endpoint_project'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'delivry'), $file)
            );
        }
    });



    add_filter( 'upload_mimes', function ( $mimes ) {
        $mimes['svg'] = 'image/svg+xml';
    
        return $mimes;
    } );


    function eboy_get_product_categories() {
        $taxonomy = "product_cat";
            $terms = get_terms($taxonomy, array('orderby' => 'slug', 'hide_empty' => false, 'exclude' => array( 19 ))); //Exclude Specific Category by ID

            foreach ($terms as $term) {
                $thumbnail_id = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);
                $image = wp_get_attachment_url($thumbnail_id); ?>

                <div class="col-12 col-md-3">
                    <div class="cat-item drop-shadow white-b padding-20 align-center margin-bottom-30">
                        <?php 
                            echo '<h3 class="uppercase strong blue-2-c margin-bototm-20 equal-height">' . $term->name . '</h3>';
                            echo '<div class="item-thumbnail" style="background: url('.$image.');height:150px"></div>'; 
                            echo '<a href="' . get_term_link($term->name, $taxonomy) . '" class="button color-blue-2-radial">View Range</a>';
                        ?>
                    </div>
                </div>
                <?php }
      }
    add_action('eboy_portfolio', 'eboy_get_product_categories', 10 );

    function get_testimonials() {
        $testimonials = array();
        $args = array(
            'post_type' => 'testimonials',
            'nopaging' => true,
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $testimonial_data = array(
                    'title' => get_the_title(),
                    'content' => get_the_content(),
                    // Add other fields as needed
                );
                $testimonials[] = $testimonial_data;
            }
            wp_reset_postdata();
        }
        return rest_ensure_response( $testimonials );
        }