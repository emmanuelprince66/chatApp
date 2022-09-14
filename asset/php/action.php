<?php
session_start();

require_once 'auth.php';
$user = new Auth();


// handles register ajax request 
if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $name = $user->test_input($_POST['name']);
    $email = $user->test_input($_POST['email']);
    $pass = $user->test_input($_POST['password']);

    $hpass = password_hash($pass, PASSWORD_DEFAULT);

    if ($user->user_exist($email)) {
        echo $user->showMessage('warning', 'This E-mail has already been registered');
    } else {
        if ($user->register($name, $email, $hpass)) {
            echo 'Register';
            $_SESSION['user'] = $email;
        } else {
            echo $user->showMessage('danger', 'Something went wrong! try again later!');
        }
    }
}

//handles login ajax request
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    // $user->displayError();
    $pass = $user->test_input($_POST['password']);
    $email = $user->test_input($_POST['email']);
    //handles add status
    if (isset($_POST['status'])) {
        $status = date('i');
        $_SESSION['user'] = $email;

        $suser->set_date($email, $status);
    }

    $loggedInUser = $user->login($email);

    if ($loggedInUser != null) {
        if (password_verify($pass, $loggedInUser['password'])) {
            if (!empty($_POST['rem'])) {
                setcookie("email", $email, time() + (30 * 24 * 60 * 60), '/');
                setcookie("password", $pass, time() + (30 * 24 * 60 * 60), '/');
            } else {
                setcookie("email", "", 1, "/");
                setcookie("password", "", 1, "/");
            }
            echo 'login';
            $_SESSION['user'] = $email;
        } else {
            echo $user->showMessage('danger', 'Password Is Incorrect!');
        }
    } else {
        echo $user->showMessage('danger', 'User Not Found!');
    }
}