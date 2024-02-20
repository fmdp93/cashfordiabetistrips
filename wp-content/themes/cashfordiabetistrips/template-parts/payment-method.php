<?php ob_start(); ?>
<div class="form-check">
    <input class="form-check-input" type="radio" name="payment_method" <?php echo ($this->html_user_data['payment_method'] ?? $this->session->user['payment_method'] ?? '') == 'check' ? 'checked="1"' : ''; ?> id="pm_check" value="check">
    <label class="form-check-label" for="pm_check">
        I would like to be paid by check
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="payment_method" <?php echo ($this->html_user_data['payment_method'] ?? $this->session->user['payment_method'] ?? '') == 'paypal' ? 'checked="1"' : ''; ?> id="pm_paypal" value="paypal">
    <label class="form-check-label" for="pm_paypal">
        I would like to be paid via PayPal
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="payment_method" <?php echo ($this->html_user_data['payment_method'] ?? $this->session->user['payment_method'] ?? '') == 'zelle' ? 'checked="1"' : ''; ?> id="pm_zelle" value="zelle">
    <label class="form-check-label" for="pm_zelle">
        I would like to be paid by zelle
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="payment_method" <?php echo ($this->html_user_data['payment_method'] ?? $this->session->user['payment_method'] ?? '') == 'cash app' ? 'checked="1"' : ''; ?> id="pm_cash_app" value="cash app">
    <label class="form-check-label" for="pm_cash_app">
        I would like to be paid by cash app
    </label>
</div>
<div class="form-group">
    <?php echo alertError($this->html_error["pm_val"] ?? ''); ?>
    <input type="text" name="pm_val" value="<?php echo $this->html_user_data["pm_val"] ??  $this->session->user["pm_val"] ?? '' ?>" class="form-control" id="pm_val">
</div>
<?php return ob_get_clean();
