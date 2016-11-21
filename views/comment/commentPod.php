<?php

$cssAnsScriptFiles = array(
	"/plugins/ScrollToFixed/jquery-scrolltofixed-min.js",
	'/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
	'/plugins/jquery-shorten/jquery.shorten.1.0.js',
	'/plugins/perfect-scrollbar/src/perfect-scrollbar.css',
	'/plugins/perfect-scrollbar/src/perfect-scrollbar.js',
	'/plugins/perfect-scrollbar/src/jquery.mousewheel.js',
	'/plugins/x-editable/js/bootstrap-editable.js' , 
	/*'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , 
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , 
	'/plugins/wysihtml5/wysihtml5.js'*/
	'/plugins/x-editable/js/bootstrap-editable.js' , 

);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles, Yii::app()->request->baseUrl);
?>	

<style>
.tree .comment .avatar {
    clear: left;
    float: left;
    margin: 0 10px 5px 0;
}

.commenter-location, .comment-time, .comment-options {
    font-size: 0.95rem;
    font-weight: 300;
    line-height: 0.8125rem;
}

.commentContent-deleted {
	opacity: 0.5;
}

.commentText-deleted {
	color : rgba(229,51,76,1);
	opacity: 1;
}
#commentHistory .panel-heading{
	/*min-height:50px;*/
}
#commentHistory .panel-scroll{
	/*overflow-y: hsidden;*/
}

<?php if($contextType != "actionRooms"){ ?>
.blockUI.blockMsg.blockPage{
	width:72% !important;
	top: 8% !important;
	left: 18% !important;
}

@media screen and (max-width: 767px) {
	.ps-container-com{
		max-height: 250px !important;
	}
}
@media screen and (min-width: 768px) and (max-width: 1024px) {
	.ps-container-com{
		max-height: 370px !important;
	}
}
@media screen and (min-width: 1025px) {
	.ps-container-com{
		max-height: 420px !important;
	}
}
<?php } ?>

.commentContent{
	padding:10px;
}
.text-comment{
	white-space: pre-line;
}
</style>

<?php 
$optionsLabels = array(
	Comment::COMMENT_ON_TREE => array(
		true => array("title" => "You can reply to a comment", "label" => "Can Reply"),
		false => array("title" => "You can not reply to a comment", "label" => "Can't Reply")
	),
	Comment::COMMENT_ANONYMOUS => array(
		true => array("title" => "The discussion is anonymous", "label" => "Anonymous"),
		false => array("title" => "Your name and avatar will be displayed when you comment", "label" => "Nominatively")
	),
	Comment::ONE_COMMENT_ONLY => array(
		true => array("title" => "You can only reply once", "label" => "Only one comment"),
		false => array("title" => "No limit on comments", "label" => "No limit comments")
	)
);

$canComment = $canComment && isset(Yii::app()->session["user"]);
?>
<!-- start: PAGE CONTENT -->


