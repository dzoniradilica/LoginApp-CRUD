<?php
    include "db.php";
    include "partials/header.php";
    include "partials/navigation.php";
    include_once "functions.php";

    if(isset($_SESSION['logged_in'])) {
        redirect("admin.php");
    }

    $errors = "";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $rows = get_user($username);

        if($_POST['password'] === $_POST['confirm_password'] && ($rows < 1)) {
            create_user($username, $email, $hash_password);
        }

        if($_POST['password'] === $_POST['confirm_password'] && ($rows >= 1)) {
            $errors = "Passwords don't match and Please enter another username" ;
        }

        if($_POST['password'] === $_POST['confirm_password']) {
            $errors = "Passwords don't match!";
        }

        if($rows >= 1) {
            $errors = "Please enter another username";
        }
    }
?>

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

<?php include "partials/footer.php"; ?>

<?php
    mysqli_close($conn);
?>