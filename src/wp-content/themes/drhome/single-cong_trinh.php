<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); 
// $page_id_vi = get_page_by_path( 'cong-trinh', OBJECT, 'page' )->ID;
// $page_id_eb = get_page_by_path( 'constructions', OBJECT, 'page' )->ID;
$data_page_id = getTextLang(3907, 3912);
global $post;
?>
<div class="main">

    <?php echo do_action('get_banner_new', $data_page_id); ?>

    <section class="section sec-post-detaile">
        <div class="container">
            <div class="row">
                <!-- <div class="col-lg-9 col-md-7 col-sm-12"> -->
                    <div class="sec-post-detail--content">
                        <div class="sec-post-detail--content--header">
                            <h3 class="sec-post-detail--content--title"><?php echo $post->post_title; ?></h3>
                            <div class="sec-post-detail--content--infor">
                                <div class="sec-post-detail--content--author"><img src="<?php echo THEME_URI; ?>/images/icon/icon-user.svg" alt="icon-user"><?php echo get_the_author(); ?></div>
                                <div class="sec-post-detail--content--time"><img src="<?php echo THEME_URI; ?>/images/icon/icon-calendar.svg" alt="icon-calendar"> <?php echo get_the_date('M d,Y'); ?></div>
                            </div>
                        </div>
                        <div class="sec-post-detail--content--body">
                            <?php //echo $post->post_content; ?>
                        
                            <?php 
                            if (have_posts()) : 
                                while (have_posts()) : the_post();
                                    if(!empty(get_the_content()))
                                        the_content(); 
                                endwhile;
                            endif; ?>
                            <!-- Add hasg tags  -->
                            <?php //if(!empty($tags = get_the_tags($post->ID))): ?>
                                <!-- <div class="post-hash-tags">
                                    <ul>
                                        <?php   
                                            // foreach($tags as $tag){
                                            //     echo '<li class="post-hash-tags--name"><a href="'.get_tag_link($tag->term_id).'">#'.$tag->name.'</a></li>';
                                            // }
                                        ?>
                                    </ul>                                
                                </div> -->
                            <?php //endif; ?>

                            <?php if(!empty($tags = get_field('hash_tags'))): ?>
                                <div class="post-hash-tags">
                                    <ul>
                                        <?php   
                                            foreach($tags as $tag){
                                                echo '<li class="post-hash-tags--name"><a href="'.$tag['tag']['url'].'" target="_blank">#'.$tag['tag']['title'].'</a></li>';
                                            }
                                        ?>
                                    </ul>                                
                                </div>
                            <?php endif; ?>
                            <!-- End Add hasg tags  -->
                        </div>
                    </div>
                <!-- </div> -->
                <!-- <div class="col-lg-3 col-md-5 col-sm-12"> -->
                    <div class="sec-post-content--sidebar ">
                        <?php 
                        $categories = get_the_category(get_the_ID());
                        if ($categories){
                            $category_ids = array();
                            foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                            $args=array(
                                'post_type' => 'cong_trinh',
                                'category__in' => $category_ids,
                                'post__not_in' => array(get_the_ID()),
                                'posts_per_page' => 6,
                                'orderby'=>'date',
                                'order'=>'DESC',
                            );
                            // if (get_posts($args) == NULL){
                            //     $args = array(
                            //         'posts_per_page'   => 6,
                            //         'orderby'          => 'date',
                            //         'order'            => 'DESC',
                            //     );
                            // }
                        } else {
                            $args = array(
                                'post_type' => 'cong_trinh',
                                'posts_per_page'   => 6,
                                'orderby'          => 'date',
                                'order'            => 'DESC',
                            );
                        }
                        if ($posts = get_posts($args)){ ?>
                            <div class="sec-post-detail--related-posts">
                                <h3 class="sec-post-content--sidebar-title"><?php echo getTextLang('Bài viết liên quan', 'Related posts' ); ?></h3>
                                <div class="related-posts--list">
                                    <?php                                         
                                        foreach ($posts as $post){
                                            $thum = get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_URI.'/images/default/noimage_123x77.png';
                                            ?>
                                            <article class="related-posts--box">
                                                <div class="related-posts--box--thumb">
                                                    <a href="<?php echo get_permalink($post->ID); ?>" target="_blank">
                                                        <img src="<?php echo $thum; ?>" alt="<?php echo $post->post_title; ?>"  title="<?php echo $post->post_title; ?>">
                                                    </a>
                                                </div> 
                                                <div class="related-posts--box--content">
                                                    <a href="<?php echo get_permalink($post->ID); ?>" target="_blank">
                                                        <h4 class="related-posts--box--title" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></h4> 
                                                    </a>
                                                </div>                           
                                            </article>
                                            <?php
                                        } 
                                    ?>                                    
                                </div>
                            </div>
                        <?php } ?>
                        <?php 
                        $cat = getTextLang('cong-trinh-thuc-te', 'realistic-works');
                        $args = array(
                            'post_type'     =>'cong_trinh',
                            'posts_per_page'   => 6,
                            'orderby'          => 'date',
                            'order'            => 'DESC',
                            'post_status'      => 'publish',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'danh-muc-cong-trinh',
                                    'field' => 'slug',
                                    'terms' => $cat
                                )
                            )
                        );
                        if($posts = get_posts($args)){
                            ?>
                            <div class="sec-post-detail--typical-works">
                                <h3 class="sec-post-content--sidebar-title"><?php echo getTextLang('Công trình tiêu biểu', 'Typical works' ); ?></h3>
                                <div class="typical-works--list">
                                    <div class="row">
                                        <?php foreach($posts as $post){
                                            $thum = get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_URI.'/images/default/noimage_187x153.png';
                                            ?>
                                            <div class="col-sm-6 col-12">
                                                <article class="typical-works--box">
                                                    <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title; ?>">
                                                        <div class="typical-works--box--thumb">
                                                            <img src="<?php echo $thum; ?>" alt="<?php echo $post->post_title; ?>">                                
                                                        </div> 
                                                        <div class="typical-works--box--content">
                                                            <h4 class="typical-works--box--title">  
                                                                <?php echo $post->post_title; ?>                                  
                                                            </h4> 
                                                        </div> 
                                                    </a>                            
                                                </article>
                                            </div>
                                            <?php
                                        } ?>
                                    </div>                                    
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        $form_post = get_field('form_post', 'option');
                        $header_title = $form_post['header']['title']? $form_post['header']['title'] : getTextLang('Gọi ngay', 'Call now' );
                        $header_description = $form_post['header']['description'];
                        $header_phome = $form_post['header']['phone'];
                        $body_title = $form_post['body']['title'];
                        $body_description = $form_post['body']['description'];
                        $body_form = $form_post['body']['form']->ID;
                        ?>
                        <div class="sec-post-detail--contact">
                            <div class="sec-post-detail--contact--content">
                                <div class="sec-post-detail--contact--header">
                                    <h3 class="sec-post-detail--contact--title"><?php echo $header_title; ?></h3>
                                    <div class="sec-post-detail--contact--description"><?php echo $header_description; ?></div> 
                                    <div class="sec-post-detail--contact-hotline">
                                        <img src="<?php echo THEME_URI; ?>/images/icon/icon-call.svg" alt="icon-call">
                                        <ul>
                                            <?php 
                                                if($header_phome){
                                                    foreach($header_phome as $phone){
                                                        $call = str_replace(array('(', ')',' ','.'), '', $phone['number']);
                                                        echo '<li><a href="tel:'.$call.'" title="">'.$phone['number'].'</a></li>';
                                                    }
                                                }
                                            ?>
                                        </ul>
                                    </div>         
                                </div>
                                <div class="sec-post-detail--contact--form">
                                    <h4 class="sec-post-detail--contact--form--title"><?php echo $body_title; ?></h4>
                                    <div class="sec-post-detail--contact--form--description"><?php echo $body_description; ?></div>
                                    <?php echo do_shortcode('[contact-form-7 id="'.$body_form.'"]') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>




