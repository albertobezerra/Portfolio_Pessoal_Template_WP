<?php get_header(); ?>

<div class="page-post">
	<div class="container">
		<div class="row">


			
				
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<div class="col-12 col-md-8">

					<div class="loc-img"><?php the_post_thumbnail(false, array('class'=>"thumb-principal")); ?></div>

					<div class="titulo-do-post"><h3><?php the_title(); ?></h3></div>	

						<?php the_content(); ?>

						<?php endwhile; endif; ?>

				</div>

				<div class="col-6 col-md-4">

					<div class="autor">

						<?php tutsup_author_area();?>


					</div>

					<div class="maisvistos">

						<p class="mais-visto-chamada">Post's Mais vistos</p>

						<?php
							$nova_consulta = new WP_Query( 
							    array(
							        'posts_per_page'      => 5,                 // Máximo de 5 artigos
							        'no_found_rows'       => true,              // Não conta linhas
							        'post_status'         => 'publish',         // Somente posts publicados
							        'ignore_sticky_posts' => true,              // Ignora posts fixos
							        'orderby'             => 'meta_value_num',  // Ordena pelo valor da post meta
							        'meta_key'            => 'tp_post_counter', // A nossa post meta
							        'order'               => 'DESC'             // Ordem decrescente
							    )
							);
						?>

						<?php if ( $nova_consulta->have_posts() ): ?>
       					<?php while ( $nova_consulta->have_posts() ): ?>
        
			            <?php $nova_consulta->the_post(); ?>
			            <?php $tp_post_counter = get_post_meta( $post->ID, 'tp_post_counter', true );?>
            
            			<div class="mais-visto clearfix">
                
			                <?php if( has_post_thumbnail() ): ?>
			                    <div class="mais-visto-thumbnail">
			                        <a href="<?php the_permalink(); ?>">
			                            <?php the_post_thumbnail('mais-visto-thumbnail'); ?>
			                        </a>
			                    </div> <!-- .mais-visto-thumbnail -->
			                <?php endif; // has_post_thumbnail ?>
	                
			                <h4 class="mais-visto-titulo">
			                    <a href="<?php the_permalink(); ?>">
			                        <?php the_title();?>
			                    </a>
			                </h4><br> <!-- .mais-visto-titulo -->
            
           				</div> <!-- .mais-visto -->
            
				        	<?php endwhile; ?>
					   	 <?php endif; // have_posts ?>

				    	<?php wp_reset_postdata(); ?>

					</div>

					<div class="ultimaspublicacoes">Últimas publicações



					

					</div>

					<div class="publicidade">Publicidade
						
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<ins class="adsbygoogle"
							     style="display:block"
							     data-ad-format="fluid"
							     data-ad-layout-key="-73+ed+2i-1n-4w"
							     data-ad-client="ca-pub-7979689703488774"
							     data-ad-slot="5425200500"></ins>
							<script>
							     (adsbygoogle = window.adsbygoogle || []).push({});
						</script>

						<img src="<?php bloginfo('template_directory'); ?>/assets/images/01.jpg">


						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<!-- Publii Lateral -->
							<ins class="adsbygoogle"
							     style="display:block"
							     data-ad-client="ca-pub-7979689703488774"
							     data-ad-slot="5146068713"
							     data-ad-format="auto"
							     data-full-width-responsive="true"></ins>
							<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
						</script>

					</div>



				</div>		
		
				
	
		</div>
		
	</div>

</div>




<?php get_footer(); ?>