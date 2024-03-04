<?php
require_once '../../src/classes/User.php';
require_once '../../src/classes/Database.php';
require_once '../../utils.php';



if (isset($_POST['submit'])) {
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);
    $existingUser = User::findByEmail($email);
    if ($existingUser) {
        $message = urlencode("A user with this email already exists.");
        header("Location: register.php?message={$message}");
        exit;
    }

    $registrationSuccess = User::register($email, $password);
    
    if ($registrationSuccess) {
        $message = urlencode("Registration successful. Please wait for administrator approval.");
    } else {
        $message = urlencode("Registration failed. Please try again.");
    }
    header("Location: register.php?message={$message}");
    exit;
}
