<?php 
	$cs = Yii::app()->getClientScript();
	$cssAnsScriptFilesModule = array(
	  '/js/dataHelpers.js',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);


	$logguedAndValid = Person::logguedAndValid();
	$voteLinksAndInfos = Action::voteLinksAndInfos($logguedAndValid,$action);
?>

<style type="text/css">

	#commentHistory .panel-scroll{
		max-height:unset !important;
	}
	.info-survey{
		font-weight: 500;
		font-size: 13px;
		border-top: 1px solid rgb(210, 210, 210);
		padding-top: 15px;
		margin-top: 0px;
	}
	.datepicker{z-index:12000 !important;}

		
	.footer-comments{
	  margin-top: 15px !important;
	  /*float:left;*/
	  padding: 30px;
	}
	.ctnr-txtarea {
	    position: absolute;
	    right: 30px!important;
	    left: 70px!important;
	}
</style>	
<?php 
	//ca sert a quoi ce doublon ?
	$parentType = $room["parentType"];
	$parentId = $room["parentId"];
	$nameParentTitle = "";
	if($parentType == Organization::COLLECTION && isset($parentId)){
		$orga = Organization::getById($parentId);
		$nameParentTitle = $orga["name"];
	}
?>
 	 	  
<?php 
	$extraBtn = ( Authorisation::canParticipate(Yii::app()->session['userId'],$parentSpace['parentType'],$parentSpace['parentId']) ) ? 
		'<i class="fa fa-angle-right"></i> '.
		'<a class="filter btn btn-xs btn-primary Helvetica lbh" href="#rooms.editAction.room.'.$parentSpace["_id"].'">'.
			'<i class="fa fa-plus"></i> '.Yii::t( "survey", "Add an Action", null, Yii::app()->controller->module->id).
		'</a>' 
		: '';

	if(!isset($_GET["renderPartial"])){
	 	$this->renderPartial('../rooms/header',array(    
            		"parent" => $parent, 
                        "parentId" => $parentSpace['parentId'], 
                        "parentType" => $parentSpace['parentType'], 
                        "fromView" => "rooms.actions",
                        "faTitle" => "cogs",
                        "colorTitle" => "azure",
                        "textTitle" => "<a class='text-dark btn' href='javascript:loadByHash(\"#rooms.index.type.".$room['parentType'].".id.".$room['parentId'].".tab.3\")'><i class='fa fa-cogs'></i> ".Yii::t("rooms","Actions", null, Yii::app()->controller->module->id)."</a>".
                        				" / ".
                        				"<a class='text-dark btn' href='javascript:loadByHash(\"#rooms.actions.id.".$parentSpace["_id"]."\")'><i class='fa fa-cogs'></i> ".$parentSpace["name"]."</a>".$extraBtn
                            
                            )); 
		echo '<div class="col-md-12 panel-white padding-15" id="room-container">';
  	}
?>

