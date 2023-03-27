$('#save_online_app_response').click(function () {
    if (!jQuery("#online_applicant_response_form").valid()) {
        return false;
    }
    let data = {
        'response': $('#response').val(),
        'online_appicant_id': ONLINE_APPLICANT_ID
    };

    ulploadFileWithData('/api/save_online_applicant_resp', data, function (result) {
        if (result.status == 1) {
            toastr.success('Online applicant response saving is successful!')
            $('#online_applicant_response_form').trigger("reset");
            load_online_app_response_tbl();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Online applicant response saving was unsuccessful!');
        }
    });
});

load_online_app_response_tbl = () => {
    let index = 1;
    let html = '';
    ajaxRequest('get', '/api/get_online_applicant_responses', null, function (result) {
        if (result != '') {
            result.forEach(online_applicant_resp => {
                let created_at = new Date(online_applicant_resp.created_at);
                let formatted_created_at = created_at.getFullYear()+'-'+created_at.getMonth()+'-'+created_at.getDate();
                let user_name = (online_applicant_resp.added_by != null) ? (online_applicant_resp.added_by.preffered_name != null) ? online_applicant_resp.added_by.preffered_name : '-' : '-';
                html += '<tr>';
                html += '<td>' + index++ + '</td>';
                html += '<td>' + online_applicant_resp.response + '</td>';
                html += '<td>' + online_applicant_resp.designation.name + '</td>';
                html += '<td>' + user_name + '</td>';
                html += '<td>' + formatted_created_at + '</td>';
                html += '</tr>';
            });
            $('#online_applicant_resp_tbl tbody').html(html);
            $('#online_applicant_resp_tbl').DataTable({
                "pageLength": 10,
                "destroy": true,
                "retrieve": true
            });
        } else {
            $('#online_applicant_resp_tbl tbody').html('<tr><td colspan="5" class="text-center text-bold"><span>No Data</span></td></tr>');
        }
    });
}

$("#online_applicant_response_form").validate({
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