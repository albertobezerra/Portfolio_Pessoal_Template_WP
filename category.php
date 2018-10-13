<?php get_header(); ?>

<div class="container">



      <?php while(have_posts()) : the_post(); ?>

      <?php endwhile; ?>


    <?php previous_posts_link(); ?>
    <?php  next_posts_link(); ?>



</div>


<?php get_footer(); ?>