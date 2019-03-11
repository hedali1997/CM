<?php
require_once '../inc/function.php';

if(!empty($_GET['sort']) && !empty($_GET['factory']) && !empty($_GET['type']) && !empty($_GET['color']) && !empty($_GET['size'])){
    $sort=u_g($_GET['sort']);
    $factory=u_g($_GET['factory']);
    $type=u_g($_GET['type']);
    $color=u_g($_GET['color']);
    $size=u_g($_GET['size']);
    // 为了和主页面传过来的参数顺序一致
    $sort=get_sort($sort);
    $factory=get_factory($sort,$factory);
    $type=get_type($sort,$factory,$type);
    $color=get_color($sort,$factory,$type,$color);
    $size=get_size($sort,$factory,$type,$color,$size);

    $res=cm_fetch_all('select distinct '.u_g('材质').' from '.u_g('商品表').' where '.u_g('商品种类')."='{$sort}' and ".u_g('厂家')."='{$factory}' and ".u_g('型号')."='{$type}' and ".u_g('颜色')."='{$color}' and ".u_g('尺码')."='{$size}';");
    if(!$res){
    die( print_r( sqlsrv_errors(), true));
    exit('查询失败1');
    }
    foreach ($res as $item) {
        echo $item[u_g('材质')].'|';
    }
}elseif(!empty($_GET['sort']) && !empty($_GET['factory']) && !empty($_GET['type']) && !empty($_GET['color'])){
    $sort=u_g($_GET['sort']);
    $factory=u_g($_GET['factory']);
    $type=u_g($_GET['type']);
    $color=u_g($_GET['color']);
    // 为了和主页面传过来的参数顺序一致
    $sort=get_sort($sort);
    $factory=get_factory($sort,$factory);
    $type=get_type($sort,$factory,$type);
    $color=get_color($sort,$factory,$type,$color);

    $res=cm_fetch_all('select distinct '.u_g('尺码').' from '.u_g('商品表').' where '.u_g('商品种类')."='{$sort}' and ".u_g('厂家')."='{$factory}' and ".u_g('型号')."='{$type}' and ".u_g('颜色')."='{$color}';");
    if(!$res){
    die( print_r( sqlsrv_errors(), true));
    exit('查询失败1');
    }
    foreach ($res as $item) {
        echo $item[u_g('尺码')].'|';
    }
}elseif(!empty($_GET['sort']) && !empty($_GET['factory']) && !empty($_GET['type'])){
    $sort=u_g($_GET['sort']);
    $factory=u_g($_GET['factory']);
    $type=u_g($_GET['type']);
    // 为了和主页面传过来的参数顺序一致
    $sort=get_sort($sort);
    $factory=get_factory($sort,$factory);
    $type=get_type($sort,$factory,$type);

    $res=cm_fetch_all('select distinct '.u_g('颜色').' from '.u_g('商品表').' where '.u_g('商品种类')."='{$sort}' and ".u_g('厂家')."='{$factory}' and ".u_g('型号')."='{$type}';");
    if(!$res){
    die( print_r( sqlsrv_errors(), true));
    exit('查询失败1');
    }
    foreach ($res as $item) {
        echo $item[u_g('颜色')].'|';
    }
}elseif(!empty($_GET['sort']) && !empty($_GET['factory'])){
    $sort=u_g($_GET['sort']);
    $factory=u_g($_GET['factory']);
    // 为了和主页面传过来的参数顺序一致
    $sort=get_sort($sort);
    $factory=get_factory($sort,$factory);

    $res=cm_fetch_all('select distinct '.u_g('型号').' from '.u_g('商品表').' where '.u_g('商品种类')."='{$sort}' and ".u_g('厂家')."='{$factory}';");
    if(!$res){
    die( print_r( sqlsrv_errors(), true));
    exit('查询失败1');
    }
    foreach ($res as $item) {
        echo $item[u_g('型号')].'|';
    }
}elseif(!empty($_GET['sort'])){
    $sort=u_g($_GET['sort']);
    $sort=get_sort($sort);
    $res=cm_fetch_all('select distinct '.u_g('厂家').' from '.u_g('商品表').' where '.u_g('商品种类')."='{$sort}';");
    if(!$res){
    die( print_r( sqlsrv_errors(), true));
    exit('查询失败1');
    }
    foreach ($res as $item) {
        echo $item[u_g('厂家')].'|';
    }
}else{
    exit(u_g('没有传入必要的参数'));
}
