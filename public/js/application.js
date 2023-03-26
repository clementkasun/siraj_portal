$('#save_applicant').click(function() {
    if (!jQuery("#applicant_form").valid()) {
        return false;
    }
    let data = {
        'full_name': $('#full_name').val(),
        'address': $('#address').val(),
        'phone_no_one': $('#phone_no_one').val(),
        'phone_no_two': $('#phone_no_two').val(),
        'nic': $('#nic').val(),
        'passport_number': $('#passport_number').val(),
        'passport_issue_date': $('#passport_issue_date').val(),
        'passport_place_of_issue': $('#passport_place_of_issue').val(),
        'passport_exp_date': $('#passport_exp_date').val(),
        'birth_date': $('#birth_date').val(),
        'gender': $('#sex').val(),
        'height': $('#height').val(),
        'weight': $('#weight').val(),
        'complexion': $('#complexion').val(),
        'nationality': $('#nationality').val(),
        'religion': $('#religion').val(),
        'maritial_status': $('#maritial_status').val(),
        'number_of_children': $('#number_of_children').val(),
        'applied_post': $('#applied_post').val(),
        'applied_country': $('#applied_country').val(),
        'post_status': $('#post_status').val(),
        'edu_qualifications': $('#edu_qualifications').val(),
        'monthly_sallary': $('#monthly_sallary').val(),
        'commision_price': $('#commision_price').val(),
        'decorating': $('#decorating').is(":checked"),
        'baby_sitting': $('#baby_sitting').is(":checked"),
        'cleaning': $('#cleaning').is(":checked"),
        'cooking': $('#cooking').is(":checked"),
        'washing': $('#washing').is(":checked"),
        'sewing': $('#sewing').is(":checked"),
        'driving': $('#driving').is(":checked"),
        'passport_pdf': $('#passport_pdf')[0].files[0],
        'nic_pdf': $('#nic_pdf')[0].files[0],
        'police_record_pdf': $('#police_record_pdf')[0].files[0],
        'gs_certificate_pdf': $('#gs_certificate_pdf')[0].files[0],
        'family_back_pdf': $('#family_back_pdf')[0].files[0],
        'visa_pdf': $('#visa_pdf')[0].files[0],
        'medical_pdf': $('#medical_pdf')[0].files[0],
        'agreement_pdf': $('#agreement_pdf')[0].files[0],
        'personal_form_pdf': $('#personal_form_pdf')[0].files[0],
        'job_order_pdf': $('#job_order_pdf')[0].files[0],
        'ticket_pdf': $('#ticket_pdf')[0].files[0],
        'agency_agreement_pdf': $('#agency_agreement_pdf')[0].files[0],
        'applicant_image_passport': $('#applicant_image_passport')[0].files[0],
        'applicant_image_full_size': $('#applicant_image_full_size')[0].files[0],
    };

    ulploadFileWithData('/api/save_applicant', data, function(result) {
        if (result.status == 1) {
            toastr.success('Applicant saving is successful!')
            $('#applicant_form').trigger("reset");
            window.location.href = '/registered_applicants';
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Applicant saving was failed!');
        }
    });
});

$('#update_applicant').click(function() {
    if (!jQuery("#applicant_form").valid()) {
        return false;
    }
    let data = {
        'full_name': $('#full_name').val(),
        'address': $('#address').val(),
        'phone_no_one': $('#phone_no_one').val(),
        'phone_no_two': $('#phone_no_two').val(),
        'nic': $('#nic').val(),
        'passport_number': $('#passport_number').val(),
        'passport_issue_date': $('#passport_issue_date').val(),
        'passport_place_of_issue': $('#passport_place_of_issue').val(),
        'passport_exp_date': $('#passport_exp_date').val(),
        'birth_date': $('#birth_date').val(),
        'gender': $('#sex').val(),
        'height': $('#height').val(),
        'weight': $('#weight').val(),
        'complexion': $('#complexion').val(),
        'nationality': $('#nationality').val(),
        'religion': $('#religion').val(),
        'maritial_status': $('#maritial_status').val(),
        'number_of_children': $('#number_of_children').val(),
        'applied_post': $('#applied_post').val(),
        'applied_country': $('#applied_country').val(),
        'post_status': $('#post_status').val(),
        'edu_qualifications': $('#edu_qualifications').val(),
        'monthly_sallary': $('#monthly_sallary').val(),
        'commision_price': $('#commision_price').val(),
        'decorating': $('#decorating').is(":checked"),
        'baby_sitting': $('#baby_sitting').is(":checked"),
        'cleaning': $('#cleaning').is(":checked"),
        'cooking': $('#cooking').is(":checked"),
        'washing': $('#washing').is(":checked"),
        'sewing': $('#sewing').is(":checked"),
        'driving': $('#driving').is(":checked"),
        'passport_pdf': $('#passport_pdf')[0].files[0],
        'nic_pdf': $('#nic_pdf')[0].files[0],
        'police_record_pdf': $('#police_record_pdf')[0].files[0],
        'gs_certificate_pdf': $('#gs_certificate_pdf')[0].files[0],
        'family_back_pdf': $('#family_back_pdf')[0].files[0],
        'visa_pdf': $('#visa_pdf')[0].files[0],
        'medical_pdf': $('#medical_pdf')[0].files[0],
        'agreement_pdf': $('#agreement_pdf')[0].files[0],
        'personal_form_pdf': $('#personal_form_pdf')[0].files[0],
        'job_order_pdf': $('#job_order_pdf')[0].files[0],
        'ticket_pdf': $('#ticket_pdf')[0].files[0],
        'agency_agreement_pdf': $('#agency_agreement_pdf')[0].files[0],
        'applicant_image_passport': $('#applicant_image_passport')[0].files[0],
        'applicant_image_full_size': $('#applicant_image_full_size')[0].files[0],
    };

    ulploadFileWithData('/api/update_applicant/id/' + APPLICANT_ID, data, function(result) {
        if (result.status == 1) {
            toastr.success('Applicant updating is successful!');
            window.location.href = '/registered_applicants';
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Applicant updating was failed!');
        }
    });
});

$("#applicant_form").validate({
    errorClass: "invalid",
    rules: {
        full_name: {
            valid_name: true,
        },
        address: {
            valid_name: true,
        },
        phone_no_one: {
            valid_lk_phone: true,
        },
        phone_no_two: {
            valid_lk_phone: true,
        },
        nic: {
            valid_nic: true,
        },
        passport_issue_date: {
            valid_date: true,
        },
        passport_exp_date: {
            valid_date: true,
        },
        birth_date: {
            valid_date: true,
        },
        nationality: {
            valid_name: true,
        },
        religion: {
            valid_name: true,
        },
    },
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
jQuery.validator.addMethod("valid_lk_phone", function(value, element) {
    return this.optional(element) || /^(\+94)?\d{2,3}[-]?\d{7}$/.test(value);
}, "Please enter a valid phone number");
jQuery.validator.addMethod("valid_date", function(value, element) {
    return this.optional(element) || /^\d{4}\-\d{2}\-\d{2}$/.test(value);
}, "Please enter a valid date ex. 2017-03-27");
jQuery.validator.addMethod("valid_nic", function(value, element) {
    return this.optional(element) || /^[0-9+]{12}$/.test(value) || /^[0-9+]{9}[vV|xX]$/.test(value);
}, "Please enter a valid nic number");