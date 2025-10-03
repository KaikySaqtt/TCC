<?php
if (!isset($_SESSION)) session_start();
require("../config.php");
include_once DBAPI;
include(HEADER_TEMPLATE);
$db = open_database();
?>
<?php if ($db): ?>
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['type']; ?> alert-dismissible" role="alert">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif;
    clear_messages(); ?>
<?php endif; ?>
<div class="img-fundo">
    <div class="texto-inicial-jantares text-center">
        <h1 class="agrandir">Experiência de um restaurante <br>em sua residência</h1>
        <a href="#" class="btn btn-km btn-lg mt-3">Pedir orçamento</a>
    </div>
</div>
<div class="mais-info-jantares rounded-3 container">
     <section>
            
     </section>
</div>
<?php include(FOOTER_TEMPLATE); ?>