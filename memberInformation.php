<?php
require_once 'inc/function.php';

// 判断用户是否登录一定是最先去做
cm_get_current_user();

if (!empty($_GET['id'])){
    // 客户端通过url传递了一个id参数
    // =》客户端是要来拿一个修改数据的表单
    // => 需要拿到用户想要修改的数据
    $current_edit_member=cm_fetch_one("select * from ".u_g('会员库')." where ".u_g('序号')." ='{$_GET['id']}';");
}
function add_category(){
    //校验，持久化，响应
    if(empty($_POST['membername']) || empty($_POST['phonenumber']) || empty($_POST['payPwd'])){
        $GLOBALS['message'] = '请完整填写表单！会员姓名、手机号码和密码为必填项！';
        $GLOBALS['success'] = false;
        return;
    }
    // var_dump($_POST);
    // 接收并保存
    $id=guid();
    // echo $id;
    $membername = $_POST['membername'];
    $phonenum = $_POST['phonenumber'];
    $pinyin= getPY(g_u($membername));
    $payPwd = md5($_POST['payPwd']);
    $weixin = $_POST['weixin'];
    $born = $_POST['born'];
    $year =empty($born)? '': explode('-',$born)[0];
    $month = empty($born)? '': explode('-',$born)[1];
    $day =  empty($born)? '': explode('-',$born)[2];
    $cardover = $_POST['cardover'];
    $consum_point = $_POST['consum_point'];
    $consum_amount = $_POST['consum_amount'];
    $null='';

    // insert into 会员库 values('1',null,'贺大礼','17851567955','17851567955','hdl','1997-12-18','1997','12','18','100','100','123456','100');
    $rows = cm_execute("insert into ".u_g('会员库')." values ('{$id}','{$null}','{$membername}', '{$phonenum}', '{$weixin}', '{$pinyin}', '{$born}', '{$year}', '{$month}', '{$day}', '{$cardover}', '{$consum_amount}', '{$payPwd}', '{$consum_point}');");
    $GLOBALS['success'] = $rows>0;
    $GLOBALS['message'] = $rows<=0?  '添加失败!':'添加成功!';
}
function edit_category(){
    global $current_edit_member;

    if(empty($_POST['payPwd'])){
        $GLOBALS['message'] = '请完整填写表单！';
        $GLOBALS['success'] = false;
        return;
    }

    // 接收并保存
    $id = $current_edit_member[u_g('序号')];
    $membername = empty($_POST['membername']) ? $current_edit_member[u_g('姓名')] : $_POST['membername'];
    $current_edit_member[u_g('姓名')] =$membername;
    $phonenum = empty($_POST['phonenumber']) ? $current_edit_member[u_g('手机号码')] : $_POST['phonenumber'];
    $current_edit_member[u_g('手机号码')] =$phonenum;
    $pinyin= getPY(g_u($membername));
    $payPwd = md5($_POST['payPwd']);
    $weixin =empty($_POST['weixin']) ? $current_edit_member[u_g('微信号')] : $_POST['weixin'];
    $current_edit_member[u_g('微信号')] =$weixin;
    $born = empty($_POST['born']) ? $current_edit_member[u_g('出生年月')] : $_POST['born'];
    $current_edit_member[u_g('出生年月')] =$born;
    $year =empty($born)? '': explode('-',$born)[0];
    $month = empty($born)? '': explode('-',$born)[1];
    $day =  empty($born)? '': explode('-',$born)[2];
    $cardover =empty($_POST['cardover']) ? $current_edit_member[u_g('卡余额')] : $_POST['cardover'];
    $current_edit_member[u_g('卡余额')] =$cardover;
    $consum_point = empty($_POST['consum_point']) ? $current_edit_member[u_g('消费积分')] : $_POST['consum_point'];
    $current_edit_member[u_g('消费积分')] =$consum_point;
    $consum_amount = empty($_POST['consum_amount']) ? $current_edit_member[u_g('消费金额')] : $_POST['consum_amount'];
    $current_edit_member[u_g('消费金额')] =$consum_amount;
    $null='';

    // insert into categories values (null, 'slug', 'name');
    $rows = cm_execute("update ".u_g('会员库')." set ".u_g('姓名')."='{$membername}',".u_g('手机号码')."='{$phonenum}',".u_g('微信号')."='{$weixin}',".u_g('出生年月')."='{$born}',".u_g('出生年')."='{$year}',".u_g('出生月')."='{$month}',".u_g('出生日')."='{$day}',".u_g('卡余额')."='{$cardover}',".u_g('消费积分')."='{$consum_point}',".u_g('消费金额')."='{$consum_amount}',".u_g('消费密码')."='{$payPwd}' where ".u_g('序号')."='{$id}';");
    $GLOBALS['success'] = $rows>0;
    $GLOBALS['message'] = $rows<=0? '修改失败!':'修改成功!';
}

