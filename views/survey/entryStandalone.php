<?php 
$cs = Yii::app()->getClientScript();
$cssAnsScriptFilesModule = array(
  '/survey/js/highcharts.js',
  '/js/dataHelpers.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);


$logguedAndValid = Person::logguedAndValid();
$voteLinksAndInfos = Action::voteLinksAndInfos($logguedAndValid,$survey);

if( Yii::app()->request->isAjaxRequest && isset($survey["survey"]) ){
	Menu::proposal( $survey );
	$this->renderPartial('../default/panels/toolbar');
}
?>
<style type="text/css">

	/*a.btn{margin:3px;}*/
	a:hover.btn {background-color: pink;border solid #666;}

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

	.assemblyHeadSection {  
      background-image:url(<?php echo $this->module->assetsUrl; ?>/images/Discussion.jpg); 
      /*background-image: url(/ph/assets/449afa38/images/city/cityDefaultHead_BW.jpg);*/
      background-color: #fff;
      background-repeat: no-repeat;
      background-position: 0px -50px;
      background-size: 100% auto;
    }

      .citizenAssembly-header{
        background-color: rgba(255, 255, 255, 0.63);
		padding-top: 0px;
		margin-bottom: -3px;
		font-size: 32px;
		top: 115px;
		z-index: 1;
		position: absolute;
		width: 96%;
		left: 2%;
		padding-bottom: 15px;
      }

    .citizenAssembly-header h1{
    	font-size: 32px;
		
    }
    .row.vote-row {
	   	position: absolute;
		padding-top: 5px;
		top: 300px;
		background-color: white;
		width: 100%;
		z-index: 0;
    }

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

  #thumb-profil-parent{
      margin-top:-60px;
      margin-bottom:20px;
      -moz-box-shadow: 0px 3px 10px 1px #656565;
      -webkit-box-shadow: 0px 3px 10px 1px #656565;
      -o-box-shadow: 0px 3px 10px 1px #656565;
      box-shadow: 0px 3px 10px 1px #656565;
    }


#commentHistory .panel-scroll{
	max-height:unset !important;
}


@media screen and (min-width: 1060px) {
  
}
@media screen and (max-width: 1060px) {
  
  .assemblyHeadSection {  
    background-position: 0px 50px;
  }

  .container-tool-vote {
    font-size: 17px;
    margin-top: 60px;
  }
}

@media screen and (max-width: 767px) {
  .assemblyHeadSection {  
    background-position: 0px 0px;
  }
  .citizenAssembly-header{
  	top: 70px;
  	height:160px;
  }
  .citizenAssembly-header h1 {
	font-size: 24px;
  }
  .row.vote-row {
    top: 230px;
  }
}

@media screen and (max-width: 600px) {
  
}

</style>

<?php /* ?>
<div class="pull-right" style="padding:20px;">
	<a href="#" onclick="showMenu()">
		<i class="menuBtn fa fa-bars fa-3x text-white "></i>
	</a>
</div>
*/?>



<!-- start: LOGIN BOX -->
<div class="padding-20 center" style="margin-top: 20px">
	<?php /* ?>
	<span class="titleRed text-red homestead" style="font-size:40px">CO</span>
	<span  style="font-size:40px" class="titleWhite homestead">MMU</span>
	<span  style="font-size:40px" class="titleWhite2 text-red homestead">NECTER</span>
	<a href="#" class="text-white" onclick="showVideo('133636468')"><i class="fa fa-2x fa-youtube-play"></i></a>

	<br/>
	<span class="subTitle text-white text-bold" style="margin-top:-13px; font-size:1.5em">Se connecter à sa commune.</span>
	*/?>
	<br/>
	<!-- <span class="text-red " style="font-size:40px"><?php echo Yii::t("rooms","VOTE",null,Yii::app()->controller->module->id) ?> </span>
	<span  style="font-size:40px" class=" "> <?php echo Yii::t("rooms","DECIDE",null,Yii::app()->controller->module->id) ?> </span>
	<span  style="font-size:40px" class=" text-red "> <?php echo Yii::t("rooms","ACT",null,Yii::app()->controller->module->id) ?></span>
 -->
