<?php
    //* Template Name: Liên hệ
    get_header();
?>
    <div class="contact">
        <?php do_action('banner_page_f'); ?>
        <?php
            $img_left=get_field('image_left');
            $title=get_field('title');
            $title_form=get_field('title_form');
            $form_contact=get_field('form_shortcode');
            /*information*/
            $address=get_field('address','option');
            $number_phone_one=get_field('number_phone','option');
            $number_phone_mobile_one=$number_phone_two=get_field('numberphone_two','option');
            $number_phone_mobile_two=get_field('number_phone_mobile_two','options');
            $email=get_field('email','options');
        ?>
        <div class="content-contact">
            <div class="container">
                <div class="row">
                    <?php if($img_left): ?>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                        <img src="<?php echo $img_left['url'];?>" alt="<?php echo $img_left['alt'];?>">
                    </div>
                    <?php endif; ?>

                    <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                        <div class="information-contact">
                            <?php echo acf_render('<h2>','</h2>',$title); ?>

                            <?php if($address || $number_phone_one || $number_phone_two || $email): ?>
                            <ul>
                                <?php if($address):?>
                                <li class="address">
                                    <img src="<?php echo THEME_URI; ?>/images/icon-address.svg" alt="icon-address">
                                    <?php echo $address; ?>
                                </li>
                                <?php endif; ?>

                                <?php if($number_phone_one || $number_phone_two):?>
                                <li class="phone">
                                    <div class="phone-mobile">
                                        <?php if($number_phone_one):?>
                                            <img src="<?php echo THEME_IMAGES?>/phone-1.svg">
                                            <a href="tel:+<?php echo str_replace(' ','',$number_phone_one);?>"><?php echo $number_phone_one; ?></a><?php endif; ?>
                                        <?php if($number_phone_mobile_two):?>- <a href="tel:+<?php echo str_replace(' ','',$number_phone_mobile_two);?>"><?php echo $number_phone_mobile_two; ?></a><?php endif;?>
                                    </div>
                                    <div class="phone-number">
                                        <?php if($number_phone_two):?>
                                            <!--<i class="fa fa-phone" aria-hidden="true"></i>--><img src="<?php echo THEME_IMAGES?>/icon-phone-header.svg" alt="icon-phone">
                                            <a href="tel:+<?php echo str_replace(' ','',$number_phone_two);?>"><?php echo $number_phone_two; ?></a>
                                        <?php endif;?>
                                    </div>

                                </li>
                                <?php endif; ?>

                                <?php if($email):?>
                                <li class="mail">
                                    <i class="far fa-envelope" aria-hidden="true"></i>
                                    <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                                </li>
                                <?php endif;?>
                            </ul>
                            <?php endif; ?>
                        </div>
                        <div class="form-contact">
                            <?php echo acf_render('<div class="title-form"><h3>','</h3></div>',$title_form); ?>
                            <?php echo do_shortcode($form_contact);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>
