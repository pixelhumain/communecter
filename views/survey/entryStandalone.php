<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($this->module->assetsUrl. '/survey/js/highcharts.js' , CClientScript::POS_END);
//Data helper
$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);
//$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets'.'/plugins/share-button/ShareButton.min.js' , CClientScript::POS_END);


$logguedAndValid = Person::logguedAndValid();
$voteLinksAndInfos = Action::voteLinksAndInfos($logguedAndValid,$survey);
?>
<style type="text/css">

	a.btn{margin:3px;}
	a:hover.btn {background-color: pink;border solid #666;}

	/*.infolink{border-top:1px solid #fff}*/
	.leftlinks a.btn{color:black;background-color: yellow;border: 1px solid yellow;}
	/*.rightlinks a.btn{background-color: beige;border: 1px solid beige;}*/
	a.btn.alertlink{background-color:red;color:white;border: 1px solid red;}
	a.btn.golink{background-color:green;color:white;border: 1px solid green;}
	a.btn.voteUp{background-color: #93C22C;border: 1px solid green;}
	a.btn.voteUnclear{background-color: yellow;border: 1px solid yellow;}
	a.btn.voteMoreInfo{background-color: #789289;border: 1px solid #789289;}
	a.btn.voteAbstain{color: black;background-color: white;border: 1px solid grey;}
	a.btn.voteDown{background-color: #db254e;border: 1px solid #db254e;}

	.commentPod .panel {box-shadow: none;}
	.commentPod .panel-heading {border-bottom-width: 0px;}

</style>

<?php /* ?>
<div class="pull-right" style="padding:20px;">
	<a href="#" onclick="showMenu()">
		<i class="menuBtn fa fa-bars fa-3x text-white "></i>
	</a>
</div>
*/?>


<!-- start: LOGIN BOX -->
<div class="padding-20 center">
	<?php /* ?>
	<span class="titleRed text-red homestead" style="font-size:40px">CO</span>
	<span  style="font-size:40px" class="titleWhite homestead">MMU</span>
	<span  style="font-size:40px" class="titleWhite2 text-red homestead">NECTER</span>
	<a href="#" class="text-white" onclick="showVideo('133636468')"><i class="fa fa-2x fa-youtube-play"></i></a>

	<br/>
	<span class="subTitle text-white text-bold" style="margin-top:-13px; font-size:1.5em">Se connecter à sa commune.</span>
	*/?>
	<br/>
	<span class="text-red " style="font-size:40px"><?php echo Yii::t("survey","VOTE",null,Yii::app()->controller->module->id) ?> </span>
	<span  style="font-size:40px" class=" "> <?php echo Yii::t("survey","DECIDE",null,Yii::app()->controller->module->id) ?> </span>
	<span  style="font-size:40px" class=" text-red "> <?php echo Yii::t("survey","ACT",null,Yii::app()->controller->module->id) ?></span>

	<br/>
	<span  style="font-size:23px" class="text-white text-bold"> <?php if( $voteLinksAndInfos["hasVoted"] )
			echo Yii::t("survey","YOU VOTED ALLREADY",null,Yii::app()->controller->module->id); 
		else
			echo Yii::t("survey","FEEL FREE TO VOTE",null,Yii::app()->controller->module->id); ?> </span>
	<br/>
	<span  style="font-size:23px" class="text-white text-bold"> <?php echo Yii::t("survey","VOTERS",null,Yii::app()->controller->module->id) ?> : <?php  echo ( @$voteLinksAndInfos["totalVote"] ) ? $voteLinksAndInfos["totalVote"] : "0";  ?> | </span>
	<span  style="font-size:23px" class="text-white text-bold"> <?php echo Yii::t("survey","Since",null,Yii::app()->controller->module->id) ?> : <?php echo date("m/d/y",$survey["created"]) ?> | </span>
	<?php if( @$survey["dateEnd"] ){ ?>
	<span  style="font-size:23px" class="text-white text-bold"> <?php echo Yii::t("survey","Ends",null,Yii::app()->controller->module->id) ?> : <?php echo date("d/m/y",@$survey["dateEnd"]) ?> | </span>
	<?php } ?>
	<span  style="font-size:23px" class="text-white text-bold"> <?php echo Yii::t("survey","VISITORS",null,Yii::app()->controller->module->id) ?> : <?php echo (isset($survey["viewCount"])) ? $survey["viewCount"] : "0"  ?></span>
</div>
<?php 
//$this->renderPartial('../person/menuTitle',array("topTitleExists"=>true,"actionTitle"=>"CONTRIBUTE", "actionIcon"=>"fa-money"));
?>

<div class="row vote-row" >
	
	<div class="col-md-12">
		<!-- start: REGISTER BOX -->
		<div class="box-vote box-pod box">
			<div class="col-md-4" >
				<div style="height: 300px">
					<?php 
						$canEdit = Authorisation::canEditEntry(Yii::app()->session["userId"], (string) $survey['_id']);
						$this->renderPartial('../pod/fileupload', array(  "itemId" => (string) $survey['_id'],
																		  "type" => Survey::COLLECTION,
																		  "resize" => false,
																		  "contentId" => Document::IMG_PROFIL,
																		  "show" => true,
																		  "editMode" => $canEdit )); 
					?>
				</div>
				<?php /* ?>
				<a class="btn btn-xs btn-default share-button" href="javascript:;"><i class='fa fa-share' ></i> Share </a>
				*/?>
			</div>
			<div class="col-md-8">
				<span class="text-extra-large text-bold"><?php echo  $survey["name"] ?></span>
				<br/><br/>
				<?php echo $survey["message"]; ?>
				<br/><br/>
			</div>
		</div>
	</div>

	<div class="col-md-8" >
		<div class="box-vote box-pod box margin-10 commentPod"></div>
	</div>

	<div class="col-md-4 center ">

		<?php /*
			$this->renderPartial('../person/menuTitle',array( "topTitleExists" => true,
															  "actionTitle"    => "VOTE", 
														 	  "actionIcon"     => "download" ));*/
		?>

<?php if( @$survey["dateEnd"] && $survey["dateEnd"] < time() ){ ?>
		
		<div class="box-vote box-pod box radius-20">
			<span class="text-extra-large text-bold"> 
				<?php echo Yii::t("survey","THIS VOTE IS CLOSED",null,Yii::app()->controller->module->id) ?>
			</span> 
			<?php if( isset($organizer) ){ ?>
				<p> Invited by <a href="<?php echo @$organizer['link'] ?>" target="_blank"><?php echo @$organizer['name'] ?></a> </p>
			<?php }	?>
			<div id="container2" style="min-width: 350px; height: 350px; margin: 0 auto"></div>

		</div>
	
<?php } else { ?> 

		<div class="box-vote box-pod box radius-20">
			<span class="text-extra-large text-bold"> 
					<?php echo Yii::t("survey","INVITATION TO VOTE",null,Yii::app()->controller->module->id) ?>
			</span> 
			<?php 
			if( isset($organizer) ){ ?>
				<p> Invited by <a href="<?php echo @$organizer['link'] ?>" target="_blank"><?php echo @$organizer['name'] ?></a> </p>
			<?php 
			}	
			$this->renderPartial('entry',array( "survey" => $survey, 
												"position" => "center",
												"showName" => true,
												"hideTexts" => true
												 ));?>
		</div>

<?php } ?>


	</div>	
</div>


<div class="row discuss-row" style="display:none" >
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
</div>

<div class="row decide-row" style="display:none" >
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


<div class="row act-row" style="display:none" >
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


<div class=" contact-row  " style="display:none" >
	<div class="col-xs-8 col-xs-offset-2">
			<div class="space20">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, similique autem, neque provident hic placeat in magnam temporibus laborum, corporis tenetur cumque tempora sit cum dignissimos. Animi molestiae nostrum consequuntur.</div>
			<div class="space20">Iusto quis facilis officia ullam! Impedit corporis pariatur exercitationem, explicabo possimus nemo non perferendis officiis quam molestias aliquid, doloremque, provident itaque quos fugiat sit totam temporibus repellendus vitae. Culpa, incidunt.</div>
			<div class="space20">Quos impedit aliquid nemo magnam ipsam corporis sint, distinctio mollitia sunt harum animi, inventore officia. Vitae similique eaque, consequatur voluptatibus, sunt velit adipisci explicabo maxime. Aperiam et totam ipsa molestias.</div>
			<div class="space20">Optio debitis, id nisi, dolorem, ab iure cumque vero modi eos quisquam unde soluta, blanditiis repellendus fugit delectus perspiciatis accusamus quidem animi voluptates. Eius magni voluptatibus exercitationem est, nostrum deleniti!</div>
	</div>
</div>



<style type="text/css">
	.footerBtn{font-size: 2em; color:white; font-weight: bolder;}
</style>

<script type="text/javascript">
clickedVoteObject = null;

//Images
var images = <?php echo json_encode($images) ?>;
var contentKeyBase = "<?php echo $contentKeyBase ?>";

jQuery(document).ready(function() {
	//var shareBtns = new ShareButton(".share-button");

	//titleAnim ();

	$('.box-vote').show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
		$(this).removeClass("animated flipInX");
	});
	$('.voteIcon').off().on("click",function() { 
		$(this).addClass("faa-bounce animated");
		clickedVoteObject = $(this).data("vote");
		console.log(clickedVoteObject);
	 })
	
	getAjax(".commentPod",baseUrl+"/"+moduleId+"/comment/index/type/surveys/id/<?php echo $survey['_id'] ?>",null,"html");

	buildResults ();

});

function addaction(id,action)
{
    console.warn("--------------- addaction ---------------------");
    if( checkLoggued( "<?php echo $_SERVER['REQUEST_URI']?>" ))
    {
    	bootbox.confirm("Vous êtes sûr ? Vous ne pourrez pas changer votre vote",
        	function(result) {
        		if (result) {
			      	params = { 
			           "userId" : '<?php echo Yii::app()->session["userId"]?>' , 
			           "id" : id ,
			           "collection":"surveys",
			           "action" : action 
			        };
			      	ajaxPost(null,'<?php echo Yii::app()->createUrl($this->module->id."/survey/addaction")?>',params,function(data){
			        	window.location.reload();
			      	});
			    } else {
			    	$("."+clickedVoteObject).removeClass("faa-bounce animated");
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
var getColor = {
	    'Pou': '#93C22C',
	    'Con': '#db254e',
	    'Abs': 'white', 
	    'Pac': 'yellow', 
	    'Plu': '#789289'
	};
function buildResults () { 

	<?php if( @$survey["dateEnd"] && $survey["dateEnd"] < time()){ ?>
		console.log("buildResults");
	
		console.log("setUpGraph");
		$('#container2').highcharts({
		    chart: {
		        plotBackgroundColor: null,
		        plotBorderWidth: null,
		        plotShadow: false
		    },
		    title: {
		        text: "Results"
		    },
		    tooltip: {
		      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		    },
		    plotOptions: {
		        pie: {
		            allowPointSelect: true,
		            cursor: 'pointer',
		            dataLabels: {
		                enabled: true,
		                color: '#000000',
		                connectorColor: '#000000',
		                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
		            }
		        }
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
	<?php } ?>
}
</script>