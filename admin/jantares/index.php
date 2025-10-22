<?php if (!isset($_SESSION)) session_start(); ?>
<?php
if ($_SESSION['user']['id_user'] != 1) {
    $_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: /TCC/clientes/index.php");
}
include('functions.php');
index();
include(HEADER_TEMPLATE);
?>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show mt-3 text-center" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
<?php endif; ?>


<div class="container container-wide agrandir mt-3 pb-3">
    <div class="card shadow-sm border-0 mt-5 p-4"></div>
        <h2 class="page-title mb-4">Orçamentos de jantares e almoços privativos cadastrados</h2>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light text-center" style="color: #233f69;">
                    <tr>
                        <th>ID</th>
                        <th width="30%">Endereço</th>
                        <th>CPF/CNPJ Cliente</th>
                        <th>Almoço ou Jantar</th>
                        <th>Quantidade de Pessoas</th>
                        <th>Drinks</th>
                        <th>Sobremesas</th>
                        <th>Data do Evento</th>
                        <th>Data do Orçamento</th>
                        <th>Detalhamento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if ($jantares) : ?>
                        <?php foreach ($jantares as $jantar) : ?>
                            <tr>
                                <td><?php echo $jantar['id_jan']; ?></td>
                                <td><?php echo htmlspecialchars($jantar['endereco']); ?></td>
                                <td><?php echo formatacpfcnpj($jantar['cpf_cnpj_usuario']); ?></td>
                                <td><?php echo $jantar['jantar_ou_almoco']; ?></td>
                                <td><?php echo $jantar['quantidade_pessoas']; ?></td>
                                <td><?php echo $jantar['drinks'] == 0 ? 'Não' : 'Sim'; ?></td>
                                <td><?php echo $jantar['sobremesas'] == 0 ? 'Não' : 'Sim'; ?></td>
                                <td><?php echo formatadata($jantar['data_do_evento'], "d/m/Y"); ?></td>
                                <td><?php echo formatadata($jantar['data_do_orcamento_jan'], "d/m/Y"); ?></td>
                                <td class="text-start"><?php echo nl2br(htmlspecialchars($jantar['detalhes_jan'])); ?></td>
                                 <td class="text-center">
                                    <a href="edit.php?id_jan=<?php echo $jantar['id_jan']; ?>" 
                                       class="btn-crud btn-edit mb-1">
                                       <i class="fa fa-file-pen"></i> Editar
                                    </a>
                                    <a href="#" 
                                       class="btn-crud btn-delete"
                                       data-bs-toggle="modal" 
                                       data-bs-target="#modal_jantares" 
                                       data-id="<?php echo $jantar['id_jan']; ?>">
                                       <i class="fa fa-trash-can"></i> Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="11" class="text-muted">Nenhum registro encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>
