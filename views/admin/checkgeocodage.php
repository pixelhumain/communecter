<div class="panel panel-white">
	<div>
		<div class="panel-heading text-center border-light">
			<h3 class="panel-title text-red"><i class="fa fa-map-marker"></i>   <?php echo Yii::t("common", "CHECKGEOCODAGE"); ?></h3>
		</div>
		<div class="panel-body">
			<div class="col-sm-12 col-xs-12">
				<a href="#" class="btn btn-primary" id="btnCheckGeo"> Récupérer les citoyens/organisations qui sont mal géolocaliser</a>
			</div>
			<div class="col-sm-12 col-xs-12">
				Process : <br/>
				- On vérifie si l'entité a une adresse, si il en a une,  <br/>
				- On vérifie si l'entité a un code postal et un code INSEE : <br/>
					&nbsp;&nbsp;- Si il n'y en pas alors on retourne avec l'erreur<br/>
					&nbsp;&nbsp;- Sinon on test si il y a une géolocalisation :<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;- Si il n'y en pas alors on retourne avec l'erreur :<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;- On récupère la commune via la lat/lon/cp <br/>
						&nbsp;&nbsp;&nbsp;&nbsp;- Si on ne récupère pas la commune , on affiche un message d'erreur sinon<br/>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- On test si le code INSEE de la commune et celui de l'entité sont identiques <br/>
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
	  										entity[typeEntity].name+ "</a></td>"+
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