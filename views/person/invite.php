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
	background-color: rgba(242, 242, 242, 0.6);
	width: 100%;
	-moz-box-shadow: 0px 0px 3px -1px #747474;
	-webkit-box-shadow: 0px 0px 3px -1px #747474;
	-o-box-shadow: 0px 0px 3px -1px #747474;
	box-shadow: 0px 0px 3px -1px #747474;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#cfcfcf, Direction=134, Strength=5);
}




/* design alpha tango*/
.main-col-search{
	background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/tango-circle-bg-yellow.png");
	background-size:100%;
	background-repeat: no-repeat;
	background-color: #ffffb5 !important;
}

.noteWrap .panel-white{
	background-color: rgba(0, 0, 0, 0);
	color: white;
	font-size: 15px;
	font-weight: 300;
}
.noteWrap .control-label{
	font-size:15px;
	font-weight:600;
}

.main-top-menu{
	background-color: rgba(255, 255, 255, 0.82) !important;
}
.select2-container .select2-choice .select2-arrow b::before{
	/*content:"";*/
}

.btn-select-type-orga {
	font-size: 14px;
}

.noteWrap input {
	text-align:left !important;
}
.noteWrap #description{
	word-wrap: break-word;
	resize: horizontal;
	max-height: 460px;
	overflow: scroll;
	max-width: 100%;
	width: 924px;
	min-height: 250px !important;
}
.input-icon > input {
    padding-left: 25px;
    padding-right: 6px;
}
input.form-control{
	text-align: left !important;
}


#newInvite .nav-tabs > li > a {
    border: 0 none;
    border-radius: 5px;
    color: #8E9AA2;
    min-width: 70px;
    padding: 5px !important;
    margin-bottom:10px;
}
#newInvite .nav-tabs > li > a {
	background-color: transparent !important;
}
#newInvite .nav-tabs > li > a > div:hover {
    background-color: #3C5665;
    color:white !important;
}
#newInvite .nav-tabs > li > a > div:focus {
    background-color: #3C5665;
    color:white !important;
}

#listEmailGrid{
	margin-top: 20px;
	background-color: transparent;
	padding: 15px;
	border-radius: 4px;
	/*border-right: 1px solid #474747;*/
	padding: 0px;
	width:100%;
}
#listEmailGrid .mix{
	margin-bottom: -1px !important;
}
#listEmailGrid  .item_map_list{
	padding:10px 10px 10px 0px !important; 
	margin-top:0px;
	text-decoration:none;
	background-color:white;
	border: 1px solid rgba(0, 0, 0, 0.08); /*rgba(93, 93, 93, 0.15);*/
	text-align: center;
}
#listEmailGrid  .item_map_list_blue{
	background-color:rgba(0, 0, 0, 0.08);
	padding:10px 10px 10px 0px !important; 
	margin-top:0px;
	text-decoration:none;
	border: 1px solid rgba(0, 0, 0, 0.08); /*rgba(93, 93, 93, 0.15);*/
	text-align: center;
}
#listEmailGrid .item_map_list .left-col .thumbnail-profil{
	width: 75px;
	height: 75px;
}
#listEmailGrid .ico-type-account i.fa{
	margin-left:11px !important;
}
#listEmailGrid .thumbnail-profil{
	margin-left:10px;
}
#listEmailGrid .detailDiv a.text-xss{
	font-size: 12px;
	font-weight: 300;
}

.panelLabel{
		margin-bottom:10px;
		margin-left:25px;
		color:#58879B;
		font-size:25px
	}

</style>

<?php 
$this->renderPartial('../default/panels/toolbar'); 
?>

