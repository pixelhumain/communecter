<?php
$cs = Yii::app()->getClientScript();
$cssAnsScriptFilesModule = array(
		'/plugins/jsonview/jquery.jsonview.js',
		'/plugins/jsonview/jquery.jsonview.css',
		//'/assets/js/sig/geoloc.js',
		/*'/assets/js/dataHelpers.js',
		'/assets/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
		'/assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js'*/
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule,Yii::app()->request->baseUrl);


$userId = Yii::app()->session["userId"] ;
?>

<style>
	.bg-azure-light-1{
		background-color: rgba(43, 176, 198, 0.3) !important;
	}
	.bg-azure-light-2{
		background-color: rgba(43, 176, 198, 0.7) !important;
	}
	.bg-azure-light-3{
		background-color: rgba(42, 135, 155, 0.8) !important;
	}

	.menu-step-tsr div{
		margin-left: 20px;
	    font-size: 18px;
	    width: 15%;
	    text-align: center;
	    display: inline-block;
	    margin-top:15px;
	    margin-bottom:5px;
	}
	.menu-step-tsr div.homestead{
		font-size:12px;
	}
	.menu-step-tsr div.selected {
	    border-bottom: 7px solid white;
	}

	.block-step-tsr div{
		font-size: 18px;
	    text-align: center;
	    display: inline-block;
	    margin-top:15px;
	    margin-bottom:15px;
	}

	.mapping-step-tsr{
	    display: inline-block;
	    margin-top:15px;
	    margin-bottom:15px;
	}

	.nbFile{
	    font-size: 18px;
	}
