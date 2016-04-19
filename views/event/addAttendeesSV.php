<?php
if(@$event) {
	Menu::event($event);
	$this->renderPartial('../default/panels/toolbar'); 
}
?>
<style>
#step3{
	display:none;
}
</style>
<div id="newAttendees">
	<div class="space20"></div>
		<h2 class='radius-10 padding-10 partition-blue text-bold'> <?php echo Yii::t("event","Add an attendee",null,Yii::app()->controller->module->id); ?></h2>
	<div class="col-md-6 col-md-offset-3">  
       	<div class="panel panel-white">
        	<div class="panel-heading border-light">
			</div>
		<div class="panel-body">
			<form class="form-attendees" autocomplete="off">
				<input class="attendees-parentId hide"  id="attendeesParentId" name="attendeesParentId" value="<?php echo $id ?>" type="text"/>
				<input class="attendees-id hide" id = "attendeesId" name="attendeesId" value="" type="text"/>
				<div class="row" id="step1">
					<div class="col-md-1">	
		           		<i class="fa fa-search fa-2x"></i> 
		           	</div>
					<div class="col-md-10">
						<div class="form-group">
							<input class="attendees-search form-control" placeholder="<?php echo Yii::t("common","Search by name or email") ?>" autocomplete = "off" id="attendeesSearch" name="attendeesSearch" value="">
				        		<ul class="dropdown-menu" id="dropdown_search" style="">
									<li class="li-dropdown-scope">-</li>
								</ul>
							</input>
						</div>
					</div>
				</div>
				<!--<div class="row" id="step2">
					<div class="form-group" id="ficheUser">
						<div class="col-md-7">
							//Laisser le bouton Add me as attendee (Ergonomique)
							<a href="javascript:;" data-id = '' class="connectAttendeesBtn btn btn-lg btn-light-blue tooltips " data-placement="top" data-original-title="Add me as attendee" ><i class=" connectBtnIcon fa fa-link "></i> <?php echo Yii::t("event","Add me as attendee",null,Yii::app()->controller->module->id); ?> </a>
							<hr>
							<?php echo Yii::t("common", "Name") ?> : <p id="ficheName" name="ficheName"></p><br>
							<?php echo Yii::t("common","Birth date") ?> : <p id="birth" name="birth" ></p><br>
							Tags : <p id="tags" name="tags" ></p><br>
						</div>
					</div>
				</div>-->
				<div class="row" id="step3">
					<div class="row">
						<div class="col-md-1 col-md-offset-1" id="iconUser">	
				           	<i class="fa fa-user fa-2x"></i>
				       	</div>
				       	<div class="col-md-9">
							<input class="attendees-name form-control" placeholder="<?php echo Yii::t("common","Name")?>" id="attendeesName" name="attendeesName" value="" />
						</div>
					</div>
					<div class="row">
						<div class="col-md-1 col-md-offset-1">	
			           		<i class="fa fa-envelope-o fa-2x"></i>
			           	</div>
	    	        	<div class="col-md-9">
							<input class="attendees-email form-control" placeholder="Email" id="attendeesEmail" name="attendeesEmail" value="" />
						</div>
					</div>
					<div class ="row">
				               	<div class="col-md-10  col-md-offset-1">	
									<a href="javascript:showSearchAttendees()"><i class="fa fa-search"></i> <?php echo Yii::t("common","Search") ?></a>
								</div>
							</div>
					<div class="row">
						<div class="col-md-2 col-md-offset-1">
							<div class="form-group">
					    	    <button class="btn btn-primary" id="btnInviteNew" ><?php echo Yii::t("common","Invite"); ?></button>
					    	</div>
					    </div>
				    </div>
				</div>
							<div class="row ">
			 	<div class="col-md-12">
			        <table class="table table-striped table-bordered table-hover attendeesAddedTable hide">
			            <thead>
			                <tr>
			                    <th class="hidden-xs">Type</th>
			                    <th>Name</th>
			                    <th class="hidden-xs center">Email</th>
			                    <th>Status</th>
			                </tr>
			            </thead>
			            <tbody class="attendeesAdded"></tbody>
			        </table>
			    </div>
			</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	jQuery(document).ready(function() {
		$(".moduleLabel").html("<i class='fa fa-circle text-orange'></i> <i class='fa fa-calendar'></i> <?php echo addslashes(@$event["name"]) ?>  <a href='javascript:showMap()' id='btn-center-city'><i class='fa fa-map-marker'></i></a>");
	 	bindeventSubViewattendees();
	 	runAttendeesFormValidation();
	 	$('#attendeesSearch').keyup(function(e){
		    var email = $('#attendeesSearch').val();
		    setTimeout(function(){
		    	autoCompleteEmailAddAttendees(email)
		    }, 500);		
		});
		$('#attendeesEmail').focusout(function(e){
			//$(".new-attendees #dropdown_city").css({"display" : "none" });
		});
	});

	function bindeventSubViewattendees() {	
		$(".close-subview-button").off().on("click", function(e) {
			$(".close-subviews").trigger("click");
			e.prattendeesDefault();
		});


		/*$(".connectAttendeesBtn").off().on("click", function(){
			var idToconnect= $(this).data("id");
			var eventId = $(".form-attendees .attendees-id").val();
			$.ajax({
				type: "POST",
				url: baseUrl+"/"+moduleId+'/event/saveAttendees',
				data: data,
				dataType: "json",
	       		success: function(data){
	       		}
			})
		});*/

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
				//attendeesType : "* Please select a type",
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
				//newAttendee = new Object;
				var params = {
					"childId" :  $(".form-attendees .attendees-id").val(),
					"childName" : $(".form-attendees .attendees-name ").val(),
					"childEmail" : $('.form-attendees .attendees-email').val(),
					"childType" : "<?php echo Person::COLLECTION; ?>", 
					"parentType" : "<?php echo Event::COLLECTION;?>",
					"parentId" : $(".attendees-parentId").val()
				};

				//newAttendee.id = $(".form-attendees .attendees-id").val();
				//newAttendee.name = $(".form-attendees .attendees-name ").val(), 
				//newAttendee.email = $('.form-attendees .attendees-email').val(),
				//console.log(newAttendee);
				//idEvent = $(".attendees-parentId").val();
				$.blockUI({
					message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
		            '<blockquote>'+
		              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
		              '<cite title="Hegel">Hegel</cite>'+
		            '</blockquote> '
				});
				
				//if ($(".form-attendees .attendees-id").val() !== "") {
				//	el = $(".form-attendees .attendees-id").val();

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
				        url: baseUrl+"/"+moduleId+"/link/connect",
				        dataType : "json",
				        data:params,
						type:"POST",
				    })
				    .done(function (data) 
				    {

				    	$.unblockUI();
				        if (data &&  data.result) { 
					        console.log(data);      
					        setValidationTable(); 
		        			$(".form-attendees .attendees-name").val("");
							$(".form-attendees .attendees-name").removeAttr("disabled");
							$('.form-attendees .attendees-id').val("");
							$('.form-attendees .attendees-email').val("");
							$('.form-attendees .attendees-email').removeAttr("disabled");
							$('#newAttendees #attendeesEmail').parents().eq(1).show();
		        			showSearchAttendees();  
				        	toastr.success(data.msg);
				        } else {
				           toastr.error(data.msg);
				        }
				    });

				
			}
		});
	};

	// on hide attendees's form destroy summernote and bootstrapSwitch plugins
	function hideEditAttendee() {
		showSearchAttendees();
		//$.hideSubview();
	};
	// enables the edit form 
	function editAttendee(el) {
		$(".close-new-attendees").off().on("click", function() {
			$(".back-subviews").trigger("click");
		});
		$(".form-attendees .help-block").remove();
		$(".form-attendees .form-group").removeClass("has-error").removeClass("has-success");
	};


	function autoCompleteEmailAddAttendees(searchValue){
		console.log("autoCompleteEmailAddAttendees");
		var data = {"search" : searchValue,"searchMode":"personOnly"};
		$.ajax({
			type: "POST",
	        url: baseUrl+"/"+moduleId+"/search/searchmemberautocomplete",
	        data: data,
	        dataType: "json",
	        success: function(data){
	        	if(!data){
	        		toastr.error(data.content);
	        	}else{
	        	
					str = "<li class='li-dropdown-scope'><a href='javascript:openNewAttendeeForm()'>Non trouvé ? Cliquez ici.</a></li>";
		 			$.each(data, function(key, value) {
		 				
		 				$.each(value, function(i, v){
		 					var imageSearch = '<i class="fa fa-user fa-2x"></i>';
		 					var logoSearch = "";
		 					if("undefined" != typeof v.logo){
		 						var logoSearch = '<div class="pull-right"><img alt="image" class="img-circle" src="'+baseUrl+"/"+moduleId+'/document/resized/40x40'+v.logo+'" /></div>'
		 					}
		  					str += '<li class="li-dropdown-scope"><a href="javascript:setMemberInputAddAttendees(\''+v.id+'\',\''+v.name+'\',\''+v.email+'\',\''+key+'\')">'+imageSearch+' '+v.name +'</a></li>';
		  				});
		  			}); 

		  			$("#newAttendees #dropdown_search").html(str);
		  			$("#newAttendees #dropdown_search").css({"display" : "inline" });
	  			}
			}	
		})
	}


	function openNewAttendeeForm(){
		$("#newAttendees #step3").css("display", "block");
		$("#newAttendees #step1").css("display", "none");
		$("#newAttendees #attendeesName").val("");
		$("#newAttendees #attendeesName").removeAttr("disabled");
		$('#newAttendees #attendeesEmail').val("");
		$('#newAttendees #attendeesEmail').removeAttr("disabled");
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  		if(emailReg.test( $("#newAttendees #attendeesSearch").val() )){
  			$('#newAttendees #attendeesEmail').val( $("#newAttendees #attendeesSearch").val());
  		}else{
  			$("#newAttendees #attendeesName").val($("#newAttendees #attendeesSearch").val());
  		}
	}


	function setMemberInputAddAttendees(id,name,email,key){
		$("#newAttendees #step3").css("display", "block");
		$("#newAttendees #step1").css("display", "none");
		if(email==""){
			$('#newAttendees #attendeesEmail').parents().eq(1).hide();
		}

		$("#newAttendees #attendeesName").val(name).attr("disabled","disabled");
		$('#newAttendees #attendeesEmail').val(email).attr("disabled","disabled");
		$('#newAttendees #attendeesId').val(id);

	}
	
	function showSearchAttendees(){
		$("#newAttendees #step3").css("display", "none");
		$("#newAttendees #step1").css("display", "block");
		$("#newAttendees .attendees-search").val("");
		$("#newAttendees .attendees-id").val("");
		$("#newAttendees #dropdown_search").css({"display" : "none" });
	}
	function setValidationTable(){
		type="<?php echo Yii::t("common", Person::COLLECTION); ?>";
		strHTML = "<tr><td>"+type+"</td><td>"
	   						+$(".form-attendees .attendees-name").val()+"</td><td>"
	   						+$(".form-attendees .attendees-email").val()+"</td><td>"+
	   						"<span class='label label-info'>added</span></td> <tr>";
	    $(".attendeesAdded").append(strHTML);
	    if($(".attendeesAddedTable").hasClass("hide"))
	        $(".attendeesAddedTable").removeClass('hide').addClass('animated bounceIn');
	}
</script>