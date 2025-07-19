# Plataforma E-commerce ZIEL-TECH

## 🌟 Visão Geral
ZIEL-TECH é um projeto de uma  plataforma de e-commerce baseada na web, projetada para demonstrar uma loja online funcional. Ela permite que os usuários naveguem por produtos, adicionem-nos a um carrinho de compras e simulem um processo de checkout com diferentes métodos de pagamento. O principal propósito deste código é servir como um exemplo prático dos princípios da Programação Orientada a Objetos (POO) aplicados a um cenário do mundo real. Este projeto também serviu como um trabalho prático para um curso de PHP, permitindo aplicar os conhecimentos adquiridos em um contexto de desenvolvimento web real. **Este projeto é 100% focado em Programação Orientada a Objetos (POO)**, refletindo uma filosofia de design central ("Projeto-POO-Tech") evidente em toda a sua estrutura.

---

## ✨ Principais Funcionalidades
* Exibição de catálogo de produtos (homepage).
* Funcionalidade de carrinho de compras (adicionar ao carrinho, visualizar carrinho). Um link para o carrinho também está presente no cabeçalho.
* Simulação de múltiplos métodos de pagamento (como Boleto, PayPal, Cartão de Crédito) gerenciados através de princípios POO.
* Roteamento de página dinâmico usando um front controller.
* Gerenciamento básico de dados de clientes e vendas (conceitualizado em classes).
* Sistema de notificações ao usuário para ações (mensagens de sucesso/erro) faz parte do design.

---

## 💻 Tecnologias Principais
* **PHP:** A principal linguagem de backend usada para toda a lógica e implementação POO.
* **HTML/CSS:** Usado para a estrutura e estilização da interface do usuário. (Folhas de estilo externas como `aurora.css` e `site.css` são referenciadas).
* **Font Awesome:** Incorporado para ícones na interface do usuário.

---

## 🏗️ Destaques da Arquitetura
* **Programação Orientada a Objetos (POO):** A fundação do projeto está profundamente enraizada na POO. Cada parte significativa da funcionalidade, desde a representação do produto até o processamento do pagamento, é encapsulada em classes PHP. Esta abordagem utiliza conceitos como:
    * **Classes e Objetos:** Para modelar entidades do mundo real (ex: `Produto`, `Cliente`, `Venda`, tipos de pagamento).
    * **Herança:** Vista em classes de pagamento que estendem uma classe base `Notificacao`.
    * **Interfaces:** Como `PagamentoInterface` para definir contratos para métodos de pagamento.
    * **Encapsulamento:** Protegendo os componentes internos da classe usando propriedades privadas e fornecendo acesso através de métodos getter.
* **Padrão Front Controller:** Um único ponto de entrada (`index.php` na raiz) lida com todas as requisições de entrada e as direciona para as classes de controller e métodos apropriados.
* **Estrutura similar ao MVC (Model-View-Controller):**
    * **Modelos (Models):** Classes PHP (ex: `Produto`, `Clientes`, `Venda`, várias classes de pagamento) localizadas no diretório `classes/` lidam com a lógica de negócios e os dados.
    * **Visualizações (Views):** Arquivos PHP localizados em `public/home/` (como `home.php`) e `public/home/carrinho/` (como `index.php` para o carrinho) são responsáveis pela camada de apresentação, frequentemente incluindo componentes compartilhados de cabeçalho e rodapé.
    * **Controladores (Controllers):** A classe `Controlador` (e potencialmente outras carregadas dinamicamente pelo front controller) gerencia a entrada do usuário, interage com os modelos e seleciona as visualizações para renderização.

---

## 📂 Visão Geral da Estrutura do Projeto
* `index.php` (Diretório raiz): O Front Controller principal que roteia todas as requisições.
* `classes/`: Contém todas as classes PHP centrais (Modelos, Controladores, lógica de pagamento, etc.).
* `public/`: Provavelmente serve como o diretório raiz do servidor web.
    * `home/`: Contém os arquivos de visualização das páginas principais do site, como `home.php`.
    * `carrinho/`: Contém os arquivos de visualização especificamente para o carrinho de compras, como `index.php`.
    * `shared/`: Contém componentes de visualização reutilizáveis como `header.php` e `footer.php`.
* `lib/` (Inferido dos caminhos no código):
    * `img/`: Armazena imagens de produtos (ex: `notebook.png`, `teclado.jpg`) e banners do site, referenciados nos arquivos de visualização.
    * (Arquivos CSS como `aurora.css` e `site.css` também são vinculados a partir de um caminho `lib/` ou diretamente).

---

## ⚙️ Como Funciona
1.  Todas as requisições do usuário são direcionadas para o `index.php` principal no diretório raiz.
2.  Este Front Controller analisa os parâmetros da URL (`$_GET['arquivo']` e `$_GET['metodo']`) para determinar a classe do controlador de destino (do diretório `classes/`) e o método a ser executado. Se nenhum parâmetro for fornecido, ele assume como padrão o método `index` da classe `Controlador` principal.
3.  A classe Controller designada (ex: `Controlador.php`) processa a requisição. Isso pode envolver a interação com classes Model (ex: buscar dados de produtos da classe `Produto`) ou gerenciar dados da sessão (como os itens do carrinho de compras).
4.  Após o processamento, o Controller seleciona e carrega o arquivo de View apropriado (ex: `public/home/home.php` ou `public/home/carrinho/index.php`) para renderizar a página HTML apresentada ao usuário.
5.  As Views utilizam arquivos de cabeçalho e rodapé compartilhados e exibem dados passados do Controller, incluindo detalhes de produtos e imagens.
