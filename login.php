<?php
require_once 'inc/function.php';

function login(){
  //接收并校验
  //持久化
  //响应
  if(empty($_POST['username'])){
    $GLOBALS['message']='请输入登录名称';
    return;
  }
  if(empty($_POST['password'])){
    $GLOBALS['message']='请输入登录密码';
    return;
  }

  $username=u_g($_POST['username']);
  $password=u_g($_POST['password']);

  //当客户端提交过来了完整的表单信息就应该开始对其进行数据校验
  $conn = sqlsrv_connect(CM_SERVER_NAME,CM_SERVER_INFO);
  if(!$conn){
    exit('链接数据库失败');
  }

  $query=sqlsrv_query($conn, "select *from ".u_g('用户管理')." where ".u_g('登录名称')."='{$username}';");
  if(!$query){
    die( print_r( sqlsrv_errors(), true));
    $GLOBALS['message']='登录失败，请重试！';
    return;
  }
  $user=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
  if(!$user){
    //用户名不存在
    $GLOBALS['message']='用户名与密码不匹配';
    return;
  }
  if($user[u_g('权限')]!==u_g('系统管理员')){
    //密码不正确
    $GLOBALS['message']='请以管理员账户登录';
    return;
  }
  //一般密码都要加密放在数据库中
  //加密密码，MD5已经不安全了
  if($user[u_g('密码')]!==$password){
    //密码不正确
    $GLOBALS['message']='用户名与密码不匹配';
    return;
  }
  //存一个登录标识
  // $_SESSION['is_logged_in']=true;
  // 为了后续可以直接获取当前用户登录的信息，直接将用户信息放在SESSION中
  $_SESSION['current_login_user']=$user;
  //一切ok 可以跳转
  header('Location: /');
}

if($_SERVER['REQUEST_METHOD']==='POST'){
  login();
}

if($_SERVER['REQUEST_METHOD']==='GET' && isset($_GET['action']) && $_GET['action']==='logout'){
  // 删除了登录标识
  unset($_SESSION['current_login_user']);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('商品进销存后台管理系统'); ?></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
</head>
<body>
<div class="main">
    <form class="container-fluid" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate autocomplete="off">
        <?php if (isset($message)): ?>
            <div class="alert alert-danger">
            <strong><?php echo u_g('错误！') ?></strong> <?php echo u_g($message); ?>
            </div>
        <?php endif ?>
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label"><?php echo u_g('登录名称：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username"
                       placeholder="<?php echo u_g('请输入登录名称'); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label"><?php echo u_g('登录密码：'); ?></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="<?php echo u_g('请输入登录密码'); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary"><?php echo u_g('登录') ?></button>
            </div>
        </div>
    </form>

</div>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>