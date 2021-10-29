<?php
require_once('../functions/classesAutoload.php');
require_once('../functions/startSession.php');
require_once('../functions/logError.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $shoppingcart = new ShoppingcartsController();
        $result = $shoppingcart->deleteProduct($_GET['pid']);
    }
    catch (PDOException $e) {
        logError($e);
        header('Location: /pages/productPage.php?internalError=true&pid='.intval($_GET['pid']));
    }

    if ($result) {
        header("Location: /pages/shoppingcart.php");
    }
    else {
        header('Location: /pages/insertProduct.php?insertProductError=true');
    }
}
else {
    echo "Método post";
}