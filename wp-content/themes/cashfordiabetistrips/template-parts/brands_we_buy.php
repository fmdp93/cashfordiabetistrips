<?php ob_start(); ?>
<div class="row">
    <div class="col-12 col-md-6 col-lg-4 my-2 my-lg-3">
        <div class="card text-center">
            <div class="title p-3">
                <?php echo $title; ?>
            </div>
            <div class="p-2 p-lg-3">
                <img class="card-img-top" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/brands/' . $picture; ?>" alt="<?php echo $title ?>">
                <div class="card-body">                    
                    <?php for($i = 0; $i < count($pricing_label); $i++){ ?>                    
                    <div class="row breakdown">
                        <div class="col-6">
                            <span><?php echo $pricing_label[$i]; ?></span><br>                            
                        </div>
                        <div class="col-6">
                            <span><?php echo $pricing_price[$i]; ?></span><br>                            
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
return ob_get_clean();
