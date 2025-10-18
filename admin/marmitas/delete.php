<?php 
  include('functions.php'); 
  session_start();
  // Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['user']) || $_SESSION['user']['id_user'] != 1) {
    $_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: /TCC/index.php");
    exit;
}
else{
  if (isset($_GET['id_mar'])){
    delete($_GET['id_mar']);
  } else {
    die("ERRO: ID não definido.");
  }
}

?>