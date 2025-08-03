
        
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>CRUD com Bootstrap</title>
        <meta name="description" content="Material da aula de PW">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo BASEURL; ?>inc/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
            .btn-light {
                color: #ffffff;
                background-color: #999999;
                border-color: #999999;
            }
            .btn-outline-dark {
                color: #ffffff;
                border-color: #666666;
            }
            header, .actions {
                margin-bottom: 20px;
            }
            .btn-light:hover
            {
                background-color: #888888;
                color: #ffffff;
                border-color: #888888;
            }
            .navbody{
                background-color: #677483;
            }
            .navbody a{
                 color: #eeececff;
            }
            .dropdown-menu{
                background-color: #677483;
                color: #e7e7e7ff;
            }
            .km{
              width: 180px;
              height : auto;

            }
            .kmdiv{
                display: flex;
                justify-content: center;
                align-items: center;
                margin: auto;
                margin-right: 15%;
            }

             @media (max-width: 767px) {
                .kmdv{
                    display: none;
                }
                }
            @media (max-width: 410px) {
                .kmdv{
                    display: none;
                }
                .kmdiv{
                    display: none;
                }
                }
             @media (min-width: 767px) {
                .kmdiv{
                    display: none;
                }
                }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbody navbar-dark fixed-top">
            <div class="container containerbetween">
                <a href="<?php echo BASEURL; ?>" class="navbar-brand">
                    <i class="fa-solid fa-house-chimney"></i> Home
                 </a>
                <div class="kmdiv">
                    <img class="km" src="/TCC/inc/kmcc.png">       
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-users"></i>    Serviços
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php"><i class="fa-solid fa-user-plus"></i> Jantares almoços privados</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers"><i class="fa-solid fa-users"></i> Marmitas e finger foods</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-people-group"></i>    Gerentes
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="<?php echo BASEURL; ?>gerente">
                                            <i class="fa-solid fa-people-group"></i>    Gerenciar Gerentes
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo BASEURL; ?>gerente/add.php">
                                            <i class="fa-solid fa-person-circle-plus"></i>    Novo Gerente
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <?php if (isset($_SESSION['user'])): // Verifica se está logado ?>
                                <?php if ($_SESSION['user'] == "admin"): // Verifica se está logado como admin ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-user-lock"></i> ADM
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>users/add.php"><i class="fa-solid fa-user-tie"></i> Clientes registrados</a></li>
                                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>users"><i class="fa-solid fa-user-lock"></i> Serviços encomendados</a></li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                            <li>
                                <div class="kmdv">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <img class="km" src="/TCC/inc/kmcc.png"> 
                                    </li>
                                </ul>
                                </div>
                            </li>
                        </ul>
                       
                        <ul class="navbar-nav">
                            <?php if (isset($_SESSION['user'])) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo BASEURL; ?>inc/logout.php">
                                        <!--<?php echo $_SESSION['user']; ?>-->  Desconectar <i class="fa-solid fa-person-walking-arrow-right"></i>
                                    </a>
                                </li>
                            <?php else : ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo BASEURL; ?>inc/login.php">
                                        <i class="fa-solid fa-users"></i> Login
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                
            </div>
        </nav>
        <main class="container">
        

        