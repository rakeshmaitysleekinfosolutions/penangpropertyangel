require('./bootstrap');
require('./additional-methods');
require('./jquery.validate');
require ('./jquery.slimscroll');
import 'datatables.net-bs4'

import 'jquery-ui/ui/widgets/datepicker.js';
import 'select2/dist/js/select2';


import 'summernote';
import 'jquery-ui/ui/widgets/datepicker.js';
import 'bootstrap-datepicker';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function () {
    if($('.datetimepicker').length > 0 ){
        $('.datetimepicker').datepicker({
            format: 'dd-mm-yyyy'
        });
    }
});
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */




var $sidebarOverlay = $(".task-overlay");
$(".task-chat, #mobile_btn").on("click", function(e) {
    var $target = $($(this).attr("href"));
    if ($target.length) {
        $target.toggleClass("opened");
        $sidebarOverlay.toggleClass("opened");
        $("html").toggleClass("menu-opened");
        $sidebarOverlay.attr("data-reff", $(this).attr("href"))
    }
    e.preventDefault()
});

$sidebarOverlay.on("click", function(e) {
    var $target = $($(this).attr("data-reff"));
    if ($target.length) {
        $target.removeClass("opened");
        $("html").removeClass("menu-opened");
        $(this).removeClass("opened")
        $(".main-wrapper").removeClass("slide-nav-toggle");
    }
    e.preventDefault()
});

$(document).ready(function() {
    if($('.themes-icon').length > 0 ){
        $(".themes-icon").click(function () {
            $('.themes').toggleClass("active");
            $('.main-wrapper').removeClass('open-msg-box');
        });
    }
});

!function($) {
    "use strict";
    var Sidemenu = function() {
        this.$menuItem = $("#sidebar-menu a")
    };

    Sidemenu.prototype.menuItemClick = function(e) {
        if($(this).parent().hasClass("submenu")) {
            e.preventDefault();
        }
        if(!$(this).hasClass("subdrop")) {
            $("ul",$(this).parents("ul:first")).slideUp(350);
            $("a",$(this).parents("ul:first")).removeClass("subdrop");
            $(this).next("ul").slideDown(350);
            $(this).addClass("subdrop");
        }else if($(this).hasClass("subdrop")) {
            $(this).removeClass("subdrop");
            $(this).next("ul").slideUp(350);
        }
    },

        Sidemenu.prototype.init = function() {
            var $this  = this;
            $this.$menuItem.on('click', $this.menuItemClick);
            $("#sidebar-menu ul li.submenu a.active").parents("li:last").children("a:first").addClass("active").trigger("click");
        },
        $.Sidemenu = new Sidemenu, $.Sidemenu.Constructor = Sidemenu
}(window.jQuery),

    function($) {
        "use strict";
        var App = function() {
            this.$body = $("body")
        };
        App.prototype.init = function() {
            var $this = this;
            $(document).ready($this.onDocReady);
            $.Sidemenu.init();
        },
            $.App = new App, $.App.Constructor = App
    }(window.jQuery),

    function($) {
        "use strict";
        $.App.init();
    }(window.jQuery);

$(document).ready(function() {
    if($('select').length > 0 ){
        $('select').select2({
            width: '100%'
        });
    }
});


// $(document).ready(function() {
// 	if($('.floating').length > 0 ){
// 		$('.floating').on('focus blur', function (e) {
// 		$(this).parents('.form-focus').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
// 		}).trigger('blur');
// 	}
// });

$(document).ready(function() {
    if($('.msg-list-scroll').length > 0 ){
        $('.msg-list-scroll').slimscroll({
            height:'100%',
            color: '#878787',
            disableFadeOut : true,
            borderRadius:0,
            size:'4px',
            alwaysVisible:false,
            touchScrollStep : 100
        });
        var h=$(window).height()-124;
        $('.msg-list-scroll').height(h);
        $('.msg-sidebar .slimScrollDiv').height(h);

        $(window).resize(function(){
            var h=$(window).height()-124;
            $('.msg-list-scroll').height(h);
            $('.msg-sidebar .slimScrollDiv').height(h);
        });
    }
});

