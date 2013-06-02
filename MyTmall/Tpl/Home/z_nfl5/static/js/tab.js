function choose(x) {
    $('li.nfl_choose').removeClass('nfl_choose');
    $('#nfl_tab' + x + ',#nfl_pro' + x).addClass('nfl_choose');
}