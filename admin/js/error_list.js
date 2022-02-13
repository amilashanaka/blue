/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function error_by_code(id) {

    switch (id) {
        case 1:

            swal("Successfully updated", "click ok to exit", "success");

            break;
        case 2:
            swal("Password Miss Match", "Please check", "warning");

            break;
        case 3:
            swal("Something Went Wrong", "Please check", "error");

            break;
        case 4:
            swal("Successfully Added", "Please check", "success");
            break;

        case 5:
            swal("User Name Already Taken", "Please check", "warning");

            break;

        case 6:
            swal("Bank Details Updated", "Please check", "success");
            break;

        case 7:
            swal("Password Updated", "Please check", "success");
            break;
        case 8:
            swal("Currency Name Already Exist ", "Please check", "error");
            break;

        case 9:
            swal("Successfully Transfer", "Sucess", "success");
            break;
        case 10:
            swal("Lotto Draw Number Exist", "Please check", "error");
            break;
        case 11:
            swal("insufficient Balance", "please Request Credit", "warning");
            break;
        case 12:
            swal("Successfully Transfer", "Please View Statements", "success");
            break;

        case 13:
            swal("Successfully Send", "Please View Statements", "success");
            break;

        case 14:
            swal("insufficient Balance", "please Enter Less Amount", "warning");
             break;

        case 15:
            swal("Limit Exceeded", "please Enter Less Amount", "warning");
    }



}


function update_message(body_txt) {


    swal("Successfully updated", body_txt, "success");
    
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 100
        });


        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Update Notification',
            body: body_txt
        })


    });
}



