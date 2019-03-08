<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

function search(){
    $names=cm_fetch_all("select ".u_g('姓名')." from ".u_g('会员库').";");
    $phones=cm_fetch_all("select ".u_g('手机号码')." from ".u_g('会员库').";");
    // var_dump($names);
    // var_dump($phones);
    $membername = $_GET['membername'];
    $phonenumber= $_GET['phonenumber'];
    if(isset($membername)){
        for ($i=0; $i < count($names); $i++) {
            if(implode("",$names[$i])==$membername){
                $name = $names[$i];
                break;
            }
        }
    }
    if(isset($phonenumber)){
        for ($i=0; $i < count($phones); $i++) {
            if(implode("",$phones[$i])==$phonenumber){
                $name = $names[$i];
                break;
            }
        }
    }
    if(empty($name)){
        $GLOBALS['message'] = '您不是会员无法查询！';
        return;
    }
    $name = implode("",$name);
    // select 日期,数量,应收,实收,优惠,销售姓名,收款方式,出货方式 from 销售记录 where 会员姓名='贺大礼' order by 日期 desc
    $res=cm_fetch_all("select ".u_g('日期').",".u_g('数量').",".u_g('应收').",".u_g('实收').",".u_g('优惠').",".u_g('销售姓名').",".u_g('收款方式').",".u_g('出货方式')." from ".u_g('销售记录')." where ".u_g('会员姓名')."='{$name}' order by ".u_g('日期')." desc");
    if(!$res){
        $GLOBALS['message'] = '您当前没有消费记录！';
        return;
    }
    return $res;
}

if($_SERVER['REQUEST_METHOD']==='GET' && (!empty($_GET['membername']) || !empty($_GET['phonenumber'])) ){
    $searchInfo=search();
}
else{
    $GLOBALS['message'] = '请输入会员姓名或手机号码查询';
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('购物明细查询') ?></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
    <style>
        .main{
            min-width: 640px;
        }
        .btn-block{
            max-width: 320px;
        }
    </style>
</head>
<body>
<div class="main">
<?php include 'inc/top.php'; ?>
    <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='get'>
        <div class="form-group">
            <label for="membername" class="col-sm-2 control-label"><?php echo u_g('会员姓名：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="membername" name="membername">
            </div>
        </div>
        <div class="form-group">
            <label for="phonenumber" class="col-sm-2 control-label"><?php echo u_g('手机号码：') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phonenumber" name="phonenumber">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('查询') ?></button>
            </div>
        </div>
    </form>
    <?php if (isset($message)):
    $message=u_g($message);?>
        <div class="alert alert-danger">
              <?php echo $message; ?>
        </div>
    <?php endif ?>
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?php echo u_g('日期') ?></th>
                <th><?php echo u_g('数量') ?></th>
                <th><?php echo u_g('应收') ?></th>
                <th><?php echo u_g('实收') ?></th>
                <th><?php echo u_g('优惠') ?></th>
                <th><?php echo u_g('销售员') ?></th>
                <th><?php echo u_g('收款方式') ?></th>
                <th><?php echo u_g('出货方式') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($searchInfo)): ?>
                <?php foreach ($searchInfo as $value): ?>
                <tr>
                    <td><?php echo date_format($value[u_g('日期')],"Y-m-d"); ?></td>
                    <td><?php echo $value[u_g('数量')]; ?></td>
                    <td><?php echo $value[u_g('应收')]; ?></td>
                    <td><?php echo $value[u_g('实收')]; ?></td>
                    <td><?php echo $value[u_g('优惠')]; ?></td>
                    <td><?php echo $value[u_g('销售姓名')]; ?></td>
                    <td><?php echo $value[u_g('收款方式')]; ?></td>
                    <td><?php echo $value[u_g('出货方式')]; ?></td>
                </tr>
                <?php endforeach ?>
            <?php endif ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'inc/bottom.php'; ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>