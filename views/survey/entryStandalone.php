<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/okvideo/okvideo.min.js' , CClientScript::POS_END);
//Data helper
$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);

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
  a.btn.voteAbstain{color: black;background-color: white;border: 1px solid white;}
  a.btn.voteDown{background-color: #db254e;border: 1px solid #db254e;}
</style>

<div class="pull-right" style="padding:20px;">
	<a href="#" onclick="showMenu()">
		<i class="menuBtn fa fa-bars fa-3x text-white "></i>
	</a>
</div>


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
	<span class="text-red " style="font-size:40px">VOTE </span>
	<span  style="font-size:40px" class=" "> DECIDE</span>
	<span  style="font-size:40px" class=" text-red "> ACT</span>

	<br/>
	<span  style="font-size:23px" class="text-white text-bold"> <?php if( $voteLinksAndInfos["hasVoted"] )
			echo "Thanks  for your vote"; 
		else
			echo "Feel Free to vote"; ?> | </span>
	<span  style="font-size:23px" class="text-white text-bold"> VOTERS : <?php  echo ( $voteLinksAndInfos["totalVote"] ) ? $voteLinksAndInfos["totalVote"] : "0";  ?> | </span>
	<span  style="font-size:23px" class="text-white text-bold"> Since : <?php echo date("m/d/Y",$survey["created"]) ?> | </span>
	<span  style="font-size:23px" class="text-white text-bold"> VISITORS : 15</span>
</div>
<?php 
//$this->renderPartial('../person/menuTitle',array("topTitleExists"=>true,"actionTitle"=>"CONTRIBUTE", "actionIcon"=>"fa-money"));
?>

<div class="row vote-row" >
	
	<div class="col-xs-12 col-sm-4 center">
		<!-- start: REGISTER BOX -->
		<div class="box-vote box-pod box">
			
			<span class="text-extra-large text-bold">PRESENTATION DU SUJET</span>
			<br/>
			<img src="https://unsplash.it/g/300">
			<br/>
			<?php echo $survey["message"]; ?>
		</div>
	</div>

	<div class=" col-xs-12 col-sm-4 " >
		
		<div class="box-vote box-pod box margin-10" style="padding-left:40px">

			<span class="text-extra-large text-bold">COMMENTS</span>

			<br/> xxxxxxxxxxxxxxxxxxxxxx
			<br/> xxxxxxxxxxxxxxxxxxxxxx
			<br/> xxxxxxxxxxxxxxxxxxxxxx
			<br/> xxxxxxxxxxxxxxxxxxxxxx
			<br/> xxxxxxxxxxxxxxxxxxxxxx
			<br/> xxxxxxxxxxxxxxxxxxxxxx
			<br/> xxxxxxxxxxxxxxxxxxxxxx
			<br/> xxxxxxxxxxxxxxxxxxxxxx
		</div>
	</div>

	<div class="col-xs-12 col-sm-4 center ">
		<?php 
			$this->renderPartial('../person/menuTitle',array( "topTitleExists"=>true,
															  "actionTitle" => "VOTE", 
														 	  "actionIcon"  => "download" ));
		?>
		<div class="box-vote box-pod box radius-20">
			<span class="text-extra-large text-bold"> INVITATION TO VOTE </span> 
			<p> Invited by --- <?php //echo $parentOrganization['name'] ?> </p>
			<?php 
			$this->renderPartial('entry',array( "survey" => $survey, 
												"position" => "center",
												"showName" => true ));
			?>
		</div>
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
<div class="visible-desktop hidden-phone visible-tablet" style="position:fixed; bottom:0px; left:0px;background-color: #E33551;width:100%;height:50px;">
	<div class="space10"></div>
	<div class="center">
		<a href="#" onclick="showMenu();showMenu ('vote-row','bgcity')" class=" footerBtn">VOTE . </a>
		<a href="#" onclick="showMenu();showMenu ('discuss-row')" class=" footerBtn">DISCUSS . </a> 
		<a href="#" onclick="showMenu();showMenu('decide-row','bgblue')" class=" footerBtn">DECIDE . </a>
		<a href="#" onclick="showMenu();showMenu('act-row','bggreen')" class=" footerBtn">ACT . </a> 
		<a href="#" onclick="showMenu();showMenu('contact-row')" class=" footerBtn">CONTACT </a> 
	</div>
	<div class="hide">
		<h5>Our Current Progress</h5>
		<div class="progress">
			<div class="progress-bar" style="width: 90%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar"> 60% </div>
		</div>
	</div>
</div>
<script type="text/javascript">

jQuery(document).ready(function() {

	//titleAnim ();

	$('.box-vote').show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
		$(this).removeClass("animated flipInX");
	});

});

function addaction(id,action){
    console.warn("--------------- addaction ---------------------");
    if(confirm("Vous êtes sûr ? Vous ne pourrez pas changer votre vote")){
      params = { 
           "userId" : '<?php echo Yii::app()->session["userId"]?>' , 
           "id" : id ,
           "collection":"surveys",
           "action" : action 
           };
      ajaxPost(null,'<?php echo Yii::app()->createUrl($this->module->id."/survey/addaction")?>',params,function(data){
        window.location.reload();
      });
    }
 }

	var activePanel = "vote-row";
	function showHidePanels (panel) {  
		$('.'+activePanel).slideUp();
		$('.'+panel).slideDown();
		activePanel = panel;
	}

</script>





