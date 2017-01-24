<?php 
$cs = Yii::app()->getClientScript();

$cssAnsScriptFilesModule = array(
  '/assets/css/rooms/header.css'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl); ?>
 <style>

.assemblyHeadSection {  
  <?php $bg = (@$archived) ? "assemblyParisDayArchived" : "assemblyParisDay";?>
  /*background-image:url(<?php echo $this->module->assetsUrl; ?>/images/city/<?php echo $bg; ?>.jpg); */
  background-image:url(<?php echo $this->module->assetsUrl; ?>/images/city/dda-connexion-lines.jpg); 

  background-repeat: no-repeat !important;
  background-size: 100% 400px !important;
  background-position: 0px 0px !important;
 }
 .bgDDA .modal .modal-header{
  background-image:url(<?php echo $this->module->assetsUrl; ?>/images/city/dda-connexion-lines.jpg); 
  background-repeat: no-repeat !important;
  background-size: auto;
}
.contentProposal{
	background-color: white;
}
.header-parent-space{
	margin: -15px 10px;
	padding: 15px 8px 8px;
	border-radius: 7px 7px 0px 0px;
	background-color: rgba(255, 255, 255, 0);
}

#room-container{
	min-height:300px;
}
.btn-select-room{
	margin-top: 5px;
	border: none;
	font-size: 20px;
	font-weight: 200;
	width: 100%;
	text-align: center;
	border-radius:100px;
}
.btn-select-room.bg-dark:hover{
	background-color:#58829B !important;
}

.modal .room-item{
	width:100%;
	padding:15px;
	font-size:16px;
	border-bottom:1px solid #DBDBDB;
	border-top:1px solid rgba(230, 230, 230, 0);
	float:left;
}
.modal .room-item:hover{
	background-color: rgb(230, 230, 230) !important;
	border-top:1px solid rgb(192, 192, 192);
}

.title-conseil-citoyen {
    background-color: rgba(255, 255, 255, 0);
    margin: 0px;
    padding: 10px;
    border-radius: 12px;
    -moz-box-shadow: 0px 3px 10px 1px #656565;
    -webkit-box-shadow: 0px 3px 10px 1px #656565;
    -o-box-shadow: 0px 3px 10px 1px #656565;
    box-shadow: 0px 3px 10px 1px rgb(101, 101, 101);
    margin-bottom: 10px;
}
.link-tools a:hover{
	text-decoration: underline;
}

.fileupload-new.thumbnail{
	width:unset;
}
h1.citizenAssembly-header {
    font-size: 30px;
}

