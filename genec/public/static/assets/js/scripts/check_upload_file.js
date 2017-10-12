function check(form) {
    var error = $('#error');
    var apply = getFileName(form.apply.value);
    if(apply[1] != 'doc' && apply[1] != 'docx') {
        error.css('padding','15px');
        error.html('上传的文件必须是doc或docx类型');
        return false;
    }
    if(form.title.value != apply[0]) {
        error.css('padding','15px');
        error.html('题目要与上传文件名一致');
        return false;
    }
    return true;
}

function getFileName(file) {
    var pos = file.lastIndexOf('\\');
    file = file.substring(pos + 1);
    var pos2 = file.lastIndexOf('.');
    var arr = [];
    arr[0] = file.substring(0,pos2);
    arr[1] = file.substring(pos2 + 1);
    console.log(arr);
    return arr;
}