</style>
<div class="panel panel-white">

	<!-- HEADER -->
	<div class="col-md-12 center bg-azure-light-3 menu-step-tsr section-tsr center">
		<div class="homestead text-white selected" id="menu-step-1">
			<i class="fa fa-2x fa-circle"></i><br/><?php echo Yii::t("common", "Source"); ?>
		</div>
		<div class="homestead text-white" id="menu-step-2">
			<i class="fa fa-2x fa-circle-o"></i><br/><?php echo Yii::t("common", "Link"); ?>
			
		</div>
		<div class="homestead text-white" id="menu-step-3">
			<i class="fa fa-2x fa-circle-o"></i><br/><?php echo Yii::t("common", "Visualisation"); ?>
		</div>
	</div>

	<!-- SOURCE -->
	<div class="col-sm-12 block-step-tsr section-tsr" id="menu-step-source">
		<div class="col-sm-4 col-xs-12">
			<label for="chooseElement"><?php echo Yii::t("common", "Element"); ?> : </label>
			<select id="chooseElement" name="chooseElement" class="">
				<option value="-1"><?php echo Yii::t("common", "Choose"); ?></option>
				<option value="<?php echo Organization::COLLECTION; ?>"><?php echo Yii::t("common", "Organization"); ?></option>
				<option value="<?php echo Project::COLLECTION; ?>"><?php echo Yii::t("common", "Project"); ?></option>
				<option value="<?php echo Event::COLLECTION; ?>"><?php echo Yii::t("common", "Event"); ?></option>
				<option value="<?php echo Person::COLLECTION; ?>"><?php echo Yii::t("common", "Person"); ?></option>
			</select>
		</div>
		<div class="col-sm-4 col-xs-12">
			<label for="selectTypeSource"><?php echo Yii::t("common", "Source"); ?> : </label>
			<select id="selectTypeSource" name="selectTypeSource" class="">
				<option value="-1"><?php echo Yii::t("common", "Choose"); ?></option>
				<option value="url"><?php echo Yii::t("common", "URL"); ?></option>
				<option value="file"><?php echo Yii::t("common", "File"); ?></option>
			</select>
		</div>
		<div class="col-sm-4 col-xs-12">
			<label for="selectTypeSource"><?php echo Yii::t("common", "Link"); ?> : </label>
			<select id="chooseMapping" name="chooseMapping" class="">
				<option value="-1"><?php echo Yii::t("common", "Not link"); ?></option>
			<?php
				if(!empty($allMappings)){
					foreach ($allMappings as $key => $value){
						echo '<option value="'.$key .'">'.$value["name"].'</option>';
					}
				}
			?>
			</select>
		</div>
		<div id="divFile" class="col-sm-12 col-xs-12">
			<div class="col-sm-2 col-xs-12">
				<label for="fileImport"><?php echo Yii::t("common", "File (CSV, JSON)"); ?> : </label>
			</div>
			<div class="col-sm-4 col-xs-12" id="divInputFile">
				<input type="file" id="fileImport" name="fileImport" accept=".csv,.json,.js,.geojson">
			</div>
		</div>
		<div id="divUrl" class="col-sm-12 col-xs-12">
			<div class="col-sm-4 col-xs-12">
				<label for="textUrl"><?php echo Yii::t("common", "URL (JSON)"); ?> :</label>
				<input type="text" id="textUrl" name="textUrl" value="">
			</div>
			<div class="col-sm-4 col-xs-12">
				<label for="pathElement"><?php echo Yii::t("common", "Path Elements"); ?> :</label>
				<input type="text" id="pathElement" name="pathElement" value="">
			</div>
		</div>
		<div id="divCsv" class="col-sm-12 col-xs-12">
			<div class="col-sm-4 col-xs-12">
				<label for="selectSeparateur"><?php echo Yii::t("common", "Séparateur"); ?> : </label>
				<select id="selectSeparateur" name="selectSeparateur" class="">
					<option value=";"><?php echo Yii::t("common", "Semicolon"); ?></option>
					<option value=","><?php echo Yii::t("common", "Comma"); ?></option>
					<option value=" "><?php echo Yii::t("common", "Space"); ?></option>
				</select>
			</div>
			<div class="col-sm-4 col-xs-12">
				<label for="selectSeparateurText"><?php echo Yii::t("common", "Separateur de Text"); ?> : </label>
				<select id="selectSeparateurText" name="selectSeparateur" class="">
					<option value=""><?php echo Yii::t("common", "Nothing"); ?></option>
					<option value='"'><?php echo Yii::t("common", "Quotation marks"); ?></option>
					<option value="'"><?php echo Yii::t("common", "Quotes"); ?></option>
				</select>
			</div>
		</div>
		<div class="col-sm-12 col-xs-12">
			<a href="javascript:;" id="btnNextStep" class="btn btn-success margin-top-15"><?php echo Yii::t("common", "Next step"); ?></a>
		</div>
	</div>

	<!-- MAPPING -->
	<div class="col-md-12 mapping-step-tsr section-tsr" id="menu-step-mapping">
		<input type="hidden" id="nbLigneMapping" value="0"/>
		<div class="col-md-12 nbFile text-dark" >
			Il y a <span id="nbFileMapping" class="text-red"> <span> 
		</div>
		<div id="divInputHidden"></div>
		<table id="tabcreatemapping" class="table table-striped table-bordered table-hover">
    		<thead>
	    		<tr>
	    			<th class="col-sm-5"><?php echo Yii::t("common", "Source"); ?></th>
	    			<th class="col-sm-5"><?php echo Yii::t("common", "Communecter"); ?></th>
	    			<th class="col-sm-2"><?php echo Yii::t("common", "Add")." / ".Yii::t("common", "Remove"); ?></th>
	    		</tr>
    		</thead>
	    	<tbody class="directoryLines" id="bodyCreateMapping">
		    	<tr id="LineAddMapping">
	    			<td>
	    				<select id="selectSource" class="col-sm-12"></select>
	    			</td>
	    			<td>
	    				<select id="selectAttributesElt" class="col-sm-12"></select>
	    			</td>
	    			<td>
	    				<input type="submit" id="addMapping" class="btn btn-primary col-sm-12" value="Ajouter"/>
	    			</td>
				</tr>
			</tbody>
		</table>
		<div class="col-sm-12 col-xs-12">
			<div class="col-sm-6 col-xs-12">
				<label for="inputKey">Key : </label>
				<input class="" placeholder="Key a attribuer à l'ensemble des données importer" id="inputKey" name="inputKey" value="">
			</div>
			<!--<div class="col-sm-6 col-xs-12" id="divCheckboxWarnings">
				<label>
					Warnings : <input type="checkbox" value="" id="checkboxWarnings" name="checkboxWarnings">
				</label>
			</div>-->
		</div>
		<div class="col-sm-12 col-xs-12">
			<div class="col-sm-6 col-xs-12">
				<label>
					Test : <input class="hide" id="isTest" name="isTest" ></input>
				<input id="checkboxTest" name="checkboxTest" type="checkbox" data-on-text="<?php echo Yii::t("common","Yes") ?>" data-off-text="<?php echo Yii::t("common","No") ?>" name="my-checkbox" checked></input>
				</label>
			</div>
			<div class="col-sm-6 col-xs-12" id="divNbTest">
				<label for="inputNbTest">Nombre d'entités à tester max(900) : </label>
				<input class="" placeholder="" id="inputNbTest" name="inputNbTest" value="5">
			</div>
		</div>
		<div class="col-sm-2 col-xs-12"  id="divInvite">
			<div class="col-sm-12 col-xs-12" id="divAuthor">
				<label for="nameInvitor">Author Invite: </label>
				<input class="" placeholder="" id="nameInvitor" name="nameInvitor" value="">
			</div>
			<div class="col-sm-12 col-xs-12" id="divMessage">
				<textarea id="msgInvite" class="" rows="3">Message Invite</textarea>
			</div>
		</div>
		<div class="col-sm-12 col-xs-12">
			<a href="javascript:;" id="btnPreviousStep" class="btn btn-danger margin-top-15"><?php echo Yii::t("common", "Previous step"); ?></a>
			<a href="javascript:;" id="btnNextStep2" class="btn btn-success margin-top-15"><?php echo Yii::t("common", "Next step"); ?></a>
		</div>
	</div>

	<div class="col-md-12 mapping-step-tsr section-tsr" id="menu-step-visualisation">
		<div class="panel-scroll row-fluid height-300">
			<table id="representation" class="table table-striped table-hover"></table>
		</div>
		<br/>	
		<div class="col-xs-12 col-sm-6">
			<label class="nbFile text-dark">
				Données importés : <span id="nbFileImport" class="text-red"> <span> 
			</label>
			<div class="panel panel-default">
				<div class="panel-body">
					<div id="divJsonImport" class="panel-scroll height-300">
						<input type="hidden" id="jsonImport" value="">
					    <div class="col-sm-12" id="divJsonImportView"></div>
					    
					</div>
				</div>
			</div>
			<div class="col-sm-12 center">
		    	<a href="javascript:;" class="btn btn-primary col-sm-2 col-md-offset-2" type="submit" id="btnImport">Save</a>
		    </div>

		</div>
		<div class="col-xs-12 col-xs-12 col-sm-6">
			<label class="nbFile text-dark">
				Données rejetées : <span id="nbFileError" class="text-red"> <span> 
			</label>
			<div class="panel panel-default">
				<div class="panel-body">
					<div id="divJsonError" class="panel-scroll height-300">
						<input type="hidden" id="jsonError" value="">
					    <div class="col-sm-12" id="divJsonErrorView"></div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-xs-12 center">
		    	<a href="javascript:;" class="btn btn-primary col-sm-2" type="submit" id="btnError">Save</a>
		    </div>
		</div>
		<div class="col-xs-12 col-sm-12">
			<button class="btn btn-danger margin-top-15" onclick="returnStep2()">Retour <i class="fa fa-reply"></i></button>
		</div>
	</div>

