function ajaxRequest(Method, url, data, callBack) {
    $.ajax({
        type: Method,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer " + $('meta[name=api-token]').attr("content"),
            "Accept": "application/json"
        },
        url: url,
        data: data,
        contentType: false,
        dataType: "json",
        cache: false,
        success: function (result) {
            if(result.status == 4){
                Toast.fire({
                    type: 'warning',
                    title: result.msg
                });
                return false;
            }
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack(result);
            }
        }, error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 401) {
                msg = 'You Dont Have Privilege To Performe This Action!';
            } else if (jqXHR.status == 422) {
                msg = 'Validation Error !';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            Toast.fire({
                type: 'error',
                title: msg
            });
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack(msg);
            }
        }
    });
}

function submitDataWithFile(url, frmDta, callBack, metod = false) {
    let formData = new FormData();
    // populate fields
    $.each(frmDta, function (k, val) {
        formData.append(k, val);
    });
    ulploadFile2(url, formData, function (result) {
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack(result);
        }
    }, metod);
}

function show_mesege(resp_id) {
    if (resp_id.id == 1) {
        Toast.fire({
            type: 'success',
            title: 'Agency Management System</br>Success!'
        });
    } else {
        Toast.fire({
            type: 'error',
            title: 'Agency Management System</br>Error'
        });
    }
}
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000

});


function loadRoles(id, combo, callBack) {
    $.ajax({
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer " + $('meta[name=api-token]').attr("content"),
            "Accept": "application/json"
        },
        url: "/api/rolls/levelId/" + id,
        contentType: false,
        dataType: "json",
        cache: false,
        processDaate: false,
        success: function (result) {
            /// apending data to comboBox
            $('.' + combo).empty();
            $.each(result, function (key, value) {
                $('.' + combo).append(new Option(value.name, value.id));
            });
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        }
    });

}

function loadRolesById(id, combo, callBack) {
    $.ajax({
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer " + $('meta[name=api-token]').attr("content"),
            "Accept": "application/json"
        },
        url: "/api/rolls/id/" + id,
        contentType: false,
        dataType: "json",
        cache: false,
        processDaate: false,
        success: function (result) {
            /// apending data to comboBox
            $('.' + combo).empty();
            $.each(result, function (key, value) {
                $('.' + combo).append(new Option(value.name, value.id));
            });
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        }
    });

}

function loadAllRoles(combo, selected, callBack) {
    $.ajax({
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer " + $('meta[name=api-token]').attr("content"),
            "Accept": "application/json"
        },
        url: "/api/rolls",
        contentType: false,
        dataType: "json",
        cache: false,
        processDaate: false,
        success: function (result) {
            /// apending data to comboBox
            $('.' + combo).empty();
            $.each(result, function (key, value) {
                $('.' + combo).append(new Option(value.name, value.id));
            });
            $('.' + combo).val(selected);
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        }
    });

}