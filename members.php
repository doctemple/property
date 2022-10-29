<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}
// Profile
$members = $login->memberList();
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
  <a href="signup.php" class="btn btn-primary float-right">เพิ่มสมาชิก</a>
<h4>รายชื่อลูกค้า</h4>
              <table class="table table-sm table-striped">
                <thead>
                  <tr>
                    <th>ชื่อ-นามสกุล</th><th>โทร</th><th></th>    
                  </tr>
              </thead>
              <tbody>
                  <?php for($i=0;$i<sizeof($members);$i++){ ?>
                  <tr>
                    <td><?php echo $members[$i]['firstName']; ?>  <?php echo $members[$i]['lastName']; ?>
							          <?php if($members[$i]['company']!=""){ echo "({$members[$i]['company']})"; } ?>
                        <?php if($members[$i]['taxNumber']!=""){ echo "({$members[$i]['taxNumber']})"; } ?>
                        <?php if($members[$i]['address']!=""){ echo "({$members[$i]['address']})"; } ?>
					</td>
                    <td><?php echo $members[$i]['phone']; ?></td>
                    <td class="text-right"><a class="btn btn-xs btn-info" href="edit.member.php?id=<?php echo $members[$i]['id']; ?>">ข้อมูล</a>
                    <?php  /* echo '<a class="btn btn-xs btn-warning" href="api/del.members.php?id='.$members[$i]['id'].'">ลบ</a>'; */ ?>
                    <?php  echo '<a class="btn btn-xs btn-warning" href="history.tickets.php?phone='.$members[$i]['phone'].'">ประวัติบริการ</a>'; ?>
                  </td>
                  </tr>
                  <?php } ?>
                  </tbody>
              </table>
                  </div>
    </div>

    <!-- Content Bottom //-->
    <div class="page-bottom">
     
    </div>

<?php include('components/foot.php'); ?>