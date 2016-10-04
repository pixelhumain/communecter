<?php
$cs = Yii::app()->getClientScript();
$cssAnsScriptFilesModule = array(
		'/assets/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
		'/assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
$userId = Yii::app()->session["userId"] ;
?>
<div class="panel panel-white">
	<div id="config">
		<div class="panel-heading border-light">
			<h4 class="panel-title">Import Data</h4>
		</div>
		<!-- <div class="panel-body" >
			<div id="authorize-div" style="">
				<span>Authorize access to Drive API</span>
				
				<button id="authorize-button" onclick="handleAuthClick(event)">
					Authorize
				</button>
		    </div>
		    <pre id="output"></pre>

		</div> -->
		<div class="panel-body">
			<?php //var_dump($city); ?>
			<div class="col-xs-12">
				<div class="col-sm-4 col-xs-12">
						<label for="chooseEntity">Collection : </label>
						<select id="chooseEntity" name="chooseEntity">
							<option value="-1">Choisir</option>
							<option value="invite">Invite</option>
							<option value="event">Event</option>
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
			<div class="col-xs-12">
				<div class="col-xs-12">
					<label for="pathFolderImage">Path dossier image :</label>
					<input type="text" id="pathFolderImage" name="pathFolderImage" value="">
				</div>	
			</div>
			<div class="col-xs-12">
				<!--<div class="col-sm-3 col-xs-12">-->
					<label>
						Lier les entités : <input class="hide" id="isLink" name="isLink"></input>
						<input id="checkboxLink" name="checkboxLink" type="checkbox" data-on-text="<?php echo Yii::t("common","Yes") ?>" data-off-text="<?php echo Yii::t("common","No") ?>"></input>
					</label>
				<!-- </div>-->
				<div id="divLink">
					<select id="chooseTypeLink" name="chooseTypeLink"> 
						<option value="Person">Person</option>
						<option value="Organization">Organisation</option>
						<option value="Event">Event</option>
					</select>
					<label for="inputIdLink">Id de l'entité : </label>
					<input class="" placeholder="" id="inputIdLink" name="inputIdLink" value="">
					<label>
						Admin : <input class="hide" id="isAdmin" name="isAdmin"></input>
					<input id="checkboxAdmin" name="checkboxAdmin" type="checkbox" data-on-text="<?php echo Yii::t("common","Yes") ?>" data-off-text="<?php echo Yii::t("common","No") ?>"></input>
					</label>
				</div>
				<div id="divSendMail">
					<label>
						Envoyer les mails d'invitation : <input class="hide" id="isSendMail" name="isSendMail"></input>
					<input id="checkboxSendMail" name="checkboxSendMail" type="checkbox" data-on-text="<?php echo Yii::t("common","Yes") ?>" data-off-text="<?php echo Yii::t("common","No") ?>"></input>
					</label>
					<label for="inputIdLink">invitor URL : </label>
					<input class="" placeholder="" id="inputInvitorUrl" name="inputInvitorUrl" value="">
				</div>
				<div id="divKissKiss">
					<label>
						Kiss Kiss Bang Bang : <input class="hide" id="isKissKiss" name="isKissKiss"></input>
					<input id="checkboxKissKiss" name="checkboxKissKiss" type="checkbox" data-on-text="<?php echo Yii::t("common","Yes") ?>" data-off-text="<?php echo Yii::t("common","No") ?>"></input>
					</label>
				</div>
			</div>
			<div class="col-xs-12">
					<label>
						Warnings : <input type="checkbox" value="" id="checkboxWarnings" name="checkboxWarnings">
					</label>
				</div>
			<div class="col-xs-12">
				<div class="col-sm-5 col-xs-12">
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
//var CLIENT_ID = "<?php echo Yii::app()->params['google']['client_id']; ?>"; 
//var SCOPES = ['https://www.googleapis.com/auth/drive'];
//var SCOPES = ['https://www.googleapis.com/auth/drive.metadata.readonly'];


jQuery(document).ready(function() 
{
	$("#divLink").hide();
	bind();

});









function bind()
{
	$("#checkboxAdmin").bootstrapSwitch();
	$("#checkboxAdmin").on("switchChange.bootstrapSwitch", function (event, state) {
		console.log("state = "+state );
		$("#isAdmin").val(state);
		
	});


	$("#checkboxLink").bootstrapSwitch();
	$("#checkboxLink").on("switchChange.bootstrapSwitch", function (event, state) {
		console.log("state = "+state );
		$("#isLink").val(state);
		if(state == true){
			$("#divLink").show();
		}else{
			$("#divLink").hide();
		}
	});

	$("#checkboxSendMail").bootstrapSwitch();
	$("#checkboxSendMail").on("switchChange.bootstrapSwitch", function (event, state) {
		console.log("state = "+state );
		$("#isSendMail").val(state);
	});

	$("#checkboxKissKiss").bootstrapSwitch();
	$("#checkboxKissKiss").on("switchChange.bootstrapSwitch", function (event, state) {
		console.log("state = "+state );
		$("#isKissKiss").val(state);
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


/**
* Check if current user has authorized this application.
*/
/*function checkAuth() {
	console.log("checkAuth");
	gapi.auth.authorize({
		'client_id': CLIENT_ID,
		'scope': SCOPES.join(' '),
		'immediate': true
	}, handleAuthResult);
}

/**
* Handle response from authorization server.
*
* @param {Object} authResult Authorization result.
*/
/*function handleAuthResult(authResult) {
	console.log("handleAuthResult", authResult);
	var authorizeDiv = document.getElementById('authorize-div');
	if (authResult && !authResult.error) {
		// Hide auth UI, then load client library.
		authorizeDiv.style.display = 'none';
		loadDriveApi();
	} else {
		// Show auth UI, allowing the user to initiate authorization by
		// clicking authorize button.
		authorizeDiv.style.display = 'inline';
	}
}


 /**
* Initiate auth flow in response to user clicking authorize button.
*
* @param {Event} event Button click event.
*/
/*function handleAuthClick(event) {
	console.log("handleAuthClick", event);
	gapi.auth.authorize({
		client_id: CLIENT_ID, 
		scope: SCOPES, 
		immediate: false}, handleAuthResult);
	return false;
}

/**
* Load Drive API client library.
*/
/*function loadDriveApi() {
	console.log("loadDriveApi");
	gapi.client.load('drive', 'v3', listFiles);
}

/**
* Print files.
*/
/*function listFiles() {
	console.log("listFiles");
	var request = gapi.client.drive.files.list({
    	'pageSize': 10,
    	'fields': "nextPageToken, files(id, name)"
  	});

  	request.execute(function(resp) {
    	appendPre('Files:');
    	console.log(resp);
    	var files = resp.files;
    	if (files && files.length > 0) {
      		for (var i = 0; i < files.length; i++) {
        		var file = files[i];
        		appendPre(file.name + ' (' + file.id + ')');
        		//auth();
        		
      		}
    	} else {
      		appendPre('No files found.');
    	}
  	});
}

/**
* Append a pre element to the body containing the given message
* as its text node.
*
* @param {string} message Text to be placed in pre element.
*/
/*function appendPre(message) {
	console.log("appendPre", message);
	var pre = document.getElementById('output');
	var textContent = document.createTextNode(message + '\n');
	pre.appendChild(textContent);

	
}





function auth() {
	var config = {
		'client_id': CLIENT_ID,
		'scope': SCOPES
	};
	gapi.auth.authorize(config, function() {
		getToken();

		//fetch(gapi.auth.getToken());
	});
}

function getToken(stop) {
	console.log("getToken", token);
	var token = gapi.auth.getToken();
	if(typeof token != "undefined"){
		fetch2(token);
	}
	else {
		if(stop == false)
			getToken(true) ;
		else
			toastr.error("Veuillez réessayer plus taSrd.");
	}
}

function fetch2(token){
	console.log("fetch", token);
	var urlGmail = "https://www.googleapis.com/drive/v3/files/0B9tVDVlaccMsU3lqbXJiQkh6aVU?alt=media&access_token=" + token.access_token ;
	$.ajax({
  		url: urlGmail,
  		dataType: "html",
  		success:function(data){
    		console.log("dataFetch", data);
    		
  		},
  		error:function(data){
  			console.log("error",data)
  		}
	});

	bindInviteSubViewInvites();
}*/
</script>