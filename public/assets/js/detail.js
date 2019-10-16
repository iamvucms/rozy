var hforfixedtop = 30;
$('.introbottom').css('display', 'none');
$('.boxtop').css('padding-bottom', "10px")
document.querySelectorAll('.quantitycart').forEach((val) => {
    val.childNodes[0].onclick = () => {
        if (parseInt(val.childNodes[1].value) - 1 > 0) val.childNodes[1].value = parseInt(val.childNodes[1].value) - 1;

    }
    val.childNodes[2].onclick = () => {
        val.childNodes[1].value = parseInt(val.childNodes[1].value) + 1;
    }
})
var product_row = 5;
var iproduct = 0;
var product_row_flash = 6;
var iproduct_flash = 0;
if ($(window).width() <= 768) {
    console.log($(window).width())
    product_row = 3;
    product_row_flash = 3;
    hforfixedtop = 0;
}
if ($(window).width() <= 450) {
    console.log($(window).width())
    product_row = 2;
    product_row_flash = 2;
    hforfixedtop = 0;
}
$('#megaheader').css('width', $('.bodyheader .megamenu').width() + 'px')
$(window).resize(function () {
    $('#megaheader').css('width', $('.bodyheader .megamenu').width() + 'px');
    if ($(window).width() <= 768) {
        console.log($(window).width())
        product_row = 3;
        product_row_flash = 3;
        document.querySelectorAll('#foryou .product').forEach((val) => {
            val.style.marginRight = '5px'
        })
    }
    if ($(window).width() <= 450) {
        console.log($(window).width())
        product_row = 2;
        product_row_flash = 2;
        document.querySelectorAll('#foryou .product').forEach((val) => {
            val.style.marginRight = '5px'
        })
    }
    let iproduct = 0;
    let iproduct_flash = 0;

    document.querySelectorAll('#foryou .product').forEach((val) => {
        iproduct++;
        if (iproduct % product_row == 0) {
            val.style.marginRight = '0px'
        }

    })
    document.querySelectorAll('#flashsales .product').forEach((val) => {
        iproduct_flash++;
        if (iproduct_flash % product_row_flash == 0) {
            val.style.marginRight = '0px'
        }

    })
});
document.querySelectorAll('#foryou .product').forEach((val) => {
    iproduct++;
    if (iproduct % product_row == 0) {
        val.style.marginRight = '0px'
    }

})


document.querySelectorAll('#flashsales .product').forEach((val) => {
    iproduct_flash++;
    if (iproduct_flash % product_row_flash == 0) {
        val.style.marginRight = '0px'
    }

})

$('#register').hide();
$('#clicklogin').hide();
$('#forgot').hide();
$('#clickregister').click(() => {
    $('#forgot').hide();
    $('#login').fadeOut(0);

    $('#register').fadeIn(500);

    $('#clicklogin').show();
    $('#clickregister').hide();
})
$('#clicklogin').click(() => {
    $('#forgot').hide();
    $('#register').fadeOut(0);
    $('#login').fadeIn(500);
    $('#clickregister').show();
    $('#clicklogin').hide();
})

$('#clickforgot').click(() => {
    $('#login').fadeOut(0);
    setTimeout(() => {
        $('#forgot').fadeIn(400)
    }, 200);
    $('#clicklogin').show();


})
$('#backlogin').click(() => {
    $('#forgot').hide();
    $('#login').fadeIn(1000);
    $('#clickregister').show();
    $('#clicklogin').hide();
    return false;
})
/*Hover Categories Li  */
$('#megahovertop').hover(() => {
    $('#megaheader').css('display', 'block');
})
$('#megaheader').mouseout(() => {
    $('#megahovertop').mouseout(() => {
        $('#megaheader').css('display', 'none');
    })
})
$('#megaheader').mouseout(() => {
    $('#megaheader').css('display', 'none');
})
$('#megaheader').mouseover(() => {
    $('#megaheader').css('display', 'block');
})
// endhovercategorili 
//Effect style
$('#justviewproducts').hover(() => {
    $('.justviewlist').css('display', 'flex');
})
$('.justviewlist').mouseout(() => {
    $('#justviewproducts').mouseout(() => {
        $('.justviewlist').css('display', 'none');
    })
})
$('.justviewlist').mouseout(() => {
    $('.justviewlist').css('display', 'none');
})
$('.justviewlist').mouseover(() => {
    $('.justviewlist').css('display', 'flex');


})
var preSelectedAddress = 'TP Hồ Chí Minh'
$('#select_address').mouseover((e) => {

    if ($('#select_address').val() !== '') {
        preSelectedAddress = $('#select_address').val()
    }
    $('#select_address').val('')
    $('#select_address').prop('checked')
    $('#select_address').attr("placeholder", preSelectedAddress)

})
$('#category').mouseout(() => {
    preSelectedAddress = $('#select_address').val()
})
$('#select_address').click((e) => {
    preSelectedAddress = $('#select_address').val()
    $('#select_address').val('')
    $('#select_address').prop('checked')
    $('#select_address').attr("placeholder", preSelectedAddress)
})
var i = 5;

