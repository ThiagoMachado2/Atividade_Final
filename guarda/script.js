<script>
      $('#codigo_peca').change(function() {
        var codigo_peca = $(this).val();
        var nome_peca = $(this).find('option:selected').text();
        var valor_venda = $(this).find('option:selected').data('valor');
        $('#nome_peca').val(nome_peca);
        $('#valor_venda').val(valor_venda);
      });

      $('#cart-form').submit(function(e) {
        e.preventDefault(); // Evita o envio padrão do formulário

        // Captura os itens do carrinho
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

        // Envia os itens do carrinho para venda.php
        $.ajax({
          url: '_script/venda.php',
          type: 'POST',
          data: {
            cart_items: JSON.stringify(cartItems)
          },
          success: function(response) {
            alert(response); // Exibe a resposta do servidor
            // Limpa o carrinho e atualiza o total da compra
            $('.cart-item').remove();
            $('#total-compra').text('Total da compra: R$ 0.00');
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Erro ao processar a venda.');
          }
        });
      });

      $('#add-to-cart').click(function() {
        var codigo_peca = $('#codigo_peca').val();
        var nome_peca = $('#codigo_peca option:selected').text();
        var valor_venda = $('#codigo_peca option:selected').data('valor');
        var quantidade_disponivel = parseInt($('#codigo_peca option:selected').data('quantidade'));
        var quantidade = $('#quantidade').val();
        var total = valor_venda * quantidade;

        if (quantidade > quantidade_disponivel) {
          alert("Quantidade indisponível no estoque!");
          return; // Evita adicionar ao carrinho se a quantidade não estiver disponível
        }

        addToCart(codigo_peca, nome_peca, valor_venda, quantidade, total);
        updateTotal();
      });

      function addToCart(codigo_peca, nome_peca, valor_venda, quantidade, total) {
        $('#cart-items').append('<div class="cart-item" data-cod-peca="' + codigo_peca + '">' + nome_peca + ' - R$ ' + valor_venda + ' - Quantidade: ' + quantidade + '</div>');
      }

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
      };
    </script>