<?php
if (!isset($_SESSION)) session_start();
include('functions.php');
add();
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

<head>
    <style>
        body {
            background-color: #9b9b9bff;
        }
    </style>
</head>
<section class="container my-5">
    <div class="form-card mx-auto">
        <h2 class="form-title">Solicitar Orçamento</h2>
        <form action="agendamento.php" method="post">
            <div class="mb-3">
                <label for="quantidadeMarmitas" class="form-label">Quantas marmitas deseja por semana? (mínimo 5)</label>
                <input type="number" class="form-control" id="quantidadeMarmitas" name="quantidade_marmitas" placeholder="Ex: 5" required>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Será fit ou normal?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_marmita" id="fit" value="fit">
                    <label class="form-check-label" for="fit">Fit</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_marmita" id="normal" value="normal">
                    <label class="form-check-label" for="normal">Normal</label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label d-block">Você deseja que planeje uma dieta ou você já possui um plano alimentar?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dieta_ou_nao" id="planejar_dieta" value="Sim" require>
                    <label class="form-check-label" for="montar-dieta">Quero que planeje uma dieta</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dieta_ou_nao" id="não-planejar" value="Não" require>
                    <label class="form-check-label" for="não-planejar">Já tenho um plano</label>
                </div>
            </div>
            <p class="form-title">Caso você possua um arquivo com a sua dieta ou detalheamento das refeições encaminhe posteriormente para a chef!</p>
            <div class="mb-4">
                <label for="detalhesPedido" class="form-label">Observações</label>
                <textarea class="form-control" id="detalhes_pedido" name="detalhes_mar" rows="4" placeholder="Detalhe sobre os seus pedidos aqui..."></textarea>
            </div>

            <div class="d-grid">
                <h6 class="form-title">Você será levado para o whatsapp de nossa personal chef!</h6>
                <button type="submit" class="btn btn-km" onclick="sendwhatsappmarmita()">Enviar orçamento</button>
            </div>
        </form>
    </div>
</section>


<?php include(FOOTER_TEMPLATE); ?>