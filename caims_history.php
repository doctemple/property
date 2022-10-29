<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}
// Profile
$History = $login->CaimsHistory(12);
$colors=array("","bg-warning-light","bg-primary-light","bg-success-light");
$texts=array("รอ..","กำลังดำเนินการ","เสร็จแล้ว","จบงาน");
?>
    <style>

    </style>


    <!-- Content Top //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>

    <!-- Content Middle //-->
    <div class="page  ">
<p>
<div class="box">
<h4>ประวัติการเคลม 1 ปีย้อนหลัง</h4>
<br>
<?php 
              $remainjob = sizeof($History);
              if($remainjob>0){
              ?>
              <table class="table table-sm ">
                <thead>
                  <tr>
                    <th>รหัสส่งเคลม</th><th>รายการ</th><th>สถานะ</th><th></th>    
                  </tr>
              </thead>
              <tbody>
                  <?php for($i=0;$i<sizeof($History);$i++){ ?>
<?php
      $time = strtotime($History[$i]['createDate']);
      $newformat = date('ymd',$time);
?>
                  <tr class="<?php echo $colors[$History[$i]['cStatus']]; ?>" >
                    <td><?php echo $newformat.$History[$i]['caimID']; ?></td>
                    <td><?php echo $History[$i]['fName']; ?>  <?php echo $History[$i]['cPhone']; ?> </td>
                    <td>
                      <?php echo $texts[$History[$i]['cStatus']]; ?>
                    </td>
                    <td><a class="btn btn-sm btn-light" data-toggle="collapse" data-target="#jobr<?php echo $i; ?>" data-p="#jobr<?php echo $i; ?>"><i class="fas fa-angle-right"></i></a></td>
                  </tr>
                  <tr class="collapse <?php echo $colors[$History[$i]['cStatus']]; ?>" id="jobr<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne">
                  <td colspan="4">
                  <?php echo $History[$i]['tDescription']; ?>
                  <?php 
if($_SESSION['role']==3){ 
echo '<a class="btn btn-sm btn-danger float-right" style="margin-left:6px; margin-right:6px;" href="api/del.ticket.php?id='.$History[$i]['caimID'].'" >ลบ</a>';
}

if($History[$i]['cStatus']==0){ echo '<a class="btn btn-sm btn-warning float-right" href="api/ticket.status.php?s=1&id='.$History[$i]['caimID'].'" >เริ่มดำเนินการ</a>'; }else
if($History[$i]['cStatus']==1){ echo '<a class="btn btn-sm btn-primary float-right" href="api/ticket.status.php?s=2&id='.$History[$i]['caimID'].'" >เสร็จแล้ว</a>'; }else
if($History[$i]['cStatus']==2){ echo '<a class="btn btn-sm btn-success float-right" href="api/ticket.status.php?s=3&id='.$History[$i]['caimID'].'" >ลูกค้ารับกลับ</a>'; } 
?>                  
                  </td></tr>
                  <?php } ?>
                  </tbody>
              </table>

              <br>
              <?php } ?>

                  </div>
    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>

<?php include('components/foot.php'); ?>