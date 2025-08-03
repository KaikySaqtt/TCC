<?php
    include("../config.php");
    include(DBAPI);

    $gerentes = null;
    $gerente = null;

    /**
     *  Listagem de Clientes
     */
    function index() {
        global $gerentes;
        $gerentes = find_all("gerentes");
    }
    /**
     *  Cadastro de Clientes
     */

    define('TAMANHO_MAXIMO', 5000000); // 5MB

    function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo)
    {
        try {
            $nomearquivo = basename($arquivo_destino);
            $uploadOk = 1;

            $check = getimagesize($nome_temp);
            if ($check === false) {
                throw new Exception("O arquivo não é uma imagem!");
            }

            if (file_exists($arquivo_destino)) {
                throw new Exception("Desculpe, o arquivo já existe!");
            }

            if ($tamanho_arquivo > TAMANHO_MAXIMO) {
                throw new Exception("Desculpe, mas o arquivo é muito grande!");
            }

            $formatos_permitidos = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($tipo_arquivo, $formatos_permitidos)) {
                throw new Exception("Apenas arquivos JPG, JPEG, PNG e GIF são permitidos!");
            }

            if (move_uploaded_file($nome_temp, $arquivo_destino)) {
                $_SESSION['message'] = "O arquivo " . htmlspecialchars($nomearquivo) . " foi armazenado.";
                $_SESSION['type'] = "success";
            } else {
                throw new Exception("Erro ao enviar o arquivo.");
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "Erro: " . $e->getMessage();
            $_SESSION['type'] = "danger";
        }
    }

    function add() {

        if (!empty($_POST['gerente'])) {
             $db = open_database();
            try {
                $today = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
                $gerente = $_POST['gerente'];
               
                if (!empty($_FILES['foto']['name'])) {
                    $pasta_destino = 'fotos/';
                    if (!is_dir($pasta_destino)) {
                        mkdir($pasta_destino, 0777, true);  // Cria a pasta caso não exista
                    }
                    $tipo_arquivo = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
                    $nomearquivo = uniqid() . '.' . $tipo_arquivo;
                    $arquivo_destino = $pasta_destino . $nomearquivo;
                    $tamanho_arquivo = $_FILES['foto']['size'];
                    $nome_temp = $_FILES['foto']['tmp_name'];
    
                    upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
                    $gerente['foto'] = $nomearquivo;
                } else {
                    $gerente['foto'] = 'SemFoto.jpg';  // Foto padrão
                }
                $stmt = $db->prepare('INSERT INTO gerentes 
                    (nome, endereco, depto, datanasc, foto) 
                    VALUES 
                    (:nome, :endereco, :depto, :datanasc, :foto)');
    
                // Bind dos parâmetros para evitar SQL Injection
                $stmt->bindParam(':nome', $gerente['nome'], PDO::PARAM_STR);
                $stmt->bindParam(':endereco', $gerente['endereco'], PDO::PARAM_STR);
                $stmt->bindParam(':depto', $gerente['depto'], PDO::PARAM_STR);
                $stmt->bindParam(':datanasc', $gerente['datanasc'], PDO::PARAM_STR);
                $stmt->bindParam(':foto', $gerente['foto'], PDO::PARAM_STR);
                $stmt->execute();
    
                header('Location: index.php');
                exit;
            } catch (PDOException $e) {
                echo 'Erro ao adicionar gerente: ' . $e->getMessage();
            }
        }
        
    }
    function view($id = null) {
        global $gerente;
        $gerente = find("gerentes", $id);
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
