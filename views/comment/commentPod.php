<?php

$cssAnsScriptFiles = array(
	"/assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js",
	'/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
	'/assets/plugins/jquery-shorten/jquery.shorten.1.0.js',
	'/assets/plugins/moment/min/moment.min.js',
	'/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css',
	'/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js',
	'/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles);

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
</style>

<?php 
$optionsLabels = array(
	Comment::COMMENT_ON_TREE => array(
		true => array("title" => "You can reply to a comment", "label" => "Can Reply"),
		false => array("title" => "You can not reply to a comment", "label" => "Can Reply")
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

?>
<!-- start: PAGE CONTENT -->
<div id="commentHistory">
	<div class="panel panel-white">
		<div class="panel-heading border-light">
			<?php 
			$currentUser = Yii::app()->session["user"];
			if (@$currentUser && Role::isDeveloper($currentUser['roles'])){ ?>
			<div class="options pull-right">
				<?php foreach ($options as $optionKey => $optionValue) {
					$currentLabel = $optionsLabels[$optionKey][$optionValue];
					echo '<span class="comment-options" title="'.$currentLabel["title"].'">'.$currentLabel["label"].' | </span>';
				}?>
			</div>
			<?php } ?>
			<h4 class="panel-title"><i class="fa fa-comments fa-2x text-blue"></i><span class="nbComments"><?php echo ' '.$nbComment; ?></span> <?php echo Yii::t("comment","Comments") ?></h4>
			
		</div>

		<div class="panel-body panel-white">
			<div class='row'>
				<div class="tabbable no-margin no-padding partition-dark">
					<ul class="nav nav-tabs">
						<li role="presentation" class="active">
							<!-- start: TIMELINE PANEL -->
							<a href="#entry_comments" data-toggle="tab">
								<?php echo Yii::t("comment","Comments") ?><span class="badge badge-green nbComments"><?php echo $nbComment ?></span>
							</a>
							<!-- end: TIMELINE PANEL -->
						</li>
						<li role="presentation">
							<a href="#entry_community_comments" data-toggle="tab">
								<?php echo Yii::t("comment","Popular") ?><span class="badge badge-yellow"><?php echo count($communitySelectedComments) ?></span>
							</a>
						</li>
					<?php if (Authorisation::canEditEntry(Yii::app()->session["userId"], (String) $context["_id"])) { ?>
						<li role="presentation">
							<a href="#entry_abuse" data-toggle="tab">
								Abuse <span class="badge badge-red nbCommentsAbused"><?php echo count($abusedComments) ?></span>
							</a>
						</li>
					<?php } ?>
					</ul>
					<div class="tab-content partition-white">
						<div class="tab-pane active no-padding" id="entry_comments" >
							<div class="panel-scroll ps-container commentTable" style="padding-top: 5px; max-height: 540px; height:auto ">
							<?php if ($canComment) {?>
								<div class='saySomething padding-5'>
									<input type="text" style="width:100%" value="<?php echo Yii::t("comment","Say Something") ?>"/>
								</div>
							<?php } ?>
							</div>
						</div>
						<div class="tab-pane no-padding" id="entry_community_comments">
							<div class="panel-scroll ps-container communityCommentTable" style="padding-top: 5px; max-height: 540px; height:auto ">
							</div>
						</div>
						<div class="tab-pane no-padding" id="entry_abuse">
							<div class="panel-scroll ps-container abuseCommentTable" style="padding-top: 5px; max-height: 540px; height:auto ">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<style type="text/css">

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

jQuery(document).ready(function() {
	buildCommentsTree('.commentTable', comments, "all");
	buildCommentsTree('.communityCommentTable', commentsSelected, "all");
	buildCommentsTree('.abuseCommentTable', abusedComments, "abuse");
	bindEvent();
	$('.ps-container').perfectScrollbar({suppressScrollX : true});
});

function buildCommentsTree(where, commentsList, withActions) {
	$(".commentsTL").html('<div class="spine"></div>');
	
	countEntries = 0;
	$(where).append(buildComments(commentsList, 0, withActions));
}

function addEmptyCommentOnTop() {
	var newCommentLine = buildNewCommentLine("");	
	//create a new reply line on the root
	var ulRoot = $('#entry_comments .tree');
	ulRoot.prepend(newCommentLine);
	$(".newComment").focus();
}

function buildComments(commentsLevel, level, withActions) {
	if (level == 0) {
		var commentsHTML = '<ul class="tree list-unstyled padding-5">';
	} else {
		var commentsHTML = '<ul class="level list-unstyled" style="padding-left: 15px">';	
	}

	$.each( commentsLevel , function(key,commentObj) {
		if(commentObj.text && commentObj.created) {
			var date = new Date( parseInt(commentObj.created)*1000 );
			var commentActions = withActions;
			//Manage deleted comments
			if (commentObj.status == "deleted") {
				commentActions = "disabled";
			}
			var commentsTLLine = buildCommentLineHTML(commentObj, commentActions);
			
			commentsHTML += commentsTLLine;
			
			if (commentObj.replies.length != 0) {
				nextLevel = level + 1;
				var commentsTLLineDown = buildComments(commentObj.replies, nextLevel, withActions);
				commentsHTML += commentsTLLineDown;
			} else {
				commentsHTML += "</li>";
			}
		}
	});
	commentsHTML += "</ul>";
	return commentsHTML;
}

function buildCommentLineHTML(commentObj, withActions) {
	// console.log(commentObj, withActions);
	var id = commentObj["_id"]["$id"];
	var date = moment(commentObj.created * 1000);
	var dateStr = date.fromNow();
	
	var iconStr = getProfilImageUrl(commentObj.author.profilImageUrl);
	var objectLink = (commentObj.object) ? ' <a '+url+'>'+iconStr+'</a>' : iconStr;

	var color = "white";
	var icon = "fa-user";
	
	var name = commentObj.author.name;
	if(commentObj.author.address != "undefined")
		var city = commentObj.author.address.addressLocality;
	var text = commentObj.text;
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

	commentsTLLine = '<hr style="border-width: 2px; margin-bottom: 10px; margin-top: 10px">'+
					'<li id="comment'+id+'" class="comment">'+
						'<div class="commentContent-'+commentObj.status+'">'+
							//tags+
							objectLink+
							'<div class="commentline_title">'+
								'<span class="text-bold light-text no-margin">'+name+'</span>'+
								'<span class="commenter-location padding-5">'+city+'</span>'+
								'<span class="comment-time"><i class="fa fa-clock-o"></i> '+dateStr+'</span>'+
							'</div>'+
							'<div class="commentText-'+commentObj.status+'">'+text+'</div>'+
							'<div class="space10"></div>'+
							"<div class='bar_tools_post'>";
	
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

	if (voteUpCount > 0 && commentObj.voteUp.toString().indexOf(userId) >= 0) {
 		actionDone = "voteUp";
 		colorVoteDown = colorReportAbuse = "label-inverse";
	}
	
	if (voteDownCount > 0 && commentObj.voteDown.toString().indexOf(userId) >= 0) {
 		actionDone = "voteDown";
 		colorVoteUp = colorReportAbuse = "label-inverse";
	}

	if (reportAbuseCount > 0 && "undefined" != typeof commentObj.reportAbuse[userId]) {
 		actionDone = "reportAbuse";
 		colorVoteDown = colorVoteUp = "label-inverse";
	}

	if (actionDone != "") {
		classVoteUp = "";
		classVoteDown = "";
		classReportAbuse = "";
	}

	var titleVoteUp = "<?php echo addslashes(Yii::t('comment','Agree with that'))?>";
	var titleVoteDown = "<?php echo addslashes(Yii::t('comment','Disagree with that'))?>";
	var titleReportAbuse = "<?php echo addslashes(Yii::t('comment','Report an abuse'))?>";

	// console.log(commentObj.contextId);
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
	var separator, anchor;
	$('.commentline-scrubber').scrollToFixed({
		marginTop: $('header').outerHeight() + 100
	}).find("a").on("click", function(e){			
		anchor = $(this).data("separator");
		$("body").scrollTo(anchor, 300);
		e.preventDefault();
	});
	
	//New comment actions
	$('.saySomething').off().on("focusin",function(){
		var backUrl = window.location.href.replace(window.location.origin, "");
		// console.log(backUrl);
		if (checkLoggued(backUrl)) {
			$('.saySomething').hide();
			addEmptyCommentOnTop();
			bindEvent();
		}
	});
	$('.validateComment').off().on("click",function(){
		validateComment($(this).data("id"), $(this).data("parentid"));
	});
	$('.cancelComment').off().on("click",function(){
		cancelComment($(this).data("id"));
	});

	//Comment action button
	$('.commentReply').off().on("click",function(){
		replyComment($(this).data("id"));
	});
	$('.commentVoteUp').off().on("click",function(){
		actionOnComment($(this),'<?php echo Action::ACTION_VOTE_UP ?>');
		disableOtherAction($(this).data("id"), '.commentVoteUp');
	});
	$('.commentVoteDown').off().on("click",function(){
		actionOnComment($(this),'<?php echo Action::ACTION_VOTE_DOWN ?>');
		disableOtherAction($(this).data("id"), '.commentVoteDown');
	});

	//Abuse process
	$('.commentReportAbuse').off().on("click",function(){
		reportAbuse($(this), $(this).data("contextid"));
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
	
}

function actionOnComment(comment, action) {
	$.ajax({
		url: baseUrl+'/'+moduleId+"/action/addaction/",
		data: {
			id: comment.data("id"),
			collection : '<?php echo Comment::COLLECTION?>',
			action : action
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
                    	toastr.info("You already vote on this comment.");
                    } else {
	                    toastr.success(data.msg);
	                    count = parseInt(comment.data("count"));
						comment.data( "count" , count+1 );
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
	// console.log(contextId);
	var box = bootbox.prompt('<?php echo Yii::t("comment","You are going to declare this comment as abuse : please fill the reason ?") ?>', function(result) {
		if (result != null) {			
			if (result != "") {
				actionAbuseComment(comment, "<?php echo Action::ACTION_REPORT_ABUSE ?>", result);
				disableOtherAction(comment.data("id"), '.commentReportAbuse');
				copyCommentOnAbuseTab(comment);
				return true;
			} else {
				toastr.error('<?php echo Yii::t("comment","Please fill a reason") ?>');
			}
		}
	});

	box.on("shown.bs.modal", function() {
	  $.unblockUI();
	});

	box.on("hide.bs.modal", function() {
	  showComments(contextId);
	});
}

function actionAbuseComment(comment, action, reason) {
	$.ajax({
		url: baseUrl+'/'+moduleId+"/comment/abuseprocess/",
		data: {
			id: comment.data("id"),
			collection : '<?php echo Comment::COLLECTION?>',
			action : action,
			reason : reason
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
	// console.log("la", commentAbused.data("id"));
	var commentObj = comments[commentAbused.data("id")];
	abusedComments[commentAbused.data("id")] = commentObj;

	var newCommentLine = buildCommentLineHTML(commentObj, "abuse");
	var ulRoot = $('#entry_abuse .tree');
	ulRoot.prepend(newCommentLine);
	$('.nbCommentsAbused').html((parseInt($('.nbCommentsAbused').html()) || 0) + 1);
}

//When a user already did an action on a comment the other buttons are disabled
function disableOtherAction(commentId, action) {
	if (action != ".commentVoteUp") {
		$("#comment"+commentId).children().children(".bar_tools_post").children(".commentVoteUp").children(".label").removeClass("label-green").addClass("label-inverse");
		$("#comment"+commentId).children().children(".bar_tools_post").children(".commentVoteUp").off();
	}
	if (action != ".commentVoteDown") {
		$("#comment"+commentId).children().children(".bar_tools_post").children(".commentVoteDown").children(".label").removeClass("label-orange").addClass("label-inverse");	
		$("#comment"+commentId).children().children(".bar_tools_post").children(".commentVoteDown").off();
	}
	
	if (action != ".commentReportAbuse") {
		$("#comment"+commentId).children().children(".bar_tools_post").children(".commentReportAbuse").children(".label").removeClass("label-red").addClass("label-inverse");
		$("#comment"+commentId).children().children(".bar_tools_post").children(".commentReportAbuse").off();
	}

	$("#comment"+commentId).children().children(".bar_tools_post").children(action).off();
}

function replyComment(parentCommentId) {
	
	var commentsTLLine = buildNewCommentLine(parentCommentId);

	//add a new line under the comment
	var ulChildren = $('#comment'+parentCommentId).children('ul');
	// console.log(ulChildren);
	
	if (ulChildren.length == 0) {
		// console.log("pas de children");
		//add new ul entry
		commentsTLLine = '<ul class="level list-unstyled" style="padding-left: 15px">'+commentsTLLine+'</ul>';
		ulChildren = $('#comment'+parentCommentId);
		ulChildren.append(commentsTLLine);
	} else {
		ulChildren.prepend(commentsTLLine);	
	}
	bindEvent();
	$(".newComment").focus();
}

function buildNewCommentLine(parentCommentId) {
	var id = 'newcomment'+Math.floor((Math.random() * 100) + 1);
	
	var iconStr = getProfilImageUrl(currentUser.profilImageUrl);
	var objectLink = iconStr;

	var color = "white";
	var icon = "fa-user";
	
	var name = currentUser.name;
	var city = "";
	var text = '<textarea class="newComment" rows="2" style="width: 100%"></textarea>';
	
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
						"<div class='bar_tools_post'>"+
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
	// console.log('Remove comment '+commentId, parentId);
	if (parentId == "") {
		$('.saySomething').show();
	} 
	$('#'+commentId).remove();
}

function validateComment(commentId, parentCommentId) {
	
	$.ajax({
		url: baseUrl+'/'+moduleId+"/comment/save/",
		data: {
			parentCommentId: parentCommentId,
			content : $('#'+commentId+' .newComment').val(),
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
					switchComment(commentId, data.newComment, parentCommentId);
					$('.nbComments').html((parseInt($('.nbComments').html()) || 0) + 1);
				}
			},
		error: 
			function(data) {
				toastr.error('<?php echo Yii::t("comment","Error calling the serveur : contact your administrator.") ?>');
			}
	});

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
	
	bindEvent();
}

function getProfilImageUrl(imageURL) {
	var iconStr = '<div class="avatar">';
	
	if ("undefined" != typeof imageURL && imageURL != "") {
		iconStr += '<img width="50" height="50" alt="image" class="img-circle"'+ 
						'src="'+baseUrl+'/'+moduleId+'/document/resized/50x50'+
						 imageURL+'">';
	} else {
		iconStr += '<i class="fa fa-user_circled fa-2x fa-border"></i>';
	}

	iconStr += "</div>";
	
	return iconStr;
}

</script>
