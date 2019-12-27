<?php
add_action('wp_ajax_load_term_sv','load_term_sv');
add_action('wp_ajax_nopriv_load_term_sv','load_term_sv');
function load_term_sv(){
    $data_limit = $_POST['data_limit'];
    $data_paging = $_POST['data_paging'];
    $terms_per_page = $data_limit;
    $taxonomy   = 'danh-muc-dich-vu';
    $term_count = count(arrs_all_cat($taxonomy));
    $offset = ( $terms_per_page * $data_paging ) - $terms_per_page;
    $terms = get_terms(
        [
            'taxonomy' => $taxonomy,
            'orderby'  => 'date',
            'order'    => 'DESC',
            'number'   => $terms_per_page,
            'offset'   => $offset,
            'hide_empty' => false,
        ]
    );
    $total_page=get_num_page($term_count,$terms_per_page);
    ?>
    <?php 
        if(!empty($terms)){
            foreach ($terms as $term) :?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="tab-service--box">
                        <?php
                        // Sử dụng field acf
                        $thumb = get_field('image', $term)['url'] ? get_field('image', $term)['url'] : THEME_URI.'/images/default/noimage_333x333.png';
                        ?>
                        <div class="tab-service--box--thumb">
                            <a href="<?php echo  get_term_link($term->term_id); ?>" title="<?php echo $term->name; ?>"><!-- change 31/10 -->
                                <img src="<?php echo $thumb; ?>" alt="<?php echo $term->name ?>">
                            </a>
                        </div>
                        <div class="tab-service--box--content">
                            <h3 class="tab-service--box--title">
                                <a href="<?php echo get_term_link($term->term_id) ?>" title="<?php echo $term->name; ?>"><?php echo $term->name ?></a>
                            </h3>
                            <a href="<?php echo get_term_link($term->term_id) ?>" title="<?php echo $term->name; ?>"><div class="tab-service--box--readmore">+</div></a>
                        </div>
                    </div>
                </div>
            <?php endforeach ; 
        } else{
            ?>
            <div class="empty_pd">
                <h4><?php echo getTextLang("Không có dịch vụ", 'No services');?></h4>
            </div>
            <?php
        }?>
        <?php paging('',5,$total_page,$data_paging,$terms_per_page,'admin'); ?>

    <?php
    exit;
}

add_action('wp_ajax_load_post_list','load_post_list');
add_action('wp_ajax_nopriv_load_post_list','load_post_list');
function load_post_list(){
    $data_limit = $_POST['data_limit'];
    $data_paging = $_POST['data_paging'];

    $posts_per_page = $data_limit;
    $offset = ( $posts_per_page * $data_paging ) - $posts_per_page;


    $paged =  get_query_var('paged')?get_query_var('paged'):1;
    $args = array(
        'post_type'=> 'dich-vu',
        'orderby'    => 'date',
        'post_status' => 'publish',
        "posts_per_page" => $posts_per_page,
        'order'    => 'DESC',
        'paged'=>$paged,
        'offset'   => $offset,
    );
    $posts = get_posts($args);
    $post_cout = count(get_posts(
        [
            'post_type'=> 'dich-vu',
            "posts_per_page" => -1,
            'post_status' => 'publish',
        ]
    ));
    $total_page=get_num_page($post_cout,$posts_per_page);
    foreach ($posts as $post) :
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <div class="tab-service--box">
                <?php
                $thumb = get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_URI.'/images/default/noimage_333x333.png';
                ?>
                <div class="tab-service--box--thumb">
                    <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>">
                        <img src="<?php echo $thumb; ?>" alt="<?php echo $post->post_title; ?>">
                    </a>
                </div>
                <div class="tab-service--box--content">
                    <h3 class="tab-service--box--title">
                        <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?> </a>
                        
                    </h3>
                    <div class="tab-service--box--readmore">+</div>
                </div>
            </div>
        </div>
    <?php endforeach ; ?>
    <?php 
        if(!empty($posts)){
            foreach ($posts as $post) :
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="tab-service--box">
                        <?php
                        $thumb = get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_URI.'/images/default/noimage_333x333.png';
                        ?>
                        <div class="tab-service--box--thumb">
                            <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>">
                                <img src="<?php echo $thumb; ?>" alt="<?php echo $post->post_title; ?>">
                            </a>
                        </div>
                        <div class="tab-service--box--content">
                            <h3 class="tab-service--box--title">
                                <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?> </a>
                                
                            </h3>
                            <div class="tab-service--box--readmore">+</div>
                        </div>
                    </div>
                </div>
            <?php endforeach ;
        } else{
            ?>
            <div class="empty_pd">
                <h4><?php echo getTextLang("Không có dịch vụ", 'No services');?></h4>
            </div>
            <?php
        }?>
    

    <?php paging('',5,$total_page,$data_paging,$posts_per_page,'admin'); ?>

    <?php
    exit;
}


