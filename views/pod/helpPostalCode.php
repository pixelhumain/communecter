<?php
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js',
	//'/js/sig/geolocInternational.js'
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<?php 
	$me = Person::getById(Yii::app()->session['userId']);
	
	/*$lat = isset($me["geo"]) ? $me["geo"]["latitude"] : 
			@$me["geoPosition"] ? $me["geoPosition"]["coordinates"][1] : -21.13318 ;

	$lng = isset($me["geo"]) ? $me["geo"]["longitude"] : 
			isset($me["geoPosition"]) ? $me["geoPosition"]["coordinates"][0] : 55.5314 ;
	*/
	$lat = -21.13318;
	if(@$me["geo"]){ $lat = $me["geo"]["latitude"]; } else {
		if(@$me["geoPosition"]){ $lat = $me["geoPosition"]["coordinates"][1]; }
	}
	$lng = 55.5314;
	if(@$me["geo"]){ $lng = $me["geo"]["longitude"]; } else {
		if(@$me["geoPosition"]){ $lng = $me["geoPosition"]["coordinates"][0]; }
	}
	
	$sigParams = array(

		/* CLÉ UNIQUE QUI SERT D'IDENTIFIANT POUR CETTE CARTE */
		"sigKey" => "Entity",

		/* MAP */
		"mapHeight" => 350,
		"mapTop" => 0,
		"mapColor" => 'rgb(69, 96, 116)',  //ex : '#456074', //'#5F8295', //'#955F5F', rgba(69, 116, 88, 0.49)
		"mapOpacity" => 0.4, //ex : 0.4

		/* MAP LAYERS (FOND DE CARTE) */
		"mapTileLayer" 	  => 'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png',
		"mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	
		//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

		/* MAP BUTTONS */
		"mapBtnBgColor" => '#5896AB',
		"mapBtnColor" => '#213042',
		"mapBtnBgColor_hover" => '#456074',

		/* USE */
		"titlePanel" 		 => '',
        "usePanel" 			 => false,
        "useFilterType" 	 => false,
        "useRightList" 		 => true,
        "useZoomButton" 	 => false,
        "useHomeButton" 	 => false,
        "useSatelliteTiles"	 => false,
        "useFullScreen" 	 => false,
        "useFullPage" 	 	 => false,
        "useResearchTools" 	 => false,
        "useChartsMarkers" 	 => false,
        "useHelpCoordinates" => false,

		/* COORDONNÉES DE DÉPART (position géographique de la carte au chargement) && zoom de départ */
		"firstView"		  => array(  "coordinates" => array($lat, $lng),
									 "zoom"		  => 11),
		);
?>
<style>


/* css modale */
#country-geolocInternational{
	margin-bottom:10px;
}
#inputText-geolocInternational{
	width: 80%;
	height: 45px;
	padding-left: 10px;
	border-width: 0px;
	border-bottom-width: 1px;
}
#btn-geolocInternational{
	height: 45px;
	border-radius: 0px;
	width: 20%;
	text-align: center;
}

.btn-select-address{
	margin-top:3px;
}

#mapCanvasEntity{
	height:350px;
	width:100%;
	/*border-radius: 400px;*/
	/*max-width: 350px;*/
}
.sigModule<?php echo $sigParams['sigKey']; ?> #liste_map_element{
	padding-top:0px;
}
.sigModule<?php echo $sigParams['sigKey']; ?> #right_tool_map {
    width: unset;
    height: 305px;
    position: relative !important;
    right: 0%;
    top: 0%;
    border-bottom:1px solid #d4d4d4;
    border-left:1px solid #d4d4d4;
    -moz-box-shadow: -5px -5px 1px 0px rgba(189, 189, 189, 0);
	-webkit-box-shadow: -5px -5px 1px 0px rgba(189, 189, 189, 0);
	-o-box-shadow: -5px -5px 1px 0px rgba(189, 189, 189, 0);
	box-shadow: -5px -5px 1px 0px rgba(189, 189, 189, 0);
}

.sigModule<?php echo $sigParams['sigKey']; ?> .info_item.pseudo_item_map_list{
	width-width: 100% !important;
	max-width: 100% !important;
	text-align: left;
	font-weight: 400;
    padding-bottom: 5px;
    padding-top: 5px;
}