</div>

<script type="text/javascript">
var file = [] ;
var csvFile = "" ;
var extensions = ["csv", "json", "js", "geojson"];
var nameFile = "";
var typeFile = "";
var typeElement = "";

jQuery(document).ready(function() {

	setTitle("CreateFile","circle");

	$("#divFile").hide();
	$("#divCsv").hide();
	$("#divUrl").hide();
	$("#menu-step-mapping").hide();
	$("#menu-step-visualisation").hide();
	bindCreateFile();
	bindUpdate();
	
});


function bindCreateFile(){
	$("#selectTypeSource").change( function (){
		var typeSource = $("#selectTypeSource").val();
		if(typeSource == "url"){
			$("#divUrl").show();
			$("#divCsv").hide();
			$("#divFile").hide();
		}	
		else if(typeSource == "file"){
			$("#divUrl").hide();
			$("#divFile").show();
		}else{
			$("#divUrl").hide();
			$("#divFile").hide();
		}	
	});


	$("#btnPreviousStep").off().on('click', function(e){
		returnStep1();
  	});


	$("#btnNextStep").off().on('click', function(e){
		mylog.log($("#selectTypeSource").val(), file.length);
  		if($("#chooseElement").val() == "-1"){
  			toastr.error("Vous devez sélectionner un type d'éléments");
  			return false ;
  		}
  		else if($("#selectTypeSource").val() == "-1"){
  			toastr.error("Vous devez sélectionner une source");
  			return false ;
  		}else if($("#selectTypeSource").val() == "file"){
  			if(file.length == 0 && csvFile.length == 0){
	  			toastr.error("Vous devez sélectionner un fichier.");
	  			return false ;
	  		}
  		}
  		var typeSource = $("#selectTypeSource").val();
  		typeElement = $("#chooseElement").val();

  		if(typeSource == "url"){
			nameFile = "JSON_URL";
  			typeFile = "json";			
			$.ajax({
				url: baseUrl+'/communecter/adminpublic/getdatabyurl/',
				type: 'POST',
				dataType: 'json', 
				data:{ url : $("#textUrl").val() },
				async : false,
				success: function (obj){
					mylog.log('success' , obj);
					file.push(obj.data) ;
					stepTwo();
				},
				error: function (error) {
					mylog.log('error', error);
				}
			});
		}	
		else if(typeSource == "file"){
			stepTwo();
		}	
		
		return false;
  		
  	});


	$("#addMapping").off().on('click', function(){

  		var nbLigneMapping = parseInt($("#nbLigneMapping").val()) + 1;
  		var error = false ;
  		var msgError = "" ;

  		//var selectValueHeadCSV = $("#selectHeadCSV option:selected").text() ;
  		var selectSource = $("#selectSource option:selected").val() ;
  		var selectAttributesElt = $("#selectAttributesElt option:selected").text() ;


  		var inc = 1;
  		while(error == false && inc <= nbLigneMapping){
  			if($("#valueSource"+inc).text() == selectSource ){
  				error = true;
  				msgError += "Vous avez déja ajouter l'éléments de la colonne CSV. "
  			}

  			if($("#valueAttributeElt"+inc).text() == selectAttributesElt){
  				error = true;
  				msgError += "Vous avez déja ajouter l'éléments de la colonne du Mapping. "
  			}
  			inc++;
  		}

  		if(error == false){

  			var attributeEltSplit = selectAttributesElt.split(".");
  			if(verifNameSelected(attributeEltSplit)){
  				var newOptionSelect = addNewMappingForSelecte(attributeEltSplit, false);
	  			var arrayOption = [];
	  			getOptionHTML(arrayOption, newOptionSelect, "");
	  			verifBeforeAddSelect(arrayOption);
	  			chaine = "" ;
	  			$.each(arrayOption, function(key, value){
	  				chaine = chaine + '<option name="optionAttributesElt" values="'+value+'">'+value+'</option>'
	  			});

	  			$("#selectAttributesElt").append(chaine);
  			}  			
	  		ligne = '<tr id="lineMapping'+nbLigneMapping+'"> ';
	  		ligne =	 ligne + '<td id="valueSource'+nbLigneMapping+'">' + selectSource + '</td>';
	  		ligne =	 ligne + '<td id="valueAttributeElt'+nbLigneMapping+'">' + selectAttributesElt + '</td>';
	  		ligne =	 ligne + '<td><input type="hidden" id="idHeadCSV'+nbLigneMapping+'" value="'+ selectSource +'"/><a href="#" class="deleteLineMapping btn btn-danger">X</a></td></tr>';
	  		$("#nbLigneMapping").val(nbLigneMapping);
	  		$("#LineAddMapping").before(ligne);
	  		
	  	}
	  	else
	  	{
	  		toastr.error(msgError);
	  	}

	  	bindUpdate();
  		return false;
  	});

	$(".deleteLineMapping").off().on('click', function(){
  		$(this).parent().parent().remove();
  	});

  	$("#btnNextStep2").off().on('click', function(){
  		processingBlockUi();
		setTimeout(function(){ preStep2(); }, 2000);
  		return false;
  	});


	$("#btnImport").off().on('click', function(){
  		$("<a />", {
		    "download": nameFile+"_StandardForCommunecter.json",
		    "href" : "data:application/json," + encodeURIComponent($('#jsonImport').val())
		  }).appendTo("body")
		  .click(function() {
		     $(this).remove()
		  })[0].click() ;
  	});

  	$("#btnError").off().on('click', function(){
  		$("<a />", {
		    "download": nameFile+"_NotStandardForCommunecter.json",
		    "href" : "data:application/json," + encodeURIComponent($('#jsonError').val())
		  }).appendTo("body")
		  .click(function() {
		     $(this).remove()
		  })[0].click() ;
  	});
}

