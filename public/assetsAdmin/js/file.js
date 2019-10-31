$('.closefolder').click(()=>{
          $('.foldercreate').css('transform','scale(0)')
})
$('#folderbtn').click(()=>{
          $('.foldercreate').css('transform','scale(1)')
})
$('.renamebox .closefolder').click(()=>{
          $('.renamebox').css('transform','scale(0)')
})
$('#renamebtn').click(()=>{
          $('.renamebox').css('transform','scale(1)')
})
$('#renamebtn2').click(()=>{
          $('.renamebox').css('transform','scale(1)')
})
document.querySelectorAll('.thumb .folder').forEach(v=>{
          v.ischeck = false;
          v.onclick = ()=>{
                    console.log()
                    if(v.ischeck==false){
                              document.querySelectorAll('.thumb .folder').forEach(v=>{
                                        v.childNodes[1].style.color = '#212529'
                                        v.style.border = '1px solid #ddd'
                                        v.childNodes[3].style.background = '#ddd'
                                        v.childNodes[3].style.color = '#212529'
                                        v.ischeck = false;
                              })
                              v.childNodes[1].style.color = '#007bff'
                              v.style.border = '1px solid #007bff'
                              v.childNodes[3].style.background = '#007bff'
                              v.childNodes[3].style.color = 'white'
                              v.ischeck = true;
                    }else{
                              v.childNodes[1].style.color = '#212529'
                              v.style.border = '1px solid #ddd'
                              v.childNodes[3].style.background = '#ddd'
                              v.childNodes[3].style.color = '#212529'
                              v.ischeck = false;
                    }
          }
          v.oncontex
})
document.querySelectorAll('.folder').forEach(v=>{
          v.oncontextmenu = (e)=>{
                    document.querySelectorAll('.thumb .folder').forEach(v=>{
                              v.childNodes[1].style.color = '#212529'
                              v.style.border = '1px solid #ddd'
                              v.childNodes[3].style.background = '#ddd'
                              v.childNodes[3].style.color = '#212529'
                              v.ischeck = false;
                    })
                    v.childNodes[1].style.color = '#007bff'
                    v.style.border = '1px solid #007bff'
                    v.childNodes[3].style.background = '#007bff'
                    v.childNodes[3].style.color = 'white'
                    v.ischeck = true;
                    $('.rclickmenu').fadeIn(200)
                    $('.rclickmenu').css('top',e.clientY+10+"px");
                    $('.rclickmenu').css('left',e.clientX+10+"px");
                    return false;
          }
})
document.querySelector('.vucms').onclick = ()=>{
          $('.rclickmenu').hide()
}
