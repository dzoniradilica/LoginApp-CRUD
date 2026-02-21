<?php
    include "functions.php";

    session_start();
?>

<nav>
    <ul>
        <?php if(!isset($_SESSION['logged_in'])): ?>
            <li>
                <a href="index.php" class="<?php is_active("index.php") ?>">Home</a>
            </li>
            <li>
                <a href="register.php" class="<?php is_active("register.php") ?>">Register</a>
            </li>
            <li>
                <a href="login.php" class="<?php is_active("login.php") ?>">Login</a>
            </li>
        <?php endif; ?>

        <?php if(isset($_SESSION['logged_in'])): ?>
            <li>
                <a href="index.php" class="<?php is_active("index.php") ?>">Home</a>
            </li>
            <li>
                <a href="admin.php" class="<?php is_active("admin.php") ?>">Admin</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>