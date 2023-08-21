<!-- archive for the event post types -->

<?php get_header(); ?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Past Events</h1>
      <div class="page-banner__intro">
        <p>A recap of our past events.</p>
      </div>
    </div>  
    </div>

    <div class="container container--narrow page-section"> 
        
      <?php 
      

      $today = date('Ymd');
      $oldEvents = new WP_Query (array(
        'post_type' => 'event',
        'paged' => get_query_var('paged',1),
            
            'post_type'=> 'event', // the custom post we want to access
            'meta_key' => 'event_date',// assigns the customs sort based on the field type
            'orderby'=> 'meta_value_num',// order them my numbers
            'order'=> 'ASC',// makes sure the are ascending 
            'meta_query' =>array(// this query will make sure events from the past are not shown
              'key'=> 'event_date', //checks that the event date
              'compare'=> '<', //is less than todays date
              'value'=> $today,// today's date 
              'type' => 'numeric',// tells wordpress that the type is numeric

      )
      )
  
      );
      
      
      while($oldEvents->have_posts()) {
        $oldEvents->the_post(); ?>
        <div class="event-summary">
         
            <a class="event-summary__date t-center" href="#">
             <span class="event-summary__month"><?php 
              $eventDate = new DateTime(get_field('event_date'));
              echo $eventDate-> format('M')
              
              
              ?></span>
              <span class="event-summary__day"><?php echo $eventDate-> format('d')?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
              <p> <?php echo wp_trim_words(get_the_content(),18)  ?> <a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
              </div>

      </div>
            
        
      <?php }
      echo paginate_links(array(
        'total' => $oldEvents->max_num_pages // when we a custom query we need to enable pagination this way
      ));

      ?>
      

     
    



 

  <?php get_footer();

?>