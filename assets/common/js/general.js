jQuery(document).ready(function ($) {
    "use strict";  

    //auto-close flashdata alert boxes
    $(".alert-dismissable.auto_dismiss").delay(10000).fadeOut('slow', function() {
        $(this).alert('close');
    });

    //select picker
    $('.selectpicker').selectpicker({
        liveSearch: true,
        virtualScroll: true
    });


    var req_attr = $('input.form-control').attr('required');
	if (typeof req_attr !== typeof undefined && req_attr !== false) {
	    $('input.form-control').css('border-color', '#f2f2f2');
	    $(this).focusout(function(){
	    	if ($(this).val() == '') {
	    		$(this).css('border-color', '#eb7374');
	    	} 
	    });
	    $(document).on('input', 'input.form-control', function(){
	    	if ($(this).val() !== '') {
	    		$(this).css('border-color', '#f2f2f2');
	    	} 
	    });
	}

    $(document).ready(function(){
        $('.file_input').on('change', function(){ 
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var parent = $(this).closest('.file_preview_area');
                $(parent).find('.file_preview').html(''); //clear html of output element
                var data = $(this)[0].files; //this file data 

                $.each(data, function(i, file){ 
                    if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {
                            var card = 
                            `<div class="card preview_thumb">
                              <img src="${e.target.result}" class="card-img-top" title="${file.name}">
                              <div class="card-body">
                                <p class="card-text hide">${file.name}</p>
                              </div>
                            </div>`;
                            $(parent).find('.file_preview').append(card); //append image to output element
                        };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    } else {
                        var ext = file.name.split('.').pop();
                        var src = file_preview_src(ext);
                        var card = 
                        `<div class="card preview_thumb">
                          <img src="${src}" class="card-img-top" title="${file.name}">
                          <div class="card-body">
                            <p class="card-text hide">${file.name}</p>
                          </div>
                        </div>`;
                        $(parent).find('.file_preview').append(card); //append image to output element
                    }
                });
                
            }else{
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });

    function file_preview_src(ext) {
        var path = base_url+'assets/common/img/icons/';
        switch (ext.toLowerCase()) {
            case 'pdf':
                return path += 'pdf.png';
                break;
            case 'doc':
            case 'docx':
                return path += 'word.png';
                break;
            case 'xls':
            case 'xlsx':
            case 'ods':
                return path += 'excel.png';
                break;
            case 'pptm':
            case 'ppsm':
                return path += 'ppt.png';
                break;
            case 'zip':
            case 'rar':
                return path += 'zip.png';
                break;
            case 'mp2':
            case 'mp3':
            case 'wav':
            case 'wma':
            case 'acc':
            case 'amr':
                return path += 'audio.png';
                break;
            case 'mp4':
            case 'avi':
            case 'mpg':
            case '3gp':
            case 'mov':
            case 'mkv':
            case 'ogv':
            case 'flv':
                return path += 'video.png';
                break;
            case 'exe':
                return path += 'exe.png';
                break;
            default:
                return path += 'file.png';
                break;
        }
    }

});

//render thumbnail image in big image box
$(document).on('click', '.cloud_small_image', function(){
    $('.cloud_big_image').prop('src', $(this).prop('src'));
});


function url_title(str) {
    return str.toLowerCase().replace(/ /g, '-').replace(/[-]+/g, '-').replace(/[^\w-]+/g, '');
}

function image_exists(url){
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status != 404;
}

function rating_stars(rating) {
  var diff = 5 - rating, rated = '', unrated = '';
  //rated
  for (var i = 0; i < rating; i++) {
    rated += '<i class="fa fa-star"></i>'; 
  }
  //unrated
  if (diff > 0) {
      for (var i = 0; i < diff; i++) {
        unrated += '<i class="fa fa-star-o"></i>'; 
      }
  }
  return '<span class="rating">'+rated+unrated+'</span>';
}

function print_color(code, name = '', pos = 'right', icon = 'square') {
    if (code == '') return '';
    var color = '<i class="fa fa-'+icon+'" style="color: '+code+'"></i> ';
    //if name is not set, use only color
    if ( ! name.length) return color;
    color = pos == 'left' ? (color+' '+name) : (name+' '+color);
    return color;
}

function print_colors(codes, names = '', pos = 'left', icon = 'square', $return = 'string') {
    if (codes == null) return '';
    var colors_arr = [];
    //if names is not set, use only colors
    if (names == '') {
        var colors = codes.split(',');
        $.each(colors, function(i, code) {
            colors_arr.push(print_color(code, '', pos, icon));
        });
        return $return == 'array' ? colors_arr : colors_arr.join(' ');
    } 
    //combine array in code => name pairs
    var colors = Object.assign(...codes.split(',').map((k, i) => ({[k]: names.split(',')[i]})));
    console.log(colors);
    $.each(colors, function(code, name) {
        colors_arr.push(print_color(code, name, pos, icon));
    });
    return $return == 'array' ? colors_arr : colors_arr.join(', ');
}

function range_slider(id, min = 0, max = 100, val_min = 100, val_max = 1000) {
    $('#'+id).slider({
        range: true,
        min: min,
        max: max,
        values: [val_min, val_max],
        slide: function(e, ui) {
            $(this).closest('.slider-range').find('.price_min').val(ui.values[0]);
            $(this).closest('.slider-range').find('.price_max').val(ui.values[1]);
        }
  });
}

function clone_row() {
    `<table class="table table-striped table-hover table-sm">
        <thead class="text-white bg-light-dark">
            <tr>
                <th style="min-width: 150px">Role</th>
                <th>Parent</th>
                <th>Code</th>
                <th>Slots</th>
                <th>Use</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $slots = json_decode($row_TDept['cat_txt'], true);
            foreach ($roles as $role) {
                $slot = isset($slots[$catID]) ? $slots[$catID] : 0;
                ?>
                <tr class="roles_row">
                    <td class="name">
                        <?= $role['category_name'] ?>
                        <input type="hidden" name="role_idx[]" value="<?= $role['catID'] ?>">
                        <input type="hidden" name="category_name[]">
                    </td>
                    <td class="parent">
                        <?= $role['catname'] ?>
                        <input type="hidden" name="parent_id[]">
                    </td>
                    <td class="code">
                        <?= $role['code'] ?>
                        <input type="hidden" name="code[]">
                    </td>
                    <td class="slots">
                        <div class="input-group">
                            <input type="number" name="cat_inf[]" class="form-control" min="0" max="<?= $role['cat_inf'] ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">out of <?= $role['cat_inf'] ?></span>
                            </div>
                        </div>
                    </td>
                    <td class="use">
                        <input type="hidden" name="use[]" value="0">
                        <input type="checkbox" name="use[]" value="1" <?= $slot == 1 ? 'checked' : '' ?>>
                    </td>
                </tr>
                <?php
            } ?>
            <tr>
                <td colspan="5">
                    <button type="button" class="btn btn-primary" id="add_role">Add New</button>
                </td>
            </tr>   
        </tbody>
    </table>`;

    $('#add_role').on('click', function() {
        var total_rows = $('.roles_row').length;
        var last_row = total_rows-1;
        var clone = $('.roles_row').eq(last_row).clone();
        clone.find('.name').html('<input type="hidden" name="role_idx[]"><input type="text" name="category_name[]" class="form-control" style="width: 100%">');
        let roles = '<?= json_encode($roles) ?>';
        let parent = '<select name="parent_id[]" class="form-control">';
        $.each(JSON.parse(roles), function(i, role) {
            parent += `<option value="${role.category_id}">${role.category_name}</option>`;
        });
        parent += '</select>';
        clone.find('.parent').html(parent);
        clone.find('.code').html('<input type="text" name="code[]" class="form-control" style="width: 100px">');
        clone.find('.slots').html('<input type="number" name="cat_inf[]" class="form-control">');
        clone.find('.use').html('<input type="hidden" name="use[]" value="0"><i class="fa fa-remove text-danger cursor-pointer remove_row"></i>');
        clone.find('.role_id').val('');
        $('.roles_row').eq(last_row).after(clone);
    });
    $(document).on('click', '.remove_row', function() {
        var parent = $(this).closest('.roles_row').remove();
    });
}


