<div id="panel_edit_account" class="tab-pane fade">
	<form action="#" role="form" id="organizationForm">
		<input id="organizationId" type="hidden" name="organizationId" value="<?php if($organization)echo (string)$organization['_id']; ?>"/>
		<div class="row">
			<div class="col-md-12">
				<h3>Organization Info</h3>
				<hr>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>
						Image Upload
					</label>
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-1-xl.jpg" alt="">
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail"></div>
						<div class="user-edit-image-buttons">
							<span class="btn btn-azure btn-file"><span class="fileupload-new"><i class="fa fa-picture"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture"></i> Change</span>
								<input type="file">
							</span>
							<a href="#" class="btn fileupload-exists btn-red" data-dismiss="fileupload">
								<i class="fa fa-times"></i> Remove
							</a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">
						Accronyme
					</label>
					<input type="text" placeholder="My Organization Short Name" class="form-control" id="shortName" name="shortName" value="<?php if (isset($organization["shortName"])) echo $organization["shortName"]; ?>">
				</div>
				<div class="form-group">
					<label class="control-label">
						Name (Raison Sociale)
					</label><span class="symbol required"></span>
					<input type="text" placeholder="My Organization Name" class="form-control" id="organizationName" name="organizationName" value="<?php echo $organization["name"]?>">
				</div>
				<div class="form-group">
					<label class="control-label">
						Email Address
					</label><span class="symbol required"></span>
					<input type="email" placeholder="peter@example.com" class="form-control" id="organizationEmail" name="organizationEmail" value="<?php if(isset($organization["email"])) echo $organization["email"]?>" >
				</div>
				<div class="form-group">
					<label class="control-label">
						Phone
					</label>
					<input type="phone" placeholder="02 62 99 99 99" class="form-control" id="phone" name="phone">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">
						Centres d'interet 
					</label>
					
        		    <input id="tagsOrganization" type="hidden" name="tagsOrganization" value="<?php echo ($organization && isset($organization['tags']) ) ? implode(",", $organization['tags']) : ""?>" style="display: none;">
				</div>
				<div class="form-group connected-group">
					<label class="control-label">
						Date of Creation
					</label>
					<div class="input-group">
						<input type="text" class="form-control" id="creationDate" name="creationDate">
						<span class="input-group-addon btn-blue"><i class="fa fa-calendar"></i></span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">
						Type <span class="symbol required"></span>
					</label>
					<select name="type" id="type" class="form-control" >
						<option value=""></option>
						<?php
						foreach ($types as $key=>$value) 
						{
						?>
						<option value="<?php echo $key?>" <?php if(($organization && isset($organization['type']) && $key == $organization['type']) ) echo "selected"; ?> ><?php echo $value?></option>
						<?php 
						}
						?>
					</select>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">
								Postal Code
							</label>
							<input class="form-control" placeholder="12345" type="text" name="postalCode" id="postalCode" value="<?php if(isset($organization["address"]))echo $organization["address"]["postalCode"]?>" >
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="control-label">
								City
							</label>
							<input class="form-control tooltips" placeholder="Saint Louis" type="text" data-original-title="We'll display it when you write reviews" data-rel="tooltip"  title="" data-placement="top" name="city" id="city">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">
								Country <span class="symbol required"></span>
							</label>
							<select name="organizationCountry" id="organizationCountry" class="form-control">
								<option></option>
								<?php 
								foreach (OpenData::$phCountries as $key => $value) 
								{
								?>
								<option value="<?php echo $key?>" <?php if((!empty($organization["address"]) && isset($organization["address"]['addressCountry']) && $key == $organization["address"]['addressCountry']) ) echo "selected"; else if ($key == "Réunion") echo "selected"; ?> ><?php echo $key?></option>
								<?php 
								}
								?>
							</select>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3>Additional Info</h3>
				<hr>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">
						Twitter
					</label>
					<span class="input-icon">
						<input class="form-control" type="text" placeholder="Twitter Account" name="twitterAccount" id="twitterAccount">
						<i class="fa fa-twitter"></i> </span>
				</div>
				<div class="form-group">
					<label class="control-label">
						Facebook
					</label>
					<span class="input-icon">
						<input class="form-control" type="text" placeholder="Facebook Account" name="facebookAccount" id="facebookAccount">
						<i class="fa fa-facebook"></i> </span>
				</div>
				<div class="form-group">
					<label class="control-label">
						Google Plus
					</label>
					<span class="input-icon">
						<input class="form-control" type="text" placeholder="Google Plus Account" name="gplusAccount" id="gplusAccount">
						<i class="fa fa-google-plus"></i> </span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">
						Github
					</label>
					<span class="input-icon">
						<input class="form-control" type="text" placeholder="GitHub Account" name="gitHubAccount" id="gitHubAccount">
						<i class="fa fa-github"></i> </span>
				</div>
				<div class="form-group">
					<label class="control-label">
						Linkedin
					</label>
					<span class="input-icon">
						<input class="form-control" type="text" placeholder="LinkedIn Account" name="linkedInAccount" id="linkedInAccount">
						<i class="fa fa-linkedin"></i> </span>
				</div>
				<div class="form-group">
					<label class="control-label">
						Skype
					</label>
					<span class="input-icon">
						<input class="form-control" type="text" placeholder="Skype Account" name="skypeAccount" id="skypeAccount">
						<i class="fa fa-skype"></i> </span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div>
					<span class="symbol required"> Required Fields
					<hr>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<p>
					By clicking UPDATE, you are agreeing to the Policy and Terms &amp; Conditions.
				</p>
			</div>
			<div class="col-md-4">
				<button class="btn btn-green btn-block" type="submit">
					Update <i class="fa fa-arrow-circle-right"></i>
				</button>
			</div>
		</div>
	</form>
</div>