<?php 
session_start();
if(!isset($_SESSION['aut']) || $_SESSION['aut']!=1 || $_SESSION['role']<2){
  header("location:main.php");
}
include('components/head.php');
include('components/top.php');

function checkImg($path){
  if (file_exists($path)) {
      return true;
  } else {
      return false;
  }
}


function Details($ticket,$login){

  $ticket_id = $ticket['ticketID'];
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

  $ptype=array("บริการ","สินค้า","เคลม");
  $colors=array("text-secondary","bg-danger-light text-danger","bg-primary-light text-primary","bg-success-light text-success");
  $icolors=array("text-secondary","ibg-warning-light","ibg-primary-light text-primary","ibg-success-light text-success");
  $texts=array(
    '<i class="fas fa-bell"></i> รอตรวจเช็ค',
    '<i class="fas fa-cog fa-spin"></i> ดำเนินการ',
    '<i class="fas fa-tools"></i> ซ่อมเสร็จ',
    '<i class="fas fa-check-circle text-success"></i> จบงาน');

  /*
      $caimStatus=array(
      '<i class="fas fa-exclamation"></i> รอดำเนินการ',
      '<i class="fas fa-cog fa-spin"></i> ส่งเคลม',
      '<i class="fas fa-ban"></i> ประกัน ไม่รับเคลม',
      '<i class="fas fa-certificate fa-spin text-success"></i> ประกัน รับเคลม',
      '<i class="fas fa-check-circle text-success"></i> สินค้าเคลม อยู่ที่ร้าน'
    );
    */

  $caimStatus=array(
      '<i class="fas fa-exclamation"></i>',
      '<i class="fas fa-cog fa-spin"></i>',
      '<i class="fas fa-ban  fa-spin"></i>',
      '<i class="fas fa-hourglass-half fa-spin"></i>',
      '<i class="fas fa-check-circle "></i>'
    );

  $users=array('ผู้รับแจ้ง','ผู้รับงาน',' ผู้ดำเนินการ',' ผู้ส่งมอบ');
  $fuser=array('byNotic','byUser','exUser','closeUser');                      
  $time = strtotime($ticket['createDate']);
  $newformat = date('ymd',$time);
?>

<div class="card card-body bg-gray-light h4">
    <div class="row">
        <div class="col">รหัสส่งซ่อม : <?php echo str_pad($ticket['ticketID'], 6, "0", STR_PAD_LEFT); ?></div>
        <?php if($ticket['tStatus']==2){ ?>
        <div class="col-1"><a onClick="gotoFoot()" class="text-secondary float-right"><i class="fa fa-1x fa-address-card"></i></a></div>
        <?php } ?>
        <div class="col-1"><a href="tickets.php" class="text-dark float-right"><i class="fa fa-1x fa-list"></i></a></div>
    </div>
</div>
<br>
<div class="card card-body <?php echo $colors[$ticket['tStatus']]; ?>">
    <div class="row">
        <div class="col">
        <strong>ลูกค้า</strong> : 
            <?php if($ticket['company']!=""){ echo $ticket['company']."<br>"; } ?>
            <?php if($ticket['firstName']!=""){ $cusname = $ticket['firstName'].' '.$ticket['lastName'].' ('.$ticket['fName'].')'; }else{ $cusname =  $ticket['fName']; } 
                echo $cusname;
            ?><br>
            <strong>โทร</strong> : <a href="tel:<?php echo $ticket['cPhone']; ?>"><i class="fas fa-phone"></i>
                <?php echo $ticket['cPhone']; ?></a>
            
            <?php if($ticket['psGroup']==0){ ?> 
                <br>กรุณาเลือกประเภท<br>
                <a class="btn btn-warning" href="api/update.ps.php?id=<?php echo $ticket['ticketID']; ?>&ps=1">โน๊ตบุค</a> 
                <a class="btn btn-primary" href="api/update.ps.php?id=<?php echo $ticket['ticketID']; ?>&ps=2">พีซี</a> 
                <a class="btn btn-success" href="api/update.ps.php?id=<?php echo $ticket['ticketID']; ?>&ps=3">ปริ้นเตอร์</a>
            <?php }else{ ?>
                <p class="card-text"><strong>ประเภท</strong> : (<?php echo $ticket['psCode']; ?>) <?php echo $ticket['psName']; ?></p>
            <?php } ?>
        </div>
        <div class="col text-right">

            <?php 
                      if($ticket['tStatus']==3){ 
                        echo $ticket['endPrice']; 
                      }else{
                        echo $texts[$ticket['tStatus']];
                      }
                      ?><br>
            <?php if($ticket['email']!=NULL){ echo '<i class="fas fa-star text-warning"></i> '.str_pad($ticket['mid'], 6, "0", STR_PAD_LEFT)."<br>"; } ?>

            <?php if($ticket['company']!=""){ echo '<i class="far fa-address-card"></i> นิติบุคคล<br>'; } ?>
        </div>
    </div>
</div>
<br>

<div class="card card-body " style="font-size:0.7em;">
    <div class="row bg-light">
        <div class="col"><span
                class="text-secondary">เวลาแจ้งงาน</span><br><?php echo date('d/m/y H:i',strtotime($ticket['createDate'])); ?>
        </div>
        <div class="col-4"><span class="text-secondary">ผู้รับแจ้ง</span><br><?php  echo $login->fName($ticket[$fuser[0]]);  ?></div>
        <div class="col-3"><span class="text-secondary">สถานะ</span><br>รอ..</div>
    </div>

    <?php if($ticket['tStatus']>0){ ?>
    <div class="row">
        <div class="col"><span
                class="text-secondary">เวลารับงาน</span><br><?php echo date('d/m/y H:i',strtotime($ticket['firstDate'])); ?>
        </div>
        <div class="col-4"><span
                class="text-secondary">ผู้รับงาน</span><br><?php  echo $login->fName($ticket[$fuser[1]]);  ?></div>
        <div class="col-3"><span class="text-secondary">ประเมิน</span><br><?php echo $ticket['firstPrice']; ?></div>
    </div>
    <?php } ?>

    <?php if($ticket['tStatus']>1){ ?>
    <div class="row bg-light">
        <div class="col"><span
                class="text-secondary">เวลาดำเนินการ</span><br><?php echo date('d/m/y H:i',strtotime($ticket['secondDate'])); ?>
        </div>
        <div class="col-4"><span
                class="text-secondary">ดำเนินการโดย</span><br><?php  echo $login->fName($ticket[$fuser[2]]);  ?></div>
        <div class="col-3"><span class="text-secondary">ปรับปรุง</span><br><?php echo $ticket['secondPrice']; ?></div>
    </div>
    <?php } ?>

    <?php if($ticket['tStatus']>2){ ?>
    <div class="row">
        <div class="col"><span
                class="text-secondary">เวลางานเสร็จ</span><br><?php echo date('d/m/y H:i',strtotime($ticket['endDate'])); ?>
        </div>
        <div class="col-4"><span
                class="text-secondary">ยืนยันโดย</span><br><?php  echo $login->fName($ticket[$fuser[3]]);  ?></div>
        <div class="col-3"><span class="text-secondary">ส่งงาน</span><br><?php echo $ticket['endPrice']; ?></div>
    </div>
    <?php } ?>
</div>

<br>
<div class="card card-body bg-gray-light">
    <div class="row">
        <div class="col"><strong>ลูกค้า <i class="fa fa-comment-dots"></i></strong></div>
        <div class="col"></div>
    </div>
    <div class="row">
        <div class="col"><?php echo $ticket['tDescription']; ?></div>
    </div>

</div>
<br>
<div class="card card-body bg-primary-light">
    <form id="formnote" action="api/add.note.php" method="post">
        <input type="hidden" name="id" value="<?php echo $ticket_id; ?>">
        <div class="row">
            <div class="col">&nbsp;</div>
            <div class="col-3"><strong>ช่าง <i class="fa fa-comment-dots"></i></strong></div>
        </div>

        <div class="row">
            <div class="col">
                <textarea rows="1" class="bg-primary-light" id="comment"
                    name="note"><?php echo $ticket['Note']; ?></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col">&nbsp;</div>
            <div class="col text-primary">
                <span class="btn btn-sm btn-primary float-right"
                    onclick="document.getElementById('formnote').submit();"><i class="fa fa-plus-circle"></i>
                    บันทึกโน๊ต</span>
            </div>
        </div>
    </form>
</div>
<p>
    
<span id="progress" class="alert alert-success cover" style="display:none; margin:4px;"></span>

<div class="row">
    <div class="col-3">
        <div class="upload-pic-wrapper">
            <img id="imgshow1" class="img rounded " src="images/<?php echo $img_name1; ?>"
                <?php if($img_name1!="img.jpg"){ ?>
                onclick="imgZoom('images/tickets/<?php echo $ticket_id.'/'.$img_file1; ?>','รูปสินค้า');" <?php  }  ?>>

            <?php if($img_name1=="img.jpg"){ ?>
            <span class="custom-file-btn btn btn-light">
                <i class="fa fa-camera fa-lg"></i>
                <?php echo "<input type=\"file\" name=\"fileToUpload1\" id=\"fileToUpload1\" class=\"custom-file-input\" onchange=\"fileTicket('fileToUpload1','{$ticket_id}','{$img_file1}','imgshow1','progress');\" accept=\"image/*\" aria-describedby=\"fileHelp\" capture=\"camera\" />"; ?>
            </span>
            <?php }else{ ?>
            <span>&nbsp;</span>
            <?php } ?>
            <div class="pic-info">สินค้า</div>
        </div>
    </div>
    <div class="col-3">
        <div class="upload-pic-wrapper">
            <img id="imgshow2" class="img rounded " src="images/<?php echo $img_name2; ?>"
                <?php if($img_name2!="img.jpg"){ ?>
                onclick="imgZoom('images/tickets/<?php echo $ticket_id.'/'.$img_file2; ?>','รูปสินค้า');" <?php  }  ?>>
            <?php if($img_name2=="img.jpg"){ ?>
            <span class="custom-file-btn btn btn-light"><i class="fa fa-camera fa-lg"></i>
                <?php echo "<input type=\"file\" name=\"fileToUpload2\" id=\"fileToUpload2\" class=\"custom-file-input\" onchange=\"fileTicket('fileToUpload2','{$ticket_id}','{$img_file2}','imgshow2','progress');\" accept=\"image/*\" aria-describedby=\"fileHelp\" capture=\"camera\" />"; ?>
            </span>
            <?php }else{ ?>
            <span>&nbsp;</span>
            <?php } ?>
            <div class="pic-info">อุปกรณ์</div>
        </div>
    </div>
    <div class="col-3">
        <div class="upload-pic-wrapper">
            <img id="imgshow3" class="img rounded " src="images/<?php echo $img_name3; ?>"
                <?php if($img_name3!="img.jpg"){ ?>
                onclick="imgZoom('images/tickets/<?php echo $ticket_id.'/'.$img_file3; ?>','รูปสินค้า');" <?php  }  ?>>
            <?php if($img_name3=="img.jpg"){ ?>
            <span class="custom-file-btn btn btn-light"><i class="fa fa-camera fa-lg"></i>
                <?php echo "<input type=\"file\" name=\"fileToUpload3\" id=\"fileToUpload3\" class=\"custom-file-input\" onchange=\"fileTicket('fileToUpload3','{$ticket_id}','{$img_file3}','imgshow3','progress');\" accept=\"image/*\" aria-describedby=\"fileHelp\" capture=\"camera\" />"; ?>
            </span>
            <?php }else{ ?>
            <span>&nbsp;</span>
            <?php } ?>
            <div class="pic-info">อุปกรณ์</div>
        </div>
    </div>
    <div class="col-3">
        <div class="upload-pic-wrapper">
            <img id="imgshow4" class="img rounded " src="images/<?php echo $img_name4; ?>"
                <?php if($img_name4!="img.jpg"){ ?>
                onclick="imgZoom('images/tickets/<?php echo $ticket_id.'/'.$img_file4; ?>','รูปสินค้า');" <?php  }  ?>>
            <?php if($img_name4=="img.jpg"){ ?>
            <span class="custom-file-btn btn btn-light"><i class="fa fa-camera fa-lg"></i>
                <?php echo "<input type=\"file\" name=\"fileToUpload4\" id=\"fileToUpload4\" class=\"custom-file-input\" onchange=\"fileTicket('fileToUpload4','{$ticket_id}','{$img_file4}','imgshow4','progress');\" accept=\"image/*\" aria-describedby=\"fileHelp\" capture=\"camera\" />"; ?>
            </span>
            <?php }else{ ?>
            <span>&nbsp;</span>
            <?php } ?>
            <div class="pic-info">อุปกรณ์</div>
        </div>
    </div>
</div>

<br>
<h4>รายการ</h4>
<?php
if($ticket['tStatus']==3){  }else{
?>

<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">
    <i class="fas fa-plus"></i> เพิ่ม
</button>
<br>



<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="api/ticket.addprice.php" method="post" class="needs-validation" novalidate>
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">เพิ่มรายการ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">


                    <input type="hidden" name="tid" value="<?php echo $ticket['ticketID']; ?>">
                    <input type="hidden" name="ts" value="<?php echo $ticket['tStatus']; ?>">
                    <input type="hidden" name="uid" value="<?php echo $_SESSION['u']; ?>">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">ประเภท</div>
                        </div>
                        <select name="pType" class="custom-select">
                            <option value="0">บริการ</option>
                            <option value="1">สินค้า</option>
                            <option value="2">เคลม</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">สินค้าและบริการ</div>
                        </div>
                        <input type="text" class="form-control" name="subject">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">จำนวนเงิน</div>
                        </div>
                        <input type="text" class="form-control" name="price" required>
                    </div>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger "><i class="fas fa-plus"></i> เพิ่ม</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php } ?>

<br>
<div class="card card-body">
    <?php
                $prices = $login->pricesList($ticket_id);
                $size = sizeof($prices);
                $tt = 0;
                if($size>0){
                   echo '<table class="table table-sm bg-light">';
                   echo "<tr><td><strong>ลำดับ</strong></td><td><strong>ประเภท</strong></td><td><strong>รายการ</strong></td><td><strong>ราคา</strong></td><td></td></tr>";
                  for($p=0;$p<$size;$p++){
                    $delb = "";
                    $caimb = "";
                    $num = $p+1;
                    $ppp = number_format($prices[$p]['addPrice'],2);
                    if($ticket['tStatus']!=3){  

                      if($prices[$p]['sid']==2){
                        $caimb .= "<a class=\"btn btn-sm bg-warning\" data-toggle=\"modal\" data-target=\"#myProgress{$prices[$p]['id']}\" >{$caimStatus[$prices[$p]['pid']]}</a>";

 ?>
    <!-- The Modal -->
    <div class="modal" id="myProgress<?php echo $prices[$p]['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="api/caim.status.php?tid=<?php echo $ticket['ticketID']; ?>" method="post"
                    class="needs-validation" novalidate>
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">สถานะงานเคลม</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <h4><?php echo $prices[$p]['subject']; ?></h4>
                        <input type="hidden" name="tid" value="<?php echo $ticket['ticketID']; ?>">
                        <input type="hidden" name="id" value="<?php echo $prices[$p]['id']; ?>">
                        <input type="hidden" name="ts" value="<?php echo $ticket['tStatus']; ?>">
                        <input type="hidden" name="uid" value="<?php echo $_SESSION['u']; ?>">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">สถานะ</div>
                            </div>
                            <select name="pid" class="custom-select">
                                <option value="0">เลือกสถานะ</option>
                                <option value="0" <?php if($prices[$p]['pid']==0){ echo " selected"; } ?>>รอดำเนินการ
                                </option>
                                <option value="1" <?php if($prices[$p]['pid']==1){ echo " selected"; } ?>>ส่งเคลมแล้ว
                                </option>
                                <option value="2" <?php if($prices[$p]['pid']==2){ echo " selected"; } ?>>ประกัน
                                    ไม่รับเคลม</option>
                                <option value="3" <?php if($prices[$p]['pid']==3){ echo " selected"; } ?>>ประกัน
                                    รับเคลมแล้ว</option>
                                <option value="4" <?php if($prices[$p]['pid']==4){ echo " selected"; } ?>>สินค้าเคลม
                                    อยู่ที่ร้านแล้ว</option>
                            </select>
                        </div>
                        <h5>การปรับล่าสุด</h5>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">เมื่อ</div>
                            </div>
                            <input type="text" readonly class="form-control"
                                value="<?php if($prices[$p]['progressDate']==""){ echo $prices[$p]['AddTime']; }else{ echo $prices[$p]['progressDate']; } ?>">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">โดย </div>
                            </div>
                            <input type="text" readonly class="form-control"
                                value="<?php if($prices[$p]['progressBy']==""){ $pby = $prices[$p]['addBy']; }else{ $pby = $prices[$p]['progressBy']; } echo $login->Fname($pby); ?>">
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger "> ปรับปรุง สถานะ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
                      }else{
                        $caimb .= "<a class=\"btn btn-sm bg-light\" ><i class=\"fa fa-ellipsis-v\" ></i></a>";
                      }

                      $delb .= "&nbsp;<a class=\"btn btn-sm bg-primary text-light\" href=\"api/del.price.php?tid={$ticket_id}&id={$prices[$p]['id']}\"><i class=\"fa fa-window-close\" ></i></a>";
                    }else{
                      $delb = "";
                    }
                    echo "<tr><td>{$num}</td><td>{$caimb} {$ptype[$prices[$p]['sid']]}</td><td>{$prices[$p]['subject']}</td><td>{$ppp}</td><td>{$delb}</td></tr>";
                  }

                  $tt += $login->totalPay($ticket_id);
                  $totalpp = number_format($tt,2);
                  $pledge = $ticket['pledge'];
                  if($pledge==""){ $pledge=0; }

                  $xxx = $tt - $ticket['pledge'];


                  echo "<tr><td></td><td><strong>รวม</strong></td><td><strong>{$totalpp} บาท</strong></td><td></td></tr>";

                      echo "</table>";
                }else{ echo "ยังไม่มีรายละเอียด"; $totalpp = 0; $pledge = 0; }
                ?>
</div>
<br>
<?php
if($ticket['tStatus']==0){  
?>
<form action="api/ticket.status.php" method="get" class="needs-validation" novalidate>
    <input type="hidden" name="s" value="1">
    <input type="hidden" name="id" value="<?php echo $ticket['ticketID']; ?>">
    <div class="row">
        <div class="col">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text ">ราคาประเมิน</div>
                </div>
                <input readonly type="text" class="form-control form-control-sm" name="fprice"
                    value="<?php echo $tt; ?>" required>
                <div class="input-group-append">
                    <div class="input-group-text">บาท</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text ">วางมัดจำแล้ว</div>
                </div>
                <input type="text" class="form-control form-control-sm" name="pledge" value="">
                <div class="input-group-append">
                    <div class="input-group-text">บาท</div>
                </div>
            </div>
            <br>
            <input type="submit" class="btn btn-warning float-right" value="เริ่มดำเนินการ">
        </div>
    </div>
</form>

<hr>
<form action="api/ticket.status.php" method="get" class="needs-validation" novalidate>
    <input type="hidden" name="s" value="2">
    <input type="hidden" name="id" value="<?php echo $ticket['ticketID']; ?>">
    <input type="submit" class="btn btn-primary float-right" value="ปรับเป็นสถานะเสร็จแล้ว">
</form>
<p>&nbsp;</p>
<?php
}
?>

<?php
if($ticket['tStatus']==1){  
?>
<form action="api/ticket.status.php" method="get" class="needs-validation" novalidate>
    <input type="hidden" name="s" value="2">
    <input type="hidden" name="id" value="<?php echo $ticket['ticketID']; ?>">
    <div class="row">
        <div class="col">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text ">ปรับปรุงราคาใหม่</div>
                </div>
                <input readonly type="text" class="form-control form-control-sm" name="sprice"
                    value="<?php echo $tt; ?>" required>
                <div class="input-group-append">
                    <div class="input-group-text">บาท</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text ">วางมัดจำแล้ว</div>
                </div>
                <input type="text" <?php if($pledge>0){ echo "readonly"; } ?> class="form-control form-control-sm"
                    name="pledge" value="<?php echo $pledge; ?>">
                <div class="input-group-append">
                    <div class="input-group-text">บาท</div>
                </div>
            </div>
        </div>
    </div>
    <?php if($pledge>0){ ?>
    <div class="row">
        <div class="col">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text ">ยอดคงเหลือ</div>
                </div>
                <input type="text" readonly class="form-control form-control-sm" name="xxx"
                    value="<?php echo $xxx;  ?>">
                <div class="input-group-append">
                    <div class="input-group-text">บาท</div>
                </div>
            </div>

        </div>
    </div>
    <?php } ?>
    <br>
    <input type="submit" class="btn btn-primary float-right" value="เสร็จแล้ว">
</form>
</div>
<?php
}
?>

<?php
if($ticket['tStatus']==0 || $ticket['tStatus']==1){  
?>
<form action="api/ticket.status.php" method="get" class="needs-validation" novalidate>
    <input type="hidden" name="s" value="9">
    <input type="hidden" name="id" value="<?php echo $ticket['ticketID']; ?>">
    <div class="row">
        <div class="col">
            <input type="checkbox" name="confirm" value="1" required> <label for="confirm">ลูกค้ายกเลิก</label>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <input type="submit" class="btn btn-danger" value="ยืนยัน การยกเลิกงาน">
        </div>
    </div>
</form>
</div>
<p>&nbsp;</p>
<?php
}
?>

<?php
if($ticket['tStatus']==2){  
?>
<form action="api/ticket.status.php" method="post" class="needs-validation" novalidate>
    <input type="hidden" name="s" value="3">
    <input type="hidden" name="id" value="<?php echo $ticket['ticketID']; ?>">
    <input type="hidden" name="tid" value="<?php echo $ticket['ticketID']; ?>">
    <div class="row">
        <div class="col">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text ">ยืนยันราคา</div>
                </div>
                <input readonly type="text" class="form-control form-control-sm" name="eprice"
                    value="<?php echo $tt; ?>" pattern="^\d{2}$" required>
                <div class="input-group-append">
                    <div class="input-group-text">บาท</div>
                </div>
            </div>
            <?php if($pledge>0){ ?>
            <div class="row">
                <div class="col">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text ">วางมัดจำแล้ว</div>
                        </div>
                        <input type="text" <?php if($pledge>0){ echo "readonly"; } ?>
                            class="form-control form-control-sm" name="pledge" value="<?php echo $pledge; ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">บาท</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text ">ยอดคงเหลือ</div>
                        </div>
                        <input type="text" readonly class="form-control form-control-sm" name="xxx"
                            value="<?php echo $xxx;  ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">บาท</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <br>


            <?php  if($ticket['tStatus']==2){  ?>
                <a id="foot" ></a>
    <div class="row">
        <div class="col box text-center"><p><h5>ลูกค้ารับมอบงาน</h5>

                <div id="signature"></div>
                <div>
                <p>
                    <input type="hidden" id="signature_capture" name="approval">
                </p>
                </div>

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


        </script>

 <?php } ?>
 <div class="row">
        <div class="col box text-center">
 <input type="submit" class="btn btn-success" value="ส่งมอบงาน" <?php if($tt==0){ echo " disabled"; } ?>>
    </div>
    </div>
        </div>
    </div>
</form>
<?php
}
?>

<?php  if($ticket['tStatus']==3){  ?>
    
    <div class="row" >
        <div class="col box text-center"><br><p>&nbsp;
            <img src="<?php echo $ticket['approval']; ?>" class="img-fluid">
            <h5>ลายเซ็นลูกค้า</h5>
            <h5>(คุณ <?php echo $cusname; ?>)</h5>
        </div>
    </div>
 <?php } ?>

<br>
<?php 
  }


if(isset($_GET['id'])){ $tid = $_GET['id']; }else{
  header("location:tickets.php");
}
// Profile
$ticket = $login->TicketDetail($tid);
?>
<div class="page  ">
    <?php Details($ticket,$login); ?>
</div>



<script>
// Disable form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

</script>

<?php include('components/foot.php'); ?>