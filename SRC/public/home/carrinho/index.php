<?php require_once "public/shared/header.php"; ?>
<!-- <link rel="stylesheet" href="../../../lib/aurora.css">
<link rel="stylesheet" href="../../../lib/site.css"> -->
<section class="car">
    <div class="container">
        <div class="box-6 mg-t-6">
            <form action="" method="POST">
                <table class="car-table">
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
                    <tbody>
                        <tr class="zebra">
                            <td class="fonte12 pd-5 txt-c"><?= $_SESSION['carrinho']['id'];?></td>
                            <td class="fonte12 pd-5 txt-c"><?= $_SESSION['carrinho']['descricao'];?></td>
                            <td class="fonte12 pd-5 txt-c"><?= $_SESSION['carrinho']['qtde'];?></td>
                            <td class="fonte12 pd-5 txt-c"><?= "R$".number_format($_SESSION['carrinho']['preco'], 2 ,",",".");?></td>
                            <td class="fonte12 pd-5 txt-c"><img src="lib/img/<?= $_SESSION['carrinho']['imagem'];?>" alt="" class="logo-40 mg-auto"></td>
                            <td class="fonte12 pd-5 txt-c">000.00</td>
                            <td class="fonte12 pd-5 txt-c">
                                <a href="" class="txt-c flex justify-center item-centro">
                                    <i class="fa-solid fa-trash-can font22 fnc-error"></i>
                            </td>
                            </a>
                        </tr>

                        <tr>
                            <td colspan="6">
                                <label for="">Selecionar Clientes</label>
                                <select name="cliente" id="" class="mg-b-4">
                                    <option value="">Selecione um cliente</option>
                                    <option value="">joao</option>
                                    <option value="">pedro</option>
                                </select>
                                <label for="">Forma de pagamento</label>
                                <select name="cliente" id="">
                                    <option value="">Selecionar pagamento</option>
                                    <option value="">Boleto</option>
                                    <option value="">Paypal</option>
                                    <option value="">Cartão de credito</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <a href="index.php?arquivo=controlador&metodo=index" class="btn-100 bg-p1-azul mg-b-1 fnc-branco fonte14 fw-800">Comprar mais</a>
                                <input type="submit" value="Finalizar" class=" btn-100 btn-borda-vermelho ">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</section>

<?php require_once "public/shared/footer.php"; ?>