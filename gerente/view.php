<?php if (!isset($_SESSION)) session_start(); ?>
<?php
    include('functions.php');
    view($_GET['id']);
    include(HEADER_TEMPLATE); 
?>

            <h2 class="mt-3">Gerente <?php echo $gerente['id']; ?></h2>
            <hr>

            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
            <?php endif; ?>

            <dl class="dl-horizontal">
                <dt>ID: </dt>
                <dd><?php echo $gerente['id']; ?></dd>

                <dt>Nome / Razão Social:</dt>
                <dd><?php echo $gerente['nome']; ?></dd>

                <dt>Departamento</dt>
                <dd><?php echo $gerente['depto']; ?></dd>

                <dt>Data de Nascimento:</dt>
                <dd><?php echo formatadata($gerente['datanasc'], "d/m/Y"); ?></dd>
            </dl>

            <dl class="dl-horizontal">
                <dt>Endereço:</dt>
                <dd><?php echo $gerente['endereco']; ?></dd>

                <dt>Foto:</dt>
                <dd>
                    <?php
                        if(!empty($gerente['foto'])) {
                            echo "<img src=\"fotos/". $gerente['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
                        } else {
                            echo "<img src=\"fotos/semimagem.jpg\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
                        }
                        ?>
                </dd>
            </dl>   

            <div id="actions" class="row">
                <div class="col-md-12">
                    <a href="edit.php?id=<?php echo $gerente['id']; ?>" class="btn btn-secondary"><i class="fa-regular fa-pen-to-square me-1"></i>Editar</a>
                    <a href="index.php" class="btn btn-default border"><i class="fa-solid fa-arrow-left me-1"></i>Voltar</a>
                </div>
            </div>

<?php include(FOOTER_TEMPLATE); ?>