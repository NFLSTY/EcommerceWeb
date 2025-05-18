<?php
    session_start();
    if ($_SESSION['home']==false) {
        header('location: home.php');
    }
?>