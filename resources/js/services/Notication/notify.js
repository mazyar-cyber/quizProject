import toast from 'toastr';
import 'toastr/build/toastr.min.css';
toast.options = {
    "closeButton": false,
    "debug": true,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-left",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
class Notification {
    static success(msg){
        return toast.success(msg);
    }
    static error(msg){
        return toast.error(msg);
    }
}
export  default Notification;
