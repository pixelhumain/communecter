<?php
	
$cssAnsScriptFilesModule = array(
	'/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
	'/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js'
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule,Yii::app()->request->baseUrl);
?>
<style>
	#dropdown_search{
		padding: 0px 15px; 
		margin-left:2%; 
		width:96%;
	}
	#dropdown_search .li-dropdown-scope ol {
    	color: #155869;
    	padding: 5px 5px 5px 15px !important;
	}

	#addMemberSection{
		display: none;
	}

	#iconeChargement{
		visibility: hidden;
	}
	#divAdmin{
		display: none;
	}
	#addMemberForm{
		padding: 20px;
	}
	#formNewMember{
		display: none;
	}
	#addMembers{
		display: block;
		float: left;
		padding: 10px;
		background-color: rgba(242, 242, 242, 0.9);
		width: 100%;
		box-shadow: 1px 1px 5px 3px #CFCFCF;
	}
	.li-dropdown-scope a{
		padding:15px 25px !important;
	}

/*
#addMembers .nav-tabs > li > a {
    border: 0 none;
    border-radius: 5px;
    color: #8E9AA2;
    min-width: 70px;
    padding: 5px !important;
    margin-bottom:10px;
}

#addMembers .nav-tabs > li > a {
	background-color: transparent !important;
}
#addMembers .nav-tabs > li > a > div:hover {
    background-color: #3C5665;
    color:white !important;
}
#addMembers .nav-tabs > li > a > div:focus {
    background-color: #3C5665;
    color:white !important;
}*/


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
	height: 150px;
}
#listEmailGrid  .item_map_list_blue{
	background-color:rgba(0, 0, 0, 0.08);
	padding:10px 10px 10px 0px !important; 
	margin-top:0px;
	text-decoration:none;
	border: 1px solid rgba(0, 0, 0, 0.08); /*rgba(93, 93, 93, 0.15);*/
	text-align: center;
	height: 150px;
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
.li-dropdown-add-members i.fa, .searchEntry i.fa{
	width:50px;
	height:50px;
	border-radius: 50%;
	background-color: #e7e7e7;
	padding-top: 11px;
	padding-left: 15px;
	margin-right: 6px;
	margin-left: 4px;
}
.li-dropdown-add-members i.fa{
	margin-left: 0px;
}
#dropdown_search .member-name{
	max-width:80%;
	margin-top:10px; 
	float:left;
}
#dropdown_search .li-dropdown-add-members .member-name{
	float:unset;
}


/* MODAL */

@media screen and (min-width: 768px) {
	#modalDirectoryForm #modal-scope .modal-dialog{
		width:760px
	}
}
#modalDirectoryForm  .modal-header, 
#modalDirectoryForm  .modal-footer{
	background-color: #EAEAEA;
	color: #2D6569;
}

#modalDirectoryForm  .modal-header button.close{
	color: 2D6569 !important;
	opacity: 0.6 !important;
}
#modalDirectoryForm  #list-scroll-type{
	max-height:400px;
	overflow-y:auto; 
	overflow-x:hidden; 
	padding-top:15px;
	border-left: 1px solid rgba(128, 128, 128, 0.26);
}
#modalDirectoryForm  #list-scroll-type .panel-default,
#modalDirectoryForm  #list-scroll-type .panel-heading,
#modalDirectoryForm  #list-scroll-type .panel-body{
	margin-bottom: 0px;
}
#modalDirectoryForm .modal .panel-heading{
	padding: 0px;
	min-height: auto;
	background-color: transparent;
	border: none;
}

#modalDirectoryForm .form-control{
	width:unset;
}
#modalDirectoryForm .modal input#search-contact{
	width: 66.66666667%;
	margin-top: -8px;
	margin-right: 0px;
	padding-left: 10px;
	padding-right: 10px;
	height: 52px;
	border-radius: 0px;
	text-align:left;
	background-color: rgba(255, 255, 255, 0.54);
}

#modalDirectoryForm .modal .panel-heading h4{
	margin:0px;
	font-size: 18px !important;
	background-color: rgba(114, 114, 114, 0.1);
	padding: 10px;
	border-radius: 0px;
}
#modalDirectoryForm .modal-body{
	padding: 0px 15px;
}

#modalDirectoryForm .panel-body{
	background-color: transparent !important;
}
#modalDirectoryForm .modal .panel{
	padding: 0px;
	background-color: transparent;
	border: none;
	box-shadow: none;
}
#modalDirectoryForm .modal ul{
	list-style: none !important;
	padding-left: 0px;
	margin-bottom:20px;
}

#modalDirectoryForm .modal .list-group{
	margin-bottom:0px !important;
}
#modalDirectoryForm .modal #list-scroll-type ul{
	margin-bottom:0px !important;
}
#modalDirectoryForm .modal #menu-type ul li{
	font-size:16px;
}
#modalDirectoryForm .modal #menu-type ul li i{
	width:20px;
	text-align: center;
}
#modalDirectoryForm .modal #menu-type ul li a:hover{
	color:inherit !important;	
	text-decoration: underline;
}
#modalDirectoryForm .modal .btn-scroll-type{
	border:none!important;
    padding: 3px;
    text-align: left;
    width: 100%;
}
#modalDirectoryForm .modal .btn-select-contact{
	min-width:70% !important;
}

