function pesquisaUsuario(valueEdit, control) {
    var usuarios = [];
    var codigo = $('#inputCodigoUsuario').val();
    var nome = $('#inputNomeUsuario').val();
    if (codigo.length > 0 || nome.length > 0) {
        $.ajax({
            url: '../service/PesquisaUsuarioService.php',
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
                console.log('Erro realizar pesquisa de usuario' + err)
            }
        });
    } else if (valueEdit != null) {
        $.ajax({
            url: '../service/PesquisaUsuarioService.php',
            type: 'GET',
            data: {
                editar: valueEdit,
                dataType: 'json',
            },
            success: function(xhr, data) {
               location.href = '../view/CadastroUsuario.php';
               return data;
            },
            error: function(req, err) {
                console.log('Erro realizar pesquisa de usuario' + err)
            }
        });
    } else {
        if (control == null || control == 1) {
            $.ajax({
                url: '../service/PesquisaUsuarioService.php',
                type: 'GET',
                data: {
                    dataType: 'json'
                },
                success: function(xhr, data) {
                   location.reload();
                    return data;
                },
                error: function(req, err) {
                    console.log('Erro realizar pesquisa de usuario' + err)
                }
            });
        }
    }
}

function direcionamentoPagina(idUsuario){
	  $.ajax({
            url: '../service/PesquisaUsuarioService.php',
            type: 'GET',
            data: {
                editar: idUsuario,
                dataType: 'json',
            },
            success: function(xhr, data) {
               location.href = '../view/PermissaoAcessoUsuario.php';
               return data;
            },
            error: function(req, err) {
                console.log('Erro realizar pesquisa de usuario' + err)
            }
        });
	
}

function deletarUsuario(idUsuario) {
    if (confirm("Deseja realmente excluir esse usuário!") == true) {
		if(idUsuario != null){
            $.ajax({
            url: '../service/DeletaUsuario.php',
            type: 'POST',
            data: {
                codigo: idUsuario,
                dataType: 'json'
            },
            success: function(xhr, data) {
                location.reload();
				location.href = '../view/PesquisaUsuario.php';
                return data;
            },
            error: function(req, err) {
                console.log('Erro ao excluir usuario' + err)
            }
        });
		}
    } else {
		location.href = '../view/PesquisaUsuario.php';
    }
}