<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}
// Profile
$phone = $_GET['phone'];
$ticketHistory = $login->ticketHistory($phone);
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
<h4>ประวัติการใช้บริการ</h4>
<br>
<?php 
              $remainjob = sizeof($ticketHistory);
              if($remainjob>0){
              ?>
              <table class="table table-sm ">
                <thead>
                  <tr>
                    <th>รหัสส่งซ่อม</th><th>รายการ</th><th>สถานะ</th><th></th>    
                  </tr>
              </thead>
              <tbody>
                  <?php for($i=0;$i<sizeof($ticketHistory);$i++){ ?>
<?php
      $time = strtotime($ticketHistory[$i]['createDate']);
      $newformat = date('ymd',$time);
?>
                  <tr class="<?php echo $colors[$ticketHistory[$i]['tStatus']]; ?>" >
                    <td><?php echo $newformat.$ticketHistory[$i]['ticketID']; ?></td>
                    <td><?php echo $ticketHistory[$i]['fName']; ?>  <?php echo $ticketHistory[$i]['cPhone']; ?> </td>
                    <td>
                      <?php echo $texts[$ticketHistory[$i]['tStatus']]; ?>
                    </td>
                    <td><a class="btn btn-sm btn-light" data-toggle="collapse" data-target="#jobr<?php echo $i; ?>" data-p="#jobr<?php echo $i; ?>"><i class="fas fa-angle-right"></i></a></td>
                  </tr>
                  <tr class="collapse <?php echo $colors[$ticketHistory[$i]['tStatus']]; ?>" id="jobr<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne"><td colspan="4">
                  <?php echo $ticketHistory[$i]['tDescription']; ?>
                  <?php 
if($ticketHistory[$i]['tStatus']==0){ echo '<a class="btn btn-sm btn-warning float-right" href="api/ticket.status.php?s=1&id='.$ticketHistory[$i]['ticketID'].'" >เริ่มดำเนินการ</a>'; }else
if($ticketHistory[$i]['tStatus']==1){ echo '<a class="btn btn-sm btn-primary float-right" href="api/ticket.status.php?s=2&id='.$ticketHistory[$i]['ticketID'].'" >เสร็จแล้ว</a>'; }else
if($ticketHistory[$i]['tStatus']==2){ echo '<a class="btn btn-sm btn-success float-right" href="api/ticket.status.php?s=3&id='.$ticketHistory[$i]['ticketID'].'" >ลูกค้ารับกลับ</a>'; } 
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