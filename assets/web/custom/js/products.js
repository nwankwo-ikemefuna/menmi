jQuery(document).ready(function ($) {
    "use strict"; 

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
      } 
    };
    $(document).on( "click", ".prod_cat", function() {
        $('#productTabContent').fadeTo( "slow", 0.33 );
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
            fetch_data_ajax('shop/cat_products_ajax', {cat_id: prod_cat_id}, 'POST', cat_prods_callback);
        }
        $('#productTabContent').fadeTo( "fast", 1);
    });
    //homepage?
    if (current_page == 'home') {
      //cat
      var first_cat_obj = $('.prod_cat')[0];
      var first_cat_id = $(first_cat_obj).data('id');
      if (!(first_cat_id in cat_prods))
        fetch_data_ajax('shop/cat_products_ajax', {cat_id: first_cat_id}, 'POST', cat_prods_callback);
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
      console.log('in cart', row.in_cart);
      var url = base_url+'shop/view/'+row.id+'/'+url_title(row.name),
          amount_old = row.amount_old.length ? `<p class="old-price"> <span class="price-label">Regular Price:</span><span class="price">${row.amount_old}</span></p>` : '';
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
                  <button class="action add-to-cart basket_product" type="button" title="Add to Cart" data-id="${row.id}" data-qty="0" data-in_cart="${row.in_cart}" ${row.in_cart == 1 ? 'disabled' : ''}><span>Add to Cart</span></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>`;
    }

    //shopping cart
    var cart_prods = function(row) {
      var url = base_url+'shop/view/'+row.id+'/'+url_title(row.name);
      return `
      <li class="item odd"> <a href="${url}" title="${row.name}" class="product-image"><img src="${row.image_file}" alt="${row.name}" width="65"></a>
        <div class="product-details">
          <a href="${url}" title="Remove this item" class="remove_cart_product"><i class="pe-7s-trash text-danger"></i></a>
          <p class="product-name"><a href="${url}">${row.name}</a></p>
          <span class="price">${row.amount}</span>
        </div>
      </li>`;
    },
    cart_prods_callback = function(jres) {
      if (jres.status) {
        if (jres.body.msg.total == 0) {
          $('.cart_prods').html('<h6 class="text-danger text-center">Your cart is empty! Start shopping now.</h6>');
          $('.cart_actions').prop('disabled', true);
        } else {
          var accum = '';
          $.each(jres.body.msg.products, (i, row) => {
              accum += cart_prods(row);
          });
          $('.cart_prods').html(accum);
          $('.cart_prods_total').html(jres.body.msg.total_formatted);
          $('.cart_total_price').html(jres.body.msg.total_price);
          $('.cart_actions').prop('disabled', false);
          $('#m_cart_prods .modal-title').html(`My Cart (${jres.body.msg.total_formatted})`);
        }
      }
    };
    //add to cart
    var cart_url = base_url+'shop/cart_ajax';
    $(document).on('click', '.basket_product', function() {
      var id = $(this).data('id'),
          qty = $(this).data('qty'),
          in_cart = $(this).data('in_cart');
      //does item already exist in cart?
      if (Boolean(in_cart)) return false;
      //cart modal
      $('#m_cart_prods .cart_update_info').text('Item added to cart successfully').fadeIn('slow').delay(5000).fadeOut('slow');
      $('#m_cart_prods').modal('show');
      fetch_data_ajax(cart_url, {id: id, qty: qty, type: 'add'}, 'POST', cart_prods_callback);
      //update in cart to true
      $(this).prop('disabled', true);
    });
    //remove from cart
    $(document).on('click', '.remove_cart_product', function() {
      var id = $(this).data('id');
      fetch_data_ajax(cart_url, {id: id, type: 'remove'}, 'POST', cart_prods_callback);
      console.log('deleted id', id);
      console.log('orders', order);
    });
    //update cart
    $(document).on('click', '.update_cart', function() {
      var new_order = {};
      $.each(jres.body.msg.products, (i, row) => {
          var id = $(this).data('id'),
            qty = $(this).data('qty'),
            order = {[id]: qty};
          new_order.push(order);
      });
      fetch_data_ajax(cart_url, {id: id, type: 'update'}, 'POST', cart_prods_callback);
      console.log('new order', new_order);
    });

    //show cart on page load
    if ($('.cart_prods').length) {
      fetch_data_ajax(cart_url, {}, 'POST', cart_prods_callback);
    }

});

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