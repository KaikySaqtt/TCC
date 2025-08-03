<?php 
  include('functions.php'); 
  session_start();
  if (!isset($_SESSION['user'])) {
    $_SESSION['message'] = "Você precisa estar logado para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: " .  BASEURL . "index.php");
}   
else{
  if (isset($_GET['id'])){
    delete($_GET['id']);
  } else {
    die("ERRO: ID não definido.");
  }
}

?>