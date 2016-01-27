
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title">Inviter des contacts et partager communecter sur vos réseaux sociaux</h4>
	</div>
	<div class="panel-body">
		<ul class="nav nav-tabs">
		  	<!-- <li role="presentation" class="active"><a href="#" class="" id="buttonGmail">Gmail</a></li> -->
		  	<li role="presentation"><a href="#" class="" id="buttonGmail">Gmail</a></li>
		  	<li role="presentation"><a href="#" class="" id="buttonGooglePlus">Google+</a></li>
		  	<li role="presentation"><a href="#" class="" id="buttonImportFile">Importer un fichier</a></li>
		  	<li role="presentation"><a href="#" class="" id="buttonSaisir">Saisir</a></li>
		</ul>
	</div>
	<div class="panel-body">
		<div class="col-sm-12 col-xs-12">
			<div id="viewGmail">
				<div class="col-sm-12 col-xs-12">
					<button id="contacts"
						class="btn btn-primary col-md-3 col-md-offset-1">
						Récupérez vos contacts Gmail
					</button>
				</div>
				
			</div>
			<div id="viewGooglePlus">
			  <button
					class="g-interactivepost btn btn-primary col-md-3 col-md-offset-2"
					data-clientid="608116136544-tqus0f4dpitr0f76fubutqqjq5nh96ca.apps.googleusercontent.com"
					data-contenturl="www.pixelhumain.com"
					data-calltoactionlabel="INVITE"
					data-calltoactionurl="http://www.pixelhumain.com"
					data-cookiepolicy="single_host_origin"
					data-prefilltext="Viens nous rejoindre!!!">
					Partagez PixelHumain sur Google+
				</button>
			</div>

			<div id="viewImportFile">
				yo
			</div>


			<div id="viewSaisir">
				<div class="form-group col-sm-12 col-xs-12">
					<label for="textmail" class="control-label col-sm-12 col-xs-12">Copier vos emails, séparé par des points-virgules.</label>
					<div class="col-sm-5 col-xs-12">
						<textarea id="mailssaisie" class="form-control col-sm-5" rows="5"></textarea>
					</div>
					<a href="#" class="btn btn-primary col-sm-2" id="submitAfficher">Afficher</a>
				</div>
				
			</div>
		</div>
		<br/><br/>
		<div id="validationMail" class="col-sm-12 col-xs-12">

			<div class="list-group col-sm-5">
				<span class="list-group-item active">Liste des contacts</span>
				<span class="list-group-item">
					<input type='checkbox' id='allchecked'/><label id="textallchecked" for="allchecked">Tout cocher</label>	
				</span>
				<div id="list-contact"> </div>
       		</div>
        	<div id="Messages" class="col-sm-5">
        		<label for="textmail" class="control-label">Votre Message :</label>
        		<textarea id="textmail" class="form-control" rows="5">Venez me rejoindre sur PixelHumain</textarea>
        		<div class="col-sm-12">&nbsp;</div>
        		<a href="#" class="btn btn-primary col-sm-2" id="submitInviter">Inviter</a>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
