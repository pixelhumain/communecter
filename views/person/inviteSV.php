<?php
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/communecter.js'
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<style>

#newInvite .dropdown-menu{
	width: 100%;
}
#step2, #step3{
	display:none;
}

.margin-bottom-10 {
	margin-bottom: 10px;
}

.city-search {
    font-size: 0.95rem;
    font-weight: 300;
    line-height: 0.8125rem;
}

#newInvite{
		float: left;
		padding: 10px;
		background-color: rgba(242, 242, 242, 0.9);
		width: 100%;
		-moz-box-shadow: 1px 1px 5px 3px #cfcfcf;
		-webkit-box-shadow: 1px 1px 5px 3px #cfcfcf;
		-o-box-shadow: 1px 1px 5px 3px #cfcfcf;
		box-shadow: 1px 1px 5px 3px #cfcfcf;
		filter:progid:DXImageTransform.Microsoft.Shadow(color=#cfcfcf, Direction=134, Strength=5);
	}
</style>

<?php if( @$isNotSV ){ 
	$this->renderPartial('../default/panels/toolbar'); 
}?>

<div id="newInvite">
	<ul class="nav nav-tabs">
		<li role="presentation">
			<a href="#" class="" id="menuInviteSomeone">
				<h4 id="titleInviteSomeone" class='titleInviteSV radius-10 padding-10 text-yellow text-bold'>
					<i class="fa fa-plus"></i> 
					<i class="fa fa-user fa-2x"></i> 
					<?php echo Yii::t("person","Add a Person") ?>
				</h4>
			</a>
		</li>
	  	<li role="presentation">
	  		<a href="#" class="" id="menuGmail">
	  			<h4 id="titleGmail" class='radius-10 padding-10 text-grey text-bold'>
	  				<i class="fa fa-envelope fa-2x"></i> 
					Gmail
				</h4>
	  		</a>
	  	</li>
	  	<li role="presentation">
	  		<a href="#" class="" id="menuGooglePlus">
	  			<h4 id="titleGooglePlus" class='radius-10 padding-10 text-grey text-bold'>
	  				<i class="fa fa-google-plus-square fa-2x"></i> 
					Google+
				</h4>	  		
	  		</a>
	  	</li>
	  	<li role="presentation">
	  		<a href="#" class="" id="menuImportFile">
	  			<h4 id="titleImportFile" class='radius-10 padding-10 text-grey text-bold'>
	  				<i class="fa fa-upload fa-2x"></i> 
					Importer un fichier
				</h4>
	  		</a>
	  	</li>
	  	<li role="presentation">
	  		<a href="#" class="" id="menuWriteMails">
	  			<h4 id="titleWriteMails" class='radius-10 padding-10 text-grey text-bold'>
	  				<i class="fa fa-pencil-square-o fa-2x"></i> 
					Saisir
				</h4>
	  		</a>
	  	</li>
	</ul>	
	<?php 
	$size = ( !@$isNotSV ) ? "col-md-6 col-md-offset-3" : "col-md-12 height-230"
	?>
	<div class="<?php echo $size ?>" >
		<!-- Partie "Invite Someone" -->
       	<div class="panel panel-white" id="divInviteSomeone">
        	<div class="panel-heading border-light">
        		<?php if( !@$isNotSV ){ ?>
					<h1><?php echo Yii::t("common","Connect people to your network") ?></h1>
				<?php } ?>	
			    <p>  <?php echo Yii::t("person","Find people you know by name or email") ?>. </p>
			</div>
			
			<div class="panel-body">

				<form class="form-invite" autocomplete="off">
					<input class="invite-parentId hide"  id="inviteParentId" name="inviteParentId" type="text"/>
					<input class="invite-id hide" id = "inviteId" name="inviteId" type="text"/>
					<div class="row" id="step1">
						<div class="col-md-1">	
			           		<i class="fa fa-search fa-2x"></i> 
			           	</div>
						<div class="col-md-10">
							<div class="form-group">
								<input class="invite-search form-control" placeholder="Search Here" autocomplete = "off" id="inviteSearch" name="inviteSearch" value="">
					        		<ul class="dropdown-menu" id="dropdown_searchInvite" style="">
										<li class="li-dropdown-scope">-</li>
									</ul>
								</input>
							</div>
						</div>
					</div>
					<div class="row" id="step2">
						<div class="form-group" id="ficheUser">
							<div class="col-md-5 text-center">
								<div class='photoInvited text-center'>
								</div>
								<a class='pending btn btn-xs btn-red tooltips' data-toggle="tooltip" data-placement="bottom" title="This user has been already invited but has not connected yet.">Pending User</a>
							</div>
							<div class="col-md-7">
								<a href="javascript:;" class="connectBtn btn btn-lg btn-light-blue tooltips " data-placement="top" data-original-title="Follow this person" ><i class=" connectBtnIcon fa fa-link "></i>  Follow this person</a>
								<a href="javascript:;" class="disconnectBtn btn btn-lg btn-light-blue tooltips " data-placement="top" data-original-title="Unfollow this person" ><i class=" disconnectBtnIcon fa fa-unlink "></i>  Unfollow this person</a>
								<hr>
								<h2 id="ficheName" name="ficheName"></h2>
								<span id="email" name="email" ></span><br><br>
								<span id="address" name="address" ></span><br><br>
								<span id="tags" name="tags" ></span><br>
							</div>
						</div>
		               	<div class ="row">
			               	<div class="col-md-10  col-md-offset-1">	
								<h4><a href="javascript:backToSearch()"><i class="fa fa-search"></i> Search</a></h4>
							</div>
						</div>
					</div>
					<div class="row" id="step3">
						<div class="row margin-bottom-10">
							<div class="col-md-1 col-md-offset-1" id="iconUser">	
					           	<i class="fa fa-user fa-2x"></i>
					       	</div>
					       	<div class="col-md-9">
								<input class="invite-name form-control" placeholder="Name" id="inviteName" name="inviteName" value="" />
							</div>
						</div>
						<div class="row margin-bottom-10">
							<div class="col-md-1 col-md-offset-1">	
				           		<i class="fa fa-envelope-o fa-2x"></i>
				           	</div>
		    	        	<div class="col-md-9">
								<input class="invite-email form-control" placeholder="Email" id="inviteEmail" name="inviteEmail" value="" />
							</div>
						</div>
						<div class="row margin-bottom-10">
							<div class="col-md-1 col-md-offset-1">	
				           		<i class="fa fa-align-justify fa-2x"></i>
				           	</div>
		    	        	<div class="col-md-9">
								<textarea class="invite-text form-control" id="inviteText" name="inviteText" rows="4" />
							</div>
						</div>
						<div class="row margin-bottom-10">
							<div class="col-md-2 col-md-offset-1">
								<div class="form-group">
						    	    <button class="btn btn-primary" id="btnInviteNew" >Inviter</button>
						    		<button class="btn btn-primary btnCancel" id="btnCancelStep3" >Cancel</button>
						    	</div>
						    </div>
					    </div>
					</div>
				</form>
			</div>
		</div>
		<div class="panel panel-white" id="divGmail">
        	<div class="panel-heading border-light">
        		Inviter vos contacts Gmail
			</div>
			<div class="panel-body">
				<form class="form-gmail" autocomplete="off">
					<div class="col-sm-12 col-xs-12">
						<a href="#" id="buttonContactsGmail"
							class="btn btn-primary col-md-3">
							Récupérez vos contacts Gmail
						</a>
					</div>
				</form>
			</div>
		</div>
		<div class="panel panel-white" id="divGooglePlus">
        	<div class="panel-heading border-light">
        		Publier sur Google +, pour inviter vos amis a rejoindre Communecter
			</div>
			<div class="panel-body">
				<form class="form-googlePlus" autocomplete="off">
					<div class="col-sm-12 col-xs-12">
						<!-- Placez cette balise où vous souhaitez faire apparaître le gadget bouton "Partager". -->
						<div class="g-plus" data-action="share" data-height="24" data-href="https://www.communecter.org"></div>
						<!--<a  href="#" 
							class="g-interactivepost btn btn-primary col-md-3"
						    data-clientid="<?php //echo Yii::app()->params['google']['client_id'] ; ?>"
							data-contenturl="www.communecter.org"
							data-calltoactionlabel="INVITE"
							data-calltoactionurl="www.communecter.org"
							data-cookiepolicy="single_host_origin"
							data-prefilltext="Bonjour, J'ai découvert un réseau sociétal citoyen appelé Communecter - être connecter à sa commune. Tu peux agir concrétement autour de chez toi et découvrir ce qui s'y passe. Viens rejoindre le réseau sur communecter.org.">
							Partagez Communecter sur Google+
						</a> -->
					</div>
				</form>
			</div>
		</div>

		<div class="panel panel-white" id="divImportFile">
        	<div class="panel-heading border-light">
        		Selectionner un ficher csv qui contient les mails de vos contacts
			</div>
			<div class="panel-body">
				<form class="form-importFile" autocomplete="off">
					<div class="col-sm-12 col-xs-12">
						Fichier (CSV) : <input type="file" id="fileEmail" name="fileEmail" accept=".csv">
					</div>
				</form>
			</div>
		</div>


		
		<div class="panel panel-white" id="divWriteMails">
        	<div class="panel-heading border-light">
        		Copier vos emails, séparé par des points-virgules.
			</div>
			<div class="panel-body">
				<form class="form-writeMails" autocomplete="off">
					<div class="col-sm-12 col-xs-12">
						<div class="col-sm-5 col-xs-12">
							<textarea id="textareaMails" class="form-control col-sm-5" rows="5"></textarea>
						</div>
						<a href="#" class="btn btn-primary col-sm-2" id="submitAfficher">Afficher</a>
					</div>
				</form>
			</div>
		</div>

		<div class="panel panel-white" id="divCheckMail">
        	<div class="panel-body">
        		<div id="checkMail" class="col-sm-12 col-xs-12">
					<div class="list-group col-sm-5">
						<span class="list-group-item active">
							<div>Liste des contacts 
							<div id="nbContact" class="text-right"></div></div>
						</span>
						<span class="list-group-item">
							<input type='checkbox' id='allchecked'/><label id="textallchecked" for="allchecked">Tout cocher</label>	
						</span>
						<div id="list-contact" class="panel-scroll row-fluid height-300"> </div>
		       		</div>
		        	<div id="Messages" class="col-sm-5">
		        		<label for="textmail" class="control-label">Votre Message :</label>
		        		<textarea id="textmail" class="form-control" rows="5">Bonjour, J'ai découvert un réseau sociétal citoyen appelé "Communecter - être connecter à sa commune". 
