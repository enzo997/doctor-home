<?php
    $thumb = get_field('image', $term)['url'] ? get_field('image', $term)['url'] : THEME_URI.'/images/default/noimage_333x333.png';
?>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="tab-service--box tab-service--box--<?php echo $term->term_id; ?>">
        <div class="tab-service--box--thumb">
            <a href="<?php echo  get_term_link($term->term_id); ?>" target="_blank" title="<?php echo $term->name; ?>">
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