jQuery(document).ready(function ($) {
    "use strict"; 

    /* =========================== HOME ==================== */
    //product categories
    var cat_prods = {},
        prod_cat_id = '',
    cat_prods_callback = function(jres) {
      if (jres.status) {
          var cols = '';
          var products = {[prod_cat_id]: jres.body.msg};
          //push to product object
          cat_prods = {...cat_prods, ...products};
          $.each(jres.body.msg, (i, row) => {
              cols += product_grid_widget(row, 'col-md-3 col-sm-6');
          });
          $('#catprods').html(cols);
          $('#cats_all_link').html(`<a class="btn btn_theme_white m-t-10-n" href="${base_url}shop?cat_id=${prod_cat_id}">See More &raquo;</a>`);
      } 
    };
    $(document).on( "click", ".prod_cat", function() {
        $(this).addClass('btn_theme_red').siblings().removeClass('btn_theme_red');
        $('#catprods').fadeTo( "slow", 0.33 );
        prod_cat_id = $(this).data('id');
        if ((prod_cat_id in cat_prods)) {  
            var widget = '';
            //products for this cat already fetched, don't go to server
            var products = cat_prods[prod_cat_id];
            $.each(products, (i, row) => {
                widget += product_grid_widget(row, 'col-md-3 col-sm-6');
            });
            $('#catprods').html(widget);
        } else {
            fetch_data_ajax('shop/cat_products_ajax', {cat_id: prod_cat_id}, 'POST', cat_prods_callback, null, true, 'Fetching category products');
        }
        $('#cats_all_link').html(`<a class="btn btn_theme_white m-t-10-n" href="${base_url}shop?cat_id=${prod_cat_id}">See More &raquo;</a>`);
        $('#catprods').fadeTo( "fast", 1);
    });
    //homepage?
    if (current_page == 'home') {
      //render first category products on page load
      var first_cat_obj = $('.prod_cat')[0];
      $(first_cat_obj).addClass('btn_theme_red');
      prod_cat_id = $(first_cat_obj).data('id');
      if (!(prod_cat_id in cat_prods)) {
        fetch_data_ajax('shop/cat_products_ajax', {cat_id: prod_cat_id}, 'POST', cat_prods_callback);
        cat_prods = {[prod_cat_id]: {}};
        $('#cats_all_link').html(`<a class="btn btn_theme_white m-t-10-n" href="${base_url}shop?cat_id=${prod_cat_id}">See More &raquo;</a>`);
      }
    }


    /* =========================== SHOP ==================== */
    //object to hold our post data
    var post_data = {
      search: '',
      sort_by: '',
      price_min: '',
      price_max: '', 
      min_rating: '',
      cat_idx: [],
      sizes: [],
      colors: [],
      list_type: '',
      tag: '',
      rel_id: '',
      rel_tags: '',
    },
    prods_col = function(row) {
      return `
      <div class="item col-lg-4 col-md-4 col-sm-6 col-xs-12">
        ${product_grid_widget(row)}
      </div>`;
    },
    prod_succ_callbk = function(jres) {
      var found = jres.body.msg.total_rows;
      var products_inflect = found == 1 ? 'product' : 'products';
      if (found == 0) {
        $('#products').html('<h4 class="text-danger m-l-5">Could not find any item matching the specified criteria!</h4>');
        $('#empty_wishlist').hide();
      }
      $('#total_found').html(`${jres.body.msg.total_rows_formatted} ${products_inflect} found`);
    },
    shop_url = 'shop/products_ajax',
    elem = 'products',
    pagination = 'pagination';
    //params from get
    post_data.list_type = $('[name="list_type"]').val();
    post_data.rel_id = $('[name="list_type"]').data('rel_id');
    post_data.rel_tags = $('[name="list_type"]').data('rel_tags');
    post_data.tag = $('[name="list_type"]').data('tag');
    post_data.search = $('[name="search"]').val();
    $('.product_category').each(function(i, elem) {
      if ($(elem).prop('checked')) 
        post_data.cat_idx.push($(this).val());
    });
    if (current_page == 'shop')
      paginate_data(shop_url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk, null, true, 'Fetching products');
    ci_paginate(shop_url, elem, prods_col, pagination, post_data, 'products', prod_succ_callbk);

    //searching
    $(document).on('click', '#search_shop', function() {
      var search = $('[name="search"]').val();
      if (search.length) {
        post_data.search = search;
        paginate_data(shop_url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk, null, true, 'Fetching matching products');
      }
    });
    $(document).on('click', '#cancel_search', function() {
      var search = $('[name="search"]').val();
      if (search.length) {
        $('[name="search"]').val('');
        post_data.search = '';
        paginate_data(shop_url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk, null, true, 'Applying changes');
      }
    });
    //sorting
    $(document).on('change', '[name="sort_by"]', function() {
      var sort_by = $(this).val();
      post_data.sort_by = sort_by;
      paginate_data(shop_url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk, null, true, 'Applying sort');
    });
    //apply price
    var price_min = $('.price_min').val(),
        price_max = $('.price_max').val();
    range_slider('price_range', Number(price_min), Number(price_max), Number(price_min), Number(price_max));
    range_slider('price_range_side', Number(price_min), Number(price_max), Number(price_min), Number(price_max));
    $(document).on('click', '.apply_price', function() {
      var p_min = Number($(this).closest('.price_range_wrapper').find('.price_min').val());
      var p_max = Number($(this).closest('.price_range_wrapper').find('.price_max').val());
      //update all with this class
      $('.price_min').val(p_min);
      $('.price_max').val(p_max);
      post_data.price_min = p_min;
      post_data.price_max = p_max;
      paginate_data(shop_url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk, null, true, 'Fetching matching products');
    });
    //category select
    $(document).on('change', '.product_category', function() {
      product_filter_box(this, $(this).val(), post_data.cat_idx);
      paginate_data(shop_url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk, null, true, 'Fetching matching products');
    });
    //size select
    $(document).on('change', '.product_size', function() {
      product_filter_box(this, $(this).val(), post_data.sizes);
      paginate_data(shop_url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk, null, true, 'Fetching matching products');
    });
    //color select
    $(document).on('change', '.product_color', function() {
      product_filter_box(this, $(this).val(), post_data.colors);
      paginate_data(shop_url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk, null, true, 'Fetching matching products');
    });
    //rating select
    $(document).on('change', '.product_rating', function() {
      post_data.min_rating = $(this).val();
      paginate_data(shop_url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk, null, true, 'Fetching matching products');
    });
    //clear filter
    $(document).on('click', '#clear_filter', function() {
      if ($.isEmptyObject(post_data)) return false;
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
        min_rating: '',
        cat_idx: [],
        sizes: [],
        colors: [],
        //retain the data of these guys
        list_type: post_data.list_type,
        tag: post_data.tag,
        rel_id: post_data.rel_id,
        rel_tags: post_data.rel_tags
      };
      paginate_data(shop_url, elem, prods_col, pagination, 0, post_data, prod_succ_callbk, null, true, 'Clearing filters');
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
      var url = product_url(row.id, row.name),
          image_url = base_url+row.image_file,
          amount_old = row.amount_old.length ? `<p class="old-price"> <span class="price-label">Regular Price:</span><span class="price">${row.amount_old}</span></p>` : '';
      return `
      <div class="product-item p-b-10 ${item_class}">
        <div class="item-inner">
          <div class="product-thumbnail">
            <div class="box-hover">
              <div class="btn-quickview"><a href="${url}"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
              </div>
              <div class="add-to-links text-center" data-role="add-to-links">
                <a class="action add-to-wishlist clickable wishlist_product" type="button" title="Add to Wishlist" data-id="${row.id}" data-in_wishlist="${row.in_wishlist}" ${row.in_wishlist == 1 ? 'disabled' : ''}></a>
              </div>
            </div>
            <a href="${url}" class="product-item-photo"> <img class="product-image-photo" src="${image_url}" alt=""></a> 
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
                  <button class="action add-to-cart basket_product" type="button" title="Add to Cart" data-id="${row.id}" data-qty="0" data-in_cart="${row.in_cart}" ${row.in_cart == 1 || row.stock < 1 ? 'disabled' : ''}><span>Add to Cart</span></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>`;
    }

    //render thumbnail image in big image box
    $(document).on('click', '.cloud_small_image', function(){
        $('.cloud_big_image').prop('src', $(this).prop('src'));
    });



    /* =========================== WISHLIST ACTIONS ==================== */
    var wishlist_url = base_url+'shop/wishlist_ajax';
    //add to wishlist
    $(document).on('click', '.wishlist_product', function() {
      var id = $(this).data('id'),
          in_wishlist = $(this).data('in_wishlist');
      //does item already exist in wishlist?
      if (Boolean(in_wishlist)) return false;
      fetch_data_ajax(wishlist_url, {type: 'add', id: id}, 'POST', null, null, true, 'Adding item to wishlist');
      //update in cart to true
      $(this).prop('disabled', true);
    });
    //remove product from wishlist
    $(document).on('click', '.remove_wishlist_product', function() {
      var id = $(this).data('id');
      fetch_data_ajax(wishlist_url, {type: 'remove', id: id}, 'POST', null, null, true, 'Removing item from wishlist');
    });
    //empty wishlist
    /*$(document).on('click', '#empty_wishlist', function() {
      if (confirm('Are you sure you want to empty your wishlist?')) {
        fetch_data_ajax(wishlist_url, {type: 'empty'}, 'POST', null, null, true, 'Clearing wishlist');
        init_cart_data();
      }
      return false;
    });*/



    /* =========================== CART ACTIONS ==================== */
    //cart products preview - in header
    var cart_prods_preview_mini = function(row) {
      var url = product_url(row.id, row.name),
          image_url = base_url+row.image_file;
      return `
      <li class="item odd"> <a href="${url}" title="${row.name}" class="product-image"><img src="${image_url}" alt="${row.name}" width="65"></a>
        <div class="product-details">
          <a title="Remove this item from cart" class="remove-cart remove_cart_product" data-id="${row.id}"><i class="icon-close text-danger"></i></a>
          <p class="product-name"><a href="${url}">${row.name}</a></p>
          <strong>${row.qty}</strong> x <span class="price">${row.amount}</span>
        </div>
      </li>`;
    },
    cart_prods_preview_modal = function(row) {
      var url = product_url(row.id, row.name),
          image_url = base_url+row.image_file;
      return `
      <tr>
        <td class="cart_product text-center"><a href="${url}"><img src="${image_url}" alt="${row.name}"></a></td>
        <td class="cart_description">
          <p class="product-name text-bold"><a href="${url}">${row.name}</a></p>
          <small>Category: ${row.category}</small> <br>
          <small>Size: ${row.size_name}</small> <br>
        </td>
        <td class="price"><strong>${row.qty}</strong> x <span>${row.amount}</span></td>
        <td class="action"><i class="icon-close text-danger clickable remove_cart_product" data-id="${row.id}" title="Remove this item from cart"></i></td>
      </tr>`;
    },
    cart_prods_table = function(row) {
      var url = product_url(row.id, row.name),
          image_url = base_url+row.image_file,
          in_stock = row.stock > 0 ? 'In stock' : 'Sold out',
          in_stock_class = row.stock > 0 ? 'text-success' : 'text-danger',
          in_stock_readonly = row.stock > 0 ? '' : 'readonly';
      return `
      <tr>
        <td class="cart_product"><a href="${url}"><img src="${image_url}" alt="${row.name}"></a></td>
        <td class="cart_description">
          <p class="product-name text-bold"><a href="${url}">${row.name}</a></p>
          <small>Category: ${row.category}</small> <br>
          <small>Size: ${row.size_name}</small> <br>
          <small>Colors: ${print_colors(row.color_codes)}</small> <br>
          <small>Availability: <span class="${in_stock_class}">${in_stock}</span></small>
        </td>
        <td class="price"><span>${row.amount}</span></td>
        <td class="qty"><input class="form-control input-sm product_qty" type="number" value="${row.qty}" min="1" max="${row.stock}" data-id="${row.id}" ${in_stock_readonly} style="width: 100px"></td>
        <td class="price"><span>${row.product_total_amount}</span></td>
        <td class="action"><i class="icon-close text-danger clickable remove_cart_product" data-id="${row.id}" title="Remove this item from cart"></i></td>
      </tr>`;
    },
    cart_prods_succ_callbk = function(jres) {
      if (jres.status) {
        if (jres.body.msg.total_products == 0) {
          init_cart_data();
        } else {
          var accum_cart_mini = '';
          var accum_cart_modal = '';
          var accum_cart_table = '';
          $.each(jres.body.msg.products, (i, row) => {
            //mini cart
            accum_cart_mini += cart_prods_preview_mini(row);
            //modal cart
            accum_cart_modal += cart_prods_preview_modal(row);
            //cart table
            accum_cart_table += cart_prods_table(row);
          });
          $('#cart_prods_preview_mini').html(accum_cart_mini);
          $('#cart_prods_preview_modal').html(accum_cart_modal);
          $('#cart_prods_table').html(accum_cart_table);
          $('.cart_prods_total').html(jres.body.msg.total_products_formatted);
          $('.cart_total_price').html(jres.body.msg.total_amount);
          $('[name="total_price"]').val(jres.body.msg.total_price);
          $('.cart_grand_total_price').html(jres.body.msg.total_amount);
          $('.continue_shopping').text('Continue Shopping');
          $('.cart_actions').show();
        }
      }
    },
    cart_url = base_url+'shop/cart_ajax';
    //show mini and/or table cart on page load
    if ($('#cart_prods_preview_mini').length || $('#cart_prods_table').length) {
      //show prcessing indicator on cart page
      var indicator = Boolean($('#cart_prods_table').length);
      fetch_data_ajax(cart_url, {}, 'POST', cart_prods_succ_callbk, null, indicator, 'Fetching products');
    }

    //add to cart
    $(document).on('click', '.basket_product', function() {
      var id = $(this).data('id'),
          qty = $(this).data('qty'),
          in_cart = $(this).data('in_cart');
      //does item already exist in cart?
      if (Boolean(in_cart)) return false;
      //cart modal
      $('#m_cart_prods .cart_update_info').text('Item added to cart successfully').fadeIn('slow').delay(5000).fadeOut('slow');
      $('#m_cart_prods').modal('show');
      fetch_data_ajax(cart_url, {type: 'add', id: id, qty: qty}, 'POST', cart_prods_succ_callbk);
      //update in cart to true
      $(this).prop('disabled', true);
    });
    //update cart
    $(document).on('click', '#update_cart', function() {
      var cart = $('.product_qty');
      var full_cart = {};
      $.each(cart, (i, elem) => {
          var id = $(elem).data('id'),
              qty = $(elem).val(),
              order = {[id]: qty};
          full_cart = {...full_cart, ...order};
      });
      fetch_data_ajax(cart_url, {type: 'update', full_cart: full_cart}, 'POST', cart_prods_succ_callbk, null, true, 'Updating cart');
    });
    //remove product from cart
    $(document).on('click', '.remove_cart_product', function() {
      var id = $(this).data('id');
      fetch_data_ajax(cart_url, {type: 'remove', id: id}, 'POST', cart_prods_succ_callbk, null, true, 'Removing item from cart');
    });
    //reload cart
    $(document).on('click', '.reload_cart', function() {
      if (confirm('Are you sure you want to reload your cart?')) {
        fetch_data_ajax(cart_url, {}, 'POST', cart_prods_succ_callbk, null, true, 'Reloading cart');
      }
      return false;
    });
    //empty cart
    $(document).on('click', '#empty_cart', function() {
      if (confirm('Are you sure you want to empty your cart?')) {
        fetch_data_ajax(cart_url, {type: 'empty'}, 'POST', cart_prods_succ_callbk, null, true, 'Clearing cart');
        init_cart_data();
      }
      return false;
    });


    /*================== CHECKOUT ACTIONS =================== */
    //fetch profile and populate checkout fields
    var profile_succ_callbk = function(jres) {
      var data = jres.body.msg;
      if ($.isEmptyObject(data)) {
        status_box('profile_msg', 'Could not locate a profile associated with the provided email address!', 'danger', 'id');
      } else {
        status_box('profile_msg', 'Profile fetched and populated successfully', 'success', 'id');
        fill_form_fields('checkout_form', data, ['total_price', 'payment_method', 'currency_key']);
      }
    };
    $(document).on('click', '#fetch_profile', function() {
      var email = $('[name="email"]').val();
      if ( ! email.length) return false;
        fetch_data_ajax(base_url+'shop/fetch_profile_ajax', {email: email}, 'POST', profile_succ_callbk, null, true, 'Fetching profile');
    });
    if (current_page == 'checkout') {
      //shipping address same as billing address?
      toggle_elem_prop('#ship_is_bill', '#shipping_address', 'checked', true);
      toggle_elem_prop_trigger('#ship_is_bill', '#shipping_address', true);
      //payment method
      toggle_elem_val('[name="payment_method"]', '#payment_online', '#payment_offline', payment_methods.online);
      toggle_elem_val_trigger('[name="payment_method"]', '#payment_online', '#payment_offline', payment_methods.online);
    }

    $('#checkout_form').on( "submit", function(e) {
      e.preventDefault();
      var form_data = new FormData(this);
      // console.log(...form_data);
      //online payment? let's pay with paystack first before submitting order
      var payment_method = $('[name="payment_method"]:checked').val()
      if (payment_method == payment_methods.online) {
        
        //initiate payment
        var initpay_succ_callbk = function(jres) {
          if ( ! jres.status) {
            status_box('status_msg', jres.error, 'danger');
          } else {
            //pay with paystack
            var paystack_succ_callbk = function(pres) {
              if ( ! pres.status) {
                status_box('status_msg', 'Unable to complete transaction', 'danger');
              } else {
                //append payment id to form data
                form_data.append('payment_id', pres.body.msg);
                process_order(form_data);
              }
            };
            var paystack_data = {
              email: $('[name="email"]').val(),
              first_name: $('[name="first_name"]').val(),
              last_name: $('[name="last_name"]').val(),
              amount: +$('[name="total_price"]').val(),
              currency_key: $('[name="currency_key"]').val()
            };
            payWithPaystack('shop/paystack_verify', paystack_data, paystack_succ_callbk);
          }
        };
        var initpay_url = base_url+'shop/initiate_payment';
        post_data_ajax(initpay_url, form_data, true, initpay_succ_callbk);
        
      } else {
        //offline payment
        process_order(form_data);
      }
    });

    function process_order(form_data) {
      var checkout_url = base_url+'shop/checkout_ajax';
      return ajax_post_form('checkout_form', form_data, checkout_url, 'redirect', '_dynamic', 'Order submitted successfully');
    }

});

function init_cart_data() {
  var empty_cart_msg = 'Your cart is empty! Start shopping now.';
  $('.cart_prods_total').html(0);
  $('.cart_total_price').html('0.00');
  $('[name="total_price"]').html(0);
  $('.cart_grand_total_price').html('0.00'); //for now
  $('#cart_prods_preview_mini').html(`<h6 class="text-danger text-center m-t-10">${empty_cart_msg}</h6>`);
  $('#cart_prods_preview_modal').html(`<tr><td colspan="4"><h4 class="text-danger text-center">${empty_cart_msg}</h4></td></tr>`);
  $('#cart_prods_table').html(`<tr><td colspan="6"><h4 class="text-danger text-center">${empty_cart_msg}</h4></td></tr>`);
  $('.continue_shopping').text('Start Shopping');
  $('.cart_actions').hide();
}

function product_url(id, name = '') {
  return base_url+'shop/view/'+id+'/'+url_title(name);
}

function qty_select(type, stock) {
  var result = document.getElementById('qty'); 
  var qty = result.value; 
  if (type == 'dec') {
    if (!isNaN(qty) && qty > 0) result.value--;
    return false;
  } else { //inc
    if (!isNaN(qty) && qty < stock) result.value++;
    return false;
  }
}