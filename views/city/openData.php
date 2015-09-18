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
<div class='panel panel-white'>
	<div class="panel-heading border-light">
		<h4 class="panel-title">Liste des pods</h4>
	</div>
	<div class="panel-body">
		<div id="listPod">
		 	
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function() {

	getPod();
	/*var inseeOpenData = "<?php echo $_GET['insee']; ?>";
	var typeDataOpenData = "population";
	var typeGraphOpenData = "multibar"; 
	var typeZoneOpenData  = "commune";
	//var optionData = "undefined";
	tabPod = [];
	name_idOpenData = "<?php //echo $name_idOpenData; ?>";
	
	var citiesCheckedOpenData ='<?php array(); ?>';
	var optionCheckedOpenData = getValueChekboxOpenData(name_idOpenData);
	var optionCheckedCitiesOpenData = getValueChekboxCitiesOpenData(inseeOpenData, name_idOpenData);

	modifyListCitiesOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData, citiesCheckedOpenData, optionCheckedOpenData);
	
	bindBtnActionOpenData(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionCheckedOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData);
	getPod(inseeOpenData, typeDataOpenData, typeZoneOpenData, optionCheckedOpenData, name_idOpenData, typeGraphOpenData, optionCheckedCitiesOpenData);

	$("#<?php //echo $name_idOpenData ; ?>_panel #filtreByCommune").hide();
	$("#<?php //echo $name_idOpenData ; ?>_panel #listCommune").select2();

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


function bindBtnActionOpenData()
{
	//console.warn("----------------- bindBtnAction -----------------");
	//console.log(name_id + "_panel : ", insee, typeDataOpenData, typeZoneOpenData, optionChecked);

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
					getPod();
					toastr.success(data.msgSuccess);
				}	
			}
		});
	});

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
			$.each(data.tabPod, function(namePod,valuePOD){
				getAjax("."+namePod, valuePOD.url, 
				function(){
					$("."+namePod+" #title").html('X ' + valuePOD.title);
					bindBtnActionOpenData();
				}, "html");
			});
		}
	});
}



</script>