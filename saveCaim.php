<?php
session_start();

function mkdir_recursive($directory, $permissions=0755) {
    if(!file_exists(dirname($directory))){
        mkdir_recursive(dirname($directory), $permissions);
    }
    if(mkdir($directory, $permissions)){
        chmod($directory, $permissions);
        return true;
    }
    return false;
}

function imageResize($imageResourceId,$width,$height) {

    if ($width > $height) {
        $targetWidth =1000;
        $targetHeight =640;
    } else {
        $targetWidth =640;
        $targetHeight =1000;
    }

    $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
    return $targetLayer;
}

if (isset($_FILES['myFile'])) {

    $img_name = $_GET['imgname'];
    $tid = $_GET['id'];
    $folder = "images/caims/{$tid}";
    mkdir_recursive($folder);

    $file = $_FILES['myFile']['tmp_name']; 
    $sourceProperties = getimagesize($file);
    $fileNewName = $img_name;
    $folderPath = "images/caims/{$tid}/";

    $ext = pathinfo($_FILES['myFile']['name'], PATHINFO_EXTENSION);
    $imageType = $sourceProperties[2];

            $imageResourceId = imagecreatefromjpeg($file); 

            $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);

            $newfile = imagejpeg($targetLayer,$folderPath. $fileNewName);
            move_uploaded_file($newfile, $folderPath.$fileNewName);

}
?>