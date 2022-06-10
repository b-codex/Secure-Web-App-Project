<?php

?>

<?php include 'inc/header.php' ?>

<form class="login100-form" method="POST" autocomplete="off" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <span class="login100-form-title">
        Create your account
    </span>

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
        <input class="input100" autocomplete="off" type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </span>
    </div>

    <div class="container-login100-form-btn">
        <button class="login100-form-btn">
            Create account
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
        <a class="txt2" href="forgot_password.php">
            Forgot Password?
            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
        </a>
    </div>
</form>
<?php include 'inc/footer.php' ?>