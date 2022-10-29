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
                        <li  id="personal"><strong>ถ่ายรูป</strong></li>
                        <li class="active" id="payment"><strong>ยืนยัน</strong></li>
                        <li id="confirm"><strong>รอช่าง</strong></li>
                    </ul>

  <div class="card">
    <div class="card-body bg-light">
    <h4 class="card-title">ยืนยันการส่งซ่อม</h4>
    <a class="edit" href="caim_edit.php"><i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล</a>
      <p class="card-text"><strong>ชื่อลูกค้า</strong> : คุณ <?php echo $caim['fName']; ?></p>
      <p class="card-text"><strong>เบอร์โทร</strong> : <?php echo $caim['cPhone']; ?></p>
      <p class="card-text"><strong>รายละเอียด</strong> : <?php echo $caim['tDescription']; ?></p>  
      <p class="card-text"><strong>ภาพอุปกรณ์</strong> <a class="edit" href="caims_2.php"><i class="fas fa-plus-circle"></i> ถ่ายรูปเพิ่ม</a></p>       
                <div class="row">
                    <div class="col-3">
                            <div class="upload-pic-wrapper">
                                <img id="imgshow2" class="img rounded " src="images/<?php echo $img_name1; ?>"
                                    onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file1; ?>','รูปสินค้า');">

                                </span>
                                <div class="pic-info">สินค้า</div>
                            </div>
                        </div>
                    <div class="col-3">
                            <div class="upload-pic-wrapper">
                                <img id="imgshow2" class="img rounded " src="images/<?php echo $img_name2; ?>"
                                    onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file2; ?>','รูปสินค้า');">

                                </span>
                                <div class="pic-info">อุปกรณ์</div>
                            </div>
                        </div>
                    <div class="col-3">
                            <div class="upload-pic-wrapper">
                                <img id="imgshow3" class="img rounded " src="images/<?php echo $img_name3; ?>"
                                    onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file3; ?>','รูปสินค้า');">

                                </span>
                                <div class="pic-info">อุปกรณ์</div>
                            </div>
                        </div>
                    <div class="col-3">
                        <div class="upload-pic-wrapper">
                            <img id="imgshow4" class="img rounded " src="images/<?php echo $img_name4; ?>"
                                onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file4; ?>','รูปสินค้า');">

                            </span>
                            <div class="pic-info">อุปกรณ์</div>
                        </div>
                        </div>
                </div>
                </div>
  </div>
<br>

                <div class="card">
                    <div class="card-body btn-center">
                        <a href="caim_wait.php" class="btn btn-success">ยืนยัน ส่งเคลม</a>
                    </div>
                </div>

                

    </div>
</div>

<!-- Content Bottom //-->
<div class="animated bounceInLeft" style="text-align:center;  align-items: center;  justify-content: center; ">
    <?php //echo nl2br(print_r($_SESSION,'r')); ?>
</div>

<!-- Footer //-->
<?php include('components/foot.php');  ?>