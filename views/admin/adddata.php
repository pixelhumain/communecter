<?php
$cs = Yii::app()->getClientScript();
$userId = Yii::app()->session["userId"] ;
?>
<div class="panel panel-white">
	<div id="config">
		<div class="panel-heading border-light">
			<h4 class="panel-title">Import Data</h4>
		</div>
		<div class="panel-body">
			<?php //var_dump($city); ?>
			<div class="col-sm-12 col-xs-12">
				<div class="col-sm-4 col-xs-12">
						<label for="chooseEntity">Collection : </label>
						<select id="chooseEntity" name="chooseEntity">
							<option value="-1">Choisir</option>
							<option value="organization">Organization</option>
							<option value="person">Person</option>
							<option value="project">Project</option>
						</select>
				</div>
				<div class="col-sm-4 col-xs-12">
						<label for="fileImport">Fichier JSON :</label>
						<input type="file" id="fileImport" name="fileImport" accept=".json,.js">
				</div>
			</div>
			<div class="col-sm-12 col-xs-12">
				<div class="col-sm-4 col-xs-12">
					<label for="pathFolderImage">Path dossier image :</label>
					<input type="text" id="pathFolderImage" name="pathFolderImage" value="">
				</div>
				<div class="col-sm-4 col-xs-12">
					<a href="#" class="btn btn-primary col-sm-3" id="sumitVerification">Vérification</a>
				</div>
			</div>
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
jQuery(document).ready(function() 
{
	bind();

});

function bind()
{
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
  		/*rand = Math.floor((Math.random() * 8) + 1);
  		$.blockUI({message : '<div class="title-processing homestead"><i class="fa fa-spinner fa-spin"></i> Processing... </div>'
			+'<a class="thumb-info" href="'+proverbs[rand]+'" data-title="Proverbs, Culture, Art, Thoughts"  data-lightbox="all">'
			+ '<img src="'+proverbs[rand]+'" style="border:0px solid #666; border-radius:3px;"/></a><br/><br/>'
		});*/
  		console.log("file", file);
  		$.ajax({
	        type: 'POST',
	        data: {
	        		file : file,
	        		chooseEntity : $("#chooseEntity").val(),
	        		creatorID : "<?php echo $userId; ?>",
	        		pathFolderImage : $("#pathFolderImage").val()
	        	},
	        url: baseUrl+'/communecter/admin/adddataindb/',
	        dataType : 'json',
	        success: function(data)
	        {
	        	//console.log("data",data);
	        	var chaine = ""

	        	$.each(data.resData, function(key, value){
	  				
	        		chaine += "<tr>" +
	        					"<td>"+value.name+"</td>"+
	        					"<td>"+value.info+"</td>"+
	        				"</tr>";

	  			});

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