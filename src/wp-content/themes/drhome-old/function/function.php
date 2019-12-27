<?php
	$upload_folder= wp_upload_dir();
	define('THEME_URI', get_template_directory_uri());
	define('AJAX_URI', admin_url('admin-ajax.php'));
	define('UPLOAD_URI', $upload_folder['baseurl']);
	define('UPLOAD_DIR', $upload_folder['basedir']);
	define('MYID',get_current_user_id());
	
	add_theme_support( 'post-thumbnails' );
	
	require get_template_directory() . '/function/filters.php';
	require get_template_directory() . '/function/actions.php';
	require get_template_directory() . '/function/ajaxs.php';
	require get_template_directory() . '/function/shortcodes.php';
	require get_template_directory() . '/function/cropt.php';
	/*------------------all function here------------*/
	function hr_cropt($media_id,$w,$h){
		if(is_numeric($w) and is_numeric($h)){
			$url = wp_get_attachment_url($media_id);
			$ext = substr(strrchr($url, '/'),1);
			$cropt=UPLOAD_URI.'/cropt/';
			if($url=="") return $url;
			if(file_exists($cropt.$media_id."_".$w."x".$h."_".$ext)){	
				$url=$cropt.$media_id."_".$w."x".$h."_".$ext;
			}
			else{
				$resizeObj = new resize($url);
				$resizeObj -> resizeImage($w,$h, "crop");
				$resizeObj -> saveImage(UPLOAD_DIR.'/cropt/'.$media_id."_".$w."x".$h."_".$ext, 100);
				$url=$cropt.$media_id."_".$w."x".$h."_".$ext;
			}
			return $url;
		}
		return "";
	}

function thenatives_upload_media ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'thenatives_upload_media');
	
function nt_create_post_type($args) {
    if(!is_array($args) || !$args['post_type'] || !$args['name'] || !$args['single'] || !$args['slug']) return;
    $post_type = $args['post_type'];
    $name = $args['name'];
    $single = $args['single'];
    $slug = $args['slug'];

    register_post_type($post_type, array(
        'labels' => array(
            'name' => __($name),
            'singular_name' => __($single),
            'add_new' => __('Add New '.$single),
            'add_new_item' => __('Add New '.$single),
            'edit_item' => __('Edit '.$single),
            'new_item' => __('New '.$single),
            'all_items' => __('All '.$name),
            'view_item' => __('View '.$single),
            'search_items' => __('Search '.$name),
            'not_found' => __('Not Found '.$single),
            'not_found_in_trash' => __('Not Found '.$single.' In Trash'),
            'parent_item_colon' => '',
            'menu_name' => __($name)
        ),
        'public' => true,
        'menu_icon' => 'dashicons-star-filled',
        'exclude_from_search' => false,
        'menu_position' => 6,
        'has_archive' => true,
        'taxonomies' => array($post_type),
        'rewrite' => array('slug' => $slug),
        'supports' => array('title', 'editor', 'excerpt', 'revisions', 'thumbnail', 'author')
    ));
}
function nt_create_taxonomy($args) {
    if(!is_array($args) || !$args['post_type'] || !$args['name'] || !$args['single'] || !$args['taxonomy'] || !$args['slug']) return;
    $post_type = $args['post_type'];
    $name = $args['name'];
    $single = $args['single'];
    $slug = $args['slug'];
    $taxonomy = $args['taxonomy'];
    $labels = array(
        'name' => __($name),
        'singular_name' => __($single),
        'search_items' => __('Search '.$name),
        'popular_items' => __('Popular '.$name),
        'all_items' => __('All '.$name),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit '.$single),
        'update_item' => __('Update '.$single),
        'add_new_item' => __('Add '.$single),
        'new_item_name' => __('New '.$single),
        'menu_name' => __($name),
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => $slug),
    );
    register_taxonomy($taxonomy, $post_type, $args);
}

