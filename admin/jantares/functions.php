<?php

include('../../config.php');
include(DBAPI);

$jantares = null;
$jantar = null;

/**
 *  Listagem de orçamentos dos jantares
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
function view($id_jan = null)
{
    global $jantar;
    $db = open_database();
    try {
        $stmt = $db->prepare('SELECT * FROM tab_orcamento_jantar WHERE id_jan = :id_jan');
        $stmt->bindParam(':id_jan', $id_jan, PDO::PARAM_INT);
        $stmt->execute();
        $jantar = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Erro ao visualizar orçamentos de jantares: ' . $e->getMessage();
    }
}
/**
 * Edita um orçamento existente
 */
function edit($id_jan, $postData)
{
    if (!$postData) {
        return false; // nada a fazer
    }

    $db = open_database();

    try {
        $stmt = $db->prepare('UPDATE tab_orcamento_jantar 
            SET quantidade_pessoas = :quantidade_pessoas, 
                cpf_cnpj_usuario = :cpf_cnpj_usuario,   
                jantar_ou_almoco = :jantar_ou_almoco, 
                drinks = :drinks, 
                sobremesas = :sobremesas,
                detalhes_jan = :detalhes_jan
            WHERE id_jan = :id_jan');

        $quantidade_pessoas = $postData['quantidade_pessoas'] ?? null;
        $cpf_cnpj_usuario   = $postData['cpf_cnpj_usuario'] ?? null;
        $jantar_ou_almoco   = $postData['jantar_ou_almoco'] ?? null;
        $sobremesas         =  strtoupper($postData['sobremesas'] ?? null);
        $drinks             =  strtoupper($postData['drinks'] ?? null);
        $detalhes_jan       = $postData['detalhes_jan'] ?? null;
        if ($drinks === 'SIM') {
            $drinks = 0;
        } else {
            $drinks = 1;
        }
        if ($sobremesas === 'SIM') {
            $sobremesas = 0;
        } else {
            $sobremesas = 1;
        }
        $stmt->bindParam(':quantidade_pessoas', $quantidade_pessoas, PDO::PARAM_INT);
        $stmt->bindParam(':cpf_cnpj_usuario', $cpf_cnpj_usuario, PDO::PARAM_STR);
        $stmt->bindParam(':jantar_ou_almoco', $jantar_ou_almoco, PDO::PARAM_STR);
        $stmt->bindParam(':drinks', $drinks, PDO::PARAM_BOOL);
        $stmt->bindParam(':sobremesas', $sobremesas, PDO::PARAM_BOOL);
        $stmt->bindParam(':detalhes_jan', $detalhes_jan, PDO::PARAM_STR);
        $stmt->bindParam(':id_jan', $id_jan, PDO::PARAM_INT);

        $stmt->execute();
        return true;

    } catch (PDOException $e) {
        echo 'Erro ao atualizar orçamento de jantar: ' . $e->getMessage();
        return false;
    }
}

/**
 * Exclui um orçamento
 */
function delete($id = null)
{
    if ($id !== null) {
        $db = open_database();
        try {
            $stmt = $db->prepare('DELETE FROM tab_orcamento_jantar WHERE id_jan = :id_jan');
            $stmt->bindParam(':id_jan', $id, PDO::PARAM_INT);
            $stmt->execute();
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            echo 'Erro ao excluir cliente: ' . $e->getMessage();
        }
    }
}
