function toast(toast_modal, msg) {
    toast_modal.modal('show');
    toast_modal.find('p').text(msg);
    setTimeout(function () {
        toast_modal.modal('hide');
    },1500);
}