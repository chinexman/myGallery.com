<?php

include_once 'db_connect.php';





if(isset($_POST['send'])){


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    $nameError = $emailError = $commentsError = "";
    $error = false;

    if (empty($_POST['name'])) {
        $error = true;
        $nameError = " please enter your full name";
    } else {
        $name = test_input($_POST['name']);

        if (!preg_match("/^[a-zA-z]*$/", $name)) {
            $error = true;
            $nameError = " Names must contain alphabet and space";
                   }
    }

    if (empty($_POST["email"])) {
        $error = true;
        $emailError = "E-mail is required";
    } else

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $emailError = "please enter a valid email address ";


        } else {
            $email = test_input($_POST["email"]);

        }

    if (empty($_POST['comments'])) {
        $error = true;
        $commentsError = " please enter your comments";
    } else {


        $comments = test_input($_POST["comments"]);
    }

    /*
    echo "name:". $name .  "<br />";

    echo "email:". $email . "<br  />";

    echo"comments:". $comments . "<br />";
    echo"nameerror:". $nameError .  "<br  />";
    echo "emailerror:". $emailError . "<br  />";
    echo"commentserror:". $commentsError . "<br />";
*/

    if (!$error) {
        $sql = "INSERT INTO contact" .
            "(name,email,comments) " . "VALUES " .
            "('$name','$email','$comments')";
        $retval = $con->query($sql);

        if ($retval) {
            $errTyp = 'success';

                 $errMSG = "Hi ". $name . "  Your message have being, we will get back to you within 24hrs";

        } else {

            //  $_SESSION['message']='Registration failed';
            //  header('location:login.php');
            $errTyp = "Danger";
            $errMSG = "Something went wrong, try again later";
            die('Could not enter data:' . $con->error);
        }
    }

}

