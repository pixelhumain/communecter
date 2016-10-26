<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/okvideo/okvideo.min.js' , CClientScript::POS_END);
//Data helper
$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);
?>

<div class="pull-right" style="padding:20px;">
	<a href="#" onclick="showMenu()">
		<i class="menuBtn fa fa-bars fa-3x text-white "></i>
	</a>
</div>

<!-- start: LOGIN BOX -->
<div class="padding-20 center">
	<span class="text-red " style="font-size:40px">CROWD</span>
	<span  style="font-size:40px" class=" "> FUNDING</span>
	<span  style="font-size:40px" class=" text-red "> SIMULATION</span>

	<br/>
	<span class="titleRed text-red homestead" style="font-size:40px">CO</span>
	<span  style="font-size:40px" class="titleWhite homestead">MMU</span>
	<span  style="font-size:40px" class="titleWhite2 text-red homestead">NECTER</span>
	<a href="#" class="text-white" onclick="showVideo('133636468')"><i class="fa fa-2x fa-youtube-play"></i></a>

	<br/>
	<span class="subTitle text-white text-bold" style="margin-top:-13px; font-size:1.5em">Se connecter à sa commune.</span>

	<br/>
	<span  style="font-size:23px" class="text-white text-bold"> Open Atlas Members : 385 | </span>
	<span  style="font-size:23px" class="text-white text-bold"> Contributors : 5 | </span>
	<span  style="font-size:23px" class="text-white text-bold"> Promises : 2000€ | </span>
	<span  style="font-size:23px" class="text-white text-bold"> Visitors : 15</span>
</div>
<?php 
$this->renderPartial('../person/menuTitle',array("topTitleExists"=>true,"actionTitle"=>"CONTRIBUTE", "actionIcon"=>"fa-money"));
?>

