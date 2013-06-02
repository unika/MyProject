$('#nfl_cate>div>ul>li').hover(function () { $(this).addClass('nfl_hover'); $(this).append("<div id='temp'></div>"); }, function () { $(this).removeClass('nfl_hover'); $('#temp', this).remove() })
//$('#nfl_cate>div>ul>li>div>ul>li').hover(
//function () {
//    $(this).addClass('nfl_hover2');
//}, function () {
//    $(this).removeClass('nfl_hover2');
//  })
