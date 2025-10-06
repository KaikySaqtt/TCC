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
<div class="mais-info-jantares rounded-3 container">
    <section>
        <h2 class="agrandir text-center pt-4">Viva um dos melhores restaurante aonde você desejar</h2>
        <h5 class="text-center">Oferecemos diversos planos, venha conferir e realizar um orçamento!</h5>
        <div class="row g-4 row-cols-1 row-cols-sm-3 mt-3">
            <div class="col"> 
                <div class="card shadow-sm" style="width:95%; heigth: auto">
                    <img src="../kmimagens/comida.png" class="card-img-top" alt="Jantares privativos">
                    <div class="card-body text-center">
                        <h5 class="card-title">Jantares e almoços privativos aonde você quiser</h5>
                        <a href="../TCC/jantares/" class="btn btn-km">Ver mais</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm" style="width:95%; heigth: auto">
                    <img src="../kmimagens/marmita2.png" class="card-img-top" alt="Marmitas">
                    <div class="card-body text-center">
                        <h5 class="card-title">Marmitas e Dietas personalizadas para você</h5>
                        <a href="../TCC/marmitas-e-dietas/" class="btn btn-km">Ver mais</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm mb-3" style="width:95%; heigth: auto">
                    <img src="../kmimagens/marmita2.png" class="card-img-top" alt="Marmitas e finger food">
                    <div class="card-body text-center">
                        <h5 class="card-title">Marmitas e Dietas personalizadas para você</h5>
                        <a href="../TCC/marmitas-e-dietas/" class="btn btn-km">Ver mais</a>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?php include(FOOTER_TEMPLATE); ?>