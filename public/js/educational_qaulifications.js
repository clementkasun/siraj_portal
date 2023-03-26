$('#save_qualification').click(function() {
    if (!jQuery("#qualifications_form").valid()) {
        return false;
    }
    let data = {
        'institute': $('#institute').val(),
        'course': $('#course').val(),
        'start_date': $('#start_date').val(),
        'end_date': $('#end_date').val(),
        'result': $('#result').val(),
        'applicant_id': $(this).attr('data-id')
    };

    ulploadFileWithData('/api/save_educational_qualification', data, function(result) {
        if (result.status == 1) {
            toastr.success('Educational qualification saving is successful!')
            $('#qualifications_form').trigger("reset");
            load_edu_qualifications_table($('#save_qualification').attr('data-id'));
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Educational qualification saving was unsuccessful!');
        }
    });
});

$('#update_qualification').click(function() {
    let data = {
        'institute': $('#institute').val(),
        'course': $('#course').val(),
        'start_date': $('#start_date').val(),
        'end_date': $('#end_date').val(),
        'result': $('#result').val(),
        'applicant_id': $('#save_qualification').attr('data-id')
    };

    let url = '/api/update_educational_qualification/id/' + $(this).attr('data-id');
    ulploadFileWithData(url, data, function(result) {
        if (result.status == 1) {
            toastr.success('Educational qualification saving is successful!')
            $('#qualifications_form').trigger("reset");
            load_edu_qualifications_table($('#save_qualification').attr('data-id'));
            reset_edu_quali_buttons();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Educational qualification saving was unsuccessful!');
        }
    });
});

$(document).on('click', '.delete', function() {
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
            delete_edu_qualification(id);
        }
    });
});

delete_edu_qualification = (id) => {
    ajaxRequest('delete', '/api/delete_educational_qualification/id/' + id, null, function(result) {
        if (result.status == 1) {
            $('#qualifications_form').trigger("reset");
            reset_edu_quali_buttons();
            load_edu_qualifications_table($('#save_qualification').attr('data-id'));
            toastr.success('Deleting edcuational qualification was successful!')
        } else {
            toastr.error('Deleting educational qualification was failed!');
        }
    });
}

reset_edu_quali_buttons = () => {
    $('#save_qualification').removeClass('d-none');
    $('#update_qualification').addClass('d-none');
}

$(document).on('click', '.edit', function() {
    let id = $(this).attr('data-id');
    edit_edu_qualification(id);
});

edit_edu_qualification = (id) => {
    let url = '/api/get_educational_qualification/id/' + id;
    ajaxRequest('get', url, null, function(result) {
        $('#institute').val(result.institute);
        $('#course').val(result.course);
        $('#start_date').val(result.start_date);
        $('#end_date').val(result.end_date);
        $('#result').val(result.result);
        $('#save_qualification').addClass('d-none');
        $('#update_qualification').removeClass('d-none');
        $('#update_qualification').attr('data-id', result.id);
    });
}

load_edu_qualifications_table = (id) => {
    let index = 1;
    let html = '';
    ajaxRequest('get', '/api/get_educational_qualifications/id/'+id, null, function(result) {
        if (result != '') {
            result.forEach(edu_qualification => {
                html += '<tr>';
                html += '<td>' + index++ + '</td>';
                html += '<td style="width: 15em">' + edu_qualification.institute + '</td>';
                html += '<td style="width: 15em">' + edu_qualification.course + '</td>';
                html += '<td style="width: 15em">' + edu_qualification.result + '</td>';
                html += '<td>' + edu_qualification.start_date + '</td>';
                html += '<td>' + edu_qualification.end_date + '</td>';
                html += '<td><button type="button" class="btn btn-primary btn-sm edit m-1" data-id="' + edu_qualification.id + '"> Edit </button>';
                html += '<button type="button" class="btn btn-danger btn-sm delete m-1" data-id="' + edu_qualification.id + '"> Delete </button></td>';
            });
            $('#edu_qualifications_tbl tbody').html(html);
            $('#edu_qualifications_tbl').DataTable({
                "pageLength": 10,
                "destroy": true,
                "retrieve": true
            });
        } else {
            $('#edu_qualifications_tbl tbody').html('<tr><td colspan="7" class="text-center text-bold"><span>No Data</span></td></tr>');
        }
    });
}

$("#qualifications_form").validate({
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