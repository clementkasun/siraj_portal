$('#save_phone_number_response').click(function () {
    if (!jQuery("#phone_number_respone_form").valid()) {
        return false;
    }
    let data = {
        'response': $('#response').val(),
        'phone_number_id': PHONE_NUMBER_ID
    };

    ulploadFileWithData('/api/save_phone_number_response', data, function (result) {
        if (result.status == 1) {
            toastr.success('Phone number response saving is successful!')
            $('#phone_number_respone_form').trigger("reset");
            load_phone_number_resp_tbl();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Phone number response saving was failed!');
        }
    });
});

load_phone_number_resp_tbl = () => {
    let index = 1;
    let html = '';
    ajaxRequest('get', '/api/get_phone_number_responses/id/' + PHONE_NUMBER_ID, null, function (result) {
        if (result != '') {
            result.forEach(phone_number_resp => {
                let created_at = new Date(phone_number_resp.created_at);
                let formatted_created_at = created_at.getFullYear()+'-'+created_at.getMonth()+'-'+created_at.getDate();
                let user_name = (phone_number_resp.user.first_name != null) ? phone_number_resp.user.first_name : ''+ ' ' + (phone_number_resp.user.last_name != null) ? phone_number_resp.user.last_name : '';
                html += '<tr>';
                html += '<td>' + index++ + '</td>';
                html += '<td>' + phone_number_resp.phone_number.phone_number + '</td>';
                html += '<td>' + phone_number_resp.response + '</td>';
                html += '<td>' + phone_number_resp.designation.name + '</td>';
                html += '<td>' + user_name + '</td>';
                html += '<td>' + formatted_created_at + '</td>';
                html += '</tr>';
            });
            $('#phone_number_response_tbl tbody').html(html);
            $('#phone_number_response_tbl').DataTable({
                "pageLength": 10,
                "destroy": true,
                "retrieve": true
            });
        } else {
            $('#phone_number_response_tbl tbody').html('<tr><td colspan="6" class="text-center text-bold"><span>No Data</span></td></tr>');
        }
    });
}

$("#phone_number_respone_form").validate({
    errorClass: "invalid",
    rules: {
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