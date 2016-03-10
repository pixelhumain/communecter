
	<div class="main-login col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4 pull-right">

		<div class="box-login box box-white-round" style="display:none">

			<form class="form-login" action="" method="POST">
				<img style="width:100%" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logoL.jpg"/>
				<br/>
				<?php //echo Yii::app()->session["requestedUrl"]." - ".Yii::app()->request->url; ?>
				<fieldset style="padding-left:70px;padding-right:70px;">
					<div class="form-group">
						<span class="input-icon">		
							<input type="text" class="form-control radius-10" name="email" id="email" placeholder="Email" >
							<i class="fa fa-user"></i> </span>
					</div>
					<div class="form-group form-actions">
						<span class="input-icon">
							<input type="password" class="form-control password"  name="password" id="password" placeholder="Password">
							<i class="fa fa-lock"></i>
						</span>
					</div>
					<div class="form-actions">
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
						</div>
						<div class="errorHandler alert alert-danger no-display loginResult">
							<i class="fa fa-remove-sign"></i> Please verify your entries.
						</div>
						<div class="errorHandler alert alert-danger no-display notValidatedEmailResult">
							<i class="fa fa-remove-sign"></i> Your account is not validated : please check your mailbox to validate your email address.
							      If you didn't receive it or lost it, click
							      <a class="validate" href="#">here</a> to receive it again.
						</div>
						<div class="errorHandler alert alert-success no-display emailValidated">
							<i class="fa fa-check"></i> Your account is now validated ! Please try to login.
						</div>
						<div class="errorHandler alert alert-danger no-display custom-msg">
							<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
						</div>
						<label for="remember" class="checkbox-inline">
							<input type="checkbox" class="grey remember" id="remember" name="remember">
							Keep me signed in onnnn
						</label>
						<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="loginBtn ladda-button pull-right">
							<span class="ladda-label">Login</span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
						</button>
					</div>
					<div class="new-account">
						<?php echo Yii::t("login","Don't have an account yet?") ?>
						<a href="#" class="register">
							<?php echo Yii::t("login","Create an account") ?>
						</a>
						<br/>
						<a class="forgot" href="#">I forgot my password</a> 
					</div>
				</fieldset>
			</form>
		</div>
		<!-- end: LOGIN BOX -->
		<!-- start: FORGOT BOX -->
		<div class="box-email box box-white-round">
			<form class="form-email">
				<img style="width:100%" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logoL.jpg"/>
				<br/>
				<fieldset style="padding-left:70px;padding-right:70px;">
					<div class="form-group">
						<span class="input-icon">
							<input type="email" class="form-control" id="email2" placeholder="Email">
							<i class="fa fa-envelope"></i> </span>
					</div>
					<div class="form-actions">
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
						</div>
						<a class="btn btn-light-grey go-back">
							<i class="fa fa-chevron-circle-left"></i> Log-In
						</a>
						<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="forgotBtn ladda-button pull-right">
							<span class="ladda-label">Submit</span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
						</button>
					</div>
				</fieldset>
			</form>
		</div>
		<!-- end: FORGOT BOX -->
		<!-- start: REGISTER BOX -->
		<div class="box-register box box-white-round">
			
			<form class="form-register">
				<img style="width:100%" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logoL.jpg"/>
				<br/>
				
				<fieldset style="padding-left:70px;padding-right:70px;">
					<div class="form-group">
						<span class="input-icon">
							<input type="text" class="form-control" id="name" name="name" placeholder="Prénom Nom : John Doe">
							<i class="fa fa-user"></i> </span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="email" class="form-control" id="email3" name="email3" placeholder="<?php echo Yii::t("login","Email") ?>">
							<i class="fa fa-envelope"></i> </span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="password" class="form-control" id="password3" name="password3" placeholder="<?php echo Yii::t("login","Password") ?>">
							<i class="fa fa-lock"></i> </span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="password" class="form-control" id="passwordAgain" name="passwordAgain" placeholder="<?php echo Yii::t("login","Password again") ?>">
							<i class="fa fa-lock"></i> </span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="text" class="form-control" name="streetAddress" id="fullStreet" placeholder="<?php echo Yii::t("login","Full Street") ?>" value="<?php if(isset($organization["address"])) echo $organization["address"]["streetAddress"]?>" >
							<i class="fa fa-road"></i>
						</span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="text" class="form-control" id="cp" name="cp" placeholder="<?php echo Yii::t("login","Postal Code") ?>">
							<i class="fa fa-home"></i>
						</span>
					</div>
					<div class="form-group" id="cityDiv" style="display: none;">
						<span class="input-icon">
							<select class="selectpicker form-control" id="city" name="city" title='<?php echo Yii::t("login","Select your City...") ?>'>
							</select>
						</span>
						<div class="alert alert-success pull-left col-md-12" id="alert-city-found" style="text-align:center;font-family:inherit; border-radius:0px; margin-top:10px;">
							<span class="pull-left" style="padding:6px;">Position géographique trouvée <i class="fa fa-smile-o"></i></span>
							<div class="btn btn-success" id="btn-show-city"><i class="fa fa-map-marker"></i> Personnaliser</div>
						</div>

						<input type="hidden" name="geoPosLatitude" id="geoPosLatitude" style="width: 100%; height:35px;">
						<input type="hidden" name="geoPosLongitude" id="geoPosLongitude" style="width: 100%; height:35px;">
								
					</div>
					<div class="form-group pull-left">
						<div>
							<label for="agree" class="checkbox-inline">
								<input type="checkbox" class="grey agree" id="agree" name="agree">
								<?php echo Yii::t("login","I agree to the Terms of ") ?><a href="#" class="bootbox-spp"><?php echo Yii::t("login","Service and Privacy Policy") ?></a>
							</label>
						</div>
					</div>

					<div class="form-actions">
						<div class="errorHandler alert alert-danger no-display registerResult">
							<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
						</div>
						<div class="errorHandler alert alert-success no-display pendingProcess">
							<i class="fa fa-check"></i> <?php echo Yii::t("login","Please fill your personal information in order to log in.") ?>
						</div>
						<?php echo Yii::t("login","Already have an account?") ?>
						<a href="#" class="go-back">
							<?php echo Yii::t("login","Log-in") ?>
						</a>
						<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="createBtn ladda-button pull-right">
							<span class="ladda-label"><?php echo Yii::t("login","Submit") ?></span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
						</button>
					</div>
				</fieldset>
			</form>
			<!-- end: COPYRIGHT -->
		</div>
		<!-- end: REGISTER BOX -->
	</div>
	

