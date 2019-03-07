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
    <div class="result">
        <h4 class="text-center">支出：</h4>
        <p class="text-primary text-center"><span>进货支出：</span>2192.0000</p>
        <p class="text-primary text-center"><span>其他支出：</span>500.0000</p>
        <p class="text-primary text-center"><span>合计支出：</span>2692.0000</p>
        <h4 class="text-center">收入：</h4>
        <p class="text-primary text-center"><span>销售收入：</span>319.2000</p>
        <p class="text-primary text-center"><span>会员卡余额：</span>680.8000</p>
        <h4 class="text-center">利润：</h4>
        <p class="text-primary text-center"><span>利润合计：</span>-2372.8000</p>
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