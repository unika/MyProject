
function initimg() {
    if (!$('#slidePic')[0])
        return;
    var i = 0, p = $('#slidePic ul'), pList = $('#slidePic ul li'), len = pList.length;
    var elePrev = $('#prev'), eleNext = $('#next');
    //var firstClick = false;
    var w = 59, num = 5;
    var selected_i = 0;
    p.css('width', w * len);
    if (len <= num)
        eleNext.addClass('gray');
    //left
    function prev() {
        if (elePrev.hasClass('gray')) {
            //alert('已经是第一张了');
            if ((selected_i - 1) < 0) { return; }
            selected_i--;
            show();
            return;
        }
        p.animate({
            marginLeft: -(--i) * w
            //marginTop:-(--i) * w
        }, 500);
        if (i < len - num) {
            eleNext.removeClass('gray');
            selected_i--;
            show();
        }
        if (i == 0) {
            elePrev.addClass('gray');
        }
    }
    function next() {
        if (eleNext.hasClass('gray')) {
            //alert('已经是最后一张了');
            //return;
            if ((selected_i + 1) >= len) { return; }
            selected_i++;
            show();
            return;
        } else {
            //p.css('margin-left',-(++i) * w);
            p.animate({
                marginLeft: -(++i) * w
                //marginTop:-(++i) * w
            }, 500);
            if (i != 0) {
                elePrev.removeClass('gray');
                selected_i++;
                show()
            }

            if (i == len - num) { eleNext.addClass('gray'); }
        }
    }
    elePrev.live('click', prev);
    eleNext.live('click', next);
    //$("#slidePic ul li:first").addClass('cur');
    pList.hover(function () {
        selected_i = $(this).index();
        show();
    })
    function show() {
        var hoverImg = $("#slidePic ul li:eq(" + selected_i + ")").find('IMG');
        var imgSrc = hoverImg.attr("jqimg");
        var imgJqimg = hoverImg.attr("jqimg2");
        $('#minImage').css('height', $('#minImage').height()).attr('src', "/static/img/loading2.gif");
        var newImage = new Image();
        newImage.onload = function () { $('#minImage').attr('src', imgSrc).css('height','auto'); };
        newImage.src = imgSrc;
        $('#minImage').attr('jqimg', imgJqimg);
        $('#slidePic ul li.cur').removeClass('cur');
        $("#slidePic ul li:eq(" + (selected_i) + ")").addClass("cur");
    }
}




function selattr(sel) {
    var curSel = $(sel);
    curSel.parent().children().removeClass("selected");
    curSel.addClass("selected");

    var attrName = curSel.attr("attrName");
    var inputName = "buy_" + attrName;
    var attrVal = curSel.attr("val");

    $("input[name=" + inputName + "]").val(attrVal);
}

function CaclPrice() {

}

function ValidBuy() {

    var msg = "";
    $(".buyp").each(
        function () {
            if (this.value == "") msg = msg + this.getAttribute("msg") + "\r\n\r\n";
        }
    );
   if (msg.length > 0) alert(msg);

   var num = $("input[name='buyNum']").val();
   num = num.replace(/[^\d]/gi, '');
   if (num == "" || num < 1) num = 1;
   $("input[name='buyNum']").val(num);

   return msg.length <= 0;
}


//限时抢购
function view_time() {

    if (the_s >= 0) {

        var the_H = Math.floor((the_s ) / 3600);
        var the_M = Math.floor((the_s - the_H * 3600) / 60);
        var the_S = (the_s - the_H * 3600) % 60;

        var html = "Left ";

        html += "<span>" + the_H + "</span>H";
        html += "<span>" + the_M + "</span>M";
        html += "<span>" + the_S + "</span>S";

        $("#limit_time").html(html);

        the_s--;
    }
    else {
        $("#limit_time").html("Has Ended");
        clearInterval(limit_time);
    }
}

