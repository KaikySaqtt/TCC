<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>personal Chef Karol Marques</title>
    <meta name="description" content="Site da personal chef Karol Marques">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo BASEURL; ?>inc/imgs/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbody navbar-dark fixed-top">
        <div class="kmhome">
            <a href="<?php echo BASEURL; ?>"> <img class="kmnome" src="/TCC/inc/imgs/kmnome.png"> </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 navcontainer">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-kitchen-set"></i> Serviços
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>jantares/"><i class="fa-solid fa-utensils"></i> Jantares almoços privados</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>marmitas-e-dietas/"><i class="bi bi-wallet-fill"></i> Marmitas e dietas</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" aria-expanded="false">
                        <i class="fa-solid fa-calendar-days"></i> Agendamento
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" aria-expanded="false">
                        <i class="fa-solid fa-person-dress"></i> Sobre Karol 
                    </a>
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
                    <ul class="navbar-nav kmpanela">
                        <li class="nav-item">
                            <img class="km" src="/TCC/inc/imgs/kmpanela.png">
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASEURL; ?>inc/logout.php">
                            <!--<?php echo $_SESSION['user']; ?>--> Desconectar <i class="fa-solid fa-person-walking-arrow-right"></i>
                        </a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASEURL; ?>inc/login.php" style="margin-right: 10px">
                            <i class="fa-solid fa-users"></i> Login
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <main class="">