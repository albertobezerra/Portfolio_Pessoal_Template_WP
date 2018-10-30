<?php get_header(); ?>

<div class="page-post">
	<div class="container">
		<div class="row">

				<div class="miolodepao"><?php wp_custom_breadcrumbs(); ?></div>
				
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<div class="col-12 col-md-8">

					<div class="loc-img"><?php the_post_thumbnail(false, array('class'=>"thumb-principal")); ?></div>
					
					<div class="titulo-do-post"><h3><?php the_title(); ?></h3></div>	

						<?php the_content(); ?>

						<?php endwhile; endif; ?>

						<div class="post-pag-wrap">

							<div class="post-pag-container prev">
								<?php previous_post_link('
									<span>Post anterior</span>
									<h3>%link</h3>
									', '%title', false);
								?>
							</div>

							<div class="post-pag-container next">
								<?php next_post_link('
									<span>Próximo post</span>
									<h3>%link</h3>
									', '%title', false);
								?>
							</div>

						</div>
					


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

					<div class="publicidade">

						<div class="publicidade-chamada">Publicidade</div>
						
						<div class="espaco-publicidade">
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
						</div>

					</div>



				</div>		
		
				
	
		</div>
		
	</div>

</div>




<?php get_footer(); ?>