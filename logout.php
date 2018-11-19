<?php
/**
 * Created by PhpStorm.
 * User: adu
 * Date: 2/3/2018
 * Time: 8:19 PM
 */



session_start();

if(!isset($_SESSION['user'])){
    header("location:hallogin.php");
}elseif(isset($_SESSION['user'])!=""){
   header("location:galhome.php");
}

if(isset($_GET['logout'])){
    unset($_SESSION['user']);
    session_unset();
    session_destroy();
    header("location:halindex.html");
    exit;
}
?>