$('#save_comission').click(function() {
    if (!jQuery("#commission_form").valid()) {
        return false;
    }
    let data = {
        'com_price': $('#com_price').val(),
        'com_response': $('#com_response').val(),
        'applicant_id': $('#save_comission').attr('data-id')
    };

    ulploadFileWithData('/api/save_comission', data, function(result) {
        if (result.status == 1) {
            toastr.success('Comission saving is successful!')
            $('#comission_form').trigger("reset");
            location.reload();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Commission saving was unsuccessful!');
        }
    });
});

$('#update_comission').click(function() {
    let data = {
        'com_price': $('#com_price').val(),
        'com_response': $('#com_response').val(),
        'applicant_id': $('#save_comission').attr('data-id')
    };

    let url = '/api/update_comission/id/' + $(this).attr('data-id');
    ulploadFileWithData(url, data, function(result) {
        if (result.status == 1) {
            toastr.success('Comission updating is successful!')
            $('#comission_form').trigger("reset");
            location.reload();
            reset_comission_buttons();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Comission updating was unsuccessful!');
        }
    });
});

$(document).on('click', '.delete-comission', function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Record will be deleted!",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.value) {
            let id = $(this).attr('data-id');
            reset_comission_buttons();
            delete_comission(id);
        }
    });
});

delete_comission = (id) => {
    ajaxRequest('delete', '/api/delete_comission/id/' + id, null, function(result) {
        if (result.status == 1) {
            $('#comission_form').trigger("reset");
            reset_comission_buttons();
            load_comission_tbl($('#save_comission').attr('data-id'));
            toastr.success('Deleting comission was successful!');
        } else {
            toastr.error('Deleting comission was failed!');
        }
    });
}

reset_comission_buttons = () => {
    $('#save_comission').removeClass('d-none');
    $('#update_comission').addClass('d-none');
}

$(document).on('click', '.edit-comission', function() {
    let id = $(this).attr('data-id');
    edit_comission(id);
});

edit_comission = (id) => {
    let url = '/api/get_comission/id/' + id;
    ajaxRequest('get', url, null, function(result) {
        $('#com_price').val(result.price);
        $('#com_response').val(result.response);
        $('#save_comission').addClass('d-none');
        $('#update_comission').removeClass('d-none');
        $('#update_comission').attr('data-id', result.id);
    });
}

load_comission_tbl = (id) => {
    let index = 1;
    let html = '';
    ajaxRequest('get', '/api/get_comissions/id/'+id, null, function(result) {
        if (result != '') {
            result.forEach(comission => {
                html += '<tr>';
                html += '<td>' + index++ + '</td>';
                html += '<td>' + comission.staff_mem_name + '</td>';
                html += '<td>' + comission.designation.name + '</td>';
                html += '<td>' + comission.price + '</td>';
                html += '<td>' + comission.response + '</td>';
                html += '<td><button type="button" class="btn btn-primary btn-sm edit-comission m-1" data-id="' + comission.id + '"> Edit </button>';
                html += '<button type="button" class="btn btn-danger btn-sm delete-comission m-1" data-id="' + comission.id + '"> Delete </button></td>';
            });
            $('#commission_tbl tbody').html(html);
            $('#commission_tbl').DataTable({
                "pageLength": 10,
                "destroy": true,
                "retrieve": true
            });
        } else {
            $('#commission_tbl tbody').html('<tr><td colspan="6" class="text-center text-bold"><span>No Data</span></td></tr>');
        }
    });
}

$("#commission_form").validate({
    errorClass: "invalid",
    // rules: {
    //     firstName: {
    //         valid_name: true,
    //     },
    //     lastName: {
    //         valid_name: true,
    //     },
    //     fullName: {
    //         valid_name: true,
    //     },
    //     prefferedName: {
    //         valid_name: true,
    //     },
    //     email: {
    //         valid_email: true,
    //     },
    //     address: {
    //         valid_name: true,
    //     },
    //     mobileNo: {
    //         valid_lk_phone: true,
    //     },
    //     landNo: {
    //         valid_lk_phone: true,
    //     },
    //     nic: {
    //         valid_nic: true,
    //     },
    //     birthDate: {
    //         valid_date: true,
    //     },
    // },
    highlight: function(element) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function(element) {
        $(element).removeClass('is-invalid');
    },
    errorElement: 'span',
    errorClass: 'validation-error-message help-block form-helper bold',
    errorPlacement: function(error, element) {
        if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});

jQuery.validator.setDefaults({
    errorElement: "span",
    ignore: ":hidden:not(select.chosen-select)",
    errorPlacement: function(error, element) {
        // Add the `help-block` class to the error element
        error.addClass("help-block");
        if (element.prop("type") === "checkbox") {
            //                error.insertAfter(element.parent("label"));
            error.appendTo(element.parents("validate-parent"));
        } else if (element.is("select.chosen-select")) {
            error.insertAfter(element.siblings(".chosen-container"));
        } else if (element.prop("type") === "radio") {
            error.appendTo(element.parents("div.validate-parent"));
        } else {
            error.insertAfter(element);
        }
    },
    highlight: function(element, errorClass, validClass) {
        jQuery(element).parents(".validate-parent").addClass("has-error").removeClass("has-success");
    },
    unhighlight: function(element, errorClass, validClass) {
        jQuery(element).parents(".validate-parent").removeClass("has-error");
    }
});
jQuery.validator.addMethod("valid_name", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9\s\.\&\-():, ]{1,100}$/.test(value);
}, "Please enter a valid name");
jQuery.validator.addMethod("valid_email", function(value, element) {
    return this.optional(element) || /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/.test(value);
}, "Please enter a valid email addresss");
jQuery.validator.addMethod("valid_code", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9._%+-@#()^;*!$=, ]{1,40}$/.test(value);
}, "Please enter a valid password");
jQuery.validator.addMethod("valid_lk_phone", function(value, element) {
    return this.optional(element) || /^(\+94)?\d{2,3}[-]?\d{7}$/.test(value);
}, "Please enter a valid phone number");
jQuery.validator.addMethod("valid_date", function(value, element) {
    return this.optional(element) || /^\d{4}\-\d{2}\-\d{2}$/.test(value);
}, "Please enter a valid date ex. 2017-03-27");
jQuery.validator.addMethod("valid_nic", function(value, element) {
    return this.optional(element) || /^[0-9+]{12}$/.test(value) || /^[0-9+]{9}[vV|xX]$/.test(value);
}, "Please enter a valid nic number");