<?php 
	//ca sert a quoi ce doublon ?
	$survey = Survey::getById($survey["_id"]);
	$room = ActionRoom::getById($survey["survey"]);
	$parentType = $room["parentType"];
	$parentId = $room["parentId"];
	$nameParentTitle = "";
	if($parentType == Organization::COLLECTION && isset($parentId)){
		$orga = Organization::getById($parentId);
		$nameParentTitle = $orga["name"];
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
 	<div>
     
 		<h1 class="homestead text-dark center citizenAssembly-header">

		  <?php 
		    $urlPhotoProfil = "";
		    if(isset($parent['profilImageUrl']) && $organizer['profilImageUrl'] != "")
		        $urlPhotoProfil = Yii::app()->createUrl($organizer['profilImageUrl']);
		      else
		        $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
		  
		    $icon = "comments"; 
		      if($parentType == Project::COLLECTION) $icon = "lightbulb-o";
		      if($parentType == Organization::COLLECTION) $icon = "group";
		      if($parentType == Person::CONTROLLER) $icon = "user";
		  ?>
		  <img class="img-circle" id="thumb-profil-parent" width="120" height="120" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
		    <br>
		  <span style="padding:0px; border-radius:50px;">
		    <i class="fa fa-<?php echo $icon; ?>"></i> 
		    <?php echo $organizer["name"]; ?>
		  </span>
		  	<br>
		  <small class="homestead text-dark center">Propositions, Débats, Votes</small>
		  
		</h1>
     

		<!-- <span class="pull-right text-right"> 
			<?php if( $voteLinksAndInfos["hasVoted"] )
				echo Yii::t("rooms","YOU VOTED ALLREADY",null,Yii::app()->controller->module->id); 
			else
				echo Yii::t("rooms","FEEL FREE TO VOTE",null,Yii::app()->controller->module->id); ?>

		</span> -->

		<!-- <span class="text-extra-large text-bold"> 
				<?php echo Yii::t("rooms","INVITATION TO VOTE",null,Yii::app()->controller->module->id) ?>
		</span>  -->
		
    </div>
 </div>

<div class="row vote-row" >

	<div class="col-md-12">
		<!-- start: REGISTER BOX -->
		<div class="box-vote box-pod box">
				
			<h4 class="col-md-12 text-center text-azure" style="font-weight:500; font-size:13px;"> 
				
				<span class="pull-right"><?php echo Yii::t("rooms","Since",null,Yii::app()->controller->module->id) ?> <i class="fa fa-caret-right"></i> <?php echo date("d/m/y",$survey["created"]) ?></span>
				
				<span class="pull-left"><i class="fa fa-caret-right"></i> <?php echo Yii::t("rooms","VOTERS",null,Yii::app()->controller->module->id) ?> : <?php  echo ( @$voteLinksAndInfos["totalVote"] ) ? $voteLinksAndInfos["totalVote"] : "0";  ?> </span>
			 	<br>
			 	<span class="pull-left"><i class="fa fa-caret-right"></i> <?php echo Yii::t("rooms","VISITORS",null,Yii::app()->controller->module->id) ?> : <?php echo (isset($survey["viewCount"])) ? $survey["viewCount"] : "0"  ?></span>
				<?php if( @$survey["dateEnd"] ){ ?>
				<span class="pull-right"><?php echo Yii::t("rooms","Ends",null,Yii::app()->controller->module->id) ?> <i class="fa fa-caret-right"></i> <?php echo date("d/m/y",@$survey["dateEnd"]) ?></span>
				<?php } ?>
				
			</h4>

			

			<div class="col-md-6 col-md-offset-3 center" style="margin-top: -45px; margin-bottom: 10px;">

				<?php if( @$survey["dateEnd"] && $survey["dateEnd"] < time() ){ ?>
						
						<div class="box-vote box-pod box radius-20" style="">
							<span class="text-extra-large text-bold text-red"> 
								<?php echo Yii::t("rooms","Closed",null,Yii::app()->controller->module->id) ?>
							</span> 
							<?php if( isset($organizer) ){ ?>
								<p><?php echo Yii::t("rooms","Proposed by",null,Yii::app()->controller->module->id) ?> <a href="<?php echo @$organizer['link'] ?>" target="_blank"><?php echo @$organizer['name'] ?></a> </p>
							<?php }	?>
							
						</div>
						
				<?php } else { ?> 

						<div class="box-vote box-pod box radius-20">
							<?php
							$this->renderPartial('entry',array( "survey" => $survey, 
																"position" => "center",
																"showName" => true,
																"hideTexts" => true
																 ));?>
						</div>

				<?php } ?>
			</div>	
			<div class="col-xs-12 voteinfoSection">
				<div class="col-md-7" style="margin-top:10px;">
					<?php if( isset($organizer) ){ ?>
						<span class="text-red" style="font-size:13px; font-weight:500;"><i class="fa fa-caret-right"></i> Proposition à l'assemblée par <a style="font-size:14px;" href="javascript:<?php echo @$organizer['link'] ?>" class="text-dark"><?php echo @$organizer['name'] ?></a></span><br/>
					<?php }	?>
					
					<span class="text-extra-large text-bold text-dark col-md-12" style="font-size:25px !important;"><i class="fa fa-file-text"></i> <?php echo  $survey["name"] ?></span>
					<br/><br/>
					
					<?php echo $survey["message"]; ?>
					
					<br/>
					<?php if( isset( $survey["tags"] ) ){ ?>
						<span class="text-red" style="font-size:13px; font-weight:500;"><i class="fa fa-tags"></i>
						<?php foreach ( $survey["tags"] as $value) {
								echo '<span class="badge badge-danger text-xss">#'.$value.'</span> ';
							}?>
						</span><br>
					<?php }	?>

					<?php if( isset( $survey["urls"] ) ){ ?>
						
						<h2 class="text-dark" style="border-top:1px solid #eee;"><br>Des liens d'informations ou actions à faire</h2>
						<?php foreach ( $survey["urls"] as $value) {
							if( strpos($value, "http://")!==false || strpos($value, "https://")!==false )
								echo '<a href="'.$value.'" class="text-large"  target="_blank"><i class="fa fa-link"></i> '.$value.'</a><br/> ';
							else
								echo '<span class="text-large"><i class="fa fa-caret-right"></i> '.$value.'</span><br/> ';
						}?>
						<span class="" >Faites des propositions dans les commentaires</span>
					<?php }	?>
				</div>
				<div  class="col-md-5" style="border:1px solid #ccc">
					<div class="col-md-12 leftInfoSection chartResults" >
						<?php echo getChartBarResult($survey); ?>
						<div id="container2"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
		
	<div class="col-md-12 commentSection leftInfoSection" >
		<div class="box-vote box-pod box margin-10 commentPod"></div>
	</div>
	
</div>


<div class="row discuss-row hide"  >
	<div class="panel panel-white col-xs-8 col-xs-offset-2 ">
		<div class="panel-heading border-light ">
			<h4 class="panel-title"> <i class='fa fa-commentsfa-2x icon-big text-center '></i> DISCUSS</h4>
		</div>
		<div class="panel-body">
			<h1></h1>

			<div class="space20">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, similique autem, neque provident hic placeat in magnam temporibus laborum, corporis tenetur cumque tempora sit cum dignissimos. Animi molestiae nostrum consequuntur.</div>
			<div class="space20">Iusto quis facilis officia ullam! Impedit corporis pariatur exercitationem, explicabo possimus nemo non perferendis officiis quam molestias aliquid, doloremque, provident itaque quos fugiat sit totam temporibus repellendus vitae. Culpa, incidunt.</div>
			<div class="space20">Quos impedit aliquid nemo magnam ipsam corporis sint, distinctio mollitia sunt harum animi, inventore officia. Vitae similique eaque, consequatur voluptatibus, sunt velit adipisci explicabo maxime. Aperiam et totam ipsa molestias.</div>
			<div class="space20">Optio debitis, id nisi, dolorem, ab iure cumque vero modi eos quisquam unde soluta, blanditiis repellendus fugit delectus perspiciatis accusamus quidem animi voluptates. Eius magni voluptatibus exercitationem est, nostrum deleniti!</div>
		</div>
	</div>
</div>

<div class="row decide-row hide" >
	<div class="panel panel-white col-xs-8 col-xs-offset-2 ">
		<div class="panel-heading border-light ">
			<h4 class="panel-title"> <i class='fa fa-commentsfa-2x icon-big text-center '></i> DECIDE</h4>
		</div>
		<div class="panel-body">
			<h1></h1>

			<div class="space20">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, similique autem, neque provident hic placeat in magnam temporibus laborum, corporis tenetur cumque tempora sit cum dignissimos. Animi molestiae nostrum consequuntur.</div>
			<div class="space20">Iusto quis facilis officia ullam! Impedit corporis pariatur exercitationem, explicabo possimus nemo non perferendis officiis quam molestias aliquid, doloremque, provident itaque quos fugiat sit totam temporibus repellendus vitae. Culpa, incidunt.</div>
			<div class="space20">Quos impedit aliquid nemo magnam ipsam corporis sint, distinctio mollitia sunt harum animi, inventore officia. Vitae similique eaque, consequatur voluptatibus, sunt velit adipisci explicabo maxime. Aperiam et totam ipsa molestias.</div>
			<div class="space20">Optio debitis, id nisi, dolorem, ab iure cumque vero modi eos quisquam unde soluta, blanditiis repellendus fugit delectus perspiciatis accusamus quidem animi voluptates. Eius magni voluptatibus exercitationem est, nostrum deleniti!</div>
		</div>
	</div>
</div>


<div class="row act-row hide"  >
	<div class="panel panel-white col-xs-8 col-xs-offset-2 ">
		<div class="panel-heading border-light ">
			<h4 class="panel-title"> <i class='fa fa-commentsfa-2x icon-big text-center '></i> ACT</h4>
		</div>
		<div class="panel-body">
			<h1></h1>

			<div class="space20">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, similique autem, neque provident hic placeat in magnam temporibus laborum, corporis tenetur cumque tempora sit cum dignissimos. Animi molestiae nostrum consequuntur.</div>
			<div class="space20">Iusto quis facilis officia ullam! Impedit corporis pariatur exercitationem, explicabo possimus nemo non perferendis officiis quam molestias aliquid, doloremque, provident itaque quos fugiat sit totam temporibus repellendus vitae. Culpa, incidunt.</div>
			<div class="space20">Quos impedit aliquid nemo magnam ipsam corporis sint, distinctio mollitia sunt harum animi, inventore officia. Vitae similique eaque, consequatur voluptatibus, sunt velit adipisci explicabo maxime. Aperiam et totam ipsa molestias.</div>
			<div class="space20">Optio debitis, id nisi, dolorem, ab iure cumque vero modi eos quisquam unde soluta, blanditiis repellendus fugit delectus perspiciatis accusamus quidem animi voluptates. Eius magni voluptatibus exercitationem est, nostrum deleniti!</div>
		</div>
	</div>
</div>


<style type="text/css">
	.footerBtn{font-size: 2em; color:white; font-weight: bolder;}
</style>

<script type="text/javascript">
clickedVoteObject = null;

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
    	var message = "Vous êtes sûr ? Vous ne pourrez pas changer votre vote";
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
    	// bootbox.confirm("Vous êtes sûr ? Vous ne pourrez pas changer votre vote",
     //    	function(result) {
     //    		if (result) {
			  //     	params = { 
			  //          "userId" : '<?php echo Yii::app()->session["userId"]?>' , 
			  //          "id" : id ,
			  //          "collection":"surveys",
			  //          "action" : action 
			  //       };
			  //     	ajaxPost(null,'<?php echo Yii::app()->createUrl($this->module->id."/survey/addaction")?>',params,function(data){
			  //       	loadByHash(location.hash);
			  //     	});
			  //   } else {
			  //   	$("."+clickedVoteObject).removeClass("faa-bounce animated");
			  //   }
    	// });
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
</script>