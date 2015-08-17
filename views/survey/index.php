<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->controller->module->assetsUrl. '/survey/css/mixitup/reset.css');
$cs->registerCssFile(Yii::app()->controller->module->assetsUrl. '/survey/css/mixitup/style.css');
$cs->registerScriptFile(Yii::app()->controller->module->assetsUrl. '/survey/js/highcharts.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->controller->module->assetsUrl. '/survey/js/exporting.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->controller->module->assetsUrl. '/survey/js/jquery.mixitup.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets'.'/plugins/share-button/ShareButton.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets'.'/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' , CClientScript::POS_END);

$commentActive = true;
?>

<style type="text/css">
  .connect{border-radius: 8px; opacity: 0.9;background-color: #182129; margin-bottom: 10px;border:1px solid #3399FF;width: 100%;padding: 10px }
  button.filter,button.sort{color:#000;}
  a.btn{margin:3px;}
  .mix{border-radius: 8px;}
  

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
</style>

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
          $link = '<a class="titleMix '.$meslois.'" href="'.Yii::app()->createUrl("/".Yii::app()->controller->module->id."/survey/entries/id/".(string)$entry["_id"]).'">'.$name.' ('.$count.')</a>' ;
        else if ( $entry["type"] == "entry" )
          $link = '<a class="titleMix '.$meslois.'" onclick="entryDetail(\''.Yii::app()->createUrl("/".Yii::app()->controller->module->id."/survey/entry/id/".(string)$entry["_id"]).'\')" href="javascript:;">'.$name.'</a>' ;
        
  
        //$infoslink bring visual detail about the entry
        $infoslink = "";
        $infoslink .= (!empty($followingEntry)) ? "<a class='btn voteAbstain filter' data-filter='.myentries' ><i class='fa fa-rss infolink' ></i></a>" :"";
  
        $infoslink .= (!empty($meslois)) ? ' <a class="btn btn-xs filter" data-filter=".myentries" onclick="entryDetail(\''.Yii::app()->createUrl("/".Yii::app()->controller->module->id."/survey/entry/id/".(string)$entry["_id"]).'\',\'edit\')" href="javascript:;"><i class="fa fa-user infolink"></i> Edit</a> ' : '';                          
        if (Yii::app()->session["userIsAdmin"]) {
          $linkStandalone = Yii::app()->createUrl("/".Yii::app()->controller->module->id."/survey/entry/id/".(string)$entry["_id"]);
          $infoslink .= "<a target='_blank' class='btn voteAbstain' href='".$linkStandalone."' title='Open standalone page'><i class='fa fa-magic infolink'></i></a>";
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
        $info = ($totalVote) ? '<span class="info">'.$totalVote.' sur <span class="info voterTotal">'.$uniqueVoters.'</span> voter(s)</span><br/>':'<span class="info"></span><br/>';
  
        $content = ($entry["type"]==Survey::TYPE_ENTRY) ? "".$entry["message"]:"";
  
        $leftLinks = $voteLinksAndInfos["links"];
        $graphLink = ($totalVote) ?' <a class="btn voteAbstain" onclick="entryDetail(\''.Yii::app()->createUrl("/".Yii::app()->controller->module->id."/survey/graph/id/".(string)$entry["_id"]).'\',\'graph\')" href="javascript:;"><i class="fa fa-th-large"></i> Result</a> ' : '';
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
          $byInfo = "by <a href='".Yii::app()->createUrl(Yii::app()->controller->module->id."/".$parentCtrler."/dashboard/id/".$entry["parentId"])."'><i class='fa fa-".$parentIcon."'></i></a>";
        }

        $contextType = ( $entry["type"] == Survey::TYPE_ENTRY ) ? Survey::COLLECTION : Survey::PARENT_COLLECTION;
        $commentBtn = "<a class='btn btn-xs voteAbstain' href='".Yii::app()->createUrl(Yii::app()->controller->module->id."/comment/index/type/".$contextType."/id/".$entry["_id"])."'>".@$entry["commentCount"]." <i class='fa fa-comment'></i> Comment</a>";
        $closeBtn = "";
        $isClosed = "";
        if( Yii::app()->session["userEmail"] == $entry["email"] && (!isset($entry["dateEnd"]) || $entry["dateEnd"] > time() ) && $entry["type"] == Survey::TYPE_ENTRY ) 
          $closeBtn = "<a class='btn btn-xs btn-danger' href='javascript:;' onclick='closeEntry(\"".$entry["_id"]."\")'><i class='fa fa-times'></i> CLOSE</a>";
        else
            $isClosed = " closed";
        $cpList = ( ( @$where["type"]==Survey::TYPE_SURVEY) ? $cpList : "");
        $createdInfo =  (!empty( $created )) ? " created : ".$created : "";
        $ends =  (!empty( $entry["dateEnd"] )) ? '<div class="space1"></div>'." end : ".date("d/m/y",$entry["dateEnd"]) : "";
        $boxColor = ($entry["type"]==Survey::TYPE_ENTRY ) ? "boxColor1" : "boxColor2" ;
        $block = ' <div class="mix '.$boxColor.' '.$avoter.' '.
                        $meslois.' '.
                        $followingEntry.' '.
                        $tags.' '.
                        $cpList.$isClosed.'"'.
                        
                        'data-vote="'.$ordre.'"  data-time="'.
                        $created.'" style="display:inline-blocks"">'.
                        $link.'<br/>'.
                        $info.
                        //$tags.
                        //$content.
                        '<div class="space1"></div><div class="pull-right" >'.$leftLinks.'</div>'.
                        //'<div class="space1"></div>'.$rightLinks.

                       
                        '<div class="space1"></div>'.$createdInfo.$views.
                        $ends.
                        '<div class="space1"></div><div class="pull-left" >'.
                            $graphLink.$infoslink.$commentBtn.$closeBtn. 
                            $byInfo.
                        '</div>'.
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
    <div class="controls" style="border-radius: 8px;">
          <button class="filter btn fr" data-filter="all">Tout</button>
          
          <?php if( $logguedAndValid && $where["type"]==Survey::TYPE_ENTRY ) { ?>
          <label>Participation : </label>
          <button class="sort " data-sort="vote:asc">Asc</button>
          <button class="sort " data-sort="vote:desc">Desc</button>
          <?php } ?>
          <label>Chronologique : </label>
          <button class="sort " data-sort="time:asc">Asc</button>
          <button class="sort " data-sort="time:desc">Desc</button>
          <label>Affichage:</label>
          <button id="ChangeLayout"><i class="fa fa-reorder"></i></button>
          <br/>

          <?php if(!isset($_GET["cp"]) && $where["type"]==Survey::TYPE_SURVEY){?> 
          <label>Géographique : </label>
          <?php echo $cpBlock; 
          }?>
          <br/>

          <label>Filtre:</label>
          <?php if( $logguedAndValid && $where["type"]==Survey::TYPE_ENTRY){?>
          <a class="filter btn btn-orange" data-filter=".avoter">To vote</a>
          <a class="filter btn btn-orange" data-filter=".mesvotes">My votes</a>
          <a class="filter btn btn-orange" data-filter=".myentries">My proposals</a>
          <a class="filter btn btn-orange" data-filter=".closed">Closed</a>
          <?php } ?>
          
          <?php echo $tagBlock?>

    </div>

    <div id="mixcontainer" class="mixcontainer">
        <?php echo (count($list)) ? $blocks : '<div class="mix">aucun sondage'.
                                              '<a href="#" class="newVoteProposal btn btn-orange"><i class="fa fa-plus"></i></a>'.
                                             '</div>'; ?>
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
clickedVoteObject = null;
jQuery(document).ready(function() {
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
var layout = 'grid', // Store the current layout as a variable
$container = $('#mixcontainer'), // Cache the MixItUp container
$changeLayout = $('#ChangeLayout'); // Cache the changeLayout button

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
    getAjax( null , url , function(data){
      if(type == "edit") 
        editEntrySV (data);
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



</script>
<?php
if($where["type"]==Survey::TYPE_ENTRY){
  Yii::app()->controller->renderPartial('editEntrySV',array("survey"=>$where[Survey::TYPE_SURVEY]));
  Yii::app()->controller->renderPartial(Yii::app()->params["modulePath"].Yii::app()->controller->module->id.'.views.survey.modals.voterloiDesc');
  Yii::app()->controller->renderPartial(Yii::app()->params["modulePath"].Yii::app()->controller->module->id.'.views.survey.modals.cgu');
  if($commentActive){
    Yii::app()->controller->renderPartial(Yii::app()->params["modulePath"].Yii::app()->controller->module->id.'.views.survey.modals.comments');
  }
} 
?>


