<?php
include("functions.php");
if (!isset($_SESSION)) session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user'] != "admin") {
        $_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
        $_SESSION['type'] = "danger";
        header("Location: " .  BASEURL . "index.php");
    }
} else {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: " .  BASEURL . "index.php");
}
add();
include(HEADER_TEMPLATE);
?>

<h2 class="mt-2">Novo Usuário</h2>

<form action="add.php" method="post" enctype="multipart/form-data">
    <!-- area de campos do form -->
    <hr />
    <div class="row">
        <div class="form-group col-md-8">
            <label for="nome">Nome completo</label>
            <input type="text" class="form-control" id="nome" name="usuario[nome]" maxlength="50" required>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="usuario[username]" maxlength="50" required>
        </div>
    </div>

    <div class="row">

        <div class="form-group col-md-4">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="usuario[password]" maxlength="100" required>
        </div>

    </div>

    <div class="row">

        <div class="form-group col-md-4">
            <label for="foto">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>

        <div class="form-group col-md-2">
            <label for="imgPreview">Pré visualização</label>
            <img class="form-control rounded" id="imgPreview" src="./fotos/UsuarioSemFoto.png" alt="" srcset="">
        </div>

    </div>

    <div id="actions" class="row mt-2">
        <div class="col-md-12">
            <button type="submit" class="btn btn-outline-primary btn-lg mt-3 btn-color me-4"><i class="fa-solid fa-sd-card"></i> Salvar</button>
            <a href="index.php" class="btn btn-outline-danger btn-lg mt-3 btn-color"> <i class="fa-solid fa-arrow-left"></i> Cancelar</a>
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
</script>