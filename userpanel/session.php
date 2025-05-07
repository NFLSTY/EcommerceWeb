<?php
    session_start();
    if ($_SESSION['index']==false) {
        header('location: index.php');
    }
?>