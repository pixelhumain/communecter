<div class="panel panel-white">
	<div class="panel-heading text-center border-light">
		<h3 class="panel-title text-red"><i class="fa fa-map-marker"></i>   <?php echo Yii::t("common", "SOURCE ADMIN"); ?></h3>
	</div>
	<div class="panel-body">
		<h4 class="panel-title">Cities mal </h4>
		<br/>
		<div><span id="nbWarnings"></span></div>
		<div class="col-sm-2 col-xs-12" id="divFile">
			<h4 class=" text-dark">
				Fichier (CSV,JSON) :
			</h4>
			<input type="file" id="fileImport" name="fileImport" accept=".csv,.json,.js,.geojson">
		</div>
		<div class="col-xs-12">
				<a href="#" id="btnVerification" class="btn btn-success margin-top-15">Vérification</a>
			</div>
		<table id="tableEntity" class="col-xs-12">
			<?php
				//var_dump($cities);
				/*foreach ($cities as $name => $find) {
					echo $name."</br>";
					var_dump($find);
				}*/
			?>
		</table>
	</div>
</div>

<script type="text/javascript">

var file = [];
jQuery(document).ready(function() {
	setTitle("Espace administrateur : Import de données","cog");
	//init();
	 bindCheck();
});


function bindCheck(){
	$("#fileImport").change(function(e) {
    	var ext = $("input#fileImport").val().split(".").pop().toLowerCase();
    	//mylog.log("ext", ext, $.inArray(ext, "json"));
		if(ext != "csv" && ext !=  "json" && ext == "js" && ext !=  "geojson") {
			alert('Upload CSV or JSON');
			return false;
		}

		if(ext == "csv") {
			if (e.target.files != undefined) {
				var reader = new FileReader();
				file = [];
				reader.onload = function(e) {
					//mylog.log("csv : ", e.target.result );
					var csvval=e.target.result.split("\n");
					//mylog.log("csv : ", csvval );
					$.each(csvval, function(key, value){
						var ligne = value.split(";");
						var newLigne = [];
						$.each(ligne, function(keyLigne, valueLigne){
							//mylog.log("valueLigne", valueLigne);
							if(valueLigne.charAt(0) == '"' && valueLigne.charAt(valueLigne.length-1) == '"'){
								var elt = valueLigne.substr(1,valueLigne.length-2);
								newLigne.push(elt);
							}else{
								newLigne.push(valueLigne);
							}
						});
						
		  				file.push(newLigne);
		  			});
		  			mylog.log("file :", file.length );
		  			mylog.log("file :", file );
				};
				reader.readAsText(e.target.files.item(0));
			}
		}
		
		return false;

	});


	$("#btnVerification").off().on('click', function(e)
  	{
  		if($("#chooseCollection").val() == "-1"){
  			toastr.error("Vous devez sélectionner une collection");
  			return false ;
  		}
  		
		var fin = false ;
  		var indexStart = 0 ;
  		var limit = 25 ;
  		var indexEnd = limit;
  		var params = {};

  		while(fin == false){
  			subFile = file.slice(indexStart,indexEnd);
  			mylog.log("subFile", subFile.length);
  			params["file"] = subFile;
  			visualisation(params);
			indexStart = indexEnd ;
  			indexEnd = indexEnd + limit;
  			if(indexStart > file.length)
  				fin = true ;
  		}		
		
		
  		
  	});

}

function visualisation(params){
	$.ajax({
		url: baseUrl+'/communecter/admin/checkcedex/',
		type: 'POST',
		dataType: 'json', 
		data:{ params },
		async : false,
		success: function (obj){
			mylog.log('obj', obj);
			var ligne = "";
			$.each(obj, function(key, value){

				ligne += "<tr><td>"+value.cp+"</td><td>"+value.name+"</td><tr>";
			});

			$("#tableEntity").html(ligne);

		},
		error: function (error) {
			mylog.log('error', error);
		}
	});

}
/*function init(){
	//mylog.log("cities", jQuery.parseJSON(cities));

	var obj = jQuery.parseJSON(cities) ;
	chaine = "";
	mylog.log("obj", obj.length, obj);
	$.each(obj, function(key, value){
		var address = transformNominatimUrl(value["alternateName"]);
		var addressName = transformNominatimUrl(value["name"]);
		mylog.log('--------------------------------------------------------');
		var elt = findGeoposByDataGouv(value["cp"], value["insee"], address, "village");
		
		if(elt.length == 0)
			elt = findGeoposByDataGouv(value["cp"], value["insee"], address, "town");
		if(elt.length == 0)
			elt = findGeoposByDataGouv(value["cp"], value["insee"], address, "city");
		

		mylog.log("RESULT", elt);
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
			//mylog.log('success', type, obj.features);
			if(typeof obj.features != "undefined"){
				elt = obj.features ;
			}
		},
		error: function (error) {
			mylog.log('error', error);	
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
}*/


</script>