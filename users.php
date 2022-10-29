<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}
// Profile
$members = $login->userList();
?>
    <style>

    </style>


    <!-- Content Top //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>

    <!-- Content Middle //-->
    <div class="page  ">
<p>
<div class="box">
<a class="btn btn-success float-right" href="add.users.php"><i class="fas fa-plus"></i> เพิ่มผู้ใช้</a>
<h4>รายการผู้ใช้</h4>
<br>
              <table class="table table-sm table-striped">
                <thead>
                  <tr>
                    <th>ผู้ใช้</th><th>ชื่อ-นามสกุล</th><th></th>    
                  </tr>
              </thead>
              <tbody>
                  <?php for($i=0;$i<sizeof($members);$i++){ ?>
                  <tr>
                    <td><?php echo $members[$i]['user']; ?></td>
                    <td><?php echo $members[$i]['firstName']; ?>  <?php echo $members[$i]['lastName']; ?></td>
                    <td><a class="btn btn-xs btn-info" href="edit.user.php?id=<?php echo $members[$i]['id']; ?>">แก้ไข</a>
                    <?php if($members[$i]['id']!=1){ echo '<a class="btn btn-xs btn-warning" href="api/del.users.php?id='.$members[$i]['id'].'">ลบ</a>'; } ?></td>
                  </tr>
                  <?php } ?>
                  </tbody>
              </table>
                  </div>
    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>

<?php include('components/foot.php'); ?>