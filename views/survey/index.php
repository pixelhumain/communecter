<?php 
$cs = Yii::app()->getClientScript();

$cssAnsScriptFilesModule = array(
  '/survey/css/mixitup/reset.css',
  '/survey/css/mixitup/style.css',
  '/survey/js/highcharts.js' , 
  '/survey/js/exporting.js' , 
  '/survey/js/jquery.mixitup.min.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

$cssAnsScriptFilesModule = array(
  '/assets/plugins/share-button/ShareButton.min.js' , 
  '/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);

$commentActive = true;

Menu::survey( $where["survey"] );
$this->renderPartial('../default/panels/toolbar');
?>

<style type="text/css">
  .connect{border-radius: 8px; opacity: 0.9;background-color: #182129; margin-bottom: 10px;border:1px solid #3399FF;width: 100%;padding: 10px }
  button.filter,button.sort{color:#000;}
  /*a.btn{margin:3px;}*/
  .mix{border-radius: 8px;}
  .home{margin-top: 50px;}

  /*.infolink{border-top:1px solid #fff}*/

  .leftlinks a.btn{background-color: yellow;border: 1px solid yellow;}
  /*.rightlinks a.btn{background-color: beige;border: 1px solid beige;}*/
  a.btn.alertlink{background-color:red;color:white;border: 1px solid red;}
  a.btn.golink{background-color:green;color:white;border: 1px solid green;}
  a.btn.voteUp{background-color: #93C22C;border: 1px solid green;}
  a.btn.voteUnclear{background-color: yellow;border: 1px solid yellow;}
  a.btn.voteMoreInfo{background-color: #789289;border: 1px solid #789289;}
  a.btn.voteAbstain{color: black;background-color: white;border: 1px solid white;}
  a.btn.voteDown{background-color: #db254e;border: 1px solid #db254e;}
  .step{ background-color: #182129;  opacity: 0.9;}
  .taglist{width: 255px;display: inline;background-color:#3490EC;color:#000;padding: 3px 5px;height: 28px; }


  .controls{
    background: #E7E7E7;
    border: 1px solid #BDBDBD;
  }

  .mixcontainer .mix{
    border-radius:0px;
    border-color: #CCC;
    height:350px;
    margin:-1px -3px !important;
    float:left;
    moz-box-shadow: 0px 2px 4px -3px rgba(101, 101, 101, 0.61);
    -webkit-box-shadow: 0px 2px 4px -3px rgba(101, 101, 101, 0.61);
    -o-box-shadow: 0px 2px 4px -3px rgba(101, 101, 101, 0.61);
    box-shadow: 0px 2px 4px -3px rgba(101, 101, 101, 0.61);
    filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=4);
  }

  .mixcontainer .mix a.titleMix{
    margin-top: 4px !important;
    float: left;
    width: 100%;

  }
  .mixcontainer .mix a.titleMix:hover{
    text-decoration: underline;
  }

  .leftlinks a.btn {
      border: 1px solid #9c9c9c !important;
      width: 14%;
  }

  .mixcontainer .mix a, .mixcontainer .mix span{
    background-color: #fff;
    border-color: #ccc;
  }
  .mixcontainer .mix span{
    height: 135px;
  }


    .assemblyHeadSection {  
      background-image:url(<?php echo $this->module->assetsUrl; ?>/images/city/assemblyHead.png); 
      /*background-image: url(/ph/assets/449afa38/images/city/cityDefaultHead_BW.jpg);*/
      background-color: #fff;
      background-repeat: no-repeat;
      background-position: 0px -50px;
      background-size: 100% auto;
    }

      h1.citizenAssembly-header{
        background-color: rgba(255, 255, 255, 0.63);
        padding: 30px;
        margin-bottom: -3px;
        font-size: 32px;
        margin-top:90px;
      }

    .message-propostal{
      font-size: 13px !important;
      font-weight: 300 !important;
      margin-top: 20px !important;
      line-height: 1.3;
      width:100%;
    }

    .lbl-info-survey{
      font-size: 12px !important;
      font-weight: 500 !important;
      margin-top:3px;
      padding:4px;
    }
</style>


<div id="surveyDetails"></div>

<section class="mt80 stepContainer">
  <div class=" home ">
  
  <?php 
  $logguedAndValid = Person::logguedAndValid();
  $alltags = array(); 
  $blocks = "";
  $tagBlock = "";
  $cpBlock = "";
  $cps = array();
  $count = 0;

    /* **************************************
    *  go through the list of entries for the survey and build filters
    ***************************************** */
    function buildEntryBlock( $entry,$uniqueVoters,$alltags ){
        $logguedAndValid = Person::logguedAndValid();
        $tagBlock = "";
        $cpBlock = "";
        $name = $entry["name"];
        $message = substr($entry["message"],0,300);
        $email =  (isset($entry["email"])) ? $entry["email"] : "";
        $cpList = (isset($entry["cp"])) ? $entry["cp"] : "";
        if( !isset($_GET["cp"]) && $entry["type"] == Survey::TYPE_SURVEY )
        {
          if(isset($entry["cp"]))
          {
            if(is_array($entry["cp"]))
            {
              $cpList = "";
              foreach ($entry["cp"] as $cp) {
                if(!in_array($cp, $cps)){
                  $cpBlock .= ' <button class="filter " data-filter=".'.$cp.'">'.$cp.'</button>';
                  array_push($cps, $cp);
                }
                $cpList .= $cp." ";
              }
            } 
            else if(!in_array($entry["cp"], $cps))
            {
              $cpBlock .= ' <button class="filter " data-filter=".'.$entry["cp"].'">'.$entry["cp"].'</button>';
              array_push($cps, $entry["cp"]);
            }
          }
        }
  
        $tags = "";
        if(isset($entry["tags"]))
        {
          foreach ($entry["tags"] as $t) 
          {
            if(!empty($t) && !in_array($t, $alltags))
            {
              array_push($alltags, $t);
              $tagBlock .= ' <button class="filter " data-filter=".'.$t.'">'.$t.'</button>';
            }
            $tags .= $t.' ';
          }
        }
  
        $count = PHDB::count ( Survey::COLLECTION, array( "type"=>Survey::TYPE_ENTRY,
                                                          "survey"=>(string)$entry["_id"] ) );
        $link = $name;
  
        /* **************************************
        //check if I wrote this law
        *************************************** */
        $meslois = ( $logguedAndValid && Yii::app()->session["userEmail"] && $entry['email'] == Yii::app()->session["userEmail"] ) ? "myentries" : "";
        
        //checks if the user is a follower of the entry
        $followingEntry = ( $logguedAndValid && Action::isUserFollowing($entry,Action::ACTION_FOLLOW) ) ? "myentries":"";
        
        
        //title + Link
        if ( $entry["type"] == Survey::TYPE_SURVEY )
          $link = '<a class="titleMix text-dark '.$meslois.'" onclick="loadByHash(\'#survey.entry.id.'.(string)$entry["_id"].'\')" href="javascript:">'."<i class='fa fa-gavel'></i> ".$name.' ('.$count.')</a>' ;
        else if ( $entry["type"] == "entry" )
          $link = '<a class="titleMix text-dark '.$meslois.'" onclick="loadByHash(\'#survey.entry.id.'.(string)$entry["_id"].'\')" href="javascript:;">'."<i class='fa fa-gavel'></i> ".$name.'</a>' ;
        
        $message = "<span class='text-dark no-border message-propostal'><i class='fa fa-file-text fa-2x'></i> ".$message."</span>";

        //$infoslink bring visual detail about the entry
        $infoslink = "";
        $infoslink .= (!empty($followingEntry)) ? "<a class='btn voteAbstain filter' data-filter='.myentries' ><i class='fa fa-rss infolink' ></i></a>" :"";
  
        $infoslink .= (!empty($meslois)) ? ' <a class="btn btn-xs btn-default filter" data-filter=".myentries" onclick="loadByHash(\'#survey.editEntry.survey.'.$entry["survey"].'.id.'.(string)$entry["_id"].'\')" href="javascript:;"><i class="fa fa-user infolink"></i> '.Yii::t("rooms", "Edit", null, Yii::app()->controller->module->id ).'</a> ' : '';                          
        
        if (Yii::app()->session["userIsAdmin"]) {
          $linkStandalone = Yii::app()->createUrl("/".Yii::app()->controller->module->id."/survey/entry/id/".(string)$entry["_id"]);
          $infoslink .= "<a target='_blank' class='btn btn-default voteAbstain' href='".$linkStandalone."' title='Open standalone page'><i class='fa fa-magic infolink'></i></a>";
        }
  
        /* **************************************
        Rendering Each block
        ****************************************/
        $voteLinksAndInfos = Action::voteLinksAndInfos($logguedAndValid,$entry);
        $avoter = $voteLinksAndInfos["avoter"];
        $hrefComment = "#commentsForm";
        $commentCount = 0;
        //$linkComment = ($logguedAndValid && $commentActive) ? "<a class='btn ".$entry["_id"].Action::ACTION_COMMENT."' role='button' data-toggle='modal' href=\"".$hrefComment."\" title='".$commentCount." Commentaire'><i class='fa fa-comments '></i></a>" : "";
        $totalVote = $voteLinksAndInfos["totalVote"];
        $info = ($totalVote) ? '<span class="info">'.$totalVote.' sur <span class="info voterTotal">'.$uniqueVoters.'</span> vote(s)</span><br/>':'<span class="info"></span>';
  
        $content = ($entry["type"]==Survey::TYPE_ENTRY) ? "".$entry["message"]:"";
  
        $leftLinks = $voteLinksAndInfos["links"];
        $graphLink = ($totalVote) ?' <a class="btn voteAbstain" onclick="entryDetail(\''.Yii::app()->createUrl("/".Yii::app()->controller->module->id."/survey/graph/id/".(string)$entry["_id"]).'\',\'graph\')" href="javascript:;"><i class="fa fa-pie-chart"></i> '.Yii::t("rooms", "Result", null, Yii::app()->controller->module->id).'</a> ' : '';
        
        $moderatelink = (  @$where["type"]==Survey::TYPE_ENTRY && $isModerator && isset( $entry["applications"][Yii::app()->controller->module->id]["cleared"] ) && $entry["applications"][Yii::app()->controller->module->id]["cleared"] == false ) ? "<a class='btn golink' href='javascript:moderateEntry(\"".$entry["_id"]."\",1)'><i class='fa fa-plus ' ></i></a><a class='btn alertlink' href='javascript:moderateEntry(\"".$entry["_id"]."\",0)'><i class='fa fa-minus ' ></i></a>" :"";
        $rightLinks = (  @$entry["applications"][Yii::app()->controller->module->id]["cleared"] == false ) ? $moderatelink : $graphLink.$infoslink ;
        $rightLinks = ( $entry["type"] == Survey::TYPE_ENTRY ) ? "<div class='rightlinks'>".$rightLinks."</div>" : "";
        $ordre = $voteLinksAndInfos["ordre"];
        $created = ( @$entry["created"] ) ? date("d/m/y h:i",$entry["created"]) : ""; 
        $views = ( @$entry["viewCount"] ) ? ", views : ".$entry["viewCount"] : ""; 
        $byInfo = "";
        if ( isset($entry["parentType"]) && isset($entry["parentId"]) ) 
        {
          if($entry["parentType"] == Organization::COLLECTION){
              $parentCtrler = Organization::CONTROLLER;
              $parentIcon = "group";
          }
          else if($entry["parentType"] == Person::COLLECTION){
              $parentCtrler = Person::CONTROLLER;
              $parentIcon = "user";
          }else if($entry["parentType"] == City::COLLECTION){
              $parentCtrler = City::CONTROLLER;
              $parentIcon = "university";
          }
          //$parentTitle = '<a href="'.Yii::app()->createUrl("/communecter/".$parentCtrler."/dashboard/id/".$id).'">'.$parent["name"]."</a>'s ";
          $byInfo = "by <a href='javascript:loadByHash(\"#".$parentCtrler.".detail.id.".$entry["parentId"]."\")'><i class='fa fa-".$parentIcon."'></i></a>";
        }

        $contextType = ( $entry["type"] == Survey::TYPE_ENTRY ) ? Survey::COLLECTION : Survey::PARENT_COLLECTION;
        $commentBtn = "<a class='btn btn-xs btn-default voteAbstain' href='javascript:loadByHash(\"#comment.index.type.".$contextType.".id.".$entry["_id"]."\")'>".@$entry["commentCount"]." <i class='fa fa-comment'></i> ".Yii::t("rooms", "Comment", null, Yii::app()->controller->module->id)."</a>";
        $closeBtn = "";
        $isClosed = "";
        if( Yii::app()->session["userEmail"] == $entry["email"] && (!isset($entry["dateEnd"]) || $entry["dateEnd"] > time() ) && $entry["type"] == Survey::TYPE_ENTRY ) 
          $closeBtn = "<a class='btn btn-xs btn-danger pull-right' href='javascript:;'".
                        " onclick='closeEntry(\"".$entry["_id"]."\")'>".
                        "<i class='fa fa-times'></i> ".Yii::t('rooms', 'Close', null, Yii::app()->controller->module->id).
                      "</a>";
        else
            $isClosed = " closed";
        $cpList = ( ( @$where["type"]==Survey::TYPE_SURVEY) ? $cpList : "");
        
        $createdInfo  = "<div class='text-red lbl-info-survey '><i class='fa fa-clock-o' style='padding:0px 5px 0px 2px;'></i> ";
        $createdInfo .= (!empty( $created )) ? " ".Yii::t("rooms", "created", null, Yii::app()->controller->module->id) . " : ".$created : "";
        $createdInfo .= "</div>";

        $ends  = "<div class='text-red lbl-info-survey'>";
        $ends .=  (!empty( $entry["dateEnd"] )) ? '<div class="space1"></div>'." ".Yii::t("rooms", "end", null, Yii::app()->controller->module->id) . " : ".date("d/m/y",$entry["dateEnd"]) : "";
        $ends .= "</div>";

        $boxColor = ($entry["type"]==Survey::TYPE_ENTRY ) ? "bg-white" : "bg-azure" ;
        $block = ' <div class="mix '.$boxColor.' '.$avoter.' '.
                        $meslois.' '.
                        $followingEntry.' '.
                        $tags.' '.
                        $cpList.$isClosed.'"'.
                        
                        'data-vote="'.$ordre.'"  data-time="'.
                        $created.'" style="display:inline-blocks"">'.
                        $createdInfo.
                        $link.'<br/>'.
                        $message.'<br/>'.
                        $info.
                        //$tags.
                        //$content.
                        '<div class="space1"></div><div class="pull-left" >'.
                            $graphLink.$commentBtn.$closeBtn.$infoslink. 
                            $byInfo.
                        '</div>'.
                        '<div class="space1"></div><div class="" >'.$leftLinks.'</div>'.
                        '<div class="space1"></div>'.$views.
                        $ends.
                        
                    '</div>';

        return array(
            "block"=>$block,
            "alltags" => $alltags, 
            "tagBlock" => $tagBlock,
            "cpBlock" => $cpBlock
        );
    }
    //TODO seperate logic from view
    foreach ($list as $key => $entry) 
    {
        $entryMap = buildEntryBlock($entry,$uniqueVoters,$alltags);
        $blocks .= $entryMap["block"]; 
        $alltags = $entryMap["alltags"];
        $tagBlock .= $entryMap["tagBlock"];
        $cpBlock .= $entryMap["cpBlock"];
    }
    ?>
    


    <h1 class="homestead text-red center citizenAssembly-header">
      <i class="fa fa-group"></i> <?php echo $nameParentTitle; ?><br>
      <small class="homestead text-dark center">
        Propositions, Débats, Votes
        </small>
    </h1>

    <div class="panel-white" style="display:inline-block;">
   
        
        <div class="controls col-md-12" style="border-radius:0px;">
              <!-- <label>Filtre:</label> -->
              <button class="btn btn-default" onclick="loadByHash('<?php echo $surveyLoadByHash; ?>')"><i class="fa fa-caret-left"></i> <i class="fa fa-group"></i></button>
              <button class="filter btn btn-default fr" data-filter="all"><i class="fa fa-eye"></i> Tout</button>
              <?php if( $logguedAndValid && $where["type"]==Survey::TYPE_ENTRY){?>
              <a class="filter btn bg-red" data-filter=".avoter"><i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'To vote', null, Yii::app()->controller->module->id)?></a>
              <a class="filter btn bg-red" data-filter=".mesvotes"><i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'My votes', null, Yii::app()->controller->module->id)?></a>
              <a class="filter btn bg-red" data-filter=".myentries"><i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'My proposals', null, Yii::app()->controller->module->id)?></a>
              <a class="filter btn bg-red" data-filter=".closed"><i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'Closed', null, Yii::app()->controller->module->id)?></a>
        
              <?php } ?>
              
              <?php //echo $tagBlock?>
        </div>

        <div class="col-md-12 col-sm-12 pull-left" style="display:inline-block; margin-top:20px; margin-bottom:20px;">
              
              <?php if( $logguedAndValid && $where["type"]==Survey::TYPE_ENTRY ) { ?>
              <label>Participation : </label>
              <button class="sort btn btn-default" data-sort="vote:asc"><i class="fa fa-caret-up"></i></button>
              <button class="sort btn btn-default" data-sort="vote:desc"><i class="fa fa-caret-down"></i></button>
              <?php } ?>
              <label>Chronologie : </label>
              <button class="sort btn btn-default" data-sort="time:asc"><i class="fa fa-caret-up"></i></button>
              <button class="sort btn btn-default" data-sort="time:desc"><i class="fa fa-caret-down"></i></button>
              <label>Affichage :</label>
              <button id="ChangeLayout" class="btn btn-default"><i class="fa fa-reorder"></i></button>
              <br/>

              <?php if(!isset($_GET["cp"]) && $where["type"]==Survey::TYPE_SURVEY){?> 
              <label>Géographique : </label>
              <?php echo $cpBlock; 
              }?>
              <br/>
        </div>

        <div id="mixcontainer" class="mixcontainer col-md-12">
            <?php
                 //echo count($list);
                 echo (count($list) > 0) ? $blocks : "" ?>
        </div>
      </div>

    </div>

    </section>

    <div class="space20"></div>


<script type="text/javascript">

/* **************************************
*
*  Initialisation
*
***************************************** */
var layout = 'grid', // Store the current layout as a variable
$container = $('#mixcontainer'), // Cache the MixItUp container
$changeLayout = $('#ChangeLayout'); // Cache the changeLayout button
clickedVoteObject = null;
jQuery(document).ready(function() {
  //$(".moduleLabel").html('<?php echo "Sondages : ".$where["survey"]["name"] ?>');
  $(".moduleLabel").html("<i class='fa fa-gavel text-red'></i> " + "décider ensemble");
  $(".main-col-search").addClass("assemblyHeadSection");
  $container.mixItUp({
      load: {sort: 'vote:desc'},
      animation: {
        animateChangeLayout: true, // Animate the positions of targets as the layout changes
        animateResizeTargets: true, // Animate the width/height of targets as the layout changes
        effects: 'fade rotateX(-40deg) translateZ(-100px)'
      },
      layout: {
        containerClass: 'grid' // Add the class 'list' to the container on load
      }
    });
  moduleWording();
  $('.voteIcon').off().on("click",function() { 
    $(this).addClass("faa-bounce animated");
    clickedVoteObject = $(this).data("vote");
    console.log(clickedVoteObject);
   });
});

/* **************************************
*
*  Mixit Up pluggin stuff
*
***************************************** */


  $changeLayout.on('click', function()
  {
    // If the current layout is a list, change to grid:
    if(layout == 'list'){
      layout = 'grid';
      $changeLayout.html('<i class="fa fa-reorder"></i>'); // Update the button text
      $container.mixItUp('changeLayout', {
        containerClass: layout // change the container class to "grid"
      });
    // Else if the current layout is a grid, change to list:  
    } else {
      layout = 'list';
      $changeLayout.html('<i class="fa fa-th"></i>'); // Update the button text
      $container.mixItUp('changeLayout', {
        containerClass: layout // Change the container class to 'list'
      });
    }
  });

  /* **************************************
  *
  *  REad or Edit an Entry
  *
  ***************************************** */
  function entryDetail(url,type){
    console.warn("--------------- entryDetail ---------------------",url);
    getAjax( "surveyDetails" , url , function(data){
      $("#surveyDetails").html(data);
      //console.dir(data);
      
      console.log("type", type);
      if(type == "edit") 
        loadByHash(url);
      else 
        readEntrySV (data,type);
      
    } );
  }

  /* **************************************
  *
  *  voting and moderation
  *
  ***************************************** */
function addaction(id,action)
{
    console.warn("--------------- addaction ---------------------");
    
      bootbox.confirm("Vous êtes sûr ? Vous ne pourrez pas changer votre vote",
          function(result) {
            if (result) {
              params = { 
                 "userId" : '<?php echo Yii::app()->session["userId"]?>' , 
                 "id" : id ,
                 "collection":"surveys",
                 "action" : action 
              };
              ajaxPost(null,'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/survey/addaction")?>',params,function(data){
                window.location.reload();
              });
          } else {
            $("."+clickedVoteObject).removeClass("faa-bounce animated");
          }
      });
 }

 function closeEntry(id)
{
    console.warn("--------------- closeEntry ---------------------");
    
      bootbox.confirm("Are you sure ? you cannot revert closing an entry. ",
          function(result) {
            if (result) {
              params = { 
                 "id" : id 
              };
              ajaxPost(null,'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/survey/close")?>',params,function(data){
                if(data.result)
                  window.location.reload();
                else 
                  toastr.error(data.msg);
              });
          } 
      });
 }

  function dejaVote(){
    alert("Vous ne pouvez pas votez 2 fois, ni changer de vote.");
  }

  function moderateEntry(id,action)
    {
      console.warn("--------------- moderateEntry ---------------------");
      params = { 
        "survey" : id , 
        "action" : action , 
        "app" : "<?php echo Yii::app()->controller->module->id?>"};
      ajaxPost("moderateEntryResult",'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/survey/moderateentry")?>',params,function(){
        window.location.reload();
      });
    }

    /* **************************************
    *
    *  Design stuff
    *
    ***************************************** */
    function AutoGrowTextArea(textField)
    {
      /*if (textField.clientHeight < textField.scrollHeight)
      {
        textField.style.height = textField.scrollHeight + "px";
        if (textField.clientHeight < textField.scrollHeight)
        {
          textField.style.height = 
            (textField.scrollHeight * 2 - textField.clientHeight) + "px";
        }
      }*/
    }
    activeView = ".home";
    function hideShow(ids,parent)
    {
      $(activeView).addClass("hidden");
      $(ids).removeClass("hidden");
      activeView = ids;
    }
    function copytoPopin(){
      txt = $('#message1').val();
      //AutoGrowTextArea(this);
      $('#message').val(txt);
      $('#nameaddEntry').val(txt.substring(0,20));
    }
    function moduleWording(){
      $(".loginFormToptxt").html( "Inscrivez vous avec votre email pour donner vos consignes de votes et faire des propositions."+
                                  "<br/>Si vous êtes déja inscrit , connectez vous avec votre email d'inscription.");
      $(".loginFormToptxt2").html("Si vous n'avez pas de compte ce même formulaire vous créera un compte, sinon vous logguera.");
    }

function readEntrySV(data,type) { 
  console.warn("--------------- readEntrySV ---------------------");
  console.dir(data);
  $("#readEntryContainer").html("<div class='col-sm-8 col-sm-offset-2 '>"+
              '<h1 class="homestead text-red center citizenAssembly-header">'+
              '<i class="fa fa-pie-chart "></i>'+
              '<br>'+
              '<small class="homestead text-dark center"> Resultats du moment </small>'+
             ' </h1>'+
              "<div class='space20'></div>"+
              "<a href='javascript:toggleGraph()' class='pull-left'><i class='fa fa-chevron-circle-left text-red fa-2x'></i></a>"+
              // "<h1 id='entryTitle' ></h1>"+
              "<div class='space20 center' id='entryContent'></div>"+
              "</div>");
  
  $("#entryContent").html(data.content);
  $("#entryTitle").html(data.title);
  if(type=="graph")
    setUpGraph();
  toggleGraph()
}

function toggleGraph(){
  if( $("#readEntryContainer").hasClass('hide') ){
    $("#readEntryContainer").removeClass('hide');
    $(".stepContainer").addClass('hide');
  } else {
    $(".stepContainer").removeClass('hide');
    $("#readEntryContainer").addClass('hide');
  }
}

</script>
<div class="hide" id="readEntryContainer"></div>

<?php
if($where["type"]==Survey::TYPE_ENTRY){
  Yii::app()->controller->renderPartial(Yii::app()->params["modulePath"].Yii::app()->controller->module->id.'.views.survey.modals.voterloiDesc');
  Yii::app()->controller->renderPartial(Yii::app()->params["modulePath"].Yii::app()->controller->module->id.'.views.survey.modals.cgu');
  if($commentActive){
    Yii::app()->controller->renderPartial(Yii::app()->params["modulePath"].Yii::app()->controller->module->id.'.views.survey.modals.comments');
  }
} 
?>


