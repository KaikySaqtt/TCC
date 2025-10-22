<?php

include('../../config.php');
include(DBAPI);

$customers = null;
$customer = null;

/**
 *  Listagem de Clientes
 */
function index()
{
    global $usuarios;
    $db = open_database();
    try {
        $stmt = $db->query('SELECT * FROM tab_usuarios');
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    }
}

/**
 *  Visualização de um Cliente
 */
function view($id = null)
{
    global $usuario;
    $db = open_database();
    try {
        $stmt = $db->prepare('SELECT * FROM tab_usuarios WHERE id_user = :id_user');
        $stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    }
}

/**
 *  Cadastro de Clientes
 */

/**
 * Edita um cliente existente
 */
function edit()
{
    $new = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($_POST['customer'])) {
            $customer = $_POST['customer'];
            $customer['modified'] = $new->format('Y-m-d H:i:s');

            $db = open_database();
            try {
                $stmt = $db->prepare('UPDATE customers 
                    SET name = :name, cpf_cnpj = :cpf_cnpj, birthdate = :birthdate, address = :address, 
                        hood = :hood, zip_code = :zip_code, city = :city, state = :state, phone = :phone, 
                        ie = :ie, modified = :modified 
                    WHERE id = :id');

                // Bind dos parâmetros
                $stmt->bindParam(':name', $customer['name']);
                $stmt->bindParam(':cpf_cnpj', $customer['cpf_cnpj']);
                $stmt->bindParam(':birthdate', $customer['birthdate']);
                $stmt->bindParam(':address', $customer['address']);
                $stmt->bindParam(':hood', $customer['hood']);
                $stmt->bindParam(':zip_code', $customer['zip_code']);
                $stmt->bindParam(':city', $customer['city']);
                $stmt->bindParam(':state', $customer['state']);
                $stmt->bindParam(':phone', $customer['phone']);
                $stmt->bindParam(':ie', $customer['ie']);
                $stmt->bindParam(':modified', $customer['modified']);   
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                $stmt->execute();
                header('Location: index.php');
                exit;
            } catch (PDOException $e) {
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
 * Exclui um cliente
 */
function delete($id = null)
{
    if ($id !== null) {
        $db = open_database();

        try {
            // 1. Buscar o CPF/CNPJ do usuário
            $stmt = $db->prepare('SELECT cpf_cnpj FROM tab_usuarios WHERE id_user = :id_user');
            $stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $cpf = $user['cpf_cnpj'];

                // 2. Excluir orçamentos/jantares relacionados a esse usuário
                $stmt = $db->prepare('DELETE FROM tab_orcamento_jantar WHERE cpf_cnpj_usuario = :cpf');
                $stmt->bindParam(':cpf', $cpf);
                $stmt->execute();

                // 3. Agora excluir o usuário
                $stmt = $db->prepare('DELETE FROM tab_usuarios WHERE id_user = :id_user');
                $stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
                $stmt->execute();

                header('Location: index.php');
                exit;
            } else {
                echo "Usuário não encontrado!";
            }
        } catch (PDOException $e) {
            echo "Erro ao excluir: " . $e->getMessage();
        }
    }
}
