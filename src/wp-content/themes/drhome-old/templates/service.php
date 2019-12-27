<?php
//* Template Name: Dịch vụ
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
                            // require THEME_PATH.'/templates-parts/item-dich-vu.php';
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