<?php 
session_start();
include('components/head.php');
include('components/top.php');
?>
    <style>
        td:first-child {
          text-align:right;
          font-weight: bold;
          width:30%;
        }
        td{ text-align:left; }
    </style>
    <!-- Content Middle //-->
    <div class="page animated bounceInDown">
    <div class="box">
    <h5 class="text-center">สมัครสมาชิก</h5>
    <form action="api/add.member.php" method="post" enctype="multipart/form-data"  class="needs-validation" novalidate>

      <table class="table table-sm table-striped">
        <tbody>
          <tr>
            <td>เพศ</td>
            <td>
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" value="1" name="gender" id="male" >
              <label class="form-check-label" for="male">
                ชาย
              </label> &nbsp;&nbsp;
              <input class="form-check-input" type="radio" value="0" name="gender" id="female" >
              <label class="form-check-label" for="female">
                หญิง
              </label>
            </div></td>
          </tr>
          <tr>
            <td>ชื่อจริง</td>
            <td><input type="text" class="form-control" name="firstName" id="firstName"  required /></td>
          </tr>
          <tr>
            <td>นามสกุล</td>
            <td><input type="text" class="form-control" name="lastName" id="lastName"  required /></td>
          </tr>
          <tr>
            <td>อีเมล</td>
            <td><input type="text" class="form-control" name="email" id="email"   /></td>
          </tr>
          <tr>
            <td>เบอร์โทร</td>
            <td><input type="text" class="form-control" name="phone" id="phone"   required /></td>
          </tr>
		            <tr>
            <td>บริษัท</td>
            <td><input type="text" class="form-control" name="company" id="company"   /></td>
          </tr>
          <tr>
            <td>เลขผู้เสียภาษี</td>
            <td><input type="text" class="form-control" name="taxNumber" id="taxNumber"   /></td>
          </tr>
          <tr>
            <td>ที่อยู่</td>
            <td><textarea class="form-control" name="address" id="address" rows="3" ></textarea></td>
          </tr>
          <tr>
            <td>ประเภทสมาชิก</td>
            <td>
            <select class="form-control form-select" id="mtype" name="mtype">
              <option value="0">ลูกค้าทั่วไป</option>
              <option value="1">ลูกค้าบริษัท</option>
              <option value="2">ลูกค้าพิเศษ</option>
              <option value="3">ลูกค้า VIP</option>
            </select>
            </td>
          </tr>
          </tbody>
      </table>


      <div class="content text-left" style="padding:6px;">
        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
        <div class="mb-3">
          <label for="" class="form-label"></label>
          <textarea class="form-control" name="note" id="note" rows="3" aria-label=""></textarea>
        </div>
      </div>
      
    <input type="submit" class="btn btn-success" value="ยืนยันสมัครสมาชิก">



                    </form>

    </div>
      </div>
    <!-- Content Bottom //-->
    <div class="animated bounceInLeft"
        style="text-align:center;  align-items: center;  justify-content: center; ">

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