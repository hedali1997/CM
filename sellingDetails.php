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
    <title>会员信息管理</title>
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
                       value="2017-10-01">
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
            <label for="sellNumber" class="col-sm-2 control-label">销售数量：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="sellNumber"
                       value="1" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label for="returnNumber" class="col-sm-2 control-label">退货数量：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="returnNumber"
                       value="0" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label for="saleAmounts" class="col-sm-2 control-label">销售金额：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="saleAmounts"
                       value="319.200" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">查询</button>
            </div>
        </div>
    </form>
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>日期</th>
                <th>商品种类</th>
                <th>厂家</th>
                <th>型号</th>
                <th>颜色</th>
                <th>尺码</th>
                <th>材质</th>
                <th>销售姓名</th>
                <th>销售价</th>
                <th>是否退货</th>
                <th>销售方式</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>2019/03/03</td>
                <td>衣服</td>
                <td>特步</td>
                <td>羽绒服</td>
                <td>白</td>
                <td>156</td>
                <td>羽绒</td>
                <td>贺大礼</td>
                <td>399.0000</td>
                <td>否</td>
                <td>销售</td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>2019/03/03</td>
                <td>衣服</td>
                <td>特步</td>
                <td>羽绒服</td>
                <td>白</td>
                <td>156</td>
                <td>羽绒</td>
                <td>贺大礼</td>
                <td>399.0000</td>
                <td>否</td>
                <td>销售</td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>2019/03/03</td>
                <td>衣服</td>
                <td>特步</td>
                <td>羽绒服</td>
                <td>白</td>
                <td>156</td>
                <td>羽绒</td>
                <td>贺大礼</td>
                <td>399.0000</td>
                <td>否</td>
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