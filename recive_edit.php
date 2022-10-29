<?php 
session_start();
include('components/head.php');
include('components/top.php');
$ticket_id = $_SESSION['tid'];

$ticket = $login->Ticket($ticket_id);
if(isset($_SESSION['wait']) && $_SESSION['wait']==1){
  //header("location:service_wait.php");
}
?>

<!-- Content Middle //-->
<div class="page animated bounceInDown">
    <div class="container-fluid">

<h4>แก้ไขข้อมูล</h4>
<br>
                    <form action="api/update.recive.php" method="post" class="needs-validation" novalidate>
                    <input type="hidden" name="ticketID" value="<?php echo $ticket['ticketID']; ?>" >
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                    <span class="fas fa-user"></span>&nbsp;ชื่อลูค้า
                    </div>
                  </div>
                  <input type="text" class="form-control"  id="fName"  name="fName" value="<?php echo $ticket['fName']; ?>"  required>
                </div>
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>&nbsp;เบอร์โทร
                    </div>
                  </div>
                  <input type="tel" class="form-control" id="cPhone"  name="cPhone"  value="<?php echo $ticket['cPhone']; ?>"  required>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="mb-3">
                      <label for="" class="form-label">อธิบาย</label>
                      <textarea class="form-control" id="description" name="description" rows="3" aria-label=""><?php echo $ticket['tDescription']; ?></textarea>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <div class="row">
                  <div class="col-12">
                  <hr>
                    <button type="submit" class="btn btn-primary btn-block">ปรับปรุงข้อมูล</button>
                    <hr>
                  </div>
                  <!-- /.col -->
                </div>
              </form>

        
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