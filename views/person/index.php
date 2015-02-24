<?php
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.pulsate/jquery.pulsate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/pages-user-profile.js' , CClientScript::POS_END);
?>
<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-sm-12">
		<div class="tabbable">
			<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
				<li class="active">
					<a data-toggle="tab" href="#panel_overview">
						Overview
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#panel_edit_account">
						Edit Account
					</a>
				</li>
				
				<li>
					<a data-toggle="tab" href="#panel_organisations">
						Organizations
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#panel_organisations">
						Events
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#panel_organisations">
						Projects
					</a>
				</li>

				
			</ul>
			<div class="tab-content">
				<div id="panel_overview" class="tab-pane fade in active">
					<div class="row">
						<div class="col-sm-5 col-md-4">
							<div class="user-left">
								<div class="center">
									<h4><?php //echo Yii::app()->session["user"]["name"]?></h4>
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="user-image">
											<div class="fileupload-new thumbnail"><img src="<?php if ($person && isset($person["imagePath"])) echo $person["imagePath"]; else echo Yii::app()->theme->baseUrl.'/assets/images/avatar-1-xl.jpg'; ?>" alt="">
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
											<td><a href="#"><?php if(isset($person["url"]))echo $person["url"];?></a></td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>email:</td>
											<td><a href=""><?php echo Yii::app()->session["userEmail"];?></a></td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>phone:</td>
											<td><?php if(isset($person["telephone"]))echo $person["telephone"];?></td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>skype</td>
											<td><?php if(isset($person["skype"]))echo $person["skype"];?></td>
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
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas convallis porta purus, pulvinar mattis nulla tempus ut. Curabitur quis dui orci. Ut nisi dolor, dignissim a aliquet quis, vulputate id dui. Proin ultrices ultrices ligula, dictum varius turpis faucibus non. Curabitur faucibus ultrices nunc, nec aliquet leo tempor cursus.
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
				<div id="panel_edit_account" class="tab-pane fade" >
					<form action="#" role="form" id="personForm" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-12">
								<h3>Account Info</h3>
								<hr>
							</div>
							<div class="col-md-6 col-ld-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="control-label">
										First Name
									</label>
									<input type="text" placeholder="Peter" class="form-control" id="name" name="name" value="<?php if(isset($person["name"]))echo $person["name"];?>">
								</div>
								<div class="form-group">
									<label class="control-label">
										Email Address
									</label>
									<input type="email" placeholder="peter@example.com" class="form-control" id="email" name="email" value="<?php echo Yii::app()->session["userEmail"];?>">
								</div>
								<div class="form-group">
									<label class="control-label">
										Tags
									</label>
									
									<input id="tags" name="tags" value="<?php echo ($person && isset($person['tags']) ) ?  $person['tags'] : ""?>" style="display: block;">
								</div>
							</div>
							<div class="col-md-6 col-ld-6 col-sm-6 col-xs-12 ">
								
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">
												Postal Code
											</label>
											<input class="form-control" placeholder="12345" type="text" name="postalCode" id="postalCode"  value="<?php if(isset($person["cp"]))echo $person["cp"];?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">
												City
											</label>
											<select name="city" id="city" class="form-control">
												<option></option>
												<?php 
												foreach (OpenData::$commune["974"] as $key => $value) 
												{
												?>
												<option value="<?php echo $value?>" <?php if(($person && isset($person['city']) && $value == $person['city']) ) echo "selected"; ?> ><?php echo $value?></option>
												<?php 
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">
												Country
											</label>
											<select name="country" id="country" class="form-control">
												<option></option>
												<?php 
												foreach (OpenData::$phCountries as $key => $value) 
												{
												?>
												<option value="<?php echo $key?>" <?php if(($person && isset($person["address"]["addressLocality"]) && $key == $person["address"]["addressLocality"]) ) echo "selected";  ?> ><?php echo $key?></option>
												<?php 
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>
										Image Upload
									</label>
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail">
											
											<img src="<?php if ($person && isset($person["imagePath"])) echo $person["imagePath"]; else echo Yii::app()->theme->baseUrl.'/assets/images/avatar-1-xl.jpg' ?>" alt="">
											
										</div>
										<div class="fileupload-preview fileupload-exists thumbnail"></div>
										<div class="user-edit-image-buttons">
											<span class="btn btn-azure btn-file"><span class="fileupload-new"><i class="fa fa-picture"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture"></i> Change</span>
												<input type="file" name="avatar" id="avatar">
											</span>
											<a href="#" class="btn fileupload-exists btn-red" data-dismiss="fileupload">
												<i class="fa fa-times"></i> Remove
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div>
									Required Fields
									<hr>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8  col-xs-12">
								<p>
									By clicking UPDATE, you are agreeing to the Policy and Terms &amp; Conditions.
								</p>
							</div>
							<div class="col-sm-4  col-xs-12">
								<button class="btn btn-green btn-block" type="submit">
									Update <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</div>
					</form>
				</div>

				<div id="panel_organisations" class="tab-pane fade">
					<table class="table table-striped table-bordered table-hover" id="projects">
						<thead>
							<tr>
								<th>Name</th>
								<th class="hidden-xs">Type</th>
								<th class="hidden-xs center">Tags</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(isset($organizations)){
							foreach ($organizations as $e) 
							{
							?>
							<tr id="organisation<?php echo (string)$e["_id"];?>">
								<td><?php if(isset($e["name"]))echo $e["name"]?></td>
								<td><?php if(isset($e["type"]))echo $e["type"]?></td>
								<td><?php if(isset($e["tags"]))echo implode(",", $e["tags"])?></td>
								<td class="center">
								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/view/id/'.$e["_id"]);?>" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
									<a href="#" class="btn btn-red tooltips delBtn" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
								</div>
								</td>
							</tr>
							<?php
							}}
							?>
						</tbody>
					</table>
				</div>

				<div id="panel_events" class="tab-pane fade">
					<table class="table table-striped table-bordered table-hover" id="projects">
						<thead>
							<tr>
								<th>Name</th>
								<th class="hidden-xs">Type</th>
								<th class="hidden-xs center">Tags</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(isset($organizations)){
							foreach ($organizations as $e) 
							{
							?>
							<tr id="organisation<?php echo (string)$e["_id"];?>">
								<td><?php if(isset($e["name"]))echo $e["name"]?></td>
								<td><?php if(isset($e["type"]))echo $e["type"]?></td>
								<td><?php if(isset($e["tags"]))echo implode(",", $e["tags"])?></td>
								<td class="center">
								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/view/id/'.$e["_id"]);?>" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
									<a href="#" class="btn btn-red tooltips delBtn" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
								</div>
								</td>
							</tr>
							<?php
							}}
							?>
						</tbody>
					</table>
				</div>

				<div id="panel_projects" class="tab-pane fade">
					<table class="table table-striped table-bordered table-hover" id="projects">
						<thead>
							<tr>
								<th>Name</th>
								<th class="hidden-xs">Type</th>
								<th class="hidden-xs center">Tags</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(isset($organizations)){
							foreach ($organizations as $e) 
							{
							?>
							<tr id="organisation<?php echo (string)$e["_id"];?>">
								<td><?php if(isset($e["name"]))echo $e["name"]?></td>
								<td><?php if(isset($e["type"]))echo $e["type"]?></td>
								<td><?php if(isset($e["tags"]))echo implode(",", $e["tags"])?></td>
								<td class="center">
								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/view/id/'.$e["_id"]);?>" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
									<a href="#" class="btn btn-red tooltips delBtn" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
								</div>
								</td>
							</tr>
							<?php
							}}
							?>
						</tbody>
					</table>
				</div>

			</div>
		</div>
<div class="row">
	<div class="col-md-12 padding-20">
		<a href="javascript:;" onclick="openSubView('Add an Organisation', '/communecter/organization/form',null)" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-plus"></i> Add an Organization</a>
		<a href="javascript:;" onclick="openSubView('Invite Someone', '/communecter/person/invite',null)" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-plus"></i> Invite Someone</a>
	</div>	
</div>
	</div>
</div>

<!-- end: PAGE CONTENT-->
<script>
jQuery(document).ready(function() {

	$('#tags').select2({ tags: <?php echo $tags ?> });
	$('#tags').select2({ tags: <?php echo $tags ?> });
	PagesUserProfile.init();

});

$(".delBtn").on("click",function(){
	id = $(this).data("id");

	bootbox.confirm("Are you sure you want to delete "+$(this).data("name")+" organization ?", function(result) {
		if(result)
		{
			testitpost(null , baseUrl+"/"+moduleId+"/organization/delete",{"id":id},
				function(data,id){
					if(data.result){
						toastr.success("delete successfull ");
						$('organisation'+$(this).data("id")).remove();
						var tr = $(this).closest('tr');
				        tr.css("background-color","#FF3700");
				        tr.fadeOut(400, function(){
				            tr.remove();
				        });
				        return false;
					}
					else 
						toastr.error(data.msg);
				});
		}
	});
});

$("#personForm").submit( function(event){	
	event.preventDefault();
	var formData = $(this).serialize();//new FormData($(this)[0]);

	console.log(formData);

	$.ajax({
	  type: "POST",
	  url: baseUrl+"/"+moduleId+"/api/saveUser",
	  data: $(this).serialize(),
	  contentType: false,
	  processData : false,
	  success: function(data){
	  		if(data.result)
	  			toastr.success(data.msg);
	  		else
	  			toastr.error(data.msg);
	  },
	  dataType: "json"
	});
});
</script>