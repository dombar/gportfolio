function pesquisaIndicadores(idProjeto) {
	var nome = $('#inputNomeIndicador').val();
    $.ajax({
        url: '../service/ProcessaNomesIndicadores.php',
        type: 'GET',
        data: {
			nome:nome,
			idProjeto:idProjeto,
            dataType: 'json',
        },
        success: function(xhr, data) {
            location.href = '../view/PesquisaIndicadores.php';
            return data;
        },
        error: function(req, err) {
            console.log('Erro ao pesquisar por indicadores' + err);
        }
    });
}

function pesquisaIndicadoresRelatorio(idProjeto) {
    $.ajax({
        url: '../service/DetalhesIndicador.php',
        type: 'GET',
        data: {
			id:idProjeto,
            dataType: 'json',
        },
        success: function(xhr, data) {
            location.href = '../view/DetalhesIndicadoresRelatorio.php';
            return data;
        },
        error: function(req, err) {
            console.log('Erro ao pesquisar por indicadores' + err);
        }
    });
}

function pesquisaIndicadoresRelatorioTela() {
    var idProjeto = $('#inputCodigoIndicador').val();
    var nome = $('#inputNomeIndicador').val();
    console.log(idProjeto);
    $.ajax({
        url: '../service/PesquisaIndicadoresRelatorio.php',
        type: 'GET',
        data: {
			id:idProjeto,
            nome:nome,
            dataType: 'json',
        },
        success: function(xhr, data) {
           location.href = '../view/RelatorioIndicadores.php';
            return data;
        },
        error: function(req, err) {
            console.log('Erro ao pesquisar por indicadores' + err);
        }
    });
    
}

function associarIndicadores(){
	location.href = '../view/AssociacaoIndicadores.php';
}

function salvarIndicadores(){
	var nome = $('#nomesSelecao').val();
	var valorMa = $('#valorMaximo').val();
	var valorMi = $('#valorMinimo').val();
	var id = $('#idProjeto').val();
	if(valorMa.length > 0 && valorMi.length > 0){
    $.ajax({
        url: '../service/SalvaAssocIndicadores.php',
        type: 'POST',
        data: {
			indicadoresSelect:nome,
			idProjeto:id,
			valorMaximo:valorMa,
			valorMinimo:valorMi,
            dataType: 'json',
        },
        success: function(xhr, data) {
           location.href = '../view/AssociacaoIndicadores.php';
           return data;
        },
        error: function(req, err) {
            console.log('Erro ao pesquisar por indicadores' + err);
        }
    });
}
}


function deletaIndicadorProjeto(idIndicador, idProjeto) {
    if (confirm("Deseja realmente excluir esse indicador do projeto!") == true) {
		if(idIndicador != null && idProjeto != null){
            $.ajax({
            url: '../service/DeletarIndicadorProjeto.php',
            type: 'POST',
            data: {
                idIndicador: idIndicador,
                idProjeto: idProjeto,
                dataType: 'json'
            },
            success: function(xhr, data) {
				location.href = '../view/AssociacaoIndicadores.php';
                return data;
            },
            error: function(req, err) {
                console.log('Erro realizar pesquisa de projetos' + err)
            }
        });
		}
    } else {
		location.href = '../view/AssociacaoIndicadores.php';
    }
}