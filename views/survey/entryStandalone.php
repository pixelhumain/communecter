<?php 
	$cs = Yii::app()->getClientScript();
	$cssAnsScriptFilesModule = array(
	  //'/survey/js/highcharts.js',
	  '/js/dataHelpers.js'
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

	

	$cssAnsScriptFilesBase = array(
		//X-editable
		'/plugins/x-editable/css/bootstrap-editable.css',
		'/plugins/x-editable/js/bootstrap-editable.js',
		//DatePicker
		'/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' ,
		'/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.fr.js' ,
		'/plugins/bootstrap-datepicker/css/datepicker.css',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesBase, Yii::app()->request->baseUrl);

	$logguedAndValid = Person::logguedAndValid();
	$voteLinksAndInfos = Action::voteLinksAndInfos($logguedAndValid,$survey);
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

	#profil_fileUpload{
		min-height: 180px;
	}
	.datepicker{z-index:12000 !important;}

	
.footer-comments{
  /*margin-top: 15px !important;*/
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
	$survey = Survey::getById($survey["_id"]);
	$room = ActionRoom::getById($survey["survey"]);
	$parentType = $room["parentType"];
	$parentId = $room["parentId"];
	$nameParentTitle = "";
	if($parentType == Organization::COLLECTION && isset($parentId)){
		$orga = Organization::getById($parentId);
		$nameParentTitle = htmlentities($orga["name"]);
	}
 

	  $nameList = (strlen($room["name"])>20) ? substr($room["name"],0,20)."..." : $room["name"];
	  $extraBtn = ( Authorisation::canParticipate(Yii::app()->session['userId'],$parentType,$parentId) ) ? 
	  ' <i class="fa fa-caret-right"></i> '.
	  '<a class="filter btn  btn-xs btn-primary Helvetica lbh" href="#survey.editEntry.survey.'.(string)$room["_id"].'">'.
	  	'<i class="fa fa-plus"></i> '.Yii::t( "survey", 'Add a proposal', null, Yii::app()->controller->module->id).
	  '</a>' 
	  : '';
  
  if(!isset($_GET["renderPartial"])){
		$this->renderPartial('../rooms/header',array(   
					"archived"=> (@$room["status"] == ActionRoom::STATE_ARCHIVED) , 
        			"parent" => $parent, 
                    "parentId" => $parentId, 
                    "parentType" => $parentType, 
                    "parentSpace" => $parentSpace,
                    "fromView" => "survey.entry",
                    "faTitle" => "gavel",
                    "colorTitle" => "azure",
                    "textTitle" => "<a class='text-dark btn' href='javascript:loadByHash(\"#rooms.index.type.$parentType.id.$parentId.tab.2\")'><i class='fa fa-gavel'></i> ".Yii::t("rooms","Decide", null, Yii::app()->controller->module->id)."</a>".
                    				" / ".
                    				"<a class='text-dark btn' href='javascript:loadByHash(\"#survey.entries.id.".$survey["survey"]."\")'><i class='fa fa-th'></i> ".$nameList."</a>".$extraBtn
                      
                    )); 
		echo '<div class="col-md-12 panel-white padding-15" id="room-container">';
	  }
?>

<div class="row vote-row contentProposal" >

	<div class="col-md-12">
		<!-- start: REGISTER BOX -->
		<div class="box-vote box-pod">
			<h1 class="text-dark" style="font-size: 17px;margin-top: 20px;">
				<i class="fa fa-angle-down"></i> 
				<span class="homestead"><i class="fa fa-archive"></i> Espace de décision :</span>
				<a href="javascript:showRoom('vote', '<?php echo $survey["survey"]; ?>')">
					<?php echo $room["name"]; ?>
				</a>
				<hr>
			</h1>
	
			<div class="col-md-12 voteinfoSection">
				<?php 
					$voteDownCount = (isset($survey[Action::ACTION_VOTE_DOWN."Count"])) ? $survey[Action::ACTION_VOTE_DOWN."Count"] : 0;
					$voteAbstainCount = (isset($survey[Action::ACTION_VOTE_ABSTAIN."Count"])) ? $survey[Action::ACTION_VOTE_ABSTAIN."Count"] : 0;
					$voteUnclearCount = (isset($survey[Action::ACTION_VOTE_UNCLEAR."Count"])) ? $survey[Action::ACTION_VOTE_UNCLEAR."Count"] : 0;
					$voteMoreInfoCount = (isset($survey[Action::ACTION_VOTE_MOREINFO."Count"])) ? $survey[Action::ACTION_VOTE_MOREINFO."Count"] : 0;
					$voteUpCount = (isset($survey[Action::ACTION_VOTE_UP."Count"])) ? $survey[Action::ACTION_VOTE_UP."Count"] : 0;
					$totalVotes = $voteDownCount+$voteAbstainCount+$voteUpCount+$voteUnclearCount+$voteMoreInfoCount;
					$oneVote = ($totalVotes!=0) ? 100/$totalVotes:1;
					$voteDownCount = $voteDownCount * $oneVote ;
					$voteAbstainCount = $voteAbstainCount * $oneVote;
					$voteUpCount = $voteUpCount * $oneVote;
					$voteUnclearCount = $voteUnclearCount * $oneVote;
					$voteMoreInfoCount = $voteMoreInfoCount * $oneVote;
			    ?>
				
				<div class="col-md-6 no-padding margin-bottom-15">
					<?php if( @($organizer) ){ ?>
						<span class="text-red" style="font-size:13px; font-weight:500;">
							<i class="fa fa-angle-right"></i> 
							<?php echo Yii::t("rooms","Made by ",null,Yii::app()->controller->module->id) ?> 
							<a style="font-size:14px;" href="javascript:<?php echo @$organizer['link'] ?>" class="text-dark">
								<?php echo @$organizer['name'] ?>
							</a>
						</span><br/>
					<?php }	?>
					<span class="text-extra-large text-bold text-dark col-md-12" style="font-size:25px !important;">
						<i class="fa fa-file-text"></i> <?php echo  $survey["name"] ?>
					</span>
				</div>
				<div class="col-md-6">
					<div class="box-ajaxTools">					
						<?php if (  isset(Yii::app()->session["userId"]) && $survey["organizerId"] == Yii::app()->session["userId"] )  
						{
							$hasVote = (@$survey["voteUpCount"] || @$survey["voteAbstainCount"] || @$survey["voteUnclearCount"] || @$survey["voteMoreInfoCount"] || @$survey["voteDownCount"] ) ? true : false;
				            if( !$hasVote && $voteLinksAndInfos["avoter"] != "closed" )
				            { ?>
								<a class="tooltips btn btn-default  " href="javascript:openEntryForm()" >
									<i class="fa fa-pencil "></i> <span class="hidden-sm hidden-md hidden-xs">Éditer</span>
								</a>
							<?php } ?>
							<a class="tooltips btn btn-default" href="javascript:;" onclick="$('#modal-select-room5').modal('show')" 
								data-placement="bottom" data-original-title="Déplacer cette proposition dans un autre espace">
							<i class="fa fa-share-alt text-grey "></i> <span class="hidden-sm hidden-md hidden-xs">Déplacer</span>
							</a>
							<?php 
							if( !( ( @$survey["dateEnd"] && $survey["dateEnd"] < time()) )   )
            				{ ?>
							<a class="tooltips btn btn-default  " href="javascript:;" onclick="closeEntry('<?php echo $survey["_id"]; ?>')" 
							   data-placement="bottom" data-original-title="Supprimer cette proposition">
								<i class="fa fa-times text-red "></i> <span class="hidden-sm hidden-md hidden-xs">Fermer</span>
							</a>
						<?php } 
						} ?>
						<a href="javascript:;" data-id="explainSurveys" class="tooltips btn btn-default explainLink" 
						   data-placement="bottom" data-original-title="Comprendre les propositions">
							<i class="fa fa-question-circle "></i> <span class="hidden-sm hidden-md hidden-xs"></span>
						</a>					
					</div>
				</div>	
			</div>	

			<div class="col-md-4 col-sm-4 col-xs-12 no-padding" style="padding-right: 15px !important;">
				
				<?php  $this->renderPartial('../pod/fileupload', 
											 array("itemId" => $survey["_id"],
											  "type" => Survey::COLLECTION,
											  "resize" => false,
											  "contentId" => Document::IMG_PROFIL,
											  "editMode" => Authorisation::canEditItem(Yii::app()->session['userId'],Survey::COLLECTION,$survey["_id"],$parentType,$parentId),
											  "image" => $images)); 
				
				if(isset( Yii::app()->session["userId"]) && false)
				{
					if(Yii::app()->session["userEmail"] != $survey["email"])
					{
						if(!(isset($survey[Action::ACTION_FOLLOW]) 
						    && is_array($survey[Action::ACTION_FOLLOW]) 
						    && in_array(Yii::app()->session["userId"], $survey[Action::ACTION_FOLLOW]))) 
						{} 
						else { 
							
							echo '<div class="space10"></div>'.
								Yii::t("rooms","You are Following this vote.",null,Yii::app()->controller->module->id). 
									"<i class='fa fa-rss' ></i>";
						} 
					} else {

						echo '<div class="space10"></div>'.
								Yii::t("rooms","You created this vote.",null,Yii::app()->controller->module->id);

					    if( Yii::app()->request->isAjaxRequest){ ?>
							<a class="btn btn-xs btn-default" onclick="entryDetail('<?php echo Yii::app()->createUrl("/communecter/survey/entry/id/".(string)$survey["_id"])?>','edit')" href="javascript:;">
								<i class='fa fa-pencil' ></i> 
								<?php echo Yii::t("rooms","Edit this Entry",null,Yii::app()->controller->module->id) ?>
							</a>
						<?php } ?>
					<?php } ?>

				<?php } ?>
				<div class="col-md-12 padding-10">
					<?php if( @( $survey["tags"] ) ){ ?>
						<span class="text-red" style="font-size:13px; font-weight:500;"><i class="fa fa-tags"></i>
						<?php foreach ( $survey["tags"] as $value) {
								echo '<span class="badge badge-danger text-xss">#'.$value.'</span> ';
							}?>
						</span><br>
					<?php }	?>
				</div>
			</div>

			<div class="col-md-8 col-sm-8 col-xs-12 col-tool-vote text-dark" style="margin-bottom: 10px; margin-top: 10px; font-size:15px;">
				
				<span class="text-azure">
					<i class="fa fa-calendar"></i> 
					<?php echo Yii::t("rooms","Since",null,Yii::app()->controller->module->id) ?> : 
					<?php echo date("d/m/Y",$survey["created"]) ?>
					
				</span>
				<br>
				<?php if( @$survey["dateEnd"] ){ ?>
				<span class="text-red">
					<i class="fa fa-calendar"></i>
					<?php echo Yii::t("rooms","Ends",null,Yii::app()->controller->module->id) ?> :
					<a href="javascript:" id="endDate" data-type="date" data-title="Date de fin" data-emptytext="Date de cloture de la proposition" class="editable editable-click" >
					</a>
				</span>
				<span>
					<?php 
						$canEditEndDate = ( $voteLinksAndInfos["avoter"] != "closed" && isset(Yii::app()->session["userId"]) && $survey["organizerId"] == Yii::app()->session["userId"]) ? true : false;
					?>
				</span>
				<br><hr>
				<span>
			 		<i class="fa fa-user"></i> 
			 		<?php echo Yii::t("rooms","VISITORS",null,Yii::app()->controller->module->id) ?> : 
			 		<?php echo (isset($survey["viewCount"])) ? $survey["viewCount"] : "0"  ?>
			 	</span>
				<br>
			 	<span>
					<i class="fa fa-user"></i> 
					<?php echo Yii::t("rooms","VOTERS",null,Yii::app()->controller->module->id) ?> : 
					<?php  echo ( @$voteLinksAndInfos["totalVote"] ) ? $voteLinksAndInfos["totalVote"] : "0";  ?>
				</span>
			 	<br><hr>
			 	<?php } ?>
			 	<div class="text-bold text-dark">
			 		<?php 
						$canParticipate = Authorisation::canParticipate(Yii::app()->session['userId'],$parentType,$parentId);
						if( $canParticipate && $voteLinksAndInfos["hasVoted"] && $voteLinksAndInfos["avoter"] != "closed" ) 
							echo $voteLinksAndInfos["links"]; 
						else if( $canParticipate && $voteLinksAndInfos["avoter"] == "closed" )
							echo '<i class="fa fa-angle-right"></i><span class="text-red"> Cette proposition est cloturé depuis le '.date("d/m/y",@$survey["dateEnd"]).'</span>';
						else if( $canParticipate && !$voteLinksAndInfos["hasVoted"] )
							echo '<i class="fa fa-angle-right"></i> Vous n\'avez pas voté';
						else if( !$canParticipate && isset(Yii::app()->session['userId']) && $parentType == "cities")
							echo '<i class="fa fa-angle-right"></i> Vous devez habiter cette commune pour voter ici';
						else if( !$canParticipate && isset(Yii::app()->session['userId']) )
							echo '<i class="fa fa-angle-right"></i> Devenez membre pour voter ici';
						else if( !$canParticipate && !isset(Yii::app()->session['userId']) )
							echo '<i class="fa fa-angle-right"></i> Connectez-vous pour voter';
					?>
				</div>

			</div>

			<div class="col-xs-12 no-padding">

				<div class="col-xs-12 text-dark" style="font-size:15px">
					<hr style="margin-top:0px">
					<?php echo $survey["message"]; ?>
					<hr>
					<h2 class="center homestead text-dark"><i class="fa fa-angle-down"></i><br>Espace de vote</h2>
				</div>

				<div class="col-xs-12">
					<?php echo Survey::getChartCircle($survey, $voteLinksAndInfos, $parentType,$parentId); ?>
					<div class="col-md-12 col-sm-12 no-padding margin-top-10"><hr></div>
				</div>

				<?php if( @( $survey["urls"] ) ){ ?>
				<div class="col-md-12 col-xs-12 col-sm-12 center">
					
					<h2 class="text-dark"><br><i class="fa fa-link"></i> Informations complémentaires</h2>
					<?php foreach ( $survey["urls"] as $value) {
						if( strpos($value, "http://")!==false || strpos($value, "https://")!==false )
							echo '<a href="'.$value.'" class="text-large" style="word-wrap: break-word;" target="_blank">'.
									''.$value.
								 '</a><br/> ';
						else
							echo '<span class="text-large"><i class="fa fa-angle-right"></i> '.$value.'</span><br/> ';
					}?>
				</div>	
				<?php }	?>
			</div>

			<?php if( $totalVotes > 0 && false){ ?>
			<div  class="col-md-5 radius-10" style="border:1px solid #666; background-color:#ddd;">
				<div class="leftInfoSection chartResults" >
					<?php //echo getChartBarResult($survey); ?>
					<div id="container2"></div>
				</div>
			</div>
			<?php }	?>
		</div>
	</div>
		
	<div class="col-md-12 col-sm-12 commentSection leftInfoSection" >
		<hr>
		<h2 class='text-dark homestead' style="margin: -20px 0px 15px;"><i class="fa fa-angle-down"></i><br>Discussion</h2>
		<div class="box-vote box-pod margin-10 commentPod"></div>
	</div>
	
</div>

<?php if (  isset(Yii::app()->session["userId"]) && $survey["organizerId"] == Yii::app()->session["userId"] )  { ?>
<div class="modal fade" id="modal-edit-entry" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-dark">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-left">
        	<i class="fa fa-angle-down"></i> <i class="fa fa-pencil"></i> Éditer la proposition
        </h2>
      </div>
      <div class="modal-body no-padding">
      	<div class="panel-body" id="form-edit-entry">
			<?php 
				$params = array(
			    	"survey" => $survey, //la proposition actuelle
			        "roomId" => $survey["survey"] //id de la room
			    );
				$this->renderPartial('../survey/editEntrySV', $params); 
			?>
		</div>
		
	  </div>
	</div>
  </div>
</div>
<?php }	?>

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
var images = <?php echo json_encode($images) ?>;
var mode = "view";
var itemId = "<?php echo $survey["_id"] ?>";
var endDate = "<?php echo date("d/m/Y",@$survey["dateEnd"]) ?>";

jQuery(document).ready(function() {
	$.fn.editable.defaults.container='body';
	$(".main-col-search").addClass("assemblyHeadSection");
  	setTitle("Propositions, débats, votes","gavel");
  	$('.box-vote').show();

  	$(".tooltips").tooltip();
	
  	$('#form-edit-entry #btn-submit-form').addClass("hidden");

  	$(".commentPod").html("<i class='fa fa-spin fa-refresh'></i> Chargement des commentaires");
	getAjax(".commentPod",baseUrl+"/"+moduleId+"/comment/index/type/surveys/id/<?php echo $survey['_id'] ?>",
		function(){  $(".commentCount").html( $(".nbComments").html() ); 
	},"html");

	$(".explainLink").click(function() {
		showDefinition( $(this).data("id") );
		return false;
	});

	editEndDate();

});

//activate Xedit on endDate (#1177)
function editEndDate() {
<?php
	if( $canEditEndDate ) {
?>
	mylog.log("Init XEdit end date");
	$('#endDate').editable({
		pk: itemId,
		url: baseUrl+"/"+moduleId+"/element/updatefields/type/<?php echo Survey::COLLECTION?>", 
		mode: 'popup',
		placement: "right",
		format: 'yyyy-mm-dd',   
    	viewformat: 'dd/mm/yyyy',
    	datepicker: {
            weekStart: 1,
        },
        //toggle:'mouseenter',
        showbuttons: true,
		success : function(data) {
			if(data.result) {
				toastr.success(data.msg);
				loadActivity=true;	
			}else 
				return data.msg;
	    }
    });

	//formatDate = "YYYY-MM-DD HH:mm";
	mylog.log("End Date : "+moment(endDate, "DD/MM/YYYY").format("YYYY-MM-DD"));
	$('#endDate').editable('setValue', moment(endDate, "DD/MM/YYYY").format("YYYY-MM-DD"), true);

<?php } ?>
}

function saveEditEntry(){ 
	$('#form-edit-entry #btn-submit-form').click();
}

function addaction(id,action)
{
    mylog.warn("--------------- addaction ---------------------");
    if( checkIsLoggued( "<?php echo Yii::app()->session['userId']?>" ))
    {
    	var message = "<span class='text-dark'>Vous avez choisi de voter <strong>" + trad[action] + "</strong></span><br>";
    	var input = "<span class='text-red'><i class='fa fa-warning'></i> Vous ne pourrez pas changer votre vote</span>"+
    				"<span id='modalComment'>"+
    					'<textarea class="newComment wysiwygInput" rows="2" style="width: 100%" placeholder="Laisser un commentaire... (optionnel)"></textarea>'+
    				"</span><br>"+
    				'<script type="text/javascript" >'+
    				'$(".wysiwygInput").off().on("focus", function(){ activateSummernote(".newComment");})'+
    				'<\/script>';

    	var boxNews = bootbox.dialog({
			title: message,
			message: input,
			buttons: {
				annuler: {
					label: "Annuler",
					className: "btn-default",
					callback: function() {
						$("."+clickedVoteObject).removeClass("faa-bounce animated");
					}
				},
				success: {
					label: "Confirmer",
					className: "btn-info",
					callback: function() {
						var voteComment = $("#modalComment .newComment").code();
						params = { 
				           "userId" : '<?php echo Yii::app()->session["userId"]?>' , 
				           "id" : id ,
				           "collection":"surveys",
				           "action" : action 
				        };
				        console.log("voteComment", voteComment);
				        if(voteComment != ""){
				        	params.comment = trad[action]+' : '+voteComment;
				        	saveComment(params.comment);
				        } 
				      	ajaxPost(null,'<?php echo Yii::app()->createUrl($this->module->id."/survey/addaction")?>',params,function(data){
				        	loadByHash(location.hash);
				      	});
					}
				}
			}
    	});
    	
 	}
 }

var activePanel = "vote-row";
function showHidePanels (panel) 
{  
	$('.'+activePanel).slideUp();
	$('.'+panel).slideDown();
	activePanel = panel;
}

function buildResults () { 


		mylog.log("buildResults");

	var getColor = {
	    'Pou': '#93C22C',
	    'Con': '#db254e',
	    'Abs': 'white', 
	    'Pac': 'yellow', 
	    'Plu': '#789289'
	}; 
	
		mylog.log("setUpGraph");
		$('#container2').highcharts({
		    chart: {
		        plotBackgroundColor: null,
		        plotBorderWidth: null,
		        plotShadow: false,
		        //marginTop: -20,
		        backgroundColor: "#ddd"
		    },
		    title: {
		        text: "Resultats"
		    },
		    tooltip: {
		      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		    },
		    plotOptions: {
		        pie: {
		            allowPointSelect: true,
		            cursor: 'pointer',
		            //size: 200,
		            dataLabels: {
		                enabled: true,
		                color: '#000000',
		                connectorColor: '#000000',
		                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
		            }
		        }
		    },
		    exporting: {
			    enabled: false
			},
		    
		    series: [{
		        type: 'pie',
		        name: 'Vote',
		        data: [
		        	{ name: 'Vote Pour',y: <?php echo $voteUpCount?>,color: getColor['Pou'] },
		        	{ name: 'Vote Contre',y: <?php echo $voteDownCount?>,color: getColor['Con'] },
		        	{ name: 'Abstention',y: <?php echo $voteAbstainCount?>,color: getColor['Abs'] },
		        	{ name: 'Pas Clair',y: <?php echo $voteUnclearCount?>,color: getColor['Pac'] },
		        	{ name: "Plus d'infos",y: <?php echo $voteMoreInfoCount?>,color: getColor['Plu'] }
		        ]
		    }]
		});
}


function closeEntry(id)
{
    mylog.warn("--------------- closeEntry ---------------------");
    
      bootbox.confirm("<strong>Êtes-vous sûr de vouloir fermer cette proposition ?</strong> (fermeture définitive) ",
          function(result) {
            if (result) {
              params = { 
                 "id" : id 
              };
              ajaxPost(null,'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/survey/close")?>',params,function(data){
                if(data.result)
                  window.location.reload();
                else 
                  toastr.error(data.msg);
              });
          } 
      });
 }

function move( type,destId ){
	bootbox.hideAll();
	mylog.warn("--------------- move ---------------------",type,destId);
	bootbox.confirm("<strong>Êtes-vous sûr de vouloir déplacer cette proposition ?</strong>",
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

</script>