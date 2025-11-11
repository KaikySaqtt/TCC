<?php
    include("../config.php");
    include(DBAPI);

    $jantares = null;
    $jantar = null;

    /**
     *  Listagem de Clientes
     */
    function index() {
        global $marmitas;
        $jantares = find_all("tab_orcamento_marmitas");
    }
    /**
     *  Cadastro de orçamentos de marmitas
     */

    define('TAMANHO_MAXIMO', 5000000); // 5MB

    function add() {
    if (!empty($_POST)) {
        if (!isset($_SESSION)) session_start();

        // Verifica se o usuário está logado e tem CPF/CNPJ na sessão
        if (!isset($_SESSION['user']) || empty($_SESSION['user']['cpf_cnpj'])) {
            // É uma boa prática não expor detalhes de erro, mas para depuração isso é útil.
            // Em produção, considere um redirecionamento ou uma mensagem genérica.
            die("Erro: Usuário não está logado ou CPF/CNPJ não encontrado na sessão.");
        }

        // Obtém o CPF/CNPJ do usuário logado
        $cpf_cnpj_usuario = $_SESSION['user']['cpf_cnpj'];

        // Conecta ao banco de dados
        $db = open_database();

        try {
            // Prepara a instrução SQL para inserir na tabela correta com as colunas da imagem
            $stmt = $db->prepare('INSERT INTO tab_orcamento_marmita
                    (quantidade_marmitas, fit_ou_normal, dieta_ou_nao, detalhes_mar, data_do_orcamento_mar, cpf_cnpj_usuario)
                VALUES
                    (:quantidade_marmitas, :fit_ou_normal, :dieta_ou_nao, :detalhes_mar, :data_do_orcamento_mar, :cpf_cnpj_usuario)');

            // --- Mapear os valores do formulário ---
            // ATENÇÃO: Os nomes em $_POST['...'] devem corresponder aos 'name' dos seus campos no formulário HTML.
            $quantidade_marmitas = $_POST['quantidade_marmitas'];
            $fit_ou_normal = $_POST['tipo_marmita']; // Ex: 'Fit' ou 'Normal'
            $dieta_ou_nao = isset($_POST['dieta_ou_nao']) ? 1 : 0;     // Ex: 'Sim' ou 'Não'
            $detalhes_mar = $_POST['detalhes_mar'];       // Detalhes do pedido
            $dia_orcamento = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

            // --- Vincular (Bind) os parâmetros ---
            $stmt->bindParam(':quantidade_marmitas', $quantidade_marmitas, PDO::PARAM_INT);
            $stmt->bindParam(':fit_ou_normal', $fit_ou_normal, PDO::PARAM_STR);
            $stmt->bindParam(':dieta_ou_nao', $dieta_ou_nao, PDO::PARAM_BOOL);
            $stmt->bindParam(':detalhes_mar', $detalhes_mar, PDO::PARAM_STR);
            $stmt->bindValue(':data_do_orcamento_mar', $dia_orcamento->format('Y-m-d H:i:s'));
            $stmt->bindParam(':cpf_cnpj_usuario', $cpf_cnpj_usuario, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Redireciona para a página principal após a inserção bem-sucedida
            header('Location: ../index.php?mj=m');
            exit;

        } catch (PDOException $e) {
            // Em caso de erro, exibe a mensagem e os dados para facilitar a depuração
            echo "<pre>";
            echo "Dados do Formulário (POST):<br>";
            print_r($_POST);
            echo "<hr>Dados da Sessão:<br>";
            print_r($_SESSION);
            echo "</pre>";
        }
    }
}
?>