<div id="commentHistory" class="no-padding pull-left col-md-12">
	<div class="panel panel-white">
		<div class="panel-body border-light">

			<?php if($contextType == "actionRooms"){ ?>
				<?php
					if($contextType == "actionRooms" && $context["type"] == ActionRoom::TYPE_DISCUSS){
						echo "<div class='col-md-4'>";
						$this->renderPartial('../pod/fileupload', array("itemId" => (string)$context["_id"],
							  "type" => ActionRoom::COLLECTION,
							  "resize" => false,
							  "contentId" => Document::IMG_PROFIL,
							  "editMode" => $canComment,
							  "image" => $images,
							   "parentType" => $parentType,
							   "parentId" => $parentId, 
)); 
						}
						echo "</div>";
				
				  	$icon = (@$context["status"] == ActionRoom::STATE_ARCHIVED) ? "download" : "comments";
	              	$archived = (@$context["status"] == ActionRoom::STATE_ARCHIVED) ? "<span class='text-small helvetica'>(ARCHIVED)</span>" : "";
	              	$color = (@$context["status"] == ActionRoom::STATE_ARCHIVED) ? "text-red " : "text-dark";
                ?>
                <div class='col-md-8'>
					<h1 class=" <?php echo $color;?>" style="color:rgba(0, 0, 0, 0.8); font-size:27px;">
				      <i class="fa fa-<?php echo $icon;?>"></i> "<?php echo $context["name"].$archived; ?>"
				  	</h1>

			<?php }else{ ?>
				<div class='col-md-12'>
			<?php } ?>

			<?php $currentUser = Yii::app()->session["user"]; ?>
			<?php if (@$currentUser && Role::isDeveloper($currentUser['roles'])){ ?>
				<div class="options pull-right">
					<?php foreach ($options as $optionKey => $optionValue) {
						$currentLabel = $optionsLabels[$optionKey][$optionValue];
						echo '<span class="comment-options" title="'.$currentLabel["title"].'">'.$currentLabel["label"].' | </span>';
					}?>
				</div>
			<?php } ?>
			<h4 class="panel-title text-dark" style="font-weight: 300;"><i class="fa fa-comments"></i> 
				<span class="nbComments"><?php echo ' '.$nbComment; ?></span> <?php echo Yii::t("comment","Comments") ?>
			</h4>
			</div>
		</div>
		  
		<div class="panel-body panel-white">
			<div class='row'>
				<div class="tabbable no-margin no-padding partition-dark">
					<ul class="nav nav-tabs">
						<li role="presentation" class="active">
							<!-- start: TIMELINE PANEL -->
							<a href="#entry_comments" data-toggle="tab">
								<i class="fa fa-comments"></i> 
								<span class="hidden-sm">
									<?php echo Yii::t("comment","Comments") ?> <span class="badge bg-azure nbComments"><?php echo $nbComment ?></span>
								</span>
							</a>
							<!-- end: TIMELINE PANEL -->
						</li>
						<li role="presentation">
							<a href="#entry_community_comments" data-toggle="tab">
								<i class="fa fa-thumbs-up"></i> 
								<span class="hidden-sm">
									<?php echo Yii::t("comment","Popular") ?> <span class="badge badge-green"><?php echo count($communitySelectedComments) ?></span>
								</span>
							</a>
						</li>
					<?php if ( ($context["type"] == ActionRoom::TYPE_VOTE && (Authorisation::canEditItem(Yii::app()->session["userId"], Survey::COLLECTION, (String) $context["_id"]))) 
								//|| ($context["type"] == ActionRoom::TYPE_ACTIONS && (Authorisation::canEditAction(Yii::app()->session["userId"], (String) $context["_id"])))  
								) { ?>
						<li role="presentation">
							<a href="#entry_abuse" data-toggle="tab">
								<i class="fa fa-flag"></i> 
								<span class="hidden-sm">
									<?php echo Yii::t("comment","Abuse") ?> <span class="badge badge-red nbCommentsAbused"><?php echo count($abusedComments) ?></span>
								</span>
							</a>
						</li>
					<?php } ?>
					</ul>
					<div class="tab-content partition-white">
						<div class="tab-pane active no-padding" id="entry_comments" >
							<div class="panel-scroll ps-container-com commentTable" style="padding-top: 5px; height:auto ">
							<?php if ($canComment) {?>
								<div class='saySomething padding-5'>
									<input type="text" style="width:100%" value="<?php echo Yii::t("comment","Say Something") ?>"/>
								</div>
							<?php }else if(!isset(Yii::app()->session["user"]) ){ ?>
								<h4 class="text-dark padding-10 no-margin"><i class="fa fa-lock"></i> Connectez-vous pour participer à cette conversation</h4>
							<?php }else if($parentType == Project::COLLECTION ){ ?>
								<h4 class="text-dark padding-10 no-margin"><i class="fa fa-lock"></i> Devenez contributeur du projet pour participer à cette conversation</h4>
							<?php }else if($parentType == Organization::COLLECTION ){ ?>
								<h4 class="text-dark padding-10 no-margin"><i class="fa fa-lock"></i> Devenez membre de l'organisation pour participer à cette conversation</h4>
							<?php } ?>
							</div>
						</div>
						<div class="tab-pane no-padding" id="entry_community_comments">
							<div class="panel-scroll ps-container-com communityCommentTable" style="padding-top: 5px; height:auto ">
							</div>
						</div>
						<div class="tab-pane no-padding" id="entry_abuse">
							<div class="panel-scroll ps-container-com abuseCommentTable" style="padding-top: 5px; height:auto ">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<style type="text/css">
	ul li.comment {border-left : 5px solid #ccc; margin-bottom: 5px;padding-left: 5px;} 
	.commentContent-posted {margin-left:10px};
</style>
<!-- end: PAGE CONTENT-->
<script type="text/javascript">

//Comments
var comments = <?php echo json_encode($comments); ?>;
var commentsSelected = <?php echo json_encode($communitySelectedComments); ?>;
var abusedComments = <?php echo json_encode($abusedComments); ?>;

var context = <?php echo json_encode($context)?>;
var contextType = <?php echo json_encode($contextType)?>;
var currentUser = <?php echo json_encode(Yii::app()->session["user"])?>;
var options = <?php echo json_encode($options)?>;
var canUserComment = <?php echo json_encode($canComment)?>;
var commentIdOnTop;
var selection;
var modeComment = "view";
//var canParticipate = <?php //echo ( $canParticipate ) ? "true" : "false"; ?>;

jQuery(document).ready(function() {
	//setTitle("","");$(".moduleLabel").html("<i class='fa fa-comments'></i> Espace de discussion");
  	
	buildCommentsTree('.commentTable', comments, "all");
	buildCommentsTree('.communityCommentTable', commentsSelected, "all");
	buildCommentsTree('.abuseCommentTable', abusedComments, "abuse");
	bindEvent();
	$('.ps-container').perfectScrollbar({suppressScrollX : true});

	

	/*!
	  Non-Sucking Autogrow 1.1.1
	  license: MIT
	  author: Roman Pushkin
	  https://github.com/ro31337/jquery.ns-autogrow
	*/
	(function(){var e;!function(t,l){return t.fn.autogrow=function(i){return null==i&&(i={}),null==i.horizontal&&(i.horizontal=!0),null==i.vertical&&(i.vertical=!0),null==i.debugx&&(i.debugx=-1e4),null==i.debugy&&(i.debugy=-1e4),null==i.debugcolor&&(i.debugcolor="yellow"),null==i.flickering&&(i.flickering=!0),null==i.postGrowCallback&&(i.postGrowCallback=function(){}),null==i.verticalScrollbarWidth&&(i.verticalScrollbarWidth=e()),i.horizontal!==!1||i.vertical!==!1?this.filter("textarea").each(function(){var e,n,r,o,a,c,d;return e=t(this),e.data("autogrow-enabled")?void 0:(e.data("autogrow-enabled"),a=e.height(),c=e.width(),o=1*e.css("lineHeight")||0,e.hasVerticalScrollBar=function(){return e[0].clientHeight<e[0].scrollHeight},n=t('<div class="autogrow-shadow"></div>').css({position:"absolute",display:"inline-block","background-color":i.debugcolor,top:i.debugy,left:i.debugx,"max-width":e.css("max-width"),padding:e.css("padding"),fontSize:e.css("fontSize"),fontFamily:e.css("fontFamily"),fontWeight:e.css("fontWeight"),lineHeight:e.css("lineHeight"),resize:"none","word-wrap":"break-word"}).appendTo(document.body),i.horizontal===!1?n.css({width:e.width()}):(r=e.css("font-size"),n.css("padding-right","+="+r),n.normalPaddingRight=n.css("padding-right")),d=function(t){return function(l){var r,d,s;return d=t.value.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n /g,"<br/>&nbsp;").replace(/"/g,"&quot;").replace(/'/g,"&#39;").replace(/\n$/,"<br/>&nbsp;").replace(/\n/g,"<br/>").replace(/ {2,}/g,function(e){return Array(e.length-1).join("&nbsp;")+" "}),/(\n|\r)/.test(t.value)&&(d+="<br />",i.flickering===!1&&(d+="<br />")),n.html(d),i.vertical===!0&&(r=Math.max(n.height()+o,a),e.height(r)),i.horizontal===!0&&(n.css("padding-right",n.normalPaddingRight),i.vertical===!1&&e.hasVerticalScrollBar()&&n.css("padding-right","+="+i.verticalScrollbarWidth+"px"),s=Math.max(n.outerWidth(),c),e.width(s)),i.postGrowCallback(e)}}(this),e.change(d).keyup(d).keydown(d),t(l).resize(d),d())}):void 0}}(window.jQuery,window),e=function(){var e,t,l,i;return e=document.createElement("p"),e.style.width="100%",e.style.height="200px",t=document.createElement("div"),t.style.position="absolute",t.style.top="0px",t.style.left="0px",t.style.visibility="hidden",t.style.width="200px",t.style.height="150px",t.style.overflow="hidden",t.appendChild(e),document.body.appendChild(t),l=e.offsetWidth,t.style.overflow="scroll",i=e.offsetWidth,l===i&&(i=t.clientWidth),document.body.removeChild(t),l-i}}).call(this);
});

function buildCommentsTree(where, commentsList, withActions) {
	$(".commentsTL").html('<div class="spine"></div>');
	
	countEntries = 0;
	$(where).append(buildComments(commentsList, 0, withActions,where));
	if(where != ".communityCommentTable")
		initCommentUpdate(commentsList);
}

function initCommentUpdate(comment){
	$.each( comment , function(key,o) {
		if (o.replies.length != 0){
				initCommentUpdate(o.replies);
		}
		initXEditable();
		manageCommentModeContext(key);
	});
}
function addEmptyCommentOnTop() {
	var newCommentLine = buildNewCommentLine("");	
	//create a new reply line on the root
	var ulRoot = $('#entry_comments .tree');
	ulRoot.prepend(newCommentLine);
	$(".newComment").focus().autogrow({vertical: true, horizontal: false});
}

function buildComments(commentsLevel, level, withActions,where) {
	if (level == 0) {
		var commentsHTML = '<ul class="tree list-unstyled padding-5">';
	} else {
		var commentsHTML = '<ul class="level list-unstyled" style="padding-left: 15px">';	
	}
	mylog.log(commentsLevel);
	$.each( commentsLevel , function(key,commentObj) {
		if(commentObj.text && commentObj.created) {
			var date = new Date( parseInt(commentObj.created)*1000 );
			var commentActions = withActions;
			//Manage deleted comments
			if (commentObj.status == "deleted") {
				commentActions = "disabled";
			}
			var commentsTLLine = buildCommentLineHTML(commentObj, commentActions,where);
			
			commentsHTML += commentsTLLine;
			
			if (commentObj.replies.length != 0) {
				nextLevel = level + 1;
				var commentsTLLineDown = buildComments(commentObj.replies, nextLevel, withActions,where);
				commentsHTML += commentsTLLineDown;
			} else {
				commentsHTML += "</li>";
			}
		}
	});
	commentsHTML += "</ul>";
	return commentsHTML;
}

function buildCommentLineHTML(commentObj, withActions,where) {
//	mylog.log(commentObj);
	var id = commentObj["_id"]["$id"];
	moment.locale('fr');
	var date = moment(commentObj.created * 1000);
	var dateStr = date.fromNow();
	
	var iconStr = getProfilImageUrl(commentObj.author.profilThumbImageUrl);
	var objectLink = (commentObj.object) ? ' <a '+url+'>'+iconStr+'</a>' : iconStr;

	var color = "white";
	var icon = "fa-user";
	
	var name = commentObj.author.name;
	if(commentObj.author.address != "undefined")
		var city = commentObj.author.address.addressLocality;
	if(where != ".communityCommentTable")
		text = '<a href="javascript:" id="commentText'+id+'" data-type="textarea" data-pk="'+id+'" data-emptytext="Vide" class="editable-comment editable-pre-wrapped editable">'+commentObj.text+'</a>';
	else
		text = commentObj.text;
	var tags = "";
	if( "undefined" != typeof commentObj.tags && commentObj.tags) {
		$.each( commentObj.tags , function(i,tag){
			tags += "<span class='label label-inverse'>"+tag+"</span> ";
		});
		tags = '<div class="pull-right"><i class="fa fa-tags"></i> '+tags+'</div>';
	}
	
	var personName = "Unknown";
	//var dateString = date.toLocaleString();
	var commentsTLLine;
	manageComment="";
	if (typeof(userId) != "undefined" && commentObj.author.id == userId){
		manageComment='<a href="javascript:;" onclick="deleteComment(\''+id+'\',$(this))"><span class="comment-delete pull-right text-red" style="padding-left:10px;"><i class="fa fa-trash-o"></i> <?php echo Yii::t("common","Delete") ?></span></a>'+
		'<a href="javascript:;" onclick="modifyComment(\''+id+'\')"><span class="comment-modify pull-right"><i class="fa fa-pencil"></i> <?php echo Yii::t("common","Modify") ?></span></a>';
	} 
	commentsTLLine = '<hr style="border-width: 2px; margin-bottom: 10px; margin-top: 10px">'+
					'<li id="comment'+id+'" class="comment">'+
						'<div class="commentContent-'+commentObj.status+'">'+
							//tags+
							objectLink+
							'<div class="commentline_title">'+
								'<span class="text-bold light-text no-margin">'+name+'</span>'+
								'<span class="commenter-location padding-5">'+city+'</span>'+
								'<span class="comment-time"><i class="fa fa-clock-o"></i> '+dateStr+'</span>'+
								manageComment+
							'</div>'+
							'<div class="commentText-'+commentObj.status+'" style="float:left;width:75%;">'+
									text+
							'</div>'+
							'<div class="space10"></div>'+
							"<div class='bar_tools_post hide'>";
	
	if (withActions == "all") {
		commentsTLLine += commentActions(commentObj);
	} else if (withActions == "abuse") {
		commentsTLLine += commentAbuseActions(commentObj);
	} else if (withActions = "disabled") {
		commentsTLLine += commentDisabledActions(commentObj);
	}

	commentsTLLine += "</div> </div>";

	return commentsTLLine;
}

function commentActions(commentObj) {
	var res = "";
	//Reply button
	if (options.tree == true) {
		res += "<a href='javascript:;' class='commentReply' data-id='"+commentObj._id['$id']+"'><span class='label label-info'><i class='fa fa-reply'></i></span></a> "
	};
	mylog.log(commentObj);
	//Other action button
	var actionDone = "";
	var classVoteUp = "commentVoteUp";
	var colorVoteUp = "label-green";
	var classVoteDown = "commentVoteDown";
	var colorVoteDown = "label-orange";
	var classReportAbuse = "commentReportAbuse";
	var colorReportAbuse = "label-red";

	var voteUpCount = parseInt(commentObj.voteUpCount) || 0;
	var voteDownCount = parseInt(commentObj.voteDownCount) || 0;
	var reportAbuseCount = parseInt(commentObj.reportAbuseCount) || 0;

	if (voteUpCount > 0 && "undefined" != typeof(commentObj.voteUp[userId])) {
 		actionDone = "commentVoteUp";
 		colorVoteDown = colorReportAbuse = "label-inverse";
	}
	
	if (voteDownCount > 0 && "undefined" != typeof(commentObj.voteDown[userId])) {
 		actionDone = "commentVoteDown";
 		colorVoteUp = colorReportAbuse = "label-inverse";
	}

	if (reportAbuseCount > 0 && "undefined" != typeof commentObj.reportAbuse[userId]) {
 		actionDone = "commentReportAbuse";
 		colorVoteDown = colorVoteUp = "label-inverse";
	}

	/*if (actionDone != "") {
		classVoteUp = actionDone;
		classVoteDown = actionDone;
		classReportAbuse = actionDone;
	}*/

	var titleVoteUp = "<?php echo addslashes(Yii::t('comment','Agree with that'))?>";
	var titleVoteDown = "<?php echo addslashes(Yii::t('comment','Disagree with that'))?>";
	var titleReportAbuse = "<?php echo addslashes(Yii::t('comment','Report an abuse'))?>";

	// mylog.log(commentObj.contextId);
	res += "<a href='javascript:;' title='"+titleVoteUp+"' class='"+classVoteUp+"' data-count='"+voteUpCount+"' data-id='"+commentObj._id['$id']+"'><span class='label "+colorVoteUp+"'>"+voteUpCount+" <i class='fa fa-thumbs-up'></i></span></a> "+
		  "<a href='javascript:;' title='"+titleVoteDown+"' class='"+classVoteDown+"' data-count='"+voteDownCount+"' data-id='"+commentObj._id['$id']+"'><span class='label "+colorVoteDown+"'>"+voteDownCount+" <i class='fa fa-thumbs-down'></i></span></a> "+
		  "<a href='javascript:;' title='"+titleReportAbuse+"' class='"+classReportAbuse+"' data-count='"+reportAbuseCount+"' data-id='"+commentObj._id['$id']+"' data-contextid='"+commentObj.contextId+"'><span class='label "+colorReportAbuse+"'>"+reportAbuseCount+" <i class='fa fa-flag'></i></span></a> ";
	return res;
}

function commentAbuseActions(commentObj) {
	var res = "";
	
	res += "<a href='javascript:;' title='Abuse history' class='abuseHistory' data-id='"+commentObj._id['$id']+"'><span class='label label-info'><i class='fa fa-history'></i></span></a> "+
			"<a href='javascript:;' title='Remove the comment' class='deleteComment' data-id='"+commentObj._id['$id']+"'><span class='label label-red'><i class='fa fa-trash-o'></i></span></a> "+
			"<a href='javascript:;' title='Ignore abuse' class='ignoreAbuse' data-id='"+commentObj._id['$id']+"'><span class='label label-green'><i class='fa fa-check'></i></span></a> ";
	return res;
}

function commentDisabledActions(commentObj) {
	return "";
}

function bindEvent(){
	var separator;
	var anchor;
	$('.commentline-scrubber').scrollToFixed({
		marginTop: $('header').outerHeight() + 100
	}).find("a").on("click", function(e){			
		anchor = $(this).data("separator");
		$("body").scrollTo(anchor, 300);
		e.preventDefault();
	});
	
	//New comment actions
	$('.saySomething').off().on("focusin",function(){
		// mylog.log(backUrl);
		if (checkIsLoggued("<?php echo Yii::app()->session['userId']?>")) {
			$('.saySomething').hide();
			addEmptyCommentOnTop();
			bindEvent();
			activateSummernote('.newComment');
		}
	});
	$('.newComment').unbind('keydown').keydown(function(event) {
	  	if ( event.ctrlKey && event.keyCode == 13 && !event.shiftKey) {
			event.preventDefault();
			mylog.log($(this).data("id"), $(this).data("parentid"));
	        validateComment($(this).data("id"), $(this).data("parentid"));
	    }
	});
	$('.validateComment').off().one("click",function(){
		validateComment($(this).data("id"), $(this).data("parentid"));
	});
	$('.cancelComment').off().on("click",function(){
		cancelComment($(this).data("id"));
	});

	//Comment action button
	$('.commentReply').off().on("click",function(){
		$(this).prop('disabled', true);
		replyComment($(this).data("id"));
		$(this).prop('disabled', false);
	});
	$('.commentVoteUp').off().on("click",function(){
		id=$(this).data("id");
		if($(this).children(".label").hasClass("label-inverse")){
			if($(".commentReportAbuse[data-id='"+id+"']").children(".label").hasClass("label-red"))
				toastr.info("<?php echo Yii::t("common", "You can't make any actions on this comment after reporting abuse !") ?>");
			else
				toastr.info("<?php echo Yii::t("common", "Remove your last opinion before") ?>");
		}else{	
			if($(".commentVoteDown[data-id='"+id+"']").children(".label").hasClass("label-inverse")){
				method = true;
			}
			else{
				method = false;
			}
			actionOnComment($(this),'<?php echo Action::ACTION_VOTE_UP ?>', method);
			disableOtherAction(id, '.commentVoteUp',method);
		}
	});
	$('.commentVoteDown').off().on("click",function(){
		id=$(this).data("id");
		if($(this).children(".label").hasClass("label-inverse")){
			if($(".commentReportAbuse[data-id='"+id+"']").children(".label").hasClass("label-red"))
				toastr.info("<?php echo Yii::t("common", "You can't make any actions on this comment after reporting abuse !") ?>");
			else
				toastr.info("<?php echo Yii::t("common", "Remove your last opinion before") ?>");
		}else{	
			if($(".commentVoteUp[data-id='"+id+"']").children(".label").hasClass("label-inverse")){
				method = true;
			}
			else{
				method = false;
			}
			actionOnComment($(this),'<?php echo Action::ACTION_VOTE_DOWN ?>', method);
			disableOtherAction(id, '.commentVoteDown', method);
		}
	});

	//Abuse process
	$('.commentReportAbuse').off().on("click",function(){
		id=$(this).data("id");
		if($(this).children(".label").hasClass("label-inverse"))
			toastr.info("<?php echo Yii::t("common", "Remove your last opinion before") ?>");
		else{	
			if($(".commentVoteUp[data-id='"+id+"']").children(".label").hasClass("label-inverse") && $(".commentVoteDown[data-id='"+id+"']").children(".label").hasClass("label-inverse"))
				toastr.info("<?php echo Yii::t("common", "You can't make any actions on this comment after reporting abuse !") ?>");
			else
				reportAbuse($(this), $(this).data("contextid"));
		}
	});
	$('.deleteComment').off().on("click",function(){
		actionAbuseComment($(this), "<?php echo Comment::STATUS_DELETED ?>", "");
	});
	$('.ignoreAbuse').off().on("click",function(){
		actionAbuseComment($(this), "<?php echo Comment::STATUS_ACCEPTED ?>", "");

	});
	$('.abuseHistory').off().on("click",function(){
		bootbox.alert("TODO - history");
	});
	$('.commentContent-posted').off().on("mouseover",function(){
		if( canUserComment )
			$(this).children(".bar_tools_post").removeClass("hide").fadeIn(2000);
	}).on("mouseout",function(){
		$(this).children(".bar_tools_post").addClass("hide");
	});

	if(contextType == "actionRooms" && canUserComment)
	{
		$(".commentText-posted").bind('mouseup', function(e){
	        if (window.getSelection) {
	          selection = window.getSelection();
	        } else if (document.selection) {
	          selection = document.selection.createRange();
	        }
	        if( $(this).parent().hasClass("commentContent-posted")){
	        	if($(".selBtn").length)
	        		$(".selBtn").remove();
	        	links = "<a href='javascript:;' onclick='fastAdd(\"/rooms/fastaddaction\")' class='selBtn text-bold btn btn-purple btn-xs'><i class='fa fa-cogs'></i> créer en action <i class='fa fa-plus'></i></a>"+
	        			" <a href='javascript:;'  onclick='fastAdd(\"/survey/fastaddentry\")' class='selBtn text-bold btn btn-purple btn-xs'><i class='fa fa-archive'></i> créer en proposition <i class='fa fa-plus'></i></a>"
	        			/*+" <a href='javascript:;'  onclick='highlight()' class='selBtn text-bold btn btn-dark-yellow btn-xs'><i class='fa fa-paint-brush'></i> Highlight Hot point <i class='fa fa-legal'></i></a>"*/;
	        	$(this).parent().find("div.bar_tools_post").append(links);
	        }
	    });
	}
}

function highlight () { 
	toastr.info("<h1>New Feature<br/><span class='text-large'>Highlighting text in discussions, to build quick reading synthesis</span><br/><a class='btn btn-dark-blue' href='alert(\"open communecter public Feature voting\")'>VOTE FOR IT</a></h1>");
}
function  fastAdd(url) { 
	mylog.log("url",url);
	selTxt = selection.toString();
	if( selection.toString() != "" ){
		if( url.indexOf("fastaddaction") > 0 )
			prompt = "<?php echo Yii::t("rooms","The action will be created in an action List named like this discussion",null,Yii::app()->controller->module->id) ?>";
		else if( url.indexOf("fastaddentry") > 0 )
			prompt = "<?php echo Yii::t("rooms","The proposal will be created in a Decision Room named like this discussion",null,Yii::app()->controller->module->id) ?>";

		var message = "<?php echo Yii::t("common","Are you sure") ?> ?";
		var boxNews = bootbox.dialog({
				title: message,
				message: prompt,
				buttons: {
					annuler: {
						label: "Annuler",
						className: "btn-default",
						callback: function() {}
					},
					success: {
						label: "OK",
						className: "btn-info",
						callback: function() {
							processingBlockUi();
							$.ajax({
						        type: "POST",
						        url: baseUrl+'/'+moduleId+url,
						        data: {
						        	"discussionId" : context['_id']['$id'],
						        	"type" : contextType,
						        	"txt" : selTxt
						        },
						        dataType: "json",
						        success: function(data){
						          if(data.result){
						            toastr.success("<h1><?php echo Yii::t("common","Created Successfully") ?>.<br/><a class='btn btn-dark-blue' href='javascript:loadByHash(\""+data.hash+"\")'><?php echo Yii::t("common","Quick access here") ?></a><h1>");
						            $(".selBtn").remove(); 
						          } else 
						            toastr.error(data.msg);
						          
						          $.unblockUI();
						        },
						        error: function(data) {
						          $.unblockUI();
						          toastr.error("Something went really bad : "+data.msg);
						        }
						    });
						}
					}
				}
	    });
	}
 }

function actionOnComment(comment, action, method) {
	mylog.log(comment);
	params=new Object,
	params.id = comment.data("id"),
	params.collection = '<?php echo Comment::COLLECTION?>',
	params.action = action;
	if(method){
		params.unset=method;
	}
	$.ajax({
		url: baseUrl+'/'+moduleId+"/action/addaction/",
		data: params,
		type: 'post',
		global: false,
		dataType: 'json',
		success: 
			function(data) {
    			if(!data.result){
                    toastr.error(data.msg);
               	}
                else { 
                    if (data.userAllreadyDidAction) {
                    	toastr.info("You already vote on this comment.");
                    } else {
						count = parseInt(comment.data("count"));
	                    if(action=="reportAbuse"){
							toastr.success(trad["thanktosignalabuse"]);

							//to hide menu
							$(".newsReport[data-id="+params.id+"]").hide();
						}
						else{
		                    if(count < count+data.inc)
		                    	toastr.success("<?php echo Yii::t("common", "Your vote has been successfully added") ?>");
		                    else
								toastr.success("<?php echo Yii::t("common","Your vote has been successfully removed") ?>");	 
						}                   
	                   // toastr.success(data.msg);

						comment.data( "count" , count+data.inc );
						icon = comment.children(".label").children(".fa").attr("class");
						comment.children(".label").html(comment.data("count")+" <i class='"+icon+"'></i>");
					}
                }
            },
        error: 
        	function(data) {
        		toastr.error("Error calling the serveur : contact your administrator.");
        	}
		});
}

function reportAbuse(comment, contextId) {
	// mylog.log(contextId);
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
	var boxComment = bootbox.dialog({
	  message: message,
	  title: '<?php echo Yii::t("comment","You are going to declare this comment as abuse : please fill the reason ?") ?>',
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
	      	actionAbuseComment(comment, "<?php echo Action::ACTION_REPORT_ABUSE ?>", reason, reasonComment);
			disableOtherAction(comment.data("id"), '.commentReportAbuse');
			copyCommentOnAbuseTab(comment);
			return true;
	      }
	    },
	  }
	});

	// var box = bootbox.prompt('<?php echo Yii::t("comment","You are going to declare this comment as abuse : please fill the reason ?") ?>', function(result) {
	// 	if (result != null) {			
	// 		if (result != "") {
	// 			actionAbuseComment(comment, "<?php echo Action::ACTION_REPORT_ABUSE ?>", result);
	// 			disableOtherAction(comment.data("id"), '.commentReportAbuse');
	// 			copyCommentOnAbuseTab(comment);
	// 			return true;
	// 		} else {
	// 			toastr.error('<?php echo Yii::t("comment","Please fill a reason") ?>');
	// 		}
	// 	}
	// });

	boxComment.on("shown.bs.modal", function() {
	  $.unblockUI();
	});

	boxComment.on("hide.bs.modal", function() {
	  $.unblockUI();
	});
}

function actionAbuseComment(comment, action, reason, reasonComment) {
	$.ajax({
		url: baseUrl+'/'+moduleId+"/action/addaction/",
		data: {
			id: comment.data("id"),
			collection : '<?php echo Comment::COLLECTION?>',
			action : action,
			reason : reason,
			comment : reasonComment
		},
		type: 'post',
		global: false,
		dataType: 'json',
		success: 
			function(data) {
    			if(!data.result){
                    toastr.error(data.msg);
               	}
                else { 
                    if (data.userAllreadyDidAction) {
                    	toastr.info('<?php echo Yii::t("comment","You already declare this comment as abused.") ?>');
                    } else {
	                    toastr.success(data.msg);
	                    if (action == "<?php echo Action::ACTION_REPORT_ABUSE ?>") {
		                    count = parseInt(comment.data("count"));
							comment.data( "count" , count+1 );
							icon = comment.children(".label").children(".fa").attr("class");
							comment.children(".label").html(comment.data("count")+" <i class='"+icon+"'></i>");
						} else {
							$('.abuseCommentTable #comment'+comment.data("id")).remove();
							//abusedComments[comment.data("id")]
							$('.nbCommentsAbused').html((parseInt($('.nbCommentsAbused').html()) || 0) -1);
						}
					}
                }
            },
        error: 
        	function(data) {
        		toastr.error('<?php echo Yii::t("comment","Error calling the serveur : contact your administrator.") ?>');
        	}
		});
}

function copyCommentOnAbuseTab(commentAbused) {
	// mylog.log("la", commentAbused.data("id"));
	var commentObj = comments[commentAbused.data("id")];
	abusedComments[commentAbused.data("id")] = commentObj;

	var newCommentLine = buildCommentLineHTML(commentObj, "abuse");
	var ulRoot = $('#entry_abuse .tree');
	ulRoot.prepend(newCommentLine);
	$('.nbCommentsAbused').html((parseInt($('.nbCommentsAbused').html()) || 0) + 1);
}

//When a user already did an action on a comment the other buttons are disabled
function disableOtherAction(commentId, action,method) {
	if(method){
		$("#comment"+commentId).children().children(".bar_tools_post").children(".commentVoteUp").children(".label").removeClass("label-inverse").addClass("label-green");
		$("#comment"+commentId).children().children(".bar_tools_post").children(".commentVoteDown").children(".label").removeClass("label-inverse").addClass("label-orange");	
		$("#comment"+commentId).children().children(".bar_tools_post").children(".commentReportAbuse").children(".label").removeClass("label-inverse").addClass("label-red");
	}
	else{
		if (action != ".commentVoteUp") {
			$("#comment"+commentId).children().children(".bar_tools_post").children(".commentVoteUp").children(".label").removeClass("label-green").addClass("label-inverse");
			//$("#comment"+commentId).children().children(".bar_tools_post").children(".commentVoteUp");
		}
		if (action != ".commentVoteDown") {
			$("#comment"+commentId).children().children(".bar_tools_post").children(".commentVoteDown").children(".label").removeClass("label-orange").addClass("label-inverse");	
			//$("#comment"+commentId).children().children(".bar_tools_post").children(".commentVoteDown").off();
		}
		
		if (action != ".commentReportAbuse") {
			$("#comment"+commentId).children().children(".bar_tools_post").children(".commentReportAbuse").children(".label").removeClass("label-red").addClass("label-inverse");
			//$("#comment"+commentId).children().children(".bar_tools_post").children(".commentReportAbuse").off();
		}
	
		//$("#comment"+commentId).children().children(".bar_tools_post").children(action).off();
	}
}

function replyComment(parentCommentId) {
	
	var commentsTLLine = buildNewCommentLine(parentCommentId);

	//add a new line under the comment
	var ulChildren = $('#comment'+parentCommentId).children('ul');
	// mylog.log(ulChildren);
	
	if (ulChildren.length == 0) {
		// mylog.log("pas de children");
		//add new ul entry
		commentsTLLine = '<ul class="level list-unstyled" style="padding-left: 15px">'+commentsTLLine+'</ul>';
		ulChildren = $('#comment'+parentCommentId);
		ulChildren.append(commentsTLLine);
	} else {
		ulChildren.prepend(commentsTLLine);	
	}
	bindEvent();
	$(".newComment").focus();
	activateSummernote('.newComment');
}

function buildNewCommentLine(parentCommentId) {
	var id = 'newcomment'+Math.floor((Math.random() * 100) + 1);
	
	var iconStr = getProfilImageUrl(currentUser.profilThumbImageUrl);
	var objectLink = iconStr;

	var color = "white";
	var icon = "fa-user";
	
	var name = currentUser.name;
	var city = "";
	var text = '<textarea class="newComment wysiwygInput" rows="2" style="width: 100%" data-id="'+id+'" data-parentid="'+parentCommentId+'"></textarea>';
	
	if (canUserComment == true) {
		commentsTLLine = 
					'<li id="'+id+'" class="comment">'+
						'<hr style="border-width: 2px;"">'+
						'<div class="" >'+
							//tags+
							objectLink+
							'<div class="commentline_title">'+
								'<span class="text-bold light-text no-margin">'+name+'</span>'+
								'<span class="commenter-location padding-5">'+city+'</span>'+
							'</div>'+
						'<div class="space10"></div>'+
						text+	
						'<div class="space10"></div>'+
						"<div class='bar_tools_post '>"+
						"<a href='javascript:;' class='validateComment' data-id='"+id+"' data-parentid='"+parentCommentId+"'><span class='label label-info'><?php echo Yii::t("comment","Validate") ?></span></a> "+
						"<a href='javascript:;' class='cancelComment' data-id='"+id+"' data-parentid='"+parentCommentId+"'><span class='label label-info'><?php echo Yii::t("comment","Cancel") ?></span></a> "+
						"</div>"+
					'</div></li>';
	} else {
		commentsTLLine = 
					'<li id="'+id+'"><div class="partition-'+color+'">'+
						'You can not comment more on this discussion'+
					'</div></li>';
	}
	return commentsTLLine;
}

function cancelComment(commentId) {
	var parentId = $("#"+commentId).children().children(".bar_tools_post").children(".cancelComment").data("parentid");
	// mylog.log('Remove comment '+commentId, parentId);
	if (parentId == "") {
		$('.saySomething').show();
	} 
	$('#'+commentId).remove();
}

function validateComment(commentId, parentCommentId) {
	content = $.trim($('#'+commentId+' .newComment').code());
	if (content == "" || content == null) {
		$('#'+commentId).remove();
	} else {
		$.ajax({
			url: baseUrl+'/'+moduleId+"/comment/save/",
			data: {
				parentCommentId: parentCommentId,
				content : content,
				contextId : context["_id"]["$id"],
				contextType : contextType
			},
			type: 'post',
			global: false,
			dataType: 'json',
			success: 
				function(data) {
					if(!data.result){
						toastr.error(data.msg);
					}
					else { 
						toastr.success(data.msg);
						mylog.log(data);
						$('.nbComments').html((parseInt($('.nbComments').html()) || 0) + 1);
						if (data.newComment.contextType=="news"){
							$(".newsAddComment[data-id='"+data.newComment.contextId+"']").children().children(".nbNewsComment").text(parseInt($('.nbComments').html()) || 0);
						}
						switchComment(commentId, data.newComment, parentCommentId);
						latestComments = data.time;
					}
				},
			error: 
				function(data) {
					toastr.error('<?php echo Yii::t("comment","Error calling the serveur : contact your administrator.") ?>');
				}
		});
	}
	//return newCommentId;
}

//Switch from Edditing comment to view comment
function switchComment(tempCommentId, comment, parentCommentId) {
	comments[comment["_id"]["$id"]] = comment;
	$('#'+tempCommentId).remove();
	var commentsTLLine = buildCommentLineHTML(comment, "all");
	// When it's a root comment
	if (parentCommentId == "" || "undefined" == typeof parentCommentId) {
		var ulChildren = $('#entry_comments .tree');
		ulChildren.prepend(commentsTLLine);
		$('#comment'+comment["_id"]["$id"]).addClass('animated bounceIn');
		$('.saySomething').show();
	} else {
		var ulChildren = $('#comment'+parentCommentId).children('ul');
		ulChildren.prepend(commentsTLLine);
		$('#comment'+comment["_id"]["$id"]).addClass('animated bounceIn');
	}
	initXEditable();
	manageCommentModeContext(comment["_id"]["$id"]);
	bindEvent();
}

function getProfilImageUrl(imageURL) {
	mylog.log("imageURL",imageURL);
	var iconStr = '<div class="avatar">';
	
	if ("undefined" != typeof imageURL && imageURL != "") {
		iconStr += '<img width="30" height="30" alt="image" class="img-circle"'+ 
						'src="'+baseUrl+'/'+imageURL+'">';
	} else {
		iconStr += '<i class="fa fa-user_circled fa-2x fa-border"></i>';
	}

	iconStr += "</div>";
	
	return iconStr;
}

function deleteComment(id,$this){
	$.ajax({
        type: "POST",
        url: baseUrl+"/"+moduleId+"/comment/delete/id/"+id,
		dataType: "json",
		//data: {"newsId": idNews},
    	success: function(data){
        	if (data.result) {    
	        	mylog.log(data);           
				toastr.success("<?php echo Yii::t("common","Comment successfully deleted")?>");
				liParent=$this.parents().eq(2);
	        	liParent.fadeOut();
	        	$('.nbComments').html((parseInt($('.nbComments').html()) || 0) - 1);
	        	if (data.comment.contextType=="news"){
						$(".newsAddComment[data-id='"+data.comment.contextId+"']").children().children(".nbNewsComment").text(parseInt($('.nbComments').html()) || 0 );
					}
			} else {
	            toastr.error("Quelque chose a buggé");
	        }
	    }
	});
}

function modifyComment(id){
	switchModeCommentEdit(id);
}

function switchModeCommentEdit(id){
	//alert(mode);
	if(modeComment == "view"){
		modeComment = "update";
		manageCommentModeContext(id);
	} else {
		modeComment ="view";
		manageCommentModeContext(id);
	}
}

function manageCommentModeContext(id) {
	listXeditables = ['#commentText'+id];
	if (modeComment == "view") {
		//$('.editable-project').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			$(value).editable('toggleDisabled');
			$(value).css('fontWeight', '300');
		});
		//$("#btn-update-geopos").removeClass("hidden");
	} else if (modeComment == "update") {
		// Add a pk to make the update process available on X-Editable
		//$('.editable-comment').editable('option', 'pk', id);
		$.each(listXeditables, function(i,value) {
			$(value).editable('option', 'pk', id);
			$(value).editable('toggleDisabled');
			$(value).css('fontWeight', '500');
		});
	}
}
function initXEditable() {
	$.fn.editable.defaults.mode = 'inline';
	$('.editable-comment').editable({
    	url: baseUrl+"/"+moduleId+"/comment/updatefield", //this url will not be used for creating new job, it is only for update
    	emptytext: 'Empty',
    	textarea: {
			html: true,
			video: true,
			image: true
		},
    	showbuttons: 'bottom',
    	success : function(data) {
	        if(data.result) {
	        	toastr.success(data.msg);
				mylog.log(data);
	        	//$(this).text(data.text);
				mylog.log(data);
				mylog.log("ici");
				//initXEditable();
				//switchModeCommentEdit(data.id);
				//$("a[data-id='"+data.id+"']").trigger('click');
	        }
	        else{
	        	toastr.error(data.msg);  
	        }
	    }
	});

}
</script>
