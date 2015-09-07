<div class="panel panel-white">
	<div class="panel-heading border-light">
		<span class="text-extra-large">Gamification : </span><span class="badge badge-warning text-extra-large">badge <?php echo Gamification::badge( Yii::app()->session['userId'] ) ?></span>
		<br/>Everything you do has an impact and gives you points
		<br/>You network is your value, your actions are recognized
	</div>
	<div class="panel-tools">
		<?php if( Yii::app()->session["userId"] ) { ?>
		<a href="javascript:;" onclick="openSubView('Add an Organisation', '/'+moduleId+'/organization/addorganizationform',null)" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Add an Organization"><i class="fa fa-plus"></i> <i class="fa fa-group"></i> </a>

		<a href="javascript:;" onclick="openSubView('Add an Organisation', '/'+moduleId+'/events/addeventform',null)" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Add an Event"><i class="fa fa-plus"></i> <i class="fa fa-calendar"></i></a>

		<a href="javascript:;" onclick="openSubView('Add an Organisation', '/'+moduleId+'/person/inviteSomeone',null)" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Invite Someone "><i class="fa fa-plus"></i> <i class="fa fa-user"></i></a>
		<?php } ?>

	</div>
	<div class="panel-body">
		<div>	
			<?php //var_dump($projects) ?>
			<table class="table table-striped table-bordered table-hover  directoryTable">
				<thead>
					<tr>
						<th>What</th>
						<th>Points</th>
					</tr>
				</thead>
				<tbody class="directoryLines">
					<tr>
						<td>Links with People (<?php echo Gamification::POINTS_LINK_USER_2_USER ?> pt per link) </td>
						<td><span class="badge badge-warning animated bounceIn"><?php echo Gamification::calcPoints( Yii::app()->session['userId'], Link::person2person ) ?></span></td>
					</tr>
					<tr>
						<td>Links with Organizations  (<?php echo Gamification::POINTS_LINK_USER_2_ORGANIZATION ?> pt per link)</td>
						<td><span class="badge badge-warning animated bounceIn"><?php echo Gamification::calcPoints( Yii::app()->session['userId'], Link::person2organization ) ?></span></td>
					</tr>
					<tr>
						<td>Links Events (<?php echo Gamification::POINTS_LINK_USER_2_EVENT ?> pts per link)</td>
						<td><span class="badge badge-warning animated bounceIn"><?php echo Gamification::calcPoints( Yii::app()->session['userId'], Link::person2events ) ?></span></td>
					</tr>
					<tr>
						<td>Links with Project (<?php echo Gamification::POINTS_LINK_USER_2_PROJECT ?> pts per link)</td>
						<td><span class="badge badge-warning animated bounceIn"><?php echo Gamification::calcPoints( Yii::app()->session['userId'], Link::person2projects ) ?></span></td>
					</tr>
					<tr>
						<td>Number of tags</td>
						<td><span class="badge badge-warning animated bounceIn"></span></td>
					</tr>
					<tr>
						<td>Number of scopes</td>
						<td><span class="badge badge-warning animated bounceIn"></span></td>
					</tr>
					<tr>
						<td>Number of actions (votes, brainstorms, discussions)</td>
						<td><span class="badge badge-warning animated bounceIn"></span></td>
					</tr>
					<tr>
						<td>Number of contributions (comments, news posts)</td>
						<td><span class="badge badge-warning animated bounceIn"></span></td>
					</tr>
					<tr>
						<td>Number of populare posts</td>
						<td><span class="badge badge-warning animated bounceIn"></span></td>
					</tr>
					<tr>
						<td>Number of contributed urls</td>
						<td><span class="badge badge-warning animated bounceIn"></span></td>
					</tr>
					<tr>
						<td>Number of created Organization</td>
						<td><span class="badge badge-warning animated bounceIn"></span></td>
					</tr>
					<tr>
						<td>Number of created Events</td>
						<td><span class="badge badge-warning animated bounceIn"></span></td>
					</tr>
					<tr>
						<td>Number of created Projects</td>
						<td><span class="badge badge-warning animated bounceIn"></span></td>
					</tr>
					<tr>
						<td>Number of followers</td>
						<td><span class="badge badge-warning animated bounceIn"></span></td>
					</tr>
					
				</tbody>
			</table>

		</div>
	</div>
</div>
