<?php
require_once 'inc/function.php';
// 判断用户是否登录一定是最先去做
cm_get_current_user();

if(!empty($_GET['delete'])){
    $GLOBALS['message'] = '删除记录成功！';
    $GLOBALS['success'] = true;
}

function search(){
    if(empty($_POST['startDate']) || empty($_POST['endDate'])){
        $GLOBALS['message']='请选择开始日期和结束日期';
        $GLOBALS['success'] = false;
        return;
    }
    $startDate=$_POST['startDate'];
    $endDate=$_POST['endDate'];

    $res=cm_fetch_all("select * from ".u_g('支出明细表')." where ".u_g('支出日期').">='{$startDate}' and ".u_g('支出日期')."<='{$endDate}' order by ".u_g('支出日期')." desc;");
    if(!$res){
        $GLOBALS['message']='查询失败';
        $GLOBALS['success'] = false;
        return;
    }
    return $res;
}

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $search_info=search();
}

$info=cm_fetch_all('select '.u_g('序号').','.u_g('支出明细').','.u_g('支出金额').','.u_g('支出日期').','.u_g('登记日期').','.u_g('备注').' from '.u_g('支出明细表').' order by '.u_g('支出日期').' desc;');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo u_g('支出明细查询'); ?></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7//css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
    <style>
        .main{
            min-width: 640px;
        }
    </style>
</head>
<body>
<div class="main">
<?php include 'inc/top.php'; ?>
    <form class="container-fluid" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="startDate" class="col-sm-2 control-label"><?php echo u_g('开始日期：'); ?></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="startDate" name="startDate" value="2017-10-01">
            </div>
        </div>
        <div class="form-group">
            <label for="endDate" class="col-sm-2 control-label"><?php echo u_g('结束日期：'); ?></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="endDate" name="endDate" value="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block"><?php echo u_g('统计'); ?></button>
            </div>
        </div>
    </form>
    <?php if (isset($message)):
        $message=u_g($message);?>
        <?php if ($success): ?>
            <div class="alert alert-success">
                <?php echo $message; ?>
            </div>
        <?php else: ?>
          <div class="alert alert-danger">
                <?php echo $message; ?>
          </div>
        <?php endif ?>
    <?php endif ?>
    <div class="col-md-8">
        <div class="page-action">
            <!-- show when multiple checked -->
            <a id="btn_delete" class="btn btn-danger btn-sm" href="payDetails-delete.php" style="display: none"><?php echo u_g('批量删除'); ?></a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th><?php echo u_g('支出明细'); ?></th>
                <th><?php echo u_g('支出金额'); ?></th>
                <th><?php echo u_g('支出日期'); ?></th>
                <th><?php echo u_g('登记日期'); ?></th>
                <th><?php echo u_g('备注'); ?></th>
                <th><?php echo u_g('操作'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($search_info)): ?>
                <?php foreach ($search_info as $item): ?>
                    <tr>
                        <td class="text-center" width="40"><input type="checkbox" data-id="<?php echo $item[u_g('序号')]; ?>"></td>
                        <td><?php echo $item[u_g('支出明细')]; ?></td>
                        <td><?php echo $item[u_g('支出金额')]; ?></td>
                        <td><?php echo date_format($item[u_g('支出日期')],'Y-m-d H:i:s'); ?></td>
                        <td><?php echo date_format($item[u_g('登记日期')],'Y-m-d H:i:s'); ?></td>
                        <td><?php echo $item[u_g('备注')]; ?></td>
                        <td class="text-center">
                            <a href="/payEnroll.php?id=<?php echo $item[u_g('序号')]; ?>" class="btn btn-info btn-block"><?php echo u_g('编辑'); ?></a>
                            <a href="/payDetails-delete.php?id=<?php echo $item[u_g('序号')]; ?>" class="btn btn-danger btn-block"><?php echo u_g('删除'); ?></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <?php foreach ($info as $item): ?>
                    <tr>
                        <td class="text-center" width="40"><input type="checkbox" data-id="<?php echo $item[u_g('序号')]; ?>"></td>
                        <td><?php echo $item[u_g('支出明细')]; ?></td>
                        <td><?php echo $item[u_g('支出金额')]; ?></td>
                        <td><?php echo date_format($item[u_g('支出日期')],'Y-m-d H:i:s'); ?></td>
                        <td><?php echo date_format($item[u_g('登记日期')],'Y-m-d H:i:s'); ?></td>
                        <td><?php echo $item[u_g('备注')]; ?></td>
                        <td class="text-center">
                            <a href="/payEnroll.php?id=<?php echo $item[u_g('序号')]; ?>" class="btn btn-info btn-block"><?php echo u_g('编辑'); ?></a>
                            <a href="/payDetails-delete.php?id=<?php echo $item[u_g('序号')]; ?>" class="btn btn-danger btn-block"><?php echo u_g('删除'); ?></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'inc/bottom.php'; ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/js/function.js"></script>
<script>
$(function(){
    $('#endDate').val(getTime(false));
    // 在表格中的任意一个chexkbox选中状态变化时
    var $tbodyCheckboxs= $('tbody input');
    var $btnDelete = $('#btn_delete');

    // 定义一个数组记录被选中的
    var allCheckeds =[];
    $tbodyCheckboxs.on('change',function(){
        // this.dateset['id'];
        // console.log($(this).attr('data-id'));
        // console.log($(this).data('id'));
        var id=$(this).data('id');
        // 根据有没有选中当前这个 CheckBox 决定是添加还是移除
        // includes(x)判断是否含有x这个成员（ES5新函数）有兼容问题
        if($(this).prop('checked')){
          // allCheckeds.indexOf(id) ===-1 || allCheckeds.push(id);  两种方法都可以
            allCheckeds.includes(id) || allCheckeds.push(id);
        }else{
            allCheckeds.splice(allCheckeds.indexOf(id),1);
        }
        console.log(allCheckeds);
        // 根据剩下的CheckBox决定是否显示删除
        allCheckeds.length ? $btnDelete.fadeIn() : $btnDelete.fadeOut();
        $btnDelete.prop('search','?id=' + allCheckeds);
    })

    // 找一个合适的时机，做一个合适的事情
    // 全选和全不选
    $('thead input').on('change',function(){
      // 1.获取当前选中状态
      var checked = $(this).prop('checked');
      // 2.设置给表体中的每一个
      // 对于一些常见方法可以直接.方法名（.change）调用，
      // .trigger()可以用来触发所有的指定的事件
      $tbodyCheckboxs.prop('checked',checked).trigger('change');
    })
})
</script>
</body>
</html>