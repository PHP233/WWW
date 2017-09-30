function toast(msg, pre) {
    if(pre != null) {
        $(pre).modal('hide');
    }
    var toast_modal = $('#toast_modal');
    toast_modal.find('p').text(msg);
    toast_modal.modal('show');
    setTimeout(function () {
        toast_modal.modal('hide');
    },1500);
}