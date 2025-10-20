<?php
// Esse é o login.php
include_once('../config.php');
include(HEADER_TEMPLATE);
?>

<div class="container mt-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0 p-4">
                <div class="card-body text-center">
                    <h2 class="fw-semibold mb-3">
                        <i class="fa-solid fa-right-to-bracket me-2"></i> Login
                    </h2>
                    <form action="valida.php" method="post">
                        <div class="mb-3 text-start">
                            <label for="cpf_cnpj" class="form-label">CPF/CNPJ</label>
                            <input type="text" class="form-control" name="cpf_cnpj" id="cpf_cnpj" required>
                        </div>
                        <div class="mb-4 text-start">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-km">
                                <i class="fa-solid fa-right-to-bracket me-2"></i> Entrar
                            </button>
                            <a href="registrar.php" class="btn btn-light">
                                <i class="fa-solid fa-user-plus me-2"></i> Registrar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include(FOOTER_TEMPLATE); ?>
