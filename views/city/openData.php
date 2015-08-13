<?php
/*$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/weather-icons/css/weather-icons.min.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js' , CClientScript::POS_END);
*/
?>
<?php
	$cs = Yii::app()->getClientScript();
  	$cssAnsScriptFilesModule = array(
  		'/assets/plugins/nvd3/nv.d3.js',
  		);
  	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
?>
<!-- start: PAGE CONTENT -->
<?php 
	$name_idOpenData = "openData" ;
?>
<div class="row">
	<div class='panel panel-white' id="<?php echo $name_idOpenData; ?>_panel">
		<div class="panel-heading border-light">
			<ul  class="panel-heading-tabs border-light ulline">
				<li>
					<label class = "label_dropdown" for="typeGraph">Voir : </label>
					<div class="btn-group">
						<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
							<span id="label-type"> Population </span><span class="caret"></span>
						</a>
						<ul role="menu" class="dropdown-menu" id="typeGraph">
							<?php
								$where = array("insee"=>$_GET['insee']);
	     						$fields = array();
	     						$option = City::getWhereData($where, $fields);
	     						$chaine = "" ;
	     						foreach ($option as $key => $value) 
	     						{
	     							foreach ($value as $k => $v) 
	     							{
	     								if($k != "_id" && $k != "insee")
		     							$chaine = $chaine.'<li>
											<a  class="btn-drop typeBtn" data-name="'.$k.'">'.$k.'</a>
										</li>';	
		     						}

	     						}
	     						echo $chaine ;
							?>
							
						</ul>
					</div>
				</li>
				<li>
					<label class = "label_dropdown" for="label-option">Option : </label>
					<div class="btn-group">
						<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
							<span id="label-option"> Total </span><span class="caret"></span>
						</a>
						<ul role="menu" class="dropdown-menu pull-right panel-scroll height-230" id="filterGraph">
							<?php
								$typeData= "population";
								$where = array("insee"=>$_GET['insee'], $typeData => array( '$exists' => 1 ));
	     						$fields = array($typeData);
	     						$option = City::getWhereData($where, $fields);
	     						$chaine = "" ;
	     						foreach ($option as $key => $value) 
	     						{
	     							foreach ($value as $k => $v) 
	     							{
		     							if($k == $typeData)
		     							{
		     								$chaine = CityOpenData::listOption($v, $chaine, true, $name_idOpenData);
		     							}	
		     						}
	     						}
	     						echo $chaine ;
							?>

						</ul>
					</div>
				</li>
				<li>
					<label class = "label_dropdown" for="typeGraph">Type graph : </label>
					<div class="btn-group">
						<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
							<span id="label-graph">Multi-Bar</span><span class="caret"></span>
						</a>
						<ul role="menu" class="dropdown-menu" id="typeGraph" >
							<li>
								<a class="btn-drop graphBtn" data-name="multibart">Multi-Bar</a>
							</li>
							<li>
								<a  class="btn-drop graphBtn" data-name="piechart">PieChart</a>
							</li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
		<div class="panel-heading border-light divline">
			<ul  class="panel-heading-tabs border-light ulline">
				<li>
					<label class = "label_dropdown" for="zoneGraph">Filtrer par : </label>
					<div class="btn-group">
						<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
							<span id="label-zone"> Commune </span><span class="caret"></span>
						</a>
						<ul role="menu" class="dropdown-menu pull-right " id="zoneGraph" >
							<li>
								<a class="btn-drop locBtn">Commune</a>
							</li>
							<li>
								<a  class="btn-drop locBtn" data-name="departement">Departement</a>
							</li>
							<li>
								<a  class="btn-drop locBtn" data-name="region">Region</a>
							</li>
						</ul>
					</div>
				</li>
				<li id="filtreByCommune">
					<div class="btn-group">
						<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
							<span id="label-cities"> Aucune communes sélectionnés </span><span class="caret"></span>
						</a>

						<ul role="menu" class="dropdown-menu pull-right panel-scroll height-230" id="filterCities">
						</ul>
					</div>
				</li>
				<li>
					<a href="#" id="ajouterPod">Ajouter</a>
				</li>
			</ul>
		</div>
	</div>
