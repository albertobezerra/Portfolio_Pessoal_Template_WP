<?php get_header(); ?>



<!-- IMAGEM FULL -->
<div class="imgprincipal">
	
	<center><img class="img-responsive" src="<?php bloginfo('template_directory'); ?>/assets/images/header.jpg"></center>


</div>

<!-- IMAGEM FULL -->

<!-- SOBRE -->
<div class="sobre-principal">
	<div class="container">
		<div class="row">
		
		<?php 
				$args = array('post_type'=>'page', 'pagename'=>'sobre');
				$my_sobre = get_posts( $args );
				if($my_sobre) : foreach($my_sobre as $post) : setup_postdata( $post );
			 ?>
			 	

				<div class="col-md-6 col-lg-6">
					<h2 class="sobremim-txt-inicial"><a class="link-sobremim-inicial" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<h4 class="sobremim-resumo-txt-inicial"><?php the_excerpt(); ?></h4>
				</div>

				<?php
		    	endforeach;
		    	endif;
	     		?>

				<div class="col-md-6 col-lg-6">

				<?php 
				$args = array('post_type'=>'page', 'pagename'=>'contato');
				$my_contato = get_posts( $args );
				if($my_contato) : foreach($my_contato as $post) : setup_postdata( $post );
				?>

				<center><?php the_post_thumbnail(false, array('class'=>'img-responsive')); ?></center>

				<?php
		    	endforeach;
		    	endif;
	     		?>

					

				</div>

			 

		</div>	
	</div>
</div>
<!-- SOBRE -->


<!-- PORTFOLIO -->

<div class="portfolio">
	
	<div class="container">
		<h2 class="titulo-portfolio">Portfólio</h2>
		
		<div class="row">

			<?php 
				$args = array('post_type'=>'post', 'category_name'=>'portfa', 'showposts'=>4);
				$my_posts = get_posts( $args );
				if($my_posts) : foreach($my_posts as $post) : setup_postdata( $post );
			 ?>

			 <div class="col-md-8 partedaimagem">
			 	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(false, array('class'=>"thumb-principal")); ?></a>
			 </div>

			 <div class="col-md-4 partedotexto">
			 	<h3 class="texto-portfolio-principal"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<h4 class="texto-da-descricao"><?php the_excerpt(); ?></h4>
					<a href="<?php the_permalink(); ?>"><button class="btn-da-desc-principal">LEIA +</button></a>
			 </div>


			 <?php
		    	endforeach;
		    	endif;
	     	?>
			<div class="clear"></div>
			<div class="link"><a class="mais-projetos" href="portfolio">+ projetos</a></div>

		</div>

	</div>

</div>

<!-- PORTFOLIO -->


<!-- BLOG -->

<div class="blog">
	
	<div class="container">
		
		<h2 class="titulo-blog">Blog</h2>
		
		<div class="row">

			<?php 
				$args = array('post_type'=>'post', 'category_name'=>'doblog', 'showposts'=>3);
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
			<div class="clear"></div>
			<div class="link-blog"><a class="mais-projetos-blog" href="blog">+ posts</a></div>

		</div>

	</div>

</div>

<!-- BLOG -->


<?php get_footer(); ?>