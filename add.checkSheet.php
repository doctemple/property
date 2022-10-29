<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}
?>
<style>
  input{ text-align:center; }
  table{ width:100%; }
  table td { padding:4px; font-size:11px;  }
</style>

    <!-- Content Top //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">
        <h5 class="text-center">ใบตรวจสุขภาพ</h5>
    </div>

<p>
    <!-- Content Middle //-->
    <div class="page  " >

    <?php 
    if(!isset($_GET['id'])){ 
      $members = $login->memberList();
      ?>
    <div class="container">
      <form action="add.checkSheet.php" method="get" >
      <hr>
              <h5>เลือกผู้เข้ารับการตรวจ</h5>
              <hr>
              <select name="id" id="id" class="w-100">
                <?php
                        for($i=0;$i<sizeof($members);$i++){
                          echo '<option value="'.$members[$i]['id'].'" >'.$members[$i]['firstName'].' '.$members[$i]['lastName'].'</option>'; 
                        }
                ?>
              </select>
              <hr>
        <input type="submit" class="btn btn-success" value=" ถัดไป ">
        <hr>
      </form>
                      </div>
    <?php }else{ ?>
      <form action="api/add.checkSheet.php" method="post" enctype="multipart/form-data"  class="needs-validation" novalidate >

      <?php $profile = $login->memberProfile($_GET['id']); ?>
      <input type="hidden" name="member" id="member" value="<?php echo $profile['id']; ?>">
        <table class="tables">
          <tbody>
          <tr>
                    <td colspan="2"><h5>ชื่อ-นามสกุล : <?php echo $profile['firstName']." ".$profile['lastName']; ?></h5></td>
                  </tr>
                  <tr>
                    <td >
                    <div class="form-group">
                      <label for="blood">กรุ๊ปเลือด</label>
              <select name="blood" id="blood" class="form-control" required>
                <option value=""  >เลือกกรุ๊ปเลือด</option>
                  <option value="A" <?php if($profile['blood']=="A"){ echo "selected"; } ?> >A</option>
                  <option value="B" <?php if($profile['blood']=="B"){ echo "selected"; } ?> >B</option>
                  <option value="AB" <?php if($profile['blood']=="AB"){ echo "selected"; } ?> >AB</option>
                  <option value="O" <?php if($profile['blood']=="O"){ echo "selected"; } ?> >O</option>
              </select>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
    </div>
                  </td>
                    <td >
                    <div class="form-group"><label for="blood">วัย</label>
                    <select name="age" id="age" class="form-control" required>
                        <option value=""  >เลือกช่วงอายุ</option>
                        <option value="1"  >ทารก(1เดือน-1ปี)</option>
                        <option value="2"  >วัยเด็ก(2ปี - 12ปี)</option>
                        <option value="3"  >วัยรุ่น(13-25ปี)</option>
                        <option value="4"  >วัยผู้ใหญ่(26-35ปี)</option>
                        <option value="5"  >วัยกลางคน(36-59ปี)</option>
                        <option value="6"  >ผู้สูงวัย(อายุ 60 ปีขึ้นไป)</option>
                    </select>
                    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
                    </td>
                  </tr>
                  <tr>
              <td width="50%"><div class="form-group"><label for="weight">น้ำหนัก (kg)</label>
              <input type="text" name="weight" id="weight"  class="form-control" value="<?php echo $profile['weight']; ?>" required >
              <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div></td>
              <td><div class="form-group"><label for="height">ความสูง (cm)</label>
              <input type="text" name="height" id="height"  class="form-control" value="<?php echo $profile['height']; ?>" required ><div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div></td>
            </tr>
            <tr class="bg-light">
              <td><div class="form-group"><label for="around_belly">วัดรอบพุง (cm)</label>
              <input type="text" name="around_belly" id="around_belly"   class="form-control" value="">
              <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div></td>
              <td><div class="form-group"><label for="bmi">ดัชนีมวลกาย (BMI)</label>
              <input type="text" name="bmi" id="bmi" class="form-control" value="<?php if($profile['height']>0){ $hh = ($profile['height']/100);  echo round($profile['weight']/($hh*$hh),2); } ?>" >
              <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div></td>
            </tr>
            <tr>
              <td><div class="form-group"><label for="blood_pressure_sys">ความดันโลหิตบีบตัว (SYS)</label>
              <input type="text" name="blood_pressure_sys" id="blood_pressure_sys" class="form-control" required >
              <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div></td>
              <td><div class="form-group"><label for="blood_pressure_dia">ความดันโลหิตคลายตัว (DIA)</label>
              <input type="text" name="blood_pressure_dia" id="blood_pressure_dia" class="form-control" required >
              <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div></td>
            </tr>
            <tr class="bg-light">
              <td><div class="form-group"><label for="pulse">ซีพจร (PULSE)</label>
              <input type="text" name="pulse" id="pulse" class="form-control" required >
              <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div></td>
              <td><div class="form-group"><label for="blood_sugar">ระดับน้ำตาลในเลือด</label>
              <input type="text" name="blood_sugar" id="blood_sugar" class="form-control" value="">
              <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div></td>
            </tr>
            <tr class="bg-light">
              <td><div class="form-group"><label for="drugAllergy">แพ้ยา</label>
              <input type="text" name="drugAllergy" id="drugAllergy" class="form-control" value="<?php echo $profile['drugAllergy']; ?>"> <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
              </td>
              <td><div class="form-group"><label for="foodAllergy">แพ้อาหาร</label>
               <input type="text" name="foodAllergy" id="foodAllergy" class="form-control" value="<?php echo $profile['foodAllergy']; ?>"> 
               <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
              </td>
            </tr>
            <tr>
              <td><div class="form-group"><label for="congenitalDisease">โรคประจำตัว</label>
              <input type="text" name="congenitalDisease" id="congenitalDisease" class="form-control" value="<?php echo $profile['congenitalDisease']; ?>">
              <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
              </td>
              <td>
              <div class="form-group"><label for="vaccine">วัคซีน</label>
              <input type="text" name="vaccine" id="vaccine" class="form-control" value="<?php echo $profile['vaccine']; ?>">
              <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
              </td>
            </tr>
            <tr>
              <td>

              </td>
              <td><div class="form-group"><label for="vaccine_covid19">วัคซีน โควิด 19</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" value="1" name="vaccine_covid19" id="yes" >
                <label class="form-check-label" for="yes">
                  ผ่าน
                </label> &nbsp;&nbsp;
                <input class="form-check-input" type="radio" value="0" name="vaccine_covid19" id="no" >
                <label class="form-check-label" for="no">
                  ไม่ผ่าน
                </label>
                </div>
                <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
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

        <input type="submit" class="btn btn-success" value="บันทึก">
      </form>
    <?php } ?>
    </div>

    <!-- Content Bottom //-->
    <div class=" "
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