<header class="header_001">

  <a class="brand" href="{{ home_url('/') }}">
  @if ( get_theme_mod( 'site_logo' ) )
        <img src="<?php echo esc_attr(get_theme_mod( 'site_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
  @endif
  </a>

  @if (has_nav_menu('primary_navigation'))
    <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
      {!! 
        wp_nav_menu(array(
                'theme_location' => 'primary_navigation',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
       !!}
    </nav>
  @endif
</header>