function nt_posts_count($args, $all = true) {
    global $wpdb;
    if($all === true) {
        $args['posts_per_page'] = -1;
    }
    $args['count'] = 1;
    $the_query = new WP_Query( $args );
    $sql = "SELECT count(*) as count from (".str_replace("SQL_CALC_FOUND_ROWS ",'',$the_query->request).") as sub";
    $row = $wpdb->get_row( $sql );
    if($row){
        return $row->count;
    }
    return 0;
}

function nt_page_link($page = 1, $link='') {
    if(!$link) return;
    $newLink = '';
    $subLink = '';
    $pos =  strpos($link,'page');
    $pos = ($pos!==false)?$pos:strpos($link,'paged');
    if($pos!==false){
        $newLink = substr($link,0,$pos-1);
    }
    $newLink = $newLink?$newLink:$link;

    $page = is_numeric($page)?$page:1;

    $pos =  strpos($link,'/?');
    if($pos!==false){
        $newLink = substr($newLink,0,$pos);
        $subLink = substr($link,$pos);
    }
    if($page > 1 && is_archive()){
        $newLink .='/?page='.$page;
    }
    elseif($page > 1) {
        $newLink .='/page/'.$page;
    }
    $newLink .= $subLink;
    return $newLink;
}

function nt_pagination($args,$params = array(),$page='') {
    if(!$page) {
        global $wp;
        $current_url = home_url(add_query_arg(array(),$wp->request));
    }
    else {
        $current_url = $page;
    }
    $number = $args['posts_per_page'];
    $args['posts_per_page'] = -1;
    $all = nt_posts_count($args);
    if($all) {
        $percent = $all % $number;
        $number_p = ($percent)?(($all-$percent)/$number + 1):($all/$number);
        if($number_p>1){
            $display = wp_is_mobile()?3:5;
            if($display%2==0) {
                $display -= 1;
            }
            $paged = (isset($args['paged']) && $args['paged']>1)?$args['paged']:1;
            $data = ' data-link='.$current_url;
            if(is_array($params) && count($params)) {
                foreach ($params as $key=>$param){
                    $data.= ' data-'.$key.'="'.$param.'"';
                }
            }
            $number_plus = floor($display/2);
            ?>
            <ul class="thenativePagination">
                <?php 
                    $url = nt_page_link( 1,$current_url ); 
                    $prev = $paged>1?$paged-1:1; 
                    $url = nt_page_link( $prev,$current_url );
                ?>
                <?php
                    if($paged > 1):
                        ?>
                        <li class="thenativePaginationPrev>
                            <a <?php echo $data; ?> data-page="<?php echo $prev; ?>" href="<?php echo $url; ?>"><<</a>
                        </li>
                        <?php
                    endif;
                ?>
                

                <?php 
                if($number_p < $display): 
                    for($i=1; $i<=$number_p;$i++):
                        $url = nt_page_link( $i,$current_url ); ?>
                        <li <?php echo ($i==$paged)?' class="active"':''; ?>><a <?php echo $data; ?> data-page="<?php echo $i ?>" href="<?php echo $url; ?>"><span><?php echo $i ?></span></a></li>
                        <?php 
                    endfor; 
                elseif($paged > $number_p - $number_plus) :
                    for($i=$number_p-$display+1; $i<=$number_p;$i++): ?>
                        <?php $url = ($i==$paged)?'javascript:void(0)':nt_page_link( $i,$current_url ); ?>
                        <li <?php echo ($i==$paged)?' class="active"':''; ?>><a <?php echo $data; ?> data-page="<?php echo $i ?>" href="<?php echo $url; ?>"><span><?php echo $i ?></span></a></li>
                        <?php 
                    endfor; 
                else: 
                    if($paged <= $number_plus): 
                        for($i=1; $i<=$display;$i++): ?>
                            <?php $url = ($i==$paged)?'javascript:void(0)':nt_page_link( $i,$current_url ); ?>
                            <li <?php echo ($i==$paged)?' class="active"':''; ?>><a <?php echo $data; ?> data-page="<?php echo $i ?>" href="<?php echo $url; ?>"><span><?php echo $i ?></span></a></li>
                            <?php 
                        endfor; 
                    else: 
                        for($i=$paged-$number_plus; $i<$paged;$i++): 
                            $url = nt_page_link( $i,$current_url ); 
                                ?>
                            <li><a <?php echo $data; ?> data-page="<?php echo $i ?>" href="<?php echo $url; ?>"><span><?php echo $i ?></span></a></li>
                        <?php endfor; ?>

                        <li class="active"><a <?php echo $data; ?> data-page="<?php echo $paged ?>" href="javascript:void(0)"><span><?php echo $i ?></span></a></li>

                        <?php for($i=$paged+1; $i<=$paged+$number_plus;$i++):
                            $url = nt_page_link( $i,$current_url ); ?>
                            <li><a <?php echo $data; ?> data-page="<?php echo $i ?>" href="<?php echo $url; ?>"><span><?php echo $i ?></span></a></li>
                        <?php endfor; 
                    endif; 
                endif; 
                $next = $paged < $number_p?$paged+1:$number_p; 
                $url = nt_page_link( $next,$current_url ); 
                ?>
                <?php if($paged < $next): ?>
                    <li class="thenativePaginationNext">
                        <a <?php echo $data; ?> data-page="<?php echo $next; ?>" href="<?php echo $url; ?>">>></a>
                    </li>
                <?php endif; ?>
            </ul>
            <?php
        }
    }
}

