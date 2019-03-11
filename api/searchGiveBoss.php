<?php
require_once '../inc/function.php';

if(empty($_GET['start']) || empty($_GET['end'])){
    exit('缺少必要参数');
}
$start=u_g($_GET['start']);
$end=u_g($_GET['end']);
// select 上缴明细表.日期,销售记录.销售姓名,上缴现金,上缴pos单 from 上缴明细表 inner join 销售记录 on 上缴明细表.销售编号=销售记录.销售编号 where 上缴明细表.日期>='2017-10-01' and 上缴明细表.日期<='2019-03-11';
$res=cm_fetch_all("
select ".u_g('上缴明细表').".".u_g('日期').",".u_g('销售记录').".".u_g('销售姓名').",".u_g('上缴现金').",".u_g('上缴pos单')." from ".u_g('上缴明细表')." inner join ".u_g('销售记录')." on ".u_g('上缴明细表').".".u_g('销售编号')."=".u_g('销售记录').".".u_g('销售编号')." where ".u_g('上缴明细表').".".u_g('日期').">='{$start}' and ".u_g('上缴明细表').".".u_g('日期')."<='{$end}' order by ".u_g('日期')." desc;");
if(!$res){
    return;
}
foreach ($res as $item) {
    echo date_format($item[u_g('日期')],"Y-m-d h:i:s").','.$item[u_g('销售姓名')].','.$item[u_g('上缴现金')].','.$item[u_g('上缴pos单')].'|';
}
