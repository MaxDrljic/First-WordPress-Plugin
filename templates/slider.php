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
  echo '<div class="max-slider--wrapper"><div class="max-slider--container"><div class="max-slider--view"><ul>';
  while ($query->have_posts()) : $query->the_post();
    // Double question mark syntax: do this if it is exists / true, if not, do that other thing.
    $name = get_post_meta( get_the_ID(), '_max_testimonial_key', true )['name'] ?? '';

    echo '<li class="max-slider--view__slides"><p class="testimonial-quote">"'.get_the_content().'"</p><p class="testimonial-author">~ '.$name.' ~</p></li>';
  endwhile;
  // Unicode defined in span elements, code can be found on Google
  echo '</ul></div><div class="max-slider--arrows"><span class="arrow max-slider--arrows__left">&#x3c;</span><span class="arrow max-slider--arrows__right">&#x3e;</span></div></div></div>';
endif;

wp_reset_postdata();