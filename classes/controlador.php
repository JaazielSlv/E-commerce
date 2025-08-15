<?php
session_start();

require_once "classes/produto.php";
require_once "classes/clientes.php";
require_once "classes/boleto.php";
require_once "classes/paypal.php";
require_once "classes/cartao_credito.php";
require_once "classes/notificacao.php";

class Controlador  extends Notification
{

    public function index()
    {
        $prod = new Produto();
        $ret = $prod->gerarProdutos();

        require_once "public/home/home.php";
    }

    public function inserirCarrinho()
    {
        $id = 0;
        $cliente = (new Clientes())->obterClientes();


        if ($_GET && isset($_GET['id'])):

            $id = $_GET['id'];
            $linha = -1;
            $existe = false;

            // Inicializa o carrinho se não existir
            if (!isset($_SESSION['carrinho'])) {
                $_SESSION['carrinho'] = [];
            }

            if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0):
                foreach ($_SESSION['carrinho'] as $linha => $valor):
                    // Verifica se $valor é um array e se possui a chave 'id'
                    if (is_array($valor) && isset($valor['id']) && $valor['id'] == $id):
                        $existe = true;
                        break; // Para o loop quando encontrar o produto
                    endif;
                endforeach;
            endif;

            if (!$existe):
                $produto = (new Produto())->obterProdutoPorId($id);
                #var_dump($produto);
                if (isset($produto) && $produto !== null):
                    // Calcula o próximo índice baseado no tamanho atual do array
                    $proximoIndice = count($_SESSION['carrinho']);
                    $_SESSION['carrinho'][$proximoIndice]['id'] = $produto->getId();
                    $_SESSION['carrinho'][$proximoIndice]['descricao'] = $produto->getDescricao();
                    $_SESSION['carrinho'][$proximoIndice]['preco'] = $produto->getPreco();
                    $_SESSION['carrinho'][$proximoIndice]['imagem'] = $produto->getImagem();
                    $_SESSION['carrinho'][$proximoIndice]['qtde'] = 1;

                    if (!isset($_SESSION['qtdeProduto'])):
                        $_SESSION['qtdeProduto'] = 0;
                    endif;
                    $_SESSION['qtdeProduto'] += 1;

                endif;
            endif;

        endif;