</div>


	<div class="row">
		<div id="listPod">
		 	
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function() {

	var inseeOpenData = "<?php echo $_GET['insee']; ?>";
	var typeDataOpenData = "population";
	var typeGraphOpenData = "multibar"; 
	var typeZoneOpenData  = "commune";
	//var optionData = "undefined";
	tabPod = [];
	name_idOpenData = "<?php echo $name_idOpenData; ?>";
	
	var citiesCheckedOpenData ='<?php array(); ?>';
	var optionCheckedOpenData = getValueChekboxOpenData(name_idOpenData);
	var optionCheckedCitiesOpenData = getValueChekboxCitiesOpenData(inseeOpenData, name_idOpenData);

	modifyListCitiesOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData, citiesCheckedOpenData, optionCheckedOpenData);
	
	bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionCheckedOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData);
	getPod(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionCheckedOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData);

	$("#<?php echo $name_idOpenData ; ?>_panel #filtreByCommune").hide();
	$("#<?php echo $name_idOpenData ; ?>_panel #listCommune").select2();

	$('.pulsate').pulsate({
            color: '#2A3945', // set the color of the pulse
            reach: 10, // how far the pulse goes in px
            speed: 1000, // how long one pulse takes in ms
            pause: 200, // how long the pause between pulses is in ms
            glow: false, // if the glow should be shown too
            repeat: 10, // will repeat forever if true, if given a number will repeat for that many times
            onHover: false // if true only pulsate if user hovers over the element
        });
	//$("#newPod").append(baseUrl+"/"+moduleId+"/city/statisticpopulation/insee/<?php echo $_GET["insee"]?>");

	/*getAjax(".statisticPop", baseUrl+"/"+moduleId+"/city/statisticpopulation/insee/<?php echo $_GET["insee"]?>", 
		function(){
			$(".statisticPop .ulline").hide();
			$(".statisticPop .divline").hide();
			$(".statisticPop #titleGraph").html('Population de la commune');
		}, "html");
	
	optionData = {};
	optionData["0"] = ".2012.total" ;
	optionData["1"] = ".2012.agriculture" ;
	
	getAjax(".statisticEntreprise", baseUrl+"/"+moduleId+"/city/statisticpopulation/insee/<?php echo $_GET["insee"]?>/typeData/entreprise/optionData/"+$.param(optionData), 
		function(){
			$(".statisticEntreprise .ulline").hide();
			$(".statisticEntreprise .divline").hide();
			$(".statisticEntreprise #titleGraph").html('Entreprise agriculture de la commune');
		}, "html");

	getAjax(".statisticEntreprise2", baseUrl+"/"+moduleId+"/city/statisticpopulation/insee/<?php echo $_GET["insee"]?>/typeData/entreprise/", 
		function(){
			$(".statisticEntreprise2 .ulline").hide();
			$(".statisticEntreprise2 .divline").hide();
			$(".statisticEntreprise2 #titleGraph").html('Entreprise de la commune');
		}, "html");*/


});


function bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionCheckedOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData)
{
	//console.warn("----------------- bindBtnAction -----------------");
	//console.log(name_id + "_panel : ", insee, typeDataOpenData, typeZoneOpenData, optionChecked);
	$("#"+name_idOpenData+"_panel .locBtn" ).off().on("click", function() {
		
		$("#"+name_idOpenData+"_panel #label-zone").text($(this).text());
		typeZoneOpenData = $(this).data("name");
		if(typeZoneOpenData != "commune")
		{
			modifyListCitiesOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData, [], optionCheckedOpenData)
		}
		else
			$("#"+name_idOpenData+"_panel #filtreByCommune").hide();
		bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionCheckedOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData)
	});


	$("#"+name_idOpenData+"_panel .graphBtn" ).off().on("click", function() {
		
		$("#label-graph").text($(this).text());
		typeGraphOpenData = $(this).data("name");
		bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionCheckedOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData)
		
	});

	$("#"+name_idOpenData+"_panel .typeBtn").off().on("click", function(){
		
		typeDataOpenData = $(this).data("name");
		console.log("nameTEXT", $(this).text());

		$("#"+name_idOpenData+"_panel #label-type").text(typeDataOpenData);
		modifyListOptionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData);
		
		/*var urlToSend = baseUrl+"/"+moduleId+"/city/getoptiondata/insee/"+inseeOpenData+"/typeData/"+typeDataOpenData;
		$.ajax({
			type: "POST",
			url: urlToSend,
			dataType: "json",
			success: function(data){
				console.log("gooooooo", data);
				modifyListOptionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, name_idOpenData, typeGraphOpenData);
			}
		});*/
	});

	$("#"+name_idOpenData+"_panel .optionBtn").off().on("click", function(){
		
		optionCheckedOpenData = getValueChekboxOpenData(name_idOpenData);
		if(optionCheckedOpenData.length == 1)
			$("#<?php echo $name_idOpenData ; ?>_panel #label-option").text($(this).text());
		else
			$("#<?php echo $name_idOpenData ; ?>_panel #label-option").text(optionCheckedOpenData.length + " éléments séléctionnés");		
	});

	$("#"+name_idOpenData+"_panel .optionCities").off().on("click", function(){
		console.warn("----------------- optionCities -----------------");
		optionCheckedCitiesOpenData = getValueChekboxCitiesOpenData(inseeOpenData, name_idOpenData);
		console.log("optionCheckedCities", optionCheckedCitiesOpenData);
		if(optionCheckedCitiesOpenData == null)
		{
			$("#<?php echo $name_idOpenData ; ?>_panel #label-cities").text("Aucunes communes séléctionnés");
		}	
		else
		{
			$("#<?php echo $name_idOpenData ; ?>_panel #label-cities").text((optionCheckedCitiesOpenData.length - 1) + " communes séléctionnés");
		}			
	});


	


	$("#ajouterPod").off().on("click", function(){
		//console.warn("----------------- ajouterPod -----------------");
		//console.info("ajouterPod", typeGraphOpenData);
		var title = typeDataOpenData + " - " + typeGraphOpenData  + " - " + typeZoneOpenData;
		bootbox.prompt("Donner un titre", function(result){
			
			if (result != null){                                             
			    title = result ;
			    var urlToSend = baseUrl+"/"+moduleId+"/city/addpodopendata/modify/add";
				var urlPod = baseUrl+"/"+moduleId+"/city/statisticpopulation/insee/"+inseeOpenData+"/typeData/"+typeDataOpenData;
				
				if("undefined" != typeGraphOpenData){
					urlPod += "/typeGraph/"+ typeGraphOpenData;
				}
				if("undefined" != typeZoneOpenData){
					urlPod += "/type/"+ typeZoneOpenData;
				}

				var optionCheckedOpenData = getNameOptionOpenData(name_idOpenData);
				if({} != optionCheckedOpenData){
					urlPod += "/optionData/"+ $.param(optionCheckedOpenData);
				}

				optionCheckedCitiesOpenData = getInseeOptionOpenData(name_idOpenData);
				if({} != optionCheckedCitiesOpenData){
					urlPod += "/inseeCities/"+ $.param(optionCheckedCitiesOpenData);
				}
				
				$.ajax({
					type: "POST",
					url: urlToSend,
					data:{urlPod: urlPod, titlePod: title, tabPod: tabPod},
					dataType: "json",
					success: function(data){
						//console.info("ajouterPod", data);
						if(data.result == false)
						{
							toastr.error(data.msgError);
						}
						else
						{
							$("#listPod").html("");
							getPod(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionCheckedOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData);
							toastr.success(data.msgSuccess);
						}	
					}
				});                           
			}
		});		
	});

	$(".deletePod").off().on("click", function(){
		console.warn("----------------- deletePod -----------------");
		var idPod_delete = $(this).attr("id").split("_");
		//alert(idPod_delete[0]);
		console.log("TabPod", tabPod);
		newTabPod = {};
		var i = 1 ;
		$.each(tabPod, function(keyNamePod,valuesPod){
			console.log("idPod_delete[0]", idPod_delete[0],"keyNamePod", keyNamePod);
			if(idPod_delete[0] != keyNamePod)
			{
				newTabPod['pod'+i] = valuesPod;
				i++ ;
			}	
		});

		console.log("newTabPod", newTabPod);
		var urlToSend = baseUrl+"/"+moduleId+"/city/addpodopendata/modify/delete";
		$.ajax({
			type: "POST",
			url: urlToSend,
			data:{tabPod: newTabPod},
			dataType: "json",
			success: function(data){
				//console.info("ajouterPod", data);
				if(data.result == false)
				{
					toastr.error(data.msgError);
				}
				else
				{
					$("#listPod").html("");
					getPod(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionCheckedOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData);
					toastr.success(data.msgSuccess);
				}	
			}
		});
	});

}

function modifyListOptionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData){
	//console.warn("----------------- modifyListOptionOpenData -----------------");
	var urlToSend = baseUrl+"/"+moduleId+"/city/getlistoption/";
	$.ajax({
		type: "POST",
		url: urlToSend,
		data:{insee: inseeOpenData, typeData: typeDataOpenData, name_id: name_idOpenData},
		dataType: "json",
		success: function(data){
			//console.info("modifyListOptionOpenDataSuccess", data);
			$("#<?php echo $name_idOpenData ; ?>_panel #filterGraph").html(data);
			var optionChecked = getValueChekbox(name_idOpenData);
			$("#<?php echo $name_idOpenData ; ?>_panel #label-option").text(optionChecked.length + " éléments séléctionnés");
			bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionChecked, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData);
		}
	});
}

function modifyListCitiesOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData, citiesCheckedOpenData, optionCheckedOpenData){
	//console.warn("----------------- modifyListCities -----------------");

	$("#<?php echo $name_idOpenData ; ?>_panel #filtreByCommune").show();
	var urlToSend = baseUrl+"/"+moduleId+"/city/getlistcities/insee/"+inseeOpenData+"/zone/"+typeZoneOpenData;
	$.ajax({
		type: "POST",
		url: urlToSend,
		dataType: "json",
		success: function(data){
			console.log("data", data);
			if(data.result == true)
			{
				console.log(data);
				var chaine = "";
				$.each(data.cities, function(keyCities,valuesCities){
					if(citiesCheckedOpenData.indexOf(valuesCities['insee']) == -1)
						chaine = chaine + '<li><a class="btn-drop optionCities" data-name="'+valuesCities['insee']+'"><input type="checkbox" id="'+name_idOpenData+valuesCities['insee']+'" name="'+name_idOpenData+'optionCheckboxCities" value="'+valuesCities['insee']+'"/><label for="'+name_idOpenData+valuesCities['insee']+'" >'+valuesCities['name']+'</label></a></li>';
					else
						chaine = chaine + '<li><a class="btn-drop optionCities" data-name="'+valuesCities['insee']+'"><input type="checkbox" id="'+name_idOpenData+valuesCities['insee']+'" name="'+name_idOpenData+'optionCheckboxCities" value="'+valuesCities['insee']+'" checked/><label for="'+name_idOpenData+valuesCities['insee']+'" >'+valuesCities['name']+'</label></a></li>';
				});
				$("#<?php echo $name_idOpenData ; ?>_panel #label-cities").text("Aucunes communes séléctionnés");
				$("#<?php echo $name_idOpenData ; ?>_panel #filterCities").html(chaine);
				optionCheckedCitiesOpenData = getValueChekboxCitiesOpenData(inseeOpenData, name_idOpenData);
				console.log(optionCheckedCitiesOpenData);
				bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionCheckedOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData);
			}

		}
	});
}

function getValueChekboxOpenData(name_idOpenData){
	console.warn("----------------- getValueChekbox -----------------");
	var optionChecked = [];
	$('input:checked[name='+name_idOpenData+'optionCheckbox]').each(function() {
	  optionChecked.push($(this).val());
	});

	if(optionChecked.length == 1)
		$("#<?php echo $name_idOpenData ; ?>_panel #label-option").text(optionChecked.length + " éléments séléctionnés");
	return optionChecked ;
}

function getValueChekboxCitiesOpenData(inseeOpenData, name_idOpenData){
	console.warn("----------------- getValueChekbox -----------------");
	var optionCheckedCities = [];
	$('input:checked[name='+name_idOpenData+'optionCheckboxCities]').each(function() {
	  optionCheckedCities.push($(this).val());
	});

	if(optionCheckedCities.length == 0)
		optionCheckedCities = null ;
	else
		optionCheckedCities.push(inseeOpenData);
	
	return optionCheckedCities ;
}

function getNameOptionOpenData(name_idOpenData){
	console.warn("----------------- getNameOptionOpenData -----------------");
	var optionChecked = {};
	var i = 0 ;
	$('input:checked[name='+name_idOpenData+'optionCheckbox]').each(function() {
	  optionChecked[i] = $(this).val();
	  i++;
	});

	return optionChecked ;
}

function getInseeOptionOpenData(name_idOpenData){
	console.warn("----------------- getInseeOptionOpenData -----------------");
	var optionCheckedCities = {};
	var i = 0 ;
	$('input:checked[name='+name_idOpenData+'optionCheckboxCities]').each(function() {
	  optionCheckedCities[i] = $(this).val();
	  i++;
	});

	return optionCheckedCities ;
}

function getPod(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionCheckedOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData){
	console.warn("----------------- getPod -----------------");
	var urlToSend = baseUrl+"/"+moduleId+"/city/getpodopendata/";
	$.ajax({
		type: "POST",
		url: urlToSend,
		dataType: "json",
		success: function(data){
			console.log("getPod", data.tabPod);
			$("#listPod").append(data.chaine);
			tabPod = data.tabPod ;
			$.each(data.tabPod, function(namePod,valuePOD){
				getAjax("."+namePod, valuePOD.url, 
				function(){
					$("."+namePod + " .ulline").hide();
					$("."+namePod + " .divline").hide();
					$("."+namePod + " .titlePod").html('<a href="#" id="'+namePod+'_delete" class="deletePod" >X</a> '+valuePOD.title);
					bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionCheckedOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData);
				}, "html");
			});
		}
	});
}

</script>