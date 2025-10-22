<?php

include('../../config.php');
include(DBAPI);

$marmitas = null;
$marmita = null;

/**
 *  Listagem de orçamentos marmitas
 */
function index()
{
    global $marmitas;
    $db = open_database();
    try {
        $stmt = $db->query('SELECT * FROM tab_orcamento_marmita');
        $marmitas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    }
}

/**
 *  Visualização de um orçamento de marmita
 */
function view($id = null)
{
    global $marmita;
    $db = open_database();
    try {
        $stmt = $db->prepare('SELECT * FROM tab_orcamento_marmita WHERE id_mar = :id_mar');
        $stmt->bindParam(':id_mar', $id, PDO::PARAM_INT);
        $stmt->execute();
        $marmita = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    }
}


/**
  Cadastro de orçamento a mão 

function add()
{
    if (!empty($_POST['marmita'])) {
        $today = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $marmita = $_POST['marmita'];
        $marmita['modified'] = $marmita['created'] = $today->format('Y-m-d H:i:s');

        $db = open_database();
        try {
            $stmt = $db->prepare('INSERT INTO customers 
                (name, cpf_cnpj, birthdate, address, hood, zip_code, city, state, phone, ie, created, modified) 
                VALUES 
                (:name, :cpf_cnpj, :birthdate, :address, :hood, :zip_code, :city, :state, :phone, :ie, :created, :modified)');

            // Bind dos parâmetros para evitar SQL Injection
            $stmt->bindParam(':name', $marmita['name'], PDO::PARAM_STR);
            $stmt->bindParam(':cpf_cnpj', $marmita['cpf_cnpj'], PDO::PARAM_STR);
            $stmt->bindParam(':birthdate', $marmita['birthdate'], PDO::PARAM_STR);
            $stmt->bindParam(':address', $marmita['address'], PDO::PARAM_STR);
            $stmt->bindParam(':hood', $marmita['hood'], PDO::PARAM_STR);
            $stmt->bindParam(':zip_code', $marmita['zip_code'], PDO::PARAM_STR);
            $stmt->bindParam(':city', $marmita['city'], PDO::PARAM_STR);
            $stmt->bindParam(':state', $marmita['state'], PDO::PARAM_STR);
            $stmt->bindParam(':phone', $marmita['phone'], PDO::PARAM_STR);
            $stmt->bindParam(':ie', $marmita['ie'], PDO::PARAM_STR);
            $stmt->bindParam(':created', $marmita['created'], PDO::PARAM_STR);
            $stmt->bindParam(':modified', $marmita['modified'], PDO::PARAM_STR);

            $stmt->execute();

            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            echo 'Erro ao adicionar cliente: ' . $e->getMessage();
        }
    }
}
 */

/**
 * Edita um orçamento existente
 */
function edit($id_mar, $postData)
{
    if (!$postData) {
        return false; // nada a fazer
    }

    $db = open_database();

    try {
        $stmt = $db->prepare('UPDATE tab_orcamento_marmita 
            SET quantidade_marmitas = :quantidade_marmitas, 
                cpf_cnpj_usuario = :cpf_cnpj_usuario,   
                fit_ou_normal = :fit_ou_normal, 
                dieta_ou_nao = :dieta_ou_nao, 
                detalhes_mar = :detalhes_mar
            WHERE id_mar = :id_mar');

        $quantidade_marmitas = $postData['quantidade_marmitas'] ?? null;
        $cpf_cnpj_usuario    = $postData['cpf_cnpj_usuario'] ?? null;
        $fit_ou_normal       = $postData['fit_ou_normal'] ?? null;
        $dieta_ou_nao        = $postData['dieta_ou_nao'] ?? null;
        $detalhes_mar        = $postData['detalhes_mar'] ?? null;

        $stmt->bindParam(':quantidade_marmitas', $quantidade_marmitas, PDO::PARAM_INT);
        $stmt->bindParam(':cpf_cnpj_usuario', $cpf_cnpj_usuario, PDO::PARAM_STR);
        $stmt->bindParam(':fit_ou_normal', $fit_ou_normal, PDO::PARAM_STR);
        $stmt->bindParam(':dieta_ou_nao', $dieta_ou_nao, PDO::PARAM_STR);
        $stmt->bindParam(':detalhes_mar', $detalhes_mar, PDO::PARAM_STR);
        $stmt->bindParam(':id_mar', $id_mar, PDO::PARAM_INT);

        $stmt->execute();
        return true;

    } catch (PDOException $e) {
        return false;
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
            $stmt = $db->prepare('DELETE FROM tab_orcamento_marmita WHERE id_mar = :id_mar');
            $stmt->bindParam(':id_mar', $id, PDO::PARAM_INT);
            $stmt->execute();
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
        }
    }
}
