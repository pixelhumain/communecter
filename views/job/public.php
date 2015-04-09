<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/x-editable/css/bootstrap-editable.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '//assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '//assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css');
?>
<div class="row">
	<div class="col-sm-12">
		<div id="#panel_public" class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">Offer a <span class="text-bold">Job</span></h4>
				<div class="panel-tools">
					<div class="dropdown" style="display: inline-block;">
						<a class="btn btn-xs dropdown-toggle btn-transparent-grey" data-toggle="dropdown" aria-expanded="false">
							<i class="fa fa-cog"></i>
						</a>
						<ul role="menu" class="dropdown-menu dropdown-light pull-right" style="display: none;">
							<li>
								<a href="#" class="panel-collapse collapses"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
							</li>
							<li>
								<a href="#" class="panel-refresh">
									<i class="fa fa-refresh"></i> <span>Refresh</span>
								</a>
							</li>
							<li>
								<a data-toggle="modal" href="#panel-config" class="panel-config">
									<i class="fa fa-wrench"></i> <span>Configurations</span>
								</a>
							</li>
							<li>
								<a href="#" class="panel-expand">
									<i class="fa fa-expand"></i> <span>Fullscreen</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="panel-body" style="display: block;">
				<form class="form-horizontal" role="form">
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-white">
								<div class="panel-body">
									<div class="col-md-6"> 
										<div class="form-group">
											<label for="form-field-1" class="col-sm-3 control-label">Job Title</label>
											<div class="col-sm-9">
												<a href="#" id="jobTitle" data-inputclass="inputlong" data-type="text" data-original-title="Enter Job Title" class="editable-job editable editable-click">
													Job Title - un super boulot ! Y a pas de doute ! C'est génial !
												</a>
											</div>
										</div>
										<div class="form-group">
											<label for="form-field-2" class="col-sm-3 control-label">Postal Code</label>
											<div class="col-sm-9">
												<a href="#" id="jobTown" data-type="text" data-original-title="Enter Job Town" class="editable-job editable editable-click">
													Postal code
												</a>
											</div>
										</div>
										<div class="form-group">
											<label for="form-field-3" class="col-sm-3 control-label">Start Date</label>
											<div class="col-sm-9">
												<a href="#" id="jobStartDate" data-type="text" data-original-title="Enter Job Town" class="editable-job editable editable-click">
													Start Date
												</a>
											</div>
										</div>
									</div>
									<div class="col-md-6"> 
										<div class="form-group">
											<label for="form-field-4" class="col-sm-3 control-label">Hiring organization</label>
											<div class="col-sm-9">
												<a href="#" id="hiringOrganization" data-type="text" data-original-title="Enter Job Town" class="editable-job editable editable-click">
													Hiring Organization
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-white">
								<div class="panel-body">
									<div class="col-md-12"> 
										<div class="form-group">
											<label for="form-field-5" class="col-md-2 control-label">Function</label>
											<div class="col-md-4">
												<a href="#" id="jobFunction" data-type="text" data-original-title="Enter Job Function" class="editable-job editable editable-click">
													Job Function
												</a>
											</div>
											<label for="form-field-6" class="col-md-2 control-label">Education Requirements</label>
											<div class="col-md-4">
												<a href="#" id="educationRequirements" data-type="text" data-original-title="Enter Job Education Requirements" class="editable-job editable editable-click">
													Education Requirements
												</a>
											</div>
										</div>
										<div class="form-group">
											<label for="form-field-7" class="col-md-2 control-label">Job Location</label>
											<div class="col-md-4">
												<a href="#" id="jobLocation" data-type="text" data-original-title="Enter Job Location" class="editable-job editable editable-click">
													Job Location
												</a>
											</div>
											<label for="form-field-8" class="col-md-2 control-label">Work Hours</label>
											<div class="col-md-4">
												<a href="#" id="workHours" data-type="text" data-original-title="Enter Job Town" class="editable-job editable editable-click">
													Work Hours
												</a>
											</div>
										</div>
										<div class="form-group">
											<label for="form-field-9" class="col-md-2 control-label">Employment Type</label>
											<div class="col-md-4">
												<a href="#" id="employmentType" data-type="text" data-original-title="Enter Job Location" class="editable-job editable editable-click">
													Employment Type
												</a>
											</div>
											<label for="form-field-10" class="col-md-2 control-label">Base Salary</label>
											<div class="col-md-4">
												<a href="#" id="baseSalary" data-type="text" data-original-title="Enter Job Town" class="editable-job editable editable-click">
													Base Salary
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-white">
								<div class="panel-body">
									<div class="col-md-12"> 
										<div class="form-group">
											<label for="form-field-11" class="col-md-2 control-label">Description</label>
											<div class="col-md-10">
												<a href="#" id="description" data-type="wysihtml5" data-original-title="Enter Job Description" class="editable-job editable editable-click">
													<h1>Job Description</h1>
												</a>
											</div>
										</div>
										<div class="form-group">
											<label for="form-field-11" class="col-md-2 control-label">Qualifications</label>
											<div class="col-md-10">
												<a href="#" id="qualifications" data-type="wysihtml5" data-original-title="Enter Job Qualifications" class="editable-job editable editable-click">
													Job Qualifications
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="panel panel-white">	
	    					<button id="save-btn" class="btn btn-primary" style="display: inline-block;">Save new job!</button>
	    					<button id="reset-btn" class="btn pull-right">Reset</button>
	    				</div>
	    			</div>
    			</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var jobData = <?php echo json_encode($job)?>;

