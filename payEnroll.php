<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

if(!empty($_GET['id'])){
    $current_info=cm_fetch_one('select '.u_g('序号').','.u_g('支出明细').','.u_g('支出金额').','.u_g('支出日期').','.u_g('登记日期').','.u_g('备注').' from '.u_g('支出明细表').' where '.u_g('序号')."='{$_GET['id']}';");
}
if(!empty($_GET['delete'])){
    $GLOBALS['message'] = '删除记录成功！';
    $GLOBALS['success'] = true;
}
function check_info(){
    if(empty($_POST['payDetail']) || empty($_POST['payMoney']) || empty($_POST['payTime'])){
        $GLOBALS['message'] = '请完整填写表单！支出明细、支出金额和支出日期为必填项！';
        $GLOBALS['success'] = false;
        return false;
    }
    return true;
}
function add_info(){
    if(!check_info()) return;
    $payDetail=$_POST['payDetail'];
    $payMoney=$_POST['payMoney'];
    $payTime=date('Y-m-d H:i:s');
    $remark=empty($_POST['remark'])? '':$_POST['remark'];
    $nowTime=date('Y-m-d H:i:s');
    // insert into 支出明细表 (支出明细,支出金额,支出日期,登记日期,备注) values('{$payDetail}','{$payMoney}','{$payTime}','{$nowTime}','{$remark}');
    $rows=cm_execute("insert into ".u_g('支出明细表')." (".u_g('支出明细').",".u_g('支出金额').",".u_g('支出日期').",".u_g('登记日期').",".u_g('备注').") values('{$payDetail}','{$payMoney}','{$payTime}','{$nowTime}','{$remark}');");
    $GLOBALS['success'] = $rows>0;
    $GLOBALS['message'] = $rows<=0?  '添加失败!':'添加成功!';
}
function edit_info(){
    if(!check_info()) return;
    $id=empty($_POST['id'])? $current_info[u_g('序号')]:$_POST['id'];
    $current_info[u_g('序号')]=$id;
    $payDetail=$_POST['payDetail'];
    $payMoney=$_POST['payMoney'];
    $payTime=empty($_POST['payTime'])? $current_info[u_g('支出日期')]:$_POST['payTime'];
    $current_info[u_g('支出日期')]=$payTime;
    $remark=empty($_POST['remark'])? '':$_POST['remark'];
    $nowTime=date('Y-m-d H:i:s');
    // update 支出明细表 set 支出明细='',支出金额='',支出日期='',登记日期='',备注='' where 序号='';
    $rows=cm_execute("update ".u_g('支出明细表')." set ".u_g('支出明细')."='{$payDetail}',".u_g('支出金额')."='{$payMoney}',".u_g('支出日期')."='{$payTime}',".u_g('登记日期')."='{$nowTime}',".u_g('备注')."='{$remark}' where ".u_g('序号')."='{$id}';");
    $GLOBALS['success'] = $rows>0;
    $GLOBALS['message'] = $rows<=0?  '保存失败!':'保存成功!';
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(empty($_POST['id'])){
        add_info();
    }else{
        edit_info();
    }
}

$info=cm_fetch_all('select '.u_g('序号').','.u_g('支出明细').','.u_g('支出金额').','.u_g('支出日期').','.u_g('登记日期').','.u_g('备注').' from '.u_g('支出明细表').' order by '.u_g('支出日期').' desc;');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('支出登记'); ?></title>
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
    <?php if (isset($current_info)): ?>
    <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
        <div class="form-group hidden">
            <label for="id" class="col-sm-2 control-label"><?php echo u_g('序号'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $current_info[u_g('序号')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="payDetail" class="col-sm-2 control-label"><?php echo u_g('支出明细：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="payDetail" name="payDetail" value="<?php echo $current_info[u_g('支出明细')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="payMoney" class="col-sm-2 control-label"><?php echo u_g('支出金额：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="payMoney" name="payMoney" value="<?php echo $current_info[u_g('支出金额')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="payTime" class="col-sm-2 control-label"><?php echo u_g('支出日期：'); ?></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="payTime" name="payTime" value="<?php echo date_format($current_info[u_g('支出日期')],'Y-m-d'); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="remark" class="col-sm-2 control-label"><?php echo u_g('备注：'); ?></label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" style="resize:none;" id="remark" name="remark"><?php echo $current_info[u_g('备注')]; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('保存'); ?></button>
            </div>
        </div>
    </form>
    <?php else: ?>
    <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
        <div class="form-group">
            <label for="payDetail" class="col-sm-2 control-label"><?php echo u_g('支出明细：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="payDetail" name="payDetail">
            </div>
        </div>
        <div class="form-group">
            <label for="payMoney" class="col-sm-2 control-label"><?php echo u_g('支出金额：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="payMoney" name="payMoney" >
            </div>
        </div>
        <div class="form-group">
            <label for="payTime" class="col-sm-2 control-label"><?php echo u_g('支出日期：'); ?></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="payTime" name="payTime">
            </div>
        </div>
        <div class="form-group">
            <label for="remark" class="col-sm-2 control-label"><?php echo u_g('备注：'); ?></label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" style="resize:none;" id="remark" name="remark" ></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('添加'); ?></button>
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
                <th><?php echo u_g('支出明细'); ?></th>
                <th><?php echo u_g('支出金额'); ?></th>
                <th><?php echo u_g('支出日期'); ?></th>
                <th><?php echo u_g('登记日期'); ?></th>
                <th><?php echo u_g('备注'); ?></th>
                <th class="text-center" width="100"><?php echo u_g('操作'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($current_info)): ?>
                <tr>
                    <td><?php echo $current_info[u_g('支出明细')]; ?></td>
                    <td><?php echo $current_info[u_g('支出金额')]; ?></td>
                    <td><?php echo date_format($current_info[u_g('支出日期')],'Y-m-d H:i:s'); ?></td>
                    <td><?php echo date_format($current_info[u_g('登记日期')],'Y-m-d H:i:s'); ?></td>
                    <td><?php echo $current_info[u_g('备注')]; ?></td>
                    <td class="text-center">
                        <a href="/payDetails-delete.php?id=<?php echo $current_info[u_g('序号')]; ?>" class="btn btn-danger btn-block"><?php echo u_g('删除'); ?></a>
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($info as $item): ?>
                <tr>
                    <td><?php echo $item[u_g('支出明细')]; ?></td>
                    <td><?php echo $item[u_g('支出金额')]; ?></td>
                    <td><?php echo date_format($item[u_g('支出日期')],'Y-m-d H:i:s'); ?></td>
                    <td><?php echo date_format($item[u_g('登记日期')],'Y-m-d H:i:s'); ?></td>
                    <td><?php echo $item[u_g('备注')]; ?></td>
                    <td class="text-center">
                        <a href="/payEnroll.php?id=<?php echo $item[u_g('序号')]; ?>" class="btn btn-info btn-block"><?php echo u_g('编辑'); ?></a>
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
<script src="/js/function.js"></script>
<script>
    $(function($){
        var id = getUrlParam('id');
        if (!id) {$('#payTime').val(getTime());};
    });
</script>
</body>
</html>