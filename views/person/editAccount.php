<div id="panel_edit_account" class="tab-pane fade" >
	<form action="#" role="form" id="personForm" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-12">
				<h3>Account Info</h3>
				<hr>
			</div>
			<div class="col-md-6 col-ld-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="control-label">
						First Name
					</label>
					<input type="text" placeholder="Peter" class="form-control" id="name" name="name" value="<?php if(isset($person["name"]))echo $person["name"];?>">
				</div>
				<fieldset>
					<div class="form-group">
						<label class="control-label">
							Email Address
						</label>
						<input type="email" placeholder="peter@example.com" class="form-control" id="email" name="email" value="<?php echo Yii::app()->session["userEmail"];?>">
					</div>
					<div class="form-group">
						<label class="control-label">
							Url
						</label>
						<input type="url" placeholder="www.peter-example.com" class="form-control" id="url" name="url" value="<?php if(isset($person["url"]))echo $person["url"];?>">
					</div>
					<div class="form-group"> 
						<label class="control-label">
							Phone
						</label>
						<input type="tel" placeholder="" class="form-control" id="tel" name="tel" value="<?php if(isset($person["phoneNumber"]))echo $person["phoneNumber"];?>">
					</div>
					<div class="form-group"> 
						<label class="control-label">
							Skype
						</label>
						<input type="text" placeholder="" class="form-control" id="skype" name="skype" value="<?php if(isset($person["skype"]))echo $person["skype"];?>">
					</div>
				</fieldset>
					
					<div class="form-group">
						<label class="control-label">
							Tags
						</label>
						
						<input id="tags" name="tags" value="" style="display: block;">
					</div>
			</div>
			<div class="col-md-6 col-ld-6 col-sm-6 col-xs-12 ">
				
				<div class="form-group"> 
					<label class="control-label">
						Birth
					</label>
					<input type="date" placeholder="01/01/1901" class="form-control" id="birth" name="birth" value="<?php if(isset($person["birt"]))echo $person["birth"];?>">
				</div>
				<div class="form-group"> 
					<label class="control-label">
						Position(s)
					</label>
					<input type="text" placeholder="Position1, Position2" class="form-control" id="position" name="position" value="<?php if(isset($person["position"]))echo $person["position"];?>">
				</div>
				<div class="form-group"> 
					<label class="control-label">
						Supervisor
					</label>
					<input type="text" placeholder="Supervisor" class="form-control" id="supervisor" name="supervisor" value="<?php if(isset($person["supervisor"]))echo $person["supervisor"];?>">
				</div>
				<div class="form-group"> 
					<label class="control-label">
						Group(s)
					</label>
					<input type="text" placeholder="Group1, Group2" class="form-control" id="group" name="group" value="<?php if(isset($person["group"]))echo $person["group"];?>">
				</div>
				<div class="row">

					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">
								Postal Code
							</label>
							<input class="form-control" placeholder="12345" type="text" name="postalCode" id="postalCode"  value="<?php if(isset($person["cp"]))echo $person["cp"];?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">
								City
							</label>
							<select name="city" id="city" class="form-control">
								<option></option>
								<?php 
								foreach (OpenData::$commune["974"] as $key => $value) 
								{
								?>
								<option value="<?php echo $value?>" <?php if(($person && isset($person['city']) && $value == $person['city']) ) echo "selected"; ?> ><?php echo $value?></option>
								<?php 
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">
								Country
							</label>
							<select name="country" id="country" class="form-control">
								<option></option>
								<?php 
								foreach (OpenData::$phCountries as $key => $value) 
								{
								?>
								<option value="<?php echo $key?>" <?php if(($person && isset($person["address"]["addressLocality"]) && $key == $person["address"]["addressLocality"]) ) echo "selected";  ?> ><?php echo $key?></option>
								<?php 
								}
								?>
							</select>
						</div>
					</div>
					
				</div>
				<div class="form-group">
					<label>
						Image Upload
					</label>
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail">
							
							<img src="<?php if ($person && isset($person["imagePath"])) echo $person["imagePath"]; else echo Yii::app()->theme->baseUrl.'/assets/images/avatar-1-xl.jpg' ?>" alt="">
							
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail"></div>
						<div class="user-edit-image-buttons">
							<span class="btn btn-azure btn-file"><span class="fileupload-new"><i class="fa fa-picture"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture"></i> Change</span>
								<input type="file" name="avatar" id="avatar">
							</span>
							<a href="#" class="btn fileupload-exists btn-red" data-dismiss="fileupload">
								<i class="fa fa-times"></i> Remove
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div>
					Required Fields
					<hr>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8  col-xs-12">
				<p>
					By clicking UPDATE, you are agreeing to the Policy and Terms &amp; Conditions.
				</p>
			</div>
			<div class="col-sm-4  col-xs-12">
				<button class="btn btn-green btn-block" type="submit">
					Update <i class="fa fa-arrow-circle-right"></i>
				</button>
			</div>
		</div>
	</form>
</div>