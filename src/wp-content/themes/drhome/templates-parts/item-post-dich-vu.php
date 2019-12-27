<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
    <div class="tab-service--box">
        <?php
        $thumb = get_the_post_thumbnail_url($post->ID)?get_the_post_thumbnail_url($post->ID):THEME_URI.'/images/default/noimage_333x333.png';
        ?>
        <div class="tab-service--box--thumb">
            <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title; ?>">
                <img src="<?php echo $thumb; ?>" alt="<?php echo $post->post_title; ?>">
            </a>
        </div>
        <div class="tab-service--box--content">
            <h3 class="tab-service--box--title">
                <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a>
                
            </h3>
            <a href="<?php echo get_permalink($term->term_id) ?>" target="_blank" title="<?php echo $post->post_title; ?>"><div class="tab-service--box--readmore">+</div></a>
        </div>
    </div>
</div>