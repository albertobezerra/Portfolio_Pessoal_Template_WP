<?php get_header(); ?>

<div class="page-blog">
	
	<div class="container">
		
		<h2 class="titulo-blog-page">Blog</h2>
		
		<div class="row">

			<?php 
				$args = array('post_type'=>'post', 'category_name'=>'blog', 'showposts'=>3);
				$my_posts = get_posts( $args );
				if($my_posts) : foreach($my_posts as $post) : setup_postdata( $post );
			 ?>

			 <div class="col-md-8 partedaimagem-blog">
			 	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(false, array('class'=>'thumb-principal')); ?></a>
			 </div>

			 <div class="col-md-4 partedotexto-blog">
			 	<h3 class="texto-portfolio-principal-blog"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<h4 class="texto-da-descricao-blog"><?php the_excerpt(); ?></h4>
					<a href="<?php the_permalink(); ?>"><button class="btn-da-desc-principal-blog">LEIA +</button></a>
			 </div>


			 <?php
		    	endforeach;
		    	endif;
	     	?>

		</div>

	</div>

</div>


<?php get_footer(); ?>