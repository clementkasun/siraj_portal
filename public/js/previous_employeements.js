$('#save_previous_emp').click(function () {
    if (!jQuery("#previous_employeement_form").valid()) {
        return false;
    }
    let data = {
        'job_type': $('#job_type').val(),
        'period': $('#period').val(),
        'country': $('#country').val(),
        'applicant_id': $(this).attr('data-id')
    };

    ulploadFileWithData('/api/save_previous_employeement', data, function (result) {
        if (result.status == 1) {
            toastr.success('Previous employeement saving is successful!')
            setTimeout(function () {
                location.reload();
            }, 1000);
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Previous employeement saving was unsuccessful!');
        }
    });
});

$('#update_previous_emp').click(function () {
    let data = {
        'job_type': $('#job_type').val(),
        'period': $('#period').val(),
        'country': $('#country').val(),
        'applicant_id': $('#save_previous_emp').attr('data-id')
    };

    let url = '/api/update_previous_employeement/id/' + $(this).attr('data-id');
    ulploadFileWithData(url, data, function (result) {
        if (result.status == 1) {
            toastr.success('Previous employeement update is successful!')
            setTimeout(function () {
                location.reload();
            }, 1000);
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Previous employeement update was unsuccessful!');
        }
    });
});

$(document).on('click', '.delete-prev-emp', function () {
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
            delete_previous_emp(id);
        }
    });
});

delete_previous_emp = (id) => {
    ajaxRequest('delete', '/api/delete_previous_employeement/id/' + id, null, function (result) {
        if (result.status == 1) {
            toastr.success('Deleting previous employee details is successful!');
            setTimeout(function () {
                location.reload();
            }, 1000);
        } else {
            toastr.error('Deleting previous employee details was failed!');
        }
    });
}

$(document).on('click', '.edit-previous-emp', function () {
    let id = $(this).attr('data-id');
    edit_prev_experience(id);
});

edit_prev_experience = (id) => {
    let url = '/api/get_previous_experience/id/' + id;
    ajaxRequest('get', url, null, function (result) {
        $('#job_type').val(result.job_type);
        $('#period').val(result.period);
        $('#country').val(result.country);
        $('#save_previous_emp').addClass('d-none');
        $('#update_previous_emp').removeClass('d-none');
        $('#update_previous_emp').attr('data-id', id);
    });
}

// load_previous_employeement_table = (id, privillages = []) => {
//     let index = 1;
//     let html = '';
//     ajaxRequest('get', '/api/get_previous_employeements/id/' + id, null, function (result) {
//         if (result != '') {
//             result.forEach(previous_emp => {
//                 let first_name = (previous_emp.added_by != null) ? (previous_emp.added_by.first_name != null) ? previous_emp.added_by.first_name : '': '';
//                 let last_name = (previous_emp.added_by != null) ? (previous_emp.added_by.last_name != null) ? previous_emp.added_by.last_name : '': '';
//                 let created_at = new Date(previous_emp.created_at);
//                 let formatted_created_at = created_at.getFullYear()+'-'+created_at.getMonth()+'-'+created_at.getDate();

//                 html += '<tr>';
//                 html += '<td>' + index++ + '</td>';
//                 html += '<td>' + previous_emp.job_type + '</td>';
//                 html += '<td>' + previous_emp.country + '</td>';
//                 html += '<td>' + previous_emp.period + '</td>';
//                 html += '<td>' + first_name +' '+ last_name + '</td>';
//                 html += '<td>' + formatted_created_at + '</td>';
//                 html += '<td>';
//                 if(privillages['is_update'] == '1'){
//                     html += '<button type="button" class="btn btn-primary btn-sm edit-previous-emp m-1" data-id="' + previous_emp.id + '"> Edit </button>';
//                 }else{
//                     html += '<button type="button" class="btn btn-primary btn-sm edit-previous-emp m-1" disabled> Edit </button>';
//                 }
//                 if(privillages['is_delete'] == '1'){
//                     html += '<button type="button" class="btn btn-danger btn-sm delete-prev-emp m-1" data-id="' + previous_emp.id + '"> Delete </button>';
//                 }else{
//                     html += '<button type="button" class="btn btn-danger btn-sm delete-prev-emp m-1" disabled> Delete </button>';
//                 }
//                 html += '</td>';
//             });
//             $('#previous_emp_tbl tbody').html(html);
//             $('#previous_emp_tbl').DataTable({
//                 "pageLength": 10,
//                 "destroy": true,
//                 "retrieve": true
//             });
//         } else {
//             $('#previous_emp_tbl tbody').html('<tr><td colspan="7" class="text-center text-bold"><span>No Data</span></td></tr>');
//         }
//     });
// }

$("#previous_employeement_form").validate({
    errorClass: "invalid",
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
jQuery.validator.addMethod("valid_email", function (value, element) {
    return this.optional(element) || /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/.test(value);
}, "Please enter a valid email addresss");
jQuery.validator.addMethod("valid_code", function (value, element) {
    return this.optional(element) || /^[a-zA-Z0-9._%+-@#()^;*!$=, ]{1,40}$/.test(value);
}, "Please enter a valid password");
jQuery.validator.addMethod("valid_lk_phone", function (value, element) {
    return this.optional(element) || /^(\+94)?\d{2,3}[-]?\d{7}$/.test(value);
}, "Please enter a valid phone number");
jQuery.validator.addMethod("valid_date", function (value, element) {
    return this.optional(element) || /^\d{4}\-\d{2}\-\d{2}$/.test(value);
}, "Please enter a valid date ex. 2017-03-27");
jQuery.validator.addMethod("valid_nic", function (value, element) {
    return this.optional(element) || /^[0-9+]{12}$/.test(value) || /^[0-9+]{9}[vV|xX]$/.test(value);
}, "Please enter a valid nic number");