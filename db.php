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

    function create_user($username, $email, $hash_password) {
        global $conn;
        $sql = "INSERT INTO users (username, email, password)
        VALUES ('$username', '$email', '$hash_password')";
        $result = mysqli_query($conn, $sql);

        if($result) {
            $_SESSION['logged_in'] = true;
            redirect("admin.php");
        } else {
            echo "Something went wrong! " . mysqli_error($conn);
        }
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