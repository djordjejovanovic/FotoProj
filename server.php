<?php

include('user.php');

session_start();

$username = "";
$email = "";
$errors = array();

$connection = mysqli_connect('localhost', 'root', "Djole123!", 'fotoproj');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//registration method
if (isset($_POST['confirm_registration'])) {

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    $query = "SELECT * FROM users WHERE user_name ='$username' LIMIT 1";
    $response = mysqli_query($connection, $query);

    if (mysqli_num_rows($response) == 1) {
        array_push($errors, "Username already exists");
    }

    if (count($errors) == 0) {

        $password = md5($password);

        $query = "INSERT INTO users (user_email, user_name, user_password) 
                      VALUES('$email', '$username', '$password')";

        mysqli_query($connection, $query);

        $_SESSION['username'] = $username;
        $_SESSION['usertype'] = 0;
        $_SESSION['success'] = "You are now logged in";

        header('location: index.php');
    }
}

//login method
if (isset($_POST['login_confirm'])) {

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {

        $password = md5($password);
        $query = "SELECT * FROM users WHERE user_name='$username' AND user_password='$password'";
        $res = mysqli_query($connection, $query);

        if (mysqli_num_rows($res) == 1) {

            $results = mysqli_fetch_array($res);
            $user = new User($results);

            $_SESSION['usertype'] = $user->usertype == 1 ? 1 : 0;
            $_SESSION['username'] = $user->username;
            $_SESSION['success'] = "You are now logged in";

            if (isset($_POST['rememberMe'])) {
                setcookie('username', $user->username, time() + 60 * 60 * 24 * 365);
                setcookie('password', htmlspecialchars($_POST['password']), time() + 60 * 60 * 24 * 365);
                setcookie('rememberMe', htmlspecialchars($_POST['rememberMe']), time() + 60 * 60 * 24 * 365);
            } else {
                setcookie('username', '');
                setcookie('password', '');
                setcookie('rememberMe', '');
            }

            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

?>