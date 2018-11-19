<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if(isset($_POST['btn-login'])) {
    $name="chinedu";
    $email=$_POST['email'];
    $to = $email;
    $subject = "account verification(chineduemordi@gmail.com)";
    $message_body ='
            hello '.$name .'
            Thank you for signing up!
             please click on this link to activate your account;
             http://localhost/mygallery.com/verify.php?email='.$email;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    mail($to,$subject,$message_body);

    if(mail($to,$subject,$message_body)){
        echo"mail was sent successfully to" . $email;
    }else{
        echo"mail was not sent successfullyto" . $email;
    }




}

?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Welcome <?= $first_name.' '.$last_name ?></title>
    <?php include 'css/css.html'; ?>
</head>

<body>
<div class="form">

    <h1>Welcome</h1>

    <p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

        <div class="col-md-12">

            <div class="form-group">
                <h2 class="">Sign In.</h2>

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
                    <input type="email" name="email" class="form-control" placeholder="Your Email"  maxlength="40" />
                </div>
            </div>



            <div class="form-group">
                <hr />
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-block btn" name="btn-login">Sign In</button>
            </div>

            <div class="form-group">
                <hr />
            </div>

            <div class="form-group">
                <a href="register.php">Sign Up Here...</a>
            </div>

        </div>

    </form>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
