<?php
//* Template Name: Home-page-new
$id = get_queried_object()->ID;
get_header();
?>
<main class="home-page">
    <section class="sec-main-banner-top">
        <div class="sec-main-banner-top--content" style="background-image: url('<?php echo get_field('main_banner_top',$id)['image_main_banner']?get_field('main_banner_top',$id)['image_main_banner']['url']:THEME_IMAGES.'/noimage.png'; ?>'); background-repeat: no-repeat; background-size: cover; height: 735px;">
            <h1 class="sec-main-banner-top--title-h1"><?php echo get_field('main_banner_top',$id)['title_h1']?get_field('main_banner_top',$id)['title_h1']:"DR.HOME";?></h1>
            <h2 class="sec-main-banner-top--title-h2"><?php echo get_field('main_banner_top',$id)['title_h2']?get_field('main_banner_top',$id)['title_h2']:"BẢO TRÌ VÀ CẢI TẠO NHÀ";?></h2>
        </div>
    </section>
    <section class="sec-about-doctor-home">
        <div class="container">
        <?php $secAboutDR = get_field('about_doctor_home',$id);?>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 col-12 sec-about-doctor-home--col-left">
                    <div class="cont-image">
                        <img src="<?php echo $secAboutDR['col_image_left']?$secAboutDR['col_image_left']['url']:THEME_IMAGES.'/noimage.png';?>" alt="Image-sec-about-dr-home">
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-12 sec-about-doctor-home--col-right">
                    <div class="sec-about-doctor-home--col-right--col-cont">
                        <h4 class="sec-about-doctor-home--col-right--col-cont--title-h4"><?php echo $secAboutDR['col_content_right']['title_h4']?$secAboutDR['col_content_right']['title_h4']:"VỀ DOCTOR HOME";?></h4>
                        <i class="far fa-square"></i>
                        <div class="sec-about-doctor-home--col-right--col-cont--descrition description-cont-group">
                            <div class="col-content-description">
                                <div class="description">
                                    <?php echo $secAboutDR['col_content_right']?$secAboutDR['col_content_right']['description']:""; ?>
                                </div>
                            </div>
                        </div>
                        <h5 class = "sec-about-doctor-home--col-right--col-cont--title-h5-itaclic"><?php echo $secAboutDR['col_content_right']['title_italic'];?></h5>
                        <div class="sec-about-doctor-home--col-right--col-cont--group-content group-content">
                            <div class="row">
                                <?php	
                                    $pr_company_group = $secAboutDR['col_content_right']['pr_company_group'];
                                    $i = 0;
                                    foreach($pr_company_group  as $item):
                                    $i++;
                                    $pr_box = $item['pr_box']?$item['pr_box']:'';
                                    ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="col-content-box col-content-box-<?php echo $i;?>">
                                            <!-- <?php //if($i==1){
                                                ?><div class="icon-box"><i class="fas fa-building"></i></div><?
                                            //}
                                            ?>
                                            <?php //if($i==2){
                                                ?><div class="icon-box"><div class="cont-icont"><img src="<?php //echo THEME_IMAGES?>/icon-coint.png" alt="ICON"></div></div><?
                                            //}
                                            ?>
                                            <?php //if($i==3){
                                                ?><div class="icon-box"><i class="fas fa-gavel"></i></div><?
                                            //}
                                            ?>
                                            <?php //if($i==4){
                                                ?><div class="icon-box"><div class="cont-icont"><img src="<?php //echo THEME_IMAGES?>/icon-book.png" alt="ICON"></div></div><?
                                            //}
                                            ?> -->
                                            <div class="icon-svg-pr">
                                                <img src="<?php echo $pr_box['icon_pr']?$pr_box['icon_pr']['url']:"";?>" alt="icon-pr">
                                            </div>
                                            <div class="cont-element-group">
                                                <div class="title-box"><?php echo $pr_box['title']?$pr_box['title']:"";?></div>
                                                <div class="description-box description">
                                                    <?php echo $pr_box['description']?$pr_box['description']:"";?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php   
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php 
    $our_services= get_field('our_services',$id);
    // $title_service=get_field('title_service');
    // $description_service=get_field('description_service');
    // $list_service=get_field('list_service');


    if($our_services['show_post']['select'] == 0){
        $args=array(
            'post_type'=> 'dich-vu',
            'orderby'    => 'date',
            'post_status' => 'publish',
            "posts_per_page" => 6,
            'order'    => 'DESC',
            'suppress_filters' => false,
        );
        $lang_posts = new WP_Query($args);
        $posts = $lang_posts->posts;
        // $posts = get_posts($args);
    } else{
        $posts = $our_services['show_post']['post'];
    }   

    // var_dump($our_services['show_post']['select']);

    if(!empty($posts)):
    ?>
        <section class="sec-our-service">
            <div class="container">
                <!-- <h5 class="title-h5 sec-our-service--title-h5"><?php //echo $our_services['title_h5']?$our_services['title_h5']:"OUR SERVICES";?></h5> -->
                <h4 class="title-h4 sec-our-service--title-h4"><?php echo $our_services['title_h4']?$our_services['title_h4']:"DỊCH VỤ CỦA DR. HOME";?></h4>
                <div class="description sec-our-service--description"><?php echo $our_services['description']?$our_services['description']:"";?></div>     
                <div class="row">
                    <? 
                        foreach($posts as $post){
                            require THEME_PATH.'/templates-parts/item-dich-vu-homepage.php';
                        }
                    ?>
                </div>   
                <div class="sec-our-services--link-see-more">
                    <a href="<?php echo $our_services['link_see_more']?$our_services['link_see_more']['url']:"###"; ?>" target="_blank"><?php echo $our_services['link_see_more']?$our_services['link_see_more']['title']:"Xem Thêm"; ?></a>
                </div>  
            </div>
        </section>
    <?php endif; ?>
    <?php 
        $rw_show_post = get_field('rw_show_post', $id);
        if($rw_show_post['select'] == 0){
            $cat = getTextLang('cong-trinh-thuc-te', 'realistic-works');
            $args=array(
                'post_type'=> 'cong_trinh',
                'orderby'    => 'date',
                'order'    => 'DESC',
                'post_status' => 'publish',
                "posts_per_page" => 6,
                'suppress_filters' => false,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'danh-muc-cong-trinh',
                        'field' => 'slug',
                        'terms' => $cat
                    )
                )
            );
            $lang_posts = new WP_Query($args);
            $posts_work = $lang_posts->posts;
            // $posts_work = get_posts($args);
        } else{
            $posts_work = $rw_show_post['post'];
        }  
    if(!empty($posts_work)): ?>
        <section class="sec-realistic-works">
            <div class="container">
                    <h4 class="sec-realistic-works--title-h4"><?php echo get_field('title_realistic_h4',$id)?get_field('title_realistic_h4',$id):getTextLang('CÔNG TRÌNH THỰC TẾ', 'REAL WORKS');?></h4>              
                <div class="row">
                    <?php
                        foreach($posts_work as $post){
                            ?>
                            <div class="list col-lg-4 col-md-4 col-sm-12 col-12 list-sec-cateroy-realistic">
                                <div class="text-content">
                                    <div class="text-content--image">
                                        <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title?>" class="button"><img src="<?php echo get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_IMAGES.'/noimage.png';?>" alt="image-post"></a>
                                    </div>
                                    <div class="cont-group">
                                        <div class="cont-word">
                                            <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title;?>"><h3 class="h3-title"><?php echo $post->post_title; ?></h3></a>
                                            <div class="description"><?php echo $post->post_excerpt; ?></div>
                                        </div>
                                        <div class="cont-button-plus">
                                            <a href="<?php echo get_permalink($post->ID);  ?>" target="_blank" title="<?php echo $post->post_title;?>"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        //}
                    ?>
                </div> 
                <div class="sec-realistic-link">
                    <a href="<?php echo get_field('link_see_more_realistic', $id)['url'];?>" target="_blank" ><?php echo get_field('link_see_more_realistic', $id)?get_field('link_see_more_realistic', $id)['title']:"Xem Thêm"; ?></a>
                </div>    
            </div>
        </section>
    <?php endif; ?>

    <?php 
        $n_show_post_copy = get_field('n_show_post_copy', $id);
        if($n_show_post_copy['select'] == 0){
            $args = array(
                'orderby'    => 'date',
                'post_status' => 'publish',
                "posts_per_page" => 4,
                'order'    => 'DESC',
                'suppress_filters' => false,
            );
            // $posts = get_posts($args);
            $lang_posts = new WP_Query($args);
            $posts = $lang_posts->posts;
        } else{
            $posts = $n_show_post_copy['post'];
        }  

        if(!empty($posts)):
    ?>                   
        <section class="sec-news">
            <div class="container">
                    <h4 class="sec-news--title-h4"><?php echo get_field('tilte_news_h4',$id)?get_field('tilte_news_h4',$id):getTextLang('TIN TỨC', 'NEWS');?></h4>
                <div class="row">     
                    <?php
                        foreach($posts as $key=>$post){  
                            if ($key==0):
                            ?>
                                <div class="col-lg-6 col-md-6 col-sm-12 first-child">
                                    <div class=" bolg-post--box blog-post--box-<?php echo $key;?>">
                                        <div class="col-image">
                                            <div class="date">
                                                <?php echo get_the_date( 'd/m',$post->ID )?>
                                            </div>
                                            <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title; ?>">
                                                <img src="<?php echo get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_IMAGES.'/noimage.png';?>" alt="image-post">
                                            </a>
                                        </div>
                                        <div class="blog-post--content">
                                            <div class="cont">
                                                <h3 class="title-h3">
                                                    <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title; ?>"><?php echo excerpt($post->post_title, 20, '...'); ?></a>
                                                </h3>
                                                <div class="description">
                                                    <?php //echo $post->post_excerpt;?><!--change 28/10/2019 -->
                                                    <?php
                                                        $limit = getTextLang(60,45);
                                                    ?>
                                                    <?php echo excerpt(get_the_excerpt(),$limit); ?>
                                                </div>
                                                <div class="see-detail">
                                                    <?php $see_detail_title = getTextLang('Xem chi tiết', 'See Detail'); ?>
                                                    <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title; ?>"><?php echo $see_detail_title; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            <?php
                            endif;
                            ?>
                            <?php
                            // other child
                            if($key == 1)
                                echo '<div class="col-lg-6 col-md-6 col-sm-12 other-child">';
                            ?>
                            <?php
                            if($key != 0):
                            ?>
                                <div class=" bolg-post--box blog-post--box-<?php echo $key;?>">
                                    <div class="col-image">
                                        <div class="date">
                                                <?php echo get_the_date( 'd/m',$post->ID )?>
                                            </div>
                                        <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title; ?>">
                                            <img src="<?php echo get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_IMAGES.'/noimage.png';?>" alt="image-post">
                                        </a>
                                    </div>
                                    <div class="blog-post--content">
                                        <div class="cont">
                                            <h3 class="title-h3">
                                                <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title; ?>"><?php echo excerpt($post->post_title, 15, '...'); ?></a>
                                            </h3>
                                            <div class="see-detail">
                                                    <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title; ?>"><?php echo getTextLang('Xem chi tiết', 'See Detail'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            <?php
                            endif;
                            if($key == count($posts)-1)
                                echo '</div>';
                        }
                    ?>
                </div>
                <div class="sec-news--see-more">
                    <a href="<?php echo get_field('link_see_more_news',$id)?get_field('link_see_more_news',$id)['url']:"#"; ?>" target="_blank"><?php echo get_field('link_see_more_news',$id)?get_field('link_see_more_news',$id)['title']:"Xem Thêm"; ?></a>
                </div>
            </div>
        </section>
    <?php endif; ?>

</main>
<?php get_footer();?>