<?php

 ?>
<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="GBK">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会员卡金额变动明细</title>
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
            <label for="rechargeMethod" class="col-sm-2 control-label">充值方式：</label>
            <div class="col-sm-10">
                <select class="form-control" name="rechargeMethod" id="rechargeMethod">
                    <option>现金充值</option>
                    <option>POS刷卡充值</option>
                    <option>支付宝充值</option>
                    <option>微信充值</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="rechargeAmount" class="col-sm-2 control-label">充值金额：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rechargeAmount"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">充值</button>
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
                <th>姓名</th>
                <th>手机号码</th>
                <th>卡余额</th>
                <th>消费积分</th>
                <th>消费金额</th>
                <th class="text-center" width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>贺大礼</td>
                <td>18702431601</td>
                <td>1000.0000</td>
                <td>1000.0000</td>
                <td>1000.0000</td>
                <td class="text-center">
                    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>贺大礼</td>
                <td>18702431601</td>
                <td>1000.0000</td>
                <td>1000.0000</td>
                <td>1000.0000</td>
                <td class="text-center">
                    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>贺大礼</td>
                <td>18702431601</td>
                <td>1000.0000</td>
                <td>1000.0000</td>
                <td>1000.0000</td>
                <td class="text-center">
                    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
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