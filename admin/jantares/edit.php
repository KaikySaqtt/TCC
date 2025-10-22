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
if (!isset($_GET['id_jan'])) {
    die("ID do jantar não informado.");
}

$id_jan = $_GET['id_jan'];

// Busca os dados do jantar antes de exibir o formulário
view($id_jan);

// Processa o POST (quando o formulário é enviado)
if (isset($_POST['jantar'])) {
    $jantarPost = $_POST['jantar'];
    $db = open_database();
    try {
        $stmt = $db->prepare('UPDATE tab_orcamento_jantar 
            SET endereco = :endereco,
        quantidade_pessoas = :quantidade_pessoas, 
        cpf_cnpj_usuario = :cpf_cnpj_usuario,   
        jantar_ou_almoco = :jantar_ou_almoco, 
        drinks = :drinks, 
        sobremesas = :sobremesas,
        detalhes_jan = :detalhes_jan
    WHERE id_jan = :id_jan');

        // Preparar variáveis
        $endereco           = $jantarPost['endereco'] ?? null;
        $quantidade_pessoas = $jantarPost['quantidade_pessoas'] ?? null;
        $cpf_cnpj_usuario   = $jantarPost['cpf_cnpj_usuario'] ?? null;
        $jantar_ou_almoco   = $jantarPost['jantar_ou_almoco'] ?? null;
        $drinks             = $jantarPost['drinks'] ?? null;
        $sobremesas         = $jantarPost['sobremesas'] ?? null;
        $detalhes_jan       = $jantarPost['detalhes_jan'] ?? null;

        // Bind dos parâmetros
        $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
        $stmt->bindParam(':quantidade_pessoas', $quantidade_pessoas, PDO::PARAM_INT);
        $stmt->bindParam(':cpf_cnpj_usuario', $cpf_cnpj_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':jantar_ou_almoco', $jantar_ou_almoco, PDO::PARAM_STR);
        $stmt->bindParam(':drinks', $drinks, PDO::PARAM_BOOL);
        $stmt->bindParam(':sobremesas', $sobremesas, PDO::PARAM_BOOL);
        $stmt->bindParam(':detalhes_jan', $detalhes_jan, PDO::PARAM_STR);
        $stmt->bindParam(':id_jan', $id_jan, PDO::PARAM_INT);

        $stmt->execute();
        $_SESSION['message'] = "Orçamento atualizado com sucesso!";
        $_SESSION['type'] = "success";
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        echo 'Erro ao atualizar orçamento de jantar: ' . $e->getMessage();
    }
}

include(HEADER_TEMPLATE);
?>

<h2>Atualizar orçamento</h2>

<form class="form-edit-jan" action="edit.php?id_jan=<?php echo $jantar['id_jan']; ?>" method="post" enctype="multipart/form-data">
    <hr>

    <div class="form-edit-row mb-5 mt-5">
        <div class="form-edit-group col-md-2">
            <label><h6>ID do Pedido</h6></label>
            <input type="text" class="form-edit-control" value="<?php echo $jantar['id_jan']; ?>" disabled>
        </div>

        <div class="form-edit-group col-md-2">
            <label><h6>Data de emissão do pedido</h6></label>
            <input type="date" class="form-edit-control" value="<?php echo date('Y-m-d', strtotime($jantar['data_do_orcamento_jan'])); ?>" disabled>
        </div>

        <div class="form-edit-group col-md-4">
            <label><h6>Endereço</h6></label>
            <input type="text" class="form-edit-control" name="jantar[endereco]" value="<?php echo $jantar['endereco']; ?>" required>
        </div>

        
        
    </div>
    <div class="form-edit-row mb-5 mt-5">
        <div class="form-edit-group col-md-2">
            <label><h6>Quantidade de pessoas</h6></label>
            <input type="text" class="form-edit-control" name="jantar[quantidade_pessoas]" value="<?php echo $jantar['quantidade_pessoas']; ?>" required>
        </div>
        <div class="form-edit-group col-md-2">
            <label><h6>CPF ou CNPJ do cliente</h6></label>
            <input type="text" class="form-edit-control" name="jantar[cpf_cnpj_usuario]" value="<?php echo $jantar['cpf_cnpj_usuario']; ?>" required>
        </div>
        <div class="form-edit-group col-md-2">
            <label><h6>Jantar ou almoço</h6></label>
            <input type="text" class="form-edit-control" name="jantar[jantar_ou_almoco]" value="<?php echo $jantar['jantar_ou_almoco']; ?>" required>
        </div>
    </div>
    <div class="form-edit-row mb-5 mt-5">
        <div class="form-edit-group col-md-2">
            <label><h6>Incluir drinks</h6></label>
            <select class="form-edit-control" name="jantar[drinks]">
                <option value="1" <?php echo $jantar['drinks'] ? 'selected' : ''; ?>>Sim</option>
                <option value="0" <?php echo !$jantar['drinks'] ? 'selected' : ''; ?>>Não</option>
            </select>
        </div>

        <div class="form-edit-group col-md-2">
            <label><h6>Incluir sobremesas</h6></label>
            <select class="form-edit-control" name="jantar[sobremesas]">
                <option value="1" <?php echo $jantar['sobremesas'] ? 'selected' : ''; ?>>Sim</option>
                <option value="0" <?php echo !$jantar['sobremesas'] ? 'selected' : ''; ?>>Não</option>
            </select>
        </div>

        <div class="form-edit-group col-md-3">
            <label><h6>Detalhes do orçamento</h6></label>
            <input type="text" class="form-edit-control" name="jantar[detalhes_jan]" value="<?php echo $jantar['detalhes_jan']; ?>" required>
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
