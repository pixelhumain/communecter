<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
?>

<script type='text/javascript'>
$(window).load(function(){




(function(t,e){if(typeof exports=="object")module.exports=e();else if(typeof define=="function"&&define.amd)define(e);else t.Spinner=e()})(this,function(){"use strict";var t=["webkit","Moz","ms","O"],e={},i;function o(t,e){var i=document.createElement(t||"div"),o;for(o in e)i[o]=e[o];return i}function n(t){for(var e=1,i=arguments.length;e<i;e++)t.appendChild(arguments[e]);return t}var r=function(){var t=o("style",{type:"text/css"});n(document.getElementsByTagName("head")[0],t);return t.sheet||t.styleSheet}();function s(t,o,n,s){var a=["opacity",o,~~(t*100),n,s].join("-"),f=.01+n/s*100,l=Math.max(1-(1-t)/o*(100-f),t),u=i.substring(0,i.indexOf("Animation")).toLowerCase(),d=u&&"-"+u+"-"||"";if(!e[a]){r.insertRule("@"+d+"keyframes "+a+"{"+"0%{opacity:"+l+"}"+f+"%{opacity:"+t+"}"+(f+.01)+"%{opacity:1}"+(f+o)%100+"%{opacity:"+t+"}"+"100%{opacity:"+l+"}"+"}",r.cssRules.length);e[a]=1}return a}function a(e,i){var o=e.style,n,r;i=i.charAt(0).toUpperCase()+i.slice(1);for(r=0;r<t.length;r++){n=t[r]+i;if(o[n]!==undefined)return n}if(o[i]!==undefined)return i}function f(t,e){for(var i in e)t.style[a(t,i)||i]=e[i];return t}function l(t){for(var e=1;e<arguments.length;e++){var i=arguments[e];for(var o in i)if(t[o]===undefined)t[o]=i[o]}return t}function u(t){var e={x:t.offsetLeft,y:t.offsetTop};while(t=t.offsetParent)e.x+=t.offsetLeft,e.y+=t.offsetTop;return e}function d(t,e){return typeof t=="string"?t:t[e%t.length]}var p={lines:12,length:7,width:5,radius:10,rotate:0,corners:1,color:"#000",direction:1,speed:1,trail:100,opacity:1/4,fps:20,zIndex:2e9,className:"spinner",top:"auto",left:"auto",position:"relative"};function c(t){if(typeof this=="undefined")return new c(t);this.opts=l(t||{},c.defaults,p)}c.defaults={};l(c.prototype,{spin:function(t){this.stop();var e=this,n=e.opts,r=e.el=f(o(0,{className:n.className}),{position:n.position,width:0,zIndex:n.zIndex}),s=n.radius+n.length+n.width,a,l;if(t){t.insertBefore(r,t.firstChild||null);l=u(t);a=u(r);f(r,{left:(n.left=="auto"?l.x-a.x+(t.offsetWidth>>1):parseInt(n.left,10)+s)+"px",top:(n.top=="auto"?l.y-a.y+(t.offsetHeight>>1):parseInt(n.top,10)+s)+"px"})}r.setAttribute("role","progressbar");e.lines(r,e.opts);if(!i){var d=0,p=(n.lines-1)*(1-n.direction)/2,c,h=n.fps,m=h/n.speed,y=(1-n.opacity)/(m*n.trail/100),g=m/n.lines;(function v(){d++;for(var t=0;t<n.lines;t++){c=Math.max(1-(d+(n.lines-t)*g)%m*y,n.opacity);e.opacity(r,t*n.direction+p,c,n)}e.timeout=e.el&&setTimeout(v,~~(1e3/h))})()}return e},stop:function(){var t=this.el;if(t){clearTimeout(this.timeout);if(t.parentNode)t.parentNode.removeChild(t);this.el=undefined}return this},lines:function(t,e){var r=0,a=(e.lines-1)*(1-e.direction)/2,l;function u(t,i){return f(o(),{position:"absolute",width:e.length+e.width+"px",height:e.width+"px",background:t,boxShadow:i,transformOrigin:"left",transform:"rotate("+~~(360/e.lines*r+e.rotate)+"deg) translate("+e.radius+"px"+",0)",borderRadius:(e.corners*e.width>>1)+"px"})}for(;r<e.lines;r++){l=f(o(),{position:"absolute",top:1+~(e.width/2)+"px",transform:e.hwaccel?"translate3d(0,0,0)":"",opacity:e.opacity,animation:i&&s(e.opacity,e.trail,a+r*e.direction,e.lines)+" "+1/e.speed+"s linear infinite"});if(e.shadow)n(l,f(u("#000","0 0 4px "+"#000"),{top:2+"px"}));n(t,n(l,u(d(e.color,r),"0 0 1px rgba(0,0,0,.1)")))}return t},opacity:function(t,e,i){if(e<t.childNodes.length)t.childNodes[e].style.opacity=i}});function h(){function t(t,e){return o("<"+t+' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">',e)}r.addRule(".spin-vml","behavior:url(#default#VML)");c.prototype.lines=function(e,i){var o=i.length+i.width,r=2*o;function s(){return f(t("group",{coordsize:r+" "+r,coordorigin:-o+" "+-o}),{width:r,height:r})}var a=-(i.width+i.length)*2+"px",l=f(s(),{position:"absolute",top:a,left:a}),u;function p(e,r,a){n(l,n(f(s(),{rotation:360/i.lines*e+"deg",left:~~r}),n(f(t("roundrect",{arcsize:i.corners}),{width:o,height:i.width,left:i.radius,top:-i.width>>1,filter:a}),t("fill",{color:d(i.color,e),opacity:i.opacity}),t("stroke",{opacity:0}))))}if(i.shadow)for(u=1;u<=i.lines;u++)p(u,-2,"progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)");for(u=1;u<=i.lines;u++)p(u);return n(e,l)};c.prototype.opacity=function(t,e,i,o){var n=t.firstChild;o=o.shadow&&o.lines||0;if(n&&e+o<n.childNodes.length){n=n.childNodes[e+o];n=n&&n.firstChild;n=n&&n.firstChild;if(n)n.opacity=i}}}var m=f(o("group"),{behavior:"url(#default#VML)"});if(!a(m,"transform")&&m.adj)h();else i=a(m,"animation");return c});





var opts = {
  lines: 13, // The number of lines to draw
  length: 20, // The length of each line
  width: 10, // The line thickness
  radius: 30, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 0, // The rotation offset
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#000', // #rgb or #rrggbb or array of colors
  speed: 1, // Rounds per second
  trail: 60, // Afterglow percentage
  shadow: false, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: 'auto', // Top position relative to parent in px
  left:'auto' // Left position relative to parent in px
};


var target = document.getElementById('searching_spinner_center');
var spinner = new Spinner(opts).spin(target);
});
</script>