<div id="newInvite">
	<ul class="nav nav-tabs">
		<li role="presentation">
			<a href="javascript:" class="" id="menuInviteSomeone">
				<div id="titleInviteSomeone" class='radius-10 padding-10 text-yellow text-dark'>
					<!-- <i class="fa fa-plus"></i>  -->
					<i class="fa fa-search fa-2x"></i> Rechercher ...
					<?php //echo Yii::t("person","Add a Person") ?>
				</div>
			</a>
		</li>
	  	<li role="presentation">
	  		<a href="#" class="" id="menuGmail">
	  			<div id="titleGmail" class='radius-10 padding-10 text-grey text-dark'>
	  				<i class="fa fa-envelope fa-2x"></i> 
					Gmail
				</div>
	  		</a>
	  	</li>
	  	<li role="presentation">
	  		<a href="javascript:" class="" id="menuGooglePlus">
	  			<div id="titleGooglePlus" class='radius-10 padding-10 text-grey text-dark'>
	  				<i class="fa fa-google-plus-square fa-2x"></i> 
					Google+
				</div>	  		
	  		</a>
	  	</li>
	  	<li role="presentation">
	  		<a href="javascript:" class="" id="menuImportFile">
	  			<div id="titleImportFile" class='radius-10 padding-10 text-grey text-dark'>
	  				<i class="fa fa-upload fa-2x"></i> 
					Importer un fichier
				</div>
	  		</a>
	  	</li>
	  	<li role="presentation">
	  		<a href="javascript:" class="" id="menuWriteMails">
	  			<div id="titleWriteMails" class='radius-10 padding-10 text-grey text-dark'>
	  				<i class="fa fa-pencil-square-o fa-2x"></i> 
					Saisir
				</div>
	  		</a>
	  	</li>
	</ul>	
	<?php 
	$size = "col-md-12";
	?>
	<div class="<?php echo $size ?>" style="margin-top:20px;">
		<!-- Partie "Invite Someone" -->
       	<div class="panel panel-white" id="divInviteSomeone">
        	<div class="panel-heading border-light">
        		<h3 class="text-dark">  <?php echo Yii::t("person","Find people you know by name or email") ?>. </h3>
			</div>
			
			<div class="panel-body">

				<form class="form-invite" autocomplete="off">
					<input class="invite-parentId hide"  id="inviteParentId" name="inviteParentId" type="text"/>
					<input class="invite-id hide" id = "inviteId" name="inviteId" type="text"/>
					<div class="row" id="step1">
						<div class="col-md-1 text-right" style="margin-top:5px;">	
			           		<i class="fa fa-search fa-2x"></i> 
			           	</div>
						<div class="col-md-10">
							<div class="form-group">
								<input class="invite-search form-control text-left" placeholder="Un nom, un e-mail ..." autocomplete = "off" id="inviteSearch" name="inviteSearch" value="">
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
								<a href="javascript:;" class="connectBtn btn btn-lg btn-light-blue tooltips " data-placement="top" data-original-title="<?php echo Yii::t("common","Follow this person") ?>" ><i class=" connectBtnIcon fa fa-link "></i>  <?php echo Yii::t("common","Follow this person") ?></a>
								<a href="javascript:;" class="disconnectBtn btn btn-lg btn-light-blue tooltips " data-placement="top" data-original-title="<?php echo Yii::t("common","Unfollow this person")?>" ><i class=" disconnectBtnIcon fa fa-unlink "></i>  <?php echo Yii::t("common","Unfollow this person") ?></a>
								<hr>
								<h2 id="ficheName" name="ficheName"></h2>
								<span id="email" name="email" ></span><br><br>
								<span id="address" name="address" ></span><br><br>
								<span id="tags" name="tags" ></span><br>
							</div>
						</div>
		               	<div class ="row">
			               	<div class="col-md-10  col-md-offset-1">	
								<h4><a href="javascript:backToSearch()"><i class="fa fa-search"></i> Rechercher</a></h4>
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
							<div class="col-md-11">
								<div class="form-group">
						    	    <button class="btn bg-dark pull-right" id="btnInviteNew" >Inviter</button> 
						    		<button class="btn btn-danger pull-right btnCancel" style="margin-right:10px;" id="btnCancelStep3" >Annuler</button>
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
						<a href="#" class="btn bg-dark col-sm-2" id="submitAfficher">Afficher</a>
					</div>
				</form>
			</div>
		</div>
		<div class="panel panel-white" id="divCheckMail">
        	<div class="panel-body">
        		<div id="checkMail" class="col-sm-12 col-xs-12">
        			<div class="homestead panelLabel pull-left">
							<i class="fa fa-edit"></i>
							<label for="textmail" class="control-label">Message</label>
					</div>
        			<div id="Messages" class="col-sm-12 col-xs-12">
		        		<textarea id="textmail" class="form-control" rows="3">Bonjour, J'ai découvert un réseau sociétal citoyen appelé "Communecter - être connecter à sa commune". 
