<?php if (!isset($_SESSION)) session_start(); ?>
<?php
  // esse é o index.php
  if (!(isset($_SESSION))) session_start();
  if (isset($_SESSION['user'])) {
    if ($_SESSION['user'] != "admin") {
        $_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
        $_SESSION['type'] = "danger";
        header("Location: " .  BASEURL . "index.php");
    }
  } else {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: " . "/crud-bootstrap-php/index.php");
  }
  require('functions.php');

  if(isset($_GET['pdf'])){ // Acrescentado para gerar PDF
    if ($_GET['pdf']=="ok"){
        pdf();
    } else {
        pdf($_GET['pdf']);
    }
  }


  index();
?>

<?php include(HEADER_TEMPLATE); ?>

<header style="margin-top:10px;">
  <div class="row">
    <div class="col-sm-6">
      <h2>Usuários</h2>
    </div>
    <div class="col-sm-6 text-end h2">
      <a class="btn btn-secondary" href="add.php"><i class="fa fa-plus"></i> Novo Usuário</a>
      <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
        <a class="btn btn-danger" href="index.php?pdf=<?php echo $_POST['users']; ?>" download>
          <i class="fa-solid fa-file-pdf"></i> Listage
        </a>
      <?php else : ?>
      <a class="btn btn-danger" href="index.php?pdf=ok" download>
          <i class="fa-solid fa-file-pdf"></i> Listagem
      </a>
      <?php endif; ?>
      <a class="btn btn-light" href="index.php"><i class="fas fa-sync-alt"></i> Atualizar</a>
    </div>
  </div>
</header>

<div name="filtro" action="functions.php" method="post">
  <div class="row">
    <div class="input-group col-mb3">
      <input type="text" class="form-control" maxlength="100" name="users" required>
      <button type="submit" class="btn btn-secondary dashboard-label"><i class="fas fa-search"></i> Consultar</button>
    </div>
  </div>
</div>

<hr>

<?php if (!empty($_SESSION['message'])) : ?>
  <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<?php clear_messages(); ?>

<table class="table table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Login</th>
      <th>Foto</th>
      <th>Opções</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($usuarios) : ?>
      <?php foreach ($usuarios as $usuario) : ?>
        <tr>
          <td style="align-items: center;"><?php echo $usuario['id']; ?></td>
          <td><?php echo $usuario['nome']; ?></td>
          <td><?php echo $usuario['username']; ?></td>
          <td>
            <?php
              if (!empty($usuario['foto'])) {
                echo "<img src=\"fotos/" . $usuario['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
              } else {
                echo "<img src=\"fotos/semimagem.jpg\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
              }
            ?>
          </td>
          <td class="actions">
            <a href="view.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-light"><i class="fa fa-eye"></i> Visualizar</a>
            <a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i> Editar</a>
            <a href="#" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete-user-modal" data-usuario="<?php echo $usuario['id']; ?>"><i class="fa fa-trash-can"></i> Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else : ?>
      <tr>
        <td colspan="6">Nenhum registro encontrado.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>


<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>  