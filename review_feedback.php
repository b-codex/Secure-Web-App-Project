<?php
include 'inc/header.php';
require_once './Token.php';

?>

<?php
session_start();

$valid = null;
$found = null;
$success = null;
$user = $_SESSION['user'];
$hidden = false;

/* Checking if the submit button has been clicked. */
if (isset($_POST['submit'])) {
    // $email = htmlspecialchars($_POST['email']);

    /* Checking if the content is empty or not. */
    if (isset($_POST['content']) && $_POST['content'] != "") {

        /* Checking if the content is empty or not. */
        if (filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS) && filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS)) {

            /* Sanitizing the input. */
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

            /* Sanitizing the input. */
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);

            if (!empty($content) && !empty($name)) {
                if (Token::check($_POST['token'])) {

                    /* Inserting the name and content into the database. */

                    $result = false;
                    $title = $_SESSION['title'];
                    $artist = $_SESSION['artist'];
                    $year = $_SESSION['year'];
                    $genre = $_SESSION['genre'];

                    $q = "INSERT INTO feedback (name, content, title, year, artist, genre, user) VALUES ('$name','$content', '$title', '$year', '$artist', '$genre', '$user')";
                    /* Trying to insert the data into the database. */
                    $result =  mysqli_query($conn, $q);
                    // print_r($result);

                    if ($result) {
                        $success = true;
                        header('Location: dashboard.php');
                    } else {
                        $success = false;
                    }
                }
            }
        } else {
            $valid = false;
        }
    } else {
        $valid = false;
    }
}
?>

<script>
    window.onload = function(event) {
        event.preventDefault();
    };
</script>

<head>
    <link rel="stylesheet" href="css/main2.css">
</head>

<body>

    <div class="limiter">

    <?php
        $q = "SELECT * FROM feedback WHERE user = '$user'";
        /* Executing the query. */
        $result = mysqli_query($conn, $q);

        /* Fetching all the results from the database. */
        $res = mysqli_fetch_array($result, MYSQLI_ASSOC);

        print_r($res);
    ?>

        <div class="container-login100" style="background-color: white;" hidden='true'>
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/feedback.png" alt="IMG">
                </div>


                <form class="login100-form" method="POST" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="container">
                        <p class="text-center" style="color: green;">

                            <!-- /* Checking if the account has been created or not. */ -->
                            <?php
                            if ($success) {
                                echo ("Feedback Updated");
                            }

                            ?>
                        </p>
                    </div>
                    <span class="login100-form-title">
                        Leave Feedback
                    </span>

                    <div class="wrap-input100">
                        <input class="input100" autocomplete="off" type="text" name="name" placeholder="Your Name" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input1">
                        <textarea class="input1" name="content" placeholder="Leave Your Feedback Here..." required></textarea>
                        <span class="shadow-input1"></span>
                    </div>

                    <div class="container">
                        <p class="text-center" style="color: red;">

                            <!-- /* Checking if the email is valid or not. */ -->
                            <?php
                            // echo ($valid);
                            // if (!$valid) {
                            //     echo ("EMAIL IS NOT VALID!");
                            // }
                            // if (!$success) {
                            //     echo ("AN UNEXPECTED ERROR HAS OCCURRED. PLEASE TRY AGAIN!");
                            // }
                            // if (!$found) {
                            //     echo ("EITHER EMAIL OR PASSWORD IS WRONG. PLEASE TRY AGAIN!");
                            // }
                            ?>
                        </p>
                    </div>

                    <div class="container-contact1-form-btn">
                        <input class="contact1-form-btn text-center" value="Submit" type="submit" name="submit">
                    </div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"> </input>

                    <div class="text-center p-t-12">

                    </div>

                    <div class="text-center p-t-136">

                    </div>
                </form>

                <!-- /* Including the footer. */ -->
                <?php include 'inc/footer.php' ?>