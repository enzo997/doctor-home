<?php
get_header();
?>
<div class="main">
    <?php
        $bg_banner=get_field('background_banner_home');
        $title_banner=get_field('title_banner_home');
        $descriptiion_banner=get_field('description_banner_home');
        $button_text_banner_home=get_field('button_text_banner_home');
        $button_link_banner_home=get_field('button_link_banner_home');
        $title_form=get_field('title_form_banner_home');
        $form_shortcode_banner=get_field('form_shortcode_banner');
        $form_shortcode_banner_en=get_field('form_shortcode_banner_en');
    ?>
    <section class="banner" style="background-image: url('<?php echo $bg_banner['url']; ?>')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 text-banner">
                    <?php echo acf_render('<h1>','</h1>',$title_banner); ?>
                    <h3 class="title-english"><?php echo get_field('title_english');?></h3>
                    <?php echo acf_render('<p>','</p>',$descriptiion_banner);?>
                    <a href="<?php echo $button_link_banner_home;?>" class="btn-style">
                        <?php echo $button_text_banner_home;?>
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-contact">
                        <?php echo acf_render('<div class="title-form"><h3>','</h3></div>',$title_form);?>
                        <?php //echo do_shortcode($form_shortcode_banner);?>
                        <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                            <?php echo do_shortcode($form_shortcode_banner);?>
                        <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                            <?php echo do_shortcode($form_shortcode_banner_en);?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php 
        $choose_video=get_field('choose_video');
        $video_link=get_field('video_link');
        $video_file=get_field('video_file');
        if (!empty($video_link) || !empty($video_file)){
    ?>
        <section class="section_video">
            <div class="container">
                <?php if ($choose_video==0){
                    $video_url=str_replace("watch?v=","embed/",$video_link);
                    ?>
                    <div class="video_link">
                        <iframe src="<?php echo $video_url;?>" frameborder="0"></iframe>
                    </div>
                <?php } else { 
                    $bg_video=get_field('video_background_image');
                    ?>
                    <div class="video_file">
                        <video controls poster="<?php echo $bg_video['url']; ?>">
                            <source src="<?php echo $video_file['url']; ?>" type="video/mp4">
                        </video>
                    </div>
                <?php } ?>
            </div>
            <style>
                .section_video {padding: 60px 0 40px;}
                .section_video .video_link {}
                .section_video .video_link iframe {width: 100%; min-height:550px;}
                .section_video .video_file {}
                .section_video .video_file video {width: 100%;}
                @media (max-width:991px){
                    .section_video .video_link iframe {width: 100%; min-height:395px;}
                }
                @media (max-width:767px){
                    .section_video .video_link iframe {width: 100%; min-height:300px;}
                }
            </style>
        </section>
    <?php } ?>




    <?php
        $title_service=get_field('title_service');
        $description_service=get_field('description_service');
        $list_service=get_field('list_service');
    ?>

    <section class="content-section service">
        <div class="container">
            <?php if($title_service || $description_service):?>
                <div class="title">
                    <?php echo acf_render('<h2>','</h2>',$title_service); ?>
                    <?php echo acf_render('<h4>','</h4>',$description_service); ?>
                </div>
            <?php endif;?>

            <div class="row">
                <?php if(have_rows('list_service')):while (have_rows('list_service')):the_row(); ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="box-service">
                            <?php $icon_t = get_sub_field('icon_service');if($icon_t):?>
                                <img src="<?php echo $icon_t['url']?>" alt="<?php echo $icon_t['alt']?>">
                            <?php endif; ?>
                            <?php echo acf_render('<h3 class="service-heading">','</h3>',get_sub_field('title_service_item'));?>
                            <?php echo acf_render('<p>','</p>',get_sub_field('description_service_item'));?>
