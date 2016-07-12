<?php if($contextType == "actionRooms"){ ?>

<style type="text/css">

#commentHistory .panel-heading{
	/*padding:15px !important;*/
}
</style>

<?php 
	Menu::comments( $parentType, $parentId, $context);
	$this->renderPartial('../default/panels/toolbar');

}

?>



<?php if($contextType == "actionRooms"){ ?>
   		 <?php $this->renderPartial('../rooms/header',array(    
                            "archived"=> (@$context["status"] == ActionRoom::STATE_ARCHIVED) , 
            		   					"parent" => $parent, 
                            "parentId" => $parentId, 
                            "parentType" => $parentType, 
                            "fromView" => "comment.index",
                            "faTitle" => "comments",
                            "colorTitle" => "azure",
                            "textTitle" => "<a class='text-dark btn' href='javascript:loadByHash(\"#rooms.index.type.$parentType.id.$parentId.tab.1\")'><i class='fa fa-comments'></i> ".Yii::t("rooms","Discuss", null, Yii::app()->controller->module->id)."</a>"
                            )); ?>
<?php } ?>


<?php
	//$canComment = (isset($parentId) && isset($parentType) && isset(Yii::app()->session["userId"])
	//		&& Authorisation::canParticipate(Yii::app()->session["userId"], $parentType, $parentId));
	$this->renderPartial("../comment/commentPod", array("comments"=>$comments,
											 "communitySelectedComments"=>$communitySelectedComments,
											 "abusedComments"=>$abusedComments,
											 "options"=>$options,
											 "canComment"=>$canComment,
											 "parentType"=>$parentType,
											 "contextType"=>$contextType,
											 "nbComment"=>$nbComment,
											 "canComment" => $canComment,
											 "context"=>$context,
											 "images"=>$images));
?>

<script type="text/javascript">
var images = <?php echo json_encode($images) ?>;
var latestComments = <?php echo time(); ?>;
jQuery(document).ready(function() {
	
	<?php if($contextType == "actionRooms"){ ?>
  		$(".moduleLabel").html("<i class='fa fa-comments'></i> <?php echo Yii::t("rooms","Discussion", null, Yii::app()->controller->module->id); ?>");
		$(".main-col-search").addClass("assemblyHeadSection");
  	<?php } ?>

});

function checkCommentCount(){ 
		console.log("check if new comments exist since",latestComments);
		//show refresh button
		$.ajax({
        type: "POST",
        url: baseUrl+'/'+moduleId+"/comment/countcommentsfrom",
        data: {
        	"from" : latestComments,
        	"type" : contextType,
        	"id" : "<?php echo (string)$context["_id"]; ?>"
        },
        dataType: "json",
        success: function(data){
          if(data.count>0){
          	console.log("you have new comments", data.count);
          	
          	$(".refreshComments").removeClass('hide')
          	$(".refreshComments").html("<i class='fa fa-refresh'></i> "+data.count+" <?php echo Yii::t( "comment", 'New Comment(s) Click to Refresh', Yii::app()->controller->module->id)?> ");
          } else {
          	console.log("nothing new");
          }
          if(userId){
	        //checkCommentCount();
	    	}
        }
    });
}

function archive(collection,id){
  console.warn("--------------- archive ---------------------",collection,id);
    
  bootbox.confirm("Vous êtes sûr ? ",
      function(result) {
        if (result) {
          params = { 
             "id" : id ,
             "type":collection,
             "name":"status",
             "value":"<?php echo ( @$context["status"] != ActionRoom::STATE_ARCHIVED ) ? ActionRoom::STATE_ARCHIVED : "" ?>",
          };
          ajaxPost(null,'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/element/updatefield")?>',params,function(data){
            loadByHash(window.location.hash);
          });
      } else {
        $("."+clickedVoteObject).removeClass("faa-bounce animated");
      }
  });
}
</script>