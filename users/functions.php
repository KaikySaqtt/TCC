<?php

include('../config.php');
require("../inc/pdf.php");    
include(DBAPI);

$usuarios = null;
$usuario = null;

/**
 * Listagem de Usuários
 */
function index()
{
	global $usuarios;
	if (!empty($_POST['users'])) {
		$usuarios = filter("usuarios", "nome like '%" . $_POST['users'] . "%'");
	} else {
		$usuarios = find_all("usuarios");
	}
}

/**
 *  Upload de imagens
 */
function filter($table = null, $p = null){
    $database = open_database();
    $found = null;

    try {
        if ($p) {
            $sql = "SELECT * FROM " . $table . " WHERE " . $p;
            $result = $database->query($sql);
            $consultou = false;
            if($result) {
                $consultou = true;
            }
            if ($consultou = true) {
                $found = array();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    array_push($found, $row);
                }
            } else {
                throw new Exception("Não foram encontrados registros de dados!");
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }

    close_database($database);
    return $found;

}

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
/**
 * Cadastro Usuários
 */
function add()
{
	if (!empty($_POST['usuario'])) {
        $db = open_database();
        try {
            $usuario = $_POST['usuario'];
            
            // Tratamento de upload da foto
            // Tratamento de upload da foto
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
                $usuario['foto'] = $nomearquivo;
            } else {
                $usuario['foto'] = 'UsuarioSemFoto.jpg';  // Foto padrão
            }

            // Criptografar a senha
            if (!empty($usuario['password'])) {
                $usuario['password'] = password_hash($usuario['password'], PASSWORD_DEFAULT);
            }

            // Inserção no banco de dados
            $stmt = $db->prepare('INSERT INTO usuarios (nome, username, password, foto) VALUES (:nome, :username, :password, :foto)');
            $stmt->execute($usuario);
            header('Location: index.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['message'] = 'Erro ao adicionar usuário: ' . $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
    }
}

/**
 * Atualização/Edição de Usuários
 */
function edit()
{
	try {
		if (isset($_GET['id'])) {

			$id = $_GET['id'];

			if (isset($_POST['usuario'])) {
				$usuario = $_POST['usuario'];

				//criptografando a senha
				if (!empty($usuario['password'])) {
					$senha = criptografia($usuario['password']);
					$usuario['password'] = $senha;
				}

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

					$usuario['foto'] = $nomearquivo;
				}

				update('usuarios', $id, $usuario);
				header('Location: index.php');
			} else {
				global $usuario;
				$usuario = find("usuarios", $id);
			}
		} else {
			header("Location: index.php");
		}
	} catch (Exception $e) {
		$_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
		$_SESSION['type'] = "danger";
	}
}

/**
 * Visualização de um Usuário 
 */
function view($id = null)
{
	global $usuario;
	$usuario = find("usuarios", $id);
}

/**
 * Exclusão de um Usuario
 */
function delete($id = null)
{
	try {
		if (!empty($id)) {
			// Buscar o usuário antes de deletar para remover a foto se existir
			$usuario = find("usuarios", $id);

			// Verifica se o usuário existe
			if ($usuario) {
				// Se o usuário tiver uma foto (diferente da imagem padrão), ela será deletada
				if (isset($usuario['foto']) && $usuario['foto'] != 'semimagem.jpg') {
					$arquivo_foto = "fotos/" . $usuario['foto'];

					// Verifica se o arquivo existe no servidor antes de tentar deletar
					if (file_exists($arquivo_foto)) {
						unlink($arquivo_foto);  // Deleta a foto do servidor
					}
				}

				// Remover o usuário do banco de dados
				remove("usuarios", $id);

				// Mensagem de sucesso
				$_SESSION['message'] = "Usuário deletado com sucesso.";
				$_SESSION['type'] = "success";
			} else {
				throw new Exception("Usuário não encontrado.");
			}
		} else {
			throw new Exception("ID inválido.");
		}
	} catch (Exception $e) {
		// Mensagem de erro
		$_SESSION['message'] = "Erro ao deletar o usuário: " . $e->getMessage();
		$_SESSION['type'] = "danger";
	}

	// Redirecionar para a página inicial
	header("Location: index.php");
	exit();
}
/**
 * Gerando PDF
 */

function pdf($p = null){
    require_once('../inc/pdf.php');
    ob_clean();
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->SetAutoPageBreak(true, 20);

    // Verificando os usuários
    if ($p) {
        $usuarios = filter("usuarios", "nome", $p);
    } else {
        $usuarios = find_all("usuarios");
    }

    // Adicionando Cabeçalho da Tabela
    $pdf -> Cell(20);
    $pdf->SetFillColor(200, 220, 255); // Cor de fundo do cabeçalho
    $pdf->Cell(60, 7, 'Nome', 1, 0, 'C', true);  // Cabeçalho da coluna Nome
    $pdf->Cell(60, 7, 'User', 1, 0, 'C', true);  // Cabeçalho da coluna User
    $pdf->Cell(30, 7, 'Foto', 1, 1, 'C', true);  // Cabeçalho da coluna Foto

    if (is_array($usuarios) && count($usuarios) > 0) {
        foreach ($usuarios as $usuario){
            $larguraCelula = 60;
            $alturaCelula = 60;
            $espacoFinal = 20; // margem inferior da página
            $xInicial = $pdf->GetX();
            $yInicial = $pdf->GetY();

            // Adicionando os dados do usuário na tabela
            $caminhoImagem = '../users/fotos/' . $usuario['foto'];

             // Verifica se há espaço para o bloco inteiro
            if ($yInicial + $alturaCelula + $espacoFinal > $pdf->GetPageHeight()) {
                $pdf->AddPage();
                $yInicial = $pdf->GetY(); // atualiza a posição Y
            }
 
            // Adicionando a foto
            if (file_exists($caminhoImagem) && getimagesize($caminhoImagem)) {
                $pdf->Image($caminhoImagem, $xInicial + 140, $yInicial + 5, 30, 30);
            }

            // Adicionando o Nome e User com bordas
            $pdf->SetXY($xInicial, $yInicial + 5);
            $pdf -> Cell(20);
            $pdf->Cell(60, 30, $pdf->converteTexto($usuario['nome']), 1, 0, 'L'); // Célula com borda
            $pdf->Cell(60, 30, $pdf->converteTexto($usuario['username']), 1, 0, 'L'); // Célula com borda
            $pdf->Cell(30, 30, '', 1, 1, 'C');  // Célula de Foto, sem texto

            // Espaço entre as linhas de usuários
            $pdf->Ln(10);
        }
    } else {
        $pdf->Cell(0, 10, $pdf->converteTexto('Nenhum usuário encontrado!'), 0, 1);
    }

    // Gerando o PDF
    $pdf->Output("D", "listagem_usuarios.pdf");
    exit;
}

?>