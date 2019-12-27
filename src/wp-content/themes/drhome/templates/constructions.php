<?php
//* Template Name: Công trình

    get_header();
    // global $post;
    $data_page_id = get_the_ID();
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
                    
                    <?php
                        $page = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;
                        $posts_per_page = 6;
                        $args = array(
                            'post_type' => 'cong_trinh',
                            'orderby'  => 'date',
                            'order'    => 'DESC',
                            'posts_per_page' => $posts_per_page,
                            'paged'=>$page,
                            'post_status' => 'publish',
                            'suppress_filters' => 'false',
                        );              
                        $lang_posts = new WP_Query($args);
                        $posts_list = $lang_posts->posts;
                        if(!empty($posts_list)){
                            foreach ($posts_list as $post) 
                                require THEME_PATH.'/templates-parts/item-cong-trinh.php';
                        }else{
                            ?>
                            <div class="empty_pd">
                                <h4><?php echo getTextLang("Không có công trình nào", 'No constructions');?></h4>
                            </div>
                            <?php
                        }
                                           
                        $args['posts_per_page']=-1;
                        $total = count(get_posts($args));
                        $total_page=get_num_page($total,$posts_per_page);
                        paging('',5,$total_page,$page,$posts_per_page,'admin');
                        ?>
                </div>
            </div>
        </div>
    </section>

</div>
<?php get_footer(); ?>