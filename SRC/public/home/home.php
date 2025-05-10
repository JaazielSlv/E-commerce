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

            <a href="index.php?arquivo=controlador&metodo=inserircarrinho&id=<?= $valor->getid();?>" class="btn-100 bg-p7-electric mg-t-1 fnc-branco font14 bg-p1-verde-hover">Adicionar ao carrinho</a>
        </div>

        <?php endforeach; 
        endif; ?>

    </div>
</section>
<?php require_once "public/shared/footer.php"; ?>