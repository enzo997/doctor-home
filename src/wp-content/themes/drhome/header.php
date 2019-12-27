<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="RViv3rd_4QoeiYkKxtJ_Rl_iQHOWA4xRvizJbG1YhnQ" />
    <!-- <meta name="google-site-verification" content="2NKj42sTlh7H9iG-IjN5092mD5WQo8_5VSQ6qG1xAUE" /> -->
    <meta name="google-site-verification" content="HCx7-BkgSlKs-OYNDiPMyntTtVlUoA51kEHk1nQFaWo" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap" rel="stylesheet">
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<header id = "header" class="header">
    <section class="top-header">
        <div class="container">
            <?php 
                $logo = get_field('logo', 'options');
                $phone = get_field('number_phone', 'options');
                $email_group = get_field('email_group', 'options');
                $button_text_header = get_field('button_text_header', 'options')?get_field('button_text_header', 'options'):"text-none";
            ?>
            <!-- logo mobile -->
            <?php //if($logo): ?>
            <!-- <div class="logo">
                <a href="<?php //echo get_home_url(); ?>">
                    <img src="<?php //echo $logo['url'];?>" alt="<?php //echo $logo['alt'];?>">
                </a>
            </div> -->
            <?php //endif; ?>
            <!-- ###logo mobile -->
            <?php if( $phone || $email_group ):""?>
                <ul class="nav navbar-nav pull-right social-header">
                    <?php if($phone):?>
                        <li class="phone">
                            <a href="tel:<?php echo str_replace(' ','',$phone); ?>">
                                <img src="<?php echo THEME_IMAGES?>/icon-phone-header.svg" alt="icon-phone"><?php echo $phone;?>
                            </a>
                        </li>
                    <?php endif;?>
                    <?php if($email_group):?>
                        <li class="email">
                            <?php foreach($email_group as $i=>$item):
                                $i++;
                                $email = $item['email'];
                                if ($i==1){
                                ?>
                                    <a href="mailto:<?php echo $email; ?>"> <i class="fa fa-envelope"></i><?php echo $email; ?></a><br/>
                                <?php   }
                            endforeach;     
                            ?>
                        </li>
                    <?php endif;?> 
                    <div class="col-right col-contact-mobile">
                        <?php $button_link=get_field('button_link_header','options');?>
                        <?php if($button_link):?>
                            <a href="<?php echo $button_link;?>" target="_blank" class="btn-style btn-style--top"><?php echo $button_text_header; ?></a>
                        <?php endif;?>
                    </div>
                </ul>
            <?php endif;?>
            <!-- icon-social network use relationship frome footer -->
            <?php if(!empty($icon = get_field('social_link','option'))) { ?>
                <div class="icon-social-network">
                    <?php 
                    foreach($icon as $social_networks_header):
                        ?>
                        <div class="cont-icon">
                            <a href="<?php echo get_field('link',$social_networks_header)?get_field('link',$social_networks_header):"";?>" target= "_blank">
                                <?php echo get_field('icon',$social_networks_header)?get_field('icon',$social_networks_header):""?>
                            </a>
                        </div>    
                    <?php
                    endforeach;
                    ?>
                </div>
            <?php } ?>
            <!-- ################## -->
            <div class="icon-menu">
                <h4>Menu</h4>
                <!-- icon-menu-mobile -->
                <img src="<?php echo THEME_IMAGES; ?>/menu.svg">
            </div>
        </div>
    </section>
    <section class="navbar navbar-default header_aera main-header">
        <div class="container">
            <!-- content-group -->
            <div class="col-content col-content-active">
                <div class="col-left">
                    <div class="btn-close">
                        <i class="fas fa-window-close"></i>
                    </div>
                    <?php //$logo=get_field('logo','options');?>
                    <div class="logo cont-logo">
                        <a href="<?php echo get_home_url(); ?>">
                            <div class="cont-img">
                                <img src="<?php echo get_field('logo','options')?get_field('logo','options')['url']:THEME_IMAGES.'/noimage.png';?>" alt="<?php echo $logo['alt'];?>">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="group-col-right">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'main-menu',
                        'menu_class'     => 'nav navbar-nav main_menu pull-right',
                    ) );
                    language_selector_flags();
                    ?>
                    <div class="cont-active-contac">
                        <?php if($phone):?>
                            <li class="phone-active-menu">
                                <a href="tel:<?php echo str_replace(' ','',$phone); ?>">
                                    <img src="<?php echo THEME_IMAGES?>/icon-phone-header.svg" alt="icon-phone"><?php echo $phone;?>
                                </a>
                            </li>
                        <?php endif;?>
                        <?php if($email_group):?>
                            <li class="email-active-menu">
                                <?php foreach($email_group as $i=>$item):
                                    $i++;
                                    $email = $item['email'];
                                    if ($i==1){
                                    ?>
                                        <a href="mailto:<?php echo $email; ?>"> <i class="fa fa-envelope"></i><?php echo $email; ?></a><br/>
                                    <?php   }
                                endforeach;     
                                ?>
                            </li>
                        <?php endif;?> 
                    </div>
                    <div class="icon-social-network-active-menu">
                        <?php $icon = get_field('social_link','option');
                        foreach($icon as $social_networks_header):
                            ?>
                            <div class="cont-icon">
                                <a href="<?php echo get_field('link',$social_networks_header)?get_field('link',$social_networks_header):"";?>">
                                    <?php echo get_field('icon',$social_networks_header)?get_field('icon',$social_networks_header):""?>
                                </a>
                            </div>    
                        <?php
                        endforeach;
                        ?>
                    </div>
                    <div class="col-right">
                    <?php $button_link=get_field('button_link_header','options');?>
                        <?php if($button_link):?>
                            <a href="<?php echo $button_link;?>" class="btn-style btn-style--top"><?php echo $button_text_header; ?></a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <!-- content-group -->
        </div>
    </section>
</header>
<header class="header-mobile">
    <div class="container">
        <div class="header-mobile--content">
            <div class="logo">
                <a href="<?php echo get_home_url(); ?>">
                    <div class="cont-img">
                        <img src="<?php echo get_field('logo','options')?get_field('logo','options')['url']:THEME_IMAGES.'/noimage.png';?>" alt="<?php echo $logo['alt'];?>">
                    </div>
                </a>
            </div>
            <div class="icon-menu">
                <h4>Menu</h4>
                <img src="<?php echo THEME_IMAGES; ?>/menu.svg">
            </div>
        </div>
    </div>
</header>
<!-- active post type page -->
<?php 
$post_type = get_post_type();
if($post_type !=='page'){ ?>
    <script type="text/javascript"> 
        jQuery('.header .navbar-nav > li.<?php echo $post_type; ?>').addClass('current_page_item');
    </script>
<?php } ?>
<div class="bg-black"></div>