$(document).ready(function(){
    if($('.slimscroll').length > 0 ){
        $('.slimscroll').slimScroll({
            height: 'auto',
            width: '100%',
            position: 'right',
            size: "7px",
            color: '#ccc',
            wheelStep: 10,
            touchScrollStep : 100
        });
        var h=$(window).height()-60;
        $('.slimscroll').height(h);
        $('.sidebar .slimScrollDiv').height(h);

        $(window).resize(function(){
            var h=$(window).height()-60;
            $('.slimscroll').height(h);
            $('.sidebar .slimScrollDiv').height(h);
        });
    }
});

$(document).ready(function(){
    if($('.page-wrapper').length > 0 ){
        var height = $(window).height();
        $(".page-wrapper").css("min-height", height);
    }
});

$(window).resize(function(){
    if($('.page-wrapper').length > 0 ){
        var height = $(window).height();
        $(".page-wrapper").css("min-height", height);
    }
});




/*
$(document).ready(function() {
	if($('.datatable').length > 0 ){
		$('.datatable').DataTable({
			"bFilter": false,
		});
	}
});
*/
$(document).ready(function() {
    if($('[data-toggle="tooltip"]').length > 0 ){
        $('[data-toggle="tooltip"]').tooltip();
    }
});

$(document).ready(function(){
    if($('.btn-toggle').length > 0 ){
        $('.btn-toggle').click(function() {
            $(this).find('.btn').toggleClass('active');
            if ($(this).find('.btn-success').size()>0) {
                $(this).find('.btn').toggleClass('btn-success');
            }
        });
    }
});

$(document).ready(function() {
    if($('.main-wrapper').length > 0 ){
        var $wrapper = $(".main-wrapper");
        $(document).on('click', '#mobile_btn', function (e) {
            $(".dropdown.open > .dropdown-toggle").dropdown("toggle");
            return false;
        });
        $(document).on('click', '#mobile_btn', function (e) {
            $wrapper.toggleClass('slide-nav-toggle');
            $('#chat_sidebar').removeClass('opened');
            return false;
        });
        $(document).on('click', '#open_msg_box', function (e) {
            $wrapper.toggleClass('open-msg-box').removeClass('');
            $('.themes').removeClass('active');
            $('.dropdown').removeClass('open');
            return false;
        });
    }
});

$(document).ready(function(){
    if($('.dropdown-toggle').length > 0 ){
        $('.dropdown-toggle').click(function() {
            if ($('.main-wrapper').hasClass('open-msg-box')){
                $('.main-wrapper').removeClass('open-msg-box');
            }
        });
    }
});

$( document ).ready(function() {
    $('.table-responsive').on('shown.bs.dropdown', function (e) {
        var $table = $(this),
            $dropmenu = $(e.target).find('.dropdown-menu'),
            tableOffsetHeight = $table.offset().top + $table.height(),
            menuOffsetHeight = $dropmenu.offset().top + $dropmenu.outerHeight(true);

        if (menuOffsetHeight > tableOffsetHeight)
            $table.css("padding-bottom", menuOffsetHeight - tableOffsetHeight);
    });
    $('.table-responsive').on('hide.bs.dropdown', function () {
        $(this).css("padding-bottom", 0);
    });

    $('a[data-toggle="modal"]').on('click',function(){
        setTimeout(function(){ if($(".modal.custom-modal").hasClass('in')){
            $(".modal-backdrop").addClass('custom-backdrop');

        } },500);
    });
});

