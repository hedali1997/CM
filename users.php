<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

if(!empty($_GET['id'])){
    $current_info=cm_fetch_one("select * from ".u_g('用户管理')." where ".u_g('用户编号')."='{$_GET['id']}';");
    $current_perm=$current_info[u_g('权限')]===u_g('系统管理员')? 'p1':'p2';
}
if(!empty($_GET['delete'])){
    $GLOBALS['message']='删除成功';
    $GLOBALS['success']=true;
}

function checkuser($loginName){
    $users_info=cm_fetch_all('select '.u_g('登录名称').' from '.u_g('用户管理').';');
    for ($i=0; $i < count($users_info); $i++) {
        if(implode("",$users_info[$i])==$loginName){
            return true;
        }
        return false;
    }
}
function adduser(){
    if (empty($_POST['loginName']) || empty($_POST['trueName'])) {
        $GLOBALS['message']='请填写登录名称和真实姓名';
        $GLOBALS['success']=false;
        return;
    }
    if (empty($_POST['password'])) {
        $GLOBALS['message']='请填写登录密码';
        $GLOBALS['success']=false;
        return;
    }
    $id=guid();
    $loginName=$_POST['loginName'];
    $trueName=$_POST['trueName'];
    $permission=$_POST['permission']=='p1'? u_g('系统管理员'):u_g('一般操作员');
    $password=$_POST['password'];

    if (checkuser($loginName)) {
        $GLOBALS['message'] = '登录名称已存在！';
        $GLOBALS['success'] = false;
        return;
    }

    $rows=cm_execute("insert into ".u_g('用户管理')." (".u_g('用户编号').",".u_g('登录名称').",".u_g('真实姓名').",".u_g('权限').",".u_g('密码').") values('{$id}','{$loginName}','{$trueName}','{$permission}','{$password}');");
    $GLOBALS['success'] = $rows>0;
    $GLOBALS['message'] = $rows<=0?  '添加失败!':'添加成功!';
}
function edituser(){
    if (empty($_POST['loginName']) || empty($_POST['trueName'])) {
        $GLOBALS['message']='请填写登录名称和真实姓名';
        $GLOBALS['success']=false;
        return;
    }
    if (empty($_POST['password'])) {
        $GLOBALS['message']='请填写登录密码';
        $GLOBALS['success']=false;
        return;
    }
    $id=$_GET['id'];
    $loginName=$_POST['loginName'];
    $trueName=$_POST['trueName'];
    $permission=$_POST['permission']=='p1'? u_g('系统管理员'):u_g('一般操作员');
    $password=$_POST['password'];
    $rows=cm_execute("update ".u_g('用户管理')." set ".u_g('登录名称')."='{$loginName}',".u_g('真实姓名')."='{$trueName}',".u_g('权限')."='{$permission}',".u_g('密码')."='{$password}' where ".u_g('用户编号')."='{$id}';");
    $GLOBALS['success'] = $rows>0;
    $GLOBALS['message'] = $rows<=0?  '修改失败!':'修改成功!';
}

if ($_SERVER['REQUEST_METHOD']==='POST') {
    if(empty($_GET['id'])){
        adduser();
    }else{
        edituser();
    }
}

$info=cm_fetch_all('select * from '.u_g('用户管理').';');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('用户管理'); ?></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
</head>
<body>
<div class="main">
<?php include 'inc/top.php'; ?>
    <?php if (isset($current_info)): ?>
        <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $current_info[u_g('用户编号')] ?>" method='post'>
            <div class="form-group">
                <label for="loginName" class="col-sm-2 control-label"><?php echo u_g('登录名称：'); ?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="loginName" name="loginName" value="<?php echo $current_info[u_g('登录名称')] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="trueName" class="col-sm-2 control-label"><?php echo u_g('真实姓名：'); ?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="trueName" name="trueName" value="<?php echo $current_info[u_g('真实姓名')] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="permission" class="col-sm-2 control-label"><?php echo u_g('权限：'); ?></label>
                <div class="col-sm-10">
                    <select class="form-control" name="permission" id="permission">
                        <option value="p1" <?php echo $current_perm=='p1'? 'selected':''; ?>><?php echo u_g('系统管理员'); ?></option>
                        <option value="p2" <?php echo $current_perm=='p2'? 'selected':''; ?>><?php echo u_g('一般操作员'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label"><?php echo u_g('登录密码：'); ?></label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('修改'); ?></button>
                </div>
            </div>
        </form>
    <?php else: ?>
        <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
            <div class="form-group">
                <label for="loginName" class="col-sm-2 control-label"><?php echo u_g('登录名称：'); ?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="loginName" name="loginName">
                </div>
            </div>
            <div class="form-group">
                <label for="trueName" class="col-sm-2 control-label"><?php echo u_g('真实姓名：'); ?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="trueName" name="trueName">
                </div>
            </div>
            <div class="form-group">
                <label for="permission" class="col-sm-2 control-label"><?php echo u_g('权限：'); ?></label>
                <div class="col-sm-10">
                    <select class="form-control" name="permission" id="permission">
                        <option value="p1"><?php echo u_g('系统管理员'); ?></option>
                        <option value="p2"><?php echo u_g('一般操作员'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label"><?php echo u_g('登录密码：'); ?></label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('添加'); ?></button>
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
                <th><?php echo u_g('登录名称'); ?></th>
                <th><?php echo u_g('真实姓名'); ?></th>
                <th><?php echo u_g('权限'); ?></th>
                <th class="text-center" width="100"><?php echo u_g('操作'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($info as $item): ?>
                <tr>
                    <td><?php echo $item[u_g('登录名称')] ?></td>
                    <td><?php echo $item[u_g('真实姓名')] ?></td>
                    <td><?php echo $item[u_g('权限')] ?></td>
                    <td class="text-center">
                        <a href="/users.php?id=<?php echo $item[u_g('用户编号')] ?>" class="btn btn-info btn-block"><?php echo u_g('编辑') ?></a>
                        <a href="/users-delete.php?id=<?php echo $item[u_g('用户编号')] ?>" class="btn btn-danger btn-block"><?php echo u_g('删除') ?></a>
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
</body>
</html>