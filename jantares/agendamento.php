<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['user'])) {
    echo '
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modalHtml = `
                <div class="modal fade" id="login-required-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginRequiredLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h1 class="modal-title fs-5" id="loginRequiredLabel">Acesso Negado</h1>
                            </div>
                            <div class="modal-body">
                                Você precisa estar logado para acessar esse recurso.
                            </div>
                            <div class="modal-footer">
                                <a href="index.php" class="btn btn-primary">Ir para Login</a>
                            </div>
                        </div>
                    </div>
                </div>`;
            
            document.body.insertAdjacentHTML("beforeend", modalHtml);
            const modal = new bootstrap.Modal(document.getElementById("login-required-modal"));
            modal.show();
        });
    </script>
    ';
}
include('functions.php');
add();
include(HEADER_TEMPLATE);
$db = open_database();
?>
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
                    <label for="quantidadePessoas" class="form-label">Quantas pessoas terá no evento?</label>
                    <input type="number" class="form-control" id="quantida_pessoas" name="quantidade_pessoas" placeholder="Ex: 15" required>
                </div>

                <div class="mb-4">
                    <label for="endereco" class="form-label">Endereço completo do evento</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua, número, bairro e cidade" required>
                </div>

                <div class="mb-4">
                    <label for="data_do_evento" class="form-label">Data do evento</label>
                    <input type="date" class="form-control" id="data_do_evento" name="data_do_evento" required>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Qual a refeição principal?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo_refeicao" id="almoco" value="almoço">
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
                        <input class="form-check-input" type="checkbox" value="sim" id="incluir_sobremesa" name="incluir_sobremesa">
                        <label class="form-check-label" for="incluirSobremesa">
                            Sobremesa
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="sim" id="incluir_drinks" name="incluir_drinks">
                        <label class="form-check-label" for="incluirDrinks">
                            Drinks
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="detalhesPedido" class="form-label">Observações</label>
                    <textarea class="form-control" id="detalhes_pedido" name="detalhes_pedido" rows="4" placeholder="Detalhe sobre os seus pedidos aqui..."></textarea>
                </div>

                <div class="d-grid">
                    <h6 class="form-title">Você será levado para o whatsapp de nossa personal chef!</h6>
                    <button type="submit" class="btn btn-km" onclick="sendwhatsappjantar()">Enviar orçamento</button>
                </div>
            </form>
        </div>
    </section>


    <?php include(FOOTER_TEMPLATE); ?>