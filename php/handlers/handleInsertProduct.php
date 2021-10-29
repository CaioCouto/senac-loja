<?php
require_once('../functions/classesAutoload.php');
require_once('../functions/logError.php');

function makePath($separator, ...$segments) {
    return implode($separator, $segments);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = str_replace("\n", '<br>', $_POST['descricao-input']);
    $fileName = $_FILES['imagem-input']['name'];
    $root = dirname(dirname(__DIR__));
    $relativePath = makePath(DIRECTORY_SEPARATOR, 'static', 'img', 'products');
    $imgDestination = makePath(DIRECTORY_SEPARATOR, $root, $relativePath, $fileName);
    $resourcePath = '/' . makePath('/', 'static', 'img', 'products', $fileName);
    move_uploaded_file($_FILES['imagem-input']['tmp_name'], $imgDestination);

    $data = array(
        [$_POST['nome-input'], PDO::PARAM_STR],
        [$_POST['valor-input'], PDO::PARAM_STR],
        [$descricao, PDO::PARAM_STR],
        [$_POST['quantidade-input'], PDO::PARAM_INT],
        [$resourcePath, PDO::PARAM_STR],
        [$_POST['categoria-input'], PDO::PARAM_STR],
    );
    
    try {
        $products = new ProductsController();
        $result = $products->insertNewProduct($data);
    }
    catch (PDOException $e) {
        logError($e);
        header('Location: /pages/insertProduct.php?internalError=true');
    }

    if ($result) {
        header("Location: /pages/insertProduct.php?success=true");
    }
    else {
        header('Location: /pages/insertProduct.php?insertProductError=true');
    }
}
else {
    echo "Método GET";
}