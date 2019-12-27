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
    <meta name="google-site-verification" content="2NKj42sTlh7H9iG-IjN5092mD5WQo8_5VSQ6qG1xAUE" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header id = "header" class="header">
    <section class="top-header">
        <div class="container">
            <?php $logo=get_field('logo','options');
            $phone=get_field('number_phone','options');
            $email=get_field('email','options');
            $button_text_header=get_field('button_text_header','options');
            $button_link=get_field('button_link_header','options');
            ?>
            <?php if($logo): ?>
            <div class="logo">
                <a href="<?php echo get_home_url(); ?>">
                    <img src="<?php echo $logo['url'];?>" alt="<?php echo $logo['alt'];?>">
                </a>
            </div>
            <?php endif; ?>

            <?php if($phone || $email ): ?>
            <ul class="nav navbar-nav pull-right social-header">
                <?php if($phone):?>
                <li class="phone">
                    <a href="tel:<?php echo str_replace(' ','',$phone); ?>">
                        <img src="<?php echo THEME_IMAGES?>/icon-phone-header.svg" alt="icon-phone"><?php echo $phone;?>
                    </a>
                </li>
                <?php endif;?>

                <?php if($email):?>
                <li class="email">
                    <a href="mailto:<?php echo $email; ?>">
                        <i class="fa fa-envelope"></i><?php echo $email; ?>
                    </a>
                </li>
                <?php endif;?>

                <?php if($button_link):?>
                <li>
                    <a href="<?php echo $button_link;?>" class="btn-style"><?php echo $button_text_header; ?></a>
                </li>
                <?php endif;?>
            </ul>
            <?php endif;?>
            <div class="icon-menu">
                <h4>Menu</h4>
                <img src="<?php echo THEME_IMAGES; ?>/menu.svg">
            </div>
        </div>
    </section>
    <section class="navbar navbar-default header_aera">
        <div class="container">
            <div class="btn-close">
                <img src="<?php echo THEME_IMAGES; ?>/close.png" alt="close">
            </div>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'main-menu',
                'menu_class'     => 'nav navbar-nav main_menu pull-right',
            ) );
            ?>

        </div>
    </section>
</header>