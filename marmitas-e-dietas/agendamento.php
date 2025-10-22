<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['user'])) {
    echo '
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modalHtml = `
                <div class="modal fade" id="login-required-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginRequiredLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-km">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="loginRequiredLabel">
                          <i class="bi bi-lock-fill me-2"></i> Acesso Negado
                        </h1>
                      </div>
                      <div class="modal-body">
                        Você precisa estar logado para acessar esse recurso.
                      </div>
                      <div class="modal-footer">
                        <a href="../inc/login.php" class="btn btn-km">Ir para Login</a>
                      </div>
                    </div>
                  </div>
                </div>
            `; // <-- aqui fechamos corretamente o template string

            // Insere o modal no final do body
            document.body.insertAdjacentHTML("beforeend", modalHtml);

            // Cria e mostra o modal com Bootstrap
            const modal = new bootstrap.Modal(document.getElementById("login-required-modal"));
            modal.show();
        });
    </script>';
}
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
                <label class="form-label d-block">Você deseja que planeje uma dieta personalizada para você?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dieta_ou_nao" id="planejar_dieta" value="Sim" require>
                    <label class="form-check-label" for="montar-dieta">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dieta_ou_nao" id="não-planejar" value="Não" require>
                    <label class="form-check-label" for="não-planejar">Não</label>
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