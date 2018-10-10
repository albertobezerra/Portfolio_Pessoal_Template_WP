<?php get_header(); ?>

<div class="page-post">
	<div class="container">
		<div class="row">


			
				
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<div class="titulo-do-post"><h3><?php the_title(); ?></h3></div>	

				<?php the_content(); ?>

				<?php endwhile; endif; ?>

			
		
				
	
		</div>
	</div>
</div>




<?php get_footer(); ?>