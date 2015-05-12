<?php 
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/x-editable/css/bootstrap-editable.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css');

	//X-editable...
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/x-editable/js/bootstrap-editable.js' , CClientScript::POS_END, array(), 2);

	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , CClientScript::POS_END, array(), 2);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , CClientScript::POS_END, array(), 2);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/wysihtml5.js' , CClientScript::POS_END, array(), 2);
?>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-user fa-2x text-blue"></i>  Account info</h4>
		<ul class="panel-heading-tabs border-light">
        	<li>
        		<?php 
					if( !Admin::checkInitData( PHType::TYPE_CITOYEN, "personNetworkingAll" ) ){ ?>
						<a href="<?php echo Yii::app()->createUrl("/communecter/person/InitDataPeopleAll") ?>" class="btn btn-xs btn-red " ><i class="fa fa-plus"></i> InitData : Dummy People</a>
					<?php } else { ?>
						<a href="<?php echo Yii::app()->createUrl("/communecter/person/clearInitDataPeopleAll") ?>" class="btn btn-xs btn-red " ><i class="fa fa-plus"></i> Remove Dummy People</a>
				<?php } ?>
        	</li>
        	<?php 
			//connected user isn't allready connected with page User
			if( Yii::app()->session['userId'] != (string)$person["_id"]) 
			{
			?>
        	<li>
        		<div class="center" id='btnTools'>
					<?php
						//if connected user and pageUser are allready connected
						if( Link::isConnected( Yii::app()->session['userId'] , PHType::TYPE_CITOYEN , (string)$person["_id"] , PHType::TYPE_CITOYEN ) ){  ?>
							<a href="javascript:;" class="disconnectBtn btn btn-xs btn-light-blue tooltips " data-placement="top" data-original-title="Remove this person as a relation" ><i class=" disconnectBtnIcon fa fa-unlink "></i></a>
						<?php } else { ?>
							<a href="javascript:;" class="connectBtn btn btn-xs btn-light-blue tooltips " data-placement="top" data-original-title="Connect to this person as a relation" ><i class=" connectBtnIcon fa fa-link "></i></a>
						<?php }
					?>
				</div>
        	</li>
        	<?php } ?>
	    </ul>
	</div>
	<div class="panel-body ">
		<form action="#" role="form" id="personForm" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12 col-ld-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="control-label">
							First Name : 
						</label>
						<a href="#" id="name" data-type="text" data-original-title="Enter your first name" class="editable-person editable editable-click">
							<?php if(isset($person["name"]))echo $person["name"]; else echo "";?>
						</a>
					</div>
					<div class="form-group"> 
						<label class="control-label">
							Birth
						</label>
						<a href="#" id="birth" data-type="text" data-original-title="Enter your birthday" class="editable-person editable editable-click">
							<?php if(isset($person["birth"]))echo $person["birth"]; else echo "";?>
						</a>
					</div>
					<fieldset>
						<div class="form-group">
							<label class="control-label">
								Email Address : 
							</label>

							<a href="#" id="email" data-type="text" data-original-title="Enter your email" class="editable-person editable editable-click">
								<?php if(isset($person["email"]))echo $person["email"]; else echo "";?>
							</a>
						</div>
						<div class="form-group">
							<label class="control-label">
								Url : 
							</label>
							<a href="#" id="url" data-type="text" data-original-title="Enter your url website" class="editable-person editable editable-click">
								<?php if(isset($person["url"]))echo $person["url"]; else echo "";?>
							</a>
						</div>
						<div class="form-group"> 
							<label class="control-label">
								Phone : 
							</label>
							<a href="#" id="phoneNumber" data-type="text" data-original-title="Enter your phoneNumber" class="editable-person editable editable-click">
								<?php if(isset($person["phoneNumber"]))echo $person["phoneNumber"]; else echo "";?>
							</a>
						</div>
					</fieldset>
					<div class="form-group"> 
						<label class="control-label">
							Position : 
						</label>
						<a href="#" id="position" data-type="text" data-original-title="Enter your position" class="editable-person editable editable-click">
							<?php if(isset($person["position"]))echo $person["position"]; else echo "";?>
						</a>

					</div>
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">
									Postal Code : 
								</label>
								<a href="#" id="postalCode" data-type="text" data-original-title="Enter PostalCode" class="editable-person editable editable-click">
									<?php if(isset($person["postalCode"]))echo $person["postalCode"]; else echo "";?>
								</a>
							</div>
						</div>
						
					</div>
					<div class="form-group">
						<label class="control-label">
							Tags : 
						</label>
						
						<a href="#" id="tags" data-type="select2" data-original-title="Enter tagsList" class=" editable editable-click">
							<?php if(isset($person["tags"]))echo implode(",", $person["tags"]); else echo "";?>
						</a>
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							<i class="fa fa-twitter"></i> Twitter : 
						</label>
						<a href="#" id="socialNetwork.twitterAccount" data-type="text" data-original-title="" class="editable-person editable editable-click">
							<?php if (isset($person["socialNetwork"]["twitterAccount"])) echo $person["socialNetwork"]["twitterAccount"]; else echo ""; ?>
						</a>		 
					</div>
					<div class="form-group">
						<label class="control-label">
							<i class="fa fa-facebook"></i> Facebook : 
						</label>
						<a href="#" id="socialNetwork.facebookAccount" data-type="text" data-original-title="" class="editable-person editable editable-click">
							<?php if (isset($person["socialNetwork"]["facebookAccount"])) echo $person["socialNetwork"]["facebookAccount"]; else echo ""; ?>
						</a>	
					</div>
					<div class="form-group">
						<label class="control-label">
							<i class="fa fa-google-plus"></i> Google Plus : 
						</label>
						<a href="#" id="socialNetwork.gpplusAccount" data-type="text" data-original-title="" class="editable-person editable editable-click">
							<?php if (isset($person["socialNetwork"]["gpplusAccount"])) echo $person["socialNetwork"]["gpplusAccount"]; else echo ""; ?>
						</a>
					</div>
					<div class="form-group">
						<label class="control-label">
							<i class="fa fa-github"></i> Github : 
						</label>
						<a href="#" id="socialNetwork.gitHubAccount" data-type="text" data-original-title="" class="editable-person editable editable-click">
							<?php if (isset($person["socialNetwork"]["gitHubAccount"])) echo $person["socialNetwork"]["gitHubAccount"]; else echo ""; ?>
						</a>
					</div>
					<div class="form-group">
						<label class="control-label">
							<i class="fa fa-linkedin"></i> Linkedin : 
						</label>
						<a href="#" id="socialNetwork.linkedInAccount" data-type="text" data-original-title="" class="editable-person editable editable-click">
							<?php if (isset($person["socialNetwork"]["linkedInAccount"])) echo $person["socialNetwork"]["linkedInAccount"]; else echo ""; ?>
						</a>
					</div>
					<div class="form-group">
						<label class="control-label">
							<i class="fa fa-skype"></i> Skype :
						</label>
						<a href="#" id="socialNetwork.skypeAccount" data-type="text" data-original-title="" class="editable-person editable editable-click">
							<?php if (isset($person["socialNetwork"]["skypeAccount"])) echo $person["socialNetwork"]["skypeAccount"]; else echo ""; ?>
						</a>
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
				<div class="col-md-12">
					<div>
						<?php
						//if connected user and pageUser are allready connected
						$base = 'upload'.DIRECTORY_SEPARATOR.'export'.DIRECTORY_SEPARATOR.Yii::app()->session["userId"].DIRECTORY_SEPARATOR;
	    				if( Yii::app()->session["userId"] && file_exists ( $base.Yii::app()->session["userId"].".json" ) )
						{  ?>
							<a href="javascript:;" class="btn btn-xs btn-red importMyDataBtn" ><i class="fa fa-download"></i> Import my data</a>
						<?php } ?>
						<a href="javascript:;" class="btn btn-xs btn-red exportMyDataBtn" ><i class="fa fa-upload"></i> Export my data</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
