<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

function search_attr(){
    if(empty($_POST['sort'])||empty($_POST['factory'])){
        $GLOBALS['message'] = '请至少选择商品种类和厂家！';
        return;
    }
    $sort=$_POST['sort'];
    $factory=$_POST['factory'];
    $sort=get_sort($sort);
    $factory=get_factory($sort,$factory);
    if(empty($_POST['type'])){
        $res=cm_fetch_all('select '.u_g('商品种类').','.u_g('厂家').','.u_g('型号').','.u_g('颜色').','.u_g('尺码').','.u_g('材质').','.u_g('进货均价').','.u_g('库存数量').' from '.u_g('商品表').' where '.u_g('商品种类')."='{$sort}' and ".u_g('厂家')."='{$factory}';");
        if(!$res){
            $GLOBALS['message'] = '查询失败1！';
            return;
        }
        return $res;
    }
    $type=get_type($sort,$factory,$_POST['type']);
    if(empty($_POST['color'])){
        $res=cm_fetch_all('select '.u_g('商品种类').','.u_g('厂家').','.u_g('型号').','.u_g('颜色').','.u_g('尺码').','.u_g('材质').','.u_g('进货均价').','.u_g('库存数量').' from '.u_g('商品表').' where '.u_g('商品种类')."='{$sort}' and ".u_g('厂家')."='{$factory}' and ".u_g('型号')."='{$type}';");
        if(!$res){
            $GLOBALS['message'] = '查询失败2！';
            return;
        }
        return $res;
    }
    $color=get_color($sort,$factory,$type,$_POST['color']);
    if(empty($_POST['size'])){
        $res=cm_fetch_all('select '.u_g('商品种类').','.u_g('厂家').','.u_g('型号').','.u_g('颜色').','.u_g('尺码').','.u_g('材质').','.u_g('进货均价').','.u_g('库存数量').' from '.u_g('商品表').' where '.u_g('商品种类')."='{$sort}' and ".u_g('厂家')."='{$factory}' and ".u_g('型号')."='{$type}' and ".u_g('颜色')."='{$color}';");
        if(!$res){
            $GLOBALS['message'] = '查询失败3！';
            return;
        }
        return $res;
    }
    $size=get_size($sort,$factory,$type,$color,$_POST['size']);
    if(empty($_POST['material'])){
        $res=cm_fetch_all('select '.u_g('商品种类').','.u_g('厂家').','.u_g('型号').','.u_g('颜色').','.u_g('尺码').','.u_g('材质').','.u_g('进货均价').','.u_g('库存数量').' from '.u_g('商品表').' where '.u_g('商品种类')."='{$sort}' and ".u_g('厂家')."='{$factory}' and ".u_g('型号')."='{$type}' and ".u_g('颜色')."='{$color}' and ".u_g('尺码')."='{$size}';");
        if(!$res){
            $GLOBALS['message'] = '查询失败4！';
            return;
        }
        return $res;
    }
    $material=get_material($sort,$factory,$type,$color,$size,$_POST['material']);
    $res=cm_fetch_all('select '.u_g('商品种类').','.u_g('厂家').','.u_g('型号').','.u_g('颜色').','.u_g('尺码').','.u_g('材质').','.u_g('进货均价').','.u_g('库存数量').' from '.u_g('商品表').' where '.u_g('商品种类')."='{$sort}' and ".u_g('厂家')."='{$factory}' and ".u_g('型号')."='{$type}' and ".u_g('颜色')."='{$color}' and ".u_g('尺码')."='{$size}' and ".u_g('材质')."='{$material}';");
    if(!$res){
        $GLOBALS['message'] = '查询失败5！';
        return;
    }
    return $res;
}
function search_num(){
    $num=$_POST['lessNum'];
    $res=cm_fetch_all('select '.u_g('商品种类').','.u_g('厂家').','.u_g('型号').','.u_g('颜色').','.u_g('尺码').','.u_g('材质').','.u_g('进货均价').','.u_g('库存数量').' from '.u_g('商品表').' where '.u_g('库存数量')."<='{$num}';");
    if(!$res){
        $GLOBALS['message'] = '查询失败6！';
        return;
    }
    return $res;
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    if(empty($_POST['lessNum'])){
        $searchInfo=search_attr();
    }else{
        $searchInfo=search_num();
    }
}
if($_SERVER['REQUEST_METHOD']==='GET' && !empty($_GET['show'])){
    $info=cm_fetch_all('select '.u_g('商品种类').','.u_g('厂家').','.u_g('型号').','.u_g('颜色').','.u_g('尺码').','.u_g('材质').','.u_g('进货均价').','.u_g('库存数量').' from '.u_g('商品表').';');
}