        require_once "public/home/carrinho/index.php";
    }

    public function atualizarCarrinho()
    {

        if ($_GET):

            $linha = $_GET['linha'];

            if (isset($_SESSION['carrinho'][$linha])):
                $_SESSION['qtdeProduto'] -= $_SESSION['carrinho'][$linha]['qtde'];

                unset($_SESSION['carrinho'][$linha]);

            endif;

            header('location:index.php?arquivo=Controlador&metodo=inserirCarrinho');

        endif;

        if ($_POST):

            $linha = $_POST['linha'];
            $qtde = $_POST['quantidade'];

            if ($qtde > 0):
                $_SESSION['carrinho'][$linha]['qtde'] = $qtde;

                $_SESSION['qtdeProduto'] = 0;
                foreach ($_SESSION['carrinho'] as $itens):
                    // Verifica se $itens é um array e possui a chave 'qtde'
                    if (is_array($itens) && isset($itens['qtde'])):
                        $_SESSION['qtdeProduto'] += $itens['qtde'];
                    endif;
                endforeach;


            endif;
        endif;
    }

    public function finalizarCarrinho()
    {
       require_once "public/shared/header.php";
        if ($_POST):

            $clienteId = $_POST['cliente'];
            $formaPag = $_POST['formapagamento'];

            // Verifica se os campos obrigatórios foram preenchidos
            if (empty($clienteId) || empty($formaPag)):
                echo "<div class='container flex justify-center'>";
                echo "<div class='box-6 pd-10 bg-branco radius mg-t-10'>";
                echo "<p class='fonte16 fnc-error txt-c'>Por favor, selecione um cliente e uma forma de pagamento.</p>";
                echo "<a href='index.php?arquivo=controlador&metodo=inserirCarrinho' class='btn-100 bg-p2-azul fnc-branco mg-t-2'>Voltar ao carrinho</a>";
                echo "</div>";
                echo "</div>";
                require_once "public/shared/footer.php";
                return;
            endif;

            $cli = (new Clientes())->obterClientes();
            $cliSelecionado = null;
            foreach ($cli as $valor):
                if ($valor->getId() == $clienteId):
                    $cliSelecionado = $valor;
                    break;
                endif;
            endforeach;


            $formaPagamento = null;
            switch ($formaPag):
                case 'Boleto':
                    $formaPagamento = new Boleto();
                    break;
                case 'Paypal':
                    $formaPagamento = new PayPal();
                    break;
                case 'Cartão de credito':
                    $formaPagamento = new CartaoCredito();
                    break;
                default:
                    $formaPag = "Forma de pagamento não selecionada";
                    break;
            endswitch;

            echo " <div class='container flex justify-center'> ";
               echo " <div class='box-6 pd-10 bg-branco radius mg-t-10'> ";
                   echo " <div class='box-12'> ";
                   echo "<h3 class=' poppins-medium fonte24'> Detalhes da compra </h3> ";
                   echo "<div class='divider mg-t-2 mg-b-2'></div>";
                   #LISTANDO DADOS DO CLIENTE
                   echo "<div class='box-12 flex justify-between'>";
                   if ($cliSelecionado !== null):
                      echo "<p class='fonte14 espaco-letra poppins-medium'><strong class'fonte16'>Cliente:</strong>{$cliSelecionado->getNome()} </p>";
                      echo "<p class='fonte14 espaco-letra poppins-medium'><strong class'fonte16'>Documento:</strong>{$cliSelecionado->getCpf()} </p>";
                   else:
                      echo "<p class='fonte14 espaco-letra poppins-medium fnc-error'><strong>Erro:</strong> Cliente não selecionado ou não encontrado</p>";
                   endif;
                   echo "</div>";

                   echo "<div class='limpar'></div> <div class='divider mg-t-2 mg-b-2'></div>";
                   
                   #LISTANDO ITENS DO CARRINHO
                   echo "<div class='box-12 mg-t-2'>";
                      echo "<h3 class='poppins-medium fonte24 mg-b-2'> Itens no carrinho </h3> ";
                      echo "<div class='box-12'>";
                      $total = 0; // Inicializa total antes do if
                      if(isset($_SESSION['carrinho'])):
                        foreach ($_SESSION['carrinho']  as $key => $valor):
                            // Verifica se $valor é um array e possui as chaves necessárias
                            if (is_array($valor) && isset($valor['qtde']) && isset($valor['preco'])):
                                $subTotal = $valor['qtde'] * $valor['preco'];
                                $total += $subTotal;
                                echo "<div class='box-12 bg-p3-paper radius pd-10 mg-b-2'>";
                                   echo "<div class='box-2'>";
                                      echo "<img src='lib/img/{$valor['imagem']}' class=' logo-40' />";
                                   echo "</div>";
                                echo "<div class='box-10'>";

                                echo "<p class='fonte14 espaco-letra poppins-medium'><strong class'fonte16'>Descrição:</strong>{$valor['descricao']} </p>";
                                echo "<p class='fonte14 espaco-letra poppins-medium'><strong class'fonte16'>Qtde:</strong>{$valor['qtde']} </p>";
                                echo "<p class='fonte14 espaco-letra poppins-medium'><strong class'fonte16'>Sub-total:</strong> R$ ". number_format($subTotal,2,',','.') ."</p>";
                     
                                echo "</div>";
                                echo "</div>";
                            endif;
                        endforeach;
                      endif;

                      echo "<div class='box-12'> <h4 class='txt-d fonte16 poppins-black fnc-cinza'>Total: <span class=' poppins-medium'>R$ ". number_format($total,2,',','.') ." </span></h4> </div>";
                      echo "<div class='box-12 mg-t-2 bg-p1-verde2 radius pd-10'> <p class='txt-c fnc-verde poppins-medium'> Pagamento realizado via {$formaPag} </p> </div>";

                   echo "<div>";  
                   #FIM DA LISTAGEM DE PRODUTOS
                   
                   // Processa o pagamento se a forma de pagamento foi selecionada
                   if ($formaPagamento !== null):
                       echo "<div class='box-12 mg-t-2 pd-10 bg-p3-paper radius'>";
                       echo "<h4 class='fonte16 poppins-medium mg-b-1'>Processando Pagamento:</h4>";
                       $formaPagamento->pagar($total);
                       echo "</div>";
                   endif;
                   
                   echo "<div class='box-12 mg-t-2'> <a href='index.php?arquivo=controlador&metodo=index' class='btn-100 bg-p1-amarelo fnc-branco'>Voltar à Loja</a> </div>";

                   echo " </div> ";
               echo " </div> ";
            echo " </div> ";

            unset($_SESSION['carrinho']);
            unset($_SESSION['qtdeProduto']);
            

        endif;
    }

    public function removerCarrinho()
    {
        if (isset($_GET['linha'])):
            $linha = $_GET['linha'];

            // Verifica se a linha existe no carrinho
            if (isset($_SESSION['carrinho'][$linha])):
                
                // Decrementa a quantidade total de produtos
                if (isset($_SESSION['qtdeProduto']) && isset($_SESSION['carrinho'][$linha]['qtde'])):
                    $_SESSION['qtdeProduto'] -= $_SESSION['carrinho'][$linha]['qtde'];
                endif;

                // Remove o item do carrinho
                unset($_SESSION['carrinho'][$linha]);

                // Reindexar o array para evitar problemas com índices
                $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);

                // Se o carrinho ficou vazio, redefine a quantidade
                if (empty($_SESSION['carrinho'])):
                    $_SESSION['qtdeProduto'] = 0;
                endif;

            endif;
        endif;

        // Redireciona de volta para o carrinho
        header('Location: index.php?arquivo=controlador&metodo=inserirCarrinho');
        exit();
    }

    public function obterQuantidadeCarrinho()
    {
        // Método simples para retornar apenas a quantidade de itens no carrinho
        echo isset($_SESSION['qtdeProduto']) ? $_SESSION['qtdeProduto'] : 0;
        exit();
    }

    public function adicionarCarrinhoAjax()
    {
        // Verifica se é uma requisição POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método não permitido']);
            exit();
        }

        $response = ['success' => false, 'message' => '', 'quantidade' => 0];

        try {
            // Verifica se o ID foi enviado
            if (!isset($_POST['id']) || empty($_POST['id'])) {
                $response['message'] = 'ID do produto não informado';
                echo json_encode($response);
                exit();
            }

            $id = intval($_POST['id']);
            $linha = -1;
            $existe = false;

            // Inicializa o carrinho se não existir
            if (!isset($_SESSION['carrinho'])) {
                $_SESSION['carrinho'] = [];
            }

            // Verifica se o produto já existe no carrinho
            if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
                foreach ($_SESSION['carrinho'] as $linha => $valor) {
                    if (is_array($valor) && isset($valor['id']) && $valor['id'] == $id) {
                        $existe = true;
                        break;
                    }
                }
            }

            if (!$existe) {
                $produto = (new Produto())->obterProdutoPorId($id);
                
                if (isset($produto) && $produto !== null) {
                    // Calcula o próximo índice baseado no tamanho atual do array
                    $proximoIndice = count($_SESSION['carrinho']);
                    $_SESSION['carrinho'][$proximoIndice]['id'] = $produto->getId();
                    $_SESSION['carrinho'][$proximoIndice]['descricao'] = $produto->getDescricao();
                    $_SESSION['carrinho'][$proximoIndice]['preco'] = $produto->getPreco();
                    $_SESSION['carrinho'][$proximoIndice]['imagem'] = $produto->getImagem();
                    $_SESSION['carrinho'][$proximoIndice]['qtde'] = 1;

                    if (!isset($_SESSION['qtdeProduto'])) {
                        $_SESSION['qtdeProduto'] = 0;
                    }
                    $_SESSION['qtdeProduto'] += 1;

                    $response['success'] = true;
                    $response['message'] = 'Produto adicionado ao carrinho com sucesso!';
                    $response['quantidade'] = $_SESSION['qtdeProduto'];
                } else {
                    $response['message'] = 'Produto não encontrado';
                }
            } else {
                $response['message'] = 'Produto já está no carrinho';
                $response['quantidade'] = isset($_SESSION['qtdeProduto']) ? $_SESSION['qtdeProduto'] : 0;
            }

        } catch (Exception $e) {
            $response['message'] = 'Erro interno do servidor';
        }

        // Define o cabeçalho como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}