/*--- Create Post-type --social-network-*/
function create_new_custom_post_type(){

    $args = array(
        "post_type" => 'dich-vu',
        "name" => "Dịch vụ",
        "single" => "Dịch vụ",
        "slug" => "dich-vu",
    );
    nt_create_post_type($args);

    $args = array(
        "post_type" => 'social-network',
        "name" => "Social Network",
        "single" => "Social Network",
        "slug" => "social-network",
    );
    nt_create_post_type($args);

    $args = array(
        "post_type" => array('dich-vu'),
        "name" => "Danh mục dịch vụ",
        "single" => "Danh mục dịch vụ",
        "slug" => "danh-muc-dich-vu",
        "taxonomy" => "danh-muc-dich-vu",
    );
    nt_create_taxonomy($args);

    // $args = array(
    //     "post_type" => 'du-an-hoan-thanh',
    //     "name" => "Dự án hoàn thành",
    //     "single" => "Dự án hoàn thành",
    //     "slug" => "du-an-hoan-thanh",
    // );
    // nt_create_post_type($args);

    // $args = array(
    //     "post_type" => array('du-an-hoan-thanh'),
    //     "name" => "Danh mục dự án hoàn thành",
    //     "single" => "Danh mục dự án hoàn thành",
    //     "slug" => "danh-muc-du-an-hoan-thanh",
    //     "taxonomy" => "danh-muc-du-an-hoan-thanh",
    // );
    // nt_create_taxonomy($args);

    // $args = array(
    //     "post_type" => 'cong-trinh-thuc-te',
    //     "name" => "Công trình thực tế",
    //     "single" => "Công trình thực tế",
    //     "slug" => "cong-trinh-thuc-te",
    // );
    // nt_create_post_type($args);

    // $args = array(
    //     "post_type" => array('cong-trinh-thuc-te'),
    //     "name" => "Danh mục công trình thực tế",
    //     "single" => "Danh mục công trình thực tế",
    //     "slug" => "danh-muc-cong-trinh-thuc-te",
    //     "taxonomy" => "danh-muc-cong-trinh-thuc-te",
    // );
    // nt_create_taxonomy($args);


    //add new post type Cong Trinh 29/10/2019-------------fix frome custmer-----------------//
    $args = array(
        "post_type" => 'cong_trinh',
        "name" => "Công Trình",
        "single" => "Công Trình",
        "slug" => "cong_trinh",
    );
    nt_create_post_type($args);
        //taxaonomy Danh muc cong trinh
    $args = array(
        "post_type" => array('cong_trinh'),
        "name" => "Danh mục công trình",
        "single" => "Danh mục công trình",
        "slug" => "danh-muc-cong-trinh",
        "taxonomy" => "danh-muc-cong-trinh",
    );
    nt_create_taxonomy($args);
}
add_action('init', 'create_new_custom_post_type');




