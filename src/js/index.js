window.Popper = require('popper.js').default;
window.$ = global.$ = window.jQuery = require('jquery');

require('./additional-methods');
require('./jquery.validate');
require('./loadingoverlay.min');
require('./jquery.slimscroll');


require('./owl.carousel');

$.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
});
var $frmRegister = $("#frmRegister"),
    $frmLogin = $("#frmLogin"),
    $frmInspection = $('#inspection-arranged'),
    $frmRentFilter = $('#frm-rent-filter'),
    validate = ($.fn.validate !== undefined);

if ($frmRegister.length > 0 && validate) {
      $frmRegister.validate({
            rules:{
                  firstname: {
                        required: true,
                  },
                  lastname: {
                        required: true,
                  },
                  email: {
                        required: true,
                        email: true
                  },
                  password: {
                        required: true,
                        alphanumeric: true,
                        nowhitespace: true
                  },
                  confirm: {
                        required: true,
                        alphanumeric: true,
                        nowhitespace: true,
                        equalTo: "#input-password"
                  },
                  "input-agree": {
                        required: true,
                  }
            },
            submitHandler: function (form, event) {
                  event.preventDefault();
                  $.ajax({
                        type: "POST",
                        url: $(form).attr('action'),
                        dataType: "json",
                        data: $(form).serialize(),
                        beforeSend: function() {
                              $.LoadingOverlay("show");
                        },
                        success: function (json) {
                              if (json['error']) {
                                    //$('#button-register').button('reset');
                                    $.LoadingOverlay("hide");
                                    if (json['error']['warning']) {
                                          $('#my-container .signup-form').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                                    }
                                    for (var i in json['error']) {
                                          var element = $('#input-' + i.replace('_', '-'));
                                          if ($(element).parent().hasClass('input-group')) {
                                                $(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
                                          } else {
                                                $(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
                                          }
                                    }
                                    // Highlight any found errors
                                    $('.text-danger').parent().addClass('has-error');
                              }
                              if (json['success']) {
                                    setTimeout(function() {
                                          $('#my-container > .signup-form').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i>  ' + json['success'] + '</div>');
                                          location.href = json['redirect'];
                                    },3000);
                              }
                        }
                  });

                  return false; // required to block normal submit since you used ajax
            }

      });
}
if ($frmLogin.length > 0 && validate) {
      $frmLogin.validate({
            rules:{
                  email: {
                        required: true,
                        email: true
                  },
                  password: {
                        required: true,
                  },
                  "input-remember": {
                        required: true,
                  }
            },
            submitHandler: function (form, event) {
                  event.preventDefault();
                  $.ajax({
                        type: "POST",
                        url: $(form).attr('action'),
                        dataType: "json",
                        data: $(form).serialize(),
                        beforeSend: function() {
                              $.LoadingOverlay("show");
                        },
                        success: function (json) {
                              console.log(json);
                              if (json['error']) {
                                    //$('#button-register').button('reset');
                                    $.LoadingOverlay("hide");
                                    if (json['error']['warning']) {
                                          $('#loginFormContainer > .loginForm').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                                    }
                                    for (var i in json['error']) {
                                          var element = $('#input-login-' + i.replace('_', '-'));
                                          if ($(element).parent().hasClass('input-group')) {
                                                $(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
                                          } else {
                                                $(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
                                          }
                                    }
                                    // Highlight any found errors
                                    $('.text-danger').parent().addClass('has-error');
                              }
                              if (json['success']) {
                                    setTimeout(function() {
                                          $('#loginFormContainer > .loginForm').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i>  ' + json['success'] + '</div>');
                                          location.href = json['redirect'];
                                    },3000);
                              }
                        }
                  });

                  return false; // required to block normal submit since you used ajax
            }

      });
}



var compare = {
      'add': function(product_id) {
            $.ajax({
                  url: myLabel.addCompare,
                  type: 'post',
                  data: {
                        product_id: product_id
                  },
                  dataType: 'json',
                  success: function(json) {
                        if (json['success']) {
                              $('#compare1').html(json['total']);
                        }
                  },
                  error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                  }
            });
      },
      'remove': function() {

      }
}

$(document).on('change', '#compare1', function() {
      var product_id = $(this).val();
      $.ajax({
            url: myLabel.addCompare,
            type: 'post',
            data: {
                  product_id: product_id,
                  compare: 'compare1',
            },
            dataType: 'json',
            success: function(json) {
                  if (json['success']) {
                        window.location.href = json['redirect'];
                        $('html, .campare_detail_div').animate({ scrollTop: 0 }, 'slow');
                        //$('#product1').html(json['body']);
                  }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
      });
});
$(document).on('change', '#compare2', function() {
      var product_id = $(this).val();
      $.ajax({
            url: myLabel.addCompare,
            type: 'post',
            data: {
                  product_id: product_id,
                  compare: 'compare2',
            },
            dataType: 'json',
            success: function(json) {
                  if (json['success']) {
                        window.location.href = json['redirect'];
                        console.log(json['redirect']);
                        $('#product2').html(json['body']);
                  }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
      });
});
$(document).on('change', '#compare3', function() {
      var product_id = $(this).val();
      $.ajax({
            url: myLabel.addCompare,
            type: 'post',
            data: {
                  product_id: product_id,
                  compare: 'compare3',
            },
            dataType: 'json',
            success: function(json) {
                  if (json['success']) {
                        window.location.href = json['redirect'];
                        $('#product3').html(json['body']);
                  }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
      });
});
// $('#btn_2').click(function(){
//       $('.fea_div2').show();
//       $('.fea_div3').hide();
// });
//
// $('#btn_3').click(function(){
//       $('.fea_div3').show();
//       $('.fea_div2').hide();
// });

$('.owl-carousel').owlCarousel({
      autoplay:true,
      dots:false,
      nav:true,
      loop:true,
      navText:['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
      responsive:{
            0:{
                  items:1
            },
            600:{
                  items:1
            },
            1000:{
                  items:1
            }
      }
});
$(document).on('click', '.sub-project', function() {
      var sub_project_id = $(this).attr('data-sub_project_id');
      console.log(sub_project_id);
      $.ajax({
            url: myLabel.fetchSubProject ,
            type: 'post',
            data: {
                  sub_project_id: sub_project_id,
            },
            beforeSend: function() {
                  $('.f_slider_start').LoadingOverlay("show");
            },
            dataType: 'html',
            success: function(html) {
                  $('.f_slider_start').LoadingOverlay("hide");
                  $('.f_slider_start').html(html);
                  $('.owl-carousel').owlCarousel({
                        autoplay:true,
                        dots:false,
                        nav:true,
                        loop:true,
                        navText:['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
                        responsive:{
                              0:{
                                    items:1
                              },
                              600:{
                                    items:1
                              },
                              1000:{
                                    items:1
                              }
                        }
                  });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
      });
});

var imageArray = myLabel.sliderImages;
console.log(imageArray);
var imageIndex = 0;

function changeImageByTimer() {
      bigImage = $('#fade_img');
      bigImage.animate({opacity: .1 }, function() { $(this).attr('src', imageArray[imageIndex]) });
      imageIndex++;
      console.log(imageIndex)

      if (imageIndex >= 2) {
            imageIndex = 0;
      }

      bigImage.animate({opacity: 1})
}

var imgTimer = setInterval(changeImageByTimer, 3000);

$('select[name="state_id"]').on('change', function() {
      var state_id = $('select[name="state_id"]').find(":selected").val();
      $.ajax({
            url: myLabel.childStates,
            dataType: 'json',
            method: 'POST',
            data: {
                  state_id: state_id
            },
            beforeSend: function() {
                  $('select[name="state_id"]').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
            },
            complete: function() {
                  $('.fa-spin').remove();
            },
            success: function(json) {
                  // }
                  var html = '';
                  // html = '<option value="">select option</option>';

                  if (json['states'] && json['states'] != '') {
                        for (var i = 0; i < json['states'].length; i++) {
                              html += '<option value="' + json['states'][i]['id'] + '"';
                              //console.log(json['states'][i]['id']);
                              if (json['states'][i]['id'] == myLabel.state_id) {

                                    html += ' selected="selected"';
                              }

                              html += '>' + json['states'][i]['name'] + '</option>';
                        }
                  } else {
                        html += '<option value="0" selected="selected">Empty</option>';
                  }

                  $('select[name="childstate_id"]').html(html);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                  //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
      });
});


// Price Range Slider
$(document).ready(function(){

     // $('#price-range-submit').hide();
      $(function () {
            $("#area-range").slider({
                  range: true,
                  orientation: "horizontal",
                  min: 1,
                  max: 999999999,
                  values: [1, 999999999],
                  step: 1,

                  slide: function (event, ui) {
                        if (ui.values[0] == ui.values[1]) {
                              return false;
                        }

                        $("#min_area").val(ui.values[0]);
                        $("#max_area").val(ui.values[1]);
                  }
            });
            $("#min_area").val($("#area-range").slider("values", 0));
            $("#max_area").val($("#area-range").slider("values", 1));

            // price range
            $("#price-range").slider({
                  range: true,
                  orientation: "horizontal",
                  min: 1,
                  max: 999999999,
                  values: [1, 999999999],
                  step: 1,

                  slide: function (event, ui) {
                        if (ui.values[0] == ui.values[1]) {
                              return false;
                        }

                        $("#min_price").val(ui.values[0]);
                        $("#max_price").val(ui.values[1]);
                  }
            });
            $("#min_price").val($("#price-range").slider("values", 0));
            $("#max_price").val($("#price-range").slider("values", 1));

      });

      // $("#slider-range,#price-range-submit").click(function () {
      //
      //       var min_price = $('#min_price').val();
      //       var max_price = $('#max_price').val();
      //
      //       $("#searchResults").text("Here List of products will be shown which are cost between " + min_price  +" "+ "and" + " "+ max_price + ".");
      // });

});

// Rent Filter
if ($frmRentFilter.length > 0 && validate) {
      $frmRentFilter.validate({
            submitHandler: function (form, event) {
                  event.preventDefault();
                  $.ajax({
                        type: "POST",
                        url: $(form).attr('action'),
                        dataType: "html",
                        data: $(form).serialize(),
                        beforeSend: function() {
                              $('#render-filter-data').LoadingOverlay("show");
                        },
                        success: function (html) {
                              $('#render-filter-data').LoadingOverlay("hide");
                              $('#render-filter-data').html(html);

                        }
                  });

                  return false; // required to block normal submit since you used ajax
            }

      });
}
$(document).on('click','#btn-reset', function(e) {
      location.reload();
})
// require('../datetimepicker/jquery.mousewheel.min');
// require('../datetimepicker/jquery.datetimepicker.min');

import 'jquery-datetimepicker';
$.datetimepicker.setLocale('en');
$('#inspection-arranged-datetime').datetimepicker({
      format:'m/d/Y H:i:a',
      formatDate:'d.m.Y',
      //defaultDate:'8.12.1986', // it's my birthday
      defaultDate:'+03.01.1970', // it's my birthday
      defaultTime:'10:00',
      timepickerScrollbar:false,
      minDate: new Date(),
      step:30

});
// From Inspection
if ($frmInspection.length > 0 && validate) {
      $frmInspection.validate({
            submitHandler: function (form, event) {
                  event.preventDefault();
                  $.ajax({
                        type: "POST",
                        url: $(form).attr('action'),
                        dataType: "json",
                        data: $(form).serialize(),
                        beforeSend: function() {
                              //$('#inspection-arranged-btn').LoadingOverlay("show");
                        },
                        success: function (json) {
                              //$('#inspection-arranged-btn').LoadingOverlay("hide");
                              if(json['error']) {
                                    $('#message').html(('<div class="alert alert-danger"><i class="fa fa-check-circle"></i>  ' + json['message'] + '</div>'))
                              }
                              if(json['success']) {
                                    $('#message').html(('<div class="alert alert-success"><i class="fa fa-check-circle"></i>  ' + json['message'] + '</div>'))
                                    $(form)[0].reset();
                              }


                        }
                  });

                  return false; // required to block normal submit since you used ajax
            }

      });
}

window.onload = function() {
      var $recaptcha = document.querySelector('#g-recaptcha-response');

      if($recaptcha) {
            $recaptcha.setAttribute("required", "required");
      }
};