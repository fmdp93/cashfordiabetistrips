<?php
get_header();
?>
<div class="container vh-100">
    <div class="row">
        <div class="col-12 my-5">                        
            <?php 
                echo json_decode(urldecode($_COOKIE['success_message']), true);
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>