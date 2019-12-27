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
        <?php $link='<a class="btn-request" href="'.$button_link.'">'; echo acf_render($link,'</a>',$button_text); ?>
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
            $form_footer_en=get_field('footer _form_en','options');
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
                            <a href="tel:<?php echo str_replace(' ','',$number_phone_two);?>">
                                <img src="<?php echo THEME_IMAGES?>/phone-1.svg"><?php echo $number_phone_two; ?>
                            </a>
                            <?php if($number_phone_mobile_two):?>- <a href="tel:<?php echo str_replace(' ','',$number_phone_mobile_two);?>"><?php echo $number_phone_mobile_two; ?></a><?php endif;?>
                        </li>
                        <?php endif; ?>

                        <?php if($number_phone_one):?>
                        <li class="phone_number">
                            <a href="tel:<?php echo str_replace(' ','',$number_phone_one); ?>"><img src="<?php echo THEME_IMAGES?>/icon-phone-header.svg"><?php echo $number_phone_one; ?></a>
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
                    <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                        <h4><?php echo get_the_title('12');?></h4>
                    <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                        <h4><?php echo get_the_title('2366');?></h4>
                    <?php endif; ?>

                    <?php
                    $args = array(
                        'posts_per_page'   => 5,
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
                    <?php endif; wp_reset_query(); ?>
                </div>
                <?php if($form_footer || $form_footer_en): ?>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <?php echo acf_render('<h4>','</h4>',$title_form_footer); ?>
                    <div class="form-footer">
                        <?php //echo do_shortcode($form_footer); ?>
                        <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                            <?php echo do_shortcode($form_footer);?>
                        <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                            <?php echo do_shortcode($form_footer_en);?>
                        <?php endif; ?>
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
<!-- Start of Async Drift Code -->
    <script>
        "use strict";

        !function() {
        var t = window.driftt = window.drift = window.driftt || [];
        if (!t.init) {
        if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
        t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ],
        t.factory = function(e) {
            return function() {
            var n = Array.prototype.slice.call(arguments);
            return n.unshift(e), t.push, t;
            };
        }, t.methods.forEach(function(e) {
            t[e] = t.factory(e);
        }), t.load = function(t) {
            var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
            o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
            var i = document.getElementsByTagName("script")[0];
            i.parentNode.insertBefore(o, i);
        };
        }
        }();
        drift.SNIPPET_VERSION = '0.3.1';
        drift.load('npm226z274wk');
    </script>
<!-- End of Async Drift Code -->
    <script>
        setTimeout(function(){
            document.addEventListener( 'wpcf7mailsent', function( event ) {
                if ( 4 == event.detail.contactFormId || 11 == event.detail.contactFormId) {
                    window.location="<?php echo get_page_link(240); ?>";
                }
            }, false );
        }, 5000);
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130552676-1"></script>
    <script>
        setTimeout(function(){
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-130552676-1');
        }, 3000);
    </script>

    <!-- Load Facebook SDK for JavaScript -->
    <!-- <div id="fb-root"></div> -->
    <!-- <script>
        setTimeout(function(){
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        }, 5000);
    </script> -->

    <!-- Your customer chat code -->
    <!-- <div class="fb-customerchat"
    attribution=setup_tool
    page_id="185167292332403"
    logged_in_greeting="Dr Home s&#7861;n s&#224;ng ph&#7909;c v&#7909;. Hotline: 0901 172 859"
    logged_out_greeting="Dr Home s&#7861;n s&#224;ng ph&#7909;c v&#7909;. Hotline: 0901 172 859">
    </div> -->

<?php wp_footer(); 
$phone=get_field('hotline','options');
?>
    <div id="hotline" class="d-md-none d-block">
        <a href="tel:<?php echo str_replace(' ','',$phone); ?>" title="hotline">
            <div id="phone"><span>&nbsp;</span>
            <h3><?php echo $phone;?></h3>
            </div>
        </a>
    </div>

</body>
</html>