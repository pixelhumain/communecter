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
				<h4 class="panel-title">Invite tes amis Google</h4>
				<div class="panel-tools">
					<a href="javascript:;" id="backToDashboardBtn" class="btn btn-xs btn-blue">Back</a>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
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
					<button id="contacts"
						class="btn btn-primary col-md-3 col-md-offset-1">
						Récupérez vos contacts Gmail
					</button>
				</div>
				<div class="row">&nbsp;
				</div>
				<div class="row">
					<form method="POST" action="" id="shareForm" >
						<div class="form-group">
							<div id="list-contact" class="list-group col-md-5 col-md-offset-1">
								<a href="#" class="list-group-item active">Liste des contacts</a>
				        	</div>
				        	<div class="col-md-5">
				        		<label for="inputEmail3" class="control-label">Votre Message :</label>
				        		<textarea id="textmail" class="form-control" rows="5">Venez me rejoindre sur PixelHumain</textarea>
				        		<div class="col-md-12">&nbsp;</div>
				        		<a href="#" class="btn btn-primary col-md-3 col-md-offset-4" id="submitInviter">Inviter</a>
							</div>
						</div>
						<div class="form-group"> 
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end: PAGE CONTENT-->
<script type="text/javascript">
(function() 
  {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/client:plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();

</script>
<script type="text/javascript">
 jQuery(document).ready(function() 
{ 


	

	$("#shareForm").hide();
	$("#contacts").off().on('click', function()
	{
    	var config = 
	    {
	    	'client_id': '608116136544-tqus0f4dpitr0f76fubutqqjq5nh96ca.apps.googleusercontent.com',
	    	'scope': 'https://www.google.com/m8/feeds'
	    };
	    gapi.auth.authorize(config, function()
	    {
	    	fetch(gapi.auth.getToken());
	    });
	});

  function fetch(token)
  {
    $.ajax({
      url: "https://www.google.com/m8/feeds/contacts/default/full?access_token=" + token.access_token + "&alt=json",
      dataType: "jsonp",
      success:function(data) 
      {
        console.dir(data);
        $("#shareForm").show();
        $.each(data.feed.entry, function(key, value) 
        {
          var text = "";
          if(value.gd$email)
          {
            $.each(value.gd$email, function( keyMails, valueMails ) 
            {
              text = '<span class="list-group-item"><input type="checkbox" aria-label="'+valueMails.address+'" value="'+valueMails.address+'">'+valueMails.address+'</span>';
              $("#list-contact").append(text);
            });
          }
          
        });
      }
    });
  }


  $("#submitInviter").off().on('click', function()
  {
    if($("input:checked").map(function () { return this.value; }).get() == "")
    	toastr.error("Veuillez sélectionner une adresse mail.");
    else
    {
    	var mailselected = $("input:checked").map(function () { return this.value; }).get();
    	$.ajax({
	        type: 'POST',
	        data: {textmail : $('#textmail').val(), mails : mailselected},
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