<div class="eventMarker" style="z-index:-1;display:none;position:absolute; top:500px; left:100px;cursor:pointer;" >
	<img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/event.png" style="width:72px;" />
	<span class="homestead eventMarkerlabel" style="display:none;color:white;font-size:25px">EVENTS</span>
</div>
<div class="cityMarker" style="z-index:-1;display:none;position:absolute; top:350px; right:100px;cursor:pointer;" >
	<span class="homestead cityMarkerlabel" style="display:none;color:white;font-size:25px">CITIES</span>
	<img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/mairie.png" style="width:72px;" />
</div>
<div class="projectMarker" style="z-index:-1;display:none;position:absolute; top:620px; left:240px;cursor:pointer;" >
	<img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/project.png" style="width:72px;" />
	<span class="homestead projectMarkerlabel" style="display:none;color:white;font-size:25px">PROJECTS</span>
</div>
<div class="assoMarker" style="z-index:-1;display:none;position:absolute; top:750px; right:750px; cursor:pointer;" >
	<span class="homestead assoMarkerlabel" style="display:none;color:white;font-size:25px">ORGANIZATIONS</span>
	<img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/asso.png" style="width:72px;" />
</div>
<div class="userMarker" style="z-index:-1;display:none;position:absolute; top:600px; right:200px;cursor:pointer;" >
	<span class="homestead userMarkerlabel" style="display:none;color:white;font-size:25px">PEOPLE</span>
	<img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/user.png" style="width:72px;" />
</div>
<div class="connectMarker text-white" style="z-index:-1;display:none;position:absolute; top:25px; left:25px;cursor:pointer;" >
	<i class="fa fa-sign-in fa-2x"></i> 
	<span class="homestead connectlabel" style="display:none;color:white;font-size:25px"> CONNECT</span>
</div>



