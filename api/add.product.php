<?php
session_start();
include('config.php');
include('icare.inc.php');
$status=false;
if(isset($_POST)){
    // Config
    // Process
    $api = new INC();
    $add = $api->addProducts($_POST);

    if($add!=''){

        if (isset($_FILES['fileToUpload'])) {

            $file_name = $_FILES['fileToUpload']['name'];
            $parts = explode('.',$file_name);
            $ext = end($parts);  

			$imgsrc = "../images/products/".$add.".".$ext;
			//echo $imgsrc ;
               if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imgsrc)){
                   //echo "File is valid, and was successfully uploaded.\n";
                   $status=true;

                   $updateIMG = $api->updateIMG($add,$ext);
                   if($updateIMG){
                    $status=true;
                   }else{
                    $status=false;
                   }

               }else{
                   echo "File not uploaded";
                   echo "</p>";
                   echo '<pre>';
                   echo 'Here is some more debugging info:';
                   print_r($_FILES);
                   print "</pre>";
                   $status=false;
               }    

        }

    }


    if(!$status){
        header('location:../add.product.php');
    }else{
        header('location:../products.php');
    }


}else{
    header('location:../products.php');
}


?>