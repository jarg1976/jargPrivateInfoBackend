<?php
    $dns = "localhost";
    $username = "root"; //  $username = "private_info_app_user";
    $password = "";     // $password = "B3nfica#*123";
    $database = "private_info_app";

    $connection = mysqli_connect($dns, $username, $password, $database);

    // Check connection
    if ($connection->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
?>