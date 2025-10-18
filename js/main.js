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

$('#delete-modal-marmitas').on('show.bs.modal', function (event) {

  var button = $(event.relatedTarget);
  var id = button.data('marmita');

  var modal = $(this);
  modal.find('.modal-title').text('Excluir o orçamento com id = ' + id);
  modal.find('.modal-body').text('Deseja realmente excluir o orçamento com id= ' + id + '?');
  modal.find('#confirm').attr('href', 'delete.php?id_mar=' + id);
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
  var data = document.querySelector('#data_evento').value;
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
    + "*Data : *" + data + "%0a"
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

  var quantidade_Marmitas = document.querySelector('#quantidadeMarmitas').value;
  var fit = document.querySelector('#fit').checked;
  var fit_ou_normal = "";
  var dieta_ou_nao = "";
  var dieta = document.querySelector('#planejar_dieta').checked;
  var detalhes = document.querySelector('#detalhesPedido').value;

  if (fit == true){
    fit_ou_normal = "fit"
  }else{
    fit_ou_normal = "normal"
  }
  if (dieta == true){
    dieta_ou_nao = "Desejo que tenha uma dieta planejada para mim"
  }else{
    dieta_ou_nao = "Não necessito de uma nova dieta, já possuo um plano alimentar"
  }


  var url = "https://wa.me/" + phonenumber + "?text="
    + "*Quantidade de marmitas semanais :* " + quantidade_Marmitas + "%0a"
    + "*Marmita fit ou normal :* " + fit_ou_normal + "%0a"
    + "*Necessita de dieta nova ou já possui :* " + dieta_ou_nao + "%0a"
    + "*Detalhamento das marmitas :* " + detalhes + "%0a%0a";

  window.open(url, '_blank').focus();

}

