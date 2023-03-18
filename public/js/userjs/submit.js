// alert('linked');


function assignRolePrivillages(callBack) {
    var data = {
        role_id: $('#rollCombo').val(),
        pre: []
    }

    var table = $(".assignedPrivilages tbody tr");
    $.each(table, function (key, value) {

        var privillage = {
            id: value.id.substring(3),
            is_read: 0,
            is_create: 0,
            is_update: 0,
            is_delete: 0
        }
        privillage.is_read = ($(value).find('.read').prop('checked') ? 1 : 0);
        privillage.is_create = ($(value).find('.write').prop('checked') ? 1 : 0);
        privillage.is_update = ($(value).find('.update').prop('checked') ? 1 : 0);
        privillage.is_delete = ($(value).find('.delete').prop('checked') ? 1 : 0);
        if (privillage.is_read == true || privillage.is_create == true || privillage.is_update == true || privillage.is_delete == true) {
            data.privillage.push(privillage);
        }
    });
    // alert(JSON.stringify(data));

    $.ajax({
        type: "GET",
        url: "api/rolls/privilege/add",
        data: data,
        contentType: 'text/json',
        dataType: "json",
        cache: false,
        processDaate: false,
        success: function (result) {
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack(result);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            alert(textStatus + ':' + errorThrown);
        }
    });
}

function assignPrivillagesToUser(id, callBack) {
    // update user privileges

    var data = {
        user_id: id,
        role_id: $('.roleCombo').val(),
        privillage: []
    }

    var table = $(".assignedPrivilages tbody tr");
    $.each(table, function (key, value) {
        var privillage = {
            id: value.id.substring(10),
            is_read: 0,
            is_create: 0,
            is_update: 0,
            is_delete: 0
        }

        privillage.is_read = ($(value).find('.read').prop('checked') ? 1 : 0);
        privillage.is_create = ($(value).find('.write').prop('checked') ? 1 : 0);
        privillage.is_update = ($(value).find('.update').prop('checked') ? 1 : 0);
        privillage.is_delete = ($(value).find('.delete').prop('checked') ? 1 : 0);
        if (privillage.is_read == true || privillage.is_create == true || privillage.is_update == true || privillage.is_delete == true) {
            data.privillage.push(privillage);
        }
    });
    console.log(data);
    // alert(JSON.stringify(data));
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer " + $('meta[name=api-token]').attr("content"),
            "Accept": "application/json"
        },
    });
    $.ajax({
        type: "GET",
        url: "/user/privilege/add/" + id,
        data: data,
        contentType: 'text/json',
        dataType: "json",
        cache: false,
        success: function (result) {

            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        }
    });
}

function changeAciveStatus(id, data, callBack) {
    $.ajax({
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer " + $('meta[name=api-token]').attr("content"),
            "Accept": "application/json"
        },
        url: "/user/activity/" + id,
        data: data,
        contentType: 'text/json',
        dataType: "json",
        cache: false,
        success: function (result) {
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack();
            }
        }
    });
}
function deleteRole(id, callBack) {
    $.ajax({
        type: "DELETE",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer " + $('meta[name=api-token]').attr("content"),
            "Accept": "application/json"
        },
        url: "/rolls/rollId/" + id,
        cache: false,
        success: function (result) {
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack(result);
            }
        }
    });
}
function updateRole(id, data, callBack) {
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer " + $('meta[name=api-token]').attr("content"),
            "Accept": "application/json"
        },
        data: data,
        url: "/rolls/rollId/" + id,
        cache: false,
        success: function (result) {
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack(result);
            }
        }
    });
}

function activeDeletedUser(id, callBack) {
    $.ajax({
        type: "PUT",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer " + $('meta[name=api-token]').attr("content"),
            "Accept": "application/json"
        },

        url: "/user/active/" + id,
        cache: false,
        success: function (result) {
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack(result);
            }

            if (result.id == 1) {
                location.reload();
            }


        }
    });
}