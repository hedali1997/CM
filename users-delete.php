<?php
require_once 'inc/function.php';

if(empty($_GET['id'])){
    exit('缺少必要参数');
}

$id =$_GET['id'];

$rows=cm_execute("delete from ".u_g('用户管理')." where ".u_g('用户编号')." = '{$id}';");

header('Location: /users.php?delete=true');