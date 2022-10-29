<?php
session_start();
include('config.php');
include('icare.inc.php');
$status=false;
if(isset($_POST)){

    // Config  
      extract($_POST);  



      if (isset($_FILES['fileToUpload']) && isset($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['name']!="" ) {


        $file_name = $_FILES['fileToUpload']['name'];
        $parts=explode('.',$file_name);
        $ext = end($parts); 

           if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "../images/products/".$id.".".$ext)){
               //echo "File is valid, and was successfully uploaded.\n";
               $status=true;
           }else{
               echo "File not uploaded";
               echo "</p>";
               echo '<pre>';
               echo 'Here is some more debugging info:';
               print_r($_FILES);
               print "</pre>";
               $status=false;
           }

           $imgnew = $id.".".$ext;

       }

 

    // Process
    $api = new INC();
    $update = $api->updateProduct($_POST,$imgnew);

    if(!$update){
        $status=false;
        echo "Update Product Error.";
    }else{
        $status=true;
        echo "Product Updated.";
    }


    if(!$status){
        header('location:../edit.product.php?id='.$id);
    }else{
        header('location:../products.php?id='.$id);
    }


}
?>