<?php
    // wp_redirect(get_page_link(12).'/#'.get_query_var('danh-muc-dich-vu'));die();
    get_header();
    $post = get_queried_object();
    // $page_id_vi = get_page_by_path( 'dich_vu', OBJECT, 'page' )->ID;
    // $page_id_en = get_page_by_path( 'services', OBJECT, 'page' )->ID;
    $data_page_id = getTextLang(12, 2366);
?>

<div class="main tax-dich-vu--page">

    <?php echo do_action('get_banner_new', $data_page_id); ?>

    <section class="section sec-tax-content tab-service--new">
        <div class="container">
            <div class="sec-tax-content--header tab-service--header">
                <h2 class="sec-tax-content--title tab-service--title"><?php echo $post->name; ?></h2>
                <div class="sec-tax-content--description tab-service--description"><?php echo $post->description; ?></div>
            </div>
            <div id="" class="sec-tax-content--list">
                <div class="row" id="tax-load--post-list" data-term="<?php echo $post->term_id; ?>">
                    <?php 
                        
                        $page =  get_query_var('paged')?get_query_var('paged'):1;
                        $posts_per_page = 6;
                        $args = array(
                            'post_type'=> 'dich-vu',
                            'orderby'    => 'date',
                            'post_status' => 'publish',
                            "posts_per_page" => $posts_per_page,
                            'order'    => 'DESC',
                            "paged"=>$page,
                            'tax_query' => array( 
                                array(
                                    'taxonomy' => $post->taxonomy,
                                    'field' => 'term_id',
                                    'terms' => $post->term_id,
                                )
                            ),
                        );
                        $post_cout = count(get_posts(
                            [
                                'post_type'=> 'dich-vu',
                                'orderby'    => 'date',
                                'post_status' => 'publish',
                                "posts_per_page" => -1,
                                'order'    => 'DESC',
                                "paged"=>$page,
                                'tax_query' => 
                                [
                                    [
                                        'taxonomy' => $post->taxonomy,
                                        'field' => 'term_id',
                                        'terms' => $post->term_id,
                                    ]
                                ]
                            ]
                        ));
                        $total_page=get_num_page($post_cout,$posts_per_page);
                        // var_dump($total_page);
                        if(!empty(get_posts($args))){
                            foreach (get_posts($args) as $post):
                                ?>
                                 <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <div class="tab-service--box">
                                        <?php
                                        $thumb = get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_URI.'/images/default/noimage_333x333.png';
                                        ?>
                                        <div class="tab-service--box--thumb">
                                            <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title; ?>">
                                                <img src="<?php echo $thumb; ?>" alt="<?php echo $post->post_title; ?>">
                                            </a>
                                        </div>
                                        <div class="tab-service--box--content">
                                            <h3 class="tab-service--box--title">
                                                <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a>
                                                
                                            </h3>
                                            <a href="<?php echo get_permalink($term->term_id) ?>" target="_blank" title="<?php echo $post->post_title; ?>"><div class="tab-service--box--readmore">+</div></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; 
                        } else{
                            ?>
                            <div class="empty_pd">
                                <h4><?php echo getTextLang("Không có dịch vụ", 'No services');?></h4>
                            </div>
                            <?php
                        }?>
                        <?php paging('',5,$total_page,$page,$posts_per_page,'admin'); ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>