<div class="row fund-row" >
	
	<div class="col-xs-12 col-sm-4 center">
		<!-- start: REGISTER BOX -->
		<div class="box-fund box-pod box">
			<img style="width:100%" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logoL.jpg"/>
			Hey les amis, si toi aussi tu aimes manger des patates 
			<br/> tu vas aimer te communecter pour manger encore plus de patates
			<br/> mais avant de manger les patates, tu veux nous aider a les acheter ?	
			<br/> Je t'embete avec ce formulaire, car j'aimerais savoir 
			<br/> si tu amerais participer a une belle aventure 
			<br/>
			<br/> tu vas aimer te communecter pour manger encore plus de patates
			<br/> mais avant de manger les patates, tu veux nous aider a les acheter ?	
			<br/> Je t'embete avec ce formulaire, car j'aimerais savoir 
			<br/> si tu amerais participer a une belle aventure 
		</div>
	</div>

	<div class=" col-xs-12 col-sm-4 " >
		
		<div class="box-fund box-pod box margin-10" style="padding-left:40px">
			<span class="text-extra-large text-bold">What do you want to fund</span>
			<br/><label for="fund1" class="checkbox-inline"><input type="checkbox" id="fund1" class="grey"/> Our Team can remain in dev <span class="badge"> 1</span></label>
			<br/><label for="fund2" class="checkbox-inline"><input type="checkbox" id="fund2" class="grey"/> Mobile version <span class="badge"> 5</span></label>
			<br/>New modules like : 
			<br/><label for="fund3" class="checkbox-inline"><input type="checkbox" id="fund3" class="grey" /> Voting system <span class="badge"> 2</span></label>
			<br/><label for="fund4" class="checkbox-inline"><input type="checkbox" id="fund4" class="grey"/> Action Rooms <span class="badge"> 1</span></label>
		</div>
		
		<div class="box-fund box-pod box margin-10" style="padding-left:40px">
			<span class="text-extra-large text-bold">YOU GAVE US , WE GIVE YOU </span>
			<br/><label for="gift1" class="checkbox-inline"><input type="checkbox" id="gift1" class="grey" checked disabled/> Association Member <span class="badge"> 1</span></label>
			<br/><label for="gifts" class="checkbox-inline"><input type="radio" id="gifts" class="grey"/> Gift1<span class="badge"> 1</span></label>
			<br/><label for="gifts" class="checkbox-inline"><input type="radio" id="gifts" class="grey"/> Gift2<span class="badge"> 1</span></label>
			<br/><label for="gifts" class="checkbox-inline"><input type="radio" id="gifts" class="grey"/> Gift3<span class="badge"> 1</span></label>
			<br/>For <span class="nextAmount">xx</span>€ more get this 
			<br/>Next Gift <span class="badge"> 2</span>
			<br/>Next Gift <span class="badge"> 2</span>
			<br/>Next Gift <span class="badge"> 2</span>
		</div>

		<div class="box-fund box-pod box margin-10">

			<div class="col-sm-6 col-xs-12">
				<span class="text-extra-large text-bold">A few numbers</span>
				<ul class="list-group ">
					<li class="list-group-item ">CONTRIBUTORS : 5</li>
					<li class="list-group-item ">PROMISES : 2000€</li>
					<li class="list-group-item ">VISITORS : 15</li>
					<li class="list-group-item ">SINCE : 15days</li>
					<li class="list-group-item ">Asso. MEMBERS : 500</li>
				</ul>
			</div>
			<div class="col-sm-6 col-xs-12">
				<span class="text-extra-large text-bold">A few dates</span>
				<ul class="list-group ">
					<li class="list-group-item ">NOW : NEED YOUR HELP</li>
					<li class="list-group-item ">OPENING : 31 Sept 2015</li>
					<li class="list-group-item ">STARTED DEV : 01 Feb 2015</li>
					<li class="list-group-item ">PROJECT STARTED : Oct 2012</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-4 center ">
		
		<!-- start: REGISTER BOX -->
		<div class="box-fund box-pod box " style="background-color: white">
			
			<span class="text-extra-large text-bold">WANT TO CONTRIBUTE ?</span>
			<form class="form-register">
				
					<fieldset style="padding-left:70px;padding-right:70px;">
						<div class="space20"></div>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" id="name" name="name" placeholder="Prénom Nom : John Doe">
								<i class="fa fa-user"></i> 
							</span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" id="email3" name="email3" placeholder="Email">
								<i class="fa fa-envelope"></i> 
							</span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" id="cp" name="cp" placeholder="Postal Code">
								<i class="fa fa-home"></i>
							</span>
						</div>
						<div class="form-group" id="cityDiv" style="display: none;">
							<span class="input-icon">
								<select class="selectpicker form-control" id="city" name="city" title='Select your City...'>
								</select>
							</span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<select class="selectpicker form-control" id="amount" name="amount" >
									<option value="">Help us fund it ? </option>
									<option value="0">Just Like the project, and will participate</option>
									<option value="1">Donate 1€</option>
									<option value="5">Donate 5€</option>
									<option value="12">Donate 12€ = 1€ / month</option>
									<option value="20">Donate 20€</option>
									<option value="50">Donate 50€</option>
									<option value="100">Donate 100€</option>
									<option value="300">Donate 300€</option>
									<option value="500">Donate 500€</option>
									<option value="800">Donate 800€</option>
									<option value="1000">Donate 1K€</option>
									<option value="5000">Donate 5K€</option>
								</select>
							</span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<select class="selectpicker form-control" id="inExchange" name="inExchange" title='Contrepartie ?'>
									<option value="">in exchange ?</option>
									<option value="">Un slip rose</option>
									<option value="">etre membre de l'association</option>
									<option value="">recevoir un TShirt</option>
								</select>
							</span>
						</div>
						
						<div class="form-group">
							<div>
								<label for="joinOpal" class="checkbox-inline">
									<input type="checkbox" class="grey agree" id="joinOpal" name="joinOpal">
									become member of Open Atlas Association (20€)
								</label>
							</div>
						</div>

						<div class="form-group">
							<div>
								<label for="agree" class="checkbox-inline">
									<input type="checkbox" class="grey agree" id="agree" name="agree">
									I'll eat 100 patatoes <a href="#" class="bootbox-spp">if I brake my promise</a>
								</label>
							</div>
						</div>

						<div class="form-actions">
							<div class="errorHandler alert alert-danger no-display registerResult">
								<i class="fa fa-remove-sign"></i> Please verify your entries.
							</div>
							<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="createBtn ladda-button pull-right">
								<span class="ladda-label">Submit</span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
							</button>
						</div>
					</fieldset>
			</form>
			<!-- end: COPYRIGHT -->
		</div>
		<!-- end: REGISTER BOX -->
	</div>
	
</div>

<div class="row partners-row" style="display:none" >
	<div class="panel panel-white col-xs-8 col-xs-offset-2 ">
		<div class="panel-heading border-light ">
			<h4 class="panel-title"> <i class='fa fa-commentsfa-2x icon-big text-center '></i> DISCUSS</h4>
		</div>
		<div class="panel-body">
			<h1></h1>

			<div class="space20">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, similique autem, neque provident hic placeat in magnam temporibus laborum, corporis tenetur cumque tempora sit cum dignissimos. Animi molestiae nostrum consequuntur.</div>
			<div class="space20">Iusto quis facilis officia ullam! Impedit corporis pariatur exercitationem, explicabo possimus nemo non perferendis officiis quam molestias aliquid, doloremque, provident itaque quos fugiat sit totam temporibus repellendus vitae. Culpa, incidunt.</div>
			<div class="space20">Quos impedit aliquid nemo magnam ipsam corporis sint, distinctio mollitia sunt harum animi, inventore officia. Vitae similique eaque, consequatur voluptatibus, sunt velit adipisci explicabo maxime. Aperiam et totam ipsa molestias.</div>
			<div class="space20">Optio debitis, id nisi, dolorem, ab iure cumque vero modi eos quisquam unde soluta, blanditiis repellendus fugit delectus perspiciatis accusamus quidem animi voluptates. Eius magni voluptatibus exercitationem est, nostrum deleniti!</div>
		</div>
	</div>
