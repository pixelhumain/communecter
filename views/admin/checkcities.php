<div class="panel panel-white">
	<div class="panel-heading text-center border-light">
		<h3 class="panel-title text-red"><i class="fa fa-map-marker"></i>   <?php echo Yii::t("common", "SOURCE ADMIN"); ?></h3>
	</div>
	<div class="panel-body">
		<h4 class="panel-title">Cities mal </h4>
		<br/>
		<div><span id="nbWarnings"></span></div>
		<table id="tableEntity" class="col-sm-12 col-xs-12">
			
		</table>
	</div>
</div>

<script type="text/javascript">
$(".moduleLabel").html("<i class='fa fa-cog'></i> Espace administrateur : Import de données");

var cities = '<?php echo addslashes($cities) ; ?>' ;
jQuery(document).ready(function() {
	
	init();
});

function init(){
	//console.log("cities", jQuery.parseJSON(cities));

	var obj = jQuery.parseJSON(cities) ;
	chaine = "";
	console.log("obj", obj.length, obj);
	$.each(obj, function(key, value){
		var address = transformNominatimUrl(value["alternateName"]);
		var addressName = transformNominatimUrl(value["name"]);
		console.log('--------------------------------------------------------');
		var elt = findGeoposByDataGouv(value["cp"], value["insee"], address, "village");
		
		if(elt.length == 0)
			elt = findGeoposByDataGouv(value["cp"], value["insee"], address, "town");
		if(elt.length == 0)
			elt = findGeoposByDataGouv(value["cp"], value["insee"], address, "city");
		

		console.log("RESULT", elt);
		if(elt.length == 0){
			chaine += "<tr><td>"+ value["insee"]+" : "+ value["insee"]+" : "+ value["alternateName"]+"</td>";
			chaine += "<td>Introuvable sur DataGouv</td></tr>";
		}		
	});

	$("#tableEntity").html(chaine);

}

function findGeoposByDataGouv(cp, insee, city, type){
	var elt = {};
	$.ajax({  
		url: "//api-adresse.data.gouv.fr/search/?q="+city+"&postcode="+cp+"&citycode="+insee+"&type="+type,
		dataType: 'json',
		async:false,
		complete: function () {},
		success: function (obj){
			//console.log('success', type, obj.features);
			if(typeof obj.features != "undefined"){
				elt = obj.features ;
			}
		},
		error: function (error) {
			console.log('error', error);	
		}
	});

	return elt ;

}

function transformNominatimUrl(str){
	var res = "";
	for(var i = 0; i<str.length; i++){
		res += (str.charAt(i) == " ") ? "+" : str.charAt(i);
	}
	return res;
}


</script>