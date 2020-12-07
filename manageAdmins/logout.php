<?php
session_start();
if(isset($_SESSION['username'])) {
    session_destroy();
    echo "Redirecting ... ";
    sleep(1);
    header('Location: ../public/indexPublic.php');
    exit();
}