Tu peux agir concrétement autour de chez toi et découvrir ce qui s'y passe. Viens rejoindre le réseau sur communecter.org.</textarea>
		        		<div class="col-sm-12">&nbsp;</div>
					</div>
					
						<div class="homestead panelLabel pull-left">
							<i class="fa fa-users"></i>
							Liste des contacts 		
						</div>
				
					<div class="col-sm-12 col-xs-12">
						<div  id="nbContact" class="homestead pull-left">
						</div>
						<select id="selectContact" class="col-sm-offset-2">
							<option value="all">Tous les contacts</option>
							<option value="2015-01-01">Depuis 2015</option>
							<option value="2014-01-01">Depuis 2014</option>
							<option value="2013-01-01">Depuis 2013</option>
							<option value="2012-01-01">Depuis 2012</option>
							<option value="2011-01-01">Depuis 2011</option>
							<option value="2010-01-01">Depuis 2010</option>
							<option value="2009-01-01">Depuis 2009</option>
							<option value="2008-01-01">Depuis 2008</option>
							<option value="2007-01-01">Depuis 2007</option>
							<option value="2006-01-01">Depuis 2006</option>
							<option value="2005-01-01">Depuis 2005</option>
							<option value="2004-01-01">Depuis 2004</option>
							<option value="2003-01-01">Depuis 2003</option>
							<option value="2002-01-01">Depuis 2002</option>
							<option value="2001-01-01">Depuis 2001</option>
							<option value="2000-01-01">Depuis 2000</option>
						</select>	
					</div>
					<br/>	
					<div class="panel-scroll row-fluid height-300">
		        		<ul id="listEmailGrid" class="pull-left  list-unstyled">
						</ul>
					</div>
					<br/>
					<div class="col-sm-12 col-xs-12 pull-center">
		        		<a href="#" class="btn bg-dark col-sm-2 " id="submitInviter">Inviter</a>
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

var listMails = [];
var totalMails = 0;
var subViewElement, subViewContent;
var timeout;
var tabObject = [];

