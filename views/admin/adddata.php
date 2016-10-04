<?php
$cs = Yii::app()->getClientScript();
$cssAnsScriptFilesModule = array(
		'/assets/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
		'/assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
$cssAnsScriptFilesModule = array(
	'/js/default/directory.js',
);
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
$userId = Yii::app()->session["userId"] ;
?>
<style>
	.dropdown-menu{
		width: 100%;
	}
	.btn-add-to-directory{
		font-size: 14px;
		margin-right: 0px;
		border-radius: 6px;
		color: #666;
		border: 1px solid rgba(188, 185, 185, 0.69);
		margin-left: 3px;
		float: left;
		padding: 1px;
		width: 24px;
		margin-top: 15px;
	}
  .img-logo {
    height: 290px;
  }
  .btn-filter-type{
    height:35px;
    border-bottom: 3px solid transparent;
  }
  .btn-filter-type.active{
    height:35px;
    border-bottom: 3px solid #383f4e;
  }
  .btn-filter-type:hover{
    height:35px;
    border-bottom: 3px solid #383f4e;
  }
  .btn-scope{
    display: inline;
  }
  .lbl-scope-list {
    top: 255px;
  }
  .btn-tag{
    font-weight:300;
    padding-left: 0px;
  }
  .btn-tag.bold{
    font-weight:600;
  }
  	.searchEntity{
	    padding: 10px;
	}
  	.searchEntity:hover{
	    background-color: #d9d9d9;
	}
  
  @media screen and (max-width: 1024px) {
    #menu-directory-type .hidden-sm{
     display:none;
    }
  }

@media screen and (max-width: 767px) {
  .searchEntity{
        /*margin-left: 25px !important;*/
  }
  	
	  #searchBarText{
    font-size:13px !important;
    margin-right:-30px;
  }
  /*.btn-add-to-directory {
      position: absolute;
      right: 0px;
      z-index:9px !important;
  }*/
}

</style>

<div class="col-md-12 no-padding " style="margin-top:25px;">
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
		<label for="fileImport">Fichier JSON :</label>
		<input type="file" id="fileImport" name="fileImport" accept=".json,.js">
	</div>
	<div class="col-xs-12">
		<div class="col-sm-12 col-xs-12">
			<label for="pathFolderImage">Path dossier image :</label>
			<input type="text" id="pathFolderImage" name="pathFolderImage" value="">
		</div>	
	</div>
	<div class="col-xs-12">
		<label for="checkboxLink">Lier les entités : <input class="hide" id="isLink" name="isLink"></input></label>
		<input id="checkboxLink" name="checkboxLink" type="checkbox" data-on-text="<?php echo Yii::t("common","Yes") ?>" data-off-text="<?php echo Yii::t("common","No") ?>"></input>
		<br/>
		<select id="chooseElementLink" name="chooseElementLink" class="">
			<option value="<?php echo Person::COLLECTION; ?>"><?php echo Yii::t("common", "Person"); ?></option>
			<option value="<?php echo Organization::COLLECTION; ?>"><?php echo Yii::t("common", "Organization"); ?></option>
		</select>
		<br/>
		<div id="searchLink" class="input-group margin-bottom-10 col-md-8 col-sm-8 col-xs-8 pull-left">
			<input id="searchBarText" data-searchPage="true" type="text" placeholder="Chercher le citoyen ou l'organisation pour lier les données importer" class="input-search form-control">
			<span class="input-group-btn">
	            <!--<button class="btn btn-success btn-start-search tooltips" id="btn-start-search"
	                    data-toggle="tooltip" data-placement="top" title="Actualiser les résultats">
	                    <i class="fa fa-refresh"></i>
	            </button>-->
	            <a href="javascript:;" class="btn btn-success btn-start-search tooltips" id="btn-start-search">
	            	<i class="fa fa-refresh"></i>
	           	</a>
	      	</span>
	      	<ul class="dropdown-menu" id="dropdown_searchInvite" style="">
				<li class="li-dropdown-scope">-</li>
			</ul>
		</div>
		<div id="resultSearchEntity" class='col-md-12 no-padding hidden' onclick='addElementLink("name","name")'>
			<div id="imgSearchEntity" class='col-md-2 col-sm-2 col-xs-3 entityCenter no-padding'></div>
			<div class='col-md-8 col-sm-9 col-xs-6 entityRight no-padding'>
				<span id="nameSearchEntity" class='entityName text-dark'></span>
				<input type="hidden" id="idSearchEntity" value=""/>
	        </div>
		</div>

	</div>
	<div style="" class="col-xs-12 margin-top-15" id="dropdown_search"></div>

	<div class="col-xs-12">
		<div class="col-sm-5 col-xs-12">
			<a href="#" class="btn btn-primary col-sm-3" id="sumitVerification">Vérification</a>
		</div>
	</div>

	<div id="createLink">
		<div class="panel-heading border-light">
			<h4 class="panel-title">Résultat</h4>
		</div>
		<div class="panel-body">
			<div id="divtab" class="table-responsive">
				<table id="tabcreatemapping" class="table table-striped table-bordered table-hover">
		    		<thead>
			    		<tr>
			    			<th class="col-sm-5">Entité</th>
			    			<th class="col-sm-5">Result</th>
			    		</tr>
		    		</thead>
			    	<tbody class="directoryLines" id="bodyResult">
				    	
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
</div>

		
	
	


