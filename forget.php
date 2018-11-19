<?php
/**
 * Created by PhpStorm.
 * User: adu
 * Date: 1/31/2018
 * Time: 9:39 PM
 */





require_once 'db_connect.php';






if(isset($_POST['forget'])) {


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    $nameError = $emailError = $passError = "";
    $error = false;



    if (empty($_POST["email"])) {
        $error = true;
        $emailError = "E-mail is required";
    } else {
        $email = test_input($_POST["email"]);

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $emailError = "please enter a valid email address ";


        }

    }




    if(!$error){

        //$password = password_hash($password, PASSWORD_BCRYPT);
        //   echo " got to encpt level";
        //   echo "password". $password;
        $sql="SELECT userId,userEmail,userPass FROM users where userEmail='$email'";
        $res=$con->query($sql);
        //$row= $res->fetch_assoc();
        $row= $res->fetch_array();
        // echo " process the row retrieve" . "<br />";
        //  print_r($row);
        $count= mysqli_num_rows($res);
        //  echo "entry password" . $password. "<br />";
        //   echo "database password" . $row['userPass'] . "<br />";



        //  echo " count the number of row received";
        if($count==1){
            $to = $email;
            $subject = "account verification(chineduemordi@gmail.com)";
            $message_body ='
            hello '.$name .'
            
             please click on this link to reset your account;
             http://localhost/mygallery.com/reset.php?email='.$email;
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            mail($to,$subject,$message_body);
          header("location:reset.php?email=$email");

        }else{
            //$errMsg = "Incorrect Credentials, Try again";
            $errMSG= "Forget password email not found";
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

        .form-group{

            align-content: center;
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

        #login-form{
            margin-left:90px ;
            margin-right: 90px;
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
                <li><a href="galregister.php"><span class="glyphicon glyphicon-user"></span> sign up</a></li>
                <li><a href="gallogin.php"><span class="glyphicon glyphicon-log-in"></span> login</a></li>

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

    <div id="login-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

            <div class="col-md-12">

                <div class="form-group">
                    <h2 class="">Forget Password</h2>

                </div>

                <div class="form-group">
                    <hr />
                </div>

                <?php
                if ( isset($errMSG) ) {

                    ?>
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                        </div>
                    </div>

                    <?php
                }
                ?>

                <div class="form-group text-center">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
                    </div>
                    <span class="text-danger"><?php echo $emailError; ?></span>
                </div>



                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-block btn" name="forget">send</button>
                </div>

                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group">
                    <a href="galregister.php">Sign Up Here...</a>
                    <a href="gallogin.php">Login Here...</a>
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
<?php ob_end_flush(); ?>
