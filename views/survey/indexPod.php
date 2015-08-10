<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($this->module->assetsUrl. '/survey/css/mixitup/reset.css');
$cs->registerCssFile($this->module->assetsUrl. '/survey/css/mixitup/style.css');
$cs->registerScriptFile($this->module->assetsUrl. '/survey/js/highcharts.js' , CClientScript::POS_END);
$cs->registerScriptFile($this->module->assetsUrl. '/survey/js/exporting.js' , CClientScript::POS_END);
$cs->registerScriptFile($this->module->assetsUrl. '/survey/js/jquery.mixitup.min.js' , CClientScript::POS_END);

$commentActive = true;

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
    foreach ($list as $key => $value) 
    {
      $name = $value["name"];
      $email =  (isset($value["email"])) ? $value["email"] : "";
      $cpList = (isset($value["cp"])) ? $value["cp"] : "";
      if( !isset($_GET["cp"]) && $value["type"] == Survey::TYPE_SURVEY )
      {
        if(isset($value["cp"]))
        {
          if(is_array($value["cp"]))
          {
            $cpList = "";
            foreach ($value["cp"] as $cp) {
              if(!in_array($cp, $cps)){
                $cpBlock .= ' <button class="filter " data-filter=".'.$cp.'">'.$cp.'</button>';
                array_push($cps, $cp);
              }
              $cpList .= $cp." ";
            }
          } 
          else if(!in_array($value["cp"], $cps))
          {
            $cpBlock .= ' <button class="filter " data-filter=".'.$value["cp"].'">'.$value["cp"].'</button>';
            array_push($cps, $value["cp"]);
          }
        }
      }

      $tags = "";
      if(isset($value["tags"]))
      {
        foreach ($value["tags"] as $t) 
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
                                                        "survey"=>(string)$value["_id"] ) );
      $link = $name;

      /* **************************************
      //check if I wrote this law
      *************************************** */
      $meslois = ($logguedAndValid && Yii::app()->session["userEmail"] && $value['email'] == Yii::app()->session["userEmail"]) ? "myentries" : "";
      
      //checks if the user is a follower of the entry
      $followingEntry = ($logguedAndValid 
                        && isset($value[Action::ACTION_FOLLOW]) 
                        && is_array($value[Action::ACTION_FOLLOW]) 
                        && in_array(Yii::app()->session["userId"], $value[Action::ACTION_FOLLOW])) ? "myentries":"";
      
      if ( $value["type"] == Survey::TYPE_SURVEY )
        $link = '<a class="titleMix '.$meslois.'" href="'.Yii::app()->createUrl("/".$this->module->id."/survey/entries/id/".(string)$value["_id"]).'">'.$name.' ('.$count.')</a>' ;
      else if ( $value["type"] == "entry" )
        $link = '<a class="titleMix '.$meslois.'" onclick="entryDetail(\''.Yii::app()->createUrl("/".$this->module->id."/survey/entry/id/".(string)$value["_id"]).'\')" href="javascript:;">'.$name.'</a>' ;
      
      //$infoslink bring visual detail about the entry
      $infoslink = "";
      $infoslink .= (!empty($followingEntry)) ? "<i class='fa fa-rss infolink' ></i>" :"";
      $infoslink .= (!empty($meslois)) ? "<i class='fa fa-user infolink' ></i>" :"";

      
      //has loged user voted on this entry 
      //vote UPS
      $voteUpActive = ( $logguedAndValid 
                     && isset($value[Action::ACTION_VOTE_UP])
                     && is_array($value[Action::ACTION_VOTE_UP]) 
                     && in_array( Yii::app()->session["userId"] , $value[Action::ACTION_VOTE_UP] )) ? "active":"";
      $voteUpCount = (isset($value[Action::ACTION_VOTE_UP."Count"])) ? $value[Action::ACTION_VOTE_UP."Count"] : 0 ;
      $hrefUp = ($logguedAndValid && empty($voteUpActive)) ? "javascript:addaction('".$value["_id"]."','".Action::ACTION_VOTE_UP."')" : "";
      $classUp = $voteUpActive." ".Action::ACTION_VOTE_UP." ".$value["_id"].Action::ACTION_VOTE_UP;
      $iconUp = 'fa-thumbs-up';

      //vote ABSTAIN 
      $voteAbstainActive = ($logguedAndValid 
                        && isset($value[Action::ACTION_VOTE_ABSTAIN])
                        && is_array($value[Action::ACTION_VOTE_ABSTAIN])
                        && in_array(Yii::app()->session["userId"], $value[Action::ACTION_VOTE_ABSTAIN])) ? "active":"";
      $voteAbstainCount = (isset($value[Action::ACTION_VOTE_ABSTAIN."Count"])) ? $value[Action::ACTION_VOTE_ABSTAIN."Count"] : 0 ;
      $hrefAbstain = ($logguedAndValid && empty($voteAbstainActive)) ? "javascript:addaction('".(string)$value["_id"]."','".Action::ACTION_VOTE_ABSTAIN."')" : "";
      $classAbstain = $voteAbstainActive." ".Action::ACTION_VOTE_ABSTAIN." ".$value["_id"].Action::ACTION_VOTE_ABSTAIN;
      $iconAbstain = 'fa-circle';

      //vote UNCLEAR
      $voteUnclearActive = ( $logguedAndValid 
                     && isset($value[Action::ACTION_VOTE_UNCLEAR])
                     && is_array($value[Action::ACTION_VOTE_UNCLEAR]) 
                     && in_array( Yii::app()->session["userId"] , $value[Action::ACTION_VOTE_UNCLEAR] )) ? "active":"";
      $voteUnclearCount = (isset($value[Action::ACTION_VOTE_UNCLEAR."Count"])) ? $value[Action::ACTION_VOTE_UNCLEAR."Count"] : 0 ;
      $hrefUnclear = ($logguedAndValid && empty($voteUnclearCount)) ? "javascript:addaction('".$value["_id"]."','".Action::ACTION_VOTE_UNCLEAR."')" : "";
      $classUnclear = $voteUnclearActive." ".Action::ACTION_VOTE_UNCLEAR." ".$value["_id"].Action::ACTION_VOTE_UNCLEAR;
      $iconUnclear = "fa-pencil";

      //vote MORE INFO
      $voteMoreInfoActive = ( $logguedAndValid 
                     && isset($value[Action::ACTION_VOTE_MOREINFO])
                     && is_array($value[Action::ACTION_VOTE_MOREINFO]) 
                     && in_array( Yii::app()->session["userId"] , $value[Action::ACTION_VOTE_MOREINFO] )) ? "active":"";
      $voteMoreInfoCount = (isset($value[Action::ACTION_VOTE_MOREINFO."Count"])) ? $value[Action::ACTION_VOTE_MOREINFO."Count"] : 0 ;
      $hrefMoreInfo = ($logguedAndValid && empty($voteMoreInfoCount)) ? "javascript:addaction('".$value["_id"]."','".Action::ACTION_VOTE_MOREINFO."')" : "";
      $classMoreInfo = $voteMoreInfoActive." ".Action::ACTION_VOTE_MOREINFO." ".$value["_id"].Action::ACTION_VOTE_MOREINFO;
      $iconMoreInfo = "fa-question-circle";

      //vote DOWN 
      $voteDownActive = ($logguedAndValid 
                        && isset($value[Action::ACTION_VOTE_DOWN]) 
                        && is_array($value[Action::ACTION_VOTE_DOWN]) 
                        && in_array(Yii::app()->session["userId"], $value[Action::ACTION_VOTE_DOWN])) ? "active":"";
      $voteDownCount = (isset($value[Action::ACTION_VOTE_DOWN."Count"])) ? $value[Action::ACTION_VOTE_DOWN."Count"] : 0 ;
      $hrefDown = ($logguedAndValid && empty($voteDownActive)) ? "javascript:addaction('".(string)$value["_id"]."','".Action::ACTION_VOTE_DOWN."')" : "";
      $classDown = $voteDownActive." ".Action::ACTION_VOTE_DOWN." ".$value["_id"].Action::ACTION_VOTE_DOWN;
      $iconDown = "fa-thumbs-down";

      //votes cannot be changed, link become spans
      $avoter = "mesvotes";
      if( !empty($voteUpActive) || !empty($voteAbstainActive) || !empty($voteDownActive) || !empty($voteUnclearActive) || !empty($voteMoreInfoActive)){
        $linkVoteUp = ($logguedAndValid && !empty($voteUpActive) ) ? "<span class='".$classUp."' ><i class='fa $iconUp' ></i></span>" : "";
        $linkVoteAbstain = ($logguedAndValid && !empty($voteAbstainActive)) ? "<span class='".$classAbstain."'><i class='fa $iconAbstain'></i></span>" : "";
        $linkVoteUnclear = ($logguedAndValid && !empty($voteUnclearActive)) ? "<span class='".$classUnclear."'><i class='fa  $iconUnclear'></i></span>" : "";
        $linkVoteMoreInfo = ($logguedAndValid && !empty($voteMoreInfoActive)) ? "<span class='".$classMoreInfo."'><i class='fa  $iconMoreInfo'></i></span>" : "";
        $linkVoteDown = ($logguedAndValid && !empty($voteDownActive)) ? "<span class='".$classDown."' ><i class='fa $iconDown'></i></span>" : "";
      }else{
        $avoter = "avoter";
        $linkVoteUp = ($logguedAndValid  ) ? "<a class='btn ".$classUp."' href=\" ".$hrefUp." \" title='".$voteUpCount." Pour'><i class='fa $iconUp' ></i></a>" : "";
        $linkVoteAbstain = ($logguedAndValid ) ? "<a class='btn ".$classAbstain."' href=\"".$hrefAbstain."\" title=' ".$voteAbstainCount." Blanc'><i class='fa $iconAbstain'></i></a>" : "";
        $linkVoteUnclear = ($logguedAndValid ) ? "<a class='btn ".$classUnclear."' href=\"".$hrefUnclear."\" title=' ".$voteUnclearCount." Amender'><i class='fa $iconUnclear'></i></a>" : "";
        $linkVoteMoreInfo = ($logguedAndValid ) ? "<a class='btn ".$classMoreInfo."' href=\"".$hrefMoreInfo."\" title=' ".$voteMoreInfoCount." Plus d'informations.'><i class='fa $iconMoreInfo'></i></a>" : "";
        $linkVoteDown = ($logguedAndValid) ? "<a class='btn ".$classDown."' href=\"".$hrefDown."\" title='".$voteDownCount." Contre'><i class='fa $iconDown'></i></a>" : "";
      }
      $hrefComment = "#commentsForm";
      $commentCount = 0;
      $linkComment = ($logguedAndValid && $commentActive) ? "<a class='btn ".$value["_id"].Action::ACTION_COMMENT."' role='button' data-toggle='modal' href=\"".$hrefComment."\" title='".$commentCount." Commentaire'><i class='fa fa-comments '></i></a>" : "";
      $totalVote = $voteUpCount+$voteAbstainCount+$voteDownCount+$voteUnclearCount+$voteMoreInfoCount;
      $info = ($totalVote) ? '<span class="info">'.$totalVote.' sur <span class="info voterTotal">'.$uniqueVoters.'</span> voteur(s)</span><br/>':'<span class="info"></span><br/>';

      $content = ($value["type"]==Survey::TYPE_ENTRY) ? "".$value["message"]:"";

      /* **************************************
      Rendering Each block
      ****************************************/
      $leftLinks = ($value["type"]==Survey::TYPE_ENTRY) ? "<div class='leftlinks'>".$linkVoteUp." ".$linkVoteUnclear." ".$linkVoteAbstain." ".$linkVoteMoreInfo." ".$linkVoteDown."</div>" : "";
      $graphLink = ($totalVote) ?' <a class="btn btn-orange" onclick="entryDetail(\''.Yii::app()->createUrl("/".$this->module->id."/survey/graph/id/".(string)$value["_id"]).'\',\'graph\')" href="javascript:;"><i class="fa fa-th-large"></i></a> ' : '';
      $moderatelink = (  $where["type"]==Survey::TYPE_ENTRY && $isModerator && isset( $value["applications"][$this->module->id]["cleared"] ) && $value["applications"][$this->module->id]["cleared"] == false ) ? "<a class='btn golink' href='javascript:moderateEntry(\"".$value["_id"]."\",1)'><i class='fa fa-plus ' ></i></a><a class='btn alertlink' href='javascript:moderateEntry(\"".$value["_id"]."\",0)'><i class='fa fa-minus ' ></i></a>" :"";
      $rightLinks = (  isset( $value["applications"][$this->module->id]["cleared"] ) && $value["applications"][$this->module->id]["cleared"] == false ) ? $moderatelink : $graphLink.$infoslink ;
      $rightLinks = ($value["type"]==Survey::TYPE_ENTRY) ? "<div class='rightlinks'>".$rightLinks."</div>" : "";
      $ordre = $voteUpCount+$voteDownCount;
      $created = (isset($value["created"])) ? date("d/m/Y h:i",$value["created"]) : ""; 
      $byInfo = "";
      if ( isset($value["parentType"]) && isset($value["parentId"]) ) 
      {
        if($value["parentType"] == Organization::COLLECTION){
            $parentCtrler = Organization::CONTROLLER;
            $parentIcon = "group";
        }
        else if($value["parentType"] == Person::COLLECTION){
            $parentCtrler = Person::CONTROLLER;
            $parentIcon = "user";
        }else if($value["parentType"] == City::COLLECTION){
            $parentCtrler = City::CONTROLLER;
            $parentIcon = "university";
        }
        //$parentTitle = '<a href="'.Yii::app()->createUrl("/communecter/".$parentCtrler."/dashboard/id/".$id).'">'.$parent["name"]."</a>'s ";
        $byInfo = "by <a href='".Yii::app()->createUrl($this->module->id."/".$parentCtrler."/dashboard/id/".$value["parentId"])."'><i class='fa fa-".$parentIcon."'></i></a>";
      }

      $createdInfo =  (!empty( $created )) ? "<br/>created : ".$created : "";
      $blocks .= ' <tr class="mix '.$avoter.' '.
                    $meslois.' '.
                    $followingEntry.' '.
                    $tags.'" >'.
                    '<td>'.$link.'</td>'.
                    ( ( $value["type"] == Survey::TYPE_ENTRY ) ? '<td>'.$info.'</td>' : '').
                    ( ( $value["type"] == Survey::TYPE_ENTRY ) ?'<td>'.$byInfo.'</td>' : '').
                    '<td>'.$createdInfo.'</td>'.
                    ( ( $value["type"] == Survey::TYPE_ENTRY ) ? '<td>'.$leftLinks.'</td>' : '').
                    ( ( $value["type"] == Survey::TYPE_ENTRY ) ? '<td>'.$rightLinks.'</td>' : '').
                    '</tr>';
    }
    ?>


