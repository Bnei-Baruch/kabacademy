<div id="editMyAccount">
		<?php
		echo <<<HTML
				<form>
					<fieldset>
						<div class="formItem">
							<label for="first_name">{$myAccountData->first_name['translate']}</label>
							<input type="text" name="first_name" value="{$myAccountData->first_name['val']}"
								class="text ui-widget ui-widget-content ui-corner-all" />
						</div>
						<div class="formItem">
							<label for="last_name">{$myAccountData->last_name['translate']}</label>
							<input type="text" name="last_name" value="{$myAccountData->last_name['val']}"
								class="text ui-widget ui-widget-content ui-corner-all" />
						</div>
						<div class="formItem">
							<label for="display_name">{$myAccountData->display_name['translate']}</label>
							<input type="text" name="display_name" value="{$myAccountData->display_name['val']}"
								class="text ui-widget ui-widget-content ui-corner-all" />
						</div>
						<div class="formItem">
							<label for="country">{$myAccountData->country['translate']}</label> 
							<input type="text" name="country" value="{$myAccountData->country['val']}"
								class="text ui-widget ui-widget-content ui-corner-all" />
						</div>
						<div class="formItem">
							<label for="city">{$myAccountData->city['translate']}</label> 
							<input type="text" name="city" value="{$myAccountData->city['val']}"
								class="text ui-widget ui-widget-content ui-corner-all" />
						</div>
						<div class="formItem">
							<label for="age">{$myAccountData->age['translate']}</label>
							<input type="number" min="16" max="100" name="age" value="{$myAccountData->age['val']}"
								class="text ui-widget ui-widget-content ui-corner-all" />
						</div>
						<div class="formItem">
							<label for="gender">{$myAccountData->gender['translate']['gender']}</label> 
							<select id="gender" name="gender">
								<option value="{$myAccountData->gender['translate']['male']}" selected="{$myAccountData->gender['male']}">
									{$myAccountData->gender['translate']['male']}
								</option>
								<option value="{$myAccountData->gender['translate']['female']}"  selected="{$myAccountData->gender['female']}">
									{$myAccountData->gender['translate']['female']}
								</option>
							</select>
						</div>
					</fieldset>
					div
				</form>
HTML;
		?>
			<div id="saveMyAccount">submit</div>
</div>