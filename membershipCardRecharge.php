<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

if (!empty($_GET['id'])){
    // 客户端通过url传递了一个id参数
    // =》客户端是要来拿一个修改数据的表单
    // => 需要拿到用户想要修改的数据
    $current_recharge_member=cm_fetch_one('select '.u_g('序号').','.u_g('姓名').','.u_g('手机号码').','.u_g('卡余额').' from '.u_g('会员库')." where ".u_g('序号')." ='{$_GET['id']}';");
}

function recharge_member(){
    //校验，持久化，响应
    if(empty($_POST['id']) && empty($_POST['rechargeAmount'])){
        $GLOBALS['message'] = '请完整填写表单！';
        $GLOBALS['success'] = false;
        return;
    }
    // 接收并保存
    $id = $_POST['id'];
    $sellId=guid();
    // $membername = $_POST['membername'];
    // $phonenum = $_POST['phonenumber'];
    $rechargeAmount = $_POST['rechargeAmount'];
    $date = date('Y-m-d h:i:s', time());
    switch ($_POST['rechargeMethod']) {
        case '1':
            $rechargeMethod = u_g('现金充值');
            break;
        case '2':
            $rechargeMethod = u_g('POS刷卡充值');
            break;
        case '3':
            $rechargeMethod = u_g('支付宝充值');
            break;
        case '4':
            $rechargeMethod = u_g('微信充值');
            break;
        default:
            $rechargeMethod = u_g('现金充值');
            break;
    }

    //update 会员库 set 卡余额=卡余额 + '100' where 姓名 = '贺大礼'
    $rows_update = cm_execute("update ".u_g('会员库')." set ".u_g('卡余额')."=".u_g('卡余额')." + '{$rechargeAmount}' where ".u_g('序号')." = '{$id}';");
    // insert into 会员卡金额变动明细表(日期,会员编号,发生金额,变动类型,销售编号,充值方式) values('2019-3-8 12:00:00','0d0abd64-239c-4017-8e89-98ca9bc5da8b','100','充值','123456','现金充值')
    $rows_insert =cm_execute("insert into ".u_g('会员卡金额变动明细表')." values ('{$date}','{$id}','{$rechargeAmount}','".u_g('充值')."','{$sellId}','{$rechargeMethod}');");

    $GLOBALS['success'] = $rows_update>0 && $rows_insert>0;
    $GLOBALS['message'] = $rows_update<=0 && $rows_insert<=0?  '充值失败!':'充值成功!';
}
//如果修改操作与查询操作在一起，一定是先做修改，再查询
if($_SERVER['REQUEST_METHOD']==='POST'){
    recharge_member();
}

$member=cm_fetch_all('select '.u_g('序号').','.u_g('姓名').','.u_g('手机号码').','.u_g('卡余额').' from '.u_g('会员库').';');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="GBK">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('会员卡充值'); ?></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
    <style type="text/css">
        .btn-block{
            max-width: 320px;
        }
    </style>
