<div class="panel panel-white">
	<div>
		<div class="panel-heading text-center border-light">
			<h3 class="panel-title text-red"><i class="fa fa-map-marker"></i>   <?php echo Yii::t("common", "CHECKGEOCODAGE"); ?></h3>
		</div>
		<div class="panel-body">
			<div class="col-sm-12 col-xs-12">
				<a href="#" class="btn btn-primary" id="btnCheckGeo"> Récupérer les citoyens/organisations qui sont mal géolocaliser</a>
			</div>
		</div>
	</div>


	<div id="divCheckEvents">
		<div class="panel-heading border-light">
			<h4 class="panel-title">Entité mal géolocalisé</h4>
		</div>
		<div class="panel-body">
			<table id="tableEntity" class="col-sm-12 col-xs-12">
				

			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
$(".moduleLabel").html("<i class='fa fa-cog'></i> Espace administrateur : Import de données");
jQuery(document).ready(function() {
	bindCheckGeo();
});

function bindCheckGeo(){
	$("#btnCheckGeo").off().on('click', function(e){
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'/communecter/admin/getentitybadlygeolocalited/',
	        dataType : 'json',
	        success: function(data)                                                   
	        {
	        	console.log("data",data);

	        	textHTML = "<tr><th>Type</th><th>Entité</th><th>Msg Error</th></tr>";

	        	$.each(data, function(typeEntity, listEntity){
	  				$.each(listEntity, function(key, entity){
	  					textHTML += "<tr>"+
	  									"<td>"+typeEntity+"</td>"+             
	  									"<td>"+								    
	  										'<a  href="javascript:;" onclick="loadByHash(\'#'+typeEntity+'.detail.id.'+entity[typeEntity]["_id"]["$id"]+'\')" class=""> '+
	  										entity[typeEntity].name+ "</td>"+
	  									"<td>"+entity["error"]+"</td>"+
	  								"</tr>";
					});
	  			});
	        	$("#tableEntity").html(textHTML);
	        }
		});
	});


}

</script>