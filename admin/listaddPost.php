<?php
session_start();

$name = htmlspecialchars(trim($_POST['eventname']),ENT_QUOTES);
$file = $_SERVER['PHP_SELF'];

// Handle file upload
if (isset($_FILES['imgFile']) && $_FILES['imgFile']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../upload/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $fileTmpPath = $_FILES['imgFile']['tmp_name'];
    $fileName = $_FILES['imgFile']['name'];
    $fileSize = $_FILES['imgFile']['size'];
    $fileType = $_FILES['imgFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg', 'webp');
    if (in_array($fileExtension, $allowedfileExtensions)) {
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $dest_path = $uploadDir . $newFileName;
        
        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $img = 'upload/' . $newFileName; // Relative path for frontend
        } else {
            echo "上传文件失败";
            exit;
        }
    } else {
        echo "不支持的文件格式";
        exit;
    }
} elseif (isset($_POST['img']) && $_POST['img'] !== '') {
    $img = htmlspecialchars($_POST['img'],ENT_QUOTES);
} else {
    $img = 0;
}

if ($_POST['icon'] == 1) {
    $icon = 1;
} else {
    $icon = 0;
}

include_once 'connect.php';

if (isset($_SESSION['loginadmin']) && $_SESSION['loginadmin'] <> '') {
    $charu = "insert into lovelist (eventname,icon,imgurl) values ('$name','$icon','$img')";
    $result = mysqli_query($connect, $charu);
    if ($result) {
        echo "1";
    } else {
        echo "0";
    }
} else {
    echo "<script>alert('非法操作，行为已记录');location.href = 'warning.php?route=$file';</script>";
}
