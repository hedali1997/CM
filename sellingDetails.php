<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

// select 销售明细表.日期,商品表.商品种类,商品表.厂家,商品表.型号,商品表.颜色,商品表.尺码,商品表.材质,销售明细表.销售姓名,销售明细表.销售价,销售明细表.是否退货,销售明细表.销售方式 from 销售明细表 inner join 商品表 on 商品表.商品序号=销售明细表.商品序号 order by 日期 desc;
$info=cm_fetch_all('select '.u_g('销售明细表').'.'.u_g('日期').','.u_g('商品表').'.'.u_g('商品种类').','.u_g('商品表').'.'.u_g('厂家').','.u_g('商品表').'.'.u_g('型号').','.u_g('商品表').'.'.u_g('颜色').','.u_g('商品表').'.'.u_g('尺码').','.u_g('商品表').'.'.u_g('材质').','.u_g('销售明细表').'.'.u_g('销售姓名').','.u_g('销售明细表').'.'.u_g('折后价').','.u_g('销售明细表').'.'.u_g('是否退货').','.u_g('销售明细表').'.'.u_g('销售方式').' from '.u_g('销售明细表').' inner join '.u_g('商品表').' on '.u_g('商品表').'.'.u_g('商品序号').'='.u_g('销售明细表').'.'.u_g('商品序号').' order by '.u_g('日期').' desc;');
$sell_count=cm_fetch_one('select count(1) as num from '.u_g('销售记录').';')['num'];
$return_count=cm_fetch_one("select count(1) as num from ".u_g('销售明细表')." where ".u_g('是否退货')."='".u_g('是')."';")['num'];
$sell_amount=cm_fetch_one('select sum('.u_g('收款金额').') as sum from '.u_g('销售记录').';')['sum'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('销售明细查询'); ?></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
    <style>
        .main{
            min-width: 640px;
        }
    </style>
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
                <input type="date" class="form-control" id="endDate" name="endDate">
            </div>
        </div>
        <div class="form-group">
            <label for="sellNumber" class="col-sm-2 control-label"><?php echo u_g('销售数量：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="sellNumber"
                       value="<?php echo $sell_count; ?>" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label for="returnNumber" class="col-sm-2 control-label"><?php echo u_g('退货数量：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="returnNumber"
                       value="<?php echo $return_count; ?>" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label for="saleAmounts" class="col-sm-2 control-label"><?php echo u_g('销售总金额：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="saleAmounts"
                       value="<?php echo $sell_amount; ?>" disabled="disabled">
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
                <th><?php echo u_g('商品种类'); ?></th>
                <th><?php echo u_g('厂家'); ?></th>
                <th><?php echo u_g('型号'); ?></th>
                <th><?php echo u_g('颜色'); ?></th>
                <th><?php echo u_g('尺码'); ?></th>
                <th><?php echo u_g('材质'); ?></th>
                <th><?php echo u_g('销售姓名'); ?></th>
                <th><?php echo u_g('销售价'); ?></th>
                <th><?php echo u_g('是否退货'); ?></th>
                <th><?php echo u_g('销售方式'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($info as $item): ?>
                <tr>
                    <td><?php echo date_format($item[u_g('日期')],'Y-m-d H:i:s') ?></td>
                    <td><?php echo $item[u_g('商品种类')] ?></td>
                    <td><?php echo $item[u_g('厂家')] ?></td>
                    <td><?php echo $item[u_g('型号')] ?></td>
                    <td><?php echo $item[u_g('颜色')] ?></td>
                    <td><?php echo $item[u_g('尺码')] ?></td>
                    <td><?php echo $item[u_g('材质')] ?></td>
                    <td><?php echo $item[u_g('销售姓名')] ?></td>
                    <td><?php echo $item[u_g('折后价')] ?></td>
                    <td><?php echo $item[u_g('是否退货')] ?></td>
                    <td><?php echo $item[u_g('销售方式')] ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'inc/bottom.php'; ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/js/function.js"></script>
<script>
    $(function($){// 入口函数
        $('#endDate').val(getTime(false));
        $('#search').on('click',function(){
            var start_time=$('#startDate').val();
            var end_time=$('#endDate').val();
            $('.alert').remove();
            $('.table tbody tr').remove();
            $('#sellNumber').val('');
            $('#returnNumber').val('');
            $('#saleAmounts').val('');
            if(!start_time||!start_time){
            $('form').after("<div class='alert alert-danger'><?php echo u_g('请输入开始日期和结束日期'); ?></div>");
                return false;}
            $.get('/api/sellSearch.php',{ start: start_time,end: end_time}, function(res){
                if(!res){
                    $('form').after("<div class='alert alert-danger'><?php echo u_g('对不起，查询不到任何记录！'); ?></div>");
                    return false;
                }
                var getRes = res.split('|');
                var item = new Array();
                for (var i = 0; i < getRes.length-1; i++) {
                    $('.table tbody').append('<tr></tr>');
                    item=getRes[i].split(',');
                    for (var j = 3; j < item.length; j++) {
                        $('.table tbody tr:eq('+i+')').append('<td>'+item[j]+'</td>');
                    };
                };
                $('#sellNumber').val(item[0]);
                $('#returnNumber').val(item[1]);
                $('#saleAmounts').val(item[2]);
            });
            return false;
        });
    });
</script>
</body>
</html>