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
    <title><?php echo u_g('会员卡积分查询'); ?></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
    <style>
        .main{
            min-width: 640px;
        }
        .btn-block{
            max-width: 320px;
        }
    </style>
</head>
<body>
<div class="main">
<?php include 'inc/top.php'; ?>
    <form class="container-fluid" role="form">
        <div class="form-group">
            <label for="membername" class="col-sm-2 control-label"><?php echo u_g('会员姓名：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="membername"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="phonenumber" class="col-sm-2 control-label"><?php echo u_g('手机号码：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phonenumber"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="search" class="btn btn-primary btn-block"><?php echo u_g('查询'); ?></button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="reset" class="btn btn-primary btn-block"><?php echo u_g('重新输入'); ?></button>
            </div>
        </div>
    </form>
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?php echo u_g('姓名'); ?></th>
                <th><?php echo u_g('手机号码'); ?></th>
                <th><?php echo u_g('卡余额'); ?></th>
                <th><?php echo u_g('消费积分'); ?></th>
                <th><?php echo u_g('消费金额'); ?></th>
            </tr>
            </thead>
            <tbody>
<!--             <tr>
                <td>贺大礼</td>
                <td>18702431601</td>
                <td>1000.0000</td>
                <td>1000.0000</td>
                <td>1000.0000</td>
            </tr> -->
            </tbody>
        </table>
    </div>
</div>
<?php include 'inc/bottom.php'; ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $(function($){// 入口函数
        var phoneFormat = /0?(13|14|15|17|18)[0-9]{9}/;
        var nameFormat =  /^[\u4E00-\u9FA5\uf900-\ufa2d·s]{2,10}$/;//验证姓名正则
        $('#search').on('click',function(){
            var name_value=$('#membername').val();
            var phone_value=$('#phonenumber').val();
            $('.alert').remove();
            $('.table tbody tr').remove();
            if(name_value!='' && nameFormat.test(name_value)){
                $.get('/api/searchPoints.php',{ name: name_value}, function(res){
                    if(!res){
                        $('form').after("<div class='alert alert-danger'><?php echo u_g('对不起，查询不到您的记录！'); ?></div>")
                        return false;
                    }
                    var getRes = res.split(',');
                    $('.table tbody').append('<tr></tr>');
                    for (var j = 0; j < getRes.length; j++) {
                        $('.table tbody tr').append('<td>'+getRes[j]+'</td>');
                    };
                    $('#phonenumber').val(getRes[1]);
                });
                return false;
            }
            if(phone_value!='' && phoneFormat.test(phone_value)){
                $.get('/api/searchPoints.php',{ phone: phone_value}, function(res){
                    if(!res){
                        $('form').after("<div class='alert alert-danger'><?php echo u_g('对不起，查询不到您的记录！'); ?></div>")
                        return false;
                    }
                    var getRes = res.split(',');
                    console.dir(getRes);
                    $('.table tbody').append('<tr></tr>');
                    for (var j = 0; j < getRes.length; j++) {
                        $('.table tbody tr').append('<td>'+getRes[j]+'</td>');
                    };
                    $('#membername').val(getRes[0]);
                });
                return false;
            }
            $('form').after("<div class='alert alert-danger'><?php echo u_g('请输入会员姓名或手机号码！'); ?></div>")
            return false;
        });
        $('#reset').on('click',function(){
            $('#membername').val('');
            $('#phonenumber').val('');
            $('.alert').remove();
            $('.table tbody tr').remove();
            return false;
        });
    });
</script>
</body>
</html>