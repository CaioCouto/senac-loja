<?php
require_once('../functions/classesAutoload.php');
require_once('../functions/logError.php');
require_once('../functions/timezone.php');

function startSession($result) {
    session_start();
    setcookie(
        session_name(), 
        session_id(), 
        0, // expires_or_options: time() + $monthInSeconds() // lifetime
        '/',
        $_SERVER['SERVER_NAME'], 
    );
    foreach($result as $k => $v) {
        $_SESSION[$k] = $v;
    }
}

function getRedirectLocation($result) {
    $userIsValid = boolval($result);
    if ($userIsValid) {
        startSession($result);
        return '/';
    } 
    else {
        return '/pages/login.php?authError=true';
    }
}

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email-input'];
    $senha = $_POST['senha-input'];
    
    try {
        $users = new UsersController();
        $result = $users->validateUser($email, $senha);
        $location = getRedirectLocation($result);
    } 
    catch (PDOException $e) {
        logError($e);
        $location = '/login.php?internalError=true';
    }

    header('Location: ' . $location);    
}