<?php 
$cssAnsScriptFilesTheme = array(
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css',
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css',
	'/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css',
	'/assets/plugins/x-editable/css/bootstrap-editable.css',
	//X-editable...
	'/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js' , 
	'/assets/plugins/x-editable/js/bootstrap-editable.js' , 
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , 
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , 
	'/assets/plugins/wysihtml5/wysihtml5.js',
	'/assets/plugins/moment/min/moment.min.js',
	'/assets/plugins/Chart.js/Chart.min.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js',
	'/js/postalCode.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
$cssAnsScriptFilesModuleSS = array(
	'/plugins/Chart.js/Chart.min.js',
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModuleSS,Yii::app()->theme->baseUrl."/assets");
?>

<style>
progress[value] {
    /* Get rid of the default appearance */
    appearance: none;   
    /* This unfortunately leaves a trail of border behind in Firefox and Opera. We can remove that by setting the border to none. */
    border: none;
    /* Add dimensions */
	width: 100%; height: 20px;
    /* Although firefox doesn't provide any additional pseudo class to style the progress element container, any style applied here works on the container. */
    background-color: whiteSmoke;
    border-radius: 3px;
    box-shadow: 0 2px 3px rgba(0,0,0,.5) inset;
    /* Of all IE, only IE10 supports progress element that too partially. It only allows to change the background-color of the progress value using the 'color' attribute. */
    color: royalblue;
    position: relative;
}
/*
Webkit browsers provide two pseudo classes that can be use to style HTML5 progress element.
-webkit-progress-bar -> To style the progress element container
-webkit-progress-value -> To style the progress element value.
*/

progress[value]::-webkit-progress-bar {
    background-color: whiteSmoke;
    border-radius: 3px;
    box-shadow: 0 2px 3px rgba(0,0,0,.5) inset;
}

progress[value]::-webkit-progress-value {
    position: relative;
    
    background-size: 35px 20px, 100% 100%, 100% 100%;
    border-radius:3px;
    
    /* Let's animate this */
    animation: animate-stripes 5s linear infinite;
}

@keyframes animate-stripes { 100% { background-position: -100px 0; } }

/* Firefox provides a single pseudo class to style the progress element value and not for container. -moz-progress-bar */
progress[value]::-moz-progress-bar {
    /* Gradient background with Stripes */
    background-image:
    -moz-linear-gradient( 135deg,
	    transparent,
	    transparent 33%,
	    rgba(0,0,0,.1) 33%,
	    rgba(0,0,0,.1) 66%,
	    transparent 66%),
    -moz-linear-gradient( top,
        rgba(255, 255, 255, .25),
        rgba(0,0,0,.2)),
    -moz-linear-gradient( left, #09c, #f44);    
    background-size: 35px 20px, 100% 100%, 100% 100%;
    border-radius:3px;
    /* Firefox doesn't support CSS3 keyframe animations on progress element. Hence, we did not include animate-stripes in this code block */
}

.progressStyle::-webkit-progress-value
{
    /* Gradient background with Stripes */
    background-image:
    -webkit-linear-gradient( 135deg,
        transparent,
	    transparent 33%,
	    rgba(0,0,0,.1) 33%,
	    rgba(0,0,0,.1) 66%,
	    transparent 66%),
    -webkit-linear-gradient( top,
        rgba(255, 255, 255, .25),
        rgba(0,0,0,.2)),
    -webkit-linear-gradient( left, #09c, #ff0);
}

	.panel-title{
		font-weight: 200;
		font-size: 21px;
		font-family: "homestead";
	}

	.entityTitle{
      background-color: #FFF; /*#EFEFEF; /*#2A3A45;*/
      margin-bottom: 10px;
      border-radius: 0px 0px 4px 4px;
      margin-top: -10px;
      overflow-x: hidden; 
      font-size: 30px;
	  font-weight: 200;
  	  margin:0px !important;
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
    /*.entityDetails i.fa-tag{
      margin-left:10px;
    }*/
    .entityDetails i.fa{
      margin-right:7px;
      font-size: 17px;
	  margin-top: 5px;
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
    .lbl-info-details{
    	font-weight: 600;
	    border-bottom: 1px solid lightgray;
	    padding-bottom: 7px;
	    margin-bottom: 5px;
	    width:100%;
	    float:left;
	}
	 
    
    
    
</style>

	<div class="panel-heading border-light">
		<h4 class="panel-title text-dark">
				<i class="fa fa-info-circle"></i> 
				<?php echo Yii::t("project","PROJECT DESCRIPTION",null,Yii::app()->controller->module->id) ?>
		</h4>
		<!-- <div class="navigator padding-0 text-right"> -->
			
		<!-- </div> -->
	</div>
	<div class="panel-tools">
		<?php if ($isAdmin){ ?>
			<a href="javascript:" id="editProjectDetail" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Compléter ou corriger les informations de ce projet" alt=""><i class="fa fa-pencil"></i><span class="hidden-xs"> Éditer les informations</span></a>
			<a href="javascript:" id="editGeoPosition" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Modifier la position géographique" alt=""><i class="fa fa-map-marker"></i><span class="hidden-xs"> Modifiez la position géographique</span></a>
		<?php } ?>
	</div>
	<div class="panel-body padding-20">
		<div class="col-sm-6 col-xs-6 text-dark padding-10">
			<?php
				$this->renderPartial('../pod/fileupload', array("itemId" => (string)$project["_id"],
																  "type" => Project::COLLECTION,
																  "resize" => false,
																  "contentId" => Document::IMG_PROFIL,
																  "editMode" => Authorisation::canEditItem(Yii::app()->session["userId"], Project::COLLECTION,(String) $project["_id"]),
																  "image" => $imagesD)); 
			?>
			<div class="col-md-7 col-sm-8 col-xs-10 text-dark ">
				<a  href="#" id="avancement" data-type="select" data-title="avancement" 
					data-original-title="<?php echo Yii::t("project","Enter the project's maturity",null,Yii::app()->controller->module->id) ?>" 
					class="entityDetails editable editable-click">
					<?php if(isset($project["properties"]["avancement"])){ 
						//idea => concept => Started => development => testing => mature
						if($project["properties"]["avancement"]=="idea")
							$val=5;
						else if($project["properties"]["avancement"]=="concept")
							$val=20;
						else if ($project["properties"]["avancement"]== "started")
							$val=40;
						else if ($project["properties"]["avancement"] == "development")
							$val=60;
						else if ($project["properties"]["avancement"] == "testing")
							$val=80;
						else 
							$val=100;
						echo Yii::t("project",$project["properties"]["avancement"],null,Yii::app()->controller->module->id);
					} ?>
				</a>
				<?php if(isset($project["properties"]["avancement"])){ ?>
				<progress max="100" value="<?php echo $val;?>" class="progressStyle">
				</progress>
				<?php } ?>
			</div>
		</div>
		<div class="col-sm-6 col-xs-6 text-dark padding-20" style="padding-top:0px!important;">
		<table class="table-condensed table-hover text-dark entityDetails" >
			<tbody>
				<tr>
					<td>
						<a href="#" id="name" data-type="text" 
						  data-original-title="<?php echo Yii::t("project","Enter the project's name",null,Yii::app()->controller->module->id) ?>" 
						  class="entityTitle editable-project editable editable-click">
							<?php if(isset($project["name"]))echo $project["name"];?>
						</a>
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-bullseye"></i> 
						<a href="#" id="address" data-type="postalCode" data-title="Postal Code" data-emptytext="Postal Code" class="editable editable-click" data-placement="bottom"></a>,<a href="#" id="addressCountry" data-type="select" data-title="Country" data-emptytext="Country" data-original-title="" class="editable editable-click"></a>
						<br>
						<a href="javascript:" id="btn-update-geopos" class="btn btn-primary btn-sm hidden" style="margin: 10px 0px;">
							<i class="fa fa-map-marker" style="margin:0px !important;"></i> Repositionner
						</a>
						<hr style="margin:10px 0px 0px 0px;">
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-calendar"></i> 
						<?php if(!empty($project["startDate"])) echo Yii::t("common","From") ; ?> <a href="#" id="startDate" data-type="date" data-original-title="<?php echo Yii::t("project","Enter the project's start",null,Yii::app()->controller->module->id) ?>" class="editable editable-click"></a> 
						<label id="labelTo"><?php echo Yii::t("common","To"); ?></label><a href="#" id="endDate" data-type="date" data-original-title="<?php echo Yii::t("project","Enter the project's end",null,Yii::app()->controller->module->id) ?>" class="editable editable-click"></a>
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-file-text-o"></i> Licence : 
						<a href="#" id="licence" data-type="text" data-original-title="<?php echo Yii::t("project","Enter the project's licence",null,Yii::app()->controller->module->id) ?>" class="editable-project editable editable-click"><?php if(isset($project["licence"])) echo $project["licence"];?></a></td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-desktop"></i> 
						<a href="#" id="url" data-type="text" data-original-title="<?php echo Yii::t("project","Enter the project's url",null,Yii::app()->controller->module->id) ?>" class="editable-project editable editable-click"><?php if(isset($project["url"])) echo $project["url"];?></a>
					</td>
				</tr>	
				<tr>
					<td>
						<i class="fa fa-tag text-red"></i> 
						<a href="#" id="tags" data-type="select2" data-type="Tags" data-emptytext="Tags" class="text-red editable editable-click"></a>
					</td>
				</tr>
				
			</tbody>
		</table>
		</div>

		<div class="hidden" id="entity-insee-value" 
			 insee-val="<?php echo (isset( $project["address"]["codeInsee"])) ? $project["address"]["codeInsee"] : ""; ?>">
		</div>

	<div class="text-dark lbl-info-details"><i class="fa fa-angle-down"></i> Description</div>
				
	<div class="col-md-12 padding-20">
		<a href="#" id="description" data-type="wysihtml5" data-original-title="<?php echo Yii::t("project","Enter the project's description",null,Yii::app()->controller->module->id) ?>" class="editable editable-click"></a>	
	</div>
</div>


		

	
<script type="text/javascript">
var projectData = <?php echo json_encode($project)?>;
var mode = "update";
var projectId= "<?php echo (string) $project["_id"]; ?>";
var countries = <?php echo json_encode($countries); ?>;
var startDate = '<?php if(isset($project["startDate"])) echo $project["startDate"]; else echo ""; ?>';
var endDate = '<?php if(isset($project["endDate"])) echo $project["endDate"]; else echo "" ?>';
var imagesD = <?php echo(isset($imagesD)) ? json_encode($imagesD) : null; ?>;
var contentKeyBase = "<?php echo isset($contentKeyBase) ? $contentKeyBase : ""; ?>";
if(imagesD != null){
	var images = imagesD;
}

jQuery(document).ready(function() 
{
    bindAboutPodProjects();
	initXEditable();
	manageModeContext();
	debugMap.push(projectData);
	console.log("endDate",$('#endDate').val());
	console.dir(projectData);
	$("#btn-update-geopos").click(function(){
		findGeoPosByAddress();
	});

	
		//getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo (string)$project["_id"]?>/isAdmin/<?php echo $isAdmin?>",null,"html");
});



function bindAboutPodProjects() {
	$("#editProjectDetail").on("click", function(){
		switchMode();
	});

	$("#editGeoPosition").click(function(){
		Sig.startModifyGeoposition(projectId, "projects", projectData);
		showMap(true);
	});

}

function initXEditable() {
	$.fn.editable.defaults.mode = 'popup';
	$('.editable-project').editable({
    	url: baseUrl+"/"+moduleId+"/project/updatefield", //this url will not be used for creating new job, it is only for update
    	//value : <?php echo (isset($project["name"]))?json_encode($project["name"]) : "''";?> ,
    	//onblur: 'submit',
    	showbuttons: false,
    	success : function(data) {
	        if(data.result) {
	        	toastr.success(data.msg);
				console.log(data);
	        }
	        else
	        	toastr.error(data.msg);  
	    }
	});
    //make jobTitle required
	$('#name').editable('option', 'validate', function(v) {
    	if(!v) return 'Required field!';
	});

	$('#description').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		value: <?php echo (isset($project["description"])) ? json_encode($project["description"]) : "''"; ?>,
		placement: 'bottom',
		mode: 'popup',
		wysihtml5: {
			html: true,
			video: false,
			image: false
		},
		success : function(data) {
	        if(data.result) 
	        	toastr.success(data.msg);
	        else
	        	toastr.error(data.msg);  
	    },
	});
	
	$('#startDate').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		type: "date",
		mode: "popup",
		placement: "bottom",
		format: 'yyyy-mm-dd',
		viewformat: 'dd/mm/yyyy',
		datepicker: {
			weekStart: 1,
		},
		success : function(data) {
			if(data.result) 
				toastr.success(data.msg);
			else 
				return data.msg;
	    }
	});

	$('#endDate').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		type: "date",
		mode: "popup",
		placement: "bottom",
		format: 'yyyy-mm-dd',   
    	viewformat: 'dd/mm/yyyy',
    	datepicker: {
            weekStart: 1,
       },
       success : function(data) {
	        if(data.result) 
	        	toastr.success(data.msg);
	        else 
				return data.msg;
	    }
    });
    var formatDate = "YYYY-MM-DD";
    $('#startDate').editable('setValue', moment(startDate, "YYYY-MM-DD HH:mm").format(formatDate), true);
	$('#endDate').editable('setValue', moment(endDate, "YYYY-MM-DD HH:mm").format(formatDate), true);


    //Select2 tags
	$('#tags').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		mode: 'popup',
		value: <?php echo (isset($project["tags"])) ? json_encode(implode(",", $project["tags"])) : "''"; ?>,
		select2: {
			width: 200,
			tags: <?php if(isset($tags)) echo json_encode($tags); else echo json_encode(array())?>,
			tokenSeparators: [","]
		},
		success : function(data) {
			if(data.result) 
				toastr.success(data.msg);
			else 
				return data.msg;
	    }
	});

	$('#address').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield",
		mode: 'popup',
		// success: function(response, newValue) {
		// 	console.log("success update postal Code : "+newValue);
			
		// },
		value : {
        	//postalCode: '<?php echo (isset( $project["address"]["postalCode"])) ? $project["address"]["postalCode"] : null; ?>',
        	codeInsee: '<?php echo (isset( $project["address"]["codeInsee"])) ? $project["address"]["codeInsee"] : ""; ?>',
        	addressLocality : '<?php echo (isset( $project["address"]["addressLocality"])) ? $project["address"]["addressLocality"] : ""; ?>'
    	},
    	success : function(data, newValue) {
			if(data.result) {
				toastr.success(data.msg);
				$("#entity-insee-value").attr("insee-val", newValue.codeInsee);
				findGeoPosByAddress();
			}
			else {
				return data.msg;
			}
	    }
	});

	$('#addressCountry').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		value: '<?php echo (isset( $project["address"]["addressCountry"])) ? $project["address"]["addressCountry"] : ""; ?>',
		source: function() {
			return countries;
		},
		success : function(data) {
			if(data.result) 
				toastr.success(data.msg);
			else 
				return data.msg;
	    }
	});
	$('#avancement').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		source: function() {
			//idea => concept => Started => development => testing => mature
			avancement=["idea","concept","started","development","testing","mature"];
			return avancement;
		},
		success : function(data) {
			if(data.result) {
				toastr.success(data.msg);
				if(data.avancement=="idea")
					val=5;
				else if(data.avancement=="concept")
					val=20;
				else if (data.avancement== "started")
					val=40;
				else if (data.avancement == "development")
					val=60;
				else if(data.avancement == "testing")
					val=80;
				else
					val=100;
				$('.progressStyle').val(val);
			}
			else 
				return data.msg;
	    }
	});

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

