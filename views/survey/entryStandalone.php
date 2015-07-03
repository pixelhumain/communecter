<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/okvideo/okvideo.min.js' , CClientScript::POS_END);

//Data helper
$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/okvideo/okvideo.min.js' , CClientScript::POS_END);

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

<div class="row">
	<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		<!-- start: LOGIN BOX -->
		<?php 
			$this->renderPartial('../person/menuTitle',array( "actionTitle" => "VOTE", 
														 	  "actionIcon"  => "download" ));
		?>
		
		<div class="box-login box radius-20">

			<span class="text-extra-large text-bold"> INVITATION TO VOTE </span> 
			<p> Invited by --- <?php //echo $parentOrganization['name'] ?> </p>
			
			
			<?php 
			$this->renderPartial('entry',array( "survey" => $survey, 
												"position" => "center",
												"showName" => true ));
			?>
		</div>
		<!-- end: LOGIN BOX -->
	</div>
</div>
<script type="text/javascript">

jQuery(document).ready(function() {

	$(".titleRed").html("VOTER");
	$(".titleWhite").html("");
	$(".titleWhite2").html("");
	$(".subTitle").html("C'est un bien commun.");

	$('.box-login').show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
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

</script>


