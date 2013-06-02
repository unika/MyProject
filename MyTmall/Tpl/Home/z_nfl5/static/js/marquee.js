$.fn.marquee = function (user_settings) {
    var settings = $.extend({ time: 3000, step: 70 }, user_settings);
    var self = $(this);
    self.append(self.html());
    var timeout = null;
    function play() {self.children().first().appendTo(self); self.scrollTop(0).animate({ scrollTop: settings.step }, 2000, function () { if (timeout) clearTimeout(timeout); timeout = setTimeout(function () { play(); }, settings.time); }); };
    function stop() { clearTimeout(timeout); self.stop() };
    self.hover(stop, play);
    play();
};

$('#nfl_order>ul').marquee();

