<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}

if(isset($_GET['ye'])){
  $ye = $_GET['ye'];
}else{
  $ye = date("Y");
}


if(isset($_GET['mo'])){
  $mo = str_pad($_GET['mo'], 2, "0", STR_PAD_LEFT);
}else{
  $mo = date("m");
}


// Profile
$History = $login->History($mo,$ye);
$mos = $login->HistoryMo();
$yes = $login->HistoryYe();
$colors=array("","bg-warning-light","bg-primary-light","bg-success-light");
$texts=array("รอ..","กำลังดำเนินการ","เสร็จแล้ว","จบงาน","","","","","","ยกเลิก");



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
<form action="history.php" method="get" class="needs-validation" novalidate>
  <div class="row">
    <div class="col">
        <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <div class="input-group-text">เดือน</div>
                  </div>
                  <select name="mo" class="custom-select">
                            <?php for($i=0;$i<sizeof($mos);$i++){ 
                                  if($mos[$i]==$mo){
                                    echo '<option value="'.str_pad($mos[$i], 2, "0", STR_PAD_LEFT).'" selected>'.str_pad($mos[$i], 2, "0", STR_PAD_LEFT).'</option>'; 
                                  }else{
                                    echo '<option value="'.str_pad($mos[$i], 2, "0", STR_PAD_LEFT).'">'.str_pad($mos[$i], 2, "0", STR_PAD_LEFT).'</option>'; 
                                  }
                              } ?>
                  </select>
        </div>
    </div>
    <div class="col">
       <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <div class="input-group-text">ปี</div>
                  </div>
                  <select name="ye" class="custom-select">
                            <?php for($x=0;$x<sizeof($yes);$x++){ 
                                      if($yes[$x]==$ye){
                                        echo '<option value="'.$yes[$x].'" selected>'.$yes[$x].'</option>'; 
                                      }else{
                                        echo '<option value="'.$yes[$x].'">'.$yes[$x].'</option>'; 
                                      }
                              } ?>
                  </select>
              </div>   
    </div>
  </div>

 
              
              <button type="submit" class="btn btn-danger "><i class="fas fa-search"></i> ค้นหา</button>
              <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#other">ค้นหารูปแบบอื่น</button>
              <p>
</form>  

<div id="other" class="collapse">

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
                    <input type="text" class="form-control" id="ticketID" name="ticketID" pattern="^\d{6}$" required>
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
                            </div>
<?php 
              $remainjob = sizeof($History);
              if($remainjob>0){
              ?>
              <table class="table table-sm ">
                <thead>
                  <tr>
                  <th>วันที่</th><th>รหัสส่งซ่อม</th><th>รายการ</th><th>สถานะ</th><th></th>    
                  </tr>
              </thead>
              <tbody>
                  <?php

                  for($i=0;$i<sizeof($History);$i++){ 
                    if(isset($History[$i]['tStatus'])){
                      $tstatus = $History[$i]['tStatus'];
                      }else{
                          $tstatus = 0;
                      }
                    ?>
                  <tr class="<?php echo $colors[$tstatus]; ?> press" onclick="location='ticket_detail.php?id=<?php echo $History[$i]['ticketID']; ?>';" >
                    <td><?php if(isset($History[$i]['firstDate'])){ echo date_format(new DateTime($History[$i]['firstDate']),"d/m/y"); }else{
                      echo date_format(new DateTime($History[$i]['createDate']),"d/m/y");
                    } ?></td>                  
                    <td><?php echo str_pad($History[$i]['ticketID'], 6, "0", STR_PAD_LEFT); ?></td>
                    <td><?php echo $History[$i]['fName']; ?>  <?php echo $History[$i]['cPhone']; ?> </td>
                    <td>
                      <?php echo $texts[$tstatus]; ?>
                    </td>
                    <td>
                    <?php if($_SESSION['role']==3){ 
                      echo '<a class="btn btn-sm btn-danger float-right"  href="api/del.ticket.php?id='.$History[$i]['ticketID'].'" >ลบ</a>';
                       } ?>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
              </table>

              <br>
              <?php } ?>

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

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>

<?php include('components/foot.php'); ?>