//ENG and VN
function language_selector_flags(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    // var_dump($languages);
    if(!empty($languages)){
        echo'<div class="dropdown-pane" data-position="top" data-alignment="center" id="lang-dropdown" data-dropdown data-hover="true" data-hover-pane="true"><ul class="clear-ENG-VN clear_mobile">';
        foreach($languages as $l){
            echo '<li>';
                if(!$l['active']) echo '<a class="notactive_lang" href="'.$l['url'].'">';
                echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
                if(!$l['active']) echo '</a>';
            echo '</li>';
        }
        echo'</ul></div>';
    }
 }
//
 function arrs_all_cat($tax){
    $term_args = array(
        'taxonomy' => $tax,
        'hide_empty' => false,
        'orderby ' => 'id',
    );
    global $sitepress;

    $original_lang = ICL_LANGUAGE_CODE;
    $new_lang = $original_lang;
    $sitepress->switch_lang($new_lang);

    $terms = get_terms( $term_args );
    return $terms;
}
function paging($baseUrl, $showItem, $totalPages, $currentPage, $limit, $role) {
    if ($totalPages <= 1) {
        return null;
    }
    $numberDecrement = 0;
    if ($showItem % 2 === 0) {
        $numberDecrement = 1;
    }
    if (floor($showItem / 2) >= $currentPage) {
        $startIndex = 1;
        $limitIndex = $showItem > $totalPages ? $totalPages : $showItem;
    } else if ($currentPage + floor($showItem / 2) > $totalPages ) {
        $startIndex = $totalPages - $showItem < 0 ? 1 : $totalPages - $showItem + 1;
        $limitIndex = $totalPages;
    } else {
        $startIndex = $currentPage - floor($showItem / 2) < 1 ? 1 : $currentPage - floor($showItem / 2) + $numberDecrement;
        $limitIndex = $currentPage + floor($showItem / 2) > $totalPages ? $totalPages : $currentPage + floor($showItem / 2);
    }
    ?>
    <div class="paging">
        <ul>
            <?php  if($currentPage > 1): $preIndex = $currentPage - 1; ?>
                <li>
                    <a data-role="<?php echo $role;?>" data-limit="<?php echo $limit; ?>" data-paging="<?php echo $preIndex; ?>" class="load_paging" href="javascript:void(0)"><<</a>
                </li>
            <?php endif; ?>
            <?php for ($index = $startIndex; $index <= $limitIndex; $index++) {
                $url = $baseUrl.'?page='.$index;
                $classActive = '';
                if ($index == $currentPage) {
                    $classActive = 'active';
                }
                ?>
                <li page="<?php echo $index; ?>" class="<?php echo $classActive ?>">
                    <a data-role="<?php echo $role;?>" data-limit="<?php echo $limit; ?>" data-paging="<?php echo $index; ?>" class="load_paging"  href="javascript:void(0)"><?php echo $index; ?></a>
                </li>
            <?php } ?>
            <?php if($currentPage < $limitIndex): $nextIndex = $currentPage + 1; ?>
                <li><a data-role="<?php echo $role;?>" data-limit="<?php echo $limit; ?>" data-paging="<?php echo $nextIndex; ?>" class="load_paging" href="javascript:void(0)">>></a></li>
            <?php endif; ?>
        </ul>
    </div>
    <?php
}
function get_num_page($total,$num){
    $percent = $total % $num;
    return ($percent)?(($total-$percent)/$num + 1):($total/$num);
}