Tu peux agir concrétement autour de chez toi et découvrir ce qui s'y passe. Viens rejoindre le réseau sur communecter.org.</textarea>
		        		<div class="col-sm-12">&nbsp;</div>
		        		<a href="#" class="btn btn-primary col-sm-2" id="submitInviter">Inviter</a>
					</div>
				</div>
			</div>
		</div>
</div>
<!-- Function utiliser pour faire des appels aux API de google -->

<!-- Placez cette balise dans l'en-tête ou juste avant la balise de fermeture du corps de texte. -->
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'fr'}
</script>


<!--<script type="text/javascript">
(function(){
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/client:plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script> -->

<script src="https://apis.google.com/js/client.js"></script>
<script type="text/javascript">

var userId = "<?php echo Yii::app()->session["userId"]; ?>";
var googleID = "<?php echo Yii::app()->params['google']['client_id']; ?>";
var keyApp = "<?php echo Yii::app()->params['google']['keyAPP']; ?>";
var currentUser = <?php echo json_encode($currentUser) ?>;
var tags;

var subViewElement, subViewContent;
var timeout;
var tabObject = [];


jQuery(document).ready(function() {
 	initSubView();
 	bindInviteSubViewInvites();
 	runinviteFormValidation();

 	$(".moduleLabel").html("<i class='fa fa-plus'></i> <i class='fa fa-user'></i> Inviter quelqu'un");
});

function bindInviteSubViewInvites() {
	$("#menuInviteSomeone").click(function() {
		fadeInView("divInviteSomeone");
		$("#shareForm").hide();
	});

	$("#menuGmail").click(function() {
		fadeInView("divGmail");
		$("#shareForm").hide();
	});

	$("#menuGooglePlus").click(function() {
		fadeInView("divGooglePlus");
		$("#shareForm").hide();
	});

	$("#menuImportFile").click(function() {
		fadeInView("divImportFile");
		$("#shareForm").hide();
	});
	$("#menuWriteMails").click(function() {
		fadeInView("divWriteMails");
		$("#shareForm").hide();
	});

	$('#allchecked').change(function() { 
		console.log("allchecked");          
        var cases = $("#list-contact").find('[name=mailPersonInvite]'); // on cherche les checkbox qui dépendent de la liste 'list-contact'
        if(this.checked)
        { // si 'allchecked' est coché
            cases.attr('checked', true); // on coche les cases
            $('#textallchecked').html('Tout décocher'); // mise à jour du texte de cocheText
        }else
        { // si on décoche 'allchecked'
            cases.attr('checked', false);// on coche les cases
            $('#textallchecked').html('Tout cocher');// mise à jour du texte de cocheText
        }          
               
    });
	$(".btnCancel").off().on('click', function(){
		backToSearch();
	});

	$("#buttonContactsGmail").off().on('click', function(){
		console.log("buttonContactsGmail");
		auth();
    	
	});

	$(".form-writeMails #submitAfficher").off().on('click', function(){
		var listemail = $('.form-writeMails #textareaMails').val().replace(/\s/g,"");
  		arraymail = listemail.split(';');
  		$("#list-contact").html("");
  		var text = "" ;
  		var nbContact = 0 ; 
  		$.each(arraymail, function(keyMails, valueMails){
  			nbContact++;
        	text += '<span class="list-group-item"><input name="mailPersonInvite" type="checkbox" aria-label="'+valueMails.trim()+'" value="'+valueMails.trim()+'">'+valueMails.trim()+'</span>';
        	
        });
        $("#nbContact").html(nbContact + " contacts");
  		$("#list-contact").append(text);
        $("#divCheckMail").show();
  	});

	$(".form-importFile #fileEmail").change(function(e) {
		console.log("YOYOYO");
    	$("#list-contact").html("");
		var ext = $(".form-importFile input#fileEmail").val().split(".").pop().toLowerCase();
		if($.inArray(ext, ["csv"]) == -1) {
			alert('Upload CSV');
			return false;
		} 

		var nbContact = 0 ; 
		if (e.target.files != undefined) {
			var reader = new FileReader();
			reader.onload = function(e) {
				var csvval=e.target.result.split("\n");
				var text = "" ;
				$.each(csvval, function(keyMails, valueMails){
					console.log("valueMails",valueMails);
					if(valueMails.trim() != ""){
						nbContact++;
						text += '<span class="list-group-item"><input name="mailPersonInvite" type="checkbox" aria-label="'+valueMails.trim()+'" value="'+valueMails.trim()+'">'+valueMails.trim()+'</span>';
					}	
				});
				$("#list-contact").append(text);
			};
			reader.readAsText(e.target.files.item(0));

		}

		$("#nbContact").html(nbContact + " contacts");
		$("#divCheckMail").show();
		return false;
	});

	$(".connectBtn").off().on("click", function() {
		connectPerson($('#newInvite #inviteId').val(), function(user){
			console.log('callback connectPerson')
			if( isNotSV )
				loadByHash( "#person.directory" );
			else if(updateInvite != undefined && typeof updateInvite == "function"){
				updateInvite(user, false, false);
			}
			$.hideSubview();

		});
	});
	$(".disconnectBtn").off().on("click", function() {
		var idToDisconnect = $('#newInvite #inviteId').val();
		var typeToDisconnect = "<?php echo Person::COLLECTION ?>";
		var nameToDisconnect = $("#newInvite #ficheName").text();
		disconnectPerson(idToDisconnect, typeToDisconnect, nameToDisconnect, function(id) {
			console.log('callback disconnectPerson')
			if( isNotSV )
				loadByHash( "#person.directory" );
			else if(updateInvite != undefined && typeof updateInvite == "function"){
				updateInvite(id, false, true);
			}
			$.hideSubview();
		});
	});

	$('#inviteSearch').keyup(function(e){
	    var search = $('#inviteSearch').val();
	    if(search.length>2){
	    	clearTimeout(timeout);
			timeout = setTimeout('autoCompleteInviteSearch("'+encodeURI(search)+'")', 500); 
		 }else{
		 	$("#newInvite #dropdown_searchInvite").css({"display" : "none" });	
		 }	
	});


	$("#divCheckMail #submitInviter").off().on('click', function()
	{
		var mails = [];
		$('input:checked[name=mailPersonInvite]').each(function() {
		 	mails.push($(this).val());
		});
    	if(mails.length == 0)
    		toastr.error("Veuillez sélectionner une adresse mail.");
    	else{
    		$.each(mails, function(key, value) {
    			//console.log("value", value)
    			if(value != "on"){
			  		nameUtil = 	value.split("@");
				  	$.ajax({
				        type: "POST",
				        url: baseUrl+"/"+moduleId+'/person/connect',
				        dataType : "json",
				        data: {
				        	parentId : $("#parentId").val(),
				        	invitedUserName : nameUtil[0],
				        	invitedUserEmail : value,
				        	msgEmail : $("#textmail").val()
				        },
						type:"POST",
				    })
				    .done(function (data){
				    	$.unblockUI();
				        if (data &&  data.result) {               
				        	toastr.success('The invitation has been sent with success !');
				        	$.hideSubview();
				        	if( isNotSV )	
				        		showAjaxPanel( '/person/directory?isNotSV=1&tpl=directory2&type=<?php echo Person::COLLECTION ?>', 'MY PEOPLE','user' );
				        	else if(updateInvite != undefined && typeof updateInvite == "function"){
				        		updateInvite(data.invitedUser, true);
				        	} 
				        } else {
				        	$.unblockUI();
							toastr.error(data.msg);
				        }
				    });
				}
    		});
    	}
  	});
};


//validate new invite form
function runinviteFormValidation(el) {
	var forminvite = $('.form-invite');
	var errorHandler2 = $('.errorHandler', forminvite);
	var successHandler2 = $('.successHandler', forminvite);

	forminvite.validate({
		errorElement : "span", // contain the error msg in a span tag
		errorClass : 'help-block',
		errorPlacement : function(error, element) {// render error placement for each input type
			if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
				error.insertAfter($(element).closest('.form-group').children('div').children().last());
			} else if (element.parent().hasClass("input-icon")) {

				error.insertAfter($(element).parent());
			} else {
				error.insertAfter(element);
				// for other inputs, just perform default behavior
			}
		},
		ignore : "",
		rules : {
			inviteName : {
				minlength : 2,
				required : true
			},
			inviteEmail : {
				required : true
			}
		},
		messages : {
			inviteName : "* Please specify a name",
			inviteSearch : "* Please specify a email"
		},
		invalidHandler : function(invite, validator) {//display error alert on form submit
			successHandler2.hide();
			errorHandler2.show();
		},
		highlight : function(element) {
			$(element).closest('.help-block').removeClass('valid');
			// display OK icon
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
			// add the Bootstrap error class to the control group
		},
		unhighlight : function(element) {// revert the change done by hightlight
			$(element).closest('.form-group').removeClass('has-error');
			// set error class to the control group
		},
		success : function(label, element) {
			label.addClass('help-block valid');
			// mark the current input as valid and display OK icon
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
		},
		submitHandler : function(form) {
			console.log("submit handler");
			successHandler2.show();
			errorHandler2.hide();
			var parentId = $(".form-invite .invite-parentId").val();
			var invitedUserName = $("#inviteName").val();
			var invitedUserEmail = $("#inviteEmail").val();
			$.blockUI({
				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
	            '<blockquote>'+
	              '<p>Get up Stand up ! Stand up for your right !</p>'+
	              '<cite title="Bob Marley">Bob Marley</cite>'+
	            '</blockquote> '
			});
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+'/person/connect',
		        dataType : "json",
		        data: {
		        	parentId : parentId,
		        	invitedUserName : invitedUserName,
		        	invitedUserEmail : invitedUserEmail,
		        	msgEmail : $("#inviteText").val()
		        },
				type:"POST",
		    })
		    .done(function (data) {
		    	$.unblockUI();
		        if (data &&  data.result) {               
		        	toastr.success('The invitation has been sent with success !');
		        	$.hideSubview();
		        	if( isNotSV )	
		        		showAjaxPanel( '/person/directory?isNotSV=1&tpl=directory2&type=<?php echo Person::COLLECTION ?>', 'MY PEOPLE','user' );
		        	else if(updateInvite != undefined && typeof updateInvite == "function"){
		        		updateInvite(data.invitedUser, true);
		        	} 
		        } else {
		        	$.unblockUI();
					toastr.error(data.msg);
		        }
		    });
		}
	});
};

