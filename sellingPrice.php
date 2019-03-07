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
            <label for="sort" class="col-sm-2 control-label">商品种类：</label>
            <div class="col-sm-10">
                <select class="form-control" id="sort" name="sort">
                    <option>鞋子</option>
                    <option>衣服</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="factory" class="col-sm-2 control-label">厂家：</label>
            <div class="col-sm-10">
                <select class="form-control" id="factory" name="factory">
                    <option>特步</option>
                    <option>耐克</option>
                    <option>鸿星尔克</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="sell" class="col-sm-2 control-label">销售价：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="sell" name="sell"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="memberDiscount" class="col-sm-2 control-label">会员打折：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="memberDiscount" name="memberDiscount"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="cardDiscount" class="col-sm-2 control-label">充值卡打折：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cardDiscount" name="cardDiscount"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="memberSell" class="col-sm-2 control-label">会员价：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="memberSell" name="memberSell"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="cardSell" class="col-sm-2 control-label">充值卡售价：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cardSell" name="cardSell"
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
                <th>型号</th>
                <th>进货均价</th>
                <th>销售价</th>
                <th>会员打折</th>
                <th>会员销售价</th>
                <th>充值卡打折</th>
                <th>充值卡售价</th>
                <th class="text-center" width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>跑鞋</td>
                <td>80</td>
                <td>150</td>
                <td>0.85</td>
                <td>127.5</td>
                <td>0.8</td>
                <td>120</td>
                <td class="text-center">
                    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>跑鞋</td>
                <td>80</td>
                <td>150</td>
                <td>0.85</td>
                <td>127.5</td>
                <td>0.8</td>
                <td>120</td>
                <td class="text-center">
                    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>跑鞋</td>
                <td>80</td>
                <td>150</td>
                <td>0.85</td>
                <td>127.5</td>
                <td>0.8</td>
                <td>120</td>
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