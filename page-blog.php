<?php get_header(); ?>

<div class="page-blog">
	
	<div class="container">
		
		<h2 class="titulo-blog-page">Blog</h2>
		
		<div class="row">

			<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?> 
			<?php query_posts("category_name=doblog&showposts=3&paged=$paged"); ?> 

			


			<?php while(have_posts()) : the_post(); ?>

				
			 <div class="col-md-8 partedaimagem-blog">
			 	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(false, array('class'=>'thumb-principal')); ?></a>
			 </div>

			 <div class="col-md-4 partedotexto-blog">
			 	<h3 class="texto-portfolio-principal-blog"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<h4 class="texto-da-descricao-blog"><?php the_excerpt(); ?></h4>
					<a href="<?php the_permalink(); ?>"><button class="btn-da-desc-principal-blog">LEIA +</button></a>
			 </div>


			<?php endwhile; ?>


		</div>

		<div class="container container-custom"><?php echo paginate_links(); ?></div>
		
	</div>

</div>


<?php get_footer(); ?>