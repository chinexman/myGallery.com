


<?php
/**
 * Created by PhpStorm.
 * User: adu
 * Date: 1/30/2018
 * Time: 12:52 AM
 */


ob_start();

session_start();


if(isset($_SESSION['user'])!=" "){
    header:("location: halhome2.php");
}

include_once 'db_connect.php';


if(isset($_POST['btn-signup'])){


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
    }else if(strlen($_POST['name'])<6){
        $error = true;
        $nameError="Name must have atleast 6 characters ";

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

    if(empty($_POST['password'])){
        $error = true;
        $passError = " please enter password";
    }else if(strlen($_POST['password'])<6){
        $error = true;
        $passError="password must have atleast 6 characters ";

    }else{
        $password = test_input($_POST["password"]);

        $password =hash('sha256',$password);

        //$password =password_hash($password, PASSWORD_BCRYPT);


    }



    echo "name:". $name .  "<br />";

    echo "email:". $email . "<br  />";

    echo"pasword:". $password . "<br />";
    echo"nameerror:". $nameError .  "<br  />";
    echo "emailerror:". $emailError . "<br  />";
    echo"pasworderror:". $passError . "<br />";
    echo "count:". $count . "<br  />";






    if(!$error) {
        $sql = "INSERT INTO users".
            "(userName,userEmail,userPass) "."VALUES ".
            "('$name','$email','$password')";
        $retval = $con->query($sql);


        if($retval){

            /*  $_SESSION['active']=0;
              $_SESSION["logged_in"]=true;
              $_SESSION['message']=

                  "confirmation message has been sent to $email,please verify your
                  account by clicking on the link in the message!";

              $to = $email;
              $subject = "account verification(chineduemordi@gmail.com)";
              $message_body ='
              hello '.$name .'
              Thank you for signing up!
               please click on this link to activate your account;
               http://localhost/mygallery.com/verify.php?email='.$name;
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  // More headers
              $headers .= 'From: <ilorinwarehouse@mpiafrica.com>' . "\r\n";
              $headers .= 'Cc: chinexdiamond@gmail.com' . "\r\n";


              echo "to" . $to . "<br />";
              echo "subject" . $subject . "<br />";
              echo " message body" . $message_body . "<br />";


              if(mail($to,$subject,$message_body)){
                  echo "mail sent succefully";
              }else{
                  echo" mail delivery failed";
              };
              die;

              header('location : home.php');

  */
            $errTyp= 'success';
            $errMSG = "Successfully registered, you may login now";
            unset($name);
            unset($email);
            unset($password);
        }else{

            //  $_SESSION['message']='Registration failed';
            //  header('location:login.php');
            $errTyp= "Danger";
            $errMSG = "Something went wrong, try again later";
            die('Could not enter data:' . $con->error );
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

        .form-group .btn{
            background-color: #f4511e;
            color: white;
        }

        .input-group-addon{
            background-color:#f4511e ;
        }

        .glyphicon-envelope{

            color: white;
        }

        .glyphicon-lock{
            color: white;
        }

        .glyphicon-user{
            color: white;
        }

        .form-group{

            align-content: center;
        }

        #login-form{
            margin-left:50px ;
            margin-right: 50px;
            align-content: center;
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
                <li><a href="halregister.php"><span class="glyphicon glyphicon-user"></span> sign up</a></li>
                <li><a href="hallogin.php"><span class="glyphicon glyphicon-log-in"></span> login</a></li>

            </ul></div>
    </div>

</nav>
<!-- end navbar -->




<br>
<br>
<br>
<br>
<br>
<br>

<div class="container text-center">

    <div id="login-form text-center">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

            <div class="col-md-12">

                <div class="form-group">
                    <h2 class="">Sign Up.</h2>
                </div>

                <div class="form-group">
                    <hr />
                </div>


                <?php
                if ( isset($errMSG) ) {

                    ?>
                    <div class="form-group">
                        <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
                            <span class="glyphicon glyphicon-info-sign"></span></span> <?php echo $errMSG; ?>
                        </div>
                             </div>


                    <?php
                }
                ?>
                <div class="form-group">

                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" >
                    </div>
                    <span class="text-danger"><?php echo $nameError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
                    </div>
                    <span class="text-danger"><?php echo $emailError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" maxlength="15" />
                    </div>
                    <span class="text-danger"><?php echo $passError; ?></span>
                </div>

                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-danger" name="btn-signup">Sign Up</button>
                </div>

                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group">
                    <a href="index.php">Sign in Here...</a>
                </div>

            </div>

        </form>
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
            <h4>"this company is the best. i am so happy with the result!"<br>
                <span>Micheal Roe, Vice President, Comment Box</span></h4>
        </div>
        <div class="item">
            <h4>"One word.....WOW!!"<br>
                <span>John Doe, Salesman,Rep Inc</span></h4>
        </div>
        <div class="item">
            <h4>"Could i ...be any more happy with this company?"<br>
                <span>Chandler Bing, Actor, FriendsAlot</span></h4>
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
</div>
<!-- end portoflio page -->





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