$(document).ready(function() {
    // Manipulador de evento para envio do formulário
    $('#cart-form').submit(function(e) {
      e.preventDefault();
    
      var cartItems = [];
      $('.cart-item').each(function() {
        var itemText = $(this).text().trim();
        var nomePeca = itemText.split(' - R$ ')[0];
        var valorVenda = parseFloat(itemText.split(' - R$ ')[1].split(' - Quantidade: ')[0]);
        var quantidade = parseInt(itemText.split(' - Quantidade: ')[1]);
        var total = parseFloat((valorVenda * quantidade).toFixed(2));
        var codPeca = $(this).data('cod-peca');
    
        cartItems.push({
          cod_peca: codPeca,
          nome_peca: nomePeca,
          valor_venda: valorVenda,
          quantidade: quantidade,
          total: total
        });
      });
    
      $.ajax({
        url: '_script/venda.php',
        type: 'POST',
        data: {
          cart_items: JSON.stringify(cartItems)
        },
        success: function(response) {
          alert(response);
          $('.cart-item').remove();
          $('#total-compra').text('Total da compra: R$ 0.00');
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
          alert('Erro ao processar a venda.');
        }
      });
    });
  });
  