$('#save_phone_number').click(function () {
    if (!jQuery("#phone_number_form").valid()) {
        return false;
    }
    let data = {
        'phone_number': $('#phone_number').val(),
        'name': $('#name').val(),
    };

    ulploadFileWithData('/api/save_phone_number', data, function (result) {
        if (result.status == 1) {
            toastr.success('Phone number adding is successful!')
            $('#phone_number_form').trigger("reset");
            load_phone_number_tbl();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Phone number saving was failed!');
        }
    });
});

$('#update_phone_number').click(function () {
    let id = $(this).attr('data-id');
    if (!jQuery("#phone_number_form").valid()) {
        return false;
    }
    let data = {
        'phone_number': $('#phone_number').val(),
        'name': $('#name').val(),
    };

    ulploadFileWithData('/api/update_phone_number/id/' + id, data, function (result) {
        if (result.status == 1) {
            toastr.success('Phone number updating is successful!');
            reset_phone_num_buttons();
            load_phone_number_tbl();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Phone number updating was failed!');
        }
    });
});

$(document).on('click', '.delete', function () {
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
            reset_phone_num_buttons();
            delete_phone_number(id);
        }
    });
});

delete_phone_number = (id) => {
    ajaxRequest('delete', '/api/delete_phone_number/id/' + id, null, function (result) {
        if (result.status == 1) {
            $('#phone_number_form').trigger("reset");
            reset_phone_num_buttons();
            load_phone_number_tbl($('#save_phone_number').attr('data-id'));
            toastr.success('Deleting phone number was successful!');
        } else {
            toastr.error('Deleting phone number was failed!');
        }
    });
}

reset_phone_num_buttons = () => {
    $('#save_phone_number').removeClass('d-none');
    $('#update_phone_number').addClass('d-none');
}

$(document).on('click', '.edit', function () {
    let id = $(this).attr('data-id');
    edit_phone_number(id);
});

edit_phone_number = (id) => {
    let url = '/api/get_phone_number/id/' + id;
    ajaxRequest('get', url, null, function (result) {
        $('#phone_number').val(result.phone_number);
        $('#name').val(result.name);
        $('#save_phone_number').addClass('d-none');
        $('#update_phone_number').removeClass('d-none');
        $('#update_phone_number').attr('data-id', result.id);
    });
}

load_phone_number_tbl = (privillages = []) => {
    let index = 1;
    let html = '';
    ajaxRequest('get', '/api/get_phone_numbers', null, function (result) {
        if (result != '') {
            result.forEach(phone_number => {

                let added_name = (phone_number.added_by != null) ? (phone_number.added_by.preffered_name != null) ? phone_number.added_by.preffered_name : '' : '';
                let assigned_name = (phone_number.assigned_to != null) ? (phone_number.assigned_to.preffered_name != null) ? phone_number.assigned_to.preffered_name : '' : '';
                let phone_num_response = (phone_number.phone_number_response != null) ? (phone_number.phone_number_response[0] != null) ? phone_number.phone_number_response[0].response : '' : '';  
                let phone_number_name =  (phone_number.name != null) ? phone_number.name : '';

                html += '<tr>';
                html += '<td>' + index++ + '</td>';
                html += '<td style="width: 8em">' + phone_number.phone_number + '</td>';
                html += '<td>' + phone_number_name + '</td>';
                html += '<td>' + added_name + '</td>';
                html += '<td>' + assigned_name + '</td>';
                html += '<td>' + phone_num_response + '</td>';
                html += '<td>';
                if(privillages['is_update'] == '1'){
                    html += '<button type="button" class="btn btn-primary btn-sm edit m-1" data-id="' + phone_number.id + '"> Edit </button>';
                    html += '<a href="/phone_number_response/id/' + phone_number.id + '" class="btn btn-primary btn-sm m-1">response</a>';
                }else{
                    html += '<button type="button" class="btn btn-primary btn-sm edit m-1" disabled> Edit </button>';
                    html += '<a href="/phone_number_response/id/' + phone_number.id + '" class="btn btn-primary btn-sm m-1" style="pointer-events: none; cursor: default;">response</a>';
                }
                if(privillages['is_delete'] == '1'){
                    html += '<button type="button" class="btn btn-danger btn-sm delete m-1" data-id="' + phone_number.id + '"> Delete </button>';
                }else{
                    html += '<button type="button" class="btn btn-danger btn-sm delete m-1" disabled> Delete </button>';
                }
                if(privillages['is_read'] == '1'){
                    html += '<a href="/phone_number_profile/id/' + phone_number.id + '" class="btn btn-success btn-sm m-1">Profile</a>';
                }else{
                    html += '<a href="#" class="btn btn-success btn-sm m-1" onclick="return false;" style="pointer-events: none; cursor: default;">Profile</a>';
                }
                html += '</td>';
            });
            $('#phone_number_tbl tbody').html(html);
            $('#phone_number_tbl').DataTable({
                "pageLength": 10,
                "destroy": true,
                "retrieve": true
            });
        } else {
            $('#phone_number_tbl tbody').html('<tr><td colspan="7" class="text-center text-bold"><span>No Data</span></td></tr>');
        }
    });
}

$("#phone_number_form").validate({
    errorClass: "invalid",
    rules: {
        phone_number: {
            valid_lk_phone: true,
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