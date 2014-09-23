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
					<a data-toggle="tab" href="#panel_projects">
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
									<h4><?php echo Yii::app()->session["user"]["firstName"]." ".Yii::app()->session["user"]["lastName"]?></h4>
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="user-image">
											<div class="fileupload-new thumbnail"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-1-xl.jpg" alt="">
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
				<div id="panel_edit_account" class="tab-pane fade">
					<form action="#" role="form" id="form">
						<div class="row">
							<div class="col-md-12">
								<h3>Account Info</h3>
								<hr>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										First Name
									</label>
									<input type="text" placeholder="Peter" class="form-control" id="firstname" name="firstname" value="<?php echo Yii::app()->session["user"]["firstName"]?>">
								</div>
								<div class="form-group">
									<label class="control-label">
										Last Name
									</label>
									<input type="text" placeholder="Clark" class="form-control" id="lastname" name="lastname" value="<?php echo Yii::app()->session["user"]["lastName"]?>">
								</div>
								<div class="form-group">
									<label class="control-label">
										Email Address
									</label>
									<input type="email" placeholder="peter@example.com" class="form-control" id="email" name="email">
								</div>
								<div class="form-group">
									<label class="control-label">
										Phone
									</label>
									<input type="email" placeholder="(641)-734-4763" class="form-control" id="phone" name="email">
								</div>
								<div class="form-group">
									<label class="control-label">
										Password
									</label>
									<input type="password" placeholder="password" class="form-control" name="password" id="password">
								</div>
								<div class="form-group">
									<label class="control-label">
										Confirm Password
									</label>
									<input type="password"  placeholder="password" class="form-control" id="password_again" name="password_again">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group connected-group">
									<label class="control-label">
										Date of Birth
									</label>
									<div class="row">
										<div class="col-md-3">
											<select name="dd" id="dd" class="form-control" >
												<option value="">DD</option>
												<option value="01">1</option>
												<option value="02">2</option>
												<option value="03">3</option>
												<option value="04">4</option>
												<option value="05">5</option>
												<option value="06">6</option>
												<option value="07">7</option>
												<option value="08">8</option>
												<option value="09">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21" selected="selected">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option>
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="31">31</option>
											</select>
										</div>
										<div class="col-md-3">
											<select name="mm" id="mm" class="form-control" >
												<option value="">MM</option>
												<option value="01">1</option>
												<option value="02">2</option>
												<option value="03">3</option>
												<option value="04">4</option>
												<option value="05">5</option>
												<option value="06">6</option>
												<option value="07">7</option>
												<option value="08">8</option>
												<option value="09">9</option>
												<option value="10" selected="selected">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
											</select>
										</div>
										<div class="col-md-3">
											<input type="text" placeholder="1982" id="yyyy" name="yyyy" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">
										Gender
									</label>
									<div>
										<label class="radio-inline">
											<input type="radio" class="grey" value="" name="gender" id="gender_female">
											Female
										</label>
										<label class="radio-inline">
											<input type="radio" class="grey" value="" name="gender"  id="gender_male" checked="checked">
											Male
										</label>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">
												Zip Code
											</label>
											<input class="form-control" placeholder="12345" type="text" name="zipcode" id="zipcode">
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<label class="control-label">
												City
											</label>
											<input class="form-control tooltips" placeholder="London (UK)" type="text" data-original-title="We'll display it when you write reviews" data-rel="tooltip"  title="" data-placement="top" name="city" id="city">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>
										Image Upload
									</label>
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-1-xl.jpg" alt="">
										</div>
										<div class="fileupload-preview fileupload-exists thumbnail"></div>
										<div class="user-edit-image-buttons">
											<span class="btn btn-azure btn-file"><span class="fileupload-new"><i class="fa fa-picture"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture"></i> Change</span>
												<input type="file">
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
								<h3>Additional Info</h3>
								<hr>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										Twitter
									</label>
									<span class="input-icon">
										<input class="form-control" type="text" placeholder="Text Field">
										<i class="fa fa-twitter"></i> </span>
								</div>
								<div class="form-group">
									<label class="control-label">
										Facebook
									</label>
									<span class="input-icon">
										<input class="form-control" type="text" placeholder="Text Field">
										<i class="fa fa-facebook"></i> </span>
								</div>
								<div class="form-group">
									<label class="control-label">
										Google Plus
									</label>
									<span class="input-icon">
										<input class="form-control" type="text" placeholder="Text Field">
										<i class="fa fa-google-plus"></i> </span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										Github
									</label>
									<span class="input-icon">
										<input class="form-control" type="text" placeholder="Text Field">
										<i class="fa fa-github"></i> </span>
								</div>
								<div class="form-group">
									<label class="control-label">
										Linkedin
									</label>
									<span class="input-icon">
										<input class="form-control" type="text" placeholder="Text Field">
										<i class="fa fa-linkedin"></i> </span>
								</div>
								<div class="form-group">
									<label class="control-label">
										Skype
									</label>
									<span class="input-icon">
										<input class="form-control" type="text" placeholder="Text Field">
										<i class="fa fa-skype"></i> </span>
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
							<div class="col-md-8">
								<p>
									By clicking UPDATE, you are agreeing to the Policy and Terms &amp; Conditions.
								</p>
							</div>
							<div class="col-md-4">
								<button class="btn btn-green btn-block" type="submit">
									Update <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
				<div id="panel_projects" class="tab-pane fade">
					<table class="table table-striped table-bordered table-hover" id="projects">
						<thead>
							<tr>
								<th class="center">
								<div class="checkbox-table">
									<label>
										<input type="checkbox" class="flat-grey selectall">
									</label>
								</div></th>
								<th>Project Name</th>
								<th class="hidden-xs">Client</th>
								<th>Proj Comp</th>
								<th class="hidden-xs">%Comp</th>
								<th class="hidden-xs center">Priority</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="center">
								<div class="checkbox-table">
									<label>
										<input type="checkbox" class="flat-grey foocheck">
									</label>
								</div></td>
								<td>IT Help Desk</td>
								<td class="hidden-xs">Master Company</td>
								<td>11 november 2014</td>
								<td class="hidden-xs">
								<div class="progress active progress-xs">
									<div style="width: 70%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar" class="progress-bar progress-bar-warning">
										<span class="sr-only"> 70% Complete (danger)</span>
									</div>
								</div></td>
								<td class="center hidden-xs"><span class="label label-danger">Critical</span></td>
								<td class="center">
								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
									<a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
								</div>
								<div class="visible-xs visible-sm hidden-md hidden-lg">
									<div class="btn-group">
										<a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
											<i class="fa fa-cog"></i> <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-edit"></i> Edit
												</a>
											</li>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-share"></i> Share
												</a>
											</li>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-times"></i> Remove
												</a>
											</li>
										</ul>
									</div>
								</div></td>
							</tr>
							<tr>
								<td class="center">
								<div class="checkbox-table">
									<label>
										<input type="checkbox" class="flat-grey foocheck">
									</label>
								</div></td>
								<td>PM New Product Dev</td>
								<td class="hidden-xs">Brand Company</td>
								<td>12 june 2014</td>
								<td class="hidden-xs">
								<div class="progress active progress-xs">
									<div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-info">
										<span class="sr-only"> 40% Complete</span>
									</div>
								</div></td>
								<td class="center hidden-xs"><span class="label label-warning">High</span></td>
								<td class="center">
								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
									<a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
								</div>
								<div class="visible-xs visible-sm hidden-md hidden-lg">
									<div class="btn-group">
										<a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
											<i class="fa fa-cog"></i> <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-edit"></i> Edit
												</a>
											</li>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-share"></i> Share
												</a>
											</li>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-times"></i> Remove
												</a>
											</li>
										</ul>
									</div>
								</div></td>
							</tr>
							<tr>
								<td class="center">
								<div class="checkbox-table">
									<label>
										<input type="checkbox" class="flat-grey foocheck">
									</label>
								</div></td>
								<td>ClipTheme Web Site</td>
								<td class="hidden-xs">Internal</td>
								<td>11 november 2014</td>
								<td class="hidden-xs">
								<div class="progress active progress-xs">
									<div style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" class="progress-bar progress-bar-success">
										<span class="sr-only"> 90% Complete</span>
									</div>
								</div></td>
								<td class="center hidden-xs"><span class="label label-success">Normal</span></td>
								<td class="center">
								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
									<a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
								</div>
								<div class="visible-xs visible-sm hidden-md hidden-lg">
									<div class="btn-group">
										<a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
											<i class="fa fa-cog"></i> <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-edit"></i> Edit
												</a>
											</li>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-share"></i> Share
												</a>
											</li>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-times"></i> Remove
												</a>
											</li>
										</ul>
									</div>
								</div></td>
							</tr>
							<tr>
								<td class="center">
								<div class="checkbox-table">
									<label>
										<input type="checkbox" class="flat-grey foocheck">
									</label>
								</div></td>
								<td>Local Ad</td>
								<td class="hidden-xs">UI Fab</td>
								<td>15 april 2014</td>
								<td class="hidden-xs">
								<div class="progress active progress-xs">
									<div style="width: 50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar" class="progress-bar progress-bar-warning">
										<span class="sr-only"> 50% Complete</span>
									</div>
								</div></td>
								<td class="center hidden-xs"><span class="label label-success">Normal</span></td>
								<td class="center">
								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
									<a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
								</div>
								<div class="visible-xs visible-sm hidden-md hidden-lg">
									<div class="btn-group">
										<a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
											<i class="fa fa-cog"></i> <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-edit"></i> Edit
												</a>
											</li>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-share"></i> Share
												</a>
											</li>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-times"></i> Remove
												</a>
											</li>
										</ul>
									</div>
								</div></td>
							</tr>
							<tr>
								<td class="center">
								<div class="checkbox-table">
									<label>
										<input type="checkbox" class="flat-grey foocheck">
									</label>
								</div></td>
								<td>Design new theme</td>
								<td class="hidden-xs">Internal</td>
								<td>2 october 2014</td>
								<td class="hidden-xs">
								<div class="progress active progress-xs">
									<div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-success">
										<span class="sr-only"> 20% Complete (warning)</span>
									</div>
								</div></td>
								<td class="center hidden-xs"><span class="label label-danger">Critical</span></td>
								<td class="center">
								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
									<a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
								</div>
								<div class="visible-xs visible-sm hidden-md hidden-lg">
									<div class="btn-group">
										<a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
											<i class="fa fa-cog"></i> <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-edit"></i> Edit
												</a>
											</li>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-share"></i> Share
												</a>
											</li>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-times"></i> Remove
												</a>
											</li>
										</ul>
									</div>
								</div></td>
							</tr>
							<tr>
								<td class="center">
								<div class="checkbox-table">
									<label>
										<input type="checkbox" class="flat-grey foocheck">
									</label>
								</div></td>
								<td>IT Help Desk</td>
								<td class="hidden-xs">Designer TM</td>
								<td>6 december 2014</td>
								<td class="hidden-xs">
								<div class="progress active progress-xs">
									<div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
										<span class="sr-only"> 40% Complete (warning)</span>
									</div>
								</div></td>
								<td class="center hidden-xs"><span class="label label-warning">High</span></td>
								<td class="center">
								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
									<a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
								</div>
								<div class="visible-xs visible-sm hidden-md hidden-lg">
									<div class="btn-group">
										<a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
											<i class="fa fa-cog"></i> <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-edit"></i> Edit
												</a>
											</li>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-share"></i> Share
												</a>
											</li>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="#">
													<i class="fa fa-times"></i> Remove
												</a>
											</li>
										</ul>
									</div>
								</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end: PAGE CONTENT-->


<script>
	jQuery(document).ready(function() {
		Main.init();
		SVExamples.init();
		PagesUserProfile.init();
	});
</script>