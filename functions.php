<?php

function university_files() {
     wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}// review this section

add_action('wp_enqueue_scripts', 'university_files');

function university_features() {
  add_theme_support('title-tag');
  register_nav_menu("headerMenuLocation", "Header Menu Location"); // this will add the menu in the admin menu tab
  register_nav_menu("footerLocationOne", "Footer Location One"); // this will add the menu in the admin menu tab
  register_nav_menu("footerLocationTwo", "Footer Location Two"); // this will add the menu in the admin menu tab
}
add_action('after_setup_theme', 'university_features');
//custom plugins located in mu-plugins folder , make sure to save changes of permalinks in settings
function university_adjust_queries($query){ //$query is given by wordpress
  $today = date('Ymd');
  if(!is_admin() && is_post_type_archive('event') && $query->is_main_query()){ // is_admin ensures this is only done on the backend
    $query->set('meta_key', 'event_date');
    $query->set( 'orderby','meta_value_num');
    $query->set( 'order','ASC');
    $query->set('meta_query',array(
              'key'=> 'event_date', 
              'compare'=> '>=', 
              'value'=> $today,
              'type' => 'numeric',
            ));
    
    


  }

};
add_action('pre_get_posts','university_adjust_queries')
?>



