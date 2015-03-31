<style type="text/css">
	.dropzoneTEEO {
	    background: none repeat scroll 0 0 white;
	    border: 1px dashed rgba(0, 0, 0, 0.4);

	    min-height: 130px;
	    max-width: 200px;
	}
	.uploaderDiv{
		max-width: 250px;
	}
	.panel-footing{
		text-align: center;
		padding-bottom: 10px;
	}
</style>

<div id="panel_edit_account" class="tab-pane fade" >
	<form  method="post" id="profileForm" enctype="multipart/form-data">
		<div class="fileupload fileupload-new" data-provides="fileupload">
		<div class="fileupload-new thumbnail">
			<img src="<?php if ($person && isset($person["imagePath"])) echo $person["imagePath"]; else echo Yii::app()->theme->baseUrl.'/assets/images/avatar-1-xl.jpg'; ?>" alt="">	
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
		<input type="submit" value="Upload File" />
	</form>
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
				<div class="form-group"> 
					<label class="control-label">
						Birth
					</label>
					<input type="date" placeholder="01/01/1901" class="form-control" id="birth" name="birth" value="<?php if(isset($person["birth"]))echo $person["birth"];?>">
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
					
			</div>
			<div class="col-md-6 col-ld-6 col-sm-6 col-xs-12 ">
				
				
				<div class="form-group posdiv"> 
					<label class="control-label">
						Position
					</label>
					<a href='javascript:addPos()'><i class="fa fa-plus fa-lg"></i></a>
					<input type="text" placeholder="Position" class="form-control" id="position" name="position" value=""></input>

				</div>
				<div class="form-group"> 
					<label class="control-label">
						Supervisor
					</label>
					<input type="text" placeholder="Supervisor" class="form-control" id="supervisor" name="supervisor" value="<?php if(isset($person["supervisor"]))echo $person["supervisor"];?>">
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
					<label class="control-label">
						Tags
					</label>
					
					<input id="tags" type="hidden" style="min-width:100%" name="tagsOrganization" value="<?php echo ($person && isset($person['tags'] ) && $person['tags']!="") ? implode(",", $person['tags']) : ""?>" style="display: none;">
				</div>
				<!--<div class="form-group">
					<label>
						Image Upload
					</label>
					<div class="row uploaderDiv" >
						<div class="col-sm-12">
							
							<div class="panel panel-white hidden">
								<div class="panel-body uploadPanel">
									<div onclick="javascript:removeDrop()" class="dz-clickable dropzoneTEEO" id="project-dropzone"></div>
									
								</div>
								<div class="panel-footing">
									<a href="javascript:removeDrop()" data-dz-remove class="btn btn-warning cancel">
								         <i class="glyphicon glyphicon-ban-circle"></i>
								         <span>Cancel</span>
								     </a>
								</div>
							</div>
							
						</div>
					</div>

				</div>-->
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
						<input class="form-control" type="text" placeholder="Twitter Account" name="twitterAccount" id="twitterAccount" value="<?php if (isset($person["socialNetwork"]["twitterAccount"])) echo $person["socialNetwork"]["twitterAccount"] ?>">
						<i class="fa fa-twitter"></i> </span>
				</div>
				<div class="form-group">
					<label class="control-label">
						Facebook
					</label>
					<span class="input-icon">
						<input class="form-control" type="text" placeholder="Facebook Account" name="facebookAccount" id="facebookAccount" value="<?php if (isset($person["socialNetwork"]["facebookAccount"])) echo $person["socialNetwork"]["facebookAccount"] ?>">
						<i class="fa fa-facebook"></i> </span>
				</div>
				<div class="form-group">
					<label class="control-label">
						Google Plus
					</label>
					<span class="input-icon">
						<input class="form-control" type="text" placeholder="Google Plus Account" name="gplusAccount" id="gplusAccount" value="<?php if (isset($person["socialNetwork"]["gplusAccount"])) echo $person["socialNetwork"]["gplusAccount"] ?>">
						<i class="fa fa-google-plus"></i> </span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">
						Github
					</label>
					<span class="input-icon">
						<input class="form-control" type="text" placeholder="GitHub Account" name="gitHubAccount" id="gitHubAccount" value="<?php if (isset($person["socialNetwork"]["gitHubAccount"])) echo $person["socialNetwork"]["gitHubAccount"] ?>">
						<i class="fa fa-github"></i> </span>
				</div>
				<div class="form-group">
					<label class="control-label">
						Linkedin
					</label>
					<span class="input-icon">
						<input class="form-control" type="text" placeholder="LinkedIn Account" name="linkedInAccount" id="linkedInAccount" value="<?php if (isset($person["socialNetwork"]["linkedInAccount"])) echo $person["socialNetwork"]["linkedInAccount"] ?>">
						<i class="fa fa-linkedin"></i> </span>
				</div>
				<div class="form-group">
					<label class="control-label">
						Skype
					</label>
					<span class="input-icon">
						<input class="form-control" type="text" placeholder="Skype Account" name="skypeAccount" id="skypeAccount" value="<?php if (isset($person["socialNetwork"]["skypeAccount"])) echo $person["socialNetwork"]["skypeAccount"] ?>">
						<i class="fa fa-skype"></i> </span>
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

