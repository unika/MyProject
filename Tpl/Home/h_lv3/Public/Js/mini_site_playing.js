
(function ($) {


    $.fn.blockSlide = function (settings) {
        settings = jQuery.extend({
            speed: "normal",
            num: 5,
            timer: 30000,
            flowSpeed: 3000
        }, settings);
        return this.each(function () {
            $.fn.blockSlide.scllor($(this), settings);
        });
    };

    $.fn.blockSlide.scllor = function ($this, settings) {
        var ul = $("#myjQueryNav");
        var imgScllor = $("#myjQueryContent>div");
        var timerID;
        var index = 0;
        var li = ul.children();

        $(imgScllor).eq(index).animate({ opacity: 1 }, settings.speed).css({ "z-index": "5" }).siblings().animate({ opacity: 0 }, settings.speed).css({ "z-index": "0" });
        $(li).eq(index).addClass("current").siblings().removeClass("current");
        index = 1;
        $(li).hover(function () {
            if (MyTime) {
                clearInterval(MyTime);
            }
            index = $(li).index(this);
            MyTime = setTimeout(function () {
                $(imgScllor).stop();
                ShowjQueryFlash(index);
            }, 400);

        }, function () {
            clearInterval(MyTime);
            MyTime = setInterval(function () {
                ShowjQueryFlash(index);

                index++;
                if (index == settings.num)
                    index = 0;
            }, settings.timer);
        });

        $(imgScllor).hover(function () {
            if (MyTime) {
                clearInterval(MyTime);
            }
            $("#myjQueryContent").stop();
            $("#myjQueryContent").animate({ opacity: "0.5" }, 500);
        }, function () {
            $("#myjQueryContent").stop();
            $("#myjQueryContent").animate({ opacity: "1" }, 500);
            MyTime = setInterval(function () {
                ShowjQueryFlash(index);

                index++;
                if (index == settings.num)
                    index = 0;
            }, settings.timer);
        });
        var MyTime = setInterval(function () {
            ShowjQueryFlash(index);
            //alert(index);
            index++;
            if (index == settings.num)
                index = 0;
        }, settings.timer);
        var ShowjQueryFlash = function (i) {
            $(imgScllor).eq(i).animate({ opacity: 1 }, settings.speed).css({ "z-index": "5" }).siblings().animate({ opacity: 0 }, settings.speed).css({ "z-index": "0" });
            $(li).eq(i).addClass("current").siblings().removeClass("current");
        }
    }
})(jQuery);
$("#myjQuery").blockSlide({
    speed:1300,
    num: 4,
    timer: 3000,
    flowSpeed: 200
});