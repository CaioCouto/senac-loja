<?php
$functionsDir = dirname(__DIR__) . '/php/functions';
$componentsDir = dirname(__DIR__) . '/php/components';
require_once($functionsDir . '/logError.php');
require_once($functionsDir . '/startSession.php');
require_once($functionsDir . '/classesAutoload.php');
require_once($functionsDir . '/generalFunctions.php');
if (!session_id()) {
    header('Location: /login.php?notLogged=true');
}
elseif ($_SESSION['userStatus'] !== 'admin') {
    header('Location: /?notAllowed=true');
}

try {
    $baseURL = getBaseURL();
    $user = new UsersController();
    $data = $user->getUsers();
} catch (PDOException $e) {
    logError($e);
    $location = '/pages/updateUser.php?internalError=true';
}
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
            <?php
            if (!empty($_GET)):
                $queryParam = array_keys($_GET)[0];
                if($queryParam === 'deleteSuccess'):
            ?>
                    <div class="main__alert alert alert-success alert-dismissible fade show" role="alert">
                        <p class="m-0">O usuário foi excluído com sucesso!</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif ($queryParam === 'updateSuccess'): ?>
                    <div class="main__alert alert alert-success alert-dismissible fade show" role="alert">
                    <p class="m-0">O usuário foi atualizado com sucesso!</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>  
                <?php elseif ($queryParam === 'deleteError' or $queryParam === 'updateError'): ?>
                    <div class="main__alert alert alert-warning alert-dismissible fade show" role="alert">
                        <p class="m-0"> Oops. Parece que há alguma coisa impedindo que o usuário seja afetado. </p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>  
                <?php elseif ($queryParam === 'internalError'): ?>
                    <div class="main__alert alert alert-danger alert-dismissible fade show" role="alert">
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

            <?php foreach($data as $user): ?>
                <div class="main__card card mb-3 flex-md-row align-items-md-center justify-content-md-evenly">
                    <div class="main__card-description">
                        <div class="card-body">
                            <h5 class="card-title">Usuário</h5>
                            <p class="mb-1">Nome: <?php echo $user['name'] . ' ' . $user['surname']; ?></p>
                            <p class="mb-1">Email: <?php echo $user['email']; ?></p>
                            <p class="mb-1">CPF: <?php echo $user['cpf']; ?></p>
                            <p class="mb-3">Status: <?php echo $user['status']; ?></p>
                            <h5 class="card-title">Endereço</h5>
                            <p class="mb-1"><?php echo $user['address'] . ', ' .$user['houseNumber'] . ' - ' . $user['neighborhood']; ?></p>
                            <p class="mb-1"><?php echo $user['city'] ?></p>
                            <p class="mb-1"><?php echo $user['cep'] ?></p>
                        </div>
                    </div>

                    <div class="main__card-buttons d-flex flex-md-column justify-content-center align-items-md-center">
                        <a class="btn btn-primary mx-3 my-md-2 mx-md-0" href="editUser.php?usr=<?php echo $user['email']; ?>">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <a class="btn btn-danger mx-3 my-md-2 mx-md-0" href="../php/handlers/handleUserDelete.php?usr=<?php echo $user['email']; ?>">
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