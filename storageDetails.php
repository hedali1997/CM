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
    <title><?php echo u_g('入库明细查询') ?></title>
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
            <label for="dateStart" class="col-sm-2 control-label"><?php echo u_g('进货日期起：') ?></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="dateStart"
                       value="2017-10-01">
            </div>
        </div>
        <div class="form-group">
            <label for="dateEnd" class="col-sm-2 control-label"><?php echo u_g('进货日期止：') ?></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="dateEnd"
                       value="2019-03-03">
            </div>
        </div>
        <div class="form-group">
            <label for="allInAmounts" class="col-sm-2 control-label"><?php echo u_g('当前进货总金额：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="allInAmounts"
                       value="0" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="search" class="btn btn-primary btn-block"><?php echo u_g('查询') ?></button>
            </div>
        </div>
    </form>
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?php echo u_g('日期') ?></th>
                <th><?php echo u_g('商品种类') ?></th>
                <th><?php echo u_g('厂家') ?></th>
                <th><?php echo u_g('型号') ?></th>
                <th><?php echo u_g('颜色') ?></th>
                <th><?php echo u_g('尺码') ?></th>
                <th><?php echo u_g('材质') ?></th>
                <th><?php echo u_g('进货单价') ?></th>
                <th><?php echo u_g('数量') ?></th>
                <th><?php echo u_g('金额') ?></th>
                <th><?php echo u_g('销售价') ?></th>
            </tr>
            </thead>
            <tbody>
<!--             <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>2019/03/02</td>
                <td>鞋子</td>
                <td>特步</td>
                <td>跑鞋</td>
                <td>白</td>
                <td>36</td>
                <td>棉</td>
                <td>120.0000</td>
                <td>3</td>
                <td>360.0000</td>
                <td>150</td>
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
        $('#search').on('click',function(){
            var time_start=$('#dateStart').val();
            var time_end=$('#dateEnd').val();
            $('.alert').remove();
            $('.table tbody tr').remove();
            if(!time_start || !time_end){
                $('form').after("<div class='alert alert-danger'><?php echo u_g('请输入进货日期起和进货日期止！'); ?></div>");
                return false;
            }
            $.get('/api/storageSearch.php',{ start: time_start,end: time_end}, function(res){
                if(!res){
                    $('form').after("<div class='alert alert-danger'><?php echo u_g('对不起，查询不到您的记录！'); ?></div>");
                    return false;
                }
                var getRes = res.split('|');
                var item = new Array();
                for (var i = 0; i < getRes.length-1; i++) {
                    $('.table tbody').append('<tr></tr>');
                    item=getRes[i].split(',');

                    for (var j = 0; j < item.length-1; j++) {
                        $('.table tbody tr:eq('+i+')').append('<td>'+item[j]+'</td>');
                    };
                };
                var allAmounts=item[11];
                $('#allInAmounts').val(allAmounts);
            });
            return false;
        });
    });
</script>
</body>
</html>