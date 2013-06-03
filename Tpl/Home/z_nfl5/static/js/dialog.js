function dialog(url, width, height, cssName) {
    if (!document.getElementById('floatBox')) 
        $("body").append("<div id=\"dialog_bg\" style=\"height:" + $(document).height() + "px;filter:alpha(opacity=0);opacity:0;\"></div><div id=\"floatBox\" class=\"floatBox\"><div id=\"dialog_content\"></div><div id=\"dialog_close\"><span></span></div></div>");
    $("#dialog_bg,#dialog_close span").click(function () {if (height == null) height = "auto";$("#dialog_bg,#floatBox").hide();});
    $("#dialog_bg").show().css({ opacity: "0.5" });
    $("#floatBox").attr("class", cssName).css({ display: "block", left: (($(document).width()) / 2 - (parseInt(width) / 2)) + "px", top: ($(document).scrollTop() + 50) + "px", width: width, height: height });
    $("#dialog_content").load(url, function () { wojilu.ui.valid(); });    
}
function dialog2(id) {
    hideFloat();
    var tid = '';
    $(id).load('/ShoppingCart/SimpleCart.aspx?ajax=true');
    $(id).parent().addClass('relative').hover(function () { clearTimeout(tid); }, function () { tid = setTimeout(hideFloat, 3000) })
}
function hideFloat() {
    $('.sim_box').parent().parent().removeClass('relative');
    $('.sim_box').remove();
} 
