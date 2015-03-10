<div class="row">
	<div class="col-sm-12">
		<div class="tabbable">
			<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
				<li class="active">
					<a data-toggle="tab" href="#panel_public">
						Public Information
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="#panel_public" class="tab-pane fade in active">
					<div class="row">
						<div class="col-sm-5 col-md-4">
							<div class="user-left">
								<div class="center">
									<?php 
									//connected user isn't allready connected with page User
									if( Yii::app()->session['userId'] != (string)$organization["_id"]) 
									{
										//if connected user and pageUser are allready connected
										if( Link::isConnected( Yii::app()->session['userId'] , PHType::TYPE_CITOYEN , (string)$organization["_id"] , PHType::TYPE_ORGANIZATIONS ) ){  ?>
											<a href="javascript:;" class="disconnectBtn btn btn-red  pull-left  tooltips " data-placement="top" data-original-title="Remove this Organization Link" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
										<?php } else { ?>
											<a href="javascript:;" class="connectBtn btn btn-red  pull-left tooltips " data-placement="top" data-original-title="Connect to this Organization" ><i class=" connectBtnIcon fa fa-link"></i></a>
										<?php }
									} ?>
									<h4><?php echo $organization["name"]?></h4>
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="user-image">
											<div class="fileupload-new thumbnail"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/organization.PNG" alt="">
											</div>
											<div class="fileupload-preview fileupload-exists thumbnail"></div>
											<div class="user-image-buttons">
												<span class="btn btn-azure btn-file btn-sm"><span class="fileupload-new"><i class="fa fa-pencil"></i></span><span class="fileupload-exists"><i class="fa fa-pencil"></i></span>
													<input type="file">
												</span>
												<a href="#" class="btn fileupload-exists btn-red btn-sm" data-dismiss="fileupload">
													<i class="fa fa-times"></i>
												</a>
											</div>
										</div>
									</div>
									<hr>
									<div class="social-icons block">
										<ul>
											<li data-placement="top" data-original-title="Twitter" class="social-twitter tooltips">
												<a href="http://www.twitter.com" target="_blank">
													Twitter
												</a>
											</li>
											<li data-placement="top" data-original-title="Facebook" class="social-facebook tooltips">
												<a href="http://facebook.com" target="_blank">
													Facebook
												</a>
											</li>
											<li data-placement="top" data-original-title="Google" class="social-google tooltips">
												<a href="http://google.com" target="_blank">
													Google+
												</a>
											</li>
											<li data-placement="top" data-original-title="LinkedIn" class="social-linkedin tooltips">
												<a href="http://linkedin.com" target="_blank">
													LinkedIn
												</a>
											</li>
											<li data-placement="top" data-original-title="Github" class="social-github tooltips">
												<a href="#" target="_blank">
													Github
												</a>
											</li>
										</ul>
									</div>
									<hr>
								</div>
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th colspan="3">Contact Information</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>url</td>
											<td>
											<a href="#">
												www.example.com
											</a></td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>email:</td>
											<td>
											<a href="">
												peter@example.com
											</a></td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>phone:</td>
											<td>(641)-734-4763</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>skye</td>
											<td>
											<a href="">
												peterclark82
											</a></td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th colspan="3">General information</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Position</td>
											<td>UI Designer</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Last Logged In</td>
											<td>56 min</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Position</td>
											<td>Senior Marketing Manager</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Supervisor</td>
											<td>
											<a href="#">
												Kenneth Ross
											</a></td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Status</td>
											<td><span class="label label-sm label-info">Administrator</span></td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th colspan="3">Additional information</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Birth</td>
											<td>21 October 1982</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Groups</td>
											<td>New company web site development, HR Management</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-sm-7 col-md-8">
							<p>
								<?php if(isset($organization["description"]))echo $organization["description"]?>
							</p>
							<div class="row space20">
								<div class="col-sm-3">
									<button class="btn btn-icon btn-block">
										<i class="clip-clip"></i>
										Projects <span class="badge badge-info"> 4 </span>
									</button>
								</div>
								<div class="col-sm-3">
									<button class="btn btn-icon btn-block pulsate">
										<i class="clip-bubble-2"></i>
										Messages <span class="badge badge-info"> 23 </span>
									</button>
								</div>
								<div class="col-sm-3">
									<button class="btn btn-icon btn-block">
										<i class="clip-calendar"></i>
										Calendar <span class="badge badge-info"> 5 </span>
									</button>
								</div>
								<div class="col-sm-3">
									<button class="btn btn-icon btn-block">
										<i class="clip-list-3"></i>
										Notifications <span class="badge badge-info"> 9 </span>
									</button>
								</div>
							</div>
							<div class="panel panel-white space20">
								<div class="panel-heading">
									<i class="clip-menu"></i>
									Recent Activities
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
								<div class="panel-body panel-scroll height-300">
									<ul class="activities">
										<li>
											<a class="activity" href="javascript:void(0)">
												<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-blue"></i> <i class="fa fa-code fa-stack-1x fa-inverse"></i> </span> <span class="desc">You uploaded a new release.</span>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													2 hours ago
												</div>
											</a>
										</li>
										<li>
											<a class="activity" href="javascript:void(0)">
												<img alt="image" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-2.jpg"> <span class="desc">Nicole Bell sent you a message.</span>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													3 hours ago
												</div>
											</a>
										</li>
										<li>
											<a class="activity" href="javascript:void(0)">
												<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-orange"></i> <i class="fa fa-database fa-stack-1x fa-inverse"></i> </span> <span class="desc">DataBase Migration.</span>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													5 hours ago
												</div>
											</a>
										</li>
										<li>
											<a class="activity" href="javascript:void(0)">
												<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-yellow"></i> <i class="fa fa-calendar-o fa-stack-1x fa-inverse"></i> </span> <span class="desc">You added a new event to the calendar.</span>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													8 hours ago
												</div>
											</a>
										</li>
										<li>
											<a class="activity" href="javascript:void(0)">
												<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-green"></i> <i class="fa fa-file-image-o fa-stack-1x fa-inverse"></i> </span> <span class="desc">Kenneth Ross uploaded new images.</span>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													9 hours ago
												</div>
											</a>
										</li>
										<li>
											<a class="activity" href="javascript:void(0)">
												<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-green"></i> <i class="fa fa-file-image-o fa-stack-1x fa-inverse"></i> </span> <span class="desc">Peter Clark uploaded a new image.</span>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													12 hours ago
												</div>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="panel panel-white space20">
								<div class="panel-heading">
									<i class="clip-checkmark-2"></i>
									To Do
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
								<div class="panel-body panel-scroll height-300">
									<ul class="todo">
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i> <span class="desc">Staff Meeting</span> <span class="label label-danger"> today</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i> <span class="desc"> New frontend layout</span> <span class="label label-danger"> today</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i> <span class="desc"> Hire developers</span> <span class="label label-warning"> tommorow</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i> <span class="desc">Staff Meeting</span> <span class="label label-warning"> tommorow</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i> <span class="desc"> New frontend layout</span> <span class="label label-success"> this week</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i> <span class="desc"> Hire developers</span> <span class="label label-success"> this week</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i> <span class="desc"> New frontend layout</span> <span class="label label-info"> this month</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i> <span class="desc"> Hire developers</span> <span class="label label-info"> this month</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i> <span class="desc">Staff Meeting</span> <span class="label label-danger"> today</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i> <span class="desc"> New frontend layout</span> <span class="label label-danger"> today</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i> <span class="desc"> Hire developers</span> <span class="label label-warning"> tommorow</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var organizationData = <?php echo json_encode($organization)?>;
debugMap.push(organizationData);
jQuery(document).ready(function() {
	
	$(".disconnectBtn").off().on("click",function () {
        
        $(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/person/disconnect/id/<?php echo (string)$organization['_id'] ?>/type/<?php echo PHType::TYPE_ORGANIZATIONS ?>",
	        dataType : "json"
	    })
	    .done(function (data) 
	    {
	        if ( data && data.result ) {               
	        	toastr.info("I don't know this guy any longer!!");
	        	$(".disconnectBtn").fadeOut();
	        } else {
	           toastr.info("something went wrong!! please try again.");
	           $(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
	        }
	    });
	});

	$(".connectBtn").off().on("click",function () {
		$(".connectBtnIcon").removeClass("fa-link").addClass("fa-spinner fa-spin");
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/person/connect/id/<?php echo (string)$organization['_id'] ?>/type/<?php echo PHType::TYPE_ORGANIZATIONS ?>",
	        dataType : "json"
	    })
	    .done(function (data)
	    {
	        if ( data && data.result ) {               
	        	toastr.info("added this guy to my knows connections");
	        	$(".connectBtn").fadeOut();
	        } else {
	           toastr.info("something went wrong!! please try again.");
	           $(".connectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-link");
	        }
	    });
        
	});
	
});
</script>