<!--                            --><?php //if(get_sub_field('button_link_service_item')):?>
<!--                            <a href="--><?php //echo get_sub_field('button_link_service_item');?><!--" class="detail">--><?php //echo get_sub_field('button_text_service_item'); ?>
<!--                                <i class="fa fa-chevron-right" aria-hidden="true"></i>-->
<!--                            </a>-->
<!--                            --><?php //endif;?>
                            <?php if(get_sub_field('button_link_2')):?>
                                <a href="<?php echo get_sub_field('button_link_2');?>" class="detail"><?php echo get_sub_field('button_text_service_item'); ?>
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </a>
                            <?php endif;?>
                        </div>
                    </div>
                <?php endwhile; endif;?>
            </div>
        </div>
    </section>

    <?php
    $title_why_choose_us=get_field('title_why_choose_us');
    $description_why_choose_us=get_field('description_why_choose_us');
    $list_about_us=get_field('list_about-us');
    ?>
    <?php if($title_why_choose_us || $description_why_choose_us || $list_about_us):?>
    <section class="content-section about-us">
        <div class="container">
            <div class="title">
                <?php echo acf_render('<h2>','</h2>',$title_why_choose_us); ?>
                <?php echo acf_render('<h4>','</h4>',$description_why_choose_us); ?>
            </div>
            <?php if(have_rows('list_about-us')):?>
                <div class="row">
                    <?php while (have_rows('list_about-us')):the_row();?>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="box-about">
                                <?php echo acf_render('<h3>','</h3>',get_sub_field('title_item'));?>
                                <?php echo acf_render('','',get_sub_field('description_item'));?>
                            </div>
                        </div>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>
    </section>
    <?php endif; ?>

    <?php
        $bg_banner_work=get_field('background_work');
        $titile_work=get_field('titile_work');
        $description_work=get_field('description_work');
        $process_work=get_field('process_work');
    ?>
    <section class="section-work" style="background-image: url('<?php echo $bg_banner_work['url']?>')">
        <div class="container">
            <div class="title">
                <?php echo acf_render('<h2>','</h2>',$titile_work);?>
                <?php echo acf_render('<h4>','</h4>',$description_work);?>
            </div>
            <?php if( have_rows('process_work') ): ?>
            <div class="box-text">
                <?php $dem=0; while( have_rows('process_work') ): the_row(); $dem+=1;?>
                    <div class="content-work">
                        <div class="circle-number <?php if($dem%2==0){echo 'work-even';} ?>">
                            <?php echo acf_render('<p>','</p>',$dem);?>
                        </div>
                        <div class="box-work">
                            <?php echo acf_render('<p>','</p>',get_sub_field('text_work'));?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php
    
    if(ICL_LANGUAGE_CODE=='vi'):
        $title_library_image=get_field('title_for_home',16);
        $description_library_image=get_field('description_for_home',16);
        $images = get_field('thu_vien_hinh_anh_gallery',16);
    elseif(ICL_LANGUAGE_CODE=='en'):
        $title_library_image=get_field('title_for_home',2365);
        $description_library_image=get_field('description_for_home',2365);
        $images = get_field('thu_vien_hinh_anh_gallery',2365);
    endif;
    $size = 'full';
    if( $images ): ?>
    <section class="library-img">
        <div class="container">
            <div class="title">
                <?php echo acf_render('<h2>','</h2>',$title_library_image); ?>
                <?php echo acf_render('<h4>','</h4>',$description_library_image); ?>
            </div>
            <div class="row">
                <?php $dem=0; foreach( $images as $image ): $dem++;
                ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <a data-title="<?php echo $image['title']; ?>" href="<?php echo $image['url']; ?>">
                            <img src="<?php echo $image['sizes']['thumb_350x300']; ?>" alt="<?php echo $image['alt']; ?>" />
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
    <?php
        $args = array(
            'posts_per_page'   => 3,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'post',
            'post_status'      => 'publish',
        );
        $query=new WP_Query($args);
        if($query->have_posts()):
    ?>
    <?php
        $title_news=get_field('title_news');
        $description_news=get_field('description_news');
    ?>
    <section class="blog-content">
        <div class="container">
            <?php if($title_news || $description_news): ?>
            <div class="title">
                <?php echo acf_render('<h2>','</h2>',$title_news); ?>
                <?php echo acf_render('<h4>','</h4>',$description_news); ?>
            </div>
            <?php endif; ?>
            <div class="row">
                <?php while ($query->have_posts()):$query->the_post(); ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="box-blog">
                            <div class="content-img">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('thumb_350x215');?>
                                </a>
                            </div>
                            <div class="content-box">
                                <h4>
                                    <a href="<?php the_permalink(); ?>" class="title-blog"><?php the_title()?></a>
                                </h4>
                                <p><?php echo get_the_excerpt(); ?></p>
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
            <div class="see-all">
                <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                    <a href="<?php echo get_page_link(14);?>">
                        XEM TẤT CẢ
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                    <a href="<?php echo get_page_link(2364);?>">
                        SEE ALL
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                <?php endif;?>
            </div>
        </div>
    </section>
    <?php endif; wp_reset_query();?>
    <?php
        $title_customer=get_field('title_customer');
        $description_customer=get_field('description_customer');
        $list_company=get_field('list_company');
        if($title_customer || $description_customer || $list_company):
    ?>
        <section class="customer">
            <div class="container">
                <div class="title">
                    <?php echo acf_render('<h2>','</h2>',$title_customer)?>
                    <?php echo acf_render('<h4>','</h4>',$description_customer);?>
                </div>
                <?php if(have_rows('list_company')):?>
                    <div class="row">
                        <?php while (have_rows('list_company')):the_row();?>
                            <div class="col-12 col-img">
                                <div class="customer-img">
                                    <img src="<?php echo get_sub_field('logo_company')['url'];?>" alt="<?php echo get_sub_field('logo_company')['alt'];?>">
                                </div>
                            </div>
                        <?php endwhile;?>
                    </div>
                <?php endif;?>
            </div>
        </section>
    <?php endif;?>
</div>
<?php get_footer();?>
