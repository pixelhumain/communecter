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
							<?php 
								//connected user isn't allready connected with page User
								if( Yii::app()->session['userId'] != (string)$person["_id"]) 
								{
									//if connected user and pageUser are allready connected
									if( Link::isConnected( Yii::app()->session['userId'] , PHType::TYPE_CITOYEN , (string)$person["_id"] , PHType::TYPE_CITOYEN ) ){  ?>
										<a href="javascript:;" class="disconnectBtn btn btn-red  pull-left  tooltips " data-placement="top" data-original-title="Remove this person as a relation" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
									<?php } else { ?>
										<a href="javascript:;" class="connectBtn btn btn-red  pull-left tooltips " data-placement="top" data-original-title="Connect to this person as a relation" ><i class=" connectBtnIcon fa fa-link"></i></a>
									<?php }
								} ?>
							<div class="user-left">
								<div class="center">
									<h4><?php //echo Yii::app()->session["user"]["name"]?></h4>
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div>
											<img class="img-circle" src="<?php if ($person && isset($person["imagePath"])) echo $person["imagePath"]; else echo Yii::app()->theme->baseUrl.'/assets/images/avatar-1-xl.jpg'; ?>" alt="">
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
											<td><?php if(isset($person["phoneNumber"]))echo $person["phoneNumber"];?></td>
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
												<?php if(isset($person["supervisor"]))echo $person["supervisor"];?>
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
											<td><?php if(isset($person["birth"]))echo $person["birth"];?></td>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var personData = <?php echo json_encode($person)?>;

jQuery(document).ready(function() {
	
	$(".disconnectBtn").off().on("click",function () {
        
        $(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/person/disconnect/id/<?php echo (string)$person['_id'] ?>/type/<?php echo PHType::TYPE_CITOYEN ?>",
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
	        url: baseUrl+"/"+moduleId+"/person/connect/id/<?php echo (string)$person['_id'] ?>/type/<?php echo PHType::TYPE_CITOYEN ?>",
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
	debugMap.push(personData);
});
</script>