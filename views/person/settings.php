<?php 
$cssAnsScriptFilesTheme = array(
	//SELECT2
	'/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
	'/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js' , 

);
//if ($type == Project::COLLECTION)
//	array_push($cssAnsScriptFilesTheme, "/assets/plugins/Chart.js/Chart.min.js");
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme, Yii::app()->request->baseUrl);
?>
<style>
	td{padding:5px;}
	.panel-lines {
		padding:10px;

	}
	td, tr{
		text-align: center;
		text-align: -moz-center;
		text-align: -webkit-center;
	}
	.labelNotifications{
		
	}
</style>
<!--<div class="row">
	<div class="col-md-4 col-lg-4 col-sm-4">

		<div class="panel-lines col-md-12 col-sm-12 col-xs-12">
			<span class="labelNotifications">Actions on news (new one, comment, like, dislike)</span>
		</div>
		<div class="panel-lines col-md-12 col-sm-12 col-xs-12">
			<span class="labelNotifications">Comments (answer, like, dislike)</span>
		</div>
		<div class="panel-lines col-md-12 col-sm-12 col-xs-12">
			<span class="labelNotifications">New element (orga, project, event, poi)</span>
		</div>
		<div class="panel-lines col-md-12 col-sm-12 col-xs-12">
			<span class="labelNotifications">Needs published</span>
		</div>
		<div class="panel-lines col-md-12 col-sm-12 col-xs-12">
			<span class="labelNotifications">Discuss, survey, action (new room, new comment)</span>
		</div>
		<div class="panel-lines col-md-12 col-sm-12 col-xs-12">
			<span class="labelNotifications">Votes (new vote, alert before the end of votes, vote's result)</span>
		</div>
	</div>-->
<div class="col-md-12">
<h1>Notifications settings</h1>
<span> Activate or desactivate notifications and mails you want to received. You have a basic settings with three level personal, your network (including admin and members link) and public (your points of communexion)</span>
</div>
<table>
	<th>
		<tr>
			<td></td><td colspan="2">Personal notifcations</td><td colspan="2">Network notifications</td><td colspan="2">Communected notifications</td>
		</tr>
		<tr>
			<td></td><td>Notifs</td><td>Mail</td><td>Notifs</td><td>Mail</td><td>Notifs</td><td>Mail</td>
		</tr>
		<tr id="news">
			<th class="labelNotifications">Actions on news (new one, comment, like, dislike)</th>
			<td>
				<input class="hide input-settings" name="notification" data-type="personal">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="personal">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="notification" data-type="network">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="network">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="notification" data-type="public">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="public">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
		</tr>
		<tr id="comments">
			<th class="labelNotifications">Comments (answer, like, dislike)</th>
			<td>
				<input class="hide input-settings" name="notification" data-type="personal">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="personal">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="notification" data-type="network">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="network">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
			<td>
				<input class="hide input-settings" name="notification" data-type="public">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="public">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
		</tr>
		<tr id="elements">
			<th class="labelNotifications">New element (orga, project, event, poi)</th>
			<td>
				<input class="hide input-settings" name="notification" data-type="personal">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="personal">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
			<td>
				<input class="hide input-settings" name="notification" data-type="network">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="network">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="notification" data-type="public">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="public">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
		</tr>
		<tr id="needs">
			<th class="labelNotifications">Needs published</th>
			<td>
				<input class="hide input-settings" name="notification" data-type="personal">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="personal">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
			<td>
				<input class="hide input-settings" name="notification" data-type="network">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="network">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="notification" data-type="public">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="public">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
		</tr>
		<tr id="room">
			<th class="labelNotifications">Discuss, survey, action (new room, new comment)</th>
			<td>
				<input class="hide input-settings" name="notification" data-type="personal">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="personal">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
			<td>
				<input class="hide input-settings" name="notification" data-type="network">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="network">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="notification" data-type="public">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="public">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
		</tr>
		<tr id="survey">
			<th class="labelNotifications">Votes (new vote, alert before the end of votes, vote's result)</th>
			<td>
				<input class="hide input-settings" name="notification" data-type="personal">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="personal">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1" disabled>
			</td>
			<td>
				<input class="hide input-settings" name="notification" data-type="network">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="network">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="notification" data-type="public">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
			<td>
				<input class="hide input-settings" name="mail" data-type="public">
				<input type="checkbox" name="my-checkbox" data-type="notification" data-size="mini" data-label-width="1" data-handle-width="1">
			</td>
		</tr>
	</th>
</table>
<script type="text/javascript">
defaultNotificationsSettings={
	"notification":{
		"personal":{
			"comments":true,
			"news":true
		},
		"network":{
			"news":true,
			"elements":true,
			"needs":true,
			"room":true,
			"survey":true
		},
		"admin":{
			"follow":true,
			"invite":true,
			"ask":true,
			"confirm":true
		},
		"city":{
			"needs":true,
			"room":true,
			"survey":true	
		}
	},
	"mail":{
		"personal":{
			"comments":true,
			"news":true
		},
		"network":{
			"news":true,
			"elements":true,
			"needs":true,
			"room":true,
			"survey":true
		},
		"admin":{
			"follow":true,
			"invite":true,
			"ask":true,
			"confirm":true
		},
		"city":{
			"needs":false,
			"room":false,
			"survey":false	
		}
	}
}
notificationSettings=defaultNotificationsSettings;
jQuery(document).ready(function() {
	$("[name='my-checkbox']").bootstrapSwitch();
	$("[name='my-checkbox']").on("switchChange.bootstrapSwitch", function (event, state) {
		mylog.log("state = "+state );
		if (state == true) {
			$(this).prev().val(1);
		} else {
			$(this).prev().val(0);
		}		
	});
	initNotificationSettings(notificationSettings);
});

function initNotificationSettings(settings){
	$.each(settings.notification, function(key,data){
		$.each(data,function(e,v){
			if(v==true){
				$("#"+e).find("input[name='notification'][data-type='"+key+"']").val(1);
				$("#"+e).find("input[name='notification'][data-type='"+key+"']").next().find("[name='my-checkbox']").bootstrapSwitch('state', true, true);
			}
		});
	});
	$.each(settings.mail, function(key,data){
		$.each(data,function(e,v){
			if(v==true){
				$("#"+e).find("input[name='mail'][data-type='"+key+"']").val(1);
				$("#"+e).find("input[name='mail'][data-type='"+key+"']").next().find("[name='my-checkbox']").bootstrapSwitch('state', true, true);
			}
		});
	});
}
function onSaveNotificationSettings(){
	
}
</script>