<script type="text/javascript">
	var geoPositionCity = null;
	var citiesByPostalCode = null;
	jQuery(document).ready(function() {
		userId = null;
		Login.init();	
		//titleAnim ();	
		if (email != "") {
			$(".form-login #email").val( email );
		}
		
		//Validation of the email
		if (userValidated) {
			//We are in a process of invitation. The user already exists in the db
			if (invitor != null) {
				$(".errorHandler").hide();
				$('.register').click();
				$('.pendingProcess').show();
				$('#email3').val(email);
				$('#email3').prop('disabled', true);
			} else {
				$(".errorHandler").hide();
				$(".emailValidated").show();
				$(".form-login #password").focus();
			}
		}

		if (msgError != "") {
			$(".custom-msg").show();
			$(".custom-msg").text(msgError);
		}

		$(".eventMarker").show().addClass("animated slideInDown").off().on("click",function() { 
			showPanel('box-event');
		}).on('mouseover',function() { 
			$(".eventMarkerlabel").show();
		}).on('mouseout',function() { 
			$(".eventMarkerlabel").hide();
		});
		$(".cityMarker").show().addClass("animated slideInUp").off().on("click",function() { 
			showPanel('box-city');
		}).on('mouseover',function() { 
			$(".cityMarkerlabel").show();
		}).on('mouseout',function() { 
			$(".cityMarkerlabel").hide();
		});
		$(".projectMarker").show().addClass("animated zoomInRight").off().on("click",function() { 
			showPanel('box-projects');
		}).on('mouseover',function() { 
			$(".projectMarkerlabel").show();
		}).on('mouseout',function() { 
			$(".projectMarkerlabel").hide();
		});
		$(".assoMarker").show().addClass("animated zoomInLeft").off().on("click",function() { 
			showPanel('box-orga');
		}).on('mouseover',function() { 
			$(".assoMarkerlabel").show();
		}).on('mouseout',function() { 
			$(".assoMarkerlabel").hide();
		});
		$(".userMarker").show().addClass("animated zoomInLeft").off().on("click",function() { 
			showPanel('box-people');
		}).on('mouseover',function() { 
			$(".userMarkerlabel").show();
		}).on('mouseout',function() { 
			$(".userMarkerlabel").hide();
		});
		$(".connectMarker").show().addClass("animated zoomInLeft").off().on("click",function() { 
			showPanel('box-login');
		}).on('mouseover',function() { 
			$(".connectlabel").show();
		}).on('mouseout',function() { 
			$(".connectlabel").hide();
		});
		$(".byPHRight").show().addClass("animated zoomInLeft").off().on("click",function() { 
			showPanel('box-ph');
		});
		
	
	});

var email = '<?php echo @$_GET["email"]; ?>';
var userValidated = '<?php echo @$_GET["userValidated"]; ?>';
var pendingUserId = '<?php echo @$_GET["pendingUserId"]; ?>';
var msgError = '<?php echo @$_GET["msg"]; ?>';
var invitor = <?php echo Yii::app()->session["invitor"] ? json_encode(Yii::app()->session["invitor"]) : '""'?>;

