$('#save_staff_response').click(function() {
    if (!jQuery("#staff_response_form").valid()) {
        return false;
    }
    let data = {
        'response': $('#response').val(),
        'applicant_id': $('#save_staff_response').attr('data-id')
    };

    ulploadFileWithData('/api/save_application_staff_response', data, function(result) {
        if (result.status == 1) {
            toastr.success('Application staff response saving is successful!')
            $('#staff_response_form').trigger("reset");
            load_application_staff_table($('#save_staff_response').attr('data-id'));
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Application staff response saving was unsuccessful!');
        }
    });
});

$('#update_staff_response').click(function() {
    let data = {
        'response': $('#response').val(),
        'applicant_id': $('#save_staff_response').attr('data-id')
    };

    let url = '/api/update_application_staff_response/id/' + $(this).attr('data-id');
    ulploadFileWithData(url, data, function(result) {
        if (result.status == 1) {
            toastr.success('Application staff response updating is successful!')
            $('#staff_response_form').trigger("reset");
            load_application_staff_table($('#save_staff_response').attr('data-id'));
            reset_app_staff_buttons();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Application staff response updating was unsuccessful!');
        }
    });
});

$(document).on('click', '.delete-app-staff', function() {
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
            reset_app_staff_buttons();
            delete_app_staff(id);
        }
    });
});

delete_app_staff = (id) => {
    ajaxRequest('delete', '/api/delete_application_staff_response/id/' + id, null, function(result) {
        if (result.status == 1) {
            $('#staff_response_form').trigger("reset");
            reset_app_staff_buttons();
            load_application_staff_table($('#save_staff_response').attr('data-id'));
            toastr.success('Deleting application staff was successful!');
        } else {
            toastr.error('Deleting application staff was failed!');
        }
    });
}

reset_app_staff_buttons = () => {
    $('#save_staff_response').removeClass('d-none');
    $('#update_staff_response').addClass('d-none');
}

$(document).on('click', '.edit-app-staff', function() {
    let id = $(this).attr('data-id');
    edit_applicant_staff_response(id);
});

edit_applicant_staff_response = (id) => {
    let url = '/api/get_application_staff_response/id/' + id;
    ajaxRequest('get', url, null, function(result) {
        $('#response').val(result.response);
        $('#save_staff_response').addClass('d-none');
        $('#update_staff_response').removeClass('d-none');
        $('#update_staff_response').attr('data-id', result.id);
    });
}

load_application_staff_table = (id) => {
    let index = 1;
    let html = '';
    ajaxRequest('get', '/api/get_application_staff_responses/id/'+id, null, function(result) {
        if (result != '') {
            result.forEach(app_staff_resp => {
                html += '<tr>';
                html += '<td>' + index++ + '</td>';
                html += '<td>' + app_staff_resp.staff_mem_name + '</td>';
                html += '<td>' + app_staff_resp.designation.name + '</td>';
                html += '<td>' + app_staff_resp.response + '</td>';
                html += '<td><button type="button" class="btn btn-primary edit-app-staff m-1" data-id="' + app_staff_resp.id + '"> Edit </button>';
                html += '<button type="button" class="btn btn-danger delete-app-staff m-1" data-id="' + app_staff_resp.id + '"> Delete </button></td>';
            });
            $('#app_staff_resp_tbl tbody').html(html);
            $('#app_staff_resp_tbl').DataTable({
                "pageLength": 10,
                "destroy": true,
                "retrieve": true
            });
        } else {
            $('#app_staff_resp_tbl tbody').html('<tr><td colspan="5" class="text-center text-bold"><span>No Data</span></td></tr>');
        }
    });
}

$("#staff_response_form").validate({
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