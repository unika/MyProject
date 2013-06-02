$("#sys_num ol").hover(function () { $(this).addClass('active') }, function () { $(this).removeClass('active') })

function code() { $("#cart_code").slideToggle('fast', function () { $("#cart_discount>a").toggleClass('active') }); }