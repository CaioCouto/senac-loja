<?php
$functionsDir = dirname(__DIR__) . '/php/functions';
$componentsDir = dirname(__DIR__) . '/php/components';
require_once($functionsDir . '/generalFunctions.php');
require_once($functionsDir . '/startSession.php');
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
    <link rel="stylesheet" href="../static/css/signup.css">
    <title>Loja</title>
  </head>

  <body>
    <!-- ** Cabeçalho ** -->
	<?php require_once($componentsDir . '/header.php'); ?>
    
    <!-- ** Principal ** -->
    <main class="container-fluid d-flex flex-column justify-content-center align-items-md-center">
		<form class="bg-white main__form w-100 w-lg-50" method="POST" action="../php/handlers/handleSignUp.php">
			<?php
			if(!empty($_GET)):
				if($_GET['createSuccess']):
			?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<p class="m-0">
						Usuário cadastrado com sucesso.
						</p>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>

				<?php elseif (!$_GET['createFail']): ?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<p class="m-0">
							Oops! Parece que houve um erro na hora de cadastrar o usuário.
						</p>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>

				<?php elseif ($_GET['internalError']): ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<p class="m-0">
							Oops! Parece que houve um erro interno no nosso sistema que impediu o seu login. 
							Por favor, aguarde alguns instantes enquanto os nossos macacaquinhos automatizados 
							resolvem o problema e, então, tente novamente.<br/><br/>
							Se desejar, informe o erro para o Macaquinho Chefe através do email: <strong>macaquinhochefe@banana.com</strong>;
						</p>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
			<?php
				endif;
			endif;
			?>
			<fieldset class="mb-3">
				<legend>Informações Pessoais</legend>
				<div class="mb-3 d-flex flex-column flex-md-row justify-content-evenly gap-md-2">
					<div class="w-100 mb-3 mb-lg-0">      
						<label for="nome-input" class="form-label">Nome</label>
						<span class='text-danger ms-2 main__form-nome--valid'>
							<i class="bi bi-exclamation-circle"></i>
							Nome Inválido
						</span>
						<input type="text" class="form-control" id="nome-input" name="nome-input" required>
					</div>
				
					<div class="w-100 mb-3 mb-lg-0">
						<label for="sobrenome-input" class="form-label">Sobrenome</label>
						<span class='text-danger ms-2 main__form-sobrenome--valid'>
							<i class="bi bi-exclamation-circle"></i> 
							Sobrenome Inválido
						</span>
						<input type="text" class="form-control" id="sobrenome-input" name="sobrenome-input" required> 
					</div>

					<div class="w-100 mb-3 mb-lg-0">
						<label for="status-input" class="form-label">Status</label>
						<select class="form-select" id="status-input" name="status-input" aria-label="Identificação de gênero" required>
						<option value="" selected>Selecione um status...</option>
						<option value="admin">Administrador</option>
						<option value="collab">Colaborador</option>
						<option value="user">Usuário</option>
						</select>
					</div>
				</div>
				
				<div class="mb-3 d-flex flex-column flex-md-row justify-content-evenly gap-md-2">
					<div class="w-100 mb-3 mb-lg-0">
						<label for="cpf-input" class="form-label">CPF</label>
						<span class='text-danger ms-2 main__form-cpf--valid'>
							<i class="bi bi-exclamation-circle"></i> 
							CPF Inválido
						</span>
						<input type="text" class="form-control" id="cpf-input" name="cpf-input" required> 
					</div>
					
					<div class="w-100 mb-3 mb-lg-0">
						<label for="genero-input" class="form-label">Com qual você se identifica?</label>
						<select class="form-select" id="genero-input" name="genero-input" aria-label="Identificação de gênero" required>
						<option value="" selected>Selecione um gênero...</option>
						<option value="M">Masculino</option>
						<option value="F">Feminino</option>
						<option value="NB">Não binário</option>
						</select>
					</div>
				</div>
			
				<div class="mb-3 d-flex flex-column justify-content-evenly gap-2">
					<div class="w-100 mb-3 mb-lg-0">
						<label for="email-input" class="form-label">E-mail</label>
						<span class='text-danger ms-2 main__form-email--valid'>
							<i class="bi bi-exclamation-circle"></i> 
							E-mail Inválido
						</span>
						<input type="email" class="form-control" id="email-input" name="email-input" required>
					</div>
					
					<div class="w-100 mb-3 mb-lg-0">
						<label for="senha-input" class="form-label">Senha</label>
						<span class='text-danger ms-2 main__form-senha--valid'>
							<i class="bi bi-exclamation-circle"></i> 
							Senha Inválida
						</span>
						<input type="password" class="form-control" id="senha-input" name="senha-input" minlength="8" required>
						<div id="emailHelp" class="form-text text-dark">A senha deve conter ao menos 8 caracteres.</div>
					</div>
				</div>
			</fieldset>
			
			<fieldset class="mb-3">
				<legend>Endereço</legend>
				<div class="d-flex flex-column flex-lg-row">
					<div class="mb-3">      
						<label for="cep-input" class="form-label">CEP</label>
						<span class='text-danger ms-2 main__form-cep--valid'>
							<i class="bi bi-exclamation-circle"></i> 
							CEP Inválido
						</span>
						<input type="text" class="form-control" id="cep-input" name="cep-input" required>
					</div>
				</div>
			
				<div class="mb-3 d-flex flex-column flex-md-row justify-content-evenly gap-2">
					<div class="w-100">
						<label for="endereco-input" class="form-label">Endereço</label>
						<input type="text" class="form-control" id="endereco-input" name="endereco-input" required>
					</div>
					
					<div class="w-100">
						<label for="numero-input" class="form-label">Número</label>
						<input type="text" class="form-control" id="numero-input" name="numero-input" required>
					</div>
				</div>

				<div class="mb-3 d-flex flex-column flex-md-row justify-content-evenly gap-2">
					<div class="w-100">
						<label for="cidade-input" class="form-label">Cidade</label>
						<input type="text" class="form-control" id="cidade-input" name="cidade-input" required>
					</div>
					
					<div class="w-100">
						<label for="bairro-input" class="form-label">Bairro</label>
						<input type="text" class="form-control" id="bairro-input" name="bairro-input" require> 
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Enviar</button>
			</fieldset>
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
    <script src="../static/js/signUp/validateCEP.js"></script>
    <script src="../static/js/signUp/inputMasks.js"></script>
    <!-- <script src="../static/js/signUp/validateSignUp.js"></script> -->
  </body>
</html>