#modalDirectoryForm .modal #menu-type .btn-scroll-type{
	border:none!important;
    padding: 2px;
	text-align: left;
	width: 92%;
	margin-left: 4%;
	padding: 6px 4px 4px 8px;
	margin-bottom: 3px;
	background:transparent !important;
}
#modalDirectoryForm .modal #menu-type .btn-scroll-type:hover{
	background-color:rgba(0, 0, 0, 0.04) !important;
}
#modalDirectoryForm .modal #scope-postal-code{
	width: 99%;
	display: none;
	margin-left: -1% !important;
}
#modalDirectoryForm .modal .info-contact{
	display: inline-block !important;
	vertical-align: middle;
}
#modalDirectoryForm .modal .scope-city-contact{
	text-overflow: ellipsis;
	white-space: nowrap;
	overflow: hidden;
	max-width: 160px;
	display: inline-block;
	height: 15px;
 } 
#modalDirectoryForm .modal .scope-name-contact{
	display: inline-block;
    vertical-align: middle;
    text-align: left;
    max-width: 200px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    font-size: 12px;
}
#modalDirectoryForm .modal .thumb-send-to {
    width: 35px;
    height: 35px;
    background-color: #DADADA;
    border-radius: 4px;
    margin:5px;
}
#modalDirectoryForm .modal .text-light{
	font-weight:500;
	color:#8C8C8C !important;
}
#modalDirectoryForm .modal #menu-type h4 {
    background-color: rgba(35, 83, 96, 0.15);
	color: #2D6569;
	width: 100%;
	float: left;
	padding: 10px 10px 10px 20px;
	margin: 0;
	margin-bottom: 10px;
}

#btn-submit-form{
	display: none;
}

.tools_bar{
	border-bottom: 1px solid lightgrey;
}

<?php 
if($type == Organization::COLLECTION){
	$formTitle = Yii::t("organisation","Add a member to this organization",null,Yii::app()->controller->module->id);
	$formDescription = Yii::t("organisation","An Organization can have People as members or Organizations",null,Yii::app()->controller->module->id);
} else if($type == Project::COLLECTION){
	$formTitle = Yii::t("project","Add a contributor to this project",null,Yii::app()->controller->module->id);
	$formDescription = Yii::t("project","A project can have People as contributors or Organizations",null,Yii::app()->controller->module->id);
} else if($type == Event::COLLECTION){
	$formTitle = Yii::t("event","Invite people to this event",null,Yii::app()->controller->module->id);
	$formDescription = Yii::t("event","Invite people to your event and manage its administration",null,Yii::app()->controller->module->id);
}
?>
/* MODAL */
</style>
<?php 
if(!@$_GET["renderPartial"])
	$this->renderPartial('../pod/headerEntity', array("entity"=>$element, "type" => $type, "openEdition" => $openEdition, "edit" => $edit, "firstView" => "addmembers"));  
