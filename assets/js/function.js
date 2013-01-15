function checkDate(date) {
    var reg = /[0-9]{4}\/[0-9]{2}\/[0-9]{2}/;
    if(!reg.test(date)) {
        alert("Ngày tháng nhập vào không hợp lệ! (Phải có dạng yyyy/mm/dd)");
        return false;
    } else {
        return true;
    }
}
function checkBlank(name) {
    if(name=="") {
        alert("Chưa nhập tên!");
        return false;
    } else {
        return true;
    }
}
function checkBday(date) {
    var reg = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
    if(!reg.test(date)) {
        alert("Ngày sinh nhập vào không hợp lệ\nNgày sinh có dạng (năm-tháng-ngày)!");
        return false;
    } else {
        return true;
    }
}