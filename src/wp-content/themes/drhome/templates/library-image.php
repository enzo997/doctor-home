<?php
//* Template Name: Thư viện
get_header();
?>
<div class="main">
    <?php do_action('banner_page_f'); ?>

    <?php
    $images = get_field('thu_vien_hinh_anh_gallery');
    $size = 'full';
    if( $images ): ?>
    <section class="library-img">
        <div class="container">
            <div class="row">
                <?php foreach( $images as $image ): ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <h4 style="display: none"><?php echo $image['title']; ?></h4>
                    <a data-title="<?php echo $image['title']; ?>" href="<?php echo $image['url']; ?>" target="_blank"> 
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title'];?>"/>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>
<?php get_footer();?>
