<?php require_once "public/shared/header.php"; ?>
<!-- <link rel="stylesheet" href="../../../lib/aurora.css">
<link rel="stylesheet" href="../../../lib/site.css"> -->
<section class="car edicao">
    <div class="carrinho-container">
        <div class="carrinho-wrapper">
            <form action="index.php?arquivo=controlador&metodo=finalizarCarrinho" method="POST">
                <table class="car-table ">
                    <thead>
                        <tr>
                            <th class="pd-10 bg-p2-azul fonte14">Codigo</th>
                            <th class="pd-10 bg-p2-azul fonte14">Produto</th>
                            <th class="pd-10 bg-p2-azul fonte14">Qtde</th>
                            <th class="pd-10 bg-p2-azul fonte14">Preço</th>
                            <th class="pd-10 bg-p2-azul fonte14">Imagem</th>
                            <th class="pd-10 bg-p2-azul fonte14">Sub-Total</th>
                            <th class="pd-10 bg-p2-azul fonte14">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <?php if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0): ?>
                            <?php foreach ($_SESSION['carrinho'] as $indice => $item): ?>
                                <?php if (is_array($item) && isset($item['id'], $item['descricao'], $item['qtde'], $item['preco'], $item['imagem'])): ?>
                                    <tr class="zebra">
                                        <td class="fonte12 pd-5 txt-c"><?= $item['id']; ?></td>
                                        <td class="fonte12 pd-5 txt-c"><?= $item['descricao']; ?></td>
                                        <td class="fonte12 pd-5 txt-c"><?= $item['qtde']; ?></td>
                                        <td class="fonte12 pd-5 txt-c"><?= "R$".number_format($item['preco'], 2 ,",","."); ?></td>
                                        <td class="fonte12 pd-5 txt-c"><img src="lib/img/<?= $item['imagem']; ?>" alt="" class="logo-40 mg-auto"></td>
                                        <td class="fonte12 pd-5 txt-c"><?= "R$".number_format($item['preco'] * $item['qtde'], 2 ,",","."); ?></td>
                                        <td class="fonte12 pd-5 txt-c">
                                            <a href="index.php?arquivo=controlador&metodo=removerCarrinho&linha=<?= $indice; ?>" class="txt-c flex justify-center item-centro">
                                                <i class="fa-solid fa-trash-can font22 fnc-error"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="fonte12 pd-5 txt-c">Carrinho vazio</td>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <td colspan="7">
                                <div class="form-container">
                                    <div class="form-row">
                                        <label for="">Selecionar Clientes</label>
                                        <select name="cliente" id="" class="mg-b-4">
                                            <option value="">Selecione um cliente</option>
                                            <option value="1">Fulano de Tal</option>
                                            <option value="2">Ciclano da Silva</option>
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <label for="">Forma de pagamento</label>
                                        <select name="formapagamento" id="">
                                            <option value="">Selecionar pagamento</option>
                                            <option value="Boleto">Boleto</option>
                                            <option value="Paypal">Paypal</option>
                                            <option value="Cartão de credito">Cartão de credito</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" class="button-group ">
                                <a href="index.php?arquivo=controlador&metodo=index" class="btn-comprar-mais">Comprar mais</a>
                                <input type="submit" value="Finalizar" class="btn-finalizar">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</section>

<script>
// Força a exibição do texto selecionado nos selects
document.addEventListener('DOMContentLoaded', function() {
    const selects = document.querySelectorAll('.form-row select');
    
    selects.forEach(function(select) {
        // Força o estilo ao carregar
        select.style.color = '#000000';
        select.style.backgroundColor = 'white';
        
        // Adiciona evento para quando o valor mudar
        select.addEventListener('change', function() {
            this.style.color = '#000000';
            this.style.backgroundColor = 'white';
            
            // Força atualização visual
            this.blur();
            this.focus();
            this.blur();
        });
        
        // Adiciona evento para foco
        select.addEventListener('focus', function() {
            this.style.color = '#000000';
        });
        
        // Adiciona evento para quando perder o foco
        select.addEventListener('blur', function() {
            this.style.color = '#000000';
        });
    });
});
</script>

<?php require_once "public/shared/footer.php"; ?>