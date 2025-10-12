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
        <form>
            <div class="mb-3">
                <label for="quantidadePessoas" class="form-label">Quantas pessoas terá no evento?</label>
                <input type="number" class="form-control" id="quantidadePessoas" name="quantidade_pessoas" placeholder="Ex: 15" required>
            </div>

            <div class="mb-4">
                <label for="endereco" class="form-label">Endereço completo do evento</label>
                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua, número, bairro e cidade" required>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Qual a refeição principal?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_refeicao" id="almoco" value="almoco">
                    <label class="form-check-label" for="almoco">Almoço</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_refeicao" id="jantar" value="jantar">
                    <label class="form-check-label" for="jantar">Jantar</label>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label d-block">Deseja incluir adicionais?</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="sim" id="incluirSobremesa" name="incluir_sobremesa">
                    <label class="form-check-label" for="incluirSobremesa">
                        Sobremesa
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="sim" id="incluirDrinks" name="incluir_drinks">
                    <label class="form-check-label" for="incluirDrinks">
                        Drinks
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label for="detalhesPedido" class="form-label">Observações</label>
                <textarea class="form-control" id="detalhesPedido" name="detalhes_pedido" rows="4" placeholder="Detalhe sobre os seus pedidos aqui..."></textarea>
            </div>

            <div class="d-grid">
                <h6 class="form-title">Você será levado para o whatsapp de nossa personal chef!</h6>
                <button type="button" class="btn btn-km" onclick="sendwhatsappjantar()">Enviar orçamento</button>
            </div>
        </form>
    </div>
</section>


<?php include(FOOTER_TEMPLATE); ?>