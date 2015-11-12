<?php 
	

$cssAnsScriptFilesModule = array(
	'/plugins/x-editable/css/bootstrap-editable.css',
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css',
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css',

	'/plugins/x-editable/js/bootstrap-editable.js' , 
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' ,
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js',
	'/plugins/moment/min/moment.min.js',
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");

$cssAnsScriptFilesModule = array(
	'/js/dataHelpers.js',
	'/js/postalCode.js'
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule , $this->module->assetsUrl);
	//My profil page or visitor ?
	$canEdit = Yii::app()->session['userId'] == (string)$person["_id"];
	$contextMapPerson = null;
	if(isset($person["_id"])){
		$personId = $person["_id"];
		$contextMapPerson = Person::getPersonLinksByPersonId($personId);
		//var_dump($contextMapPerson);
	}
?>
<style>
.socialIcon{
	padding-right: 10px;
}

</style>

<div class="panel panel-white">
	<div class="panel-heading border-light">
        <h4 class="panel-title"><i class="fa fa-user fa-2x text-blue"></i>   Account info</h4>
    </div>
	
 	<div class="panel-tools">
 		<?php    
				if ( $canEdit ) { ?>
					<a href="javascript:" id="editProfil" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="right" title="Editer vos informations" alt=""><i class="fa fa-pencil"></i><span class="hidden-sm hidden-xs"> Editer</span></a>
					<a href="javascript:" id="editGeoPosition" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="right" title="Modifiez votre position sur la carte" alt=""><i class="fa fa-map-marker"></i><span class="hidden-sm hidden-xs"> Déplacer</span></a>
		<?php } ?>
  	</div>
  	<div class="panel-body" style="padding-top: 0px">
		<div class="row" style="height: 190px">
			<?php   if (Role::isUserBetaTester(@$person["roles"])) { ?>
 						<a href="javascript:;" class="btn btn-xs btn-red pull-right" ><i class="fa"></i>Beta Tester</a>
 			<?php 	} ?>
			<div class="col-sm-5 col-xs-5 no-padding border-light" style="border-width: 1px; border-style: solid;">
				<?php 
					$this->renderPartial('../pod/fileupload', array(  "itemId" => (string) $person["_id"],
																	  "type" => Person::COLLECTION,
																	  "resize" => false,
																	  "contentId" => Document::IMG_PROFIL,
																	  "show" => true,
																	  "editMode" => $canEdit )); 
				?>
			</div>
			<div class="col-sm-7 col-xs-7">
				<div class="padding-10">
					<h2>
						<a href="#" id="name" data-type="text" data-original-title="Enter your first name" class="editable-person editable editable-click">
							<?php if(isset($person["name"]))echo $person["name"]; else echo "";?>
						</a>
					</h2>
					<a href="#" id="birthDate" data-type="date" data-title="Birth date" data-emptytext="Birth date" class="editable editable-click required">
					</a>
					<br>
					<a href="#" id="email" data-type="text" data-title="Email" data-emptytext="Email" class="editable-person editable editable-click required">
						<?php echo (isset($person["email"])) ? $person["email"] : null; ?>
					</a>
					<br>
					<a href="#" id="streetAddress" data-type="text" data-title="Street Address" data-emptytext="Address" class="editable-person editable editable-click">
						<?php echo (isset( $person["address"]["streetAddress"])) ? $person["address"]["streetAddress"] : null; ?>
					</a>
					<br>
					<a href="#" id="address" data-type="postalCode" data-title="Postal Code" data-emptytext="Postal Code" class="editable editable-click" data-placement="bottom">
					</a>
					<br>
					<a href="#" id="addressCountry" data-type="select" data-title="Country" data-emptytext="Country" data-original-title="" class="editable editable-click">					
					</a>
					<br>
					<a href="#" id="telephone" data-type="text" data-title="Phone" data-emptytext="Phone Number" class="editable-person editable editable-click">
						<?php echo (isset($person["telephone"])) ? $person["telephone"] : null; ?>
					</a>
					<br>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				Socials
				<a href="#" id="facebookAccount" data-emptytext='<i class="fa fa-facebook"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
					<?php if (isset($person["socialNetwork"]["facebook"])) echo $person["socialNetwork"]["facebook"]; else echo ""; ?>
				</a>
				<a href="#" id="skypeAccount" data-emptytext='<i class="fa fa-skype"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
					<?php if (isset($person["socialNetwork"]["skype"])) echo $person["socialNetwork"]["skype"]; else echo ""; ?>
				</a>
				<a href="#" id="twitterAccount" data-emptytext='<i class="fa fa-twitter"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
					<?php if (isset($person["socialNetwork"]["twitter"])) echo $person["socialNetwork"]["twitter"]; else echo ""; ?>
				</a>
				<a href="#" id="gpplusAccount" data-emptytext='<i class="fa fa-google-plus"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
					<?php if (isset($person["socialNetwork"]["googleplus"])) echo $person["socialNetwork"]["googleplus"]; else echo ""; ?>
				</a>
				<a href="#" id="gitHubAccount" data-emptytext='<i class="fa fa-github"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
					<?php if (isset($person["socialNetwork"]["github"])) echo $person["socialNetwork"]["github"]; else echo ""; ?>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 border-light" style="border-width: 1px">
				Description
				<a href="#" id="shortDescription" data-type="wysihtml5" data-showbuttons="true" data-title="Short Description" data-emptytext="Short Description" class="editable-person editable editable-click">
					<?php echo (isset($person["shortDescription"])) ? $person["shortDescription"] : null; ?>
				</a>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">
						Tags : 
					</label>
					
					<a href="#" id="tags" data-type="select2" data-original-title="Enter tagsList" class="editable editable-click">
						<?php if(isset($person["tags"])){
							foreach ($person["tags"] as $tag) {
								//echo " <a href='#' onclick='toastr.info(\"TODO : find similar people!\"+$(this).data((\"tag\")));' data-tag='".$tag."' class='btn btn-default btn-xs'>".$tag."</a>";
							}
						}?>
					</a>
				</div>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php 
				if ( $canEdit ) { ?>
				<div class="dropdown">
					<a href="#" data-close-others="true" class="dropdown-toggle btn btn-xs btn-default" data-hover="dropdown" data-toggle="dropdown" onclick="buildBgClassesList()">Backgrounds</a>	
					<div class="dropdown-menu bgClassesContainer" style="display: none;"></div>
				</div>
				<br/>
				<?php } ?>
				<div>
					<?php
					//if connected user and pageUser are allready connected
					$base = 'upload'.DIRECTORY_SEPARATOR.'export'.DIRECTORY_SEPARATOR.Yii::app()->session["userId"].DIRECTORY_SEPARATOR;
    				if( Yii::app()->session["userId"] && file_exists ( $base.Yii::app()->session["userId"].".json" ) )
					{  /* ?>
						<a href="javascript:;" class="btn btn-xs btn-red importMyDataBtn" ><i class="fa fa-download"></i> Import my data</a>
					<?php */ } 
					if (Person::logguedAndValid() && $canEdit) {
					?>
						<a href='javascript:;' class='btn btn-xs btn-red changePasswordBtn'><i class='fa fa-key'></i> Change password</a>
					<?php } /*?>
					<a href="javascript:;" class="btn btn-xs btn-red exportMyDataBtn" ><i class="fa fa-upload"></i> Export my data</a>
					*/ ?>
				</div>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var personData = <?php echo json_encode($person)?>;
var personId = "<?php echo isset($person["_id"]) ? $person["_id"] : ""; ?>";
var personConnectId = "<?php echo Yii::app()->session["userId"]; ?>"
var countries = <?php echo json_encode($countries) ?>;
var birthDate = '<?php echo (isset($person["birthDate"])) ? $person["birthDate"] : null; ?>';
var tags = <?php echo json_encode($tags)?>;
var imagesD = <?php echo(isset($imagesD)  ) ? json_encode($imagesD) : "null"; ?>;


var contextMapPerson = <?php echo(isset($contextMapPerson)  ) ? json_encode($contextMapPerson) : "null"; ?>;

if(imagesD != null){
	var images = imagesD;
}

//By default : view mode
var mode = "view";

jQuery(document).ready(function() 
{
    bindAboutPodEvents();
    initXEditable();
	manageModeContext();
	debugMap.push(personData);

	//console.dir(contextMapPerson);

	if(contextMapPerson != null){
		var elementsMap = new Array();
		elementsMap.push(personData);
		$.each(contextMapPerson, function (key, value){
			$.each(value, function (key2, value2){
				elementsMap.push(value2);
			});
		});
		console.log("start show elementsMap");
		console.dir(elementsMap);
		Sig.restartMap();
		Sig.showMapElements(Sig.map, elementsMap);
	}

});

function buildBgClassesList() 
{ 
	if( $(".bgClassesContainer").html() == "" )
	{
		$.each(bgClasses,function(i,v) { 
			$(".bgClassesContainer").append('<a class="btn btn-xs btn-default bgChangeBtn" href="javascript:;" data-class="'+v.key+'" >'+v.name+'</a>');
			existingClasses += " "+v.key;
		});
		$(".bgChangeBtn").off().on("click", function(){
			setBg( $(this).data("class") );
		});
	}
}
function bindAboutPodEvents() 
{
	$("#editProfil").on("click", function(){
		switchMode();
	});

	console.log("personData");
	console.dir(personData);

	$("#editGeoPosition").click(function(){
		Sig.startModifyGeoposition(personId, "citoyens", personData);
		showMap(true);
	});

	$('.exportMyDataBtn').off().on("click",function () { 
    	console.log("exportMyDataBtn");
    	$.ajax({
	        type: "GET",
	        url: baseUrl+"/"+moduleId+"/data/exportinitdata/id/<?php echo Yii::app()->session["userId"] ?>/module/communecter"
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
}

function initXEditable() {
	$.fn.editable.defaults.mode = 'inline';
	$('.editable-person').editable({
    	url: baseUrl+"/"+moduleId+"/person/updatefield", //this url will not be used for creating new job, it is only for update
    	onblur: 'submit',
    	showbuttons: false,
    	mode: 'popup'
	});

	$('.socialIcon').editable({
		display: function(value) {
			manageSocialNetwork($(this), value);
		},
		url: baseUrl+"/"+moduleId+"/person/updatefield",
		mode: 'popup'
	})

    //make jobTitle required
	$('#name').editable('option', 'validate', function(v) {
    	if(!v) return 'Required field!';
	});

	//Select2 tags
    $('#tags').editable({
        url: baseUrl+"/"+moduleId+"/person/updatefield", //this url will not be used for creating new user, it is only for update
        mode : 'popup',
        value: <?php echo (isset($person["tags"])) ? json_encode(implode(",", $person["tags"])) : "''"; ?>,
        select2: {
            tags: <?php if(isset($tags)) echo json_encode($tags); else echo json_encode(array())?>,
            tokenSeparators: [","],
            width: 200
        }
    }); 

    $('#addressCountry').editable({
		url: baseUrl+"/"+moduleId+"/person/updatefield",
		mode : 'popup',
		value: '<?php echo (isset( $person["address"]["addressCountry"])) ? $person["address"]["addressCountry"] : ""; ?>',
		source: function() {
			return countries;
		},
	});

	$('#birthDate').editable({
		url: baseUrl+"/"+moduleId+"/person/updatefield", 
		mode: 'popup',
		placement: "right",
		format: 'yyyy-mm-dd',   
    	viewformat: 'dd/mm/yyyy',
    	datepicker: {
            weekStart: 1,
        },
        showbuttons: true
	});
	$('#birthDate').editable('setValue', moment(birthDate, "YYYY-MM-DD HH:mm").format("YYYY-MM-DD"), true);

	$('#address').editable({
		url: baseUrl+"/"+moduleId+"/person/updatefield",
		mode: 'popup',
		success: function(response, newValue) {
			console.log("success update postal Code : "+newValue);
		},
		value : {
        	postalCode: '<?php echo (isset( $person["address"]["postalCode"])) ? $person["address"]["postalCode"] : null; ?>',
        	codeInsee: '<?php echo (isset( $person["address"]["codeInsee"])) ? $person["address"]["codeInsee"] : ""; ?>',
        	addressLocality : '<?php echo (isset( $person["address"]["addressLocality"])) ? $person["address"]["addressLocality"] : ""; ?>'
    	}
	});
}

function manageModeContext() {
	listXeditables = [	'#birthDate', '#description', '#tags', '#address', '#addressCountry', '#facebookAccount', '#twitterAccount',
						'#gpplusAccount', '#gitHubAccount', '#skypeAccount'];
	if (mode == "view") {
		$('.editable-person').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			$(value).editable('toggleDisabled');
		})
	} else if (mode == "update") {
		// Add a pk to make the update process available on X-Editable
		$('.editable-person').editable('option', 'pk', personId);
		$('.editable-person').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			//add primary key to the x-editable field
			$(value).editable('option', 'pk', personId);
			$(value).editable('toggleDisabled');
		})
	}
}

function switchMode() {
	if(mode == "view"){
		mode = "update";
		manageModeContext();
	} else {
		mode ="view";
		manageModeContext();
	}
}

function manageSocialNetwork(iconObject, value) {
	tabId2Icon = {"facebookAccount" : "fa-facebook", "twitterAccount" : "fa-twitter", 
			"gpplusAccount" : "fa-google-plus", "gitHubAccount" : "fa-github", "skypeAccount" : "fa-skype"}

	var fa = tabId2Icon[iconObject.attr("id")];
	console.log(value);
	iconObject.empty();
	if (value != "") {
		iconObject.tooltip({title: value, placement: "top"});
		iconObject.html('<i class="fa '+fa+' fa-blue"></i>');
	} 
	console.log(iconObject);
}

</script>