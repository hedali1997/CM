<?php
require_once 'inc/function.php';

if(empty($_GET['id'])){
    exit('缺少必要参数');
}

$id =$_GET['id'];

$rows=cm_execute("delete from ".u_g('会员库')." where ".u_g('序号')." in ('{$id}');");
header('Location: /memberInformation.php?delete=true');