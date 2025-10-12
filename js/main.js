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

function sendwhatsappjantar() {
  // Substitua este número pelo número de telefone de destino
  var phonenumber = "+5515988185623";

  var quantiadepessoas = document.querySelector('#quantidadePessoas').value;
  var endereco = document.querySelector('#endereco').value;
  var almoco = document.querySelector('#almoco').checked;
  var jantaroualmoco = "";
  var sobremesa = document.querySelector('#incluirSobremesa').checked;
  var sobremesasimoounao = '';
  var drinkssimoounao = '';
  var drinks = document.querySelector('#incluirDrinks').checked;
  var detalhes = document.querySelector('#detalhesPedido').value;

  if (almoco == true){
    jantaroualmoco = "almoço"
  }else{
    jantaroualmoco = "jantar"
  }
  if (drinks == true){
    drinkssimoounao = "sim"
  }else{
    drinkssimoounao = "não"
  }
  if (sobremesa == true){
    sobremesasimoounao = "sim"
  }else{
    sobremesasimoounao = "não"
  }

  var url = "https://wa.me/" + phonenumber + "?text="
    + "*Quantidade de pessoas :* " + quantiadepessoas + "%0a"
    + "*Endereco :* " + endereco + "%0a"
    + "*Sobremesa :* " + sobremesasimoounao + "%0a"
    + "*Drinks :* " + drinkssimoounao + "%0a"
    + "*Sobremesa :* " + sobremesa + "%0a"
    + "*Jantar ou almoço :* " + jantaroualmoco + "%0a"
    + "*Detalhamento dos pratos :* " + detalhes + "%0a%0a";

  window.open(url, '_blank').focus();

}
function sendwhatsappmarmita() {
  // Substitua este número pelo número de telefone de destino
  var phonenumber = "+5515988185623";

  var quantiadepessoas = document.querySelector('#quantidadePessoas').value;
  var endereco = document.querySelector('#endereco').value;
  var almoco = document.querySelector('#almoco').checked;
  var jantaroualmoco = "";
  var sobremesa = document.querySelector('#incluirSobremesa').value;
  var drinks = document.querySelector('#incluirDrinks').value;
  var detalhes = document.querySelector('#detalhesPedido').value;

  if (almoco == true){
    jantaroualmoco = "almoço"
  }else{
    jantaroualmoco = "jantar"
  }

  var url = "https://wa.me/" + phonenumber + "?text="
    + "*Quantidade de pessoas :* " + quantiadepessoas + "%0a"
    + "*Endereco :* " + endereco + "%0a"
    + "*Sobremesa :* " + sobremesa + "%0a"
    + "*Drinks :* " + drinks + "%0a"
    + "*Sobremesa :* " + sobremesa + "%0a"
    + "*Jantar ou almoço :* " + jantaroualmoco + "%0a"
    + "*Detalhamento dos pratos :* " + detalhes + "%0a%0a";

  window.open(url, '_blank').focus();

}

