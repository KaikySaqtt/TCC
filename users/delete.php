<?php
// esse é o delete.php
require_once("functions.php");
if (isset($_SESSION['user'])) {
    if ($_SESSION['user'] != "admin") {
        $_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
        $_SESSION['type'] = "danger";
        header("Location: " .  BASEURL . "index.php");
    }
} else {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: " .  BASEURL . "index.php");
}
if (isset($_GET['id'])) {
    try {
        // consultando o usuário para obter o nome do arquivo da foto
        $usuario = find("usuarios", $_GET['id']);
        // Chamando a função delete para apagar o usuário do banco de dados
        delete($_GET['id']);
        // Apagando o arquivo da foto do usuário pasta fotos
        unlink("fotos/" . $usuario['foto']);
    } catch (Exception $e) {
        $_SESSION['message'] = "Não foi possível realizar a operação: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
} else {
    die("ERRO: ID não definido.");
}
?>
