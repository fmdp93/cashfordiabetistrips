<?php
get_header();
?>
<div id="page_products_to_sell" class="container mt-3 mt-lg-5">
    <div class="row">
        <div class="col-12">
            <div id="products-to-sell-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#products-to-sell-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#products-to-sell-carousel" data-slide-to="1"></li>
                    <li data-target="#products-to-sell-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="<?php echo get_template_directory_uri() . "/assets/img/collection-slider.png" ?>" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo get_template_directory_uri() . "/assets/img/Test-Strip-Buyers-Web-Mobile-Banners-03.png" ?>" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo get_template_directory_uri() . "/assets/img/Test-Strip-Buyers-Web-Mobile-Banners-10-09.png" ?>" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#products-to-sell-carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#products-to-sell-carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>            
        </div>
        <div class="col-12">
            <div id="brands_we_buy" class="jumbotron p-0 my-2 my-lg-5">
                <h1 class="display-4"><span>brands </span><span>we buy</span></h1>
                <p class="lead">Select any brand below to see which products we carry from them.</p>
            </div>
        </div>
        <div class="col-12 p-3 sticky-top text-light bg-dark">
            <div class="row">
                <div class="col-8">
                    Fill out form on the bottom of this page. For prepaid shipping label
                </div>
                <div class="col-4 text-right">
                    Your Total Earned: <span id="total_earned">$</span>
                </div>
            </div>
        </div>
        <?php echo apply_filters('product_form', ''); ?>
    </div>
</div>
<?php
get_footer();
?>