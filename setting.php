<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

function update(){
    if(empty($_POST['memberDiscount']) || empty($_POST['cardDiscount'])){
        $GLOBALS['message']='请完整填写表单';
        $GLOBALS['success']=false;
        return;
    }
    $member=(float)$_POST['memberDiscount'];
    $card=(float)$_POST['cardDiscount'];
    if($member < 0 || $member>1 || $card < 0 || $card > 1){
        $GLOBALS['message']='请填写0-1之间的数字';
        $GLOBALS['success']=false;
        return;
    }
    $rows = cm_execute("update ".u_g('系统设置')." set ".u_g('会员打折')."='{$member}',".u_g('充值卡打折')."='{$card}';");
    $GLOBALS['success']=$rows>0;
    $GLOBALS['message']=$rows>0? '更改成功':'更改失败';
}


if($_SERVER['REQUEST_METHOD']==='POST'){
    update();
}

$info=cm_fetch_one('select '.u_g('会员打折').','.u_g('充值卡打折').' from '.u_g('系统设置').';');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('系统设置'); ?></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
</head>
<body>
<div class="main">
<?php include 'inc/top.php'; ?>
    <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
        <div class="form-group">
            <label for="memberDiscount" class="col-sm-2 control-label"><?php echo u_g('会员打折：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="memberDiscount" name="memberDiscount"
                       value="0<?php echo $info[u_g('会员打折')] ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="cardDiscount" class="col-sm-2 control-label"><?php echo u_g('充值卡打折：'); ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cardDiscount" name="cardDiscount"
                       value="0<?php echo $info[u_g('充值卡打折')] ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('确定'); ?></button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="updateAll" class="btn btn-primary btn-block"><?php echo u_g('批量更新折率'); ?></button>
            </div>
        </div>
    </form>
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
</div>
<?php include 'inc/bottom.php'; ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $(function(){
        $('#updateAll').on('click', function() {
            var member_d=$('#memberDiscount').val();
            var card_d=$('#cardDiscount').val();
            $('.alert').remove();
            if(!member_d || !card_d) return false;
            $.get('updateSet.php',{member: member_d,card:card_d}, function(res) {
                if(!res){
                    return false;
                }
                $('form').after("<div class='alert alert-success'><?php echo u_g('批量更新成功！'); ?></div>");
            });
            return false;
        });
    });
</script>
</body>
</html>