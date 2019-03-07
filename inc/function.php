<?php
require_once 'config.php';
require_once 'getPY.php';
function u_g($str){
    return iconv ( "utf-8", "gb2312//IGNORE", $str );
}
function g_u($str){
    return iconv ( "gb2312","utf-8" , $str );
}
session_start();

function cm_get_current_user (){
    if(empty($_SESSION['current_login_user'])){
    //没有当前登录用户信息，意味着没有登录
    header('Location: /login.php');
    exit();// 没有必要再执行之后的代码
    }
    return $_SESSION['current_login_user'];
}

function cm_fetch_all ($sql){
    $conn = sqlsrv_connect(CM_SERVER_NAME,CM_SERVER_INFO);
    if(!$conn){
    exit('链接数据库失败');
    }

    $query=sqlsrv_query($conn, $sql);
    if(!$query){
    return false;
    }

    while($row = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)){
        $result[]=$row;
    }

    // 断开连接，释放内容-----下面两条不写也行，php会自动断开，严谨点就该写
    sqlsrv_free_stmt($query);
    sqlsrv_close($conn);
    return $result;
}
function cm_fetch_one($sql){
    $res = cm_fetch_all($sql);
    return isset($res[0])? $res[0]:null;
}
function cm_execute ($sql){
    $conn = sqlsrv_connect(CM_SERVER_NAME,CM_SERVER_INFO);
    if(!$conn){
    exit('链接数据库失败');
    }

    $query=sqlsrv_query($conn, $sql);
    if(!$query){
    die( print_r( sqlsrv_errors(), true));
    return false;
    }
    // 对于增删改类的操作都是获取受影响行数
    $affected_rows = sqlsrv_rows_affected($query);

    sqlsrv_close($conn);
    return $affected_rows;
}
function guid(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
        return $uuid;
    }
}