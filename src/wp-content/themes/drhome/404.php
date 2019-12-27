<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

    <?php
        $bg_404=get_field('bg_404','options');
        $title_404=get_field('title_404','options');
        $description_404=get_field('description_404','options');
        $button_text_home=get_field('button_text_home','options');
    ?>
	<section class="section-404" style="background-image: url('<?php echo $bg_404['url'];?>')">
        <div class="container">
            <div class="content-404">
                <?php echo acf_render('<h1>','</h1>',$title_404);?>
                <?php echo acf_render('<h3>','</h3>',$description_404);?>
                <?php $link_home='<a class="btn-style" href ="'.get_home_url().'">'; echo acf_render($link_home,'</a>',$button_text_home)?>
            </div>
        </div>
    </section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
