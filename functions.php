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
  MIOLO DE PAO
*-----------------------------------------------------------------------------*/

function wp_custom_breadcrumbs() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '&raquo;'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = get_bloginfo('url');
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
 
  } else {
 
    echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'categoria "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} // end wp_custom_breadcrumbs()


/*-----------------------------------------------------------------------------*
  Novos campos de contato
*-----------------------------------------------------------------------------*/

if ( ! function_exists('tutsup_new_contact_fields') ) {

    function tutsup_new_contact_fields( $contact_fields ) {
        // LinkedIn
        $contact_fields['linkedin'] = 'LinkedIn';
        
        // GitHub
        $contact_fields['github'] = 'GitHub';
        
        // Lattes
        $contact_fields['lattes'] = 'Lattes';

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
                        
                        <?php if ( get_the_author_meta( 'linkedin', $author_id ) ): ?>
                            <a class="tp-author-social-link" href="<?php 
                                echo get_the_author_meta( 'linkedin', $author_id ); 
                            ?>">LinkedIn</a>  
                        <?php endif;?>
                        
                        <?php if ( get_the_author_meta( 'github', $author_id ) ): ?>
                            <a class="tp-author-social-link" href="<?php 
                                echo get_the_author_meta( 'github', $author_id ); 
                            ?>?rel=author" rel="author">GitHub</a> 
                        <?php endif;?>
                        
                        <?php if ( get_the_author_meta( 'lattes', $author_id ) ): ?>
                            <a class="tp-author-social-link" href="<?php 
                                echo get_the_author_meta( 'lattes', $author_id  ); 
                            ?>">Lattes</a>
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