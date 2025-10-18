<?php

include('../../config.php');
include(DBAPI);

$jantares = null;
$jantar = null;

/**
 *  Listagem de Clientes
 */
function index()
{
    global $jantares;
    $db = open_database();
    try {
        $stmt = $db->query('SELECT * FROM tab_orcamento_jantar');
        $jantares = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Erro ao listar orçamentos dos jantares: ' . $e->getMessage();
    }
}

/**
 *  Visualização dos orçamentos dos jantares
 */
function view($id = null)
{
    global $jantar;
    $db = open_database();
    try {
        $stmt = $db->prepare('SELECT * FROM tab_jantares WHERE id_jan = :id_jan');
        $stmt->bindParam(':id_jan', $id_jan, PDO::PARAM_INT);
        $stmt->execute();
        $jantar = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Erro ao visualizar orçamentos de jantares: ' . $e->getMessage();
    }
}

/**
 *  Cadastro de Clientes
 */
function add()
{
    if (!empty($_POST['jantar'])) {
        $today = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $jantar = $_POST['jantar'];
        $jantar['modified'] = $jantar['created'] = $today->format('Y-m-d H:i:s');

        $db = open_database();
        try {
            $stmt = $db->prepare('INSERT INTO customers 
                (name, cpf_cnpj, birthdate, address, hood, zip_code, city, state, phone, ie, created, modified) 
                VALUES 
                (:name, :cpf_cnpj, :birthdate, :address, :hood, :zip_code, :city, :state, :phone, :ie, :created, :modified)');

            // Bind dos parâmetros para evitar SQL Injection
            $stmt->bindParam(':name', $jantar['name'], PDO::PARAM_STR);
            $stmt->bindParam(':cpf_cnpj', $jantar['cpf_cnpj'], PDO::PARAM_STR);
            $stmt->bindParam(':birthdate', $jantar['birthdate'], PDO::PARAM_STR);
            $stmt->bindParam(':address', $jantar['address'], PDO::PARAM_STR);
            $stmt->bindParam(':hood', $jantar['hood'], PDO::PARAM_STR);
            $stmt->bindParam(':zip_code', $jantar['zip_code'], PDO::PARAM_STR);
            $stmt->bindParam(':city', $jantar['city'], PDO::PARAM_STR);
            $stmt->bindParam(':state', $jantar['state'], PDO::PARAM_STR);
            $stmt->bindParam(':phone', $jantar['phone'], PDO::PARAM_STR);
            $stmt->bindParam(':ie', $jantar['ie'], PDO::PARAM_STR);
            $stmt->bindParam(':created', $jantar['created'], PDO::PARAM_STR);
            $stmt->bindParam(':modified', $jantar['modified'], PDO::PARAM_STR);

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
        if (isset($_POST['jantar'])) {
            $jantar = $_POST['jantar'];
            $jantar['modified'] = $new->format('Y-m-d H:i:s');

            $db = open_database();
            try {
                $stmt = $db->prepare('UPDATE customers 
                    SET name = :name, cpf_cnpj = :cpf_cnpj, birthdate = :birthdate, address = :address, 
                        hood = :hood, zip_code = :zip_code, city = :city, state = :state, phone = :phone, 
                        ie = :ie, modified = :modified 
                    WHERE id = :id');

                // Bind dos parâmetros
                $stmt->bindParam(':name', $jantar['name']);
                $stmt->bindParam(':cpf_cnpj', $jantar['cpf_cnpj']);
                $stmt->bindParam(':birthdate', $jantar['birthdate']);
                $stmt->bindParam(':address', $jantar['address']);
                $stmt->bindParam(':hood', $jantar['hood']);
                $stmt->bindParam(':zip_code', $jantar['zip_code']);
                $stmt->bindParam(':city', $jantar['city']);
                $stmt->bindParam(':state', $jantar['state']);
                $stmt->bindParam(':phone', $jantar['phone']);
                $stmt->bindParam(':ie', $jantar['ie']);
                $stmt->bindParam(':modified', $jantar['modified']);   
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                $stmt->execute();
                header('Location: index.php');
                exit;
            } catch (PDOException $e) {
                echo 'Erro ao atualizar cliente: ' . $e->getMessage();
            }
        } else {
            global $jantar;
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
