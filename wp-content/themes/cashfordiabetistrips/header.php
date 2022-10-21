<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo wp_get_document_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon.png" />
    <?php wp_head() ?>

</head>

<body>
    <div class="container" id="user_nav">
        <div class="row align-items-end align-items-stretch">
            <div class="col-12 col-lg-3">
                <a class="" href="<?php echo home_url() ?>">
                    <img id="site_logo" class="mt-3" src="<?php echo get_template_directory_uri() . "/assets/img/logo.png" ?>" alt="site_logo" />
                </a>
            </div>
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-12">
                        <div class="top_nav">
                            <nav class="navbar navbar-expand-xl">
                                <ul class="navbar-nav ml-auto flex-row">
                                    <li class="nav-item"><span><i class="far fa-newspaper"></i> <a href="#">BLOG</a></span></li>
                                    <li class="nav-item"><span><i class="far fa-question-circle"></i> <a href="<?php echo home_url('faq') ?>">FAQS</a></span></li>
                                    <li class="nav-item"><span><i class="fas fa-user"></i> <a href="<?php echo home_url('my-account') ?>">ACCOUNT</a></span></li>
                                    <li class="nav-item"><span><i class="fas fa-search"></i> <a href="#">SEARCH</a></span></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-12">
                        <nav class="bottom_nav navbar navbar-expand-xl navbar-light">
                            <button class="navbar-toggler navbar-toggler-left ml-auto mb-1 mt-sm-0 border-" type="button" data-toggle="collapse" data-target="#user_nav_div" aria-controls="user_nav_div" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="user_nav_div">
                                <ul class="navbar-nav ml-auto text-right">
                                    <li class="nav-item"><span><a href="<?php echo home_url("products-to-sell") ?>">PRODUCTS TO SELL</a></span></li>
                                    <!-- <li class="nav-item"><span><a href="#">FREE SHIPPING KIT</a></span></li> -->
                                    <li class="nav-item"><span><a href="#">SHIPPING INSTRUCTIONS</a></span></li>
                                    <!-- <li class="nav-item"><span><a href="#">INFORMATION GUIDE</a></span></li> -->
                                    <li class="nav-item"><span><a href="<?php echo home_url('damage-guidelines') ?>">DAMAGE GUIDELINES</a></span></li>
                                    <li class="nav-item"><span><a href="<?php echo home_url('testimonials') ?>">TESTIMONIALS</a></span></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </div>