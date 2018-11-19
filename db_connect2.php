<?php
/**
 * Created by PhpStorm.
 * User: adu
 * Date: 2/15/2018
 * Time: 11:33 AM

 */
define('DBHOST',"localhost");
define("DBUSER","root");
define("DBPASS" , "");
define("DBNAME","TEST");

$con=mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
$dbcon = mysqli_select_db($con,DBNAME);

if(!$con){
    die("Connection failed: ". mysqli_connect());
}

if(!$dbcon){
    die("Database Connection failed" . mysqli_error());
}


?>