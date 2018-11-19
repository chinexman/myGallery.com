<?php
/**
 * Created by PhpStorm.
 * User: adu
 * Date: 2/5/2018
 * Time: 7:01 PM
 */

$target_dir="uploads/";
$target_file=$target_dir . basename($_FILES["fileToUpload"]['name']);
$uploadOk=1;
$imageFileType= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "file is an image -" . $check["mime"] . ".";
        $uploadOk = 1;

    } else {
        echo " File is not an image";
        $uploadOk = 0;
    }

}
    if(file_exists($target_file)){
        echo "Sorry.file already exist";
        $uploadOk=0;
    }

    if($_FILES["fileToUpload"]["size"]>500000){
        echo "Sorry , file is too Large";
        $uploadOk=0;

    }

    if($imageFileType !="jpg" && $imageFileType!="png" && $imageFileType !="jpeg" && $imageFileType !="gif"){
        echo "Sorry, Only jpg,png,jpeg and gif files are allowed";
        $uploadOk=0;
    }


    if($uploadOk==0){
        echo "Sorry, your file was not Uploaded";
    }else{
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)){
            echo "The file " .basename($_FILES['fileToUpload']['name']). "has been updated";
            echo "<img src=uploads/" .$file_name. " height=200 width=300 />";
        }else{
            echo" there was an error uploading your file";
        }
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>photogallery</title>
</head>
<body>
<div class="gallery">
    <a target="_blank" href="">
          <img src="{$_FILES['fileToUpload']['tmp_name']}" alt="photo1" width="300" height="200">




    </a>
    <div class="desc">Add a description of the image here</div>
</div>
</body>
