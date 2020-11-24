window.Popper = require('popper.js').default;
window.$ = global.$ = window.jQuery = require('jquery');

require('./additional-methods');
require('./jquery.validate');
require('./loadingoverlay.min');
require ('./jquery.slimscroll');


require('./owl.carousel');

$.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
});
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
var $frmRegister = $("#frmRegister"),
    $frmLogin = $("#frmLogin"),
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

