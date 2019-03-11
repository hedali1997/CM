<?php
require_once '../inc/function.php';

if(empty($_GET['start']) || empty($_GET['end'])){
    exit('缺少必要参数');
}
$start=u_g($_GET['start']);
$end=u_g($_GET['end']);
// SELECT [进货明细表].[日期] ,[商品表].[商品种类],[商品表].[厂家],[商品表].[型号],[商品表].[颜色],[商品表].[尺码],[商品表].[材质],[进货明细表].[进货单价],[进货明细表].[数量],[进货明细表].[金额],[商品表].[销售价] from [进货明细表] inner join [商品表] on [进货明细表].[商品序号]=[商品表].[商品序号] where [进货明细表].[日期] >= '2017-10-1' and [进货明细表].[日期] <= '2019-3-1' order by [日期] desc;
$sql="SELECT ".u_g('进货明细表').".".u_g('日期')." ,".u_g('商品表').".".u_g('商品种类').",".u_g('商品表').".".u_g('厂家').",".u_g('商品表').".".u_g('型号').",".u_g('商品表').".".u_g('颜色').",".u_g('商品表').".".u_g('尺码').",".u_g('商品表').".".u_g('材质').",".u_g('进货明细表').".".u_g('进货单价').",".u_g('进货明细表').".".u_g('数量').",".u_g('进货明细表').".".u_g('金额').",".u_g('商品表').".".u_g('销售价')." from ".u_g('进货明细表')." inner join ".u_g('商品表')." on ".u_g('进货明细表').".".u_g('商品序号')."=".u_g('商品表').".".u_g('商品序号')." where ".u_g('进货明细表').".".u_g('日期')." >= '{$start}' and ".u_g('进货明细表').".".u_g('日期')." <= '{$end}' order by ".u_g('日期')." desc;";
$res=cm_fetch_all($sql);
$allAmounts =cm_fetch_one("SELECT SUM(".u_g('金额').") as Amounts FROM ".u_g('进货明细表')." where ".u_g('日期')." >= '{$start}' and ".u_g('日期')." <= '{$end}';");
if(!$res || !$allAmounts){
die( print_r( sqlsrv_errors(), true));
exit('查询失败1');
}
foreach ($res as $item){
    echo date_format($item[u_g('日期')],"Y-m-d h:i:s").','.$item[u_g('商品种类')].','.$item[u_g('厂家')].','.$item[u_g('型号')].','.$item[u_g('颜色')].','.$item[u_g('尺码')].','.$item[u_g('材质')].','.$item[u_g('进货单价')].','.$item[u_g('数量')].','.$item[u_g('金额')].','.$item[u_g('销售价')].','.$allAmounts['Amounts'].'|';
}
