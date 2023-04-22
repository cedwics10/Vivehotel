    <form method="post" action="<?=hlien("commander","save")?>">
		<input type="hidden" name="com_id" id="com_id" value="<?= $id ?>" />
		
                        <div class='form-group'>
                            <label for='com_quantite'>Quantite</label>
                            <input id='com_quantite' name='com_quantite' type='text' size='50' value='<?=mhe($com_quantite)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='com_services'>Services</label>
                            <input id='com_services' name='com_services' type='text' size='50' value='<?=mhe($com_services)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='com_reservation'>Reservation</label>
                            <input id='com_reservation' name='com_reservation' type='text' size='50' value='<?=mhe($com_reservation)?>'  class='form-control' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              