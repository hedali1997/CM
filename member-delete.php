<?php
require_once 'inc/function.php';

if(empty($_GET['id'])){
    exit('缺少必要参数');
}

$id =$_GET['id'];

$rows=cm_execute("delete from ".u_g('支出明细表')." where ".u_g('序号')." ='{$id}';");
header('Location: /memberInformation.php?delete=true');