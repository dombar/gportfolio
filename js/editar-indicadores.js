function editarIndicador(idIndicador){
	$.ajax({
            url: '../service/EditarIndicadores.php',
            type: 'POST',
            data: {
                id: idIndicador,
                dataType: 'json',
            },
            success: function(xhr, data) {
                location.href = '../view/CadastroIndicadores.php';
                return data;
            },
            error: function(req, err) {
                console.log('Erro realizar pesquisa de projetos' + err)
            }
        });
}

function cadastroIndicador(){
    	$.ajax({
            url: '../service/LimpaSessaoIndicadores.php',
            type: 'GET',
            data: {
                dataType: 'json',
            },
            success: function(xhr, data) {
                location.href = '../view/CadastroIndicadores.php';
                return data;
            },
            error: function(req, err) {
                console.log('Erro realizar pesquisa de projetos' + err)
            }
        });
}

function deletaIndicador(codigo) {
    if (confirm("Deseja realmente excluir esse indicador!") == true) {
		if(codigo != null || codigo.length > 0){
            $.ajax({
            url: '../service/DeletarIndicador.php',
            type: 'POST',
            data: {
                id: codigo,
                dataType: 'json'
            },
            success: function(xhr, data) {
				location.href = '../view/PesquisaIndicadores.php';
                return data;
            },
            error: function(req, err) {
                console.log('Erro realizar pesquisa de projetos' + err)
            }
        });
		}
    } else {
		location.href = '../view/PesquisaIndicadores.php';
    }
}