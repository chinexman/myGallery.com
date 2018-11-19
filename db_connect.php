<?php
/**
 * Created by PhpStorm.
 * User: adu
 * Date: 1/30/2018
 * Time: 12:21 AM
 */



error_reporting(E_DEPRECATED & ~E_NOTICE);

define('DBHOST',"localhost");
define("DBUSER","root");
define("DBPASS" , "");
define("DBNAME","DBTEST");

$con=mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
$dbcon = mysqli_select_db($con,DBNAME);

if(!$con){
    die("Connection failed: ". mysqli_connect());
}

if(!$dbcon){
    die("Database Connection failed" . mysqli_error());
}


?>