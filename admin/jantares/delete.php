<?php 
  include('functions.php'); 
  session_start();
  // Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['user']) || $_SESSION['user']['id_user'] != 1) {
    header("Location: /TCC/index.php");
    exit;
}
else{
  if (isset($_GET['id_jan'])){
    delete($_GET['id_jan']);
  } else {
    die("ERRO: ID do jantar não definido.");
  }
}

?>