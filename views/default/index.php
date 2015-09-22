<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/okvideo/okvideo.min.js' , CClientScript::POS_END);
//Data helper
$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);

  
?>

<div class="pull-right" style="padding:20px;">
  <a href="#" onclick="showHideMenu ()">
    <i class="menuBtn fa fa-bars fa-3x text-white "></i>
  </a>
</div>


<div class="row">
  <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 center">
  <a class="byPHRight" href="#"><img style="height: 39px;position: fixed;left: 0px;bottom: 10px;z-index: 2000;" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/byPH.png"/></a>
    <!-- start: LOGIN BOX -->
    <?php 
    $this->renderPartial('menuTitle');
    $this->renderPartial('panels/what');
    $this->renderPartial('panels/how');
    $this->renderPartial('panels/why');
    $this->renderPartial('panels/where');
    $this->renderPartial('panels/when');
    $this->renderPartial('panels/who');
    $this->renderPartial('panels/events');
    $this->renderPartial('panels/cities');
    $this->renderPartial('panels/orga');
    $this->renderPartial('panels/people');
    $this->renderPartial('panels/involved');
    $this->renderPartial('panels/projects');
    $this->renderPartial('panels/ph');
    $this->renderPartial('panels/communecter');

    $this->renderPartial('panels/dashboard');    
    ?>
    
  </div>
  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2  center">
    <h1 class="panelTitle text-extra-large text-bold" style="display:none"></h1>
    <div class="box-ajax box box-white-round" style="top:0px;">
      <form class="form-login ajaxForm" style="display:none" action="" method="POST"></form>
    </div>
  </div>
</div>

<?php /* **********************
  ICON MARKER FLOTTANT
**************************** ?>
<div class="eventMarker" style="z-index:1;display:none;position:fixed; bottom:0px; right:50px;cursor:pointer;" >
  <img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/event.png" style="width:72px;" />
  <span class="homestead eventMarkerlabel" style="display:none;color:white;font-size:25px">EVENTS</span>
</div>
<div class="cityMarker" style="z-index:1;display:none;position:absolute; bottom:0px; right:150px;cursor:pointer;" >
  <span class="homestead cityMarkerlabel" style="display:none;color:white;font-size:25px">CITIES</span>
  <img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/mairie.png" style="width:72px;" />
</div>
<div class="projectMarker" style="z-index:1;display:none;position:absolute; bottom:0px; right:250px;cursor:pointer;" >
  <img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/project.png" style="width:72px;" />
  <span class="homestead projectMarkerlabel" style="display:none;color:white;font-size:25px">PROJECTS</span>
</div>
<div class="assoMarker" style="z-index:1;display:none;position:absolute;bottom:0px; right:350px; cursor:pointer;" >
  <span class="homestead assoMarkerlabel" style="display:none;color:white;font-size:25px">ORGANIZATIONS</span>
  <img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/asso.png" style="width:72px;" />
</div>
<div class="userMarker" style="z-index:1;display:none;position:absolute; bottom:0px; right:450px;cursor:pointer;" >
  <span class="homestead userMarkerlabel" style="display:none;color:white;font-size:25px">PEOPLE</span>
  <img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/user.png" style="width:72px;" />
</div>

<?php /* **********************
  LEFT MENU
**************************** */?>
<div class="center text-white" style="z-index:1;position:absolute; top:50px; left:25px;" >
    <div class="center text-white pull-left">
        <a href="#" onclick="showPanel('box-login',null,'<?php echo Yii::app()->session['user']['name'] ?>')" class="text-white"><i class="fa fa-home fa-2x"></i></a>
        <br/><br/><a href="#" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/person/directory/?tpl=directory2&type=<?php echo Person::COLLECTION ?>', 'PERSON DIRECTORY ','user' )" class="text-white"><i class="fa fa-user fa-2x"></i></a>
        <?php //onclick="showPanel('box-people',null,'PEOPLE','user')" ?>
        <br/><br/><a href="#" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/person/directory/?tpl=directory2&type=<?php echo Organization::COLLECTION ?>', 'ORGANIZATION DIRECTORY ','users' )" class="text-white"><i class="fa fa-users fa-2x"></i></a>
        <?php //showPanel('box-orga',null,'ORGANIZATIONS','users') ?>
        <br/><br/><a href="#" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/person/directory/?tpl=directory2&type=<?php echo Event::COLLECTION ?>', 'EVENT DIRECTORY ','calender' )" class="text-white"><i class="fa fa-calendar fa-2x"></i></a>
        <?php //showPanel('box-event',null,'EVENTS','calendar') ?>
        <br/><br/><a href="#" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/person/directory/?tpl=directory2&type=<?php echo Project::COLLECTION ?>', 'PROJECT DIRECTORY ','calender' )" class="text-white"><i class="fa fa-lightbulb-o fa-2x"></i></a>
        <?php //showPanel('box-projects',null,'PROJECTS','lightbulb-o') ?>
        <br/><br/><a href="#" onclick="showMap(true)" class="text-white"><i class="fa fa-map-marker fa-2x"></i></a>
        <br/><br/><a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout') ?>" class="text-white"><i class="fa fa-sign-out fa-2x"></i></a>
    </div>
</div>

<?php /* **********************
  CONTEXT TITLE
**************************** */?>
<div class="center text-white pull-left" style="z-index:1;position:absolute; top:10px; left:70px; " >
    <span class="homestead moduleLabel" style="color:white;font-size:25px"></span>