.img-room-modal img{
	max-width: 35px;
	margin-top: -5px;
	margin-right: 10px;
	border-radius: 4px;
}
#room-container .badge-danger {
    margin-bottom: 2px;
    margin-left: 2px;
}
</style>	


	<h1 class="text-dark citizenAssembly-header">
	 	<?php 
	    	$urlPhotoProfil = "";
			if(!@$parent){
				if($parentType == Project::COLLECTION) { $parent = Project::getById($parentId); }
			  	if($parentType == Organization::COLLECTION) { $parent = Organization::getById($parentId); }
			  	if($parentType == Person::COLLECTION) { $parent = Person::getById($parentId); }
		        if($parentType == City::COLLECTION) { $parent = City::getByUnikey($parentId); }
			}

			if(isset($parent['profilImageUrl']) && $parent['profilImageUrl'] != ""){
		      $urlPhotoProfil = Yii::app()->getRequest()->getBaseUrl(true).$parent['profilImageUrl'];
			}
		    // else{
		    // 	if($parentType == Person::COLLECTION)
		    //   		$urlPhotoProfil = $this->module->assetsUrl.'/images/thumb/project-default-image.png';
		    //   	if($parentType == Organization::COLLECTION)
		    //   		$urlPhotoProfil = $this->module->assetsUrl.'/images/thumb/orga-default-image.png';
		    //   	if($parentType == Project::COLLECTION)
		    //   		$urlPhotoProfil = $this->module->assetsUrl.'/images/thumb/default.png';
		    // }
		
			$icon = "comments";	
			$colorName = "dark";
			if($parentType == Project::COLLECTION) { $icon = "lightbulb-o"; $colorName = "purple"; }
		  	if($parentType == Organization::COLLECTION) { $icon = "group"; $colorName = "green"; }
		  	if($parentType == Person::COLLECTION) { $icon = "user"; $colorName = "dark"; }
	        if($parentType == City::COLLECTION) { $icon = "university"; $colorName = "red"; }
		?>
		
		<?php //création de l'url sur le nom du parent
			$urlParent = Element::getControlerByCollection($parentType).".detail.id.".$parentId; 
			if($parentType == City::COLLECTION) 
				$urlParent = Element::getControlerByCollection($parentType).".detail.insee.".$parent["insee"].".postalCode.".$parent["cp"]; 
		?>

		<div class="row header-parent-space">

			<?php if($parentType != City::COLLECTION && $urlPhotoProfil != ""){ ?>
				<div class="col-md-3 col-sm-3 col-xs-12 center">
					<img class="thumbnail img-responsive" id="thumb-profil-parent" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
				</div>
			<?php }else if($parentType == City::COLLECTION){ ?>
				<div class="col-md-3 col-sm-3 col-xs-12 center">
					<h1 class="homestead title-conseil-citoyen center text-red"><i class="fa fa-group"></i><br>Conseil Citoyen</h1>
				</div>
			<?php } ?>
	    	
			<?php if($parentType == City::COLLECTION || $urlPhotoProfil != "") 
					$colSize="9"; else $colSize="12"; 
			?>
			
	    	<div class="col-md-<?php echo $colSize; ?> col-sm-<?php echo $colSize; ?>">
	    		<div class="col-md-12 no-padding margin-bottom-15">
		    		<a href="javascript:loadByHash('#<?php echo $urlParent; ?>');" class="text-<?php echo $colorName; ?> homestead">
						<i class="fa fa-<?php echo $icon; ?>"></i> 
							<?php
								if($parentType == City::COLLECTION) echo "Commune de "; 
								echo $parent['name']; 
							?>
					</a>			
				</div>

				<?php 
					if(!@$mainPage){
						$rooms = ActionRoom::getAllRoomsByTypeId($parentType, $parentId);
						$discussions = $rooms["discussions"];
						$votes = $rooms["votes"];
						$actions = $rooms["actions"];
						$history = $rooms["history"];
					}
				?>
					<div class="col-md-4 no-padding">
						<button type="button" class="btn btn-default bg-dark btn-select-room" data-toggle="modal" data-target="#modal-select-room1">
							<i class="fa fa-comments"></i> Discuter <span class="badge"><?php if(@$discussions) echo count($discussions); else echo "0"; ?></span>
						</button><br>
					</div>
					<div class="col-md-4">
						<button type="button" class="btn btn-default bg-dark btn-select-room" data-toggle="modal" data-target="#modal-select-room2">
							<i class="fa fa-archive"></i> Décider <span class="badge"><?php if(@$votes) echo count($votes); else echo "0"; ?></span>
						</button><br>
					</div>
					<div class="col-md-4 no-padding">
						<button type="button" class="btn btn-default bg-dark btn-select-room" data-toggle="modal" data-target="#modal-select-room3">
							<i class="fa fa-cogs"></i> Agir <span class="badge"><?php if(@$actions) echo count($actions); else echo "0"; ?></span>
						</button>
					</div>
					<div class="col-md-12 margin-top-15 link-tools">
						<a href="javascript:showRoom('all', '<?php echo $parentId; ?>')" class="pull-left text-dark" style="font-size:15px;"><i class="fa fa-list"></i> Afficher tout</a>
						<?php if(@$_GET["archived"] == null){ ?>
						 <a href="javascript:loadByHash(location.hash+'.archived.1')" class="pull-left text-red" style="font-size:15px;margin-left:30px;"><i class="fa fa-times"></i> Archives</a>
						<?php } ?>
						<?php //if(@$history && !empty($history)){ ?>
							<a href="javascript:" class="pull-right text-dark" style="font-size:15px;" data-toggle="modal" data-target="#modal-select-room4">
								<i class="fa fa-clock-o"></i> Mon historique
							</a>
						<?php //} ?>
					</div>

				<div class="col-md-12 no-padding" style="margin: 15px 0 15px 0 !important;">
					<?php 
						$btnLbl = "<i class='fa fa-sign-in'></i> ".Yii::t("rooms","JOIN TO PARTICIPATE", null, Yii::app()->controller->module->id);
					    $ctrl = Element::getControlerByCollection($parentType);
					    $btnUrl = "loadByHash('#".$ctrl.".detail.id.".$parentId."')";
						if( $parentType == City::COLLECTION || 
							($parentType != Person::COLLECTION && 
							Authorisation::canParticipate(Yii::app()->session['userId'],$parentType,$parentId) ))
							{ 
								$btnLbl = "<i class='fa fa-plus'></i> ".Yii::t("rooms","Add an Action Room", null, Yii::app()->controller->module->id);
							    $btnUrl = "loadByHash('#rooms.editroom.type.".$parentType.".id.".$parentId."')";
							} 
						if(!isset(Yii::app()->session['userId'])){ 
							$btnLbl = "<i class='fa fa-sign-in'></i> ".Yii::t("rooms","LOGIN TO PARTICIPATE", null, Yii::app()->controller->module->id);
						    $btnUrl = "showPanel('box-login');";
						}

						$addBtn = ( $parentType != Person::COLLECTION ) ? ' <i class="fa fa-angle-right"></i> <a class="filter btn btn-xs btn-primary Helvetica" href="javascript:;" onclick="'.$btnUrl.'">'.$btnLbl.'</a>' : ""; 
					?>
					<!-- <span class="breadscrum">
						<a class='text-dark' href='javascript:loadByHash("#rooms.index.type.<?php //echo $parentType ?>.id.<?php //echo $parentId ?>.tab.1")'>
							<i class="fa fa-connectdevelop"></i> <?php //echo Yii::t("rooms","Action Rooms", null, Yii::app()->controller->module->id) ?>
						</a> 
						<?php 
							//if( $parentType != Person::COLLECTION ){
							//	echo (@$textTitle) ? "/ ".$textTitle : 
							//		' <i class="fa fa-angle-right"></i> <a class="filter btn btn-default Helvetica" href="javascript:;" onclick="'.$btnUrl.'">'.$btnLbl.'</a>';
							//}
						?>
					</span> -->
				</div>
		</div>

	</h1>

	<?php  if( isset(Yii::app()->session['userId']) && 
			Authorisation::canParticipate(Yii::app()->session['userId'], $parentType, $parentId ) ){ ?>
	<div class="modal fade" id="modal-create-room" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header text-dark">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h2 class="modal-title text-left">
	        	<i class="fa fa-angle-down"></i> <i class="fa fa-plus"></i> Créer un espace
	        </h2>
	      </div>
	      <div class="modal-body no-padding">
	      	<div class="panel-body" id="form-create-room">
				<?php 
					$listRoomTypes = Lists::getListByName("listRoomTypes");
				    foreach ($listRoomTypes as $key => $value) {
				        //error_log("translate ".$value);
				        $listRoomTypes[$key] = Yii::t("rooms",$value, null, Yii::app()->controller->module->id);
				    }
				    $tagsList =  Lists::getListByName("tags");
				    $params = array(
				        "listRoomTypes" => $listRoomTypes,
				        "tagsList" => $tagsList,
				        "id" => $parentId,
				        "type" => $parentType
				    );
					$this->renderPartial('../rooms/editRoomSV', $params); 
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-success"
					    onclick="javascript:saveNewRoom();">
						<i class="fa fa-save"></i> Enregistrer
				</button>
			</div>
		  </div>
		</div>
	  </div>
	</div>

<?php } ?>

