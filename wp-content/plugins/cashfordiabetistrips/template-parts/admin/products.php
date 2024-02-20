<div class="row">
    <div class="col-12">
        <h1>Manage Products</h1>
    </div>

    <div id="add-product" class="col-12">
        <a href="<?php echo admin_url("admin.php?page=cashfordiabetistrips-add-product") ?>" class="btn btn-green-c1 text-white">+ Add Product</a>
    </div>

    <div class="col-12 pt-3">
        <div id="products-list">
            <h3>Products Lists</h3>
            <?php
            if ($products) {
            ?>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Model</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Action</th>
                        </tr>

                        <?php foreach ($products as $product) { ?>
                    <tbody>
                        <tr>
                            <td><?php echo $product->p_id ?></td>
                            <td><?php echo $product->brand ?></td>
                            <td><?php echo $product->model_name ?></td>
                            <td><?php echo $product->p_name ?></td>
                            <td><?php echo $product->price ?></td>
                            <td><?php echo $product->quantity ?></td>
                            <td>
                                <a href="
                                <?php echo admin_url(
                                    "admin.php?page=cashfordiabetistrips-update&id=" . $product->p_id
                                ) ?>">
                                    <button class="btn btn-green-c1">
                                        <i class="fas fa-edit"></i>
                                        Update
                                    </button>
                                </a>
                                <a href="#">
                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        Delete
                                    </button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
                </thead>
                </table>
            <?php } else { ?>
                <div>
                    <p>Products available to sell will be shown here.
                        <a class="text-primary" href="<?php echo admin_url("admin.php?page=cashfordiabetistrips-add-product") ?>">
                            Add product.
                        </a>
                    </p>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>