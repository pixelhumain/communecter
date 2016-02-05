<?php
$cs = Yii::app()->getClientScript();
if(!Yii::app()->request->isAjaxRequest)
{
	$cssAnsScriptFilesModule = array(
		'/assets/plugins/jsonview/jquery.jsonview.js',
		'/assets/plugins/jsonview/jquery.jsonview.css',
		'/assets/js/sig/geoloc.js',
		'/assets/js/dataHelpers.js',
		//'/plugins/DataTables/media/css/DT_bootstrap.css',
		//'/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js',
    	//'/plugins/DataTables/media/js/DT_bootstrap.js'
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
}

$userId = Yii::app()->session["userId"] ;
?>
<div class="panel panel-white">
	<div id="config">
		<div class="panel-heading border-light">
			<h4 class="panel-title">Import Data</h4>
		</div>
		<div class="panel-body">
			<form id="formfile" method="POST" action="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/communecter/admin/importData';?>" enctype="multipart/form-data">
				<div class="col-sm-3 col-xs-12">
					<label for="chooseCollection">Collection : </label>
					<?php
						$params = array();
						$fields = array("_id", "key");
						$listCollection = ImportData::getMicroFormats($params, $fields);
					?>
					<select id="chooseCollection" name="chooseCollection">
						<option></option>
						<?php
							foreach ($listCollection as $key => $value) {
								echo '<option value="'.$value['_id']->{'$id'}.'">'.$value['key'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="col-sm-3 col-xs-12">
					<label for="fileImport">Fichier (CSV,JSON) :</label>
					<input type="file" id="fileImport" name="fileImport" accept=".csv,.json,.js">
				</div>
				<div class="col-sm-3 col-xs-12">
					<label> Séparateur de données :</label>
					<select id="separateurDonnees" name="separateurDonnees">
						<option value=";">point-virgule</option>
					  	<option value=",">virgule</option>
					  	<option value=".">point</option>
					  	<option value=" ">espace</option>
					</select>
				</div>
				<div class="col-sm-3 col-xs-12">
					<label> Séparateur de texte :</label>
					<select id="separateurTexte" name="separateurTexte">
						<option value='"'>guillemet</option>
					  	<option value="'">cote</option>
					</select>
				</div>
				<br/><br/><br/><br/><br/>
				<div class="col-sm-4 col-sm-offset-5 col-xs-12">
					<input type="submit" class="btn btn-primary col-sm-3" id="sumitVerification" value="Vérification"/>
				</div>
			</form>
		</div>
	</div>
	<div id="createLink">
		<div class="panel-heading border-light">
			<h4 class="panel-title">Assignation des données</h4>
		</div>
		<div class="panel-body">
			<?php
				if(!empty($createLink))
				{
					$arrayNameFile = explode(".", $nameFile);
					if(!empty($typeFile) && $typeFile == "csv")
					{
			?>
				<div class="col-sm-12 col-xs-12">
					<label for="subFile">Fichier : </label>
					<select id="subFile">
						<?php
								
									$subfiles = scandir(sys_get_temp_dir()."/filesImportData/".$arrayNameFile[0]);
									foreach ($subfiles as $key => $value){
						                if(strpos($value, $arrayNameFile[0]) !== false) 
						                	echo '<option value="'.$value.'">'.$value.'</option>';
						            }
						     
						?>
					</select>
					
				</div>

			<?php
					}
				}
			?>
			<br/> <br/>
			<div class="col-sm-12 col-xs-12">
				<div class="col-sm-4 col-xs-12">
					<label for="selectCreator">Créateur : </label>
					<select id="selectCreator">
						<option value="you">Vous-même</option>
						<option value="other">Autre</option>
					</select>
				</div>
				<div id="divSearchCreator">
					<div class="col-sm-4 col-xs-12">
						<input class="" placeholder="Saisir l'ID du creator de données" id="creatorID" name="creatorID" value="">
						<input class="" placeholder="Saisir l'Email du creator de données" id="creatorEmail" name="creatorEmail" value="">
					</div>
				</div>
				<div class="col-sm-4 col-xs-12">
					<label for="selectRole">Role : </label>
					<select id="selectRole">
						<option value="creator">Creator</option>
						<option value="admin">Admin</option>
						<option value="member">Member</option>
					</select>
				</div>
			</div>
			<br/> <br/>
			<div class="col-sm-12 col-xs-12">
				
				<!--<div id="divSearchMember">
					<div class="col-sm-3 col-xs-12">
						<input class="invite-search form-control" placeholder="Choisir une personne qui sera relié au données" autocomplete = "off" id="inviteSearch" name="inviteSearch" value="">
			        		<ul class="dropdown-menu" id="dropdown_searchInvite" style="">
								<li class="li-dropdown-scope">-</li>
							</ul>
						</input>
						<input type="hidden" name="memberId" id="memberId" value=""/>
					</div>
					<div class="col-sm-4 col-xs-12">
						People : <div id="namePeople"></div>
					</div>
				</div>-->
			</div>
			<br/> <br/>
			<div id="divtab" class="table-responsive">
				<input type="hidden" id="nbLigneMapping" value="0"/>
				<?php
					if(!empty($createLink)){
						echo '<input type="hidden" id="idCollection" value="'.$idCollection.'"/>';
						echo '<input type="hidden" id="nameFile" value="'.$arrayNameFile[0].'"/>';
						echo '<input type="hidden" id="typeFile" value="'.$typeFile.'"/>';
						//var_dump(json_encode($json_origine));
						if(!empty($typeFile) && $typeFile == "csv")
							echo '<input type="hidden" id="jsonCSV" value="'.json_encode($arrayCSV).'"/>';
						if(!empty($typeFile) && $typeFile == "json")
							echo "<input type='hidden' id='jsonJSON' value='".json_encode($json_origine)."' />";
							//echo '<input type="hidden" id="jsonJSON" value="'.json_encode($json_origine).'"/>';
						
					}
				?>
		    	<table id="tabcreatemapping" class="table table-striped table-bordered table-hover">
		    		<thead>
			    		<tr>
			    			<th class="col-sm-5">Colonne CSV</th>
			    			<th class="col-sm-5">Mapping</th>
			    			<th class="col-sm-2">Ajouter/Supprimer</th>
			    		</tr>
		    		</thead>
			    	<tbody class="directoryLines" id="bodyCreateMapping">
				    	<tr id="LineAddMapping">
			    			<td>
			    				<select id="selectHeadCSV" class="col-sm-12">
			    					<?php
			    						if(!empty($createLink)){
			    							if(!empty($typeFile) && $typeFile == "csv"){
				    							foreach ($arrayCSV[0] as $key => $value) 
												{
													echo '<option value="'.$key.'">'.$value.'</option>' ;
												}
											}
											else if(!empty($arbre)  && $typeFile == "json"){
												foreach ($arbre as $key => $value) 
												{
													echo '<option value="'.$value.'">'.$value.'</option>';
												}
											}
											
			    						}
			    					?>
			    				</select>
			    			</td>
			    			<td>
			    				<select id="selectLinkCollection" class="col-sm-12">
									<?php
			    						if(!empty($createLink))
			    						{
			    							$params = array("_id"=>new MongoId($idCollection));
											$fields = array("mappingFields");
											$fieldsCollection = ImportData::getMicroFormats($params, $fields);
											
			    							foreach ($fieldsCollection as $key => $value) 
											{
												//var_dump($value);
												$pathMapping = FileHelper::arbreJson($value['mappingFields'], "", "");
												$arrayPathMapping = explode(";",  $pathMapping);
												foreach ($arrayPathMapping as $keyPathMapping => $valuePathMapping) 
												{
													
													if(!empty($valuePathMapping))
														echo '<option name="optionLinkCollection" value="'.$valuePathMapping.'">'.$valuePathMapping.'</option>' ;
												}
											}
			    							
			    						}
			    					?>
			    				</select>
			    			</td>
			    			<td>
			    				<input type="submit" id="addMapping" class="btn btn-primary col-sm-12" value="Ajouter"/>
			    			</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="form-group col-sm-12">
				<div class="form-group col-sm-4 col-sm-offset-5">
					<a href="#" id="sumitVisualisation" class="btn btn-primary col-sm-3">Visualisation</a>
				</div>
			</div>
		</div>
	</div>
	<div id="verifBeforeImport">
		<div class="panel-heading border-light">
			<h4 class="panel-title">Vérification avant l'import</h4>
		</div>
		<div class="panel-body">
			<div class="col-xs-12 col-sm-12">
				<div class="panel-scroll row-fluid height-300">
					<table id="representation" class="table table-striped table-hover">

					</table>
				</div>
				
			</div>
			<div class="col-xs-12 col-sm-12">
				<div class="col-xs-12 col-sm-6">
					<label>Données importés :</label>	
					<div class="panel panel-default">
						<div class="panel-body">
							<div id="divJsonImport" class="panel-scroll height-300">
								<input type="hidden" id="jsonImport" value="">
							    <div class="col-md-12" id="divJsonImportView"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<label>Données rejetées :</label>	
					<div class="panel panel-default">
						<div class="panel-body">
							<div id="divJsonError" class="panel-scroll height-300">
								<input type="hidden" id="jsonError" value="">
							    <div class="col-md-12" id="divJsonErrorView"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5 col-md-offset-5">
				<a href="#" class="btn btn-primary col-md-3" type="submit" id="sumitGeo">GeoLocalisation</a>
				<a href="#" class="btn btn-primary col-md-3" type="submit" id="sumitImport">Import</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

$(".moduleLabel").html("<i class='fa fa-cog'></i> Espace administrateur : Import de données");

var tabObject = [];
var userId = "<?php echo $userId; ?>" ;
$("#memberId").html(userId);

jQuery(document).ready(function() 
{
	

	bindEvents();
	var createLink = "<?php echo $createLink; ?>" ;

	
	if(createLink == false)
		$("#createLink").hide();
	$("#verifBeforeImport").hide();
	$("#divSearchCreator").hide();
	//$("#representation").DataTable();

});

function bindEvents()
{

	$("#fileImport").change(function(e) {
    	
		var ext = $("input#fileImport").val().split(".").pop().toLowerCase();
		if($.inArray(ext, ["csv"]) == -1) {
			alert('Upload CSV');
			return false;
		}  
		

	});

	$("#sumitVerification").off().on('click', function()
  	{
  		var nameFile = $("#fileImport").val().split("."); 
  		console.log("type",nameFile[nameFile.length-1])
  		if(nameFile[nameFile.length-1] != "csv" && nameFile[nameFile.length-1] != "json" && nameFile[nameFile.length-1] != "js" )
  		{
  			toastr.error("Vous devez sélectionner un fichier en CSV ou JSON");
  			return false ;
  		}

  		if(e.target.files != undefined) {
			var reader = new FileReader();
			var arrayCSV = [];
			reader.onload = function(e) {
				console.log("csv : ", e.target.result )
				
				var csvval=e.target.result.split("\n");
				console.log("csv : ", csvval )
				$.each(csvval, function(key, value){
	  				arrayCSV.push(value.split(";"));
	  			});
	  			console.log("arrayCSV : ", arrayCSV )

			};
			reader.readAsText(e.target.files.item(0));


			$.ajax({
			        type: 'POST',
			        data: {
			        		nameFile : ""
			        },
			        url: baseUrl+'/communecter/admin/previewData/',
			        dataType : 'json',
			        success: function(data)
			        {


			        }
			});

		}
		
		return false;
  		
  	});


	$('#inviteSearch').keyup(function(e){
	    var search = $('#inviteSearch').val();
	    if(search.length>2){
	    	clearTimeout(timeout);
			timeout = setTimeout('autoCompleteInviteSearch("'+encodeURI(search)+'")', 500); 
		 }else{
		 	$("#dropdown_searchInvite").css({"display" : "none" });	
		 }	
	});



	/*$("#selectRole").change( function (){
		var role = $("#selectRole").val();
		if(role == "creator")
		{
			$("#divSearchMember").hide();
			$("#memberId").html(userId);
		}	
		else
			$("#divSearchMember").show();
	});*/


	$("#selectCreator").change( function (){
		var creator = $("#selectCreator").val();
		if(creator == "you")
		{
			$("#divSearchCreator").hide();
			$("#creatorID").html(userId);
		}	
		else
		{
			$("#divSearchCreator").show();
			$("#creatorID").html("");
		}	
	});


	$("#addMapping").off().on('click', function()
  	{
  		var nbLigneMapping = parseInt($("#nbLigneMapping").val()) + 1;
  		var error = false ;
  		var msgError = "" ;

  		var selectValueHeadCSV = $("#selectHeadCSV option:selected").text() ;
  		var selectIdHeadCSV = $("#selectHeadCSV option:selected").val() ;
  		var selectLinkCollection = $("#selectLinkCollection option:selected").text() ;


  		var inc = 1;
  		while(error == false && inc <= nbLigneMapping)
  		{
  			if($("#valueHeadCSV"+inc).text() == selectValueHeadCSV )
  			{
  				error = true;
  				msgError += "Vous avez déja ajouter l'éléments de la colonne CSV. "
  			}

  			if($("#valueLinkCollection"+inc).text() == selectLinkCollection)
  			{
  				error = true;
  				msgError += "Vous avez déja ajouter l'éléments de la colonne du Mapping. "
  			}
  			inc++;
  		}

  		if(error == false)
  		{
  			var arrayLinkCollection = selectLinkCollection.split(".");
  			if(verifNameSelected(arrayLinkCollection))
  			{
  				var newOptionSelect = addNewMappingForSelecte(arrayLinkCollection, false);
	  			var arrayOption = [];
	  			getOptionHTML(arrayOption, newOptionSelect, "");
	  			verifBeforeAddSelect(arrayOption);
	  			chaine = "" ;
	  			$.each(arrayOption, function(key, value){
	  				chaine = chaine + '<option name="optionLinkCollection" values="'+value+'">'+value+'</option>'
	  			});

	  			$("#selectLinkCollection").append(chaine);
  			}

  			
	  		ligne = '<tr id="lineMapping'+nbLigneMapping+'"> ';
	  		ligne =	 ligne + '<td id="valueHeadCSV'+nbLigneMapping+'">' + selectValueHeadCSV + '</td>';
	  		ligne =	 ligne + '<td id="valueLinkCollection'+nbLigneMapping+'">' + selectLinkCollection + '</td>';
	  		ligne =	 ligne + '<td><input type="hidden" id="idHeadCSV'+nbLigneMapping+'" value="'+ selectIdHeadCSV +'"/><a href="#" class="deleteLineMapping btn btn-primary">X</a></td></tr>';
	  		$("#nbLigneMapping").val(nbLigneMapping);
	  		$("#LineAddMapping").before(ligne);
	  		bindEvents();
	  	}
	  	else
	  	{
	  		toastr.error(msgError);
	  	}

	  	bindEvents();
  		return false;
  	});

	$(".deleteLineMapping").off().on('click', function()
  	{
  		$(this).parent().parent().remove();
  	});


  	$("#sumitVisualisation").off().on('click', function()
  	{
		/*$.blockUI({
		message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
		           '<blockquote>'+
		             '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
		             '<cite title="Hegel">Hegel</cite>'+
		           '</blockquote> '
		});
		$.blockUI({
				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
	            '<blockquote>'+
	              '<p>Get up Stand up ! Stand up for your right !</p>'+
	              '<cite title="Bob Marley">Bob Marley</cite>'+
	            '</blockquote> '
			});*/

		var creator = "" ;
  		if($("#selectCreator").val() == "you")
  			creator = userId ;
  		else if($("#selectCreator").val() == "other")
  			creator = $('#creatorID').val() ;
		var nbLigneMapping = $("#nbLigneMapping").val();
		
		var infoCreateData = [] ;

		if(nbLigneMapping == 0)
		{
			$.unblockUI();
			toastr.error("Vous devez faire au moins une assignation de données");
  			return false ;
		}
		else
		{
			for (i = 1; i <= nbLigneMapping; i++) 
	  		{
	  			if($('#lineMapping'+i).length)
	  			{
	  				var valuesCreateData = {};
					valuesCreateData['valueLinkCollection'] = $("#valueLinkCollection"+i).text();
					valuesCreateData['idHeadCSV'] = $("#idHeadCSV"+i).val();
					infoCreateData.push(valuesCreateData);
	  			}
				
	  		}

	  		var jsonFile = "" ;

	  		if($("#typeFile").val() == "csv")
	  			jsonFile = $("#jsonCSV").val() ;
	  		else if($("#typeFile").val() == "json" || $("#typeFile").val() == "js")
	  			jsonFile = $("#jsonJSON").val() ;

	  		//console.log("type", $("#typeFile").val());
	  		//console.log("jsonFile", jsonFile, $("#jsonJSON").val());
	  		if(infoCreateData != [])
	  		{
	  			$.ajax({
			        type: 'POST',
			        data: {
			        		infoCreateData : infoCreateData, 
			        		idCollection : $("#idCollection").val(),
			        		jsonFile :  jsonFile,
			        		subFile : $("#subFile").val(),
			        		nameFile : $("#nameFile").val(),
			        		typeFile : $("#typeFile").val(),
			        		role : $("#selectRole").val(),
			        		creatorID : creator,
			        		creatorEmail : $('#creatorEmail').val(),
			        },
			        url: baseUrl+'/communecter/admin/previewData/',
			        dataType : 'json',
			        success: function(data)
			        {
			        	console.log("data",data);
			        	if(data.result)
			        	{
			        		//console.log("data.jsonImport",data.jsonImport);
			        		$("#divJsonImportView").JSONView(data.jsonImport);
			        		$("#jsonImport").val(data.jsonImport);
			        		$("#divJsonErrorView").JSONView(data.jsonError);
			        		$("#jsonError").val(data.jsonError);

			        		console.log("csvContenu", data.csvContenu);
							var chaine = "" ;
			        		$.each(data.csvContenu, function(keyCsvContenu, valueCsvContenu){
			        			chaine += "<tr>" ;
			        			if(keyCsvContenu == 0)
			        			{
			        				$.each(valueCsvContenu, function(key, value){
			        					chaine += "<th>"+value+"</th>";
			        				});
			        			}else{
									$.each(valueCsvContenu, function(key, value){
			        					chaine += "<td>"+value+"</td>";
			        				});
			        			}
			        			chaine += "</tr>" ;
			        		});
			        		$("#representation").html(chaine);
			        		$("#verifBeforeImport").show();




			        		$.unblockUI();
			        	}
			        }
			    });
	  		}
	  		else
			{
				toastr.error("Vous devez ajouter des éléments au mapping.");
			}
	  		console.log("infoCreateData", infoCreateData);
		}
		$.unblockUI();
  		return false;
  	});


	$("#sumitImport").off().on('click', function()
  	{
  		var creator = "" ;
  		if($("#selectCreator").val() == "you")
  			creator = userId ;
  		else if($("#selectCreator").val() == "other")
  			creator = $('#creatorID').val() ;

  		console.log("creator", creator);
  		/*$.blockUI({
		message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
  	            '<blockquote>'+
  	              "<p>Rien n'est plus proche du vrai que le faux</p>"+
  	              '<cite title="Einstein">Einstein</cite>'+
  	            '</blockquote> '
		});*/
  		$.ajax({
	        type: 'POST', 
	        data: { jsonImport : $('#jsonImport').val(), 
	        		nameFile : $('#nameFile').val(),
	        		jsonError : $('#jsonError').val(),
	        		creatorID : creator,
	        		idCollection : $("#idCollection").val()},
	        url: baseUrl+'/communecter/admin/importinmongo/',
	        dataType : 'json',
	        success: function(data)
	        {
	            console.dir(data);
	            if(data.result)
	              	toastr.success("Les données ont été ajouté.");
	            else
	                toastr.error("Erreur");
	           	//$.unblockUI();
	        }
	    });
  	});




  	$("#sumitGeo").off().on('click', function()
  	{
  		var dataGood = [];
  		var dataBad = jQuery.parseJSON($('#jsonError').val()) ;

  		var nbNominatim = 0;
  		var nbGoogle = 0;

  		var json = jQuery.parseJSON($('#jsonImport').val()) ;
  		$.each( json, function( key, org ) {
  			//console.log("org", org);
			
		   	var adressLong = "" ;
		   	var adressShort = "" ;

	  		if(org.address.streetAddress.trim() != "")
	  			adressLong = adressLong + org.address.streetAddress ;

	  		if(org.address.postalCode.trim() != "")
	  		{
	  			adressLong = adressLong + ", " + org.address.postalCode;
	  			adressShort += org.address.postalCode;
	  		}	
	  		if(org.address.addressLocality.trim() != "")
	  		{
	  			adressLong = adressLong + ", " +  org.address.addressLocality;
	  			adressShort += ", " + org.address.addressLocality
	  		}	

			
	  		var address = transformNominatimUrl(adressLong);
		  		//lance la requette nominatim (sig/geoloc.js l.109)
		  	var objNominatim = findGeoposByNominatim(address);
				
			var geo = {};
			var address2 = org.address;

			if(objNominatim.length != 0){
				valNominatim = objNominatim[0];
				//$.each(objNominatim, function( keyNominatim, valNominatim ){
					geo["@type"] = "GeoCoordinates";
					geo["latitude"] = valNominatim.lat;
					geo["longitude"] = valNominatim.lon;
					nbNominatim = nbNominatim + 1 ;
				//});
			}else{
				address = transformNominatimUrl(adressLong);
				objGoogleMaps = findGeoposByGoogleMaps(address);
				console.log("objGoogleMaps", objGoogleMaps, objGoogleMaps.length, objGoogleMaps.size);
				if(objGoogleMaps.results.length != 0){	
					var valGoogleMaps = objGoogleMaps.results[0] ;
					geo["@type"] = "GeoCoordinates";
					geo["latitude"] = valGoogleMaps.geometry.location.lat;
					geo["longitude"] = valGoogleMaps.geometry.location.lng;
					nbGoogle = nbGoogle + 1 ;
				}else{
					address = transformNominatimUrl(adressShort);
					objNominatim = findGeoposByNominatim(address);
					if(objNominatim.length != 0){
						valNominatim = objNominatim[0];
						//$.each(objNominatim, function( keyNominatim, valNominatim ){
							geo["@type"] = "GeoCoordinates";
							geo["latitude"] = valNominatim.lat;
							geo["longitude"] = valNominatim.lon;
							org["Warning"] = "Nous n'avons pas pu géolocaliser précisément l'organisme." ;
							nbNominatim = nbNominatim + 1 ;
						//});

					}else{
						address = transformNominatimUrl(adressShort);
						objGoogleMaps = findGeoposByGoogleMaps(address);
						console.log("objGoogleMaps", objGoogleMaps);
						if(objGoogleMaps.results.length != 0 && objGoogleMaps.status != "ZERO_RESULTS"){	
							var valGoogleMaps = objGoogleMaps.results[0] ;
							geo["@type"] = "GeoCoordinates";
							geo["latitude"] = valGoogleMaps.geometry.location.lat;
							geo["longitude"] = valGoogleMaps.geometry.location.lng;
							org["Warning"] = "Nous n'avons pas pu géolocaliser précisément l'organisme." ;
							nbGoogle = nbGoogle + 1 ;
						}
						else
							org["msgError"] = "Nous n'avons pas pu faire la Géolocalisation" ;
			  		}
			  	}
			}


		  	if(address2["codeInsee"].trim().length == 0 && geo["latitude"].length != 0 && geo["longitude"].length != 0)
	  		{
	  			address2["codeInsee"] = getInseeWithLatLon(geo["latitude"], geo["longitude"]);
	  			if(address2["codeInsee"].trim().length != 0)
	  				address2["addressLocality"] = getInfoAdressByInsee(address2["codeInsee"], address2["postalCode"]);
	  			else
	  				org["msgError"] = "Nous n'avons pas pu récupérer le code INSEE" ;
	  		}
			
			org["geo"] = geo ;
			org["address"] = address2 ;

			if(typeof org["msgError"] == "undefined" && typeof org["Warning"] == "undefined")
			{
				console.log("dataGood", typeof org["Warning"]);
				dataGood.push(org) ;
			}	
			else
			{
				console.log("dataBad", typeof org["Warning"]);
				dataBad.push(org) ;
			}	
		

		});

		console.log("nbNominatim", nbNominatim);
		console.log("nbGoogle", nbGoogle);
		$("#divJsonImportView").JSONView(JSON.stringify(dataGood));
		$("#jsonImport").val(JSON.stringify(dataGood));
		$("#divJsonErrorView").JSONView(dataBad);
		$("#jsonError").val(dataBad);
		
		var list = dataGood;
		$.each(dataBad, function(key, value){
			list.push(value)
		});		

		$.ajax({
	        type: 'POST', 
	        data: { list : list },
	        url: baseUrl+'/communecter/admin/checkdataimport/',
	        dataType : 'json',
	        success: function(data)
	        {
	            var chaine = "" ;
        		$.each(data, function(keyCsvContenu, valueCsvContenu){
        			chaine += "<tr>" ;
        			if(keyCsvContenu == 0)
        			{
        				$.each(valueCsvContenu, function(key, value){
        					chaine += "<th>"+value+"</th>";
        				});
        			}else{
						$.each(valueCsvContenu, function(key, value){
        					chaine += "<td>"+value+"</td>";
        				});
        			}
        			chaine += "</tr>" ;
        		});
        		$("#representation").html(chaine);
	        }
	    });
		
  	});
}



function getInseeWithLatLon(lat, lon){
	var insee = "" ;
	$.ajax({
		type: 'POST',
		data: { 
			latitude : lat,
			longitude : lon
		},
		async:false,
		url: baseUrl+'/communecter/sig/getinseebylatlng/',
		dataType : 'json',
		success: function(data){
			insee = data.insee ;
		}
	});

	return insee ;
	
}

function getInfoAdressByInsee(insee,cp){
	var alternateName = "" ;
	$.ajax({
		type: 'POST',
		data: { 
			insee : insee,
			cp : cp
		},
		async:false,
		url: baseUrl+'/communecter/city/getinfoadressbyinsee/',
		dataType : 'json',
		success: function(data){
			//console.log(data);
			$.each(data, function( key, val ) {
				console.log(val);
				alternateName = val.alternateName ;
			});
			
		}
	});

	return alternateName ;	
}





function callbackNominatimSuccess(obj){
	return obj ;
}
//https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=YOUR_API_KEY

function findGeoposByGoogleMaps(requestPart){
	var objnominatim = {} ;
	console.log('findGeoposByGoogleMaps',"https://maps.googleapis.com/maps/api/geocode/json?address=" + requestPart + "&key=AIzaSyCKvVYQHdz8dD34nvp7xl8wEYVGHQhXKtM");
	showLoadingMsg("Recherche de la position en cours");
	$.ajax({
		url: "//maps.googleapis.com/maps/api/geocode/json?address=" + requestPart + "&key=AIzaSyCKvVYQHdz8dD34nvp7xl8wEYVGHQhXKtM",
		type: 'POST',
		dataType: 'json',
		async:false,
		crossDomain:true,
		complete: function () {},
		success: function (obj){
			console.log('success');	
			hideLoadingMsg();
			objnominatim = callbackNominatimSuccess(obj);
		},
		error: function (error) {
			console.log('error');	
			return callbackNominatimError(error);
		}
	});

	return objnominatim ;

}


function findGeoposByNominatim(requestPart){
	var objnominatim = {} ;
	//console.log('findGeoposByNominatim');
	showLoadingMsg("Recherche de la position en cours");
	$.ajax({
		url: "//nominatim.openstreetmap.org/search?q=" + requestPart + "&format=json&polygon=0&addressdetails=1",
		type: 'POST',
		dataType: 'json',
		async:false,
		crossDomain:true,
		complete: function () {},
		success: function (obj){
			//console.log('success');	
			hideLoadingMsg();
			objnominatim = callbackNominatimSuccess(obj);
		},
		error: function (error) {
			//console.log('error');	
			return callbackNominatimError(error);
		}
	});

	return objnominatim ;

}


function addNewMappingForSelecte(arrayMap, subArray)
{
	var firstElt = arrayMap[0] ;
	arrayMap.shift();
	var beInt = parseInt(firstElt);
	var newSelect = {} ;

	if(!isNaN(beInt))
	{
		beInt++;
		if(subArray)
		{	
			if(arrayMap.length >= 1)
			{
				var newArrayMap = jQuery.extend([], arrayMap);
				newSelect[firstElt] = addNewMappingForSelecte(arrayMap, subArray);
				newSelect[beInt.toString()] = addNewMappingForSelecte(newArrayMap, subArray);
			}
			else
			{
				newSelect[firstElt] = "";
				newSelect[beInt.toString()] = "";
			}
		}
		else
		{
			if(arrayMap.length >= 1)
			{
				subArray = true ;
				newSelect[beInt.toString()] = addNewMappingForSelecte(arrayMap, subArray);
			}
			else
			{
				newSelect[beInt.toString()] = "";
			}
		}
	}
	else
	{
		if(arrayMap.length >=1)
		{
			newSelect[firstElt] = addNewMappingForSelecte(arrayMap, true);
		}
		else
		{
			newSelect[firstElt] = "";
		}
	}
	return newSelect ;
}

function callbackNominatimSuccess(obj){
	//console.log("obj" , obj);
	return obj ;
}

function getOptionHTML(arrayOption, objectOption, father)
{
	if(!jQuery.isPlainObject(objectOption))
	{
		arrayOption.push(father);
	}
	else
	{
		$.each(objectOption, function(key, values){
			if(father != "")
				var newfather = father +"."+ key
			else
				var newfather = key
			getOptionHTML(arrayOption, values, newfather);
		});
	}
}

function verifNameSelected(arrayName)
{
	var find = false ; 

	$.each(arrayName, function(key, value){
		var beInt = parseInt(value);
		if(!isNaN(beInt))
		{
			find = true ;
		}
	});

	return find ;
}

function verifBeforeAddSelect(arrayMap)
{
	$('[name=optionLinkCollection]').each(function() {
	  	var option = $(this).val() ;
	  	var position = jQuery.inArray( option, arrayMap);
	  	if(position != -1)
	  		arrayMap.splice(position, 1);
		//console.log("option", option);
	});
}

function autoCompleteInviteSearch(search){
	tabObject = [];

	var data = { 
		"search" : search,
		"searchMode" : "personOnly"
	};
	var urlurl = baseUrl+"/communecter/search/searchmemberautocomplete" ;
	console.log("url", urlurl);

	ajaxPost("", urlurl, data,
		function (data){
			var str = "<li class='li-dropdown-scope'><a href='javascript:newInvitation()'>Pas trouvé ? Lancer une invitation à rejoindre votre réseau !</li>";
			var compt = 0;
			var city, postalCode = "";
			$.each(data["citoyens"], function(k, v) { 
				city = "";
				postalCode = "";
				var htmlIco ="<i class='fa fa-user fa-2x'></i>"
				if(v.id != userId) {
					tabObject.push(v);
	 				if(v.profilImageUrl != ""){
	 					var htmlIco= "<img width='50' height='50' alt='image' class='img-circle' src='"+baseUrl+v.profilImageUrl+"'/>"
	 				}
	 				if (v.address != null) {
	 					city = v.address.addressLocality;
	 					postalCode = v.address.postalCode;
	 				}
	  				str += 	"<li class='li-dropdown-scope'>" +
	  						"<a href='javascript:selectPeopleForLink("+compt+")'>"+htmlIco+" "+v.name + 
	  						"<span class='city-search'> "+postalCode+" "+city+"</span>"+"</a>"+
	  						"</li>";
	  				compt++;
  				}
			});
			console.log("str : ", str);
			$("#dropdown_searchInvite").html(str);
			$("#dropdown_searchInvite").css({"display" : "inline" });
		}
	);	
}


function selectPeopleForLink(num){

	var person = tabObject[num];
	var personId = person["id"];

	console.log(person, personId, person["name"]);
	$("#memberId").html(personId);
	$("#namePeople").html(person["name"]);
	$("#dropdown_searchInvite").css({"display" : "none" });	
	
}

</script>