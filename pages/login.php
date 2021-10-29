<?php
$functionsDir = realpath(dirname(__DIR__) . '/php/functions');
$componentsDir = realpath(dirname(__DIR__) . '/php/components');
require_once($functionsDir . '/generalFunctions.php');
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
    <link rel="stylesheet" href="../static/css/login.css">
    <title>Loja</title>
  </head>

  <body>
    <!-- ** Cabeçalho ** -->
		<?php require_once($componentsDir . '/header.php'); ?>
    
    <!-- ** Principal ** -->
    <main class="container-fluid d-flex flex-column justify-content-center align-items-md-center">
      	<form class="bg-white p-3 main__form" method="POST" action="../php/handlers/handleLogin.php">
		  	<?php
			if(!empty($_GET)):
				if(isset($_GET['internalError'])):
			?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<p class="m-0">
							Oops! Parece que houve um erro interno no nosso sistema que impediu o seu login. 
							Por favor, aguarde alguns instantes enquanto os nossos macacaquinhos automatizados 
							resolvem o problema e, então, tente novamente.<br/><br/>
							Se desejar, informe o erro para o Macaquinho Chefe através do email: <strong>macaquinhochefe@banana.com</strong>;
						</p>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php elseif (isset($_GET['authError'])): ?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<p class="m-0">
							Oops! Parece que houve um erro na hora digitar as suas credenciais. Por favor verifique as informações e tente novamente! :)
						</p>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
			<?php
				endif;
			endif;
			?>
        
			<div class="mb-3">
				<label for="email-input" class="form-label">Email</label>
				<input type="email" class="form-control" id="email-input" name="email-input" aria-describedby="emailHelp">
			</div>
			
			<div class="mb-3">
				<label for="password-input" class="form-label">Password</label>
				<input type="password" class="form-control" id="password-input" name="senha-input">
			</div>
			
			<button type="submit" class="btn btn-primary">Submit</button>
			<button type="submit" class="btn btn-danger">Cadastrar-se</button>
		</form>
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
