$('#save_language').click(function() {
    if (!jQuery("#languages_form").valid()) {
        return false;
    }
    let data = {
        'language': $('#language').val(),
        'poor': $('#poor').is(':checked'),
        'fair': $('#fair').is(':checked'),
        'fluent': $('#fluent').is(':checked'),
        'applicant_id': $(this).attr('data-id')
    };

    ulploadFileWithData('/api/save_applicant_language', data, function(result) {
        if (result.status == 1) {
            toastr.success('Language saving is successful!')
            $('#languages_form').trigger("reset");
            load_language_table($('#save_language').attr('data-id'));
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Language saving was unsuccessful!');
        }
    });
});

$('#update_language').click(function() {
    let data = {
        'language': $('#language').val(),
        'poor': $('#poor').is(':checked'),
        'fair': $('#fair').is(':checked'),
        'fluent': $('#fluent').is(':checked'),
    };

    let url = '/api/update_applicant_language/id/' + $(this).attr('data-id');
    ulploadFileWithData(url, data, function(result) {
        if (result.status == 1) {
            toastr.success('Language updating is successful!')
            $('#languages_form').trigger("reset");
            load_language_table($('#save_language').attr('data-id'));
            reset_app_lan_buttons();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Language updating was unsuccessful!');
        }
    });
});

$(document).on('click', '.delete-app-lan', function() {
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
            reset_app_lan_buttons();
            delete_language(id);
        }
    });
});

delete_language = (id) => {
    ajaxRequest('delete', '/api/delete_application_language/id/' + id, null, function(result) {
        if (result.status == 1) {
            $('#languages_form').trigger("reset");
            load_language_table($('#save_language').attr('data-id'));
            toastr.success('Deleting language was successful!');
        } else {
            toastr.error('Deleting language was failed!');
        }
    });
}

reset_app_lan_buttons = () => {
    $('#save_language').removeClass('d-none');
    $('#update_language').addClass('d-none');
}

$(document).on('click', '.edit-app-lan', function() {
    let id = $(this).attr('data-id');
    edit_applicant_language(id);
});

edit_applicant_language = (id) => {
    let url = '/api/get_applicant_language/id/' + id;
    ajaxRequest('get', url, null, function(result) {
        $('#language').val(result.language_name);
        $('#poor').val(result.poor);
        $('#fair').val(result.fair);
        $('#fluent').val(result.fluent);
        $('#save_language').addClass('d-none');
        $('#update_language').removeClass('d-none');
        $('#update_language').attr('data-id', result.id);
    });
}

load_language_table = (id) => {
    let index = 1;
    let html = '';
    ajaxRequest('get', '/api/get_applicant_languages/id/'+id, null, function(result) {
        if (result != '') {
            result.forEach(language => {
                let yes_clause = '<span class="badge badge-info pl-2 pr-2">Yes</span>';
                let no_clause = '<span class="badge badge-warning pl-2 pr-2">No</span>';
                let poor_status = (language.poor) ?  yes_clause : no_clause;
                let fair_status = (language.fair) ? yes_clause : no_clause;
                let fluent_status = (language.fluent) ? yes_clause : no_clause;

                html += '<tr>';
                html += '<td>' + index++ + '</td>';
                html += '<td>' + language.language_name + '</td>';
                html += '<td>' + poor_status + '</td>';
                html += '<td>' + fair_status + '</td>';
                html += '<td>' + fluent_status + '</td>';
                html += '<td><button type="button" class="btn btn-primary edit-app-lan m-1" data-id="' + language.id + '"> Edit </button>';
                html += '<button type="button" class="btn btn-danger delete-app-lan m-1" data-id="' + language.id + '"> Delete </button></td>';
            });
            $('#language_tbl tbody').html(html);
            $('#language_tbl').DataTable({
                "pageLength": 10,
                "destroy": true,
                "retrieve": true
            });
        } else {
            $('#language_tbl tbody').html('<tr><td colspan="6" class="text-center text-bold"><span>No Data</span></td></tr>');
        }
    });
}

$("#languages_form").validate({
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