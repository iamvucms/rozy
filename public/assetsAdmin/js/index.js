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
                    if(cw>550) $('.right').css('padding-left', '230px')
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
labels = [];
datas = []
dataview = [];
for (let i = 1; i < 31; i++) {
          labels.push('Ngày ' + i)
          datas.push(Math.floor(Math.random() * i) + i * 5)
          dataview.push(Math.floor(Math.random() * i * 10) + 100)
}
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
var myPieChart = new Chart(circlechart, {
          type: 'pie',
          data: {
                    labels: ['Điện Thoại - Máy Tính Bảng', 'Điện Tử - Điện Lạnh',
                              'Phụ Kiện - Thiết Bị Số', 'Laptop - Thiết bị IT', 'Máy Ảnh - Quay Phim',
                              'Điện Gia Dụng', 'Nhà Cửa Đời Sống', 'Hàng Tiêu Dùng - Thực Phẩm',
                              'Đồ chơi, Mẹ & Bé', 'Làm Đẹp - Sức Khỏe', 'Thời trang - Phụ kiện',
                              'Thể Thao - Dã Ngoại', 'Xe Máy, Ô tô, Xe Đạp', 'Sách, VPP & Quà Tặng'
                    ],
                    datasets: [
                              {
                                        label: "null",
                                        data: [Math.floor(Math.random() *10000) + 1000,Math.floor(Math.random() *10000) + 1000,Math.floor(Math.random() *10000) + 1000,Math.floor(Math.random() *10000) + 1000,Math.floor(Math.random() *10000) + 1000,Math.floor(Math.random() *10000) + 1000,Math.floor(Math.random() *10000) + 1000,Math.floor(Math.random() *10000) + 1000,Math.floor(Math.random() *10000) + 1000,Math.floor(Math.random() *10000) + 1000,Math.floor(Math.random() *10000) + 1000,Math.floor(Math.random() *10000) + 1000,Math.floor(Math.random() *10000) + 1000],
                                        backgroundColor: [
                                                  "#6ce3cf",
                                                  "#56aee2",
                                                  "#8a56e2",
                                                  "#cf56e2",
                                                  "#e25668",
                                                  "#e28956",
                                                  "#e2cf56",
                                                  "#aee256",
                                                  "#71e256",
                                                  "#6fe289",
                                                  "#1b3353",
                                                  "#467fcf",
                                                  "#E9967A",
                                                  "orange"
                                        ],
                                        borderColor: [
                                                  "white"
                                        ],
                                        borderWidth: [0.5]
                              }
                    ]
          },

          options: {
                    legend: {
                              display: false
                    },
                    responsive:true
          }
});
var circlechart = document.getElementById("circlechart1");
var myPieChart = new Chart(circlechart, {
          type: 'pie',
          data: {
                    labels: [' Rất Tốt (5 sao)',
                              ' Tốt (4 sao)',
                              ' Được (3 sao)',
                              ' Tệ (2 sao)',
                              ' Rất Tệ (1 sao)'
                    ],
                    datasets: [
                              {
                                        label: "null",
                                        data: [Math.floor(Math.random() *500) + 100,Math.floor(Math.random() *500) + 100,Math.floor(Math.random() *500) + 100,Math.floor(Math.random() *500) + 100,Math.floor(Math.random() *500) + 100],
                                        backgroundColor: [
                                                  "#c8d9f1",
                                                  "#7ea5dd",

                                                  "#467fcf",
                                                  "#4097e6",
                                                  "#1b3353",
                                        ],
                                        borderColor: [
                                                  'white'
                                        ],
                                        borderWidth: [0.5]
                              }
                    ]

          },

          options: {
                    legend: {
                              display: false
                    }
          }
});
//chartcontrolmonth
$('.monthcontrol #prev').click(() => {
          if (parseInt($('.cmonth').html()) > 1) $('.cmonth').html(parseInt($('.cmonth').html())-1)
})
$('.monthcontrol #next').click(() => {
          if (parseInt($('.cmonth').html()) < 12) $('.cmonth').html(parseInt($('.cmonth').html())+1)
})
//responsive
$(window).resize(()=>{
         let w = $(window).width();
         cw=w;
         if(w<550){
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

if(cw<550){
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