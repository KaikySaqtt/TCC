<?php if (!isset($_SESSION)) session_start(); ?>
<?php
    include('functions.php');
    index();
    include(HEADER_TEMPLATE);
?>

            <header class="mt-3 ">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Gerentes</h2>
                    </div>
                    <div class="col-sm-6 text-right h2">
                        <a class="btn btn-secondary" href="add.php"><i class="fa fa-user-plus"></i> Novo Gerente</a>
                        <a class="btn btn-light" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
                    </div>
                </div>
            </header>

            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php //clear_messages(); ?>
            <?php endif; ?>

            <hr>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th width="30%">Nome</th>
                        <th>Depto</th>
                        <th>Endereço</th>
                        <th>Data de nascimento</th>
                        <th>Foto</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($gerentes) : ?>
                        <?php foreach ($gerentes as $gerente) : ?>
                            <tr>
                                <td><?php echo $gerente['id']; ?></td>
                                <td><?php echo $gerente['nome']; ?></td>
                                <td><?php echo $gerente['depto']; ?></td>
                                <td><?php echo $gerente['endereco']; ?></td>
                                <td><?php echo formatadata($gerente['datanasc'],"d/m/Y"); ?></td>
                                <td>
                                    <?php 					
                                        if (empty($gerente['foto'])) {
                                            echo "<img src=\"fotos/SemFoto.PNG\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
                                        } else {
                                            $imagem = $gerente['foto'];
                                            $id = $gerente['id'];
                                            echo "<img src='fotos/$imagem' class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
                                        }
                                    ?> 
                                </td>
                                <td class="actions text-right">
                                    <a href="view.php?id=<?php echo $gerente['id']; ?>" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i> Visualizar</a>
                                    <a href="edit.php?id=<?php echo $gerente['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-file-pen"></i> Editar</a>
                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete-gerente-modal" data-customer="<?php echo $gerente['id']; ?>">
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