// init subview
function initSubView() {
	$(".form-invite .invite-parentId").val("<?php echo Yii::app()->session['userId']; ?>");
	$(".form-invite .invite-id").val("");
	$(".form-invite .invite-name").val("");
	$(".form-invite .invite-search").val("");
	$("#divGmail").hide();
	$("#divGooglePlus").hide();
	$("#divCheckMail").hide();
	$("#divImportFile").hide();
	$("#divImportFile").hide();
	$("#divWriteMails").hide();
};


function autoCompleteInviteSearch(search){
	tabObject = [];

	var data = { 
		"search" : search,
		"searchMode" : "personOnly"
	};
	
	
	ajaxPost("", '<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/'.$this->module->id?>/search/searchmemberautocomplete', data,
		function (data){
			var str = "<li class='li-dropdown-scope'><a href='javascript:newInvitation()'>Pas trouvé ? Lancer une invitation à rejoindre votre réseau !</li>";
			var compt = 0;
			var city, postalCode = "";
			$.each(data["citoyens"], function(k, v) { 
				city = "";
				postalCode = "";
				var htmlIco ="<i class='fa fa-user fa-2x'></i>"
				if(v.id != userId) {
					tabObject.push(v);
	 				if(v.profilImageUrl != ""){
	 					var htmlIco= "<img width='50' height='50' alt='image' class='img-circle' src='"+baseUrl+v.profilImageUrl+"'/>"
	 				}
	 				if (v.address != null) {
	 					city = v.address.addressLocality;
	 					postalCode = v.address.postalCode;
	 				}
	  				str += 	"<li class='li-dropdown-scope'>" +
	  						"<a href='javascript:setInviteInput("+compt+")'>"+htmlIco+" "+v.name + 
	  						//"<span class='city-search'> "+postalCode+" "+city+"</span>"+"</a>"+
	  						"</li>";
	  				compt++;
  				}
			});
			
			$("#newInvite #dropdown_searchInvite").html(str);
			$("#newInvite #dropdown_searchInvite").css({"display" : "inline" });
		}
	);	
}

