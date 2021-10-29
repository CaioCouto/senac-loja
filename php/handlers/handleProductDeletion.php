<?php
require_once('../functions/classesAutoload.php');
require_once('../functions/logError.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $products = new ProductsController();
        $result = $products->deleteProduct($_GET['pid']);
    }
    catch (PDOException $e) {
        logError($e);
        header('Location: /pages/updateProduct.php?internalError=true');
    }

    if ($result) {
        header("Location: /pages/updateProduct.php?success=true");
    }
    else {
        header('Location: /pages/updateProduct.php?deletionProductError=true');
    }
}
else {
    header("Location: /pages/updateProduct.php?invalidMethod=true");
}