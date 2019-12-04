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
    product_row = 3;
    product_row_flash = 3;
    hforfixedtop = 0;
}
if ($(window).width() <= 450) {
    product_row = 2;
    product_row_flash = 2;
    hforfixedtop = 0;
}
$('#megaheader').css('width', $('.bodyheader .megamenu').width() + 'px')
$(window).resize(function () {
    $('#megaheader').css('width', $('.bodyheader .megamenu').width() + 'px');
    if ($(window).width() <= 768) {
        product_row = 3;
        product_row_flash = 3;
        document.querySelectorAll('#foryou .product').forEach((val) => {
            val.style.marginRight = '5px'
        })
    }
    if ($(window).width() <= 450) {
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
    document.querySelector('#forgot').innerHTML = '<p class="logintitle" > Khôi phục tài khoản</p><span style="margin-top:10px;width:100px;display:none;" id="RecoveryMessage"></span><form onsubmit="return false;"><div class="inputgroup" id="recoveryGroup"><input id="recoveryEmail" type="text" name="email" placeholder="Email"autocomplete="off"> <br></div><p id="recoveryError" style="color:red;display:none;margin-top:5px"></p><button class="sendnow" id="backlogin"><span>Trở lại</span></button><button class="sendnow" id="recbutton" onclick="recovery()"><span>Khôi phục</span></button></form>'
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
var preSelected = 'Tất cả danh mục'
$('#category_select').mouseover((e) => {

    if ($('#category_select').val() !== '') {
        preSelected = $('#category_select').val()
    }
    $('#category_select').val('')
    $('#category_select').prop('checked')
    $('#category_select').attr("placeholder", preSelected)

})
$('#category').mouseout(() => {
    preSelected = $('#category_select').val()
})
$('#category_select').click((e) => {
    preSelected = $('#category_select').val()
    $('#category_select').val('')
    $('#category_select').prop('checked')
    $('#category_select').attr("placeholder", preSelected)
})
var i = 5;

setInterval(() => {
    if (i > 50) i = 5;
    $('#salepercent').text('-' + i + '%');
    i += 5;
}, 400)
//fixed box top 
var scrollHeight = $(window).scrollTop();
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
var owl = $('.bigslider');
owl.owlCarousel({
    items: 1,
    loop: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true
});
$('.customNextBtn').click(function () {
    owl.trigger('next.owl.carousel');
})
// Go to the previous item
$('.customPrevBtn').click(function () {
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
    loop: true,
    margin: 5,
    autoplay: true,
    autoplayTimeout: 5000,
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
    },
    autoplayHoverPause: true
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
var owlkey = $('#keys_slider');
owlkey.owlCarousel({
    items: 7,
    loop: true,
    margin: 30,
    autoplay: true,
    autoplayTimeout: 6000,
    autoplayHoverPause: true,
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
$('#keysforyou .rightarrow').click(function () {
    owlkey.trigger('next.owl.carousel');
})
// Go to the previous item
$('#keysforyou .leftarrow').click(function () {
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
let currentpage = 1;
if(isLogin===true & currentpage <=1) gotostep(2)
function gotostep(x) {
    if(isLogin===true && x <=1) x=2
    if(isLogin===false&& x >1) x=1;
    currentpage = x;
    
    history.pushState({
        id: 'nextStep'+x
    }, '', '?step='+x);
    
    $('.payment .process ul li p').attr('style', 'background:#efefef')
    $('.payment .process ul li a').attr('style', 'background:#acacac')
    $('.payment .process ul li span').attr('style', 'font-weight:300')
    let i = 1;
    let selector = document.querySelectorAll('.payment .process ul li');
    selector.forEach(v => {
        if (i <= x) {
            v.childNodes[0].style.backgroundColor = '#e33551'
            v.childNodes[0].childNodes[1].style.fontWeight = 'bold'
        }
        if(i+1<=x) v.childNodes[2].style.backgroundColor='#e33551'
        i++;
    })
    if (x == 1) {
        $('.checkout_info').hide(200)
        $('.paymethod').hide(200)
        $('.payfinish').hide(200)
        $('.stepredirect').hide()
        $('.loginform').fadeIn(400)


    }
    if (x == 2) {
        if(isLogin===false) window.location.reload()
        $('.loginform').hide(200)
        $('.paymethod').hide(200)
        $('.payfinish').hide(200)
        $('.stepredirect').fadeIn(500)
        $('.checkout_info').fadeIn(400)
        if ($(window).width() > 450) {
            $('.yourcartlist').fadeIn()
        } else {
            $('.yourcartlist').hide()
        }
    }
    if (x == 3) {
        $('.loginform').hide(200)
        $('.checkout_info').hide(200)
        $('.payfinish').hide(200)
        $('.paymethod').fadeIn(400)
        if ($(window).width() > 450) {
            $('.yourcartlist').fadeIn()
        } else {
            $('.yourcartlist').hide()
        }
    }
    if (x == 4) {
        $('.stepredirect').hide(200)
        $('.loginform').hide(200)
        $('.paymethod').hide(200)
        $('.checkout_info').hide(200)
        $('.payfinish').fadeIn(400)
        $('.yourcartlist').fadeIn()
    }
}

$('.stepredirect #back').click(() => {
    gotostep(currentpage - 1 > 0 ? currentpage - 1 : 1)
})
$('.stepredirect #next').click(() => {
    if (currentpage==2) checkStep2();
    else if(currentpage==3){
        checkStep3()
    }
    else gotostep(currentpage + 1)
})
let switchform = 1;
$('.botreg').click(() => {
    if (switchform == 1) {
        $('.reg').hide(100);
        $('.log').hide(100);
        $('.loghidden').fadeIn(500);
        $('.reghidden').fadeIn(500);
        $('.loginform').css('height', 'auto');
        $('.invitereg button').css('margin-top', '300px')
        switchform = 0
    } else {
        $('.reg').fadeIn(500);
        $('.log').fadeIn(500);
        $('.loghidden').hide(100);
        $('.reghidden').hide(100);
        $('.loginform').css('height', '450px');
        $('.invitereg button').css('margin-top', '150px')
        switchform = 1
    }
})
document.querySelectorAll('.choose div').forEach((val, index) => {
    val.onclick = () => {
        val.childNodes[3].checked = true;
        if (index == 0) {
            $('.formbank').hide()
            $('.formdirect').hide()
            $('.formccv').fadeIn(400)
        }
        if (index == 1) {
            $('.formccv').hide()
            $('.formdirect').hide()
            $('.formbank').fadeIn(400)
        }
        if (index == 2) {
            $('.formbank').hide()
            $('.formccv').hide()
            $('.formdirect').fadeIn(400)
        }
        document.querySelectorAll('.choose div').forEach(preval => {
            preval.removeAttribute('class')
        })
        val.setAttribute('class', 'active');
    }
    i++;
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
var inputs = document.querySelector('.searchinput')
inputs.onclick = () => {
    $('.ideaforsearch').fadeIn()
}
inputs.oninput = () => {
    let key = inputs.value.toLowerCase()
    axios.post('/findkey',{
        keyword:key
    }).then(d=>{
        data = d.data
        html = ''
        for(let product of data.data){
            if(product.img_avt){
                html += `<li>
                <a href="../../../products/${product.slug}"><img class="notchange" src="${product.img_avt.src}"><span>${product.name}</span></a>
                </li>`
            }
            else {
                html += `<li>
                <a href="../../../products/${product.slug}"><img src=""><span>${product.name}</span></a>
                </li>`
            }
        }
        document.querySelector('#idealist').innerHTML = html
    })
}