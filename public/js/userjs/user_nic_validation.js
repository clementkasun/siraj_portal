is_user_email_or_nic_exist = (data, callBack) => {
    ulploadFileWithData('/api/is_nic_or_email_exist', data, function (response) {  
        if (response.status == 1) {
            toastr.error('Email already exist!');
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack(true);
            }
        } 
        
        if (response.status == 2) {
            toastr.error('NIC already exist!');
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack(true);
            }
        } 

        if (response.status == 3) {
            toastr.error('NIC and Email both already exist!');
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack(true);
            }
        } 
        
        if(response.status == 0){
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack(false);
            }
        }
    });
}