<?php
    include "functions.php";

    session_start();

    $_SESSION = [];

    session_unset();

    session_destroy();

    redirect("index.php");
?>

