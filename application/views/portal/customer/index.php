<div class="row">
    <div class="<?php echo grid_col(12); ?> mb-2">
        <div class="h-100 bg-white padding-25">
            <h4 class="box-title mt-0 text-bold"><i class="fa fa-shopping-bag"></i> My Cart</h4>
            <div class="table-responsive">
                <table class="table mt-0 mb-0">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Details</th>
                        <th>Date</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Electronics</td>
                        <td><span class="badge badge-pill badge-primary text-uppercase">SALE</span> </td>
                        <td>January 18</td>
                        <td><span class="text-primary">$32</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <a href="<?php echo base_url('shop/cart'); ?>" class="card-link btn btn-theme ripple">Manage Cart</a>
            <a href="<?php echo base_url('shop/checkout'); ?>" class="card-link btn btn-theme ripple">Checkout</a>
        </div>
    </div>
</div>