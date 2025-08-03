<?php if (!isset($_SESSION)) session_start(); ?>
<?php
    include('functions.php');
    if (!isset($_SESSION['user'])) {
        $_SESSION['message'] = "Você precisa estar logado para acessar esse recurso!";
        $_SESSION['type'] = "danger";
        header("Location: " .  BASEURL . "index.php");
    } 
    add();
    include(HEADER_TEMPLATE);
?>

            <h2 class="mt-3">Novo Gerente</h2>

            <form action="add.php" method="post" enctype="multipart/form-data">
                <!-- area de campos do form -->
                <hr/>
                <div class="row">
                    <div class="form-group col-md-7">
                        <label for="name">Nome / Razão Social</label>
                        <input type="text" class="form-control" name="gerente[nome]" maxlength="100">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="campo2">Departamento </label>
                        <input type="text" class="form-control" name="gerente[depto]" maxlength="20">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo3">Data de Nascimento</label>
                        <input type="date" class="form-control" name="gerente[datanasc]">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="campo1">Endereço</label>
                        <input type="text" class="form-control" name="gerente[endereco]" maxlength="50">
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="imgPreview">Pré visualização</label>
                        <img class="form-control rounded" id="imgPreview" src="./fotos/SemFoto.PNG" alt="" srcset="">
                    </div>
                </div>

                <div class="row">
                    <div id="actions" class="row mt-2">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-secondary"> <i class="fa-solid me-1 fa-sd-card"></i>Salvar</button>
                            <a href="index.php" class="btn btn-light"><i class="fa-solid me-1 fa-arrow-left"></i>Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
<?php include(FOOTER_TEMPLATE); ?>
<script>
    $(document).ready(() => {
        $("#foto").change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#imgPreview").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>s