function manageModeContext() {
	listXeditables = ['#description', '#startDate', '#endDate', '#tags', '#address', '#addressCountry','#avancement'];
	if (mode == "view") {
		$('.editable-project').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			$(value).editable('toggleDisabled');
		});
		if(endDate == "")
			$("#labelTo").removeClass("hidden");
		$("#btn-update-geopos").removeClass("hidden");
	} else if (mode == "update") {
		// Add a pk to make the update process available on X-Editable
		$('.editable-project').editable('option', 'pk', projectId);
		$('.editable-project').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			//add primary key to the x-editable field
			//alert(listXeditables[i]);
			$(value).editable('option', 'pk', projectId);
			$(value).editable('toggleDisabled');
		});

		
		if(endDate == "")
			$("#labelTo").addClass("hidden");
		$("#btn-update-geopos").addClass("hidden");
	}
}

	
	//modification de la position geographique	

	function findGeoPosByAddress(){
		//si la streetAdress n'est pas renseignée
		//if($("#streetAddress").html() == $("#streetAddress").attr("data-emptytext")){
			//on récupère la valeur du code insee s'il existe
			var insee = ($("#entity-insee-value").attr("insee-val") != "") ? 
						 $("#entity-insee-value").attr("insee-val") : "";
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee);
		//si on a une streetAddress
		// }else{
		// 	var request = "";

		// 	//recuperation des données de l'addresse
		// 	//var street 			= ($("#streetAddress").html()  != $("#streetAddress").attr("data-emptytext"))  ? $("#streetAddress").html() : "";
		// 	var address 		= ($("#address").html() 	   != $("#address").attr("data-emptytext")) 	   ? $("#address").html() : "";
		// 	var addressCountry 	= ($("#addressCountry").html() != $("#addressCountry").attr("data-emptytext")) ? $("#addressCountry").html() : "";
			
		// 	//construction de la requete
		// 	//request = addToRequest(request, street);
		// 	request = addToRequest(request, address);
		// 	request = addToRequest(request, addressCountry);

		// 	request = transformNominatimUrl(request);
		// 	request = "?q=" + request;
			
		// 	findGeoposByNominatim(request);
		// }
	
	}

	//quand la recherche nominatim a fonctionné
	function callbackNominatimSuccess(obj){
		console.log("callbackNominatimSuccess");
		//si nominatim a trouvé un/des resultats
		if (obj.length > 0) {
			//on utilise les coordonnées du premier resultat
			var coords = L.latLng(obj[0].lat, obj[0].lon);
			//met à jour la nouvelle position dans la donnée
			projectData["geo"] = { "latitude" : obj[0].lat, "longitude" : obj[0].lon };
			//et on affiche le marker sur la carte à cette position
			showGeoposFound(coords, projectId, "projects", projectData);
		}
		//si nominatim n'a pas trouvé de résultat
		else {
			//on récupère la valeur du code insee s'il existe
			var insee = ($("#entity-insee-value").attr("insee-val") != "") ? 
						 $("#entity-insee-value").attr("insee-val") : "";
			//si on a un codeInsee, on lance la recherche de position par codeInsee
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
			
			projectData["geo"] = { "latitude" : obj.geo.latitude, "longitude" : obj.geo.longitude };
			//on affiche le marker sur la carte
			showGeoposFound(coords, projectId, "projects", projectData);
		}
		else {
			console.log("Erreur getlatlngbyinsee vide");
		}
	}

	//quand la recherche par code insee n'a pas fonctionné
	function callbackFindByInseeError(){
		console.log("erreur getlatlngbyinsee");
	}
	
</script>