function setInviteInput(num){
	var person = tabObject[num];
	var personId = person["id"];
	console.log(person, personId);

	$('#newInvite #inviteName').val(person["name"]);
	$('#newInvite #inviteId').val(personId);
	$("#newInvite #ficheName").text(person["name"]);
	
	if (person.address != null) {
		//Address : CP + Locality
		$("#newInvite #address").text(person.address.postalCode+" "+person.address.addressLocality);
	}
	
	if (person.email != null) {
		//Email
		$("#newInvite #email").text(person.email);
	}
	//Tags
	var tagsStr = "";
	if( "object" == typeof person.tags && person.tags ) {
		$.each( person.tags , function(i,tag){
			tagsStr += "<span class='label label-inverse'>"+tag+"</span> ";
		});
	} else {
		tagsStr += "<span class='label label-inverse'>No Tag</span> ";
	}
	$("#newInvite #tags").html('<div class="pull-left"><i class="fa fa-tags"></i> '+tagsStr+'</div>');
	$(".photoInvited").empty();
	if (person["profilImageUrl"] != "") {
		$(".photoInvited").html("<img class='img-responsive' src='"+baseUrl+person["profilImageUrl"]+"' />");
	} else {
		$(".photoInvited").html("<span><i class='fa fa-user_circled' style='font-size: 10em;'></i></span>");
	}

	//Pending
	if (person.pending == true) {
		$(".pending").show();
	} else {
		$(".pending").hide();
	}

	//Already in the network of the current user
	if (currentUser.links != null && currentUser.links.knows != null && currentUser.links.knows[personId] != null) {
		$('.disconnectBtn').show();
		$('.connectBtn').hide();
	} else {
		$('.disconnectBtn').hide();
		$('.connectBtn').show();
	}

	//Show / Hide steps
	$("#newInvite #step1").css({"display" : "none"});
	$("#newInvite #dropdown_searchInvite").css({"display" : "none" });	
	$("#newInvite #step2").css({"display" : "block"});
}