<script type="text/javascript">
var file = "";
var searchType = [ "persons" ];
jQuery(document).ready(function() 
{
	$("#divLink").hide();
	loadingData = false;
	$("#dropdown_searchInvite").css({"display" : "none" });
	bindAddData();

});

function callBackSearch(data){
	console.log("callBackSearch", data);
	
	str = "";
    var city, postalCode = "";
	$.each(data, function(key, element) {

		var typeIco = key;
		var ico = mapIconTop["default"];
		var color = mapColorIconTop["default"];

		mapElements.push(element);
		typeIco = element.type;
		ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
		color = ("undefined" != typeof mapColorIconTop[typeIco]) ? mapColorIconTop[typeIco] : mapColorIconTop["default"];
		htmlIco ="<i class='fa "+ ico +" fa-2x bg-"+color+"'></i>";

		if("undefined" != typeof element.profilThumbImageUrl && element.profilThumbImageUrl != ""){
			var htmlIco= "<img width='80' height='80' class='img-circle bg-"+color+"' src='"+baseUrl+element.profilThumbImageUrl+"'/>";
		}
		city="";
		var postalCode = element.cp

		if (element.address != null) {
			city = element.address.addressLocality;
			postalCode = element.cp ? element.cp : element.address.postalCode ? element.address.postalCode : "";
		}

		//var id = getObjectId(element);
		var id = element.id ;
		var insee = element.insee ? element.insee : "";
		type = element.type;
		if(type=="citoyen") 
			type = "person";
		var url = "javascript:";
		var onclick = 'loadByHash("#' + type + '.detail.id.' + id + '");';
		var onclickCp = "";
		var target = " target='_blank'";
		var dataId = "";
		if(type == "city"){
			url = "javascript:";
			onclick = 'setScopeValue($(this))';
			onclickCp = 'setScopeValue($(this));';
			target = "";dataId = element.name;
		}
		var tags = "";
		if(typeof element.tags != "undefined" && element.tags != null){
			$.each(element.tags, function(key, value){
				if(value != "")
					tags +=   "<span class='badge bg-red btn-tag'>#" + value + "</span>";
			});
		}
		var name = typeof element.name != "undefined" ? element.name : "";
		var postalCode = (	typeof element.address != "undefined" &&
                  			typeof element.address.postalCode != "undefined") ? element.address.postalCode : "";
                  
		if(postalCode == "")
			postalCode = typeof element.cp != "undefined" ? element.cp : "";
        var cityName = (typeof element.address != "undefined" &&
                  		typeof element.address.addressLocality != "undefined") ? element.address.addressLocality : "";
        var fullLocality = postalCode + " " + cityName;
        var description = (typeof element.shortDescription != "undefined" &&
                  			element.shortDescription != null) ? element.shortDescription : "";

		console.log("id", id, typeof id) ;
		//onclick='addElementLink("+ name + "," + name + ");'
		str = "";
		str += "<li class='li-dropdown-scope'>";
			str += "<div class='col-md-12 searchEntity' id='elementSearch"+id+"' >";
				str += "<div id='elementImgSearch"+id+"' class='col-md-2 col-sm-2 col-xs-3 entityCenter no-padding'>"+ htmlIco + "</div>";
				target = "";
				str += "<div class='col-md-8 col-sm-9 col-xs-6 entityRight no-padding'>";
					str += "<span id='elementNameSearch"+id+"' class='entityName text-dark'>" + name + "</span>";
		      	if(fullLocality != "" && fullLocality != " ")
		        	str += "<span class='entityLocality'><i class='fa fa-home'></i> " + fullLocality + "</span>";
		        if(description != "")
		        	str += "<div class='entityDescription'>" + description + "</div>";
		    	str += tags;
			str += "</div>";
	    str += "</li>";

	    $("#dropdown_searchInvite").append(str);
	    $('#elementSearch'+id).off().on('click', function(e){
			$("#resultSearchEntity").removeClass("hidden");
			$("#nameSearchEntity").html(name);
			$("#idSearchEntity").html(key);
			$("#imgSearchEntity").html(htmlIco);
			$("#dropdown_searchInvite").css({"display" : "none" });
			$("#dropdown_search").html("");
	  	});

	});
	//$("#dropdown_searchInvite").html(str);
	$("#dropdown_searchInvite").css({"display" : "inline" });


	
}

