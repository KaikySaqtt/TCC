<?php if (!isset($_SESSION)) session_start(); ?>
<?php
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['id_user'] != 1) {
            $_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
            $_SESSION['type'] = "danger";
            header("Location: " .  "/TCC/clientes/index.php");
        }
    } else {
        $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
        $_SESSION['type'] = "danger";
        header("Location: " . "/TCC/jantares/index.php");
    }

    include('functions.php');
    index();
    include(HEADER_TEMPLATE);
?>

<div class="container container-wide agrandir mt-5 pb-5">
    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show mt-3" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0 mt-5 p-4">
        <h2 class="page-title mb-4">Orçamentos de marmitas cadastrados</h2>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light" style="color: #233f69;">
                    <tr>
                        <th>ID</th>
                        <th>Quantidade de marmitas</th>
                        <th>CPF/CNPJ do cliente</th>
                        <th>Fit ou normal</th>
                        <th>Quer dieta ou não</th>
                        <th>Dia do orçamento</th>
                        <th>Detalhes</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
    <?php if ($marmitas) : ?>
        <?php foreach ($marmitas as $marmita) : ?>
            <tr>
                <td data-label="ID"><?php echo $marmita['id_mar']; ?></td>
                <td data-label="Quantidade"><?php echo $marmita['quantidade_marmitas']; ?></td>
                <td data-label="CPF/CNPJ"><?php echo formatacpfcnpj($marmita['cpf_cnpj_usuario']); ?></td>
                <td data-label="Fit ou normal"><?php echo $marmita['fit_ou_normal']; ?></td>
                <td data-label="Quer dieta?"><?php echo $marmita['dieta_ou_nao'] == 0 ? 'Não' : 'Sim'; ?></td>
                <td data-label="Data"><?php echo formatadata($marmita['data_do_orcamento_mar'], "d/m/y"); ?></td>
                <td data-label="Detalhes"><?php echo $marmita['detalhes_mar']; ?></td>
                <td data-label="Ações" class="text-center">
                    <a href="edit.php?id_mar=<?php echo $marmita['id_mar']; ?>" class="btn-crud btn-edit mb-1">
                        <i class="fa fa-file-pen"></i> Editar
                    </a>
                    <a href="#" class="btn-crud btn-delete"
                       data-bs-toggle="modal" data-bs-target="#modal_marmitas"
                       data-id="<?php echo $marmita['id_mar']; ?>">
                        <i class="fa fa-trash-can"></i> Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="8" class="text-center text-muted py-4">Nenhum registro encontrado.</td>
        </tr>
    <?php endif; ?>
</tbody>

            </table>
        </div>
    </div>
</div>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>
