<?php 
session_start();
include('components/head.php');
include('components/top.php');
if(!isset($_SESSION['aut']) && $_SESSION['aut']==false){
        header("location:main.php");
}
// news
$id = $_GET['id'];
$news = $login->prodDetail($id);
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
    <div class="page ">

    <form action="api/edit.product.php" method="post" enctype="multipart/form-data"  >
    <input type="hidden" name="id" id="id" value="<?php echo $news['id']; ?>" >
    <input type="hidden" name="img" id="img" value="<?php echo $news['img']; ?>" >    
    <div class="content text-left" >

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">ชื่อสินค้า</span>
      </div>
          <input type="text" class="form-control" name="subject" id="subject" value="<?php echo $news['subject']; ?>" >
      </div>

      <div class="row">
      <div class="col-sm-2">
      <div class="product-img box">
         <?php

        $imgsrc="images/products/".$news['img'];
        if(file_exists($imgsrc)){
          echo "<img id=\"imgshow\" src=\"$imgsrc\" class=\"img\" alt=\"Image\" />";
        }else{
          echo "<img id=\"imgshow\" src=\"images/img.jpg\" class=\"img\" alt=\"Empty Image\" />";
        }
        ?>
        </div>
      </div>
       <div class="col-sm-10 upload-btn-wrapper ">
        <div class="custom-file">
          <p><input type="file"  name="fileToUpload" id="fileToUpload"  accept="image/*" capture="camera" ></p>
          <p><div class="cover badge badge-secondary" id="progress">OK</div></p>
        </div>
        
        
        <div id="details"></div>
      </div>
      </div>


      <div class="content text-left" >
        <div class="mb-3">
          <textarea class="form-control" name="detail" id="detail" rows="10" aria-label=""><?php echo $news['detail']; ?></textarea>
        </div>
      </div>
      
    </div>
    <input type="submit" class="btn btn-success float-right" value="ปรับปรุงข้อมูล">

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
        style="text-align:center;  align-items: center;  justify-content: center; margin-bottom:100px; ">
    <p>&nbsp;</p>
    </div>
</form>
<?php include('components/foot.php'); ?>