$(document).ready(function() {
    if($('.clickable-row').length > 0 ){
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    }
});
$( document ).ready(function() {
    if($('.checkbox-all').length > 0 ){
        $('.checkbox-all').click(function () {
            $('.checkmail').click();
        });
    }
    if($('.checkmail').length > 0 ){
        $('.checkmail').each(function() {
            $(this).click(function() {
                if($(this).closest('tr').hasClass("checked")){
                    $(this).closest('tr').removeClass('checked');
                } else {
                    $(this).closest('tr').addClass('checked');
                }
            });
        });
    }
    if($('.mail-important').length > 0 ){
        $(".mail-important").click(function(){
            $(this).find('i.fa').toggleClass("fa-star");
            $(this).find('i.fa').toggleClass("fa-star-o");
        });
    }
});

/* Dynamic Menu Selction */
/** Select Dynamic Menu*/
$('#menu a[href]').on('click', function() {

    sessionStorage.setItem('menu', $(this).attr('href'));
});

if (!sessionStorage.getItem('menu')) {
    $('#menu #dashboard').addClass('active');
} else {
    // Sets active and open to selected page in the left column menu.
    if (sessionStorage.getItem('menu') != '#') {
        $('#menu a[href=\'' + sessionStorage.getItem('menu') + '\']').parents('li').addClass('active');
    }

}

if (localStorage.getItem('sidebar') == 'active') {
    $('#button-menu i').replaceWith('<i class="fa fa-dedent fa-lg"></i>');

    $('#sidebar').addClass('active');

    // Slide Down Menu
    $('#menu li.active').has('ul').children('ul').addClass(' in');
    $('#menu li').not('.active').has('ul').children('ul').addClass('');
} else {
    $('#button-menu i').replaceWith('<i class="fa fa-indent fa-lg"></i>');
    $('#menu li li.active').has('ul').children('ul').addClass(' in');
    $('#menu li li').not('.active').has('ul').children('ul').addClass('');
}

// Menu button
$('#button-menu').on('click', function() {
    // Checks if the left column is active or not.
    if ($('#sidebar').hasClass('active')) {
        localStorage.setItem('sidebar', '');

        $('#button-menu i').replaceWith('<i class="fa fa-indent fa-lg"></i>');

        $('#sidebar').removeClass('active');

        $('#menu > li > ul').removeClass('in collapse');
        $('#menu > li > ul').removeAttr('style');
    } else {
        localStorage.setItem('sidebar', 'active');

        $('#button-menu i').replaceWith('<i class="fa fa-dedent fa-lg"></i>');

        $('#sidebar').addClass('active');

        // Add the slide down to open menu items
        $('#menu li.open').has('ul').children('ul').addClass('collapse in');
        $('#menu li').not('.open').has('ul').children('ul').addClass('collapse');
    }
});

// Image Manager
$(document).on('click', 'a[data-toggle=\'image\']', function(e) {
    var $element = $(this);
    //console.log($element);
    var $popover = $element.data('bs.popover'); // element has bs popover?

    e.preventDefault();

    // destroy all image popovers
    $('a[data-toggle="image"]').popover('destroy');

    // remove flickering (do not re-add popover when clicking for removal)
    if ($popover) {
        return;
    }
    console.log($element);
    $element.popover({
        html: true,
        placement: 'right',
        trigger: 'manual',
        content: function() {
            return '<a type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></a> <a type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>';
        }
    });

    $element.popover('show');
    console.log(1);
    $('#button-image').on('click', function() {
        var $button = $(this);
        var $icon   = $button.find('> i');

        $('#modal-image').remove();

        $.ajax({
            url: myLabel.filemanager + '?target=' + $element.parent().find('input').attr('id') + '&thumb=' + $element.attr('id') + '&type=' + $element.attr('type'),
            dataType: 'html',
            beforeSend: function() {
                $button.prop('disabled', true);
                if ($icon.length) {
                    $icon.attr('class', 'fa fa-circle-o-notch fa-spin');
                }
            },
            complete: function() {
                $button.prop('disabled', false);

                if ($icon.length) {
                    $icon.attr('class', 'fa fa-pencil');
                }
            },
            success: function(html) {
                $('body').append('<div id="modal-image" class="modal">' + html + '</div>');

                $('#modal-image').modal('show');
            }
        });

        $element.popover('destroy');
    });

    $('#button-clear').on('click', function() {
        $element.find('img').attr('src', $element.find('img').attr('data-placeholder'));

        $element.parent().find('input').val('');

        $element.popover('destroy');
    });
});

