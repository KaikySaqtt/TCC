<?php
require "config.php";
include_once DBAPI;
if (!isset($_SESSION)) session_start();
include(HEADER_TEMPLATE);
$db = open_database();
?>
<?php if ($db): ?>
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['type']; ?> alert-dismissible" role="alert">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif;
    clear_messages(); ?>
<?php endif; ?>

<!-- INT / HERO -->
<section class="int container py-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-6 text-center text-lg-start esquerda">
            <h1 class="agrandir fw-bold">Um restaurante em sua residência</h1>
            <h4 class="agrandir lh-base">
                Desfrute de uma experiência culinária personalizada
                <br class="d-none d-lg-inline">com a personal chef Karol Marques
                <br class="d-none d-lg-inline">tudo no conforto da sua própria casa!
            </h4>
            <a href="#" class="btn btn-km btn-lg mt-3">Começar</a>
        </div>

        <div class="col-lg-6 direita">
            <!-- Grid de cards (mosaico estático em HTML) -->
            <div class="row g-3 row-cols-2 row-cols-md-3 gallery container">
                <div class="col col-responsive">
                    <div class="card shadow-sm h-100">
                        <div class="ratio ratio-1x1">
                            <img src="kmimagens/km1.png" class="w-100 h-100" alt="Imagem 1">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm h-100 card-meio">
                        <div class="ratio ratio-1x1">
                            <img src="kmimagens/docepote.png" class="w-100 h-100" alt="Imagem 2">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm h-100 card-direita">
                        <div class="ratio ratio-1x1">
                            <img src="kmimagens/marmitas42.png" class="w-100 h-100" alt="Imagem 3">
                        </div>
                    </div>
                </div>
                <div class="col col-responsive">
                    <div class="card shadow-sm h-100">
                        <div class="ratio ratio-1x1">
                            <img src="kmimagens/docepote4.png" class="w-100 h-100" alt="Imagem 4">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm h-100 card-meio">
                        <div class="ratio ratio-1x1">
                            <img src="kmimagens/km2.png" class="w-100 h-100" alt="Imagem 5">
                        </div>
                    </div>
                </div>
                <div class="col col-responsive">
                    <div class="card shadow-sm h-100 card-direita">
                        <div class="ratio ratio-1x1">
                            <img src="kmimagens/marmitas4.png" class="w-100 h-100" alt="Imagem 6">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <div class="ratio ratio-1x1">
                            <img src="kmimagens/comida1.png" class="w-100 h-100" alt="Imagem 7">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm h-100 card-meio">
                        <div class="ratio ratio-1x1">
                            <img src="kmimagens/docepote2.png" class="w-100 h-100" alt="Imagem 8">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm h-100 card-direita">
                        <div class="ratio ratio-1x1">
                            <img src="kmimagens/comida3.png" class="w-100 h-100" alt="Imagem 9">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- SERVICES -->
<section class="services py-5">
    <div class="container bg-white rounded-3 p-4 p-md-5 shadow-sm">
        <div class="row align-items-center g-4">
            <div class="col-lg-5">
                <h4 class="agrandir text-center text-lg-start">
                    Descubra nossos serviços especializados e personalizados para você!
                </h4>
            </div>
            <div class="col-lg-7">
                <div class="row g-4 row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <div class="card h-60 shadow-sm">
                            <img src="kmimagens/comida.png" class="card-img-top" alt="Jantares privativos">
                            <div class="card-body text-center">
                                <h5 class="card-title">Jantares e almoços privativos</h5>
                                <a href="#" class="btn btn-km">Ver mais</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="kmimagens/marmita2.png" class="card-img-top" alt="Marmitas e finger food">
                            <div class="card-body text-center">
                                <h5 class="card-title">Marmitas e Dietas personalizadas</h5>
                                <a href="#" class="btn btn-km">Ver mais</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SOBRE KM -->
<section class="sobre-km py-5">
    <div class="container rounded-3 p-4 p-md-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-5">
                <h3 class="agrandir">
                    Conheça mais da nossa personal chef Karol Marques, especialista em gastronomia
                </h3>
                <a href="#" class="btn btn-km mt-3">Ver mais</a>
            </div>
            <div class="col-lg-7">
                <div class="row g-3 row-cols-2">
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="card-img-top" src="kmimagens/km6.png" alt="Karol 1">
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="card-img-top" src="kmimagens/km3.png" alt="Karol 2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(FOOTER_TEMPLATE); ?>