</div>
</div>

<div class="row actors-row" style="display:none" >
	<div class="panel panel-white col-xs-8 col-xs-offset-2 ">
		<div class="panel-heading border-light ">
			<h4 class="panel-title"> <i class='fa fa-commentsfa-2x icon-big text-center '></i> DECIDE</h4>
		</div>
		<div class="panel-body">
			<h1></h1>

			<div class="space20">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, similique autem, neque provident hic placeat in magnam temporibus laborum, corporis tenetur cumque tempora sit cum dignissimos. Animi molestiae nostrum consequuntur.</div>
			<div class="space20">Iusto quis facilis officia ullam! Impedit corporis pariatur exercitationem, explicabo possimus nemo non perferendis officiis quam molestias aliquid, doloremque, provident itaque quos fugiat sit totam temporibus repellendus vitae. Culpa, incidunt.</div>
			<div class="space20">Quos impedit aliquid nemo magnam ipsam corporis sint, distinctio mollitia sunt harum animi, inventore officia. Vitae similique eaque, consequatur voluptatibus, sunt velit adipisci explicabo maxime. Aperiam et totam ipsa molestias.</div>
			<div class="space20">Optio debitis, id nisi, dolorem, ab iure cumque vero modi eos quisquam unde soluta, blanditiis repellendus fugit delectus perspiciatis accusamus quidem animi voluptates. Eius magni voluptatibus exercitationem est, nostrum deleniti!</div>
		</div>
	</div>
</div>


<div class="row stats-row" style="display:none" >
	<div class="panel panel-white col-xs-8 col-xs-offset-2 ">
		<div class="panel-heading border-light ">
			<h4 class="panel-title"> <i class='fa fa-commentsfa-2x icon-big text-center '></i> ACT</h4>
		</div>
		<div class="panel-body">
			<h1></h1>

			<div class="space20">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, similique autem, neque provident hic placeat in magnam temporibus laborum, corporis tenetur cumque tempora sit cum dignissimos. Animi molestiae nostrum consequuntur.</div>
			<div class="space20">Iusto quis facilis officia ullam! Impedit corporis pariatur exercitationem, explicabo possimus nemo non perferendis officiis quam molestias aliquid, doloremque, provident itaque quos fugiat sit totam temporibus repellendus vitae. Culpa, incidunt.</div>
			<div class="space20">Quos impedit aliquid nemo magnam ipsam corporis sint, distinctio mollitia sunt harum animi, inventore officia. Vitae similique eaque, consequatur voluptatibus, sunt velit adipisci explicabo maxime. Aperiam et totam ipsa molestias.</div>
			<div class="space20">Optio debitis, id nisi, dolorem, ab iure cumque vero modi eos quisquam unde soluta, blanditiis repellendus fugit delectus perspiciatis accusamus quidem animi voluptates. Eius magni voluptatibus exercitationem est, nostrum deleniti!</div>
		</div>
	</div>
</div>

<div class="row timeline-row" style="display:none" >
	<div class="panel panel-white col-xs-8 col-xs-offset-2 ">
		<div class="panel-heading border-light ">
			<h4 class="panel-title"> <i class='fa fa-commentsfa-2x icon-big text-center '></i> ACT</h4>
		</div>
		<div class="panel-body">
			<h1></h1>

			<div class="space20">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, similique autem, neque provident hic placeat in magnam temporibus laborum, corporis tenetur cumque tempora sit cum dignissimos. Animi molestiae nostrum consequuntur.</div>
			<div class="space20">Iusto quis facilis officia ullam! Impedit corporis pariatur exercitationem, explicabo possimus nemo non perferendis officiis quam molestias aliquid, doloremque, provident itaque quos fugiat sit totam temporibus repellendus vitae. Culpa, incidunt.</div>
			<div class="space20">Quos impedit aliquid nemo magnam ipsam corporis sint, distinctio mollitia sunt harum animi, inventore officia. Vitae similique eaque, consequatur voluptatibus, sunt velit adipisci explicabo maxime. Aperiam et totam ipsa molestias.</div>
			<div class="space20">Optio debitis, id nisi, dolorem, ab iure cumque vero modi eos quisquam unde soluta, blanditiis repellendus fugit delectus perspiciatis accusamus quidem animi voluptates. Eius magni voluptatibus exercitationem est, nostrum deleniti!</div>
		</div>
	</div>
