<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<?php $bg=get_field('background_before_footer','options');
    $title=get_field('title_banner_before_footer','options');
    $button_text=get_field('button_text_before_footer','options');
    $button_link=get_field('button_link_before_footer','options');
?>
<section class="request" style="background-image: url('<?php echo $bg['url']; ?>')">
    <div class="container">
        <?php echo acf_render('<h3>','</h3>',$title); ?>
        <?php $link='<a href="'.$button_link.'">'; echo acf_render($link,'</a>',$button_text); ?>
    </div>
</section>
<div class="bg-black"></div>
<footer id="footer" class="footer" role="contentinfo">
    <div class="container">
        <?php
            $logo_footer=get_field('logo_footer','options');
            $title_information=get_field('title_information','options');
            $address=get_field('address','option');
            $number_phone_one=get_field('number_phone','option');
            $number_phone_two=get_field('numberphone_two','option');
            $number_phone_mobile_two=get_field('number_phone_mobile_two','options');
            $email=get_field('email','options');
            $title_form_footer=get_field('title_form_footer','options');
            $form_footer=get_field('footer _form','options');
        ?>
        <div class="content-footer">
            <div class="row">
                <?php if($logo_footer): ?>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <a href="<?php echo get_home_url();?>"><img src="<?php echo $logo_footer['url'];?>" alt="<?php echo $logo_footer['alt'];?>"></a>
                </div>
                <?php endif; ?>

                <?php if($address || $number_phone_one || $number_phone_two || $email): ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 contact">
                    <?php echo acf_render('<h4>','</h4>',$title_information); ?>
                    <ul>
                        <?php if($address):?>
                        <li class="address">
                            <img src="<?php echo THEME_IMAGES?>/building.svg"><?php echo $address; ?>
                        </li>
                        <?php endif; ?>

                        <?php if($number_phone_two):?>
                        <li class="phone_mobile">
                            <a href="tel:+<?php echo str_replace(' ','',$number_phone_two);?>">
                                <img src="<?php echo THEME_IMAGES?>/phone-1.svg"><?php echo $number_phone_two; ?>
                            </a>
                            <?php if($number_phone_mobile_two):?>- <a href="tel:+<?php echo str_replace(' ','',$number_phone_mobile_two);?>"><?php echo $number_phone_mobile_two; ?></a><?php endif;?>
                        </li>
                        <?php endif; ?>

                        <?php if($number_phone_one):?>
                        <li class="phone_number">
                            <a href="tel:+<?php echo str_replace(' ','',$number_phone_one); ?>"><img src="<?php echo THEME_IMAGES?>/icon-phone-header.svg"><?php echo $number_phone_one; ?></a>
                        </li>
                        <?php endif; ?>

                        <?php if($email):?>
                        <li>
                            <a href="mailto:<?php echo $email; ?>"><img src="<?php echo THEME_IMAGES?>/email.svg"><?php echo $email; ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php
                    $terms = get_terms( array(
                        'taxonomy' => 'danh-muc-dich-vu',
                        'hide_empty' => false,
                        'orderby ' => 'id',
                    ));
                ?>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 service-footer">
                    <h4><?php echo get_the_title(12); ?></h4>
                    <!--<ul>
                        <?php /*foreach ($terms as $category):
                            $link_term = get_category_link($category->term_id);
                        */?>
                        <li>
                            <a href="<?php /*echo get_page_link(12);*/?>/#<?php /*echo $category->slug; */?>"><?php /*echo $category->name; */?></a>
                        </li>
                        <?php /*endforeach;*/?>
                    </ul>-->
                    <?php
                    $args = array(
                        'posts_per_page'   => 3,
                        'orderby'          => 'date',
                        'order'            => 'DESC',
                        'post_type'        => 'dich-vu',
                        'post_status'      => 'publish',
                    );
                    $query=new WP_Query($args);
                    if($query->have_posts()):
                    ?>
                    <ul>
                    <?php while ($query->have_posts()):$query->the_post(); ?>
                        <li><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile;?>
                    </ul>
                </div>
                <?php if($form_footer): ?>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <?php echo acf_render('<h4>','</h4>',$title_form_footer); ?>
                    <div class="form-footer">
                        <?php echo do_shortcode($form_footer); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="copy-right">
            <div class="content-copy">
                <?php $copy_right=get_field('copy_right','options');
                if($copy_right){?>
                <h4><?php echo $copy_right;?></h4>
                <?php } ?>
                <div class="social pull-right">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'social_menu',
                        'menu_class'     => 'social_menu',
                    ) );
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<script>
    document.addEventListener( 'wpcf7mailsent', function( event ) {
        if ( 4 == event.detail.contactFormId || 11 == event.detail.contactFormId) {
            window.location="<?php echo get_page_link(240); ?>";
        }
    }, false );
</script>
<?php wp_footer(); ?>
</body>
</html>