<?php if (!isset($_SESSION)) session_start(); ?>
<?php
include("functions.php");
// Check if username is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['message'] = "Você precisa estar logado para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: " .  BASEURL . "index.php");
} 
edit();
include(HEADER_TEMPLATE);
?>
<br>
<h2>Atualizar Cliente</h2>

<form action="edit.php?id=<?php echo $customer['id']; ?>" method="post" enctype="multipart/form-data">
    <hr>
    <div class="row mb-5 mt-5">
        <div class="form-group col-md-2">
            <label for="name">
                <h6>Nome / Razão Social</h6>
            </label>
            <input type="text" class="form-control" minlength="2" maxlength="60" placeholder="Digite seu Nome/Razão Social" name="customer[name]"  value="<?php echo $customer['name']; ?>" required>
        </div>

        <div class="form-group col-md-2">
            <label for="campo2">
                <h6>CPF</h6>
            </label>
            <input type="text" class="form-control" minlength="11" maxlength="14" placeholder="Digite seu CNPJ/CPF" id="cpf" name="customer[cpf_cnpj]" value="<?php echo formatacpfcnpj($customer['cpf_cnpj']); ?>" required>
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">
                <h6>Data de Nascimento</h6>
            </label>
            <input type="date" class="form-control" name="customer[birthdate]" value="<?php echo formatadata($customer['birthdate'], "Y-m-d"); ?>">
        </div>
    </div>
    <div class="row mb-5">
        <div class="form-group col-md-5">
            <label for="campo1">
                <h6>Endereço</h6>
            </label>
            <input type="text" class="form-control" minlength="5" maxlength="60" placeholder="Digite seu Endereço" name="customer[address]" value="<?php echo $customer['address']; ?>" required>
        </div>

        <div class="form-group col-md-3">
            <label for="campo2">
                <h6>Bairro</h6>
            </label>
            <input type="text" class="form-control" minlength="1" maxlength="50" placeholder="Digite seu Bairro" name="customer[hood]" value="<?php echo $customer['hood']; ?>" required>
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">
                <h6>CEP</h6>
            </label>
            <input type="text" class="form-control" minlength="8" maxlength="9" placeholder="Digite seu CEP" id="cep" name="customer[zip_code]" value="<?php echo formatacep($customer['zip_code']); ?>" required>
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">
                <h6>Data de Cadastro</h6>
            </label>
            <input type="date" class="form-control" name="customer[created]" disabled value="<?php echo formatadata($customer['created'], "Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="row mb-5">
        <div class="form-group col-md-5">
            <label for="campo1">
                <h6>Município</h6>
            </label>
            <input type="text" class="form-control" minlength="2" maxlength="50" placeholder="Digite seu Município" name="customer[city]" value="<?php echo $customer['city']; ?>" required>
        </div>

        <div class="form-group col-md-2">
            <label for="campo2">
                <h6>Telefone</h6>
            </label>
            <input type="tel" class="form-control" minlength="11" maxlength="11" id="telefone" placeholder="(xx) xxxx-xxxx" name="customer[phone]" value="<?php echo $customer['phone']; ?>">
        </div>

        <div class="form-group col-md-1">
            <label for="campo3">
                <h6>UF</h6>
            </label>
            <input type="text" class="form-control" minlength="2" maxlength="2" placeholder="UF" name="customer[state]" value="<?php echo $customer['state']; ?>" pattern="[A-Za-z]{2}" title="A UF deve conter apenas duas letras" required oninput="this.value = this.value.toUpperCase().replace(/[^A-Za-z]/g, '')">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">
                <h6>Inscrição Estadual</h6>
            </label>
            <input
                type="text"
                class="form-control"
                minlength="10"
                maxlength="12"
                placeholder="Digite sua IE"
                name="customer[ie]"
                id="campo3"
                value="<?php echo isset($customer['ie']) ? formataie($customer['ie']) : ''; ?>">
        </div>

    </div>
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
            <a href="index.php" class="btn btn-light"><i class="fa-solid fa-arrow-left"></i> Cancelar</a>
        </div>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>