<?php
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/css/lightbox.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/js/lightbox.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/mixitup/src/jquery.mixitup.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/pages-gallery.js' , CClientScript::POS_END);
?>
<!-- start: PAGE CONTENT -->
<style type="text/css">
	.panel-tools{
		filter: alpha(opacity=1);
		-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=1)";
		-moz-opacity: 1;
		-khtml-opacity: 1;
		opacity: 1;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">Invite tes contacts</h4>
				<div class="panel-tools">
					<a href="javascript:;" id="backToDashboardBtn" class="btn btn-xs btn-blue">Back</a>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<form method="POST" action="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/communecter/person/importmail/';?>" id="shareForm" >
						<div class="form-group col-md-12">
							<label for="textmail" class="control-label">Copier vos emails, séparé par des points-virgules.</label>
				        		<textarea id="mailssaisie" class="form-control" rows="5"></textarea>
				        		<br/>
				        	<a href="#" class="btn btn-primary col-md-2 col-md-offset-5" id="submitAfficher">Afficher</a>
						</div>	
						
						<div class="form-group">
							<div id="list-contact" class="list-group col-md-5 col-md-offset-1">
								<span href="#" class="list-group-item active">Liste des contacts</span>
								<span class="list-group-item">
									<input type='checkbox' id='allchecked'/><label id="textallchecked" for="allchecked">Tout cocher</label>	
								</span>
				       		</div>
				        	<div class="col-md-5">
				        		<label for="textmail" class="control-label">Votre Message :</label>
				        		<textarea id="textmail" class="form-control" rows="5">Venez me rejoindre sur PixelHumain</textarea>
				        		<div class="col-md-12">&nbsp;</div>
				        		<a href="#" class="btn btn-primary col-md-2 col-md-offset-5" id="submitInviter">Inviter</a>
							</div>
						</div>
						<div id="test" class="col-md-5">
				        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end: PAGE CONTENT-->
<script type="text/javascript">
 jQuery(document).ready(function() 
{ 


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

  		$.each(arraymail, function(keyMails, valueMails) 
        {
          text = '<span class="list-group-item"><input type="checkbox" aria-label="'+valueMails+'" value="'+valueMails+'">'+valueMails+'</span>';
          $("#list-contact").append(text);
        });
  	});
	$("#submitInviter").off().on('click', function()
  	{
  		if($("input:checked").map(function () { return this.value; }).get() == "")
	    	toastr.error("Veuillez sélectionner une adresse mail.");
	    else
	    {
	  		var mailselected = $("input:checked").map(function () {  return this.value; }).get();
	  		$.ajax({
	        	type: 'POST',
	        	data: { mails : mailselected, textmail : $('#textmail').val()},
	        	url: baseUrl+'/communecter/person/sendmail/',
	        	dataType : 'json',
	        	success: function(data)
	        	{
	            	console.dir(data);
	            	if(data.result)
	              		toastr.success("Vos invitations ont été envoyées.");
	            	else
	                	toastr.error("error2"); 
	        	}
	      	});
  		}
  	});

  	$("#backToDashboardBtn").off().on("click", function(){
  		document.location.href=baseUrl+"/communecter/person/network";
    })
});

</script>