<?php 
  /* COOKIE GEO POSITION */

  /*  LISTE DES COOKIES
    -----------------
    -user_geo_latitude
    -user_geo_longitude
    -insee
    -cityName
  */
  if(isset(Yii::app()->session['userId'])){
    
    $user = Person::getById(Yii::app()->session['userId']);

    $cookies = Yii::app()->request->cookies;
    $coockieDuration = time() + (3600*24*365);

    if(isset($user["geo"]) && 
       isset($user["geo"]["latitude"]) && isset($user["geo"]["longitude"]))
    {
      setcookie('user_geo_latitude', $user["geo"]["latitude"], $coockieDuration, "/ph/");
      setcookie('user_geo_longitude', $user["geo"]["longitude"], $coockieDuration, "/ph/");
    }

    if(isset($user["address"]) && isset($user["address"]["codeInsee"]))
      setcookie('insee', $user["address"]["codeInsee"], $coockieDuration, "/ph/");
    

    if(isset($user["address"]) && isset($user["address"]["addressLocality"]))
      setcookie('cityName', $user["address"]["addressLocality"], $coockieDuration, "/ph/");

  }else{ //user not connected
    if(isset($cookies['user_geo_longitude'])){
        $sigParams["firstView"] = array(  "coordinates" => array( $cookies['user_geo_latitude']->value, 
                                      $cookies['user_geo_longitude']->value),
                          "zoom" => 13);
      
    }else{
      //error_log("aucun cookie geopos trouvé");
    }
  }

?>


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

/* from randomOrga */

	.panel-white .border-light{
		/*border:0 !important;*/
	}
	#profil_imgPreview{
      max-height:400px;
      width:100%;
      border-radius: 5px;
      /*border:3px solid #93C020;*/
      /*border-radius:  4px 4px 0px 0px;*/
      margin-bottom:0px;
     

    }
	.panel-green{
      background-image: linear-gradient(to bottom, #93C020 0px, #83AB1D 100%) !important;
    }
    .entityTitle{
      background-color: #FFF; /*#EFEFEF; /*#2A3A45;*/
      margin-bottom: 10px;
      border-radius: 0px 0px 4px 4px;
      margin-top: -10px;
      font-weight: 200;
      margin:0px !important;
      font-size: 30px;
      text-align: left;
    }

    .entityDetails span{
      font-weight: 300;
      font-size:15px;

    }
    .entityDetails{
      padding-bottom:10px;
      margin-bottom:10px;
      border-bottom:0px solid #DDD;
      font-size: 15px;
	  font-weight: 300;
    }
    .entityDetails.bottom{
      /*border-top:1px solid #DDD;*/
      border-bottom:0px solid #DDD;
      padding: 5px;
      margin-top: 10px;
      margin-bottom: -13px;
    }
    .entityDetails i.fa-tag{
      margin-left:10px;
    }
    .entityDetails i.fa{
      margin-right:7px;
      font-size: 17px;
		margin-top: 5px;
    }

    .fileupload{
    	margin-bottom:0px !important;
    }

    .lbl-betatest{
    	margin:10px;
    	position: absolute;
		right: 5px;
    }
    .panel-title{
    	font-weight: 200;
    	font-size: 21px;
    	font-family: "homestead";
    }
    #fileuploadContainer{
    	z-index:0 !important;
    }
    .tag_group{
    	font-size:14px;
    	font-weight: 300;
    }

    .editable-pre-wrapped {
	    white-space: normal;
	    padding:30px; 
	}

	.btn-default.selected{
		background-color: rgb(182, 200, 210);
	}

    @media screen and (max-width: 1000px) {
      .entityDetails span{
        font-size: 1em;
      }
    }

</style>