$('select[name="country_id"]').on('change', function() {
    var country_id = $('select[name="country_id"]').find(":selected").val();
    $.ajax({
        url: myLabel.states,
        dataType: 'json',
        method: 'POST',
        data: {
            country_id: country_id
        },
        beforeSend: function() {
            $('select[name="country_id"]').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        complete: function() {
            $('.fa-spin').remove();
        },
        success: function(json) {
            // console.log(json);
            // if (json['postcode_required'] == '1') {
            //     $('input[name=\'postcode\']').parent().parent().addClass('required');
            // } else {
            //     $('input[name=\'postcode\']').parent().parent().removeClass('required');
            // }
            var html = '';
            html = '<option value="">select option</option>';

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

            $('select[name="state_id"]').html(html);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});
$('select[name="country_id"]').trigger('change');

// Agent Form Validation
var $frmAgent = $("#frmAgent"),
    validate = ($.fn.validate !== undefined),
dataTable = ($.fn.dataTable !== undefined);
if ($frmAgent.length > 0 && validate) {
    $frmAgent.validate({
        rules:{
            firstname: {
                required: true,
                lettersonly: true
            },
            lastname: {
                required: true,
                lettersonly: true
            },
            email: {
                required: true,
                email: true
            },
            "input-password": {
                alphanumeric: true,
                nowhitespace: true
            },
            "input-confirm": {
                alphanumeric: true,
                nowhitespace: true,
                equalTo: "#input-password"
            },
            phone: {
                integer: true
            },
            mobile: {
                integer: true
            },
            postcode: {
                nowhitespace: true,
                integer: true
            },
        },
        submitHandler: function (form) {
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
                        //var i;

                        for (var i in json['error']) {
                            var element = $('#input-payment-' + i.replace('_', '-'));
                            //console.log(element);
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

if ($("#agentTable").length > 0 && dataTable) {
    var dataTable = $('#agentTable').DataTable( {
        "processing": true,
        "searching" : true,
        "paging": true,
        "order" : [],
        "ajax": {
            "url": myLabel.agents,
            "type": 'POST',
            "dataSrc": "data"
        },
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<div class="spinner"></div>'
        },
        "oLanguage": {
            "sEmptyTable": "Empty Table"
        },
        dom: 'lBfrtip',
        buttons: [
            'excel', 'csv', 'pdf'
        ],
        "columnDefs": [ {
            "targets": 0,
            "orderable": false
        },{
            visible: false
        } ],
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
    }).on('change', '.updateStatus', function (e) {
        var id      = $(this).attr('data-id');
        var status  = $(this).val();
        $.ajax({
            type: "POST",
            url: myLabel.updateStatus,
            cache: false,
            data: {id: id, status: status},
            success: function (res) {
                if (res.status) {
                    dataTable.ajax.reload();
                }
            }
        });
    }).on('click', '#checkAll', function () {
        $('#agentTable input[type=checkbox]').prop('checked', this.checked);
    });
}
$(document).on('click', '#delete', function (e) {
    var selected = [];
    $('#agentTable .selectCheckbox').each(function () {
        if ($(this).is(":checked")) {
            var id = $(this).data('id');

            if (id != undefined || id != 0 || id != '' || id != null) {
                selected.push(id);
            }
        }
    });

    if (selected.length > 0) {
        swal({
            title: "Confirm Delete",
            text: "Are you want to delete this record?(Yes/No)",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {

            setTimeout(function () {
                $.ajax({
                    type: "POST",
                    url: myLabel.delete,
                    data: {selected: selected},
                    cache: false,
                    success: function (res) {
                        if (res.status === true) {
                            swal(res.message);
                        } else {
                            swal(res.message);
                        }

                        dataTable.ajax.reload();
                    }
                });
            }, 2000);

        });
    } else {
        swal("You must select one record");
    }
});