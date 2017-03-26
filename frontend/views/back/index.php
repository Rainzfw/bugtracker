<?php
\frontend\assets\BackAsset::register($this);
\frontend\assets\BackAsset::addScript($this,'@web/backend/js/backIndex.js');
?>
<div class="row-one" xmlns="http://www.w3.org/1999/html">
    <h3 class="title1">问题统计</h3>
    <div class="col-md-2 widget">
        <div class="stats-left ">
            <h5>UI+WEB</h5>
            <h4>Questions</h4>
        </div>
        <div class="stats-right">
            <label> 45</label>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="col-md-2 widget states-mdl">
        <div class="stats-left">
            <h5>PHP+JAVA</h5>
            <h4>Questions</h4>
        </div>
        <div class="stats-right">
            <label> 80</label>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="col-md-2 widget states-last">
        <div class="stats-left">
            <h5>NOT AUDIT</h5>
            <h4>Questions</h4>
        </div>
        <div class="stats-right">
            <label>51</label>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="clearfix"> </div>
</div>
<div class="row">
    <h3 class="title1">学科招生人数</h3>
    <div class="charts">
        <div class="row calender widget-shadow">
            <div style="float: left;width: 80px;text-align: right">UI</div>
            <div style="float:left;width: 10px;height: 10px;background-color: #4F52BA"></div>
            <div style="float: left;width: 80px;text-align: right">WEB</div>
            <div style="float:left;width: 10px;height: 10px;background-color: #F2B33F"></div>
            <div style="float: left;width: 80px;text-align: right">PHP</div>
            <div style="float:left;width: 10px;height: 10px;background-color: #0C0"></div>
            <div style="float: left;width: 80px;text-align: right">JAVA</div>
            <div style="float:left;width: 10px;height: 10px;background-color: #e94e02"></div>
            <canvas id="line" height="300" width="400" style="width: 400px; height: 300px;"></canvas>
        </div>
        <div class="clearfix"></div>

    </div>
    <div class="clearfix"></div>
</div>

<div class="clearfix"> </div>
