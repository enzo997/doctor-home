<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); 
$data_page_id = get_page_by_path( 'tin-tuc', OBJECT, 'page' )->ID;
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
    <?php //while(have_posts()):the_post(); ?>
    <section class="col">
        <div class="container">
            <div class="row">
                <div class="col-size-8 col-lg-7 col-md-7 col-sm-12 col-sx-12">
                    <section class="col-size-8 sec-content">
                        <div class="container">
                            <div class="col-size-8 sec-content--post">
                                <?php 
                                    $news = get_field('content');
                                ?>
                                <div class="col-size-8 sec-content post-center ">
                                    <h3 class="col-size-8 sec-content post-center h3-title"><?php echo $news['news']['title'];?></h3>
                                    <div class="col-size-8 sec-content post-center inf">
                                        <span class="col-size-8 sec-content post-center author-inf"><?php echo get_the_author(); ?></span>
                                        <span class="col-size-8 sec-content post-center day-inf"><?php echo get_the_date('M d,Y'); ?></span>
                                    </div>
                                </div>
                                <div class="col-size-8 sec-content post-description">
                                    <?php echo $news['news']['description']; ?>
                                </div>
                                <?php // endwhile; ?>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-size-4 col-lg-5 col-md-5 col-sm-12 col-sx-12">
                    <?php
                         $categories = get_the_category(get_the_ID());
                         if ($categories){
                             $category_ids = array();
                             foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                             $args=array(
                                 'category__in' => $category_ids,
                                 'post__not_in' => array(get_the_ID()),
                                 'posts_per_page' => 6,
                                 'orderby'=>'date',
                                 'order'=>'DESC',
                             );
                             if (get_posts($args) == NULL){
                                $args = array(
                                    'posts_per_page'   => 6,
                                    'orderby'          => 'date',
                                    'order'            => 'DESC',
                                    'post_type'        => 'post',
                                    'post_status'      => 'publish',
                                );
                            }
                         }
                        $query=new WP_Query($args);
                        if($query->have_posts()):
                    ?>
                    <section class="col-size-4 sec-slider">
                        <div class="container">
                            <div class="col-size-4 sec-slider--post">
                                <!-- <div class="sec-slider--post title-slider">
                                    <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                                        <h6>Bài Viết Liên Quan</h6>
                                    <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                                        <h6>Related Posts</h6>
                                    <?php endif;?>
                                </div> -->
                                <div class="col-size-4 sec-slider--post blog-content">
                                    <h4 class="h4-title"><? echo $news['title'];?></h4>
                                    <?php while ($query->have_posts()):$query->the_post(); ?>
                                        <div class="col-size-4 sec-slider--post post--box-blog">
                                            <div class="image-size">
                                                <div class="content-img">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail();?>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-size-4 sec-slider--post post-content-box">
                                                <h5 class="h5-title">
                                                    <a href="<?php the_permalink(); ?>" class="title-blog"><?php the_title()?></a>
                                                </h5>
                                                <!-- <p><?php echo get_the_excerpt(); ?></p> -->
                                                <!-- <a href="<?php the_permalink(); ?>" class="detail">
                                                    <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                                                        XEM CHI TIẾT
                                                    <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                                                        SEE DETAIL
                                                    <?php endif;?>
                                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                                </a> -->
                                            </div>
                                        </div>
                                    <?php endwhile;?>
                                </div>
                            </div>
                        </div>
                        <?php endif; wp_reset_postdata(); ?>
                    </section>
                    <?php
                        $args = array(
                            'posts_per_page'   => 6,
                            'orderby'          => 'date',
                            'order'            => 'DESC',
                            'post_type'        => 'du-an-hoan-thanh',
                            'post_status'      => 'publish',
                            );
                        $query=new WP_Query($args);
                        if($query->have_posts()):
                    ?>
                    <?php 
                        $project = get_field('project');
                    ?>
                    <section class="col-size-4 sec-list">
                        <div class="container">
                            
                            <div class="col-size-4 sec-list--content">
                                <h4 class="col-size-4 sec-list--content h4-title">
                                    <? echo $project['title']; ?>
                                </h4>
                                <?php while ($query->have_posts()):$query->the_post(); ?>
                                    <div class="col-size-4 sec-list--content box ">
                                        <div class="col-size-4 sec-list--content box--package">
                                            <?php
                                            $thumb = has_post_thumbnail() ? get_the_post_thumbnail_url() : get_field('thumbnail_default','options')['url'];
                                            ?>
                                            <a href="<?php echo get_permalink();?>">
                                                <div class="image-size">
                                                    <img src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>">
                                                </div>
                                            </a>
                                            <div class="col-size-4 sec-list--content box--title">
                                                <h5 class="col-size-4 sec-list--content box--title h5-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;
                                endif; wp_reset_postdata();?>
                            </div>
                        </div>
                    </section>
                    <?
                        $form = get_field('form') ;
                    ?>
                    <section class="col-size-4 form">
                        <div class="container">
                            <div class="col-size-4 form-content">
                                <h3 class="form h3-title"><? echo $form['call'];?></h3>
                                <h5 class="form h5-title"><i><? echo $form['subtitle'];?></i></h5>
                                <div class="form contact-phone">
                                    <div class="mobile">
                                        <div class="img-phone">
                                            <img src="<?php echo $form['img']['url']; ?>" alt="<?php echo $form['img']['url']; ?>">
                                        </div>
                                        <?php if($form['number1'] || $form['number2']):?>
                                            <li class="phone">
                                                <div class="phone-mobile">
                                                    <?php if($form['number1']):?>
                                                        <a href="tel:+<?php echo str_replace(' ','',$form['number1']);?>"><?php echo $form['number1']; ?></a><?php endif; ?>
                                                </div>
                                                <div class="phone-number">
                                                    <?php if($form['number2']):?>
                                                        <a href="tel:+<?php echo str_replace(' ','',$form['number2']);?>"><?php echo $form['number2']; ?></a>
                                                    <?php endif;?>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <h3 class="form h3-title-2"><? echo $form['title'];?></h3>
                                <h5 class="form h5-title-2"><i><? echo $form['sub'];?></i></h5>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>
