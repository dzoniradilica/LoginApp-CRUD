<?php
    include "db.php";
    include "partials/header.php";
    include "partials/navigation.php";

    if(isset($_SESSION['logged_in'])) {
        redirect("admin.php");
    }

    $errors = "";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $user = mysqli_fetch_assoc(mysqli_query($conn, $sql));

        if(!$user) {
            $errors = "Something went wrong! " . mysqli_error($conn);
        }

        if($user['username'] ?? "" === $username && password_verify($password, $user['password'] ?? "")) {
            $_SESSION['logged_in'] = true;
            redirect("admin.php");
        } else {
            $errors = "Invalid username or password!";
        }
    }
?>

    <div class="container">
        <div class="form-container">
            <form method="POST" action="">
                <h2>Login</h2>
    
                <!-- Error message placeholder -->
                <p style="color:red">
                    <?php echo $errors; ?>
                </p>
    
                <label for="username">Username:</label><br>
                <input type="text" name="username" required><br><br>
    
                <label for="password">Password:</label><br>
                <input type="password" name="password" required><br><br>
    
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
    
<?php include "partials/footer.php" ?>

<?php
    mysqli_close($conn);
?>