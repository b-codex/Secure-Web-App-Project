<!-- /* Including the header file. */ -->
<?php include 'inc/header.php' ?>
<?php include('captcha.php') ?>


<!-- /* This is the PHP code that is used to validate the user's email and password. */ -->
<?php
$valid = true;
$found = true;
$success = null;
$captcha = false;
$captcha_val = generate_captcha_image();



session_start();

if (isset($_POST["Name"])&& $_POST["Name"]!=""){
header("Location:./vendor/gotyou.php");
}else{
if (isset($_POST['login'])) {


        if ((isset($_POST['email']) && ($_POST['email'] != "")) && (isset($_POST['captcha']) == $captcha_val)) {
            $captcha = true;


            if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {

                /* Validating the email. */
                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

                /* Sanitizing the password. */
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

                /* This is the query that is used to select all the users from the database. */
                $q = "SELECT * FROM users WHERE email= '$email' AND password = '$password'";

                /* Executing the query. */
                $result = mysqli_query($conn, $q);

                /* Fetching all the results from the database. */
                $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
            
            /* This is checking if the result is empty or not. If it is empty, then it will set the
            variable to false. */
            if (!empty($res)) {
                
                if(is_array($res)){
                                    
                    $_SESSION["email"] = $email;
                    // $_SESSION["password"] = $password;
                    $_SESSION["user"] = $res['user'];

                }else{
                    if ($captcha == 'wrong') {
                        echo ('Invalid CAPTCHA');
                    } elseif (!$valid || !$found) {
                        echo ('Invalid Credentials');
                    }
                }
                // header("Location:session.php");
            } else {
                $valid = false;
            }
        } else {
            $valid = false;
        }
    }
    
    // //start session
    // if(!isset($_POST["token"]) || !isset ($_SESSION["token"])){
    //     header("Location:index.php");
    // }
    // if($_POST["token"]== $_SESSION["token"]){
    //     if(time()>= $_SESSION['token-expire']){
    //         exit (header("Location:./index.php"));
    //     }
        
    //     header("Location:dashboard.php");
        
        
    //     echo "ok";
    //     unset($_SESSION['token']);
    // }
    // else{
    //     header("Location:./index.php");
    // }
}
if(isset($_SESSION["email"]) && isset($_SESSION['user'])){
    header("Location:dashboard.php");
}
}





?>
<html>
<script>
    window.onload = function() {
        event.preventDefault();
    };
</script>
<style>
    .captcha_div {
        display: flex;
        align-items: center;
        justify-content: space-around;

    }

    .captcha_input {
        border: 1px solid lightgray;
        margin-left: 2px;
        padding: 5px;
        border-radius: 8px;
        line-height: 38px;
        width: 100px;
    }

    .captcha_input::placeholder {
        padding-left: 10px;

    }

    .captchaimage {
        height: 50px;
    }
</style>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-color: white;">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form" method="POST" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <span class="login100-form-title">
                        Login
                    </span>

                    <div class="wrap-input100">
                        <input class="input100" autocomplete="off" type="email" name="email" placeholder="Email" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100">
                        <!-- <input class="input100" autocomplete="off" type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required> -->
                        <input class="input100" autocomplete="off" type="password" name="password" placeholder="Password" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="admin1">
                        <!-- <input class="input100" autocomplete="off" type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required> -->
                        <input class="input100" autocomplete="off" type="password" name="Name" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>



                    <div class="wrap-input100 captcha_div" style="display: flex; justify-content: space-around">
                        <img src="captcha.png" alt="CAPTCHA" class="captchaimage">
                        <input class="captcha_input" autocomplete="off" type="text" id="captcha" name="captcha" placeholder="Captcha" required>
                    </div>


                    <div class="container">
                        <p class="text-center" style="color: red;">

                            <!-- This is the code that is used to display the error message if the email
                            is not valid or if the email or password is wrong. -->
                            <?php
                            if (!$captcha) {
                                echo ('Invalid CAPTCHA');
                            } elseif (!$valid || !$found) {
                                echo ('Invalid Credentials');
                            }

                            ?>
                        </p>
                    </div>

                    <div class="container-login100-form-btn">
                        <input class="login100-form-btn" type="submit" name="login" value="Login">
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="forgot_password.php">
                            Username / Password?
                        </a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="register.php">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>

                <!-- /* Including the footer file. */ -->
                <?php include 'inc/footer.php' ?>

</html>