<?php 
createModalRoom($discussions,$parentType, $parentId, 1, "Sélectionnez un espace de discussion", "comments", "discuss", "Aucun espace de discussion");
createModalRoom($votes,$parentType, $parentId, 2, "Sélectionnez un espace de décision", "archive", "vote", "Aucun espace de décision");
createModalRoom($actions,$parentType, $parentId, 3, "Sélectionnez un espace d'action", "cogs", "actions", "Aucun espace d'action");
createModalRoom($history,$parentType, $parentId, 4, "Historique de votre activité", "clock-o", "history", "Aucune activité");

//$where = Yii::app()->controller->id.'.'.Yii::app()->controller->action->id;
//if( in_array($where, array("rooms.action","survey.entry"))){
	createModalRoom( array_merge($votes,$actions) ,$parentType, $parentId, 5, 
					"Choisir un nouvel espace", "share-alt", "move", "Aucun espace","move",$faTitle);

//}

function createModalRoom($elements, $parentType, $parentId, $index, $title, 
						 $icon, $typeNew, $endLbl,$action=null,$context=null){
	

	$iconType = array("discuss"=>"comments", "entry" => "archive", "actions" => "cogs");
	
	echo '<div class="panel panel-default no-margin">';

	echo    '<div class="modal fade" id="modal-select-room'.$index.'" tabindex="-1" role="dialog">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header text-dark">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h2 class="modal-title text-left">
			        	<i class="fa fa-angle-down"></i> <i class="fa fa-'.$icon.'"></i> 
			        	<span class="">'.$title.' <span class="badge">'.count($elements).'</span>
			        </h2>
			      </div>
			      <div class="modal-body no-padding">
			      	<div class="panel-body no-padding">';

			      	if(!empty($elements)) 
			        foreach ($elements as $key => $value) { if(isset($value["_id"])) {
			        	$created = ( @$value["created"] ) ? date("d/m/y h:i",$value["created"]) : ""; 
			        	//if($typeNew == "history")  var_dump($value); error_log($value["type"]);
			        	if($typeNew == "history" && @$value["type"]){ //error_log($value["type"]);
			        		$type = $value["type"]; 
			        		if(@$iconType[$type]) $icon = $iconType[$type];
						}
						$col = Survey::COLLECTION;
			       		$attr = 'survey';
			        	if( @$value["type"] == ActionRoom::TYPE_ACTIONS ){
				        	$col = ActionRoom::TYPE_ACTIONS;
				        	$attr = 'room';
				        }

				        $onclick = 'showRoom(\''.$typeNew.'\', \''.(string)$value["_id"].'\')';
				        $skip = false;
				        if( $action == "move"){
				        	$icon = ($value["type"] == ActionRoom::TYPE_ACTIONS) ? "cogs" : "archive";
				        	$type = ($context == "cogs") ? "action" : "survey";
							$onclick = 'move(\''.$type.'\', \''.(string)$value["_id"].'\')';
							//remove the current context room destination
							//if((string)$value["_id"] == ) //we are missing the current room  object in header
				        }

				        $imgIcon = '';
				        if(isset($value['profilImageUrl']) && $value['profilImageUrl'] != ""){
					      $urlPhotoProfil = Yii::app()->getRequest()->getBaseUrl(true).$value['profilImageUrl'];
					      $imgIcon = '<img src="'.$urlPhotoProfil.'">';
						}

						$count = 0;
						if( @$value["type"] == ActionRoom::TYPE_VOTE )
							$count = PHDB::count(Survey::COLLECTION,array("survey"=>(string)$value["_id"]));
						else if( @$value["type"] == ActionRoom::TYPE_ACTIONS )
							$count = PHDB::count(Survey::COLLECTION,array("room"=>(string)$value["_id"]));
						else if( @$value["type"] == ActionRoom::TYPE_DISCUSS )
							$count = (empty($value["commentCount"])?0:$value["commentCount"]);
						if(!$skip){
							echo '<a href="javascript:" onclick="'.$onclick.'" class="text-dark room-item" data-dismiss="modal">'.
									'<i class="fa fa-angle-right"></i> <i class="fa fa-'.$icon.'"></i> '.$value["name"].
									" <span class='badge badge-success pull-right'>".
										$count.
										//PHDB::count($col,array($attr=>(string)$value["_id"])).
									"</span>".
									" <span class='pull-right img-room-modal'>".
										$imgIcon.
									"</span>".
								'</a>';
						}
					} } 

				    if(empty($elements)) 
				      	echo '<div class="panel-body "><i class="fa fa-times"></i> '.$endLbl.'</div>';

	echo 			'</div>';
	echo 		'</div>';

	echo 		'<div class="modal-footer">';
	
	if($typeNew != "history" && $typeNew != "move" && Authorisation::canParticipate(Yii::app()->session['userId'],$parentType,$parentId) ) 
	echo		    '<button type="button" class="btn btn-default pull-left" onclick="javascript:selectRoomType(\''.$typeNew.'\')"
						  data-dismiss="modal" data-toggle="modal" data-target="#modal-create-room">'.
						'<i class="fa fa-plus"></i> <i class="fa fa-'.$icon.'"></i> Créer un nouvel espace'.
					'</button>';
	echo		    '<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>';
	
	echo	    '</div>';

	echo 	   '</div>';
	echo 	  '</div>';

	echo     '</div>';

	echo   '</div>';
}

