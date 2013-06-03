/**
 * @author MyBrother
 */

//obj为指定的操作商品对象
function delgoods(obj) {
    var obj = getobj(obj);
    if (parseInt($(obj).val()) <= 1) {
        return false;
    }
    $(obj).val(parseInt($(obj).val()) - 1);
}

//obj为指定的操作商品对象
function addgoods(obj) {
    var obj = getobj(obj);
    $(obj).val(parseInt($(obj).val()) + 1);
}

//返回需要获取对象
function getobj(obj) {
    return document.getElementById(obj);
}

//obj为指定的操作商品对象
function addCart(obj) {
    var obj = getobj(obj);
    var json = new Array();
    $(".colorb").each(function(i) {
        if ($(this).hasClass("colorA")) {
            //将选取产品的属性存入一个数组
            //json.push('"' + $(this).attr("name") + '":"' + $.trim($(this).text()) + '"');
            json.push($(this).attr("name") + ':' + $.trim($(this).text()));
        }
    });
    $.post("/Cart/addCart", {
        "id" : $("#id").val(),
        "image" : $("#minImage").attr("src"),
        'attrvalue' : json,
        "number" : $("#qty").val(),
        "product_name" : $("#sys_pn").text(),
        "price" : $("#price").text(),//当前价格
    }, function(data) {
        if (data.status == 1) {
            //更改头部购物车数量
            $("#item").text(data.data);
            $.alert(data.info);
        }
    }, 'json');
}

//优惠券的有效性验证及使用
function validCoupon(obj) {
    var obj = getobj(obj);
    $.post("/Cart/validCoupon", {
        "No" : $(obj).val()
    }, function(data) {
        if (data.status == 1) {
            $("#sys_Coupon").text(data.data.coupon_price);
            $("#sys_GrandTotal").text(parseFloat($("#Total_price").text() - $("#sys_Coupon").text()).toFixed(2));
            $.alert(data.info);
        } else {
            $.alert(data.info);
        }
    }, 'json');
}

