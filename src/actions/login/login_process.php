<?php
session_start();
spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});
require_once '../../utils.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$user = User::findByEmail($email);

if ($user && password_verify($password, $user['password'])) {
    if (User::isApproved($user['id'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        if ($user['role'] === 'admin') {
            header("Location: ../../actions/admin/admin_process.php");
        } else {
            header("Location: ../../actions/display/display.php");
        }
    } else {
        $_SESSION['error'] = "Your account is pending approval.";
        header('Location: /src/errors/error.php?type=pending_approval');
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid email or password.";
    header("Location: /");
}
exit();
