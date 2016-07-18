<?php 

$cs = Yii::app()->getClientScript();
$cssAnsScriptFilesModule = array(
	'/assets/plugins/nvd3/lib/d3.v3.js',
	'/assets/plugins/nvd3/nv.d3.js',
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);

Menu::city($city);
$this->renderPartial('../default/panels/toolbar');
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
	//$(".moduleLabel").html( $(".moduleLabel").html()+" : <?php echo $city["name"] ?> <a href='#' id='btn-center-city'><i class='fa fa-map-marker'></i></a>");
	getPod();
});


function bindBtnActionOpenData(tabPod)
{
	$(".deletePod").off().on("click", function(){
		console.warn("----------------- deletePod -----------------");
		var idPod_delete = $(this).attr("id").split("_");
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
			$("#listPod").html(data.chaine);
			$.each(data.tabPod, function(namePod,valuePOD){
				getAjax("."+namePod, valuePOD.url, 
				function(){
					$("."+namePod+" #title").html('<a href="#" id="'+namePod+'_supp" class="deletePod">X  </a>' + valuePOD.title);
					bindBtnActionOpenData(data.tabPod);
				}, "html");
			});
		}
	});
}



</script>