<?php  

$cssAnsScriptFiles = array(
	//X-editable
	'/assets/plugins/x-editable/css/bootstrap-editable.css',
	'/assets/plugins/x-editable/js/bootstrap-editable.js',
	//wysihtml
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css',
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css',
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js',
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js',
	'/assets/plugins/wysihtml5/wysihtml5.js',
	//date picker
	'/assets/plugins/bootstrap-datepicker/css/datepicker.css',
	'/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles);
?>

<div class="row">
	<div class="col-sm-12">
		<div id="#panel_public" class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">Offer a <span class="text-bold">Job</span></h4>
			</div>
			<div class="panel-body" style="display: block;">				
				<form class="form-horizontal" role="form">
					<div id="msg" class="alert alert-error" style="display: block;"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-white">
								<div class="panel-body">
									<div class="col-md-6"> 
										<div class="form-group">
											<label for="form-field-1" class="col-sm-3 control-label">Job Title</label>
											<div class="col-sm-9">
												<a href="#" id="title" data-type="text" data-original-title="Enter Job Title" class="editable-job editable editable-click">
													<?php echo isset($job["title"]) ? $job["title"] : "" ?>
												</a>
											</div>
										</div>
										<div class="form-group">
											<label for="form-field-2" class="col-sm-3 control-label">Postal Code</label>
											<div class="col-sm-9">
												<a href="#" id="postalCode" data-type="text" data-original-title="Enter Job Postal Code" class="editable-job editable editable-click">
													<?php 
														if (isset($job["jobLocation"]) && isset($job["jobLocation"]["address"]) 
															&& isset($job["jobLocation"]["address"]["postalCode"])) {
															echo $job["jobLocation"]["address"]["postalCode"];
														} else {
															echo "";
														}
													?>
												</a>
											</div>
										</div>
										<div class="form-group">
											<label for="form-field-3" class="col-sm-3 control-label">Start Date</label>
											<div class="col-sm-9">
												<a href="#" id="startDate" data-type="date" data-title="Enter Start Date" class="editable editable-click">
													<?php echo isset($job["startDate"]) ? $job["startDate"] : "Enter Start Date" ?>
												</a>
											</div>
										</div>
									</div>
									<div class="col-md-6"> 
										<div class="form-group">
											<label for="form-field-4" class="col-sm-3 control-label">Hiring organization</label>
											<div class="col-sm-9">
												<a href="#" id="hiringOrganization" data-type="select2" data-original-title="Enter Job Town" class="editable editable-click">
													<?php echo (isset($job["hiringOrganization"]) && isset($job["hiringOrganization"]["name"]))  ? $job["hiringOrganization"]["name"] : "" ?>
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
											<label for="form-field-5" class="col-md-2 control-label">Responsibilities</label>
											<div class="col-md-4">
												<a href="#" id="responsibilities" data-type="textarea" data-original-title="Enter Job Responsibilities" class="editable-job editable editable-click">
													<?php echo isset($job["responsibilities"]) ? $job["responsibilities"] : "" ?>
												</a>
											</div>
											<label for="form-field-6" class="col-md-2 control-label">Education Requirements</label>
											<div class="col-md-4">
												<a href="#" id="educationRequirements" data-type="textarea" data-original-title="Enter Job Education Requirements" class="editable-job editable editable-click">
													<?php echo isset($job["educationRequirements"]) ? $job["educationRequirements"] : "" ?>
												</a>
											</div>
										</div>
										<div class="form-group">
											<label for="form-field-7" class="col-md-2 control-label">Job Location details</label>
											<div class="col-md-4">
												<a href="#" id="jobLoc" data-type="text" data-original-title="Enter Job Location" class="editable-job editable editable-click">
													<?php echo (isset($job["jobLocation"]) && isset($job["jobLocation"]["description"]))  ? $job["jobLocation"]["description"] : "" ?>
												</a>
											</div>
											<label for="form-field-8" class="col-md-2 control-label">Work Hours</label>
											<div class="col-md-4">
												<a href="#" id="workHours" data-type="text" data-original-title="Enter Work Hour" class="editable-job editable editable-click">
													<?php echo isset($job["workHours"]) ? $job["workHours"] : "" ?>
												</a>
											</div>
										</div>
										<div class="form-group">
											<label for="form-field-9" class="col-md-2 control-label">Employment Type</label>
											<div class="col-md-4">
												<a href="#" id="employmentType" data-type="text" data-original-title="Enter Employment Type" class="editable-job editable editable-click">
													<?php echo isset($job["employmentType"]) ? $job["employmentType"] : "" ?>
												</a>
											</div>
											<label for="form-field-10" class="col-md-2 control-label">Base Salary</label>
											<div class="col-md-4">
												<a href="#" id="baseSalary" data-type="text" data-original-title="Enter Base Salary" class="editable-job editable editable-click">
													<?php echo isset($job["baseSalary"]) ? $job["baseSalary"] : "" ?>
												</a>
											</div>
										</div>
										<div class="form-group">
											<label for="form-field-9" class="col-md-2 control-label">Tags</label>
											<div class="col-md-4">
												<a href="#" id="tagsJob" name="tagsJob" data-type="select2" data-original-title="Enter Tags" class="editable editable-click">
													<?php echo isset($job["tags"]) ? implode(",", $job['tags']) : "" ?>
												</a>
											</div>
											<div class="col-md-6">
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
													<?php echo isset($job["description"]) ? $job["description"] : "" ?>
												</a>
											</div>
										</div>
										<div class="form-group">
											<label for="form-field-11" class="col-md-2 control-label">Qualifications</label>
											<div class="col-md-10">
												<a href="#" id="qualifications" data-type="wysihtml5" data-original-title="Enter Job Qualifications" class="editable-job editable editable-click">
													<?php echo isset($job["qualifications"]) ? $job["qualifications"] : "" ?>
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
var jobId = "<?php echo isset($job["_id"]) ? $job["_id"] : ""; ?>";

//By default : view mode
//TODO SBAR - Get the mode from the request ?
var mode = "<?php echo $mode ?>";

jQuery(document).ready(function() {
	//initLocation();
	activateEditable();
	manageMode();
	debugMap.push(jobData);
});

function manageMode() {
	if (mode == "view") {
		$('.editable-job').editable('toggleDisabled');
		$('#startDate').editable('toggleDisabled');
		$('#tagsJob').editable('toggleDisabled');
		$('#hiringOrganization').editable('toggleDisabled');
		$('#save-btn').hide();
		$('#reset-btn').hide();
	} else if (mode == "update") {
		// Add a pk to make the update process available on X-Editable
		$('.editable-job').editable('option', 'pk', jobId);
		$('#startDate').editable('option', 'pk', jobId);
		$('#tagsJob').editable('option', 'pk', jobId);
		$('#hiringOrganization').editable('option', 'pk', jobId);
		//Hide the button
		$('#save-btn').hide();
		$('#reset-btn').hide();
	} else if (mode == "insert") {
		$('#save-btn').show();
		$('#reset-btn').show();
	}
}

function activateEditable() {
	$.fn.editable.defaults.mode = 'inline';

	//enable / disable
	$('.editJobBtn').click(function() {
		if ($('.editJobBtn').text() == "Edit Job") {
			mode = "updateMode";
			console.log("update Mode");
			manageMode();
		} else {
			mode = "viewMode";
			console.log("View Mode");
			manageMode();
		}
	});  

	$('.editable-job').editable({
    	url: baseUrl+"/"+moduleId+"/job/save", //this url will not be used for creating new job, it is only for update
    	onblur: 'submit',
    	showbuttons: false
	});

    //make jobTitle required
	$('#title').editable('option', 'validate', function(v) {
    	console.log("Title Mandatory");
    	if(!v) return 'Required field!';
	});

	//Select2 tags
    $('#tagsJob').editable({
        url: baseUrl+"/"+moduleId+"/job/save", //this url will not be used for creating new user, it is only for update
        mode: 'inline',
        showbuttons: false,
        select2: {
            tags: <?php echo $tags?>,
            tokenSeparators: [",", " "]
        }
    }); 

	//Pb with datepicker on inline mode : declare a differente X-editable form on popup mode.
	$('#startDate').editable({
		url: baseUrl+"/"+moduleId+"/job/save", //this url will not be used for creating new user, it is only for update
		mode: "popup",
        format: 'dd/mm/yyyy',    
        viewformat: 'dd/mm/yyyy',
        showbuttons: false,    
        datepicker: {
                weekStart: 1
           }
        }
    );

    var organizations = [];
    $.each({
    	<?php 
    		foreach ($organizations as $keyOrganization => $valueOrganization) {
    			echo "'".$keyOrganization."' : '".$valueOrganization["name"]."', ";
    		}
    	?>
    }, function(k, v) {
        organizations.push({id: k, text: v});
    }); 
    $('#hiringOrganization').editable({
		url: baseUrl+"/"+moduleId+"/job/save", //this url will not be used for creating new user, it is only for update
		mode: "inline",
		showbuttons: false,
		source: organizations,
        select2: {
            width: 200
        } 
    });
    //make jobTitle required
	$('#hiringOrganization').editable('option', 'validate', function(v) {
    	if(!v) return 'Required field!';
	});
    
    //Button Save
    $('#save-btn').click(function() {
	   	$('.editable').editable('submit', {
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
	               var msg = 'New job created!';
	               $('#msg').addClass('alert-success').removeClass('alert-error').html(msg).show();
	               $('#save-btn').hide(); 
	               console.log("data.job => "+data.job);
	               if(updateJob != undefined && typeof updateJob == "function")
		        			updateJob( data.job,  data.id);
	               $.hideSubview();
	           } else if(data && data.errors){ 
	               //server-side validation error, response like {"errors": {"username": "username already exist"} }
	               config.error.call(this, data.errors);
	           }               
	       },
	       error: function(errors) {
	           console.log("Bing y a une erreur !");
	           var msg = '';
	           if(errors && errors.responseText) { //ajax error, errors = xhr object
	               msg = errors.responseText;
	           } else { //validation error (client-side or server-side)
	               $.each(errors, function(k, v) { msg += k+": "+v+"<br>"; });
	           } 
	           $('#msg').removeClass('alert-success').addClass('alert-error').html(msg).show();
	           console.log("Le msg : "+msg);
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