if(isset($_POST['subcribe'])){


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    $nameError = $emailError = $commentsError = "";
    $error = false;



    if (empty($_POST["email"])) {
        $error = true;
        $emailError = "E-mail is required";
    } else

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $emailError = "please enter a valid email address ";


        } else {
            $email = test_input($_POST["email"]);

        }



    /*
    echo "name:". $name .  "<br />";

    echo "email:". $email . "<br  />";

    echo"comments:". $comments . "<br />";
    echo"nameerror:". $nameError .  "<br  />";
    echo "emailerror:". $emailError . "<br  />";
    echo"commentserror:". $commentsError . "<br />";
*/

    if (!$error) {
        $sql = "INSERT INTO subcribe" .
            "(email) " . "VALUES " .
            "('$email')";
        $retval = $con->query($sql);

        if ($retval) {
            $errTyp = 'success';

            $errMSG = "Hi   Your message have being, we will get back to you within 24hrs";

        } else {

            //  $_SESSION['message']='Registration failed';
            //  header('location:login.php');
            $errTyp = "Danger";
            $errMSG = "Something went wrong, try again later";
            die('Could not enter data:' . $con->error);
        }
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Company</title>
    <meta charset="UTF-8">
    <meta name="viewpoint"  content="width=device-width" initial-scale="1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>


    <style>

        body{
            font:400 15px lato,sans-serif;
            line-height: 1.8;
            color: #818181;
        }
        .navbar{

            margin-bottom:0;
            background-color: #f4511e;
            z-index: 9999;
            border: 0;
            font-size: 12px !important;
            line-height: 1.42857143 !important;
            letter-spacing: 4px;
            border-radius: 5px;
            font-family: Montserrat, sans-serif;
        }
        .navbar li a,.navbar .navbar-brand{
            color:#fff !important;
        }

        .navbar-nav li a:hover, .navbar-nav li.active a{
            background-color: #fff!important;
            color: #f4511e !important;

        }

        .navbar-default .navbar-toggle{

            border-color: transparent;
            color: #fff !important;
        }


        .jumbotron{
            background-color:#f4511e;
            color:#fff;
            padding: 100px 25px;
            font-family:Montserrat,sans-serif;

        }

        .container-fluid{
            padding: 60px 50px;
        }

        .logo{
            color: #f4511e;
            font-size: 200px;
        }

        .logo-small{
            color: #f4511e;
            font-size: 50px;
        }

        .thumbnail{
            padding:0 0 15px 0;
            border:none;
            border-right:0;
        }


        .thumbnail img {
            width: 100%;
            height: 100%;
            margin-bottom: 10px;
        }

        .carousel-control.right,.carousel-control.left{
            background-image: none;
            color: #f4511e;
        }


        .carousel-indicators li{
            border-color: #f4511e;
        }

        .carousel-indicators li.active{
            background-color: #f4511e;
        }

        .item h4{
            font-size: 19px;
            margin:70px 0;
            line-height:1.375em;
            font-weight:400;
            font-style: italic;


        }

        .item span{
            font-style: normal;
        }


        .bg-grey{
            background-color: #f6f6f6;
        }

        h2{
            font-size:24px;
            text-transform: uppercase;
            color:#303030;
            font-weight: 600;
            margin-bottom: 30px;
        }

        h4{
            font-size:19px;
            line-height: 1.375em;
            color:#303030;
            font-weight:400;
            margin-bottom: 30px;
        }

        .panel{
            border: 1px solid #f4511e;
            border-radius: 0 !important;
            transition: box-shadow 0.5s;

        }

        .panel:hover{
            box-shadow: 5px 0px 40px rgba(0,0,0, .2);
        }

        .panel-heading{
            background-color: #f4511e !important;
            color: white !important;
            border-bottom: 1px solid transparent;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
        }
        .panel-footer{
            background-color: white !important;

        }

        .panel-footer .btn{
            background-color: #f4511e;
            color: white;
            margin:15px 0;
        }

        .panel-footer .btn:hover{
            border:1px solid #f4511e;
            background-color: white;
            color: #f4511e;
        }

        .panel-footer .h4{
            font-size: 14px;
            color: #aaa;
        }

        .panel-footer .h3{
            font-size: 62px;
        }
        footer .glyphicon{

            font-size:20px;
            margin-bottom: 20px;
            color:#f4511e;
        }
        .slideanim{
            visibility: visible;
        }

        .slide{
            animation-name: slide;
            -webkit-animation-name: slide;
            animation-duration: 1s;
            -webkit-animation-duration: 1s;
            visibility: visible;
        }

        @keyframes slide {

            0%{
                opacity: 0;
                transform: translateY(70%);
            }
            100%{
                opacity: 1;
                transform: translateY(0%);
            }

        }

        @-webkit-keyframes slide {


            0%{
                opacity: 0;
                -webkit-transform:translateY(70%);
            }
            100%{
                opacity: 1;
                -webkit-transform: translateY(0%);
            }
        }

        @media screen and (max-width: 768px){
            .col-sm-4{
                text-align: center;
                margin: 25px 0;
            }
            .btn-lg{
                width: 100%;
                margin-bottom: 35px;
            }

        }
        @media screen and ( max-width:480px) {
            .logo{
                font-size: 150px;
            }
        }

    </style>

</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<br><br><br><br><br><br><br><br><br><br><br>
<!-- navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> </button>
            <a class="navbar-brand" href="#myPage">Logo</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#about us">ABOUT US</a></li>
                <li><a href="#services">SERVICES</a></li>
                <li><a href="#portoflio">PORTOFLIO</a></li>
                <li><a href="#Pricing">PRICING</a></li>
                <li><a href="#Contact">CONTACT</a></li>
                <li><a href="galregister.php"><span class="glyphicon glyphicon-user"></span> sign up</a></li>
                <li><a href="gallogin.php"><span class="glyphicon glyphicon-log-in"></span> login</a></li>

            </ul></div>
    </div>

</nav>
<!-- end navbar -->

<br><br><br><br><br><br><br><br><br><br><br>
<!-- jumbutron -->

<div class="jumbotron text-center">
    <h1>myGallery</h1>
    <p>save Photos for the Future</p>
    <form method="post" action="" autocomplete="off">
        <div class="input-group col-xs-8 pull-right">
            <input type="email" class="form-control" name="email"  placeholder="email address" required>

            <span class="input-group-btn" ><button type="submit" name="subcribe" class="btn btn-danger">subscribe</button></span>
        </div>
    </form>

</div>
<!-- end jumbutron -->


<!-- about company page -->
<div id="about" class="container-fluid">
    <div class="row">
        <div class="col-sm-8">
            <h2>about us</h2><br>
            <h4>

                imagine if you misplace your phone?<br>
                imagine if your phone get stolen?<br>
                imagine if your memory card or internal storage gets  virus or your phone suddenly ma
                function and needs formating or factory reset to come up?<br>
                That means you eventually looses all your data , i mean pictures and videos in this cse
                and some of this memorable ones. in years to come you will like to view them or show them to your
                children for future reference >
            </h4> <br>

            <h2>what we does</h2>

            We  display photos in the gallery with full swipe capability , so viewers can navigate
            through  the photos using the same swipe action they are familiar with.</p>With this,
            you can add a description with each gallery , and a general introduction .you can create specific galleries for display in your mobile photo gallery.This
            allows you to  be very selective about which photo should appear in these galleries.</p>
            myGallery also offers quick access to sharing photo and also transfers photo to social
            media and from your camera to your computer with a simple import process and allows use
            to create multimedia slide shows.</p>

            <br>
            <button class="btn btn-default btn-lg">Get in Touch</button>

        </div>
        <div class="col-sm-4"><span class="glyphicon glyphicon-signal logo"></span></div>

    </div>
</div>
<!-- end about  company page -->



<!--  our values page -->
<div class="container-fluid bg-grey">
    <div class="row">
        <div class="col-sm-4">
            <span class="glyphicon glyphicon-globe logo slideanim"></span>
        </div>

        <div class="col-sm-8">
            <h2>our values</h2>
            <br>
            <h4>
                <strong>Mission</strong>: Everyone sees the world differently and can create an image that no one else would be able to see in the same way.

            </h4>
            <p>
                <strong>Vission</strong>:To capture ordinary, everyday subjects in a way that makes them meaningful in that specific moment in time.
            </p>


        </div>

    </div>
</div>
<!-- end our values page -->



<!--  services page -->
<div class="container-fluid  text-center">

    <h2>SERVICES</h2>
    <h4>What we offer</h4>
    <br>
    <div class="row slideanim">
        <div class="col-sm-4">
            <span class="glyphicon glyphicon-off logo-small"></span>
            <h4>POWER</h4>
            <p></p>
        </div>
        <div class="col-sm-4">
            <span class="glyphicon glyphicon-heart logo-small"></span>
            <h4>LOVE</h4>
            <p></p>
        </div>
        <div class="col-sm-4">
            <span class="glyphicon glyphicon-lock logo-small"></span>
            <h4>LOCK</h4>
            <p></p>
        </div>
    </div>
    <br><br>
    <div class="row slideanim">
        <div class="col-sm-4">
            <span class="glyphicon glyphicon-leaf logo-small"></span>
            <h4>GREEN</h4>
            <p></p>
        </div>
        <div class="col-sm-4">
            <span class="glyphicon glyphicon-certificate logo-small"></span>
            <h4>LOVE</h4>
            <p></p>
        </div>
        <div class="col-sm-4">
            <span class="glyphicon glyphicon-wrench logo-small"></span>
            <h4 style="color:#303030">Hard work</h4>
            <p></p>
        </div>
    </div>

</div>
<!-- end services  page -->


<!-- portfolio page-->
<div id="portoflio" class="container-fluid bg-grey text-center">
    <h2>portoflio</h2>
    <br>
    <div class="row text-center slideanim">
        <div class="col-sm-4">
            <div id="myCarousel2" class="carousel slide text-center" data-ride="carousel">
                <!--indicator-->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel2" data-slide="0" class="active"></li>
                    <li data-target="#myCarousel2" data-slide="1" ></li>
                    <li data-target="#myCarousel2" data-slide="2"></li>
                </ol>


                <!-- wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="active item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/9.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/8.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/1.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                </div>



                <!--   left and right control -->
                <a class="left carousel-control"  href="#myCarousel2" role="button" data-slide="previous">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">next</span>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div id="myCarousel3" class="carousel slide text-center" data-ride="carousel">
                <!--indicator-->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel3" data-slide="0" class="active"></li>
                    <li data-target="#myCarousel3" data-slide="1" ></li>
                    <li data-target="#myCarousel3" data-slide="2"></li>
                </ol>


                <!-- wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="active item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/1.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/2.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/3.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                </div>



                <!--   left and right control -->
                <a class="left carousel-control"  href="#myCarousel3" role="button" data-slide="previous">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">next</span>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div id="myCarousel4" class="carousel slide text-center" data-ride="carousel">
                <!--indicator-->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel4" data-slide="0" class="active"></li>
                    <li data-target="#myCarousel4" data-slide="1" ></li>
                    <li data-target="#myCarousel4" data-slide="2"></li>
                </ol>


                <!-- wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="active item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/4.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/5.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/8.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                </div>



                <!--   left and right control -->
                <a class="left carousel-control"  href="#myCarousel4" role="button" data-slide="previous">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel4" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<br>
<h2 text-center>what our customers say</h2>
<div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
    <!--indicator-->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide="0" class="active"></li>
        <li data-target="#myCarousel" data-slide="1" ></li>
        <li data-target="#myCarousel" data-slide="2"></li>
    </ol>


    <!-- wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="active item">
            <div class="thumbnail">
                <img src="../myGallery.com/IMG/55.jpg.jpg" alt="San franciso " width="400" height="300">
                <h4>San francisco</h4>
                <p>yes , San francisco is ours</p>
            </div>
        </div>
        <div class="item">
            <div class="thumbnail">
                <img src="../myGallery.com/IMG/8.jpg" alt="San franciso " width="400" height="300">
                <h4>San francisco</h4>
                <p>yes , San francisco is ours</p>
            </div>
        </div>
        <div class="item">
            <div class="thumbnail">
                <img src="../myGallery.com/IMG/9.jpg" alt="San franciso " width="400" height="300">
                <h4>San francisco</h4>
                <p>yes , San francisco is ours</p>
            </div>
        </div>
    </div>



    <!--   left and right control -->
    <a class="left carousel-control"  href="#myCarousel" role="button" data-slide="previous">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">next</span>
    </a>
</div>

<!-- end portoflio page -->

<!-- portfolio2 page-->
<div id="portoflio2" class="container-fluid bg-grey text-center">
    <h2>portoflio</h2>
    <br>
    <div class="row text-center slideanim">
        <div class="col-sm-4">
            <div id="myCarousel2" class="carousel slide text-center" data-ride="carousel">
                <!--indicator-->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel2" data-slide="0" class="active"></li>
                    <li data-target="#myCarousel2" data-slide="1" ></li>
                    <li data-target="#myCarousel2" data-slide="2"></li>
                </ol>


                <!-- wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="active item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/49.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/55.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/56.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                </div>



                <!--   left and right control -->
                <a class="left carousel-control"  href="#myCarousel2" role="button" data-slide="previous">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">next</span>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div id="myCarousel3" class="carousel slide text-center" data-ride="carousel">
                <!--indicator-->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel3" data-slide="0" class="active"></li>
                    <li data-target="#myCarousel3" data-slide="1" ></li>
                    <li data-target="#myCarousel3" data-slide="2"></li>
                </ol>


                <!-- wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="active item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/49.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/56.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/55.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                </div>



                <!--   left and right control -->
                <a class="left carousel-control"  href="#myCarousel3" role="button" data-slide="previous">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">next</span>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div id="myCarousel4" class="carousel slide text-center" data-ride="carousel">
                <!--indicator-->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel4" data-slide="0" class="active"></li>
                    <li data-target="#myCarousel4" data-slide="1" ></li>
                    <li data-target="#myCarousel4" data-slide="2"></li>
                </ol>


                <!-- wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="active item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/55.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/49.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumbnail">
                            <img src="../myGallery.com/IMG/56.jpg" alt="San franciso " width="400" height="300">
                            <h4>San francisco</h4>
                            <p>yes , San francisco is ours</p>
                        </div>
                    </div>
                </div>



                <!--   left and right control -->
                <a class="left carousel-control"  href="#myCarousel4" role="button" data-slide="previous">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel4" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<br>
<h2 text-center>what our customers say</h2>
<div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
    <!--indicator-->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide="0" class="active"></li>
        <li data-target="#myCarousel" data-slide="1" ></li>
        <li data-target="#myCarousel" data-slide="2"></li>
    </ol>


    <!-- wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="active item">
            <div class="thumbnail">
                <img src="../myGallery.com/IMG/56.jpg.jpg" alt="San franciso " width="400" height="300">
                <h4>San francisco</h4>
                <p>yes , San francisco is ours</p>
            </div>
        </div>
        <div class="item">
            <div class="thumbnail">
                <img src="../myGallery.com/IMG/55.jpg" alt="San franciso " width="400" height="300">
                <h4>San francisco</h4>
                <p>yes , San francisco is ours</p>
            </div>
        </div>
        <div class="item">
            <div class="thumbnail">
                <img src="../myGallery.com/IMG/49.jpg" alt="San franciso " width="400" height="300">
                <h4>San francisco</h4>
                <p>yes , San francisco is ours</p>
            </div>
        </div>
    </div>



    <!--   left and right control -->
    <a class="left carousel-control"  href="#myCarousel" role="button" data-slide="previous">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">next</span>
    </a>
</div>

<!-- end portoflio2 page -->


<!-- pricing page -->
<div id="pricing" class="container-fluid ">
    <div class="text-center">
        <h2>PRICING</h2>
        <h4>choose a payment plan that works for you</h4>
    </div>
    <div class="row slideanim">
        <div class="col-sm-4 col-xs-12">
            <div class="panel panel-default text-center">
                <div class="panel-heading"><h1>Basic</h1></div>
                <div class="panel-body">
                    <p> <span><strong>20</strong> lorem</span></p>
                    <p> <span><strong>15</strong> ipsum</span></p>
                    <p><span><strong>5</strong> dolor</span></p>
                    <p><span><strong>2</strong> sit</span></p>
                    <p><span><strong>endless</strong> Amet</span></p>
                </div>
                <div class="panel-footer">
                    <h3><span><strong>$19</strong></span></h3>
                    <h4> <span>per month</span></h4>
                    <button type="button" class="btn btn-lg">Sign up</button>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-xs-12">
            <div class="panel panel-default text-center">
                <div class="panel-heading"><h1>Pro</h1></div>
                <div class="panel-body">
                    <p><span><strong>50</strong> lorem</span></p>
                    <p> <span><strong>25</strong> ipsum</span></p>
                    <p> <span><strong>10</strong> dolor</span></p>
                    <p><span><strong>5</strong> sit</span></p>
                    <p><span><strong>endless</strong> Amet</span></p>
                </div>
                <div class="panel-footer">
                    <h3><span><strong>$29</strong></span> </h3>
                    <h4><span>per month</span></h4>
                    <button type="button" class="btn btn-lg">Sign up</button>
                </div>
            </div>
        </div>


        <div class="col-sm-4 col-xs-12">
            <div class="panel panel-default text-center">
                <div class="panel-heading"><h1>Premium</h1></div>
                <div class="panel-body">
                    <p><span><strong>100</strong> lorem</span></p>
                    <p><span><strong>50</strong> ipsum</span></p>
                    <p><span><strong>25</strong> dolor</span></p>
                    <p><span><strong>10</strong> sit</span></p>
                    <p><span><strong>endless</strong> Amet</span></p>
                </div>
                <div class="panel-footer">
                    <h3><span><strong>$49</strong></span></h3>
                    <h4><span>per month</span></h4>
                    <button type="button" class="btn btn-lg">Sign up</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- end pricing page -->

<!-- contact -->
<div id="contact" class="container-fluid bg-grey">
    <h2 class="text-center">CONTACT</h2>
    <form class="row" method="post" action="" autocomplete="off">
        <div class="col-sm-5">
            <p>Contact us and we'll get back to you within 24hrs</p>
            <p> <span class="glyphicon glyphicon-map-maker"></span>Chicago</p>
            <p><span class="glyphicon glyphicon-phone"></span>08101052072</p>
            <p><span class="glyphicon glyphicon-envelope"></span>chineduemordi@gmail.com</p>
        </div>

        <div class="col-sm-7 slideanim">

            <div class="row">
                <?php

               // $count= 0;
              //  while($count<5){
                   // $errMSG = "Hi ". $name . "  Your message have being, we will get back to you within 24hrs";
                if ( isset($errMSG) ) {


                    ?>
                    <div class="form-group">
                        <div class="alert alert-<?php echo  ($errTyp=="success") ? "success" : $errTyp; ?>">
                            <span class="glyphicon glyphicon-info-sign"></span></span> <?php echo $count++.$errMSG; ?>
                        </div>
                    </div>


                    <?php

                }
                ?>

                <div class="col-sm-6 form-group">

                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>

                </div>
                <div class="col-sm-6 form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>

                </div>

                <textarea  class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>


            </div>
            <div class="row">
                <div class="col-sm-12 form-group">
                    <button type="submit" name="send" class="btn btn-default pull-right">send</button>
                </div>
            </div>


        </div>
    </form>
</div>





<!-- end contact -->

<!-- footer -->
<footer class="container-fluid center-text">
    <a href="#myPage" title="To Top"><span class="glyphicon glyphicon-chevron-up"></span> </a>

    <p>Bootstrap Theme Made By <a href="http://www.w3schools.com" title="Visit w3schools">www.w3schools.com</a> </p>

</footer>



<script>


    $(document).ready(function(){

        $(".navbar a,footer a[href='#myPage']").on('click',function (event) {

            if(this.hash!==""){
                event.preventDefault();

                var hash = this.hash;

                $('html,body').animate({}
                scrollTop:$(hash).offset().top}, 900, function() {
                window.location.hash=hash;
            });(
    }
    });
    $(window).scrollfunction(){
        $(".slideanim").each(function () {
            var pos =$(this).offset().top;

            var winTop = $(window).scrollTop();
            if(pos<winTop + 600){
                $(this).addClass("Slide");
            }

        });
    });

    });


</script>



</body>
</html>