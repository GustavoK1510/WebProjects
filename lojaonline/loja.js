const listaProdutos = document.getElementById('lista-produtos');
    const tbody = document.querySelector('#tabela-carrinho tbody');
    const valorTotal = document.getElementById('valor-total');
    const btnEsvaziar = document.getElementById('esvaziar');
    let carrinho = [];

    const produtos = [
  { id: 1, nome: "Camisa Básica", categoria: "Vestuário", preco: 49.90 },
  { id: 2, nome: "Calça Jeans", categoria: "Vestuário", preco: 129.90 },
  { id: 3, nome: "Tênis Esportivo", categoria: "Calçados", preco: 299.90 },
  { id: 4, nome: "Relógio Digital", categoria: "Acessórios", preco: 199.90 },
  { id: 5, nome: "Boné Masculino", categoria: "Acessórios", preco: 39.90 },
  { id: 6, nome: "Jaqueta de Couro", categoria: "Vestuário", preco: 349.90 },
  { id: 7, nome: "Chinelo Slide", categoria: "Calçados", preco: 69.90 },
  { id: 8, nome: "Camisa Polo", categoria: "Vestuário", preco: 79.90 },
  { id: 9, nome: "Mochila Escolar", categoria: "Acessórios", preco: 159.90 },
  { id: 10, nome: "Fone de Ouvido Bluetooth", categoria: "Eletrônicos", preco: 249.90 },
  { id: 11, nome: "Mouse Gamer", categoria: "Eletrônicos", preco: 119.90 },
  { id: 12, nome: "Teclado Mecânico", categoria: "Eletrônicos", preco: 299.90 },
  { id: 13, nome: "Monitor 24''", categoria: "Eletrônicos", preco: 799.90 },
  { id: 14, nome: "Camiseta Estampada", categoria: "Vestuário", preco: 59.90 },
  { id: 15, nome: "Bermuda Jeans", categoria: "Vestuário", preco: 89.90 },
  { id: 16, nome: "Carteira de Couro", categoria: "Acessórios", preco: 99.90 },
  { id: 17, nome: "Óculos de Sol", categoria: "Acessórios", preco: 149.90 },
  { id: 18, nome: "Garrafa Térmica", categoria: "Casa", preco: 79.90 },
  { id: 19, nome: "Caneca Personalizada", categoria: "Casa", preco: 39.90 },
  { id: 20, nome: "Mousepad Gamer", categoria: "Eletrônicos", preco: 49.90 },
  { id: 21, nome: "Notebook 15''", categoria: "Eletrônicos", preco: 3499.00 },
  { id: 22, nome: "Smartphone 128GB", categoria: "Eletrônicos", preco: 2299.00 },
  { id: 23, nome: "Smartwatch", categoria: "Eletrônicos", preco: 899.00 },
  { id: 24, nome: "Carregador Rápido", categoria: "Eletrônicos", preco: 99.90 },
  { id: 25, nome: "Cabo USB-C", categoria: "Eletrônicos", preco: 29.90 },
  { id: 26, nome: "Livro de JavaScript", categoria: "Livros", preco: 79.90 },
  { id: 27, nome: "Livro de HTML e CSS", categoria: "Livros", preco: 69.90 },
  { id: 28, nome: "Livro de Python", categoria: "Livros", preco: 89.90 },
  { id: 29, nome: "Livro de Banco de Dados", categoria: "Livros", preco: 99.90 },
  { id: 30, nome: "Mouse sem Fio", categoria: "Eletrônicos", preco: 89.90 },
  { id: 31, nome: "Caixa de Som Bluetooth", categoria: "Eletrônicos", preco: 229.90 },
  { id: 32, nome: "Pendrive 64GB", categoria: "Eletrônicos", preco: 59.90 },
  { id: 33, nome: "HD Externo 1TB", categoria: "Eletrônicos", preco: 449.90 },
  { id: 34, nome: "Tablet 10''", categoria: "Eletrônicos", preco: 1499.00 },
  { id: 35, nome: "Ventilador de Mesa", categoria: "Casa", preco: 199.90 },
  { id: 36, nome: "Luminária LED", categoria: "Casa", preco: 79.90 },
  { id: 37, nome: "Travesseiro Ortobom", categoria: "Casa", preco: 59.90 },
  { id: 38, nome: "Jogo de Cama Queen", categoria: "Casa", preco: 249.90 },
  { id: 39, nome: "Toalha de Banho", categoria: "Casa", preco: 39.90 },
  { id: 40, nome: "Tênis Casual", categoria: "Calçados", preco: 199.90 },
  { id: 41, nome: "Sandália Feminina", categoria: "Calçados", preco: 159.90 },
  { id: 42, nome: "Sapato Social", categoria: "Calçados", preco: 259.90 },
  { id: 43, nome: "Meias 3 Pares", categoria: "Vestuário", preco: 29.90 },
  { id: 44, nome: "Cinto de Couro", categoria: "Acessórios", preco: 69.90 },
  { id: 45, nome: "Bolsa Feminina", categoria: "Acessórios", preco: 229.90 },
  { id: 46, nome: "Chapéu de Praia", categoria: "Acessórios", preco: 79.90 },
  { id: 47, nome: "Perfume Importado", categoria: "Beleza", preco: 499.90 },
  { id: 48, nome: "Creme Hidratante", categoria: "Beleza", preco: 59.90 },
  { id: 49, nome: "Shampoo Anticaspa", categoria: "Beleza", preco: 39.90 },
  { id: 50, nome: "Escova de Cabelo", categoria: "Beleza", preco: 49.90 }
];

    function exibirProdutos() {
      listaProdutos.innerHTML = '';
      produtos.forEach(produto => {
        const item = document.createElement('div');
        item.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center', 'produto');
        item.innerHTML = `
          <div>
            <h6 class="mb-1">${produto.nome}</h6>
            <small class="text-muted">R$ ${produto.preco.toFixed(2)}</small>
          </div>
          <button class="btn btn-primary btn-sm" onclick="adicionarCarrinho(${produto.id})">Adicionar</button>
        `;
        listaProdutos.appendChild(item);
      });
    }
 
    // Adicionar produto
    function adicionarCarrinho(id) {
      const produto = produtos.find(p => p.id === id);
      const item = carrinho.find(i => i.id === id);

      if (item) item.quantidade++;
      else carrinho.push({ ...produto, quantidade: 1 });

      atualizarCarrinho();
    }

    // Atualizar carrinho
    function atualizarCarrinho() {
      tbody.innerHTML = '';
      let total = 0;

      carrinho.forEach(item => {
        const subtotal = item.preco * item.quantidade;
        total += subtotal;

        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${item.nome}</td>
          <td>
            <div class="qtd-control justify-content-center">
              <button class="btn btn-sm btn-outline-danger qtd-btn" onclick="alterarQuantidade(${item.id}, -1)">-</button>
              <span class="mx-2">${item.quantidade}</span>
              <button class="btn btn-sm btn-outline-success qtd-btn" onclick="alterarQuantidade(${item.id}, 1)">+</button>
            </div>
          </td>
          <td>R$ ${item.preco.toFixed(2)}</td>
          <td>R$ ${subtotal.toFixed(2)}</td>
        `;
        tbody.appendChild(tr);
      });

      valorTotal.textContent = `R$ ${total.toFixed(2)}`;
    }

    // Alterar quantidade
    function alterarQuantidade(id, delta) {
      const item = carrinho.find(i => i.id === id);
      if (!item) return;

      item.quantidade += delta;
      if (item.quantidade <= 0) {
        carrinho = carrinho.filter(i => i.id !== id);
      }
      atualizarCarrinho();
    }

    // Esvaziar carrinho
    btnEsvaziar.addEventListener('click', () => {
      carrinho = [];
      atualizarCarrinho();
    });

    // Inicializa
    exibirProdutos();