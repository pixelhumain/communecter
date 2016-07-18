<?php
	$cs = Yii::app()->getClientScript();
	if(!Yii::app()->request->isAjaxRequest)
	{
	  	$cssAnsScriptFilesModule = array(
	  		'/assets/plugins/nvd3/nv.d3.js',
	  		);
	  	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
  	}
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.js' , CClientScript::POS_END);
	//$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-select/bootstrap-select.min.js' , CClientScript::POS_END);
?>

<div class='panel panel-white'>
	
	<div class="panel-heading border-light">
		<h4 class="panel-title">Ajouter un graphe</h4>
		<ul class="panel-heading-tabs border-light ulline">
			<li>
				<a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/communecter/city/opendata/insee/'.$_GET['insee'];?>" class=""/>Back</a>
			</li>
		<ul>
	</div>
	<div class="panel-body">
		<div id="paramsGraph">
			<!-- Type Data -->
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<label for="typeData" />Type :</label>
					<!--class="selectpicker" -->
			      	<select id="typeData" class="col-sm-12 col-xs-12">
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
									$chaine = $chaine.'<option value="'.$k.'">'.$k.'</option>';	
								}

							}
							echo $chaine ;
						?>
			      	</select>
			    </div>

			    <div id="divTypeOption" class="col-sm-4 col-xs-12">
					<label for="typeOption" />Option : </label>
			      	<select id="typeOption" class="col-sm-12 col-xs-12" multiple="multiple">
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
	     								$chaine = CityOpenData::listOption2($v, $chaine, true, "");
	     							}	
	     						}
	 						}
	 						echo $chaine ;
						?>
			      	</select>
			    </div>

		      	<div class="col-sm-4 col-xs-12">
					<label for="typeGraph"/>Graphe :</label>
			      	<select id="typeGraph" class="col-sm-12 col-xs-12">
			        	<option value="multibart">Multi-Bar</option>
			        	<option value="piechart">PieChart</option>
			      	</select>
			    </div>

			   	
			</div>
			<br/>
			<div class="row">
			    <div class="col-sm-4 col-xs-12">
					<label for="typeZone"/>Zone :</label>
			      	<select id="typeZone" class="col-sm-12 col-xs-12">
			        	<option value="commune">Commune</option>
			        	<option value="departement">Departement</option>
			        	<option value="region">Region</option>
			      	</select>
			    </div>

			    <div id="divChooseCities" class="col-sm-4 col-xs-12" >
					<label for="chooseCities"/>Comparer :</label>
			      	<select id="chooseCities" class="col-sm-12 col-xs-12" multiple="multiple">
			      	</select>
			    </div>

	 			<div class="col-sm-4 col-xs-12">
					<a href="#" id="addPod" class="btn btn-primary col-sm-12 col-xs-12">Ajouter</a>
			    </div>
		   	</div>
		</div>

		<div id="corpsGraph">
		</div>
	</div>

</div>

<script type="text/javascript">
	
	jQuery(document).ready(function(){
		
		var insee = "<?php echo $insee; ?>";
		var typeData = $("#typeData").val();
		var typeZone = $("#typeZone").val();
		var typeGraph = $("#typeGraph").val();
		var optionChecked = $("#typeOption").val();
		var CitiesChecked = $("#chooseCities").val();

		console.log("init", insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked);
		bindBtnAction(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked)
		getGraph(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked)

		$("#typeData").select2();
		$("#typeZone").select2();
		$("#typeGraph").select2();
		$("#typeOption").select2();
		$("#chooseCities").select2();
		/*$("#typeData").selectpicker();
		$("#typeZone").selectpicker();
		$("#typeGraph").selectpicker();
		$("#typeOption").selectpicker();
		$("#chooseCities").selectpicker();
		//$('.selectpicker').selectpicker();*/
	});

