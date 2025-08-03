<?php
include("functions.php");

session_start(); // Start the session, no need to check if it's started

if (!isset($_SESSION['user'])) {
        $_SESSION['message'] = "Você precisa estar logado para acessar esse recurso!";
        $_SESSION['type'] = "danger";
        header("Location: " .  BASEURL . "index.php");
    } 
add();
include(HEADER_TEMPLATE);
?>

<h2 class="mt-2">Se Cadastre</h2>

<form action="add.php" method="post">
	<hr/>
	<div class="row mt-5 mb-5">
		<div class="form-group col-md-7">
			<label for="name">
				<h6>Nome / Razão Social</h6>
			</label>
			<input type="text" class="form-control" minlength="2" maxlength="60" placeholder="Digite seu Nome/Razão Social" name="customer[name]" required>
		</div>

		<div class="form-group col-md-2">
			<label for="cpf" class="">
				<h6>CPF</h6>
			</label>
			<input type="number" class="form-control input-custom" id="cpf" name="customer[cpf_cnpj]" minlength="11" maxlength="11"
				placeholder="Apenas números" required>
			<div class="invalid-feedback">Por favor, insira um CPF válido.</div>
		</div>

		<div class="form-group col-md-2">
			<label for="campo3">
				<h6>Data de Nascimento</h6>
			</label>
			<input type="date" class="form-control" name="customer[birthdate]" required>
		</div>
	</div>

	<div class="row mb-5">
		<div class="form-group col-md-5">
			<label for="campo1">
				<h6>Endereço</h6>
			</label>
			<input type="text" class="form-control" minlength="5" maxlength="60" placeholder="Digite seu Endereço" name="customer[address]" required>
		</div>

		<div class="form-group col-md-3">
			<label for="campo2">
				<h6>Bairro</h6>
			</label>
			<input type="text" class="form-control" minlength="1" maxlength="50" placeholder="Digite seu Bairro" name="customer[hood]" required>
		</div>

		<div class="form-group col-md-2">
			<label for="cep">
				<h6>CEP</h6>
			</label> <input type="number" class="form-control input-custom" id="cep" name="customer[zip_code]" minlength="8" maxlength="8"
				placeholder="Apenas númeors" required>
			<div class="invalid-feedback">Por favor, insira um CEP válido.</div>
		</div>

		<div class="form-group col-md-2">
			<label for="campo3">
				<h6>Data de Cadastro</h6>
			</label>
			<input type="date" class="form-control" name="customer[created]" disabled>
		</div>
	</div>

	<div class="row mb-5">
		<div class="form-group col-md-5">
			<label for="campo1">
				<h6>Município</h6>
			</label>
			<input type="text" class="form-control" minlength="2" maxlength="50" placeholder="Digite seu Município" name="customer[city]" required>
		</div>

		<div class="form-group col-md-2">
			<label for="telefone">
				<h6>Telefone</h6>
			</label>
			<input type="tel" class="form-control input-custom" id="telefone" name="customer[phone]" placeholder="Apenas númeors" minlength="10" maxlength="10">
		</div>

		<div class="form-group col-md">
			<label for="campo3">
				<h6>UF</h6>
			</label>
			<input type="text" class="form-control" minlength="2" maxlength="2" placeholder="UF" name="customer[state]" pattern="[A-Za-z]{2}" title="A UF deve conter apenas duas letras maiúsculas" required
				oninput="this.value = this.value.toUpperCase().replace(/[^A-Za-z]/g, '')">
		</div>

		<div class="form-group col-md-2">
			<label for="campo3">
				<h6>Inscrição Estadual</h6>
			</label>
			<input
				type="text"
				class="form-control"
				minlength="9"
				maxlength="9"
				placeholder="Digite sua IE"
				name="customer[ie]"
				id="campo3"
				value="<?php echo isset($customer['ie']) ? formataie($customer['ie']) : ''; ?>">
		</div>

	</div>

	<div id="actions" class="row mt-2">
		<div class="col-md-12">
			<button type="submit" class="button-74 me-4"><i class="fa-solid fa-sd-card"></i> Salvar</button>
			<a href="index.php" class="button-74"> <i class="fa-solid fa-arrow-left"></i> Cancelar</a>
		</div>
	</div>
</form>

<?php include(FOOTER_TEMPLATE); ?><?php
