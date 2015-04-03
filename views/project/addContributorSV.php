<style>

#newContributors{
	display: none;
}

</style>
<div id="newContributors">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h1>Add contributor</h1>
		<form class="form-contributor" autocomplete="off">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input class="contributor-id hide"  id="projectID" name="projectID" type="text">
						<select class="contributor-type" id="contributorType" name="contributorType">
		                    <option value="persons">People</option>
		                    <option value="organizations">Organisation</option>
		                </select>
						<input class="contributor-name form-control" name="contributorName" type="text" placeholder="name">
						<input class="contributor-email form-control" placeholder="Email" autocomplete = "off" id="contributorEmail" name="contributorEmail" value="">
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
					<button class="btn btn-info save-new-contributor" type="submit">
						Save
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
	 	bindprojectSubViewcontributor();
	 	runContributorFormValidation();
	 	$('#contributorEmail').keyup(function(e){
		    var email = $('#contributorEmail').val();
		    clearTimeout(timeout);
		    timeout = setTimeout('autoCompleteEmail("'+email+'")', 500);		
		});
		$('#contributorEmail').focusout(function(e){
			//$(".new-contributor #dropdown_city").css({"display" : "none" });
		});
	});

	function bindprojectSubViewcontributor() {	
		$(".new-contributor").off().on("click", function() {
			subViewElement = $(this);
			$(".form-contributor .contributor-id").val($(this).data("id"));
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

	function runContributorFormValidation(el) {
		var formProject = $('.form-contributor');
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
				contributorName : {
					minlength : 2,
					required : true
				},
				contributorType : {
					required : true
				},
				contributorEmail: {
					required : true
				}
			},
			messages : {
				contributorName : "* Please specify your first name",
				contributorType : "* Please select a type",
				contributorEmail : "* Please enter an email"

			},
			invalidHandler : function(contributor, validator) {//display error alert on form submit
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
				newProject.id = $(".form-contributor .contributor-id").val(),
				newProject.type = $(".form-contributor .contributor-type").val(),
				newProject.name = $(".form-contributor .contributor-name ").val(), 
				newProject.email = $('.form-contributor .contributor-email').val(), 
				
				$.blockUI({
					message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
		            '<blockquote>'+
		              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
		              '<cite title="Hegel">Hegel</cite>'+
		            '</blockquote> '
				});
				
				if ($(".form-contributor .contributor-id").val() !== "") {
					el = $(".form-contributor .contributor-id").val();

					//mockjax simulates an ajax call
					$.mockjax({
					url : '/contributor/edit/webservice',
					dataType : 'json',
					responseTime : 1000,
					responseText : {
						say : 'ok'
					}
				});


					$.ajax({
				        type: "POST",
				        url: baseUrl+"/"+moduleId+'/project/saveContributor',
				        dataType : "json",
				        data:newProject,
						type:"POST",
				    })
				    .done(function (data) 
				    {
				    	$.unblockUI();
				        if (data &&  data.result) {               
				        	toastr.success('Invatation to project success');
				        	$.hideSubview();
				        		
				        } else {
				           toastr.error('Something Went Wrong');
				        }
				    });

				}
			}
		});
	};

	// on hide contributor's form destroy summernote and bootstrapSwitch plugins
	function hideEditProject() {
		$.hideSubview();
	};
	// enables the edit form 
	function editProject(el) {
		$(".close-new-contributor").off().on("click", function() {
			$(".back-subviews").trigger("click");
		});
		$(".form-contributor .help-block").remove();
		$(".form-contributor .form-group").removeClass("has-error").removeClass("has-success");
	};
</script>