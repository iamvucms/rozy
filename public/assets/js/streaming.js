const streamSocket   = new io('http://'+window.location.hostname+':3333')

const peer = new Peer( {host: window.location.hostname, port: 9000, path: '/' });
const OpenStream = ()=>{
    const config = { video: true, audio: true }
    return navigator.mediaDevices.getUserMedia(config);
}
let myID = '';
let myStream;
peer.on('open',id=>myID=id)
peer.on('connection',conn=>{
    console.log('xxx')
    conn.send('x')
    conn.on('data',data=>console.log(data))
})
// peer.on('disconnected','')
OpenStream().then(function (stream) {
    streamSocket.emit('join_stream',{key:myID})
    streamSocket.on('closeStream',()=>{
        window.location.reload()
    })
    myStream=stream
    let video = document.querySelector('#streamVideo')
    video.srcObject = stream
    video.play()
    video.muted = true
    peer.on('call', function (call) {
        call.answer(stream); // Answer the call with an A/V stream.
        
    }, function (err) {
        console.log('Failed to get local stream', err);
    });
});
document.querySelector('#finishBtn').onclick = (e)=>{
    window.location.reload()
}
document.querySelector('#startBtn').onclick = (e)=>{
    if(document.querySelector('#description').value==''){
        document.querySelector('#description').style.border = '1px solid red'
        return;
    }
    document.querySelector('#description').style.border = '1px solid black'
    axios.post('streams',{
        id:myID,
        description:document.querySelector('#description').value,
        idcat:document.querySelector('#idcat').value,
    }).then(d=>{
        data = d.data
        console.log(data)
    })
    document.querySelector('#startBtn').setAttribute('disabled','disabled')
    document.querySelector('#startBtn').setAttribute('style','opacity:0.5')
}
