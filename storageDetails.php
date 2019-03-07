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
    <title>入库明细查询</title>
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
            <label for="dateStart" class="col-sm-2 control-label">进货日期起：</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="dateStart"
                       value="2017-10-01">
            </div>
        </div>
        <div class="form-group">
            <label for="dateEnd" class="col-sm-2 control-label">进货日期止：</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="dateEnd"
                       value="2019-03-03">
            </div>
        </div>
        <div class="form-group">
            <label for="allInAmounts" class="col-sm-2 control-label">当前进货总金额：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="allInAmounts"
                       value="1000.000" disabled="disabled">
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
                <th>商品种类</th>
                <th>厂家</th>
                <th>型号</th>
                <th>颜色</th>
                <th>尺码</th>
                <th>材质</th>
                <th>进货单价</th>
                <th>数量</th>
                <th>金额</th>
                <th>销售价</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>2019/03/02</td>
                <td>鞋子</td>
                <td>特步</td>
                <td>跑鞋</td>
                <td>白</td>
                <td>36</td>
                <td>棉</td>
                <td>120.0000</td>
                <td>3</td>
                <td>360.0000</td>
                <td>150</td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>2019/03/02</td>
                <td>鞋子</td>
                <td>特步</td>
                <td>跑鞋</td>
                <td>白</td>
                <td>36</td>
                <td>棉</td>
                <td>120.0000</td>
                <td>3</td>
                <td>360.0000</td>
                <td>150</td>
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