$(function () {
    initimg();
    $(".jqzoom").jqueryzoom({
        xzoom: 400, yzoom: 400
    });
});  


function cacl(x) {
    var temp_num = parseInt($('#nfl_qty>input').val());
    temp_num = temp_num + x;
    if (temp_num < 1) temp_num = 1;
    if (temp_num > 999) temp_num = 999;
    $('#nfl_qty>input').val(temp_num);
}


$('.buyp[name!="buy_Name"][name!="buy_Number"]').focus(function () {
    if ($(this).val() == 0) {
        $(this).val('');
    }
}).blur(function () {
    if ($(this).val() == '') {
        $(this).val('0');
    }
}).keyup(function () {
    var num = $(this).val();
    num = num.replace(/[^\d]/gi, '');
    $(this).val(num);
});