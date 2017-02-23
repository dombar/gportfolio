function pesquisaProjeto(valueEdit, control) {
    var projetos = [];
    var codigo = $('#inputCodigoProjeto').val();
    var nome = $('#inputNomeProjeto').val();
    if (codigo.length > 0 || nome.length > 0) {
        $.ajax({
            url: '../service/PesquisaProjeto.php',
            type: 'GET',
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
                console.log('Erro realizar pesquisa de projetos' + err)
            }
        });
    } else if (valueEdit != null) {
        $.ajax({
            url: '../service/PesquisaProjeto.php',
            type: 'GET',
            data: {
                editar: valueEdit,
                dataType: 'json',
            },
            success: function(xhr, data) {
                location.href = '../view/CadastroProjeto.php';
                return data;
            },
            error: function(req, err) {
                console.log('Erro realizar pesquisa de projetos' + err)
            }
        });
	}
    else {
        if (control == null || control == 1) {
            $.ajax({
                url: '../service/PesquisaProjeto.php',
                type: 'GET',
                data: {
                    dataType: 'json'
                },
                success: function(xhr, data) {
                   location.reload();
                    return data;
                },
                error: function(req, err) {
                    console.log('Erro realizar pesquisa de projetos' + err)
                }
            });
        }
    }
}

function editarProjetoMembros($codigo){
	if($codigo != null || codigo.length > 0){
	 $.ajax({
                url: '../service/PesquisaProjeto.php',
                type: 'GET',
                data: {
                    editar: $codigo,
                    dataType: 'json'
                },
                success: function(xhr, data) {
                   location.href = '../view/MembrosProjeto.php';
                    return data;
                },
                error: function(req, err) {
                    console.log('Erro realizar pesquisa de projetos' + err)
                }
            });
	}else{
		console.log("Erro na pesquisa de Membros do projeto. Codigo = " + $codigo)
	}
}

function editarProjetoStatus($codigo){
	if($codigo != null || codigo.length > 0){
                 $.ajax({
                url: '../service/PesquisaProjeto.php',
                type: 'GET',
                data: {
                    editar: $codigo,
                    dataType: 'json'
                },
                success: function(xhr, data) {
					location.reload();
                   location.href = '../view/StatusProjeto.php';
                    return data;
                },
                error: function(req, err) {
                    console.log('Erro realizar pesquisa de projetos' + err)
                }
            });
	}else{
		console.log("Erro na pesquisa de Status do projeto. Codigo = " + $codigo)
	}
}

function deletaProjeto(codigo) {
    if (confirm("Deseja realmente excluir esse projeto!") == true) {
		if(codigo != null || codigo.length > 0){
            $.ajax({
            url: '../service/DeletaProjeto.php',
            type: 'POST',
            data: {
                codigo: codigo,
                dataType: 'json'
            },
            success: function(xhr, data) {
				location.href = '../view/PesquisaProjeto.php';
                return data;
            },
            error: function(req, err) {
                console.log('Erro realizar pesquisa de projetos' + err)
            }
        });
		}
    } else {
		location.href = '../view/PesquisaProjeto.php';
    }
}

						