<?php

/**
  * Enable custom logo.
  *
  * @link https://medium.com/@gonstoll/add-a-custom-logo-uploader-to-your-wordpress-theme-3d1e244279d
  */
    
  function site_logo( $wp_customize ){
    //Settings
    $wp_customize->add_setting( 'site_logo' );//Setting for logo uploader
  
    //Controls
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
                'label'      => 'Upload a logo',
                'section'    => 'title_tagline',
                'settings'   => 'site_logo'
            )
        )
    );
  }
  add_action('customize_register', 'site_logo');
  
  