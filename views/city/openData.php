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
		<ul class="panel-heading-tabs border-light ulline">
			<li>
				<a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/communecter/city/creategraph/insee/'.$_GET['insee'];?>" class=""/>Ajouter</a>
			</li>
		<ul>
	</div>
	<div class="panel-body">
		<div id="listPod">
		 	
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function() {
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