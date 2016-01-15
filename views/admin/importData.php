<?php
$cs = Yii::app()->getClientScript();
if(!Yii::app()->request->isAjaxRequest)
{
	$cssAnsScriptFilesModule = array(
		'/assets/plugins/jsonview/jquery.jsonview.js',
		'/assets/plugins/jsonview/jquery.jsonview.css'
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
			<form id="formfile" method="POST" action="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/tools/importData/';?>" enctype="multipart/form-data">
				<div class="col-sm-3 col-xs-12">
					<label for="chooseCollection">Collection : </label>
					<?php
						$params = array();
						$fields = array("_id", "key");
						$listCollection = ImportData::getMicroFormats($params, $fields);
					?>
					<select id="chooseCollection" name="chooseCollection">
						<?php
							foreach ($listCollection as $key => $value) {
								echo '<option value="'.$value['_id']->{'$id'}.'">'.$value['key'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="col-sm-3 col-xs-12">
					<label for="fileImport">Fichier (csv) :</label>
					<input type="file" id="fileImport" name="fileImport" accept=".csv">
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
			<div class="col-sm-12 col-xs-12">
				<label for="subFile">Fichier : </label>
				<select id="subFile">
					<?php
						if($createLink)
						{
							$arrayNameFile = explode(".", $nameFile);
							$subfiles = scandir("../../modules/cityData/filesImportData/".$arrayNameFile[0]);
							foreach ($subfiles as $key => $value){
				                if(strpos($value, $arrayNameFile[0]) !== false) 
				                	echo '<option value="'.$value.'">'.$value.'</option>';
				            }
				        }
					?>
				</select>
				
			</div>
			<br/> <br/>
			<div class="col-sm-12 col-xs-12">
				<div class="col-sm-4 col-xs-12">
					<label for="selectRole">Role : </label>
					<select id="selectRole">
						<option value="creator">Creator</option>
						<option value="admin">Admin</option>
						<option value="member">Member</option>
					</select>
				</div>
				<div id="divSearchMember">
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
				</div>
			</div>
			<br/> <br/>
			<div id="divtab" class="table-responsive">
				<input type="hidden" id="nbLigneMapping" value="0"/>
				<?php
					if($createLink)
					{

						echo '<input type="hidden" id="idCollection" value="'.$idCollection.'"/>';
						echo '<input type="hidden" id="nameFile" value="'.$arrayNameFile[0].'"/>';
						echo '<input type="hidden" id="jsonCSV" value="'.json_encode($arrayCSV).'"/>';
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
			    						if($createLink)
			    						{
			    							foreach ($arrayCSV[0] as $key => $value) 
											{
												echo '<option value="'.$key.'">'.$value.'</option>' ;
											}
			    						}
			    					?>
			    				</select>
			    			</td>
			    			<td>
			    				<select id="selectLinkCollection" class="col-sm-12">
									<?php
			    						if($createLink)
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
			<div class="col-md-5 col-md-offset-5">
				<a href="#" class="btn btn-primary col-md-3" type="submit" id="sumitGeo">GeoLocalisation</a>
				<a href="#" class="btn btn-primary col-md-3" type="submit" id="sumitImport">Import</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
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
	$("#divSearchMember").hide();

});

function bindEvents()
{

	$('#inviteSearch').keyup(function(e){
	    var search = $('#inviteSearch').val();
	    if(search.length>2){
	    	clearTimeout(timeout);
			timeout = setTimeout('autoCompleteInviteSearch("'+encodeURI(search)+'")', 500); 
		 }else{
		 	$("#dropdown_searchInvite").css({"display" : "none" });	
		 }	
	});

	$("#selectRole").change( function (){
		var role = $("#selectRole").val();
		if(role == "creator")
		{
			$("#divSearchMember").hide();
			$("#memberId").html(userId);
		}	
		else
			$("#divSearchMember").show();
	});


	$("#addMapping").off().on('click', function()
  	{
  		var nbLigneMapping = parseInt($("#nbLigneMapping").val()) + 1;
  		var inc = 1;
  		var error = false ;
  		var msgError = "" ;

  		var selectValueHeadCSV = $("#selectHeadCSV option:selected").text() ;
  		var selectIdHeadCSV = $("#selectHeadCSV option:selected").val() ;
  		var selectLinkCollection = $("#selectLinkCollection option:selected").text() ;

  		while(error == false && inc <= nbLigneMapping)
  		{
  			if($("#valueheadCSV"+inc).text() == selectValueHeadCSV || $("#labelMapping"+inc).text() == selectLinkCollection)
  			{
  				error = true;
  				msgError = "Vous avez déja ajouter un des éléments."
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
	  			//console.log("arrayOption", arrayOption);
	  			verifBeforeAddSelect(arrayOption);
	  			chaine = "" ;
	  			$.each(arrayOption, function(key, value){
	  				chaine = chaine + '<option name="optionLinkCollection" values="'+value+'">'+value+'</option>'
	  			});

	  			$("#selectLinkCollection").append(chaine);
  			}

  			

  			
	  		ligne = '<tr id="lineMapping'+nbLigneMapping+'"> ';
	  		ligne =	 ligne + '<td id="valueHeadCSV'+nbLigneMapping+'"><input type="hidden" id="idHeadCSV'+nbLigneMapping+'" value="'+ selectIdHeadCSV +'"/>' + selectValueHeadCSV + '</td>';
	  		ligne =	 ligne + '<td id="valueLinkCollection'+nbLigneMapping+'">' + selectLinkCollection + '</td>';
	  		ligne =	 ligne + '<td><a href="#" class="deleteLineMapping btn btn-primary">X</a></td></tr>';
	  		$("#nbLigneMapping").val(nbLigneMapping);
	  		$("#LineAddMapping").before(ligne);
	  		bindEvents();
	  	}
	  	else
	  	{
	  		toastr.error(msgError);
	  	}
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
		});*/
		var nbLigneMapping = $("#nbLigneMapping").val();
		var infoCreateData = [] ;

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

  		if(infoCreateData != [])
  		{
  			$.ajax({
		        type: 'POST',
		        data: {
		        		infoCreateData : infoCreateData, 
		        		idCollection : $("#idCollection").val(),
		        		jsonCSV :  $("#jsonCSV").val(),
		        		subFile : $("#subFile").val(),
		        		nameFile : $("#nameFile").val(),
		        		role : $("#selectRole").val()
		        },
		        url: baseUrl+'/tools/previewData/',
		        dataType : 'json',
		        success: function(data)
		        {
		        	console.log("data",data);
		        	if(data.result)
		        	{
		        		//console.log("data",data);
		        		$("#divJsonImportView").JSONView(data.jsonImport);
		        		$("#jsonImport").val(data.jsonImport);
		        		$("#divJsonErrorView").JSONView(data.jsonError);
		        		$("#jsonError").val(data.jsonError);
		        		$("#verifBeforeImport").show();
		        	}
		        }
		    });
  		}
  		else
		{
			toastr.error("Vous devez ajouter des éléments au mapping.");
		}
  		console.log("infoCreateData", infoCreateData);
  		return false;
  	});


	$("#sumitImport").off().on('click', function()
  	{
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
	        		memberId : $('#memberId').html()},
	        url: baseUrl+'/tools/importmongo2/',
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
  		var json = jQuery.parseJSON($('#jsonImport').val()) ;
  		console.log("here", json);
  		$.each( json, function( key, org ) {
			$.each( json, function( org, orgVal ) {
		    	console.log("Address", orgVal.address);
		    	// ICI TRISTAN
		    	// Tu peux appeler ta fonction avec nominatime 
		    	// orgVal.address :  te donne un objet de type { "streetAddress" : "...", "codePstal" : "..." , ...}
		  		
		  		//fonction appelé lorsque le résultat nominatim est trouvé dans findGeoposByNominatim(address) (sig/geoloc.js l.109)
		  		function callbackNominatimSuccess(obj){
		  			console.dir(obj);
		  		}

		  		//remplace les espaces par des +
		  		var address = transformNominatimUrl(orgVal.address);
		  		//lance la requette nominatim (sig/geoloc.js l.109)
				findGeoposByNominatim(address);

		  	});
		});
  	});
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