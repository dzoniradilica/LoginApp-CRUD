<?php
    session_start();
?>

<nav>
    <ul>
        <?php if(!isset($_SESSION['logged_in'])): ?>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="register.php">Register</a>
            </li>
            <li>
                <a href="login.php">Login</a>
            </li>
        <?php endif; ?>

        <?php if(isset($_SESSION['logged_in'])): ?>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="admin.php">Admin</a>
            </li>
            <li>
                <a href="login.php">Logout</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>