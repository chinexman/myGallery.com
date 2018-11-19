<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weepa Sign Up</title>

    <meta name="viewpoint"  content="width=device-width" initial-scale="1">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="../myGallery.com/MDB%20Free/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../myGallery.com/MDB%20Free/css/bootstrap.min" rel="stylesheet">


    <style>





        .navbar{

            margin-bottom:0;
            background-color: #000000;
            z-index: 9999;
            border: 0;
            font-size: 9px !important;
            text-transform:uppercase;

            font-weight:bold;
            line-height: 1.42857143 !important;
            letter-spacing: 2px;
            border-radius: 3px;
            font-family: Montserrat, sans-serif;
            height:60px;



        }
        .navbar li a,.navbar-nav li{

            padding-top:10px;
            padding-bottom:10px;
        }
        .navbar li a,.navbar .navbar-brand{
            color:#fff !important;
        }

        .navbar-nav li a:hover, .navbar-nav li.active a{
            background-color: #fff!important;
            color: #000000 !important;

        }

        .navbar .navbar-brand{
            padding-top:7px;
            padding-left:-27px;
        }

        .footer-one h5{
            color:white !important;
            font-size:16px;

        }

        .footer-one a{
            color:white !important;
            font-size:12px;
            letter-spacing: 2px;



        }

        .footer-one li{
            color:white !important;
            font-size:12px;


        }


        .footer-one {
            background-color: #1b2433;
            height:400px;
            padding-top: 30px;


        }
        .footer-one p{
            color: white !important;
            letter-spacing: 2px;

        }


        .footer-one-alt {
            background-color: #131a26;
            height:100px;
            padding-top: 20px;


        }

        .fa{
            padding:10px;
            font-size:20px;

            text-decoration :none;
            color:white;
            text-align:center;
            text-transform:lowercase;


            border-radius: 50px;

        }

        .fa:hover{
            text-decoration: none;
        }

        .fa-facebook{
            background: #3B5998;
            color: white;
        }

        .fa-twitter{
            background: #55ACEE;
            color: white;
        }

        .fa-google{
            background: #dd4b39;
            color: white;
        }

        .fa-linkedin {
            background: #007bb5;
            color: white;
        }




        /*

                #login{
                    width:80%;

                    background: wheat;
                }
        */


        .container-fluid.bg-1{
            padding-top: 80px;
            padding-bottom: 80px;
            background: rgba(200, 202, 206, 0.84);

        }



           .col-sm-4{
               text-align: left;
           }

.form-control#tutorial_author,#tutorial_title,#submission_date{
    font-size: 17px;
    color:black;
}

    </style>

</head>
<body>

<br>
<br>
<br>
<br>
<?php
$tutorial_title=$tutorial_author="";
$titleErr=$authorErr="";

if(isset($_POST['add'])){
    $dbhost = 'localhost';
    $dbuser ='root';
    $dbpass = "";
    $conn = new Mysqli($dbhost,$dbuser,$dbpass);

    if($conn->connect_error){
        die('Could not connect:') . $conn->connect_error;
    }

    mysqli_select_db($conn,'mydb');


    /*
        $sql = "CREATE TABLE tutorials_tbl(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        tutorial_title varchar(30) NOT NULL,
        tutorial_author varchar(30) NOT NULL,
        Submission_date time
        )";

        if($conn->query($sql)===true){
            echo "table created successfully";
        }else{
            echo " error creating table";
        }

        */

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    /*
    if(!get_magic_quotes_gpc()){
        $tutorial_title = addslashes($_POST['tutorial_title']);
        $tutorial_author = addslashes($_POST['tutorial_author']);
    }else{
        $tutorial_title = $_POST['tutorial_title'];
        $tutorial_author = $_POST['tutorial_author'];
    }
    */
    $submission_date = $_POST['submission_date'];

    if(empty($_POST['tutorial_title'])){
        $error=true;
        $titleErr = " tutorial title is required";
    }else{
        $tutorial_title = test_input($_POST['tutorial_title']);
        if(!preg_match("/^[a-zA-z]*$/", $tutorial_title)){
            $error=true;
            $titleErr = " Only letters and whitespace are required";
            $tutorial_title="";
        }
    }

    if(empty($_POST['tutorial_author'])){
        $error=true;
        $authorErr = " tutorial author is required";
    }else{
        $tutorial_author = test_input($_POST['tutorial_author']);
        if(!preg_match("/^[a-zA-z]*$/", $tutorial_author)){
            $error=true;
            $authorErr = " Only letters and whitespace are required";
            $tutorial_author="";
        }
    }

   /* if(empty($_POST['tutorial_title'])|| empty($_POST['tutorial_author'])){
        echo" one input is empty";

    }elseif(empty($tutorial_title) || empty($tutorial_author)){
        echo " invalid format";
    }*/

  if(!$error){


        echo" all input has value";
        $sql = "INSERT INTO tutorials_tbl".
            "(tutorial_title,tutorial_author,submission_date) "."VALUES ".
            "('$tutorial_title','$tutorial_author','$submission_date')";
        $retval = $conn->query($sql);

        if(!$retval){
            die('Could not enter data:' . $conn->error );
        }else{
            echo" data Entered  successfully\n";
            $tutorial_title="";
            $tutorial_author="";
            $conn->close();
        }

    }

}

