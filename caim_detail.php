<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}

function checkImg($path){
  if (file_exists($path)) {
      return true;
  } else {
      return false;
  }
}


function Details($caim,$login){

  $caim_id = $caim['caimID'];
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

  $colors=array("text-secondary","bg-danger-light text-danger","bg-primary-light text-primary","bg-success-light text-success");
  $icolors=array("text-secondary","ibg-warning-light","ibg-primary-light text-primary","ibg-success-light text-success");
  $texts=array(
    '<i class="fas fa-bell"></i> รอตรวจเช็ค',
    '<i class="fas fa-cog fa-spin"></i> ดำเนินการ',
    '<i class="fas fa-tools"></i> ซ่อมเสร็จ',
    '<i class="fas fa-check-circle text-success"></i> จบงาน');

  $users=array('','ผู้รับงาน',' ผู้ดำเนินการ',' ผู้ส่งมอบ');
  $fuser=array('','byUser','exUser','closeUser');                      
  $time = strtotime($caim['createDate']);
  $newformat = date('ymd',$time);
?>
<h2>รหัสส่งเคลม : <?php echo str_pad($caim['caimID'], 6, "0", STR_PAD_LEFT); ?></h2>
              <table class="table table-sm ">
              <tbody>

                  <tr class="<?php echo $colors[$caim['cStatus']]; ?>" >
                    <td>
                    <?php if($caim['company']!=""){ echo $caim['company']."<br>"; } ?> 
                      <?php if($caim['firstName']!=""){ echo $caim['firstName'].' '.$caim['lastName'].' ('.$caim['fName'].')<br>'; }else{ echo $caim['fName']."<br>"; } ?> 
                      <a href="tel:<?php echo $caim['cPhone']; ?>" ><i class="fas fa-phone"></i> <?php echo $caim['cPhone']; ?></a>
                      
                      </td>
                    <td>
                      <?php 
                      if($caim['cStatus']==3){ 
                        echo $caim['endPrice']; 
                      }else{
                        echo $texts[$caim['cStatus']];
                      }
                      ?><br>
                      <?php if($caim['email']!=NULL){ echo '<i class="fas fa-star text-warning"></i> '.str_pad($caim['mid'], 6, "0", STR_PAD_LEFT)."<br>"; } ?> 
                      
                      <?php if($caim['company']!=""){ echo '<i class="far fa-address-card"></i> นิติบุคคล<br>'; } ?> 
                    </td>
                  </tr>
                  <tr >
                  <td  colspan="4">

                  <div class="row">
                    <div class="col"><strong>เมื่อ</strong></div>
                    <div class="col-2"><strong>โดย</strong></div>
                    <div class="col-3"><strong>ราคา</strong></div>
                  </div>

                  <div class="row">
                    <div class="col">แจ้งงาน : <?php echo date('d/m/Y H:i',strtotime($caim['createDate'])); ?></div>
                    <div class="col-2"><?php  echo $caim['fName'];  ?></div>
                    <div class="col-3">รอ..</div>
                  </div>

                 <?php if($caim['cStatus']>0){ ?>
                  <div class="row">
                    <div class="col">รับงาน : <?php echo date('d/m/Y H:i',strtotime($caim['firstDate'])); ?></div>
                    <div class="col-2"><?php  echo $login->fName($caim[$fuser[1]]);  ?></div>
                    <div class="col-3">ประเมิน : <?php echo $caim['firstPrice']; ?></div>
                  </div>
                  <?php } ?>

                  <?php if($caim['cStatus']>1){ ?>
                  <div class="row">
                    <div class="col">ดำเนินการ : <?php echo date('d/m/Y H:i',strtotime($caim['secondDate'])); ?></div>
                    <div class="col-2"><?php  echo $login->fName($caim[$fuser[2]]);  ?></div>
                    <div class="col-3">ปรับปรุง : <?php echo $caim['secondPrice']; ?></div>
                  </div>
                  <?php } ?>

                  <?php if($caim['cStatus']>2){ ?>
                  <div class="row">
                    <div class="col">งานเสร็จ : <?php echo date('d/m/Y H:i',strtotime($caim['endDate'])); ?></div>
                    <div class="col-2"><?php  echo $login->fName($caim[$fuser[3]]);  ?></div>
                    <div class="col-3">ยืนยัน : <?php echo $caim['endPrice']; ?></div>
                  </div>
                  <?php } ?>
                
             
                  <br>
                  <div class="card card-body bg-gray-light">
                    <div class="row">
                      <div class="col"><strong>ลูกค้า <i class="fa fa-comment-dots"></i></strong></div><div class="col"></div>
                    </div>
                    <div class="row">
                      <div class="col"><?php echo $caim['tDescription']; ?></div>
                    </div>
                                       
                  </div>  
                  <br>
                  <div class="card card-body bg-primary-light">
                  <form id="formnote" action="api/add.note.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $caim_id; ?>" > 
                    <div class="row">
                      <div class="col">&nbsp;</div>
                      <div class="col-3"><strong>ช่าง <i class="fa fa-comment-dots"></i></strong></div>
                    </div>
                    
                    <div class="row">
                      <div class="col">
                        <textarea   rows="1"  class="bg-primary-light" id="comment" name="note" ><?php echo $caim['Note']; ?></textarea> 
                      </div>
                    </div>

                    <div class="row">
                    <div class="col">&nbsp;</div>
                    <div class="col text-primary"> 
                      <span class="btn btn-sm btn-primary float-right" onclick="document.getElementById('formnote').submit();"><i class="fa fa-plus-circle" ></i> บันทึกโน๊ต</span>
                    </div>
                  </div>
                    </form> 
                  </div>  
                    <p>
                  <div class="row">
                    <div class="col-3">
                            <div class="upload-pic-wrapper">
                                <img id="imgshow2" class="img rounded " src="images/<?php echo $img_name1; ?>"

                                <?php if($img_name1!="img.jpg"){ ?>
                                    onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file1; ?>','รูปสินค้า');"
                                <?php  }  ?>
                                    >
                                  
                                  <?php if($img_name1=="img.jpg"){ ?>
                                    <span class="custom-file-btn btn btn-light">
                                    <i class="fa fa-camera fa-lg"></i>
                                  <?php echo "<input type=\"file\" name=\"fileToUpload1\" id=\"fileToUpload1\" class=\"custom-file-input\" onchange=\"filecaim('fileToUpload1','{$caim_id}','{$img_file1}','imgshow1','progress');\" accept=\"image/*\" aria-describedby=\"fileHelp\" capture=\"camera\" />"; ?>
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
                                    onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file2; ?>','รูปสินค้า');"
                                <?php  }  ?>
                                    
                                    >
                                    <?php if($img_name2=="img.jpg"){ ?>
                                  <span class="custom-file-btn btn btn-light"><i class="fa fa-camera fa-lg"></i>
                                  <?php echo "<input type=\"file\" name=\"fileToUpload2\" id=\"fileToUpload2\" class=\"custom-file-input\" onchange=\"filecaim('fileToUpload2','{$caim_id}','{$img_file2}','imgshow2','progress');\" accept=\"image/*\" aria-describedby=\"fileHelp\" capture=\"camera\" />"; ?>
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
                                    onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file3; ?>','รูปสินค้า');"
                                <?php  }  ?>
                                    >
                                    <?php if($img_name3=="img.jpg"){ ?>
                                    <span class="custom-file-btn btn btn-light"><i class="fa fa-camera fa-lg"></i>
                                    <?php echo "<input type=\"file\" name=\"fileToUpload3\" id=\"fileToUpload3\" class=\"custom-file-input\" onchange=\"filecaim('fileToUpload3','{$caim_id}','{$img_file3}','imgshow3','progress');\" accept=\"image/*\" aria-describedby=\"fileHelp\" capture=\"camera\" />"; ?>
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
                                    onclick="imgZoom('images/caims/<?php echo $caim_id.'/'.$img_file4; ?>','รูปสินค้า');"
                                <?php  }  ?>
                                >
                                <?php if($img_name4=="img.jpg"){ ?>
                                <span class="custom-file-btn btn btn-light"><i class="fa fa-camera fa-lg"></i>
                                <?php echo "<input type=\"file\" name=\"fileToUpload4\" id=\"fileToUpload4\" class=\"custom-file-input\" onchange=\"filecaim('fileToUpload4','{$caim_id}','{$img_file4}','imgshow4','progress');\" accept=\"image/*\" aria-describedby=\"fileHelp\" capture=\"camera\" />"; ?>
                                </span>
                                <?php }else{ ?>
                                    <span>&nbsp;</span>
                                    <?php } ?>
                            <div class="pic-info">อุปกรณ์</div>
                        </div>
                        </div>
                </div>

                <br>
<h4>ค่าใช้จ่าย</h4>
                <?php
                  if($caim['cStatus']==3){  }else{
                  ?>               
<div class="card card-body">
                  <form action="api/caim.addprice.php" method="post" class="needs-validation" novalidate>
                      <input type="hidden" name="tid" value="<?php echo $caim['caimID']; ?>" >
                      <div class="row">
                        <div class="col">
                          <input type="text" class="form-control form-control-sm" placeholder="สินค้าและบริการ" name="subject">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control form-control-sm" placeholder="ราคา" name="price">
                        </div>
                        <div class="col-2">
                          <input type="submit" class="btn btn-sm btn-danger float-right" value="เพิ่ม" >
                        </div>
                      </div>
                  </form>
                  </div>
                  <?php } ?>

                  <br>
                  <div class="card card-body">
                <?php
                $prices = $login->pricesList($caim_id);
                $size = sizeof($prices);
                $tt=0;

                if($size>0){
                   echo '<table class="table table-sm bg-light">';
                   echo "<tr><td><strong>ลำดับ</strong></td><td><strong>รายการ</strong></td><td><strong>ราคา</strong></td><td></td></tr>";
                  for($p=0;$p<$size;$p++){
                    $num = $p+1;
                    $ppp = number_format($prices[$p]['addPrice'],2);
                    echo "<tr><td>{$num}</td><td>{$prices[$p]['subject']}</td><td>{$ppp}</td><td><a href=\"api/del.price.php?tid={$caim_id}&id={$prices[$p]['id']}\"><i class=\"fa fa-window-close\" ></i></a></td></tr>";
                    $tt += $prices[$p]['addPrice'];
                  }

                  $totalpp = number_format($tt,2);


                  echo "<tr><td></td><td><strong>รวม</strong></td><td><strong>{$totalpp} บาท</strong></td><td></td></tr>";

                      echo "</table>";
                }else{ echo "ยังไม่มีรายละเอียดราคา"; $totalpp = 0.00; }
                ?>
</div>                
<br>
                  <?php
                  if($caim['cStatus']==0){  
                  ?>
                    <form action="api/caim.status.php" method="get" class="needs-validation" novalidate>
                      <input type="hidden" name="s" value="1" >
                      <input type="hidden" name="id" value="<?php echo $caim['caimID']; ?>" >
                      <div class="row">
                        <div class="col">
                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend"><div class="input-group-text ">ราคาประเมิน</div></div>
                            <input readonly type="text" class="form-control form-control-sm"  name="fprice" value="<?php echo $totalpp; ?>" required >
                            <div class="input-group-append"><div class="input-group-text">บาท</div></div>
                          </div>
                        </div>
                        <div class="col-3">
                          <input type="submit" class="btn btn-warning float-right" value="เริ่มดำเนินการ" >
                        </div>
                      </div>
                  </form>
                 <?php
                    }
                 ?>

                  <?php
                  if($caim['cStatus']==1){  
                  ?>
                    <form action="api/caim.status.php" method="get" class="needs-validation" novalidate>
                      <input type="hidden" name="s" value="2" >
                      <input type="hidden" name="id" value="<?php echo $caim['caimID']; ?>" >
                      <div class="row">
                        <div class="col">
                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend"><div class="input-group-text ">ปรับปรุงราคาใหม่</div></div>
                            <input readonly type="text" class="form-control form-control-sm"  name="sprice" value="<?php echo $totalpp; ?>" required >
                            <div class="input-group-append"><div class="input-group-text">บาท</div></div>
                          </div>
                        </div>
                        <div class="col-3">
                          <input type="submit" class="btn btn-primary float-right" value="เสร็จแล้ว" >
                        </div>
                      </div>
                  </form>
                </div>
                 <?php
                    }
                 ?>

                  <?php
                  if($caim['cStatus']==0 || $caim['cStatus']==1){  
                  ?>
                    <form action="api/caim.status.php" method="get" class="needs-validation" novalidate>
                      <input type="hidden" name="s" value="9" >
                      <input type="hidden" name="id" value="<?php echo $caim['caimID']; ?>" >
                      <div class="row">
                      <div class="col">
                        <input type="checkbox" name="confirm" value="1" required> <label for="confirm" >ลูกค้ายกเลิก</label>
                      </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <input type="submit" class="btn btn-danger" value="ยืนยัน การยกเลิกงาน" >
                        </div>
                      </div>
                  </form>
                </div>
                 <?php
                    }
                 ?>

                 <?php
                  if($caim['cStatus']==2){  
                  ?>
                    <form action="api/caim.status.php" method="get" class="needs-validation" novalidate>
                      <input type="hidden" name="s" value="3" >
                      <input type="hidden" name="id" value="<?php echo $caim['caimID']; ?>" >
                      <div class="row">
                        <div class="col">
                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend"><div class="input-group-text ">ยืนยันราคา</div></div>
                            <input readonly type="text" class="form-control form-control-sm"  name="eprice" value="<?php echo $totalpp; ?>" pattern="^\d{2}$" required >
                            <div class="input-group-append"><div class="input-group-text">บาท</div></div>
                          </div>
                        </div>
                        <div class="col-3">
                        <?php if($totalpp!=0){ ?>
                          <input type="submit" class="btn btn-success float-right" value="ส่งงาน" >
                        <?php }else{ ?>
                        <input type="button" class="btn btn-light float-right" value="ส่งงาน" disbled>
                        <?php } ?>
                        </div>
                      </div>
                  </form>
                 <?php
                    }
                 ?>

                  </td></tr>

                  </tbody>
              </table>
              <br>
          <?php 
  }


if(isset($_GET['id'])){ $cid = $_GET['id']; }else{
  header("location:caims.php");
}
// Profile
$caim = $login->caimDetail($cid);

?>
  <div class="page  ">
      <div class="box">
          <?php
            Details($caim,$login);
          ?>



      </div>

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