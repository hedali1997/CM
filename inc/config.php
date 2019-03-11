<?php
/**
 * 项目中用到的配置信息
 */
header("Content-type:text/html;charset=GB2312");
define('IP',"127.0.0.1");
define('CM_SERVER_NAME',IP.'\\SQL2014');
define('UID',"sa");
define('PWD',"cpxfwf82");
define('DATABASE',"data");
define('CM_SERVER_INFO',array("UID"=>UID,"PWD"=>PWD,"Database"=>DATABASE));
//定义根目录路劲
define('ROOT_DIR',dirname(__FILE__));