?>
<div id="addmembersPad">
	<div id="addMembers">
	<?php   
  		if (@Yii::app()->params['betaTest'] && @$numberOfInvit) { 
  			$nbOfInvit = empty($numberOfInvit) ? 0 : $numberOfInvit;
  			?>

  			<div id="numberOfInvit" class="badge badge-danger pull-right tooltips" style="margin-top:5px; margin-right:5px;" data-count="<?php echo $nbOfInvit ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("login","Number of invitations left"); ?>"><?php echo $nbOfInvit ?> invitation(s)</div>
  	<?php
		}
	?>
    <!-- start: PAGE CONTENT -->
    <h2 class='radius-10 padding-10 text-bold text-dark text-left'> 
		<i class="fa fa-plus"></i> <i class="fa fa-2x fa-user"></i> 
		<?php echo $formTitle ?>
	</h2>

	<a href="javascript:;" onclick="fadeInView('divSearch');" class="btn btn-default pull-left margin-right-15" id="menuInviteSomeone">
		<div id="titleInviteSomeone" class='titleInviteSV text-dark'>
			<!-- <i class="fa fa-plus"></i>  -->
			<i class="fa fa-search"></i> Rechercher ...
			<?php //echo Yii::t("person","Add a Person") ?>
		</div>
	</a>
	<button class="btn btn-default pull-left margin-right-15" id="menuImportFile"
		data-toggle="modal" data-target="#modal-scope">
		<div id="titleImportFile" class='text-grey text-dark'>
			<i class="fa fa-users"></i> 
			Ajouter un contact
		</div>
	</button>
	<a href="javascript:;" onclick="fadeInView('divImportFile');" class="btn btn-default pull-left margin-right-15" id="menuImportFile">
		<div id="titleImportFile" class='text-grey text-dark'>
			<i class="fa fa-upload"></i> 
			Importer un fichier
		</div>
	</a>

	<?php //$this->renderPartial('../element/addMembersFromMyContacts',array("type"=>$type)); ?>

	<div class="col-md-12 margin-top-15">  

    	<ul class="nav nav-tabs hidden">
			<li role="presentation">
				<a href="javascript:;" onclick="fadeInView('divSearch');" class="btn btn-default" id="menuInviteSomeone">
					<div id="titleInviteSomeone" class='titleInviteSV radius-10 padding-10 text-dark'>
						<!-- <i class="fa fa-plus"></i>  -->
						<i class="fa fa-search"></i> Rechercher ...
						<?php //echo Yii::t("person","Add a Person") ?>
					</div>
				</a>
			</li>
		  	
			<li role="presentation">
		  		<a href="javascript:;" onclick="fadeInView('divImportFile');" class="btn btn-default" id="menuImportFile">
		  			<div id="titleImportFile" class='radius-10 padding-10 text-grey text-dark'>
		  				<i class="fa fa-upload"></i> 
						Importer un fichier
					</div>
		  		</a>
		  	</li>

		  	<li role="presentation">
		  		<a href="javascript:;" onclick="" class="" id="menuImportFile">
		  			<div id="titleImportFile" class='radius-10 padding-10 text-grey text-dark'>
		  				<div id="modalDirectoryForm"></div>
					</div>
		  		</a>
		  		
		  	</li>
		  	
		</ul>
       
        <div id="divSearch" class="panel panel-white">
        	<div class="panel-heading border-light">
        	
        		<blockquote>
        			<?php echo $formDescription ?>
        		</blockquote>
        	</div>
        	<div class="panel-body">
		    	 <div class="form-group" id="searchMemberSection" style="margin:0px;">
	    	    	<div class='row'>
						<div class="col-md-1">	
			           		<i class="fa fa-search fa-2x pull-right" style="padding-top: 6px;"></i> 
			           	</div>
			           	<div class="col-md-5 no-padding">
			           		<span class="input-icon input-icon-right">
					           	<input class="member-search form-control" placeholder="<?php echo Yii::t("organisation","Search by name, email",null,Yii::app()->controller->module->id) ?>" autocomplete = "off" id="memberSearch" name="memberSearch" value="">
					           		<i id="iconeChargement" class="fa fa-spinner fa-spin pull-left"></i>
					        		<ul class="dropdown-menu" id="dropdown_search" style="max-height:265px;overflow:scroll;">
										<li class="li-dropdown-scope">-</li>
									</ul>
							</span>
						</div>
					</div>
				</div>
		    	<form id="addMemberForm" style="line-height:40px; padding:0px;" autocomplete="off" submit='false'>
		    		<input type="hidden" id="parentOrganisation" name="parentOrganisation" value="<?php echo (string)$element["_id"]; ?>"/>
		    	    <input type="hidden" id="memberId" name="memberId" value=""/>
		            <div class="form-group" id="addMemberSection">
		            	<div class='row center'>
		            		<h4>Est-ce un citoyen ou une association ?</h4>
		            		<input type="hidden" id="memberType"/>
		            		<div class="btn-group ">
								<a id="btnCitoyen" href="javascript:;" onclick="switchType('citoyens')" class="btn btn-default btn-green">
									Citoyen
								</a>
								<a id="btnOrganization" href="javascript:;" onclick="switchType('organizations')" class="btn btn-default btn-green">
									Organisation
								</a>
							</div>
			            </div><br>
			            <div id="formNewMember" class="center">
			    	        <div class="row">
			    	        	<div class="col-md-1" id="iconUser">	
					           		
					           	</div>
					           	<div class="col-md-10">
			    	        		<input class="form-control" placeholder="Name" id="memberName" name="memberName" value=""/>
								</div>		    	        
			    	        </div>
			    	        <div class="row" id="divOrganizationType">
			    	        	<div class="col-md-1">
			    	        		<i class="fa fa-crosshairs fa-2x"></i>
					           	</div>
					           	<div class="col-md-10">
			    	        		<select class="form-control" placeholder="Organization Type" id="organizationType" name="organizationType">
									<option value=""></option>
									<?php foreach ($organizationTypes as $key => $value) { ?>
										<option value="<?php echo $key ?>"><?php echo $value?></option>
									<?php }	?>
								</select>
								</div>		    	        
			    	        </div>
			    	        <div class ="row">
			    	        	<div class="col-md-1">	
					           		<i class="fa fa-envelope-o fa-2x"></i>
					           	</div>
			    	        	<div class="col-md-10">
			               			<input class="member-email form-control" placeholder="Email" autocomplete = "off" id="memberEmail" name="memberEmail" value=""/>
			               		</div>
			               	</div>
			               	<div class="row">
								<div class="">
									<div id="divAdmin" class="form-group">
						    	    	<label class="control-label">
											Administrateur :
										</label><br>
										<input class="hide" id="memberIsAdmin" name="memberIsAdmin">
										<input type="checkbox" data-on-text="<?php echo Yii::t("common","Yes") ?>" data-off-text="<?php echo Yii::t("common","No") ?>" name="my-checkbox">
									</div>
								</div>
							</div>
			               	<div class ="row">
				               	<div class="col-md-10  col-md-offset-1 padding-10">	
									<button class="btn btn-primary pull-right saveBtn" style="margin-left:10px;"><?php echo Yii::t("common","Save") ?></button>
									<a href="javascript:showSearch()" class="btn btn-default pull-right" style="margin-left:10px;"><i class="fa fa-search"></i> <?php echo Yii::t("common","Search") ?></a>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
					    	        
					    	    </div>
					    	</div>
				    	</div>
		    	    </div>	    	   
		        </form>
	        </div>
        </div>

        <div class="panel panel-white" id="divImportFile">
        	<div class="panel-heading border-light text-dark">
        		<blockquote>
        			<strong>Selectionnez un ficher csv contenant les mails de vos membres.</strong>
        		</blockquote>
        		<blockquote>
        			Format à respecter : Email;Nom et Prénom;Type;TypeOrga
        		</blockquote>
        		<blockquote>
        			Important :<br/> 
        				- L'addresse e-mail est obligatoire, le reste est facultatif.<br/>
        				- La valeur du champ "Type" peut prendre les valeurs suivantes : citoyens ou organizations<br/>
        				- La valeur du champ "TypeOrga" peut prendre les valeurs suivantes : NGO, LocalBusiness, Group, GovernmentOrganization
        		</blockquote>
			</div>
			<div class="panel-body">
				<form class="form-importFile" autocomplete="off">
					<div class="col-xs-12">
						Fichier (CSV) : <input type="file" id="fileEmail" name="fileEmail" accept=".csv">
					</div>
				</form>
			</div>
			<div class="panel-body">
				<div id="checkMail">
        			<div class="homestead panelLabel pull-left">
						<i class="fa fa-users"></i>
						Liste des contacts 		
					</div>
					<div  id="nbContact" class="homestead pull-right"></div>
					<br/>	
					<div class="homestead panelLabel pull-left">
		        		<input type="checkbox" id="checkboxAll" name="checkboxAll"/><label for="checkboxAll">Cocher/Décocher tous les contacts</label>
					</div>
					<br/><br/>		
					<div class="panel-scroll row-fluid height-300">
		        		<ul id="listEmailGrid" class="pull-left  list-unstyled ">
						</ul>
					</div>
					<br/>
					<div class="col-xs-12 pull-center">
		        		<a href="#" class="btn bg-dark col-sm-2 " id="submitInviter" onclick="inviteImportFile();">Inviter</a>
					</div>
				</div>
			</div>
		</div>
    </div>
	<div class="row ">
	 	<div class="col-md-8 col-md-offset-2">
	        <table class="table table-striped table-bordered table-hover newMembersAddedTable hide">
	            <thead>
	                <tr>
	                    <th class="hidden-xs">Type</th>
	                    <th>Name</th>
	                    <th class="hidden-xs center">Email</th>
	                    <th>Admin</th>
	                    <th>Status</th>
	                </tr>
	            </thead>
	            <tbody class="newMembersAdded"></tbody>
	        </table>
	    </div>
	</div>
