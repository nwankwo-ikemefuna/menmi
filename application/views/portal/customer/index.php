<div class="row">
    <div class="<?php echo grid_col(12); ?> mb-2">
        <div class="h-100 bg-white padding-25">
            <h4 class="box-title mt-0 text-bold"><i class="fa fa-shopping-bag"></i> My Cart</h4>
            <div class="table-responsive">
                <table class="table mt-0 mb-0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th class="min-w-200">Product</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $products = $this->shop_model->cart();;
                        foreach ($products as $row) { ?>
                            <tr>
                                <td><img class="record_image clickable tm_image" src="<?php echo base_url($row['image_file']); ?>"></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $row['qty']; ?></td>
                                <td><?php echo $row['product_total_amount']; ?></td>
                            </tr>
                            <?php 
                        } ?>
                    </tbody>
                </table>
            </div>
            <a class="btn btn-primary btn-raised" href="<?php echo base_url('shop/checkout'); ?>">Checkout &raquo;</a>
        </div>
    </div>
</div>

<?php require 'application/views/portal/shared/recent_orders.php'; ?>