.sigModule<?php echo $sigParams['sigKey']; ?> .element-right-list{
	border-bottom: 1px solid #c5c5c5;
	margin-bottom:-4px;
}

.sigModule<?php echo $sigParams['sigKey']; ?> .btn-group-map {
    float: left;
    top: 10px;
    right: -18px;
    left:unset;
    position: absolute;
}

.msg_list_res{
	padding: 50px;
	text-align: center;
	padding-top: 80px;
}

.sigModule<?php echo $sigParams['sigKey']; ?> .btn-map {
    padding: 7px 12px 9px !important;
    font-size: 14px !important;
}
.radio-typeInternationalSearch .radio{
	margin:5px !important;
}
.bg-success{
	background-color: #5cb85c!important;
}

.bg-success .info_item, .bg-red .info_item{
	color:white !important;
}
#modalHelpCP .modal-dialog{
	width:65% !important;
}


@media screen and (max-width: 767px) {
	#modalHelpCP .modal-dialog{
		width:100% !important;
	}
}
</style>

<div class="modal fade" id="modalHelpCP">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title text-dark">
        	<i class="fa fa-angle-down"></i> Trouver un code postal <span class="badge bg-green title-helpCP"></span>
        </h3>
      </div>
      <div class="modal-body col-md-12">
		<div class="sigModule<?php echo $sigParams['sigKey']; ?>">
			<div class="col-md-3 no-padding hidden">
				<form class="form-postalcode">
					<div class="col-md-12 no-padding">
						<select class="pull-left" id="country-geolocInternational"></select>
					</div>
					<!-- <div class="col-md-5 no-padding"></div>
					<div class="col-md-7 no-padding"></div> -->

				</form>
			</div>
			<div class="col-md-5 no-padding">
				<input type="text" id="inputText-geolocInternational" placeholder="quelle commune recherchez-vous ?">
				<button class="btn btn-success pull-right" id="btn-geolocInternational"><i class="fa fa-search"></i></button>
				<div id="right_tool_map">
					<div id="liste_map_element"></div>
				</div>
			</div>
			<div class="col-md-7 no-padding">
				<div id="mapCanvasEntity"></div>
				<div class="btn-group-map tools-btn">
					<?php if($sigParams['useSatelliteTiles']){ ?>
						<div class="btn-group btn-group-lg">
							<button type="button" class="btn btn-map bg-dark" id="btn-satellite"><i class="fa fa-magic"></i></button>
						</div>
					<?php } ?>
					<?php if($sigParams['useZoomButton']){ ?>
						<div class="btn-group btn-group-lg">		
							<button type="button" class="btn btn-map bg-dark" id="btn-zoom-out"><i class="fa fa-search-minus"></i></button>
							<button type="button" class="btn btn-map bg-dark" id="btn-zoom-in"><i class="fa fa-search-plus"></i></button>
						</div>
					<?php } ?>
					<?php if($sigParams['useHomeButton']){ ?>
						<div class="btn-group btn-group-lg">
							<button type="button" class="btn btn-map" id="btn-home"><i class="fa fa-bullseye"></i></button>
						</div>
					<?php } ?>	
				</div>
			</div>
		</div>
	  </div>
      <div class="modal-footer">
		<div class="badge bg-white text-dark pull-left"><i class="fa fa-info-circle"></i> Recherchez une commune par son nom pour trouver son code postal</div>
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-time"></i> Fermer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">

	var allCountries = getCountries("select2");
	var formType = "city"; //a modifier sur les autres formulaires pour avoir le bon icon sur la carte

	var idCountryInput = "#<?php echo $idCountryInput; ?>";
	
	//console.dir(allCountries);
	$.each(allCountries, function(key, country){
	 	$("#country-geolocInternational").append("<option value='"+country.id+"'>"+country.text+"</option>");
	 });

	//var SigEntity;
	var mapEntity;
	var typeSearchInternational;

	jQuery(document).ready(function() {
		setTitle("Créer un événement","<i class='fa fa-plus'></i> <i class='fa fa-calendar'></i>");

	 	$("#btn-geolocInternational").click(function(){
	 		var country = $(idCountryInput).val(); 
	 		
	 		if(country == ""){
	 			showMsgListRes("Merci de sélectionner un pays avant de continuer");
	 			return;
	 		}

	 		typeSearchInternational = "address"; // $(".radio-typeInternationalSearch input[type='radio']:checked").val();
	 		
	 		var requestPart = $("#inputText-geolocInternational").val();
	 			
	 		var geoPos = getGeoPosInternational(requestPart, country);
	 	});

 		//chargement des paramètres d'initialisation à partir des params PHP definis plus haut
		var initParams =  <?php echo json_encode($sigParams); ?>;
		//chargement la carte
		mapEntity = loadMap("mapCanvas", initParams);
	});

