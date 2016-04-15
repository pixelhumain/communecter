<?php //echo "hello !"; 

$pathParams = Yii::app()->controller->module->viewPath.'/default/dir/';
$json = file_get_contents($pathParams."params.json");
$params = json_decode($json, true);
?>
<style>
	.main-login{
		position:absolute;
		top:80px;
	}
	.box-login, .box-register, .box-email{
		/*left: unset !important;*/
		/*right: 17% !important;*/
		border-radius:15px;
		display:none;
	}
	.form-login, .form-register, .form-email{
		left: unset !important;
		right: 14% !important;
		border-radius:15px;
	}
	.btn-round{
		border-radius:0px 0px 15px 15px !important;
	}

	.btn-close-box{
		position:absolute;
		right:0px;
		top:0px;
		border-radius: 0px 10px 0px 0px;
		border: 0px;
		height:35px;
		background-color: transparent;
	}
</style>
	
	<div class="main-login col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-2 col-xs-10 col-xs-offset-1">


	<div class="modal fade" role="dialog" id="modalRegisterSuccess">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h4 class="modal-title"><i class="fa fa-check"></i> Inscription enregistrée !</h4>
				</div>
				<div class="modal-body center text-dark" id="modalRegisterSuccessContent"></div>
				<div class="modal-footer">
					 <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
				</div>
			</div>
		</div>
	</div>

		<!-- <a class="byPHRight" href="#"><img style="" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/byPH.png"/></a> -->
		
			<div class="box-login box box-white-round no-padding pull-right">
				<button class="btn btn-default btn-close-box" id=""><i class="fa fa-times"></i></button>
				<?php 
					$this->renderPartial('./simplyMenuTitle', array('params'=>$params));
				?>
				<form class="form-login box-white-round" action="" method="POST">
					<?php if(isset($params['skin']['loginTitle']) && $params['skin']['loginTitle'] == "communecter"){ ?>
					<img style="width:100%; border: 10px solid white; border-bottom-width:0px;" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logoL.jpg"/>
					<br/>
					<?php } ?>
					<?php //echo Yii::app()->session["requestedUrl"]." - ".Yii::app()->request->url; ?>
					<fieldset>
						<h2 class="text-red margin-bottom-10 text-center"><i class="fa fa-angle-down"></i> Je me connecte</h2>
						<div class="form-group">
							<span class="input-icon">		
								<input type="text" class="form-control radius-10" name="email" id="email-login" placeholder="<?php echo Yii::t("login","E-mail / nom d'utilisateur") ?>" >
								<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group form-actions">
							
							<span class="input-icon">
								<input type="password" class="form-control password"  name="password" id="password-login" placeholder="<?php echo Yii::t("login","Password") ?>">
								
								<label for="remember" class="checkbox-inline">
									<input type="checkbox" class="grey remember" id="remember" name="remember">
									<?php echo Yii::t("login","Keep me signed in") ?>
								</label>

								<i class="fa fa-lock"></i>
								<a class="forgot pull-right padding-5" href="javascript:" 
								onclick="showPanel('box-email', 
									function() {
										emailType = 'password';
										$('#email2').val($('#email-login').val());
										$('.forgotBtn .ladda-label').text(buttonLabel[emailType])});">
								<?php echo Yii::t("login","I forgot my password") ?></a> 
							</span>
						</div>
						<div class="form-actions" style="margin-top:-20px;">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
							</div>
							<div class="errorHandler alert alert-danger no-display loginResult">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
							</div>
							<div class="errorHandler alert alert-danger no-display notValidatedEmailResult">
								<i class="fa fa-remove-sign"></i><?php echo Yii::t("login","Your account is not validated : please check your mailbox to validate your email address.") ?>
								      <?php echo Yii::t("login","If you didn't receive it or lost it, click") ?>
								      <a class="validate" href="#" 
								      onclick="showPanel('box-email', 
								      	function() {
								      		emailType = 'validateEmail';
								      		$('#email2').val($('#email-login').val());
								      		$('.forgotBtn .ladda-label').text(buttonLabel[emailType])});">
								      <?php echo Yii::t("login","here") ?></a> <?php echo Yii::t("login","to receive it again.") ?> 
							</div>
							<div class="errorHandler alert alert-info no-display betaTestNotOpenResult">
								<i class="fa fa-remove-sign"></i><?php echo Yii::t("login","Our developpers are fighting to open soon ! Check your mail that will happen soon !")?>
							</div>
							<div class="errorHandler alert alert-success no-display emailValidated">
								<i class="fa fa-check"></i> <?php echo Yii::t("login","Your account is now validated ! Please try to login.") ?>
							</div>
							<div class="errorHandler alert alert-danger no-display custom-msg">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
							</div>
							
							<br/>
							<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="loginBtn ladda-button center-block">
								<span class="ladda-label"><i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Login") ?></span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
							</button>
						</div>
						
					</fieldset>
					<div class="new-account">
						<!-- <h2 class="text-red  no-margin padding-bottom-5 text-center bg-white"><i class="fa fa-angle-down"></i> Je m'inscris</h2> -->
						<?php //echo Yii::t("login","Don't have an account yet?") ?>
						<a href="javascript:" onclick="showPanel('box-register');" class="btn btn-default btn-sm register btn-round text-dark">
							<i class="fa fa-plus"></i> <i class="fa fa-user"></i> <?php echo Yii::t("login", "Create an account") ?>
						</a>
						
					</div>
				</form>
			</div>
			<!-- end: LOGIN BOX -->
			<!-- start: FORGOT BOX -->
			<div class="box-email box box-white-round">
				<button class="btn btn-default btn-close-box" id=""><i class="fa fa-times"></i></button>
				<form class="form-email box-white-round">
					<img style="width:100%; border: 10px solid white;" class="pull-right box-white-round" src="<?php echo $this->module->assetsUrl?>/images/logoLTxt.jpg"/>
					<br/>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" id="email2" placeholder="E-mail / nom d'utilisateur">
								<i class="fa fa-envelope"></i> </span>
						</div>
						<div class="form-actions">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
							</div>
							
							<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="forgotBtn ladda-button center center-block">
								<span class="ladda-label">XXXXXXXX</span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
							</button>
						</div>
					</fieldset>
					<div class="new-account">
						<a href="javascript:" onclick="showPanel('box-login');" class="text-dark btn go-back btn-round">
							<i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Login") ?>
						</a>	
					</div>
				</form>
			</div>
			<!-- end: FORGOT BOX -->
			<!-- start: REGISTER BOX -->
			<div class="box-register box box-white-round no-padding" style=" margin-top:-25px !important;">
				<button class="btn btn-default btn-close-box" id=""><i class="fa fa-times"></i></button>
				<form class="form-register center box-white-round" style="background-color:white !important;">
					<?php if(isset($params['skin']['loginTitle']) && $params['skin']['loginTitle'] == "communecter"){ ?>
					<img style="width:70%; border: 10px solid white;" class="" src="<?php echo $this->module->assetsUrl?>/images/logoLTxt.jpg"/>
					<?php } ?>
					<fieldset>
						<h2 class="text-red margin-bottom-10 text-center"><i class="fa fa-angle-down"></i> Je crée mon compte</h2>
						<div class="col-md-12 padding-5">
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" id="name" name="name" placeholder="Nom et Prénom">
									<i class="fa fa-user"></i> </span>
							</div>
						</div>
						<div class="col-md-6 padding-5">
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" id="username" name="username" placeholder="<?php echo Yii::t("login","Username") ?>">
									<i class="fa fa-user-secret"></i> </span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" id="email3" name="email3" placeholder="<?php echo Yii::t("login","E-mail") ?>">
									<i class="fa fa-envelope"></i> </span>
							</div>
						</div>
						<div class="col-md-6 padding-5">
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
						</div>
						<div class="col-md-12 no-padding no-margin">
							<hr style="margin-top: 0px; margin-bottom: 15px;">
						</div>
						
						<div class="form-group pull-left no-margin" style="width:100%;">
							<div>
								<label for="agree" class="checkbox-inline">
									<input type="checkbox" class="grey agree" id="agree" name="agree">
									<?php echo Yii::t("login","I agree to the Terms of") ?> <a href="https://www.communecter.org/doc/Conditions Générales d'Utilisation.pdf" target="_blank" class="bootbox-spp"><?php echo Yii::t("login","Service and Privacy Policy") ?></a>
								</label>
							</div>
						</div>			

						<div class="pull-left" style="width:100%;">
							<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="createBtn ladda-button center-block">
								<span class="ladda-label"><i class="fa fa-plus"></i><i class="fa fa-user"></i>  <?php echo Yii::t("login","Submit") ?></span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
							</button>
						</div>
						<div class="space20"></div>
						<div class="pull-left form-actions no-margin" style="width:100%; padding:10px;">
							<div class="errorHandler alert alert-danger no-display registerResult pull-left " style="width:100%;">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
							</div>
							<div class="alert alert-success no-display pendingProcess" style="width:100%;">
								<i class="fa fa-check"></i> <?php echo Yii::t("login","You've been invited : please resume the registration process in order to log in.") ?>
							</div>
						</div>
					</fieldset>
					<div class="new-account">
						<a href="javascript:" onclick="showPanel('box-login');" class="text-dark btn go-back btn-round">
							<i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Login") ?>
						</a>	
					</div>	
				</form>
				<!-- end: COPYRIGHT -->
			</div>
	</div>


