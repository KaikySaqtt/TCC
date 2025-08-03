
<?php 
    require "config.php";
    include_once DBAPI;
    if(!isset($_SESSION)) session_start();
    include(HEADER_TEMPLATE);
    $db = open_database();
?>
            <br>
            <h1>Dashboard</h1>
            <hr>

            <?php if ($db) : ?>

            
                

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <?php echo $_SESSION['message']; ?></>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php clear_messages(); ?>
<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>