</div>
</div>
<?php if(!isset($_GET["renderPartial"])){ ?>
</div>
<?php } ?>

<script type="text/javascript">
	var timeout;
	var listMails = [];
	var totalMails = 0;
	var elementType= "<?php echo $type ?>";
	var elementId= "<?php echo (string)$element["_id"] ?>";
	var links= <?php echo json_encode($element["links"]) ;?>;
	//var element = <?php echo json_encode($element) ?>;
	
	jQuery(document).ready(function() {
		activeMenuElement("addmembers");
		initFormAddMember();
		
		bindTEST();
		//removeMembersInMyContact();
		//buildDynForm();
	});


	var mapIcon = {
		"citoyens":"fa-user", 
		"NGO":"fa-users",
		"LocalBusiness" :"fa-industry",
		"Group" : "fa-circle-o",
		"GovernmentOrganization" : "fa-university"
 	};
 	function bindTEST() {

 		$('#checkboxAll').change(function() { 
 			mylog.log("checkboxAll");
			if(this.checked)
	        { 
	        	allchecked(true);
	        }else{ 
	        	allchecked(false);
	        }          
	               
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
					file = [];
					var csvval=e.target.result.split("\n");
					mylog.log("csv : ", csvval );
					$.each(csvval, function(key, value){
		  				file.push(value.split(";"));
		  			});
		  			mylog.log("file : ", file );

					var text2 = "" ;
					listMails = [];
					$.each(file, function(keyContacts, valueContacts){
						//mylog.log("valueMails",valueMails);
						text2 = "" ;
						if(valueContacts[0].trim() != ""){
							//var res = validMail(valueMails.trim());
							var res = true;
	  						if(res == true){
		  						nbContact++;
								//text += '<span class="list-group-item"><input name="mailPersonInvite" type="checkbox" aria-label="'+valueMails.trim()+'" value="'+valueMails.trim()+'">'+valueMails.trim()+'</span>';
								idMail = "contact"+nbContact ;

		          				text2 += '<li id="'+idMail+'" class="item_map_list col-lg-4 col-md-4 col-sm-6 col-xs-6" data-cat="1" style="display: inline-block;">'+
	          								'<div style="position:relative;">'+
	          									'<div class="portfolio-item">'+
	          										'<div class="detailDiv">'+
	          											'<a href="javascript:;" onclick="checkedMail(\''+idMail+'\', \''+valueContacts[0].trim()+'\');">'+
		          											'<span class="thumb-info item_map_list_panel">'+ valueContacts[1].trim() + '</span><br/>'+
		          											'<span class="text-xss" >'+ valueContacts[0].trim() + '</span><br/>'+
		          											'<input type="hidden" id="'+idMail+'memberType"/>'+
		          											'<input type="hidden" id="'+idMail+'name" value="'+valueContacts[1].trim()+'"/>'+
		          											'<input type="hidden" id="'+idMail+'mail" value="'+valueContacts[0].trim()+'"/>'+
		          										'<br/>'+
		          										'</a>'+
	          											'<div id="'+idMail+'btn" class="btn-group ">'+
															'<button id="'+idMail+'btnCitoyen" href="javascript:;" onclick="switchTypeImport(\'citoyens\', \''+idMail+'\', \''+valueContacts[0].trim()+'\')" class="btn btn-default btn-green">'+
																'Citoyen'+
															'</button>'+
															'<button id="'+idMail+'btnOrganization" href="javascript:;" onclick="switchTypeImport(\'organizations\', \''+idMail+'\', \''+valueContacts[0].trim()+'\')" class="btn btn-default btn-green">'+
																'Organisation'+
															'</button>'+
														'</div>'+
														'<br/>'+
														'<div class="col-md-12 classOrganizationType" id="'+idMail+'divOrganizationType">'+
									    	        		'<select class="form-control" placeholder="Organization Type" id="'+idMail+'organizationType" name="'+idMail+'organizationType">'+
																'<?php foreach ($organizationTypes as $key => $value) { ?>'+
																	'<option value="<?php echo $key ?>"><?php echo $value?></option>'+
																'<?php }	?>'+
															'</select>'+
														'</div>'+
	          											'<br/>'+
	          											'<div></div>'+
	          										'</div>'+
	          									'</div>'+
	          								'</div>'+
	          							'</li>';
		          			}

		          			$("#listEmailGrid").append(text2);	
							$("#"+idMail+"organizationType").hide();
							mylog.log(valueContacts[0], valueContacts[1], valueContacts[2], valueContacts[3]);
							//if(typeof valueContacts[2] != "undefined"){
							if(typeof valueContacts[2] == "undefined" || valueContacts[2].trim() != "organizations")
								switchTypeImport('citoyens', idMail, valueContacts[0].trim());
							else if(valueContacts[2].trim() == "organizations"){
								switchTypeImport('organizations', idMail, valueContacts[0].trim());
								if(valueContacts[3].trim() == "NGO"){
									$('#'+idMail+'organizationType').val("NGO");
								}else if(valueContacts[3].trim() == "LocalBusiness"){
									$('#'+idMail+'organizationType').val("LocalBusiness");
								}else if(valueContacts[3].trim() == "Group"){
									$('#'+idMail+'organizationType').val("Group");
								}else if(valueContacts[3].trim() == "GovernmentOrganization"){
									$('#'+idMail+'organizationType').val("GovernmentOrganization");
								}else{
									$('#'+idMail+'organizationType').val("NGO");
								}
							}
							//}
						}
					});
					//$("#totalContact").html(nbContact);
					totalMails = nbContact;
					setNbContact();
					
					//$("#list-contact").append(text);
				};
				reader.readAsText(e.target.files.item(0));
				//checkboxAdmin();
				$("#checkMail").show();
			}else{
				toastr.error("Nous n'avons pas réussie à lire votre fichier.")
			}
			
			
			
			return false;
		});
	};

	function bindOrganizationSubViewAddMember() {	
		$(".addMembersBtn").off().on("click", function() {
			subViewElement = $(this);
			subViewContent = subViewElement.attr('href');
			$.subview({
				content : subViewContent,
				onShow : function() {
					initFormAddMember();
				},
				onHide : function() {
					hideFormAddMember();
				}
			});
		});

		$(".close-subview-button").off().on("click", function(e) {
			$(".close-subviews").trigger("click");
			e.prinviteDefault();
		});
	};
	function initFormAddMember(){ //checkMail
		$("#divImportFile").hide();
		$("#checkMail").hide();
		
		$("#addMembers #memberIsAdmin").val("false");
		$("[name='my-checkbox']").bootstrapSwitch();
		$("[name='my-checkbox']").on("switchChange.bootstrapSwitch", function (event, state) {
			mylog.log("state = "+state );
			if (state == true) {
				$("#addMembers #memberIsAdmin").val(1);
			} else {
				$("#addMembers #memberIsAdmin").val(0);
			}
			
		}); 
		$("#addMemberForm").off().on("submit",function(event){
	    	event.preventDefault();
	    	$(".saveBtn").html('<i class="fa fa-spinner fa-spin pull-left" style="font-size:19px;"></i>');
	    	var connectType = "member";
	    	if ($("#addMembers #memberIsAdmin").val() == true) connectType = "admin";
	    	var params = {
				"childId" : $("#addMembers #memberId").val(),
				"childName" : $("#addMembers #memberName").val(),
				"childEmail" : $("#addMembers #memberEmail").val(),
				"childType" : $("#addMembers #memberType").val(), 
				"organizationType" : $("#addMembers #organizationType").val(),
				"parentType" : "<?php echo $type;?>",
				"parentId" : $("#addMembers #parentOrganisation").val(),
				"connectType" : connectType
			};
			mylog.log(params);
	    	
	    	$.ajax({
	            type: "POST",
	            url: baseUrl+"/communecter/link/connect",
	            data: params,
	            dataType: "json",
	            success: function(data){
	            	if(!data.result){
	            		toastr.error(data.msg);
	            		$(".saveBtn").html('<?php echo Yii::t("common","Save") ?>');
	            		//checkIsLoggued();
	            	}
	            	else
	            	{
	            		toastr.success(data.msg);
	            		mylog.log(data);
	            		//if(typeof updateOrganisation != "undefined" && typeof updateOrganisation == "function")
		        		//	updateOrganisation( data.member,  $("#addMembers #memberType").val());
		               	setValidationTable(data.newElement,data.newElementType, false);
		               	mapType = data.newElementType;
		               	if(data.newElementType=="<?php echo Person::COLLECTION ?>")
		               		mapType="people";
		               	contextMap[mapType].push(data.newElement);
		               	//Minus 1 on number of invit
		               	if ($("#addMembers #memberId").val().length==0){
			               	var count = parseInt($("#numberOfInvit").data("count")) - 1;
							$("#numberOfInvit").html(count + ' invitation(s)');
							$("#numberOfInvit").data("count", count);
						}
						$("#addMembers #memberId").val("");
		                $("#addMembers #memberType").val("");
		                $("#addMembers #memberName").val("");
		                $("#addMembers #memberEmail").val("");
		                $("#addMembers #memberIsAdmin").val("");
		                $('#addMembers #organizationType').val("");
						$("#addMembers #memberIsAdmin").val("false");
						$('#addMembers #memberEmail').parents().eq(1).show();
						$("[name='my-checkbox']").bootstrapSwitch('state', false);
						$(".saveBtn").html('<?php echo Yii::t("common","Save") ?>');
						showSearch();
						if(typeof(mapUrl) != "undefined"){
							if(typeof(mapUrl.detail.load) != "undefined" && mapUrl.detail.load)
								mapUrl.detail.load = false;
							if(typeof(mapUrl.directory.load) != "undefined" && mapUrl.directory.load)
								mapUrl.directory.load = false;
						}
	            	}
	            	mylog.log(data.result);   
	            },
	            error:function (xhr, ajaxOptions, thrownError){
	              toastr.error( thrownError );
	              $(".saveBtn").html('<?php echo Yii::t("common","Save") ?>');
	            } 
	    	});
	    });

		$('#memberSearch').keyup(function(e){
		    var searchValue = $('#memberSearch').val();
		    if(searchValue.length>2){
		    	clearTimeout(timeout);
			    timeout = setTimeout($("#iconeChargement").css("visibility", "visible"), 500);
			    clearTimeout(timeout);
			    timeout = setTimeout('autoCompleteEmailAddMember("'+searchValue+'")', 500); 
		    }else{
		    	$("#addMembers #dropdown_search").css({"display" : "none" });
		    	$("#iconeChargement").css("visibility", "hidden")
		    }
		       		
		});
		$('#memberEmail').focusout(function(e){
			//$("#ajaxSV #dropdown_city").css({"display" : "none" });
		});
	}

	function hideFormAddMember(){
		$(".newMembersAdded").empty();
		$(".newMembersAddedTable").removeClass('animated bounceIn').addClass('hide');
		openNewMemberForm();
		showSearch();
		
	}

	function setMemberInputAddMember(id, name, email, type, organizationType){
		$("#iconeChargement").css("visibility", "hidden")
		$("#memberSearch").val(name);
		$("#addMembers #memberName").val(name);
		$("#addMembers #memberId").val(id);
		if(email==""){
			$('#addMembers #memberEmail').parents().eq(1).hide();
		}
		$('#addMembers #memberEmail').val(email);
		
		$('#addMembers #memberEmail').attr("disabled", 'disabled');
		$("#addMembers #memberName").attr("disabled", 'disabled');

		if(type=="citoyens"){
			$("#addMembers #btnCitoyen").trigger("click");
			$("#addMembers #btnOrganization").addClass("disabled");
		}else{
			$("#addMembers #btnOrganization").trigger("click");
			$("#addMembers #btnCitoyen").addClass("disabled");
			$('#addMembers #organizationType').val(organizationType);
			$('#addMembers #organizationType').attr("disabled", 'disabled');
		}
		$("#addMembers #dropdown_search").css({"display" : "none" });
		if(elementType == "<?php echo Event::COLLECTION ?>")
			$("#addMembers #formNewMember").css("display", "block");
		else
			$("#addMembers #addMemberSection").css("display", "block");
		$("#searchMemberSection").css("display", "none");

	}

	function autoCompleteEmailAddMember(searchValue){
		mylog.log("autoCompleteEmailAddMember");
		var data = {
			"search" : searchValue,
			"elementId" : elementId
		};
		if (elementType == "<?php echo Event::COLLECTION ?>")
			data.searchMode = "personOnly";
		$.ajax({
			type: "POST",
	        url: baseUrl+"/communecter/search/searchmemberautocomplete",
	        data: data,
	        dataType: "json",
	        success: function(data){
	        	if(!data){
	        		toastr.error(data.content);
	        	}else{
	        		var icon = "fa-question-circle";
					str = "<li class='li-dropdown-add-members'><a href='javascript:openNewMemberForm()'><i class='fa fa-2x fa-plus'></i> <span class='member-name'>Non trouvé ? Envoyer une invitation.</span></a></li>";
		 			$.each(data, function(key, value) {
		 			
		 				$.each(value, function(i, v){
		 					if (v.address != null) {
            			      city = v.address.addressLocality;
                			}
                
                			if("undefined" != typeof v.profilThumbImageUrl && v.profilThumbImageUrl != ""){
                  				var htmlIco= "<img width='50' height='50' alt='image' class='img-circle' src='"+baseUrl+v.profilThumbImageUrl+"'/>"
                			}

							if (key == "citoyens") {
		 						icon = mapIcon[key];
		 					} else if (key == "organizations") {
		 						icon = mapIcon[v.type];
		 					}

                			var insee = v.insee ? v.insee : "";
                			var postalCode = v.cp ? v.cp : v.address.postalCode ? v.address.postalCode : "";
                			str +=  //"<div class='searchList li-dropdown-scope' >"+
                          		"<a href='javascript:;' data-id='"+ v.id +"' data-key='"+key+"' data-type='"+v.type+"' data-name='"+ v.name +"' data-email='"+v.email+"' data-icon='"+ icon +"' data-insee='"+ insee +"' class='searchEntry searchList li-dropdown-scope selectAddMember'>"+
                          		"<ol>";
                          	
                          	if ("undefined" != typeof htmlIco) {
                          		str += "<span>"+ htmlIco +"</span>  <span class='member-name'>" + v.name + '</span>';
                          	} else {
								str += '<span><i class="fa '+icon +' fa-2x"></i><span class="member-name">' + v.name + '</span></span>';
                          	}

                          	str +=  "</ol></a>";

		  					//str += '<li class="li-dropdown-scope"><a href="javascript:;"  ><i class="fa '+icon+'"></i> '+v.name +'</a></li>';
		  				});
		  			}); 

		  			$("#addMembers #dropdown_search").html(str);
		  			$(".selectAddMember").off().on('click',function() { 
		  				var id = $(this).data('id');
		  				var name = $(this).data('name');
		  				var email = $(this).data('email');
		  				var key = $(this).data('key');
		  				var type = $(this).data('type');
		  				setMemberInputAddMember(id,name,email,key,type);
		  			});
		  			$("#addMembers #dropdown_search").css({"display" : "inline" });
	  			}
			}	
		})
	}

	function openNewMemberForm(){
		$("#addMembers #addMemberSection").css("display", "block");
		$("#searchMemberSection").css("display", "none");
		$("#addMembers #memberName").val("");
		$("#addMembers #memberName").removeAttr("disabled");
		$("#addMembers #memberId").val("");
		$('#addMembers #memberEmail').val("");
		$('#addMembers #memberEmail').removeAttr("disabled");
		$('#addMembers #organizationType').removeAttr("disabled");
		$("#addMembers #memberIsAdmin").val("0");
		$("[name='my-checkbox']").bootstrapSwitch('state', false);
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  		if(emailReg.test( $("#memberSearch").val() )){
  			$('#addMembers #memberEmail').val( $("#addMembers #memberSearch").val());
  		}else{
  			$("#addMembers #memberName").val($("#addMembers #memberSearch").val());
  		}
	}
	function showSearch(){
		$("#addMembers #btnCitoyen").removeClass("disabled btn-dark-green").addClass("btn-green");
		$("#addMembers #btnOrganization").removeClass("disabled btn-dark-green").addClass("btn-green");
		$("#addMembers #formNewMember").css("display", "none");
		$("#addMembers #addMemberSection").css("display", "none");
		$('#addMembers #memberEmail').parents().eq(1).show();
		$("#searchMemberSection").css("display", "block");
		$("#addMembers #divAdmin").css("display", "none");
		$("#iconeChargement").css("visibility", "hidden")
		$("#memberSearch").val("");
		$("#addMembers #dropdown_search").css({"display" : "none" });
	}

	function switchType(str){
		$("#addMembers #formNewMember").css("display", "block");
		$("#addMembers #iconUser").empty();
		if(str=="citoyens"){
			$("#addMembers #divAdmin").css("display", "block");
			$("#addMembers #iconUser").html('<i class="fa fa-user fa-2x"></i>');
			$("#addMembers #divOrganizationType").css("display", "none");
			$("#addMembers #btnCitoyen").removeClass("btn-green").addClass("btn-dark-green");
			$("#addMembers #btnOrganization").removeClass("btn-dark-green").addClass("btn-green");
		}else{
			$("#addMembers #divAdmin").css("display", "none");
			$("#addMembers #divOrganizationType").css("display", "block");
			$("#addMembers #iconUser").html('<i class="fa fa-group fa-2x"></i>');
			$("#addMembers #btnOrganization").removeClass("btn-green").addClass("btn-dark-green");
			$("#addMembers #btnCitoyen").removeClass("btn-dark-green").addClass("btn-green");
		}
		$("#addMembers #memberType").val(str);
	}

	function switchTypeImport(str, idMail, mail){
		if(str=="citoyens"){
			$("#"+idMail+"organizationType").hide();
			$("#"+idMail+"divOrganizationType").css("display", "none");
			$("#"+idMail+"btn  #"+idMail+"btnCitoyen").removeClass("btn-green").addClass("btn-dark-green");
			$("#"+idMail+"btn  #"+idMail+"btnOrganization").removeClass("btn-dark-green").addClass("btn-green");
		}else{
			$("#"+idMail+"organizationType").show();
			$("#"+idMail+"divOrganizationType").css("display", "block");
			$("#"+idMail+"btn  #"+idMail+"btnOrganization").removeClass("btn-green").addClass("btn-dark-green");
			$("#"+idMail+"btn  #"+idMail+"btnCitoyen").removeClass("btn-dark-green").addClass("btn-green");
		}
		$("#"+idMail+"memberType").val(str);

		checkedDiv(idMail, mail);
	}

