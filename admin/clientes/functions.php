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
        echo 'Erro ao listar clientes: ' . $e->getMessage();
    }
}

/**
 *  Visualização de um Cliente
 */
function view($id = null)
{
    global $customer;
    $db = open_database();
    try {
        $stmt = $db->prepare('SELECT * FROM customers WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Erro ao visualizar cliente: ' . $e->getMessage();
    }
}

/**
 *  Cadastro de Clientes
 */
function add()
{
    if (!empty($_POST['customer'])) {
        $today = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $customer = $_POST['customer'];
        $customer['modified'] = $customer['created'] = $today->format('Y-m-d H:i:s');

        $db = open_database();
        try {
            $stmt = $db->prepare('INSERT INTO customers 
                (name, cpf_cnpj, birthdate, address, hood, zip_code, city, state, phone, ie, created, modified) 
                VALUES 
                (:name, :cpf_cnpj, :birthdate, :address, :hood, :zip_code, :city, :state, :phone, :ie, :created, :modified)');

            // Bind dos parâmetros para evitar SQL Injection
            $stmt->bindParam(':name', $customer['name'], PDO::PARAM_STR);
            $stmt->bindParam(':cpf_cnpj', $customer['cpf_cnpj'], PDO::PARAM_STR);
            $stmt->bindParam(':birthdate', $customer['birthdate'], PDO::PARAM_STR);
            $stmt->bindParam(':address', $customer['address'], PDO::PARAM_STR);
            $stmt->bindParam(':hood', $customer['hood'], PDO::PARAM_STR);
            $stmt->bindParam(':zip_code', $customer['zip_code'], PDO::PARAM_STR);
            $stmt->bindParam(':city', $customer['city'], PDO::PARAM_STR);
            $stmt->bindParam(':state', $customer['state'], PDO::PARAM_STR);
            $stmt->bindParam(':phone', $customer['phone'], PDO::PARAM_STR);
            $stmt->bindParam(':ie', $customer['ie'], PDO::PARAM_STR);
            $stmt->bindParam(':created', $customer['created'], PDO::PARAM_STR);
            $stmt->bindParam(':modified', $customer['modified'], PDO::PARAM_STR);

            $stmt->execute();

            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            echo 'Erro ao adicionar cliente: ' . $e->getMessage();
        }
    }
}

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
 * Exclui um cliente
 */
function delete($id = null)
{
    if ($id !== null) {
        $db = open_database();
        try {
            $stmt = $db->prepare('DELETE FROM customers WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            echo 'Erro ao excluir cliente: ' . $e->getMessage();
        }
    }
}
