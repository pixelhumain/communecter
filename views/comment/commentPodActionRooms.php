<?php if($contextType == "actionRooms"){ ?>

<style type="text/css">

#commentHistory .panel-heading{
	min-height:185px !important;
}
.footer-comments{
  margin-top: 15px !important;
  /*float:left;*/
  padding: 30px;
}
.ctnr-txtarea {
    position: absolute;
    right: 30px;
    left: 70px !important;
}
</style>
<?php } ?>


<?php if($contextType == "actionRooms" && !isset($_GET["renderPartial"])){ 
   	$this->renderPartial('../rooms/header',array(    
		   					            "parent" => $parent, 
                            "parentId" => $parentId, 
                            "parentType" => $parentType, 
                            "fromView" => "comment.index",
                            "faTitle" => "comments",
                            "colorTitle" => "azure",
                            "textTitle" => "<a class='text-dark btn' href='javascript:loadByHash(\"#rooms.index.type.$parentType.id.$parentId.tab.1\")'><i class='fa fa-comments'></i> ".Yii::t("rooms","Discuss", null, Yii::app()->controller->module->id)."</a>"
                            )); 
    echo '<div class="col-md-12 panel-white padding-15 discussContainer" id="room-container">';
  }
?>
<?php if($contextType == "actionRooms"){ ?>
    <h1 class="text-dark" style="font-size: 25px;margin-top: 20px;">
      <i class="fa fa-angle-down"></i> <i class="fa fa-comment"></i> <span class="homestead"> Espace de discussion</span> 
      <?php //echo $context["name"]; ?>
    </h1> 
<?php } ?>


<?php if($contextType == "actionRooms"){
  Menu::comments( $parentType, $parentId );
  $this->renderPartial('../default/panels/toolbar');
}
?>

<?php
	//$canComment = (isset($parentId) && isset($parentType) && isset(Yii::app()->session["userId"])
	//		&& Authorisation::canParticipate(Yii::app()->session["userId"], $parentType, $parentId));
	$this->renderPartial("../comment/commentPodSimple", array("comments"=>$comments,
											 "communitySelectedComments"=>$communitySelectedComments,
											 "abusedComments"=>$abusedComments,
											 "options"=>$options,
											 "canComment"=>$canComment,
                       "idComment"=>$idComment,
                       "parentType"=>$parentType,
											 "parentId" => $parentId, 
											 "contextType"=>$contextType,
											 "nbComment"=>$nbComment,
											 "canComment" => $canComment,
											 "context"=>$context,
											 "images"=>$images));

  if($contextType == "actionRooms" && !isset($_GET["renderPartial"]))
    echo "</div>";
?>



<script type="text/javascript">
var images = <?php echo json_encode($images) ?>;
var latestComments = <?php echo time(); ?>;
jQuery(document).ready(function() {
	
	<?php if($contextType == "actionRooms"){ ?>
  		setTitle("<?php echo Yii::t("rooms","Discussion", null, Yii::app()->controller->module->id); ?>","comments");
		$(".main-col-search").addClass("assemblyHeadSection");
  	<?php } ?>

});

function checkCommentCount(){ 
		mylog.log("check if new comments exist since",latestComments);
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
          	mylog.log("you have new comments", data.count);
          	$(".refreshComments").removeClass('hidden').html("<i class='fa fa-refresh fa-spin'></i> <?php echo Yii::t( "comment", 'New Comment(s) Click to Refresh', Yii::app()->controller->module->id)?> ");
            latestComments = data.time;
          } else {
          	mylog.log("nothing new");
          }
          if(userId){
	        //checkCommentCount();
	    	}
        }
    });
}

function archive(collection,id){
  mylog.warn("--------------- archive ---------------------",collection,id);
    
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