//如果修改操作与查询操作在一起，一定是先做修改，再查询
if($_SERVER['REQUEST_METHOD']==='POST'){
    //一旦表单提交请求并且没有通过url提交id，就意味着是要添加数据
    if(empty($_GET['id'])){
        add_category();
    }else{
        edit_category();
    }
}

$member=cm_fetch_all('select * from '.u_g('会员库').';')
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('会员信息管理') ?></title>
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
    <?php if (isset($current_edit_member)): ?>
    <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $current_edit_member[u_g('序号')]; ?>" method="post">
        <div class="form-group">
            <label for="membername" class="col-sm-2 control-label"><?php echo u_g('会员姓名：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="membername" name="membername" value="<?php echo $current_edit_member[u_g('姓名')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="phonenumber" class="col-sm-2 control-label"><?php echo u_g('手机号码：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?php echo $current_edit_member[u_g('手机号码')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="payPwd" class="col-sm-2 control-label"><?php echo u_g('消费密码：') ?></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="payPwd" name="payPwd">
            </div>
        </div>
        <div class="form-group">
            <label for="weixin" class="col-sm-2 control-label"><?php echo u_g('微信号：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="weixin" name="weixin" value="<?php echo $current_edit_member[u_g('微信号')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="born" class="col-sm-2 control-label"><?php echo u_g('出生年月：') ?></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="born" name="born" value="<?php echo date_format($current_edit_member[u_g('出生年月')],'Y-m-d'); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="cardover" class="col-sm-2 control-label"><?php echo u_g('卡余额：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cardover" name="cardover" value="<?php echo $current_edit_member[u_g('卡余额')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="consum_point" class="col-sm-2 control-label"><?php echo u_g('消费积分：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="consum_point" name="consum_point" value="<?php echo $current_edit_member[u_g('消费积分')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="consum_amount" class="col-sm-2 control-label"><?php echo u_g('消费金额：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="consum_amount" name="consum_amount" value="<?php echo $current_edit_member[u_g('消费金额')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('修改') ?></button>
            </div>
        </div>
    </form>
    <?php else: ?>
    <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="membername" class="col-sm-2 control-label"><?php echo u_g('会员姓名：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="membername" name="membername">
            </div>
        </div>
        <div class="form-group">
            <label for="phonenumber" class="col-sm-2 control-label"><?php echo u_g('手机号码：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phonenumber" name="phonenumber">
            </div>
        </div>
        <div class="form-group">
            <label for="payPwd" class="col-sm-2 control-label"><?php echo u_g('消费密码：') ?></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="payPwd" name="payPwd">
            </div>
        </div>
        <div class="form-group">
            <label for="weixin" class="col-sm-2 control-label"><?php echo u_g('微信号：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="weixin" name="weixin">
            </div>
        </div>
        <div class="form-group">
            <label for="born" class="col-sm-2 control-label"><?php echo u_g('出生年月：') ?></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="born" name="born">
            </div>
        </div>
        <div class="form-group">
            <label for="cardover" class="col-sm-2 control-label"><?php echo u_g('卡余额：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cardover" name="cardover">
            </div>
        </div>
        <div class="form-group">
            <label for="consum_point" class="col-sm-2 control-label"><?php echo u_g('消费积分：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="consum_point" name="consum_point">
            </div>
        </div>
        <div class="form-group">
            <label for="consum_amount" class="col-sm-2 control-label"><?php echo u_g('消费金额：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="consum_amount" name="consum_amount">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary"><?php echo u_g('添加') ?></button>
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
                <th><?php echo u_g('姓名'); ?></th>
                <th><?php echo u_g('手机号码'); ?></th>
                <th><?php echo u_g('微信号'); ?></th>
                <th><?php echo u_g('出生年月'); ?></th>
                <th><?php echo u_g('卡余额'); ?></th>
                <th><?php echo u_g('消费积分'); ?></th>
                <th><?php echo u_g('消费金额'); ?></th>
                <th class="text-center" width="100"><?php echo u_g('操作'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($member as $item): ?>
            <tr>
                <td><?php echo $item[u_g('姓名')]; ?></td>
                <td><?php echo $item[u_g('手机号码')]; ?></td>
                <td><?php echo $item[u_g('微信号')]; ?></td>
                <td><?php echo date_format($item[u_g('出生年月')],"Y-m-d"); ?></td>
                <td><?php echo $item[u_g('卡余额')]; ?></td>
                <td><?php echo $item[u_g('消费积分')]; ?></td>
                <td><?php echo $item[u_g('消费金额')]; ?></td>
                <td class="text-center">
                <a href="/memberInformation.php?id=<?php echo $item[u_g('序号')]; ?>" class="btn btn-info btn-block"><?php echo u_g('编辑'); ?></a>
                <a href="/member-delete.php?id=<?php echo $item[u_g('序号')]; ?>" class="btn btn-info btn-block"><?php echo u_g('删除'); ?></a>
                </td>
            </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'inc/bottom.php'; ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>