<?php
add_action('item_dich_vu', 'item_dich_vu');
function item_dich_vu($post){
    if (is_tax()){
        $thumb = get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_URI.'/images/default/noimage_333x333.png';
        $link = get_permalink($post->ID);
        $title = $post->post_title;
    } else {
        $thumb = get_field('image', $post->term_id)['url'] ? get_field('image', $post->term_id)['url'] : THEME_URI.'/images/default/noimage_333x333.png';
        $link = get_term_link($post->term_id);
        $title = $post->name;
    }

    ?>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="tab-service--box">
            <div class="tab-service--box--thumb">
                <a href="<?php echo $link; ?>" title="<?php echo $title; ?>">
                    <img src="<?php echo $thumb; ?>" alt="<?php echo $title; ?>">
                </a>
            </div>
            <div class="tab-service--box--content">
                <h3 class="tab-service--box--title">
                    <a href="<?php echo $link; ?>"><?php echo $title; ?></a>

                </h3>
                <a href="<?php echo $link; ?>"><div class="tab-service--box--readmore">+</div></a>
            </div>
        </div>
    </div>
<?php
}