<?php 
$moduleId = Yii::app()->controller->module->id;
?>
<style type="text/css">
    blockquote{border-color: #2BB0C6; cursor: pointer;}
</style>




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
            "roomType" :{
              "inputType" : "hidden",
              "value" : "<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>"
            },
            "roomTypeCtx" :{
                "inputType" : "hidden",
                "placeholder" : "<?php echo Yii::t('rooms', 'Type of Room', null, $moduleId)?>",
                // "options" : listRoomTypes
              },
            "roomName" :{
              "inputType" : "text",
              "placeholder" : "Nom de l'espace",
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
   "#editEntryContainer #message" : "message",
   "#editEntryContainer #name" : "name",
   "#editEntryContainer #tags" : "tags",
   "#editEntryContainer #id"   : "parentId",
   "#editEntryContainer #type" : "parentType",
};

jQuery(document).ready(function() {
  console.warn("--------------- newRoom ---------------------");
  
  $(".moduleLabel").html("<i class='fa fa-connectdevelop fa-red'></i> <i class='fa fa-plus fa-red'></i><span class='text-dark'> Créer un nouvel espace coopératif</span>");

  //getAjax("#editRoomsContainer",baseUrl+"/"+moduleId+"/rooms/editRoom", "html");
  editRoomSV();
  $(".newRoom").off().on("click",function() { 
    console.warn("--------------- newRoom CLIK---------------------");
    //openSubView('Add a Room', '/communecter/rooms/editRoom',null,function(){editRoomSV ();});
  });
});

function selectRoomType(type){
  $("#roomTypeCtx").val(type);
  
  var msg = "Nouvel espace";
  if(type=="discuss") msg = "<i class='fa fa-comments'></i> " + msg + " de discussion";
  if(type=="framapad") msg = "<i class='fa fa-file-text-o'></i> " + msg + " framapad";
  if(type=="vote") msg = "<i class='fa fa-gavel'></i> " + msg + " de décision";
  if(type=="actions") msg = "<i class='fa fa-cogs'></i> Nouvelle Liste d'actions";
  $("#proposerloiFormLabel").html(msg);
  $("#proposerloiFormLabel").addClass("text-dark");
  $("#btn-submit-form").html('<?php echo Yii::t("common", "Submit"); ?> <i class="fa fa-arrow-circle-right"></i>');
  
  $("#first-step-create-space").hide(400);
  $(".roomTypeselect").addClass("hidden");
  $("#editRoomsContainer").removeClass("hidden");
}

function editRoomSV (roomObj) { 
  console.warn("--------------- editEntrySV ---------------------");
  $("#editRoomsContainer").html("<div class=''>"+
              "<div class='space20'></div>"+
              "<h1 id='proposerloiFormLabel' ><?php echo Yii::t('rooms', 'New Room', null, $moduleId)?></h1>"+
              "<form id='ajaxFormRoom'></form>"+
              "<div class='space20'></div>"+
             //   "<div class='clear'><?php echo Yii::t('rooms', 'Surveys contain subject to vote on, brainstorm sessions, discussions...', null, $moduleId)?></div>"+ 
              "</div>");
    
        var formRoom = $.dynForm({
          formId : "#editRoomsContainer #ajaxFormRoom",
          formObj : roomFormDefinition,
          onLoad : function  () {
            if( roomObj ){
              $("#name").val(data.title);
            }
          },
          onSave : function(){
            console.log("saving Room!!");
            
            processingBlockUi();
            var params = { 
               "email" : "<?php echo Yii::app()->session['userEmail']?>" , 
               "name" : $("#editRoomsContainer #roomName").val() , 
               "tags" : $("#editRoomsContainer #roomTags").val().split(","),
               <?php  
               //"cp" : "<?php echo (isset($survey['cp']) ) ? $survey['cp'] : ''" , 
               ?>
               "type" : $("#editRoomsContainer #roomTypeCtx").val(), //select2("val"), 
            };
            if( $("#editRoomsContainer #roomType").val() != "")
              params.parentType = $("#editRoomsContainer #type").val();
            if( $("#editRoomsContainer #id").val() != "")
              params.parentId = $("#editRoomsContainer #id").val();
           console.dir(params);
            $.ajax({
              type: "POST",
              url: '<?php echo Yii::app()->createUrl($this->module->id."/rooms/saveroom")?>',
              data: params,
              success: function(data){
                if(data.result){
                    if( $("#roomTypeCtx").select2("val") == "<?php echo ActionRoom::TYPE_DISCUSS ?>" )
                      loadByHash("#comment.index.type.actionRooms.id."+data.newInfos["_id"]["$id"]);
                    else if($("#roomTypeCtx").select2("val") == "<?php echo ActionRoom::TYPE_FRAMAPAD ?>" )
                      loadByHash("#rooms.external.id."+data.newInfos["_id"]["$id"]);
                    else if( $("#roomTypeCtx").select2("val") == "<?php echo ActionRoom::TYPE_ACTIONS ?>")
                      loadByHash("#rooms.actions.id."+data.newInfos["_id"]["$id"]);
                    else 
                      loadByHash("#survey.entries.id."+data.newInfos["_id"]["$id"]);
                    //rooms.index.type.<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>.id.<?php echo (isset($_GET['id'])) ? $_GET['id'] : '' ?>");
                }
                else {
                  toastr.error(data.msg);
                }
                $.unblockUI();
              },
              dataType: "json"
            });


            return false;
          }
        });
        console.dir(formRoom);
      
   
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
  $("#editRoomsContainer #ajaxSV").html("<div class='col-sm-8 col-sm-offset-2'>"+
              "<div class='space20'></div>"+
              "<h1 id='entryTitle' >Faites une proposition</h1>"+
              "<div id='entryContent'></div>"+
              //'<div id="container2" style="min-width: 350px; height: 350px; margin: 0 auto"></div>'+
              "</div>");
  $.subview({
        content : "#editRoomsContainer #ajaxSV",
        onShow : function() 
        {
          $("#editRoomsContainer #entryContent").html(data.content);
          $("#editRoomsContainer #entryTitle").html(data.title);
          if(type=="graph")
            setUpGraph();
        },
        onHide : function() {
          $("#editRoomsContainer #ajaxSV").html('');
          //$.hideSubview();
        }
      });
}


</script>
