function salvaMembrosProjeto($membros,$idProjeto) {
    var codigo = $idProjeto;
    var nome = $('#nomesSelecao').val();
	if(nome != null && codigo != null){
        $.ajax({
            url: '../service/IncluiMembros.php',
            type: 'POST',
            data: {
                codigo: codigo,
                nome: nome,
                dataType: 'json',
            },
            success: function(xhr, data) {
                return data;
            },
            error: function(req, err) {
                console.log('Erro realizar pesquisa de projetos' + err)
            }
        });
}
}

function deletaUsuarioProjeto(idProjeto, idUsuario) {
    if (confirm("Deseja realmente excluir esse membro do projeto!") == true) {
		if(idProjeto != null && idUsuario != null){
            $.ajax({
            url: '../service/DeletarMembros.php',
            type: 'POST',
            data: {
                idProjeto: idProjeto,
				idUsuario: idUsuario,
                dataType: 'json',
            },
            success: function(xhr, data) {
				location.href = '../view/MembrosProjeto.php';
                return data;
            },
            error: function(req, err) {
                console.log('Erro ao remover membro de projeto' + err)
            }
        });
		}
    } else {
		location.href = '../view/CadastroProjeto.php';
    }
}