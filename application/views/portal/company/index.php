<div class="card bg-secondary">
    <div class="card-body">
        <div class="row tile-count">
            <?php
            $total_stock_products = number_format($this->product_model->total_in_stock($this->company_id));
            $total_customers = number_format($this->user_model->total_users('', CUSTOMER));
            $total_pending_orders = number_format($this->order_model->total_orders(ST_ORDER_PENDING));
            $completed_orders = number_format($this->order_model->total_orders(ST_ORDER_COMPLETED));
            $stats = [
                ['Products In Stock', $total_stock_products, 'shopping-bag'],
                ['Customers', $total_customers, 'users'],
                ['Pending Orders', $total_pending_orders, 'clock-o'],
                ['Completed Orders', $completed_orders, 'check-circle'],
            ];
            foreach ($stats as $stat) { ?>
                <div class="<?php echo grid_col('', 6, 6, 3, 3); ?> tile-stats-count"> 
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6"><i class="fa fa-<?php echo $stat[2]; ?>" aria-hidden="true"></i>
                            <h5 class="text-muted text-uppercase"><?php echo $stat[0]; ?></h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <h3 class="counter text-right m-t-15 text-info"><?php echo $stat[1]; ?></h3>
                        </div>
                        <div class="col-12">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-info w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
            } ?>
        </div>
        
        <?php 
        $featured_products = $this->product_model->featured($this->company_id, [], 'rand', 3);
        if (!empty($featured_products)) { ?>
            <h3>Featured Products</h3>
            <div class="row mb-2">
                <?php
                foreach ($featured_products as $row) { ?>
                    <div class="<?php echo grid_col(12, 6, 4); ?> p-b-10">
                        <div class="h-100 bg-white padding-25">
                            <?php ajax_page_link('products/view/'.$row->id, '<h4 class="box-title mt-0">'.$row->name.'</h4>'); ?>
                            <img class="img-responsive" src="<?php echo $row->image_file; ?>">
                        </div>
                    </div>
                    <?php 
                } ?>
            </div>
            <?php 
        } ?>
    </div>
</div>

<?php require 'application/views/portal/shared/recent_orders.php'; ?>