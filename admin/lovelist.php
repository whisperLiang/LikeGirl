<?php
session_start();
include_once 'Nav.php';
$lovelist = "select * from lovelist order by id desc";
$reslist = mysqli_query($connect, $lovelist);
?>


<link href="assets/css/vendor/dataTables.bootstrap4.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/vendor/responsive.bootstrap4.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/vendor/buttons.bootstrap4.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/vendor/select.bootstrap4.css" rel="stylesheet" type="text/css"/>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3 size_18">恋爱清单<a href="/admin/lovelistAdd.php">
                        <button type="button" class="btn btn-success btn-sm right_10">
                            <i class="mdi mdi-circle-edit-outline"></i>新增
                        </button>
                    </a></h4>
                <table id="basic-datatable" class="table dt-responsive nowrap" width="100%">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>事件标题</th>
                        <th>完成状态</th>
                        <th>图片预览</th>
                        <th style="width:150px;">操作</th>
                    </tr>
                    </thead>


                    <tbody>
                    <?php
                    $SerialNumber = 0;
                    while ($list = mysqli_fetch_array($reslist)) {
                        $SerialNumber++;
                        ?>
                        <tr>
                            <td>
                                <div class="SerialNumber">
                                    <?php echo $SerialNumber ?>
                                </div>
                            </td>
                            <td><?php echo $list['eventname'] ?></td>
                            <td><?php if ($list['icon']) { ?> <span class="badge badge-success-lighten">已完成 </span><?php } ?><?php if (!$list['icon']) { ?> <span class="badge badge-danger-lighten">未完成</span> <?php } ?></td>
                            <td><?php if ($list['imgurl']) { 
                                $imgSrc = $list['imgurl'];
                                if ($imgSrc && strpos($imgSrc, 'http') !== 0 && strpos($imgSrc, '//') !== 0) {
                                    $imgSrc = '../' . $imgSrc;
                                }
                            ?> 
                            <img src="<?php echo $imgSrc ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;" alt="预览">
                            <?php } else { ?>暂无图片 <?php } ?></td>
                            <td>
                                <a href="modlist.php?id=<?php echo $list['id'] ?>&icon=<?php echo $list['icon'] ?>&name=<?php echo $list['eventname'] ?>&imgurl=<?php echo $list['imgurl']; ?> ">
                                    <button type="button" class="btn btn-secondary btn-rounded">
                                        <i class=" mdi mdi-clipboard-text-play-outline mr-1"></i>修改
                                    </button>
                                </a>
                                <a href="javascript:del(<?php echo $list['id']; ?>,'<?php echo $list['eventname']; ?>');">
                                    <button type="button" class="btn btn-danger btn-rounded">
                                        <i class=" mdi mdi-delete-empty mr-1"></i>删除
                                    </button>
                                </a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<script>
    function del(id, eventname) {
        if (confirm('您确认要删除内容为 ' + eventname + ' 的事件吗')) {
            location.href = 'dellist.php?id=' + id + '&title' + eventname;
        }
    }

</script>
<?php
include_once 'Footer.php';
?>
<!-- third party js -->
<script src="assets/js/vendor/jquery.dataTables.min.js"></script>
<script src="assets/js/vendor/dataTables.bootstrap4.js"></script>
<script src="assets/js/vendor/dataTables.responsive.min.js"></script>
<script src="assets/js/vendor/responsive.bootstrap4.min.js"></script>
<script src="assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="assets/js/vendor/buttons.bootstrap4.min.js"></script>
<script src="assets/js/vendor/buttons.html5.min.js"></script>
<script src="assets/js/vendor/buttons.flash.min.js"></script>
<script src="assets/js/vendor/buttons.print.min.js"></script>
<script src="assets/js/vendor/dataTables.keyTable.min.js"></script>
<script src="assets/js/vendor/dataTables.select.min.js"></script>
<!-- third party js ends -->
<!-- demo app -->
<script src="assets/js/pages/demo.datatable-init.js"></script>
<!-- end demo js-->
</body>
</html>