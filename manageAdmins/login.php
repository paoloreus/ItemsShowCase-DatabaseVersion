<?php
session_start();
include __DIR__ . '/admins.php';
if(isset($_POST['login'])){

    if(empty($_POST['username']) || empty($_POST['password'])){
            header('Location: ../public/indexLogin.php?empty=Please fill in the Blanks');
    }
    else {
        $admin = new Admins();
        $result = $admin -> getLogin($_POST['username'], $_POST['password']);

        if($result ->fetch_assoc()){
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
            header('Location: ../public/indexAdmin.php');
        }
        else {
            header('Location: ../public/indexLogin.php?invalid=Invalid username/password');
        }
    }
}
