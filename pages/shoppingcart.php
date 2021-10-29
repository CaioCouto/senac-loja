<?php
$functionsDir = realpath(dirname(__DIR__) . '/php/functions');
$componentsDir = realpath(dirname(__DIR__) . '/php/components');
require_once($functionsDir . '/startSession.php');
require_once($functionsDir . '/classesAutoload.php');
require_once($functionsDir . '/generalFunctions.php');

$baseURL = getBaseURL();
$cart = new ShoppingcartsController();
$data = $cart->getShoppingcart($_SESSION['userEmail']);
if (!empty($data)) {
    $userData = [
        'address' => $data[0]['address'],
        'houseNumber' => $data[0]['houseNumber'],
        'neighborhood' => $data[0]['neighborhood'],
        'city' => $data[0]['city'],
        'cep' => $data[0]['cep']
    ];
}
?>


<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
        >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../static/css/shoppingcart.css"> 

        <title>Carrinho</title>
	</head>

    <body>
        <!-- ** Cabeçalho ** -->
        <?php require_once($componentsDir . '/header.php'); ?>

        <!-- ** Principal ** -->
        <main class="container-md">
            <h1>Resumo do Pedido</h1>
            <?php if (empty($data)): ?>
                <h3>Não há itens no seu carrinho</h3>
            <?php else: ?>
                <a href="../php/handlers/handleShoppingcartClear.php">Limpar carrinho</a>
                <section class="main__shopcart-details d-lg-flex">
                    <article class="main__shopcart-products col-lg-6">
                        <?php foreach($data as $product): ?>
                            <div class="main__shopcart-card card mb-3 w-100 align-items-center gap-1">
                                <div class="main__shopcart-prodImage">
                                    <img src="<?php echo $baseURL . $product['image']?>" class="img-fluid rounded-start">
                                </div>

                                <div class="card-body ps-3">
                                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                    <label for="quantity-input" class="form-label m-0"><sub>Quantidade</sub></label>
                                    <div class="input-group mb-3">
                                        <a class="input-group-text main__quantity-link" href="../php/handlers/handleShoppingcartRemove.php?pid=<?php echo $product['product_id']; ?>">
                                            -
                                        </a>
                                        <input type="text" class="form-control" id="quantity-input" min="1" value="<?php echo $product['COUNT(Shoppingcarts.product_id)']; ?>">
                                        <a class="input-group-text main__quantity-link" href="../php/handlers/handleShoppingcartInsertion.php?pid=<?php echo $product['product_id']; ?>">
                                            +
                                        </a>
                                    </div>
                                    <p class="card-text"><strong>
                                        R$ <?php echo number_format($product['value'], 2, ',', '.'); ?>
                                    </strong></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </article>
                    
                    <article class="col-lg-6 main__shopcart-detail__value d-lg-flex flex-lg-column justify-content-lg-start px-lg-5">
                        <div>
                            <h5>Endereço de entrega</h5>
                            <p class="mb-1"><?php echo $userData['address'] . ', ' .$userData['houseNumber'] . ' - ' . $userData['neighborhood']; ?></p>
                            <p class="mb-1"><?php echo $userData['city'] ?></p>
                            <p class="mb-1"><?php echo $userData['cep'] ?></p>
                        </div>
                        <hr/>
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <h6 class="m-0">Subtotal</h6>
                                <p class="m-0">R$ 
                                    <?php
                                        $total = 0;
                                        foreach($data as $product) {
                                            $total += $product['SUM(Products.value)'];
                                        }
                                        echo number_format($total, 2, ',', '.');
                                    ?>
                                </p>
                            </div>

                            <div class="d-flex align-items-center gap-2 mb-2">
                                <h6 class="m-0">Frete (valor fixo)</h6>
                                <p class="m-0">R$ 300</p>
                            </div>
                        </div>

                        <a class="btn btn-primary my-2" href="/">Procurar mais itens</a>
                        <a class="btn btn-success" href="../php/handlers/handleShoppingcartClear.php?finalizar=true">Finalizar Pedido</a>
                    </article>
                </section> 
            <?php endif; ?>           
        </main>

        <!-- ** Rodapé ** -->
        <?php require_once($componentsDir . '/footer.php'); ?>

        <!-- ** Scripts ** -->
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
        ></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>
</html>