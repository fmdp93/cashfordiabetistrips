<?php ob_start(); ?>
<form action="<?php echo $this->products_to_sell_action ?>" method="POST">
    <?php wp_nonce_field($this->products_to_sell_action, 'products_to_sell'); ?>
    <input type="hidden" name="action" value="cashfordiabetistrips_products_to_sell_action">
    <input type="hidden" name="model" value="<?php echo $_GET['model']??''; ?>"?>
    <div class="col-12">
        <?php
        echo apply_filters("product_view", @$_GET);
        ?>
    </div>
    <div class="col-12">
        <?php alertError($this->html_error["product_error"] ?? ''); ?>
        <h2>Step 1</h2>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="shipping_label" id="shipping_label_1" value="1" checked>
            <label class="form-check-label" for="shipping_label_1">
                I require a shipping label to be EMAIL to the EMAIL ADDRESS provided below to send my inventory.
            </label>
        </div>
        <div class="form-check disabled">
            <input class="form-check-input" type="radio" name="shipping_label" id="shipping_label_2" value="2" disabled>
            <label class="form-check-label" for="shipping_label_2">
                I require a shipping label to be MAIL to the MAILING ADDRESS provided bellow
            </label>
        </div>
    </div>
    <div class="col-12">
        <h2>Step 2</h2>
        <div class="form-group">
            <label for="promo_code">Promo Code</label>
            <input type="text" name="promo_code" value="<?php echo $this->html_user_data["promo_code"] ?? '' ?>" class="form-control" id="promo_code" placeholder="Promo Code (not required)">
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <input type="text" name="notes" value="<?php echo $this->html_user_data["notes"] ?? '' ?>" class="form-control" id="notes" placeholder="15 words or less (not required)">
        </div>
        <?php
        echo apply_filters("user_details_form", "");
        ?>
    </div>
    <div id="payment_method" class="col-12">
        <h2>Step 3</h2>
        <?php echo apply_filters('payment_method', ''); ?>
        <div class="border-top border-gray-c1 pt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="tos">
                <label class="form-check-label" for="tos">
                    By checking here, I have read and agree to the Terms and Conditions.
                </label>
            </div>
            <div class="form-check">
                <input name="checkbox_2" class="form-check-input" type="checkbox" value="1" id="email_notif" checked>
                <label class="form-check-label" for="email_notif">
                    I give permission to more cash for strips and its affiliates to communicate with me via email to notify me of price changes, promotions, and other notices.
                </label>
            </div>
            <div class="form-check">
                <input name="checkbox_3" class="form-check-input" type="checkbox" value="1" id="txt_notif" checked>
                <label class="form-check-label" for="txt_notif">
                    I give permission to more cash for strips and its affiliates to communicate with me via text message to notify me of price changes, promotions, and other notices. Note: your carrier might charge fees for any text messages receive.
                </label>
            </div>
        </div>
        <div id="submit" class="border-top border-secondary my-1 py-3 d-none">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary border-0 rounded-0 p-3">
        </div>
    </div>
</form>
<?php return ob_get_clean(); 