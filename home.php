
<?php
ob_start();
session_start();

require_once 'db_connect.php';
if(!isset($_SESSION['user'])){
    header("location:login.php");
    exit;
}
if(isset($_POST['send'])){


    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    $nameError=$emailError=$passError="";
    $error=false;

    if(empty($_POST['name'])){
        $error =true;
        $nameError = " please enter your full name";
    }else{
        $name = test_input($_POST['name']);

        if(!preg_match("/^[a-zA-z]*$/", $name)){
            $error = true;
            $nameError = " Names must contain alphabet and space";
            $name ="";
        }
    }

    if(empty($_POST["email"])){
        $error=true;
        $emailError="E-mail is required";
    }else

        if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
            $error = true;
            $emailError ="please enter a valid email address ";


        }else{
            $email = test_input($_POST["email"]);

            $query ="SELECT userEmail FROM users where userEmail='$email'";
            $result = $con->query($query);
            $count = mysqli_num_rows($result);
            if($count!=0){
                $error = true;
                $emailError = "provided email is already in use";

            }



        }


    $comments = test_input($_POST["comments"]);

    if(!$error) {
        $sql = "INSERT INTO contact".
            "(name,email,comments) "."VALUES ".
            "('$name','$email','$comments')";
        $retval = $con->query($sql);

    }


    if($retval){
        $errTyp= 'success';
        $errMSG = "Successfully registered, you may login now";

    }else{

        //  $_SESSION['message']='Registration failed';
        //  header('location:login.php');
        $errTyp= "Danger";
        $errMSG = "Something went wrong, try again later";
        die('Could not enter data:' . $con->error );
    }
}


$res=$con->query("SELECT * from users WHERE userId =".$_SESSION['user']);
$userRow=$res->fetch_array();

?>



<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome - <?php echo $userRow['userEmail']; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="../myGallery.com/MDB%20Free/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../myGallery.com/MDB%20Free/css/bootstrap.min" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://www.codingcage.com">Coding Cage</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://www.codingcage.com/2015/01/user-registration-and-login-script-using-php-mysql.html">Back to Article</a></li>
                <li><a href="http://www.codingcage.com/search/label/jQuery">jQuery</a></li>
                <li><a href="http://www.codingcage.com/search/label/PHP">PHP</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userEmail']; ?>&nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div id="wrapper">

    <div class="container">

        <div class="page-header">
            <h3>Coding Cage - Programming Blog</h3>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1>Focuses on PHP, MySQL, Ajax, jQuery, Web Design and more...</h1>
            </div>
        </div>

    </div>

</div>

<script src="assets/jquery-1.11.3-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>