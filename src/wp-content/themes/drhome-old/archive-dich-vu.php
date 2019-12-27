<?php
get_header();
$page = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;
$terms_per_page = 6;
$taxonomy   = 'danh-muc-dich-vu';
$term_count = count(arrs_all_cat($taxonomy));
$offset = ( $terms_per_page * $page ) - $terms_per_page;
$terms = get_terms(
    [
        'taxonomy' => $taxonomy,
        'orderby'  => 'date',
        'order'    => 'DESC',
        'number'   => $terms_per_page,
        'offset'   => $offset,
        'hide_empty' => false,
    ]
);
$total_page=get_num_page($term_count,$terms_per_page);

$page_id_vi = get_page_by_path( 'dich_vu', OBJECT, 'page' )->ID;
$page_id_en = get_page_by_path( 'services', OBJECT, 'page' )->ID;
$data_page_id = getTextLang($page_id_vi, $page_id_en);

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
                <div id="load_term_sv" class="row">
                    <?php
                    if($terms){
                        foreach ($terms as $post) {
                            echo do_action('item_dich_vu', $post);
                        }
                    } else{
                        ?>
                        <div class="empty_pd">
                            <h4><?php echo getTextLang("Không có dịch vụ", 'No services');?></h4>
                        </div>
                        <?php
                    }
                    ?>
                    <?php paging('',5,$total_page,$page,$terms_per_page,'admin'); ?>
                </div>
            </div>
        </div>
    </section>

</div>
<?php get_footer(); ?>