setInterval(() => {
    if (i > 50) i = 5;
    $('#salepercent').text('-' + i + '%');
    i += 5;
}, 400)
//fixed box top 
var scrollHeight = $(window).scrollTop();
console.log(scrollHeight)
if (scrollHeight >= hforfixedtop) {
    $('.boxtop').css('position', 'fixed');
    $('.boxtop').css('top', '0%');
    $('.boxtop').css('width', '100%');
    if ($(window).width() > 768) {

    } else {
        $('.body').css('margin-top', '55px');
    }
}
else if (scrollHeight < hforfixedtop) {
    $('.boxtop').css('position', 'relative');


}
$(window).on("scroll", function () {
    var scrollHeight = $(window).scrollTop();
    console.log(scrollHeight)
    if (scrollHeight > hforfixedtop) {
        $('.boxtop').css('position', 'fixed');
        $('.boxtop').css('top', '0%');
        $('.boxtop').css('width', '100%');
        if ($(window).width() > 768) {
            $('.body').css('margin-top', '130px')
        } else {
            $('.body').css('margin-top', '55px');
        }
    }
    else if (scrollHeight <= hforfixedtop) {
        if ($(window).width() <= 768) {
            $('.body').css('margin-top', '10px');
        } else {
            $('.body').css('margin-top', '20px');
        }

        $('.boxtop').css('top', '0px');
        $('.boxtop').css('position', 'relative');


    }

});
$('.product').css('transition', 'all ease 0.2s');
//Carousel Slider Banner Mega
var owl = $('.description .destext #dslider');
owl.owlCarousel({
    items: 5,
    loop: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true
});
$('#goright').click(function () {
    owl.trigger('next.owl.carousel');
})
// Go to the previous item
$('#goleft').click(function () {
    // With optional speed parameter
    // Parameters has to be in square bracket '[]'
    owl.trigger('prev.owl.carousel', [300]);
})
$('#catsforyou .catsforyoutitle span').click(() => {
    $('#catsforyou').fadeOut(500);
})
var owlcat = $('#cats_slider');
owlcat.owlCarousel({
    items: 7,
    loop: false,
    margin: 5,
    responsiveClass: true,
    responsive: {
        0: {
            items: 3,
            nav: true
        },
        600: {
            items: 5,
            nav: false
        },
        1000: {
            items: 7,
            nav: true,
            loop: false
        }
    }
});
$('#catsforyou .rightarrow').click(function () {
    owlcat.trigger('next.owl.carousel');
})
// Go to the previous item
$('#catsforyou .leftarrow').click(function () {
    // With optional speed parameter
    // Parameters has to be in square bracket '[]'
    owlcat.trigger('prev.owl.carousel', [300]);
})
$('#keysforyou .catsforyoutitle span').click(() => {
    $('#keysforyou').fadeOut(500);
})
var owlkey = $('#keyslider');
owlkey.owlCarousel({
    margin: 5,
    responsiveClass: true,
    items: 5,
    loop: true,
    responsive: {
        0: {
            items: 4,
            nav: true
        },
        600: {
            items: 4,
            nav: false
        },
        1000: {
            items: 5,
            loop: false
        }
    }
});
$('.photolist .right').click(function () {
    owlkey.trigger('next.owl.carousel');
})
// Go to the previous item
$('.photolist .left').click(function () {
    // With optional speed parameter
    // Parameters has to be in square bracket '[]'
    owlkey.trigger('prev.owl.carousel', [300]);
})
$('#flashsales .loadmore').click(() => {
    $('#flashsales #loadmoretext').css('display', "none");
    $('#flashsales .loadingicon').attr('style', 'display:block !important;');
    setTimeout(() => {
        $('#flashsales .flashnext1').attr('style', 'display: inline-block !important');

        var iproduct_flash = 0;
        document.querySelectorAll('#flashsales .product').forEach((val) => {
            iproduct_flash++;
            if (iproduct_flash % product_row_flash == 0) {
                val.style.marginRight = '0px'
            }

        })
        $('#flashsales #loadmoretext').css('display', "block");
        $('#flashsales .loadingicon').attr('style', 'display:none !important;');
    }, 500)
})
console.log($('#foryou .flashnext1').attr('style'));
$('#foryou .loadmore').click(() => {
    $('#foryou #loadmoretext').css('display', "none");
    $('#foryou .loadingicon').attr('style', 'display:block !important;' + $('#foryou .loadingicon').attr('style'));
    setTimeout(() => {

        $('#foryou .flashnext1').attr('style', 'display: inline-block !important;' + $('#foryou .flashnext1').attr('style'));

        var iproduct = 0;
        document.querySelectorAll('#foryou .product').forEach((val) => {
            iproduct++;
            if (iproduct % product_row == 0) {
                val.style.marginRight = '0px'
            }

        })
        $('#foryou #loadmoretext').css('display', "block");
        $('#foryou  .loadingicon').attr('style', 'display:none !important;');
    }, 500)
})
// lazy load
document.querySelectorAll('img').forEach((val) => {
    val.setAttribute('data-src', val.src)
    val.setAttribute('src', "")

})
$("img").lazyload();//exec
document.querySelectorAll('.rating p').forEach((val) => {
    var rand = Math.floor(Math.random() * 5) + 1;
    for (let i = 0; i < rand * 2; i += 2) {
        val.childNodes[i].style.color = 'rgb(255, 217, 0)';
    }
    // console.log(val.childNodes);
})

