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
      <form action="api/update.inspector.php" method="post" enctype="multipart/form-data"  >
    <!-- Content Middle //-->
    <div class="page  ">


    <input type="hidden" name="id" id="id" value="<?php echo $profile['id']; ?>">
      <table class="table table-sm table-striped">
        <tbody>
        <tr>
            <td>ชื่อผู้ใช้</td>
            <td><input type="text" class="form-control" name="user" id="user"  value="<?php echo $profile['user']; ?>" /></td>
          </tr>
          <tr>
            <td>รหัสผ่าน</td>
            <td><input type="password" class="form-control" name="newpassword" id="newpassword"  placeholder="*********" /></td>
          </tr>
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
            <td>ชื่อ</td>
            <td><input type="text" class="form-control" name="firstName" id="firstName"  value="<?php echo $profile['firstName']; ?>" /></td>
          </tr>
          <tr>
            <td>นามสกุล</td>
            <td><input type="text" class="form-control" name="lastName" id="lastName"  value="<?php echo $profile['lastName']; ?>" /></td>
          </tr>
          <tr>
            <td>ตำแหน่ง</td>
            <td><input type="text" class="form-control" name="position" id="position"  value="<?php echo $profile['position']; ?>" /></td>
          </tr>
          <tr>
            <td>อีเมล</td>
            <td><input type="text" class="form-control" name="email" id="email"  value="<?php echo $profile['email']; ?>" /></td>
          </tr>
          <tr>
            <td>เบอร์โทร</td>
            <td><input type="text" class="form-control" name="phone" id="phone"  value="<?php echo $profile['phone']; ?>"  /></td>
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
      <input type="submit" class="btn btn-success" value="บันทึก">
    </div>


  </div>

                    

    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>
</form>
<?php include('components/foot.php'); ?>