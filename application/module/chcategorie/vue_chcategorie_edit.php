    <form method="post" action="<?=hlien("chcategorie","save")?>">
		<input type="hidden" name="chc_id" id="chc_id" value="<?= $id ?>" />
		
                        <div class='form-group'>
                            <label for='chc_categorie'>Categorie</label>
                            <input id='chc_categorie' name='chc_categorie' type='text' size='50' value='<?=mhe($chc_categorie)?>'  class='form-control' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              