function checkedMail(id, mail) {
	mylog.log("checkedMail",id, mail);
	var contact = {} ;
	contact["mail"] = mail ;
	contact["id"] = id ;
	/*contact["typeOrga"] = "" ;
	if(contact["type"] == "organizations")
		contact["typeOrga"] = $("#"+id+"organizationType").val() ;*/

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
	mylog.log("checkedMail",listMails);
	setNbContact()
	//bindInviteSubViewInvites();
};



function checkedDiv(id, mail) {
	mylog.log("checkedDiv",id, mail);
	var contact = {} ;
	contact["mail"] = mail ;
	contact["id"] = id ;

	var find = false ;
	$.each(listMails, function(key, val) {
		if(mail == val.mail){
			find = true ;
		}	
	});
	if(find == false){
		listMails.push(contact);
	}
	if(!$( "#"+id ).hasClass( "item_map_list_blue" )){
		$( "#"+id ).removeClass("item_map_list");
		$( "#"+id ).addClass("item_map_list_blue");
	}
	mylog.log("checkedDiv",listMails);
	setNbContact();	
};






function setValidationTable(newMember, newMemberType, multi){
	var admin= "";
	var type="";
	if(newMemberType=="<?php echo Person::COLLECTION ?>"){
		type = "Personne";
	}else{
		type = "Organisation"
	}
	if(multi==false && $("#addMembers #memberIsAdmin").val()=="1"){
		admin="Oui";
	}else{
		admin = "Non";
	}
	strHTML = "<tr><td>"+type+"</td><td>"
   						+newMember.name+"</td><td>"
   						+newMember.email+"</td><td>"
   						+admin+"</td><td>"+
   						"<span class='label label-info'>added</span></td> <tr>";
    $(".newMembersAdded").append(strHTML);
    if($(".newMembersAddedTable").hasClass("hide"))
        $(".newMembersAddedTable").removeClass('hide').addClass('animated bounceIn');
}

