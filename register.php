<!-- /* Including the header file. */ -->
<?php include 'inc/header.php' ?>
<?php include('captcha.php') ?>



<!-- /* This is the PHP code that is used to register a user. */ -->
<?php
$valid = true;
$found = true;
$success = null;
$captcha = false;
$captcha_val = generate_captcha_image();
// echo (generate_captcha_image());
/* This is checking if the register button has been clicked. */
if (isset($_POST['register'])) {



    /* This is checking if the email field is empty. */
    if ((isset($_POST['email']) && ($_POST['email'] != "")) && (isset($_POST['captcha']) == $captcha_val)) {


        /* This is checking if the email is valid. */
        if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {

            /* This is sanitizing the input. */
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

            /* This is checking if the email is valid. */
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

            /* This is sanitizing the input. */
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = md5($password);

            /* This is inserting the name, email and password into the database. */
            $q = "INSERT INTO users (name, email, password) VALUES ('$name','$email','$password')";

            $result = false;

            /* This is checking if the query is successful. */
            try {
                $result =  mysqli_query($conn, $q);
                // $conn->multi_query($q);

            } catch (\Throwable $th) {
                // echo "Failed";
            }


            if ($result) {
                $success = true;
            } else {
                $success = false;
            }
        } else {
            $valid = false;
        }
    } else {
        $valid = false;
    }
}
?>

<html>
<style>
    .captcha_div {
        display: flex;
        align-items: center;
        justify-content: space-around;

    }

    .captcha_input {
        border: 1px solid lightgray;
        margin-left: 5px;
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
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form" method="POST" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <span class="login100-form-title">
                        Create your account
                    </span>

                    <div class="container">
                        <p class="text-center" style="color: green;">

                            <!-- /* This is checking if the account has been created. */ -->
                            <?php
                            // echo ($valid);
                            if ($success) {
                                echo ("ACCOUNT CREATED!");
                            }

                            ?>
                        </p>
                    </div>

                    <div class="wrap-input100">
                        <input class="input100" type="text" autocomplete="off" name="name" placeholder="Your Name" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

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
                    <div class="wrap-input100 captcha_div" style="display: flex; justify-content: space-around">
                        <img src="captcha.png" alt="CAPTCHA" class="captchaimage">
                        <input class="captcha_input" autocomplete="off" type="text" id="captcha" name="captcha" placeholder="Captcha" required>
                    </div>


                    <div class="container">
                        <p class="text-center" style="color: red;">

                            <!-- /* This is checking if the email is valid. */ -->
                            <?php
                            // echo ($valid);
                            if (!$valid) {
                                echo ("EMAIL IS NOT VALID!");
                            }
                            if (!$found) {
                                echo ("USER ALREADY EXISTS!");
                            }
                            if ($success === false) {
                                echo ("ACCOUNT NOT CREATED!");
                            }
                            ?>
                        </p>
                    </div>

                    <div class="container-login100-form-btn">
                        <input class="login100-form-btn" type="submit" name="register" value="Create Account">
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Back to
                        </span>
                        <a class="txt2" href="index.php">
                            Login?
                        </a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="forgot_password.php">
                            Forgot Password?
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>

                <!-- /* Including the footer file. */ -->
                <?php include 'inc/footer.php' ?>

</html>