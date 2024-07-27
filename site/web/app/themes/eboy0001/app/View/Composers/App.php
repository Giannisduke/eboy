<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'siteName' => $this->siteName(),
        ];
    }

    /**
     * Returns the site name.
     *
     * @return string
     */
    public function siteName()
    {
        return get_bloginfo('name', 'display');
    }

    /**
     * Handling Auto-Increment IDs.
     *
     * @return string
     */
    public function get_next_blog_id()
    {
        global $wpdb;
        $table_name = $wpdb->base_prefix . 'blogs';
        $query      = $wpdb->prepare(
          "SELECT AUTO_INCREMENT
          FROM information_schema.TABLES
          WHERE TABLE_SCHEMA = %s
            AND TABLE_NAME = %s",
          DB_NAME, // This is the database name; you can also use $wpdb->dbname
          $table_name
        );
    
        $next_site_id = $wpdb->get_var($query);
        return $next_site_id;
    }
}
