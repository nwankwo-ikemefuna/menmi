<div class="main container">
  <div class="row">
    <section class="col-main col-sm-12">
      <div id="contact" class="page-content page-contact">
        <div class="page-title  m-t-30">
          <h2>Our Contact</h2>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6 p-b-30" id="contact_form_map">
            <p><?php echo $this->session->company_short_description; ?></p>
            <ul class="store_info">
              <li><i class="fa fa-home"></i><?php echo $this->session->company_address_1; ?></li>
              <li><i class="fa fa-phone"></i><span><?php echo $this->session->company_phone_1; ?></span></li>
              <li><i class="fa fa-phone"></i><span><?php echo $this->session->company_phone_2; ?></span></li>
              <li><i class="fa fa-envelope"></i><span><a href="mailto:<?php echo $this->session->company_email_1; ?>"><?php echo $this->session->company_email_1; ?></a></span></li>
            </ul>
          </div>
          <div class="col-sm-6">
            <h3 class="page-subheading">Get in touch with us</h3>
            <div class="contact-form-box">
              <?php 
              $attrs = ['id' => 'contact_form', 'class' => 'ajax_form', 'data-type' => 'none', 'data-redirect' => '_void', 'data-msg' => "Thank you for reaching out to us. We'll get in touch with you as soon as we can", 'data-clear' => true];
              echo form_open($this->c_controller.'/contact_ajax', $attrs); ?>
                <div class="form-selector">
                  <label>First Name</label>
                  <input type="text" name="first_name" class="form-control input-sm" required />
                </div>
                <div class="form-selector">
                  <label>Last Name</label>
                  <input type="text" name="last_name" class="form-control input-sm" required />
                </div>
                <div class="form-selector">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control input-sm" required />
                </div>
                <div class="form-selector">
                  <label>Phone</label>
                  <input type="text" name="phone" class="form-control input-sm" required />
                </div>
                <div class="form-selector">
                  <label>Message</label>
                  <textarea name="message" class="form-control input-sm" rows="10" required></textarea>
                </div>
                <?php xform_notice(); ?>
                <div class="form-selector">
                  <button class="button"><i class="fa fa-send"></i>&nbsp; <span>Send Message</span></button>
                </div>
                <?php
              echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>