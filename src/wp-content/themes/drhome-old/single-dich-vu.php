<?php  
    get_header();
    $page_id_vi = get_page_by_path( 'dich_vu', OBJECT, 'page' )->ID;
    $page_id_en = get_page_by_path( 'services', OBJECT, 'page' )->ID;
    $data_page_id = getTextLang($page_id_vi, $page_id_en);
?>
    <div class="single-service main">

    <?php echo do_action('get_banner_new', $data_page_id); ?>

        <?php while(have_posts()):the_post(); ?>
        <div class="container">
            <div class="title-post  text-center">
                <h2><?php the_title();?></h2>
            </div>
            <div class="content-post">
                <?php the_content(); ?>
            </div>
            <?php endwhile; ?>

            <?php
            $terms = get_terms( array(
                'taxonomy' => 'danh-muc-dich-vu',
                'hide_empty' => false,
                'orderby ' => 'id',
            ));
            ?>

            <?php
            $args = array(
                'posts_per_page'   => -1,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'post_type'        => 'dich-vu',
                'post_status'      => 'publish',
            );
            $query=new WP_Query($args);
            if($query->have_posts()):
                ?>
                <div class="slider-post package">
                    <div class="title-slider">
                        <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                            <h6>Dịch vụ khác</h6>
                        <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                            <h6>Other Services</h6>
                        <?php endif;?>
                    </div>
                    <div class="blog-content">
                        <div class="container">
                            <div class="row">
                            <?php
                            $args = array(
                                'posts_per_page'   => 4,
                                'orderby'          => 'date',
                                'order'            => 'DESC',
                                'post_type'        => 'dich-vu',
                                'post_status'      => 'publish',
                            );
                            $query=new WP_Query($args);
                            if($query->have_posts()):
                                ?>
                                <?php while ($query->have_posts()):$query->the_post(); ?>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="box-package">
                                        <?php
                                        $thumb = has_post_thumbnail() ? get_the_post_thumbnail_url() : get_field('thumbnail_default','options')['url'];
                                        ?>
                                        <a href="<?php echo get_permalink();?>">
                                            <img src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>">
                                        </a>
                                        <div class="box-title">
                                            <h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <a href="<?php echo get_permalink(); ?>" class="detail">
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
                            <?php endwhile;
                            endif; ?>
                        </div>
                        </div>
                    </div>
                </div>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </div>
<?php get_footer(); ?>
