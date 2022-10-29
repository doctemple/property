<?php 
session_start();
if(isset($_SESSION['aut']) && $_SESSION['aut']==1 && $_SESSION['role']<2){
    header("location:main.php");
 }
include('components/head.php'); 
include('components/top.php'); 
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


    </div>

    <!-- Content Middle //-->
    <div class="page  ">
<div class="box text-center">

<img src="images/avatar-m.png" alt="Profile" width="20%" class="rounded-circle" />
        <br>

    <h5 class="profile-username "><?php echo $_SESSION['firstName']; ?></h5>


        <hr>

            <div class="row">
                <div class="col ">
                <a  class="btn btn-light btn-menu" href="tickets.php"><i class="fas fa-tasks fa-2x"></i><br>งานบริการ</a>
                </div>  
                <div class="col ">
                <a  class="btn btn-light btn-menu" href="history.php"><i class="fas fa-history fa-2x"></i><br>ประวัติงาน</a>
                </div>       
            </div>  
            <br>
            <div class="row">
                <div class="col ">
                <a  class="btn btn-light btn-menu" href="products.php"><i class="fas fa-cash-register fa-2x"></i><br>สินค้า</a>
                </div>  
                <div class="col ">
                <a  class="btn btn-light btn-menu" href="members.php"><i class="fas fa-users fa-2x"></i><br>รายชื่อลูกค้า</a>
                </div>       
            </div>  
            <br>
            <div class="row">
                <div class="col ">
                <a  class="btn btn-light btn-menu" href="caims.list.php"><i class="fas fa-ambulance fa-2x"></i><br>งานเคลม</a>
                </div>  
                <div class="col ">
                <a  class="btn btn-light btn-menu" href="caims_history.php"><i class="fas fa-book-medical fa-2x"></i><br>ประวัติงานเคลม</a>
                </div>       
            </div>  
            <br>
            <?php if($_SESSION['role']==3){ ?>
            <div class="row">
                <div class="col ">
                <a  class="btn btn-light btn-menu" href="setting.php"><i class="fas fa-cog fa-2x"></i><br>ตั้งค่าระบบ</a>
                </div>
                <div class="col ">
                <a  class="btn btn-light btn-menu" href="users.php"><i class="fas fa-user fa-2x"></i><br>พนักงาน</a>
                </div>  
                    </div>
                    <br>
            <?php } ?>
    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>

<?php include('components/foot.php'); ?>