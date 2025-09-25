<?php

require_once '../classes/user_class.php';


function register_user_ctr($name, $email, $password, $phone_number, $country, $city, $role)
{
    $user = new User();
    $user_id = $user->createUser($name, $email, $password, $phone_number, $country, $city, $role);
    if ($user_id) {
        return $user_id;
    }
    return false;
}

function get_user_by_email_ctr($email)
{
    $user = new User();
    return $user->getUserByEmail($email);
}

function email_exists_ctr($email)
{
    $user = new User();
    return $user->emailExists($email);
}

function user_authentication_ctr($email, $password)
{
    $user = new User();
    $user_data = $user->getUserByEmail($email);
    if ($user_data && password_verify($password, $user_data['password'])) {
        return $user_data;
    }
    return false;
}