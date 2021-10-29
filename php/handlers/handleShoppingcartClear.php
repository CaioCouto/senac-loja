<?php
require_once('../functions/classesAutoload.php');
require_once('../functions/startSession.php');
require_once('../functions/logError.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $shoppingcart = new ShoppingcartsController();
        $result = $shoppingcart->clearCart($_SESSION['userEmail']);
    }
    catch (PDOException $e) {
        logError($e);
        header('Location: /pages/productPage.php?internalError=true&pid='.intval($_GET['pid']));
    }

    if ($result) {
        $location = boolval($_GET['finalizar']) ? '/' : '/pages/shoppingcart.php';
        header("Location: {$location}");
    }
    else {
        header('Location: /pages/insertProduct.php?insertProductError=true');
    }
}
else {
    echo "Método post";
}