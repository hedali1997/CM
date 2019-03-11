<?php
require_once '../inc/function.php';

if (empty($_GET['show']) || $_GET['show']!='true') {
    exit('error');
}
// select 商品种类,厂家,型号,颜色,尺码,材质 from 商品表
$res=cm_fetch_all("select ".u_g('商品种类').",".u_g('厂家').",".u_g('型号').",".u_g('颜色').",".u_g('尺码').",".u_g('材质').",".u_g('商品序号')." from ".u_g('商品表').";");
if(!$res){
die( print_r( sqlsrv_errors(), true));
exit('error');
}

foreach ($res as $item) {
    echo $item[u_g('商品种类')].','.$item[u_g('厂家')].','.$item[u_g('型号')].','.$item[u_g('颜色')].','.$item[u_g('尺码')].','.$item[u_g('材质')].','.$item[u_g('商品序号')].'|';
}