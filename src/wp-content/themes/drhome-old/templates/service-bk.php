<?php
get_header();
global $post;
var_dump($post);
?>
<div class="main">
    <?php do_action('banner_page_f'); ?>
    <section class="tab-service package">
        <div class="container">
            <div class="title">
               <h2><?php echo get_field('title_dich_vu')?get_field('title_dich_vu'):$post->title; ?></h2>
               <h4><?php echo get_field('description_dichvu');?></h4>
            </div>
            <div class="tab-content row">
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
    </section>

    <?php
    $title_library_image=get_field('title_for_home',16);
    $description_library_image=get_field('description_for_home',16);
    $images = get_field('thu_vien_hinh_anh_gallery',16);
    $size = 'full';
    if( $images ): ?>
    <section class="library-img">
        <div class="container">
            <div class="title">
                <?php echo acf_render('<h2>','</h2>',$title_library_image); ?>
                <?php echo acf_render('<h4>','</h4>',$description_library_image); ?>
            </div>
            <div class="row">
                <?php $dem=0; foreach( $images as $image ): $dem++;?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <a data-title="<?php echo $image['title']; ?>" href="<?php echo $image['url']; ?>">
                            <img src="<?php echo $image['url'];; ?>" alt="<?php echo $image['alt']; ?>" />
                        </a>
                    </div>
                    <?php if($dem==6){break;} ?>
                <?php endforeach; ?>
            </div>
            <div class="see-all">
                <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                    <a href="<?php echo get_page_link(16);?>">
                        XEM TẤT CẢ
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                    <a href="<?php echo get_page_link(2365);?>">
                        SEE ALL
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                <?php endif;?>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>
<?php get_footer(); ?>