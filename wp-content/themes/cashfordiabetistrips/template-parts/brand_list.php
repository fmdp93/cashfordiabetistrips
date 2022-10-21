<?php ob_start(); ?>
    <div class="col-12 col-md-6 col-lg-3 my-2 my-lg-3">
        <div class="card">
            <div class="title p-3 text-center">
                <?php echo $model_row->name; ?>
            </div>
            <div class="p-2 p-lg-3">
                <img class="card-img-top" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/brands/' . $model_row->picture; ?>" alt="<?php echo $model_row->name ?>"> 
                <div class="card-body">                    
                    <?php foreach($products_sql as $product_row){ ?>                  
                    <div class="row breakdown">
                        <div class="col-8">                            
                            <span><?php echo $product_row->front_page_title ?></span><br>                            
                        </div>
                        <div class="col-4">
                            <span>From $<?php echo $product_row->price; ?></span><br>                            
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <a href="<?php echo home_url('products-to-sell?model=' . $model_row->id); ?>" class="sell_product_btn btn btn-primary w-100 my-3">Sell Product</a>
    </div>

<?php
return ob_get_clean();
