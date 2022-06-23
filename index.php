<!-- /* Including the header file. */ -->
<?php include 'inc/header.php' ?>
<?php include('captcha.php') ?>


<!-- /* This is the PHP code that is used to validate the user's email and password. */ -->
<?php

$valid = true;
$found = true;
$captcha = true;
generate_captcha_image();


if (isset($_POST['login'])) {
    // $email = htmlspecialchars($_POST['email']);

    if (isset($_POST['email']) && ($_POST['email'] != "") && ($_POST['captcha'] != generate_captcha_image())) {
        $captcha = false;

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
            $res = mysqli_fetch_all($result, MYSQLI_ASSOC);

            /* This is checking if the result is empty or not. If it is empty, then it will set the
            variable to false. */
            if (!empty($res)) {
                // print_r($res[0]);
            } else {
                $found = false;
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
                    <div class="wrap-input100 captcha_div" style="display: flex; justify-content: space-around">
                        <img src="captcha.png" alt="CAPTCHA" class="captchaimage">
                        <input class="captcha_input" autocomplete="off" type="text" id="captcha" name="captcha" placeholder="Captcha" required>
                    </div>


                    <div class="container">
                        <p class="text-center" style="color: red;">

                            <!-- This is the code that is used to display the error message if the email
                            is not valid or if the email or password is wrong. -->
                            <?php
                            // echo ($valid);
                            if (!$valid) {
                                echo ("EMAIL IS NOT VALID!");
                            }
                            if (!$captcha) {
                                echo ("INVALID CAPTCHA!");
                            }
                            if (!$found) {
                                echo ("EITHER EMAIL OR PASSWORD IS WRONG. PLEASE TRY AGAIN!");
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