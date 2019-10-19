var hforfixedtop = 30;
$('.introbottom').css('display','none');
$('.boxtop').css('padding-bottom',"10px")
document.querySelectorAll('.quantitycart').forEach((val)=>{
          val.childNodes[0].onclick = ()=>{
                    if(parseInt(val.childNodes[1].value) -1>0) val.childNodes[1].value = parseInt(val.childNodes[1].value) -1;
                    
          }
          val.childNodes[2].onclick = ()=>{
                    val.childNodes[1].value = parseInt(val.childNodes[1].value) +1;
          }
})
var product_row = 5;
var iproduct=0;
var product_row_flash = 6;
var iproduct_flash=0;
if($(window).width() <= 768){
          
          console.log($(window).width())
          product_row=3;
          product_row_flash=3;
          hforfixedtop =0;
}
if($(window).width() <= 450){
          $('.fhead').css('padding-bottom','80px')
          console.log($(window).width())
          product_row=2;
          product_row_flash=2;
          hforfixedtop =0;
}
$('#megaheader').css('width',$('.bodyheader .megamenu').width()+'px')
$( window ).resize(function() {
          $('#megaheader').css('width',$('.bodyheader .megamenu').width()+'px');
          if($(window).width() <= 768){
                    $('.fhead').css('padding-bottom','30px')
                    console.log($(window).width())
                    product_row=3;
                    product_row_flash=3;
          }
          else if($(window).width() <= 450){
                    $('.fhead').css('padding-bottom','80px')
                    console.log($(window).width())
                    product_row=2;
                    product_row_flash=2;
                    document.querySelectorAll('#foryou .product').forEach((val)=>{
                              val.style.marginRight = '5px'
                    })
          }
          let iproduct=0;
          let iproduct_flash=0;
          
          document.querySelectorAll('#foryou .product').forEach((val)=>{
                    iproduct++;
                    if(iproduct%product_row==0){
                              val.style.marginRight = '0px'
                    }
                    
          })
          document.querySelectorAll('#flashsales .product').forEach((val)=>{
                    iproduct_flash++;
                    if(iproduct_flash%product_row_flash==0){
                              val.style.marginRight = '0px'
                    }
                    
          })
});
document.querySelectorAll('#foryou .product').forEach((val)=>{
          iproduct++;
          if(iproduct%product_row==0){
                    val.style.marginRight = '0px'
          }
          
})


document.querySelectorAll('#flashsales .product').forEach((val)=>{
          iproduct_flash++;
          if(iproduct_flash%product_row_flash==0){
                    val.style.marginRight = '0px'
          }
          
})

$('#register').hide();
$('#clicklogin').hide();
$('#forgot').hide();
$('#clickregister').click(()=>{
          $('#forgot').hide();
          $('#login').fadeOut(0);
           
          $('#register').fadeIn(500);
         
          $('#clicklogin').show();
          $('#clickregister').hide();
})
$('#clicklogin').click(()=>{
          $('#forgot').hide();
          $('#register').fadeOut(0);
          $('#login').fadeIn(500);
          $('#clickregister').show();
          $('#clicklogin').hide();
})

