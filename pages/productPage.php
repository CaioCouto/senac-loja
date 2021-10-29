<?php
$functionsDir = realpath(dirname(__DIR__) . '/php/functions');
$componentsDir = realpath(dirname(__DIR__) . '/php/components');
require_once($functionsDir . '/startSession.php');
require_once($functionsDir . '/classesAutoload.php');
require_once($functionsDir . '/generalFunctions.php');

$baseURL = getBaseURL();
$products = new ProductsController();
$data = $products->getProduct($_GET['pid']);
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
        <link rel="stylesheet" href="../static/css/productPage.css"> 

        <title>Home</title>
	</head>

  <body>
    <!-- ** Cabeçalho ** -->
    <?php require_once($componentsDir . '/header.php'); ?>

    <!-- ** Principal ** -->
    <main class="container-md mb-auto">
        <section class="mb-4">
            <h1><?php echo $data['name']; ?></h1>
            <h6>Categoria: <?php echo ucfirst($data['category']); ?></h6>
            <hr/>
            
            <article class="d-flex justify-content-between align-items-center">
                <img class="main__product-image w-50" src="<?php echo $baseURL . $data['image']; ?>">

                <div class="card border-0 w-100 align-items-center">
                    <div class="card-body main__product-price">
                        <h5 class="card-title mb-1">R$ <?php echo number_format($data['value'], 2, ',', '.'); ?></h5>
                        <h6 class="card-subtitle mb-4 text-muted"><?php echo $data['quantity']; ?> produtos restantes.</h6>
                        <a 
                        href="../php/handlers/handleShoppingcartInsertion.php?pid=<?php echo $_GET['pid']; ?>"
                        class="btn btn-primary"
                        >
                            Adicionar ao carrinho
                        </a>
                    </div>
                </div>
            </article>
        </section>

        <section class="main__product-details">
            <h1>Descrição</h1>
            <hr/>
            <p><?php echo $data['description']; ?></p>
        </section>
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
