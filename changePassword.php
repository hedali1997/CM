<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
$user=cm_get_current_user();

function alter(){
    global $user;
    if(empty($_POST['oldPassword']) || empty($_POST['newPassword']) || empty($_POST['isPassword'])){
        $GLOBALS['message']='请完整填写表单';
        $GLOBALS['success']=false;
        return;
    }
    $oldPassword=$_POST['oldPassword'];
    if($user[u_g('密码')]!==$oldPassword){
        $GLOBALS['message']='原始密码错误，请重新输入';
        $GLOBALS['success']=false;
        return;
    }
    $newPassword=$_POST['newPassword'];
    $isPassword=$_POST['isPassword'];
    if($newPassword!==$isPassword){
        $GLOBALS['message']='新密码和确认密码不一致，请重新输入';
        $GLOBALS['success']=false;
        return;
    }
    $id=$user[u_g('用户编号')];
    $rows=cm_execute("update ".u_g('用户管理')." set ".u_g('密码')."='{$newPassword}' where ".u_g('用户编号')."='{$id}';");
    $GLOBALS['success']=$rows>0;
    $GLOBALS['message']=$rows>0? '修改成功':'修改失败';
    $_SESSION['current_login_user'][u_g('密码')]=$newPassword;
}

if ($_SERVER['REQUEST_METHOD']==='POST') {
    alter();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('修改密码') ?></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
</head>
<body>
<div class="main">
<?php include 'inc/top.php'; ?>
    <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
        <div class="form-group">
            <label for="oldPassword" class="col-sm-2 control-label"><?php echo u_g('原始密码：') ?></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="oldPassword" name="oldPassword">
            </div>
        </div>
        <div class="form-group">
            <label for="newPassword" class="col-sm-2 control-label"><?php echo u_g('新的密码：') ?></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="newPassword" name="newPassword">
            </div>
        </div>
        <div class="form-group">
            <label for="isPassword" class="col-sm-2 control-label"><?php echo u_g('确认密码：') ?></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="isPassword" name="isPassword">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('修改') ?></button>
            </div>
        </div>
    </form>
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
</div>
<?php include 'inc/bottom.php'; ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>