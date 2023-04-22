    <form method="post" action="<?=hlien("hocategorie","save")?>">
		<input type="hidden" name="hoc_id" id="hoc_id" value="<?= $id ?>" />
		
                        <div class='form-group'>
                            <label for='hoc_categorie'>Categorie</label>
                            <input id='hoc_categorie' name='hoc_categorie' type='text' size='50' value='<?=mhe($hoc_categorie)?>'  class='form-control' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              