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

function task($title,$tickets,$prefix,$login){

  $colors=array("text-secondary","bg-danger-light text-danger","bg-primary-light text-primary","bg-success-light text-success");
  $icolors=array("text-secondary","ibg-danger-light","ibg-primary-light text-primary","ibg-success-light text-success");
  $texts=array(
    '<i class="fas fa-bell"></i> รอตรวจเช็ค',
    '<i class="fas fa-cog fa-spin"></i> ดำเนินการ',
    '<i class="fas fa-tools"></i> ซ่อมเสร็จ',
    '<i class="fas fa-check-circle text-success"></i> จบงาน');

  $users=array('','ผู้รับงาน',' ผู้ดำเนินการ',' ผู้ส่งมอบ');
  $fuser=array('','byUser','exUser','closeUser');

  $job = @sizeof($tickets);
              if($job>0){
                echo "<h4>{$title}</h4>";
              ?>

              <table class="table table-sm ">
                <thead>
                  <tr>
                    <th>รายการ</th><th><?php if($prefix=="B"){  echo "จำนวนเงิน"; }else{ echo "สถานะ"; } ?></th>    
                  </tr>
              </thead>
              <tbody>
                  <?php 
                  $sum = 0;
                  $num = 0;
                  for($i=0;$i<sizeof($tickets);$i++){
                      $time = strtotime($tickets[$i]['createDate']);
                      $newformat = date('ymd',$time);

                      if($tickets[$i]['tStatus']==3){ 
                      $sum += $tickets[$i]['endPrice'];
                      }else{
                        $num ++;
                      }
                    
                  ?>
                  <tr class="<?php echo $colors[$tickets[$i]['tStatus']]; ?> press" onclick="location='ticket_detail.php?id=<?php echo $tickets[$i]['ticketID']; ?>';" >
                    <td>
                        <strong><?php echo str_pad($tickets[$i]['ticketID'], 6, "0", STR_PAD_LEFT); ?></strong><br>                    
                        <?php if($tickets[$i]['company']!=""){ echo $tickets[$i]['company']."<br>"; } ?>
                        <?php if($tickets[$i]['firstName']!=""){ echo $tickets[$i]['firstName'].' '.$tickets[$i]['lastName'].' ('.$tickets[$i]['fName'].')<br>'; }else{ echo $tickets[$i]['fName']; } ?> 
                    </td>
                    <td width="30%" class="text-rigth">
                      <?php
                      if($tickets[$i]['tStatus']==3){ 
                        echo $tickets[$i]['endPrice']; 
                      }else{
                        echo $texts[$tickets[$i]['tStatus']];
                      }
                      ?>
                    </td>
                    
                  
                  </tr>
                  <tr class="collapse <?php echo $icolors[$tickets[$i]['tStatus']]; ?>" id="job<?php echo $prefix.$i; ?>" aria-expanded="true" aria-controls="collapseOne">
                  <td class="tdtop" colspan="2">
                    
                  <div class="row">
                    <div class="col">วันที่รับงาน<br><?php echo date('d/m/Y',strtotime($tickets[$i]['createDate'])); ?></div>
                    <div class="col"><?php if($tickets[$i]['tStatus']>0){ echo $users[1]."<br>".$login->fName($tickets[$i][$fuser[1]]); } ?></div>
                    <div class="col"><?php if($tickets[$i]['tStatus']>1){ echo $users[2]."<br>".$login->fName($tickets[$i][$fuser[2]]); } ?></div>
                    <div class="col"><?php if($tickets[$i]['tStatus']>2){ echo $users[3]."<br>".$login->fName($tickets[$i][$fuser[3]]); } ?></div>
                  </div>

                  <?php if($_SESSION['role']==3){ ?>
                  <div class="row">
                    <div class="col">ราคา</div>
                    <div class="col"><?php echo$tickets[$i]['firstPrice']; ?></div>
                    <div class="col"><?php echo$tickets[$i]['secondPrice']; ?></div>
                    <div class="col"><?php echo$tickets[$i]['endPrice']; ?></div>
                  </div>
                  <?php } ?>
<br>
                  <a class="bg-light btn " href="tel:<?php echo $tickets[$i]['cPhone']; ?>" ><i class="fas fa-phone"></i> <?php echo $tickets[$i]['cPhone']; ?></a>
                  <div class="card card-body">
                  <?php 
                  echo $tickets[$i]['tDescription'];
                  ?>    
                  </div>               
                    <br>&nbsp;

                    <p>
                    <?php
                    $img1 = "images/tickets/{$tickets[$i]['ticketID']}/1.jpg";
                    if(checkImg($img1)){
                      echo '<img class="miniimg rounded " src="'.$img1.'" onclick="'."imgZoom('{$img1}','รูปสินค้า');".'" >';
                    }

                    $img1 = "images/tickets/{$tickets[$i]['ticketID']}/2.jpg";
                    if(checkImg($img1)){
                      echo '<img class="miniimg rounded " src="'.$img1.'" onclick="'."imgZoom('{$img1}','รูปอุปกรณ์ 1');".'" >';
                    }

                    $img1 = "images/tickets/{$tickets[$i]['ticketID']}/3.jpg";
                    if(checkImg($img1)){
                      echo '<img class="miniimg rounded " src="'.$img1.'" onclick="'."imgZoom('{$img1}','รูปอุปกรณ์ 2');".'" >';
                    }

                    $img1 = "images/tickets/{$tickets[$i]['ticketID']}/4.jpg";
                    if(checkImg($img1)){
                      echo '<img class="miniimg rounded " src="'.$img1.'" onclick="'."imgZoom('{$img1}','รูปอุปกรณ์ 3');".'" >';
                    }
                    ?>
                  <br>

                  </td></tr>
                  <?php } ?>
                  </tbody>
                  <thead>
                  <tr>
                  <?php if($prefix=="B"){  
                    echo "<th>รวมยอด</th><th>{$sum} บาท</th>"; 
                  }else{
                    echo "<th>งานรอยืนยัน</th><th>{$num} งาน</th>"; 
                  }
                    ?>
                  </tr>
              </thead>
              </table>
              <br>
          <?php 
      }
  }


// Profile
$caimsRemain = $login->caimsRemain();
$caimsToday = $login->caimsCompleted();
?>
  <div class="page  ">
      <div class="box">
          <?php
            task("งานเคลมสินค้า",$caimsRemain,"A",$login);
          ?>
      </div>

      <div class="box">
          <?php
            task("ส่งงานแล้ว",$caimsToday,"B",$login);
          ?>
      </div>
  </div>

      <!-- Content Bottom //-->
      <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; height:10%;">

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