<div class="row">


<div id="Searching_Modal" class="modal fade" tabindex="-1" role="dialog" data-keyboard="false"
         data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center">
                    <h3>Login ...</h3>
                </div>
                <div class="modal-body" >
                    <div style="height:200px">
                      <span id="searching_spinner_center" style="position: absolute;display: block;top: 50%;left: 50%;"></span>
                      <div class="errorHandler alert alert-danger no-display loginResult">
					<i class="fa fa-remove-sign"></i> Please verify your entries.
				</div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: center"></div>
            </div>
        </div>
</div>


	<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		<div class="logo">
			<img height="30" src="<?php echo $this->module->assetsUrl?>/images/COMMUNECTION.png"/>
		</div>
		<!-- start: LOGIN BOX -->
		<div class="box-login">
			<img height="80" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logo.png"/>
			<h3>Sign in to your account</h3>
			<p>
				Please enter your name and password to log in.
			</p>
			<form class="form-login" action="" method="POST">
				
				<fieldset>
					<div class="form-group">
						<span class="input-icon">		
							<input type="text" class="form-control" name="email" id="email" placeholder="Email">
							<i class="fa fa-user"></i> </span>
					</div>
					<div class="form-group form-actions">
						<span class="input-icon">
							<input type="password" class="form-control password"  name="password" id="password" placeholder="Password">
							<i class="fa fa-lock"></i>
							<a class="forgot" href="#">
								I forgot my password
							</a> </span>
					</div>
					<div class="form-actions">
						<label for="remember" class="checkbox-inline">
							<input type="checkbox" class="grey remember" id="remember" name="remember">
							Keep me signed in
						</label>
						<button type="submit" class="btn btn-green pull-right">
							Login <i class="fa fa-arrow-circle-right"></i>
						</button>
					</div>
					<div class="new-account">
						Don't have an account yet?
						<a href="#" class="register">
							Create an account
						</a>
					</div>
				</fieldset>
			</form>
			<!-- start: COPYRIGHT -->
			<div class="copyright">
				2014  <?php echo (isset($this->projectImage)) ? '<img height="30" src="'.$this->module->assetsUrl.$this->projectImage.'"/>' : "<i class='fa fa-close'>/i>";?>
			</div>
			<!-- end: COPYRIGHT -->
		</div>
		<!-- end: LOGIN BOX -->
		<!-- start: FORGOT BOX -->
		<div class="box-forgot">
			<img height="80" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logo.png"/>
			<h3>Forget Password?</h3>
			<p>
				Enter your e-mail address below to get your password by email.
			</p>
			<form class="form-forgot">
				<div class="errorHandler alert alert-danger no-display">
					<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
				</div>
				<fieldset>
					<div class="form-group">
						<span class="input-icon">
							<input type="email" class="form-control" id="email2" placeholder="Email">
							<i class="fa fa-envelope"></i> </span>
					</div>
					<div class="form-actions">
						<a class="btn btn-light-grey go-back">
							<i class="fa fa-chevron-circle-left"></i> Log-In
						</a>
						<button type="submit" class="btn btn-green pull-right">
							Submit <i class="fa fa-arrow-circle-right"></i>
						</button>
					</div>
				</fieldset>
			</form>
			<!-- start: COPYRIGHT -->
			<div class="copyright">
				2014  <?php echo (isset($this->projectImage)) ? '<img height="30" src="'.$this->module->assetsUrl.$this->projectImage.'"/>' : "<i class='fa fa-close'>/i>";?>
			</div>
			<!-- end: COPYRIGHT -->
		</div>
		<!-- end: FORGOT BOX -->
		<!-- start: REGISTER BOX -->
		<div class="box-register">
			<img height="80" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logo.png"/>
			<h3>Sign Up</h3>
			<p>
				Enter your personal details below:
			</p>
			<form class="form-register">
				<div class="errorHandler alert alert-danger no-display">
					<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
				</div>
				<fieldset>
					<div class="form-group">
						<span class="input-icon">
							<input type="text" class="form-control" id="name" placeholder="Nom">
							<i class="fa fa-user"></i> </span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="email" class="form-control" id="email3" placeholder="Email">
							<i class="fa fa-envelope"></i> </span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="password" class="form-control" id="password3" placeholder="Password">
							<i class="fa fa-lock"></i> </span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="text" class="form-control" id="cp" placeholder="Postal Code">
							<i class="fa fa-home"></i></span>
					</div>
					<div class="form-group">
						<div>
							<label for="agree" class="checkbox-inline">
								<input type="checkbox" class="grey agree" id="agree" name="agree">
								I agree to the Terms of Service and Privacy Policy
							</label>
						</div>
					</div>

					<div class="form-actions">
						Already have an account?
						<a href="#" class="go-back">
							Log-in
						</a>
						<button type="submit" class="btn btn-green pull-right">
							Submit <i class="fa fa-arrow-circle-right"></i>
						</button>
					</div>
				</fieldset>
			</form>
			<!-- start: COPYRIGHT -->
			<div class="copyright">
				2014  <?php echo (isset($this->projectImage)) ? '<img height="30" src="'.$this->module->assetsUrl.$this->projectImage.'"/>' : "<i class='fa fa-close'>/i>";?>
			</div>
			<!-- end: COPYRIGHT -->
		</div>
		<!-- end: REGISTER BOX -->
	</div>
