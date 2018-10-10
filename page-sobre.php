<?php get_header(); ?>

<div class="page-sobre">
	<div class="container">
		<div class="row">

			<h2 class="titulo-sobre-page">SOBRE MIM</h2>

				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<?php the_post_thumbnail(false, array('class'=>"img-responsive")); ?>
				
				<?php endwhile; endif; ?>

			<div class="conteudo">
				
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<?php the_content(); ?>

				<?php endwhile; endif; ?>

			</div>
		
				
	
		</div>
	</div>
</div>



<?php get_footer(); ?>