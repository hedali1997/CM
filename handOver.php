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
    <title><?php echo u_g('上缴管理'); ?></title>
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
                <input type="date" class="form-control" id="endDate" name="endDate" >
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="search" class="btn btn-primary btn-block"><?php echo u_g('查询'); ?></button>
            </div>
        </div>
    </form>
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?php echo u_g('日期'); ?></th>
                <th><?php echo u_g('销售姓名'); ?></th>
                <th><?php echo u_g('上缴现金'); ?></th>
                <th><?php echo u_g('上缴POS单'); ?></th>
            </tr>
            </thead>
            <tbody>
<!--             <tr>
                <td>2018/02/06</td>
                <td>贺大礼</td>
                <td>0.0000</td>
                <td>1000.0000</td>
            </tr> -->
            </tbody>
        </table>
    </div>
</div>
<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

?>
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
            $('.alert').remove();
            $('.table tbody tr').remove();
            if(!start_time || !end_time)return false;
            $.get('/api/searchGiveBoss.php',{start:start_time ,end:end_time }, function(res) {
                if(!res){
                    $('form').after("<div class='alert alert-danger'><?php echo u_g('对不起，查询不到任何记录！'); ?></div>")
                    return false;
                }
                var getRes=res.split('|');
                var item = new Array();

                for (var i = 0; i < getRes.length-1; i++) {
                    $('.table tbody').append('<tr></tr>');
                    item =getRes[i].split(',');
                    for (var j = 0; j < item.length; j++) {
                        $('.table tbody tr:eq('+i+')').append('<td>'+item[j]+'</td>');
                    };
                };
            });
            return false;
        });
        var start_time=$('#startDate').val();
        var end_time=$('#endDate').val();
        $('.alert').remove();
        $('.table tbody tr').remove();
        if(!start_time || !end_time)return false;
        $.get('/api/searchGiveBoss.php',{start:start_time ,end:end_time }, function(res) {
            if(!res){
                $('form').after("<div class='alert alert-danger'><?php echo u_g('对不起，查询不到任何记录！'); ?></div>")
                return false;
            }
            var getRes=res.split('|');
            var item = new Array();
            $('.table tbody tr').remove();
            for (var i = 0; i < getRes.length-1; i++) {
                $('.table tbody').append('<tr></tr>');
                item =getRes[i].split(',');
                for (var j = 0; j < item.length; j++) {
                    $('.table tbody tr:eq('+i+')').append('<td>'+item[j]+'</td>');
                };
            };
        });
    });
</script>
</body>
</html>