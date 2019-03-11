function getNow(s) {
    return s < 10 ? '0' + s: s;
}
// time为true，获取当期日期加时间，false只获取日期
function getTime(time){
    var myDate = new Date();
    //获取当前年
    var year=myDate.getFullYear();
    //获取当前月
    var month=myDate.getMonth()+1;
    //获取当前日
    var date=myDate.getDate();
    var h=myDate.getHours();       //获取当前小时数(0-23)
    var m=myDate.getMinutes();     //获取当前分钟数(0-59)
    var s=myDate.getSeconds();
    if(time){
    var now=year+'-'+getNow(month)+"-"+getNow(date)+" "+getNow(h)+':'+getNow(m)+":"+getNow(s);
    }else{
    var now=year+'-'+getNow(month)+"-"+getNow(date);
    }
    return now;
}
//获取url中的参数
function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) return unescape(r[2]); return null; //返回参数值
}
// 判断字符串是否为空，为空返回'0',否则原样返回
function isnull(str){
    if (str=='') {return '0';}else{return str;}
}