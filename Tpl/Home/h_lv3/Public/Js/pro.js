$(function () {
    initimg();
    $(".jqzoom").jqueryzoom({
        xzoom: 400, yzoom: 400
    });



    //toupiao
    $(".toupiaokg").click(function () {
        var e = $(this);
        var dianle = e.parents("p").attr("diang");
        if (dianle != "isdianguole") {
            e.parents("p").siblings(".toupiao").html("Thank you for your feedback. Please note that only your first vote will be counted.");
            e.parents("p").attr("diang", "isdianguole");
        } else {
            e.parents("p").siblings(".toupiao").html("You may only submit one vote per review.");
        }


    });



});
$('#index ul li').hover(function () { var num = $(this).index(); $('li.hover').removeClass('hover'); $('#index ul li:eq(' + num + '),#index ol li:eq(' + num + ')').addClass('hover'); }, function () { })



function cartedshow(thisForm, data) {
    if (data.Msg != "ok") {
        alert(data.Msg);
    }
    else {
        $.post("/Layout/mycart.aspx".toAjax(), "", function (data2) { $(".sys_cart").html(data2); });
        dialog2('#add');
    }
    data.Msg = "";
}