<div class="row vote-row contentProposal" >

	<div class="col-md-12">
		<!-- start: REGISTER BOX -->
		<div class="box-vote box-pod">
			<h1 class="text-dark" style="font-size: 17px;margin-top: 20px;">
				<i class="fa fa-angle-right"></i> 
				<span class="homestead"><i class="fa fa-cogs"></i> <?php echo Yii::t("common","Action room"); ?> :</span>
					<a href="javascript:showRoom('actions', '<?php echo $parentSpace["_id"]; ?>')">
					<?php echo $parentSpace["name"];?> 
				</a>
			</h1>
			<div class="col-md-12 voteinfoSection">
				<div class="col-md-8 no-padding margin-bottom-15">								
					<h1 class="text-dark" style="font-size: 25px;margin-top: 20px;margin-right: 10px">
						<i class="fa fa-angle-down"></i>
						<span class="homestead"><i class="fa fa-cogs"></i> Action :</span>
						<a style="font-size:25px !important;">
							 <?php echo $action["name"] ?>
						</a>
						<div class="btn dropdown no-padding" style="padding-left:10px !important;">
							<a class="dropdown-toggle" type="button" data-toggle="dropdown" style="color:#8b91a0;">
							<i class="fa fa-cog"></i>  <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu">
								<?php if (Actions::canAdministrate(Yii::app()->session["userId"], (string)$action["_id"])) {?>
								<li>
									<a href="javascript:;" class="surveyDelete" onclick="actionDelete('<?php echo (string)$action["_id"] ?>', this, '<?php echo $room["parentId"] ?>')" data-id="<?php echo $action["_id"] ?>"><small><i class="fa fa-times"></i> Supprimer</small></a>
								</li>
								<?php } ?>
								<li>
									<a href="javascript:;" class="surveyReport" onclick="actionReportAbuse('<?php echo (string)$action["_id"] ?>', this)" data-id="<?php echo $action["_id"] ?>"><small><i class="fa fa-flag"></i> Reporter au modérateur</small></a>
								</li>
							</ul>
			      		</div>
			      	</h1>
				</div>
				<div class="col-md-4">
					<div class="box-ajaxTools">
						<?php if (  isset(Yii::app()->session["userId"]) && $action["organizerId"] == Yii::app()->session["userId"] )  { ?>
							<a class="tooltips btn btn-default  " href="javascript:" 
							   data-toggle="modal" data-target="#modal-edit-action"
							   data-placement="bottom" data-original-title="Editer cette action">
								<i class="fa fa-pencil "></i> <span class="hidden-sm hidden-md hidden-xs">Éditer</span>
							</a>
							<a class="tooltips btn btn-default" href="javascript:;" onclick="$('#modal-select-room5').modal('show')" 
								data-placement="bottom" data-original-title="Déplacer cette action dans un autre espace">
							<i class="fa fa-share-alt text-grey "></i> <span class="hidden-sm hidden-md hidden-xs">Déplacer</span>
							</a>
							<a class="tooltips btn btn-default  " href="javascript:;" onclick="closeAction('<?php echo $action["_id"]; ?>')" 
							   data-placement="bottom" data-original-title="Supprimer cette action">
								<i class="fa fa-times text-red "></i> <span class="hidden-sm hidden-md hidden-xs">Fermer</span>
							</a>
						<?php } ?>
						<a href="javascript:;" data-id="explainActions" class="tooltips btn btn-default explainLink" 
						   data-placement="bottom" data-original-title="Comprendre les listes d'actions">
							<i class="fa fa-question-circle "></i> <span class="hidden-sm hidden-md hidden-xs"></span>
						</a>						
					</div>
				</div>	
			</div>	
	
			<div class="col-md-4 no-padding" style="padding-right: 15px !important;">
				<?php 
				$this->renderPartial('../pod/fileupload', 
								array("itemId" => $action['_id'],
									  "type" => Actions::COLLECTION,
									  "resize" => false,
									  "contentId" => Document::IMG_PROFIL,
									  "editMode" => Authorisation::canEditItem(Yii::app()->session['userId'],$parentType,$parentId),
									  "image" => $images,
									   "parentId" => $parentSpace['parentId'], 
									   "parentType" => $parentSpace['parentType'])); 
				?>
				<div class="col-md-12 padding-10">
					<?php if( @$action["tags"] ){ ?>
						<span class="text-red" style="font-size:13px; font-weight:500;">
							<i class="fa fa-tags"></i>
							<?php 
								foreach ( $action["tags"] as $value) {
									echo '<span class="badge bg-red text-xss">#'.$value.'</span> ';
								}
							?>
						</span>
					<?php }	?>
				</div>
			</div>

			<div class="col-md-8 col-tool-vote text-dark" style="margin-bottom: 10px; margin-top: 10px; font-size:15px;">			<?php if( @($organizer) ){ ?>
						<span>
							<i class="fa fa-angle-right"></i> 
							<?php echo Yii::t("rooms","Made by ",null,Yii::app()->controller->module->id) ?> 
							<a style="font-size:14px;" href="javascript:<?php echo @$organizer['link'] ?>" class="text-dark">
								<?php echo @$organizer['name'] ?>
							</a>
						</span><br/>
					<?php }	?>
					<?php
						//if no assignee , no startDate no end Date
				        $statusLbl = Yii::t("rooms", "Todo", null, Yii::app()->controller->module->id);
				        $statusColor = "badge-info";
				        //if startDate passed, or no startDate but has end Date
				        if( ( isset($action["startDate"]) && $action["startDate"] < time() )  || ( !@$action["startDate"] && @$action["dateEnd"] ) )
				        {
				          $statusLbl = Yii::t("rooms", "Progressing", null, Yii::app()->controller->module->id);
				          $statusColor = "badge-success";
				          if( @$action["dateEnd"] < time()  ){
				            $statusLbl = Yii::t("rooms", "Late", null, Yii::app()->controller->module->id);
				            $statusColor = "badge-error";
				          }
				        } 
				        if ( @$action["status"] == ActionRoom::ACTION_CLOSED  ) {
				          $statusLbl = Yii::t("rooms", "Closed", null, Yii::app()->controller->module->id);
				          $statusColor = "bg-red";
				        }
					?>

					<span class="pull-right text-bold badge <?php echo $statusColor?>">
						<i class="fa fa-clock-o"></i> <?php echo $statusLbl; ?>
					</span>
					<span class="text-azure">
						<i class="fa fa-calendar"></i> 
						<?php echo Yii::t("rooms","Start Date",null,Yii::app()->controller->module->id) ?> : 
						<?php echo @$action["startDate"] ? date("d/m/y",$action["startDate"]) : "Indéfini" ?>
					</span>
					<br>
					<?php if( @$action["dateEnd"] ){ ?>
					<span class="text-red">
						<i class="fa fa-calendar"></i> 
						<?php echo Yii::t("rooms","End Date",null,Yii::app()->controller->module->id) ?> :
						<?php echo @$action["dateEnd"] ? date("d/m/y",$action["dateEnd"]) : "Indéfini" ?>
					</span>
					<br><hr>
					<span>
				 		<i class="fa fa-user"></i> 
				 		<?php echo Yii::t("rooms","VISITORS",null,Yii::app()->controller->module->id) ?> : 
				 		<?php echo (isset($action["viewCount"])) ? $action["viewCount"] : "0"  ?>
				 	</span>
					<br><hr>
				 	<?php } ?>
				 	<div class="text-bold text-dark">
				 		<?php 
							$canParticipate = Authorisation::canParticipate(Yii::app()->session['userId'],$parentType,$parentId);
							if( $canParticipate && $voteLinksAndInfos["hasVoted"] ) 
								echo $voteLinksAndInfos["links"]; 
						?>
					</div>
					
			</div>

			<div class="col-md-12 text-dark" style="font-size:15px">
				<hr style="margin-top:0px">
				<?php echo $action["message"]; ?>
				<hr>
			</div>
			<div class="col-md-7 text-dark" style="font-size:15px">
				<?php
				 if( @$action["urls"] ) { ?>
					<h3 class="label label-info">
						<i class="fa fa-angle-down"></i> 
						Informations complémentaires :
						<?php //echo Yii::t("rooms", "Links and Info Bullet points", null, Yii::app()->controller->module->id)?>
					</h3><br><br>
					<?php  foreach ( $action["urls"] as $value) {
						if( strpos($value, "http://")!==false || strpos($value, "https://")!==false )
							echo '<a href="'.$value.'" class="text-large padding-10"  target="_blank"><i class="fa fa-link"></i> '.$value.'</a><br/> ';
						else
							echo '<span class="text-large padding-5"><i class="fa fa-dot-circle-o"></i> '.$value.'</span><br/> ';
					}?>
					<hr>
				<?php }	?>	
			</div>

			<div class="col-md-5 leftInfoSection " >
				<?php if( @$action["links"]["contributors"] ) {	
						$this->renderPartial('../pod/usersList', array(  
											"project"=> $action,
											"users" => $contributors,
											"countStrongLinks" => $countStrongLinks, 
											"userCategory" => Yii::t("common","COMMUNITY"), 
											"contentType" => Actions::COLLECTION,
											"admin" => true	)); 
					}
				?>
				<?php if( Authorisation::canParticipate(Yii::app()->session['userId'],$room["parentType"],$room["parentId"]) && 
					  !@$action["links"]["contributors"][Yii::app()->session['userId']]  ){	?>
					<a href="javascript:;" class="pull-right text-large btn btn-dark-blue " 
					   onclick="assignMe('<?php echo (string)$action["_id"]?>');" >
						<i class="fa fa-link"></i> 
						Participer à cette tâche
						<?php //echo Yii::t("rooms","Assign Me This Task",null,Yii::app()->controller->module->id) ?>
				   	</a>
				<?php }	?>
			</div>
		</div>
	</div>
		
	<div class="col-md-12 commentSection leftInfoSection" >
		<h2 class='text-dark homestead' style="margin: -20px 0px 15px;"><i class="fa fa-angle-down"></i><br>Discussion</h2>
		<div class="box-vote box-pod margin-10 commentPod"></div>
	</div>
	
