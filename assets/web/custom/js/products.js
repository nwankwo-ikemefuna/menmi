jQuery(document).ready(function ($) {
    "use strict"; 

    //object to hold fetched cat products
    var cat_prods = {};
    $(document).on( "click", ".prod_cat", function() {
        $('#productTabContent').fadeTo( "slow", 0.33 );
        var cat_id = $(this).data('id');
        if ((cat_id in cat_prods)) {  
            var widget = '';
            //products for this cat already fetched, don't go to server
            var products = cat_prods[cat_id];
            $.each(products, (i, row) => {
                widget += product_grid_widget(row, 'col-md-3 col-sm-6');
            });
            $('#catprods').html(widget);
        } else {
            cat_products(cat_id);
        }
        $('#productTabContent').fadeTo( "fast", 1);
    });
    //homepage?
    if (current_page == 'home') {
      //cat
      var first_cat_obj = $('.prod_cat')[0];
      var first_cat_id = $(first_cat_obj).data('id');
      if (!(first_cat_id in cat_prods)) cat_products(first_cat_id);
    }
    function cat_products(cat_id) {
        $.ajax({
            url: base_url+'shop/cat_products_ajax',
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
                    cols += product_grid_widget(row, 'col-md-3 col-sm-6');
                });
                $('#catprods').html(cols);
            } 
        });
    }

    //object to hold our post data
    var post_data = {
      search: '',
      sort_by: '',
      price_min: '',
      price_max: '', 
      cat_idx: [],
      sizes: [],
      colors: [],
      min_rating: ''
    },
    prods_col = function(row) {
      return `
      <div class="item col-lg-4 col-md-4 col-sm-6 col-xs-12">
        ${product_grid_widget(row)}
      </div>`;
    },
    prod_succ_callbk = function(jres) {
      var found = jres.body.msg.total_rows;
      if (found == 0) {
        $('#products').html('<h4 class="text-danger">Could not find any item matching the specified criteria!</h4>');
      }
      $('#total_found').html(`${jres.body.msg.total_rows_formatted} products found`);
    },
    url = 'shop/products_ajax',
    elem = 'products',
    pagination = 'pagination';
    //any search term from get?
    post_data.search = $('[name="search"]').val();
    //cat from get?
    $('.product_category').each(function(i, elem) {
      if ($(elem).prop('checked')) 
        post_data.cat_idx.push($(this).val());
    });
    if (current_page == 'shop')
      paginate_data(url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk);
    paginate(url, elem, prods_col, pagination, post_data, prod_succ_callbk);

    //searching
    $(document).on('click', '#search_shop', function() {
      var search = $('[name="search"]').val();
      if (search.length) {
        post_data.search = search;
        paginate_data(url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk);
      }
    });
    $(document).on('click', '#cancel_search', function() {
      var search = $('[name="search"]').val();
      if (search.length) {
        $('[name="search"]').val('');
        post_data.search = '';
        paginate_data(url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk);
      }
    });
    //sorting
    $(document).on('change', '[name="sort_by"]', function() {
      var sort_by = $(this).val();
      post_data.sort_by = sort_by;
      paginate_data(url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk);
      console.log('post_data', post_data);
    });
    //apply price
    var price_min = $('.price_min').val(),
        price_max = $('.price_max').val();
    range_slider('price_range', Number(price_min), Number(price_max), Number(price_min), Number(price_max));
    $(document).on('click', '#apply_price', function() {
      post_data.price_min = Number($('.price_min').val());
      post_data.price_max = Number($('.price_max').val());
      paginate_data(url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk);
      console.log('post_data', post_data);
    });
    //category select
    $(document).on('change', '.product_category', function() {
      product_filter_box(this, $(this).val(), post_data.cat_idx);
      paginate_data(url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk);
      console.log('post_data', post_data);
    });
    //size select
    $(document).on('change', '.product_size', function() {
      product_filter_box(this, $(this).val(), post_data.sizes);
      paginate_data(url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk);
      console.log('post_data', post_data);
    });
    //color select
    $(document).on('change', '.product_color', function() {
      product_filter_box(this, $(this).val(), post_data.colors);
      paginate_data(url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk);
      console.log('post_data', post_data);
    });
    //rating select
    $(document).on('change', '.product_rating', function() {
      post_data.min_rating = $(this).val();
      paginate_data(url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk);
      console.log('post_data', post_data);
    });
    
    //clear filter
    $(document).on('click', '#clear_filter', function() {
      if ( ! $.isEmptyObject(post_data)) {
        //clear fields
        //reset price min and max with original data
        $('.price_min').val($('.price_min').data('orig_price_min'));
        $('.price_max').val($('.price_max').data('orig_price_max'));
        //clear search input
        $('[name="search"]').val('');
        //reset sort order
        $('[name="sort_by"]').val('').selectpicker('refresh');
        //clear checkfields
        $('.product_category, .product_size, .product_color, .product_rating').prop('checked', false);
        //clear post object values
        post_data = {
          search: '',
          sort_by: '',
          price_min: '',
          price_max: '', 
          cat_idx: [],
          sizes: [],
          colors: [],
          min_rating: ''
        };
        paginate_data(url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk);
      }
    });

    function product_filter_box(obj, val, arr) {
      if ($(obj).prop('checked')) {
        //if not in array, add
        if ( ! arr.includes(val)) 
          arr.push(val);
      } else {
        //if in array, remove
        if (arr.includes(val)) 
          arr.splice(arr.indexOf(val), 1);
      }
    }


    function product_grid_widget(row, item_class = '') {
      var amount_old = row.amount_old.length ? `<p class="old-price"> <span class="price-label">Regular Price:</span><span class="price">${row.amount_old}</span></p>` : '';
      var url = base_url+'shop/view/'+row.id+'/'+url_title(row.name);
      return `
      <div class="product-item p-b-10 ${item_class}">
        <div class="item-inner">
          <div class="product-thumbnail">
            <a href="${url}" class="product-item-photo"> <img class="product-image-photo" src="${row.image_file}" alt=""></a> 
          </div>
          <div class="pro-box-info">
            <div class="item-info">
              <div class="info-inner">
                <div class="item-title"> <h4><a title="${row.name}" href="${url}">${row.name} </a></h4> </div>
                <div class="item-content">
                <div class="">
                  <i class="fa fa-cube"></i> ${row.category} 
                  - 
                  <i class="fa fa-tint"></i> ${row.size_short_name}
                </div>
                <div class="">
                  ${print_colors(row.color_codes)}
                </div>
                <div>${rating_stars(row.rating)}</div>
                  <div class="item-price">
                    <div class="price-box">
                      <p class="special-price"><span class="price-label">Special Price</span><span class="price">${row.amount}</span></p>
                      ${amount_old}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-hover">
              <div class="product-item-actions">
                <div class="pro-actions">
                  <button class="action add-to-cart basket_product" type="button" title="Add to Cart" data-id="${row.id}"><span>Add to Cart</span></button>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>`;
    }

});

function qty_select(type, stock) {
  var result = document.getElementById('qty'); 
  var qty = result.value; 
  if (type == 'dec') {
    if (!isNaN(qty) && qty > 0) result.value--;
    return false;
  } else { //inc
    if (!isNaN(qty) && qty <= stock) result.value++;
    return false;
  }
}