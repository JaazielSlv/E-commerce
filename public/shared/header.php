<?php
ob_start();
if (!isset($_SESSION)):
    session_start();
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ziel Tech</title>
    <!-- CDN DO FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="lib/aurora.css">
    <link rel="stylesheet" href="lib/site.css">
</head>

<body>
    <header class="header-light pd-10">
        <div class="container">
            <div class="box-4">
                <a href="index.php?arquivo=controlador&metodo=index">
                    <h1 class="font40 fnc-preto-1 poppins-black">Ziel Tech</h1>
                </a>
            </div>
            <div class="box-8">
                <ul class="flex justify-end pd-t-1">
                    <li>
                        <a href="index.php?arquivo=controlador&metodo=inserircarrinho" class="flex justify-end item-centro mg-l-1">
                            <i class="fa-solid fa-cart-shopping fonte24 fnc-preto-1"></i>
                            <span id="carrinho-contador" class="balao flex justify-center item-centro fnc-branco "><?= isset($_SESSION['qtdeProduto']) ? $_SESSION['qtdeProduto'] : 0 ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <main>

<script>
// Função simples para atualizar o contador do carrinho
function atualizarContadorCarrinho() {
    const contador = document.getElementById('carrinho-contador');
    if (!contador) return;
    
    // Faz uma requisição simples para obter a quantidade atual
    fetch('index.php?arquivo=controlador&metodo=obterQuantidadeCarrinho')
        .then(response => response.text())
        .then(quantidade => {
            const novaQuantidade = quantidade.trim();
            
            // Só atualiza se a quantidade mudou
            if (contador.textContent !== novaQuantidade) {
                contador.textContent = novaQuantidade;
                
                // Adiciona uma pequena animação
                contador.style.transform = 'scale(1.3)';
                contador.style.backgroundColor = '#28a745';
                setTimeout(() => {
                    contador.style.transform = 'scale(1)';
                    contador.style.backgroundColor = '#2a74ff';
                }, 300);
            }
        })
        .catch(error => {
            console.log('Erro ao atualizar contador:', error);
        });
}

// Atualiza o contador quando a página carrega
document.addEventListener('DOMContentLoaded', function() {
    // Atualiza imediatamente
    atualizarContadorCarrinho();
    
    // Verifica se precisa atualizar baseado na URL
    const urlParams = new URLSearchParams(window.location.search);
    const metodo = urlParams.get('metodo');
    
    if (metodo === 'inserirCarrinho' || metodo === 'removerCarrinho') {
        // Atualiza novamente após um pequeno delay
        setTimeout(atualizarContadorCarrinho, 200);
    }
});

// Adiciona evento para links que alteram o carrinho
document.addEventListener('click', function(e) {
    const link = e.target.closest('a');
    if (link && link.href) {
        if (link.href.includes('inserirCarrinho') || 
            link.href.includes('removerCarrinho') || 
            link.href.includes('inserircarrinho')) {
            
            // Atualiza após a navegação
            setTimeout(atualizarContadorCarrinho, 500);
        }
    }
});

// Atualiza periodicamente (a cada 5 segundos) caso haja múltiplas abas
setInterval(atualizarContadorCarrinho, 5000);
</script>