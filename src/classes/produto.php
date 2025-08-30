
<?php
class Produto
{
    private int $id;
    private string $descricao;
    private float $preco;
    private string $imagem;


    public function __construct(int $id = 0, string $descricao ='', float $preco = 0.00, string $imagem = '')
    {
        $this->id  =   $id;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->imagem = $imagem;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function getPreco()
    {
        return $this->preco;
    }
    public function getImagem()
    {
        return $this->imagem;
    }

    public function gerarProdutos()
    {
        return $produtos = [
            new Produto(1, "Notebook", 2899.99, "notebook.png"),
            new Produto(2, "Teclado", 219.99, "teclado.jpg"),
            new Produto(3, "Tablet", 898.99, "tablet.jpeg"),
            new Produto(4, "Oculos", 99.99, "oculos.jpeg"),
            new Produto(5, "Iphone", 8499.99, "iphone.jpg"),
            new Produto(6, "Phone", 89.99, "fone.jpg")
        ];
    }

    public function obterTodos()
    {
        return $this->gerarProdutos();
    }

    public function obterProdutoPorId($id)
    {
        $produtos = $this->gerarProdutos();

        foreach ($produtos as $prod):
            if ($prod->getId() == $id):
                return $prod;
            endif;
        endforeach;

        return null;
    }
}
