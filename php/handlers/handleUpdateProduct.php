<?php
require_once('../functions/classesAutoload.php');
require_once('../functions/startSession.php');
require_once('../functions/logError.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_FILES['imagem-input']['name']){
        $root = dirname(dirname(__DIR__));
        $relativePath = '/static/img/products';
        $fileName = $_FILES['imagem-input']['name'];
        $imgDestination = realpath($root . $relativePath) . '\\' . $fileName;
        $resourcePath = $_SERVER['HTTP_ORIGIN'] . $relativePath . "/{$fileName}";
        $filePath = $relativePath . "/{$fileName}";
        move_uploaded_file($_FILES['imagem-input']['tmp_name'], $imgDestination);
    }
    else {
        $filePath = NULL;
    }

    $data = array(
        [$_POST['nome-input'], PDO::PARAM_STR],
        [$_POST['valor-input'], PDO::PARAM_STR],
        [$_POST['quantidade-input'], PDO::PARAM_INT],
        [$_POST['categoria-input'], PDO::PARAM_STR],
        [$_POST['descricao-input'], PDO::PARAM_STR],
        [$filePath, PDO::PARAM_STR]
    );

    try {
        $products = new ProductsController();
        $result = $products->updateProductData($data, $_GET['pid']);
    }
    catch (PDOException $e) {
        logError($e);
        header('Location: /pages/updateProduct.php?internalError=true');
    }

    header('Location: /pages/updateProduct.php?prdUpdate=' . intval($result));
}
else {
    echo "Método GET";
}