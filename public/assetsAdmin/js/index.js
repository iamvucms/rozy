let nav_stt = true;
let cw = $(window).width();
$('#propbar').click(() => {
    if (nav_stt === true) {
        $('.menubar').css('width', '40px')
        setTimeout(() => {
            $('.right').css('width', 'calc(100% - 40px)')
            $('.right').css('padding-left', '40px')
        }, 200);
        $('.navtext').hide()
        $('.navitems li i.fa-angle-right').hide()
        $('.navitems li i.fa-angle-down').hide()
        $('.menubar .options').css('padding', '0px')
        $('.menubar .top').hide()
        $('.namehiden').hide()
        $('.navtitle').hide()
        $('.menubar').css('text-align', 'center')
        $('#propbar').css('float', 'none')
        $('#propbar').css('margin-right', '0px')
        $('.lv2items').hide()
        nav_stt = false;
    } else {
        $('.menubar').css('width', '230px')
        $('.right').css('width', '100%')
        if (cw > 550) $('.right').css('padding-left', '230px')
        $('.navtext').fadeIn()
        $('.navitems li i.fa-angle-right').fadeIn()
        $('.navitems li i.fa-angle-down').fadeIn()
        $('.menubar .options').css('padding', '20px')
        $('.menubar .top').fadeIn()
        $('.namehiden').fadeIn()
        $('.navtitle').fadeIn()
        $('.menubar').css('text-align', 'left')
        $('#propbar').css('float', 'right')
        $('#propbar').css('margin-right', '20px')
        nav_stt = true;
    }
})
document.querySelectorAll('.navitems li.lv1').forEach(val => {
    val.stt = 1

    val.onclick = (e) => {

        try {
            console.log(e.path[0].getAttribute('class'))
            if (nav_stt == true && val.stt == 1 && (e.path[0].getAttribute('class') == 'lv1' || e.path[0].getAttribute('class') == 'navtext' || e.path[0].getAttribute('class').indexOf('fas fa') >= 0)) {
                val.childNodes[5].style.display = 'block'
                val.childNodes[3].outerHTML = '<i class="fas fa-angle-down"></i>'
                val.style.height = 'auto'
                val.stt = 0
            } else if (nav_stt == true && val.stt != 1 && (e.path[0].getAttribute('class') == 'lv1' || e.path[0].getAttribute('class') == 'navtext' || e.path[0].getAttribute('class').indexOf('fas fa') >= 0)) {
                val.childNodes[5].style.display = 'none'
                val.childNodes[3].outerHTML = '<i class="fas fa-angle-right"></i>'
                val.style.height = '40px'
                val.stt = 1
            }
        } catch (error) {
            //do nothing
        }
    }
})
//chart
var ctx = document.getElementById('myChart').getContext('2d');

var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',
    // The data for our dataset
    data: {
        labels: labels,
        datasets: [{
            label: 'Doanh Thu (triệu đồng)',
            backgroundColor: 'transparent',
            borderColor: 'rgb(255, 99, 132)',
            data: datas
        },
        {
            label: 'Truy Cập (nghìn lượt)',
            backgroundColor: 'transparent',
            borderColor: '#3e9af0',
            data: dataview
        }
        ]
    },

    // Configuration options go here
    options: {

    }
});
//circle chart
var circlechart = document.getElementById("circlechart");


//responsive
$(window).resize(() => {
    let w = $(window).width();
    cw = w;
    if (w < 550) {
        $('.menubar').css('width', '40px')
        setTimeout(() => {
            $('.right').css('width', 'calc(100% - 40px)')
            $('.right').css('padding-left', '40px')
        }, 200);
        $('.navtext').hide()
        $('.navitems li i.fa-angle-right').hide()
        $('.navitems li i.fa-angle-down').hide()
        $('.menubar .options').css('padding', '0px')
        $('.menubar .top').hide()
        $('.namehiden').hide()
        $('.navtitle').hide()
        $('.menubar').css('text-align', 'center')
        $('#propbar').css('float', 'none')
        $('#propbar').css('margin-right', '0px')
        $('.lv2items').hide()
        nav_stt = false;
    }
})

if (cw < 550) {
    $('.menubar').css('width', '40px')
    $('.right').css('width', 'calc(100% - 40px)')
    $('.right').css('padding-left', '40px')
    $('.navtext').hide()
    $('.navitems li i.fa-angle-right').hide()
    $('.navitems li i.fa-angle-down').hide()
    $('.menubar .options').css('padding', '0px')
    $('.menubar .top').hide()
    $('.namehiden').hide()
    $('.navtitle').hide()
    $('.menubar').css('text-align', 'center')
    $('#propbar').css('float', 'none')
    $('#propbar').css('margin-right', '0px')
    $('.lv2items').hide()
    nav_stt = false;
}
$('.inbox .intitle').click(() => {
    $('.inbox').attr('id', 'active')
    $('.boxchat').css('display', 'flex')
    $(".chatlist").animate({ scrollTop: $('.scrolllog').height() }, 1000);
})
$('.closechat').click(() => {

    $('.boxchat').hide()
    $('.inbox').attr('id', 'notactive')
})