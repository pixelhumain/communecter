<?php  

  $cssAnsScriptFiles = array(
    '/plugins/bootstrap-datepicker/css/datepicker.css',
    '/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
    '/plugins/summernote/dist/summernote.css',
    '/plugins/summernote/dist/summernote.min.js'
    );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles,Yii::app()->request->baseUrl);
  
  $cssAnsScriptFiles = array(
    '/assets/css/rooms/header.css'
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles, Yii::app()->theme->baseUrl);

  //$cssAnsScriptFilesTheme = array('js/form-elements.js');
  //HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme, Yii::app()->request->baseUrl);

  $parent = ActionRoom::getById($roomId);
  $nameList = (strlen($parent["name"])>20) ? substr($parent["name"],0,20)."..." : $parent["name"];

?>
<div id="editEntryContainer"></div>
<style type="text/css">
  .addPropBtn{
    width:100%;
    /*background-color: #BBBB77;*/
  }
  .removePropLineBtn {
      background-color: #E33551;
      line-height: 32px;
      width: 100%;
  }
</style>
<script type="text/javascript">
var organizerList = {};
var currentUser = <?php echo json_encode(Yii::app()->session["user"])?>;
var rawOrganizerList = <?php echo json_encode(Authorisation::listUserOrganizationAdmin(Yii::app() ->session["userId"])) ?>;
var docType="<?php echo Document::DOC_TYPE_IMAGE; ?>";
var contentKey = "<?php echo Document::IMG_SLIDER; ?>";
var proposalFormDefinition = {
    "jsonSchema" : {
        "title" : "Entry Form",
        "type" : "object",
        "properties" : {
          "id" :{
              "inputType" : "hidden",
              "value" : "<?php echo (isset($survey["_id"])) ? (string)$survey["_id"] : '' ?>"
            },
            "type" :{
              "inputType" : "hidden",
              "value" : "<?php echo Survey::TYPE_ENTRY?>"
            },
            "organizer" : {
              "inputType" : "hidden",
              "value" : "currentUser"
            },
            "name" :{
              "inputType" : "text",
              "placeholder" : "Titre de la proposition",
              "rules" : {
                "required" : true
              },
              "value" : "<?php echo ( isset($survey) && isset($survey["name"]) ) ? $survey["name"] : '' ?>",
            },
            /* "organizer" : {
              //"inputType" : "select",
              //"placeholder" : "Organisateur du sondage",
              //"value" : "currentUser",
              //"rules" : {
               // "required" : true
              //},
             // "options" : organizerList
            //}, */
            "message" :{
              "inputType" : "wysiwyg",
              "placeholder" : "Texte de la proposition",
              "rules" : {
                "required" : true
              },
              "value" : <?php echo ( isset($survey) && isset($survey["message"]) ) ? json_encode($survey["message"]) : '""' ?>,
            },
            "dateEnd" :{
              "inputType" : "date",
              "placeholder" : "Fin de la période de vote",
              "value":"<?php echo (isset($survey) && isset($survey['dateEnd'])) ? $survey['dateEnd'] : '' ?>",
              "rules" : {
                "required" : true
              }
            },
            "urls" : {
                  "inputType" : "array",
                  "placeholder" : "url, informations supplémentaires, actions à faire, etc",
                  "value" : <?php echo (isset($survey) && isset($survey['urls'])) ? json_encode($survey['urls']) : "[]" ?>,
            },
            /*"image" : {
                  "inputType" : "image",
                  "contextType": "<?php echo (isset($parentType)) ? $parentType : '' ?>",
                  "contextId": "<?php echo (isset($parentId)) ? $parentId : '' ?>",
                  //"placeholder" : "url, informations supplémentaires, actions à faire, etc",
                  "value" : <?php echo (isset($survey) && isset($survey['pathImage'])) ? json_encode($survey['pathImage']) : '""' ?>
            },*/
            "tags" :{
              "inputType" : "tags",
              "placeholder" : "Tags",
              "value" : "<?php echo (isset($survey) && isset($survey['tags'])) ? implode(',', $survey['tags']) : '' ?>",
              "values" : <?php echo json_encode(Tags::getActiveTags()) ?>
            } /*,
              "separator1":{
              "title":"Comment options"
            },
            "<?php echo Comment::COMMENT_ON_TREE ?>" :{
              "inputType" : "checkbox",
              "placeholder" : "Can People reply to a comment ?",
              "checked" : true,
              "value" : 1
            },
            "<?php echo Comment::COMMENT_ANONYMOUS ?>" :{
              "inputType" : "checkbox",
              "placeholder" : "Comment anonymously ?",
              "value" : 1
            },
            "<?php echo Comment::ONE_COMMENT_ONLY ?>" :{
              "inputType" : "checkbox",
              "placeholder" : "Comment only one time ?",
              "value" : 1
            },*/
        }
    }
};

