<?php
require_once '../inc/function.php';

if(!empty($_GET['sort']) && !empty($_GET['factory'])){
    $sort=u_g($_GET['sort']);
    $factory=u_g($_GET['factory']);
    // 为了和主页面传过来的参数顺序一致
        $info_sort=cm_fetch_all('select distinct '.u_g('商品种类').' from '.u_g('商品表').';');
        for($i=0;$i<count($info_sort);$i++){
            if($sort==('s'.$i)){
                $sort=implode('',$info_sort[$i]);break;
            }
        }
        $info_factory=cm_fetch_all('select distinct '.u_g('厂家').' from '.u_g('商品表').' where '.u_g('商品种类')."='{$sort}';");
        for($i=0;$i<count($info_factory);$i++){
            if($factory==('f'.$i)){
                $factory=implode('',$info_factory[$i]);break;
            }
        }

    $res=cm_fetch_all('select '.u_g('商品序号').','.u_g('型号').','.u_g('进货均价').','.u_g('销售价').','.u_g('会员打折').','.u_g('会员销售价').','.u_g('充值卡打折').','.u_g('充值卡售价').' from '.u_g('商品表').' where '.u_g('商品种类')."='{$sort}' and ".u_g('厂家')."='{$factory}';");
    if(!$res){
    die( print_r( sqlsrv_errors(), true));
    exit('查询失败1');
    }
    foreach ($res as $item) {
        echo $item[u_g('商品序号')].','.$item[u_g('型号')].','.$item[u_g('进货均价')].','.$item[u_g('销售价')].','.$item[u_g('会员打折')].','.$item[u_g('会员销售价')].','.$item[u_g('充值卡打折')].','.$item[u_g('充值卡售价')].'|';
    }
}
elseif(!empty($_GET['sort'])){
    $sort=u_g($_GET['sort']);
    $info_sort=cm_fetch_all('select distinct '.u_g('商品种类').' from '.u_g('商品表').';');
    for($i=0;$i<count($info_sort);$i++){
        if($sort==('s'.$i)){
            $sort=implode('',$info_sort[$i]);break;
        }
    }
    $res=cm_fetch_all('select distinct '.u_g('厂家').' from '.u_g('商品表').' where '.u_g('商品种类')."='{$sort}';");
    if(!$res){
    die( print_r( sqlsrv_errors(), true));
    exit('查询失败1');
    }
    foreach ($res as $item) {
        echo $item[u_g('厂家')].'|';
    }
}
else{
    exit(u_g('没有传入必要的参数'));
}
