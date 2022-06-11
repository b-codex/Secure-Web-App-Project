<?php include 'inc/header.php' ?>

<?php
$valid = true;
$found = true;
$success = null;

if (isset($_POST['register'])) {

    if (isset($_POST['email']) && $_POST['email'] != "") {
        if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            $q = "INSERT INTO users (name, email, password) VALUES ('$name','$email','$password')";
            $result = false;
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

<form class="login100-form" method="POST" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <span class="login100-form-title">
        Create your account
    </span>

    <div class="container">
        <p class="text-center" style="color: green;">
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

    <div class="container">
        <p class="text-center" style="color: red;">
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
<?php include 'inc/footer.php' ?>