<?php
//* Template Name: Tin tức
get_header();
?>
<div class="main">
    <?php do_action('banner_page_f'); ?>
    <?php
        $paged =  get_query_var('paged')?get_query_var('paged'):1;
        $args = array(
            'posts_per_page'   => 9,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'post',
            'post_status'      => 'publish',
            "paged"=>$paged,
        );
        if(get_query_var('cat')) {
            $args['cat'] = get_query_var('cat');
        }
        $query=new WP_Query($args);
        if($query->have_posts()):
    ?>
        <section class="blog-content">
            <div class="container">
                <div class="row">
                    <?php while ($query->have_posts()):$query->the_post(); ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="box-blog">
                            <div class="content-img">
                                <!-- <a href="<?php //the_permalink(); ?>">
                                    <?php //the_post_thumbnail('thumb_350x215');?>
                                </a> -->
                                <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>"><!-- change 28/10/2019 -->
                                    <img src="<?php echo get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_IMAGES.'/noimage.png';?>" alt="image-post"><!-- change 28/10/2019 -->
                                </a>
                            </div>
                            <div class="content-box">
                                <h4>
                                    <a href="<?php the_permalink(); ?>" class="title-blog" title="<?php echo $post->post_title; ?>"><?php echo excerpt($post->post_title, 7, '...'); ?></a>
                                </h4>
                                <p><?php echo excerpt(get_the_excerpt(), 42); ?></p>

                                <a href="<?php the_permalink(); ?>" class="detail">
                                        <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                                            XEM CHI TIẾT
                                        <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                                            SEE DETAIL
                                        <?php endif;?>
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endwhile;?>
                </div>
            </div>
            <div class="pagination justify-content-center align-items-center d-flex">
                <?php nt_pagination($args,array('posts_per_page'=>$args['posts_per_page'])); ?>
            </div>
        </section>
    <?php endif; wp_reset_postdata(); ?>

</div>
<?php get_footer();?>
