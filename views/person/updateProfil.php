<?php 
$cssAnsScriptFilesTheme = array(
	
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
?>

<div id="changePassword" >
	<div class="noteWrap col-md-6 col-md-offset-3">
		<div class="panel-body">
			<input type="file" id="fileImport" name="fileImport" accept=".json,.js,.geojson">
		</div>
		<div class="col-xs-12">
			<a href="#" id="btnUpdate" class="btn btn-success margin-top-15">Mettre à jour votre profil</a>
		</div>
		<div id="divtab" class="table-responsive">
			<table id="tabResult" class="table table-striped table-bordered table-hover">
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

<script type="text/javascript">

var file = "" ;
jQuery(document).ready(function() {
	bindUpdate();
});

function bindUpdate() {
	$("#btnUpdate").off().on('click', function(e){
		mylog.log("btnUpdate");
		$.ajax({
	        type: 'POST',
	        data: {
	        	file : file,
	        },
	        url: baseUrl+'/communecter/person/updatewithjson',
	        dataType : 'json',
	        async : false,
	        success: function(data)
	        {
	        	mylog.log("btnUpdate data",data);
	        	var chaine = "" ;
	        	$.each(data, function(key, value){
	        		mylog.log("value",value.result);
	        		if(value.result == true)
	  					chaine += "<tr><td>"+value.personFieldName+"</td><td>Mis à jour</td><tr>";
	  			});

	  			$("#bodyResult").html(chaine);
	        	
	        }
		});
	});

	$("#fileImport").change(function(e) {
    	var ext = $("input#fileImport").val().split(".").pop().toLowerCase();
    	//mylog.log("ext", ext, $.inArray(ext, "json"));
		if(ext !=  "json" && ext == "js" && ext !=  "geojson") {
			alert('Upload CSV or JSON');
			return false;
		}

		if(ext == "json" || ext == "js" || ext == "geojson") {
			if (e.target.files != undefined) {
				var reader = new FileReader();
				file = [];
				reader.onload = function(e) {
					file.push(e.target.result);
		  			mylog.log("file : ", file );
				};
				reader.readAsText(e.target.files.item(0));
			}
		}
		
		return false;

	});
}


</script>	

