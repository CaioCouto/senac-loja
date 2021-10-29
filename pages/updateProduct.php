<?php
$functionsDir = realpath(dirname(__DIR__) . '/php/functions');
$componentsDir = realpath(dirname(__DIR__) . '/php/components');
require_once($functionsDir . '/startSession.php');
require_once($functionsDir . '/classesAutoload.php');
require_once($functionsDir . '/generalFunctions.php');
if (!session_id()) {
    header('Location: /login.php?notLogged=true');
}
else if ($_SESSION['userStatus'] === 'user') {
    header('Location: /');
}

$baseURL = getBaseURL();
$products = new ProductsController();
$data = $products->getProducts();
?>


<!DOCTYPE html>
<html lang="pt" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
        crossorigin="anonymous"
        >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../static/css/updateProduct.css">
        <title>Loja</title>
    </head>

    <body>
        <!-- ** Cabeçalho ** -->
        <?php require_once($componentsDir . '/header.php'); ?>
        
        <!-- ** Principal ** -->
        <main class="container-fluid d-flex flex-column justify-content-center align-items-md-center">
            <?php foreach($data as $product): ?>
                <div class="main__card card mb-3 flex-md-row align-items-md-center">
                    <div class="main__card-image">
                        <img src="<?php echo $baseURL . $product['image']?>" class="img-fluid rounded-start">
                    </div>

                    <div class="main__card-description">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <p class="card-text"><?php echo $product['description']; ?></p>
                            <p class="card-text"><strong>R$ <?php echo number_format($product['value'], 2, ',', '.'); ?></strong></p>
                        </div>
                    </div>

                    <div class="main__card-buttons d-flex flex-md-column justify-content-center align-items-md-center">
                        <a class="btn btn-primary mx-3 my-md-2 mx-md-0" href="editProduct.php?pid=<?php echo $product['id']; ?>">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <a class="btn btn-danger mx-3 my-md-2 mx-md-0" href="../php/handlers/handleProductDeletion.php?pid=<?php echo $product['id']; ?>">
                            <i class="bi bi-x-circle"></i> Apagar
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
            
        </main>

        <!-- ** Rodapé ** -->
        <?php require_once($componentsDir . '/footer.php'); ?>

        <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous"
        ></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>
</html>