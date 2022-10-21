<div class="row m-3 m-lg-5">
    <?php 
    if(@$_GET['status_code'] == 'error'){
        alertError(urldecode(@$_GET['message'])); 
    }else{
        alertSuccess(urldecode(@$_GET['message'])); 
    }    ?>
    <div class="col-12">
        <h1>Add Product</h1>
    </div>    
    <form id="add_product" method="POST" action="<?php echo admin_url('admin.php'); ?>" enctype="multipart/form-data">
        <?php wp_nonce_field($this->add_product_action, 'add_product_action_nonce'); ?>
        <input type="hidden" name="action" value="cashfordiabetistrips_add_product_action">        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name of the product" />
        </div>
        <div class="form-group">
            <label for="front_page_title">Front Page Title</label>
            <input type="text" name="front_page_title" class="form-control" placeholder="Front Page Title" />
        </div>
        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" name="brand" class="form-control" placeholder="Brand of the product" />
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" name="model" class="form-control" placeholder="Model of the product" />
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" class="form-control" placeholder="$$ of the product" />
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" id="quantity" name="quantity" class="form-control" placeholder="Quantity per box" />
        </div>
        <div class="form-group">
            <label for="picture">Photo</label>
            <input type="file" class="form-control-file" id="picture" name="picture">
        </div>        
        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
    </form>
</div>