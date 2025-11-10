<?php
if (!isset($_SESSION)) session_start();
include("functions.php");

// Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['user']) || $_SESSION['user']['id_user'] != 1) {
    header("Location: /TCC/index.php");
    exit;
}
// Chama a função add() caso o formulário seja enviado
add();

include(HEADER_TEMPLATE);
?>

<h2>Novo orçamento</h2>

<form class="form-edit-jan" action="create.php" method="post" enctype="multipart/form-data">
    <hr>

    <div class="form-edit-row mb-5 mt-5">
        <div class="form-edit-group col-md-4">
            <label><h6>Endereço</h6></label>
            <input type="text" class="form-edit-control" name="jantar[endereco]" required>
        </div>

        <div class="form-edit-group col-md-2">
            <label><h6>Quantidade de pessoas</h6></label>
            <input type="number" class="form-edit-control" name="jantar[quantidade_pessoas]" required>
        </div>

        <div class="form-edit-group col-md-3">
            <label><h6>CPF ou CNPJ do cliente</h6></label>
            <input type="text" class="form-edit-control" name="jantar[cpf_cnpj_usuario]" required>
        </div>

        <div class="form-edit-group col-md-2">
            <label><h6>Data do evento</h6></label>
            <input type="date" class="form-edit-control" name="jantar[data_do_evento]" required>
        </div>
    </div>

    <div class="form-edit-row mb-5 mt-5">
        <div class="form-edit-group col-md-2">
            <label><h6>Jantar ou almoço</h6></label>
            <select class="form-edit-control" name="jantar[jantar_ou_almoco]" required>
                <option value="">Selecione</option>
                <option value="Jantar">Jantar</option>
                <option value="Almoço">Almoço</option>
            </select>
        </div>

        <div class="form-edit-group col-md-2">
            <label><h6>Incluir drinks</h6></label>
            <select class="form-edit-control" name="jantar[drinks]">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
        </div>

        <div class="form-edit-group col-md-2">
            <label><h6>Incluir sobremesas</h6></label>
            <select class="form-edit-control" name="jantar[sobremesas]">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
        </div>

        <div class="form-edit-group col-md-4">
            <label><h6>Detalhes do orçamento</h6></label>
            <input type="text" class="form-edit-control" name="jantar[detalhes_jan]" required>
        </div>
    </div>

    <div class="col-md-12 mt-2">
        <button type="submit" class="btn-crud btn-edit mb-1">
            <i class="fa-solid fa-plus"></i> Criar
        </button>
        <a href="index.php" class="btn-crud btn-delete">
            <i class="fa-solid fa-arrow-left"></i> Cancelar
        </a>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
