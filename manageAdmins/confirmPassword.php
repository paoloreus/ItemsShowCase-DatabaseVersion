<?php
session_start();
include __DIR__ . '/admins.php';
//use the update password function from admins.php to change password here
if(!isset($_SESSION['username'])){
    header('Location: ../public/indexLogin.php');
}

    if ($_POST['username'] == $_SESSION['username'] && $_POST['oldpassword'] == $_SESSION['password'] && !empty($_POST['newpassword'])) {
        $admin = new Admins();
        $resultUpdate = $admin ->updatePassword($_POST['username'], $_POST['oldpassword'], $_POST['newpassword']);
        $result = $admin ->getLogin($_POST['username'], $_POST['newpassword']);

        if($result ->fetch_assoc()){
            $_SESSION['password'] = $_POST['newpassword'];
            $message = "Changes have been made successfully! Redirecting to login page";
            echo "<script type='text/javascript'>alert('$message'); </script>";
            sleep(1);
            //header('Location: ../public/indexLogin.php');
            echo "<script type='text/javascript'>window.location='../public/indexLogin.php';</script>";
        }
        else {
            header('Location: changePassword.php?invalid=Member not found');
        }

    }

    else if($_POST['username'] == $_SESSION['username']){
        header('Location: changePassword.php?username='.$_POST['username']);

    }

    else {
        header('Location: changePassword.php?invalid=Invalid username/password');
    }
