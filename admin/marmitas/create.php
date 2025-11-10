<?php
if (!isset($_SESSION)) session_start();
include("functions.php");

// Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['user']) || $_SESSION['user']['id_user'] != 1) {
    header("Location: /TCC/index.php");
    exit;
}

// Busca clientes para preencher o select
$clientes = find_all('clientes'); // ajuste conforme o nome real da tabela

if (isset($_POST['marmita'])) {
    add($_POST['marmita']);
    header('Location: index.php');
    exit;
}

include(HEADER_TEMPLATE);
?>

<h2 class="page-title">Cadastrar novo orçamento</h2>

<form class="form-edit-mar" action="create.php" method="post" enctype="multipart/form-data">
    <div class="form-edit-row mb-5 mt-5"> 
        <div class="form-edit-group col-md-3">
            <label><h6>CPF ou CNPJ do cliente</h6></label>
            <input type="text" class="form-edit-control" name="marmita[cpf_cnpj_usuario]" required>
        </div>


        <div class="form-edit-group col-md-3">
            <label><h6>Quantidade de marmitas</h6></label>
            <input type="number" class="form-edit-control" name="marmita[quantidade_marmitas]" required>
        </div>

        <div class="form-edit-group col-md-3">
            <label><h6>Data do orçamento</h6></label>
            <input type="date" class="form-edit-control" name="marmita[data_do_orcamento_mar]" required>
        </div>
    </div>

    <div class="form-edit-row mb-5 mt-5">
        <div class="form-edit-group col-md-3">
            <label><h6>Fit ou normal</h6></label>
            <input type="text" class="form-edit-control" name="marmita[fit_ou_normal]" required>
        </div>

        <div class="form-edit-group col-md-3">
            <label><h6>Quer dieta ou não</h6></label>
            <select class="form-edit-control" name="marmita[dieta_ou_nao]">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
        </div>

        <div class="form-edit-group col-md-4">
            <label><h6>Detalhes do orçamento</h6></label>
            <input type="text" class="form-edit-control" name="marmita[detalhes_mar]" required>
        </div>
    </div>

    <div class="col-md-12 mt-2">
        <button type="submit" class="btn-crud btn-edit mb-1">
            <i class="fa-solid fa-sd-card"></i> Salvar
        </button>
        <a href="index.php" class="btn-crud btn-delete">
            <i class="fa-solid fa-arrow-left"></i> Cancelar
        </a>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
