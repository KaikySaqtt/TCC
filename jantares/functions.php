<?php
    include("../config.php");
    include(DBAPI);

    $jantares = null;
    $jantar = null;

    /**
     *  Cadastro de orçamentos de jantares
     */
    function add() {
    if (!empty($_POST)) {
        if (!isset($_SESSION)) session_start();

        // Verifica se o usuário está logado
        if (!isset($_SESSION['user']) || empty($_SESSION['user']['cpf_cnpj'])) {
            die("Erro: usuário não logado ou CPF não encontrado na sessão.");
        }

        $cpf_cnpj_usuario = $_SESSION['user']['cpf_cnpj'];


        // Conecta ao banco
        $db = open_database();

        try {
            // Prepara o SQL corretamente com nomes de colunas do banco
            $stmt = $db->prepare('INSERT INTO tab_orcamento_jantar
                (endereco, quantidade_pessoas, data_do_evento, jantar_ou_almoco, drinks, sobremesas, detalhes_jan, cpf_cnpj_usuario, data_do_orcamento_jan)
                VALUES
                (:endereco, :quantidade_pessoas, :data_do_evento, :jantar_ou_almoco, :drinks, :sobremesas, :detalhes_jan, :cpf_cnpj_usuario, :data_do_orcamento_jan)');
            // Mapear os valores do formulário
            $endereco = $_POST['endereco'];
            $quantidade_pessoas = $_POST['quantidade_pessoas'];
            $data_do_evento = $_POST['data_do_evento'];
            $jantar_ou_almoco = $_POST['tipo_refeicao'];
            $drinks = isset($_POST['incluir_drinks']) ? 1 : 0;
            $sobremesas = isset($_POST['incluir_sobremesa']) ? 1 : 0;
            $dia = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
            $detalhes_jan = $_POST['detalhes_pedido'];

            // Bind dos parâmetros
            $stmt->bindParam(':endereco', $endereco);
            $stmt->bindParam(':quantidade_pessoas', $quantidade_pessoas, PDO::PARAM_INT);
            $stmt->bindParam(':data_do_evento', $data_do_evento);
            $stmt->bindValue(':data_do_orcamento_jan', $dia->format('Y-m-d H:i:s'));
            $stmt->bindParam(':jantar_ou_almoco', $jantar_ou_almoco);
            $stmt->bindParam(':drinks', $drinks, PDO::PARAM_BOOL);
            $stmt->bindParam(':sobremesas', $sobremesas, PDO::PARAM_BOOL);
            $stmt->bindParam(':detalhes_jan', $detalhes_jan);
            $stmt->bindParam(':cpf_cnpj_usuario', $cpf_cnpj_usuario);

            $stmt->execute();

            // Redireciona após inserção
            header('Location: index.php');
            exit;

        } catch (PDOException $e) {
            echo "<pre>";
            print_r($_POST);
            print_r($_SESSION);
            echo "</pre>";
        }
    }
}