function bindAddData(){
	console.log("bindAddData");
	$("#chooseElementLink").change(function(){ 
		console.log("chooseElementLink : " + $("#chooseElementLink").val());
		if($("#chooseElementLink").val() == "<?php echo Person::COLLECTION; ?>")
			searchType = [ "persons" ];
		else if($("#chooseElementLink").val() == "<?php echo Organization::COLLECTION; ?>")
			searchType = [ "organizations" ];
    });

	$("#checkboxLink").bootstrapSwitch();
	$("#checkboxLink").on("switchChange.bootstrapSwitch", function (event, state) {
		console.log("state = "+state );
		$("#isLink").val(state);
		if(state == true){
			$("#searchLink").show();
		}else{
			$("#searchLink").hide();
		}
	});

	$('#btn-start-search').off().on('click', function(e){
		loadingData = false;
		console.log("btn-start-search", typeof callBackSearch(loadingData));
      	//signal que le chargement est terminé
      	startSearch(0, 15, callBackSearch);
  	});


	$("#fileImport").change(function(e) {
    	var ext = $("input#fileImport").val().split(".").pop().toLowerCase();
    	console.log("ext", ext, $.inArray(ext, "json"));
		if(ext !=  "json" && ext == "js") {
			alert('Upload CSV or JSON');
			return false;
		}

		if(ext == "json" || ext == "js") {
			if (e.target.files != undefined) {
				var reader = new FileReader();
				file = "";
				reader.onload = function(e) {

					file = e.target.result;
					console.log(typeof file);
					console.log(jQuery.parseJSON(file));
					
				};
				reader.readAsText(e.target.files.item(0));
			}
		}
		
		return false;

	});


	$("#sumitVerification").off().on('click', function(e)
  	{
  		if($("#chooseEntity").val() == "-1"){
  			toastr.error("Vous devez sélectionner une collection");
  			return false ;
  		}
  		rand = Math.floor((Math.random() * 8) + 1);
  		$.blockUI({message : '<div class="title-processing homestead"><i class="fa fa-spinner fa-spin"></i> Processing... </div>'
			+'<a class="thumb-info" href="'+proverbs[rand]+'" data-title="Proverbs, Culture, Art, Thoughts"  data-lightbox="all">'
			+ '<img src="'+proverbs[rand]+'" style="border:0px solid #666; border-radius:3px;"/></a><br/><br/>'
		});
  		//console.log("file", file);
  		var link = false ;
  		if( $("#isLink").val() == "true" )
  			link = true ;

  		var isAdmin = false ;
  		if( $("#isAdmin").val() == "true" )
  			isAdmin = true ;

  		var sendMail = false ;
  		if( $("#isSendMail").val() == "true" )
  			sendMail = true ;

  		var isKissKiss = false ;
  		if( $("#isKissKiss").val() == "true" )
  			isKissKiss = true ;
  			
  		$.ajax({
	        type: 'POST',
	        data: {
	        		file : file,
	        		chooseEntity : $("#chooseEntity").val(),
	        		creatorID : "<?php echo $userId; ?>",
	        		pathFolderImage : $("#pathFolderImage").val(),
	        		link : link,
	        		typeLink : $("#chooseTypeLink").val(),
	        		idLink : $("#inputIdLink").val(),
	        		isAdmin : isAdmin,
	        		warnings : $("#checkboxWarnings").is(':checked'),
					sendMail : sendMail,
	        		isKissKiss : isKissKiss,
	        		invitorUrl : $("#inputInvitorUrl").val()

	        	},
	        url: baseUrl+'/communecter/admin/adddataindb/',
	        dataType : 'json',
	        success: function(data)
	        {
	        	console.log("data",data);
	        	var chaine = "";
	        	var csv = '"name";"url";"info";définir si c\'est un nouvelle organization ou si c\'est bien la bonne(New ou Yes)";' ;
	        	if(typeof data.allbranch != "undefined"){
	        		$.each(data.allbranch, function(key, value){
		        		csv += '"'+value+'";'
		        	});
	        	}
	        	if(typeof data.resData != "undefined"){
		        	csv += "\n";
		        	$.each(data.resData, function(key, value2){
		        		//console.log("value",value);
		  				//$.each(value, function(key2, value2){
		  					//console.log("value2",value2, value2.name, value2.info);
			        		chaine += "<tr>" +
			        					"<td>"+value2.name+"</td>"+
			        					"<td>"+value2.info+"</td>"+
			        				"</tr>";
			        		/*if(key == "update"){
			        			csv += '"'+value2.name+'";"'+value2.url+'";"'+value2.info+'";;' ;
			        		}
			        		if(key == "error"){*/
			        			csv += '"'+value2.name+'";;"'+value2.info+'";;' ;
			        		//}
			        		//console.log("csv",csv);
			        		/*if(typeof value2.valueSource != "undefined"){
			        			$.each(data.allbranch, function(keyBranch, valueBranch){
			        				if(typeof value2.valueSource[valueBranch] != "undefined")
					        			csv += '"'+value2.valueSource[valueBranch]+'";' ;
					        		else
					        			csv += ';';
					        	});
			        		}*/
			        		csv += "\n";

			        		
		  					//console.log("chaine",chaine);
			  			//});
		  			});
		  		}

	        	$("<a />", {
				    "download": "Data_a_verifier.csv",
				    "href" : "data:application/csv," + encodeURIComponent(csv)
				  }).appendTo("body")
				  .click(function() {
				     $(this).remove()
				  })[0].click() ;

	  			$("#bodyResult").html(chaine);
	        	$.unblockUI();

	        },
	  		error:function(data){
	  			console.log("error",data);
	  			$.unblockUI();
	  		}
		});
		 		

		
		
		return false;
  		
  	});
}
</script>