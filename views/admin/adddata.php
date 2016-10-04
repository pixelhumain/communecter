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

<div class="col-md-12 no-padding ">
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
		file = [];
				
		if (e.target.files != undefined) {
			var reader = new FileReader();
			reader.onload = function(e) {
				if(extensions.indexOf(nameFileSplit[nameFileSplit.length-1]) == -1) {
					file = e.target.result;
	  			}
			};
			reader.readAsText(e.target.files.item(0));
		}
		return false;
	});


	$("#sumitVerification").off().on('click', function(e)
  	{
  		if($("#chooseEntity").val() == "-1"){
  			toastr.error("Vous devez sélectionner un élément");
  			return false ;
  		}
  		$.blockUI({
			message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i> Processing ...</h1>"
		});
  		
  		params: {
        		file : file,
        		chooseEntity : $("#chooseEntity").val()
        }
  			
  		$.ajax({
	        type: 'POST',
	        data: params,
	        url: baseUrl+'/communecter/admin/adddataindb/',
	        dataType : 'json',
	        success: function(data){
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