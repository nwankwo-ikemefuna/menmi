jQuery(document).ready(function ($) {
    "use strict"; 

    //object to hold fetched products
    var cat_prods = {};

    $(document).on( "click", ".prod_cat", function() {
        $('#productTabContent').fadeTo( "slow", 0.33 );
        var cat_id = $(this).data('id');
        if ((cat_id in cat_prods)) {  
            var cols = '';
            //products for this cat already fetched, don't go to server
            var products = cat_prods[cat_id];
            $.each(products, (i, row) => {
                cols += prod_col(row);
            });
            $('#catprods').html(cols);
        } else {
            cat_products(cat_id);
        }
        $('#productTabContent').fadeTo( "fast", 1);
    });

    var first_cat_obj = $('.prod_cat')[0];
    var first_cat_id = $(first_cat_obj).data('id');
    if (!(first_cat_id in cat_prods)) cat_products(first_cat_id);

    function cat_products(cat_id) {
        $.ajax({
            url: base_url+'products/cat_products_ajax', 
            type: 'POST',
            data: {cat_id: cat_id},
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {}
        }).done(function(jres) {
            if (jres.status) {
                var cols = '';
                var products = {[cat_id]: jres.body.msg};
                //push to product object
                cat_prods = {...cat_prods, ...products};
                $.each(jres.body.msg, (i, row) => {
                    cols += prod_col(row);
                });
                $('#catprods').html(cols);
            } 
        });
    }

    function prod_col(row) {
        return `<div class="product-item col-md-3 col-sm-6">
            <div class="item-inner">
            <div class="product-thumbnail">
              <a href="${row.link}" class="product-item-photo">
                <img class="product-image-photo" src="${row.image}" alt="${row.name}">
              </a>
              <div class="jtv-box-timer">
                <div class="countbox_1 jtv-timer-grid"></div>
              </div>
            </div>
            <div class="pro-box-info">
              <div class="item-info">
                <div class="info-inner">
                  <div class="item-title">
                    <h4><a href="${row.link}" title="${row.name}"><span>${row.name}</span></a></h4>
                  </div>
                  <div class="item-content">
                    <div class="item-price">
                      <div class="price-box">
                        <span class="regular-price">
                          <span class="price"><span>${row.amount}</span> 
                        </span>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-hover">
                <div class="product-item-actions">
                  <div class="pro-actions">
                    <button class="action add-to-cart" type="button" title="Add to Cart">
                      <span>Add to Cart</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>`;
    }

});