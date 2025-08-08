
<?php 
    require "config.php";
    include_once DBAPI;
    if(!isset($_SESSION)) session_start();
    include(HEADER_TEMPLATE);
    $db = open_database();
?>
<?php if ($db) : ?>
<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <?php echo $_SESSION['message']; ?></>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php clear_messages(); ?>
<?php endif; ?>

<div class="int">
    <div class="esquerda">
        <h1 class="agrandir" > <b> Um restaurante em sua residência </b></h1>
    </div>
    <div class="direita">
    
    </div>
    
</div>

<?php include(FOOTER_TEMPLATE); ?>
