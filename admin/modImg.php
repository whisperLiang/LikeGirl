<?php
session_start();
include_once 'Nav.php';

$id = $_GET['id'];
include_once 'connect.php';
$loveImg = "select * from loveImg WHERE id=$id limit 1";
$resImg = mysqli_query($connect, $loveImg);
$Imglist = mysqli_fetch_array($resImg);
?>

<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3 size_18">修改相册—— ID：<?php echo $Imglist['id'] ?></h4>

                <form class="needs-validation" action="ImgUpdaPost.php" method="post" onsubmit="return check()"
                      novalidate>
                    <div class="form-group mb-3">
                        <label for="validationCustom01">日期</label>
                        <input class="form-control col-sm-4" id="example-date" type="date" name="imgDatd" class="form-control" placeholder="日期" value="<?php echo $Imglist['imgDatd'] ?>" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="validationCustom01">图片描述</label>
                        <input name="imgText" type="text" class="form-control" placeholder="请输入图片描述" value="<?php echo $Imglist['imgText'] ?>" required>
                    </div>

                    <div class="form-group mb-3" id="img_url">
                        <label for="validationCustom01">现有图片</label>
                        <div class="mb-2">
                             <?php 
                                $imgSrc = $Imglist['imgUrl'];
                                if (strpos($imgSrc, 'http') !== 0 && strpos($imgSrc, '//') !== 0) {
                                    $imgSrc = '../' . $imgSrc;
                                }
                             ?>
                             <img src="<?php echo $imgSrc ?>" style="max-width: 100%; max-height: 300px; border-radius: 5px; box-shadow: 0 0 5px #ccc;" alt="现有图片">
                        </div>
                        <input type="hidden" name="imgUrl" value="<?php echo $Imglist['imgUrl'] ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="imgFile">上传图片 (如果上传图片，将覆盖原有图片)</label>
                        <input type="file" name="imgFile" id="imgFile" class="form-control-file">
                    </div>
                    <div class="form-group mb-3 text_right">
                        <input name="id" value="<?php echo $id ?>" type="hidden">
                        <button class="btn btn-primary" type="button" id="ImgUpdaPost">新增相册</button>
                    </div>
                </form>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>


<script>
    function check() {
        let title = document.getElementsByName('imgText')[0].value.trim();
        if (title.length == 0) {
            alert("描述不能为空");
            return false;
        }
    }


</script>
<?php
include_once 'Footer.php';
?>
</body>
</html>