var personData = <?php echo json_encode($person)?>;
var personId = "<?php echo isset($person["_id"]) ? $person["_id"] : ""; ?>";
var personConnectId = "<?php echo Yii::app()->session["userId"]; ?>"

//By default : view mode
//TODO SBAR - Get the mode from the request ?
if(personId == personConnectId )
	var mode = "update";
else
	var mode = "view";
	

jQuery(document).ready(function() 
{
	
	$('.exportMyDataBtn').off().on("click",function () { 
    	console.log("exportMyDataBtn");
    	$.ajax({
	        type: "GET",
	        url: baseUrl+"/data/exportinitdata/id/<?php echo Yii::app()->session["userId"] ?>/module/communecter"
	        //dataType : "json"
	        //data: params
	    })
	    .done(function (data) 
	    {
	        if (data.result) {               
	        	toastr.success('Export successfull');
	        } else {
	           toastr.error('Something Went Wrong');
	        }
	    });
    });

    $('.importMyDataBtn').off().on("click",function () { 
    	console.log("importMyDataBtn");
    	$.ajax({
	        type: "GET",
	        url: baseUrl+"/"+moduleId+"/person/importmydata"
	        //dataType : "json"
	        //data: params
	    })
	    .done(function (data) 
	    {
	        if (data.result) {               
	        	toastr.success('Import successfull');
	        } else {
	           toastr.error('Something Went Wrong');
	        }
	    });
    });

    bindAboutPodEvents();
	manageModePerson();
	debugMap.push(personData);

});

function manageModePerson() 
{
	if (mode == "view") {
		$('.editable-person').editable('toggleDisabled');
		$('#tags').editable('toggleDisabled');
	} else if (mode == "update") {
		// Add a pk to make the update process available on X-Editable
		$('.editable-person').editable('option', 'pk', personId);
		$('#tags').editable('option', 'pk', personId);

	}
}


function bindAboutPodEvents() {
	$.fn.editable.defaults.mode = 'inline';
	$('.editable-person').editable({
    	url: baseUrl+"/"+moduleId+"/person/updatefield", //this url will not be used for creating new job, it is only for update
    	onblur: 'submit',
    	showbuttons: false
	});
    //make jobTitle required
	$('#name').editable('option', 'validate', function(v) {
    	if(!v) return 'Required field!';
	});

	//Select2 tags
    $('#tags').editable({
        url: baseUrl+"/"+moduleId+"/person/updatefield", //this url will not be used for creating new user, it is only for update
        mode: 'inline',
        showbuttons: false,
        select2: {
            tags: <?php echo json_encode($tags)?>,
            tokenSeparators: [",", " "]
        }
    });

        
}
</script>