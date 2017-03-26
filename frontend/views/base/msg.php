<div class="site-error">
    <div class="alert alert-danger page-none-alert">
        <p>
            <span class="btn-lg text-success"><?=$data['msg']?></span>
        </p>


        <p class="text-muted">该页将在<?=$data['sec']?>秒后自动跳转!</p>
        <p>
            <?php if (!empty($data['goTo'])): ?>
                <a href="<?=$data['goTo'];?>">立即跳转</a>
            <?php else: ?>
                <a href="javascript:void(0)" onclick="history.go(-1)">返回上一页</a>
            <?php endif; ?>
        </p>
    </div>
</div>
<style type="text/css">
    .page-none-alert {
        margin: 100px 0 !important;
        text-align: center !important;
        font-size: 30px !important;
    }
</style>
<script type="text/javascript">
    <?php if(!$data['goTo']):?>
    setTimeout("history.go(-1);", <?=$data['sec'];?>000);
    <?php else:?>
    setTimeout("window.location.href='<?=$data["goTo"];?>'", <?=$data['sec'];?>000);
    <?php endif;?>
</script>