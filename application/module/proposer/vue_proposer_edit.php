    <form method="post" action="<?=hlien("proposer","save")?>">
		<input type="hidden" name="pro_id" id="pro_id" value="<?= $id ?>" />
		
                        <div class='form-group'>
                            <label for='pro_prix'>Prix</label>
                            <input id='pro_prix' name='pro_prix' type='text' size='50' value='<?=mhe($pro_prix)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='pro_hotel'>Hotel</label>
                            <input id='pro_hotel' name='pro_hotel' type='text' size='50' value='<?=mhe($pro_hotel)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='pro_services'>Services</label>
                            <input id='pro_services' name='pro_services' type='text' size='50' value='<?=mhe($pro_services)?>'  class='form-control' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              