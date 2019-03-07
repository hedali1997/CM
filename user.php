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
    <title><?php echo u_g('个人中心') ?></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
</head>
<body>
<div class="main">
    <div class="main_top clearfix">
        <a href="index.php"><?php echo u_g('返回首页') ?></a>
        <a href="login.php"><?php echo u_g('退出') ?></a>
    </div>
    <form class="container-fluid" role="form">
        <div class="form-group">
            <label for="loginName" class="col-sm-2 control-label"><?php echo u_g('登录名称：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="loginName" name="loginName"
                       value="b">
            </div>
        </div>
        <div class="form-group">
            <label for="trueName" class="col-sm-2 control-label"><?php echo u_g('真实姓名：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="trueName" name="trueName"
                       value="贺大礼">
            </div>
        </div>
        <div class="form-group">
            <label for="permission" class="col-sm-2 control-label"><?php echo u_g('权限：') ?></label>
            <div class="col-sm-10">
                <select class="form-control" name="permission" id="permission">
                    <option><?php echo u_g('系统管理员') ?></option>
                    <option><?php echo u_g('一般操作员') ?></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary"><?php echo u_g('修改') ?></button>
            </div>
        </div>
    </form>
</div>
<?php include 'inc/bottom.php'; ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>