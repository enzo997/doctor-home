<?php
    get_header();
    $page_id_vi = get_page_by_path( 'dich_vu', OBJECT, 'page' )->ID;
    $page_id_en = get_page_by_path( 'services', OBJECT, 'page' )->ID;
    $data_page_id = getTextLang($page_id_vi, $page_id_en);
?>
<div class="main">
    <?php //do_action('banner_page_f'); ?>

    <?php echo do_action('get_banner_new', $data_page_id); ?>

    <section class=" package tab-service--new">
        <div class="container">
            <div class="tab-service--header">
               <h2 class="tab-service--title"><?php echo get_field('title_dich_vu', $data_page_id);?></h2>
               <?php if($description = get_field('description_dichvu', $data_page_id)){
                   echo '<h4 class="tab-service--description">'.$description.'</h4>';
               } ?>
               
            </div>
            <div id="" class="  tab-service--content">
                <div id="load--post-list" class="row">
                    <?php 
                     $paged =  get_query_var('paged')?get_query_var('paged'):1;
                     $posts_per_page = 6;
                     $args = array(
                        'post_type'=> 'dich-vu',
                        'orderby'    => 'date',
                        'post_status' => 'publish',
                        "posts_per_page" => $posts_per_page,
                        'order'    => 'DESC',
                        'paged'=>$paged,
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
                                    <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title; ?>">
                                        <img src="<?php echo $thumb; ?>" alt="<?php echo $post->post_title; ?>">
                                    </a>
                                </div>
                                <div class="tab-service--box--content">
                                    <h3 class="tab-service--box--title">
                                        <a href="<?php echo get_permalink($post->ID); ?>" target="_blank"><?php echo $post->post_title; ?></a>
                                    </h3>
                                    <div class="tab-service--box--readmore">+</div>
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