function bindBtnAction(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked){
	
	//console.warn("----------------- bindBtnAction -----------------");
	//console.log(name_id + "_panel : ", insee, typeData, typeZone, optionChecked);
	
	$("#typeData").off().on("change", function() {
		console.warn("----------------- typeData -----------------");
		typeData = $("#typeData").val();
		modifyListOption(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked);
	});


	$("#typeZone").off().on("change", function() {
		console.warn("----------------- typeZone -----------------");
		typeZone = $("#typeZone").val();
		modifyListCities(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked);
	
	});

	$("#typeGraph").off().on("change", function() {
		console.warn("----------------- typeGraph -----------------");
		typeGraph = $("#typeGraph").val();
		getGraph(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked)
	
	});

	$("#typeOption").off().on("change", function() {
		console.warn("----------------- typeOption -----------------");
		optionChecked = $("#typeOption").val();
		console.log("optionChecked", optionChecked);
		getGraph(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked)
	
	});

	$("#chooseCities").off().on("change", function() {
		console.warn("----------------- chooseCities -----------------");
		CitiesChecked = $("#chooseCities").val();
		console.log("CitiesChecked", CitiesChecked);
		getGraph(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked)
	
	});


	$("#addPod").off().on("click", function() {
		console.warn("----------------- addPod -----------------");

		var title = typeData + " - " + typeGraph  + " - " + typeZone;
		bootbox.prompt("Donner un titre", function(result){
			
			if (result != null){                                             
			    title = result ;
			    var urlToAdd = baseUrl+"/"+moduleId+"/city/addpodopendata/modify/add";
				
				var urlPod = baseUrl+"/"+moduleId+"/city/graphcity/insee/"+insee;
				urlPod = urlPod+"/typeData/"+typeData;
				urlPod = urlPod+"/typeGraph/"+typeGraph;
				urlPod = urlPod+"/typeZone/"+typeZone;

				if(optionChecked != null)
					urlPod += "/optionData/"+ $.param(getNameOptionForURL(optionChecked));

				if(CitiesChecked != null)
					urlPod += "/inseeCities/"+ $.param(getNameOptionForURL(CitiesChecked));
				
				var urlToGetPod = baseUrl+"/"+moduleId+"/city/getpodopendata/";
				$.ajax({
					type: "POST",
					url: urlToGetPod,
					dataType: "json",
					success: function(dataPod){
						console.log("getPod", dataPod.tabPod);
						$.ajax({
							type: "POST",
							url: urlToAdd,
							data:{urlPod: urlPod, titlePod: title, tabPod: dataPod.tabPod},
							dataType: "json",
							success: function(data){
								console.info("ajouterPod", data);
								if(data.result == false)
								{
									toastr.error(data.msgError);
								}
								else
								{
									toastr.success(data.msgSuccess);
								}	
							}
						});
					}
				});                         
			}
		});	
		
	});

}


function modifyListOption(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked){
	console.warn("----------------- modifyListOption -----------------");
	var urlToSend = baseUrl+"/"+moduleId+"/city/getlistoption/";
	$.ajax({
		type: "POST",
		url: urlToSend,
		data:{insee: insee, typeData: typeData},
		dataType: "json",
		success: function(data){
			
			//$("#typeOption").html(data).selectpicker('refresh');
			$("#typeOption").select2('destroy').html(data).select2()

			optionChecked = $("#typeOption").val();
			bindBtnAction(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked);
			getGraph(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked)

			
		}
	});
}


function modifyListCities(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked){
	console.warn("----------------- modifyListCities -----------------");
	var urlToSend = baseUrl+"/"+moduleId+"/city/getlistcities/insee/"+insee+"/zone/"+typeZone;
	$.ajax({
		type: "POST",
		url: urlToSend,
		dataType: "json",
		success: function(data){
			console.log("data", data);
			if(data.result == true)
			{
				//var chaine = "<label for='chooseCities'/>Comparer : </label><select id='chooseCities' class='selectpicker' multiple>";
				var chaine = "";
				$.each(data.cities, function(keyCities,valuesCities){
					chaine += "<option value='"+valuesCities['insee']+"'>" + valuesCities['name'] + "</option>";
				});

				//$("#chooseCities").html(chaine).selectpicker('refresh');
				$("#chooseCities").select2('destroy').html(chaine).select2()

				CitiesChecked = $("#chooseCities").val();
				bindBtnAction(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked);
				getGraph(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked)
			}

		}
	});
}


function getNameOptionForURL(arrayForURL){
	console.warn("----------------- getNameOptionOpenData -----------------");
	var objetForURL = {};
	var i = 0 ;
	

	$.each(arrayForURL, function( index, value ) {
	  objetForURL[i] = value;
	  i++;
	});

	return objetForURL ;
}


function getGraph(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked)
{
	console.warn("----------------- getGraph -----------------");
	console.log(insee, typeData, typeZone, typeGraph, optionChecked, CitiesChecked);
	//http://127.0.0.1/ph/communecter/city/graphcity/insee/97414
	var urlToSend = baseUrl+"/"+moduleId+"/city/graphcity/insee/"+insee;
	urlToSend = urlToSend+"/typeData/"+typeData;
	urlToSend = urlToSend+"/typeGraph/"+typeGraph;
	urlToSend = urlToSend+"/typeZone/"+typeZone;

	if(optionChecked != null)
		urlToSend += "/optionData/"+ $.param(getNameOptionForURL(optionChecked));

	if(CitiesChecked != null)
		urlToSend += "/inseeCities/"+ $.param(getNameOptionForURL(CitiesChecked));

	console.log("urlToSend", urlToSend);
	
	getAjax("#corpsGraph", urlToSend, function(){}, "html");
}

function getPod(){
	console.warn("----------------- getPod -----------------");
	
}

</script>