function preStep2(){
	cleanVisualisation();
		var nbLigneMapping = $("#nbLigneMapping").val();
		var inputKey = $("#inputKey").val().trim();
		var infoCreateData = [] ;

		if(nbLigneMapping == 0){
			toastr.error("Vous devez faire au moins une assignation de données");
			$.unblockUI();
  			return false ;
		}else if(inputKey.length == 0){
			toastr.error("Vous devez ajouter une Key");
			$.unblockUI();
  			return false ;
		}
		else{
			for (i = 0; i <= nbLigneMapping; i++){
	  			if($('#lineMapping'+i).length){
	  				var valuesCreateData = {};
					valuesCreateData['valueAttributeElt'] = $("#valueAttributeElt"+i).text();
					//mylog.log(typeof $("#idHeadCSV"+i).val());
					valuesCreateData['idHeadCSV'] = $("#idHeadCSV"+i).val();
					infoCreateData.push(valuesCreateData);
	  			}	
	  		}
	  		if(infoCreateData != []){	
	  			
	  			var params = {
	        		infoCreateData : infoCreateData, 
	        		typeElement : typeElement,
	        		nameFile : nameFile,
	        		typeFile : typeFile,
	        		pathObject : $('#pathObject').val(),
			        key : inputKey,
			        warnings : $("#checkboxWarnings").is(':checked')
			    }

			    if(typeElement == "<?php echo Person::COLLECTION;?>"){
			    	params["msgInvite"] = $("#msgInvite").val();
					params["nameInvitor"] = $("#nameInvitor").val();
				}

	  			if($("#checkboxTest").is(':checked')){
	  				if(typeFile == "csv"){
	  					//mylog.log("inputNbTest", $("#inputNbTest").val());
	  					var subFile = file.slice(0,parseInt($("#inputNbTest").val())+1);
	  					params["file"] = subFile;
	  				}
			  		else if(typeFile == "json" || typeFile == "js" || typeFile == "geojson"){
			  			params["file"] = file;
			  			params["nbTest"] = $("#inputNbTest").val();
			  		}
	  				//mylog.log(params);
		  			stepThree(params);
		  			showStep3();

	  			}else{
	  				//mylog.log("Here");
	  				if(typeFile == "csv"){
	  					var fin = false ;
				  		var indexStart = 1 ;
				  		var limit = 30 ;
				  		var indexEnd = limit;
				  		var head = file.slice(0,1);


				  		while(fin == false){
				  			subFile = head.concat(file.slice(indexStart,indexEnd));
				  			mylog.log("subFile", subFile.length);
				  			params["file"] = subFile;

				  			stepThree(params);

							indexStart = indexEnd ;
				  			indexEnd = indexEnd + limit;
				  			if(indexStart > file.length)
				  				fin = true ;
				  		}
				  		showStep3();
	  				}
			  		else if(typeFile == "json" || typeFile == "js" || typeFile== "geojson"){
			  			params["file"] = file;
				  		stepThree(params);
				  		showStep3();
			  		}
	  			}
	  		}
	  		else{
				$.unblockUI();
				toastr.error("Vous devez ajouter des éléments au mapping.");
			}
		}
}

