<?php
// esse é o edit.php
include('functions.php');
session_start();
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
edit();
include(HEADER_TEMPLATE);
?>

<header>
    <h2>Atualizar Usuário</h2>
</header>

<form action="edit.php?id=<?php echo $usuario['id']; ?>" method="post" enctype="multipart/form-data">
    <!-- area de campos do form -->
    <hr />
    <div class="row">
        <div class="form-group col-md-8">
            <label for="name">Nome</label>
            <input type="text" class="form-control" maxlength="50" name="usuario[nome]" value="<?php echo $usuario['nome']; ?>">
        </div>

        <div class="form-group col-md-4">
            <label for="campo3">Usuário (Login)</label>
            <input type="text" class="form-control" name="usuario[username]" maxlength="50" value="<?php echo $usuario['username']; ?>">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-8">
            <label for="password">Senha</label>
            <input type="password" class="form-control" name="usuario[password]" maxlength="100" placeholder="Deixe em branco para manter" value="">
        </div>

    </div>
    <div class="row">

        <div class="form-group col-md-8">
            <label for="foto">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>

        <div class="form-group col-md-4">
            <?php
                if (!empty($usuario['foto'])) {
                    echo "<img src=\"fotos/" . $usuario['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" style=\"width: 300px\">";
                } else {
                    echo "<img src=\"fotos/semimagem.jpg\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
                }
            ?>
        </div>

    <div id="actions" class="row mb-3">
        <div class="col-md-12">
            <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
            <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
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
