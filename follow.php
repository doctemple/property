<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(isset($_SESSION['tid'])){
  //header("location:service_2.php");
}

if(isset($_SESSION['wait']) && $_SESSION['wait']==1){
  //header("location:service_wait.php");
}
?>

<!-- Content Middle //-->
<div class="page animated bounceInDown">
    <div class="container-fluid">
<h4>ติดตามงาน</h4>

<div class="box">
  <h5><i class="fas fa-id-badge"></i>&nbsp;ค้นหาด้วย ชื่อลูกค้า</h5>
<form action="service.list.php" method="post" class="needs-validation" novalidate>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                    ชื่อ
                    </div>
                  </div>
                  <input type="text" class="form-control" id="firstName"  name="firstName" minlength="2" pattern="^[a-zA-Zก-๏\s]+$"  required>
                  <div class="input-group-append">

                    <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-search"></i> ค้นหา</button>

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
                  <input type="tel" class="form-control" id="cPhone"  name="cPhone" pattern="^\d{6}$"  required>
                  <div class="input-group-append">

                    <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-search"></i> ค้นหา</button>

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
                  <input type="text" class="form-control" id="company"  name="company" minlength="6" pattern="^[a-zA-Zก-๏\s]+$"  required>
                  <div class="input-group-append">

                    <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-search"></i> ค้นหา</button>

                  </div>
                </div>
                </form>
</div>








<?php if(isset($_GET['r']) && $_GET['r']!="" && $_GET['r']==0){ ?> 
<div class="card card-body bg-warning-light">ไม่พบ เบอร์โทรนี้ ในระบบ</div>
<?php } ?>

              

        
    </div>
</div>

<!-- Content Bottom //-->
<div class="animated bounceInLeft" style="text-align:center;  align-items: center;  justify-content: center; ">
    <?php //echo nl2br(print_r($_SESSION,'r')); ?>
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

<!-- Footer //-->
<?php include('components/foot.php'); ?>