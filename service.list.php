<?php 
session_start();
include('components/head.php');
include('components/top.php');

if(isset($_POST)){
  extract($_POST);

  if(isset($firstName)){ $ticketHistory = $login->ticketHistoryBy($firstName,'Name'); }
  if(isset($ticketID)){ $ticketHistory = $login->ticketHistoryBy(($ticketID+1)-1,'ticketID'); }
if(isset($cPhone)){ $ticketHistory = $login->ticketHistoryBy($cPhone,'Phone'); }
  if(isset($company)){ $ticketHistory = $login->ticketHistoryBy($company,'Company'); }

}else{
  $phone = $_GET['phone'];
  $ticketHistory = $login->ticketHistory($phone);
}


// Profile

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

            <div class="box">
                <h5><i class="fas fa-id-badge"></i>&nbsp;ค้นหาด้วย ชื่อลูกค้า</h5>
                <form action="service.list.php" method="post" class="needs-validation" novalidate>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                ชื่อ
                            </div>
                        </div>
                        <input type="text" class="form-control" id="firstName" name="firstName" minlength="2"
                            pattern="^[a-zA-Zก-๏\s]+$" required>
                        <div class="input-group-append">

                            <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-search"></i>
                                ค้นหา</button>

                        </div>
                    </div>
                </form>
            </div>
            <br>

            <div class="box">
                <h5><i class="fas fa-mobile-alt"></i>&nbsp; ค้นหาด้วยเลขรับงาน</h5>
                <form action="service.list.php" method="post" class="needs-validation" novalidate>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                เลขรับงาน
                            </div>
                        </div>
                        <input type="tel" class="form-control" id="ticketID" name="ticketID" pattern="^\d{6}$" required>
                        <div class="input-group-append">

                            <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-search"></i>
                                ค้นหา</button>

                        </div>
                    </div>
                </form>
            </div>
            <br>

            <div class="box">
                <h5><i class="fas fa-mobile-alt"></i>&nbsp; ค้นหาด้วยเบอร์โทร</h5>
                <form action="service.list.php" method="post" class="needs-validation" novalidate>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                เบอร์โทร
                            </div>
                        </div>
                        <input type="tel" class="form-control" id="cPhone" name="cPhone" pattern="^\d{6}$" required>
                        <div class="input-group-append">

                            <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-search"></i>
                                ค้นหา</button>

                        </div>
                    </div>
                </form>
            </div>
            <br>

            <div class="box">
                <h5><i class="fas fa-building"></i>&nbsp; ค้นหาด้วย ชื่อบริษัท</h5>
                <form action="service.list.php" method="post" class="needs-validation" novalidate>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                บริษัท
                            </div>
                        </div>
                        <input type="text" class="form-control" id="company" name="company" minlength="6"
                            pattern="^[a-zA-Zก-๏\s]+$" required>
                        <div class="input-group-append">

                            <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-search"></i>
                                ค้นหา</button>

                        </div>
                    </div>
                </form>
            </div>
            <br>

<?php 
              $remainjob = sizeof($ticketHistory);
              if($remainjob>0){
              ?>
              <table class="table table-sm ">
                <thead>
                  <tr>
                    <th>รหัสส่งซ่อม</th><th>รายการ</th><th>สถานะ</th>    
                  </tr>
              </thead>
              <tbody>
                  <?php for($i=0;$i<sizeof($ticketHistory);$i++){ ?>
<?php
      $time = strtotime($ticketHistory[$i]['createDate']);
      $newformat = date('ymd',$time);
?>




                  <tr class="<?php echo $colors[$ticketHistory[$i]['tStatus']]; ?> press" onclick="location='ticket_detail.php?id=<?php echo $ticketHistory[$i]['ticketID']; ?>';" >
                    <td><?php echo str_pad($ticketHistory[$i]['ticketID'], 6, "0", STR_PAD_LEFT); ?></td>
                    <td><?php echo $ticketHistory[$i]['fName']; ?>  <?php echo $ticketHistory[$i]['cPhone']; ?> </td>
                    <td>
                      <?php echo $texts[$ticketHistory[$i]['tStatus']]; ?>
                    </td>
                  </tr>
                  <tr class="<?php echo $colors[$ticketHistory[$i]['tStatus']]; ?>" ><td colspan="4" class="tdtop">
                  <?php echo $ticketHistory[$i]['tDescription']; ?>
               
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