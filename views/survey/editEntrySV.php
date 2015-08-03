<script type="text/javascript">
var proposalFormDefinition = {
    "jsonSchema" : {
        "title" : "Entry Form",
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
            "name" :{
              "inputType" : "text",
              "placeholder" : "Titre de la proposition",
              "rules" : {
                "required" : true
              }
            },
            "message" :{
              "inputType" : "textarea",
              "placeholder" : "Texte de la proposition",
              "rules" : {
                "required" : true
              }
            },
            "urls" : {
                  "inputType" : "array",
                  "placeholder" : "url",
            },
            "tags" :{
              "inputType" : "tags",
              "placeholder" : "Tags",
              "values" : [
                "Sport",
                    "Agricutlture",
                    "Culture",
                    "Urbanisme",
              ]
            },
              "separator1":{
              "title":"Comment options"
            },
            "<?php echo Comment::COMMENT_ON_TREE ?>" :{
              "inputType" : "checkbox",
              "placeholder" : "Can I reply to a comment ?",
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
            },
        }
    }
};

var dataBind = {
   "#message" : "message",
   "#name" : "name",
   "#tags" : "tags",
   "#id"   : "typeId",
   "#type" : "type",
   "#<?php echo Comment::COMMENT_ON_TREE ?>" : "<?php echo Comment::COMMENT_ON_TREE ?>",
   "#<?php echo Comment::COMMENT_ANONYMOUS ?>" : "<?php echo Comment::COMMENT_ANONYMOUS ?>",
   "#<?php echo Comment::ONE_COMMENT_ONLY ?>" : "<?php echo Comment::ONE_COMMENT_ONLY ?>"
};

jQuery(document).ready(function() {
  
  $(".newVoteProposal").off().on("click",function() { 
    editEntrySV ();
  });
});

function editEntrySV (proposalObj) { 
  console.warn("--------------- editEntrySV ---------------------");
  $("#ajaxSV").html("<div class='col-sm-8 col-sm-offset-2'>"+
              "<div class='space20'></div>"+
              "<h1 id='proposerloiFormLabel' >Faites une proposition</h1>"+
              "<form id='ajaxForm'></form>"+
              "<div class='space20'></div>"+
                "<div class='clear'>Les propositions sont modérées avant publication sur le site afin d'éviter tous propos contraires à la loi ou susceptible de troubler l`ordre public."+
                "Nous nous réservons donc la possibilité de modifier, reformuler, compléter, différer ou ne pas publier tout ou partie d`une proposition. Dans cette éventualité, nous pouvons être amener à vous contacter par mail."+
                "<br/>Selon le nombre de propositions reçues, le délai de mise en ligne peut être variable. En cas d`urgence, merci le signaler des le début de votre proposition."+
                "Votre proposition sera publiée par l`administrateur du sondage. <br/>Ni votre adresse email ni votre nom n`apparaitront sur le site public."+
                "Vous pouvez aussi nous faire part de toute remarque constructive, nous permettant d`améliorer ce site à votre service</div>"+ 
              "</div>");
    $.subview({
      content : "#ajaxSV",
      onShow : function() 
      {
        var form = $.dynForm({
          formId : "#ajaxForm",
          formObj : proposalFormDefinition,
          onLoad : function  () {
            if( proposalObj ){
              /*$("#name").val(data.title);
              $("#message").val(data.contentBrut);
              AutoGrowTextArea($("message"));*/
            }
          },
          onSave : function(){
            console.log("saving Organization!!");
            //one = getRandomInt(0,10);
            //two = getRandomInt(0,10);
            if( $("#ajaxSV #name").val()) //&& prompt("combien font "+one+"+"+two+" ?") == one+two )
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
                 "survey" : "<?php echo (string)$survey['_id']?>", 
                 "email" : "<?php echo Yii::app()->session['userEmail']?>" , 
                 "name" : $("#ajaxSV #name").val() , 
                 "tags" : $("#ajaxSV #tags").val().split(","),
                 "message" : $("#ajaxSV #message").val(),
                 <?php  
                 //"cp" : "<?php echo (isset($survey['cp']) ) ? $survey['cp'] : ''" , 
                 ?>
                 "type" : "<?php echo Survey::TYPE_ENTRY?>",
                 "urls" : getUrls(),
                 "app" : "<?php echo $this->module->id?>",
                 "commentOptions" : {
                   "<?php echo Comment::COMMENT_ON_TREE ?>" : $("#ajaxSV #<?php echo Comment::COMMENT_ON_TREE ?>").val(),
                   "<?php echo Comment::COMMENT_ANONYMOUS ?>" : $("#ajaxSV #<?php echo Comment::COMMENT_ANONYMOUS ?>").val(),
                   "<?php echo Comment::ONE_COMMENT_ONLY ?>" : $("#ajaxSV #<?php echo Comment::ONE_COMMENT_ONLY ?>").val()
                 }
              };
             console.dir(params);
             $.ajax({
                type: "POST",
                url: '<?php echo Yii::app()->createUrl($this->module->id."/survey/saveSession")?>',
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
        console.dir(form);
      },
      onHide : function() {
        $("#ajaxSV").html('');
        $.hideSubview();
      },
      onSave: function() {
        $("#ajaxForm").submit();
      }
    });
}

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
          $.hideSubview();
        }
      });
}


</script>

