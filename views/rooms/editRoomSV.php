<?php 
Menu::back();
$this->renderPartial('../default/panels/toolbar');
 ?>
<style type="text/css">
    blockquote{border-color: #2BB0C6; cursor: pointer;}
</style>

<h1 class="homestead center text-dark"><i class="fa fa-caret-down"></i> Quel type d'espace souhaitez-vous créer ?</h1><br/>
<div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 text-dark">
  <blockquote> 
<!--     <a class="thumb-info" href="<?php echo $this->module->assetsUrl; ?>/images/screenshots/survey.png" data-title="Proverbs, Culture, Art, Thoughts"  data-lightbox="all">
    <img id="img-header" class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/screenshots/survey.png"/>
    </a> -->
    <i class="fa fa-comments center fa-4x"></i>
    <br/><br/><a class="btn btn-success" href="javascript:;" onclick="" typeval="discuss"><span class="text-bold"><?php echo Yii::t('rooms', 'Create a discussion', null, Yii::app()->controller->module->id)?> <i class="fa fa-arrow-circle-right"></i></span></a>
    <br/><br><i class="fa fa-caret-right"></i> <?php echo Yii::t('rooms', "Let's talk about", null, Yii::app()->controller->module->id)?>
    <!-- <br><i class="fa fa-caret-right"></i> <?php echo Yii::t('rooms', 'Find questions to ask', null, Yii::app()->controller->module->id)?> -->
    <br><i class="fa fa-caret-right"></i> <?php echo Yii::t('rooms', 'Collective intelligence sometimes starts by talking', null, Yii::app()->controller->module->id)?>
    <!-- <br/><a class="btn btn-success" href="javascript:;" onclick=""><?php echo Yii::t( "common", 'Do this'); ?></a>  -->
  </blockquote>
</div>

<div class="col-xs-12 col-sm-6 col-md-5 text-dark">
  <blockquote> 
    <!-- <a class="thumb-info" href="<?php echo $this->module->assetsUrl; ?>/images/screenshots/discuss.png" data-title="Proverbs, Culture, Art, Thoughts"  data-lightbox="all">
      <img id="img-header" class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/screenshots/discuss.png"/>
    </a> -->
    <i class="fa fa-gavel center fa-4x"></i>
    <br/><br/><a class="btn btn-success" href="javascript:;" onclick="" typeval="discuss"><span class="text-bold"><?php echo Yii::t('rooms', 'Take decisions', null, Yii::app()->controller->module->id)?></span> <i class="fa fa-arrow-circle-right"></i></a>
    <!-- <br><?php echo Yii::t('rooms', 'Share Qestions', null, Yii::app()->controller->module->id)?> -->
    <!-- <br><?php echo Yii::t('rooms', 'Brainstorm', null, Yii::app()->controller->module->id)?> -->
    <br/><br><i class="fa fa-caret-right"></i> <?php echo Yii::t('rooms', 'Decide Collectivelly', null, Yii::app()->controller->module->id)?>
    <br><i class="fa fa-caret-right"></i> <?php echo Yii::t('rooms', 'to think, develop, build and decide collaboratively', null, Yii::app()->controller->module->id)?>
    <!-- <br/><a class="btn btn-success" href="javascript:;" onclick=""><?php echo Yii::t( "common", 'Do this'); ?></a>  -->
  </blockquote>
</div>

<div id="editRoomsContainer" class="hidden"></div>

<script type="text/javascript">
var listRoomTypes = <?php echo json_encode($listRoomTypes)?>;
var tagsList = <?php echo json_encode($tagsList)?>;
var roomFormDefinition = {
    "jsonSchema" : {
        "title" : "News Form",
        "type" : "object",
        "properties" : {
          "id" :{
              "inputType" : "hidden",
              "value" : "<?php echo (isset($_GET['id'])) ? $_GET['id'] : '' ?>"
            },
            "type" :{
              "inputType" : "hidden",
              "value" : "<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>"
            },
            "roomType" :{
                "inputType" : "select",
                "placeholder" : "<?php echo Yii::t('rooms', 'Type of Room', null, Yii::app()->controller->module->id)?>",
                "options" : listRoomTypes
              },
            "name" :{
              "inputType" : "text",
              "placeholder" : "Titre de la proposition",
              "rules" : {
                "required" : true
              }
            },
            "tags" :{
                "inputType" : "tags",
                "placeholder" : "Tags",
                "values" : tagsList
              },
        }
    }
};

var dataBind = {
   "#message" : "message",
   "#name" : "name",
   "#tags" : "tags",
   "#id"   : "parentId",
   "#type" : "parentType",
};

jQuery(document).ready(function() {
  console.warn("--------------- newRoom ---------------------");
  
  $(".moduleLabel").html("<i class='fa fa-comments'></i><span class='text-red'> Créer une nouvelle thématique</span>");

  //getAjax("#editRoomsContainer",baseUrl+"/"+moduleId+"/rooms/editRoom", "html");
  editRoomSV();
  $(".newRoom").off().on("click",function() { 
    console.warn("--------------- newRoom CLIK---------------------");
    //openSubView('Add a Room', '/communecter/rooms/editRoom',null,function(){editRoomSV ();});
  });
});

function editRoomSV (roomObj) { 
  console.warn("--------------- editEntrySV ---------------------");
  $("#editRoomsContainer").html("<div class='col-sm-8 col-sm-offset-2'>"+
              "<div class='space20'></div>"+
              "<h1 id='proposerloiFormLabel' ><?php echo Yii::t('rooms', 'New Room', null, Yii::app()->controller->module->id)?></h1>"+
              "<form id='ajaxForm'></form>"+
              "<div class='space20'></div>"+
                "<div class='clear'><?php echo Yii::t('rooms', 'Surveys contain subject to vote on, brainstorm sessions, discussions...', null, Yii::app()->controller->module->id)?></div>"+ 
              "</div>");
    
        var form = $.dynForm({
          formId : "#ajaxForm",
          formObj : roomFormDefinition,
          onLoad : function  () {
            if( roomObj ){
              $("#name").val(data.title);
            }
          },
          onSave : function(){
            console.log("saving Room!!");
            one = getRandomInt(0,10);
            two = getRandomInt(0,10);
            if( prompt("combien font "+one+"+"+two+" ?") == one+two )
            {
              $.blockUI({
                    message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
                          '<blockquote>'+
                            '<p>each Time I plant a seed'+
                              '<br/>they say kill it before it grows.</p>'+
                            '<cite title="Bob Marley ">Bob Marley </cite>'+
                          '</blockquote> '
                  });
              var params = { 
                 "email" : "<?php echo Yii::app()->session['userEmail']?>" , 
                 "name" : $("#name").val() , 
                 "tags" : $("#tags").val().split(","),
                 <?php  
                 //"cp" : "<?php echo (isset($survey['cp']) ) ? $survey['cp'] : ''" , 
                 ?>
                 "type" : $("#roomType").select2("val"), 
              };
              if( $("#type").val() != "")
                params.parentType = $("#type").val();
              if( $("#id").val() != "")
                params.parentId = $("#id").val();
             console.dir(params);
             $.ajax({
                type: "POST",
                url: '<?php echo Yii::app()->createUrl($this->module->id."/rooms/saveroom")?>',
                data: params,
                success: function(data){
                  if(data.result){

                      loadByHash("#rooms.index.type.<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>.id.<?php echo (isset($_GET['id'])) ? $_GET['id'] : '' ?>");
                  }
                  else {
                    toastr.error(data.msg);
                  }
                  $.unblockUI();
                },
                dataType: "json"
              });
          } else 
            alert("mauvaise réponse, etes vous humain ?");


            return false;
          }
        });
        console.dir(form);
      
   
}

/*
function editRoomSV (roomObj) { 
  console.warn("--------------- editEntrySV ---------------------");
  $("#ajaxSV").html("<div class='col-sm-8 col-sm-offset-2'>"+
              "<div class='space20'></div>"+
              "<h1 id='proposerloiFormLabel' >New Room</h1>"+
              "<form id='ajaxForm'></form>"+
              "<div class='space20'></div>"+
                "<div class='clear'>Surveys contain subject to vote on, brainstorm sessoins, discussions...</div>"+ 
              "</div>");
    $.subview({
      content : "#ajaxSV",
      onShow : function() 
      {
        var form = $.dynForm({
          formId : "#ajaxForm",
          formObj : roomFormDefinition,
          onLoad : function  () {
            if( roomObj ){
              $("#name").val(data.title);
            }
          },
          onSave : function(){
            console.log("saving Room!!");
            one = getRandomInt(0,10);
            two = getRandomInt(0,10);
            if( prompt("combien font "+one+"+"+two+" ?") == one+two )
            {
              $.blockUI({
                    message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
                          '<blockquote>'+
                            '<p>each Time I plant a seed'+
                              '<br/>they say kill it before it grows.</p>'+
                            '<cite title="Bob Marley ">Bob Marley </cite>'+
                          '</blockquote> '
                  });
              var params = { 
                 "email" : "<?php echo Yii::app()->session['userEmail']?>" , 
                 "name" : $("#name").val() , 
                 "tags" : $("#tags").val().split(","),
                 <?php  
                 //"cp" : "<?php echo (isset($survey['cp']) ) ? $survey['cp'] : ''" , 
                 ?>
                 "type" : $("#roomType").select2("val"), 
              };
              if( $("#type").val() != "")
                params.parentType = $("#type").val();
              if( $("#id").val() != "")
                params.parentId = $("#id").val();
             console.dir(params);
             $.ajax({
                type: "POST",
                url: '<?php echo Yii::app()->createUrl($this->module->id."/rooms/saveroom")?>',
                data: params,
                success: function(data){
                  if(data.result){
                      window.location.reload();
                  }
                  else {
                    toastr.error(data.msg);
                  }
                  $.unblockUI();
                },
                dataType: "json"
              });
          } else 
            alert("mauvaise réponse, etes vous humain ?");


            return false;
          }
        });
        console.dir(form);
      },
      onHide : function() {
        $("#ajaxSV").html('');
        //$.hideSubview();
      },
      onSave: function() {
        $("#ajaxForm").submit();
      }
    });
}
*/

function getUrls(){
    var urls = [];
    $.each($('.addmultifield'), function() {
        urls.push( $(this).val() );
    });
    return urls;
};

function getRandomInt (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function readEntrySV(data,type) { 
  console.warn("--------------- readEntrySV ---------------------");
  console.dir(data);
  $("#ajaxSV").html("<div class='col-sm-8 col-sm-offset-2'>"+
              "<div class='space20'></div>"+
              "<h1 id='entryTitle' >Faites une proposition</h1>"+
              "<div id='entryContent'></div>"+
              //'<div id="container2" style="min-width: 350px; height: 350px; margin: 0 auto"></div>'+
              "</div>");
  $.subview({
        content : "#ajaxSV",
        onShow : function() 
        {
          $("#entryContent").html(data.content);
          $("#entryTitle").html(data.title);
          if(type=="graph")
            setUpGraph();
        },
        onHide : function() {
          $("#ajaxSV").html('');
          //$.hideSubview();
        }
      });
}


</script>

