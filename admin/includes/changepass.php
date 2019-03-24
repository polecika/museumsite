		
<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Сменить пароль</h4>
          </div>
         <form action="index.php" method="POST">
          <div class="modal-body">
            <label>Bведите старый пароль:</label>
            <input tyle="password" class="form-control" required name="old-pass">
            <label>Bведите новый пароль:</label>
            <input tyle="password" class="form-control" required name="new-pass1">
            <label>Введите новый пароль повторно:</label>
            <input tyle="password" class="form-control" required name="new-pass2">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            <button  class="btn btn-primary" type="subbmit">Сохранить изменения</button>
          </div>
        </form>
        </div>
      </div>
</div>	