var timeout;
var emailType;
var Login = function() {
	"use strict";
	var runBoxToShow = function() {
		var el = $('.box-login');
		if (getParameterByName('box').length) {
			switch(getParameterByName('box')) {
				case "register" :
					el = $('.box-register');
					break;
				case "email" :
					el = $('.box-email');
					break;
				case "validate" :
					el = $('.box-email');
					break;
				default :
					el = $('.box-login');
					break;
			}
		}
		el.show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$(this).removeClass("animated flipInX");
		});
	};
	var runLoginButtons = function() {
		$('.forgot').on('click', function() {
			$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).hide().removeClass("animated bounceOutRight");

			});
			$('.box-email').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");
			});
			emailType = "password";
			$("#email2").val($("#email").val());
			activePanel = "box-email";
		});
		$('.validate').on('click', function() {
			$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).hide().removeClass("animated bounceOutRight");

			});
			$('.box-email').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");
			});
			emailType = "validation";
			$("#email2").val($("#email").val());
			activePanel = "box-email";
		});
		$('.register').on('click', function() {
			$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).hide().removeClass("animated bounceOutRight");

			});
			$('.box-register').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");

			});
			activePanel = "box-register";
		});
		$('.go-back').click(function() {
			var boxToShow;
			if ($('.box-register').is(":visible")) {
				boxToShow = $('.box-register');
				activePanel = "box-register";
			} else {
				boxToShow = $('.box-email');
				activePanel = "box-email";
			}
			boxToShow.addClass("animated bounceOutLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				boxToShow.hide().removeClass("animated bounceOutLeft");

			});
			$('.box-login').show().addClass("animated bounceInRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInRight");

			});
		});
	};
	//function to return the querystring parameter with a given name.
	var getParameterByName = function(name) {
		name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"), results = regex.exec(location.search);
		return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	};
	var runSetDefaultValidation = function() {
		$.validator.setDefaults({
			errorElement : "span", // contain the error msg in a small tag
			errorClass : 'help-block',
			errorPlacement : function(error, element) {// render error placement for each input type
				if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
					error.insertAfter($(element).closest('.form-group').children('div').children().last());
				} else if (element.attr("name") == "card_expiry_mm" || element.attr("name") == "card_expiry_yyyy") {
					error.appendTo($(element).closest('.form-group').children('div'));
				} else {
					error.insertAfter(element);
					// for other inputs, just perform default behavior
				}
			},
			ignore : ':hidden',
			success : function(label, element) {
				label.addClass('help-block valid');
				// mark the current input as valid and display OK icon
				$(element).closest('.form-group').removeClass('has-error');
			},
			highlight : function(element) {
				$(element).closest('.help-block').removeClass('valid');
				// display OK icon
				$(element).closest('.form-group').addClass('has-error');
				// add the Bootstrap error class to the control group
			},
			unhighlight : function(element) {// revert the change done by hightlight
				$(element).closest('.form-group').removeClass('has-error');
				// set error class to the control group
			}
		});
	};
	var runLoginValidator = function() {
		var form = $('.form-login');
		var loginBtn = null;
		Ladda.bind('.loginBtn', {
	        callback: function (instance) {
	            loginBtn = instance;
	        }
	    });
		form.submit(function(e){e.preventDefault() });
		var errorHandler = $('.errorHandler', form);
		
		form.validate({
			rules : {
				email : {
					minlength : 2,
					required : true
				},
				password : {
					minlength : 4,
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler.hide();
				loginBtn.start();
				var params = { 
				   "email" : $("#email").val(), 
                   "pwd" : $("#password").val()
                };
			      
		    	$.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/person/authenticate",
		    	  data: params,
		    	  success: function(data){
		    		  if(data.result)
		    		  {
		    		  	var url = "<?php echo (isset(Yii::app()->session["requestedUrl"])) ? Yii::app()->session["requestedUrl"] : null; ?>";
		    		  	if(url)
		    		  		window.location.href = url;
		        		else
		        			window.location.reload();
		    		  } else {
		    		  	var msg;
		    		  	if (data.msg == "notValidatedEmail") {
							$('.notValidatedEmailResult').show();
		    		  	} else if (data.msg == "accountPending") {
		    		  		pendingUserId = data.pendingUserId;
		    		  		$(".errorHandler").hide();
							$('.register').click();
							$('.pendingProcess').show();
							$('#email3').val($("#email").val());
							$('#email3').prop('disabled', true);
		    		  	} else{
		    		  		msg = data.msg;
		    		  		$('.loginResult').html(msg);
							$('.loginResult').show();
		    		  	}
						loginBtn.stop();
		    		  }
		    	  },
		    	  error: function(data) {
		    	  	toastr.error("Something went really bad : contact your administrator !");
		    	  	loginBtn.stop();
		    	  },
		    	  dataType: "json"
		    	});
			    return false; // required to block normal submit since you used ajax
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler.show();
				loginBtn.stop();
			}
		});
	};
	var runForgotValidator = function() {
		var form2 = $('.form-email');
		var errorHandler2 = $('.errorHandler', form2);
		var forgotBtn = null;
		Ladda.bind('.forgotBtn', {
	        callback: function (instance) {
	            forgotBtn = instance;
	        }
	    });
		form2.validate({
			rules : {
				email2 : {
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler2.hide();
				forgotBtn.start();
				var params = { 
					"email" : $("#email2").val(),
					"type"	: emailType
				};
		        $.ajax({
		          type: "POST",
		          url: baseUrl+"/<?php echo $this->module->id?>/person/sendemail",
		          data: params,
		          success: function(data){
					if (data.result) {
						alert(data.msg);
			            window.location.reload();
					} else if (data.errId == "UNKNOWN_ACCOUNT_ID") {
						if (confirm(data.msg)) {
							$('.box-email').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
								$(this).hide().removeClass("animated bounceOutRight");
							});
							$('.box-register').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
								$(this).show().removeClass("animated bounceInLeft");

							});
						} else {
							window.location.reload();
						}
					}
		          },
		          error: function(data) {
		    	  	toastr.error("Something went really bad : contact your administrator !");
		    	  },
		          dataType: "json"
		        });
		        return false;
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler2.show();
				forgotBtn.stop();
			}
		});
	};
	var runRegisterValidator = function() {
		var form3 = $('.form-register');
		var errorHandler3 = $('.errorHandler', form3);
		var createBtn = null;
		/*---Other solution for email validation with no space
			$("#email3").keyup(function(event){
			if (event.which==32 || event.which==86){
				var txt=$(this).val();
				$(this).val(txt.trim());
			}
		});*/
		Ladda.bind('.createBtn', {
	        callback: function (instance) {
	            createBtn = instance;
	        }
	    });
		form3.validate({
			rules : {
				cp : {
					required : true,
					rangelength : [5, 5],
					validPostalCode : true
				},
				city : {
					required : true,
					minlength : 1
				},
				name : {
					required : true
				},
				email3 : {
					required : { 
						depends:function(){
							$(this).val($.trim($(this).val()));
							return true;
        				}
        			},
					email : true
				},
				password3 : {
					minlength : 8,
					required : true
				},
				passwordAgain : {
					equalTo : "#password3"
				},
				agree : {
					minlength : 1,
					required : true
				}
			},
			messages: {
				agree: "You must validate the CGU to sign up.",
			},
			submitHandler : function(form) {
				errorHandler3.hide();
				createBtn.start();
				var params = { 
				   "name" : $("#name").val(),
				   "email" : $("#email3").val(),
                   "pwd" : $("#password3").val(),
                   "cp" : $("#cp").val(),
                   "geoPosLatitude" : $("#geoPosLatitude").val(),
                   "geoPosLongitude" : $("#geoPosLongitude").val(),
                   "app" : "<?php echo $this->module->id?>",
                   "city" : $("#city").val(),
                   "pendingUserId" : pendingUserId
                };
			      
		    	$.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/person/register",
		    	  data: params,
		    	  success: function(data){
		    		  if(data.result)
		    		  {
		    		  	$.blockUI({
    		  				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '
    		  			});
		        		toastr.success(data.msg+" , we'll contact you as soon as we open up! Thanks for joining.");
		        		//window.location.reload();
		        		setTimeout(function() { $.unblockUI(); showPanel(); },5000);
		    		  }
		    		  else {
						$('.registerResult').html(data.msg);
						$('.registerResult').show();
						createBtn.stop();
		    		  }
		    	  },
		    	  error: function(data) {
		    	  	toastr.error("Something went really bad : contact your administrator !");
		    	  	createBtn.stop();
		    	  },
		    	  dataType: "json"
		    	});
			    return false;
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler3.show();
				createBtn.stop();
			}
		});
	};
	return {
		//main function to initiate template pages
		init : function() {
			addCustomValidators();
			runBoxToShow();
			runLoginButtons();
			runSetDefaultValidation();
			runLoginValidator();
			runForgotValidator();
			runRegisterValidator();
			bindPostalCodeAction();
		}
	};
}();

