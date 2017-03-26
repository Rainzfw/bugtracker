//曲线开始
//发送请求获取招生数据
$.getJSON("/back/recruit-data.html",
    function(data){
        var lineChartData = {
            labels : ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sept","Oct","Nov","Dec"],
            datasets : [
                {
                    fillColor : "rgba(51, 51, 51, 0)",
                    strokeColor : "#4F52BA",
                    pointColor : "#4F52BA",
                    pointStrokeColor : "#fff",
                    data : data.uiData
                },
                {
                    fillColor : "rgba(51, 51, 51, 0)",
                    strokeColor : "#F2B33F",
                    pointColor : "#F2B33F",
                    pointStrokeColor : "#fff",
                    data : data.webData
                },
                {
                    fillColor : "rgba(51, 51, 51, 0)",
                    strokeColor : "#0C0",
                    pointColor : "#0C0",
                    pointStrokeColor : "#fff",
                    data : data.phpData
                },
                {
                    fillColor : "rgba(51, 51, 51, 0)",
                    strokeColor : "#e94e02",
                    pointColor : "#e94e02",
                    pointStrokeColor : "#fff",
                    data :  data.javaData
                }
            ]
        };
        new Chart(document.getElementById("line").getContext("2d")).Line(lineChartData);
    });

//曲线结束
//map js start
jQuery(document).ready(function() {
    jQuery('#vmap').vectorMap({
        map: 'world_en',
        backgroundColor: '#fff',
        color: '#696565',
        hoverOpacity: 0.8,
        selectedColor: '#696565',
        enableZoom: true,
        showTooltip: true,
        values: sample_data,
        scaleColors: ['#585858', '#696565'],
        normalizeFunction: 'polynomial'
    });
});
//map js end
