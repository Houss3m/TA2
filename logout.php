<?php
            session_start();        
    unset($_SESSION['besocial_user_id']);
    header("Location: login.php");                    
    die;
?>