$("#gotop").click(() => {
    if ($(window).width() > 768) {
        $('html,body').animate({
            scrollTop: $(".header").offset().top
        }, 'slow');
    } else {
        $('html,body').animate({
            scrollTop: 0
        }, 'slow');
    }
})
document.querySelectorAll('.photolist #keyslider .item li').forEach(item => {
    item.onclick = () => {
        $('.photolist .item li.active').removeClass('active')
        item.setAttribute('class', 'active')
        let src = item.childNodes[0].getAttribute('src')
        $('.mainphoto a img').attr('src', src);
        $('.mainphoto a img').data('src', src);
        $('.mainphoto a').zoom({ url: $('.mainphoto a img').data('src') })
    }
})
$('.mainphoto a').zoom({ url: $('.mainphoto a img').data('src') })
document.querySelectorAll('.colorpick .listcolors li').forEach(item => {
    item.onclick = () => {
        $('.colorpick .listcolors li.active').removeClass('active')
        item.classList.add('active')
    }
})
let btnquantity = document.querySelectorAll('.updowngroup button');
btnquantity[0].onclick = () => {
    if (parseInt(document.querySelector('.updowngroup input').value) - 1 > 0) document.querySelector('.updowngroup input').value = parseInt(document.querySelector('.updowngroup input').value) - 1
}
btnquantity[1].onclick = () => {
    if (parseInt(document.querySelector('.updowngroup input').value) + 1 <= document.querySelector('.updowngroup').dataset.max) document.querySelector('.updowngroup input').value = parseInt(document.querySelector('.updowngroup input').value) + 1
}
$('.btnviewmore button').click(() => {
    $('.productinfo .description table tr').fadeIn(200)
    $('.btnviewmore button').hide(200)
})
$('#readtextmore').click(() => {
    $('.destext .blocknew').fadeIn(200)
    $('#readtextmore').hide(200)
})
$("#scroll2review").click(() => {
    $('html, body').animate({
        scrollTop: $("div.review").offset().top - 110
    }, 'slow')
})
$('.inbox p.intitle').click(() => {
    $('.inbox').attr('id', 'active')
    $('.boxchat').css('display', 'block')
    $(".chatlist").animate({ scrollTop: $('.scrolllog').height() }, 1000);
})
$('.closechat').click(() => {

    $('.boxchat').hide()
    $('.inbox').attr('id', 'notactive')
})
// let a = ($(window).width()*14/100-10-130/2)*2-20;
// $('.inbox .boxchat').css('width',a+"px")
// $('.inbox .boxchat').css('left','calc(100% - '+a+"px"+')/2')
var inputs = document.querySelector('.searchinput')
try {
    var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    var recognition = new SpeechRecognition();

    recognition.onresult = function (event) {
        var current = event.resultIndex;
        var transcript = event.results[current][0].transcript;
        $('.searchinput').val(transcript)
        $('.boxmic').hide()
        $('.ideaforsearch').fadeIn()
        document.querySelectorAll('#idealist li').forEach(v => {
            if (v.childNodes[0].childNodes[1].innerHTML.toLowerCase().indexOf(inputs.value.toLowerCase()) > -1) {
                v.style.display = "block"
            } else v.style.display = "none"
        })
    }
    recognition.onstart = function () {
    }
    recognition.onspeechend = function () {
    }

    recognition.onerror = function (event) {
        if (event.error == 'no-speech') {
            $('.boxmic').hide()
        };
    }
    console.log(recognition)
}
catch (e) {
    console.log(e)
}
document.querySelector('button.micnow').onclick = () => {
    $('.justviewlist').hide();
    $('#megaheader').hide()
    recognition.start();
    $('.boxmic').fadeIn()
    return false;
}
document.querySelector('.rozy').onclick = (e) => {
    if (!!!e.target.getAttribute('class') || e.target.getAttribute('class').indexOf('mic') < 0) $('.boxmic').hide()
    if (!!!e.target.getAttribute('class') || e.target.getAttribute('class').indexOf('searchinput') < 0) $('.ideaforsearch').hide()
}

inputs.onclick = () => {
    $('.ideaforsearch').fadeIn()
}
inputs.oninput = () => {
    console.log(inputs.value)
    document.querySelectorAll('#idealist li').forEach(v => {
        if (v.childNodes[0].childNodes[1].innerHTML.toLowerCase().indexOf(inputs.value.toLowerCase()) > -1) {
            v.style.display = "block"
        } else v.style.display = "none"
    })
}