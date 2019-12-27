<?php
//* Template Name: Cảm ơn
get_header();
?>
<div class="main">
    <?php
        $img_thanks=get_field('img_thanks');
        $title_thanks=get_field('title_thanks');
        $description_thanks=get_field('description_thanks');
        $button_text_service=get_field('button_text_service');
        $button_link_service=get_field('button_link_service');
    ?>
    <section class="section-thanks">
        <div class="container">
            <div class="row">
                <?php if($img_thanks): ?>
                <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                    <img src="<?php echo $img_thanks['url'];?>" alt="<?php echo $img_thanks['alt'];?>">
                </div>
                <?php endif; ?>
                <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                    <div class="content-thanks">
                        <?php echo acf_render('<h1>','</h1>',$title_thanks);?>
                        <?php echo acf_render('<h3>','</h3>',$description_thanks);?>
                        <?php $link_service='<a class="btn-style" href ="'.$button_link_service.'">'; echo acf_render($link_service,'</a>',$button_text_service)?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer();?>
