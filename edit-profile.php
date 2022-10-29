<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}
// Profile
$profile = $login->memberProfile($_SESSION['u']);
?>
    <style>
        td:first-child {
          text-align:right;
          font-weight: bold;
          width:30%;
        }
        td{ text-align:left; }
    </style>

    <!-- Content Top //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">
        <h5 class="text-center">ปรับปรุงข้อมูลใหม่</h5>
    </div>

<p>
    <!-- Content Middle //-->
    <div class="page animated bounceInDown">
    <form action="api/update.profile.php" method="post" enctype="multipart/form-data"  >
      <nav class="w-100">
        <div class="nav nav-tabs" id="member-tab" role="tablist">
          <a class="nav-item nav-link active" id="member-desc-tab" data-toggle="tab" href="#member-desc" role="tab" aria-controls="member-desc" aria-selected="true">ข้อมูลทั่วไป</a>
          <a class="nav-item nav-link" id="member-comments-tab" data-toggle="tab" href="#member-comments" role="tab" aria-controls="member-comments" aria-selected="false">ข้อมูลสุขภาพ</a>
        </div>
      </nav>
      <div class="tab-content p-3" id="nav-tabContent">
        <div class="tab-pane fade active show" id="member-desc" role="tabpanel" aria-labelledby="member-desc-tab">


      <input type="hidden" name="id" id="id" value="<?php echo $profile['id']; ?>">
      <table class="table table-sm table-striped">
        <tbody>
          <tr>
            <td>เพศ</td>
            <td>
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" value="1" name="gender" id="male" <?php if($profile['gender']==1){ echo "checked"; }?> >
              <label class="form-check-label" for="male">
                ชาย
              </label> &nbsp;&nbsp;
              <input class="form-check-input" type="radio" value="0" name="gender" id="female" <?php if($profile['gender']==0){ echo "checked"; }?>>
              <label class="form-check-label" for="female">
                หญิง
              </label>
            </div></td>
          </tr>
          <tr>
            <td>ชื่อจริง</td>
            <td><input type="text" class="form-control" name="firstName" id="firstName"  value="<?php echo $profile['firstName']; ?>" /></td>
          </tr>
          <tr>
            <td>นามสกุล</td>
            <td><input type="text" class="form-control" name="lastName" id="lastName"  value="<?php echo $profile['lastName']; ?>" /></td>
          </tr>
          <tr>
            <td>ชื่อเล่น</td>
            <td><input type="text" class="form-control" name="nickName" id="nickName"  value="<?php echo $profile['nickName']; ?>" /></td>
          </tr>
          <tr>
            <td>เลขบัตรประชาชน</td>
            <td><input type="text" class="form-control" name="idcard" id="idcard"  value="<?php echo $profile['idcard']; ?>" /></td>
          </tr>
          <tr>
            <td>อีเมล</td>
            <td><input type="text" class="form-control" name="email" id="email"  value="<?php echo $profile['email']; ?>" /></td>
          </tr>
          <tr>
            <td>เบอร์โทร</td>
            <td><input type="text" class="form-control" name="phone" id="phone"  value="<?php echo $profile['phone']; ?>"  /></td>
          </tr>
          <tr>
            <td>วันเกิด</td>
            <td><input type="text" class="form-control" name="birth" id="birth"  value="<?php echo date('d-m-Y',strtotime($profile['birth'])); ?>" placeholder="วัน-เดือน-ปี" /></td>
          </tr>
          <tr>
            <td>อาชีพ</td>
            <td><select name="occupation" id="occupation">
              <?php
            $occ =array('ไม่ระบุ','พนักงาน บริษัทเอกชน','เกษรตกร','เจ้าของกิจการ','รับจ้างทั่วไป','ข้าราชการ','นักบวช','นักลงทุน','รัฐวิสาหกิจ');
                      for($i=0;$i<sizeof($occ);$i++){
                        echo '<option value="'.$i.'"  ';
                        if($profile['occupation']==$i){ echo "selected"; }
                        echo '>'.$occ[$i].'</option>'; 
                      }
               ?>
              
            </select></td>
          </tr>
          </tbody>
      </table>
      <div class="content text-left" style="padding:6px;">
        <strong><i class="fas fa-map-marker-alt mr-1"></i> ที่อยู่</strong>
          <div class="mb-3">
            <label for="" class="form-label"></label>
            <textarea class="form-control" name="address" id="address" rows="3" aria-label=""><?php echo htmlentities($profile['address']); ?></textarea>
          </div>
        <hr>
      </div>

    </div>
    <div class="tab-pane fade" id="member-comments" role="tabpanel" aria-labelledby="member-comments-tab"> 

      <table class="table table-sm table-striped">
        <tbody>
           <tr>
            <td>โรคประจำตัว</td>
            <td>
            <input type="text" name="congenitalDisease" id="congenitalDisease" class="form-control" value="<?php echo $profile['congenitalDisease']; ?>">
            </td>
          </tr>
          <tr>
            <td>กร๊ปเลือด</td>
            <td><select name="blood" id="blood">
                <option value="A" <?php if($profile['blood']=="A"){ echo "selected"; } ?> >A</option>
                <option value="B" <?php if($profile['blood']=="B"){ echo "selected"; } ?> >B</option>
                <option value="AB" <?php if($profile['blood']=="AB"){ echo "selected"; } ?> >AB</option>
                <option value="O" <?php if($profile['blood']=="O"){ echo "selected"; } ?> >O</option>
            </select></td>
          </tr>
          <tr>
            <td>แพ้ยา</td>
            <td>
            <input type="text" name="drugAllergy" id="drugAllergy" class="form-control" value="<?php echo $profile['drugAllergy']; ?>">
            </td>
          </tr>
          <tr>
            <td>แพ้อาหาร</td>
            <td>
            <input type="text" name="foodAllergy" id="foodAllergy" class="form-control" value="<?php echo $profile['foodAllergy']; ?>">
            </td>
          </tr>
          <tr>
            <td>น้ำหนัก (kg)</td>
            <td><input type="text" name="weight" id="weight" class="form-control" value="<?php echo $profile['weight']; ?>"></td>
          </tr>
          <tr>
            <td>ความสูง (cm)</td>
            <td><input type="text" name="height" id="height" class="form-control" value="<?php echo $profile['height']; ?>"></td>
          </tr>
          <tr>
            <td>วัคซีน</td>
            <td>
            <input type="text" name="vaccine" id="vaccine" class="form-control" value="<?php echo $profile['vaccine']; ?>">
            </td>
          </tr>
         </tbody>
      </table>

      <div class="content text-left" style="padding:6px;">
        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
        <div class="mb-3">
          <label for="" class="form-label"></label>
          <textarea class="form-control" name="note" id="note" rows="3" aria-label=""><?php echo $profile['note']; ?></textarea>
        </div>
      </div>
      
    </div>
    <input type="submit" class="btn btn-success" value="บันทึก">

  </div>

                    </form>

    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>

<?php include('components/foot.php'); ?>