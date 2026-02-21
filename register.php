<?php
    include "db.php";

    session_start();

    $errors = "";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $rows = mysqli_num_rows(mysqli_query($conn, $sql));

        if(!$rows) {
            echo "Something went wrong! " . mysqli_error($conn);
        }

        if($_POST['password'] === $_POST['confirm_password'] && ($rows < 1)) {
            $sql = "INSERT INTO users (username, email, password)
            VALUES ('$username', '$email', '$hash_password')";
            $result = mysqli_query($conn, $sql);

            if($result) {
                $_SESSION['logged_in'] = true;
                header("Location: admin.php");
                exit;
            } else {
                echo "Something went wrong! " . mysqli_error($conn);
            }
        } elseif($_POST['password'] === $_POST['confirm_password'] && ($rows >= 1)) {
            $errors = "Passwords don't match and Please enter another username" ;
        } elseif($_POST['password'] === $_POST['confirm_password']) {
            $errors = "Passwords don't match!";
        } elseif($rows >= 1) {
            $errors = "Please enter another username";
        }
    }
?>

<!-- Include Header -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="register">
<div class="container">
    <div class="form-container">
        <form method="POST" action="">
            <h2>Create your Account</h2>

            <!-- Error message placeholder -->
            <p style="color:red">
                <?php echo $errors; ?>
            </p>

            <label for="username">Username:</label>
            <input placeholder="Enter your username" type="text" name="username" required>

            <label for="email">Email:</label>
            <input placeholder="Enter your email" type="email" name="email" required>

            <label for="password">Password:</label>
            <input placeholder="Enter your password" type="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input placeholder="Confirm your password" type="password" name="confirm_password" required>

            <input type="submit" value="Register">
        </form>
    </div>
</div>
    
</body>
</html>

<?php
    mysqli_close($conn);
?>