$('#clickforgot').click(()=>{
          $('#login').fadeOut(0);
          setTimeout(() => {
                    $('#forgot').fadeIn(400)
          }, 200);
          $('#clicklogin').show();
          
          
})
$('#backlogin').click(()=>{
    document.querySelector('#forgot').innerHTML = '<p class="logintitle" > Khôi phục tài khoản</p><span style="margin-top:10px;width:100px;display:none;" id="RecoveryMessage"></span><form onsubmit="return false;"><div class="inputgroup" id="recoveryGroup"><input id="recoveryEmail" type="text" name="email" placeholder="Email"autocomplete="off"> <br></div><p id="recoveryError" style="color:red;display:none;margin-top:5px"></p><button class="sendnow" id="backlogin"><span>Trở lại</span></button><button class="sendnow" id="recbutton" onclick="recovery()"><span>Khôi phục</span></button></form>'
          $('#forgot').hide();
          $('#login').fadeIn(1000);
          $('#clickregister').show();
          $('#clicklogin').hide();
          return false;
})
/*Hover Categories Li  */
$('#megahovertop').hover(()=>{
          $('#megaheader').css('display','block');
})
$('#megaheader').mouseout(()=>{
          $('#megahovertop').mouseout(()=>{
                    $('#megaheader').css('display','none');
          })
})
$('#megaheader').mouseout(()=>{
          $('#megaheader').css('display','none');
})
$('#megaheader').mouseover(()=>{
          $('#megaheader').css('display','block');
})
// endhovercategorili 
//Effect style
$('#justviewproducts').hover(()=>{
          $('.justviewlist').css('display','flex');
})
$('.justviewlist').mouseout(()=>{
          $('#justviewproducts').mouseout(()=>{
                    $('.justviewlist').css('display','none');
          })
})
$('.justviewlist').mouseout(()=>{
          $('.justviewlist').css('display','none');
})
$('.justviewlist').mouseover(()=>{
          $('.justviewlist').css('display','flex');
          
          
})
var preSelectedAddress = 'TP Hồ Chí Minh'
$('#select_address').mouseover((e)=>{
          
                    if($('#select_address').val()!==''){
                              preSelectedAddress = $('#select_address').val()
                    }
                    $('#select_address').val('')
                    $('#select_address').prop('checked')
                    $('#select_address').attr("placeholder",preSelectedAddress)
         
})
$('#category').mouseout(()=>{
          preSelectedAddress = $('#select_address').val()
})
$('#select_address').click((e)=>{
          preSelectedAddress = $('#select_address').val()
          $('#select_address').val('')
          $('#select_address').prop('checked')
          $('#select_address').attr("placeholder",preSelectedAddress)
})      
var i = 5;

setInterval(()=>{
          if(i>50) i =5;
          $('#salepercent').text('-'+i+'%');
          i+=5;
},400)
//fixed box top 
var scrollHeight =  $(window).scrollTop();
console.log(scrollHeight)
if(scrollHeight>=hforfixedtop){
          $('.boxtop').css('position','fixed');
          $('.boxtop').css('top','0%');
          $('.boxtop').css('width','100%');
          if($(window).width()>768){
                    $('.body').css('margin-top','130px')
          }else{
                    $('.body').css('margin-top','55px');
          }
}
else if(scrollHeight<hforfixedtop){
          // $('.boxtop').css('position','relative');
         
          
}
$(window).on("scroll", function() {
          var scrollHeight =  $(window).scrollTop();
          console.log(scrollHeight)
	if(scrollHeight>hforfixedtop){
                    $('.boxtop').css('position','fixed');
                    $('.boxtop').css('top','0%');
                    $('.boxtop').css('width','100%');
                    if($(window).width()>768){
                              
                              $('.body').css('margin-top','130px')
                    }else{
                              $('.body').css('margin-top','55px');
                    }
          }
          else if(scrollHeight<=hforfixedtop){
                    if($(window).width()<=768){
                              $('.body').css('margin-top','55px');
                    }else{
                              $('.body').css('margin-top','100px');
                    }
                    $('.boxtop').css('top','0px');
                    // $('.boxtop').css('position','relative');
          }
});
$('.product').css('transition','all ease 0.2s');
//Carousel Slider Banner Mega
var owl = $('.bigslider');
owl.owlCarousel({
    items:1,
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true
});
$('.customNextBtn').click(function() {
    owl.trigger('next.owl.carousel');
})
// Go to the previous item
$('.customPrevBtn').click(function() {
    // With optional speed parameter
    // Parameters has to be in square bracket '[]'
    owl.trigger('prev.owl.carousel', [300]);
})
$('#catsforyou .catsforyoutitle span').click(()=>{
          $('#catsforyou').fadeOut(500); 
})
var owlcat = $('#cats_slider');
owlcat.owlCarousel({
    items:7,
    loop:true,
    margin:5,
    autoplay:true,
    autoplayTimeout:5000,
    responsiveClass:true,
    responsive:{
        0:{
            items:3,
            nav:true
        },
        600:{
            items:5,
            nav:false
        },
        1000:{
            items:7,
            nav:true,
            loop:false
        }
    },
    autoplayHoverPause:true
});
$('#catsforyou .rightarrow').click(function() {
          owlcat.trigger('next.owl.carousel');
})
// Go to the previous item
$('#catsforyou .leftarrow').click(function() {
// With optional speed parameter
// Parameters has to be in square bracket '[]'
          owlcat.trigger('prev.owl.carousel', [300]);
})
$('#keysforyou .catsforyoutitle span').click(()=>{
          $('#keysforyou').fadeOut(500); 
})
var owlkey = $('#keys_slider');
owlkey.owlCarousel({
          items:7,
          loop:true,
          margin:30,
          autoplay:true,
          autoplayTimeout:6000,
          autoplayHoverPause:true,
          responsiveClass:true,
          responsive:{
          0:{
                    items:3,
                    nav:true
          },
          600:{
                    items:5,
                    nav:false
          },
          1000:{
                    items:7,
                    nav:true,
                    loop:false
          }
          }
      });