</div>


<?php if ( isset(Yii::app()->session["userId"]) && $action["organizerId"] == Yii::app()->session["userId"] )  { ?>
<div class="modal fade" id="modal-edit-action" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-dark">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-left">
        	<i class="fa fa-angle-down"></i> <i class="fa fa-pencil"></i> Éditer la proposition
        </h2>
      </div>
      <div class="modal-body no-padding">
      	<div class="panel-body" id="form-edit-action">
			<?php 
				$params = array(
			    	"action" => $action, //la proposition actuelle
			        "roomId" => $parentSpace["_id"] //id de la room
			    );
				$this->renderPartial('../rooms/editAction', $params); 
			?>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			<button type="button" class="btn btn-success"
				    onclick="$('#form-edit-action #btn-submit-form').click()">
					<i class="fa fa-save"></i> Enregistrer
			</button>
		</div>
	  </div>
	</div>
  </div>
</div>
<?php } ?>

<?php 
 if(!isset($_GET["renderPartial"])){
  echo "</div>"; // ferme le id="room-container"
 }
 ?>

<style type="text/css">
	.footerBtn{font-size: 2em; color:white; font-weight: bolder;}
</style>

<script type="text/javascript">
clickedVoteObject = null;
var contextData = {
	name : "<?php echo addslashes(@$action["name"]) ?>",
	id : "<?php echo (string)@$action["_id"] ?>",
	type : "action",
	controller : "room",
	otags : "<?php echo addslashes(@$action["name"]).",débat, proposition, question, vote, communecter,".addslashes(@implode(",", @$action["tags"])) ?>",
	odesc : <?php echo json_encode( 'Propositions : '.addslashes(@$action["name"])); ?>,
	parentType : "<?php echo @$room["parentType"] ?>",
    parentId : "<?php echo (string)@$room["parentId"] ?>"
};

