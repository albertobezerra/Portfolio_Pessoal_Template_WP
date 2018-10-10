<?php get_header(); ?>


<div class="page-contato">
	
	<div class="container">
		<h2 class="titulo-contato-page">CONTATO</h2>

			<?php 
				$args = array('post_type'=>'page', 'pagename'=>'contato');
				$my_contato = get_posts( $args );
				if($my_contato) : foreach($my_contato as $post) : setup_postdata( $post );
			 ?>
				<h4 class="texto_contato"><?php the_excerpt(); ?></h4>

				<?php
		    	endforeach;
		    	endif;
	     	?>
		
		<div class="row">

			<?php 
				$args = array('post_type'=>'page', 'pagename'=>'contato');
				$my_contato = get_posts( $args );
				if($my_contato) : foreach($my_contato as $post) : setup_postdata( $post );
			 ?>
			 	

				<div class="col-md-6 col-lg-6 ">

					<div class="formulario_contato">

					<?php echo FrmFormsController::get_form_shortcode(array('id' => 3, 'key' => '', 'title' => false, 'description' => false, 'readonly' => false, 'entry_id' => false)); ?>
						
					</div>
					
				</div>
				
				<div class="col-md-6 col-lg-6">
					<center><?php the_post_thumbnail(false, array('class'=>'img-responsive')); ?></center>
				</div>

			 <?php
		    	endforeach;
		    	endif;
	     	?>

		</div>

	</div>

</div>


<?php get_footer(); ?>