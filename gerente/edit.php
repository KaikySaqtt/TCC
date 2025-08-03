<?php if (!isset($_SESSION)) session_start(); ?>
<?php
    include('functions.php');
    if (!isset($_SESSION['user'])) {
        $_SESSION['message'] = "Você precisa estar logado para acessar esse recurso!";
        $_SESSION['type'] = "danger";
        header("Location: " .  BASEURL . "index.php");
    } 
    edit();
    include(HEADER_TEMPLATE);
?>

            <h2 class="mt-2">Editar gerente</h2>

            <form action="edit.php?id=<?php echo $gerente['id']; ?>" method="post"  enctype="multipart/form-data">
                <!-- area de campos do form -->
                <hr>
                <div class="row">
                    <div class="form-group col-md-7">
                        <label for="name">Nome / Razão Social</label>
                        <input type="text" class="form-control" name="gerente[nome]" maxlength="100" value="<?php echo $gerente['nome']; ?>">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo2">Departamento</label>
                        <input type="text" class="form-control" name="gerente[depto]" maxlength="20" value="<?php echo $gerente['depto']; ?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="campo3">Data de Nascimento</label>
                        <input type="date" class="form-control" name="gerente[datanasc]" value="<?php echo formatadata($gerente['datanasc'], "Y-m-d"); ?>">
                    </div>
                </div>

                    <div class="row">
                        <div class="form-group col-md-10">
                            <label for="campo1">Endereço</label>
                            <input type="text" class="form-control" name="gerente[endereco]" maxlength="50" value="<?php echo $gerente['endereco']; ?>">
                            
                        </div>
                    <div class="form-group col-md-2">
                        <label for="campo1">ID</label>
                        <input type="text" class="form-control" name="gerente[id]" value="<?php echo $gerente['id']; ?>" disabled>
                    </div>
                    <div class="form-group col-md-8">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    <div>
                        <?php 					
                                if (!empty($gerente['foto'])) {
                                    echo "<img src=\"fotos/" . $gerente['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" style=\"width: 250px\">";
                                } else {
                                    echo "<img src=\"fotos/semimagem.jpg\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"250px\">";
                                }
                        ?> 
                    </div>
                    <div id="actions" class="row mt-2 mb-2">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-secondary"> <i class="fa-solid me-1 fa-sd-card"></i>Salvar</button>
                            <a href="index.php" class="btn btn-light"><i class="fa-solid me-1 fa-arrow-left"></i>Cancelar</a>
                        </div>
                    </div>
            </form>

<?php include(FOOTER_TEMPLATE); ?>
<script>
    $(document).ready(() => {
        $('#foto').change(function () {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#imgPreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>