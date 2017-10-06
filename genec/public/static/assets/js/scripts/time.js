function timeStamp2String (date){
    console.log(date);
    date = new Date(date);
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    return year + "-" + formatTen(month) + "-" + formatTen(day);
};

function formatTen(num) {
    return num > 9 ? (num + "") : ("0" + num);
}

function formatDate(date) {
    date = new Date(date);
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    return year + "-" + month + "-" + day;
}