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
      <i class="fa fa-comment"></i> <span class="homestead"> Espace de discussion</span> 
      <div class="btn dropdown no-padding" style="padding-left:10px !important;">
        <a class="dropdown-toggle" type="button" data-toggle="dropdown" style="color:#8b91a0;">
          <i class="fa fa-cog"></i>  <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu">
          <?php if (ActionRoom::canAdministrate(Yii::app()->session["userId"], (string)$context["_id"])) {?>
          <li>
            <a href="javascript:;" class="actionRoomDelete" onclick="actionRoomDelete('<?php echo (string)$context["_id"] ?>', this)" data-id="<?php echo $parentId ?>"><small><i class="fa fa-times"></i> Supprimer</small></a>
          </li>
          <?php } ?>
          <li>
            <a href="javascript:;" class="actionRoomReport" onclick="actionRoomReportAbuse('<?php echo (string)$context["_id"] ?>', this)" data-id="<?php echo $parentId ?>"><small><i class="fa fa-flag"></i> Reporter au modérateur</small></a>
          </li>
        </ul>
      </div>
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
var contextId = '<?php echo (string)$context["_id"] ?>';
jQuery(document).ready(function() {
	
	<?php if($contextType == "actionRooms"){ ?>
  		setTitle("<?php echo Yii::t("rooms","Discussion", null, Yii::app()->controller->module->id); ?>","comments");
		$(".main-col-search").addClass("assemblyHeadSection");
  	<?php } ?>

});

//TODO SBAR : mutualize with newsReportAbuse
function actionRoomReportAbuse(id, $this) {
    var message = "<div id='reason' class='radio'>"+
      "<label><input type='radio' name='reason' value='Propos malveillants' checked>Propos malveillants</label><br>"+
      "<label><input type='radio' name='reason' value='Incitation et glorification des conduites agressives'>Incitation et glorification des conduites agressives</label><br>"+
      "<label><input type='radio' name='reason' value='Affichage de contenu gore et trash'>Affichage de contenu gore et trash</label><br>"+
      "<label><input type='radio' name='reason' value='Contenu pornographique'>Contenu pornographique</label><br>"+
        "<label><input type='radio' name='reason' value='Liens fallacieux ou frauduleux'>Liens fallacieux ou frauduleux</label><br>"+
        "<label><input type='radio' name='reason' value='Mention de source erronée'>Mention de source erronée</label><br>"+
        "<label><input type='radio' name='reason' value='Violations des droits auteur'>Violations des droits d\'auteur</label><br>"+
        "<input type='text' class='form-control' id='reasonComment' placeholder='Laisser un commentaire...'/><br>"+
      "</div>";
    var boxNews = bootbox.dialog({
      message: message,
      title: trad["askreasonreportabuse"],
      buttons: {
        annuler: {
          label: "Annuler",
          className: "btn-default",
          callback: function() {
            mylog.log("Annuler");
          }
        },
        danger: {
          label: "Déclarer cet abus",
          className: "btn-primary",
          callback: function() {
            // var reason = $('#reason').val();
            var reason = $("#reason input[type='radio']:checked").val();
            var reasonComment = $("#reasonComment").val();
            //actionOnNews($($this),action,method, reason, reasonComment);
            toastr.info("This feature is comming soon !");
            //$($this).children(".label").removeClass("text-dark").addClass("text-red");
          }
        },
      }
    });
    boxNews.on("shown.bs.modal", function() {
      $.unblockUI();
    });
}

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

function actionRoomDelete(id, $this){
  bootbox.confirm(trad["suretodeletediscuss"], 
    function(result) {
      if (result) {
        $.ajax({
              type: "POST",
              url: baseUrl+"/"+moduleId+"/rooms/deleteroom/id/"+id,
          dataType: "json",
              success: function(data){
                if (data.result) {               
                  toastr.success(data.msg);
                  showRoom('all', contextId);
                } else {
                  toastr.error(data.msg);
                }
            }
        });
      }
    }
  )
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