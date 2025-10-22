<?php
if (!isset($_SESSION)) session_start();
include("functions.php");

// Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['user']) || $_SESSION['user']['id_user'] != 1) {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: /TCC/index.php");
    exit;
}

// Verifica se o ID foi passado
if (!isset($_GET['id_user'])) {
    die("ID do usuário não informado.");
}

$id_user = $_GET['id_user'];

// Busca os dados do usuário
$usuario = view($id_user);

// Processa o formulário
if (isset($_POST['usuario'])) {
    $usuarioPost = $_POST['usuario'];
    $db = open_database();

    try {
        $stmt = $db->prepare('UPDATE tab_usuarios 
            SET name = :name,
                cpf_cnpj = :cpf_cnpj,
                password = :password,
                telefone = :telefone
            WHERE id_user = :id_user');

        // Pega os valores do formulário
        $name     = $usuarioPost['name'] ?? null;
        $cpf_cnpj = $usuarioPost['cpf_cnpj'] ?? null;
        $password = $usuarioPost['password'] ?? null;
        $telefone = $usuarioPost['telefone'] ?? null;

        // Se o campo senha estiver vazio, mantém a senha antiga
        if (empty($password)) {
            $password = $usuario['password'];
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        // Faz o bind dos parâmetros
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':cpf_cnpj', $cpf_cnpj, PDO::PARAM_INT);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);

        $stmt->execute();

        $_SESSION['message'] = "Usuário atualizado com sucesso!";
        $_SESSION['type'] = "success";
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        echo 'Erro ao atualizar usuário: ' . $e->getMessage();
    }
}

include(HEADER_TEMPLATE);
?>

<h2 class="page-title">Editar Usuário</h2>

<form class="form-edit-mar" action="edit.php?id_user=<?php echo $usuario['id_user']; ?>" method="post" enctype="multipart/form-data">
    <hr>

    <div class="form-edit-row mb-5 mt-5">
        <div class="form-edit-group col-md-2">
            <label><h6>ID do usuario</h6></label>
            <input type="text" class="form-edit-control" value="<?php echo $usuario['id_user']; ?>" disabled>
        </div>
        <div class="form-edit-group col-md-4">
            <label><h6>Nome do usuario</h6></label>
            <input type="text" class="form-edit-control" name="usuario[name]" value="<?php echo $usuario['name']; ?>" required>
        </div>
        <div class="form-edit-group col-md-4">
            <label><h6>Senha (deixe em branco para manter a senha atual)</h6></label>
            <input type="password" class="form-edit-control" name="usuario[password]" value="">
        </div>

        <div class="form-edit-group col-md-2">
            <label><h6>ID do usuario</h6></label>
            <input type="text" class="form-edit-control" value="<?php echo $usuario['id_user']; ?>" disabled>
        </div>
    </div>

    <div class="form-edit-row mb-5 mt-5">
        <div class="form-edit-group col-md-3">
            <label><h6>Telefone</h6></label>
            <input type="number" class="form-edit-control" name="usuario[telefone]" value="<?php echo $usuario['telefone']; ?>" required>
        </div>
    </div>

    <div class="col-md-12 mt-2">
        <button type="submit" class="btn-crud btn-edit mb-1">
            <i class="fa-solid fa-sd-card"></i> Salvar
        </button>
        <a href="index.php" class="btn-crud btn-delete">
            <i class="fa-solid fa-arrow-left"></i> Cancelar
        </a>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
