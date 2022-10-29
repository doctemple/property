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
          width:35%;
        }
        td{ text-align:left; }
    </style>


    <!-- Content Top //-->
    <div class=""
        style="text-align:center;  align-items: center;  justify-content: center; ">
        <img src="images/<?php if($profile['gender']==1){ echo 'avatar-m.png'; }else{ echo 'avatar-f.jpg'; } ?>" alt="Profile" width="20%" class="rounded-circle" />
    </div>

    <!-- Content Middle //-->
    <div class="page ">

        <h5 class="profile-username text-center"><?php echo $profile['firstName']." ".$profile['lastName']; ?></h5>
<hr>
  
          <nav class="w-100">
            <div class="nav nav-tabs" id="member-tab" role="tablist">
              <a class="nav-item nav-link active" id="member-desc-tab" data-toggle="tab" href="#member-desc" role="tab" aria-controls="member-desc" aria-selected="true">ข้อมูลทั่วไป</a>
              <a class="nav-item nav-link" id="member-comments-tab" data-toggle="tab" href="#member-comments" role="tab" aria-controls="member-comments" aria-selected="false">ข้อมูลสุขภาพ</a>
            </div>
          </nav>
          <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade active show" id="member-desc" role="tabpanel" aria-labelledby="member-desc-tab">
              <table class="table table-sm table-striped">
                <tbody>
                  <tr>
                    <td>เลขสมาชิก</td>
                    <td><?php echo $profile['id']; ?></td>
                  </tr>
                  <tr>
                    <td>เพศ</td>
                    <td><?php if($profile['gender']==1){ echo 'ชาย'; }else{ echo 'หญิง'; } ?></td>
                  </tr>
                  <tr>
                    <td>ชื่อ-นามสกุล</td>
                    <td><?php echo $profile['firstName']." ".$profile['lastName']; ?></td>
                  </tr>
                  <tr>
                    <td>ชื่อเล่น</td>
                    <td><?php echo $profile['nickName']." ".$profile['nickName']; ?></td>
                  </tr>
                  <tr>
                    <td>อีเมล</td>
                    <td><?php echo $profile['email']; ?></td>
                  </tr>
                  <tr>
                    <td>เบอร์โทร</td>
                    <td><?php echo $profile['phone']; ?></td>
                  </tr>
                  <tr>
                    <td>วันเกิด</td>
                    <td><?php echo date('d-m-Y',strtotime($profile['birth'])); ?></td>
                  </tr>
                  <tr>
                    <td>อาชีพ</td>
                    <td><?php 
                    	$occ =array('ไม่ระบุ','พนักงาน บริษัทเอกชน','เกษรตกร','เจ้าของกิจการ','รับจ้างทั่วไป','ข้าราชการ','นักบวช','นักลงทุน','รัฐวิสาหกิจ');
                      echo $occ[$profile['occupation']]; ?>
                  </td>
                  </tr>
                  </tbody>
              </table>
      
              <div class="content text-left" style="padding:6px;">
                <strong><i class="fas fa-map-marker-alt mr-1"></i> ที่อยู่</strong>
                <p class="text-muted"><?php echo htmlentities($profile['address']); ?></p>
                <hr>
              </div>
            </div>
            <div class="tab-pane fade" id="member-comments" role="tabpanel" aria-labelledby="member-comments-tab"> 
              <table class="table table-sm table-striped">
                <tbody>
                  <tr>
                    <td>กร๊ปเลือด</td>
                    <td><?php echo $profile['blood']; ?></td>
                  </tr>                  
                   <tr>
                    <td>โรคประจำตัว</td>
                    <td><?php echo $profile['congenitalDisease']; ?></td>
                  </tr>

                  <tr>
                    <td>แพ้ยา</td>
                    <td><?php echo $profile['drugAllergy']; ?></td>
                  </tr>
                  <tr>
                    <td>แพ้อาหาร</td>
                    <td><?php echo $profile['foodAllergy']; ?></td>
                  </tr>
                  <tr>
                    <td>วัคซีน</td>
                    <td><?php echo $profile['vaccine']; ?></td>
                  </tr>
                  <tr>
                    <td>น้ำหนัก</td>
                    <td><?php echo $profile['weight']; ?> กิโล</td>
                  </tr>
                  <tr>
                    <td>ความสูง</td>
                    <td><?php echo $profile['height']; ?> เซนติเมตร</td>
                  </tr>

                 </tbody>
              </table>
      
              <div class="content text-left" style="padding:6px;">
                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                <p class="text-muted"><?php echo $profile['note']; ?></p>
              </div>
            </div>
          </div>




    </div>

    <!-- Content Bottom //-->
    <div class=""
        style="text-align:center;  align-items: center;  justify-content: center; ">
        <a class="nav-link" href="edit-profile.php">
          <i class="fa fa-pencil-alt"></i> ปรับปรุงข้อมูลใหม่
        </a>
    </div>

<?php include('components/foot.php'); ?>