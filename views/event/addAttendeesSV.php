<?php
if(@$event) {
	Menu::event($event);
	$this->renderPartial('../default/panels/toolbar'); 
}
$cssAnsScriptFilesModule = array(
	'/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
	'/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->request->baseUrl);

$admin = false;
if(isset(Yii::app()->session["userId"]) && isset($event["_id"])){
	$admin = Authorisation::canEditItem(Yii::app()->session["userId"], Event::COLLECTION, (string)$event["_id"]);
}

?>
<style>
#newAttendees{
	display: block;
	float: left;
	padding: 10px;
	background-color: rgba(242, 242, 242, 0.9);
	width: 100%;
	box-shadow: 1px 1px 5px 3px #CFCFCF;
}
#dropdown_search{
	padding: 0px 15px; 
	margin-left:2%; 
	width:96%;
}
#dropdown_search .li-dropdown-scope ol {
	color: #155869;
	padding: 5px 5px 5px 15px !important;
}
#step3{
	display:none;
}
</style>
<div id="newAttendees">
	<?php   
  		if (@Yii::app()->params['betaTest'] && @$numberOfInvit) { 
  			$nbOfInvit = empty($numberOfInvit) ? 0 : $numberOfInvit;  			?>

  			<div id="numberOfInvit" class="badge badge-danger pull-right tooltips" style="margin-top:5px; margin-right:5px;" data-count="<?php echo $nbOfInvit ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("login","Number of invitations left"); ?>"><?php echo $nbOfInvit ?> invitation(s)</div>
  	<?php
		}
	?>
	<h2 class='radius-10 padding-10 text-dark'>
		<i class="fa fa-plus"></i> <i class="fa fa-2x fa-user"></i> 
		<?php echo Yii::t("event","Add an attendee",null,Yii::app()->controller->module->id); ?>
	</h2>
	<div class="col-md-12">  
       	<div class="panel panel-white">
        	<div class="panel-heading border-light">
	        	<blockquote>
        			<?php echo Yii::t("event","Only people can attend to an event") ?>
        		</blockquote>
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
					<?php if(@$admin && $admin==true){ ?>
					<div class="row">
						<div class="center">
							<div id="divAdmin" class="form-group">
				    	    	<label class="control-label">
									Administrateur :
								</label><br>
								<input type="checkbox" data-on-text="<?php echo Yii::t("common","Yes") ?>" data-off-text="<?php echo Yii::t("common","No") ?>" name="my-checkbox"></input>
							</div>
						</div>
					</div>
					<?php } ?>
					<input class="hide" id="attendeeIsAdmin" name="attendeeIsAdmin"></input>
					<div class ="row">
			            <div class="col-md-10  col-md-offset-1 padding-10">
				             <button class="btn btn-primary pull-right" id="btnInviteNew" style="margin-left:10px;"><?php echo Yii::t("common","Invite"); ?></button>	
							<a href="javascript:showSearchAttendees()" class="btn btn-default pull-right" style="margin-left:10px;"><i class="fa fa-search"></i> <?php echo Yii::t("common","Search") ?></a>
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
		setTitle("<?php echo addslashes(@$event["name"]) ?>  <a href='javascript:showMap()' id='btn-center-city'><i class='fa fa-map-marker'></i></a>","<i class='fa fa-circle text-orange'></i><i class='fa fa-calendar'></i>", "ADD EVENT PARTICIPANTS");
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
		$("#attendeeIsAdmin").val("false");
		$("[name='my-checkbox']").bootstrapSwitch();
		$("[name='my-checkbox']").on("switchChange.bootstrapSwitch", function (event, state) {
			console.log("state = "+state );
			if (state == true) {
				$("#attendeeIsAdmin").val(1);
			} else {
				$("#attendeeIsAdmin").val(0);
			}
			
		}); 
	});

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
				var connectType = "attendee";
				if ($("#attendeeIsAdmin").val() == true) connectType = "admin";

				var params = {
					"childId" :  $(".form-attendees .attendees-id").val(),
					"childName" : $(".form-attendees .attendees-name ").val(),
					"childEmail" : $('.form-attendees .attendees-email').val(),
					"childType" : "<?php echo Person::COLLECTION; ?>", 
					"parentType" : "<?php echo Event::COLLECTION;?>",
					"parentId" : $(".attendees-parentId").val(),
					"connectType":connectType
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
					        if ($(".form-attendees .attendees-id").val().length==0){
			               		var count = parseInt($("#numberOfInvit").data("count")) - 1;
						   		$("#numberOfInvit").html(count + ' invitation(s)');
						   		$("#numberOfInvit").data("count", count);
							}

		        			$(".form-attendees .attendees-name").val("");
							$(".form-attendees .attendees-name").removeAttr("disabled");
							$('.form-attendees .attendees-id').val("");
							$('.form-attendees .attendees-email').val("");
							$('.form-attendees .attendees-email').removeAttr("disabled");
							$('#newAttendees #attendeesEmail').parents().eq(1).show();
		        			showSearchAttendees();  
				        	toastr.success(data.msg);
				        } else {
					        if(typeof(data.type)!="undefined" && data.type=="info")
								toastr.info(data.msg);
							else
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