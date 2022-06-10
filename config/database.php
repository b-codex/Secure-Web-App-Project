<?php
    define("DB_HOST", "localhost");
    define("DB_USER", "app");
    define("DB_PASS", "admin");
    define("DB_NAME", "secure-web-app");

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection Error" . $conn->connect_error);
    }

    // echo ("Connected to Database");
