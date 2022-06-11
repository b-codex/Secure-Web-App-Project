<!-- /* Including the header file. */ -->
<?php include 'inc/header.php' ?>


<?php

?>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/img-01.png" alt="IMG">
                </div>
                <form class="login100-form" method="POST" autocomplete="off" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <span class="login100-form-title">
                        Reset Password
                    </span>

                    <div class="wrap-input100">
                        <input class="input100" autocomplete="off" type="email" name="email" placeholder="Email" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Submit
                        </button>
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
                        <a class="txt2" href="register.php">
                            Create an account?
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>

                <!-- /* Including the footer file. */ -->
                <?php include 'inc/footer.php' ?>