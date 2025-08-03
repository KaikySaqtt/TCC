$('#delete-modal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget);
  var id = button.data('customer');
  
  var modal = $(this);
  modal.find('.modal-title').text('Excluir Cliente: ' + id);
  modal.find('.modal-body').text('Deseja realmente excluir o cliente ' + id + '?');
  modal.find('#confirm').attr('href', 'delete.php?id=' + id);
});

$('#delete-gerente-modal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget);
  var id = button.data('customer');
  
  var modal = $(this);
  modal.find('.modal-title').text('Excluir Gerente: ' + id);
  modal.find('.modal-body').text('Deseja realmente excluir o gerente ' + id + '?');
  modal.find('#confirm').attr('href', 'delete.php?id=' + id);
});

$('#delete-user-modal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget);
  var id = button.data('usuario');
  
  var modal = $(this);
  modal.find('.modal-title').text('Excluir Usuário: ' + id);
  modal.find('.modal-body').text('Deseja realmente excluir o usuário ' + id + '?');
  modal.find('#confirm').attr('href', 'delete.php?id=' + id);
});


