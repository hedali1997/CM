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
    <title>修改密码</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
</head>
<body>
<div class="main">
<?php include 'inc/top.php'; ?>
    <form class="container-fluid" role="form">
        <div class="form-group">
            <label for="oldPassword" class="col-sm-2 control-label">原始密码：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="oldPassword" name="oldPassword"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="newPassword" class="col-sm-2 control-label">新的密码：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="newPassword" name="newPassword"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="isPassword" class="col-sm-2 control-label">确认密码：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="isPassword" name="isPassword"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">修改</button>
            </div>
        </div>
    </form>
</div>
<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

?>
<?php include 'inc/bottom.php'; ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>