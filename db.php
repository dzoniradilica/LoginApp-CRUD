<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db_name = "login_app";

    $conn = mysqli_connect($hostname, $username, $password, $db_name);

    if($conn) {
        // echo "Connect";
    } else {
        echo "Error";
    }

    function update_user($user_id, $email) {
        global $conn;
        $sql = "UPDATE users SET email = '$email' WHERE id = $user_id";
        mysqli_query($conn, $sql);
    }

    function delete_user($user_id) {
        global $conn;
        $sql = "DELETE FROM users WHERE id = $user_id";
        mysqli_query($conn, $sql);
    }
?>