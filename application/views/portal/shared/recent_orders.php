<div class="row">
    <div class="<?php echo grid_col(12); ?> mb-2">
        <div class="h-100 bg-white padding-25">
            <h4 class="box-title mt-0">Recent Orders</h4>
            <div class="table-responsive">
                <table class="table mt-0 mb-0">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <?php if (company_user()) { ?>
                                <th class="min-w-200">Customer</th>
                                <?php 
                            } ?>
                            <th>Ref ID</th>
                            <th>Total Items</th>
                            <th class="min-w-200">Date Placed</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = $this->order_model->sql($this->company_id);
                        if (customer_user()) {
                            $where = array_merge($sql['where'], ['o.customer_id' => $this->session->user_id]);
                        } else {
                            $where = $sql['where'];
                        }
                        $orders = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $sql['order'], '', 6);
                        foreach ($orders as $row) { ?>
                            <tr>
                                <td><?php ajax_page_button('orders/view/'.$row->id, '', 'btn-light btn-raised btn-xs', 'View order', 'eye'); ?></td>
                                <?php if (company_user()) { ?>
                                    <td><?php echo $row->customer_name; ?></td>
                                    <?php 
                                } ?>
                                <td><?php echo $row->ref_id; ?></td>
                                <td><?php echo $row->product_count; ?></td>
                                <td><?php echo $row->placed_on; ?></td>
                                <td><span class="badge badge-pill badge-<?php echo $row->order_status_bg; ?> text-uppercase"><?php echo $row->order_status; ?></span> </td>
                            </tr>
                            <?php 
                        } ?>
                    </tbody>
                </table>
            </div>
            <?php ajax_page_button('orders', 'View All &raquo;', 'btn-primary btn-raised'); ?>
        </div>
    </div>
</div>