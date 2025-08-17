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
<div style="position: relative;">
    <div class="int">
        <div class="esquerda">
            <h1 class="agrandir"> <b> Um restaurante em sua residência </b></h1>
            <h4 class="agrandir">Desfrute de uma experiência culinária personalizada <br>
                com a personal chef Karol Marques <br>
                tudo no conforto da sua própria casa! </h4>
             <div class="d-flex justify-content-center mt-2">
                <a href="#" class="btn btn-km">Começar</a>
             </div>
        </div>
        <div class="direita">
            <div class="container">
                <div class="row flex-nowrap int-cards">
                    <div class="col-sm">
                        <div class="card cardleft cardtopo" style="width: 12vw; ">
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
                        <div class="card cardmeio cardtopo" style="width: 12vw;">
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
                        <div class="card cardrigth cardtopo" style="width: 12vw;">
                            <img class="card-img-top rounded" src="kmimagens/comida1.png" alt="Imagem de capa do card">
                        </div>
                        <div class="card cardrigth " style="width: 12vw;">
                            <img class="card-img-top rounded" src="kmimagens/docepote2.png" alt="Imagem de capa do card">
                        </div>
                        <div class="card cardrigth " style="width: 12vw;">
                            <img class="card-img-top rounded" src="kmimagens/comida3.png" alt="Imagem de capa do card">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="services d-flex justify-content-center align-items-center">
        <section class="container rounded">
            <div class="tituloeventos">
                <h4 class="agrandir">Descubra nossos serviços especializados e personalizados para você!</h4>
            </div>
            <div class="eventos d-flex align-items-center">
                <div class="row flex-nowrap">
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body ">
                                <h5 class="card-title text-center">Jantares privativos</h5>
                                <img class="card-img" src="kmimagens/comida.png" alt="Imagem de capa do card">
                                <div class="d-flex justify-content-center mt-2">
                                    <a href="#" class="btn btn-km">Ver mais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body ">
                                <h5 class="card-title text-center">Marmitas e finger food</h5>
                                <img class="card-img" src="kmimagens/marmita2.png" alt="Imagem de capa do card">
                                <div class="d-flex justify-content-center mt-2">
                                    <a href="#" class="btn btn-km">Ver mais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="sobre-km d-flex justify-content-center align-items-center">
        <section class="container rounded">
            <div class="kmesquerda d-flex align-items-center">
                <div class="container flex-column  mb-2 ">
                    <h3 class="agrandir">Conheça mais da nossa personal chef Karol Marques, especialista em gastronomia </h3>
                    <div class="">
                        <a href="#" class="btn btn-km">Ver mais</a>
                    </div>
                </div>
              
            </div>
            <div class="kmdireita d-flex align-items-center" style="margin-bottom: 30vh;">
                <div class="row flex-nowrap">
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body">
                                <img class="card-img img-km" src="kmimagens/km6.png" alt="Imagem de capa do card">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body">
                                <img class="card-img img-km" src="kmimagens/km3.png" alt="Imagem de capa do card">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php include(FOOTER_TEMPLATE); ?>