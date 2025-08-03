<?php
function open_database()
{
    try {
        $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conn->exec("SET NAMES 'utf8'");
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: ";
    }
}

function close_database(&$conn)
{
    $conn = null;
}

function find($table = null, $id = null)
{
    $database = open_database();
    $found = null;

    try {
        if ($id) {
            $stmt = $database->prepare("SELECT * FROM $table WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $found = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
    return $found;
}

function find_all($table)
{
    $database = open_database();

    try {
        $stmt = $database->query("SELECT * FROM $table");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
    return [];
}

function save($table = null, $data = null)
{
    $database = open_database();
    $columns = implode(", ", array_keys($data));
    $placeholders = ":" . implode(", :", array_keys($data));

    try {
        $stmt = $database->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
        $stmt->execute($data);
        $_SESSION['message'] = 'Registro cadastrado com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Não foi possível realizar a operação: ' . $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
}

function update($table = null, $id = 0, $data = null)
{
    $database = open_database();
    $set = "";

    foreach ($data as $key => $value) {
        $set .= "$key = :$key, ";
    }
    $set = rtrim($set, ", ");

    try {
        $stmt = $database->prepare("UPDATE $table SET $set WHERE id = :id");
        $data['id'] = $id;
        $stmt->execute($data);
        $_SESSION['message'] = 'Registro atualizado com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Não foi possível realizar a operação: ' . $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
}

function remove($table = null, $id = null)
{
    if (!$id) {
        $_SESSION['message'] = 'ID inválido para exclusão.';
        $_SESSION['type'] = 'danger';
        return;
    }

    $database = open_database();
    try {
        $stmt = $database->prepare("DELETE FROM $table WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['message'] = 'Registro removido com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Erro ao remover registro: ' . $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
}


/**
 * Criptografia
 */
function criptografia($senha)
{
    return password_hash($senha, PASSWORD_BCRYPT, ['cost' => 10]);
}

function clear_messages()
{
    $_SESSION['message'] = null;
    $_SESSION['type'] = null;
}

function formatadata($date, $formato)
{
    $dt = new DateTime($date, new DateTimeZone("America/Sao_Paulo"));
    return $dt->format($formato);
}

function formatacep($cep)
{
    $cp = substr($cep, 0, 5) . "-" . substr($cep, 5);
    return $cp;
}

function formatacpfcnpj($cpf_cnpj)
{
    // Formata CPF ou CNPJ
    if (strlen($cpf_cnpj) === 11) {
        return substr($cpf_cnpj, 0, 3) . "." . substr($cpf_cnpj, 3, 3) . "." . substr($cpf_cnpj, 6, 3) . "-" . substr($cpf_cnpj, 9, 2); // CPF
    } elseif (strlen($cpf_cnpj) === 14) {
        return substr($cpf_cnpj, 0, 2) . "." . substr($cpf_cnpj, 2, 3) . "." . substr($cpf_cnpj, 5, 3) . "/" . substr($cpf_cnpj, 8, 4) . "-" . substr($cpf_cnpj, 12, 2); // CNPJ
    }
    return $cpf_cnpj; // Retorna sem formatação se o tamanho não corresponder
}

function formataphone($phone)
{
    $phone = "(" . substr($phone, 0, 2) . ") " . substr($phone, 2, 5) . "-" . substr($phone, 7, 4);
    return $phone;
}

function formataie($inscricao)
{
    $inscricao = preg_replace('/\D/', '', $inscricao);

    $inscricao = substr($inscricao, 0, 2) . "." . substr($inscricao, 2, 3) . "." . substr($inscricao, 5, 3) . "-" . substr($inscricao, 8, 1);
    return $inscricao;
}

/* Masks */