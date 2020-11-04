// Agent
!function ($) {
    "use strict";
    var $frmAgent = $("#frmAgent"),
        validate = ($.fn.validate !== undefined);
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
                    required: true,
                    alphanumeric: true,
                    nowhitespace: true
                },
                "input-confirm": {
                    required: true,
                    alphanumeric: true,
                    nowhitespace: true,
                    equalTo: "#input-password"
                }
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
    if ($(".datatable").length > 0 && dataTable) {
        var dataTable = $('.datatable').DataTable( {
            "processing": true,
            "searching" : true,
            "paging": true,
            "order" : [],
            "ajax": {
                "url": myLabel.users,
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
        }).on('click', '.edit', function (e) {
            var id = $(this).data('id');
            window.location.href = myLabel.edit + id;
        }).on('change', '.checkboxStatus', function (e) {

            var id      = $(this).attr('data-id');
            var status  = $(this).val();
            //
            // if(status == 1) {
            //     status = 0;
            // } else {
            //     status = 1;
            // }
            //
            // console.log(status);
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
        }).on('click', '.delete', function (e) {
            var selected = [];
            $('.datatable .selectCheckbox').each(function () {
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

        }).on('click', '#checkAll', function () {
            $('.datatable input[type=checkbox]').prop('checked', this.checked);
        });
    }

    function loadDataTable(data = null) {
        var dataTable = $('.datatable').DataTable( {
            "processing": true,
            "searching" : true,
            "paging": true,
            "order" : [],
            "ajax": {
                url: myLabel.users,
                type : 'get',
                data: {}
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
        });
    }

    $('select[name="address[0][country_id]"]').on('change', function() {
        var country_id = $('select[name="address[0][country_id]"]').find(":selected").val();
        $.ajax({
            url: myLabel.states,
            dataType: 'json',
            method: 'POST',
            data: {
                country_id: country_id
            },
            beforeSend: function() {
                $('select[name="address[0][country_id]"]').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
            },
            complete: function() {
                $('.fa-spin').remove();
            },
            success: function(json) {
                console.log(json);
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

                $('select[name="address[0][state_id]"]').html(html);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    $('select[name="address[0][country_id]"]').trigger('change');

    

}(window.jQuery);