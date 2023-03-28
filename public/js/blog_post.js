
$('#save_blog_post').click(function (privillages) {
    if (!jQuery("#blog_post_form").valid()) {
        return false;
    }
    let data = {
        'post_name': $('#post_name').val(),
        'description': $('#description').val(),
        'post_image': $('#post_image')[0].files[0]
    };

    ulploadFileWithData('/api/save_blog_post', data, function (result) {
        if (result.status == 1) {
            toastr.success('Blog post saving is successful!')
            location.reload();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Blog post saving was failed!');
        }
    });
});

$('#update_blog_post').click(function (privillages) {
    let data = {
        'post_name': $('#post_name').val(),
        'description': $('#description').val(),
        'post_image': $('#post_image')[0].files[0]
    };

    ulploadFileWithData('/api/update_blog_post/id/' + $('#update_blog_post').attr('data-id'), data, function (result) {
        if (result.status == 1) {
            toastr.success('Blog post updating is successful!');
            location.reload();
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        } else {
            toastr.error('Blog post updating was failed!');
        }
    });
});

// load_blog_posts = (privillages = []) => {
//     let index = 1;
//     let html = '';
//     ajaxRequest('get', '/api/get_blog_posts', null, function (result) {
//         if (result != '') {
//             result.forEach(blog_post => {
//                 let user_name = (blog_post.user.full_name != null) ? blog_post.user.full_name : '-';
//                 let created_at = new Date(blog_post.created_at);
//                 let formatted_created_at = created_at.getFullYear()+'-'+created_at.getMonth()+'-'+created_at.getDate();
//                 html += '<tr>';
//                 html += '<td>' + index++ + '</td>';
//                 html += '<td><img src=' + blog_post.post_image + ' class="img-responsive" alt="blog post image" width="100px" height="100px"/></td>';
//                 html += '<td>' + blog_post.post_name + '</td>';
//                 html += '<td style="word-wrap: break-word; max-width: 300px">' + blog_post.description + '</td>';
//                 html += '<td>' + user_name + '</td>';
//                 html += '<td>' + formatted_created_at + '</td>';
//                 html += '<td>';
//                 if(privillages['is_update'] == '1'){
//                     html += '<button type="button" class="btn btn-primary btn-sm edit m-1" data-id="' + blog_post.id + '"> Edit </button>';
//                 }else{
//                     html += '<button type="button" class="btn btn-primary btn-sm edit m-1" disabled> Edit </button>';
//                 }
//                 if(privillages['is_delete'] == '1'){
//                     html += '<button type="button" class="btn btn-danger btn-sm del m-1" data-id="' + blog_post.id + '"> Delete </button>';
//                 }else{
//                     html += '<button type="button" class="btn btn-danger btn-sm del m-1" disabled> Delete </button>';
//                 }
//                 html += '</td>';
//             });
//             $('#blog_post_tbl tbody').html(html);
//             $('#blog_post_tbl').DataTable({
//                 "pageLength": 10,
//                 "destroy": true,
//                 "retrieve": true
//             });
//         } else {
//             $('#blog_post_tbl tbody').html('<tr><td colspan="7" class="text-center text-bold"><span>No Data</span></td></tr>');
//         }
//     });
// }

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
            delete_blog_post(id);
        }
    });
});

delete_blog_post = (id) => {
    ajaxRequest('delete', '/api/delete_blog_post/id/' + id, null, function (result) {
        if (result.status == 1) {
            location.reload();
            toastr.success('Deleting blog post was successful!');
        } else {
            toastr.error('Deleting blog post was failed!');
        }
    });
}

reset_buttons = () => {
    $('#save_blog_post').removeClass('d-none');
    $('#update_blog_post').addClass('d-none');
}

$(document).on('click', '.edit', function () {
    let id = $(this).attr('data-id');
    edit_blog_post(id);
});

edit_blog_post = (id) => {
    let url = '/api/get_blog_post/id/' + id;
    ajaxRequest('get', url, null, function (result) {
        $('#post_name').val(result.post_name);
        $('#description').val(result.description);
        $('#save_blog_post').addClass('d-none');
        $('#update_blog_post').removeClass('d-none');
        $('#update_blog_post').attr('data-id', result.id);
    });
}

$("#blog_post_form").validate({
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
jQuery.validator.addMethod("valid_lk_phone", function (value, element) {
    return this.optional(element) || /^(\+94)?\d{2,3}[-]?\d{7}$/.test(value);
}, "Please enter a valid phone number");
jQuery.validator.addMethod("valid_date", function (value, element) {
    return this.optional(element) || /^\d{4}\-\d{2}\-\d{2}$/.test(value);
}, "Please enter a valid date ex. 2017-03-27");
jQuery.validator.addMethod("valid_nic", function (value, element) {
    return this.optional(element) || /^[0-9+]{12}$/.test(value) || /^[0-9+]{9}[vV|xX]$/.test(value);
}, "Please enter a valid nic number");