function stepTwo(){
	mylog.log("stepTwo", typeFile, typeElement);
	var params = {
		typeElement : typeElement,
		typeFile : typeFile,
		idMapping : $("#chooseMapping").val(),
		path : $("#pathElement").val()
	};

	if(typeFile == "json" || typeFile == "js" || typeFile == "geojson")
		params["file"] = file ;
	else
		file = csvToArray(csvFile, $("#selectSeparateur").val(), $("#selectSeparateurText").val())

	$.ajax({
        type: 'POST',
        data: params,
        url: baseUrl+'/communecter/adminpublic/assigndata/',
        dataType : 'json',
        async : false,
        success: function(data)
        {
        	mylog.log("stepTwo data",data);
        	if(data.result){
        		createStepTwo(data);
        	}
        	else{

        	}

        }
	});
}
function bindUpdate(data){
	$(".deleteLineMapping").off().on('click', function(){
  		$(this).parent().parent().remove();
  	});

  	$("#fileImport").change(function(e) {
    	var nameFileSplit = $("#fileImport").val().split("."); 
  		if(extensions.indexOf(nameFileSplit[nameFileSplit.length-1]) == -1){
  			toastr.error("Vous devez sélectionner un fichier en CSV ou JSON");
  			return false ;
  		}
  		nameFile = nameFileSplit[0];
		typeFile = nameFileSplit[nameFileSplit.length-1];

		if(extensions.indexOf(typeFile) == -1) {
			alert('Upload CSV or JSON');
			return false;
		}
		file = [];		
		if (e.target.files != undefined) {
			var reader = new FileReader();
			reader.onload = function(e) {
				if(typeFile == "csv"){
					//var csvval=e.target.result.split("\n");
					csvFile = e.target.result;
					//mylog.log("csv : ", csvval );
					/*$.each(csvval, function(key, value){
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
		  			});*/
		  			$("#divCsv").show();
				}
				else if(typeFile == "json" || typeFile == "js" || typeFile == "geojson") {
					$("#divCsv").hide();
					file.push(e.target.result);
	  			}
			};
			reader.readAsText(e.target.files.item(0));
		}
		return false;
	});
}

