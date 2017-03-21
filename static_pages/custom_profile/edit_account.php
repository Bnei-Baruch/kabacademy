<div id="editMyAccount" style="display: none;">
		<?php
		echo <<<HTML
				<form>
					<fieldset>
						<div class="form-group col-md-4">
							<label for="first_name">{$myAccountData->first_name['translate']}</label>
							<input type="text" name="first_name" value="{$myAccountData->first_name['val']}"
								class="form-control" />
						</div>
						<div class="form-group col-md-4">
							<label for="last_name">{$myAccountData->last_name['translate']}</label>
							<input type="text" name="last_name" value="{$myAccountData->last_name['val']}"
								class="form-control" />
						</div>
						<div class="form-group col-md-4">
							<label for="display_name">{$myAccountData->display_name['translate']}</label>
							<input type="text" name="display_name" value="{$myAccountData->display_name['val']}"
								class="form-control" />
						</div>
						<div class="form-group col-md-4">
							<label for="country">{$myAccountData->country['translate']}</label> 
							<input type="text" name="country" value="{$myAccountData->country['val']}"
								class="form-control" />
						</div>
						<div class="form-group col-md-4">
							<label for="city">{$myAccountData->city['translate']}</label> 
							<input type="text" name="city" value="{$myAccountData->city['val']}"
								class="form-control" />
						</div>
						<div class="form-group col-md-2">
							<label for="age">{$myAccountData->age['translate']}</label>
							<input type="number" min="16" max="100" name="age" value="{$myAccountData->age['val']}"
								class="form-control" />
						</div>
						<div class="form-group col-md-2">
							<label for="gender">{$myAccountData->gender['translate']['gender']}</label> 
							<select id="gender" name="gender" class="form-control">
								<option value="{$myAccountData->gender['translate']['male']}" {$myAccountData->gender['male']}>
									{$myAccountData->gender['translate']['male']}
								</option>
								<option value="{$myAccountData->gender['translate']['female']}"  {$myAccountData->gender['female']}>
									{$myAccountData->gender['translate']['female']}
								</option>
							</select>
						</div>
						<div class="col-md-12">
							<div id="saveMyAccount" class="button small">сохранить</div>											
						</div>
						
					</fieldset>
				</form>
HTML;
?>
		<div id="removeUserConfirmModal" style="display: none;">
			Vy deistvitelno hotite udalit vash account?
		</div>
		<?php  echo( '<div class="clearfix">'. do_shortcode('[removeUser]').'</div>'); ?>
</div>