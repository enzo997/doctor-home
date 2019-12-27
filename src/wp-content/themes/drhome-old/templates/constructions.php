<?php
//* Template Name: Công trình

    get_header();
    global $post;

    $page = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;
    $posts_per_page = 6;

    $get_posts = get_posts(
        [
            'post_type' => 'cong_trinh',
            'orderby'  => 'date',
            'order'    => 'DESC',
            'posts_per_page' => $posts_per_page,
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

    $page_id_vi = get_page_by_path( 'cong-trinh', OBJECT, 'page' )->ID;
    $page_id_en = get_page_by_path( 'constructions', OBJECT, 'page' )->ID;
    $data_page_id = getTextLang($page_id_vi, $page_id_en);

?>
<div class="main">

    <?php echo do_action('get_banner_new', $data_page_id); ?>

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
                <div id="load_post_st" class="row">
                    <?php foreach ($get_posts as $post) :?>
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
                                        <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
                                    </h3>

                                    <a href="<?php echo get_permalink($post->ID) ?>"><div class="tab-service--box--readmore">+</div></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ; ?>
                    <?php paging('',5,$total_page,$page,$posts_per_page,'admin'); ?>
                </div>
            </div>
        </div>
    </section>

</div>
<?php get_footer(); ?>