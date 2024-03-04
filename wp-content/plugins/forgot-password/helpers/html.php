<?php
function fmdp_forget_password_message($message, $type)
{
    if($message === ""){
        return "";
    }
    
    ob_start(); 
    ?>
    <div class="<?php echo "$type-msg" ?>">
        <?php echo $message ?>
    </div>
<?php
    return ob_get_clean();
}
