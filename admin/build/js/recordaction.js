function delete_record(id, tbl, id_name, type) {
 
    swal({
        title: "Are you sure?",
        text: "Do You want Deactivate  this account",
        icon: "warning",
        buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
        ],
        dangerMode: true
    }).then(function (isConfirm) {
        if (isConfirm) {
            swal({
                title: 'Deactivated',
                text: 'Sucessfully deactivated',
                icon: 'success'
            }).then(function () {
 
                var data = {
                    id: id,
                    tbl: tbl,
                    id_name: id_name

                };

                $.ajax({
                    type: "POST",
                    url: "./data/deact.php",
                    dataType: 'json',
                    data: data,

                    success: function (data) {

                        switch (data.res) {
                            case 1:
                                window.location.href = "admin_list.php?type=" + type;
                                break;
                            case 2:
                                window.location.href = "admin_list.php?type=" + type;
                                break;
                            case 3:
                                window.location.href = "currency_list.php";
                                break;
                            case 4:
                                window.location.href = "currency_list.php";
                                break;
                            case 5:
                                window.location.href = "user_list.php";
                                break;
                            case 6:
                                window.location.href = "user_list.php";

                                break;
                            case 7:
                                window.location.href = "lotto_result_list.php";
                                break;
                            case 8:
                                window.location.href = "lotto_result_list.php";

                                break;
                            case 9:
                                window.location.href = "lotto_pending_list.php";
                                break;
                            case 10:
                                window.location.href = "lotto_pending_list.php";
                                break;
                            case 11:
                                window.location.href = "user_diposit_request_list.php";
                                break;
                            case 12:
                                window.location.href = "user_diposit_request_list.php";
                                break;
                            case 13:
                                window.location.href = "slider_list.php";
                                break;
                            case 14:
                                window.location.href = "slider_list.php";
                                break;
                            case 15:
                                window.location.href = "user_withdraw_request_list.php";
                                break;
                            case 16:
                                window.location.href = "user_withdraw_request_list.php";
                                break;
                            case 17:
                                window.location.href = "service_list.php";
                                break;
                            case 18:
                                window.location.href = "service_list.php";
                                 break;
                            case 19:
                                window.location.href = "admin_withdraw_request_list.php";
                                 break;
                            case 20:
                                window.location.href = "package_list.php";
                        }

                    }
                });



            });
        } else {
            swal("Cancelled", "User Not Deactivated", "error");
        }
    });

}



function activate_record(id, tbl, id_name, type) {

    swal({
        title: "Are you sure?",
        text: "Do You want Activate  this account",
        icon: "warning",
        buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
        ],
        dangerMode: true,
    }).then(function (isConfirm) {
        if (isConfirm) {
            swal({
                title: 'Activated',
                text: 'Successfully Activated',
                icon: 'success'
            }).then(function () {

                var data = {
                    id: id,
                    tbl: tbl,
                    id_name: id_name,

                };

                $.ajax({
                    type: "POST",
                    url: "./data/act.php",
                    dataType: 'json',
                    data: data,

                    success: function (data) {

                        switch (data.res) {
                            case 1:
                                window.location.href = "admin_list.php?type=" + type;
                                break;
                            case 2:
                                window.location.href = "admin_list.php?type=" + type;

                            case 3:
                                window.location.href = "currency_list.php";
                                break;
                            case 4:
                                window.location.href = "currency_list.php";
                                break;
                            case 5:
                                window.location.href = "user_list.php";
                                break;
                            case 6:
                                window.location.href = "user_list.php";

                                break;
                            case 7:
                                window.location.href = "lotto_result_list.php";
                                break;
                            case 8:
                                window.location.href = "lotto_result_list.php";
                                break;
                            case 9:
                                window.location.href = "lotto_pending_list.php";

                            case 10:
                                window.location.href = "lotto_pending_list.php";
                                break;
                            case 11:
                                window.location.href = "user_diposit_request_list.php";
                                break;
                            case 12:
                                window.location.href = "user_diposit_request_list.php";
                                break;
                            case 13:
                                window.location.href = "slider_list.php";
                                break;
                            case 14:
                                window.location.href = "slider_list.php";
                            case 15:
                                window.location.href = "user_withdraw_request_list.php";
                                break;
                            case 16:
                                window.location.href = "user_withdraw_request_list.php";
                                   break;
                            case 17:
                                window.location.href = "service_list.php";
                                break;
                            case 18:
                                window.location.href = "service_list.php";
                                 break;
                            case 19:
                                window.location.href = "admin_withdraw_request_list.php";
                                 break;
                            case 20:
                                window.location.href = "package_list.php";



                        }



                    }
                });



            });
        } else {
            swal("Cancelled", "User Not Deactivated", "error");
        }
    });

}



function add_item(inv_id, item_id,qty,type) {
alert("Hi");
    swal({
        title: "Are you sure?",
        text: "Do You want Add this item",
        icon: "warning",
        buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
        ],
        dangerMode: true,
    }).then(function (isConfirm) {
        if (isConfirm) {
            swal({
                title: 'Add On ',
                text: 'Successfully Added',
                icon: 'success'
            }).then(function () {

                var data = {
                    inv_id: inv_id,
                    item_id: item_id,
                    qty: qty,
                    type: type,

                };

                $.ajax({
                    type: "POST",
                    url: "./data/addon.php",
                    dataType: 'json',
                    data: data,

                    success: function (data) {

                        $("#example23").load(location.href + " #example23");


                    }
                });



            });
        } else {
            swal("Cancelled", "User Not Deactivated", "error");
        }
    });

}


function add_service(inv_id,s_id,qty,type) {
    alert("Hello");
    swal({
        title: "Are you sure?",
        text: "Do You want Add this item",
        icon: "warning",
        buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
        ],
        
        dangerMode: true,
    }).then(function (isConfirm) {
        if (isConfirm) {
            swal({
                title: 'Add On ',
                text: 'Successfully Added',
                icon: 'success'
            }).then(function () {

                var data = {
                    inv_id: inv_id,
                    s_id: s_id,
                    qty: qty,
                    type: type,
                
                };

                $.ajax({
                    type: "POST",
                    url: "./data/addon.php",
                    dataType: 'json',
                    data: data,

                    success: function (data) {
                    

                        $("#example23").load(location.href + " #example23");


                    }
                });



            });
        } else {
            swal("Cancelled", "User Not Deactivated", "error");
        }
    });

}