var listFollows = <?php echo json_encode($follows) ?>;
var listFollowsId =<?php echo json_encode($listFollowsId) ?>;
console.log("listFollowsazaza", listFollows);


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

	$("#selectContact").change(function() {
		var nbc = 0 ;
		if($("#selectContact").val() == "all"){
			for (i = 1; i < totalMails; i++) { 
			    $("#contact"+i).show();
			    nbc++;
			}

			setNbContact(nbc);
		}else{

			var date1 = new Date($("#selectContact").val()).getTime() ;
			for (i = 1; i < totalMails; i++) { 
				var date2 =  new Date($("#contact"+i+"_update").val()).getTime();
				if(date2 >= date1)
			    {
			    	$("#contact"+i).show();
			    	nbc++;
			    }	
			    else
			    	$("#contact"+i).hide();
			}
			setNbContact(nbc);
		}

	});


	/*$('#allchecked').change(function() { 
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
               
    });*/
	$(".btnCancel").off().on('click', function(){
		backToSearch();
	});

	/*$("#buttonContactsGmail").off().on('click', function(){
		console.log("buttonContactsGmail");
		auth();
    	
	});*/

	$(".form-writeMails #submitAfficher").off().on('click', function(){
		var listemail = $('.form-writeMails #textareaMails').val().replace(/\s/g,"");
  		arraymail = listemail.split(';');
  		//$("#list-contact").html("");
  		$("#listEmailGrid").html("");
  		var text2 = "" ;
  		var nbContact = 0 ; 
  		$.each(arraymail, function(keyMails, valueMails){

  			if(jQuery.inArray(valueMails, listFollows) == -1 ){
  				nbContact++;
	  			idMail = "contact"+nbContact ;
	        	text2 += '<li id="'+idMail+'" class="item_map_list col-lg-3 col-md-4 col-sm-6 col-xs-6" data-cat="1" style="display: inline-block;">'+
	          							'<a href="javascript:;" onclick="checkedMail(\''+idMail+'\', \''+valueMails.trim()+'\');">'+
	          								'<div style="position:relative;">'+
	          									'<div class="portfolio-item">'+
	          										'<div class="detailDiv">'+
	          											'<span class="thumb-info item_map_list_panel"></span><br/>'+
	          											'<span class="text-xss" >'+ valueMails.trim() + '</span><br/>'+
	          											'<div class=" scopes5694ea2a94ef47ad1c8b456dperson features"></div>'+
	          							'<br/><div></div></div></div></div></a></li>';
  			}

        });
		$("#listEmailGrid").append(text2);
		totalMails = nbContact ;
        setNbContact() ;
        $("#divCheckMail").show();
  	});
	
	$(".form-importFile #fileEmail").change(function(e) {
		$("#list-contact").html("");
    	$("#listEmailGrid").html("");
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
				var text2 = "" ;
				listMails = [];
				$.each(csvval, function(keyMails, valueMails){
					//console.log("valueMails",valueMails);
					if(valueMails.trim() != ""){
						if(jQuery.inArray(valueMails.trim(), listFollows) == -1 ){
	  						nbContact++;
							//text += '<span class="list-group-item"><input name="mailPersonInvite" type="checkbox" aria-label="'+valueMails.trim()+'" value="'+valueMails.trim()+'">'+valueMails.trim()+'</span>';
							idMail = "contact"+nbContact ;

	          				text2 += '<li id="'+idMail+'" class="item_map_list col-lg-3 col-md-4 col-sm-6 col-xs-6" data-cat="1" style="display: inline-block;">'+
	          							'<a href="javascript:;" onclick="checkedMail(\''+idMail+'\', \''+valueMails.trim()+'\');">'+
	          								'<div style="position:relative;">'+
	          									'<div class="portfolio-item">'+
	          										'<div class="detailDiv">'+
	          											'<span class="thumb-info item_map_list_panel"></span><br/>'+
	          											'<span class="text-xss" >'+ valueMails.trim() + '</span><br/>'+
	          											'<div class=" scopes5694ea2a94ef47ad1c8b456dperson features"></div>'+
	          							'<br/><div></div></div></div></div></a></li>';
	          			}
					}	
				});
				//$("#totalContact").html(nbContact);
				totalMails = nbContact;
				setNbContact();
				$("#listEmailGrid").append(text2);	
				//$("#list-contact").append(text);
			};
			reader.readAsText(e.target.files.item(0));
			$("#divCheckMail").show();
		}else{
			toastr.error("Nous n'avons pas réussie à lire votre fichier.")
		}
		
		
		
		return false;
	});

	$(".connectBtn").off().on("click", function() {
			var thiselement = this;
			follow("<?php echo Person::COLLECTION ?>", $('#newInvite #inviteId').val(), userId, "<?php echo Person::COLLECTION ?>", function(){
			console.log('callback connectPerson');
			$(thiselement).children().removeClass("fa-spinner fa-spin").addClass("fa-link");			
			$('.disconnectBtn').show();
			$('.connectBtn').hide();
			listFollowsId.push($("#newInvite #inviteId").val());
			//$(thiselement).html("<i class='connectBtnIcon fa fa-link'></i><?php echo Yii::t("common","Follow this person") ?>");
			//$(thiselement).attr("data-original-title", "<?php echo Yii::t("common","Unfollow this person") ?>");
			$('#inviteSearch').val("");
			backToSearch();
			//loadByHash( "#person.directory" );
		});
	});
	$(".disconnectBtn").off().on("click", function() {
		var thiselement = this;
		var idToDisconnect = $('#newInvite #inviteId').val();
		var typeToDisconnect = "<?php echo Person::COLLECTION ?>";
		var nameToDisconnect = $("#newInvite #ficheName").text();
		disconnectTo("<?php echo Person::COLLECTION ?>",idToDisconnect,userId,"<?php echo Person::COLLECTION ?>",'followers',function() {
			console.log('callback disconnectPerson');
			$(thiselement).children().removeClass("fa-spinner fa-spin").addClass("fa-unlink");
			//// Find and remove item from an array
			var i = listFollowsId.indexOf(idToDisconnect);
			if(i != -1) {
				listFollowsId.splice(i, 1);
			}
			$('.disconnectBtn').hide();
			$('.connectBtn').show();
			$('#inviteSearch').val("");
		console.log(listFollowsId);
			backToSearch();
			//loadByHash( "#person.directory" );
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
		/*var mails = [];
		$('input:checked[name=mailPersonInvite]').each(function() {
		 	mails.push($(this).val());
		});*/
    	if(listMails.length == 0)
    		toastr.error("Veuillez sélectionner une adresse mail.");
    	else{
    		var nameUtil = "" ;
    		console.log("listMails", listMails);
    		$.each(listMails, function(key, value) {
    			console.log("value", value)
    			if(value.mail != ""){
    				if(typeof value.name != "undefined" && value.name != "")
    					nameUtil = value.name;
    				else
					{
						var name = 	value.mail.split("@");
						nameUtil = name[0];
					}	
				  	console.log("nameUtil", nameUtil);
				  	$.ajax({
				        type: "POST",
				        url: baseUrl+"/"+moduleId+'/person/follows',
				        dataType : "json",
				        data: {
				        	parentId : $("#parentId").val(),
				        	invitedUserName : nameUtil,
				        	invitedUserEmail : value.mail,
				        	msgEmail : $("#textmail").val()
				        },
						type:"POST",
				    })
				    .done(function (data){
				    	$.unblockUI();
				        if (data &&  data.result) {               
				        	toastr.success('L\'invitation a été envoyée avec succès!');
				        	//$.hideSubview();
				        	
				        	console.log(data);
				        	addFloopEntity(formData.invitedUser._id.$id, <?php echo Person::COLLECTION ?>, data.invitedUser);
				        	$('#inviteSearch').val("");
							backToSearch();
							
				        	//showAjaxPanel( '/person/directory?tpl=directory2&type=<?php echo Person::COLLECTION ?>', 'MY PEOPLE','user' );
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
				message : '<span class="homestead"><i class="fa fa-spin fa-circle-o-noch"></i> Merci de patienter ...</span>'
			});
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+'/person/follows',
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
		        	toastr.success('L\'invitation a été envoyée avec succès!');
		        	//$.hideSubview();
		        	console.log(data);
		        	addFloopEntity(data.invitedUser.id, "<?php echo Person::COLLECTION ?>", data.invitedUser);
				      $('#inviteSearch').val("");
					backToSearch();

		        	//showAjaxPanel( '/person/directory?tpl=directory2&type=<?php echo Person::COLLECTION ?>', 'MY PEOPLE','user' );
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
				console.log(v);
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
	  						"<a href='javascript:setInviteInput("+compt+")'>"+htmlIco+" "+v.name ;

	  				if(typeof postalCode != "undefined")
	  					str += "<br/>"+postalCode+" "+city;
	  					//str += "<span class='city-search'> "+postalCode+" "+city+"</span>" ;
	  				str += "</a></li>";

	  				compt++;
  				}
			});
			
			$("#newInvite #dropdown_searchInvite").html(str);
			$("#newInvite #dropdown_searchInvite").css({"display" : "inline" });
		}
	);	
}

function setInviteInput(num){
	console.log(num);
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
	if (listFollowsId.indexOf(personId) != -1) {
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
		//changeFocus("titleGmail");
		auth();
	}
	else if(inView == "divInviteSomeone")
	{
		$("#divInviteSomeone").fadeIn("slow", function() {});
		$("#divGmail").hide();
		$("#divGooglePlus").hide();
		$("#divImportFile").hide();
		$("#divWriteMails").hide();
		$("#divCheckMail").hide();
		//changeFocus("titleInviteSomeone");

	}
	else if(inView == "divGooglePlus")
	{
		$("#divGooglePlus").fadeIn("slow", function() {});
		$("#divInviteSomeone").hide();
		$("#divGmail").hide();
		$("#divImportFile").hide();
		$("#divWriteMails").hide();
		$("#divCheckMail").hide();
		//changeFocus("titleGooglePlus");
	}
	else if(inView == "divImportFile")
	{
		$("#divImportFile").fadeIn("slow", function() {});
		$("#divInviteSomeone").hide();
		$("#divGmail").hide();
		$("#divGooglePlus").hide();
		$("#divWriteMails").hide();
		$("#divCheckMail").hide();
		//changeFocus("titleImportFile");
	}
	else if(inView == "divWriteMails")
	{
		$("#divWriteMails").fadeIn("slow", function() {});
		$("#divInviteSomeone").hide();
		$("#divGmail").hide();
		$("#divGooglePlus").hide();
		$("#divImportFile").hide();
		$("#divCheckMail").hide();
		//changeFocus("titleWriteMails");
	}

}



/*function changeFocus(newFocus){
	console.log("changeFocus", newFocus);
	var nameId = $(".titleInviteSV").attr('id');
	console.log("nameId", nameId);
	
	$( "#"+nameId ).removeClass("titleInviteSV");
	$( "#"+nameId ).removeClass("text-yellow");

	$( "#"+newFocus ).removeClass("text-grey");
	$( "#"+newFocus ).addClass("titleInviteSV");
	$( "#"+newFocus ).addClass("text-yellow");
	
	
}*/


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
			toastr.error("Veuillez réessayer plus taSrd.");
	}
}

function fetch(token){
	console.log("fetch", token);
	rand = Math.floor((Math.random() * 8) + 1);
	$.blockUI({message : '<div class="title-processing homestead"><i class="fa fa-spinner fa-spin"></i> Processing... </div>'
			+'<a class="thumb-info" href="'+proverbs[rand]+'" data-title="Proverbs, Culture, Art, Thoughts"  data-lightbox="all">'
			+ '<img src="'+proverbs[rand]+'" style="border:0px solid #666; border-radius:3px;"/></a><br/><br/>'
			});
	var urlGmail = "https://www.google.com/m8/feeds/contacts/default/thin?access_token=" + token.access_token + "&alt=json&max-results=10000&showdeleted=false";
	


	if($("#selectContact").val() != "all")
		urlGmail += "&updated-min="+$("#selectContact").val();

	$.ajax({
  		url: urlGmail,
  		dataType: "jsonp",
  		success:function(data){
    		console.log("dataFetch", data);
    		$("#list-contact").html("");
    		
    		var nbContact = 0 ;
    		$.each(data.feed.entry, function(key, value){
    			var text = "";
      			var text2 = "";
      			if(value.gd$email){

      				$.each(value.gd$email, function( keyMails, valueMails ){
        				console.log("valueMails.address", valueMails.address);
        				console.log("valueMails.address", valueMails.address);
        				if(jQuery.inArray(valueMails.address, listFollows) == -1 ){
	        				nbContact++;
	          				idMail = "contact"+nbContact ;
	          				text2 += '<li id="'+idMail+'" class="item_map_list col-lg-3 col-md-4 col-sm-6 col-xs-6" data-cat="1" style="display: inline-block;">'+
	          							'<a href="javascript:;" onclick="checkedMail(\''+idMail+'\', \''+valueMails.address+'\', \''+value.title.$t+'\');">'+
	          								'<div style="position:relative;">'+
	          									'<div class="portfolio-item">'+
	          										'<div class="detailDiv">'+
	          											'<span class="thumb-info item_map_list_panel">'+ value.title.$t + '</span><br/>'+
	          											'<span class="text-xss" >'+ valueMails.address + '</span><br/>'+
	          											'<input type="hidden" name="'+idMail+'_update"  id="'+idMail+'_update" value="'+value.updated.$t+'"/>'+
	          											'<div class=" scopes5694ea2a94ef47ad1c8b456dperson features"></div>'+
	          							'<br/><div></div></div></div></div></a></li>';
	          			}
					});
        			$("#list-contact").append(text);
        			$("#listEmailGrid").append(text2);
      			}
      		});
			totalMails = nbContact; 
      		setNbContact();
      		$("#divCheckMail").show();
      		$.unblockUI();
  		},
  		error:function(data){
  			console.log("error",data)
  		}
	});

	bindInviteSubViewInvites();
}


function validMail() {
	//checklinkmailwithuser
	var res = [] ;
	$.ajax({
        type: "POST",
        url: baseUrl+'/communecter/person/checklinkmailwithuser/',
        dataType : "json",
        async : false ,
		success:function(data){
			console.log("data", data)

			$.each(data.follows, function(key, val) {
				if(typeof val.email != "undefined" && val.email != ""){
					res.push(val.email);
				}
			});
  		},
  		error:function(data){
  			console.log("error",data)
  		}
    });

	console.log("mails", res);
    return res ;
}


function checkedMail(id, mail, name) {
	var contact = {} ;
	contact["mail"] = mail ;
	contact["name"] = name ;

	var newArray = [] ;

	var find = false ;
	$.each(listMails, function(key, val) {
		if(mail == val.mail){
			find = true ;
		}else{
			newArray.push(val);
		}
	});

	listMails = newArray ;
	if(find == true){
		$( "#"+id ).removeClass("item_map_list_blue");
		$( "#"+id ).addClass("item_map_list");
		
	}else{
		$( "#"+id ).removeClass("item_map_list");
		$( "#"+id ).addClass("item_map_list_blue");
		listMails.push(contact);
	}

	setNbContact()
	bindInviteSubViewInvites();
};


function setNbContact(total) {
	if(typeof total == "undefined")
		$("#nbContact").html(listMails.length + " / " + totalMails + " contacts sélectionné(s)");
	else
		$("#nbContact").html(listMails.length + " / " + total + " contacts sélectionné(s)");
}
</script>