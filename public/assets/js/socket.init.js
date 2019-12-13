var socket = io('http://'+window.location.hostname+':3333')
socket.on('seller-msg',(m)=>{
    document.querySelectorAll('#sellerlist li').forEach(v=>{
        v.classList.remove('active')
        if(v.dataset.user==m.from){
            $('.inbox').attr('id', 'active')
            $('.boxchat').css('display', 'flex')
            axios.post(getMsgURI,{
                idsell:v.dataset.seller
            }).then(d=>{
                data = d.data
                if(data.success){
                    document.querySelector('.toptool .centername').innerHTML='SHOP: '+v.dataset.name
                    document.querySelector('#chatlog').setAttribute('data-current',v.dataset.user)
                    msg = data.data
                    html = ''
                    for(let m of msg){
                        if(m.position==1) html += `<li class="right">
                                        <p class="msgcontent">${m.msg}</p>
                                    </li>`;
                        else html += `<li class="left">
                                        <img src="${v.dataset.avatar}" alt="" class="avtsend">
                                        <p class="msgcontent">${m.msg}</p>
                                    </li>`
                    }
                    document.querySelector('#chatlog').innerHTML = html
                }
                html = `<li class="left">
                <img src="${v.dataset.avatar}" alt="" class="avtsend">
                <p class="msgcontent">${m.msg}</p>
                </li>`
                document.querySelector('#chatlog').innerHTML = document.querySelector('#chatlog').innerHTML+html
                $(".chatlist").animate({ scrollTop: $('.scrolllog').height() }, 1000);
                var audio = new Audio('../../../../../../tick.mp3');
                audio.play();
            })
            v.classList.add('active')
        }
    })
})
socket.on('client-msg',(m)=>{
    document.querySelectorAll('#sellerlist li').forEach(v=>{
        v.classList.remove('active')
        if(v.dataset.user==m.from){
            $('.inbox').attr('id', 'active')
            $('.boxchat').css('display', 'flex')
            axios.post(getMsgURI,{
                idcus:v.dataset.customer
            }).then(d=>{
                data = d.data
                if(data.success){
                    document.querySelector('.toptool .centername').innerHTML='Khách Hàng: '+v.dataset.name
                    document.querySelector('#chatlog').setAttribute('data-current',v.dataset.user)
                    msg = data.data
                    html = ''
                    for(let m of msg){
                        if(m.position==2) html += `<li class="right">
                                        <p class="msgcontent">${m.msg}</p>
                                    </li>`;
                        else html += `<li class="left">
                                        <img src="${v.dataset.avatar}" alt="" class="avtsend">
                                        <p class="msgcontent">${m.msg}</p>
                                    </li>`
                    }
                    document.querySelector('#chatlog').innerHTML = html
                }
                html = `<li class="left">
                <img src="${v.dataset.avatar}" alt="" class="avtsend">
                <p class="msgcontent">${m.msg}</p>
                </li>`
                document.querySelector('#chatlog').innerHTML = document.querySelector('#chatlog').innerHTML+html
                $(".chatlist").animate({ scrollTop: $('.scrolllog').height() }, 1000);
                var audio = new Audio('../../../../../../tick.mp3');
                audio.play();
            })
            v.classList.add('active')
        }
    })
})
function socketAuth(user_id,position=1,hash){
    socket.emit('config_socket_id',{
        user_id:user_id,
        position:position,
        hash:hash
    })
}
function SendMessage(msg,from,to,position=1){
    socket.emit('MsgSend',{
        from:from,
        to:to,
        msg:msg,
        position:position
    })
}
