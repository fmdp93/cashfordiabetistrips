<?php if (isset($_GET['ppage']) && $_GET['ppage'] === FMDP_PAGE_SUCCESS) {
    $succes_message = fmdp_flash_message("success_message");
    echo fmdp_forget_password_message($succes_message, "success");
}
