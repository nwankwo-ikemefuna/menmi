<div class="main container">
  <div class="row">
   <div class="about-page">
      <div class="col-xs-12 col-sm-6 p-b-30"> 
        <h1><span class="text_color"><?php echo $this->company_name; ?></span></h1>
        <?php echo $this->session->company_description; ?>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="single-img-add sidebar-add-slider">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <?php
              $i = 1;
              foreach ($sliders as $row) { ?>
                <div class="item <?php echo $i == 1 ? 'active' : ''; ?>">
                  <a href="<?php echo strlen($row->url) ? $row->url : '#!'; ?>">
                    <img src="<?php echo $row->image_file; ?>" alt="<?php echo $row->name; ?>">
                  </a>
                </div>
                <?php
                $i++;
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>