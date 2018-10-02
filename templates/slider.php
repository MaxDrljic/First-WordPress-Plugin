<?php

$args = array(
  'post_type'       => 'testimonial',
  'post_status'     => 'publish',
  'posts_per_page'  => 5,
  'meta_query'      => array(
    array(
      // This is one of the solutions for serialized key in custom meta key in DB of WordPress 
      // First add the 'key', which is defined in TestimonialController
      // Second, I enter a value I want to compare
      // Third, I declare compare with LIKE as a value.
      // In essence, 'the value of something is LIKE the value somethingsomething'
      'key'     => '_max_testimonial_key',
      'value'   => 's:8:"approved";i:1;s:8:"featured";i:1;',
      'compare' => 'LIKE'
    )
  )
);

$query = new WP_Query( $args );

if ($query->have_posts()) :
  echo '<ul>';
  while ($query->have_posts()) : $query->the_post();
    echo '<li>'.get_the_title().'<p>'.get_the_content().'</p></li>';
  endwhile;
  echo '</ul>';
endif;

wp_reset_postdata();