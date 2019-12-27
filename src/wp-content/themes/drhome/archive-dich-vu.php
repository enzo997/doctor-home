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

// $page_id_vi = get_page_by_path( 'dich_vu', OBJECT, 'page' )->ID;
// $page_id_en = get_page_by_path( 'services', OBJECT, 'page' )->ID;
$data_page_id = getTextLang(12, 2366);

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
                    if(!empty($terms)){
                        foreach ($terms as $term) :?>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="tab-service--box">
                                    <?php
                                    // Sử dụng field acf
                                    $thumb = get_field('image', $term)['url'] ? get_field('image', $term)['url'] : THEME_URI.'/images/default/noimage_333x333.png';
                                    ?>
                                    <div class="tab-service--box--thumb">
                                        <a href="<?php echo  get_term_link($term->term_id); ?>" target="_blank" title="<?php echo $term->name; ?>"><!-- change 31/10 -->
                                            <img src="<?php echo $thumb; ?>" alt="<?php echo $term->name ?>">
                                        </a>
                                    </div>
                                    <div class="tab-service--box--content">
                                        <h3 class="tab-service--box--title">
                                            <a href="<?php echo get_term_link($term->term_id) ?>" target="_blank" title="<?php echo $term->name; ?>"><?php echo $term->name ?></a>
                                        </h3>
                                        <a href="<?php echo get_term_link($term->term_id) ?>" target="_blank" title="<?php echo $term->name; ?>"><div class="tab-service--box--readmore">+</div></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ; 
                    } else{
                        ?>
                        <div class="empty_pd">
                            <h4><?php echo getTextLang("Không có dịch vụ", 'No services');?></h4>
                        </div>
                        <?php
                    }?>
                    <?php paging('',5,$total_page,$page,$terms_per_page,'admin'); ?>
                </div>
            </div>
        </div>
    </section>

</div>
<?php get_footer(); ?>