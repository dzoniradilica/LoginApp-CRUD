<?php
    include "db.php";

    $errors = "";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $rows = mysqli_num_rows(mysqli_query($conn, $sql));

        if(!$sql) {
            echo "Something went wrong! " . mysqli_error($conn);
        }

        if(password_verify($_POST['confirm_password'], $hash_password) && ($rows < 1)) {
            $sql = "INSERT INTO users (username, email, password)
            VALUES ('$username', '$email', '$hash_password')";
            $result = mysqli_query($conn, $sql);

            if($result) {
                header("Location: admin.php");
                exit;
            } else {
                echo "Something went wrong! " . mysqli_error($conn);
            }
        } elseif(!password_verify($_POST['confirm_password'], $hash_password) && ($rows >= 1)) {
            $errors = "Passwords don't match and Please enter another username" ;
        } elseif(!password_verify($_POST['confirm_password'], $hash_password)) {
            $errors = "Passwords don't match!";
        } elseif($rows >= 1) {
            $errors = "Please enter another username";
        }
    } else {
        echo "Something went wrong!";
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
    <nav>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
    
            <!-- When the user is logged in -->
            <li>
                <a href="admin.php">Admin</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
    
            <!-- When the user is not logged in -->
            <li>
                <a href="register.php">Register</a>
            </li>
            <li>
                <a href="login.php">Login</a>
            </li>
        </ul>
    </nav>
    
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

<!-- Include Footer -->