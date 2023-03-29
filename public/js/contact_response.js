$('#save_contact_response').click(function (privillages) {
    if (!jQuery("#contact_response_form").valid()) {
        return false;
    }
    let data = {
        'response': $('#response').val(),
        'contact_id': CONTACT_ID
    };

    ulploadFileWithData('/api/save_contact_response', data, function (result) {
        if (result.status == 1) {
            toastr.success('Contact response saving is successful!');
            location.reload();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Contact response saving was failed!');
        }
    });
});

// $('#update_contact_response').click(function (privillages) {
//     let contact_resp_id = $('#update_contact_response').attr('data-id');
//     update_contact_response(contact_resp_id);
// });

// update_contact_response = (contact_resp_id) => {
//     if (!jQuery("#contact_response_form").valid()) {
//         return false;
//     }
//     let data = {
//         'response': $('#response').val(),
//         'contact_id': CONTACT_ID
//     };

//     ulploadFileWithData('/api/update_contact_response/id/' + contact_resp_id, data, function (result) {
//         if (result.status == 1) {
//             toastr.success('Contact response updating is successful!');
//             location.reload();
//             if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
//                 callBack();
//             }
//         } else {
//             toastr.error('Contact response updating was failed!');
//         }
//     });
// }

// load_contact_response = (privillages = []) => {
//     let index = 1;
//     let html = '';
//     ajaxRequest('get', '/api/get_contact_responses', null, function (result) {
//         if (result != '') {
//             result.forEach(contact_response => {
//                 html += '<tr>';
//                 html += '<td>' + index++ + '</td>';
//                 html += '<td style="width: 15em">' + contact_response.name + '</td>';
//                 html += '<td>' + contact_response.designation.name + '</td>';
//                 html += '<td>' + contact_response.response + '</td>';
//                 if (privillages['is_update'] == '1') {
//                     html += '<td><button type="button" class="btn btn-primary btn-sm edit m-1" data-id="' + contact_response.id + '"> Edit </button>';
//                 }else{
//                     html += '<td><button type="button" class="btn btn-primary btn-sm edit m-1" disabled> Edit </button>';
//                 }
//                 if (privillages['is_delete'] == '1') {
//                     html += '<button type="button" class="btn btn-danger del btn-sm m-1" data-id="' + contact_response.id + '"> Delete </button></td>';
//                 }else{
//                     html += '<button type="button" class="btn btn-danger del btn-sm m-1" disabled> Delete </button></td>';
//                 }
//             });
//             $('#contact_resp_tbl tbody').html(html);
//             $('#contact_resp_tbl').DataTable({
//                 "pageLength": 10,
//                 "destroy": true,
//                 "retrieve": true
//             });
//         } else {
//             $('#contact_resp_tbl tbody').html('<tr><td colspan="7" class="text-center text-bold"><span>No Data</span></td></tr>');
//         }
//     });
// }

// $(document).on('click', '.del', function () {
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "Record will be deleted!",
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes!'
//     }).then((result) => {
//         if (result.value) {
//             let id = $(this).attr('data-id');
//             reset_buttons();
//             delete_contact_response(id);
//         }
//     });
// });

// delete_contact_response = (id) => {
//     ajaxRequest('delete', '/api/delete_contact_response/id/' + id, null, function (result) {
//         if (result.status == 1) {
//             location.reload();
//             toastr.success('Deleting contact response was successful!');
//         } else {
//             toastr.error('Deleting contact response was failed!');
//         }
//     });
// }

// $(document).on('click', '.edit', function () {
//     let id = $(this).attr('data-id');
//     edit_contact_response(id);
// });

// edit_contact_response = (id) => {
//     let url = '/api/get_contact_response/id/' + id;
//     ajaxRequest('get', url, null, function (result) {
//         $('#designation').val(result.designation);
//         $('#response').val(result.response);
//         $('#save_contact_response').addClass('d-none');
//         $('#update_contact_response').removeClass('d-none');
//         $('#update_contact_response').attr('data-id', result.id);
//     });
// }

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