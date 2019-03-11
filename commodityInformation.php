<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

if (!empty($_GET['id'])){
    // 客户端通过url传递了一个id参数
    // =》客户端是要来拿一个修改数据的表单
    // => 需要拿到用户想要修改的数据
    $current_edit_info=cm_fetch_one("select ".u_g('商品种类').",".u_g('厂家').",".u_g('型号').",".u_g('颜色').",".u_g('尺码').",".u_g('材质').",".u_g('商品序号')." from ".u_g('商品表')." where ".u_g('商品序号')."='{$_GET['id']}';");
}
function edit_info(){
    if(empty($_POST['sort']) || empty($_POST['factory'])){
        $GLOBALS['message'] = '商品种类和厂家必填';
        $GLOBALS['success'] = false;
    }
    $sort = $_POST['sort'];
    $factory = $_POST['factory'];
    $type = $_POST['type'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $material = $_POST['material'];
    // update 商品表 set 厂家='花花公子',型号='跑鞋' where 商品序号='48bfd5d3-62c2-4eee-9fa9-50898d3726a2';
    $rows = cm_execute("update ".u_g('商品表')." set ".u_g('商品种类')."='{$sort}',".u_g('厂家')."='{$factory}',".u_g('型号')."='{$type}',".u_g('颜色')."='{$color}',".u_g('尺码')."='{$size}',".u_g('材质')."='{$material}' where ".u_g('商品序号')."='{$_POST['id']}';");
    $GLOBALS['success'] = $rows>0;
    $GLOBALS['message'] = $rows<=0?  '修改失败!':'修改成功!';
}

//如果修改操作与查询操作在一起，一定是先做修改，再查询
if($_SERVER['REQUEST_METHOD']==='POST'){
    edit_info();
}

// $info=cm_fetch_all("select ".u_g('商品种类').",".u_g('厂家')." from ".u_g('商品表').";");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('商品信息修改'); ?></title>
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
    <?php if (isset($current_edit_info)): ?>
    <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group hidden">
            <label for="id" class="col-sm-2 control-label"><?php echo u_g('序号：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $current_edit_info[u_g('商品序号')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="sort" class="col-sm-2 control-label"><?php echo u_g('商品种类：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="sort" name="sort" value="<?php echo $current_edit_info[u_g('商品种类')] ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="factory" class="col-sm-2 control-label"><?php echo u_g('厂家：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="factory" name="factory" value="<?php echo $current_edit_info[u_g('厂家')] ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="type" class="col-sm-2 control-label"><?php echo u_g('型号：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="type" name="type" value="<?php echo $current_edit_info[u_g('型号')] ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="color" class="col-sm-2 control-label"><?php echo u_g('颜色：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="color" name="color" value="<?php echo $current_edit_info[u_g('颜色')] ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="size" class="col-sm-2 control-label"><?php echo u_g('尺码：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="size" name="size" value="<?php echo $current_edit_info[u_g('尺码')] ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="material" class="col-sm-2 control-label"><?php echo u_g('材质：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="material" name="material" value="<?php echo $current_edit_info[u_g('材质')] ?>">
            </div>
        </div>
        <div id="edit" class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('修改'); ?></button>
            </div>
        </div>
    </form>
    <?php else: ?>
    <form class="container-fluid" role="form">
        <div class="form-group">
            <div class="col-sm-10">
                <h3><?php echo u_g('所有商品信息：'); ?></h3>
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
            <tr>
                <th><?php echo u_g('商品种类'); ?></th>
                <th><?php echo u_g('厂家'); ?></th>
                <th><?php echo u_g('型号'); ?></th>
                <th><?php echo u_g('颜色'); ?></th>
                <th><?php echo u_g('尺码'); ?></th>
                <th><?php echo u_g('材质'); ?></th>
                <th class="text-center" width="100"><?php echo u_g('操作'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($current_edit_info)): ?>
            <tr>
                <td><?php echo $current_edit_info[u_g('商品种类')] ?></td>
                <td><?php echo $current_edit_info[u_g('厂家')] ?></td>
                <td><?php echo $current_edit_info[u_g('型号')] ?></td>
                <td><?php echo $current_edit_info[u_g('颜色')] ?></td>
                <td><?php echo $current_edit_info[u_g('尺码')] ?></td>
                <td><?php echo $current_edit_info[u_g('材质')] ?></td>
                <td></td>
            </tr>
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
        $('.table tbody tr').remove();
        $.get('/api/editCommodity.php',{ show: 'true'}, function(res){
            if(!res){
                $('form').after("<div class='alert alert-danger'><?php echo u_g('对不起，没有任何记录！'); ?></div>");
            }
            var getRes = res.split('|');
            console.dir(getRes);
            var item = new Array();
            for (var i = 0; i < getRes.length-1; i++) {
                $('.table tbody').append('<tr></tr>');
                item=getRes[i].split(',');
                for (var j = 0; j < item.length-1; j++) {
                    $('.table tbody tr:eq('+i+')').append('<td>'+item[j]+'</td>');
                };
                $('.table tbody tr:eq('+i+')').append("<td class='text-center'><a href='/commodityInformation.php?id="+item[6]+"' class='btn btn-info btn-block'><?php echo u_g('修改'); ?></a></td>");
            };
        });
    });
</script>
</body>
</html>