<div class="panel panel-white">
	<div class="panel-heading border-light">
        <h4 class="panel-title text-dark"><i class="fa fa-info-circle text-dark"></i> <?php echo Yii::t("common","Account info") ?></h4>
    </div>
	<div class="panel-tools">
 		<?php    
				if ( $canEdit ) { ?>
					<a href="javascript:;" id="editProfil" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Editer vos informations" alt=""><i class="fa fa-pencil"></i><span class="hidden-sm hidden-xs"> Editer</span></a>
					<a href="javascript:;" id="editGeoPosition" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Modifiez votre position sur la carte" alt=""><i class="fa fa-map-marker"></i><span class="hidden-sm hidden-xs"> Déplacer</span></a>
		<?php } ?>	

		<?php
			//if connected user and pageUser are allready connected
			$base = 'upload'.DIRECTORY_SEPARATOR.'export'.DIRECTORY_SEPARATOR.Yii::app()->session["userId"].DIRECTORY_SEPARATOR;
			if( Yii::app()->session["userId"] && file_exists ( $base.Yii::app()->session["userId"].".json" ) )
			{  /* ?>
				<a href="javascript:;" class="btn btn-xs btn-red importMyDataBtn" ><i class="fa fa-download"></i> Import my data</a>
			<?php */ } 
			if (Person::logguedAndValid() && $canEdit) {
			?>
				<a href='javascript:' class='btn btn-sm btn-default editConfidentialityBtn tooltips' data-toggle="tooltip" data-placement="bottom" title="Paramètre de confidentialité" alt="">
					<i class='fa fa-cog'></i> 
					<span class="hidden-sm hidden-xs">
					<?php echo Yii::t("common","Paramètres de confidentialité"); ?>
					</span>
				</a>
				<a href='javascript:' class='btn btn-sm btn-red changePasswordBtn tooltips' data-toggle="tooltip" data-placement="bottom" title="Changer votre mot de passe" alt="">
					<i class='fa fa-key'></i> 
					<span class="hidden-sm hidden-xs">
					<?php echo Yii::t("common","Change password") ?>
					</span>
				</a>
			<?php } /*?>
			<a href="javascript:;" class="btn btn-xs btn-red exportMyDataBtn" ><i class="fa fa-upload"></i> Export my data</a>
			*/ 
		?>

 		<?php   if (Role::isUserBetaTester(@$person["roles"])) { ?>
					<div class="badge badge-danger pull-right" style="margin-top:5px; margin-right:5px;"><i class="fa"></i>Beta Tester</div>
		<?php 	} ?>
  	</div>

  	<div class="modal fade" role="dialog" id="modal-confidentiality">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-cog"></i> Confidentialité de vos informations personnelles</h4>
	      </div>
	      <div class="modal-body">
	        <!-- <h3><i class="fa fa-cog"></i> Paramétrez la confidentialité de vos informations personnelles :</h3> -->
	        <div class="row">
	        	<div class="pull-left text-left padding-10" style="border: 1px solid rgba(128, 128, 128, 0.3); margin-left: 10px; margin-bottom: 20px;">
	        		<strong><i class="fa fa-group"></i> Public</strong> : visible pour tout le monde<br/>
	        		<strong><i class="fa fa-user-secret"></i> Privé</strong> : visible pour mes contacts seulement<br/>
	        		<strong><i class="fa fa-ban"></i> Masqué</strong> : visible pour personne<br/>
	        	</div>
		    </div>
		    <div class="row text-dark panel-btn-confidentiality">
	            <div class="col-sm-4 text-right padding-10 margin-top-10">
		        	<i class="fa fa-message"></i> <strong>Mon e-mail :</strong>
		        </div>
		        <div class="col-sm-8 text-left padding-10">
		        	<div class="btn-group btn-group-email inline-block">
		        		<button class="btn btn-default confidentialitySettings" type="email" value="public"><i class="fa fa-group"></i> Public</button>
		        		<button class="btn btn-default confidentialitySettings" type="email" value="private"><i class="fa fa-user-secret"></i> Privé</button>
		        		<button class="btn btn-default confidentialitySettings" type="email" value="hide"><i class="fa fa-ban"></i> Masqué</button>
		        	</div>
		        </div>
		        <div class="col-sm-4 text-right padding-10 margin-top-10">
		        	<i class="fa fa-message"></i> <strong>Ma localité :</strong>
		        </div>
		        <div class="col-sm-8 text-left padding-10">
		        	<div class="btn-group btn-group-locality inline-block">
		        		<button class="btn btn-default confidentialitySettings" type="locality" value="public"><i class="fa fa-group"></i> Public</button>
		        		<button class="btn btn-default confidentialitySettings" type="locality" value="private"><i class="fa fa-user-secret"></i> Privé</button>
		        		<button class="btn btn-default confidentialitySettings" type="locality" value="hide"><i class="fa fa-ban"></i> Masqué</button>
		        	</div>
		        </div>
		        <div class="col-sm-4 text-right padding-10 margin-top-10">
		        	<i class="fa fa-message"></i> <strong>Mon téléphone :</strong>
		        </div>
		        <div class="col-sm-8 text-left padding-10">
		        	<div class="btn-group btn-group-phone inline-block">
		        		<button class="btn btn-default confidentialitySettings" type="phone" value="public"><i class="fa fa-group"></i> Public</button>
		        		<button class="btn btn-default confidentialitySettings" type="phone" value="private"><i class="fa fa-user-secret"></i> Privé</button>
		        		<button class="btn btn-default confidentialitySettings" type="phone" value="hide"><i class="fa fa-ban"></i> Masqué</button>
		        	</div>
		        </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
	        <button type="button" class="btn btn-success">Enregistrer</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
  	<div class="panel-body" style="padding-top: 0px">
		<div class="row" style="">
			<div class="col-sm-6 col-md-5 padding-15">
				<?php $this->renderPartial('../pod/fileupload', array(  "itemId" => (string) $person["_id"],
																	  "type" => Person::COLLECTION,
																	  "resize" => false,
																	  "contentId" => Document::IMG_PROFIL,
																	  "show" => true,
																	  "editMode" => $canEdit,
																	  "image" => $imagesD )); 
				?>
				
					
			</div>
			<div class="col-sm-6 col-md-7 margin-top-20">
				<div class="padding-10 entityDetails text-dark">
					<h2 class="entityTitle">
						<!-- <i class="fa fa-user fa_username"></i>  -->
						<a href="#" id="username" data-type="text" data-original-title="Enter your username" data-emptytext="Enter your username" class="editable-person editable editable-click">
							<?php if(isset($person["username"]))echo $person["username"]; else echo "";?>
						</a>
					</h2>
					<?php 
					$isLinked = Link::isLinked((string)$person["_id"],Person::COLLECTION, Yii::app()->session['userId']);
					?>
					<i class="fa fa-smile-o fa_name hidden"></i> 
					<a href="#" id="name" data-type="text" data-original-title="Enter your first name" class="editable-person editable editable-click">
						<?php if(isset($person["username"]))echo $person["username"]; else echo "";?>
					</a>
					<br>

					<i class="fa fa-birthday-cake fa_birthDate hidden"></i> 
					<a href="#" id="birthDate" data-type="date" data-title="Birth date" data-emptytext="Birth date" class="editable editable-click required">
					</a>
					<br>

					<i class="fa fa-envelope fa_email"></i> 
					<a href="#" id="email" data-type="text" data-title="Email" data-emptytext="Email" class="editable-person editable editable-click required">
						<?php echo Person::showField("email",$person, $isLinked)?>
					</a>
					<br>
					<i class="fa fa-bookmark"></i> badge : <a href="javascript:loadByHash('#define.Gamification');"><span class="badge badge-warning"> <?php echo Gamification::badge( Yii::app()->session['userId'] )." : ".Gamification::calcPoints( Yii::app()->session['userId'] )." points"?></span>
					<hr style="margin:10px 0px 3px 0px;">
					
					<i class="fa fa-road fa_streetAddress hidden"></i> 
					<a href="#" id="streetAddress" data-type="text" data-title="Street Address" data-emptytext="Address" class="editable-person editable editable-click">
						<?php echo Person::showField("address.streetAddress",$person, $isLinked)?>
					</a>

					<br>
					<i class="fa fa-bullseye fa_postalCode hidden"></i> 
					<a href="#" id="address" data-type="postalCode" data-title="Postal Code" data-emptytext="Postal Code" class="editable editable-click" data-placement="bottom">
					</a>
					<br>
					<i class="fa fa-globe fa_addressCountry hidden"></i> 
					<a href="#" id="addressCountry" data-type="select" data-title="Country" data-emptytext="Country" data-original-title="" class="editable editable-click">					
					</a>
					<br>
					
					<i class="fa fa-phone fa_telephone hidden"></i> 
					<a href="#" id="telephone" data-type="text" data-title="Phone" data-emptytext="Phone Number" class="editable-person editable editable-click">
						<?php echo Person::showField("telephone",$person, $isLinked)?>
					</a>
					<br>
					
					<a href="javascript:" id="btn-update-geopos" class="btn btn-primary btn-sm hidden" style="margin: 10px 0px;">
						<i class="fa fa-map-marker" style="margin:0px !important;"></i> Repositionner
					</a>
					<?php 
							$roles = Role::getRolesUserId(Yii::app()->session["userId"]);
							if($roles["superAdmin"] == true){
								?>
									<a href="javascript:" id="btn-update-geopos-admin" class="btn btn-danger btn-sm" style="margin: 10px 0px;">
										<i class="fa fa-map-marker" style="margin:0px !important;"></i> Repositionner Admin
									</a>
								<?php
							}
						?>
					<div class="hidden" id="entity-insee-value" 
						 insee-val="<?php echo (isset( $person["address"]["codeInsee"])) ? $person["address"]["codeInsee"] : ""; ?>">
					</div>
				</div>
			</div>
		</div>
		
		<div class="row text-dark">
			<div class="padding-20 col-sm-12 col-md-12 col-lg-12 border-light" style="border-width: 1px">
				<!-- Description -->
				<a href="#" id="shortDescription" data-type="wysihtml5" data-showbuttons="true" data-title="Short Description" data-emptytext="Short Description" class="editable-person editable editable-click">
					<?php //echo Person::showField("shortDescription",$person)?>
				</a>
			</div>
		</div>
		<div class="padding-10 row text-dark">
			<div class="pull-left col-sm-7 col-md-8 tag_group">
				<?php echo Yii::t("common","Socials") ?> :
				<a href="<?php if (isset($person["socialNetwork"]["facebook"])) echo $person["socialNetwork"]["facebook"]; else echo "#"; ?>" target="_blank" id="facebookAccount" data-emptytext='<i class="fa fa-facebook"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
					<?php if (isset($person["socialNetwork"]["facebook"])) echo $person["socialNetwork"]["facebook"]; else echo ""; ?>
				</a>
				<a href="#" id="skypeAccount" data-emptytext='<i class="fa fa-skype"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
					<?php if (isset($person["socialNetwork"]["skype"])) echo $person["socialNetwork"]["skype"]; else echo ""; ?>
				</a>
				<a href="<?php if (isset($person["socialNetwork"]["twitter"])) echo $person["socialNetwork"]["twitter"]; else echo "#"; ?>" target="_blank" id="twitterAccount" data-emptytext='<i class="fa fa-twitter"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
					<?php if (isset($person["socialNetwork"]["twitter"])) echo $person["socialNetwork"]["twitter"]; else echo ""; ?>
				</a>
				<a href="<?php if (isset($person["socialNetwork"]["googleplus"])) echo $person["socialNetwork"]["googleplus"]; else echo "#"; ?>" target="_blank" id="gpplusAccount" data-emptytext='<i class="fa fa-google-plus"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
					<?php if (isset($person["socialNetwork"]["googleplus"])) echo $person["socialNetwork"]["googleplus"]; else echo ""; ?>
				</a>
				<a href="<?php if (isset($person["socialNetwork"]["github"])) echo $person["socialNetwork"]["github"]; else echo "#"; ?>" target="_blank" id="gitHubAccount" data-emptytext='<i class="fa fa-github"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
					<?php if (isset($person["socialNetwork"]["github"])) echo $person["socialNetwork"]["github"]; else echo ""; ?>
				</a>
			</div>
			
			<div class="pull-right text-right col-sm-5 col-md-4">
				<div class="form-group tag_group no-margin">
					<label class="control-label  text-red">
						<i class="fa fa-tags"></i> <?php echo Yii::t("common","Tags") ?> : 
					</label>
					
					<a href="#" id="tags" data-type="select2" data-original-title="Enter tagsList" class="editable editable-click text-red">
						<?php if(isset($person["tags"])){
							foreach ($person["tags"] as $tag) {
								//echo " <a href='#' onclick='toastr.info(\"TODO : find similar people!\"+$(this).data((\"tag\")));' data-tag='".$tag."' class='btn btn-default btn-xs'>".$tag."</a>";
							}
						}?>
					</a>
				</div>	
			</div>
		</div>
		<div class="row text-dark">
			<div class="col-md-12">
				<?php 
				/*
				if ( $canEdit ) { ?>
				<div class="dropdown">
					<a href="#" data-close-others="true" class="dropdown-toggle btn btn-xs btn-default" data-hover="dropdown" data-toggle="dropdown" onclick="buildBgClassesList()">Backgrounds</a>	
					<div class="dropdown-menu bgClassesContainer" style="display: none;"></div>
				</div>
				<br/>
				<?php }*/ ?>
				
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
	

