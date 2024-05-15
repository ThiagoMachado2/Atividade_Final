$(document).ready(function() {
    // Manipulador de evento para alteração do seletor #codigo_peca
    $('#codigo_peca').change(function() {
      var codigo_peca = $(this).val();
      var nome_peca = $(this).find('option:selected').text();
      var valor_venda = $(this).find('option:selected').data('valor');
      $('#nome_peca').val(nome_peca);
      $('#valor_venda').val(valor_venda);
    });


    // Manipulador de evento para adicionar ao carrinho a partir do botão nos cards
    $(document).on('click', '.add-to-cart-btn', function() {
      var codigo_peca = $(this).data('cod-peca');
      var nome_peca = $(this).data('nome-peca');
      var valor_venda = $(this).data('valor-venda');
      var quantidade_disponivel = parseInt($(this).data('quantidade'));
      var quantidade = 1; // Você pode definir uma quantidade padrão aqui se desejar
      var total = valor_venda * quantidade;

      // Adicionar ao carrinho
      addToCart(codigo_peca, nome_peca, valor_venda, quantidade, total);
      updateTotal();
  });
    
    // Manipulador de evento para adicionar ao carrinho
    $('#add-to-cart').click(function() {
      var codigo_peca = $('#codigo_peca').val();
      var nome_peca = $('#codigo_peca option:selected').text();
      var valor_venda = $('#codigo_peca option:selected').data('valor');
      var quantidade_disponivel = parseInt($('#codigo_peca option:selected').data('quantidade'));
      var quantidade = $('#quantidade').val();
      var total = valor_venda * quantidade;
    
      if (quantidade > quantidade_disponivel) {
        alert("Quantidade indisponível no estoque!");
        return;
      }
    
      addToCart(codigo_peca, nome_peca, valor_venda, quantidade, total);
      updateTotal();
    });
  });
  
  // Função para adicionar item ao carrinho
  function addToCart(codigo_peca, nome_peca, valor_venda, quantidade, total) {
    $('#cart-items').append('<div class="cart-item" data-cod-peca="' + codigo_peca + '">' + nome_peca + ' - R$ ' + valor_venda + ' - Quantidade: ' + quantidade + '</div>');
  }
  
  // Função para atualizar o total da compra
  function updateTotal() {
    var totalCompra = 0;
    $('.cart-item').each(function() {
      var itemText = $(this).text().trim();
      var valorVenda = parseFloat(itemText.split('R$ ')[1].split(' -')[0]);
      var quantidade = parseInt(itemText.split('Quantidade: ')[1]);
      var totalItem = valorVenda * quantidade;
      totalCompra += totalItem;
    });
    $('#total-compra').text('Total da compra: R$ ' + totalCompra.toFixed(2));
  }
  
  $(document).ready(function() {
    // Evento de clique para o botão "Selecionar"
    $('.select-button').click(function() {
      // Preencher os campos do formulário com os dados da peça selecionada
      $('#nome').val($(this).data('nome'));
      $('#fornecedor').val($(this).data('fornecedor'));
      $('#valor_compra').val($(this).data('valor-compra'));
      $('#valor_venda').val($(this).data('valor-venda'));
      $('#quantidade').val($(this).data('quantidade'));
    });
  });