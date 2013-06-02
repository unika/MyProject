
$(document).ready(function () {
    // $.post("/Layout/UserStatus.aspx".toAjax(), "", function (data) { $(".sys_login").html(data); }); $.post("/Layout/mycart.aspx".toAjax(), "", function (data) { $(".sys_cart").html(data); }); var referrer = document.referrer; if (!referrer) {
        // try { if (window.opener) { referrer = window.opener.location.href; } }
        // catch (e) { } 
    // }
    // if (referrer) { var rf_domain = referrer.split('/')[2]; } else { var rf_domain = ''; }
    // var domain = document.domain; if (rf_domain == '') { var key = ''; } else if (rf_domain == domain) { var key = ''; } else if (rf_domain == ".yahoo.") { var key = getQueryStringRegExp("p", referrer); } else if (rf_domain == ".aol.") { var key = getQueryStringRegExp("q", referrer); } else if (rf_domain == ".bing.") { var key = getQueryStringRegExp("q", referrer); } else if (rf_domain.indexOf(".google.")) { var key = getQueryStringRegExp("q", referrer); }
    // if (key != "") { $.cookie("ztkwd", key, { path: '/', expires: 1230 }); } 
})
jQuery.cookie = function (name, value, options) {
    if (typeof value != 'undefined') {
        options = options || {}; if (value === null) { value = ''; options = $.extend({}, options); options.expires = -1; }
        var expires = ''; if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date; if (typeof options.expires == 'number') { date = new Date(); date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000)); } else { date = options.expires; }
            expires = '; expires=' + date.toUTCString();
        }
        var path = options.path ? '; path=' + (options.path) : ''; var domain = options.domain ? '; domain=' + (options.domain) : ''; var secure = options.secure ? '; secure' : ''; document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else {
        var cookieValue = null; if (document.cookie && document.cookie != '') { var cookies = document.cookie.split(';'); for (var i = 0; i < cookies.length; i++) { var cookie = jQuery.trim(cookies[i]); if (cookie.substring(0, name.length + 1) == (name + '=')) { cookieValue = decodeURIComponent(cookie.substring(name.length + 1)); break; } } }
        return cookieValue;
    } 
}; function getDefr() {
    var defr = $.cookie("defr"); if (defr == null) { defr = $.ajax({ url: "/Layout/GetDefr.aspx", async: false }).responseText; $.cookie("defr", defr, { path: '/' }); }
    return defr;
}
$(document).ready(function () {
    var isRadio = $("input[name='currencylist']").length > 0; var curObj = isRadio ? $("input[name='currencylist']") : $("#currencylist"); curObj.change(function () {
        var curObjVal = isRadio ? $("input[name='currencylist']:checked").val() : $("#currencylist").val(); $.post("/Layout/ChangeCurrency.aspx".toAjax(), { 'currency': curObjVal }, function (data) {
            $.cookie("currObjData", data, { path: '/' }); if (document.location.href.indexOf(".aspx") >= 0 || rate.IsDynamic == 1) { location.reload(); }
            else { eval("var currObj = " + data); SetCurrency(isRadio, currObj); } 
        });
    }); var curr = $.cookie("currObjData"); if (curr == null || document.location.href.indexOf(".aspx") >= 0 || rate.IsDynamic == 1) return; eval("var currObj = " + curr); SetCurrency(isRadio, currObj);
}); function SetCurrency(isRadio, currObj) {
    if (isRadio) { $("input[name='currencylist'][value='" + currObj.new_Currency_Name + "']").attr("checked", true); }
    else { $("#currencylist").val(currObj.new_Currency_Name); }
    if ($(".sys_cur").length <= 0) return; $(".sys_cur").html(currObj.new_Currency_ShowName)
    if ($(".sys_p").length > 0) {
        $(".sys_p").each(function () {
            var price = $(this).data('price'); if (price == null) { price = $.trim($(this).html()); $(this).data('price', price); }
            price = price / getDefr(); var show_price = (currObj.new_Currency_Rate * price).toFixed(2); $(this).html(show_price);
        });
    }
    if ($(".sys_mp").length > 0) {
        $(".sys_mp").each(function () {
            var mprice = $(this).data('mprice'); if (mprice == null) { mprice = $.trim($(this).html()); $(this).data('mprice', mprice); }
            mprice = mprice / getDefr(); var show_mprice = (currObj.new_Currency_Rate * mprice).toFixed(2); $(this).html(show_mprice);
        });
    } 
}
function getQueryStringRegExp(name, url) { var reg = new RegExp("(^|\\?|&)" + name + "=([^&]*)(\\s|&|$)", "i"); if (reg.test(url)) return unescape(RegExp.$2.replace(/\+/g, " ")); return ""; }