function openModalHelpCP(){
	var country = $(idCountryInput).val(); 
	if(country == ""){
		$(".badge.title-helpCP").html("Attention : aucun pays selectionné");
		$(".badge.title-helpCP").removeClass("bg-green").addClass("bg-red");
	}else{
		$(".badge.title-helpCP").html(country);
		$(".badge.title-helpCP").removeClass("bg-red").addClass("bg-green");
	}

	$('#modalHelpCP').modal('show');
	setTimeout(function() {
					mapEntity.invalidateSize(false);
				}, 1000);
	
}

function showMsgListRes(msg){
	msg = msg != "" ? "<h1 class='msg_list_res'>" + msg + "</h1>" : "";
	$(".sigModuleEntity #liste_map_element").html(msg);
}


/**********************************************************************************************/
/*************************************     MAP        *****************************************/
/**********************************************************************************************/

function loadMap(canvasId, initParams)
{
	console.warn("--------------- loadMap ENTITY ---------------------");
	canvasId += initParams.sigKey;
	
	$("#"+canvasId).html("");
	$("#"+canvasId).css({"background-color": initParams.mapColor});

	//initialisation des variables de départ de la carte
	if(canvasId != "")
	var mapEntity = L.map(canvasId, { "zoomControl" : false,
								"scrollWheelZoom":true,
								"center" : initParams.firstView.coordinates,
								"zoom" : initParams.firstView.zoom,
								"worldCopyJump" : false });

	var tileLayer = L.tileLayer(initParams.mapTileLayer, { 
		attribution: 'Map tiles by ' + initParams.mapAttributions,
		minZoom: 3,
		maxZoom: 20
	});

	tileLayer.setOpacity(initParams.mapOpacity).addTo(mapEntity);

	//rafraichi les tiles après le redimentionnement du mapCanvas
	mapEntity.invalidateSize(false);
	return mapEntity;
};


function showOneElementOnMap(thisData, thisMap){
				
	var objectId = Sig.getObjectId(thisData);
	console.log("showOneElementOnMap");
	console.dir(thisData);
	console.dir(objectId);

	if(objectId != null){
					
		if(("undefined" != typeof thisData['geo'] && thisData['geo'] != null) || ("undefined" != typeof thisData['geoPosition'] && thisData['geoPosition'] != null)) {
			
				var type = (typeof thisData["typeSig"] !== "undefined") ? thisData["typeSig"] : thisData["type"];
				//préparation du contenu de la bulle
				var content = Sig.getPopupAddress(thisData, "Utiliser ce code postal");
				//création de l'icon sur la carte
				var theIcon = Sig.getIcoMarkerMap(thisData);
				console.log("theIcon");
				console.dir(theIcon);
				var properties = { 	id : objectId,
									icon : theIcon,
									type : thisData["type"],
									typeSig : type,
									name : thisData["name"],
									faIcon : Sig.getIcoByType(thisData),
									content: content };

				var coordinates = Sig.getCoordinates(thisData, "markerSingle");
				var marker = Sig.getMarkerSingle(thisMap, properties, coordinates);
				marker.dragging.enable();

				markerListEntity.push(marker);
						
				if(typeof thisData["geoShape"] != "undefined" && typeof thisData["geoShape"]["coordinates"] != "undefined"){
					var geoShape = thisData["geoShape"]; //Sig.inversePolygon(thisData["geoShape"]["coordinates"]);
					Sig.addPolygon(geoShape);
				}
				
				
				createItemRigthListMap(thisData, marker, thisMap);
				//ajoute l'événement click sur l'élément de la liste, pour ouvrir la bulle du marker correspondant
				//si le marker n'est pas dans un cluster (sinon le click est géré dans le .geoJson.onEachFeature)
				$(".sigModuleEntity .item_map_list_" + objectId).click(function()
				{	thisMap.setZoom(10);
					Sig.checkListElementMap(thisMap);
					marker.openPopup();
					thisMap.panTo(coordinates, {"animate" : false });
					thisMap.panBy([0, -80], {"animate" : false });

					
					console.log("onclick " + thisData.cityName);
					//checkCityExists(thisData, this);

					$(".btn-communecter-city").click(function(){
						var cp = $(this).attr("cp-com");
						$("input#postalCode").val(cp);
						searchCity();
						$('#modalHelpCP').modal('hide');
					});

					//if(typeof thisData.postalCode == "undefined")
					//askNominatimCp(thisData.cityName);
					//setTimeout(function(){ mapEntity.invalidateSize(false); }, 1000);
					thisMap.invalidateSize(false);
				});
				
		}
	}
}