/*** get current text **/
function getTextLang($vi,$en){
	return (get_locale()<>"en_US")?$vi:$en;
}
/*** get_breadcrumb ***/
function hr_get_breadcrumb ( $list_style = 'ol', $list_id = 'breadcrumb', $list_class = 'breadcrumb', $active_class = 'active', $echo = false ) {
	// Get text domain for translations
	$theme = wp_get_theme();
	$text_domain =  $theme->get( 'nha-khoa-2000' );

	// Open list
	$breadcrumb = '<' . $list_style . ' id="' . $list_id . '" class="' . $list_class . '" z-index:9999; bottom:100px">';
	// Front page
	if ( is_front_page() ) {
		$breadcrumb .= '<li class="' . $active_class . '">' .getTextLang('Trang chủ','Home'). '</li>';
	} else {
		$breadcrumb .= '<li><a href="' . home_url() . '">' . getTextLang('Trang chủ','Home') . '</a></li>';
	}
	
	// Blog archive
	if ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) ) {
		$blog_page_id = get_option( 'page_for_posts' );
		if ( is_home() ) {
			$breadcrumb .= '<li class="' . $active_class . '">' . get_the_title( $blog_page_id )  . '</li>';
		} else if ( is_category() || is_tag() || is_author() || is_date() || is_singular( 'post' ) ) {
			$breadcrumb .= '<li><a href="' . get_permalink( $blog_page_id ) . '">' . get_the_title( $blog_page_id )  . '</a></li>';
		}
	}
	
	// Category, tag, author and date archives
	if ( is_archive() && ! is_tax() && ! is_post_type_archive() ) {
		$breadcrumb .= '<li><a href="' . home_url(getTextLang('kien-thuc', 'news')) . '">' . getTextLang('Kiến Thức', 'News') . '</a></li>';
		$breadcrumb .= '<li class="' . $active_class . '">';
		
		// Title of archive
		if ( is_category() ) {
			$breadcrumb .= single_cat_title( '', false );
		} else if ( is_tag() ) {
			$breadcrumb .= single_tag_title( '', false );
		} else if ( is_author() ) {
			$breadcrumb .= get_the_author();
		} else if ( is_date() ) {
			if ( is_day() ) {
				$breadcrumb .= get_the_time( 'F j, Y' );
			} else if ( is_month() ) {
				$breadcrumb .= get_the_time( 'F, Y' );
			} else if ( is_year() ) {
				$breadcrumb .= get_the_time( 'Y' );
			}
		}
		$breadcrumb .= '</li>';

		
	}
	
	// Posts
	if ( is_singular( 'post' ) ) {
		// Post categories

        // Post title
        $tin_tuc = get_page_by_path( 'tin-tuc', OBJECT, 'page' )->ID;
        $news = get_page_by_path( 'news', OBJECT, 'page' )->ID;
		$mypage = getTextLang($tin_tuc, $news);
		$mypage = $tin_tuc;
		$mypage = get_post($mypage);		
		$breadcrumb .= '<li><a href="' . get_permalink($mypage->ID) . '">' . $mypage->post_title . '</a></li>';
		$post_cats = get_the_category();
		// if ( $post_cats[0] ) {
		// 	$breadcrumb .= '<li><a href="' . get_category_link( $post_cats[0]->term_id ) . '">' . $post_cats[0]->name . '</a></li>';
		// }
		$breadcrumb .= '<li class="' . $active_class . '">' . get_the_title() . '</li>';

	}

	// Pages
	if ( is_page() && ! is_front_page() ) {
		$post = get_post( get_the_ID() );
		// Page parents
		if ( $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$crumbs = array();
			while ( $parent_id ) {
				$page = get_page( $parent_id );
				$crumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$crumbs = array_reverse( $crumbs );
			foreach ( $crumbs as $crumb ) {
				$breadcrumb .= '<li>' . $crumb . '</li>';
			}
		}
		// Page title
		$breadcrumb .=  '<li class="' . $active_class . '">' . get_the_title() . '</li>';
	}
	
	// Attachments
	if ( is_attachment() ) {
		// Attachment parent
		$post = get_post( get_the_ID() );
		if ( $post->post_parent ) {

			$breadcrumb .= '<li><a href="' . get_permalink( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a></li>';
		}
		// Attachment title
		$breadcrumb .= '<li class="' . $active_class . '">' . get_the_title() . '</li>';
	}
	// Search
	if ( is_search() ) {
		$breadcrumb .= '<li class="' . $active_class . '">' . __( 'Search', $text_domain ) . '</li>';
	}
	// 404
	if ( is_404() ) {
		$breadcrumb .= '<li class="' . $active_class . '">' . __( '404', $text_domain ) . '</li>';
	}
	// Custom Post Type Archive
	if ( is_post_type_archive() ) {
		$breadcrumb .= '<li class="' . $active_class . '">' . post_type_archive_title( '', false ) . '</li>';
	}

	// Custom Taxonomies
	if ( is_tax() ) {
		// Get the post types the taxonomy is attached to
		$current_term = get_queried_object();
		$attached_to = array();
		$post_types = get_post_types();
		foreach ( $post_types as $post_type ) {
			$taxonomies = get_object_taxonomies( $post_type );
			if ( in_array( $current_term->taxonomy, $taxonomies ) ) {
				$attached_to[] = $post_type;
			}
		}
		// Post type archive link
		$output = false;
		foreach ( $attached_to as $post_type ) {
			$cpt_obj = get_post_type_object( $post_type );
			if ( ! $output && get_post_type_archive_link( $cpt_obj->name ) ) {
				$breadcrumb .= '<li><a href="' . get_post_type_archive_link( $cpt_obj->name ) . '">' .  getTextLang('Dịch vụ','Services') . '</a></li>';
				$output = true;
			}
        }

        $mypage='';
        if(get_post_type()=='dich-vu'){
            $dich_vu = get_page_by_path( 'dich_vu', OBJECT, 'page' )->ID;
            $service = get_page_by_path( 'services', OBJECT, 'page' )->ID;
            $mypage = getTextLang($dich_vu,$service);
            // $mypage = $dich_vu;
            $mypage = get_post($mypage);

            // var_dump($mypage);
        }
		// if($post_type =='cong-trinh-thuc-te' || $post_type =='du-an-hoan-thanh'){
        //     $cong_trinh = get_page_by_path( 'cong-trinh', OBJECT, 'page' )->ID;
        //     $projects = get_page_by_path( 'projects', OBJECT, 'page' )->ID;
		// 	$mypage = getTextLang($cong_trinh, $projects);
		// 	$mypage = get_post($mypage);
		// }
		// if($post_type=='du-an-hoan-thanh'){
        //     $du_an_hoan_thanh = get_page_by_path( 'du-an-hoan-thanh', OBJECT, 'page' )->ID;
        //     $completed_projects = get_page_by_path( 'completed-projects', OBJECT, 'page' )->ID;
		// 	$mypage = getTextLang($du_an_hoan_thanh , $completed_projects);
		// 	$mypage = get_post($mypage);
		// }
		// var_dump(get_post_type($post_type));
		// var_dump($post_type);
		
//		 $breadcrumb .= '<li><a href="' . get_permalink($mypage->ID) . '">' . $mypage->post_title . '</a></li>';
		// Term title
		 $breadcrumb .= '<li class="' . $active_class . '">' . single_term_title( '', false ) . '</li>';
	}

	// Custom Post Types
	if ( is_single() && get_post_type() != 'post' && get_post_type() != 'attachment' ) {
		$cpt_obj = get_post_type_object( get_post_type() );
		// Is cpt hierarchical like pages or posts?
        $mypage='';
		if(get_post_type()=='dich-vu'){
            $dich_vu = get_page_by_path( 'dich_vu', OBJECT, 'page' )->ID;
            $service = get_page_by_path( 'services', OBJECT, 'page' )->ID;
			$mypage = getTextLang($dich_vu,$service);
            // $mypage = $dich_vu;
            $mypage = get_post($mypage);
            
            // var_dump($mypage);
		}
		if(get_post_type() =='cong_trinh'){
            $cong_trinh = get_page_by_path( 'cong-trinh', OBJECT, 'page' )->ID;
            $constructions = get_page_by_path( 'constructions', OBJECT, 'page' )->ID;
			$mypage = getTextLang($cong_trinh, $constructions);
			$mypage = get_post($mypage);
		}

		
		$breadcrumb .= '<li><a href="' . get_permalink($mypage->ID) . '">' . $mypage->post_title . '</a></li>';
		if ( is_post_type_hierarchical( $cpt_obj->name ) ) {
			// Like pages
			// Cpt archive
			/*
			if ( get_post_type_archive_link( $cpt_obj->name ) ) {
				$breadcrumb .= '<li><a href="' . get_post_type_archive_link( $cpt_obj->name ) . '">' . $cpt_obj->labels->name . '</a></li>';
			}
			*/			
			// Cpt parents
			$post = get_post( get_the_ID() );
			if ( $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$crumbs = array();
				while ( $parent_id ) {
					$page = get_page( $parent_id );
					$crumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
					$parent_id  = $page->post_parent;
				}
				$crumbs = array_reverse( $crumbs );
				foreach ( $crumbs as $crumb ) {
					$breadcrumb .= '<li>' . $crumb . '</li>';
				}
			}
		} else {
			// Like posts
			// Cpt archive
			/*
			if ( get_post_type_archive_link( $cpt_obj->name ) ) {
				$breadcrumb .= '<li><a href="' . get_post_type_archive_link( $cpt_obj->name ) . '">' . $cpt_obj->labels->name . '</a></li>';
			}
			*/
			// Get cpt taxonomies
			$cpt_taxes = get_object_taxonomies( $cpt_obj->name );

			if ( $cpt_taxes && is_taxonomy_hierarchical( $cpt_taxes[0] ) ) {
				// Other taxes attached to the cpt could be hierachical, so need to look into that.
				
				$cpt_terms = get_the_terms( get_the_ID(), $cpt_taxes[0] );
				if ( is_array( $cpt_terms ) ) {
					$output = false;
					foreach( $cpt_terms as $cpt_term ) {
						
						if ( ! $output ) {
							// $breadcrumb .= '<li><a href="' . get_term_link( $cpt_term->name, $cpt_taxes[0] ) . '">' . $cpt_term->name . '</a></li>';
							$output = true;
						}
					}
				}
			}
		}
		// Cpt title
		$breadcrumb .= '<li class="' . $active_class . '">' . get_the_title() . '</li>';
		
	}
	// Close list
	$breadcrumb .= '</' . $list_style . '>';
	// Ouput
	if ( $echo ) {
		echo $breadcrumb;
	} else {
		return $breadcrumb;
	}
	
}



// API google map
function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyDQOP6Gz_91tuEODCHY2Y2IJXyjf18CTiA');
}

