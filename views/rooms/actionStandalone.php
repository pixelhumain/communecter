<?php 
$cs = Yii::app()->getClientScript();
$cssAnsScriptFilesModule = array(
  '/js/dataHelpers.js',
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);


$logguedAndValid = Person::logguedAndValid();
$voteLinksAndInfos = Action::voteLinksAndInfos($logguedAndValid,$action);

if( Yii::app()->request->isAjaxRequest ){
	Menu::action( $action );
	$this->renderPartial('../default/panels/toolbar');
}
?>
<style type="text/css">

	.assemblyHeadSection {  
      background-image:url(<?php echo $this->module->assetsUrl; ?>/images/Discussion.jpg); 
    }
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


</style>


<!-- start: LOGIN BOX -->
<div class="center">
	
	<br/>
	
<?php 
	//ca sert a quoi ce doublon ?
	$parentType = $room["parentType"];
	$parentId = $room["parentId"];
	$nameParentTitle = "";
	if($parentType == Organization::COLLECTION && isset($parentId)){
		$orga = Organization::getById($parentId);
		$nameParentTitle = $orga["name"];
	}

?>
 	<div>
     
 		
		  
		 <?php 
		$extraBtn = ( Authorisation::canParticipate(Yii::app()->session['userId'],$parentSpace['parentType'],$parentSpace['parentId']) ) ? '<i class="fa fa-caret-right"></i> <a class="filter btn btn-xs btn-primary Helvetica" href="javascript:;" onclick="loadByHash(\'#rooms.editAction.room.'.$parentSpace["_id"].'\')"> <i class="fa fa-plus"></i> '.Yii::t( "survey", "Add an Action", null, Yii::app()->controller->module->id).'</a>' : '';
		 $this->renderPartial('../rooms/header',array(    
                "parent" => $parent, 
                            "parentId" => $parentSpace['parentId'], 
                            "parentType" => $parentSpace['parentType'], 
                            "fromView" => "rooms.actions",
                            "faTitle" => "cogs",
                            "colorTitle" => "azure",
                            "textTitle" => "<a class='text-dark btn' href='javascript:loadByHash(\"#rooms.index.type.".$room['parentType'].".id.".$room['parentId'].".tab.3\")'><i class='fa fa-cogs'></i> ".Yii::t("rooms","Actions", null, Yii::app()->controller->module->id)."</a>".
                            				" / ".
                            				"<a class='text-dark btn' href='javascript:loadByHash(\"#rooms.actions.id.".$parentSpace["_id"]."\")'><i class='fa fa-cogs'></i> ".$parentSpace["name"]."</a>".$extraBtn
	                            
	                            )); ?>


    </div>
 </div>

