<?php 
session_start();
include('components/head.php');
include('components/top.php');

// Profile
if(isset($_GET['tid'])){
    $_SESSION['tid'] = $_GET['tid'];
}
    $ticket_id = $_SESSION['tid'];



$ticket = $login->Ticket($ticket_id);

    //if(!isset($_SESSION['wait']) || $_SESSION['wait']==0){ $_SESSION['wait']=1; }


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
<div class="row">
    <div class="col box">

    <h4 class="card-title">รหัสส่งซ่อม <?php echo str_pad($ticket['ticketID'], 6, "0", STR_PAD_LEFT); ?></h4>
      <p class="card-text"><strong>ชื่อลูกค้า</strong> : คุณ <?php echo $ticket['fName']; ?></p>
      <p class="card-text"><strong>เบอร์โทร</strong> : <?php echo $ticket['cPhone']; ?></p>
      <p class="card-text"><strong>วันที่รับงาน</strong> : <?php echo $ticket['createDate']; ?></p>
      <p class="card-text"><strong>ประเภท</strong> : (<?php echo $ticket['psCode']; ?>) <?php echo $ticket['psName']; ?></p>
      <p class="card-text"><strong>ภาพละเอียด</strong></p> 
	<p class="card-text"><?php echo $ticket['tDescription']; ?></p> 

      <p class="card-text text-center"><strong>ภาพอุปกรณ์</strong></p> 

      
                <div class="row">
                <div class="col-6">
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
                <div class="col-6">
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
</div>
<div class="row">
                    <div class="col-6">
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
                    <div class="col-6">
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

          
    <?php  if($ticket['tStatus']==2){  ?>
    <div class="row">
        <div class="col box text-center"><p>&nbsp;
            <form method="post" action="api/approve.php" class="noprint" id="signature-form">
                <div id="signature"></div>
                <div>
                <p style="text-align:center; margin-top:0em">
                    <button id="reset" type="button" class="btn btn-warning">เริ่มใหม่</button>
                    <input type="submit" class="btn btn-success" value="ยืนยัน รับส่งมอบ" >
                </p>
                <p>
                    <input type="hidden" id="signature_capture" name="approval">
                </p>
                </div>
                <input type="hidden" name="tid" ng-bind="tid" value="<?php echo $_REQUEST['tid']; ?>" >
            </form>
            <h5>ลายเซ็นลูกค้า</h5>
        </div>
    </div>
        <script>

        $('#signature').jSignature();
        var $sigdiv = $('#signature');
        var datapair = $sigdiv.jSignature('getData', 'svgbase64');

        $('#signature').bind('change', function(e) {
        var data = $('#signature').jSignature('getData');
        $("#signature_capture").val(data);
        //$("#help").slideDown(300);
        });

        $('#reset').click(function(e){
        $('#signature').jSignature('clear');
        //$("#signature_capture").val('');
        //$("#help").slideUp(300);
        e.preventDefault();
        });

        </script>

 <?php } ?>

 <?php  if($ticket['tStatus']==3){  ?>
    <div class="row">
        <div class="col box text-center"><br><p>&nbsp;
            <img src="<?php echo $ticket['approval']; ?>" class="img-fluid">
            <h5>ลายเซ็นลูกค้า</h5>
        </div>
    </div>


 <?php } ?>

    </div>
</div>

<!-- Footer //-->
<?php include('components/foot.php');  ?>