jQuery(document).ready(function() {
	activateEditable();
	debugMap.push(jobData);


});

function activateEditable() {
	$.fn.editable.defaults.mode = 'inline';
	
	$('.editable-job').editable({
    	url: baseUrl+"/"+moduleId+"/job/save", //this url will not be used for creating new user, it is only for update
    	onblur: 'submit'
	});

	//editables 
    $('#jobTitle').editable({
           url: '/post',
           type: 'text',
           name: 'jobTitle',
           title: 'Enter jobTitle'
    });
    $('#jobTown').editable({
           url: '/post',
           type: 'text',
           name: 'jobTown',
           title: 'Enter jobTown'
    });
    
    //Button Save
    $('#save-btn').click(function() {
	   	$('.editable-job').editable('submit', { 
	       url: baseUrl+"/"+moduleId+"/job/save", 
	       ajaxOptions: {
	           dataType: 'json' //assuming json response
	       },           
	       success: function(data, config) {
	           if(data && data.id) {  //record created, response like {"id": 2}
	               //set pk
	               $(this).editable('option', 'pk', data.id);
	               //remove unsaved class
	               $(this).removeClass('editable-unsaved');
	               //show messages
	               var msg = 'New user created! Now editables submit individually.';
	               $('#msg').addClass('alert-success').removeClass('alert-error').html(msg).show();
	               $('#save-btn').hide(); 
	               $(this).off('save.newuser');                     
	           } else if(data && data.errors){ 
	               //server-side validation error, response like {"errors": {"username": "username already exist"} }
	               config.error.call(this, data.errors);
	           }               
	       },
	       error: function(errors) {
	           var msg = '';
	           if(errors && errors.responseText) { //ajax error, errors = xhr object
	               msg = errors.responseText;
	           } else { //validation error (client-side or server-side)
	               $.each(errors, function(k, v) { msg += k+": "+v+"<br>"; });
	           } 
	           $('#msg').removeClass('alert-success').addClass('alert-error').html(msg).show();
	       }
	   });
	});

	//Button Reset
	$('#reset-btn').click(function() {
	    $('.editable-job').editable('setValue', null)  //clear values
	        .editable('option', 'pk', null)          //clear pk
	        .removeClass('editable-unsaved');        //remove bold css
	                   
	    $('#save-btn').show();
	    $('#msg').hide();                
	});
}

</script>