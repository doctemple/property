<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}
// Profile
$profile = $login->userProfile($_SESSION['u']);
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
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">
        <img src="images/<?php if($profile['gender']==1){ echo 'avatar-m.png'; }else{ echo 'avatar-f.jpg'; } ?>" alt="Profile" width="20%" class="rounded-circle" />
    </div>

    <!-- Content Middle //-->
    <div class="page  ">

    <h5 class="profile-username text-center"><?php echo $profile['firstName']." ".$profile['lastName']; ?></h5>

        <div class="container">
            <a  class="btn btn-info w-100" href="add.checkSheet.php"><i class="fa fa-list"></i> สร้างใบตรวจสุขภาพ</a><hr />
            <a  class="btn btn-info w-100" href="add.news.php"><i class="fa fa-newspaper"></i> สร้างข่าวสาร</a><hr />
            <a class="btn btn-primary w-100" href="members.php"><i class="fa fa-users"></i> ข้อมูลสมาชิกชุมชน</a><hr />
            <a  class="btn btn-info w-100" href="checkList.php"><i class="fa fa-history"></i> ประวัติการตรวจสุขภาพ</a><hr />

        <table class="table table-sm table-striped">
          <tbody>
            <tr>
              <td>รหัสเจ้าหน้าที่</td>
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
                    <td>ตำแหน่ง</td>
                    <td><?php echo $profile['position']; ?></td>
                  </tr>
                  <tr>
                    <td>อีเมล</td>
                    <td><?php echo $profile['email']; ?></td>
                  </tr>
                  <tr>
                    <td>เบอร์โทร</td>
                    <td><?php echo $profile['phone']; ?></td>
                  </tr>
            </tbody>
        </table>

        <div class="content text-left" style="padding:6px;">
                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                <p class="text-muted"><?php echo $profile['note']; ?></p>
              </div>

        <a class="nav-link" href="edit-inspector.php?id=<?php echo $profile['id']; ?>">
          <i class="fa fa-pencil-alt"></i> แก้ไขข้อมูลส่วนตัว
        </a>

        </div>
    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">
      <div class="container">



      </div>
    </div>

<?php include('components/foot.php'); ?>