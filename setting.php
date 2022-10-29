<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}
// Profile
?>
<style>
  input{ text-align:center; }
  table{ width:100%; }
  table td { padding:4px; font-size:11px;  }
  #progress{display:none;}
</style>

    <!-- Content Top //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">
        <h5 class="text-center">ตั้งค่าระบบ</h5>
    </div>

<p>
    <!-- Content Middle //-->
    <div class="page  " >

    <div class="container text-center">

              
              <hr>
      <div class="box text-center">
      <h5>โลโก้</h5>
         <img id="imgshow" class="img" src="images/logo.png" style="width:30%; padding:6px;">
      </div>
<br>

      <form action="api/update.system.php" method="post" enctype="multipart/form-data"  >
    <div class="box" >       
        <table class="tables">
          <tbody>
          <tr>
                    <td colspan="2"><h5>ชื่อระบบ : </h5></td>
                  </tr>
                  <tr>
              <td colspan="2">
              <input type="text" name="system" id="system"  class="form-control" value="<?php echo $systemName; ?>" ></td>
            </tr>
          </tbody>
        </table>
        </div>
<br>
        <input type="submit" class="text-center btn btn-success" value="บันทึก">
        
      </form>

</div>
              <hr>



                 
 

      </div>
    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>

<?php include('components/foot.php'); ?>