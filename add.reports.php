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
        <h5 class="text-center">สร้างรายงาน</h5>
    </div>

<p>
      <form action="api/add.news.php" method="post" enctype="multipart/form-data"  >
    <!-- Content Middle //-->
    <div class="page  ">

      <div class="content text-left" style="padding:6px;">
        <strong><i class="far fa-file-alt mr-1"></i> หัวข้อ</strong>
        <div class="mb-3">
          <label for="" class="form-label"></label>
          <input type="text" class="form-control" name="subject" id="subject" value="" >
        </div>
      </div>

      <div class="content text-left" style="padding:6px;">
        <strong><i class="far fa-file-alt mr-1"></i> เนื้อหา</strong>
        <div class="mb-3">
          <label for="" class="form-label"></label>
          <textarea class="form-control" name="note" id="note" rows="10" aria-label=""></textarea>
        </div>
      </div>
      
    </div>


  </div>

                    

    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">
    <input type="submit" class="btn btn-success" value="บันทึก">
    </div>
</form>
<?php include('components/foot.php'); ?>