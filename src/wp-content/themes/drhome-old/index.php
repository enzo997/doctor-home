<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<div class="main">
    <section class="banner" style="background-image: url(/drhome/wp-content/themes/drhome/images/banner-home.png)">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <h1>Dịch Vụ Bảo Trì Nhà Chuyên Ngiệp</h1>
                        <p>
                            Chúng tôi sẽ chăm sóc lo lắng cho ngôi nhà của bạn như chính ngôi nhà của mình.
                            Chúng tôi có những gói dịch vụ phù hợp cho tất cả mọi đối tượng. Chúng tôi mang đến sự hài lòng cho quý khách.
                        </p>
                        <a href="#" class="btn-style">
                            XEM DỊCH VỤ
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-contact">
                            <div class="title-form">
                                <h3>GỬI YÊU CẦU TƯ VẤN CHO CHÚNG TÔI</h3>
                            </div>
                            <?php echo do_shortcode('[contact-form-7 id="4" title="Form contact"]');?>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section class="content-section service">
        <div class="container">
            <div class="title">
                <h2>Dịch Vụ</h2>
                <h4>Chúng tôi có những gói dịch vụ phù hợp cho tất cả mọi đối tượng.</h4>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box-service">
                        <img src="/drhome/wp-content/themes/drhome/images/icon-service.png" alt="service">
                        <a href="#" class="service-heading">Bảo Trì Trọn Gói</a>
                        <p>Chúng tôi sẽ chăm sóc lo lắng cho ngôi nhà của bạn như chính ngôi nhà của mình.</p>
                        <a href="#" class="detail">XEM CHI TIẾT
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box-service">
                        <img src="/drhome/wp-content/themes/drhome/images/icon-service-1.png" alt="service">
                        <a href="#" class="service-heading">Bảo Trì Nhà Xưởng</a>
                        <p>Chúng tôi sẽ chăm sóc lo lắng cho ngôi nhà của bạn như chính ngôi nhà của mình.</p>
                        <a href="#" class="detail">XEM CHI TIẾT
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box-service">
                        <img src="/drhome/wp-content/themes/drhome/images/icon-service-2.png" alt="service">
                        <a href="#" class="service-heading">Danh Mục Bảo Trì Khác</a>
                        <p>Chúng tôi sẽ chăm sóc lo lắng cho ngôi nhà của bạn như chính ngôi nhà của mình.</p>
                        <a href="#" class="detail">XEM CHI TIẾT
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="package">
        <div class="container">
            <div class="title">
                <h2>Bảo Trì Trọn Gói</h2>
                <h4>Chúng tôi có những gói dịch vụ phù hợp cho tất cả mọi đối tượng.</h4>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="box-package">
                        <img src="/drhome/wp-content/themes/drhome/images/package.png" alt="package">
                        <div class="box-title">
                            <h3>Bảo Trì Trọn Gói Toà Nhà</h3>
                            <a href="#" class="detail">XEM CHI TIẾT
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="box-package">
                        <img src="/drhome/wp-content/themes/drhome/images/package-1.png" alt="package">
                        <div class="box-title">
                            <h3>Bảo Trì Trọn Gói Biệt Thự</h3>
                            <a href="#" class="detail">XEM CHI TIẾT
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="box-package">
                        <img src="/drhome/wp-content/themes/drhome/images/package-2.png" alt="package">
                        <div class="box-title">
                            <h3>Bảo Trì Trọn Gói Căn Hộ</h3>
                            <a href="#" class="detail">XEM CHI TIẾT
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="box-package">
                        <img src="/drhome/wp-content/themes/drhome/images/package-3.png" alt="package">
                        <div class="box-title">
                            <h3>Bảo Trì Trọn Gói Nhà Ở Gia Đình</h3>
                            <a href="#" class="detail">XEM CHI TIẾT
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content-section about-us">
        <div class="container">
            <div class="title">
                <h2>Tại Sao Bạn Chọn Chúng Tôi?</h2>
                <h4>Chúng tôi có những gói dịch vụ phù hợp cho tất cả mọi đối tượng.</h4>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box-about">
                        <h3>10 Năm Kinh Nghiệm</h3>
                        <p>Chúng tôi sẽ chăm sóc lo lắng cho ngôi nhà của bạn như chính ngôi nhà của mình.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box-about">
                        <h3>Chuyên Nghiệp</h3>
                        <p>Chúng tôi sẽ chăm sóc lo lắng cho ngôi nhà của bạn như chính ngôi nhà của mình.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box-about">
                        <h3>Nhanh Chóng</h3>
                        <p>Chúng tôi sẽ chăm sóc lo lắng cho ngôi nhà của bạn như chính ngôi nhà của mình.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box-about">
                        <h3>Chi Phí Hợp Lý</h3>
                        <p>Chúng tôi sẽ chăm sóc lo lắng cho ngôi nhà của bạn như chính ngôi nhà của mình.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box-about">
                        <h3>Tư Vấn Tận Tình</h3>
                        <p>Chúng tôi sẽ chăm sóc lo lắng cho ngôi nhà của bạn như chính ngôi nhà của mình.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box-about">
                        <h3>Bảo Trì Dài Hạn</h3>
                        <p>Chúng tôi sẽ chăm sóc lo lắng cho ngôi nhà của bạn như chính ngôi nhà của mình.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="library-img">
        <div class="container">
            <div class="title">
                <h2>Thư Viện Hình Ảnh</h2>
                <h4>Hình ảnh thi công các công trình</h4>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <img src="/drhome/wp-content/themes/drhome/images/img.png" alt="library-img">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <img src="/drhome/wp-content/themes/drhome/images/img-1.png" alt="library-img">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <img src="/drhome/wp-content/themes/drhome/images/img-2.png" alt="library-img">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <img src="/drhome/wp-content/themes/drhome/images/img-3.png" alt="library-img">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <img src="/drhome/wp-content/themes/drhome/images/img-4.png" alt="library-img">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <img src="/drhome/wp-content/themes/drhome/images/img-5.png" alt="library-img">
                </div>
            </div>
            <div class="see-all">
                <a href="#">XEM TẤT CẢ
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>
    <section class="blog-content">
        <div class="container">
            <div class="title">
                <h2>Tin Tức</h2>
                <h4>Hình ảnh thi công các công trình</h4>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box-blog">
                        <div class="content-img">
                            <a href="#">
                                <img src="/drhome/wp-content/themes/drhome/images/blog.png" alt="blog">
                            </a>
                        </div>
                        <div class="content-box">
                            <h4>
                                <a href="#" class="title-blog">Tư vấn cách chọn màu sơn nhà theo phong thủy</a>
                            </h4>
                            <p>Chúng tôi sẽ chăm sóc lo lắng cho ngôi nhà của bạn như chính ngôi nhà của mình.</p>
                            <a href="#" class="detail">XEM CHI TIẾT
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box-blog">
                        <div class="content-img">
                            <a href="#">
                                <img src="/drhome/wp-content/themes/drhome/images/blog-1.png" alt="blog">
                            </a>
                        </div>
                        <div class="content-box">
                            <h4>
                                <a href="#" class="title-blog">Bảo trì hệ thống cấp thoát nước cho căn hộ</a>
                            </h4>
                            <p>Chúng tôi sẽ chăm sóc lo lắng cho ngôi nhà của bạn như chính ngôi nhà của mình.</p>
                            <a href="#" class="detail">XEM CHI TIẾT
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box-blog">
                        <div class="content-img">
                            <a href="#">
                                <img src="/drhome/wp-content/themes/drhome/images/blog-2.png" alt="blog">
                            </a>
                        </div>
                        <div class="content-box">
                            <h4>
                                <a href="#" class="title-blog">Bảo trì hệ thống máy lạnh</a>
                            </h4>
                            <p>Chúng tôi sẽ chăm sóc lo lắng cho ngôi nhà của bạn như chính ngôi nhà của mình.</p>
                            <a href="#" class="detail">XEM CHI TIẾT
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="see-all">
                <a href="#">XEM TẤT CẢ
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>
    <section class="customer">
        <div class="container">
            <div class="title">
                <h2>Khách Hàng</h2>
                <h4>Quý khách hàng đã luôn tin tưởng và đồng hành cùng Dr Home</h4>
            </div>
            <div class="row">
                <div class="col-12 col-img">
                    <div class="customer-img">
                        <img src="/drhome/wp-content/themes/drhome/images/customer.png" alt="customer">
                    </div>
                </div>
                <div class="col-12 col-img">
                    <div class="customer-img">
                        <img src="/drhome/wp-content/themes/drhome/images/customer-1.png" alt="customer">
                    </div>
                </div>
                <div class="col-12 col-img">
                    <div class="customer-img">
                        <img src="/drhome/wp-content/themes/drhome/images/customer-2.png" alt="customer">
                    </div>
                </div>
                <div class="col-12 col-img">
                    <div class="customer-img">
                        <img src="/drhome/wp-content/themes/drhome/images/customer-3.png" alt="customer">
                    </div>
                </div>
                <div class="col-12 col-img">
                    <div class="customer-img">
                        <img src="/drhome/wp-content/themes/drhome/images/customer-4.png" alt="customer">
                    </div>
                </div>
                <div class="col-12 col-img">
                    <div class="customer-img">
                        <img src="/drhome/wp-content/themes/drhome/images/customer-5.png" alt="customer">
                    </div>
                </div>
                <div class="col-12 col-img">
                    <div class="customer-img">
                        <img src="/drhome/wp-content/themes/drhome/images/customer-6.png" alt="customer">
                    </div>
                </div>
                <div class="col-12 col-img">
                    <div class="customer-img">
                        <img src="/drhome/wp-content/themes/drhome/images/customer-7.png" alt="customer">
                    </div>
                </div>
                <div class="col-12 col-img">
                    <div class="customer-img">
                        <img src="/drhome/wp-content/themes/drhome/images/customer-8.png" alt="customer">
                    </div>
                </div>
                <div class="col-12 col-img">
                    <div class="customer-img">
                        <img src="/drhome/wp-content/themes/drhome/images/customer-9.png" alt="customer">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>