(function() 
  {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/client:plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();

</script>
<script type="text/javascript">
jQuery(document).ready(function(){
	$("#validationMail").hide();
	$("#viewGmail").hide();
	$("#viewGooglePlus").hide();
	$("#viewImportFile").hide();
	$("#viewSaisir").hide();
	bindEvents();
	var lat = 50.3727944 ;
	var lon = 3.5151906;
	insee(lat, lon);
	
});

function bindEvents(){
	$("#buttonGmail").click(function() {
		fadeInView("viewGmail");
		$("#shareForm").hide();
	});

	$( "#buttonGooglePlus").click(function() {
		fadeInView("viewGooglePlus");
	});

	$("#buttonImportFile").click(function() {
		fadeInView("viewImportFile");
	});

	$( "#buttonSaisir").click(function() {
		fadeInView("viewSaisir");
		$("#listSaisir").hide();
	});

	$('#allchecked').click(function() 
	{ // clic sur la case cocher/decocher
           
        var cases = $("#list-contact").find(':checkbox'); // on cherche les checkbox qui dépendent de la liste 'list-contact'
        if(this.checked)
        { // si 'allchecked' est coché
            cases.attr('checked', true); // on coche les cases
            $('#textallchecked').html('Tout decocher'); // mise à jour du texte de cocheText
        }else
        { // si on décoche 'allchecked'
            cases.attr('checked', false);// on coche les cases
            $('#textallchecked').html('Tout cocher');// mise à jour du texte de cocheText
        }          
               
    });

    $("#submitAfficher").off().on('click', function()
  	{

  		var listemail = $('#mailssaisie').val()
  		arraymail = listemail.split(';');
  		$("#list-contact").html("");
  		$.each(arraymail, function(keyMails, valueMails) 
        {
          text = '<span class="list-group-item"><input type="checkbox" aria-label="'+valueMails+'" value="'+valueMails+'">'+valueMails+'</span>';
          $("#list-contact").append(text);
        });

        $("#validationMail").show();
  	});

	$("#contacts").off().on('click', function()
	{
    	var config = 
	    {
	    	'client_id': '991320747617-dnqguopevn9bn3mg21nm1k12gj305anv.apps.googleusercontent.com',
	    	'scope': 'https://www.google.com/m8/feeds'
	    };
	    gapi.auth.authorize(config, function()
	    {
	    	fetch(gapi.auth.getToken());
	    });
	});


	$("#submitInviter").off().on('click', function()
	{
    	if($("input:checked").map(function () { return this.value; }).get() == "")
    		toastr.error("Veuillez sélectionner une adresse mail.");
    	else{
    		var mailselected = $("input:checked").map(function () { return this.value; }).get();
    		$.ajax({
	        	type: 'POST',
	        	data: {textmail : $('#textmail').val(), mails : mailselected},
	        	url: baseUrl+'/communecter/person/sendmail/',
	        	dataType : 'json',
	        	success: function(data){
	            	console.dir(data);
	            	if(data.result)
	              		toastr.success("Vos invitations ont été envoyées.");
	            	else
	                	toastr.error("error2"); 
	        	}
	    	});
    	}
  	});
}

function insee(lan, lon){	
	$.ajax({
	    type: 'POST', 
	    data: { latitude : lan, 
	    		longitude : lon
	    		},
	    async:false,
	    url: baseUrl+'/communecter/sig/getinseebylatlng/',
	    dataType : 'json',
	    success: function(data)
	    {
	        console.log("insee", data.insee) ;
	    }
	});
}

function fetch(token){
	$.ajax({
  		url: "https://www.google.com/m8/feeds/contacts/default/full?access_token=" + token.access_token + "&alt=json",
  		dataType: "jsonp",
  		success:function(data) 
  		{
    		console.dir(data);
    		$("#list-contact").html("");
    		$.each(data.feed.entry, function(key, value) 
    		{
      			var text = "";
      			if(value.gd$email)
      			{
      				
        			$.each(value.gd$email, function( keyMails, valueMails ) 
        			{
        				console.log("valueMails.address", valueMails.address);
          				text = '<span class="list-group-item"><input type="checkbox" aria-label="'+valueMails.address+'" value="'+valueMails.address+'">'+valueMails.address+'</span>';
          				
          				$("#list-contact").append(text);
        			});
      			}
      			$("#validationMail").show();
      		});
  		}
	});
}

function fadeInView(inView){

	if(inView == "viewGmail")
	{
		$("#viewGmail").fadeIn("slow", function() {});
		$("#viewGooglePlus").hide();
		$("#viewImportFile").hide();
		$("#viewSaisir").hide();
		$("#validationMail").hide();
	}
	else if(inView == "viewGooglePlus")
	{
		$("#viewGooglePlus").fadeIn("slow", function() {});
		$("#viewGmail").hide();
		$("#viewImportFile").hide();
		$("#viewSaisir").hide();
		$("#validationMail").hide();
	}
	else if(inView == "viewImportFile")
	{
		$("#viewImportFile").fadeIn("slow", function() {});
		$("#viewGmail").hide();
		$("#viewGooglePlus").hide();
		$("#viewSaisir").hide();
		$("#validationMail").hide();
	}
	else if(inView == "viewSaisir")
	{
		$("#viewSaisir").fadeIn("slow", function() {});
		$("#viewGmail").hide();
		$("#viewImportFile").hide();
		$("#viewGooglePlus").hide();
		$("#validationMail").hide();
	}

}

</script>