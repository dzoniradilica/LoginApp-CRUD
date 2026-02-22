<?php
    function is_active($path) {
        $url = basename($_SERVER['PHP_SELF']);
        
        if($path === $url) {
            echo "active";
        }
    }

    function redirect($path) {
        header("Location: $path");
        exit;
    }

    function transform_date($db_date) {
        $date = new DateTime($db_date);

        echo date_format($date, "d M Y");
    }
?>