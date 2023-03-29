$('#save_vacancy').click(function() {
    if (!jQuery("#vacancy_form").valid()) {
        return false;
    }
    let data = {
        'title': $('#title').val(),
        'salary': $('#salary').val(),
        'period': $('#period').val(),
        'location': $('#location').val(),
        'vacancy_image': $('#vacancy_image')[0].files[0],
    };
    ulploadFileWithData('/api/save_vacancy', data, function(result) {
        if (result.status == 1) {
            toastr.success('Vacancy saving was successful!')
            location.reload();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Vacancy saving was failed!');
        }
    });
});


$('#update_vacancy').click(function() {
    if (!jQuery("#vacancy_form").valid()) {
        return false;
    }
    let data = {
        'title': $('#title').val(),
        'salary': $('#salary').val(),
        'period': $('#period').val(),
        'location': $('#location').val(),
        'vacancy_image': $('#vacancy_image')[0].files[0],
    };
    ulploadFileWithData('/api/update_vacancy/id/' + $(this).attr('data-id'), data, function(result) {
        if (result.status == 1) {
            toastr.success('Vacancy updating was successful!')
            location.reload();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Vacancy updating was failed!');
        }
    });
});

$(document).on('click', '.edit', function() {
    let id = $(this).attr('data-id');
    load_edit_form(id);
});

$(document).on('click', '.delete', function() {
    let id = $(this).attr('data-id');
    delete_vacancy(id);
});

load_edit_form = (vacancy_id) => {
    ajaxRequest('get', '/api/get_vacancy/id/' + vacancy_id, null, function(result) {
        if (result != '') {
            $('#title').val(result.title);
            $('#salary').val(result.salary);
            $('#period').val(result.period);
            $('#location').val(result.location);
            $('#update_vacancy').attr('data-id', result.id);
            $('#save_vacancy').addClass('d-none');
            $('#update_vacancy').removeClass('d-none');
        }
    });
}

delete_vacancy = (vacancy_id) => {
    ajaxRequest('delete', '/api/delete_vacancy/id/' + vacancy_id, null, function(result) {
        if (result.status == 1) {
            location.reload();
            toastr.success('Deleting vacancy was successful!')
        } else {
            toastr.error('Deleting vacancy was failed!');
        }
    });
}

load_vacancy_table = (privillages = []) => {
    let index = 1;
    let html = '';
    ajaxRequest('get', '/api/get_vacancies', null, function(result) {
        if (result != '') {
            result.forEach(vacancy => {
                html += '<tr>';
                html += '<td>' + index++ + '</td>';
                let vacancy_image = (vacancy.vacancy_image != '') ? vacancy.vacancy_image : './dist/img/no-image.jpg';
                html += '<td><img src="' + vacancy_image + '" alt="vacancy image" style="width: 100px; height: 100px"/></td>';
                html += '<td style="width: 15em">' + vacancy.title + '</td>';
                html += '<td style="width: 15em">' + vacancy.salary + '</td>';
                html += '<td style="width: 15em">' + vacancy.period + '</td>';
                html += '<td style="width: 15em">' + vacancy.location + '</td>';
                if(privillages['is_update'] == '1'){
                    html += '<td><button type="button" class="btn btn-primary btn-sm edit m-1" data-id="' + vacancy.id + '"> Edit </button>';
                }else{
                    html += '<td><button type="button" class="btn btn-primary btn-sm edit m-1" disabled> Edit </button>';
                }
                if(privillages['is_delete'] == '1'){
                    html += '<button type="button" class="btn btn-danger btn-sm delete m-1" data-id="' + vacancy.id + '"> Delete </button></td>';
                }else{
                    html += '<button type="button" class="btn btn-danger btn-sm delete m-1" disabled> Delete </button></td>';
                }
            });
            $('#vacancy_tbl tbody').html(html);
            $("#vacancy_tbl").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#vacancy_tbl_wrapper .col-md-6:eq(0)');;
        }else{
            $('#vacancy_tbl tbody').html('<tr><td colspan="7" class="text-center text-bold"><span>No Data</span></td></tr>');
        }
    });
}

$("#vacancy_form").validate({
    errorClass: "invalid",
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