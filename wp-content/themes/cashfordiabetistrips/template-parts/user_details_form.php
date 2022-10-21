<?php
ob_start();
?>

<div class="form-group">
    <?php echo alertError($this->html_error["name"] ?? ''); ?>
    <label for="name">Your Name</label>
    <input type="text" name="name" value="<?php echo $this->html_user_data["name"] ?? $this->session->user["name"] ?? '' ?>" class="form-control" id="name" placeholder="Your Name">
</div>
<div class="form-group">
    <?php echo alertError($this->html_error["email"] ?? ''); ?>
    <label for="email">Email address</label>
    <input type="email" name="email" value="<?php echo$this->html_user_data["email"] ??  $this->session->user["email"] ?? '' ?>" class="form-control" id="email" placeholder="name@example.com">
</div>
<div class="form-group">
    <?php echo alertError($this->html_error["phone_num"] ?? ''); ?>
    <label for="phone_num">Phone Number</label>
    <input type="text" name="phone_num" value="<?php echo$this->html_user_data["phone_num"] ??  $this->session->user["phone"] ?? '' ?>" class="form-control" id="phone_num" placeholder="Phone Number">
</div>
<div class="form-group">
    <?php echo alertError($this->html_error["address"] ?? ''); ?>
    <label for="address">Home Address</label>
    <input type="text" name="address" value="<?php echo$this->html_user_data["address"] ??  $this->session->user["street"] ?? '' ?>" class="form-control" id="address" placeholder="Home Address">
</div>
<div class="form-group">
    <?php echo alertError($this->html_error["city"] ?? ''); ?>
    <label for="city">City</label>
    <input type="text" name="city" value="<?php echo$this->html_user_data["city"] ??  $this->session->user["city"] ?? '' ?>" class="form-control" id="city" placeholder="City">
</div>
<div class="form-group">
    <?php echo alertError($this->html_error["state"] ?? ''); ?>
    <label for="state">State</label>
    <input type="text" name="state" value="<?php echo$this->html_user_data["state"] ??  $this->session->user["state"] ?? '' ?>" class="form-control" id="state" placeholder="State">
</div>
<div class="form-group">
    <?php echo alertError($this->html_error["zip"] ?? ''); ?>
    <label for="zip">Zip</label>
    <input type="text" name="zip" value="<?php echo$this->html_user_data["zip"] ??  $this->session->user["postcode"] ?? '' ?>" class="form-control" id="zip" placeholder="Zip">
</div>

<?php
return ob_get_clean();
