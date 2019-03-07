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
    <title>用户管理</title>
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
            <label for="loginName" class="col-sm-2 control-label">登录名称：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="loginName" name="loginName"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="trueName" class="col-sm-2 control-label">真实姓名：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="trueName" name="trueName"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="permission" class="col-sm-2 control-label">权限：</label>
            <div class="col-sm-10">
                <select class="form-control" name="permission" id="permission">
                    <option>系统管理员</option>
                    <option>一般操作员</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">登录密码：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" name="password"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">添加</button>
            </div>
        </div>
    </form>
    <div class="col-md-8">
        <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>登录名称</th>
                <th>真实姓名</th>
                <th>权限</th>
                <th class="text-center" width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>a</td>
                <td>xiaoshou</td>
                <td>一般操作员</td>
                <td class="text-center">
                    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                </td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>b</td>
                <td>贺大礼</td>
                <td>系统管理员</td>
                <td class="text-center">
                    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                </td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>a</td>
                <td>xiaoshou</td>
                <td>一般操作员</td>
                <td class="text-center">
                    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
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