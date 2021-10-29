<?php
require_once('../functions/classesAutoload.php');
require_once('../functions/logError.php');
require_once('../functions/timezone.php');

function gatherFormData($status) {
    $password = password_hash($_POST['senha-input'], PASSWORD_DEFAULT);
    return array(
        [$_POST['nome-input'], PDO::PARAM_STR],
        [$_POST['sobrenome-input'], PDO::PARAM_STR],
        [$_POST['cpf-input'], PDO::PARAM_STR],
        [$_POST['genero-input'], PDO::PARAM_STR],
        [$_POST['email-input'], PDO::PARAM_STR],
        [$password, PDO::PARAM_STR],
        [$_POST['cep-input'], PDO::PARAM_STR],
        [$_POST['cidade-input'], PDO::PARAM_STR],
        [$_POST['endereco-input'], PDO::PARAM_STR],
        [$_POST['numero-input'], PDO::PARAM_STR],
        [$_POST['bairro-input'], PDO::PARAM_STR],
        [$status, PDO::PARAM_STR]
    );
}

function startSession($status) {
    session_start();
    setcookie(
        session_name(), 
        session_id(), 
        0, // time() + $monthInSeconds()
        '/',
        $_SERVER['SERVER_NAME'], 
    );
    $_SESSION['userEmail'] = $_POST['email-input'];
    $_SESSION['userFullName'] = ucwords($_POST['nome-input']) . ' ' . ucwords($_POST['sobrenome-input']);
    $_SESSION['userStatus'] = $status;
}

function getRedirectLocation($result, $status) {
    $admCreateSuccess = isset($_GET['adm']) and $result;
    $userSignUpSuccess = !isset($_GET['adm']) and $result;
    $admCreateFail = isset($_GET['adm']) and !$result;
    $userSignUpFail = !isset($_GET['adm']) and !$result;
    
    if ($admCreateSuccess) {
        return '/pages/createUser?createSuccess=true';
    }
    elseif ($admCreateFail) {
        return '/pages/createUser?createFail=true';
    }
    elseif ($userSignUpSuccess) {
        startSession($status);
        return '/';
    }
    elseif ($userSignUpFail) {
        return '/pages/signup.php?signupError=true';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status-input'] ? $_POST['status-input'] : 'user';
    $userData = gatherFormData($status);
    
    try {
        $users = new UsersController();
        $result = $users->insertNewUser($userData);
        $location = getRedirectLocation($result, $status);
    }
    catch (PDOException $e) {
        logError($e);
        $location .= isset($_GET['adm']) ? '/pages/createUser?internalError=true' : '/pages/signup.php?internalError=true';
    }

    header('Location: ' .  $location);
}