$('#keysforyou .rightarrow').click(function() {
          owlkey.trigger('next.owl.carousel');
})
// Go to the previous item
$('#keysforyou .leftarrow').click(function() {
// With optional speed parameter
// Parameters has to be in square bracket '[]'
          owlkey.trigger('prev.owl.carousel', [300]);
})
$('#flashsales .loadmore').click(()=>{
          $('#flashsales #loadmoretext').css('display',"none");
          $('#flashsales .loadingicon').attr('style','display:block !important;');
          setTimeout(()=>{
                    $('#flashsales .flashnext1').attr('style','display: inline-block !important');
                  
                    var iproduct_flash=0;
                    document.querySelectorAll('#flashsales .product').forEach((val)=>{
                              iproduct_flash++;
                              if(iproduct_flash%product_row_flash==0){
                                        val.style.marginRight = '0px'
                              }
                              
                    })
                    $('#flashsales #loadmoretext').css('display',"block");
                    $('#flashsales .loadingicon').attr('style','display:none !important;');
          },500)
})
console.log($('#foryou .flashnext1').attr('style'));
$('#foryou .loadmore').click(()=>{
          $('#foryou #loadmoretext').css('display',"none");
          $('#foryou .loadingicon').attr('style','display:block !important;'+$('#foryou .loadingicon').attr('style'));
          setTimeout(()=>{
                    
                    $('#foryou .flashnext1').attr('style','display: inline-block !important;'+$('#foryou .flashnext1').attr('style'));
                   
                    var iproduct=0;
                    document.querySelectorAll('#foryou .product').forEach((val)=>{
                              iproduct++;
                              if(iproduct%product_row==0){
                                        val.style.marginRight = '0px'
                              }
          
                    })
                    $('#foryou #loadmoretext').css('display',"block");
                    $('#foryou  .loadingicon').attr('style','display:none !important;');
          },500)
})
// lazy load
document.querySelectorAll('img').forEach((val)=>{
          val.setAttribute('data-src',val.src)
          val.setAttribute('src',"")
          
})
$("img").lazyload();//exec
document.querySelectorAll('.rating p').forEach((val)=>{
          var rand = Math.floor(Math.random() * 5)+1;
          for(let i=0;i<rand*2;i+=2){
                    val.childNodes[i].style.color = 'rgb(255, 217, 0)';
          }
          // console.log(val.childNodes);
})

$("#gotop").click(()=>{
          if($(window).width()>768){
                    $('html,body').animate({
                              scrollTop: $(".header").offset().top
                          }, 'slow');
          }else{
                    $('html,body').animate({
                              scrollTop: 0
                          }, 'slow');
          }
})
$('#filtertool .viewmorecat').click(()=>{
          if($('#filtertool .viewmorecat').html().indexOf('fa-sort-down')>-1){
                    $('#filtertool .hidecats').css('display','block')
                    $('#filtertool .viewmorecat').html('Ẩn bớt <i class="fas fa-caret-up"></i>')
          }else{
                    $('#filtertool .hidecats').css('display','none')
                    $('#filtertool .viewmorecat').html('Xem thêm <i class="fas fa-sort-down"></i>')
          }
          fixheightfilter()
})
$('#allcats .viewmorecat').click(()=>{
          if($('#allcats .viewmorecat').html().indexOf('fa-sort-down')>-1){
                    $('#allcats .hidecats').css('display','block')
                    $('#allcats .viewmorecat').html('Ẩn bớt <i class="fas fa-caret-up"></i>')
          }else{
                    $('#allcats .hidecats').css('display','none')
                    $('#allcats .viewmorecat').html('Xem thêm <i class="fas fa-sort-down"></i>')
          }
          fixheightfilter()
})
$('#chatlieutool .viewmorecat').click(()=>{
          if($('#chatlieutool .viewmorecat').html().indexOf('fa-sort-down')>-1){
                    $('#chatlieutool .hidecats').css('display','block')
                    $('#chatlieutool .viewmorecat').html('Ẩn bớt <i class="fas fa-caret-up"></i>')
          }else{
                    $('#chatlieutool .hidecats').css('display','none')
                    $('#chatlieutool .viewmorecat').html('Xem thêm <i class="fas fa-sort-down"></i>')
          }
          fixheightfilter()
})
$('#shirtype .viewmorecat').click(()=>{
          if($('#shirtype .viewmorecat').html().indexOf('fa-sort-down')>-1){
                    $('#shirtype .hidecats').css('display','block')
                    $('#shirtype .viewmorecat').html('Ẩn bớt <i class="fas fa-caret-up"></i>')
          }else{
                    $('#shirtype .hidecats').css('display','none')
                    $('#shirtype .viewmorecat').html('Xem thêm <i class="fas fa-sort-down"></i>')
          }
          fixheightfilter()
})
fixheightfilter()
function fixheightfilter(){
          let filterheight = 0;
          document.querySelectorAll('.filter .optioncol .categories').forEach((val)=>{
                    filterheight+=val.offsetHeight
          })
          $('.filter .optioncol').css('height',filterheight+50)
}
$('.stitle button').click(()=>{
        $('.stitle button.active').removeClass('active')  
})

