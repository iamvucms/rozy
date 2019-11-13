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
//check all
var selectedCat = [];
try {
    document.querySelectorAll('#listbox table tr').forEach(v => {
        v.ischeck = false;
        v.onclick = () => {
            if (v.ischeck == false && v.childNodes[1].tagName != 'TH') {
                v.childNodes[1].childNodes[0].checked = true;
                selectedCat.push(v.childNodes[1].childNodes[0].dataset.idcat);
                v.ischeck = true;
            } else if (v.ischeck == true && v.childNodes[1].tagName != 'TH') {
                v.childNodes[1].childNodes[0].checked = false;
                selectedCat.splice(selectedCat.indexOf(v.childNodes[1].childNodes[0].dataset.idcat),1);
                v.ischeck = false;
            }
            console.log(selectedCat)
        }
    })
    var checkall = false
    document.querySelector('.tabcat table th:first-child').childNodes[0].onclick = (e) => {
        if (checkall == false) {
            document.querySelectorAll('.tabcat table tr td:first-child').forEach(v => {
                v.ischeck = true;
                v.childNodes[0].checked = true;
                checkall = true;
            })
        } else {
            document.querySelectorAll('.tabcat table tr td:first-child').forEach(v => {
                v.childNodes[0].checked = false;
                v.ischeck = false;
                checkall = false;
            })
        }
    }
} catch (e) { }
document.querySelectorAll('.panel ul li').forEach(v => {
    v.onclick = () => {
        $('.panel ul li.active').removeClass('active')
        v.classList = 'active'
        $('.tabcat table').hide()
        $('#' + v.dataset.id).fadeIn()
    }
})
function loadmoreaddfields() {
    document.querySelectorAll('#addfield').forEach(v => {
        v.onclick = () => {
            if (v.innerHTML == '+') {
                $('#tab3').append('<tr><td><input required name="propertyName[]" type="text" placeholder="Tên trường" style="text-align: right;padding-right: 5px;font-weight: bold;"></td><td style="padding-left: 25px!important;"><input required name="propertyValue[]" type="text" placeholder="Giá trị"></td><td style="width:10%"><button id="addfield">+</button></td></tr>')
                v.innerHTML = 'x'
                v.style.backgroundColor = 'red'
            } else {
                v.innerHTML = '+'
                v.parentNode.parentNode.outerHTML = ''
            }
            loadmoreaddfields()
            return false;
        }
        if(v.innerHTML=='x') v.style.backgroundColor = 'red'
    })
}
loadmoreaddfields()

document.querySelectorAll('#tab5 #addsale').forEach(v => {
    v.onclick = () => {
        $('#tab5').append(' <tr><td><select name="" id=""><option value="">Thân thiết</option><option value="">Mới</option><option value="">Tất cả</option></select></td><td><input type="number" placeholder="Số lượng"></td><td><input type="number" placeholder="Giá bán"></td><td><input type="text" placeholder="dd/mm/yy"></td><td><input type="text" placeholder="dd/mm/yy"></td><td><button id="delsale">x</button></td></tr>')
        document.querySelectorAll('#tab5 #delsale').forEach(v => {
            v.onclick = () => {
                v.parentNode.parentNode.outerHTML = ''
            }
        })
    }
})
document.querySelectorAll('#tab2 #delsale').forEach(v => {
    v.onclick = () => {
        v.parentNode.parentNode.outerHTML = ''
    }
})
document.querySelectorAll('#tab2 #addsale').forEach(v => {
    v.onclick = () => {
        $('#tab2').append(' <tr><td><input id="productname" type="text" list="listproduct" placeholder="Tên Sản Phẩm" ></td><td><input type="number" placeholder="Số lượng"></td><td><select name="aa" id="" placeholder="Màu Sắc"><option value="">Đỏ </option><option value="like">Cam</option><option value="president">Vàng </option><option value="example">Xanh</option></select></td><td><input type="number" placeholder="Đơn Giá" disabled></td><td><input type="text" placeholder="Tổng Cộng" disabled></td><td><button id="delsale">x</button></td></tr>')
        document.querySelectorAll('#tab2 #delsale').forEach(v => {
            v.onclick = () => {
                v.parentNode.parentNode.outerHTML = ''
            }
        })
        document.querySelectorAll('#productname').forEach(v => {
            v.onchange = () => {
                console.log()
                v.parentNode.nextSibling.childNodes[0].value = 1
                v.parentNode.nextSibling.nextSibling.nextSibling.childNodes[0].value = "6800000"
                v.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.childNodes[0].value = "6800000"
                i = 0;
                tab2tt = 0;
                document.querySelectorAll('#productname').forEach(x => {
                    i += parseInt(x.parentNode.nextSibling.childNodes[0].value)
                    tab2tt += parseInt(x.parentNode.nextSibling.childNodes[0].value) * x.parentNode.nextSibling.nextSibling.nextSibling.childNodes[0].value
                })
                $('#tab2sl').html(i)
                $('#tab2tt').html(tab2tt)
                v.parentNode.nextSibling.childNodes[0].onchange = () => {
                    i = 0;
                    tab2tt = 0;
                    document.querySelectorAll('#productname').forEach(x => {
                        i += parseInt(x.parentNode.nextSibling.childNodes[0].value)
                        tab2tt += parseInt(x.parentNode.nextSibling.childNodes[0].value) * x.parentNode.nextSibling.nextSibling.nextSibling.childNodes[0].value
                    })
                    $('#tab2sl').html(i)
                    $('#tab2tt').html(tab2tt)
                    v.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.childNodes[0].value = v.parentNode.nextSibling.childNodes[0].value * v.parentNode.nextSibling.nextSibling.nextSibling.childNodes[0].value
                }

            }
        })
    }
})
var idImg = 1;
document.querySelectorAll('#tab6 #addsale').forEach(v => {
    v.onclick = () => { // Have to set Image after choosing
        $('#tab6').append('<tr><td><label style="border:1px dashed #333;padding:0px 15px;cursor:pointer" for="imgInp_'+idImg+'" id="lbl_'+idImg+'">Chọn Ảnh</label><input required onchange="readURL(this,'+idImg+')" name="ImgProducts[]" id="imgInp_'+idImg+'" style="display:none" type="file"><img style="display:none;" id="Img_'+idImg+'"></td><td><select required name="groupImg[]" id=""><option value="2">Ảnh Sản Phẩm</option><option value="3">Ảnh Slider</option></td><td><button id="delsale">x</button></td></tr>')
        document.querySelectorAll('#tab6 #delsale').forEach(v => {
            v.onclick = () => {
                v.parentNode.parentNode.outerHTML = ''
                return false
            }
        })
        idImg++;
        return false
    }
})
