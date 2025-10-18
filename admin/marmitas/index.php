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
            <h1 class="mt-5">Orçamentos de marmitas cadastrados</h1>   
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th width="30%">Quantidade de marmitas</th>
                        <th>CPF/CNPJ do cliente</th>
                        <th>Fit ou normal</th>
                        <th>Quer dieta ou não</th>
                        <th>Dia que foi feito o orçamento</th>
                        <th>Detalhes</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if ($marmitas) : ?>
                        <?php foreach ($marmitas as $marmita) : ?>
                            <tr>
                                <td><?php echo $marmita['id_mar']; ?></td>
                                <td><?php echo $marmita['quantidade_marmitas']; ?></td>
                                <td><?php echo formatacpfcnpj($marmita['cpf_cnpj_usuario']); ?></td>
                                <td><?php echo $marmita['fit_ou_normal']; ?></td>
                                <td><?php echo $marmita['dieta_ou_nao']; ?></td>
                                <td><?php echo formatadata($marmita['data_do_orcamento_mar'], "d/m/y"); ?></td>
                                <td><?php echo $marmita['detalhes_mar']; ?></td>
                                <!--<td>< echo formataphone($usuario['telefone']); ?></td>-->
                                <td class="actions text-right">
                                    <a href="edit.php?id_mar=<?php echo $marmita['id_mar']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-file-pen"></i> Editar</a>
                                    <!--<a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete-modal-marmitas" data-marmita="<?php echo $marmita['id_mar']; ?>">
                                        <i class="fa fa-trash-can"></i> Excluir
                                    </a>-->
                                    <a href="delete.php?id_mar=<?php echo $marmita['id_mar']; ?>" class="btn btn-sm btn-light">
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