// document.querySelectorAll('.groupsort button').forEach((val)=>{
//           val.onclick = ()=>{
//                     var role = val.dataset.sort;
//                     var a =[].slice.call(document.querySelectorAll('#foryou .product'));
                    
//                     if(role=='popular'){
//                               a= a.sort((a,b)=>parseInt(a.dataset.popular)-parseInt(b.dataset.popular))
//                     }
//                     else if(role=='date' ){
//                               a= a.sort((a,b)=>parseInt(a.dataset.date)-parseInt(b.dataset.date))
//                     }
//                     else if(role=='vote' ){
//                               a= a.sort((a,b)=>parseInt(a.dataset.vote)-parseInt(b.dataset.vote))
//                     }
//                     else if(role=='sales' ){
//                               a= a.sort((a,b)=>parseInt(a.dataset.sales)-parseInt(b.dataset.sales))
//                    }
//                     var html ="";
//                     for(let frag of a){
//                               html +=frag.outerHTML;
                              
//                     }
                    
//                     console.log(html)
//                     document.querySelector('#foryou .salesproducts').innerHTML = html;
//                     $('#foryou .product  img').each((index,val)=>{
//                               $(this).load(()=>{
//                               });
//                     })
//           }
          
// })
try {
          var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
          var recognition = new SpeechRecognition();
         
          recognition.onresult = function(event) {
                    var current = event.resultIndex;
                    var transcript = event.results[current][0].transcript;
                    $('.searchinput').val(transcript)
                    $('.boxmic').hide()
                    $('.ideaforsearch').fadeIn()
                    document.querySelectorAll('#idealist li').forEach(v=>{
                    if(v.childNodes[0].childNodes[1].innerHTML.toLowerCase().indexOf(inputs.value.toLowerCase())>-1){
                              v.style.display="block"
                    }else v.style.display="none"
                    })
                  }
          recognition.onstart = function() { 
          }
          recognition.onspeechend = function() {
          }
          
          recognition.onerror = function(event) {
          if(event.error == 'no-speech') {
                    $('.boxmic').hide()
          };
          }
          console.log(recognition)
}
catch(e) {
          console.log(e)
}
document.querySelector('button.micnow').onclick = ()=>{
          $('.justviewlist').hide();
          $('#megaheader').hide()
          recognition.start();
          $('.boxmic').fadeIn()
          return false;
}
document.querySelector('.rozy').onclick = (e)=>{
          if(!!!e.target.getAttribute('class') ||e.target.getAttribute('class').indexOf('mic')<0) $('.boxmic').hide()
          if(!!!e.target.getAttribute('class') ||e.target.getAttribute('class').indexOf('searchinput')<0) $('.ideaforsearch').hide()
}
var inputs = document.querySelector('.searchinput')
 inputs.onclick = ()=>{
          $('.ideaforsearch').fadeIn()
 }
inputs.oninput  =()=>{
          console.log(inputs.value)
          document.querySelectorAll('#idealist li').forEach(v=>{
                   if(v.childNodes[0].childNodes[1].innerHTML.toLowerCase().indexOf(inputs.value.toLowerCase())>-1){
                             v.style.display="block"
                   }else v.style.display="none"
          })
}