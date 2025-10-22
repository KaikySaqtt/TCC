<?php
if (!isset($_SESSION)) session_start();
require("../config.php");
include_once DBAPI;
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
<div class="img-fundo" style="background-image: url(../kmimagens/background-jantares.png);">
    <div class="texto-inicial-jantares text-center">
        <h1 class="agrandir">Experiência de um restaurante <br>em sua residência</h1>
        <a href="../jantares/agendamento.php" class="btn btn-km btn-lg mt-3">Pedir orçamento</a>
    </div>
</div>
<section>
    <div class="mais-info-jantares rounded-3 container">
            <h2 class="agrandir text-center pt-4">Viva um restaurante profissional em sua casa</h2>
            <h5 class="text-center">Cardápio personalizado pelo cliente, realize seu orçamento agora!</h5>
            <div class="row g-4 row-cols-1 row-cols-md-3 mt-3">
                <div class="col"> 
                    <div class="card shadow-sm" style="width:95%; height: auto">
                        <img src="../kmimagens/comida.png" class="card-img-top" alt="Jantares privativos">
                        <div class="card-body text-center">
                            <h5 class="card-title pb-1">Pratos <br> personalizados</h5>
                            <a href="../TCC/jantares/" class="btn btn-km btn-jantares">ir para orçamento</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm" style="width:95%; height: auto">
                        <img src="../kmimagens/docepote.png" class="card-img-top" alt="Marmitas">
                        <div class="card-body text-center">
                            <h5 class="card-title pb-1">Sobremesas <br> especias</h5>
                            <a href="../TCC/marmitas-e-dietas/" class="btn btn-km btn-jantares">ir para orçamento</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm mb-3 pb-1" style="width:95%; height: auto">
                        <img src="../kmimagens/sangria2.png" class="card-img-top" alt="Marmitas e finger food">
                        <div class="card-body text-center">
                            <h5 class="card-title pb-1">Drinks c/s <br>álcool</h5>
                            <a href="../TCC/marmitas-e-dietas/" class="btn btn-km btn-jantares">ir para orçamento</a>
                        </div>
                    </div>
                </div>

            </div>
    </div>
</section>
<?php include(FOOTER_TEMPLATE); ?>