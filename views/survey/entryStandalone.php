<?php 
$cs = Yii::app()->getClientScript();
$cssAnsScriptFilesModule = array(
  '/survey/js/highcharts.js',
  '/js/dataHelpers.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);


$logguedAndValid = Person::logguedAndValid();
$voteLinksAndInfos = Action::voteLinksAndInfos($logguedAndValid,$survey);

?>
<style type="text/css">

	/*.assemblyHeadSection {  
      background-image:url(<?php echo $this->module->assetsUrl; ?>/images/Discussion.jpg); 
    }*/
  	
	/*a.btn{margin:3px;}*/
	/*a:hover.btn {background-color: pink;border solid #666;}*/

	/*.infolink{border-top:1px solid #fff}*/
	.leftlinks a.btn{color:black;background-color: yellow;border: 0px solid yellow;}
	.leftlinks a.btn:hover{color:white;background-color: #3C5665;}
	/*.rightlinks a.btn{background-color: beige;border: 1px solid beige;}*/
	a.btn.alertlink		{background-color:red;color:white;border: 1px solid red;}
	a.btn.golink		{background-color:green;color:white;border: 1px solid green;}
	a.btn.voteUp		{background-color: #93C22C;border: 1px solid green;}
	a.btn.voteUnclear	{background-color: yellow;border: 1px solid yellow;}
	a.btn.voteMoreInfo	{background-color: #C1ABD4;border: 1px solid #789289;}
	a.btn.voteAbstain	{color: black;background-color: white;border: 1px solid grey !important;}
	a.btn.voteDown		{background-color: #db254e;border: 1px solid #db254e;}

	.commentPod .panel {box-shadow: none;}
	.commentPod .panel-heading {border-bottom-width: 0px;}

	

    .leftlinks a.btn{
    	border: transparent;
		border-radius: 25px;
		font-size: 25px;
    }

  .progress-bar-green{background-color: #93C22C;}
  .progress-bar-yellow{background-color: yellow;}
  .progress-bar-white{background-color: #C9C9C9;}
  .progress-bar-purple{background-color: #C1ABD4;}
  .progress-bar-red{background-color: #db254e;}

  .color-btnvote-green{background-color: #93C22C;color: black;	padding: 8px;border-radius: 30px;}
  .color-btnvote-yellow{background-color: yellow;color: black;	padding: 8px;border-radius: 30px;}
  .color-btnvote-white{background-color: #FFF;color: black;	padding: 8px;border-radius: 30px;border: 1px solid #939393;}
  .color-btnvote-purple{background-color: #C1ABD4;color: black;	padding: 8px;border-radius: 30px;}
  .color-btnvote-red{background-color: #db254e;color: black;		padding: 8px;border-radius: 30px;}

  .msg-head-tool-vote{
  	width:100%;
  	font-size: 18px;
  	font-weight: 300;
  }



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

			
	//copié coller merdique
	// a sortir de la vue demain
	$voteDownCount      = (isset($survey[Action::ACTION_VOTE_DOWN."Count"])) ? $survey[Action::ACTION_VOTE_DOWN."Count"] : 0;
	$voteAbstainCount   = (isset($survey[Action::ACTION_VOTE_ABSTAIN."Count"])) ? $survey[Action::ACTION_VOTE_ABSTAIN."Count"] : 0;
	$voteUnclearCount   = (isset($survey[Action::ACTION_VOTE_UNCLEAR."Count"])) ? $survey[Action::ACTION_VOTE_UNCLEAR."Count"] : 0;
	$voteMoreInfoCount  = (isset($survey[Action::ACTION_VOTE_MOREINFO."Count"])) ? $survey[Action::ACTION_VOTE_MOREINFO."Count"] : 0;
	$voteUpCount        = (isset($survey[Action::ACTION_VOTE_UP."Count"])) ? $survey[Action::ACTION_VOTE_UP."Count"] : 0;

	$totalVotesGbl = $voteDownCount+$voteAbstainCount+$voteUpCount+$voteUnclearCount+$voteMoreInfoCount;

			function getChartBarResult($survey){

	$voteDownCount      = (isset($survey[Action::ACTION_VOTE_DOWN."Count"])) ? $survey[Action::ACTION_VOTE_DOWN."Count"] : 0;
	$voteAbstainCount   = (isset($survey[Action::ACTION_VOTE_ABSTAIN."Count"])) ? $survey[Action::ACTION_VOTE_ABSTAIN."Count"] : 0;
	$voteUnclearCount   = (isset($survey[Action::ACTION_VOTE_UNCLEAR."Count"])) ? $survey[Action::ACTION_VOTE_UNCLEAR."Count"] : 0;
	$voteMoreInfoCount  = (isset($survey[Action::ACTION_VOTE_MOREINFO."Count"])) ? $survey[Action::ACTION_VOTE_MOREINFO."Count"] : 0;
	$voteUpCount        = (isset($survey[Action::ACTION_VOTE_UP."Count"])) ? $survey[Action::ACTION_VOTE_UP."Count"] : 0;

	$totalVotes = $voteDownCount+$voteAbstainCount+$voteUpCount+$voteUnclearCount+$voteMoreInfoCount;
      
      
      $oneVote = ($totalVotes!=0) ? 100/$totalVotes:1;
      
      $percentVoteDownCount     = $voteDownCount    * $oneVote;
      $percentVoteAbstainCount  = $voteAbstainCount * $oneVote;
      $percentVoteUpCount       = $voteUpCount      * $oneVote;
      $percentVoteUnclearCount  = $voteUnclearCount * $oneVote;
      $percentVoteMoreInfoCount = $voteMoreInfoCount * $oneVote;

      $html = "";

      $percentNoVote = "0";
      if($totalVotes == 0) $percentNoVote = "100";

      $html .= '<a class="btn btn-xs pull-left text-dark"'.
                ' onclick="entryDetail(\''.Yii::app()->createUrl("/".Yii::app()->controller->module->id."/survey/graph/id/".(string)$survey["_id"]).'\',\'graph\')"'.
                ' href="javascript:;"><i class="fa fa-pie-chart"></i>'.'</a>';

      if($totalVotes > 1) $msgVote = "votes exprimés";
      else                $msgVote = "vote exprimé"; 
      
      if($totalVotes >= 1 && Yii::app()->session['userId'] == $survey['organizerId'])
      	$msgVote = $msgVote." <span class='text-red'>( donc édition fermé )</span>";

      $html .= "<div class='pull-left text-dark' style='margin-top:5px; margin-left:5px; font-size:13px;'>".$totalVotes." ".$msgVote."</div><div class='space1'></div>";
      
      $html .=  '<div class="progress">'.
                  '<div class="progress-bar progress-bar-green progress-bar-striped" style="width: '.$percentVoteUpCount.'%">'.
                    $voteUpCount.' <i class="fa fa-thumbs-up"></i> ('.floor($percentVoteUpCount).'%)'.
                  '</div>'.
                  '<div class="progress-bar progress-bar-yellow progress-bar-striped" style="width: '.$percentVoteUnclearCount.'%">'.
                    $voteUnclearCount.' <i class="fa fa-pen"></i> ('.floor($percentVoteUnclearCount).'%)'.
                  '</div>'.
                  '<div class="progress-bar progress-bar-white progress-bar-striped" style="width: '.$percentVoteAbstainCount.'%">'.
                    $voteAbstainCount.' <i class="fa fa-circle"></i> ('.floor($percentVoteAbstainCount).'%)'.
                  '</div>'.
                  '<div class="progress-bar progress-bar-purple progress-bar-striped" style="width: '.$percentVoteMoreInfoCount.'%">'.
                    $voteMoreInfoCount.' <i class="fa fa-question-circle"></i> ('.floor($percentVoteMoreInfoCount).'%)'.
                  '</div>'.
                  '<div class="progress-bar progress-bar-red progress-bar-striped" style="width: '.$percentVoteDownCount.'%">'.
                    $voteDownCount.' <i class="fa fa-thumbs-down"></i> ('.floor($percentVoteDownCount).'%)'.
                  '</div>'.
                  '<div class="progress-bar progress-bar-white progress-bar-striped" style="width: '.floor($percentNoVote).'%">'.
                   // $percentNoVote.' '.
                  '</div>'.
                '</div>';
      
      
      
      return $html;
    }
 ?>
 	
<?php 
  $nameList = (strlen($room["name"])>20) ? substr($room["name"],0,20)."..." : $room["name"];
  $extraBtn = ( Authorisation::canParticipate(Yii::app()->session['userId'],$parentType,$parentId) ) ? ' <i class="fa fa-caret-right"></i> <a class="filter btn  btn-xs btn-primary Helvetica" href="javascript:;" onclick="loadByHash(\'#survey.editEntry.survey.'.(string)$room["_id"].'\')"><i class="fa fa-plus"></i> '.Yii::t( "survey", 'Add a proposal', null, Yii::app()->controller->module->id).'</a>' : '';
  
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
			
			<h1 class="text-dark" style="font-size: 25px;margin-top: 20px;">
				<i class="fa fa-angle-down"></i> <span class="homestead"><i class="fa fa-archive"></i> Espace de décision 
			</h1>
			<?php 					
				if( Yii::app()->request->isAjaxRequest && isset($survey["survey"]) ){
					Menu::proposal( $survey );
					$this->renderPartial('../default/panels/toolbar');
				}
			?>

			<h4 class="col-md-12 text-center text-azure info-survey"> 
				
				<span class="pull-right"><?php echo Yii::t("rooms","Since",null,Yii::app()->controller->module->id) ?> <i class="fa fa-caret-right"></i> <?php echo date("d/m/y",$survey["created"]) ?></span>
				
				<span class="pull-left"><i class="fa fa-caret-right"></i> <?php echo Yii::t("rooms","VOTERS",null,Yii::app()->controller->module->id) ?> : <?php  echo ( @$voteLinksAndInfos["totalVote"] ) ? $voteLinksAndInfos["totalVote"] : "0";  ?> </span>
			 	<br>
			 	<span class="pull-left"><i class="fa fa-caret-right"></i> <?php echo Yii::t("rooms","VISITORS",null,Yii::app()->controller->module->id) ?> : <?php echo (isset($survey["viewCount"])) ? $survey["viewCount"] : "0"  ?></span>
				<?php if( @$survey["dateEnd"] ){ ?>
				<span class="pull-right"><?php echo Yii::t("rooms","Ends",null,Yii::app()->controller->module->id) ?> <i class="fa fa-caret-right"></i> <?php echo date("d/m/y",@$survey["dateEnd"]) ?></span>
				<?php } ?>
				
			</h4>

			
			<div class="col-md-6 col-md-offset-3 center" style="margin-top: -45px; margin-bottom: 10px;">

				<?php if( @$survey["dateEnd"] && $survey["dateEnd"] < time() || @$room["status"]==ActionRoom::STATE_ARCHIVED ){ 
					$stateLbl = ( @$room["status"]==ActionRoom::STATE_ARCHIVED ) ? Yii::t("rooms","Archived",null,Yii::app()->controller->module->id) : Yii::t("rooms","Closed",null,Yii::app()->controller->module->id); 
					?>
						
						<div class="box-vote box-pod radius-20" style="">
							<span class="text-extra-large text-bold text-red"> 
								<?php echo $stateLbl ?>
							</span> 
							<?php if( isset($organizer) ){ ?>
								<p><?php echo Yii::t("rooms","Proposed by",null,Yii::app()->controller->module->id) ?> <a href="<?php echo @$organizer['link'] ?>" target="_blank"><?php echo @$organizer['name'] ?></a> </p>
							<?php }	?>
							
						</div>
						
				<?php } else { ?> 

						<div class="box-vote box-pod radius-20">
							<?php

							$this->renderPartial('entry',array( "survey" => $survey, 
																"voteLinksAndInfos" => $voteLinksAndInfos,
																"position" => "center",
																"showName" => true,
																"hideTexts" => true
																 ));
																 ?>
						</div>

				<?php } ?>
			</div>	
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
				<div class="col-md-<?php echo ($totalVotes ==0 ) ? "12" : "7" ?>" style="margin-top:10px;">
					<?php if( @($organizer) ){ ?>
						<span class="text-red" style="font-size:13px; font-weight:500;"><i class="fa fa-caret-right"></i> Proposition de <a style="font-size:14px;" href="javascript:<?php echo @$organizer['link'] ?>" class="text-dark"><?php echo @$organizer['name'] ?></a></span><br/>
					<?php }	?>
					
					<span class="text-extra-large text-bold text-dark col-md-12" style="font-size:25px !important;"><i class="fa fa-file-text"></i> <?php echo  $survey["name"] ?></span>
					<br/><br/>
					<?php 
					$this->renderPartial('../pod/fileupload', array("itemId" => $survey["_id"],
																	  "type" => Survey::COLLECTION,
																	  "resize" => false,
																	  "contentId" => Document::IMG_PROFIL,
																	  "editMode" => Authorisation::canParticipate(Yii::app()->session['userId'],$parentType,$parentId),
																	  "image" => $images)); 
					?>
					<?php echo $survey["message"]; ?>
					
					<br/>
					<?php if( @( $survey["tags"] ) ){ ?>
						<span class="text-red" style="font-size:13px; font-weight:500;"><i class="fa fa-tags"></i>
						<?php foreach ( $survey["tags"] as $value) {
								echo '<span class="badge badge-danger text-xss">#'.$value.'</span> ';
							}?>
						</span><br>
					<?php }	?>

					<?php if( @( $survey["urls"] ) ){ ?>
						
						<h2 class="text-dark" style="border-top:1px solid #eee;"><br>Des liens d'informations ou actions à faire</h2>
						<?php foreach ( $survey["urls"] as $value) {
							if( strpos($value, "http://")!==false || strpos($value, "https://")!==false )
								echo '<a href="'.$value.'" class="text-large" style="word-wrap: break-word;" target="_blank"><i class="fa fa-link"></i> '.$value.'</a><br/> ';
							else
								echo '<span class="text-large"><i class="fa fa-caret-right"></i> '.$value.'</span><br/> ';
						}?>
						
					<?php }	?>
				</div>
				<?php 
				
				if( $totalVotes > 0 ){ ?>
				<div  class="col-md-5 radius-10" style="border:1px solid #666; background-color:#ddd;">
					<div class=" leftInfoSection chartResults" >
						<?php echo getChartBarResult($survey); ?>
						<div id="container2"></div>
					</div>
				</div>
				<?php }	?>
			</div>
		</div>
	</div>
		
	<div class="col-md-12 commentSection leftInfoSection" >
		<div class="box-vote box-pod margin-10 commentPod"></div>
	</div>
	
</div>

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
jQuery(document).ready(function() {
	//var shareBtns = new ShareButton(".share-button");

	//titleAnim ();

	$(".main-col-search").addClass("assemblyHeadSection");
  	$(".moduleLabel").html("<i class='fa fa-gavel'></i> Propositions, débats, votes");
  
  	$('.box-vote').show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
		$(this).removeClass("animated flipInX");
	});

	
	getAjax(".commentPod",baseUrl+"/"+moduleId+"/comment/index/type/surveys/id/<?php echo $survey['_id'] ?>",function(){ $(".commentCount").html( $(".nbComments").html() ); },"html");


	buildResults ();

});

function addaction(id,action)
{
    console.warn("--------------- addaction ---------------------");
    if( checkIsLoggued( "<?php echo Yii::app()->session['userId']?>" ))
    {
    	var message = "Vous êtes sûr ? <span class='text-red text-bold'><i class='fa fa-warning'></i> Vous ne pourrez pas changer votre vote</span>";
    	var input = "<span id='modalComment'><input type='text' class='newComment form-control' placeholder='Laisser un commentaire... (optionnel)'/></span><br>";
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
					label: "OK",
					className: "btn-info",
					callback: function() {
						var voteComment = $("#modalComment .newComment").val();
						params = { 
				           "userId" : '<?php echo Yii::app()->session["userId"]?>' , 
				           "id" : id ,
				           "collection":"surveys",
				           "action" : action 
				        };
				        if(voteComment != ""){
				        	params.comment = trad[action]+' : '+voteComment;
				        	$("#modalComment .newComment").val(params.comment);
				        	validateComment("modalComment","");
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


		console.log("buildResults");

	var getColor = {
	    'Pou': '#93C22C',
	    'Con': '#db254e',
	    'Abs': 'white', 
	    'Pac': 'yellow', 
	    'Plu': '#789289'
	}; 
	
		console.log("setUpGraph");
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
    console.warn("--------------- closeEntry ---------------------");
    
      bootbox.confirm("Are you sure ? you cannot revert closing an entry. ",
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

function listOfDestinations(){

	str = "<h2>Change Parent, different parentType and Id</h2>";
	str += "<h2>Move to Decission Room</h2>";
	str += "<a href='javascript:move(\"survey\",\"57864dc3f6ca47cf4a8b457d\")'>ggggggg</a>";
	str += "<br/><a href='javascript:move(\"survey\",\"57862323f6ca47ff558b4573\")'>one two three </a>";
	str += "<h2>Move to Action Room</h2>";
	str += "<br/><a href='javascript:move(\"survey\",\"5786585cf6ca477b4e8b457d\")'>convert to action and move to qqqq </a>";
	return str;
}

function movePrompt(type, id)
{
     bootbox.dialog({
		title: "<b>Choose where to move</b> ",
		message: listOfDestinations(),
    });
}

function move( type,destId ){
	bootbox.hideAll();
	console.warn("--------------- move ---------------------",type,destId);
	bootbox.confirm("Vous êtes sûr ? ",
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
		            toastr.success("<h1>"+data.msg+".<h1>");
		            loadByHash(data.url);
		          } else 
		            toastr.error(data.msg);
		          
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