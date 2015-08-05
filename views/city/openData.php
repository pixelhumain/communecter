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
						<ul role="menu" class="dropdown-menu pull-right" id="filterGraph">
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
				<li>
					<label class = "label_dropdown" for="zoneGraph">Filtrer par : </label>
					<div class="btn-group">
						<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
							<span id="label-zone"> Commune </span><span class="caret"></span>
						</a>
						<ul role="menu" class="dropdown-menu pull-right" id="zoneGraph" >
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
	
	var optionCheckedOpenData = getValueChekboxOpenData(name_idOpenData);
	
	bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionCheckedOpenData, name_idOpenData, typeGraphOpenData);
	getPod();

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


function bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionChecked, name_idOpenData, typeGraphOpenData)
{
	console.warn("----------------- bindBtnAction -----------------");
	//console.log(name_id + "_panel : ", insee, typeDataOpenData, typeZoneOpenData, optionChecked);
	$("#"+name_idOpenData+"_panel .locBtn" ).off().on("click", function() {
		
		$("#label-zone").text($(this).text());
		typeZoneOpenData = $(this).data("name");
		bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionChecked, name_idOpenData, typeGraphOpenData)
	});


	$("#"+name_idOpenData+"_panel .graphBtn" ).off().on("click", function() {
		
		$("#label-graph").text($(this).text());
		typeGraphOpenData = $(this).data("name");
		bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionChecked, name_idOpenData, typeGraphOpenData)
		
	});

	$("#"+name_idOpenData+"_panel .typeBtn").off().on("click", function(){
		
		typeDataOpenData = $(this).data("name");
		console.log("nameTEXT", $(this).text());

		$("#<?php echo $name_idOpenData ; ?>_panel #label-type").text(typeDataOpenData);
		modifyListOptionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, name_idOpenData, typeGraphOpenData);
		/*var urlToSend = baseUrl+"/"+moduleId+"/city/getoptiondata/insee/"+inseeOpenData+"/typeData/"+typeDataOpenData;
		$.ajax({
			type: "POST",
			url: urlToSend,
			dataType: "json",
			success: function(data){
				console.log("gooooooo", data);
				modifyListOptionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, name_idOpenData, typeGraphOpenData);
			}
		});	*/
	});

	$("#"+name_idOpenData+"_panel .optionBtn").off().on("click", function(){
		
		optionChecked = getValueChekboxOpenData(name_idOpenData);
		if(optionChecked.length == 1)
			$("#<?php echo $name_idOpenData ; ?>_panel #label-option").text($(this).text());
		else
			$("#<?php echo $name_idOpenData ; ?>_panel #label-option").text(optionChecked.length + " éléments séléctionnés");

		optionData = $(this).data("name");
		
	});


	$("#"+name_idOpenData+"_panel #listCommune").click(function(){
		mapData = buildDataSet(map, $(this).data("name"));
			//console.log(mapData);
			d3.select("#<?php echo $name_idOpenData ; ?>_panel #chart svg")
			    .datum(mapData)
			    .call(chart);
			chart.update();
			bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionChecked, name_idOpenData, typeGraphOpenData);
	});

	$("#"+name_idOpenData+"_panel #listCommune" ).off().on("click", function() {
		
		var cities = [];
		var i = 0 ;
		$("#<?php echo $name_idOpenData ; ?>_panel #listCommune option:selected").each(function() 
		{
			cities[i] = $(this).val();
			i++;
		});

		if(i > 0)
		{
			var urlToSend = baseUrl+"/"+moduleId+"/city/getcitiesdata/insee/"+inseeOpenData+"/typeData/"+typeDataOpenData;
			if("undefined" != typeZoneOpenData){
				urlToSend += "/type/"+ typeZoneOpenData;
			}
			
			$.ajax({
				type: "POST",
				url: urlToSend,
				data : {cities : cities},
				dataType: "json",
				success: function(data){
					console.log("data", data);
					if(typeGraphOpenData == "piechart")
						getPieChart(data, typeDataOpenData, optionChecked, name_idOpenData);
					else
						getMultiBarChart(data, typeDataOpenData, optionChecked, name_idOpenData);
					
				} 
			});

		}
		else
		{
			var urlToSend = baseUrl+"/"+moduleId+"/city/getcitydata/insee/"+inseeOpenData+"/typeData/"+typeDataOpenData;
			if("undefined" != typeZoneOpenData){
				urlToSend += "/type/"+ typeZoneOpenData;
			}
			$.ajax({
				type: "POST",
				url: urlToSend,
				dataType: "json",
				success: function(data){
					console.log("data", data);
					if(typeGraphOpenData == "piechart")
						getPieChart(data, typeDataOpenData, optionChecked, name_idOpenData);
					else
						getMultiBarChart(data, typeDataOpenData, optionChecked, name_idOpenData);
				}
			});
		}
	});


	$("#ajouterPod").off().on("click", function(){
		console.warn("----------------- ajouterPod -----------------");
		console.info("ajouterPod", typeGraphOpenData);
		var urlToSend = baseUrl+"/"+moduleId+"/city/addpodopendata/";
		var urlPod = baseUrl+"/"+moduleId+"/city/statisticpopulation/insee/"+inseeOpenData+"/typeData/"+typeDataOpenData;
		


		if("undefined" != typeGraphOpenData){
			urlPod += "/typeGraph/"+ typeGraphOpenData;
		}
		if("undefined" != typeZoneOpenData){
			urlPod += "/type/"+ typeZoneOpenData;
		}

		
		titlePod = typeDataOpenData + " - " + typeGraphOpenData  + " - " + typeZoneOpenData;

		optionChecked = getNameOptionOpenData(name_idOpenData);
		if([] != optionChecked){
			urlPod += "/optionData/"+ $.param(optionChecked);
			titlePod = titlePod + " - Option : [ ";
			$.each(optionChecked, function(idOption,valueOption){
				titlePod = titlePod + valueOption + " " ;
			});
			titlePod = titlePod + "]";
		}

		
		
		$.ajax({
			type: "POST",
			url: urlToSend,
			data:{urlPod: urlPod, titlePod: titlePod, tabPod: tabPod},
			dataType: "json",
			success: function(data){
				console.info("ajouterPod", data);
				if(data.result == false)
				{
					toastr.error(data.msgError);
				}
				else
				{
					$("#listPod").html("");
					getPod();
					toastr.success("Le graphique a été ajouté.");
				}	
			}
		});
	});
}


function modifyListOptionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, name_idOpenData, typeGraphOpenData){
	console.warn("----------------- modifyListOptionOpenData -----------------");
	var urlToSend = baseUrl+"/"+moduleId+"/city/getlistoption/";
	$.ajax({
		type: "POST",
		url: urlToSend,
		data:{insee: inseeOpenData, typeData: typeDataOpenData, name_id: name_idOpenData},
		dataType: "json",
		success: function(data){
			console.info("modifyListOptionOpenDataSuccess", data);
			$("#<?php echo $name_idOpenData ; ?>_panel #filterGraph").html(data);
			var optionChecked = getValueChekbox(name_idOpenData);
			bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionChecked, name_idOpenData, typeGraphOpenData);
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

function getPod(){
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
					$("."+namePod + " .titlePod").html(valuePOD.title);
				}, "html");
			});
		}
	});
}

</script>