function createStepTwo(data){

	mylog.log("createStepTwo");
	var chaineSelectCSVHidden = "" ;
	if(data.typeFile == "csv"){
		$("#nbFileMapping").html(file.length - 1 + " éléments");
		$.each(file[0], function(key, value){
			chaineSelectCSVHidden += '<option value="'+value+'">'+value+'</option>';
		});
	}else if(data.typeFile == "json"){
		$("#nbFileMapping").html(data.nbElement  + " éléments");
		$.each(data.arbre, function(key, value){
			chaineSelectCSVHidden += '<option value="'+value+'">'+value+'</option>';
		});
	}
	$("#selectSource").html(chaineSelectCSVHidden);

	chaineAttributesElt = "" ;
	$.each(data.attributesElt, function(key, value){
		chaineAttributesElt += '<option name="optionAttributesElt" value="' + value+'">'+value+'</option>';
	});

	$("#selectAttributesElt").html(chaineAttributesElt);

	if(typeElement != "<?php echo Organization::COLLECTION;?>")
		$("#divCheckboxWarnings").hide();

	if(typeElement != "<?php echo Person::COLLECTION;?>")
		$("#divInvite").hide();
	
	if(typeof data.arrayMapping != "undefined"){
		var nbLigneMapping = $("#nbLigneMapping").val();
		var i = 0 ;
		$.each(data.arrayMapping, function(key, value){
			ligne = '<tr id="lineMapping'+nbLigneMapping+'"> ';
	  		ligne =	 ligne + '<td id="valueSource'+nbLigneMapping+'">' + key + '</td>';
	  		ligne =	 ligne + '<td id="valueAttributeElt'+nbLigneMapping+'">' + value + '</td>';
	  		ligne =	 ligne + '<td><input type="hidden" id="idHeadCSV'+nbLigneMapping+'" value="'+ key +'"/><a href="#" class="deleteLineMapping btn btn-danger">X</a></td></tr>';
	  		nbLigneMapping++;
	  		$("#LineAddMapping").before(ligne);
	  		i++;

		});
		$("#nbLigneMapping").val(nbLigneMapping);
	}

	bindUpdate();
	displayStepTwo();
}

