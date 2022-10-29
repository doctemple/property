<?php 
session_start();
include('components/head.php');
include('components/top.php'); 
if(isset($_SESSION['aut']) && $_SESSION['aut']==true){
  header("location:profile.php");
}
?>

    <!-- Content Top //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">
        <img src="images/logo.png" alt="Sanitation" class="logo" />
    </div>

    <!-- Content Middle //-->
    <div class="page  ">
        <div class="card">
            <div class="card-body login-card-body">
              <p class="login-box-msg">เข้าสู่ระบบ</p>
        
              <form action="api/signin.php" method="post" autocomplete="off" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="input-group mb-3">
                  <input type="hidden" id="act"  name="act" value="login">
                  <input type="text" id="idcard"  name="idcard" class="form-control" placeholder="เลขบัตรประชาชน" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                    <div class="valid-feedback">รูปแบบถูกต้อง.</div>
                    <div class="invalid-feedback">กรอกข้อมูลชื่อผู้ใช้.</div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="รหัสผ่าน" id="pwd"  name="pwd"  required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                  <div class="valid-feedback">รูปแบบถูกต้อง.</div>
                  <div class="invalid-feedback">กรอกรหัสผ่าน</div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
                    
<?php 
if(isset($_SESSION['aut']) && $_SESSION['aut']==false){
  echo '<p><div class="card bg-light card-body">การล็อกอินเข้าระบบ ไม่สำเร็จ เนื่องจาก ชื่อผู้ใช้ หรือ รหัสผ่าน อาจไม่ถูกต้อง กรุณาพยายามอีกครั้ง หรือ ติดต่อผู้ดูแลระบบ</div>';
}
?>
                  </div>
                  <!-- /.col -->
                </div>
              </form>
            </div>
            <!-- /.login-card-body -->
          </div>
    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">
        <a type="button" href="signup.php" class="btn btn-info btn-block">สมัครสมาชิก</a>
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