function newInvitation(){
	$("#newInvite #step1").css({"display" : "none"});
	$("#newInvite #step3").css({"display" : "block"});
	
	$('#newInvite #inviteId').val("");
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if(emailReg.test( $("#newInvite #inviteSearch").val() )){
		$('#newInvite #inviteEmail').val( $("#newInvite #inviteSearch").val());
	}else{
		$("#newInvite #inviteName").val($("#newInvite #inviteSearch").val());
	}

	$("#inviteText").val("Bonjour ! \nViens me rejoindre sur ce site ! \nUn email, un code postal et tu es communecter ! \ Tu peux voir tout ce qu'il se passe dans ta commune et agir pour le bien commun ! \n");
}

function backToSearch(){
	$("#newInvite #step1").css({"display" : "block"});
	$("#newInvite #dropdown_searchInvite").css({"display" : "none" });	
	$("#newInvite #step2").css({"display" : "none"});
	$("#newInvite #step3").css({"display" : "none"});

	autoCompleteInviteSearch($('#inviteSearch').val());
}


function fadeInView(inView){

	if(inView == "divGmail")
	{
		$("#divGmail").fadeIn("slow", function() {});
		$("#divInviteSomeone").hide();
		$("#divGooglePlus").hide();
		$("#divImportFile").hide();
		$("#divWriteMails").hide();
		$("#divCheckMail").hide();
		changeFocus("titleGmail");
	}
	else if(inView == "divInviteSomeone")
	{
		$("#divInviteSomeone").fadeIn("slow", function() {});
		$("#divGmail").hide();
		$("#divGooglePlus").hide();
		$("#divImportFile").hide();
		$("#divWriteMails").hide();
		$("#divCheckMail").hide();
		changeFocus("titleInviteSomeone");

	}
	else if(inView == "divGooglePlus")
	{
		$("#divGooglePlus").fadeIn("slow", function() {});
		$("#divInviteSomeone").hide();
		$("#divGmail").hide();
		$("#divImportFile").hide();
		$("#divWriteMails").hide();
		$("#divCheckMail").hide();
		changeFocus("titleGooglePlus");
	}
	else if(inView == "divImportFile")
	{
		$("#divImportFile").fadeIn("slow", function() {});
		$("#divInviteSomeone").hide();
		$("#divGmail").hide();
		$("#divGooglePlus").hide();
		$("#divWriteMails").hide();
		$("#divCheckMail").hide();
		changeFocus("titleImportFile");
	}
	else if(inView == "divWriteMails")
	{
		$("#divWriteMails").fadeIn("slow", function() {});
		$("#divInviteSomeone").hide();
		$("#divGmail").hide();
		$("#divGooglePlus").hide();
		$("#divImportFile").hide();
		$("#divCheckMail").hide();
		changeFocus("titleWriteMails");
	}

}