function verifNameSelected(arrayName){
	var find = false ; 
	$.each(arrayName, function(key, value){
		var beInt = parseInt(value);
		if(!isNaN(beInt)){
			find = true ;
		}
	});
	return find ;
}

function displayStepTwo(){
	mylog.log("showStep2")
	$('#menu-step-2 i.fa').removeClass("fa-circle-o").addClass("fa-circle");
	$('#menu-step-1 i.fa').removeClass("fa-circle").addClass("fa-check-circle");
	$('#menu-step-1').removeClass("selected");
	$('#menu-step-2').addClass("selected");
	$("#menu-step-mapping").show(400);
	$("#menu-step-source").hide(400);
	$("#menu-step-visualisation").hide(400);
}


function showStep3(){
	mylog.log("showStep3");
	$('#menu-step-3 i.fa').removeClass("fa-circle-o").addClass("fa-circle");
	$('#menu-step-2 i.fa').removeClass("fa-circle").addClass("fa-check-circle");
	$('#menu-step-2').removeClass("selected");
	$('#menu-step-3').addClass("selected");
	$("#menu-step-mapping").hide(400);
	$("#menu-step-source").hide(400);
	$("#menu-step-visualisation").show(400);
	//alert("hello");
	$.unblockUI();
}

function returnStep2(){
	mylog.log("returnStep2")
	$('#menu-step-3 i.fa').removeClass("fa-circle").addClass("fa-circle-o");
	$('#menu-step-2 i.fa').removeClass("fa-check-circle").addClass("fa-circle");
	$('#menu-step-3').removeClass("selected");
	$('#menu-step-2').addClass("selected");
	$("#menu-step-mapping").show(400);
	$("#menu-step-source").hide(400);
	$("#menu-step-visualisation").hide(400);
}

function returnStep1(){
	mylog.log("returnStep2")
	file = [] ;
	nameFile = "";
	typeFile = "";
	typeElement = "";
	$('#divInputFile').html('<input type="file" id="fileImport" name="fileImport" accept=".csv,.json,.js,.geojson">')
	$('#menu-step-1 i.fa').removeClass("fa-circle-o").addClass("fa-circle");
	$('#menu-step-2 i.fa').removeClass("fa-circle").addClass("fa-circle-o");
	$('#menu-step-2').removeClass("selected");
	$('#menu-step-1').addClass("selected");
	$("#menu-step-mapping").hide(400);
	$("#menu-step-source").show(400);
	$("#menu-step-visualisation").hide(400);
	bindUpdate();
}

function addNewMappingForSelecte(arrayMap, subArray){
	var firstElt = arrayMap[0] ;
	arrayMap.shift();
	var beInt = parseInt(firstElt);
	var newSelect = {} ;

	if(!isNaN(beInt)){
		beInt++;
		if(subArray){	
			if(arrayMap.length >= 1){
				var newArrayMap = jQuery.extend([], arrayMap);
				newSelect[firstElt] = addNewMappingForSelecte(arrayMap, subArray);
				newSelect[beInt.toString()] = addNewMappingForSelecte(newArrayMap, subArray);
			}
			else{
				newSelect[firstElt] = "";
				newSelect[beInt.toString()] = "";
			}
		}
		else{
			if(arrayMap.length >= 1){
				subArray = true ;
				newSelect[beInt.toString()] = addNewMappingForSelecte(arrayMap, subArray);
			}
			else{
				newSelect[beInt.toString()] = "";
			}
		}
	}
	else{
		if(arrayMap.length >=1){
			newSelect[firstElt] = addNewMappingForSelecte(arrayMap, true);
		}
		else{
			newSelect[firstElt] = "";
		}
	}
	return newSelect ;
}

