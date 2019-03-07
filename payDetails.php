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
    <title>支出明细查询</title>
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
            <label for="startDate" class="col-sm-2 control-label">开始日期：</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="startDate" name="startDate"
                       value="2019-03-03">
            </div>
        </div>
        <div class="form-group">
            <label for="endDate" class="col-sm-2 control-label">结束日期：</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="endDate" name="endDate"
                       value="2019-03-03">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">统计</button>
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
                <th>支出明细</th>
                <th>支出金额</th>
                <th>支出日期</th>
                <th>登记日期</th>
                <th>备注</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>购买设备</td>
                <td>500.0000</td>
                <td>2019/02/21</td>
                <td>2019/02/21</td>
                <td>购买打印机、扫描仪，钱箱等设备</td>
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