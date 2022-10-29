<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(isset($_SESSION['tid'])){
  //header("location:recive_2.php");
}

?>

<!-- Content Middle //-->
<div class="page animated bounceInDown">
    <div class="container-fluid">

        <ul id="progressbar" >
                        <li class="active" id="account"><strong>กรอกข้อมูล</strong></li>
                        <li id="personal"><strong>ถ่ายรูป</strong></li>
                        <li id="payment"><strong>ยืนยัน</strong></li>
                        <li id="confirm"><strong>รอช่าง</strong></li>
                    </ul>

                    <form action="api/recive.service.php" method="post" class="needs-validation" novalidate>
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                    <span class="fas fa-user"></span>&nbsp;ชื่อลูค้า
                    </div>
                  </div>
                  <input type="text" class="form-control"  id="fName"  name="fName"  required>
                </div>
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>&nbsp;เบอร์โทร
                    </div>
                  </div>
                  <input type="tel" class="form-control" id="cPhone"  name="cPhone"  required>
                </div>

                <div class="form-group">
        	<label for="psgroup" class="col-sm-4 col-md-4 control-label">ประเภท</label>
    		<div class="col-sm-7 col-md-7">

        <div class="form-check-inline btn btn-sm btn-warning">
      <label class="form-check-label" for="check1">
        <input type="radio" class="form-check-input" id="check1" name="psgroup" value="1" >โน๊ตบุค
      </label>
    </div>
    <div class="form-check-inline btn btn-sm btn-danger">
      <label class="form-check-label" for="check2">
        <input type="radio" class="form-check-input" id="check2" name="psgroup" value="2">พีซี
      </label>
    </div>
    <div class="form-check-inline btn btn-sm btn-success">
      <label class="form-check-label" for="check3">
        <input type="radio" class="form-check-input" id="check3" name="psgroup" value="3" >ปริ้นเตอร์
      </label>
    </div>


    		</div>
    	</div>

                <div class="row">
                  <div class="col-12">
                    <div class="mb-3">
                      <label for="" class="form-label">อธิบายปัญหา</label>
                      <textarea class="form-control" id="description" name="description" rows="3" aria-label=""></textarea>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <div class="row">
                  <div class="col-12">
                  <hr>
                    <button type="submit" class="btn btn-danger btn-block">ขั้นตอนต่อไป</button>
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

      $('.radioBtn a').on('click', function(){
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
    $('#'+tog).prop('value', sel);
    
    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
});

      </script>

<!-- Footer //-->
<?php include('components/foot.php'); ?>