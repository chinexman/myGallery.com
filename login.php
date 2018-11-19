<?php
/**
 * Created by PhpStorm.
 * User: adu
 * Date: 1/31/2018
 * Time: 9:39 PM
 */



ob_start();
session_start();

require_once 'db_connect.php';

if(isset($_SESSION['user'])!=""){
    header("location: home.php");
    exit;

}


if(isset($_POST['btn-login'])) {


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



    if (empty($_POST['password'])) {
        $error = true;
        $passError = " please enter password";
    }



        $password = test_input($_POST["password"]);

    //echo "email" . $email;
  //  echo "password" . $password . "<br />";

      if(!$error){
         $password =hash('sha256',$password);

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
        if($count==1 && $row['userPass']==$password){
            $_SESSION['user']=$row['userId'];
            header("location: home.php");
        }else{
            //$errMsg = "Incorrect Credentials, Try again";
            echo " incorrect credentials, Try again";
        }


      }
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Coding Cage - Login & Registration System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<div class="container">

    <div id="login-form">
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

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
                    </div>
                    <span class="text-danger"><?php echo $emailError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="password" class="form-control" placeholder="Your Password" maxlength="15" />
                    </div>
                    <span class="text-danger"><?php echo $passError; ?></span>
                </div>

                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
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

</div>

</body>
</html>
<?php ob_end_flush(); ?>
