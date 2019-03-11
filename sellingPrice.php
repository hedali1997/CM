<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

if (!empty($_GET['id'])){
    // 客户端通过url传递了一个id参数
    // =》客户端是要来拿一个修改数据的表单
    // => 需要拿到用户想要修改的数据
    $current_edit_info=cm_fetch_one("select ".u_g('商品种类').",".u_g('厂家').",".u_g('型号').",".u_g('进货均价').",".u_g('销售价').",".u_g('会员打折').",".u_g('会员销售价').",".u_g('充值卡打折').",".u_g('充值卡售价').",".u_g('商品序号')." from ".u_g('商品表')." where ".u_g('商品序号')."='{$_GET['id']}';");
}

function edit_info(){
    if(empty($_POST['sell']) || empty($_POST['memberDiscount']) || empty($_POST['cardDiscount'])){
        $GLOBALS['message'] = '请完整填写表单内容';
        $GLOBALS['success'] = false;
    }
    $sell = $_POST['sell'];
    $memberDiscount = $_POST['memberDiscount'];
    $memberSell = $sell*$memberDiscount;
    $cardDiscount = $_POST['cardDiscount'];
    $cardSell = $sell*$cardDiscount;
    // update 商品表 set 厂家='花花公子',型号='跑鞋' where 商品序号='48bfd5d3-62c2-4eee-9fa9-50898d3726a2';
    $rows = cm_execute("update ".u_g('商品表')." set ".u_g('销售价')."='{$sell}',".u_g('会员打折')."='{$memberDiscount}',".u_g('会员销售价')."='{$memberSell}',".u_g('充值卡打折')."='{$cardDiscount}',".u_g('充值卡售价')."='{$cardSell}' where ".u_g('商品序号')."='{$_POST['id']}';");
    $GLOBALS['success'] = $rows>0;
    $GLOBALS['message'] = $rows<=0?  '修改失败!':'修改成功!';
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    edit_info();
}

