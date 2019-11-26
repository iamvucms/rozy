var socket = io('http://127.0.0.1:3333')
socket.on('seller-msg',(m)=>{
    document.querySelectorAll('#sellerlist li').forEach(v=>{
        if(v.className=='active'){
            html = `<li class="left">
                <img src="${v.dataset.avatar}" alt="" class="avtsend">
                <p class="msgcontent">${m.msg}</p>
            </li>`
            document.querySelector('#chatlog').innerHTML = document.querySelector('#chatlog').innerHTML+html
            $(".chatlist").animate({ scrollTop: $('.scrolllog').height() }, 1000);
            var audio = new Audio('./tick.mp3');
            audio.play();
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
