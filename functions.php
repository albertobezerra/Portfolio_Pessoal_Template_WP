<?php 

/**************************************
 *  THEME SUPORT
 **************************************/
function add_suport_theme(){
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'arte-thumbnail', 250, 150, true );
}
add_action('after_setup_theme','add_suport_theme');

/**************************************
 * Registro Menu Personalizado
 **************************************/
add_theme_support('menus');
register_nav_menus( array(
	'primary' => __( 'MENU HEADER', 'menu-header' ),
) );


/**************************************
 * Delimita o tamanho do resumo (excerpt)
 **************************************/

function novo_tamanho_do_resumo($length) {
  return 25;
}
add_filter('excerpt_length', 'novo_tamanho_do_resumo');


/**************************************
 *  SCRIPTS / CSS
 **************************************/
function wp_responsivo_scripts() {
  // Carregando CSS header
  wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
  wp_enqueue_style( 'style', get_stylesheet_uri() );
  
  // Carregando Scripts header
  wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery') );

  //Carregando no footer
  //wp_enqueue_script('functions-js', get_template_directory_uri().'/assets/js/functions.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'wp_responsivo_scripts' );



/*-----------------------------------------------------------------------------*
  Novos campos de contato
*-----------------------------------------------------------------------------*/

if ( ! function_exists('tutsup_new_contact_fields') ) {

    function tutsup_new_contact_fields( $contact_fields ) {
        // Twitter
        $contact_fields['twitter'] = 'Twitter';
        
        // Facebbok
        $contact_fields['facebook'] = 'Facebook';
        
        // Google+
        $contact_fields['googleplus'] = 'Google+';

        return $contact_fields;
    } // tutsup_new_contact_fields
    
    add_filter('user_contactmethods', 'tutsup_new_contact_fields', 10, 1);
    
} // function_exists


/* POSTS MAIS VISTOS */


// Verifica se não existe nenhuma função com o nome tutsup_session_start
if ( ! function_exists( 'tutsup_session_start' ) ) {
    // Cria a função
    function tutsup_session_start() {
        // Inicia uma sessão PHP
        if ( ! session_id() ) session_start();
    }
    // Executa a ação
    add_action( 'init', 'tutsup_session_start' );
}



// Verifica se não existe nenhuma função com o nome tp_count_post_views
if ( ! function_exists( 'tp_count_post_views' ) ) {
    // Conta os views do post
    function tp_count_post_views () {   
        // Garante que vamos tratar apenas de posts
        if ( is_single() ) {
        
            // Precisamos da variável $post global para obter o ID do post
            global $post;
            
            // Se a sessão daquele posts não estiver vazia
            if ( empty( $_SESSION[ 'tp_post_counter_' . $post->ID ] ) ) {
                
                // Cria a sessão do posts
                $_SESSION[ 'tp_post_counter_' . $post->ID ] = true;
            
                // Cria ou obtém o valor da chave para contarmos
                $key = 'tp_post_counter';
                $key_value = get_post_meta( $post->ID, $key, true );
                
                // Se a chave estiver vazia, valor será 1
                if ( empty( $key_value ) ) { // Verifica o valor
                    $key_value = 1;
                    update_post_meta( $post->ID, $key, $key_value );
                } else {
                    // Caso contrário, o valor atual + 1
                    $key_value += 1;
                    update_post_meta( $post->ID, $key, $key_value );
                } // Verifica o valor
                
            } // Checa a sessão
            
        } // is_single
        
        return;
        
    }
    add_action( 'get_header', 'tp_count_post_views' );
}

/* function configura_tamanho_imagens() {      
    add_image_size( 'mais-visto-thumbnail', 150, 150, true );
}
add_action( 'after_setup_theme', 'configura_tamanho_imagens' ); */



/* PAGINAÇÃO WORDPRESS */
function wordpress_pagination() {
            global $wp_query;
 
            $big = 999999999;
 
            echo paginate_links( array(
                  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                  'format' => '?paged=%#%',
                  'current' => max( 1, get_query_var('paged') ),
                  'total' => $wp_query->max_num_pages
            ) );
      }

?>

<?php




/*-----------------------------------------------------------------------------*
  Área do autor
*-----------------------------------------------------------------------------*/

if ( ! function_exists('tutsup_author_area') ) {

    function tutsup_author_area() {
        
        // Apenas apresentaremos a área do autor em posts na íntegra
        if ( is_single() ):
            $author_id = get_the_author_meta( 'ID' );
?>
            
            <!-- Área do autor -->
            <div class="tp-author-area clearfix">
            
                <!-- Conteúdo interno da área do autor -->
                <div class="tp-inner-author-area">
                    
                    <!-- Gravatar -->
                    <div class="tp-author-gravatar">
                    
                        <a class="tp-author-link" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
                            <?php echo get_avatar( get_the_author_meta( 'user_email' ), 150 ); ?>
                        </a>
                    
                    </div> <!-- tp-author-gravatar -->
                    
                    <!-- Texto sobre o autor -->
                    <p class="tp-about-autor-text">
                        <?php _e('Sobre o autor', 'tutsup'); ?>
                    </p>
                    
                    <!-- Nome e link do autor -->
                    <h3 class="tp-about-autor-heading">
                        
                            <?php echo get_the_author(); ?>
                        
                    </h3>
                    
                    <!-- Descrição do autor -->
                    <div class="tp-author-info">
                    
                        <?php the_author_meta( 'description' ); ?>
                        
                        <!-- Links sociais -->
                        <p class="tp-social-links clearfix">  
                        
                        <?php if ( get_the_author_meta( 'facebook', $author_id ) ): ?>
                            <a class="tp-author-social-link" href="<?php 
                                echo get_the_author_meta( 'facebook', $author_id ); 
                            ?>">Facebook</a>  
                        <?php endif;?>
                        
                        <?php if ( get_the_author_meta( 'googleplus', $author_id ) ): ?>
                            <a class="tp-author-social-link" href="<?php 
                                echo get_the_author_meta( 'googleplus', $author_id ); 
                            ?>?rel=author" rel="author">Google+</a> 
                        <?php endif;?>
                        
                        <?php if ( get_the_author_meta( 'twitter', $author_id ) ): ?>
                            <a class="tp-author-social-link" href="<?php 
                                echo get_the_author_meta( 'twitter', $author_id  ); 
                            ?>">Twitter</a>
                        <?php endif;?>
                    
                        </p>
                        
                    </div> <!-- tp-author-info -->
                    
                </div> <!-- tp-inner-author-area -->
            </div> <!-- tp-author-area -->
        
        <?php endif; // is_single() ?>
<?php
    } // tutsup_author_area
} // function_exists
?>