</head>
<body>
<div class="main">
    <?php include 'inc/top.php'; ?>
    <?php if (isset($current_recharge_member)): ?>
    <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group hidden">
            <label for="id" class="col-sm-2 control-label"><?php echo u_g('编号：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $current_recharge_member[u_g('序号')]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="membername" class="col-sm-2 control-label"><?php echo u_g('会员姓名：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="membername" name="membername" value="<?php echo $current_recharge_member[u_g('姓名')] ?>" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label for="phonenumber" class="col-sm-2 control-label"><?php echo u_g('手机号码：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?php echo $current_recharge_member[u_g('手机号码')] ?>" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label for="rechargeMethod" class="col-sm-2 control-label"><?php echo u_g('充值方式：'); ?></label>
            <div class="col-sm-10">
                <select class="form-control" name="rechargeMethod" id="rechargeMethod">
                    <option value="1"><?php echo u_g('现金充值'); ?></option>
                    <option value="2"><?php echo u_g('POS刷卡充值'); ?></option>
                    <option value="3"><?php echo u_g('支付宝充值'); ?></option>
                    <option value="4"><?php echo u_g('微信充值'); ?></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="rechargeAmount" class="col-sm-2 control-label"><?php echo u_g('充值金额：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rechargeAmount" name="rechargeAmount" >
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('充值'); ?></button>
            </div>
        </div>
    </form>
    <?php else: ?>
    <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group hidden">
            <label for="id" class="col-sm-2 control-label"><?php echo u_g('编号：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id" name="id">
            </div>
        </div>
        <div class="form-group">
            <label for="membername" class="col-sm-2 control-label"><?php echo u_g('会员姓名：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="membername" name="membername">
            </div>
        </div>
        <div class="form-group">
            <label for="phonenumber" class="col-sm-2 control-label"><?php echo u_g('手机号码：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phonenumber" name="phonenumber">
            </div>
        </div>
        <div class="form-group">
            <label for="rechargeMethod" class="col-sm-2 control-label"><?php echo u_g('充值方式：'); ?></label>
            <div class="col-sm-10">
                <select class="form-control" name="rechargeMethod" id="rechargeMethod">
                    <option value="1"><?php echo u_g('现金充值'); ?></option>
                    <option value="2"><?php echo u_g('POS刷卡充值'); ?></option>
                    <option value="3"><?php echo u_g('支付宝充值'); ?></option>
                    <option value="4"><?php echo u_g('微信充值'); ?></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="rechargeAmount" class="col-sm-2 control-label"><?php echo u_g('充值金额：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rechargeAmount" name="rechargeAmount"
                       placeholder="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('充值'); ?></button>
            </div>
        </div>
    </form>
    <?php endif ?>
    <?php if (isset($message)):
    $message=u_g($message);?>
        <?php if ($success): ?>
            <div class="alert alert-success">
                <?php echo $message; ?>
            </div>
        <?php else: ?>
          <div class="alert alert-danger">
                <?php echo $message; ?>
          </div>
        <?php endif ?>
    <?php endif ?>
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?php echo u_g('姓名'); ?></th>
                <th><?php echo u_g('手机号码'); ?></th>
                <th><?php echo u_g('卡余额'); ?></th>
                <th class="text-center" width="100"><?php echo u_g('操作'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($member as $item): ?>
            <tr>
                <td><?php echo $item[u_g('姓名')] ?></td>
                <td><?php echo $item[u_g('手机号码')] ?></td>
                <td><?php echo $item[u_g('卡余额')] ?></td>
                <td class="text-center">
                    <a href="/membershipCardRecharge.php?id=<?php echo $item[u_g('序号')]; ?>" class="btn btn-info btn-block"><?php echo u_g('充值'); ?></a>
                </td>
            </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'inc/bottom.php'; ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
    $(function($){// 入口函数
        // 1、单独作用域
        // 2、确保页面加载过后执行

        // 目标：在用户输入自己的邮箱过后，页面展示这个邮箱的头像
        // 实现：
        // -时机：邮箱文本框失去焦点，并且能够拿到文本框中填写的邮箱时
        // -事情：获取这个文本框中填写的邮箱对应的头像地址展示到上面的img元素上
        var phoneFormat = /0?(13|14|15|17|18)[0-9]{9}/;
        var nameFormat =  /^[\u4E00-\u9FA5\uf900-\ufa2d·s]{2,10}$/;//验证姓名正则
        $('#membername').on('blur',function(){//blur 失去焦点事件
            if($('#membername').attr("disabled")){
                return;
            }
            var value=$(this).val();
            if(!value||!nameFormat.test(value))return;
            $.get('/api/recharge.php',{ name: value}, function(res){
                if(!res)return;
                var getRes = res.split(',');
                $('#phonenumber').val(getRes[2]).attr("disabled","disabled");
                $('#membername').attr("disabled","disabled");
                $('#id').attr("value",getRes[0]);
                $('.table tbody tr').remove();
                $('.table tbody').append('<tr></tr>');
                for (var i = 1; i < getRes.length; i++) {
                    $('.table tbody tr').append('<td>'+getRes[i]+'</td>');
                };
                $('.table tbody tr').append("<td class='text-center'><a href='/membershipCardRecharge.php' class='btn btn-info btn-block'><?php echo u_g('显示所有'); ?></a></td>");
            });
        });
        $('#phonenumber').on('blur',function(){//blur 失去焦点事件
            if($('#phonenumber').attr("disabled")){
                return;
            }
            var value=$(this).val();
            if(!value||!phoneFormat.test(value))return;
            $.get('/api/recharge.php',{ phone: value}, function(res){
                if(!res)return;
                var getRes = res.split(',');
                $('#membername').val(getRes[1]).attr("disabled","disabled");
                $('#phonenumber').attr("disabled","disabled");
                $('#id').attr("value",getRes[0]);
                $('.table tbody tr').remove();
                $('.table tbody').append('<tr></tr>');
                for (var i = 1; i < getRes.length; i++) {
                    $('.table tbody tr').append('<td>'+getRes[i]+'</td>');
                };
                $('.table tbody tr').append("<td class='text-center'><a href='/membershipCardRecharge.php' class='btn btn-info btn-block'><?php echo u_g('显示所有'); ?></a></td>");
            });
        });
    });

  </script>
</body>
</html>