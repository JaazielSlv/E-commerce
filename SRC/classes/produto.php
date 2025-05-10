<?php

class produto
{
    private int $id;
    private string $descricao;
    private float $preco;
    private string $imagem;

    public function __construct(int $id = 0, string $descricao = "", float $preco = 0.0, string $imagem = "")
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->imagem = $imagem;
    }

    public function getid()
    {
        return $this->id;
    }

    public function getdescricao()
    {
        return $this->descricao;
    }

    public function getpreco()
    {
        return $this->preco;
    }

    public function getimagem()
    {
        return $this->imagem;
    }

    public function gerar_produtos()
    {

        return $produtos = [
            new produto(1, "Notebook", 1999.00, "notebook.png"),
            new produto(2, "Teclado", 100.00, "teclado.jpg"),
            new produto(3, "Tabelt", 799.00, "tablet.jpeg"),
            new produto(4, "Oculos", 99.00, "oculos.jpeg"),
            new produto(5, "Iphone", 6000.00, "iphone.jpg"),
            new produto(6, "Fone", 50.00, "fone.jpg"),
        ];
    }
    public function obter_todos()
    {
        return $this->gerar_produtos();
    }

    public function obter_produto_por_id($id)
    {
        $produtos = $this->gerar_produtos();

        foreach ($produtos as $prod):
            if ($prod->getid() == $id):
                return $prod;
            endif;
        endforeach;
        return null;
    }
}
