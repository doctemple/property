<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}
// User
if(isset($_GET['id']) && $_GET['id']!=''){
  $uid = $_GET['id'];
  $member = $login->memberProfile($uid);
}else{
  header("location:members.php");
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
      <div class="box">
      <h5 class="text-center">ปรับปรุงข้อมูลใหม่</h5>

    <form action="api/update.member.php" method="post" enctype="multipart/form-data"  >


      <input type="hidden" name="id" id="id" value="<?php echo $member['id']; ?>">
      <table class="table table-sm table-striped">
        <tbody>
          <tr>
            <td>เพศ</td>
            <td>
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" value="1" name="gender" id="male" <?php if($member['gender']==1){ echo "checked"; }?> >
              <label class="form-check-label" for="male">
                ชาย
              </label> &nbsp;&nbsp;
              <input class="form-check-input" type="radio" value="0" name="gender" id="female" <?php if($member['gender']==0){ echo "checked"; }?>>
              <label class="form-check-label" for="female">
                หญิง
              </label>
            </div></td>
          </tr>
          <tr>
            <td>ชื่อจริง</td>
            <td><input type="text" class="form-control" name="firstName" id="firstName"  value="<?php echo $member['firstName']; ?>" /></td>
          </tr>
          <tr>
            <td>นามสกุล</td>
            <td><input type="text" class="form-control" name="lastName" id="lastName"  value="<?php echo $member['lastName']; ?>" /></td>
          </tr>
          <tr>
            <td>อีเมล</td>
            <td><input type="text" class="form-control" name="email" id="email"  value="<?php echo $member['email']; ?>" /></td>
          </tr>
          <tr>
            <td>เบอร์โทร</td>
            <td><input type="text" class="form-control" name="phone" id="phone"  value="<?php echo $member['phone']; ?>"  /></td>
          </tr>
		            <tr>
            <td>บริษัท</td>
            <td><input type="text" class="form-control" name="company" id="company"  value="<?php echo $member['company']; ?>"  /></td>
          </tr>
          </tr>
		            <tr>
            <td>เลขผู้เสียภาษี</td>
            <td><input type="text" class="form-control" name="taxNumber" id="taxNumber"  value="<?php echo $member['taxNumber']; ?>"  /></td>
          </tr>
          </tr>
		            <tr>
            <td>ที่อยู่</td>
            <td><input type="text" class="form-control" name="address" id="address"  value="<?php echo $member['address']; ?>"  /></td>
          </tr>
          </tr>
		            <tr>
            <td>ประเภทสมาชิก</td>
            <td>
            <select class="form-control form-select" id="mtype" name="mtype">
              <option value="0" <?php if($member['mtype']==0){ echo "selected"; } ?> >ลูกค้าทั่วไป</option>
              <option value="1" <?php if($member['mtype']==1){ echo "selected"; } ?> >ลูกค้าบริษัท</option>
              <option value="2" <?php if($member['mtype']==2){ echo "selected"; } ?> >ลูกค้าพิเศษ</option>
              <option value="3" <?php if($member['mtype']==3){ echo "selected"; } ?> >ลูกค้า VIP</option>
            </select>
            </td>
          </tr>          
          </tbody>
      </table>


      <div class="content text-left" style="padding:6px;">
        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
        <div class="mb-3">
          <label for="" class="form-label"></label>
          <textarea class="form-control" name="note" id="note" rows="3" aria-label=""><?php echo $member['note']; ?></textarea>
        </div>
      </div>
      

    <input type="submit" class="btn btn-success" value="บันทึก">

                    </form>
      </div>
    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>

<?php include('components/foot.php'); ?>