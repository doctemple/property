<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}
if(isset($_GET['m'])){ $m = $_GET['m']; }else{ $m = ''; } 
// Profile
$checklist = $login->checkList($m);
?>
    <style>

    </style>


    <!-- Content Top //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">
ประวัติการตรวจสุขภาพ
    </div>

    <!-- Content Middle //-->
    <div class="page  ">
<p>

              <table class="table table-sm table-striped">
                <thead>
                  <tr>
                    <th>วันที่</th><th>ชื่อ-นามสกุล</th><th></th> 
                  </tr>
              </thead>
              <tbody>
                  <?php for($i=0;$i<sizeof($checklist);$i++){ ?>
                  <tr>
                  <td><?php echo $checklist[$i]['check_date']; ?></td>
                  <td><?php echo $checklist[$i]['firstName']; ?>  <?php echo $checklist[$i]['lastName']; ?></td>
                    
                    <td><a class="btn btn-xs btn-info" href="edit.checkSheet.php?id=<?php echo $checklist[$i]['member']; ?>&sid=<?php echo $checklist[$i]['id']; ?>">แก้ไข</a>
                    <?php  echo '<a class="btn btn-xs btn-warning" href="api/del.checkList.php?id='.$checklist[$i]['id'].'">ลบ</a>'; ?>
                  </td>
                  </tr>
                  <?php } ?>
                  </tbody>
              </table>

              <p><button class="btn btn-info no-print print" onclick="window.print()">Print</button></p>
    </div>

    <!-- Content Bottom //-->
    <div class="page-bottom"
        style="text-align:center;  align-items: center;  justify-content: center; ">
    </div>

<?php include('components/foot.php'); ?>