function fadeInView(inView){
	mylog.log("fadeInView", inView);
	if(inView == "divSearch")
	{
		$("#divSearch").fadeIn("slow", function() {});
		$("#divImportFile").hide();

	}else if(inView == "divImportFile")
	{
		$("#divImportFile").fadeIn("slow", function() {});
		$("#divSearch").hide();
	}

}

function getIdByMail(mail) {
	var res = false ;
	$.ajax({
        type: "POST",
        url: baseUrl+'/communecter/person/getuseridbymail/',
        dataType : "json",
        data: {
        	mail : mail,
        },
        async : false ,
		success:function(data){
			mylog.log(data.userId.$id);
			res =  data.userId.$id ;
  		},
  		error:function(data){
  			mylog.log("error",data)
  		}
    });

    return res ;
}

function inviteImportFile(){
		if(listMails.length == 0)
    		toastr.error("Veuillez sélectionner une adresse mail.");
    	else{
    		rand = Math.floor((Math.random() * 8) + 1);
	  		$.blockUI({message : '<div class="title-processing homestead"><i class="fa fa-spinner fa-spin"></i> Processing... </div>'
				+'<a class="thumb-info" href="'+proverbs[rand]+'" data-title="Proverbs, Culture, Art, Thoughts"  data-lightbox="all">'
				+ '<img src="'+proverbs[rand]+'" style="border:0px solid #666; border-radius:3px;"/></a><br/><br/>'
			});
    		var name = "";
    		var connectType = "member";
    		mylog.log("listMails", listMails);
    		$.each(listMails, function(key, value) {
    			mylog.log("value", value)
    			if(value.mail != ""){
					mylog.log("name", $("#"+value.id+"name").val());
    				if($("#"+value.id+"name").val() == "")
					{
						var nom = value.mail.split("@") ;
						name = nom[0];
					}	
					else
						name = 	$("#"+value.id+"name").val();
    				

    				var userId = getIdByMail(value.mail);
    				var typeOrga = "" ;
					if($("#"+value.id+"memberType").val() == "organizations")
						typeOrga = $("#"+value.id+"organizationType").val() ;
					var params = {
						"childId" : userId,
						"childName" : name,
						"childEmail" : value.mail,
						"childType" : $("#"+value.id+"memberType").val(), 
						"organizationType" : typeOrga,
						"parentType" : "<?php echo Organization::COLLECTION;?>",
						"parentId" : $("#addMembers #parentOrganisation").val(),
						"connectType" : connectType
					};
				  	mylog.log("params", params);
				  	$.ajax({
			            type: "POST",
			            url: baseUrl+"/communecter/link/connect",
			            data: params,
			            dataType: "json",
			            success: function(data){
			            	if(!data.result){
			            		toastr.error(data.msg);
			            	}else{
			            		toastr.success("Les membres ont été ajoutés.");
			            		//Minus 1 on number of invit
								var count = parseInt($("#numberOfInvit").data("count")) - 1;
								$("#numberOfInvit").html(count + ' invitation(s)');
								$("#numberOfInvit").data("count", count);
								setValidationTable(data.newElement,data.newElementType, false);
			            	}
			            	mylog.log(data.result);
			            	$.unblockUI();   
			            },
			            error:function (xhr, ajaxOptions, thrownError){
			            	$.unblockUI();
			              	toastr.error( thrownError );

			            } 
			    	});
				}
    		});
    	}

}


