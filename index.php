<?php
require "config.php";
include_once DBAPI;
if (!isset($_SESSION))
    session_start();
include(HEADER_TEMPLATE);
$db = open_database();
?>
<?php if ($db): ?>
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
            <?php echo $_SESSION['message']; ?></>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php clear_messages(); ?>
<?php endif; ?>

<div class="int">
    <div class="esquerda">
        <h1 class="agrandir"> <b> Um restaurante em sua residência </b></h1>
        <h4 class="agrandir">Desfrute de uma experiência culinária personalizada <br> 
        com a personal chef Karol Marques <br>
        tudo no conforto da sua própria casa! </h2>
    </div>
    <div class="direita">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="card cardleft " style="width: 12vw; ">
                        <img class="card-img-top rounded" src="kmimagens/km1.png" alt="Imagem de capa do card">
                    </div>
                    <div class="card cardleft " style="width: 12vw;">
                        <img class="card-img-top rounded" src="kmimagens/docepote.png" alt="Imagem de capa do card">
                    </div>
                    <div class="card cardleft " style="width: 12vw;">
                        <img class="card-img-top rounded" src="kmimagens/marmitas42.png" alt="Imagem de capa do card">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card cardmeio" style="width: 12vw;">
                        <img class="card-img-top rounded" src="kmimagens/docepote4.png" alt="Imagem de capa do card">
                    </div>
                    <div class="card cardmeio" style="width: 12vw;">
                        <img class="card-img-top rounded" src="kmimagens/km2.png" alt="Imagem de capa do card">
                    </div>
                    <div class="card cardmeio" style="width: 12vw;">
                        <img class="card-img-top rounded" src="kmimagens/marmitas4.png" alt="Imagem de capa do card">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card cardrigth " style="width: 12vw;">
                        <img class="card-img-top rounded" src="kmimagens/marmita2.png" alt="Imagem de capa do card">
                    </div>
                    <div class="card cardrigth " style="width: 12vw;">
                        <img class="card-img-top rounded" src="kmimagens/docepote2.png" alt="Imagem de capa do card">
                    </div>
                    <div class="card cardrigth " style="width: 12vw;">
                        <img class="card-img-top rounded" src="kmimagens/km3.png" alt="Imagem de capa do card">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="services">

</div>
    <?php include(FOOTER_TEMPLATE); ?>