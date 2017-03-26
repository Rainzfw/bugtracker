function go(){
    var show_boxs = document.getElementsByClassName("imgshow");
    //var boxs=document.getElementsByClassName('imgshowbox');
    var len = show_boxs.length;
    for(var i=0;i<len;i++){
        var show_box=show_boxs[i];
        var box =show_box.getElementsByTagName('div');
        box = box[0];
        box.style.bottom= (0-box.offsetHeight*0.3)+"px";
        var change=function(show_box){
            var box =show_box.getElementsByTagName('div');
            box = box[0];
            var boxH = box.offsetHeight;
            var move = boxH*0.3;
            var bottomH=parseInt(box.style.bottom);
            //box.style.bottom= 0-move+"px";
            box.style.bottom= (bottomH+move)+"px";
        }
        var back=function(show_box){
            var box =show_box.getElementsByTagName('div');
            box = box[0];
            var boxH = box.offsetHeight;
            var move = boxH*0.3;
            var bottomH=parseInt(box.style.bottom);
            box.style.bottom=(bottomH-move)+"px"
        }
        show_box.onmouseover=function(){
            change(this);
        }
        show_box.onmouseout=function(){
            back(this);
        }
    }

}
window.onload=function(){
    go();
}