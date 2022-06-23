<?php include 'inc/header.php' ?>

<!-- /* This is a PHP code that is selecting all the data from the music table and storing it in the 
variable. */ -->
<?php
    $q = "SELECT * FROM music";
    $result = mysqli_query($conn, $q);
    $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<body>
    <!-- Nav -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">N</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="logout.php">Logout</a>
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
                            <h5 class="card-title text-center"><?php echo $val['title'] ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Artist: <?php echo $val['artist'] ?></li>
                            <li class="list-group-item">Year: <?php echo $val['year'] ?></li>
                            <li class="list-group-item">Genre: <?php echo $val['genre'] ?></li>
                        </ul>
                        <div class="card-body text-center">
                            <a type="button" class="btn btn-outline-dark" href="feedback.php">Leave Feedback</a>
                        </div>
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