<?php
/**
 * 项目中用到的配置信息
 */
header("Content-type:text/html;charset=GB2312");
$ip="127.0.0.1";
define('CM_SERVER_NAME',$ip.'\\SQL2014');
$uid = "sa";
$pwd = "cpxfwf82";
$database = "data";
define('CM_SERVER_INFO',array("UID"=>$uid,"PWD"=>$pwd,"Database"=>$database));
//定义根目录路劲
define('ROOT_DIR',dirname(__FILE__));