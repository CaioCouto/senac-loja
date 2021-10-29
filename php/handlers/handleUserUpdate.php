<?php
require_once('../functions/classesAutoload.php');
require_once('../functions/startSession.php');
require_once('../functions/logError.php');

function gatherFormData($status) {
    $password = $_POST['senha-input'] ? password_hash($_POST['senha-input'], PASSWORD_DEFAULT): NULL;
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

function updateSession() {
    $_SESSION['userEmail'] = $_POST['email-input'];
    $_SESSION['userFullName'] = ucwords($_POST['nome-input']) . ' ' . ucwords($_POST['sobrenome-input']);
}

function getRedirectLocation($result, $status) {
    $location = $status ? '/pages/updateUser.php' : '/pages/myAccount.php';
    ($result and !$status) ? updateSession() : NULL;
    return $location . '?updateSuccess=' . intval($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = isset($_POST['status-input']) ? $_POST['status-input'] : NULL;
    $data = gatherFormData($status);

    try {
        $users = new UsersController();
        $result = $users->updateUser($data, $_GET['usr']);
        $location = getRedirectLocation($result, $status);
    }
    catch (PDOException $e) {
        logError($e);
        $location = '/pages/myAccount.php?internalError=true';
    }

    header('Location: ' . $location);
}