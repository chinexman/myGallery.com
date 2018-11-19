<?php
/**
 * Created by PhpStorm.
 * User: adu
 * Date: 2/20/2018
 * Time: 9:17 AM
 */



$UPLOADDIR = "images/";
$file_name="";
$imageData="";
$image_file="";
$path="";
if(isset($_FILES['image'])){
    $error= array();
    $file_name= $_FILES['image']['name'];
    $file_size= $_FILES['image']['size'];
    $file_tmp= $_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $image_file="{$UPLOADDIR}{$file_name}";
    $UPLOADDIR = "images/";
    $target_path= $UPLOADDIR.basename($_FILES['image']['name']);

    $path= explode('.', $file_name);
    $file_ext = strtolower(end($path));
    $expensions= array("jpeg",'png','jpg');
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    if(in_array($file_ext,$expensions)===false){
        $error[]="extension  not allowed,please choose a JPEG or PNG file.";
    }

    if($file_size>2097152){
        $error[]='file size must be accurately 2MB';
    }

    if(empty($error)==true){


        if(move_uploaded_file($file_tmp,$image_file)){
            // $con= new mysqli("localhost","mygaller", "65e1l4JHuc", "mygaller_test");
            require'db_connect.php';
            $sql = "INSERT INTO upload_image(path) values('$image_file')";

            if($con->query($sql)==true){



            }else{
                echo "Error:".$sql.$con->error;
            }

             $sqli="select path from upload_image ORDER  by id desc ";
             $result= $con->query($sqli);
             if($result->num_rows>0){
                 while ($row= $result->fetch_assoc()){
                     $path=$row['path'];
                     echo "<img src='$path' height='280' width='320'>";
                     echo" ";


                 }
             }

            $con->close();
        }
    }else{
        print_r($error);
    }
}

?>