<div class="row vote-row contentProposal" >

	<div class="col-md-12">
		<!-- start: REGISTER BOX -->
		<div class="box-vote box-pod">
				
			<h4 class="col-md-12 text-center text-azure" style="font-weight:500; font-size:13px;"> 
				
				<?php if( @$action["startDate"]  ){ ?>
				<span class="pull-right"><?php echo Yii::t("rooms","Since",null,Yii::app()->controller->module->id) ?> <i class="fa fa-caret-right"></i> <?php echo date("d/m/y",$action["startDate"]) ?></span>
				<?php } ?> 
			 	<span class="pull-left"><i class="fa fa-caret-right"></i> <?php echo Yii::t("rooms","VISITORS",null,Yii::app()->controller->module->id) ?> : <?php echo (isset($action["viewCount"])) ? $action["viewCount"] : "0"  ?></span>
			 	<br/><span class="pull-left"><i class="fa fa-caret-right"></i> <?php /*echo Yii::t("rooms","Date Change Count",null,Yii::app()->controller->module->id) ?> : <?php echo (isset($action["viewCount"])) ? $action["viewCount"] : "0"  */?></span>
			 	
				<?php if( @$action["dateEnd"] ){ ?>
				<span class="pull-right"><?php echo Yii::t("rooms","Ends",null,Yii::app()->controller->module->id) ?> <i class="fa fa-caret-right"></i> <?php echo date("d/m/y",@$action["dateEnd"]) ?></span>
				<?php } ?>
				
			</h4>

			<div class="col-md-6 col-md-offset-3 center" style="margin-top: -40px; margin-bottom: 10px;">
				
					<div class="box-vote box-pod radius-20" style="margin-top:8px;">
						<?php
						//if no assignee , no startDate no end Date
				        $statusLbl = Yii::t("rooms", "Todo", null, Yii::app()->controller->module->id);
				        $statusColor = "";
				        //if startDate passed, or no startDate but has end Date
				        if( ( isset($action["startDate"]) && $action["startDate"] < time() )  || ( !@$action["startDate"] && @$action["dateEnd"] ) )
				        {
				          $statusLbl = Yii::t("rooms", "Progressing", null, Yii::app()->controller->module->id);
				          $statusColor = "bg-green";
				          if( @$action["dateEnd"] < time()  ){
				            $statusLbl = Yii::t("rooms", "Late", null, Yii::app()->controller->module->id);
				            $statusColor = "bg-red";
				          }
				        } 
				        if ( @$action["status"] == ActionRoom::ACTION_CLOSED  ) {
				          $statusLbl = Yii::t("rooms", "Closed", null, Yii::app()->controller->module->id);
				          $statusColor = "bg-red";
				        }
				        
						?>
						<span style="font-size: 20px; font-weight:300; padding:5px; border:1px solid #ccc; border-radius:10px;" class='text-bold <?php echo $statusColor?>'>
						<?php
				        echo $statusLbl;
						?>
						</span>
					</div>

			</div>	
			<div class="col-md-12 voteinfoSection">
				<div class="col-md-7" style="margin-top:10px;">
					<?php if( isset($organizer) ){ ?>
						<span class="text-red" style="font-size:13px; font-weight:500;"><i class="fa fa-caret-right"></i> <?php echo Yii::t("rooms","Made by ",null,Yii::app()->controller->module->id) ?> <a style="font-size:14px;" href="javascript:<?php echo @$organizer['link'] ?>" class="text-dark"><?php echo @$organizer['name'] ?></a></span><br/>
					<?php }	?>
					
					<span class="text-extra-large text-bold text-dark col-md-12" style="font-size:25px !important;"><i class="fa fa-file-text"></i> <?php echo  $action["name"] ?></span>
					<br/><br/>
					
					<?php echo $action["message"]; ?>
					
					<?php if( @$action["tags"] ){ ?>
						<span class="text-red" style="font-size:13px; font-weight:500;"><i class="fa fa-tags"></i>
						<?php foreach ( $action["tags"] as $value) {
								echo '<span class="badge badge-danger text-xss">#'.$value.'</span> ';
							}?>
						</span>
					<?php }	?>

					<?php if( @$action["urls"] )
					{ ?>
						<h3 class="text-dark text-left" style="border-top:1px solid #eee;font-weight:300;">
							<i class="fa fa-caret-down"></i> 
							<?php echo Yii::t("rooms", "Links and Info Bullet points", null, Yii::app()->controller->module->id)?>
						</h3>
						<?php foreach ( $action["urls"] as $value) {
							if( strpos($value, "http://")!==false || strpos($value, "https://")!==false )
								echo '<a href="'.$value.'" class="text-large"  target="_blank"><i class="fa fa-link"></i> '.$value.'</a><br/> ';
							else
								echo '<span class="text-large"><i class="fa fa-caret-right"></i> '.$value.'</span><br/> ';
						}
					}	?>
				</div>
				<div  class="col-md-5">
					<div class="col-md-12 leftInfoSection " >
						
						<?php 
							if( @$action["links"]["contributors"] )
							{	
								$this->renderPartial('../pod/usersList', array(  
															"project"=> $action,
															"users" => $contributors,
															"countStrongLinks" => $countStrongLinks, 
															"userCategory" => Yii::t("common","COMMUNITY"), 
															"contentType" => ActionRoom::COLLECTION_ACTIONS,
															"admin" => true	)); 
							}
						?>
						<?php if( Authorisation::canParticipate(Yii::app()->session['userId'],$room["parentType"],$room["parentId"]) && !@$action["links"]["contributors"][Yii::app()->session['userId']]  ){	?>
						<div class="space20"></div>
						<a href="javascript:;" class="pull-right text-large btn btn-dark-blue " onclick="assignMe('<?php echo (string)$action["_id"]?>');" ><i class="fa fa-link"></i> <?php echo Yii::t("rooms","Assign Me This Task",null,Yii::app()->controller->module->id) ?></a>
						<?php }	?>
					</div>
				</div>
			</div>
		</div>
	</div>
		
	<div class="col-md-12 commentSection leftInfoSection" >
		<div  class="space20"></div>
		<span class="" ><?php echo Yii::t("rooms","Add your point of view in the comments",null,Yii::app()->controller->module->id) ?></span>
		<div class="box-vote box-pod margin-10 commentPod"></div>
	</div>
	
</div>



<style type="text/css">
	.footerBtn{font-size: 2em; color:white; font-weight: bolder;}
</style>

<script type="text/javascript">
clickedVoteObject = null;

jQuery(document).ready(function() {
	
	$(".main-col-search").addClass("assemblyHeadSection");
  	$(".moduleLabel").html("<i class='fa fa-cogs'></i> Espace d'actions");
  
  	$('.box-vote').show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
		$(this).removeClass("animated flipInX");
	});

	getAjax(".commentPod",baseUrl+"/"+moduleId+"/comment/index/type/actions/id/<?php echo $action['_id'] ?>",
			function(){ $(".commentCount").html( $(".nbComments").html() ); },"html");
});

function closeAction(id)
{
    console.warn("--------------- closeEntry ---------------------");
    
      bootbox.confirm("Are you sure ? ",
          function(result) {
            if (result) {
              params = { "id" : id };
              ajaxPost(null,'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/rooms/closeaction")?>',params,function(data){
                if(data.result)
                  loadByHash(location.hash);
                else 
                  toastr.error(data.msg);
              });
          } 
      });
 }

function assignMe(id)
{
    bootbox.confirm("Are you sure ? ",
        function(result) {
            if (result) {
              params = { "id" : id };
              ajaxPost(null,'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/rooms/assignme")?>',params,function(data){
                if(data.result)
                  loadByHash(location.hash);
                else 
                  toastr.error(data.msg);
              });
        } 
    });
 }
</script>