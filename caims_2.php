<?php 
session_start();
include('components/head.php');
include('components/top.php');

// Profile
$caim_id = $_SESSION['cid'];

$caim = $login->Caim($caim_id);
if(isset($_SESSION['caimwait']) && $_SESSION['caimwait']==1){
    header("location:caim_wait.php");
  }
function checkImg($path){
    if (file_exists($path)) {
        return true;
    } else {
        return false;
    }
}




// IMG 1
$img_file1 = "1.jpg";
$path1 = "caims/".$caim_id."/".$img_file1;

if(checkImg("images/".$path1)){  
    $img_name1 = $path1;     
}else{
    $img_name1 = "img.jpg";
}

// IMG 2
$img_file2 = "2.jpg";
$path2 = "caims/".$caim_id."/".$img_file2;

if(checkImg("images/".$path2)){  
    $img_name2 = $path2;     
}else{
    $img_name2 = "img.jpg";
}

// IMG 3
$img_file3 = "3.jpg";
$path3 = "caims/".$caim_id."/".$img_file3;

if(checkImg("images/".$path3)){  
    $img_name3 = $path3;     
}else{
    $img_name3 = "img.jpg";
}

// IMG 4
$img_file4 = "4.jpg";
$path4 = "caims/".$caim_id."/".$img_file4;

if(checkImg("images/".$path4)){  
    $img_name4 = $path4;     
}else{
    $img_name4 = "img.jpg";
}

?>

<!-- Content Middle //-->
<div class="page animated bounceInDown">
    <div class="container-fluid">

          <ul id="progressbar" >
                        <li id="account"><strong>กรอกข้อมูล</strong></li>
                        <li class="active" id="personal"><strong>ถ่ายรูป</strong></li>
                        <li id="payment"><strong>ยืนยัน</strong></li>
                        <li id="confirm"><strong>รอช่าง</strong></li>
                    </ul>
        <form id="form1">
            <div class="cover progress bg-success text-light" id="progress"><i class="fas fa-check"></i></div>

                <div class="row">
                    <div class="col-12">
                        <div class="upload-pic-wrapper">
                            <img id="imgshow1" class="img rounded " src="images/<?php echo $img_name1; ?>">
                                <span class="custom-file-btn btn btn-light"><i class="fa fa-camera fa-lg"></i>
                                <?php echo "<input type=\"file\" name=\"fileToUpload1\" id=\"fileToUpload1\" class=\"custom-file-input\" onchange=\"fileCaim('fileToUpload1','{$caim_id}','{$img_file1}','imgshow1','progress');\" accept=\"image/*\" aria-describedby=\"fileHelp\" capture=\"camera\" />"; ?>
                                </span>
                            <div class="pic-info">ภาพสินค้าส่งซ่อม</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-4">
                        <div class="upload-pic-wrapper">
                            <img id="imgshow2" class="img rounded " src="images/<?php echo $img_name2; ?>"
                                onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file2; ?>','รูปสินค้า');">
                                <span class="custom-file-btn btn btn-light"><i class="fa fa-camera fa-lg"></i>
                                <?php echo "<input type=\"file\" name=\"fileToUpload2\" id=\"fileToUpload2\" class=\"custom-file-input\" onchange=\"fileCaim('fileToUpload2','{$caim_id}','{$img_file2}','imgshow2','progress');\" accept=\"image/*\" aria-describedby=\"fileHelp\" capture=\"camera\" />"; ?>
                                </span>
                            <div class="pic-info">อุปกรณ์</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="upload-pic-wrapper">
                            <img id="imgshow3" class="img rounded " src="images/<?php echo $img_name3; ?>"
                                onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file3; ?>','รูปสินค้า');">
                                <span class="custom-file-btn btn btn-light"><i class="fa fa-camera fa-lg"></i>
                                <?php echo "<input type=\"file\" name=\"fileToUpload3\" id=\"fileToUpload3\" class=\"custom-file-input\" onchange=\"fileCaim('fileToUpload3','{$caim_id}','{$img_file3}','imgshow3','progress');\" accept=\"image/*\" aria-describedby=\"fileHelp\" capture=\"camera\" />"; ?>
                                </span>
                            <div class="pic-info">อุปกรณ์</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="upload-pic-wrapper">
                            <img id="imgshow4" class="img rounded " src="images/<?php echo $img_name4; ?>"
                                onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file4; ?>','รูปสินค้า');">
                            <span class="custom-file-btn btn btn-light"><i class="fa fa-camera fa-lg"></i>
                            <?php echo "<input type=\"file\" name=\"fileToUpload4\" id=\"fileToUpload4\" class=\"custom-file-input\" onchange=\"fileCaim('fileToUpload4','{$caim_id}','{$img_file4}','imgshow4','progress');\" accept=\"image/*\" aria-describedby=\"fileHelp\" capture=\"camera\" />"; ?>
                            </span>
                            <div class="pic-info">อุปกรณ์</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body btn-center">
                        <a href="caims_3.php" class="btn btn-success">ขั้นตอนต่อไป</a>
                    </div>
                </div>
        </form>

    </div>
</div>

<!-- Content Bottom //-->
<div class="animated bounceInLeft" style="text-align:center;  align-items: center;  justify-content: center; ">
    <?php //echo nl2br(print_r($_SESSION,'r')); ?>
</div>

<!-- Footer //-->
<?php include('components/foot.php');  ?>