function createItemRigthListMap(element, thisMarker, thisMap){

	var imgProfilPath =  Sig.getThumbProfil(element);
	//prépare le nom (ou "anonyme")
	var name = (element['name'] != null) ? element['name'] : "Anonyme";

	//récupère l'url de l'icon a afficher
	// var ico = Sig.getIcoByType(element);
	// var color = Sig.getIcoColorByType(element);

	// var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';

	var button = '<div class="element-right-list" id="element-right-list-'+Sig.getObjectId(element)+'">' +
    				'<button class="item_map_list item_map_list_'+ Sig.getObjectId(element) +'">' +
	    				"<div class='info_item pseudo_item_map_list text-dark'>" +  
	    					'<i class="fa fa-map-marker"></i>' +
	    					name + 
	    				"</div>" +
	    			'</button>' + 
	    		  "</div>";

	$(".sigModuleEntity #liste_map_element").append(button);				
}

function askNominatimCp(cityName){
	http://nominatim.openstreetmap.org/search?format=json&city=Noum%C3%A9a&countrycodes=FR
	//var url = "//nominatim.openstreetmap.org/search?city=" + cityName + "&format=json&polygon=0&addressdetails=1";
	var url ="//maps.googleapis.com/maps/api/geocode/json?address=" + cityName;
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'json',
		async:false,
		crossDomain:true,
		complete: function () {},
		success: function (obj){
			console.log("askNominatimCp success");
			console.dir(obj);
		},
		error: function (thisError) {
			console.log("askNominatimCp error");
			toastr.error(thisError);
		}
	});
}

// var tileMode = "terrain";
// function createItemRigthListMap(element, thisMarker, thisMap){
// 	$(".sigModuleEntity #btn-satellite").click(function(){
// 		if(tileMode == "terrain"){
// 			tileMode = "satellite";
// 			if(thisSig.tileLayer != null) thisSig.map.removeLayer(thisSig.tileLayer);
// 			thisSig.tileLayer = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', 
// 											{maxZoom:17,
// 											 minZoom:3}).addTo(Sig.map);
// 			thisSig.map.minZoom = 0;
// 			thisSig.map.maxZoom = 17;
// 		}else if(thisSig.tileMode == "satellite"){
// 			thisSig.tileMode = "terrain";
// 			if(thisSig.tileLayer != null) thisSig.map.removeLayer(thisSig.tileLayer);
// 			thisSig.tileLayer = L.tileLayer(thisSig.initParameters.mapTileLayer, 
// 									{maxZoom:20,
// 									 minZoom:3}).addTo(Sig.map);
// 			thisSig.map.minZoom = 0;
// 			thisSig.map.maxZoom = 20;
// 		}
// 		if(thisSig.map.getZoom() > thisSig.map.getMaxZoom()) 
// 			thisSig.map.setZoom(thisSig.map.getMaxZoom());
// 	});
// }
</script>