function checkboxAdmin() {
	
	mylog.log("checkboxAdmin");
	$("[name='my-checkboxAdmin']").bootstrapSwitch();
	$("[name='my-checkboxAdmin']").on("switchChange.bootstrapSwitch", function (event, state) {
		mylog.log("state = "+state );
		if (state == true) {
			$("#addMembers #memberIsAdmin").val(1);
		} else {
			$("#addMembers #memberIsAdmin").val(0);
		}
		
	}); 
}
function setNbContact(total) {
	if(typeof total == "undefined")
		$("#nbContact").html(listMails.length + " / " + totalMails + " contacts sélectionné(s)");
	else
		$("#nbContact").html(listMails.length + " / " + total + " contacts sélectionné(s)");
}

function allchecked(bool) {
	mylog.log("allchecked");

	var lesLI = $("#listEmailGrid li").each(function(){
		var elt = $(this) ;

		mylog.log( elt[0].id);
		mylog.log($("#"+elt[0].id+"mail").val());
		if(bool == true){
			checkedDiv(elt[0].id, $("#"+elt[0].id+"mail").val());
		}
		else{
			if(!$( "#"+elt[0].id).hasClass( "item_map_list" )){
				$( "#"+elt[0].id ).removeClass("item_map_list_blue");
				$( "#"+elt[0].id).addClass("item_map_list");
			}
		}
			    
	});

	if(bool == false)
		listMails = [];

	setNbContact()	
}

function removeMembersInMyContact(){

  $("input[value='"+elementId+"']").parent().parent().parent().remove();
  $.each(links.members, function(key, value){
    $("input[value='"+key+"']").parent().parent().parent().remove();
  });
}
</script>
	

