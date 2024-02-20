<?php
get_header();
?>
<div id="page_brands_we_buy" class="container mt-3 mt-lg-5">
    <div class="row" style="height: 30%">
        <div class="col-12 col-md-4 col-lg-3">
            <div id="top_categories">
                <span class="">TOP CATEGORIES</span>
                <ul>
                    <li><a href="<?php echo home_url('/products-to-sell'); ?>">Sell Products</a></li>
                    <li><a href="<?php echo home_url("/damage-guidelines"); ?>">Damage Guidelines</a></li>
                    <li><a href="#">Shipping Instructions</a></li>                    
                    <li><a href="<?php echo home_url("faq") ?>">FAQ</a></li>
                    <li><a href="<?php echo home_url("/testimonials") ?>">Testimonials</a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-8 col-lg-9">
            <div>
                <div id="home-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#home-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#home-carousel" data-slide-to="1"></li>
                        <li data-target="#home-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="<?php echo get_template_directory_uri() . "/assets/img/Freekit.png" ?>" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="<?php echo get_template_directory_uri() . "/assets/img/signupbonusbanner.png" ?>" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="<?php echo get_template_directory_uri() . "/assets/img/TSB-banner10.png" ?>" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#home-carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#home-carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div id="brands_we_buy" class="jumbotron p-0 my-2 my-lg-5">
                <h1 class="display-4"><span>brands </span><span>we buy</span></h1>
                <p class="lead">Select any brand below to see which products we carry from them.</p>
            </div>
        </div>
        <div class="col-12">
            <?php
            echo apply_filters("brands_we_buy", "");
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>