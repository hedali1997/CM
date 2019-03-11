<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo u_g('首页') ?></title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
<div class="main">
    <?php include 'inc/top.php'; ?>
    <div class="main_nav clearfix panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#collapseOne"><?php echo u_g('会员管理') ?></a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <a class="panel-body" href="memberInformation.php"><?php echo u_g('会员信息管理') ?></a>
                <a class="panel-body" href="membershipCardRecharge.php"><?php echo u_g('会员卡充值') ?></a>
                <a class="panel-body" href="memberCardAmountChange.php"><?php echo u_g('会员卡金额变动明细') ?></a>
                <a class="panel-body" href="shoppingDetails.php"><?php echo u_g('购物明细查询') ?></a>
                <a class="panel-body" href="memberCardPoints.php"><?php echo u_g('会员卡积分查询') ?></a>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#collapseTwo"><?php echo u_g('商品管理') ?></a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <a class="panel-body" href="storageDetails.php"><?php echo u_g('入库明细查询') ?></a>
                <a class="panel-body" href="commodityInformation.php"><?php echo u_g('商品信息修改') ?></a>
                <a class="panel-body" href="sellingPrice.php"><?php echo u_g('销售价格设置') ?></a>
                <a class="panel-body" href="sellingDetails.php"><?php echo u_g('销售明细查询') ?></a>
                <a class="panel-body" href="inventoryDetails.php"><?php echo u_g('库存明细查询') ?></a>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#collapseThree"><?php echo u_g('资金管理') ?></a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <a class="panel-body" href="payEnroll.php"><?php echo u_g('日常支出登记') ?></a>
                <a class="panel-body" href="payDetails.php"><?php echo u_g('支出明细查询') ?></a>
                <a class="panel-body" href="profit.php"><?php echo u_g('盈利统计') ?></a>
                <a class="panel-body" href="handOver.php"><?php echo u_g('上缴管理') ?></a>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a href="users.php"><?php echo u_g('用户管理') ?></a></h4>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a href="changePassword.php"><?php echo u_g('修改密码') ?></a></h4>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a href="setting.php"><?php echo u_g('系统设置') ?></a></h4>
            </div>
        </div>
    </div>
</div>
<?php include 'inc/bottom.php'; ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>