function runShowCity(searchValue) {
	citiesByPostalCode = getCitiesByPostalCode(searchValue);
	Sig.citiesByPostalCode = citiesByPostalCode;
	Sig.execFullSearchNominatim(0);

	var oneValue = "";
	console.table(citiesByPostalCode);
	$.each(citiesByPostalCode,function(i, value) {
    	$("#city").append('<option value=' + value.value + '>' + value.text + '</option>');
    	oneValue = value.value;
	});
	
	if (citiesByPostalCode.length == 1) {
		$("#city").val(oneValue);
	}

	if (citiesByPostalCode.length >0) {
        $("#cityDiv").slideDown("medium");
      } else {
        $("#cityDiv").slideUp("medium");
      }
}

function bindPostalCodeAction() {
	$('.form-register #cp').change(function(e){
		searchCity();
	});
	$('.form-register #cp').keyup(function(e){
		searchCity();
	});

	$('.form-register #fullStreet').keyup(function(e){
		if($('.form-register #cp').val() != "")
		searchCity();
	});

	$('.form-register #fullStreet').change(function(e){
		if($('.form-register #cp').val() != "")
		searchCity();
	});

	$('#city').change(function(e){
		searchCity();
	});
}

function searchCity() { console.log("searchCity");
	var searchValue = $('.form-register #cp').val();
	if(searchValue.length == 5) {
		$("#city").empty();
		clearTimeout(timeout);
		timeout = setTimeout($("#iconeChargement").css("visibility", "visible"), 100);
		clearTimeout(timeout);
		timeout = setTimeout('runShowCity("'+searchValue+'")', 100); 
	} else {
		$("#cityDiv").slideUp("medium");
		$("#city").val("");
		$("#city").empty();
	}
}

function callBackFullSearch(resultNominatim){
	//console.log("callback ok");
	Sig.showCityOnMap(resultNominatim, true, "organization");
	$(".topLogoAnim").hide();

	//setTimeout("setMapPositionregister();", 1000);
}
function setMapPositionregister(){ console.log("setMapPositionregister");
	Sig.map.panTo(Sig.markerNewData.getLatLng(), {animate:false}); 
	Sig.map.panBy([300, 0]);
}
</script>