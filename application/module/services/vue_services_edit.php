    <form method="post" action="<?=hlien("services","save")?>">
		<input type="hidden" name="ser_id" id="ser_id" value="<?= $id ?>" />
		
                        <div class='form-group'>
                            <label for='ser_nom'>Nom</label>
                            <input id='ser_nom' name='ser_nom' type='text' size='50' value='<?=mhe($ser_nom)?>'  class='form-control' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              