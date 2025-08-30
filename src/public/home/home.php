<?php
require_once "public/shared/header.php";
?>
<section class="banner mg-t-4">
    <div class="container">
        <div class="box-8 flex justify-center item-centro">
            <div class="box-6 mg-t-10">
                <span class=" bg-p1-laranja fonte16 pd-l-1 block wd-50">Grandes Promoções</span>
                <h3 class="fonte50">
                    Venha conferir! <br>
                    Nossos preços <br>
                    estão increiveis!
                </h3>
            </div>
        </div>
    </div>
</section>

<section class="pord mg-t-6">


    <div class="container bg-branco radius">
        <div class="box-12 mg-b-3">
            <h3 class="fonte40 fnc-preto-1 poppins-black">Produtos em destaque</h3>
        </div>
        <?php 
        if(isset($ret) && count($ret) > 0 ):
            foreach ($ret as $key => $valor):
        ?>

        <div class="box-2 borda-1 shadow-down pd-10">
            <div class="box-12">
                <h4 class="fonte14 mg-b-2">Promoção</h4>
            </div>

            <div class="box-8">
                <img src="lib/img/<?= $valor->getimagem();?>" alt="" class="img-prod">
            </div>

            <div class="box-12 mg-t-2 mg-b-2">
                <p class="fonte14"><?= $valor->getdescricao();?></p>
                <div class="divider"></div>
            </div>


            <div class="box-12 mg-t-1 mg-b-2">
                <p class="fonte16 poppins-black txt-c"><?= $valor->getpreco();?></p>
            </div>

            <button onclick="adicionarAoCarrinho(<?= $valor->getid();?>)" class="btn-100 bg-p7-electric mg-t-1 fnc-branco font14 bg-p1-verde-hover adicionar-carrinho-btn">Adicionar ao carrinho</button>
        </div>

        <?php endforeach; 
        endif; ?>

    </div>
</section>

<script>
function adicionarAoCarrinho(produtoId) {
    // Encontra o botão que foi clicado
    const botao = event.target;
    const textoOriginal = botao.innerHTML;
    
    // Desabilita o botão e mostra loading
    botao.disabled = true;
    botao.innerHTML = 'Adicionando...';
    botao.style.opacity = '0.6';
    
    // Faz a requisição AJAX
    fetch('index.php?arquivo=controlador&metodo=adicionarCarrinhoAjax', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + produtoId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Sucesso - atualiza o contador do carrinho
            atualizarContadorCarrinho();
            
            // Feedback visual de sucesso
            botao.innerHTML = '✓ Adicionado!';
            botao.style.backgroundColor = '#28a745';
            
            // Mostra mensagem de sucesso
            mostrarMensagem(data.message, 'success');
            
            // Restaura o botão após 2 segundos
            setTimeout(() => {
                botao.disabled = false;
                botao.innerHTML = textoOriginal;
                botao.style.opacity = '1';
                botao.style.backgroundColor = '';
            }, 2000);
            
        } else {
            // Erro - mostra mensagem
            mostrarMensagem(data.message, 'error');
            
            // Restaura o botão
            botao.disabled = false;
            botao.innerHTML = textoOriginal;
            botao.style.opacity = '1';
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        mostrarMensagem('Erro ao adicionar produto ao carrinho', 'error');
        
        // Restaura o botão
        botao.disabled = false;
        botao.innerHTML = textoOriginal;
        botao.style.opacity = '1';
    });
}

function mostrarMensagem(mensagem, tipo) {
    // Remove mensagem anterior se existir
    const mensagemAnterior = document.querySelector('.mensagem-feedback');
    if (mensagemAnterior) {
        mensagemAnterior.remove();
    }
    
    // Cria a div da mensagem
    const div = document.createElement('div');
    div.className = 'mensagem-feedback';
    div.innerHTML = mensagem;
    
    // Estilo da mensagem
    div.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        z-index: 9999;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease;
        max-width: 300px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    `;
    
    // Cor baseada no tipo
    if (tipo === 'success') {
        div.style.backgroundColor = '#28a745';
    } else {
        div.style.backgroundColor = '#dc3545';
    }
    
    // Adiciona ao body
    document.body.appendChild(div);
    
    // Anima a entrada
    setTimeout(() => {
        div.style.opacity = '1';
        div.style.transform = 'translateX(0)';
    }, 10);
    
    // Remove após 4 segundos
    setTimeout(() => {
        div.style.opacity = '0';
        div.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (div.parentNode) {
                div.parentNode.removeChild(div);
            }
        }, 300);
    }, 4000);
}
</script>

<?php require_once "public/shared/footer.php"; ?>