add_action('wp_ajax_tax_load_post_list','tax_load_post_list');
add_action('wp_ajax_nopriv_tax_load_post_list','tax_load_post_list');
function tax_load_post_list(){
    $data_limit = $_POST['data_limit'];
    $data_paging = $_POST['data_paging'];
    $data_term = $_POST['data_term'];
    $posts_per_page = $data_limit;
    $offset = ( $posts_per_page * $data_paging ) - $posts_per_page;


    $post = get_queried_object();
    $page =  get_query_var('paged')?get_query_var('paged'):1;
    $posts_per_page = 6;
    $args = array(
        'post_type'=> 'dich-vu',
        'orderby'    => 'date',
        'post_status' => 'publish',
        "posts_per_page" => $posts_per_page,
        'order'    => 'DESC',
        "paged"=>$page,
        'offset'   => $offset,
        'tax_query' => array( 
            array(
                'taxonomy' => 'danh-muc-dich-vu',
                'field' => 'term_id',
                'terms' => $data_term,
            )
        ),
    );
    $post_cout = count(get_posts(
        [
            'post_type'=> 'dich-vu',
            'post_status' => 'publish',
            "posts_per_page" => -1,
            "paged"=>$page,
            'tax_query' => array( 
                array(
                    'taxonomy' => 'danh-muc-dich-vu',
                    'field' => 'term_id',
                    'terms' => $data_term,
                )
            ),
        ]
    ));                                                                 
    $total_page=get_num_page($post_cout,$posts_per_page);
    var_dump(get_posts($args));
    if(!empty(get_posts($args))){
        foreach (get_posts($args) as $post) :
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="tab-service--box">
                    <?php
                    echo $post->ID;
                    $thumb = get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_URI.'/images/default/noimage_333x333.png';
                    ?>
                    <div class="tab-service--box--thumb">
                        <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>">
                            <img src="<?php echo $thumb; ?>" alt="<?php echo $post->post_title; ?>">
                        </a>
                    </div>
                    <div class="tab-service--box--content">
                        <h3 class="tab-service--box--title">
                            <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
                            
                        </h3>
                        <div class="tab-service--box--readmore">+</div>
                    </div>
                </div>
            </div>
        <?php endforeach ; 
    } else{
        ?>
        <div class="empty_pd">
            <h4><?php echo getTextLang("Không có dịch vụ", 'No services');?></h4>
        </div>
        <?php
    }?>
    

    <?php paging('',5,$total_page,$data_paging,$posts_per_page,'admin'); ?>

    <?php
    exit;
}


add_action('wp_ajax_load_post_by_cat','load_post_by_cat');
add_action('wp_ajax_nopriv_load_post_by_cat','load_post_by_cat');
function load_post_by_cat(){
    $data_limit = $_POST['data_limit'];
    $data_paging = $_POST['data_paging'];
    $posts_per_page = $data_limit;
    $data_cat = $_POST['data_cat'];

    $offset = ( $posts_per_page * $data_paging ) - $posts_per_page;
    $page =  get_query_var('paged')?get_query_var('paged'):1;
    $args = array(
        'post_type' => 'cong_trinh',
        'orderby'  => 'date',
        'order'    => 'DESC',
        'posts_per_page' => $posts_per_page,
        'offset'   => $offset,
        'tax_query' => array(
            array(
                'taxonomy' => 'danh-muc-cong-trinh',
                'field' => 'id',
                'terms' => $data_cat
            )
        )
    );

    $get_posts = get_posts($args);
    $post_count = count(
        get_posts(
            [
                'post_type' => 'cong_trinh',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'danh-muc-cong-trinh',
                        'field' => 'id',
                        'terms' => $data_cat
                    )
                )
            ]
        )
    );
    
    $total_page=get_num_page($post_count,$posts_per_page);

    // var_dump($get_posts );
        foreach ($get_posts as $post) :
            echo $post->ID;
            ?>
            <!-- <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="tab-service--box">
                    <?php
                    $thumb = get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_URI.'/images/default/noimage_333x333.png';
                    ?>
                    <div class="tab-service--box--thumb">
                        <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>">
                            <img src="<?php echo $thumb; ?>" alt="<?php echo $post->post_title; ?>">
                        </a>
                    </div>
                    <div class="tab-service--box--content">
                        <h3 class="tab-service--box--title">
                            <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
                        </h3>            
    
                        <a href="<?php echo get_permalink($term->term_id) ?>"><div class="tab-service--box--readmore">+</div></a>
                    </div>
                </div>
            </div> -->
        <?php endforeach ;
    ?>

    <?php paging('',5,$total_page,$data_paging,$posts_per_page,'admin'); ?>

    <?php
    exit;
}

add_action('wp_ajax_load_post_st','load_post_st');
add_action('wp_ajax_nopriv_load_post_st','load_post_st');
function load_post_st(){
    $data_limit = $_POST['data_limit'];
    $data_paging = $_POST['data_paging'];
    $posts_per_page = $data_limit;
    $offset = ( $posts_per_page * $data_paging ) - $posts_per_page;


    $page =  get_query_var('paged')?get_query_var('paged'):1;

    $get_posts = get_posts(
        [
            'post_type' => 'cong_trinh',
            'orderby'  => 'date',
            'order'    => 'DESC',
            'posts_per_page' => $posts_per_page,
            'offset'   => $offset,
        ]
    );

    $post_count = count(
        get_posts(
            [
                'post_type' => 'cong_trinh',
                'posts_per_page' => -1,
            ]
        )
    );
    
    $total_page=get_num_page($post_count,$posts_per_page);

    if(!empty($get_posts)){
        foreach ($get_posts as $post) :
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="tab-service--box">
                    <?php
                    $thumb = get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_URI.'/images/default/noimage_333x333.png';
                    ?>
                    <div class="tab-service--box--thumb">
                        <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>">
                            <img src="<?php echo $thumb; ?>" alt="<?php echo $post->post_title; ?>">
                        </a>
                    </div>
                    <div class="tab-service--box--content">
                        <h3 class="tab-service--box--title">
                            <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
                        </h3>            
                        <a href="<?php echo get_permalink($term->term_id) ?>"><div class="tab-service--box--readmore">+</div></a>
                    </div>
                </div>
            </div>
        <?php endforeach ; 
    } else{
        ?>
        <div class="empty_pd">
            <h4><?php echo getTextLang("Không có công trình nào", 'No constructions');?></h4>
        </div>
        <?php
    }?>
    ?>

    <?php paging('',5,$total_page,$data_paging,$posts_per_page,'admin'); ?>

    <?php
    exit;
}

?>