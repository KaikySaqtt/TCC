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
<div class="img-fundo" style="background-image: url(../kmimagens/background-marmitas.png);">
    <div class="texto-inicial-jantares text-center">
        <h1 class="agrandir">Coma comida caseira todo dia <br> sem precisar cozinhar!</h1>
        <a href="../marmitas-e-dietas/agendamento.php" class="btn btn-km btn-lg mt-3">Pedir orçamento</a>
    </div>
</div>
<section>
    <div class="mais-info-jantares rounded-3 container">
    
            <h2 class="agrandir text-center pt-4">Nunca mais se preocupe em cozinhar ou sair da dieta!</h2>
            <h5 class="text-center">Oferecemos marmitas e produção de dietas personalizadas!</h5>
            <div class="row row-cols-1 row-cols-sm-2 justify-content-center g-3 mt-3 pb-3">
            <div class="col d-flex justify-content-center">
                <div class="card shadow-sm" style="width: 22rem;">
                    <img src="../kmimagens/km2.png" class="card-img-top" alt="Jantares privativos">
                    <div class="card-body text-center">
                        <h5 class="card-title">Planejamento de dieta para a sua necessidade</h5>
                        <a href="agendamento.php" class="btn btn-km">Pedir orçamentos</a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center">
                <div class="card shadow-sm" style="width: 22rem;">
                    <img src="../kmimagens/marmitas42.png" class="card-img-top" alt="Marmitas">
                    <div class="card-body text-center">
                        <h5 class="card-title">Marmitas fitness ou comuns, quem escolhe é você</h5>
                        <a href="agendamento.php" class="btn btn-km">Pedir orçamentos</a>
                    </div>
                </div>
            </div>
    </div>
</section>
    
</div>

<?php include(FOOTER_TEMPLATE); ?>