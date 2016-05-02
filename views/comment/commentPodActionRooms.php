<style type="text/css">


.assemblyHeadSection {  
  background-image:url(<?php echo $this->module->assetsUrl; ?>/images/Discussion.jpg); 
  /*background-image: url(/ph/assets/449afa38/images/city/cityDefaultHead_BW.jpg);*/
  background-color: #fff;
  background-repeat: no-repeat;
  background-position: 0px -40px;
  background-size: 100% auto;
}

h1.citizenAssembly-header{
background-color: rgba(255, 255, 255, 0.63);
padding: 30px;
padding-top: 0px;
margin-bottom: -3px;
font-size: 37px;
margin-top:90px;
}


#thumb-profil-parent{
	margin-top:-60px;
	margin-bottom:20px;
	-moz-box-shadow: 0px 3px 10px 1px #656565;
	-webkit-box-shadow: 0px 3px 10px 1px #656565;
	-o-box-shadow: 0px 3px 10px 1px #656565;
	box-shadow: 0px 3px 10px 1px #656565;
}

</style>

<?php if($contextType == "actionRooms"){ ?>

	<h1 class="homestead text-dark center citizenAssembly-header" style="font-size:27px;">
        <?php 
			$urlPhotoProfil = "";
			if(isset($parent['profilImageUrl']) && $parent['profilImageUrl'] != "")
		      $urlPhotoProfil = Yii::app()->createUrl($parent['profilImageUrl']);
		    else
		      $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
		
			$icon = "comments";	
		  	if($parentType == Project::COLLECTION) $icon = "lightbulb-o";
		  	if($parentType == Organization::COLLECTION) $icon = "group";
		  	if($parentType == Person::CONTROLLER) $icon = "user";
		?>
		<img class="img-circle" id="thumb-profil-parent" width="120" height="120" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
	    <br>
		<span style="padding:10px; border-radius:50px;">
			<i class="fa fa-<?php echo $icon; ?>"></i> 
			<?php echo $parent['name']; ?>
		</span>
   
    </h1>

<?php } ?>


<?php
	$this->renderPartial("commentPod", array("comments"=>$comments,
											 "communitySelectedComments"=>$communitySelectedComments,
											 "abusedComments"=>$abusedComments,
											 "options"=>$options,
											 "canComment"=>$canComment,
											 "contextType"=>$contextType,
											 //"parent"=>$parent,
											 "nbComment"=>$nbComment,
											 "context"=>$context));
?>

<script type="text/javascript">

jQuery(document).ready(function() {
	
  	<?php if($contextType == "actionRooms"){ ?>
  		$(".moduleLabel").html("<i class='fa fa-comments'></i> Espace de discussion");
		$(".main-col-search").addClass("assemblyHeadSection");
  	<?php } ?>
});

</script>