?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" >
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#myPage">
                <img src="../myGallery.com/IMG/W_from_Weepa_v7_8.png"  style="border-radius:5px" alt="logo" width="45" height="45">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#Home">Home</a> </li>
                <li><a href="#KTV BOOKINGS">  Ktv bookings</a></li>
                <li><a href="#PEOPLE">people</a></li>
                <li><a href="#PAGES">pages</a></li>
                <li><a href="SIGN UP"><span class="glyphicon glyphicon-user"></span> sign up</a></li>
                <li><a href="LOG IN"><span class="glyphicon glyphicon-log-in"></span> login</a></li>

            </ul>

        </div>
    </div>
</nav>


<div id="login" class="container-fluid bg-1 text-center">


    <div class="row">
        <div class="col-sm-3"></div>
        <div class=" col-sm-9 ">


                <img src="../myGallery.com/IMG/W_from_Weepa_v7_8.png"  style="border-radius:5px" alt="logo" width="45" height="45">
                <br>
                <br>
                <form class="form-horizontal" method="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Tutorial Title:</label>
                            <div class="col-sm-6 ">
                            <input type="text" class="form-control" name="tutorial_title" id="tutorial_title" placeholder="Enter title" value="<?php echo $tutorial_title; ?>" >
                            </div>
                            <div class="col-sm-4 pull-left"><span class="error">*<?php echo $titleErr; ?></span></div>

                        </div>
                    <br>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Tutorial Author:</label>

                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="tutorial_author" id="tutorial_author" placeholder="Enter Author" value="<?php echo $tutorial_author; ?>">

                            </div>
                            <div class="col-sm-4 pull-left"><span class="error">*<?php echo $authorErr; ?></span></div>
                        </div>
                    <br>
                        <div class="form-group bg-1">
                            <label class="control-label col-sm-2" for="title">Submission Date[yyyy-mm-dd]:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="submission_date" id="submission_date">
                            </div>
                            <div class="col-sm-4 pull-left"><span class="error">Optional</span></div>

                        </div>


                        <div class="form-group">
                            <div class=" col-sm-5">
                           <button type="submit" name="add" class="btn btn-default">add tutorial</button>
                            </div>
                        </div>







                </form>


        </div>
    </div>


</div>

<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
    <h2>Horizontal form</h2>
    <form class="form-horizontal" action="/action_page.php">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Tutorial title:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Tutorial Author:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>

<footer class="footer-one">
    <div class="container">
        <div class="row">
            <div class="col-sm-2 wow animated fadeInLeft">
                <img src="" alt="logo">
                <p>Travelers can narrow down their search for the perfect vacation
                    package by theme or category. Book the vacation of your dreams today!.</p>
            </div>
            <div class="col-sm-2 wow animated fadeInLeft">
                <h5>Weepa</h5><br>
                <ul class="list-unstyled">
                    <li><a href="#">ABOUT US</a></li><br>
                    <li><a href="#">MEDIA $ PRESS</a></li><br>
                    <li><a href="#">CARREER</a></li><br>
                    <li><a href="#">BLOG</a></li><br>
                </ul>
            </div>

            <div class="col-sm-2 wow animated fadeInLeft ">
                <h5>People</h5><br>
                <ul class="list-unstyled">
                    <li><a href="#">HELP & SUPPORT</a></li><br>
                    <li><a href="#">PRIVACY POLICY</a></li><br>
                    <li><a href="#">TERMS & CONDITIONS</a></li><br>
                </ul>
            </div>

            <div class="col-sm-2 wow animated fadeInRight">
                <h5>Ktv Bookings</h5><br>
                <ul class="list-unstyled">
                    <ADDRESS><li><strong>Address:</strong> 795 Folsom Ave, Suite 600 China </li><br>
                        <li><strong><span class="glyphicon glyphicon-phone"></span>Phone:</strong> (234) 456-7890, 123-4567 89<br></li><br>
                        <li><a href="mailto:chineduemordi@gmail.com.com" > <strong> <span class="glyphicon glyphicon-envelope"></span> Email:</strong> chineduemordi@gmail.com</a></li><br>
                        <li><strong> Monday - Friday: </strong> 10:00 - 20:00</li><br>
                        <li><strong>Saturday, Sunday:</strong> Closed</li><br>
                    </ADDRESS>
                </ul>
            </div>

            <div class="col-sm-2 wow animated fadeInRight">
                <h5>People</h5><br>
                <ul class="list-unstyled">
                    <li><a href="#about us">ABOUT US</a></li><br>
                    <li><a href="#about us">MEDIA $ PRESS</a></li><br>
                    <li><a href="#about us">CARREER</a></li><br>
                    <li><a href="#about us">BLOG</a></li><br>
                </ul>
            </div>

            <div class="col-sm-2 wow animated fadeInRight">
                <h5>Social Media</h5><br>
                <ul class="list-unstyled">
                    <li><a href="#about us">ABOUT US</a></li><br>
                    <li><a href="#about us">MEDIA $ PRESS</a></li><br>
                    <li><a href="#about us">CARREER</a></li><br>
                    <li>  <a href="#about us">BLOG</a></li><br>
                </ul>
            </div>



        </div>
    </div>


    <div class="footer-one-alt">
        <div class="container">
            <div class="col-sm-5">
                <p class="footer-copyright"> @weepa 2018</p>
            </div>
            <div class="col-sm-7 ">
                <ul class="list-inline footer-social-one m-b-0 pull-right">
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-twitter"></a>
                    <a href="#" class="fa fa-google"></a>
                    <a href="#" class="fa fa-linkedin"></a>
                </ul>
                <a href="#myPage" title="To Top"><span class="glyphicon glyphicon-chevron-up"></span> </a>

            </div>

        </div>
    </div>
</footer>


<!-- /Start your project here-->

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>


<script src="js/wow.min.js"></script>
<script>
    new WOW().init();
</script>



</body>
</html>