<?php
$functionsDir = realpath(__DIR__ . '/php/functions');
$componentsDir = realpath(__DIR__ . '/php/components');
require_once($functionsDir . '/startSession.php');
require_once($functionsDir . '/classesAutoload.php');
require_once($functionsDir . '/generalFunctions.php');

$baseURL = getBaseURL();
$products = new ProductsController();
$data = $products->getProducts();
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
        <link rel="stylesheet" href="static/css/index.css"> 

        <title>Home</title>
	</head>

  <body>
    <!-- ** Cabeçalho ** -->
    <?php require_once($componentsDir . '/header.php'); ?>

	<?php
	if (!empty($_GET)):
		$queryParam = array_keys($_GET)[0];
		if($queryParam === 'deleteSuccess'):
	?>
			<div class="w-50 mx-auto main__alert alert alert-success alert-dismissible fade show" role="alert">
				<p class="m-0">
                    <strong>É uma pena te ver partir...</strong><br/>
                    A sua conta foi excluída com sucesso!
                </p>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
            
		<?php elseif ($queryParam === 'notAllowed'): ?>
			<div class="w-50 mx-auto main__alert alert alert-warning alert-dismissible fade show" role="alert">
				<p class="m-0">
					<strong>You Shall Not Pass!</strong><br/>
					Você não tem permissão para acessar aquela página.
				</p>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>

		<?php elseif ($queryParam === 'internalError'): ?>
			<div class="w-50 mx-auto main__alert alert alert-danger alert-dismissible fade show" role="alert">
				<p class="m-0">
					Oops. Parece que algum erro interno impediu a sua ação.
					Nossos macaquinhos já foram avisados sobre isso. 
					Aguarde um pouco e tente novamente.
				</p>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>  
	<?php
		endif;
	endif;
	?>
    <!-- ** Principal ** -->
    <main class="container-md d-flex mb-auto">
        <?php foreach($data as $product): ?>
            <a class="main__product-card card" style="width: 18rem;" href='pages/productPage.php?pid=<?php echo $product['id'] ?>'>
                <img src="<?php echo $baseURL . $product['image']; ?>" class="card-img-top">

                <div class="card-body">
                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                    <p class="card-text"><?php echo $product['description']; ?></p>
                    <p class="card-text"><strong>R$ <?php echo formatToBrazilianMoney($product['value']); ?></strong></p>
                </div>
            </a>
        <?php endforeach; ?>
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
