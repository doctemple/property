<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}

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
        
    </div>

<p>
    <!-- Content Middle //-->
    <div class="page  ">
      <div class="box" >
      <h5 class="text-center">เพิ่มผู้ใช้ใหม่</h5>
      <br>
    <form action="api/add.user.php" method="post" enctype="multipart/form-data"  >


      <input type="hidden" name="id" id="id" value="<?php echo $user['id']; ?>">
      <table class="table table-sm table-striped">
        <tbody>
        <tr>
            <td>ชื่อผู้ใช้</td>
            <td><input type="text" class="form-control" name="user" id="user"   /></td>
          </tr>
          <tr>
            <td>รหัสผ่าน</td>
            <td><input type="password" class="form-control" name="newpassword" id="newpassword"   /></td>
          </tr>
          <tr>
            <td>ชื่อจริง</td>
            <td><input type="text" class="form-control" name="firstName" id="firstName"   /></td>
          </tr>
          <tr>
            <td>นามสกุล</td>
            <td><input type="text" class="form-control" name="lastName" id="lastName"   /></td>
          </tr>
          <tr>
            <td>อีเมล</td>
            <td><input type="text" class="form-control" name="email" id="email"   /></td>
          </tr>
          <tr>
            <td>เบอร์โทร</td>
            <td><input type="text" class="form-control" name="phone" id="phone"    /></td>
          </tr>
          <tr>
            <td>สิทธิในระบบ</td>
            <td>
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" value="admin" name="type" id="admin" >
              <label class="form-check-label" for="admin">
                เจ้าของร้าน
              </label> &nbsp;&nbsp;
              <input class="form-check-input" type="radio" value="user" name="type" id="inspector" >
              <label class="form-check-label" for="inspector">
              ช่าง
              </label>
            </div></td>
          </tr>
          </tbody>
      </table>


    <input type="submit" class="btn btn-success float-right" value="เพิ่มผู้ใช้">
<br>
                    </form>
                    <br>
      </div>
    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>

<?php include('components/foot.php'); ?>