<!-- end: PAGE CONTENT-->
<script>
	var compt = 0;
	jQuery(document).ready(function() {
		
		$('#tags').select2({ tags: <?php echo $tags ?> });
		$('#tags').select2({ tags: <?php echo $tags ?> });
		PagesUserProfile.init();
		//-------Position input generator-------------------
		
		if("<?php if(isset($person['positions'])){echo is_string($person['positions']);} ?>"){
			$("#position").val("<?php if(isset($person['positions'])  && is_array($person['positions'])==FALSE){ echo $person['positions']; }?>");
		}else{
			var positions = "<?php echo ($person && isset($person['positions']) && is_array($person['positions'])) ? implode(',', $person['positions']) : ""?>";
			console.log(positions.split(","));
			$("#position").val(positions.split(",")[0]);
			for(var i=1; i<positions.split(",").length; i++){
				addPos();
				$("#position"+compt).val(positions.split(",")[i]);
			}
		}
			
		//---------------Profil photo generator----------------------
		/*var	projectDropTab;
		projectDropzone = new Dropzone("#project-dropzone", {
		  acceptedFiles: "image/*",
		  url : baseUrl+"/templates/upload/dir/communecter/collection/person/input/file/rename/true",
		  maxFilesize: 2.0, // MB
		  addRemoveLinks: true,
		  maxFile: 1,
		  autoProcessQueue:false,
		  paramName: "file",
		  /*removedfile: function(file) {
			var _ref;
			return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
		   },*/
		  /*complete: function(response) { 
		  	//console.log(file.name); 
		  	if(response.xhr)
		  	{

			  	docObj = JSON.parse(response.xhr.responseText);
			  	docObj.name="image";
			  	console.log(docObj.result);
			  	editProjectDocuments = [];
			  	var doc = { 
			  		"name" : docObj.name, 
			  		"date" : new Date(), 
			  		"size" : docObj.size  
			  	};
			  	console.dir(doc); 
			  	editProjectDocuments.push( doc );	
			  	
			}
		  },
		  error: function(response) 
		  { 
		  	toastr.error("Something went wrong!!"); 
		  }
		});
		projectDropzone.on('processingfile', function(file) {
			console.log('filename', file.name);
		  file.name = 'image1.jpg';
		});
		var mockFile = { name: $(".dz-filename").text(), size:1285957, type: 'image/jpeg' };
		projectDropzone.options.addedfile.call(projectDropzone, mockFile);
		projectDropzone.options.thumbnail.call(projectDropzone, mockFile, "<?php if ($person && isset($person['imagePath'])) echo $person['imagePath']; else echo Yii::app()->theme->baseUrl.'/assets/images/avatar-1-xl.jpg'; ?>")
	*/});


	function removeDrop(){
		projectDropzone.removeAllFiles(true);
	    $('div.dz-success').remove();
	    $('div.dz-preview').remove();
	}


	function initDropZone()
	{
		console.log("initDropZone"); 
		$(".projectFiles").html("");
		projectDropTab = projects;
		console.log(projectDropTab);
		if(projects[editProjectId].documents && typeof projects[editProjectId].documents == "object")
		{
			$.each(projects[editProjectId].documents,function(i,docObj)
			{
				addFileLine(docObj,i);
			});
		}

		if( !$('.projectFilesTable').hasClass("dataTable") ){
			projectFilesTable = $('.projectFilesTable').dataTable({
					"aoColumnDefs" : [{
						"aTargets" : [0]
					}],
					"oLanguage" : {
						"sLengthMenu" : "Show _MENU_ Rows",
						"sSearch" : "",
						"oPaginate" : {
							"sPrevious" : "",
							"sNext" : ""
						}
					},
					"aaSorting" : [[1, 'asc']],
					"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
					],
					// set the initial value
					"iDisplayLength" : 10,
					"bDestroy": true
				});
		} else
			projectFilesTable.DataTable().draw();
	}

	function addPos(){
		compt++;
		$(".posdiv").append('<input type="text" placeholder="Position" class="form-control" id="position'+compt+'" name="position" value=""></input>');
	}


	$("#personForm").submit( function(event){	
		//console.log($("#personForm").serialize());
		event.preventDefault();
		formData = $("#personForm").serializeFormJSON();
		formData["tags"] = $("#tags").val();
		$("#profileForm").submit();
		//projectDropzone.processQueue();
		/*if($('.dz-filename').text() == ""){
			if("<?php if (isset($person['imagePath'])) echo $person['imagePath']?>" != ""){
				
				$('.dz-filename').text("<?php if (isset($person['imagePath'])) echo $person['imagePath']?>");
			}
		}*/
		//formData["imagePath"] = baseUrl+"/upload/communecter/person/<?php echo Yii::app()->session['userId'] ?>."+$('.dz-filename').text().split(".")[$('.dz-filename').text().split(".").length-1];

		$.ajax({
		  type: "POST",
		  url: baseUrl+"/"+moduleId+"/api/saveUser",
		  data: formData,//$("#personForm").serialize()+"&compt="+compt+"",
		  dataType: "json",
		  success: function(data){
		  		if(data){
		  			toastr.success(data.msg)
		  			//window.location.reload();
		  		}
		  		else
		  			toastr.error(data.msg);
		  },
		});
		
	});


	$("#profileForm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: baseUrl+"/"+moduleId+"/api/saveUserImages/type/person/id/<?php echo Yii::app()->session['userId'] ?>",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false, 
			processData: false,
			success: function(data){
		  		if(data.result)
		  			toastr.success(data.msg);
		  		else
		  			toastr.error(data.msg);
		  },
		});
	}));

</script>
