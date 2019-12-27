<?php
    // wp_redirect(get_page_link(12).'/#'.get_query_var('danh-muc-dich-vu'));die();
    get_header();
    $post = get_queried_object();
    $page_id_vi = get_page_by_path( 'dich_vu', OBJECT, 'page' )->ID;
    $page_id_en = get_page_by_path( 'services', OBJECT, 'page' )->ID;
    $data_page_id = getTextLang($page_id_vi, $page_id_en);
?>

<div class="main tax-dich-vu--page">

    <?php echo do_action('get_banner_new', $data_page_id); ?>

    <section class="section sec-tax-content tab-service--new">
        <div class="container">
            <div class="sec-tax-content--header tab-service--header">
                <h2 class="sec-tax-content--title tab-service--title"><?php echo $post->name; ?></h2>
                <div class="sec-tax-content--description tab-service--description"><?php echo $post->description; ?></div>
            </div>
            <div id="" class="sec-tax-content--list">
                <div class="row" id="tax-load--post-list" data-term="<?php echo $post->term_id; ?>">
                    <?php 
                        
                        $page =  get_query_var('paged')?get_query_var('paged'):1;
                        $posts_per_page = 1;
                        $args = array(
                            'post_type'=> 'dich-vu',
                            'orderby'    => 'date',
                            'post_status' => 'publish',
                            "posts_per_page" => $posts_per_page,
                            'order'    => 'DESC',
                            "paged"=>$page,
                            'tax_query' => array( 
                                array(
                                    'taxonomy' => $post->taxonomy,
                                    'field' => 'term_id',
                                    'terms' => $post->term_id,
                                )
                            ),
                        );
                        $arrs = get_posts($args);
                        // var_dump($arrs);
                        if(!empty($arrs)){
                            foreach ($arrs as $post) {
                                // require THEME_PATH.'/templates-parts/item-dich-vu.php';
                            }
                        } else{
                            ?>
                            <div class="empty_pd">
                                <h4><?php echo getTextLang("Không có dịch vụ", 'No services');?></h4>
                            </div>
                            <?php
                        }
                        $args['posts_per_page'] = -1;
                        $post_cout = count(get_posts($args));
                        $total_page=get_num_page($post_cout,$posts_per_page);
                        paging('',5,$total_page,$page,$posts_per_page,'admin');
                        ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>


