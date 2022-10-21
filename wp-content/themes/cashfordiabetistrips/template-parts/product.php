<?php ob_start(); ?>
<div class="row">
    <?php
    // dumpre($label);
    if ($products) {
        foreach ($products as $key => $product) {
    ?>
            <div class="col-12 col-md-6 col-lg-4 my-2 my-lg-3">
                <div class="card text-center">
                    <div class="title p-3">
                        <?php echo $product->name; ?>
                    </div>
                    <div class="expiration_date p-3">
                        Minimum Expiration Date: 11/21
                    </div>
                    <div>
                        <img class="card-img-top" src="<?php echo ADMIN_UPLOADS_FOLDER_URI . '/products/' . $product->picture; ?>" alt="<?php echo $product->name ?>">
                        <div class="card-body">
                            <h5 class="card-title">Condition: Good</h5>
                            <p class="card-text"><a href="<?php echo home_url('damage-guidelines') ?>">*Click here to see damage guidelines</a></p>
                            <div class="row breakdown">

                                <div class="col-4 col-lg-4">
                                    <input type="hidden" name="price[]" value="<?php echo $product->price; ?>">
                                    <input type="hidden" name="product_id[]" value="<?php echo $product->id; ?>">
                                    <input type="hidden" name="product_name[]" value="<?php echo $product->name; ?>">
                                    <span>Unit Price</span><br>
                                    <span><?php echo $product->price ?></span>
                                </div>
                                <div class="col-4 col-lg-4">
                                    <span># of boxes</span><br>
                                    <span><input type="text" name="quantity[]" placeholder="0" class="text-center" value="<?php echo $this->html_user_data['quantity'][$key] ?? '' ?>" /></span>
                                </div>
                                <div class="col-4 col-lg-4">
                                    <span class="subtotal">Sub Total</span><br>
                                    <span>0</span>
                                </div>
                                <div class="col-12 text-center text-danger">
                                    <div class="error"><?php echo $this->html_error['product_item'][$key] ?? '' ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <?php
        }
    } ?>

</div>

<?php
return ob_get_clean();
