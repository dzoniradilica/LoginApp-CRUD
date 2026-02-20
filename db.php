<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db_name = "login_app";

    $conn = mysqli_connect($hostname, $username, $password, $db_name);

    if($conn) {
        echo "Connect";
    } else {
        echo "Error";
    }
?>