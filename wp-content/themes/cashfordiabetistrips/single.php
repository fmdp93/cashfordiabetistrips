<?php
get_header();
?>
<div class="container mt-3 mt-lg-5">
    <div class="row">
        <div class="col-12">
            <?php 
            
            while(have_posts()){
                the_post();
                the_content();
            }
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>