<?php
    function is_active($path) {
        $url = basename($_SERVER['PHP_SELF']);
        
        if($path === $url) {
            echo "active";
        }
    }
?>