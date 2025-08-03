<?php
// Iniciar buffer de saída para evitar problemas com headers já enviados
ob_start();

include("../config.php");
include(DBAPI);
include(HEADER_TEMPLATE);

// Iniciar sessão antes de qualquer outra coisa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se login e senha foram enviados
if (empty($_POST['login']) || empty($_POST['senha'])) {
    header("Location: " . BASEURL . "index.php");
    exit;
}

try {
    // Abre a conexão com o banco de dados usando PDO
    $bd = open_database();

    // Preparar dados
    $usuario = $_POST['login'];
    $senha = criptografia($_POST['senha']);

    // Usar prepared statements para evitar SQL Injection com PDO
    $sql = "SELECT id, nome, username, password FROM usuarios WHERE username = :username LIMIT 1";
    $stmt = $bd->prepare($sql);
    
    // Bind dos parâmetros para a consulta
    $stmt->bindParam(':username', $usuario, PDO::PARAM_STR);
    //$stmt->bindParam(':password', $senha, PDO::PARAM_STR);
    
    // Executar a consulta
    $stmt->execute();   

    // Verificar se o usuário foi encontrado
    if ($stmt->rowCount() > 0) {
        // Dados do usuário
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Definir os dados na sessão
        $_SESSION['id'] = $dados['id'];
        $_SESSION['nome'] = $dados['nome'];
        $_SESSION['user'] = $dados['username'];

        // Mensagem de boas-vindas
        $_SESSION['message'] = "Bem-vindo, " . $dados['nome'] . "!";
        $_SESSION['type'] = "success";

        header("Location: " . BASEURL . "index.php");
        exit;
    } else {
        // Credenciais incorretas
        $_SESSION['message'] = "Usuário ou senha incorretos.";
        $_SESSION['type'] = "danger";
        header("Location: " . BASEURL . "inc/login.php");
        exit;
    }
} catch (Exception $e) {
    // Tratamento de erro
    $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
    $_SESSION['type'] = "danger";
    header("Location: " . BASEURL . "inc/login.php");
    exit;
}

// Limpar buffer de saída e enviar conteúdo
ob_end_flush();
?>
