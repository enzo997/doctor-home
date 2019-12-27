<?php
//* Template Name: Giới thiệu
get_header();
?>
<div class="main">
    <?php do_action('banner_page_f'); ?>
    <?php
        $img_left=get_field('image_left');
        $title_info=get_field('title_right');
        $description_info=get_field('description_right');
    ?>
    <?php if($img_left || $title_info || $description_info): ?>
    <section class="information">
        <div class="container">
            <div class="row">
                <?php if($img_left): ?>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <img src="<?php echo $img_left['url'];?>" alt="<?php echo $img_left['alt']; ?>">
                </div>
                <?php endif; ?>

                <?php if($title_info || $description_info): ?>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <?php echo acf_render('<div class="title"><h2>','</h2></div>',$title_info); ?>
                    <?php echo acf_render('<div class="content-information">','</div>',$description_info);?>
                </div>
                <?php endif;?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
        $title_why_choose_us=get_field('title_why_choose_us');
        $description_why_choose_us=get_field('description_why_choose_us');
        $list_about_us=get_field('list_about-us');
    ?>
    <?php if($title_why_choose_us || $description_why_choose_us || $list_about_us):?>
    <section class="content-section about-us">
        <div class="container">
            <div class="title">
                <?php echo acf_render('<h2>','</h2>',$title_why_choose_us); ?>
                <?php echo acf_render('<h4>','</h4>',$description_why_choose_us); ?>
            </div>
            <?php if(have_rows('list_about-us')):?>
            <div class="row">
                <?php while (have_rows('list_about-us')):the_row();?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box-about">
                        <?php echo acf_render('<h3>','</h3>',get_sub_field('title_item'));?>
                        <?php echo acf_render('','',get_sub_field('description_item'));?>
                    </div>
                </div>
                <?php endwhile;?>
            </div>
            <?php endif;?>
        </div>
    </section>
    <?php endif;?>

    <?php
        $title_our_work=get_field('title_our_work');
        $description_our_work=get_field('description_our_work');
        $list_our_work=get_field('list_our_work');
        if($title_our_work || $description_our_work || $list_our_work):
    ?>
    <section class="our-work" style="background-image: url('<?php echo THEME_URI;?>/images/our-work.png')">
        <div class="container">
            <div class="title">
                <?php echo acf_render('<h2>','</h2>',$title_our_work);?>
                <?php echo acf_render('<h4>','</h4>',$description_our_work);?>
            </div>
            <?php if(have_rows('list_our_work')):?>
            <div class="row">
                <?php while (have_rows('list_our_work')):the_row()?>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="data-work">
                        <?php echo acf_render('<h3>','</h3>',get_sub_field('number'));?>
                        <?php echo acf_render('<p>','</p>',get_sub_field('small_title'));?>
                    </div>
                </div>
                <?php endwhile;?>
            </div>
            <?php endif;?>
        </div>
    </section>
    <?php endif; ?>

    <?php
        $title_comment_us=get_field('title_comment_us');
        $content_comment=get_field('content_comment');
        if($title_comment_us || $content_comment):
    ?>
    <section class="commemt-us">
        <div class="container">
            <div class="title">
                <?php echo acf_render('<h2>','</h2>',$title_comment_us);?>
            </div>
            <?php if(have_rows('content_comment')):?>
            <div class="list-comment">
                <?php while (have_rows('content_comment')):the_row();?>
                <div class="content-comment">
                    <img src="<?php echo get_sub_field('image_user')['url']; ?>" alt="<?php get_sub_field('image_user')['alt']; ?>">
                    <?php echo acf_render('<div class="name"><h4>','</h4></div>',get_sub_field('user_name'));?>
                    <?php echo acf_render('<div class="address"><h6>','</h6></div>',get_sub_field('address_user'));?>
                    <?php if(get_sub_field('content_comment')): ?>
                    <div class="text-commemt">
                        <span class="icon-left"><img src="<?php echo THEME_URI;?>/images/shape.png"></span>
                        <p><?php echo get_sub_field('content_comment'); ?></p>
                        <span class="icon-right"><img src="<?php echo THEME_URI;?>/images/shape.png"></span>
                    </div>
                    <?php endif;?>
                </div>
                <?php endwhile;?>
            </div>
            <?php endif;?>
        </div>
    </section>
    <?php endif;?>
</div>
<?php get_footer();?>
