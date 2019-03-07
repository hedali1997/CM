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
                    <option>衣服</option>
                    <option>鞋子</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="factory" class="col-sm-2 control-label">厂家：</label>
            <div class="col-sm-10">
                <select class="form-control" id="factory" name="factory">
                    <option>特步</option>
                    <option>鸿星尔克</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="type" class="col-sm-2 control-label">型号：</label>
            <div class="col-sm-10">
                <select class="form-control" id="type" name="type">
                    <option>板鞋</option>
                    <option>跑鞋</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="color" class="col-sm-2 control-label">颜色：</label>
            <div class="col-sm-10">
                <select class="form-control" id="color" name="color">
                    <option>白色</option>
                    <option>黑色</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="size" class="col-sm-2 control-label">尺码：</label>
            <div class="col-sm-10">
                <select class="form-control" id="size" name="size">
                    <option>36</option>
                    <option>37</option>
                    <option>42</option>
                    <option>43</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="material" class="col-sm-2 control-label">材质：</label>
            <div class="col-sm-10">
                <select class="form-control" id="material" name="material">
                    <option>棉</option>
                    <option>羽绒</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="lessNum" class="col-sm-2 control-label">数量少于：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lessNum"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="inquiryMode" class="col-sm-2 control-label">查询方式：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inquiryMode"
                       value="按商品数量查询" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">查询</button>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">显示所有</button>
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
                <th>商品种类</th>
                <th>厂家</th>
                <th>型号</th>
                <th>颜色</th>
                <th>尺码</th>
                <th>材质</th>
                <th>进货均价</th>
                <th>库存数量</th>
                <th class="text-center" width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>鞋子</td>
                <td>特步</td>
                <td>跑鞋</td>
                <td>白</td>
                <td>43</td>
                <td>棉</td>
                <td>70</td>
                <td>3</td>
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