</div>


<div class=" contact-row  " style="display:none" >
	<div class="col-xs-8 col-xs-offset-2">
			<div class="space20">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, similique autem, neque provident hic placeat in magnam temporibus laborum, corporis tenetur cumque tempora sit cum dignissimos. Animi molestiae nostrum consequuntur.</div>
			<div class="space20">Iusto quis facilis officia ullam! Impedit corporis pariatur exercitationem, explicabo possimus nemo non perferendis officiis quam molestias aliquid, doloremque, provident itaque quos fugiat sit totam temporibus repellendus vitae. Culpa, incidunt.</div>
			<div class="space20">Quos impedit aliquid nemo magnam ipsam corporis sint, distinctio mollitia sunt harum animi, inventore officia. Vitae similique eaque, consequatur voluptatibus, sunt velit adipisci explicabo maxime. Aperiam et totam ipsa molestias.</div>
			<div class="space20">Optio debitis, id nisi, dolorem, ab iure cumque vero modi eos quisquam unde soluta, blanditiis repellendus fugit delectus perspiciatis accusamus quidem animi voluptates. Eius magni voluptatibus exercitationem est, nostrum deleniti!</div>
	</div>
</div>



<style type="text/css">
	.footerBtn{font-size: 2em; color:white; font-weight: bolder;}
</style>
<div class="visible-desktop hidden-phone visible-tablet" style="position:fixed; bottom:0px; left:0px;background-color: #E33551;width:100%;height:50px;">
	<div class="space10"></div>
	<div class="center">
		<a href="#" onclick="showMenu();showMenu('fund-row','bgcity')" class=" footerBtn">FUNDING . </a>
		<a href="#" onclick="showMenu();showMenu('partners-row','bgred')" class=" footerBtn">WE ARE NOT ALONE . </a>
		<a href="#" onclick="showMenu();showMenu('actors-row','bgblue')" class=" footerBtn">YOU ARE NOT ALONE . </a> 
		<a href="#" onclick="showMenu();showMenu('stats-row','bggreen')" class=" footerBtn">STATISTICS . </a>
		<a href="#" onclick="showMenu();showMenu('timeline-row')" class=" footerBtn">TIMELINE . </a> 
		<a href="#" onclick="showMenu();showMenu('contact-row')" class=" footerBtn">CONTACT </a> 
	</div>
	<div class="hide">
		<h5>Our Current Progress</h5>
		<div class="progress">
			<div class="progress-bar" style="width: 90%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar"> 60% </div>
		</div>
	</div>
</div>
<script type="text/javascript">

	jQuery(document).ready(function() {

		Login.init();	
		titleAnim ();	
	});

	var activePanel = "fund-row";
	function showHidePanels (panel) {  
		$('.'+activePanel).slideUp();
		$('.'+panel).slideDown();
		activePanel = panel;
	}

var timeout;
var Login = function() {
	"use strict";
	var runBoxToShow = function() {
		var el = $('.box-fund');
		if (getParameterByName('box').length) {
			switch(getParameterByName('box')) {
				case "register" :
					el = $('.box-fund');
					break;
			}
		}
		el.show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$(this).removeClass("animated flipInX");
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
	
	var runFundValidator = function() {
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
					required : true,
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
                   "app" : "<?php echo $this->module->id?>",
                   "city" : $("#city").val()
                };
			      
		    	$.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/person/register",
		    	  data: params,
		    	  success: function(data){
		    		  if(data.result)
		    		  {
		    		  	$.blockUI({
    		  				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
    		  	            '<blockquote>'+
    		  	              '<p>You will receive an email to validate your account.</p>'+
    		  	              '<cite>Welcome to the Pixel Humain</cite>'+
    		  	            '</blockquote> '
    		  			});
		        		toastr.success(data.msg+" , we'll contact you as soon as we open up! Thanks for joining.");
		        		//window.location.reload();
		        		setTimeout(function() { $.unblockUI(); showMenu(); },5000);
		    		  }
		    		  else {
						$('.registerResult').html(data.msg);
						$('.registerResult').show();
						createBtn.stop();
		    		  }
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
			runFundValidator();
			bindPostalCodeAction();
		}
	};
}();

function runShowCity(searchValue) {
	var citiesByPostalCode = getCitiesByPostalCode(searchValue);
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
}

function searchCity() {
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

</script>