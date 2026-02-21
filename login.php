<?php
    include "db.php";

    $errors = "";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = mysqli_num_rows(mysqli_query($conn,
        "SELECT * FROM users WHERE username = '$username'"));
        $hash_password_db = mysqli_fetch_assoc(mysqli_query($conn, 
        "SELECT password FROM users WHERE username = '$username' LIMIT 1"));

        if($result === 1 && password_verify($password, $hash_password_db['password'])) {
            echo "Radi";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login">
   
    
    <nav>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
    
            <!-- When the user is logged in -->
            <li>
                <a href="admin.html">Admin</a>
            </li>
            <li>
                <a href="logout.html">Logout</a>
            </li>
    
            <!-- When the user is not logged in -->
            <li>
                <a href="register.html">Register</a>
            </li>
            <li>
                <a href="login.html">Login</a>
            </li>
        </ul>
    </nav>
    

    <!-- Include Header and Navigation -->
    
    <div class="container">
        <div class="form-container">
            <form method="POST" action="">
                <h2>Login</h2>
    
                <!-- Error message placeholder -->
                <p style="color:red">
                    <!-- Error message goes here -->
                </p>
    
                <label for="username">Username:</label><br>
                <input type="text" name="username" required><br><br>
    
                <label for="password">Password:</label><br>
                <input type="password" name="password" required><br><br>
    
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
    
    <!-- Include Footer -->

</body>
</html>

<?php
    mysqli_close($conn);
?>