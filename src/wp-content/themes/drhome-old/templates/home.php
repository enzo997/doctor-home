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
                                            <?php if($i==1){
                                                ?><div class="icon-box"><i class="fas fa-building"></i></div><?
                                            }
                                            ?>
                                            <?php if($i==2){
                                                ?><div class="icon-box"><div class="cont-icont"><img src="<?php echo THEME_IMAGES?>/icon-coint.png" alt="ICON"></div></div><?
                                            }
                                            ?>
                                            <?php if($i==3){
                                                ?><div class="icon-box"><i class="fas fa-gavel"></i></div><?
                                            }
                                            ?>
                                            <?php if($i==4){
                                                ?><div class="icon-box"><div class="cont-icont"><img src="<?php echo THEME_IMAGES?>/icon-book.png" alt="ICON"></div></div><?
                                            }
                                            ?>
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
    <section class="sec-our-service">
        <?php $our_services= get_field('our_services',$id);?>
        <?php
        $title_service=get_field('title_service');
        $description_service=get_field('description_service');
        $list_service=get_field('list_service');
        ?>
        <div class="container">
            <!-- <h5 class="title-h5 sec-our-service--title-h5"><?php //echo $our_services['title_h5']?$our_services['title_h5']:"OUR SERVICES";?></h5> -->
            <h4 class="title-h4 sec-our-service--title-h4"><?php echo $our_services['title_h4']?$our_services['title_h4']:"DỊCH VỤ CỦA DR. HOME";?></h4>
            <div class="description sec-our-service--description"><?php echo $our_services['description']?$our_services['description']:"";?></div>     
            <div class="row">
            <?
                    $args=array(
                        'parent'=>get_query_var('cat'),
                        'orderby' => 'id',
                        'order' => 'DESC',
                        'number' => 6,
                    );
                    $terms = get_terms('danh-muc-dich-vu' , $args);
                    if(!empty($terms)){
                        foreach($terms as $term){
                           // echo '<pre>';
                            //    var_dump($term);
                           // echo '</pre>';
                            $image = get_field('image_category_dich_vu',$term)?get_field('image_category_dich_vu',$term)['url']:THEME_IMAGES.'/noimage.png';
                            // var_dump($image);
                            ?>
                                <div class="col-lg-4 col-md-4 col-sm-12 list-sec-cateroy-services">
                                    <div class="text-content">
                                        <div class="text-content--image">
                                            <a href="<?php echo get_term_link($term->term_id); ?>"><img src="<?php echo $image; ?>" alt="<?php echo $term->name; ?>"></a>
                                        </div>
                                        <div class="group-content">
                                            <a href="<?php echo get_term_link($term->term_id); ?>" title="<?php echo $term->name?>"><h4 class="h4-title"><?PHP ECHO $term->name; ?></h4></a>
                                            <div class="description"><?php echo $term->description; ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                ?>
            </div>   
            <div class="sec-our-services--link-see-more">
                <a href="<?php echo $our_services['link_see_more']?$our_services['link_see_more']['url']:"###"; ?>"><?php echo $our_services['link_see_more']?$our_services['link_see_more']['title']:"Xem Thêm"; ?></a>
            </div>  
            
        </div>
    </section>
    <section class="sec-realistic-works">
        <div class="container">
            <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                <h4 class="sec-realistic-works--title-h4"><?php echo get_field('title_realistic_h4',$id)?get_field('title_realistic_h4',$id):"CÔNG TRÌNH THỰC TẾ";?></h4>
            <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                <h4 class="sec-realistic-works--title-h4"><?php echo get_field('title_realistic_h4',$id)?get_field('title_realistic_h4',$id):"REAL WORKS";?></h4>
            <?php endif; ?>      
            
            <div class="row">
            <?
                    $args=array(
                        'post_type'=> 'cong_trinh',
                        'orderby'    => 'date',
                        'order'    => 'DESC',
                        'post_status' => 'publish',
                        "posts_per_page" => 6,
                    );
                    $posts = get_posts($args);
                    if(!empty($posts)){
                        foreach($posts as $post){
                            ?>
                                <div class="list col-lg-4 col-md-4 col-sm-12 col-12 list-sec-cateroy-realistic">
                                    <div class="text-content">
                                        <div class="text-content--image">
                                            <a href="<?php echo get_permalink($post->ID); ?>" class="button"><img src="<?php echo get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_IMAGES.'/noimage.png';?>" alt="image-post"></a>
                                        </div>
                                        <div class="cont-group">
                                            <div class="cont-word">
                                                <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title;?>"><h3 class="h3-title"><?php echo $post->post_title; ?></h3></a>
                                                <div class="description"><?php echo $post->post_excerpt; ?></div>
                                            </div>
                                            <div class="cont-button-plus">
                                            <a href="<?php echo get_permalink($post->ID);  ?>" title="<?php echo $post->post_title;?>"><i class="fas fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                ?>
            </div> 
            <div class="sec-realistic-link">
                <a href="<?php echo get_field('link_see_more_realistic', $id)['url'];?>"><?php echo get_field('link_see_more_realistic', $id)?get_field('link_see_more_realistic', $id)['title']:"Xem Thêm"; ?></a>
            </div>    
        </div>
    </section>
    <section class="sec-news">
        <div class="container">
            <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                <h4 class="sec-news--title-h4"><?php echo get_field('tilte_news_h4',$id)?get_field('tilte_news_h4',$id):"TIN TỨC";?></h4>
            <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                <h4 class="sec-news--title-h4"><?php echo get_field('tilte_news_h4',$id)?get_field('tilte_news_h4',$id):"NEWS";?></h4>
            <?php endif; ?>      
            <div class="row">     
                <?php
                    $args = array(
                        'orderby'    => 'date',
                        'post_status' => 'publish',
                        "posts_per_page" => 4,
                        'order'    => 'DESC',
                        "paged"=>$paged,
                    );
                    $posts = get_posts($args);

                        foreach($posts as $key=>$post){  
                            if ($key==0):
                            ?>
                                <div class="col-lg-6 col-md-6 col-sm-12 first-child">
                                    <div class=" bolg-post--box blog-post--box-<?php echo $key;?>">
                                        <div class="col-image">
                                            <div class="date">
                                                <?php echo get_the_date( 'd/m',$post->ID )?>
                                            </div>
                                            <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>">
                                                <img src="<?php echo get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_IMAGES.'/noimage.png';?>" alt="image-post">
                                            </a>
                                        </div>
                                        <div class="blog-post--content">
                                            <div class="cont">
                                                <h3 class="title-h3">
                                                    <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>"><?php echo excerpt($post->post_title, 7, '...'); ?></a>
                                                </h3>
                                                <div class="description">
                                                    <?php //echo $post->post_excerpt;?><!--change 28/10/2019 -->
                                                    <?php echo excerpt(get_the_excerpt(), 40); ?>
                                                </div>
                                                <div class="see-detail">
                                                    <?php $see_detail_title = getTextLang('Xem chi tiết', 'See Detail'); ?>
                                                    <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>"><?php echo $see_detail_title; ?></a>
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
                                        <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>">
                                            <img src="<?php echo get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_IMAGES.'/noimage.png';?>" alt="image-post">
                                        </a>
                                    </div>
                                    <div class="blog-post--content">
                                        <div class="cont">
                                            <h3 class="title-h3">
                                                <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>"><?php echo excerpt($post->post_title, 7, '...'); ?></a>
                                            </h3>
                                            <div class="see-detail">
                                                <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                                                    <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>">Xem chi tiết</a>
                                                <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                                                    <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>">See Detail</a>
                                                <?php endif; ?>
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
                <a href="<?php echo get_field('link_see_more_news',$id)?get_field('link_see_more_news',$id)['url']:"#"; ?>"><?php echo get_field('link_see_more_news',$id)?get_field('link_see_more_news',$id)['title']:"Xem Thêm"; ?></a>
            </div>
        </div>
    </section>
</main>
<?php get_footer();?>