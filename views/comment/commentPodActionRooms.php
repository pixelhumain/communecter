

<?php if($contextType == "actionRooms"){ ?>

	<h1 class="homestead text-dark center citizenAssembly-header" style="font-size:22px;">
         <i class="fa fa-comments"></i> Espace de discussion<br>        
    </h1>

<?php } ?>


<?php
	$this->renderPartial("commentPod", array("comments"=>$comments,
											 "communitySelectedComments"=>$communitySelectedComments,
											 "abusedComments"=>$abusedComments,
											 "options"=>$options,
											 "canComment"=>$canComment,
											 "contextType"=>$contextType,
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