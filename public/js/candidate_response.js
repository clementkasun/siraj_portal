$('#save_candidate_reponse').click(function () {
    if (!jQuery("#candidate_response_form").valid()) {
        return false;
    }
    let data = {
        'name': $('#name').val(),
        'designation': $('#designation').val(),
        'response': $('#response').val(),
        'candidate_id': CANDIDATE_ID
    };

    ulploadFileWithData('/api/save_candidate_response', data, function (result) {
        if (result.status == 1) {
            toastr.success('Candidate response saving is successful!');
            $('#candidate_response_form').trigger("reset");
            load_candidate_response_table();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Candidate response saving was failed!');
        }
    });
});

$('#update_candidate_reponse').click(function () {
    let candidate_id = $('#update_candidate_reponse').attr('data-id');
    update_candidate_reponse(candidate_id);
});

update_candidate_reponse = (candidate_id) => {
    if (!jQuery("#candidate_response_form").valid()) {
        return false;
    }
    let data = {
        'name': $('#name').val(),
        'designation': $('#designation').val(),
        'response': $('#response').val(),
        'candidate_id': CANDIDATE_ID
    };

    ulploadFileWithData('/api/update_candidate_response/id/' + candidate_id, data, function (result) {
        if (result.status == 1) {
            toastr.success('Candidate response updating is successful!');
            $('#candidate_response_form').trigger("reset");
            load_candidate_response_table();
            reset_buttons();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Candidate response updating was failed!');
        }
    });
}

load_candidate_response_table = () => {
    let index = 1;
    let html = '';
    ajaxRequest('get', '/api/get_candidate_responses', null, function (result) {
        if (result != '') {
            result.forEach(candidate_reponse => {
                html += '<tr>';
                html += '<td>' + index++ + '</td>';
                html += '<td style="width: 15em">' + candidate_reponse.name + '</td>';
                html += '<td>' + candidate_reponse.designation + '</td>';
                html += '<td>' + candidate_reponse.response + '</td>';
                html += '<td><button type="button" class="btn btn-primary edit m-1" data-id="' + candidate_reponse.id + '"> Edit </button>';
                html += '<button type="button" class="btn btn-danger del m-1" data-id="' + candidate_reponse.id + '"> Delete </button></td>';
            });
            $('#candidate_resp_tbl tbody').html(html);
            $('#candidate_resp_tbl').DataTable({
                "pageLength": 10,
                "destroy": true,
                "retrieve": true
            });
        } else {
            $('#candidate_resp_tbl tbody').html('<tr><td colspan="7" class="text-center text-bold"><span>No Data</span></td></tr>');
        }
    });
}

$(document).on('click', '.del', function () {
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
            reset_buttons();
            delete_candidate_reponse(id);
        }
    });
});

delete_candidate_reponse = (id) => {
    ajaxRequest('delete', '/api/delete_candidate_response/id/' + id, null, function (result) {
        if (result.status == 1) {
            $('#candidate_response_form').trigger("reset");
            load_candidate_response_table();
            toastr.success('Deleting candidate response was successful!');
        } else {
            toastr.error('Deleting candidate response was failed!');
        }
    });
}

reset_buttons = () => {
    $('#save_candidate_reponse').removeClass('d-none');
    $('#update_candidate_reponse').addClass('d-none');
}

$(document).on('click', '.edit', function () {
    let id = $(this).attr('data-id');
    edit_candidate_reponse(id);
});

edit_candidate_reponse = (id) => {
    let url = '/api/get_candidate_response/id/' + id;
    ajaxRequest('get', url, null, function (result) {
        $('#name').val(result.name);
        $('#designation').val(result.designation);
        $('#response').val(result.response);
        $('#save_candidate_reponse').addClass('d-none');
        $('#update_candidate_reponse').removeClass('d-none');
        $('#update_candidate_reponse').attr('data-id', result.id);
    });
}

$("#candidate_response_form").validate({
    errorClass: "invalid",
    rules: {
        name: {
            valid_name: true,
        },
    },
    highlight: function (element) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element) {
        $(element).removeClass('is-invalid');
    },
    errorElement: 'span',
    errorClass: 'validation-error-message help-block form-helper bold',
    errorPlacement: function (error, element) {
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
    errorPlacement: function (error, element) {
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
    highlight: function (element, errorClass, validClass) {
        jQuery(element).parents(".validate-parent").addClass("has-error").removeClass("has-success");
    },
    unhighlight: function (element, errorClass, validClass) {
        jQuery(element).parents(".validate-parent").removeClass("has-error");
    }
});
jQuery.validator.addMethod("valid_name", function (value, element) {
    return this.optional(element) || /^[a-zA-Z0-9\s\.\&\-():, ]{1,100}$/.test(value);
}, "Please enter a valid name");
jQuery.validator.addMethod("valid_lk_phone", function (value, element) {
    return this.optional(element) || /^(\+94)?\d{2,3}[-]?\d{7}$/.test(value);
}, "Please enter a valid phone number");
jQuery.validator.addMethod("valid_date", function (value, element) {
    return this.optional(element) || /^\d{4}\-\d{2}\-\d{2}$/.test(value);
}, "Please enter a valid date ex. 2017-03-27");
jQuery.validator.addMethod("valid_nic", function (value, element) {
    return this.optional(element) || /^[0-9+]{12}$/.test(value) || /^[0-9+]{9}[vV|xX]$/.test(value);
}, "Please enter a valid nic number");