$info_sort=cm_fetch_all('select distinct '.u_g('商品种类').' from '.u_g('商品表').';');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('库存明细查询'); ?></title>
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
    <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="sort" class="col-sm-2 control-label"><?php echo u_g('商品种类：'); ?></label>
            <div class="col-sm-10">
                <select class="form-control" id="sort" name="sort">
                    <?php for($i=0;$i<count($info_sort);$i++): ?>
                        <option value="<?php echo 's'.$i; ?>"><?php echo implode('',$info_sort[$i]); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="factory" class="col-sm-2 control-label"><?php echo u_g('厂家：'); ?></label>
            <div class="col-sm-10">
                <select class="form-control" id="factory" name="factory">
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="type" class="col-sm-2 control-label"><?php echo u_g('型号：'); ?></label>
            <div class="col-sm-10">
                <select class="form-control" id="type" name="type">
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="color" class="col-sm-2 control-label"><?php echo u_g('颜色：'); ?></label>
            <div class="col-sm-10">
                <select class="form-control" id="color" name="color">
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="size" class="col-sm-2 control-label"><?php echo u_g('尺码：'); ?></label>
            <div class="col-sm-10">
                <select class="form-control" id="size" name="size">
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="material" class="col-sm-2 control-label"><?php echo u_g('材质：'); ?></label>
            <div class="col-sm-10">
                <select class="form-control" id="material" name="material">
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="lessNum" class="col-sm-2 control-label"><?php echo u_g('数量少于(单独查询)：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lessNum" name="lessNum">
            </div>
        </div>
        <div class="form-group">
            <label for="searchMode" class="col-sm-2 control-label"><?php echo u_g('查询方式：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="searchMode"
                       value="<?php if (isset($searchInfo)) {
                        if(empty($_POST['lessNum'])){
                            echo u_g('按商品属性查询');
                        }else{
                            echo u_g('按数量查询');
                        }
                       }else{
                            echo u_g('查询所有');
                        } ?>" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('查询'); ?></button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a href="/inventoryDetails.php?show=all" class="btn btn-primary btn-block"><?php echo u_g('显示所有'); ?></a>
            </div>
        </div>
    </form>
    <?php if (isset($message)):
    $message=u_g($message);?>
        <div class="alert alert-danger">
              <?php echo $message; ?>
        </div>
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
                <th><?php echo u_g('进货均价'); ?></th>
                <th><?php echo u_g('库存数量'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($searchInfo)): ?>
                <?php foreach ($searchInfo as $item): ?>
                <tr>
                    <td><?php echo $item[u_g('商品种类')]; ?></td>
                    <td><?php echo $item[u_g('厂家')]; ?></td>
                    <td><?php echo $item[u_g('型号')]; ?></td>
                    <td><?php echo $item[u_g('颜色')]; ?></td>
                    <td><?php echo $item[u_g('尺码')]; ?></td>
                    <td><?php echo $item[u_g('材质')]; ?></td>
                    <td><?php echo $item[u_g('进货均价')]; ?></td>
                    <td><?php echo $item[u_g('库存数量')]; ?></td>
                </tr>
                <?php endforeach ?>
            <?php elseif(isset($info)): ?>
                <?php foreach ($info as $item): ?>
                <tr>
                    <td><?php echo $item[u_g('商品种类')]; ?></td>
                    <td><?php echo $item[u_g('厂家')]; ?></td>
                    <td><?php echo $item[u_g('型号')]; ?></td>
                    <td><?php echo $item[u_g('颜色')]; ?></td>
                    <td><?php echo $item[u_g('尺码')]; ?></td>
                    <td><?php echo $item[u_g('材质')]; ?></td>
                    <td><?php echo $item[u_g('进货均价')]; ?></td>
                    <td><?php echo $item[u_g('库存数量')]; ?></td>
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
    show();
});
function show(){
    $('#sort').on('click',function(){
        $('#factory option').remove();
        $('#type option').remove();
        $('#color option').remove();
        $('#size option').remove();
        $('#material option').remove();
        var sort_value=$(this).val();
        if(!sort_value)return;
        $.get('/api/inventorySearch.php',{ sort: sort_value }, function(res){
            if(!res)return;
            var getRes = res.split('|');
            for (var i = 0; i < getRes.length-1; i++) {
                $('#factory').append("<option value=f"+i+">"+getRes[i]+"</option>");
            };
        });
    });
    $('#factory').on('click',function(){
        $('#type option').remove();
        $('#color option').remove();
        $('#size option').remove();
        $('#material option').remove();
        var sort_value=$('#sort').val();
        var factory_value=$(this).val();
        if(!factory_value || !sort_value)return;
        $.get('/api/inventorySearch.php',{ sort: sort_value,factory: factory_value }, function(res){
            if(!res)return;
            var getRes = res.split('|');
            for (var i = 0; i < getRes.length-1; i++) {
                $('#type').append("<option value=t"+i+">"+getRes[i]+"</option>");
            };
        });
    });
    $('#type').on('click',function(){
        $('#color option').remove();
        $('#size option').remove();
        $('#material option').remove();
        var sort_value=$('#sort').val();
        var factory_value=$('#factory').val();
        var type_value=$(this).val();
        if(!factory_value || !sort_value || !type_value)return;
        $.get('/api/inventorySearch.php',{ sort: sort_value,factory: factory_value,type:type_value }, function(res){
            if(!res)return;
            var getRes = res.split('|');
            for (var i = 0; i < getRes.length-1; i++) {
                $('#color').append("<option value=c"+i+">"+getRes[i]+"</option>");
            };
        });
    });
    $('#color').on('click',function(){
        $('#size option').remove();
        $('#material option').remove();
        var sort_value=$('#sort').val();
        var factory_value=$('#factory').val();
        var type_value=$('#type').val();
        var color_value=$(this).val();
        if(!factory_value || !sort_value || !type_value || !color_value)return;
        $.get('/api/inventorySearch.php',{ sort: sort_value,factory: factory_value,type:type_value,color:color_value }, function(res){
            if(!res)return;
            var getRes = res.split('|');
            for (var i = 0; i < getRes.length-1; i++) {
                $('#size').append("<option value=si"+i+">"+getRes[i]+"</option>");
            };
        });
    });
    $('#size').on('click',function(){
        $('#material option').remove();
        var sort_value=$('#sort').val();
        var factory_value=$('#factory').val();
        var type_value=$('#type').val();
        var color_value=$('#color').val();
        var size_value=$(this).val();
        if(!factory_value || !sort_value || !type_value || !color_value || !size_value)return;
        $.get('/api/inventorySearch.php',{ sort: sort_value,factory: factory_value,type:type_value,color:color_value,size:size_value }, function(res){
            if(!res)return;
            var getRes = res.split('|');
            for (var i = 0; i < getRes.length-1; i++) {
                $('#material').append("<option value=m"+i+">"+getRes[i]+"</option>");
            };
        });
    });
}
</script>
</body>
</html>