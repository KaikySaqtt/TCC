<?php include "config.php"; ?>
<?php include DBAPI; ?>

<?php 
    try{
        $db = open_database(); 
        echo "<h1>Banco de Dados Conectado!</h1>";
    }catch(Exception $e){
        echo "<h3>Aconteceu um erro: <br>" . $e->getMessage() . "</h3>\n";
    }
	/*
    $db = open_database();
	if ($db) {
        echo "<h1>Banco de Dados Conectado!</h1>";
	} else {
		echo "<h1>ERRO: Não foi possível Conectar!</h1>";
	}
    */
?>