//By default : view mode
var mode = "view";

jQuery(document).ready(function() 
{
	if(imagesD != null){
		var images = imagesD;
	}

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
		
		$("#btn-update-geopos").click(function(){
			findGeoPosByAddress();
		});
		$("#btn-update-geopos-admin").click(function(){
			findGeoPosByAddress();
		});

		$(".panel-btn-confidentiality .btn").click(function(){
			var type = $(this).attr("type");
			var value = $(this).attr("value");
			$(".btn-group-"+type + " .btn").removeClass("selected");
			$(this).addClass("selected");

		});

		Sig.currentPersonData = personData;
		Sig.contextData = contextMapPerson;
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
	$(".changePasswordBtn").click(function () {
		console.log("changePasswordbuttton");
		loadByHash('#person.changepassword.id.'+userId+'.mode.initSV', false);
	});

	$("#editProfil").click( function(){
		switchMode();
	});
	
	//console.log("personData");
	//console.dir(personData);

	$("#editGeoPosition").click(function(){
		Sig.startModifyGeoposition(personId, "citoyens", Sig.currentPersonData);
		showMap(true);
	});

	$('.exportMyDataBtn').click("click",function () { 
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

    $(".editConfidentialityBtn").click(function(){
    	console.log("confidentiality");
    	$("#modal-confidentiality").modal("show");
    	$(".confidentialitySettings").click(function(){
	    	param = new Object;
	    	param.type = $(this).attr("type");
	    	param.value = $(this).attr("value");
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+"/person/updatesettings",
		        data: param,
		       	dataType: "json",
		    	success: function(data){
			    	toastr.success(data.msg);
			    }
			});
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

    //username of the person
	$('#username').editable('option', 'validate', function(v) {
    	if (!v) return 'Required field!';
    	//Check if dirty
    	if (personData["username"] != null && personData["username"] != v) {
    		if (! isUniqueUsername(v)) {return 'This username is already used by another citizen !';}
    	}
	});

    //name of the person
	$('#name').editable('option', 'validate', function(v) {
    	if (!v) return 'Required field!';
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
			console.log("success update postal Code : ");
			console.dir(newValue);
			
			$.cookie("insee", 	 newValue.codeInsee, 	   { path : '/ph/' });
			$.cookie("cityName", newValue.addressLocality, { path : '/ph/' });

			$("#entity-insee-value").attr("insee-val", newValue.codeInsee);
			$(".menuContainer #menu-city").attr("onclick", "loadByHash( '#city.detail.insee."+newValue.codeInsee+"', 'MA COMMUNE','university' )");
		},
		value : {
        	postalCode: '<?php echo (isset( $person["address"]["postalCode"])) ? $person["address"]["postalCode"] : null; ?>',
        	codeInsee: '<?php echo (isset( $person["address"]["codeInsee"])) ? $person["address"]["codeInsee"] : ""; ?>',
        	addressLocality : '<?php echo (isset( $person["address"]["addressLocality"])) ? $person["address"]["addressLocality"] : ""; ?>'
    	}
	});


	if(<?php echo isset($person["name"]) 						? "true" : "false"; ?>){ $(".fa_name").removeClass("hidden"); }
	if(<?php echo isset($person["birthDate"]) 					? "true" : "false"; ?>){ $(".fa_birthDate").removeClass("hidden"); }
	if(<?php echo isset($person["email"]) 						? "true" : "false"; ?>){ $(".fa_email").removeClass("hidden"); }
	if(<?php echo isset($person["address"]["streetAddress"]) 	? "true" : "false"; ?>){ $(".fa_streetAddress").removeClass("hidden"); }
	if(<?php echo isset($person["address"]["postalCode"]) 		? "true" : "false"; ?>){ $(".fa_postalCode").removeClass("hidden"); }
	if(<?php echo isset($person["address"]["addressCountry"]) 	? "true" : "false"; ?>){ $(".fa_addressCountry").removeClass("hidden"); }
	if(<?php echo isset($person["telephone"]) 					? "true" : "false"; ?>){ $(".fa_telephone").removeClass("hidden"); }

	


}

function manageModeContext() {
	listXeditables = [	'#birthDate', '#description', '#tags', '#address', '#addressCountry', '#facebookAccount', '#twitterAccount',
						'#gpplusAccount', '#gitHubAccount', '#skypeAccount'];
	if (mode == "view") {
		$('.editable-person').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			$(value).editable('toggleDisabled');
		});
		$("#btn-update-geopos").addClass("hidden");
	} else if (mode == "update") {
		// Add a pk to make the update process available on X-Editable
		$('.editable-person').editable('option', 'pk', personId);
		$('.editable-person').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			//add primary key to the x-editable field
			$(value).editable('option', 'pk', personId);
			$(value).editable('toggleDisabled');
		})
		$("#btn-update-geopos").removeClass("hidden");
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
		iconObject.tooltip({title: value, placement: "bottom"});
		iconObject.html('<i class="fa '+fa+' fa-blue"></i>');
	} 
	console.log(iconObject);
}



	//modification de la position geographique	

	function findGeoPosByAddress(){
		//si la streetAdress n'est pas renseignée
		if($("#streetAddress").html() == $("#streetAddress").attr("data-emptytext")){
			//on récupère la valeur du code insee s'il existe
			var insee = ($("#entity-insee-value").attr("insee-val") != "") ? 
						 $("#entity-insee-value").attr("insee-val") : "";
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee);
		//si on a une streetAddress
		}else{
			var request = "";

			//recuperation des données de l'addresse
			var street 			= ($("#streetAddress").html()  != $("#streetAddress").attr("data-emptytext"))  ? $("#streetAddress").html() : "";
			var address 		= ($("#address").html() 	   != $("#address").attr("data-emptytext")) 	   ? $("#address").html() : "";
			var addressCountry 	= ($("#addressCountry").html() != $("#addressCountry").attr("data-emptytext")) ? $("#addressCountry").html() : "";
			
			//construction de la requete
			request = addToRequest(request, street);
			request = addToRequest(request, address);
			request = addToRequest(request, addressCountry);

			request = transformNominatimUrl(request);
			request = "?q=" + request;
			
			findGeoposByNominatim(request);
		}
	
	}

	//quand la recherche nominatim a fonctionné
	function callbackNominatimSuccess(obj){
		console.log("callbackNominatimSuccess");
		//si nominatim a trouvé un/des resultats
		if (obj.length > 0) {
			//on utilise les coordonnées du premier resultat
			var coords = L.latLng(obj[0].lat, obj[0].lon);
			//met à jour la nouvelle position dans la donnée
			personData["geo"] = { "latitude" : obj[0].lat, "longitude" : obj[0].lon };
			//et on affiche le marker sur la carte à cette position
			showGeoposFound(coords, personId, "person", personData);
		}
		//si nominatim n'a pas trouvé de résultat
		else {
			//on récupère la valeur du code insee s'il existe
			var insee = ($("#entity-insee-value").attr("insee-val") != "") ? 
						 $("#entity-insee-value").attr("insee-val") : "";
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			console.log("recherche by insee", insee);
			if(insee != "") findGeoposByInsee(insee);
		}
	}

	//en cas d'erreur nominatim
	function callbackNominatimError(error){
		console.log("callbackNominatimError");
	}

	//quand la recherche par code insee a fonctionné
	function callbackFindByInseeSuccess(obj){
		console.log("callbackFindByInseeSuccess");
		//si on a bien un résultat
		if (typeof obj != "undefined" && obj != "") {
			//récupère les coordonnées
			var coords = Sig.getCoordinates(obj, "markerSingle");
			//si on a une geoShape on l'affiche
			if(typeof obj.geoShape != "undefined") Sig.showPolygon(obj.geoShape);
			
			personData["geo"] = { "latitude" : obj.geo.latitude, "longitude" : obj.geo.longitude };
			//on affiche le marker sur la carte
			showGeoposFound(coords, personId, "person", personData);
		}
		else {
			console.log("Erreur getlatlngbyinsee vide");
		}
	}

	//quand la recherche par code insee n'a pas fonctionné
	function callbackFindByInseeError(){
		console.log("erreur getlatlngbyinsee");
		toastr.error('');
	}

</script>