<script>

var email = '<?php echo @$_GET["email"]; ?>';
var userValidated = '<?php echo @$_GET["userValidated"]; ?>';
var pendingUserId = '<?php echo @$_GET["pendingUserId"]; ?>';
var name = '<?php echo @$_GET["name"]; ?>';
var error = '<?php echo @$_GET["error"]; ?>';
var invitor = "<?php echo @$_GET["invitor"]?>";

var msgError = {
	"accountAlreadyExists" : "<?php echo Yii::t("login","Your account already exists on the plateform : please try to login.") ?>",
	"unknwonInvitor" : "<?php echo Yii::t("login","Something went wrong ! Impossible to retrieve your invitor.") ?>",
	"somethingWrong" : "<?php echo Yii::t("login","Something went wrong !") ?>",
}

var buttonLabel = {
	"password" : '<?php echo Yii::t("login","Get my password") ?>',
	"validateEmail" : "<?php echo Yii::t("login","Send me validation email") ?>"
}

var timeout;
var emailType;

jQuery(document).ready(function() {
	//Remove parameters from URLs in case of invitation without reloading the page
	removeParametersWithoutReloading();
	
	$(".box").hide();
	Login.init();


	$('.form-register #username').keyup(function(e) {
		validateUserName();
	})

	if(email != ''){
		$('#email-login').val(email);
		$('#email-login').prop('disabled', true);
		$('#email3').val(email);
		$('#email3').prop('disabled', true);
	}

	//Validation of the user (invitation or validation)
	userValidatedActions();

	if (error != "") {
		$(".custom-msg").show();
		$(".custom-msg").text(msgError[error]);
	}

	$(".btn-close-box").click(function(){
		$(".box").hide(400);
		$(".main-col-search").animate({ top: 0, opacity:1 }, 800 );
	});

});
function userValidatedActions() { 
	if (userValidated) {
		$(".errorHandler").hide();
		$(".emailValidated").show();
		$(".form-login #password-login").focus();
	}

	//We are in a process of invitation. The user already exists in the db.
	if (invitor != "") {
		$(".errorHandler").hide();
		$('.pendingProcess').show();
		$('#name').val(name);
		$('#email3').prop('disabled', true);
	}
}

