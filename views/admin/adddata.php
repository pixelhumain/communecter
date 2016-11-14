<?php
$cs = Yii::app()->getClientScript();
$cssAnsScriptFilesModule = array(
		'/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
		'/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js'
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->request->baseUrl);
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

	#searchLink{
		margin-top: 10px;
		margin-bottom: 10px;
	}

	#searchLink .entityName{
		font-size: 14px;
	}

	.vcenter {
	    display: inline-block;
	    vertical-align: middle;
	    float: none;
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

<div class="col-md-12 no-padding ">
	<h4>Obligatoire</h4>
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
</div>
<div class="col-md-12 no-padding">
	<h4>Option</h4>
	<div class="col-xs-12">
		<label for="checkboxLink">Lier les entités : <input type="hidden" id="isLink" value=""/></label>
		<input id="checkboxLink" name="checkboxLink" type="checkbox" data-on-text="<?php echo Yii::t("common","Yes") ?>" data-off-text="<?php echo Yii::t("common","No") ?>"></input>
		<br/>
		<div id="searchLink" class="input-group col-md-8 col-sm-8 col-xs-8 pull-left hide">
			<span class="input-group-btn">
				<select id="chooseElementLink" name="chooseElementLink" class="">
					<option value="<?php echo Person::COLLECTION; ?>"><?php echo Yii::t("common", "Person"); ?></option>
					<option value="<?php echo Organization::COLLECTION; ?>"><?php echo Yii::t("common", "Organization"); ?></option>
				</select>
			</span>
			<input id="searchBarText" data-searchPage="true" type="text" placeholder="Chercher le citoyen ou l'organisation pour lier les données importer" class="input-search form-control">
			<span class="input-group-btn">
	            <a href="javascript:;" class="btn btn-success btn-start-search tooltips" id="btn-start-search">
	            	<i class="fa fa-refresh"></i>
	           	</a>
	      	</span>
	      	<ul class="dropdown-menu" id="dropdown_searchInvite" style="">
				<li class="li-dropdown-scope">-</li>
			</ul>
		</div>
		<div id="resultSearchEntity" class='col-md-5 no-padding hide' onclick='addElementLink("name","name")'>
			Link :
			<span id="nameSearchEntity" class='vcenter entityName text-dark'></span>
			<img id="imgSearchEntity" width='40' height='40' class='img-circle' src=''/>			
			<input type="hidden" id="idSearchEntity" value=""/>
			<select id="roleLink" name="roleLink" class="">
				<option value="member"><?php echo Yii::t("common", "Member"); ?></option>
				<option value="admin"><?php echo Yii::t("common", "Admin"); ?></option>
			</select>
		</div>
	</div>
</div>
<div class="col-xs-12">
	<div class="col-sm-5 col-xs-12">
		<a href="#" class="btn btn-primary col-sm-3" id="sumitVerification">Vérification</a>
	</div>
</div>

<div id="resultAddData">
	<h4 class="panel-title">Résultat</h4>

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
var file = "" ;
var extensions = ["json", "js", "geojson"];
var nameFile = "";
var typeFile = "";
var typeElement = "";
var searchType = [ "persons" ];
jQuery(document).ready(function() 
{
	
	bindAddData();

});



function bindAddData(){

	$("#fileImport").change(function(e) {
    	var nameFileSplit = $("#fileImport").val().split("."); 
  		if(extensions.indexOf(nameFileSplit[nameFileSplit.length-1]) == -1){
  			toastr.error("Vous devez sélectionner un fichier JSON");
  			return false ;
  		}
  		nameFile = nameFileSplit[0];
		typeFile = nameFileSplit[nameFileSplit.length-1];
		file = "";
		if (e.target.files != undefined) {
			var reader = new FileReader();
			reader.onload = function(e) {
				file = e.target.result;
			};
			reader.readAsText(e.target.files.item(0));
		}
		return false;
	});

	$("#checkboxLink").bootstrapSwitch();
	$("#checkboxLink").on("switchChange.bootstrapSwitch", function (event, state) {
		console.log("state = "+state );
		$("#isLink").val(state);
		if(state == true){
			$("#searchLink").removeClass("hide");
		}else{
			$("#searchLink").addClass("hide");
		}
	});

	$("#chooseElementLink").change(function(){ 
		console.log("chooseElementLink : " + $("#chooseElementLink").val());
		if($("#chooseElementLink").val() == "<?php echo Person::COLLECTION; ?>")
			searchType = [ "persons" ];
		else if($("#chooseElementLink").val() == "<?php echo Organization::COLLECTION; ?>")
			searchType = [ "organizations" ];
    });

	$('#btn-start-search').off().on('click', function(e){
		loadingData = false;
		console.log("btn-start-search", typeof callBackSearch(loadingData));
      	//signal que le chargement est terminé
      	startSearch(0, 15, callBackSearch);
  	});

	$("#sumitVerification").off().on('click', function(e)
  	{
  		if($("#chooseElement").val() == "-1"){
  			toastr.error("Vous devez sélectionner un élément");
  			return false ;
  		}
  		else if(file == ""){
  			toastr.error("Vous devez sélectionner un fichier");
  			return false ;
  		}
  		$.blockUI({
			message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i> Processing ...</h1>"
		});
  		
  		var params = {
        		file : file,
        		typeElement : $("#chooseElement").val()
        };

        
        if($("#isLink").val() == "true"){
        	params["isLink"] = true;
        	params["typeLink"] = $("#chooseElementLink").val();
        	params["idLink"] = $("#idSearchEntity").val();
        	params["roleLink"] = $("#roleLink").val();
        }
        	
  			
  		$.ajax({
	        type: 'POST',
	        data: params,
	        url: baseUrl+'/communecter/admin/adddataindb/',
	        dataType : 'json',
	        success: function(data){
	        	console.log("data",data);
	        	var chaine = "";
	        	var csv = '"name";"info";"url"' ;
	        	if(typeof data.resData != "undefined"){
		        	$.each(data.resData, function(key, value2){
		        		chaine += "<tr>" +
		        					"<td>"+value2.name+"</td>"+
		        					"<td>"+value2.info+"</td>"+
		        					"<td>"+baseUrl+value2.url+"</td>"+
		        				"</tr>";
		        		csv += "\n";
		        		csv += '"'+value2.name+'";"'+value2.info+'";"'+baseUrl+value2.url+'";' ;
		        		
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
			$("#resultSearchEntity").removeClass("hide");
			$("#nameSearchEntity").html(name);
			$("#idSearchEntity").val(key);
			//$("#imgSearchEntity").html(htmlIco);
			$("#imgSearchEntity").addClass("bg-"+color);
			$("#imgSearchEntity").attr('src',baseUrl+element.profilThumbImageUrl);
			
			$("#dropdown_searchInvite").css({"display" : "none" });
			$("#dropdown_search").html("");
	  	});

	});
	//$("#dropdown_searchInvite").html(str);
	$("#dropdown_searchInvite").css({"display" : "inline" });


	
}
</script>