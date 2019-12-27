<?php




/***** ADD SESSION ******/
add_action('init', 'hr_start_session', 1);
function hr_start_session() {
	if(!session_id()) {
		session_start();
	}
}
/**** REMOVE EMOJI *****/
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**** REMOVE CORE UPDATE *****/
add_action('after_setup_theme','hr_remove_core_updates');
function hr_remove_core_updates(){
    add_theme_support( 'title-tag' );
  if(! current_user_can('update_core')){return;}
  	//add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
 	add_filter('pre_option_update_core','__return_null');
  	add_filter('pre_site_transient_update_core','__return_null');
}
	
/**** REMOVE ADMIN BAR *****/	 
//add_action('after_setup_theme', 'hr_remove_admin_bar');
function hr_remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}
		
/**** BLOCK USER ACESS ADMIN  *****/
//add_action( 'init', 'hr_blockusers_init' );
function hr_blockusers_init() {
	if ( is_admin() && ! current_user_can( 'administrator' ) &&
	! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) && is_user_logged_in() ) {
		wp_redirect( home_url() );
		exit;
	}
}

/***** ADD SCRIPT FRONTEND ******/
add_action('wp_enqueue_scripts', 'hr_frontend_script');
function hr_frontend_script(){
    $date = date('l jS \of F Y h:i:s A');

	wp_enqueue_script('labory-js', THEME_URI.'/js/labory.js',array('jquery'),'');	
	wp_enqueue_script('bootstrap-js', THEME_URI.'/js/bootstrap.min.js',array('jquery'),'');	
	wp_enqueue_style('bootstrap-css', THEME_URI.'/css/bootstrap.min.css');
    wp_enqueue_style('slick',THEME_URI.'/css/slick.css');
    wp_enqueue_style('slick-theme',THEME_URI.'/css/slick-theme.css');
    wp_enqueue_style('slick-lightbox',THEME_URI.'/css/slick-lightbox.css');
    wp_enqueue_style('font-awesome',get_template_directory_uri().'/css/fontawesome-all.min.css');
	wp_enqueue_script('frontend-js', THEME_URI.'/js/frontend.js',array('jquery'),'', true);
    wp_enqueue_script('slick-lightbox', THEME_URI.'/js/slick-lightbox.js',array('jquery'),'', true);
    wp_enqueue_script( 'slick', THEME_URI. '/js/slick.min.js', '','' , true);
	wp_localize_script('frontend-js', 'hr', array('p_url' => THEME_URI,'a_url'=>AJAX_URI));
	wp_enqueue_style('frontend-css', THEME_URI.'/css/frontend.css');
    wp_enqueue_style('style', THEME_URI.'/style.css');
    wp_enqueue_style('main', THEME_URI.'/css/main.css');
    //add css single page
    wp_enqueue_style('singlepage-css', THEME_URI.'/css/singlepage.css');

    wp_enqueue_style('style.new-css', THEME_URI.'/css/style.new.css?'.$date);

    //add css home page
    wp_enqueue_style('homepage-css', THEME_URI.'/css/homepage.css');


}

/***** ADD SCRIPT BACKEND ******/
add_action('admin_enqueue_scripts', 'hr_admin_script');
function hr_admin_script() {
	wp_enqueue_style('backendcss', THEME_URI.'/css/backend.css');
    wp_localize_script('mainjs', 'hr', array('p_url' => THEME_URI,'a_url'=>AJAX_URI));
	wp_enqueue_script('backendjs', THEME_URI.'/js/backend.js',array(),'', true);
	wp_localize_script('backendjs', 'hr', array('p_url' => THEME_URI,'a_url'=>AJAX_URI));
}
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page('Theme Options');
}
register_nav_menus( array(
    'social_menu' => 'Social Links Menu',
    'main-menu' => 'Main Menu'
) );
function acf_render($before,$after,$content=''){
    return ($content)?$before.$content.$after:'';
}

remove_post_type_support('page', 'editor');

/*breadcumb*/
function breadcrumbs() {
    if(!is_home()) {
        echo '
        <div class="breadcrumb"><ul>
            <li class="breadcrumb-item"> 
            <a href="'.home_url('/').'">';
                if(get_bloginfo( 'language' )=='vi-VN'){echo 'Trang Chủ'; }else{ echo 'Home';}
        echo '</a>
            </li>';
        if(is_category()) {
            $category = get_term_by('id', get_query_var('cat'), 'category');
            echo '<li class="breadcrumb-item" aria-current="page">'.$category->name.'</li>';
        }
        elseif (is_page()) {
            echo '<li class="breadcrumb-item" aria-current="page">'.get_the_title().'</li>';
        }
    }
    echo '</ul></div>';
}
add_shortcode( 'breadcrumbs', 'breadcrumbs' );

/*banner page*/
function banner_page(){?>
    <div class="banner-page" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>);">
        <div class="container">
            <div class="title-page">
                <?php
                $title = '';
                if(is_category()) {
                    $category = get_term_by('id', get_query_var('cat'), 'category');
                    $title = $category->name;
                }
                else {
                    $title = get_the_title();
                }
                ?>
                <h1><?php echo $title; ?></h1>
            </div>
            <?php do_shortcode('[breadcrumbs]');?>
        </div>
    </div>
<?php }
add_action( 'banner_page_f', 'banner_page' );

// add_action( 'pre_get_posts', 'set_limit_posts' );
function set_limit_posts( $query ) {
    if($query->is_main_query()) {
        $query->set('posts_per_page', '1');
    }
}
?>