function changeFocus(newFocus){
	console.log("changeFocus", newFocus);
	var nameId = $(".titleInviteSV").attr('id');
	console.log("nameId", nameId);
	
	$( "#"+nameId ).removeClass("titleInviteSV");
	$( "#"+nameId ).removeClass("text-yellow");

	$( "#"+newFocus ).removeClass("text-grey");
	$( "#"+newFocus ).addClass("titleInviteSV");
	$( "#"+newFocus ).addClass("text-yellow");
	
	
}


function auth() {
	var config = {
		'client_id': googleID,
		'scope': 'https://www.google.com/m8/feeds'
	};
	gapi.auth.authorize(config, function() {
		getToken();

		//fetch(gapi.auth.getToken());
	});
}

function getToken(stop) {
	var token = gapi.auth.getToken();
	if(typeof token != "undefined"){
		fetch(token);
	}
	else {
		if(stop == false)
			getToken(true) ;
		else
			toastr.error("Veuillez réessayer plus tard.");
	}
}


/*function fetch(token) {
	$.ajax({
	  url: 'https://www.google.com/m8/feeds/contacts/default/full?access_token=' + token.access_token + '&alt=json',
	  dataType: 'jsonp',
	  data: token,
	}).done(function(data) {
		console.log("data",data);
	    //console.log(JSON.stringify(data));
	});
}*/

