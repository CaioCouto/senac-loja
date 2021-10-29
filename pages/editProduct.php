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

$products = new ProductsController();
$data = $products->getProduct($_GET['pid']);
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
        <link rel="stylesheet" href="../static/css/insertProduct.css">
        <title>Loja</title>
    </head>

    <body>
        <!-- ** Cabeçalho ** -->
        <?php require_once($componentsDir . '/header.php'); ?>
        
        <!-- ** Principal ** -->
        <main class="container-fluid d-flex flex-column justify-content-center align-items-md-center">
            <form 
                class="bg-white main__form d-flex flex-column" method="POST" 
                enctype="multipart/form-data" action="../php/handlers/handleUpdateProduct.php?pid=<?php echo $data['id']; ?>"
            >
                <?php
                if (!empty($_GET)):
                    if(isset($_GET['updateSuccess'])):
                    ?>
                        <div class="w-100 alert alert-success alert-dismissible fade show" role="alert">
                            <p class="m-0">O produto foi atualizado com sucesso!</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    elseif (isset($_GET['updateError'])):
                    ?>
                        <div class="w-100 alert alert-warning alert-dismissible fade show" role="alert">
                            <p class="m-0">
                                Oops. Parece que há alguma coisa errada com as informações do produto.
                                Verifique-as e tente novamente.
                            </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>  
                    <?php
                    elseif (isset($_GET['internalError'])):
                    ?>
                        <div class="w-100 alert alert-danger alert-dismissible fade show" role="alert">
                            <p class="m-0">
                            Oops. Parece que algum irro interno impediu o cadastro do produto.
                            Nossos macaquinhos já foram avisados sobre isso.
                            Aguarde um pouco e tente novamente.
                            </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>  
                    <?php
                    endif;
                endif;
                ?>

                <fieldset class="main__form-fieldset">
                    <legend>Informações do Produto</legend>
                    <div class="mb-3 d-flex flex-column flex-md-row justify-content-evenly gap-md-2">
                        <div class="w-100 mb-3 mb-lg-0">      
                            <label for="nome-input" class="form-label">Nome do Produto</label>
                            <span class='text-danger ms-2 main__form-nome--valid'>
                                <i class="bi bi-exclamation-circle"></i>
                                Nome Inválido
                            </span>
                            <input type="text" class="form-control" id="nome-input" name="nome-input" value="<?php echo $data['name']; ?>" required>
                        </div>
                    
                        <div class="w-100 mb-3 mb-lg-0">
                            <label for="valor-input" class="form-label">Valor</label>
                            <input type="text" class="form-control" id="valor-input" name="valor-input" value="R$ <?php echo formatToBrazilianMoney($data['value']); ?>" required> 
                        </div>
                        
                        <div class="w-100 mb-3 mb-lg-0">
                            <label for="quantidade-input" class="form-label">Quantidade</label>
                            <input type="number" class="form-control" id="quantidade-input" name="quantidade-input" value="<?php echo $data['quantity']; ?>" required> 
                        </div>
                    </div>
                    
                    <div class="mb-3 d-flex flex-column justify-content-evenly gap-2">
                        <div class="w-100 mb-3 mb-lg-0">
                            <label for="categoria-input" class="form-label">Categoria do produto</label>
                            <span class='text-danger ms-2 main__form-categoria--valid'>
                                <i class="bi bi-exclamation-circle"></i> 
                                Categoria Inválida
                            </span>
                            <select class="form-select" id="categoria-input" name="categoria-input" aria-label="Identificação de gênero" required>
                                <option value="">Selecione uma categoria...</option>
                                <option value="perifericos" <?php echo $data['category']==='perifericos' ? 'selected' : ''; ?>>Periféricos</option>
                                <option value="notebooks" <?php echo $data['category']==='notebooks' ? 'selected' : ''; ?>>Notebooks</option>
                                <option value="celulares" <?php echo $data['category']==='celulares' ? 'selected' : ''; ?>>Celulares</option>
                                <option value="NFT" <?php echo $data['category']==='NFT' ? 'selected' : ''; ?>>NFT</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 d-flex flex-column flex-md-row justify-content-evenly gap-md-2">
                        <div class="w-100 mb-3 mb-lg-0">
                            <label for="descricao-input" class="form-label">Descrição</label>
                            <textarea type="text" class="form-control" id="descricao-input" name="descricao-input"><?php echo $data['description']; ?></textarea> 
                        </div>
                    </div>
                   
                    <div class="mb-3 d-flex flex-column flex-md-row justify-content-evenly gap-md-2">
                        <div class="w-100 mb-3 mb-lg-0">
                            <label for="imagem-input" class="form-label">Adicione uma imagem do produto</label>
                            <input type="file" class="form-control" id="imagem-input" name="imagem-input">
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
        <script src="../static/js/insertProduct/inputMasks.js"></script>
        <script src="../static/js/insertProduct/validateProduct.js"></script>
    </body>
</html>