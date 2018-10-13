<?php get_header(); ?>

<div class="page-portfolio">
	
	<div class="container">

		<h2 class="titulo-portfolio-page">Portfólio</h2>
		
		<div class="row">

			<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?> 
			<?php query_posts("category_name=portfa&showposts=3&paged=$paged"); ?> 

			<?php while(have_posts()) : the_post(); ?>
				
			 <div class="col-md-8 partedaimagem">
			 	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(false, array('class'=>"thumb-principal")); ?></a>
			 </div>

			 <div class="col-md-4 partedotexto">
			 	<h3 class="texto-portfolio-principal"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<h4 class="texto-da-descricao"><?php the_excerpt(); ?></h4>
					<a href="<?php the_permalink(); ?>"><button class="btn-da-desc-principal">LEIA +</button></a>
			 </div>


			 <?php endwhile; ?>


		</div>

			

	</div>

	<div class="container container-custom"><?php echo paginate_links(); ?></div>

</div>


<?php get_footer(); ?>