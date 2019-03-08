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
    <title><?php echo u_g('会员卡金额变动明细'); ?></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
    <style>
        .main{
            min-width: 640px;
        }
        .btn-block{
            max-width:320px;
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
                <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('重新输入'); ?></button>
            </div>
        </div>
    </form>
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?php echo u_g('日期'); ?></th>
                <th><?php echo u_g('姓名'); ?></th>
                <th><?php echo u_g('手机号码'); ?></th>
                <th><?php echo u_g('出生年月'); ?></th>
                <th><?php echo u_g('发生金额'); ?></th>
                <th><?php echo u_g('变动方式'); ?></th>
            </tr>
            </thead>
            <tbody>
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
        $('#membername').on('blur',function(){//blur 失去焦点事件
            if($('#membername').attr("disabled")){
                return;
            }
            var value=$(this).val();
            if(!value||!nameFormat.test(value))return;
            $.get('/api/amountChange.php',{ name: value}, function(res){
                if(!res)return;
                var getRes = res.split('|');
                var item = new Array();
                console.dir(getRes);
                $('.table tbody tr').remove();
                for (var i = 0; i < getRes.length-1; i++) {
                    $('.table tbody').append('<tr></tr>');
                    item=getRes[i].split(',');
                    for (var j = 0; j < item.length; j++) {
                        $('.table tbody tr:eq('+i+')').append('<td>'+item[j]+'</td>');
                    };
                };
                $('#phonenumber').val(item[2]).attr("disabled","disabled");
                $('#membername').attr("disabled","disabled");
            });
        });
        $('#phonenumber').on('blur',function(){//blur 失去焦点事件
            if($('#phonenumber').attr("disabled")){
                return;
            }
            var value=$(this).val();
            if(!value||!phoneFormat.test(value))return;
            $.get('/api/amountChange.php',{ phone: value}, function(res){
                if(!res)return;
                var getRes = res.split('|');
                var item = new Array();
                console.dir(getRes);
                $('.table tbody tr').remove();
                for (var i = 0; i < getRes.length-1; i++) {
                    $('.table tbody').append('<tr></tr>');
                    item=getRes[i].split(',');
                    for (var j = 0; j < item.length; j++) {
                        $('.table tbody tr:eq('+i+')').append('<td>'+item[j]+'</td>');
                    };
                };
                $('#membername').val(item[1]).attr("disabled","disabled");
                $('#phonenumber').attr("disabled","disabled");
            });
        });
    });

</script>
</body>
</html>