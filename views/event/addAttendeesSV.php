<style>

#newAttendees{
	display: none;
}

</style>
<div id="newAttendees">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h1>Add attendees</h1>
		<form class="form-attendees" autocomplete="off">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input class="attendees-id hide"  id="eventID" name="eventID" type="text">
						<select class="attendees-type" id="attendeesType" name="attendeesType">
		                    <option value="persons">People</option>
		                    <option value="organizations">Organisation</option>
		                </select>
						<input class="attendees-name form-control" name="attendeesName" type="text" placeholder="name">
						<input class="attendees-email form-control" placeholder="Email" autocomplete = "off" id="attendeesEmail" name="attendeesEmail" value="">
			        		<ul class="dropdown-menu" id="dropdown_email" style="">
								<li class="li-dropdown-scope">-</li>
							</ul>
						</input>
					</div>
				</div>
			<div class="pull-right">
				<div class="btn-group">
					<a href="#" class="btn btn-info close-subview-button">
						Close
					</a>
				</div>
				<div class="btn-group">
					<button class="btn btn-info save-new-attendees" type="submit">
						Save
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
	 	bindeventSubViewattendees();
	 	runAttendeesFormValidation();
	 	$('#attendeesEmail').keyup(function(e){
		    var email = $('#attendeesEmail').val();
		    clearTimeout(timeout);
		    timeout = setTimeout('autoCompleteEmail("'+email+'")', 500);		
		});
		$('#attendeesEmail').focusout(function(e){
			//$(".new-attendees #dropdown_city").css({"display" : "none" });
		});
	});

	function bindeventSubViewattendees() {	
		$(".new-attendees").off().on("click", function() {
			subViewElement = $(this);
			$(".form-attendees .attendees-id").val($(this).data("id"));
			subViewContent = subViewElement.attr('href');
			$.subview({
				content : subViewContent,
				onShow : function() {
					editProject();
				},
				onHide : function() {
					hideEditProject();
				},
				onSave: function() {
					hideEditProject();
				}
			});
		});

		$(".close-subview-button").off().on("click", function(e) {
			$(".close-subviews").trigger("click");
			e.prinviteDefault();
		});
	};

	var subViewElement, subViewContent, subViewIndex;
	var timeout;

	function runAttendeesFormValidation(el) {
		var formProject = $('.form-attendees');
		var errorHandler2 = $('.errorHandler', formProject);
		var successHandler2 = $('.successHandler', formProject);

		formProject.validate({
			errorElement : "span", // contain the error msg in a span tag
			errorClass : 'help-block',
			errorPlacement : function(error, element) {// render error placement for each input type
				if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
					error.insertAfter($(element).closest('.form-group').children('div').children().last());
				} else if (element.parent().hasClass("input-icon")) {

					error.insertAfter($(element).parent());
				} else {
					error.insertAfter(element);
					// for other inputs, just perform default behavior
				}
			},
			ignore : "",
			rules : {
				attendeesName : {
					minlength : 2,
					required : true
				},
				attendeesType : {
					required : true
				},
				attendeesEmail: {
					required : true
				}
			},
			messages : {
				attendeesName : "* Please specify your first name",
				attendeesType : "* Please select a type",
				attendeesEmail : "* Please enter an email"

			},
			invalidHandler : function(attendees, validator) {//display error alert on form submit
				successHandler2.hide();
				errorHandler2.show();
			},
			highlight : function(element) {
				$(element).closest('.help-block').removeClass('valid');
				// display OK icon
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
				// add the Bootstrap error class to the control group
			},
			unhighlight : function(element) {// revert the change done by hightlight
				$(element).closest('.form-group').removeClass('has-error');
				// set error class to the control group
			},
			success : function(label, element) {
				label.addClass('help-block valid');
				// mark the current input as valid and display OK icon
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
			},
			submitHandler : function(form) {
				successHandler2.show();
				errorHandler2.hide();
				newProject = new Object;
				newProject.id = $(".form-attendees .attendees-id").val(),
				newProject.type = $(".form-attendees .attendees-type").val(),
				newProject.name = $(".form-attendees .attendees-name ").val(), 
				newProject.email = $('.form-attendees .attendees-email').val(), 
				
				$.blockUI({
					message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
		            '<blockquote>'+
		              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
		              '<cite title="Hegel">Hegel</cite>'+
		            '</blockquote> '
				});
				
				if ($(".form-attendees .attendees-id").val() !== "") {
					el = $(".form-attendees .attendees-id").val();

					//mockjax simulates an ajax call
					$.mockjax({
					url : '/attendees/edit/webservice',
					dataType : 'json',
					responseTime : 1000,
					responseText : {
						say : 'ok'
					}
				});


					$.ajax({
				        type: "POST",
				        url: baseUrl+"/"+moduleId+'/event/saveAttendees',
				        dataType : "json",
				        data:newProject,
						type:"POST",
				    })
				    .done(function (data) 
				    {
				    	$.unblockUI();
				        if (data &&  data.result) {               
				        	toastr.success('Invatation to event success');
				        	$.hideSubview();
				        		
				        } else {
				           toastr.error('Something Went Wrong');
				        }
				    });

				}
			}
		});
	};

	// on hide attendees's form destroy summernote and bootstrapSwitch plugins
	function hideEditProject() {
		$.hideSubview();
	};
	// enables the edit form 
	function editProject(el) {
		$(".close-new-attendees").off().on("click", function() {
			$(".back-subviews").trigger("click");
		});
		$(".form-attendees .help-block").remove();
		$(".form-attendees .form-group").removeClass("has-error").removeClass("has-success");
	};
</script>