jQuery(document).ready(function() {
	
	$(".main-col-search").addClass("assemblyHeadSection");
  	setTitle("Espace d'actions","cogs");
  	$('.box-vote').show()

  	$('#form-edit-action #btn-submit-form').addClass("hidden");
  	/*.addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
		$(this).removeClass("animated flipInX");
	});*/

	getAjax(".commentPod",baseUrl+"/"+moduleId+"/comment/index/type/actions/id/<?php echo $action['_id'] ?>?renderPartial=true",
		function(){ $(".commentCount").html( $(".nbComments").html() ); 
	},"html");

	$(".explainLink").click(function() {
		showDefinition( $(this).data("id") );
		return false;
	});
});

function closeAction(id)
{
    mylog.warn("--------------- closeEntry ---------------------");
    
      bootbox.confirm("<strong>Êtes-vous sûr de vouloir fermer cette action ?</strong>",
          function(result) {
            if (result) {
              params = { "id" : id };
              ajaxPost(null,'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/rooms/closeaction")?>',params,function(data){
                if(data.result)
                  loadByHash(location.hash);
                else 
                  toastr.error(data.msg);
              });
          } 
      });
}

function assignMe(id)
{
    bootbox.confirm("<strong>Êtes-vous sûr de vouloir participer à cette action ?</strong>" +
    				"Vous serez inscrit dans la liste des participants.",

        function(result) {
            if (result) {
              params = { "id" : id };
              ajaxPost(null,'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/rooms/assignme")?>',params,function(data){
                if(data.result)
                  loadByHash(location.hash);
                else 
                  toastr.error(data.msg);
              });
        } 
    });
 }

function move( type,destId ){
	bootbox.hideAll();
	mylog.warn("--------------- move ---------------------",type,destId);
	bootbox.confirm("<strong>Êtes-vous sûr de vouloir déplacer cette action ?</strong>",
      function(result) {
        if (result) {
			$.ajax({
		        type: "POST",
		        url: baseUrl+'/'+moduleId+'/rooms/move',
		        data: {
		        	"type" : type,
		        	"id" : "<?php echo $_GET["id"]?>",
		        	"destId":destId
		        },
		        dataType: "json",
		        success: function(data){
		          if(data.result){
		            toastr.success(data.msg);
		            loadByHash(data.url);
		          } else {
		            toastr.error(data.msg);
		            if(data.action == "login")
		            	showPanel( "box-login" );
		          }
		          
		          $.unblockUI();
		        },
		        error: function(data) {
		          $.unblockUI();
		          toastr.error("Something went really bad : "+data.msg);
		        }
		    });
		}
	});
}

function actionDelete(id, $this, parentId){
  bootbox.confirm(trad["suretodeleteaction"], 
    function(result) {
      if (result) {
        $.ajax({
              type: "POST",
              url: baseUrl+"/"+moduleId+"/rooms/deleteaction/id/"+id,
          dataType: "json",
              success: function(data){
                if (data.result) {               
                  toastr.success(data.msg);
                  showRoom('all', parentId);
                } else {
                  toastr.error(data.msg);
                }
            }
        });
      }
    }
  )
}
</script>