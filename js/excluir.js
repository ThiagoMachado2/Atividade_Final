$(document).ready(function() {
    $('.delete-btn').click(function() {
        var cod_peca = $(this).data('id');
        var row = $(this).closest('tr');

        $.ajax({
            url: '_script/excluir.php',
            type: 'POST',
            data: { Cod_Peca: cod_peca },
            success: function(response) {
                console.log('Response from server:', response);
                if (response.trim() === 'success') {
                    row.remove();
                    Swal.fire({
                        icon: 'success',
                        title: 'Peça excluída com sucesso!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro ao excluir a peça.',
                        text: 'Por favor, tente novamente.'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro na requisição AJAX: ', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao excluir a peça.',
                    text: 'Erro: ' + error
                });
            }
        });
    });
});
