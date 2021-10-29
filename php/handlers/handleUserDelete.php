<?php
require_once('../functions/classesAutoload.php');
require_once('../functions/startSession.php');
require_once('../functions/logError.php');

function validateUser($user) {
    return $user->validateUser($_GET['usr'], $_GET['pwd']);
}

function getLocationURL() {
    return $_SESSION['userStatus'] === 'admin' ? '/pages/updateUser.php' : '/php/handlers/handleSignOut.php';
}

function clearCart() {
    $shoppingCart = new ShoppingcartsController();
    return $shoppingCart->clearCart($_GET['usr']);
}

function deleteUser($user) {
    if (clearCart()) {
        return $user->deleteUser($_GET['usr']);
    }
    else {
        $location = $_SESSION['userStatus'] === 'admin'? '/pages/updateUser.php' : '/pages/myAccount.php';
        header('Location: ' . $location . '?deleteError=true');
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $user = new UsersController();
        $userIsValid = $_SESSION['userStatus'] === 'user' and validateUser($user);
        $adminIsValid = $_SESSION['userStatus'] === 'admin';
        if ($userIsValid xor $adminIsValid) {
            $result = deleteUser($user);
        }
        $location = getLocationURL();
    } catch (PDOException $e) {
        logError($e);
        $location .= 'internalError=true';
    }

    $location .= $result ? '?deleteSuccess=true' : '?deleteError=true';
    header('Location: ' . $location);
}
else {
    header("Location: /pages/updateUser.php?invalidMethod=true");
}