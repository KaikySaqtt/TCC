<?php if (!isset($_SESSION)) session_start(); ?>
<?php
    
    if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['id_user'] != 1) {
        $_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
        $_SESSION['type'] = "danger";
        header("Location: " .  "/TCC/clientes/index.php");
    }
    }else {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: " . "/TCC/jantares/index.php");
    }
    include('functions.php');
    index();
    include(HEADER_TEMPLATE);
?>
            <!--
            <header class="mt-5 ">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Clientes</h2>
                    </div>
                    <div class="col-sm-6 text-right h2">
                        <a class="btn btn-secondary" href="add.php"><i class="fa fa-user-plus"></i> Novo Cliente</a>
                        <a class="btn btn-light" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
                    </div>
                </div>
            </header>
            -->

            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php //clear_messages(); ?>
            <?php endif; ?>

            <hr>
            <h1 class="mt-5">Clientes cadastrados</h1>   
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th width="30%">Nome</th>
                        <th>CPF/CNPJ</th>
                        <th>Telefone</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($usuarios) : ?>
                        <?php foreach ($usuarios as $usuario) : ?>
                            <tr>
                                <td><?php echo $usuario['id_user']; ?></td>
                                <td><?php echo $usuario['name']; ?></td>
                                <td><?php echo formatacpfcnpj($usuario['cpf_cnpj']); ?></td>
                                <td><?php echo formataphone($usuario['telefone']); ?></td>
                                <td class="actions text-right">
                                    <a href="view.php?id=<?php echo $usuario['id_user']; ?>" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i> Visualizar</a>
                                    <a href="edit.php?id=<?php echo $usuario['id_user']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-file-pen"></i> Editar</a>
                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete-modal" data-customer="<?php echo $usuario['id_user']; ?>">
                                        <i class="fa fa-trash-can"></i> Excluir
                                    </a>
                                </td>
                            </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">Nenhum registro encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>


<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>