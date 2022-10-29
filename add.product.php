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
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <style>
        td:first-child {
          text-align:right;
          font-weight: bold;
          width:30%;
        }
        td{ text-align:left; }
        #progress{display:none;}
    </style>

    <!-- Content Middle //-->
    <div class="page  ">

    <form action="api/add.product.php" method="post" enctype="multipart/form-data"  >

    <div class="content text-left" style="padding:6px;">

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">ชื่อสินค้า</span>
      </div>
      <input type="text" class="form-control" name="subject" id="subject" value="" >
      </div>

          

      </div>

      <div class="row">
      <div class="col-4">
         <img id="imgshow" class="img img-fluid img-thumbnail" src="images/img.jpg" style="width:100%; margin-left:5px; padding:6px;">
      </div>
       <div class="col-8 upload-btn-wrapper text-left">
	   <label  for="fileToUpload">เพิ่ม รูปภาพ</label><br>
        <div class="custom-file">
          <input type="file" name="fileToUpload" id="fileToUpload"  accept="image/*" capture="camera" >
          
          <p><div class="cover badge badge-secondary" id="progress">OK</div></p>
        </div>
        
        
        <div id="details"></div>
      </div>
      </div>


      <div class="content text-left" style="padding:6px;">
        <div class="mb-3">
          <label for="" class="form-label"></label>
          <textarea class="form-control" name="detail" id="detail" rows="10" aria-label=""></textarea>
        </div>
        <p><input type="submit" class="btn btn-success float-right" value="ยืนยัน"></p>
      </div>

    </div>


  </div>

<script>
    CKEDITOR.replace('detail',{
      language: 'th',
      removeButtons: 'PasteFromWord'
    });

    function CKupdate() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }
</script>                  

    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">
    
    </div>
</form>
<?php include('components/foot.php'); ?>