</div>
<script type="text/javascript">
	

	jQuery(document).ready(function() {
		Main.init();
		Login.init();
		
	
	});

var Login = function() {
	"use strict";
	var runBoxToShow = function() {
		var el = $('.box-login');
		if (getParameterByName('box').length) {
			switch(getParameterByName('box')) {
				case "register" :
					el = $('.box-register');
					break;
				case "forgot" :
					el = $('.box-forgot');
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
			$('.box-forgot').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");

			});
		});
		$('.register').on('click', function() {
			$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).hide().removeClass("animated bounceOutRight");

			});
			$('.box-register').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");

			});

		});
		$('.go-back').click(function() {
			var boxToShow;
			if ($('.box-register').is(":visible")) {
				boxToShow = $('.box-register');
			} else {
				boxToShow = $('.box-forgot');
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
				$('#Searching_Modal').modal('show');
				errorHandler.hide();
				var params = { 
				   "email" : $("#email").val() , 
                   "pwd" : $("#password").val()
                };
                
			      
		    	$.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/api/login",
		    	  data: params,
		    	  success: function(data){
		    		  if(data.result)
		    		  {
		        		window.location.reload();
		    		  }
		    		  else {
						$('.loginResult').html(data.msg);
						$('.loginResult').show();
						
						$('#searching_spinner_center').hide();
		    		  }
		    	  },
		    	  dataType: "json"
		    	});
			    return false; // required to block normal submit since you used ajax
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler.show();
				$('#Searching_Modal').modal('hide');
			}
		});
	};
	var runForgotValidator = function() {
		var form2 = $('.form-forgot');
		var errorHandler2 = $('.errorHandler', form2);
		form2.validate({
			rules : {
				email2 : {
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler2.hide();
				var params = { "email" : $("#email2").val()};
		        $.ajax({
		          type: "POST",
		          url: baseUrl+"/<?php echo $this->module->id?>/api/sendemailpwd",
		          data: params,
		          success: function(data){
		              alert(data.msg);
		          },
		          dataType: "json"
		        });
		        return false;
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler2.show();
			}
		});
	};
	var runRegisterValidator = function() {
		var form3 = $('.form-register');
		var errorHandler3 = $('.errorHandler', form3);
		form3.validate({
			rules : {
				cp : {
					maxlength : 5,
					required : true
				},
				name : {
					required : true
				},
				email3 : {
					required : true
				},
				password3 : {
					minlength : 4,
					required : true
				},
				agree : {
					minlength : 1,
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler3.hide();
				var params = { 
				   "name" : $("#name").val() ,
				   "email" : $("#email3").val() , 
                   "pwd" : $("#password3").val(),
                   "cp" : $("#cp").val(),
                   "app" : "<?php echo $this->module->id?>"
                };
			      
		    	$.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/api/saveUser",
		    	  data: params,
		    	  success: function(data){
		    		  if(data.result)
		    		  {
		        		window.location.reload();
		    		  }
		    		  else {
						$('.loginResult').html(data.msg);
						$('.loginResult').show();
		    		  }
		    	  },
		    	  dataType: "json"
		    	});
			    return false;
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler3.show();
			}
		});
	};
	return {
		//main function to initiate template pages
		init : function() {
			runBoxToShow();
			runLoginButtons();
			runSetDefaultValidation();
			runLoginValidator();
			runForgotValidator();
			runRegisterValidator();
		}
	};
}();

</script>