?>



<script type="text/javascript">
	

jQuery(document).ready(function() {
	$('#form-create-room #btn-submit-form').addClass("hidden");
});

function saveNewRoom(){
	$('#form-create-room #btn-submit-form').click();
}

function selectRoomType(type){
  mylog.log("selectRoomType",type);
  $("#roomType").val(type);
  
  var msg = "Nouvel espace";
  if(type=="discuss") msg = "<i class='fa fa-comments'></i> " + msg + " de discussion";
  if(type=="framapad") msg = "<i class='fa fa-file-text-o'></i> " + msg + " framapad";
  if(type=="vote") msg = "<i class='fa fa-gavel'></i> " + msg + " de décision";
  if(type=="actions") msg = "<i class='fa fa-cogs'></i> Nouvelle Liste d'actions";
  $("#proposerloiFormLabel").html(msg);
  $("#proposerloiFormLabel").addClass("text-dark");
  // $("#btn-submit-form").html('<?php echo Yii::t("common", "Submit"); ?> <i class="fa fa-arrow-circle-right"></i>');
  
  //$("#first-step-create-space").hide(400);
  $(".roomTypeselect").addClass("hidden");
}

function showRoom(type, id){
	
	var mapUrl = { 	"all": 
						{ "url"  : "rooms/index/type/<?php echo $parentType; ?>", 
						  "hash" : "rooms.index.type.<?php echo $parentType; ?>"
						} ,
					"discuss": 
						{ "url"  : "comment/index/type/actionRooms", 
						  "hash" : "comment.index.type.actionRooms"
						} ,
					"vote": 
						{ "url"  : "survey/entries", 
						  "hash" : "survey.entries"
						} ,
					"entry" :
						{ "url"  : "survey/entry",
						  "hash" : "survey.entry",
						},
					"actions": 
						{ "url"  : "rooms/actions", 
						  "hash" : "rooms.actions"
						} ,
					"action":
						{
							"url" : "rooms/action",
							"hash" : "rooms.action",
						}
				}

	var url  = mapUrl[type]["url"]+"/id/"+id;
	var hash = mapUrl[type]["hash"]+".id."+id;

	$("#room-container").hide(200);
	$.blockUI({
				message : "<h4 style='font-weight:300' class='text-dark padding-10'><i class='fa fa-spin fa-circle-o-notch'></i><br>Chargement en cours ...</span></h4>"
			});
	
	getAjax('#room-container',baseUrl+'/'+moduleId+'/'+url+"/id/"+id+"?renderPartial=true", 
			function(){ 
				history.pushState(null, "New Title", "communecter#" + hash);
				$("#room-container").show(200);
				$.unblockUI();
			},"html");
}

</script>

