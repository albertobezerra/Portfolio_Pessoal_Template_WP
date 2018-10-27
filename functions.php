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


