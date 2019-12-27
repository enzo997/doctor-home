<?php 
$image = get_field('home_page_icon', $post->ID) ? get_field('home_page_icon', $post->ID)['url'] : THEME_IMAGES.'/noimage.png';
?>
<div class="col-lg-4 col-md-4 col-sm-12 list-sec-cateroy-services">
    <div class="text-content">
        <div class="text-content--image">
            <a href="<?php echo get_permalink( $post->ID ); ?>" target="_blank"><img src="<?php echo $image; ?>" alt="<?php echo $post->post_title; ?>"></a>
        </div>
        <div class="group-content">
            <a href="<?php echo get_permalink($term->term_id); ?>" target="_blank" title="<?php echo $post->post_title; ?>"><h4 class="h4-title"><?php echo $post->post_title; ?></h4></a>
            <div class="description"><?php echo get_the_excerpt(); ?></div>
        </div>
    </div>
</div>