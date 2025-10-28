<?php if (!isset($_SESSION))
    session_start(); ?>
<?php

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['id_user'] != 1) {
        header("Location: " . "/TCC/clientes/index.php");
    }
} else {
    header("Location: " . "/TCC/jantares/index.php");
}
include('functions.php');
index();
include(HEADER_TEMPLATE);
?>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php //clear_messages(); ?>
<?php endif; ?>

<div class="container container-wide agrandir mt-5 pb-3">
    <div class="card shadow-sm border-0 mt-5 p-4">
        <h2 class="page-title mb-4">Clientes cadastrados</h2>

        <!-- Botão no canto superior direito -->
        <div class="d-flex justify-content-end mb-3">
            <a href="registrar.php" class="btn-crud btn-edit">
                <i class="fa fa-user-plus"></i> Novo Cliente
            </a>
        </div>

        <div class="table-reponsive">
            <table class="table table-hover align-middle">
                <thead class="table-light text-center" style="color: #233f69;"> 
                    <tr>
                        <th>ID</th>
                        <th width="30%">Nome</th>
                        <th>CPF/CNPJ</th>
                        <th>Telefone</th>
                        <th class="ms-1">Opções</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if ($usuarios): ?>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td data-label="ID"><?php echo $usuario['id_user']; ?></td>
                                <td data-label="Nome"><?php echo $usuario['name']; ?></td>
                                <td data-label="CPF/CNPJ"><?php echo formatacpfcnpj($usuario['cpf_cnpj']); ?></td>
                                <td data-label="Telefone"><?php echo formataphone($usuario['telefone']); ?></td>
                                <td data-label="Opções" class="text-center">
                                    <a href="edit.php?id_user=<?php echo $usuario['id_user']; ?>" 
                                       class="btn-crud btn-edit mb-1">
                                       <i class="fa fa-file-pen"></i> Editar
                                    </a>
                                    <a href="#" 
                                       class="btn-crud btn-delete"
                                       data-bs-toggle="modal" 
                                       data-bs-target="#modal_clientes" 
                                       data-id="<?php echo $usuario['id_user']; ?>">
                                       <i class="fa fa-trash-can"></i> Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Nenhum registro encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>