$info=cm_fetch_all('select '.u_g('商品序号').','.u_g('商品种类').','.u_g('厂家').','.u_g('型号').','.u_g('进货均价').','.u_g('销售价').','.u_g('会员打折').','.u_g('会员销售价').','.u_g('充值卡打折').','.u_g('充值卡售价').' from '.u_g('商品表').'');
$info_sort=cm_fetch_all('select distinct '.u_g('商品种类').' from '.u_g('商品表').';');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('销售价格设置') ?></title>
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
    <?php if (isset($current_edit_info)): ?>
    <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
        <div class="form-group hidden">
            <label for="id" class="col-sm-2 control-label"><?php echo u_g('序号') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $current_edit_info[u_g('商品序号')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="sort" class="col-sm-2 control-label"><?php echo u_g('商品种类：') ?></label>
            <div class="col-sm-10">
                <select class="form-control" id="sort" name="sort" disabled="disabled">
                    <option><?php echo $current_edit_info[u_g('商品种类')]; ?></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="factory" class="col-sm-2 control-label"><?php echo u_g('厂家：') ?></label>
            <div class="col-sm-10">
                <select class="form-control" id="factory" name="factory" disabled="disabled">
                <option><?php echo $current_edit_info[u_g('厂家')]; ?></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="sell" class="col-sm-2 control-label"><?php echo u_g('销售价：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="sell" name="sell" value="<?php echo $current_edit_info[u_g('销售价')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="memberDiscount" class="col-sm-2 control-label"><?php echo u_g('会员打折：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="memberDiscount" name="memberDiscount" value="<?php echo $current_edit_info[u_g('会员打折')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="memberSell" class="col-sm-2 control-label"><?php echo u_g('会员价：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="memberSell" name="memberSell" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label for="cardDiscount" class="col-sm-2 control-label"><?php echo u_g('充值卡打折：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cardDiscount" name="cardDiscount" value="<?php echo $current_edit_info[u_g('充值卡打折')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="cardSell" class="col-sm-2 control-label"><?php echo u_g('充值卡售价：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cardSell" name="cardSell" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('修改') ?></button>
            </div>
        </div>
    </form>
    <?php else: ?>
    <form class="container-fluid" role="form">
        <div class="form-group">
            <label for="sort" class="col-sm-2 control-label"><?php echo u_g('商品种类：') ?></label>
            <div class="col-sm-10">
                <select class="form-control" id="sort" name="sort">
                    <?php for($i=0;$i<count($info_sort);$i++): ?>
                        <option value="<?php echo 's'.$i; ?>"><?php echo implode('',$info_sort[$i]); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="factory" class="col-sm-2 control-label"><?php echo u_g('厂家：') ?></label>
            <div class="col-sm-10">
                <select class="form-control" id="factory" name="factory">
                <option value=""></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="ok" class="btn btn-primary btn-block"><?php echo u_g('确定') ?></button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a href="/sellingPrice.php" class="btn btn-primary btn-block"><?php echo u_g('显示所有') ?></a>
            </div>
        </div>
    </form>
    <?php endif ?>
    <?php if (isset($message)):
    $message=u_g($message);?>
        <?php if ($success): ?>
            <div class="alert alert-success">
                <?php echo $message; ?>
            </div>
        <?php else: ?>
          <div class="alert alert-danger">
                <?php echo $message; ?>
          </div>
        <?php endif ?>
    <?php endif ?>
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
            <?php if (isset($current_edit_info)): ?>
                <tr>
                    <th><?php echo u_g('型号'); ?></th>
                    <th><?php echo u_g('进货均价'); ?></th>
                    <th><?php echo u_g('销售价'); ?></th>
                    <th><?php echo u_g('会员打折'); ?></th>
                    <th><?php echo u_g('会员销售价'); ?></th>
                    <th><?php echo u_g('充值卡打折'); ?></th>
                    <th><?php echo u_g('充值卡售价'); ?></th>
                    <th class="text-center" width="100"><?php echo u_g('操作') ?></th>
                </tr>
            <?php else: ?>
                <tr>
                <th><?php echo u_g('商品种类'); ?></th>
                <th><?php echo u_g('厂家'); ?></th>
                <th><?php echo u_g('型号'); ?></th>
                <th><?php echo u_g('进货均价'); ?></th>
                <th><?php echo u_g('销售价'); ?></th>
                <th><?php echo u_g('会员打折'); ?></th>
                <th><?php echo u_g('会员销售价'); ?></th>
                <th><?php echo u_g('充值卡打折'); ?></th>
                <th><?php echo u_g('充值卡售价'); ?></th>
                <th class="text-center" width="100"><?php echo u_g('操作') ?></th>
                </tr>
            <?php endif ?>
            </thead>
            <tbody>
            <?php if (isset($current_edit_info)): ?>
                <tr>
                    <td><?php echo $current_edit_info[u_g('型号')]; ?></td>
                    <td><?php echo $current_edit_info[u_g('进货均价')]; ?></td>
                    <td><?php echo $current_edit_info[u_g('销售价')]; ?></td>
                    <td><?php echo $current_edit_info[u_g('会员打折')]; ?></td>
                    <td><?php echo $current_edit_info[u_g('会员销售价')]; ?></td>
                    <td><?php echo $current_edit_info[u_g('充值卡打折')]; ?></td>
                    <td><?php echo $current_edit_info[u_g('充值卡售价')]; ?></td>
                    <td class="text-center">
                        <a href="/sellingPrice.php?id=<?php echo $current_edit_info[u_g('商品序号')]; ?>" class="btn btn-info btn-block"><?php echo u_g('修改'); ?></a>
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($info as $item): ?>
                <tr>
                    <td><?php echo $item[u_g('商品种类')]; ?></td>
                    <td><?php echo $item[u_g('厂家')]; ?></td>
                    <td><?php echo $item[u_g('型号')]; ?></td>
                    <td><?php echo $item[u_g('进货均价')]; ?></td>
                    <td><?php echo $item[u_g('销售价')]; ?></td>
                    <td><?php echo $item[u_g('会员打折')]; ?></td>
                    <td><?php echo $item[u_g('会员销售价')]; ?></td>
                    <td><?php echo $item[u_g('充值卡打折')]; ?></td>
                    <td><?php echo $item[u_g('充值卡售价')]; ?></td>
                    <td class="text-center">
                        <a href="/sellingPrice.php?id=<?php echo $item[u_g('商品序号')]; ?>" class="btn btn-info btn-block"><?php echo u_g('修改'); ?></a>
                    </td>
                </tr>
                <?php endforeach ?>
            <?php endif ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'inc/bottom.php'; ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$(function($){// 入口函数
    show();//显示打折后的价格
    // $('#ok').click(function() {
    //    return false;
    // });
    $('#sort').on('click',function(){//blur 失去焦点事件
        var sort_value=$(this).val();
        if(!sort_value)return;
        $.get('/api/price.php',{ sort: sort_value }, function(res){
            if(!res)return;
            var getRes = res.split('|');
            $('#factory option').remove();
            for (var i = 0; i < getRes.length-1; i++) {
                $('#factory').append("<option value=f"+i+">"+getRes[i]+"</option>");
            };
        });
    });
    $('#ok').on('click',function(){//blur 失去焦点事件
        var sort_value=$('#sort').val();
        var factory_value=$('#factory').val();
        if(!factory_value || !sort_value)return false;
        $.get('/api/price.php',{ sort: sort_value,factory: factory_value }, function(res){
            if(!res)return false;
            var getRes = res.split('|');
            var item = new Array();
            $('.table tbody tr').remove();
            $('.table thead tr th').remove();
            $('.table thead tr').append("<th><?php echo u_g('型号'); ?></th><th><?php echo u_g('进货均价'); ?></th><th><?php echo u_g('销售价'); ?></th><th><?php echo u_g('会员打折'); ?></th><th><?php echo u_g('会员销售价'); ?></th><th><?php echo u_g('充值卡打折'); ?></th><th><?php echo u_g('充值卡售价'); ?></th><th class='text-center' width='100'><?php echo u_g('操作') ?></th>");
            for (var i = 0; i < getRes.length-1; i++) {
                $('.table tbody').append('<tr></tr>');
                item=getRes[i].split(',');
                for (var j = 1; j < item.length; j++) {
                    $('.table tbody tr:eq('+i+')').append('<td>'+item[j]+'</td>');
                };
                $('.table tbody tr:eq('+i+')').append("<td class='text-center'><a href='/sellingPrice.php?id="+item[0]+"' class='btn btn-info btn-block'><?php echo u_g('修改'); ?></a></td>");
            };
        });
        return false;
    });
});
function show(){
    $('#memberSell').val($('#sell').val()*$('#memberDiscount').val());
    $('#cardSell').val($('#sell').val()*$('#cardDiscount').val());
    $('#memberDiscount').on('click',function(){
        $('#memberSell').val($('#sell').val()*$('#memberDiscount').val());
    });
    $('#cardDiscount').on('click',function(){
        $('#cardSell').val($('#sell').val()*$('#cardDiscount').val());
    });
    $('#sell').on('change',function() {
        $('#memberSell').val($('#sell').val()*$('#memberDiscount').val());
        $('#cardSell').val($('#sell').val()*$('#cardDiscount').val());
    });
}
</script>
</body>
</html>