function fetch(token){
	console.log("fetch", token);
	var urlGmail = "https://www.google.com/m8/feeds/contacts/default/full?access_token=" + token.access_token + "&alt=json&max-results=10000&showdeleted=false"
	$.ajax({
  		url: urlGmail,
  		dataType: "jsonp",
  		success:function(data){
    		console.log("dataFetch", data);
    		$("#list-contact").html("");
    		
    		var nbContact = 0 ;
    		$.each(data.feed.entry, function(key, value){
    			//console.log("value", value);
    			//console.log("title", value.title);
      			var text = "";
      			if(value.gd$email){

      				$.each(value.gd$email, function( keyMails, valueMails ){
        				//console.log("valueMails.address", valueMails.address);
        				nbContact++;
        				text += '<span class="list-group-item"><input name="mailPersonInvite" type="checkbox" aria-label="'+valueMails.address+'" value="'+valueMails.address+'">';
        				//console.log("value.link", value.link);
        				/*if(value.link){
        					$.each(value.link, function( keyLink, valueLink ){
        						if(valueLink.type == "image/*"){
        							text += '<img width="50" height="50" src="'+valueLink.href+'">';

        						}	
        					});
        				}*/	
          				text += valueMails.address+'</span>';
          			});
        			$("#list-contact").append(text);
      			}
      		});
      		$("#nbContact").html(nbContact + " contacts");
      		$("#divCheckMail").show();
  		},
  		error:function(data){
  			console.log("error",data)
  		}
	});
}


