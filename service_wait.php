<?php 
session_start();
include('components/head.php');
include('components/top.php');

// Profile
$ticket_id = $_SESSION['tid'];

$ticket = $login->Ticket($ticket_id);

    if(!isset($_SESSION['wait']) || $_SESSION['wait']==0){ $_SESSION['wait']=1; }


function checkImg($path){
    if (file_exists($path)) {
        return true;
    } else {
        return false;
    }
}


// IMG 1
$img_file1 = "1.jpg";
$path1 = "tickets/".$ticket_id."/".$img_file1;

if(checkImg("images/".$path1)){  
    $img_name1 = $path1;     
}else{
    $img_name1 = "img.jpg";
}

// IMG 2
$img_file2 = "2.jpg";
$path2 = "tickets/".$ticket_id."/".$img_file2;

if(checkImg("images/".$path2)){  
    $img_name2 = $path2;     
}else{
    $img_name2 = "img.jpg";
}

// IMG 3
$img_file3 = "3.jpg";
$path3 = "tickets/".$ticket_id."/".$img_file3;

if(checkImg("images/".$path3)){  
    $img_name3 = $path3;     
}else{
    $img_name3 = "img.jpg";
}

// IMG 4
$img_file4 = "4.jpg";
$path4 = "tickets/".$ticket_id."/".$img_file4;

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
    <div class="col box" style="position:relative;" ng-class="{'bg-warning':tstatus==1,'bg-primary text-light':tstatus==2, 'bg-success text-light':tstatus==3}">
        <h4 style="position:absolute; "><span >{{jobStatus}}</span></h4>
    <span ng-bind="CurrentDate | date:'hh:ss'" ng-init="makeTime()" style="line-height:120px; font-size:8vw; padding-left:6px; "></span>
                        <img id="Barcode128" ng-init="ticket()" class="barcode float-right" >
    </div>
</div>

<div class="row">
    <div class="col box">

    <h4 class="card-title">รหัสส่งซ่อม <?php echo str_pad($ticket['ticketID'], 6, "0", STR_PAD_LEFT); ?></h4>
      <p class="card-text"><strong>ชื่อลูกค้า</strong> : คุณ <?php echo $ticket['fName']; ?></p>
      <p class="card-text"><strong>เบอร์โทร</strong> : <?php echo $ticket['cPhone']; ?></p>
      <p class="card-text"><strong>ภาพอุปกรณ์</strong></p>       
                <div class="row">
                <div class="col-3">
                        <div class="upload-pic-wrapper">
                            <img id="imgshow2" class="img rounded " src="images/<?php echo $img_name1; ?>"
                            <?php if($img_name1!='img.jpg'){ ?>
                                onclick="imgZoom('images/tickets/<?php echo $ticket_id.'/'.$img_file1; ?>','รูปสินค้า');"
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
                                onclick="imgZoom('images/tickets/<?php echo $ticket_id.'/'.$img_file2; ?>','อุปกรณ์ 1');"
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
                                onclick="imgZoom('images/tickets/<?php echo $ticket_id.'/'.$img_file3; ?>','อุปกรณ์ 2');"
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
                                onclick="imgZoom('images/tickets/<?php echo $ticket_id.'/'.$img_file4; ?>','อุปกรณ์ 3');"
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
      <p><?php echo $ticket['tDescription']; ?></p>
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