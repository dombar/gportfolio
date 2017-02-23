<style>
	.modal { left: 20%; }
</style>
<form role="form" method="post" id="esqueci-senha-form" action="./service/EmailSenha.php" autocomplete="off">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Recuperação de senha.</h4>
      </div>
      <div class="modal-body">
	  <input type="email" name="inputEmail" id="email" class="form-control" placeholder="E-mail" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
	  </form>

