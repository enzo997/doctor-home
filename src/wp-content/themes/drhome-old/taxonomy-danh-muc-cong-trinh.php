<?php
    get_header();
    global $post;
    $cat = get_queried_object();

    $page = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;
    $posts_per_page = 1;
    $offset = ( $posts_per_page * $page ) - $posts_per_page;
    $get_posts = get_posts(
        [
            'post_type' => 'cong_trinh',
            'orderby'  => 'date',
            'order'    => 'DESC',
            'posts_per_page' => $posts_per_page,
            'tax_query' => array(
                array(
                    'taxonomy' => 'danh-muc-cong-trinh',
                    'field' => 'id',
                    'terms' => $cat->term_id
                )
            )
        ]
    );
    $post_count = count(
        get_posts(
            [
                'post_type' => 'cong_trinh',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'danh-muc-cong-trinh',
                        'field' => 'id',
                        'terms' => $cat->term_id
                    )
              ),
            ]
        )
    );

    $total_page=get_num_page($post_count,$posts_per_page);

    $page_id_vi = get_page_by_path( 'cong-trinh', OBJECT, 'page' )->ID;
    $page_id_en = get_page_by_path( 'constructions', OBJECT, 'page' )->ID;
    $data_page_id = getTextLang($page_id_vi, $page_id_en);


?>
<div class="main">
    <?php 
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

    <section class="package tab-service--new"> 
        <div class="container">
            <div class="tab-service--header">
                <?php 
                $data = get_field('header', $data_page_id); 
                $title = $data['title']?$data['title']:'DOCTOR HOME';
                $description = $data['description'];
                ?>
               <h2 class="tab-service--title"><?php echo $title; ?></h2>
               <?php if($description){
                   echo '<div class="tab-service--description">'.$description.'</div>';
               } ?>
               
            </div>
            <div id="" class="tab-service--content">
                <div id="load_post_by_cat" class="row" data-cat-id="<?php echo $cat->term_id; ?>">
                    
                    <?php 
                        if(!empty($get_posts)){
                            foreach ($get_posts as $post) :?>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
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
                                                <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a>
                                            </h3>

                                            <a href="<?php echo get_permalink($term->term_id) ?>" title="<?php echo $post->post_title; ?>"><div class="tab-service--box--readmore">+</div></a>
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
                        }
                    ?>
                    <?php paging('',5,$total_page,$page,$posts_per_page,'admin'); ?>
                </div>
            </div>
        </div>
    </section>

</div>
<?php get_footer(); ?>