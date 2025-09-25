<?php

header('Content-Type: application/json');
session_start();
$response = array();

if (isset($_SESSION['user_id'])) {
    $response['status'] = 'error';
    $response['message'] = 'You are already logged in';
    echo json_encode($response);
    exit();
}

require_once '../controllers/user_controller.php';
$email = $_POST['email'];
$password = $_POST['password'];
$user = get_user_by_email_ctr($email);
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_role'] = $user['role'];
    $response['status'] = 'success';
    $response['message'] = 'Login successful';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid email or password';
}
echo json_encode($response);
?>