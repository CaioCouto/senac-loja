<header>
    <nav class="navbar navbar-expand-xl navbar-dark">
        <div class="container-fluid justify-content-between">
            <a class="navbar-brand header__brand text-center fw-bold fs-1 m-0" href="/">XPTOStore</a>
                        
            <button 
                class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse header__collapse justify-content-between w-75" id="navbarSupportedContent">
                <form class="input-group mb-0 mt-2 mt-xl-0 header__search">
                    <i class="bi bi-search input-group-text"></i>
                    <input class="form-control" type="search" placeholder="Digite o nome do produto" aria-label="Busca">
                </form>

                <ul class="navbar-nav mb-2 mb-xl-0 justify-content-xl-around header__list">
                    <li class="nav-item">
                        <a class="nav-link <?php echo setLinkActiveClass('home'); ?>" aria-current="page" href="/">Home</a>
                    </li>

                    <?php if (session_id()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Olá, <?php echo $_SESSION['userFullName'] ?>
                            </a>
                            
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../../pages/myAccount.php">Minha Conta</a></li>
                                
                                <?php if ($_SESSION['userStatus'] === 'admin'): ?>
                                    <li><a class="dropdown-item" href="../../pages/createUser.php">Cadastrar Usuário</a></li>
                                    <li><a class="dropdown-item" href="../../pages/insertProduct.php">Cadastrar Produto</a></li>
                                    <li><a class="dropdown-item" href="../../pages/updateUser.php">Editar Usuário</a></li>
                                    <li><a class="dropdown-item" href="../../pages/updateProduct.php">Editar Produto</a></li>    
                                <?php elseif ($_SESSION['userStatus'] === 'collab'): ?>
                                    <li><a class="dropdown-item" href="../../pages/insertProduct.php">Cadastrar Produto</a></li>
                                    <li><a class="dropdown-item" href="../../pages/updateProduct.php">Editar Produto</a></li>    
                                <?php endif; ?>

                                <li><a class="dropdown-item" href="../php/handlers/handleSignOut.php">Sair</a></li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link <?php echo setLinkActiveClass('shoppingcart'); ?>" href="../../pages/shoppingcart.php">Carrinho</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo setLinkActiveClass('login'); ?>" href="../../pages/login.php">Entrar</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo setLinkActiveClass('signup'); ?>" href="../../pages/signUp.php">Cadastrar</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Departamentos
                            </a>
                            <ul class="dropdown-menu  " aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Eletrônicos</a></li>
                                <li><a class="dropdown-item" href="#">Moda</a></li>
                                <li><a class="dropdown-item" href="#">Sapatos</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>              
                </ul>
            </div>
        </div>
    </nav>
</header>