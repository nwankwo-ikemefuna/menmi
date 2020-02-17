<div class="card bg-secondary">
    <div class="card-body">
        <div class="row tile-count">
            <?php
            $stats = [
                ['Sold Products', 121, 'money'],
                ['Products In Stock', 366, 'shopping-bag'],
                ['Customers', 23, 'users'],
                ['Product Categories', 91, 'cubes']
            ];
            $product_image = base_url(get_file(company_file_path(PIX_PRODUCTS, 'dash1.jpeg'), IMAGE_404));
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
        <div class="card" style="border-radius: 10px">
            <div class="card-body">
                <img class="img-responsive" src="<?php echo $product_image; ?>">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="<?php echo grid_col(12, '', '', '', 4); ?> mb-2">
        <div class="h-100 bg-white padding-25">
            <h4 class="box-title mt-0">Recent sales</h4>
            <div class="table-responsive">
                <table class="table mt-0 mb-0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
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
                    <tr>
                        <td>Books</td>
                        <td><span class="badge badge-pill badge-info text-uppercase">EXTENDED</span></td>
                        <td>May 19</td>
                        <td><span class="text-info">$1400</span></td>
                    </tr>
                    <tr>
                        <td>Crafts</td>
                        <td><span class="badge badge-pill badge-danger text-uppercase">SALE</span></td>
                        <td>June 20</td>
                        <td><span class="text-danger">-$38</span></td>
                    </tr>
                    <tr>
                        <td>Video games</td>
                        <td><span class="badge badge-pill badge-success text-uppercase">EXTENDED</span></td>
                        <td>June 22</td>
                        <td><span class="text-success">$350</span></td>
                    </tr>
                    <tr>
                        <td>Shoes</td>
                        <td><span class="badge badge-pill badge-warning text-uppercase">EXTENDED</span></td>
                        <td>July 22</td>
                        <td><span class="text-warning">$64</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="<?php echo grid_col(12, '', '', '', 4); ?> mb-2 mb-xl-0">
        <div class="h-100 w-100 bg-white padding-25">
            <h4 class="box-title mt-0">Sales analytics</h4>
            <div id="columnChart"></div>
        </div>
    </div>
    <div class="<?php echo grid_col(12, '', '', '', 4); ?> mb-2 mb-lg-0">
        <div class="h-100 bg-white padding-25">
            <h4 class="box-title mt-0">New registrations</h4>
            <ul class="list-new-registrations list-group" data-role="newregistrationslist">
                <li class="list-group-item border-0 d-flex align-items-center justify-content-between pt-0" data-role="newregistrationslist">
                    <a href="#" class="d-flex justify-content-between align-items-center">
                        <div class="img-wrapper float-left"><img src="assets/common/img/avatar/generic.png" class="rounded-circle" alt="User Image"></div>
                        <h5>Richard Cook</h5>
                    </a>
                    <button type="button" class="btn"><i class="fa fa-ban"></i></button>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center justify-content-between" data-role="newregistrationslist">
                    <a href="#" class="d-flex justify-content-between align-items-center">
                        <div class="img-wrapper float-left"><img src="assets/common/img/avatar/generic.png" class="rounded-circle" alt="User Image"></div>
                        <h5>Richard Sevian</h5>
                    </a>
                    <button type="button" class="btn"><i class="fa fa-ban"></i></button>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center justify-content-between" data-role="newregistrationslist">
                    <a href="#" class="d-flex justify-content-between align-items-center">
                        <div class="img-wrapper float-left"><img src="assets/common/img/avatar/generic.png" class="rounded-circle" alt="User Image"></div>
                        <h5>Samuel Nelson</h5>
                    </a>
                    <button type="button" class="btn"><i class="fa fa-ban"></i></button>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center justify-content-between" data-role="newregistrationslist">
                    <a href="#" class="d-flex justify-content-between align-items-center">
                        <div class="img-wrapper float-left"><img src="assets/common/img/avatar/generic.png" class="rounded-circle" alt="User Image"></div>
                        <h5>Mary Cruise</h5>
                    </a>
                    <button type="button" class="btn"><i class="fa fa-ban"></i></button>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center justify-content-between" data-role="newregistrationslist">
                    <a href="#" class="d-flex justify-content-between align-items-center">
                        <div class="img-wrapper float-left"><img src="assets/common/img/avatar/generic.png" class="rounded-circle" alt="User Image"></div>
                        <h5>Jessica Anderson</h5>
                    </a>
                    <button type="button" class="btn"><i class="fa fa-ban"></i></button>
                </li>
            </ul>
        </div>
    </div>
</div>