var dataBind = {
   "#editEntryContainer #message" : "message",
   "#editEntryContainer #name" : "name",
   "#editEntryContainer #tags" : "tags",
   "#editEntryContainer #id"   : "typeId",
   "#editEntryContainer #type" : "type",
   "#editEntryContainer #dateEnd" : "dateEnd",
   "#editEntryContainer #<?php echo Comment::COMMENT_ON_TREE ?>" : "<?php echo Comment::COMMENT_ON_TREE ?>",
   "#editEntryContainer #<?php echo Comment::COMMENT_ANONYMOUS ?>" : "<?php echo Comment::COMMENT_ANONYMOUS ?>",
   "#editEntryContainer #<?php echo Comment::ONE_COMMENT_ONLY ?>" : "<?php echo Comment::ONE_COMMENT_ONLY ?>"
};

var proposalObj = <?php echo (isset($survey)) ? json_encode($survey) : "{}" ?>;

//editEntryContainer


jQuery(document).ready(function() { 
   
  //add current user as the default value
  organizerList["currentUser"] = currentUser.name + " (You)";

  $.each(rawOrganizerList, function(optKey, optVal) {
    organizerList[optKey] = optVal.name;
  });

  activateSummernote('#editEntryContainer #message');

  editEntrySV ();
 

  /*!
  Non-Sucking Autogrow 1.1.1
  license: MIT
  author: Roman Pushkin
  https://github.com/ro31337/jquery.ns-autogrow
*/
(function(){var e;!function(t,l){return t.fn.autogrow=function(i){return null==i&&(i={}),null==i.horizontal&&(i.horizontal=!0),null==i.vertical&&(i.vertical=!0),null==i.debugx&&(i.debugx=-1e4),null==i.debugy&&(i.debugy=-1e4),null==i.debugcolor&&(i.debugcolor="yellow"),null==i.flickering&&(i.flickering=!0),null==i.postGrowCallback&&(i.postGrowCallback=function(){}),null==i.verticalScrollbarWidth&&(i.verticalScrollbarWidth=e()),i.horizontal!==!1||i.vertical!==!1?this.filter("textarea").each(function(){var e,n,r,o,a,c,d;return e=t(this),e.data("autogrow-enabled")?void 0:(e.data("autogrow-enabled"),a=e.height(),c=e.width(),o=1*e.css("lineHeight")||0,e.hasVerticalScrollBar=function(){return e[0].clientHeight<e[0].scrollHeight},n=t('<div class="autogrow-shadow"></div>').css({position:"absolute",display:"inline-block","background-color":i.debugcolor,top:i.debugy,left:i.debugx,"max-width":e.css("max-width"),padding:e.css("padding"),fontSize:e.css("fontSize"),fontFamily:e.css("fontFamily"),fontWeight:e.css("fontWeight"),lineHeight:e.css("lineHeight"),resize:"none","word-wrap":"break-word"}).appendTo(document.body),i.horizontal===!1?n.css({width:e.width()}):(r=e.css("font-size"),n.css("padding-right","+="+r),n.normalPaddingRight=n.css("padding-right")),d=function(t){return function(l){var r,d,s;return d=t.value.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n /g,"<br/>&nbsp;").replace(/"/g,"&quot;").replace(/'/g,"&#39;").replace(/\n$/,"<br/>&nbsp;").replace(/\n/g,"<br/>").replace(/ {2,}/g,function(e){return Array(e.length-1).join("&nbsp;")+" "}),/(\n|\r)/.test(t.value)&&(d+="<br />",i.flickering===!1&&(d+="<br />")),n.html(d),i.vertical===!0&&(r=Math.max(n.height()+o,a),e.height(r)),i.horizontal===!0&&(n.css("padding-right",n.normalPaddingRight),i.vertical===!1&&e.hasVerticalScrollBar()&&n.css("padding-right","+="+i.verticalScrollbarWidth+"px"),s=Math.max(n.outerWidth(),c),e.width(s)),i.postGrowCallback(e)}}(this),e.change(d).keyup(d).keydown(d),t(l).resize(d),d())}):void 0}}(window.jQuery,window),e=function(){var e,t,l,i;return e=document.createElement("p"),e.style.width="100%",e.style.height="200px",t=document.createElement("div"),t.style.position="absolute",t.style.top="0px",t.style.left="0px",t.style.visibility="hidden",t.style.width="200px",t.style.height="150px",t.style.overflow="hidden",t.appendChild(e),document.body.appendChild(t),l=e.offsetWidth,t.style.overflow="scroll",i=e.offsetWidth,l===i&&(i=t.clientWidth),document.body.removeChild(t),l-i}}).call(this);

  $("#editEntryContainer #message").autogrow({vertical: true, horizontal: false});
  $("#editEntryContainer #name").focus();
});

function editEntrySV () {

  mylog.warn("--------------- editEntrySV ---------------------",proposalObj);
  $("#editEntryContainer").html("<div class='row bg-white'><div class='col-sm-10 col-sm-offset-1'>"+
              "<div class='space20'></div>"+
              //"<h1 id='proposerloiFormLabel' >Faire une proposition</h1>"+
              "<form id='ajaxFormEntry' enctype='multipart/form-data'></form>"+
              "<div class='space20'></div>"+
              "</div></div>");
    
        var formSurvey = $.dynForm({
          formId : "#editEntryContainer #ajaxFormEntry",
          formObj : proposalFormDefinition,
          onLoad : function() {
            mylog.log("onLoad",proposalObj);
            $('.btn-annuler').hide();
            if( proposalObj )
            {
               if(proposalObj.dateEnd)
               {
                date = new Date(proposalObj.dateEnd*1000);
                var day = date.getDate().toString();
                var month = (date.getMonth()+1).toString();
                var year = date.getFullYear().toString();
                $("#editEntryContainer #dateEnd").val( day+"/"+month+"/"+year );
              }
              $("#editEntryContainer #message").code(proposalObj.message);
             
            }
          },
          onSave : function(){
            mylog.log("saving Survey !!");
            mylog.log($("#editEntryContainer #name").val());
            
            if( $("#editEntryContainer #name").val())// && prompt("combien font "+one+"+"+two+" ?") == one+two )
            {
              processingBlockUi();
              var params = { 
                 "survey" : "<?php echo (isset($roomId)) ? $roomId : '' ?>", 
                 //"parentRoomId" : "<?php echo @$parentRoomId ? $parentRoomId : ""; ?>" , 
                 "email" : "<?php echo Yii::app()->session['userEmail']?>" , 
                 "name" : $("#editEntryContainer #name").val() , 
                 "organizer" : $("#editEntryContainer #organizer").val(),
                 "message" :  $("#editEntryContainer #message").code() ,
                 "type" : "<?php echo Survey::TYPE_ENTRY?>",
                 "app" : "<?php echo $this->module->id?>",
                 "commentOptions" : {
                   "<?php echo Comment::COMMENT_ON_TREE ?>" : $("#editEntryContainer #<?php echo Comment::COMMENT_ON_TREE ?>").val(),
                   "<?php echo Comment::COMMENT_ANONYMOUS ?>" : $("#editEntryContainer #<?php echo Comment::COMMENT_ANONYMOUS ?>").val(),
                   "<?php echo Comment::ONE_COMMENT_ONLY ?>" : $("#editEntryContainer #<?php echo Comment::ONE_COMMENT_ONLY ?>").val()
                 }
              };
              
              urls = getUrls();
              if( urls != null )
                params.urls = urls;
              if( $("#editEntryContainer #id").val() != "" )
                params.id = $("#editEntryContainer #id").val();
              if( $("#editEntryContainer #tags").val() )
                params.tags = $("#editEntryContainer #tags").val().split(",");
              if( $("#editEntryContainer #dateEnd").val() )
                params.dateEnd = $("#editEntryContainer #dateEnd").val();

             mylog.dir(params);
             $.ajax({
                type: "POST",
                url: '<?php echo Yii::app()->createUrl($this->module->id."/survey/saveSession")?>',
                data: params,
                success: function(data){
                  if(data.result){
                    if( data.surveyId && data.surveyId["$id"] )
                      loadByHash( "#survey.entry.id."+data.surveyId["$id"] );
                    else if( $("#editEntryContainer #id").val() != "" )
                      loadByHash( "#survey.entry.survey."+data.parentId+".id."+$("#editEntryContainer #id").val() );
                    else
                      loadByHash( "#survey.entries.id."+data.parentId )
                  }
                  else {
                    toastr.error(data.msg);
                  }
                  $.unblockUI();
                  $('#modal-create-proposal').modal("toogle");
                  $('#modal-edit-entry').modal("toogle");                  
                },
                error: function(data) {
                  $.unblockUI();
                  toastr.error("Something went really bad : "+data.msg);
                },
                dataType: "json"
              });
          } else 
            alert("mauvaise réponse, etes vous humain ?");
            return false;
          }
        });
        mylog.dir(formSurvey);
      
}

function getUrls()
{
    var urls = [];
    $.each($('.addmultifield'), function() {
        if( $(this).val() != "" )
          urls.push( $( this ).val() );
    });
    mylog.log("urls",urls);
    return ( urls.length ) ? urls : null;
};

function getRandomInt (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

</script>



