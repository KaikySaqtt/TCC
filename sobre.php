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

<!-- SOBRE KM -->
<section class="sobre-km py-5">
    <div class="container rounded-3 p-4 p-md-5">
        <div class="row align-items-center g-4">
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
            <div class="col-lg-5">
                <h3 class="agrandir">
                    Conheça mais da nossa personal chef Karol Marques, especialista em gastronomia,sua missão é a de levar a boa gastronomia para a vida das pessoas, fazendo eventos em sua residencia! Ela tabmém tem serviços de produção de marmitas e dietas especias para seus cliente. 
                </h3>
            </div>
        </div>
    </div>
</section>
<!-- SERVICES -->
<section class="services py-5 mt-3">
    <div class="container bg-white rounded-3 p-4 p-md-5 shadow-sm">
        <div class="row align-items-center g-4">
            <div class="col-lg-5">
                <h4 class="agrandir text-center text-lg-start">
                    Descubra as formações da nossa chef particular Karol marques! Ela fez o curso de gastronomia pela escola gastronomica de Érick Jacquin, o IGA
                </h4>
            </div>
            <div class="col-lg-7">
                <div class="row g-4 row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <div class="card h-60 shadow-sm">
                            <img src="kmimagens/iga.png" class="card-img-top" alt="Jantares privativos">
                            <div class="card-body text-center">
                                <a href="https://iga-la.com/bra/cursos-de-gastronomia-no-brasil/" target="_blank" class="btn btn-km">Ver mais sobre</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="kmimagens/marmita2.png" class="card-img-top" alt="Marmitas e finger food">
                            <div class="card-body text-center">
                                <h5 class="card-title">Marmitas e Dietas personalizadas para você</h5>
                                <a href="../TCC/marmitas-e-dietas/" class="btn btn-km">Ver mais</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>



<?php include(FOOTER_TEMPLATE); ?>