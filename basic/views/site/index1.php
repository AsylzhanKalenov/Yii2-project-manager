<?php

use yii\helpers\Url;

?>
<div id="top"></div>
<!-- Start Header Area -->
<header class="default-header">
    <div class="sticky-header">
        <div class="container">
            <div class="header-content d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="#top" class="smooth"><img src="/basic/web/forindex/img/ws.jpg" alt=""></a>
                </div>
                <div class="right-bar d-flex align-items-center">
                    <nav class="d-flex align-items-center">
                        <ul class="main-menu">
                            <li><a href="#top">Home</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="<?= Url::to(['site/profile']) ?>">Profile</a></li>
                            <li><a href="<?= Url::to(['auth/login']) ?>" class="primary-btn banner-btn">Login</a></li>
                        </ul>
                        <a href="#" class="mobile-btn"><span class="lnr lnr-menu"></span></a>
                    </nav>

                </div>
            </div>
        </div>
    </div>

</header>
<!-- End Header Area -->
<!-- Start Banner Area -->
<section class="banner-area relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row fullscreen justify-content-center align-items-center">
            <div class="col-lg-8">
                <div class="banner-content text-center">
                    <p class="text-uppercase text-white">WORKSHOP</p>
                    <h1 class="text-uppercase text-white">For making your management simple</h1>
                    <a href="<?= Url::to(['auth/login']) ?>" class="primary-btn banner-btn">Join in</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->
<!-- Start About Area -->

<!-- End About Area -->
<!-- Start Product Area -->
<section id="services" class="title-bg section-full">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="product-area-title text-center">
                    <p class="text-white text-uppercase">Why Choose Us</p>
                    <h2 class="text-white h1">We ensure perfect quality Digital <br> products for you</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single-product">
                    <div class="icon">
                        <span class="lnr lnr-star"></span>
                    </div>
                    <div class="desc">
                        <h4>Unique Design</h4>
                        <p>Simple and understandable UI/Design</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-product">
                    <div class="icon">
                        <span class="lnr lnr-magic-wand"></span>
                    </div>
                    <div class="desc">
                        <h4>Appropriate UX</h4>
                        <p>After some work, employees will get used to its interface</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-product">
                    <div class="icon">
                        <span class="lnr lnr-sun"></span>
                    </div>
                    <div class="desc">
                        <h4>Small costs</h4>
                        <p>Simple payement for web browsing makes its usage mor comfortable</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-product">
                    <div class="icon">
                        <span class="lnr lnr-layers"></span>
                    </div>
                    <div class="desc">
                        <h4>Functionality</h4>
                        <p>Different usage of functionalities makes "Workshop" flexible</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Area -->
<!-- Start Progress Bar Area -->

<!-- End Progress Bar Area -->
<!-- Start shuffle Area -->

<!-- End shuffle Area -->
<!-- Start Team member Area -->

<!-- End Team member Area -->

<!-- Start Digital Studio -->
<section class="section-full studio-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="studio-content">
                    <p class="text-uppercase text-white">We make partnership's new way</p>
                    <h2 class="h1 text-white text-uppercase mb-20">Web system "Workshop" <br> </h2>
                    <p class="text-white mb-30">Programm solves different cases of business entities for distributing tasks and management</p>
                    <a href="#" class="primary-btn text-white d-inline-flex align-items-center">Let's try!<span class="lnr lnr-arrow-right"></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Digital Studio -->
<!-- Start Pricing Area -->
<section class="section-full">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="product-area-title text-center">
                    <p class="text-uppercase">Tariffs</p>
                    <h2 class="h1">Team work builds trust and <br> trust builds growth</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="single-pricing-table">
                    <div class="top">
                        <div class="head text-center">
                            <span class="lnr lnr-shirt"></span><br>
                            <h5 class="text-white text-uppercase">Standard</h5>
                        </div>
                        <div class="package text-center">
                            <div class="price">$10</div>
                            <span class="text-white">Per month</span>
                        </div>
                    </div>

                    <div class="bottom text-center">
                        <ul class="feature text-center">
                            <li>2.5 GB </li>
                            <li>10 employees</li>
                            <li>Unlimited Styles</li>
                        </ul>
                        <a href="#" class="primary-btn text-uppercase d-inline-flex align-items-center">Purchase<span class="lnr lnr-arrow-right"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-pricing-table">
                    <div class="top">
                        <div class="head text-center">
                            <span class="lnr lnr-shirt"></span><br>
                            <h5 class="text-white text-uppercase">Business</h5>
                        </div>
                        <div class="package text-center">
                            <div class="price">$15</div>
                            <span class="text-white">Per month</span>
                        </div>
                    </div>

                    <div class="bottom text-center">
                        <ul class="feature text-center">
                            <li>5 GB</li>
                            <li>50 employees</li>
                            <li>Unlimited Styles</li>
                            <li>Customer Service</li>
                        </ul>
                        <a href="#" class="primary-btn text-uppercase d-inline-flex align-items-center">Purchase<span class="lnr lnr-arrow-right"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-pricing-table">
                    <div class="top">
                        <div class="head text-center">
                            <span class="lnr lnr-apartment"></span>
                            <h5 class="text-white text-uppercase">Ultimate</h5>
                        </div>
                        <div class="package text-center">
                            <div class="price">$20</div>
                            <span class="text-white">Per month</span>
                        </div>
                    </div>

                    <div class="bottom text-center">
                        <ul class="feature text-center">
                            <li>100 GB</li>
                            <li>Secure Online Transfer</li>
                            <li>Unlimited Styles</li>
                            <li>Customer Service</li>
                            <li>Manual Backup</li>
                        </ul>
                        <a href="#" class="primary-btn text-uppercase d-inline-flex align-items-center">Purchase<span class="lnr lnr-arrow-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Pricing Area -->
<!-- Start Testimonial Area -->

<!-- Start Publish Area -->

<!-- End Publish Area -->
<!-- Start Contact Area -->

<!-- End Contact Area -->
<!-- Start Cta Area -->
<section class="cta-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 d-flex no-flex-xs justify-content-between align-items-center">
                <h5 class="text-uppercase text-white">Not yet convinced with our quality?</h5>
                <a href="#" class="primary-btn d-inline-flex text-uppercase text-white align-items-center">Explore Services<span class="lnr lnr-arrow-right"></span></a>
            </div>
        </div>
    </div>
</section>