<div class="panel panel-white">
    <div class="panel-heading border-light">
        <div class="pull-right">
            <a href="<?php echo Yii::app()->createUrl( $this->module->id."/survey/index/type/".$type."/id/".$id) ?>" class="btn btn-xs btn-orange">All Surveys <i class="fa fa-legal"></i></a>
        </div>
        <h4 class="panel-title"> Vote en cours</h4>
    </div>

    <div class="panel-body">
          

        <div>
            <table class="table table-striped table-bordered table-hover surveyTable">
                <thead>
                  <tr>
                    <th>Title</th>
                    <?php if( $where["type"] == Survey::TYPE_ENTRY ){ ?>
                    <th>Info</th>
                    <th>by</th>
                    <?php } ?>
                    <th>Date</th>
                    <?php if( $where["type"] == Survey::TYPE_ENTRY ){ ?>
                    <th>action</th>
                    <th></th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody class="directoryLines">
                    <?php echo $blocks; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

</section>

<script type="text/javascript">

/* **************************************
*
*  Initialisation
*
***************************************** */
jQuery(document).ready(function() {
  
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
  function addaction(id,action){
    console.warn("--------------- addaction ---------------------");
    if(confirm("Vous êtes sûr ? Vous ne pourrez pas changer votre vote")){
      params = { 
           "userId" : '<?php echo Yii::app()->session["userId"]?>' , 
           "id" : id ,
           "collection":"surveys",
           "action" : action 
           };
      ajaxPost(null,'<?php echo Yii::app()->createUrl($this->module->id."/survey/addaction")?>',params,function(data){
      window.location.reload();
      });
    }
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
        "app" : "<?php echo $this->module->id?>"};
      ajaxPost("moderateEntryResult",'<?php echo Yii::app()->createUrl($this->module->id."/survey/moderateentry")?>',params,function(){
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
      if (textField.clientHeight < textField.scrollHeight)
      {
        textField.style.height = textField.scrollHeight + "px";
        if (textField.clientHeight < textField.scrollHeight)
        {
          textField.style.height = 
            (textField.scrollHeight * 2 - textField.clientHeight) + "px";
        }
      }
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
      AutoGrowTextArea(this);$('#message').val(txt);
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
  $this->renderPartial('editEntrySV',array("survey"=>$where[Survey::TYPE_SURVEY]));
  $this->renderPartial(Yii::app()->params["modulePath"].$this->module->id.'.views.survey.modals.voterloiDesc');
  $this->renderPartial(Yii::app()->params["modulePath"].$this->module->id.'.views.survey.modals.cgu');
  if($commentActive)
    $this->renderPartial(Yii::app()->params["modulePath"].$this->module->id.'.views.survey.modals.comments');
} 
?>


