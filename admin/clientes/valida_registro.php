<?php if (!isset($_SESSION))
    session_start(); ?>
<?php
// valida_registro.php
include_once('../../config.php');
include(DBAPI);

// Função para abrir banco
$db = open_database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $cpf_cnpj = trim($_POST['cpf_cnpj']);
    $telefone = $_POST['telefone'];

    // Verificar se CPF/CNPJ já existe
    $stmt = $db->prepare("SELECT id_user FROM tab_usuarios WHERE cpf_cnpj = :cpf_cnpj LIMIT 1");
    $stmt->bindParam(':cpf_cnpj', $cpf_cnpj);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "CPF/CNPJ já cadastrado!";
        header('Location: registrar.php');
        exit;
    }

    // Inserir usuário
    $stmt = $db->prepare("INSERT INTO tab_usuarios (name, cpf_cnpj, telefone) VALUES (:name, :cpf_cnpj, :telefone)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':cpf_cnpj', $cpf_cnpj);
    $stmt->bindParam(':telefone', $telefone);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Cadastro realizado com sucesso! Faça login.";
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = "Erro ao cadastrar usuário. Tente novamente.";
        header('Location: registrar.php');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
