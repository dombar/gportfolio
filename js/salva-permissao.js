function salvaPermissaoUsuario($idUsuario) {
    var codigo = $idUsuario;
    var nome = $('#nomesSelecaoPermissao').val();
	if(nome.length > 0){
        $.ajax({
            url: '../service/IncluirPermissao.php',
            type: 'POST',
            data: {
                codigo: codigo,
                nome: nome,
                dataType: 'json',
            },
            success: function(xhr, data) {
               location.reload();
               return data;
            },
            error: function(req, err) {
                console.log('Erro ao rinserir permissão usuário' + err)
            }
        });
	}
}