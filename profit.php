<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('盈利统计'); ?></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
</head>
<body>
<div class="main">
<?php include 'inc/top.php'; ?>
    <form class="container-fluid" role="form">
        <div class="form-group">
            <label for="startDate" class="col-sm-2 control-label"><?php echo u_g('开始日期：'); ?></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="startDate" name="startDate"
                       value="2017-10-01">
            </div>
        </div>
        <div class="form-group">
            <label for="endDate" class="col-sm-2 control-label"><?php echo u_g('结束日期：'); ?></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="endDate" name="endDate"
                       value="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="search" class="btn btn-primary btn-block"><?php echo u_g('统计'); ?></button>
            </div>
        </div>
    </form>
    <div class="result">
        <h4 class="text-center"><?php echo u_g('支出：'); ?></h4>
        <div class="text-primary text-center"><?php echo u_g('进货支出：'); ?><span id="inPay"></span></div>
        <div class="text-primary text-center"><?php echo u_g('其他支出：'); ?><span id="otherPay"></span></div>
        <div class="text-primary text-center"><?php echo u_g('合计支出：'); ?><span id="allPay"></span></div>
        <h4 class="text-center"><?php echo u_g('收入：'); ?></h4>
        <div class="text-primary text-center"><?php echo u_g('销售收入：'); ?><span id="outSell"></span></div>
        <div class="text-primary text-center"><?php echo u_g('会员卡余额：'); ?><span id="memberBalance"></span></div>
        <h4 class="text-center"><?php echo u_g('利润：'); ?></h4>
        <div class="text-primary text-center"><?php echo u_g('利润合计：'); ?><span id="profit"></span></div>
    </div>
</div>
<?php include 'inc/bottom.php'; ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/js/function.js"></script>
<script>
    $(function(){
        $('#endDate').val(getTime(false));
        $('#search').on('click',function(){
            var start_time=$('#startDate').val();
            var end_time=$('#endDate').val();
            if(!start_time || !end_time)return false;
            $.get('/api/searchProfit.php',{start:start_time ,end:end_time }, function(res) {
                if(!res){
                    $('form').after("<div class='alert alert-danger'><?php echo u_g('对不起，查询不到任何记录！'); ?></div>")
                    return false;
                }
                var getRes=res.split(',');
                $('#inPay').text(isnull(getRes[0]));
                $('#otherPay').text(isnull(getRes[1]));
                $('#allPay').text(isnull(getRes[2]));
                $('#outSell').text(isnull(getRes[3]));
                $('#memberBalance').text(isnull(getRes[4]));
                $('#profit').text(isnull(getRes[5]));
            });
            return false;
        });
        var start_time=$('#startDate').val();
        var end_time=$('#endDate').val();
        if(!start_time || !end_time)return;
        $.get('/api/searchProfit.php',{start:start_time ,end:end_time }, function(res) {
            if(!res){
                $('form').after("<div class='alert alert-danger'><?php echo u_g('对不起，查询不到任何记录！'); ?></div>")
                return false;
            }
            var getRes=res.split(',');
            $('#inPay').text(isnull(getRes[0]));
            $('#otherPay').text(isnull(getRes[1]));
            $('#allPay').text(isnull(getRes[2]));
            $('#outSell').text(isnull(getRes[3]));
            $('#memberBalance').text(isnull(getRes[4]));
            $('#profit').text(isnull(getRes[5]));
        });
    });
</script>
</body>
</html>