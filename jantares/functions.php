<?php
    include("../config.php");
    include(DBAPI);

    $jantares = null;
    $jantar = null;

    /**
     *  Listagem de Clientes
     */
    function index() {
        global $jantares;
        $jantares = find_all("tab_orcamento_jantar");
    }
    /**
     *  Cadastro de orçamentos de jantares
     */

    define('TAMANHO_MAXIMO', 5000000); // 5MB

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
            $stmt->bindParam(':drinks', $drinks, PDO::PARAM_INT);
            $stmt->bindParam(':sobremesas', $sobremesas, PDO::PARAM_INT);
            $stmt->bindParam(':detalhes_jan', $detalhes_jan);
            $stmt->bindParam(':cpf_cnpj_usuario', $cpf_cnpj_usuario);

            $stmt->execute();

            // Redireciona após inserção
            header('Location: index.php');
            exit;

        } catch (PDOException $e) {
            echo "Erro ao fazer o orçamento: " . $e->getMessage();
            echo "<pre>";
            print_r($_POST);
            print_r($_SESSION);
            echo "</pre>";
        }
    }
}

    function view($id = null) {
        global $gerente;
        $gerente = find("jantares", $id);
    }

    /**
 *	Atualizacao/Edicao de Cliente
 */
function edit()
{
    $new = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($_POST['gerente'])) {
            $gerente = $_POST['gerente'];

            $db = open_database();
            try {
                if (!empty($_FILES['foto']['name'])) {
					//Upload da foto
					$pasta_destino = "fotos/";
					$arquivo_destino = $pasta_destino . basename($_FILES['foto']['name']);
					$nomearquivo = basename($_FILES['foto']['name']);
					$resolução_arquivo = getimagesize($_FILES['foto']['tmp_name']);
					$tamanho_arquivo = $_FILES['foto']['size'];
					$nome_temp = $_FILES['foto']['tmp_name'];
					$tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));

					upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

					$gerente['foto'] = $nomearquivo;
				}

                $stmt = $db->prepare('UPDATE gerentes 
                    SET nome = :nome, endereco = :endereco, depto = :depto, datanasc = :datanasc, foto = :foto
                        WHERE id = :id');

                // Bind dos parâmetros
                $stmt->bindParam(':nome', $gerente['nome']);
                $stmt->bindParam(':endereco', $gerente['endereco']);
                $stmt->bindParam(':depto', $gerente['depto']);  
                $stmt->bindParam(':datanasc', $gerente['datanasc']);       
                $stmt->bindParam(':foto', $gerente['foto']);  
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                $stmt->execute();
                header('Location: index.php');
                exit;
            } catch (PDOException $e) {
                echo 'Erro ao atualizar cliente: ' . $e->getMessage();
            }
        } else {
            global $customer;
            view($id);
        }
    } else {
        header('Location: index.php');
        exit;
    }
}
/**
 *  Exclusão de um Cliente
 */
    function delete($id = null) {

        $id = $_GET["id"];
        
        global $gerente;
        $gerente = remove('gerentes', $id);

        header('location: index.php');
    }
?>