/*function contactGmail(secondTime){
	var config = {
    	'client_id': '991320747617-dnqguopevn9bn3mg21nm1k12gj305anv.apps.googleusercontent.com',
    	//'scope': 'https://www.google.com/m8/feeds'
    	'scope': 'https://www.googleapis.com/auth/urlshortener'
    };
	
    gapi.auth.authorize(config, function() {
          console.log('login complete');
          console.log(gapi.auth.getToken());
        });

}

function getcontactGmail(authResult){
	console.log("authResult", authResult);
	var token = gapi.auth.getToken() ;
	if(typeof token != "undefined"){
		fetch(token);
	}
	else {
		if(stop == false)
			getcontactGmail(token) ; 
	}

}


var clientId = '991320747617-dnqguopevn9bn3mg21nm1k12gj305anv.apps.googleusercontent.com';
var apiKey = 'iStMgQekGCuepkvAWUc-BfkJ';
var scopes = 'https://www.googleapis.com/auth/plus.me';

function handleClientLoad() {
  console.log("handleClientLoad");
  gapi.client.setApiKey(apiKey);
  window.setTimeout(checkAuth,1);
}

function checkAuth() {
	console.log("checkAuth");
  gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
}

function handleAuthResult(authResult) {
	console.log("handleAuthResult", authResult);
  var authorizeButton = document.getElementById('authorize-button');
  if (authResult && !authResult.error) {
  	console.log("yo");
    authorizeButton.style.visibility = 'hidden';
    var token = gapi.auth.getToken() ;
    fetch(authResult);
  } else {
  	console.log("yo2");
    authorizeButton.style.visibility = '';
    authorizeButton.onclick = handleAuthClick;
  }
}

function handleAuthClick(event) {
	console.log("handleAuthResult");
  gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
  return false;
}

function makeApiCall() {
  gapi.client.load('plus', 'v1').then(function() {
    var request = gapi.client.plus.people.get({
        'userId': 'me'
          });
    request.then(function(resp) {
      var heading = document.createElement('h4');
      var image = document.createElement('img');
      image.src = resp.result.image.url;
      heading.appendChild(image);
      heading.appendChild(document.createTextNode(resp.result.displayName));

      document.getElementById('content').appendChild(heading);
    }, function(reason) {
      console.log('Error: ' + reason.result.error.message);
    });
  });
}
*/




</script>