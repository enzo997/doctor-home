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
<!-- <section class="request" style="background-image: url('<?//php echo $bg['url']; ?>')">
    <div class="container">
        <?php //echo acf_render('<h3>','</h3>',$title); ?>
        <?php //$link='<a class="btn-request" href="'.$button_link.'">'; echo acf_render($link,'</a>',$button_text); ?>
    </div>
</section>
<div class="bg-black"></div> -->
<section class = "sec-information-footer">
    <div class="container">
        <?php 
                $address=get_field('address','option');
                $number_phone_one=get_field('number_phone','option');
                $number_phone_two=get_field('numberphone_two','option');
                $number_phone_mobile_two=get_field('number_phone_mobile_two','options');
                $email_group=get_field('email_group','options');
        ?>
        <?php if($address || $number_phone_one || $number_phone_two || $email_group): ?>
        <div class="content-information">
            <div class="col-cont col-address">
                <div class="icon-address"><i class="fas fa-map-marker-alt"></i></div>
                <?php if($address):?>
                    <div class="address">
                        <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                            <h4 class= "content-information--title">ĐỊA CHỈ</h4>
                        <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                            <h4 class= "content-information--title">ADDRESS</h4>
                        <?php endif; ?>
                        <?php echo $address; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-cont col-phone-number">
                <div class="icon-phone"><i class="fas fa-mobile-alt"></i></div>
                <div class="col-group">
                    <?php if($number_phone_two):?>
                        <div class="phone_mobile">
                            <?php if(ICL_LANGUAGE_CODE=='vi'): ?>
                                <h4 class= "content-information--title">ĐIỆN THOẠI</h4>
                            <?php elseif(ICL_LANGUAGE_CODE=='en'): ?>
                                <h4 class= "content-information--title">PHONE NUMBER</h4>
                            <?php endif; ?>
                            <a href="tel:<?php echo str_replace(' ','',$number_phone_two);?>">
                                <?php echo $number_phone_two; ?>
                            </a>
                            <?php if($number_phone_mobile_two):?>- <a href="tel:<?php echo str_replace(' ','',$number_phone_mobile_two);?>"><?php echo $number_phone_mobile_two; ?></a><?php endif;?>
                        </div>
                        <?php endif; ?>
                        <?php if($number_phone_one):?>
                        <div class="phone_number">
                            <a href="tel:<?php echo str_replace(' ','',$number_phone_one); ?>"><?php echo $number_phone_one; ?></a>
                        </div>
                    <?php endif; ?>
                </div> 
            </div>
            <div class="col-cont col-email"> 
                <div class="icon-email"><i class="far fa-envelope"></i></div>
                <?php if($email_group):?>
                    <div class="email">
                        <h4 class= "content-information--title">EMAIL</h4>
                        <?php 
                        foreach($email_group as $i=>$item):
                            $i++;
                            $email = $item['email'];
                            ?>
                            <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a><br/>
                        <?php   
                        endforeach;?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<footer id="footer" class="footer" role="contentinfo">
    <div class="container">
        <?php
            $title_information=get_field('title_information','options');
            $logo_footer=get_field('logo_footer','options');
            $title_form_footer=get_field('title_form_footer','options');
            $form_footer=get_field('footer _form','options');
            $form_footer_en=get_field('footer _form_en','options');
        ?>
        <div class="content-footer">
            <div class="row">
                <?php if($logo_footer): ?>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 content-logo">
                    <div class="cont-image-logo">
                    <a href="<?php echo get_home_url();?>"><img src="<?php echo get_field('logo_footer','options')?get_field('logo_footer','options')['url']:THEME_IMAGES.'/noimgage.png';?>" alt="<?php echo $logo_footer['alt'];?>"></a>
                    </div>
                    <div class="col-content-title">
                        <?php echo acf_render('<h4>','</h4>',$title_information); ?>
                    </div>
                    <?php	
                        $GroupHastag= get_field('group_hastag','options');
                        $i = 0;
                        foreach($GroupHastag as $item):
                            $i++;
                            $groupcont =$item['group_cont'];
                            ?><div class="cont-hastag-group"><?php
                            foreach($groupcont  as $ii=>$small_item):
                                $ii++;
                                $nameHastag = $small_item['name_hastag']?$small_item['name_hastag']:"";
                                $linkHastag = $small_item['link_hastag']? $small_item['link_hastag']:"#";
                                ?>
                                <a href="<?php echo $linkHastag; ?>" class="hastag" target="_blank">#<?php echo $nameHastag;?></a>
                                <?php
                                endforeach; ?>   
                            </div>
                        <?php
                        endforeach;
                    ?>
                </div>
                <?php endif; ?>
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 service-footer">
                    <?php 
                        $nav_service = get_field('nav_service', 'option');
                        $nav_service_title = $nav_service['title']?$nav_service['title']:getTextLang('Dịch vụ', 'Service');
                    ?>

                    <h4><?php echo $nav_service_title; ?></h4>

                    <?php 

                    if($nav_service['select'] !== 1){
                        $terms = get_terms(
                            [
                                'taxonomy' => 'danh-muc-dich-vu',
                                'orderby'  => 'date',
                                'order'    => 'DESC',
                                'number'   => 5,
                                'hide_empty' => false,
                            ]
                        );
                    }
                    else {
                        $terms = $nav_service['service_list'];
                    }     
                    
                    // var_dump($terms);
                    ?>
                    <?php                                          
                        if ($terms){
                            echo '<ul>';
                            foreach($terms as $term){
                                ?>
                                    <li><a href="<?php echo get_term_link($term->term_id); ?>"><?php echo $term->name; ?></a></li>
                                <?php
                            }
                            echo '</ul>';
                        }
                    ?>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 map-footer">
                    <div class="cont-map">
                        
                        <?php 
                            $location = get_field('address_google_map', 'option');
                            $lat = $location['lat']?$location['lat']:'10.778226';
                            $lng = $location['lng']?$location['lng']:'106.6772474';
                            ?>
                            <div class="acf-map">
                                <div class="marker" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lng; ?>"></div>
                            </div>

                        <style type="text/css">
                            .acf-map { width: 100%;height: 350px; height: 100%;}
                            .acf-map .gmnoprint,
                            .acf-map .gm-style-cc,
                            .acf-map .gm-bundled-control{ display:none;}
                            .acf-map img {max-width: inherit !important; }
                        </style>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right">
            <div class="content-copy">
                <div class="row">
                    <div class="col-lg-6 col-12 cont-left">
                        <h4>Copyright 2019 © <span class="your-company">Doctor Home</span><span class="creative">. Creative by</span>
                        <a href="https://namtech.com.au/" target="_blank">Namtech</a></h4>
                    </div>
                    <div class="col-lg-6  col-12 social pull-right">
                        <?php
                            $args = array(
                                'post_type'=> 'social-network',
                                'post_status' => 'publish',
                                'posts_per_page'=> 9,
                                'orderby'    => 'id',                       
                                'order' => 'ASC',
                                'paged'=>$paged,
                            );
                        $Social_network = get_posts($args);
                        // var_dump($Social_network);
                        foreach($Social_network as $social_networks):
                            ?>
                            <div class="social_menu">
                                <a href="<?php echo get_field('link',$social_networks)?get_field('link',$social_networks):"";?>"  target= "_blank">
                                    <?php echo get_field('icon',$social_networks)?get_field('icon',$social_networks):""?>
                                </a>
                            </div>    
                        <?php
                        endforeach;
                        ?>
                    </div>
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


    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQOP6Gz_91tuEODCHY2Y2IJXyjf18CTiA"></script>


</body>
</html>




