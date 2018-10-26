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

					<div class="autor">Informações do Autor</div>

					<div class="maisvistos">Mais vistos

						<?php if (function_exists('get_most_viewed')): ?>
            			<?php get_most_viewed('post',5); ?> 
          				<?php endif; ?>

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