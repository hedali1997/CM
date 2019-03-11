<?php
require_once '../inc/function.php';

if(empty($_GET['start']) || empty($_GET['end'])){
    exit('缺少必要参数');
}
$start=u_g($_GET['start']);
$end=u_g($_GET['end']);
// 进货支出   select sum(金额) as sum from 进货明细表;
$inPay=cm_fetch_one("select sum(".u_g('金额').") as sum from ".u_g('进货明细表')." where ".u_g('日期').">='{$start}' and ".u_g('日期')."<='{$end}';")['sum'];
// 其他支出   select sum(支出金额) as sum from 支出明细表;
$otherPay=cm_fetch_one("select sum(".u_g('支出金额').") as sum from ".u_g('支出明细表')." where ".u_g('支出日期').">='{$start}' and ".u_g('支出日期')."<='{$end}';")['sum'];
// 合计支出
$allPay=$inPay+$otherPay;
// 销售收入   select sum(收款金额) as sum from 销售记录;
$outSell=cm_fetch_one("select sum(".u_g('收款金额').") as sum from ".u_g('销售记录')." where ".u_g('日期').">='{$start}' and ".u_g('日期')."<='{$end}';")['sum'];
// 会员卡余额 select sum(卡余额) as sum from 会员库;
$memberBalance=cm_fetch_one("select sum(".u_g('卡余额').") as sum from ".u_g('会员库').";")['sum'];
// 利润合计
$profit=$outSell-$allPay;

echo $inPay.','.$otherPay.','.$allPay.','.$outSell.','.$memberBalance.','.$profit;