function removeParametersWithoutReloading() {
	window.history.pushState("Invitation", 
		"Invitation", 
		location.href.replace(location.search,""));
}

var Login = function() {
	"use strict";
	var runBoxToShow = function() {
		var el = $('.box-login');
		if (getParameterByName('box').length) {
			switch(getParameterByName('box')) {
				case "register" :
					el = $('.box-register');
					break;
				case "password" :
					el = $('.box-email');
					emailType = 'password'
					break;
				case "validate" :
					el = $('.box-email');
					emailType = 'validateEmail'
					break;
				default :
					el = $('.box-login');
					break;
			}
		}
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
				   "email" : $("#email-login").val(), 
                   "pwd" : $("#password-login").val()
                };
			      
		    	$.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/person/authenticate",
		    	  data: params,
		    	  success: function(data){
		    		  if(data.result)
		    		  {
		    		  	var url = "<?php echo (isset(Yii::app()->session["requestedUrl"])) ? Yii::app()->session["requestedUrl"] : null; ?>";
		    		  	//console.warn(url,", has #"+url.indexOf("#"),"count / : ",url.split("/").length - 1 );
		    		  	if(url && url.indexOf("#") >= 0 ) {
		    		  		//console.log("login 1",url);
		    		  		//reload to the url initialy requested
		    		  		window.location.href = url;
		        		} else {
		        			if( url.split("/").length - 1 <= 3 ) {
		        				//console.log("login 2",baseUrl+'#default.home');
		        				//classic use case wherever you login from if not notifications/get/not/id...
		        				//you stay on the current page
		        				//if(location.hash == '#default.home')
		        					window.location.reload();
		        				/*else
		        					window.location.href = baseUrl+'#default.home';*/
		        			}
		        			else {
		        				//console.log("login 3 reload");
		        				//for urls like notifications/get/not/id...
		        				window.location.href = baseUrl+'#default.home';
		        				//window.location.reload();
		        			}
		        		}
		    		  } else {
		    		  	var msg;
		    		  	if (data.msg == "notValidatedEmail") {
							$('.notValidatedEmailResult').show();
		    		  	} else if (data.msg == "betaTestNotOpen") {
		    		  		$('.betaTestNotOpenResult').show();
		    		  	} else if (data.msg == "accountPending") {
		    		  		pendingUserId = data.pendingUserId;
		    		  		$(".errorHandler").hide();
							$('.register').click();
							$('.pendingProcess').show();
							$('#email3').val($("#email-login").val());
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
		
		Ladda.bind('.createBtn', {
	        callback: function (instance) {
	            createBtn = instance;
	        }
	    });
		form3.validate({
			rules : {
				name : {
					required : true
				},
				username : {
					required : true,
					validUserName : true,
					rangelength : [4, 32]
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
				agree: "<?php echo Yii::t("login","You must validate the CGU to sign up.") ?>",
			},
			submitHandler : function(form) {
				errorHandler3.hide();
				createBtn.start();
				var params = { 
				   "name" : $("#name").val(),
				   "username" : $("#username").val(),
				   "email" : $("#email3").val(),
                   "pwd" : $("#password3").val(),
                   "app" : "<?php echo $this->module->id?>",
                   "pendingUserId" : pendingUserId,
                   "mode" : "<?php echo Person::REGISTER_MODE_TWO_STEPS ?>"
                };
			      
		    	$.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/person/register",
		    	  data: params,
		    	  success: function(data){
		    		  if(data.result) {
		    		  	$("#modalRegisterSuccessContent").html("<h3><i class='fa fa-smile-o fa-4x text-green'></i><br><br> "+data.msg+"</h3>");
		    		  	$("#modalRegisterSuccess").modal({ show: 'true' }); 

		        		//toastr.success(data.msg);
		        		loadByHash("#default.directory");
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
			runSetDefaultValidation();
			runLoginValidator();
			runForgotValidator();
			runRegisterValidator();
		}
	};
}();

var oldCp = "";

function validateUserName() {
	var username = $('.form-register #username').val();
	if(username.length >= 4) {
		clearTimeout(timeout);
		timeout = setTimeout(function() {
				//console.log("bing !");
				if (! isUniqueUsername(username)) {
					var validator = $( '.form-register' ).validate();
					validator.showErrors({
  						"username": '<?php echo Yii::t("login","The user name is not unique : please change it.")?>'
					});
				}
			}, 200);
	}
}

function callBackFullSearch(resultNominatim){
	console.log("callback ok");
	var ok = Sig.showCityOnMap(resultNominatim, true, "person");
	if(!ok){
		if($('#city').val() != "") {
			findGeoposByInsee($('#city').val(), callbackFindByInseeSuccessRegister);
		}
	}
	//$(".topLogoAnim").hide();

	//setTimeout("setMapPositionregister();", 1000);
}

//quand la recherche par code insee a fonctionné
function callbackFindByInseeSuccessRegister(obj){
	console.log("callbackFindByInseeSuccess");
	//si on a bien un résultat
	if (typeof obj != "undefined" && obj != "") {
		//récupère les coordonnées
		var coords = Sig.getCoordinates(obj, "markerSingle");
		//si on a une geoShape on l'affiche
		if(typeof obj.geoShape != "undefined") Sig.showPolygon(obj.geoShape);
		//on affiche le marker sur la carte
		$("#alert-city-found").show();
		//console.log("verification contenue obj");
		//console.dir(obj);
		Sig.showCityOnMap(obj, true, "person");

		if(typeof obj.name != "undefined"){
			$("#main-title-public2").html("<i class='fa fa-university'></i> "+obj.name);
			$("#main-title-public2").show();
		}

		hideLoadingMsg();
				
		//showGeoposFound(coords, projectId, "projects", projectData);
	}
	else {
		console.log("Erreur getlatlngbyinsee vide");
	}
}
	function searchAddressInGeoShape(){
		if($('#cp').val() != "" && $('#cp').val() != null){
			findGeoposByInsee($('#city').val(), callbackFindByInseeSuccessAdd);
		}
	}

	function callbackFindByInseeSuccessAdd(obj){
		console.log("callbackFindByInseeSuccessAdd");
		console.dir(obj);
		//si on a bien un résultat
		if (typeof obj != "undefined" && obj != "") {
			currentCityByInsee = obj;
			//récupère les coordonnées
			var coords = Sig.getCoordinates(obj, "markerSingle");
			//si on a une street dans le form
			if($('#fullStreet').val() != "" && $('#fullStreet').val() != null){
				//si on a une geoShape dans la reponse obj
				if(typeof obj.geoShape != "undefined") {
					//on recherche avec une limit bounds
					var polygon = L.polygon(obj.geoShape.coordinates);
					var bounds = polygon.getBounds();
					Sig.execFullSearchNominatim(0, bounds);
				}
				else{
					//on recherche partout
					Sig.execFullSearchNominatim(0);
				}
			}
			else{
				Sig.showCityOnMap(obj, true, "person");
			}

			if(typeof obj.name != "undefined"){
				$("#main-title-public2").html("<i class='fa fa-university'></i> "+obj.name);
				$("#main-title-public2").show();
			}
			hideLoadingMsg();
		}
		else {
			console.log("Erreur getlatlngbyinsee vide");
		}
	}
//quand la recherche par code insee n'a pas fonctionné
function callbackFindByInseeError(){
	console.log("erreur getlatlngbyinsee");
}


</script>