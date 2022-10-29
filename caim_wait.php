<?php 
session_start();
include('components/head.php');
include('components/top.php');

// Profile
$caim_id = $_SESSION['cid'];

$caim = $login->Caim($caim_id);

    if(!isset($_SESSION['caimwait']) || $_SESSION['caimwait']==0){ $_SESSION['caimwait']=1; }


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
<div class="page animated bounceInDown"  >
    <div class="container-fluid">
<br>
    <div class="row" >
    <div class="col box" style="position:relative;" ng-class="{'bg-warning':cStatus==1,'bg-primary text-light':cStatus==2, 'bg-success text-light':cStatus==3}">
        <h4 style="position:absolute; "><span >{{caimStatus}}</span></h4>
    <span ng-bind="CurrentDate | date:'hh:ss'" ng-init="makeTime()" style="line-height:120px; font-size:8vw; padding-left:6px; "></span>
                        <img id="Barcode128" ng-init="caim()" class="barcode float-right" >
    </div>
</div>

<div class="row">
    <div class="col box">

    <h4 class="card-title">รหัสส่งเคลม {{caimCode}}</h4>
      <p class="card-text"><strong>ชื่อลูกค้า</strong> : คุณ <?php echo $caim['fName']; ?></p>
      <p class="card-text"><strong>เบอร์โทร</strong> : <?php echo $caim['cPhone']; ?></p>
      <p class="card-text"><strong>ภาพอุปกรณ์</strong></p>       
                <div class="row">
                <div class="col-3">
                        <div class="upload-pic-wrapper">
                            <img id="imgshow2" class="img rounded " src="images/<?php echo $img_name1; ?>"
                            <?php if($img_name1!='img.jpg'){ ?>
                                onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file1; ?>','รูปสินค้า');"
                                <?php } ?>
                                >

                            </span>
                            <div class="pic-info">เครื่อง</div>
                        </div>
                    </div>
                <div class="col-3">
                        <div class="upload-pic-wrapper">
                            <img id="imgshow2" class="img rounded " src="images/<?php echo $img_name2; ?>"
                            <?php if($img_name2!='img.jpg'){ ?>
                                onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file2; ?>','อุปกรณ์ 1');"
                                <?php } ?>
                                >

                            </span>
                            <div class="pic-info">อุปกรณ์ 1</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="upload-pic-wrapper">
                            <img id="imgshow3" class="img rounded " src="images/<?php echo $img_name3; ?>"
                            <?php if($img_name3!='img.jpg'){ ?>
                                onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file3; ?>','อุปกรณ์ 2');"
                                <?php } ?>
                                >

                            </span>
                            <div class="pic-info">อุปกรณ์ 2</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="upload-pic-wrapper">
                            <img id="imgshow4" class="img rounded " src="images/<?php echo $img_name4; ?>"
                            <?php if($img_name4!='img.jpg'){ ?>
                                onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file4; ?>','อุปกรณ์ 3');"
                                <?php } ?>
                                >

                            </span>
                            <div class="pic-info">อุปกรณ์ 3</div>
                        </div>
                    </div>
                </div>
</div>
  </div>

  <div class="row">
    <div class="col box">
    <h4>รายละเอียด</h4>
      <p><?php echo $caim['tDescription']; ?></p>
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