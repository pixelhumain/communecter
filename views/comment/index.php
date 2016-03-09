<?php

$cssAnsScriptFiles = array(
	"/assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js",
	'/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles);

?>	
	<!-- start: PAGE CONTENT -->
<div id="commentHistory">
	<div class="space20"></div>
	<div class="col-md-12">
		<!-- start: TIMELINE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading border-light">
				<h4 class="panel-title"><i class="fa fa-comments fa-2x text-blue"></i> <?php echo ucfirst($contextType).' - '.@$context["name"]?></h4>
				<ul class="panel-heading-tabs border-light">
					<li>
						<div><i class="fa fa-comments fa-2x text-blue"></i><?php echo ' '.$nbComment; ?> Comments</div>
					</li>
					<li class="panel-tools">
					  <div class="dropdown">
						<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
						  <i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu dropdown-light pull-right" role="menu">
						  <li>
							<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
						  </li>
						  <li>
							<a class="panel-expand" href="#">
							  <i class="fa fa-expand"></i> <span>Fullscreen</span>
							</a>
						  </li>
						  </ul>
					  </div>
					</li>
				</ul>
			</div>
			<div class="panel-body panel-white">
				<ul class="commentline-scrubber inner-element commentsTLmonthsList"></ul>
				<div class='row'>
					<div id="commentline">
						<div class="commentline commentsTL col-md-6">
												
						</div>
					</div>

				</div>
			</div>
			<div id="waypoint">toto</div>
		</div>
		<!-- end: TIMELINE PANEL -->
	</div>
</div>
<style type="text/css">

</style>
<!-- end: PAGE CONTENT-->
<script type="text/javascript">
var context = <?php echo json_encode($context)?>;
var contextType = <?php echo json_encode($contextType)?>;
var comments = <?php echo json_encode($comments); ?>;
var currentUser = <?php echo json_encode(Yii::app()->session["user"])?>;
var options = <?php echo json_encode($options)?>;
var canUserComment = <?php echo json_encode($canComment)?>;

jQuery(document).ready(function() {
	buildTimeLine();
	addEmptyCommentOnTop();
	bindEvent();
});

function buildTimeLine() {
	$(".commentsTL").html('<div class="spine"></div>');
	
	countEntries = 0;
	$('.commentsTL').append(buildComments(comments, 0));
	$('.commentsTL').append()
}

function addEmptyCommentOnTop() {
	var newCommentLine = buildNewCommentLine("");
	
	//create a new reply line on the root
	var ulRoot = $('.tree');
	ulRoot.prepend(newCommentLine);	
}

function buildComments(commentsLevel, level) {
	if (level == 0) {
		var commentsHTML = '<ul class="tree">';
	} else {
		var commentsHTML = '<ul class="level">';	
	}

	$.each( commentsLevel , function(key,commentObj) {
		if(commentObj.text && commentObj.created) {
			var date = new Date( parseInt(commentObj.created)*1000 );
			var commentsTLLine = buildCommentLineHTML(commentObj);
			
			commentsHTML += commentsTLLine;
			
			if (commentObj.replies.length != 0) {
				nextLevel = level + 1;
				var commentsTLLineDown = buildComments(commentObj.replies, nextLevel);
				commentsHTML += commentsTLLineDown;
			} else {
				commentsHTML += "</li>";
			}
		}
	});
	commentsHTML += "</ul>";
	return commentsHTML;
}

function buildCommentLineHTML(commentObj) {
	var id = commentObj["_id"]["$id"];
	var date = moment(commentObj.created * 1000);
	var dateStr = date.format('D MMM YYYY HH:mm');
	
	var iconStr = getProfilImageUrl(commentObj.author.profilImageUrl);
	var objectLink = (commentObj.object) ? ' <a '+url+'>'+iconStr+'</a>' : iconStr;

	var color = "white";
	var icon = "fa-user";
	
	var title = commentObj.author.name;
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

	commentsTLLine = '<li id="comment'+id+'"><div class="commentline_element partition-'+color+'">'+
					tags+
					'<div class="commentline_title">'+
						objectLink+
						'<span class="text-large text-bold light-text no-margin padding-5">'+title+'</span>'+
					'</div>'+
					'<div class="space10"></div>'+
					text+	
					'<div class="space10"></div>'+
					
					'<hr><div class="pull-right"><i class="fa fa-clock-o"></i> '+dateStr+'</div>'+
					"<div class='bar_tools_post'>";
	
	if (options.tree == true) {
		commentsTLLine = commentsTLLine + "<a href='javascript:;' class='commentReply' data-id='"+commentObj._id['$id']+"'><span class='label label-info'><i class='fa fa-reply'></i></span></a> "
	};

	var voteUpCount = parseInt(commentObj.voteUpCount) || 0;
	var voteDownCount = parseInt(commentObj.voteDownCount) || 0;
	var reportAbuseCount = parseInt(commentObj.reportAbuseCount) || 0;
	
	commentsTLLine = commentsTLLine + 
					"<a href='javascript:;' class='commentVoteUp' data-count='"+voteUpCount+"' data-id='"+commentObj._id['$id']+"'><span class='label label-green'>"+voteUpCount+" <i class='fa fa-thumbs-up'></i></span></a> "+
					"<a href='javascript:;' class='commentVoteDown' data-count='"+voteDownCount+"' data-id='"+commentObj._id['$id']+"'><span class='label label-orange'>"+voteDownCount+" <i class='fa fa-thumbs-down'></i></span></a> "+
					"<a href='javascript:;' class='commentReportAbuse' data-count='"+reportAbuseCount+"' data-id='"+commentObj._id['$id']+"'><span class='label label-red'>"+reportAbuseCount+" <i class='fa fa-warning'></i></span></a> "+
					"</div>"+
				'</div>';

	return commentsTLLine;
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
	$(".date_separator").appear().on('appear', function(event, $all_appeared_elements) {
		separator = '#' + $(this).attr("id");
		$('.commentline-scrubber').find("li").removeClass("selected").find("a[href = '" + separator + "']").parent().addClass("selected");
	}).on('disappear', function(event, $all_disappeared_elements) {   				
		separator = $(this).attr("id");
		$('.commentline-scrubber').find("a").find("a[href = '" + separator + "']").parent().removeClass("selected");
	});
	$('.commentReply').off().on("click",function(){
		replyComment($(this).data("id"));
	});
	$('.validateComment').off().on("click",function(){
		validateComment($(this).data("id"), $(this).data("parentid"));
	});
	$('.cancelComment').off().on("click",function(){
		cancelComment($(this).data("id"));
	});

	$('#waypoint').on("appear", function(event, $all_appeared_elements) {
		alert("vlan je suis sur le waypoint");
	});

	//Comment action button
	$('.commentVoteUp').off().on("click",function(){
		actionOnComment($(this),'<?php echo Action::ACTION_VOTE_UP ?>');
	});
	$('.commentVoteDown').off().on("click",function(){
		actionOnComment($(this),'<?php echo Action::ACTION_VOTE_DOWN ?>');
	});
	$('.commentReportAbuse').off().on("click",function(){
		actionOnComment($(this),'<?php echo Action::ACTION_REPORT_ABUSE ?>');
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

function replyComment(parentCommentId) {
	
	var commentsTLLine = buildNewCommentLine(parentCommentId);

	//add a new line under the comment
	var ulChildren = $('#comment'+parentCommentId).children('ul');
	console.log(ulChildren);
	
	if (ulChildren.length == 0) {
		console.log("pas de children");
		//add new ul entry
		commentsTLLine = '<ul class="level">'+commentsTLLine+'</ul>';
		ulChildren = $('#comment'+parentCommentId);
		ulChildren.append(commentsTLLine);
	} else {
		ulChildren.prepend(commentsTLLine);	
	}
	bindEvent();
}

function buildNewCommentLine(parentCommentId) {
	var id = 'newcomment'+Math.floor((Math.random() * 100) + 1);
	
	var iconStr = getProfilImageUrl(currentUser.profilImageUrl);
	var objectLink = iconStr;

	var color = "white";
	var icon = "fa-user";
	
	var title = currentUser.name;
	var text = '<textarea class="newComment" rows="2" style="width: 100%"></textarea>';
	var tags = "";
	
	if (canUserComment == true) {
		commentsTLLine = 
					'<li id="'+id+'"><div class="commentline_element partition-'+color+'">'+
						tags+
						'<div class="commentline_title">'+
							objectLink+
							'<span class="text-large text-bold light-text no-margin padding-5">'+title+'</span>'+
						'</div>'+
						'<div class="space10"></div>'+
						text+	
						'<div class="space10"></div>'+
						"<div class='bar_tools_post'>"+
						"<a href='javascript:;' class='validateComment' data-id='"+id+"' data-parentid='"+parentCommentId+"'><span class='label label-info'>Submit</span></a> "+
						"<a href='javascript:;' class='cancelComment' data-id='"+id+"'><span class='label label-info'>Cancel</span></a> "+
						"</div>"+
					'</div></li>';
	} else {
		commentsTLLine = 
					'<li id="'+id+'"><div class="commentline_element partition-'+color+'">'+
						'You can not comment more for this discussion'+
					'</div></li>';
	}
	return commentsTLLine;
}

function cancelComment(commentId) {
	console.log('Remove comment '+commentId);
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
				}
			},
		error: 
			function(data) {
				toastr.error("Error calling the serveur : contact your administrator.");
			}
	});

	//return newCommentId;
}

//Switch from Edditing comment to view comment
function switchComment(tempCommentId, comment, parentCommentId) {
	$('#'+tempCommentId).remove();
	var commentsTLLine = buildCommentLineHTML(comment);
	// When it's a root comment
	if (parentCommentId == "" || "undefined" == typeof parentCommentId) {
		var ulChildren = $('.tree');
		ulChildren.prepend(commentsTLLine);
		$('#comment'+comment["_id"]["$id"]).addClass('animated bounceIn');
		addEmptyCommentOnTop();
	} else {
		var ulChildren = $('#comment'+parentCommentId).children('ul');
		ulChildren.prepend(commentsTLLine);
		$('#comment'+comment["_id"]["$id"]).addClass('animated bounceIn');
	}
	
	bindEvent();
}

function getProfilImageUrl(imageURL) {
	var iconStr = '<i class="fa fa-user_circled fa-2x pull-left fa-border"></i>';
	if ("undefined" != typeof imageURL && imageURL != "") {
		iconStr = '<img width="50" height="50" alt="image" class="img-circle"'+ 
						'src="'+baseUrl+'/'+moduleId+'/document/resized/50x50'+
						 imageURL+'">';
	}
	return iconStr;
}
</script>
