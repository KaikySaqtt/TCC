<?php
if (!isset($_SESSION)) session_start();
include("functions.php");

// Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['user']) || $_SESSION['user']['id_user'] != 1) {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: /TCC/index.php");
    exit;
}

// Verifica se o ID foi passado
if (!isset($_GET['id_mar'])) {
    die("ID da marmita não informado.");
}

$id_mar = $_GET['id_mar'];

// Busca os dados da marmita antes de exibir o formulário
view($id_mar);

// Processa o POST (quando o formulário é enviado)
if (isset($_POST['marmita'])) {
    $marmitaPost = $_POST['marmita'];
    $db = open_database();
    try {
        $stmt = $db->prepare('UPDATE tab_orcamento_marmita 
            SET quantidade_marmitas = :quantidade_marmitas, 
                cpf_cnpj_usuario = :cpf_cnpj_usuario,   
                fit_ou_normal = :fit_ou_normal, 
                dieta_ou_nao = :dieta_ou_nao, 
                detalhes_mar = :detalhes_mar
            WHERE id_mar = :id_mar');

        // Preparar variáveis
        $quantidade_marmitas = $marmitaPost['quantidade_marmitas'] ?? null;
        $cpf_cnpj_usuario    = $marmitaPost['cpf_cnpj_usuario'] ?? null;
        $fit_ou_normal       = $marmitaPost['fit_ou_normal'] ?? null;
        $dieta_ou_nao        = $marmitaPost['dieta_ou_nao'] ?? null;
        $detalhes_mar        = $marmitaPost['detalhes_mar'] ?? null;

        // Bind dos parâmetros
        $stmt->bindParam(':quantidade_marmitas', $quantidade_marmitas, PDO::PARAM_INT);
        $stmt->bindParam(':cpf_cnpj_usuario', $cpf_cnpj_usuario, PDO::PARAM_STR);
        $stmt->bindParam(':fit_ou_normal', $fit_ou_normal, PDO::PARAM_STR);
        $stmt->bindParam(':dieta_ou_nao', $dieta_ou_nao, PDO::PARAM_STR);
        $stmt->bindParam(':detalhes_mar', $detalhes_mar, PDO::PARAM_STR);
        $stmt->bindParam(':id_mar', $id_mar, PDO::PARAM_INT);

        $stmt->execute();
        $_SESSION['message'] = "Orçamento atualizado com sucesso!";
        $_SESSION['type'] = "success";
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        echo 'Erro ao atualizar orçamento de marmita: ' . $e->getMessage();
    }
}

include(HEADER_TEMPLATE);
?>

<h2 class="page-title">Atualizar orçamento</h2>

<form class="form-edit-mar" action="edit.php?id_mar=<?php echo $marmita['id_mar']; ?>" method="post" enctype="multipart/form-data">
    <hr>

    <div class="form-edit-row mb-5 mt-5">
        <div class="form-edit-group col-md-2">
            <label><h6>ID do Pedido</h6></label>
            <input type="text" class="form-edit-control" value="<?php echo $marmita['id_mar']; ?>" disabled>
        </div>

        <div class="form-edit-group col-md-3">
            <label><h6>Quantidade de marmitas</h6></label>
            <input type="text" class="form-edit-control" name="marmita[quantidade_marmitas]" value="<?php echo $marmita['quantidade_marmitas']; ?>" required>
        </div>

        <div class="form-edit-group col-md-3">
            <label><h6>CPF ou CNPJ do cliente</h6></label>
            <input type="text" class="form-edit-control" name="marmita[cpf_cnpj_usuario]" value="<?php echo $marmita['cpf_cnpj_usuario']; ?>" required>
        </div>

        <div class="form-edit-group col-md-3">
            <label><h6>Data de emissão do pedido</h6></label>
            <input type="date" class="form-edit-control" value="<?php echo date('Y-m-d', strtotime($marmita['data_do_orcamento_mar'])); ?>" disabled>
        </div>
    </div>

    <div class="form-edit-row mb-5 mt-5">
        <div class="form-edit-group col-md-3">
            <label><h6>Fit ou normal</h6></label>
            <input type="text" class="form-edit-control" name="marmita[fit_ou_normal]" value="<?php echo $marmita['fit_ou_normal']; ?>" required>
        </div>

        <div class="form-edit-group col-md-3">
            <label><h6>Quer dieta ou não</h6></label>
            <select class="form-edit-control" name="marmita[dieta_ou_nao]">
                <option value="1" <?php echo $marmita['dieta_ou_nao'] ? 'selected' : ''; ?>>Sim</option>
                <option value="0" <?php echo !$marmita['dieta_ou_nao'] ? 'selected' : ''; ?>>Não</option>
            </select>
        </div>

        <div class="form-edit-group col-md-4">
            <label><h6>Detalhes do orçamento</h6></label>
            <input type="text" class="form-edit-control" name="marmita[detalhes_mar]" value="<?php echo $marmita['detalhes_mar']; ?>" required>
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