add_action('acf/init', 'my_acf_init');

// end API google map





function get_banner_new($data_page_id){
        $data_page_id = $data_page_id ? $data_page_id : get_the_ID();
        $banner = get_field('service', $data_page_id);
        $banner_title = $banner['title_dich_vu']?$banner['title_dich_vu']:get_the_title($data_page_id);
        $banner_bg = $banner['background_image']?$banner['background_image']['url']:THEME_URI.'/images/default/noimage_1440x364.png';
    ?>
    <section class="section banner-top-new" style="background-image: url('<?php echo $banner_bg; ?>')">
        <div class="container">
            <div class=" banner-top-new--content">
                <h1 class="banner-top-new--title"><?php echo $banner_title; ?></h1>
                <?php echo hr_get_breadcrumb('ul','breadcrumbs','breadcrumbs','hrActive');?>
                <?php if($banner_subtitle = $banner['sub_title']) echo '<h3 class="banner-top-new--sub-title">'.$banner_subtitle.'</h3>'; ?>
                <?php if($banner_description = $banner['description']) echo '<div class="banner-top-new--description">'.$banner_description.'</div>'; ?>
            </div>
        </div>
    </section>
    <?php
}

add_action('get_banner_new', 'get_banner_new');


function excerpt($content, $limit="50", $more='[…]') {
    $excerpt = explode(' ', $content, $limit);
    
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(' ',$excerpt).$more;
    } else {
        $excerpt = implode(' ',$excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}

