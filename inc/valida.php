<?php
// Iniciar buffer de saída para evitar erros de header
ob_start();

include("../config.php");
include(DBAPI);
include(HEADER_TEMPLATE);

// Iniciar sessão antes de qualquer coisa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se login e senha foram enviados
if (empty($_POST['cpf_cnpj']) || empty($_POST['password'])) {
    header("Location: " . BASEURL . "index.php");
    exit;
}

try {
    // Abre conexão com o banco (PDO)
    $bd = open_database();

    // Captura e prepara os dados
    $usuario = $_POST['cpf_cnpj'];
    $senhaDigitada = $_POST['password'];

    // Buscar usuário pelo CPF/CNPJ
    $sql = "SELECT id_user, name, cpf_cnpj, password 
            FROM tab_usuarios 
            WHERE cpf_cnpj = :cpf_cnpj 
            LIMIT 1";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':cpf_cnpj', $usuario, PDO::PARAM_STR);
    $stmt->execute();

    // Verifica se encontrou o usuário
    if ($stmt->rowCount() > 0) {
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar a senha com password_verify()
        if (password_verify($senhaDigitada, $dados['password'])) {

            // Armazena os dados na sessão
            $_SESSION['user'] = [
                'name' => $dados['name'],
                'cpf_cnpj' => $dados['cpf_cnpj'],
                'id_user' => $dados['id_user']
            ];



            header("Location: " . BASEURL . "index.php");
            exit;
        } else {
            // Senha incorreta
            header("Location: " . BASEURL . "index.php");
            exit;
        }
    } else {
        // Usuário não encontrado
        header("Location: " . BASEURL . "index.php");
        exit;
    }

} catch (Exception $e) {
    // Tratamento de erro (por exemplo, erro de conexão)
    header("Location: " . BASEURL . "index.php");
    exit;
}

// Limpa o buffer de saída
ob_end_flush();
?>
