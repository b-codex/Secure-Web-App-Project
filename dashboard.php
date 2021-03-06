<?php include 'inc/header.php' ?>
<?php session_start(); ?>
<?php include('IDOR.php') ?>

<!-- /* This is a PHP code that is selecting all the data from the music table and storing it in the 
variable. */ -->
<?php
$q = "SELECT * FROM music";
$result = mysqli_query($conn, $q);
$res = mysqli_fetch_all($result, MYSQLI_ASSOC);
$redirect = null;

if ($redirect == true) {
    header("Location: feedback.php");
}

?>

<html>

<head>
    <style>
        .avatar_img {

            background-repeat: no-repeat;
            background-size: cover;
            margin-right: 15px;
            vertical-align: middle;
            width: 60px;
            height: 60px;
            border-radius: 50%;

        }
    </style>
</head>

<body>
    <!-- Nav -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <?php

            $profile = "images/profiles/*";
            $totalpfp = 0;
            foreach (glob($profile) as $file) {
                $totalpfp += 1;
            }
            $pfpIndex = rand(0, $totalpfp);
            $currentpfp = glob($profile)[0];
            ?>
            <img src="<?php echo $currentpfp ?>" class="avatar_img" alt="profile pic">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <h6><?php echo $_SESSION['email'] ?></h3>
                            <a class="nav-link active" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <h6><?php echo $_SESSION['email'] ?></h3>
                            <a class="nav-link active" href="review_feedback.php">Review Feedbacks</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Nav -->

    <!-- Body Code -->

    <div class="container">

        <div class="row">
            <!-- /* This is a PHP code that is looping through the array and storing each value in the
            variable. */ -->
            <?php foreach ($res as $val) : ?>

                <div class="col-lg-4 col-md-6 col-sm-12 my-3">
                    <div class="card" style="width: 18rem;">
                       <img src="<?php echo $val['image'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                        <form method="post">
                            <input class="btn btn-dark" type="submit" name="<?php echo $val['title'] ?>" value="<?php echo $val['title'] ?>" style="background-color: transparent; border:0px; color:black; cursor:pointer;">
                        </form>

                        <?php if (isset($_POST['title'])) : ?>
                                <?php {
                                    $_SESSION['title'] = $val['title'];
                                    $_SESSION['artist'] = $val['artist'];
                                    $_SESSION['year'] = $val['year'];
                                    $_SESSION['genre'] = $val['genre'];
                                    $redirect = true;
                                }
                                ?>
                                <script>
                                    window.location.replace("feedback.php");
                                </script>
                            <?php endif; ?>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Artist: <?php echo $val['artist'] ?></li>
                            <li class="list-group-item">Year: <?php echo $val['year'] ?></li>
                            <li class="list-group-item">Genre: <?php echo $val['genre'] ?></li>
                        </ul>
                        <div class="card-body text-center">
                            <form method="post">
                                <input type="submit" class="btn btn-outline-dark" name='leave_feedback' value="Leave Feedback">
                            </form>

                            <?php if (isset($_POST['leave_feedback'])) : ?>
                                <?php {
                                    $_SESSION['title'] = $val['title'];
                                    $_SESSION['artist'] = $val['artist'];
                                    $_SESSION['year'] = $val['year'];
                                    $_SESSION['genre'] = $val['genre'];
                                    $redirect = true;
                                }
                                ?>
                                <script>
                                    window.location.replace("feedback.php");
                                </script>
                            <?php endif; ?>
                        </div>

                        <script>

                        </script>
                    </div>
                </div>

                <!-- /* Ending the foreach loop. */ -->
            <?php endforeach; ?>

        </div>

        <!-- End Body Code -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

<!-- /* This is a PHP code that is including the footer.php file. */ -->
<?php include 'inc/footer.php' ?>

</html>