</div>

<?php /* **********************
  PARTNER LOGOS
**************************** */?>
<img class="partnerLogosLeft" src="<?php echo $this->module->assetsUrl?>/images/partners/Logo_Bis-01.png" style="width:90px;position:absolute; top:500px; left:400px;display:none;" />
<img class="partnerLogosLeft" src="<?php echo $this->module->assetsUrl?>/images/partners/logo-cn.png" style="display:none;position:absolute; top:150px; left:150px;" />
<img class="partnerLogosLeft" src="<?php echo $this->module->assetsUrl?>/images/partners/logo_lc.png" style="width:120px;display:none;position:absolute; top:350px; right:100px;cursor:pointer;" />

<img class="partnerLogosRight" src="<?php echo $this->module->assetsUrl?>/images/partners/demosalithia.png" style="display:none;position:absolute; top5:0px; left:50px; cursor:pointer;" />
<img class="partnerLogosRight" src="<?php echo $this->module->assetsUrl?>/images/partners/ggouv.png" style="display:none;position:absolute; top:600px; right:200px;cursor:pointer;" />
<img class="partnerLogosRight" src="<?php echo $this->module->assetsUrl?>/images/partners/SENSORICA.jpg" style="width:120px;display:none;position:absolute; top:150px; right:200px; cursor:pointer;" />

<img class="partnerLogosDown" src="<?php echo $this->module->assetsUrl?>/images/partners/DO.png" style="width:120px;display:none;position:absolute; top:330px; left:100px; cursor:pointer;" />
<img class="partnerLogosDown" src="<?php echo $this->module->assetsUrl?>/images/partners/fab-lab1.png" style="width:80px;display:none;position:absolute; top:610px; left:90px; cursor:pointer;" />
<img class="partnerLogosDown" src="<?php echo $this->module->assetsUrl?>/images/partners/smartCitizen.png" style="display:none;position:absolute; top:750px; right:400px; cursor:pointer;" />

<img class="partnerLogosUp" src="<?php echo $this->module->assetsUrl?>/images/logo_region_reunion.png" style="width:80px;display:none;position:absolute; bottom:20px; left:20px; cursor:pointer;" />
<img class="partnerLogosUp" src="<?php echo $this->module->assetsUrl?>/images/technopole.jpg" style="display:none;position:absolute; bottom:20px; right:20px; cursor:pointer;" />
<img class="partnerLogosUp" src="<?php echo $this->module->assetsUrl?>/images/partners/imaginSocial.jpg" style="display:none; position:absolute; top:600px; right:550px; cursor:pointer;" />

<?php /* ?>

http://habibhadi.com/lab/svgPathAnimation/demo/
http://jonobr1.github.io/two.js/#basic-usage
http://rvlasveld.github.io/blog/2013/07/02/creating-interactive-graphs-with-svg-part-1/

<style type="text/css">
svg.graph {
  position: absolute;
  top:0px;
  left: 0px;
  height: 1000px;
  width: 1000px;
}

svg.graph .line {
  stroke: white;
  stroke-width: 1;
}
</style>

<svg class="graph">
  <circle cx="0" cy="0" stroke="white" fill="white" r="5"></circle>
  <path class="line" d=" M 0 0 L 600 100"></path>
  <path class="line" d=" M 0 0 L 150 150"></path>
  <path class="line" d=" M 0 0 L 330 100"></path>
</svg>
*/?>
<script type="text/javascript">

  jQuery(document).ready(function() {

    Main.init();
    Login.init(); 
    titleAnim (); 
    if (email != "") {
      $(".form-login #email").val( email );
    }
    
    if (userValidated) {
      $(".errorHandler").hide();
      $(".emailValidated").show();
      $(".form-login #password").focus();
    }
    $(".eventMarker").show().addClass("animated slideInDown").off().on("click",function() { 
      showPanel('box-event',null,"EVENTS");
    });
    $(".cityMarker").show().addClass("animated slideInUp").off().on("click",function() { 
      showPanel('box-city',null,"CITY");
    });
    $(".projectMarker").show().addClass("animated zoomInRight").off().on("click",function() { 
      showPanel('box-projects',null,"PROJECTS");
    });
    $(".assoMarker").show().addClass("animated zoomInLeft").off().on("click",function() { 
      showPanel('box-orga',null,"ORGANIZATIONS");
    });
    $(".userMarker").show().addClass("animated zoomInLeft").off().on("click",function() { 
      showPanel('box-people',null,"PEOPLE");
    });

    $(".byPHRight").show().addClass("animated zoomInLeft").off().on("click",function() { 
      showPanel('box-ph');
    });
  
  });

var email = '<?php echo @$_GET["email"]; ?>';
var userValidated = '<?php echo @$_GET["userValidated"]; ?>';

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
                } else {
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
          "type"  : emailType
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

function sendEmailValidation() {
  var params = { 
    "email" : $("#email").val(),
    "type"  : "validation"
  };

    $.ajax({
      type: "POST",
      url: baseUrl+"/<?php echo $this->module->id?>/person/sendemail",
      data: params,
      success: function(data){
    if (data.result) {
      alert(data.msg);
            window.location.reload();
    } else {
      toastr.error("Something went wrong : "+data.msg);
    }
      },
      error: function(data) {
      toastr.error("Something went really bad : contact your administrator !");
    },
      dataType: "json"
    });
}

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