function getOptionHTML(arrayOption, objectOption, father)
{
	if(!jQuery.isPlainObject(objectOption)){
		arrayOption.push(father);
	}
	else{
		$.each(objectOption, function(key, values){
			if(father != "")
				var newfather = father +"."+ key
			else
				var newfather = key
			getOptionHTML(arrayOption, values, newfather);
		});
	}
}

function verifBeforeAddSelect(arrayMap)
{
	$('[name=optionAttributesElt]').each(function() {
	  	var option = $(this).val() ;
	  	var position = jQuery.inArray( option, arrayMap);
	  	if(position != -1)
	  		arrayMap.splice(position, 1);
		//mylog.log("option", option);
	});
}

function cleanVisualisation(){
	$("#representation").html("");
	$("#jsonImport").val("");
    $("#jsonError").val("");
}

function createInpu(nameFile, typeFile, typeElement){
	var chaineInputHidden = '<input type="hidden" id="typeElement" value="' + typeElement + '"/>';
	chaineInputHidden += '<input type="hidden" id="nameFile" value="'+nameFile+'"/>';
	chaineInputHidden += '<input type="hidden" id="typeFile" value="'+typeFile+'"/>';
	$("#divInputHidden").html(chaineInputHidden);
}


function stepThree(params){
	$.ajax({
        type: 'POST',
        data: params,
        url: baseUrl+'/communecter/adminpublic/previewData/',
        dataType : 'json',
        async : false,
        success: function(data)
        {
        	mylog.log("stepThree data",data);
        	if(data.result){
        		
        		var importD = "" ;
        		var errorD = "" ;

        		if($("#jsonImport").val() == "")
        			importD = data.elements;
        		else{
        			if(data.elements == "[]")
        				importD = $("#jsonImport").val();
        			else{
        				var elt1 = jQuery.parseJSON($("#jsonImport").val());
        				var elt2 = jQuery.parseJSON(data.elements);
        				$.each(elt2, function(key, val){
		        			elt1.push(val)
		        		});
        				importD = JSON.stringify(elt1);
        			}

        		}
        		
        		if($("#jsonError").val() == "")
        			errorD = data.elementsWarnings;
        		else{
        			if(data.elementsWarnings == "[]")
        				errorD = $("#jsonError").val();
        			else
        				var elt1E = jQuery.parseJSON($("#jsonError").val());
        				var elt2E = jQuery.parseJSON(data.elementsWarnings);
        				$.each(elt2E, function(key, val){
		        			elt1E.push(val)
		        		});
        				errorD = JSON.stringify(elt1E);
        		}

        		
        		mylog.log("importD",typeof importD);		
        		mylog.log("errorD",typeof errorD);

        		$("#jsonImport").val(importD);
        		$("#jsonError").val(errorD);
        		$("#divJsonImportView").JSONView(importD);
        		$("#divJsonErrorView").JSONView(errorD);

				
				var chaine = "" ;
        		$.each(data.listEntite, function(keyListEntite, valueListEntite){
        			chaine += "<tr>" ;
        			if(keyListEntite == 0)
        			{
        				$.each(valueListEntite, function(key, value){
        					chaine += "<th>"+value+"</th>";
        				});
        			}else{
						$.each(valueListEntite, function(key, value){
        					chaine += "<td>"+value+"</td>";
        				});
        			}
        			chaine += "</tr>" ;
        		});
        		$("#representation").append(chaine);


        		$("#nbFileImport").html(jQuery.parseJSON(importD).length);
        		$("#nbFileError").html(jQuery.parseJSON(errorD).length);

        		if($("#checkboxTest").is(':checked')){
        			$("#btnImport").hide();
        			$("#btnError").hide();
        		}else{
        			$("#btnImport").show();
        			$("#btnError").show();
        		}
        		//$("#verifBeforeImport").show();
        	}
        }
    });
}


</script>