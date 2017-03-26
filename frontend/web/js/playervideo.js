$(function(){
    var styleid = $("#youkuplayer").attr('styleid');
    var client_id = $("#youkuplayer").attr('client_id');
    var vid = $("#youkuplayer").attr('vid');
    player = new YKU.Player('youkuplayer',{
        styleid: styleid,
        client_id: client_id,
        vid: vid,
        newPlayer: true
    });
    function playVideo(){
        player.playVideo();
    }
    function pauseVideo(){
        player.pauseVideo();
    }

});
