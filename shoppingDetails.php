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
    <title>购物明细查询</title>
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
            <label for="membername" class="col-sm-2 control-label">会员姓名：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="membername"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="phonenumber" class="col-sm-2 control-label">手机号码：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phonenumber"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">查询</button>
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
                <th>日期</th>
                <th>数量</th>
                <th>应收</th>
                <th>实收</th>
                <th>优惠</th>
                <th>销售员</th>
                <th>收款方式</th>
                <th>出货方式</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>2019/03/02</td>
                <td>1</td>
                <td>399.0000</td>
                <td>319.2000</td>
                <td>79.8000</td>
                <td>贺大礼</td>
                <td>会员卡余额结账</td>
                <td>销售</td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>2019/03/02</td>
                <td>1</td>
                <td>399.0000</td>
                <td>319.2000</td>
                <td>79.8000</td>
                <td>贺大礼</td>
                <td>会员卡余额结账</td>
                <td>销售</td>
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