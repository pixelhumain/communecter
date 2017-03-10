<?php 
  $cs = Yii::app()->getClientScript();

  $cssAnsScriptFilesModule = array(
    // '/survey/css/mixitup/reset.css',
    '/survey/css/mixitup/style.css',
    '/survey/js/jquery.mixitup.min.js'
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

  $cssAnsScriptFilesModule = array(
    //'/plugins/share-button/ShareButton.min.js' , 
    '/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->request->baseUrl);

  $commentActive = true;
?>

<?php 
  $nameList = (strlen($where["survey"]["name"])>20) ? substr($where["survey"]["name"],0,20)."..." : $where["survey"]["name"];
  $extraBtn = ( Authorisation::canParticipate( Yii::app()->session['userId'], $parentType, $parentId ) ) 
    ?  ' <i class="fa fa-caret-right"></i> <a class="filter btn  btn-xs btn-primary Helvetica lbh" href="#survey.editEntry.survey.'.(string)$where["survey"]["_id"].'"><i class="fa fa-plus"></i> '.Yii::t( "survey", 'Add a proposal', null, Yii::app()->controller->module->id).'</a>' 
    : '';

  if(!isset($_GET["renderPartial"])){
    $this->renderPartial('../rooms/header',array(    
            "archived"=> (@$where["survey"]["status"] == ActionRoom::STATE_ARCHIVED) ,
            "parent" => $parent, 
            "parentId" => $parentId, 
            "parentType" => $parentType, 
            "fromView" => "survey.entries",
            "faTitle" => "gavel",
            "colorTitle" => "azure",
            "textTitle" => 
              "<a class='text-dark btn' href='javascript:loadByHash(\"#rooms.index.type.$parentType.id.$parentId.tab.2\")'><i class='fa fa-gavel'></i> ".Yii::t("rooms","Decide", null, Yii::app()->controller->module->id)."</a>"." / ".
              "<a class='text-dark btn' href='javascript:loadByHash(\"#survey.entries.id.".(string)$where["survey"]["_id"]."\")'><i class='fa fa-th'></i> ".$nameList."</a>".$extraBtn 
                          
    )); 
    echo '<div class="col-md-12 panel-white padding-15" id="room-container">';
  }
?>

<h1 class="text-dark" style="font-size: 25px;margin-top: 20px;">
  <?php $icon = (@$where["survey"]["status"] == ActionRoom::STATE_ARCHIVED) ? "download" : "archive";
        $archived = (@$where["survey"]["status"] == ActionRoom::STATE_ARCHIVED) ? "<span class='text-small text-red helvetica'>(ARCHIVED)</span>" : "";?>
    <i class="fa fa-angle-down"></i> 
    <span class="homestead"><i class="fa fa-<?php echo $icon;?>"></i> Espace de décision :</span> 
    <?php echo $where["survey"]["name"].$archived;?>
    <div class="btn dropdown no-padding" style="padding-left:10px !important;">
      <a class="dropdown-toggle" type="button" data-toggle="dropdown" style="color:#8b91a0;">
        <i class="fa fa-cog"></i>  <i class="fa fa-angle-down"></i>
      </a>
      <ul class="dropdown-menu">
        <?php if (ActionRoom::canAdministrate(Yii::app()->session["userId"], (string)$where["survey"]["_id"])) {?>
        <li>
          <a href="javascript:;" class="actionRoomDelete" onclick="actionRoomDelete('<?php echo (string)$where["survey"]["_id"] ?>', this, '<?php echo $room['parentId']; ?>')" data-id="<?php echo (string)$where["survey"]["_id"] ?>"><small><i class="fa fa-times"></i> Supprimer</small></a>
        </li>
        <?php } ?>
        <li>
          <a href="javascript:;" class="actionRoomReport" onclick="actionRoomReportAbuse('<?php echo (string)$where["survey"]["_id"] ?>', this)" data-id="<?php echo (string)$where["survey"]["_id"] ?>"><small><i class="fa fa-flag"></i> Reporter au modérateur</small></a>
        </li>
      </ul>
    </div>
</h1>

<?php
  Menu::survey( $where["survey"] );
  $this->renderPartial('../default/panels/toolbar');
?>    

<style type="text/css">


  .assemblyHeadSection {  
    /*background-image:url(<?php echo $this->module->assetsUrl; ?>/images/city/assemblyHead.png); */
    /*background-image:url(<?php echo $this->module->assetsUrl; ?>/images/bg/noise_lines.png); */
  }
  
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
  a.btn.voteMoreInfo{background-color: #C1ABD4 !important;border: 1px solid #789289;}
  a.btn.voteAbstain{color: black;background-color: white;border: 1px solid white;}
  a.btn.voteDown{background-color: #db254e;border: 1px solid #db254e;}
  .step{ background-color: #182129;  opacity: 0.9;}
  .taglist{width: 255px;display: inline;background-color:#3490EC;color:#000;padding: 3px 5px;height: 28px; }

  .progress-bar-green{background-color: #93C22C;}
  .progress-bar-yellow{background-color: yellow; color:black !important;}
  .progress-bar-white{background-color: #C9C9C9; color:black !important;}
  .progress-bar-purple{background-color: #C1ABD4;}
  .progress-bar-red{background-color: #db254e;}

  .btnvote{
    color: white !important; 
    padding: 8px!important;
    font-weight: 500;
    border-radius: 30px!important;
    display: inline-block !important;
  }

  .color-btnvote-green{   background-color: #93C22C!important;}
  .color-btnvote-yellow{  background-color: yellow!important; color:black !important;}
  .color-btnvote-white{   background-color: #FFF!important;  color:black !important; border: 1px solid #939393;}
  .color-btnvote-purple{  background-color: #C1ABD4!important;}
  .color-btnvote-red{   background-color: #db254e!important;}
  .controls{
    background: #fff;
    border-bottom: 1px solid #BDBDBD;
    border-top: 1px solid #fff;
  }

  .mixcontainer .mix{
    border-radius:0px;
    border-color: #CCC;
    height:355px;
    margin:1% 1% !important;
    float:left;
    moz-box-shadow: 0px 2px 4px -3px rgba(101, 101, 101, 0.61);
    -webkit-box-shadow: 0px 2px 4px -3px rgba(101, 101, 101, 0.61);
    -o-box-shadow: 0px 2px 4px -3px rgba(101, 101, 101, 0.61);
    box-shadow: 0px 2px 4px -3px rgba(101, 101, 101, 0.61);
    filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=4);
  }

  .mixcontainer .mix a.active, .mixcontainer .mix span.active{
    background-color: transparent;
    color: #717E87;
    font-size: 13px;
    margin: 0px;
    float: left;
    border: 0px;
  }
  .mixcontainer .mix a.titleMix{
    margin-top: 4px !important;
    float: left;
    width: 100%;
    overflow-y:hidden;
    height:50px;
    font-size: 17px;
  }
  .mixcontainer .mix a.titleMix:hover{
    text-decoration: underline !important;
  }

  .leftlinks {
      text-align: left;
      float: left;
      /*width: 100%;*/
  }

  .leftlinks a.btn{
    border: 1px solid rgba(0, 0, 0, 0.25) !important;
    border-radius: 20px;
    font-size: 18px;
    width:35px;
    height:35px;
  }

  .leftlinks a.btn:hover{
    color:#3C5665;
  }

    .mixcontainer .mix span {
        margin: 0px;
    }

  .mixcontainer .mix,.mixcontainer .mix a, .mixcontainer .mix span{
    background-color: white;
    border-color: #ccc;
  }
  .mixcontainer .switch,.mixcontainer .switch a, .mixcontainer .switch span{
    background-color: #eee;
  }
  .mixcontainer .mix span.message-propostal{
    height: 135px;
    overflow-y: hidden;
  }

  .home .controls {
    border: 1px solid #E4E4E4;
  }

    .message-propostal{
      font-size: 13px !important;
      font-weight: 300 !important;
      margin-top: 0px !important;
      min-height: 110px;
      max-height: 110px;
      line-height: 1.3;
      width:100%;
    }

    .lbl-info-survey{
      font-size: 12px !important;
      font-weight: 500 !important;
      margin-top:3px;
      /*padding:4px;*/
    }

    .progress{
      margin-bottom:5px;
      margin-top:5px;
    }


    .stepContainer hr {
        margin-top: 5px;
        margin-bottom: 5px;
        border: 0;
        border-top: 1px solid #e6e6e6;
        width: 100%;
        float: left;
    }

    .filter.btn{
      margin-bottom: 6px;
    }

   
  @media screen and (max-width: 1399px) {
    .mixcontainer .mix, .mixcontainer .gap{
      width: 48%;
    }
    .assemblyHeadSection {  
      background-position: 0px 50px;
    }
  }
  @media screen and (min-width: 1400px) {
    .mixcontainer .mix, .mixcontainer .gap{
      width: 31%;
    }
  }
  
  @media screen and (max-width: 1000px) {
    .message-propostal{
      min-height: 155px;
      max-height: 155px;
    }
    .mixcontainer .mix {
      height: 400px;
    }
  }

   @media screen and (max-width: 767px) {
    .assemblyHeadSection {  
      background-position: 0px 0px;
    }
    .message-propostal{
      min-height: 165px;
      max-height: 165px;
    }
    .mixcontainer .mix {
      height: 410px;
    }
  }

  @media screen and (max-width: 680px) {
    .mixcontainer .mix, .mixcontainer .gap{
      width: 98%;
    }
    .message-propostal{
      min-height: 155px;
      max-height: 155px;
    }
    .mixcontainer .mix {
      height: 415px;
    }
  }
  @media screen and (max-width: 480px) {
    .mixcontainer .mix, .mixcontainer .gap{
      width: 98%;
    }
    .message-propostal{
      min-height: 195px;
      max-height: 195px;
    }
    .mixcontainer .mix {
      height: 455px;
    }
  }
  .datepicker{z-index:12000 !important;}
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
  $switchcount = 1;

 

    /* **************************************
    *  go through the list of entries for the survey and build filters
    ***************************************** */
    function buildEntryBlock( $entry,$uniqueVoters,$alltags,$parentType,$parentId,$switchcount,$canParticipate, $isArchived){
        $logguedAndValid = Person::logguedAndValid();
        $tagBlock = "";
        $cpBlock = "";
        $name = $entry["name"];
        $message = substr($entry["message"],0,280);
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
              $tagBlock .= ' <button class="filter bg-red btn btn-xs" data-filter=".'.$t.'"><i class="fa fa-tag"></i> '.$t.'</button>';
            }
            $tags .= $t.' ';
          }
        }
  
        $count = PHDB::count ( Survey::COLLECTION, array( "type" => Survey::TYPE_ENTRY,
                                                          "survey" => (string)$entry["_id"] ) );
        
        /* **************************************
        //check if I wrote this law
        *************************************** */
        $meslois = ( $logguedAndValid && Yii::app()->session["userEmail"] && $entry['email'] == Yii::app()->session["userEmail"] ) ? "myentries" : "";
        
        //checks if the user is a follower of the entry
        $followingEntry = ( $logguedAndValid && Action::isUserFollowing($entry,Action::ACTION_FOLLOW) ) ? "myentries":"";

        $message = "<div class='text-dark no-border message-propostal col-md-12 no-padding pull-left'>".$message."</div>";

        //$infoslink bring visual detail about the entry
        $infoslink = "";
        $infoslink .= (!empty($followingEntry)) ? "<a class='btn voteAbstain filter' data-filter='.myentries' ><i class='fa fa-rss infolink' ></i></a>" :"";
  
        /* **************************************
        Rendering Each block
        ****************************************/
        $voteLinksAndInfos = Action::voteLinksAndInfos($logguedAndValid,$entry);
        $avoter = ( @$entry['status'] == ActionRoom::STATE_ARCHIVED || $isArchived ) ? "archived" :$voteLinksAndInfos["avoter"];
        $hrefComment = "#commentsForm";
        $commentCount = 0;
        //$linkComment = ($logguedAndValid && $commentActive) ? "<a class='btn ".$entry["_id"].Action::ACTION_COMMENT."' role='button' data-toggle='modal' href=\"".$hrefComment."\" title='".$commentCount." Commentaire'><i class='fa fa-comments '></i></a>" : "";
        $totalVote = $voteLinksAndInfos["totalVote"];
        //$info = ($totalVote) ? '<span class="info">'.$totalVote.' sur <span class="info voterTotal">'.$uniqueVoters.'</span> vote(s)</span><br/>':'<span class="info"></span>';
  
        $surveyIsClosed = (isset($entry["dateEnd"]) && $entry["dateEnd"] < time() ) ;
        $surveyHasVoted = (isset($voteLinksAndInfos["hasVoted"]) && $voteLinksAndInfos["hasVoted"] == true) ? true : false;
        
        $content = ($entry["type"]==Survey::TYPE_ENTRY) ? "".$entry["message"]:"";

       
        $moderatelink = (  @$where["type"]==Survey::TYPE_ENTRY && $isModerator && isset( $entry["applications"][Yii::app()->controller->module->id]["cleared"] ) && $entry["applications"][Yii::app()->controller->module->id]["cleared"] == false ) ? "<a class='btn golink' href='javascript:moderateEntry(\"".$entry["_id"]."\",1)'><i class='fa fa-plus ' ></i></a><a class='btn alertlink' href='javascript:moderateEntry(\"".$entry["_id"]."\",0)'><i class='fa fa-minus ' ></i></a>" :"";
        $rightLinks = (  @$entry["applications"][Yii::app()->controller->module->id]["cleared"] == false ) ? $moderatelink : $infoslink ;
        $rightLinks = ( $entry["type"] == Survey::TYPE_ENTRY ) ? "<div class='rightlinks'>".$rightLinks."</div>" : "";
        $ordre = $voteLinksAndInfos["ordre"];
        $created = ( @$entry["created"] ) ? date("d/m/y h:i",$entry["created"]) : ""; 
        
        $commentBtn = "";
        if(isset($entry["commentCount"]) && $entry["commentCount"] > 0)
        $commentBtn = "<br><i class='fa fa-comment'></i> ".@$entry["commentCount"];

        $views = ( @$entry["viewCount"] ) ? 
            "<span class='no-border pull-right text-dark' style='font-size:13px;'>
              <i class='fa fa-eye'></i> ".$entry["viewCount"].
            $commentBtn."</span>"
            : ""; 
        

        $byInfo = "";
        if ( isset($entry["parentType"]) && isset($entry["parentId"]) ) 
        {
          if($entry["parentType"] == Organization::COLLECTION){
              $parentCtrler = Organization::CONTROLLER;
              $parentIcon = "group";
              $parentColor = "green";
          }
          else if($entry["parentType"] == Person::COLLECTION){
              $parentCtrler = Person::CONTROLLER;
              $parentIcon = "user";
              $parentColor = "yellow";
          }else if($entry["parentType"] == Project::COLLECTION){
              $parentCtrler = Project::CONTROLLER;
              $parentIcon = "lightbulb-o";
              $parentColor = "purple";
          }else if($entry["parentType"] == City::COLLECTION){
              $parentCtrler = City::CONTROLLER;
              $parentIcon = "university";
              $parentColor = "red";
          }
          //$parentTitle = '<a href="'.Yii::app()->createUrl("/communecter/".$parentCtrler."/dashboard/id/".$id).'">'.$parent["name"]."</a>'s ";
          $byInfo = "by <a href='javascript:loadByHash(\"#".$parentCtrler.".detail.id.".$entry["parentId"]."\")'><i class='fa fa-".$parentIcon."'></i></a>";
        }

        $contextType = ( $entry["type"] == Survey::TYPE_ENTRY ) ? Survey::COLLECTION : Survey::PARENT_COLLECTION;

        
        $closeBtn = "";
        $isClosed = "";
        $stateLbl = "<i class='fa fa-gavel'></i> ".Yii::t('rooms', "VOTE", null, Yii::app()->controller->module->id);
        $mainClick = 'loadByHash("#survey.entry.id.'.(string)$entry["_id"].'")';
        $titleIcon = 'gavel';
        if( Yii::app()->session["userEmail"] == $entry["email"] && (!isset($entry["dateEnd"]) || $entry["dateEnd"] > time() ) && $entry["type"] == Survey::TYPE_ENTRY ) 
          $closeBtn = "<a class='btn btn-xs pull-right' href='javascript:;' style='margin-right:5px;'".
                        " onclick='closeEntry(\"".$entry["_id"]."\")'>".
                        "<i class='fa fa-times'></i> ".Yii::t('rooms', 'Close', null, Yii::app()->controller->module->id).
                      "</a>";
        else if($surveyIsClosed){
            $isClosed = " closed";
            $stateLbl = "<i class='fa fa-times text-red'></i> ".Yii::t('rooms', 'Closed', null, Yii::app()->controller->module->id);
            $titleIcon = "times text-red";
        }else{
          $stateLbl = "<i class='fa fa-sign-in text-red'></i> ".Yii::t('rooms', 'Login to vote', null, Yii::app()->controller->module->id);
          $mainClick = 'showPanel("box-login")';
        }

        // if($entry["hasVoted"]){
        //   $stateLbl = "<i class='fa fa-sign-in text-red'></i> ".Yii::t('rooms', 'Login to vote', null, Yii::app()->controller->module->id);
        //   $mainClick = 'showPanel("box-login")';
        // }
        
        //title + Link
        $link = $name;
        if ( $entry["type"] == Survey::TYPE_SURVEY )
          $link = '<a class="titleMix text-dark '.$meslois.'" onclick="showRoom(\'entry\', \''.(string)$entry["_id"].'\')" href="javascript:">'."<i class='fa fa-".$titleIcon."'></i> ".$name.' ('.$count.')</a>' ;
        else if ( $entry["type"] == "entry" )
          $link = '<a class="titleMix text-dark '.$meslois.'" onclick="showRoom(\'entry\', \''.(string)$entry["_id"].'\')" href="javascript:;">'."<i class='fa fa-".$titleIcon."'></i> ".substr($name, 0, 70).'</a>' ;

        //$leftLinks = "<button onclick='".$mainClick."' class='btn btn-default homestead col-md-12' style='font-size:20px;'> ".$stateLbl."</button>"; //$voteLinksAndInfos["links"];


        $btnRead = "";
        $leftLinks = "";
        $btnLbl = "<i class='fa fa-sign-in'></i> ".Yii::t("survey","JOIN TO VOTE", null, Yii::app()->controller->module->id);
        $ctrl = Element::getControlerByCollection($parentType);
        //$btnUrl = "#$ctrl.detail.id.$parentId";
        $btnUrl = '#survey.entry.id.'.(string)$entry["_id"];

        if( @$canParticipate && !$isArchived){
          $btnLbl = "<i class='fa fa-gavel'></i> ".Yii::t("survey","VOTE", null, Yii::app()->controller->module->id);
          $btnUrl = '#survey.entry.id.'.(string)$entry["_id"];
        }

        if( !$surveyIsClosed && !$surveyHasVoted && !$isArchived )        
        $leftLinks = "<button onclick=".'"loadByHash(\''.$btnUrl.'\')"'." class='col-xs-12 btn btn-default homestead text-red pull-left' style='font-size:20px;'> ".$btnLbl."</button>";
        else{
          $btnRead = '<button onclick="showRoom(\'entry\', \''.(string)$entry["_id"].'\')"'." class='btn btn-lg btn-default homestead pull-right text-bold tooltips' ".
                  ' data-toggle="tooltip" data-placement="left" title="Afficher les détails"'.
                  " style='margin-top: -2px;margin-right: -5px;margin-bottom: -1px;'><i class='fa fa-angle-right'></i></button>"; //$voteLinksAndInfos["links"];
        }
        //ajouter les bouton dans le panels
        if($surveyHasVoted || $surveyIsClosed ){
            $leftLinks = $voteLinksAndInfos["links"]; //$voteLinksAndInfos["links"];
        }

        // if( $surveyHasVoted || $surveyIsClosed) 
        // $btnRead = "<button onclick=".'"loadByHash(\'#survey.entry.id.'.(string)$entry["_id"].'\')"'." class='btn btn-lg btn-default homestead pull-right text-bold tooltips' ".
        //           ' data-toggle="tooltip" data-placement="left" title="Afficher les détails"'.
        //           " style='margin-top: -2px;margin-right: -5px;margin-bottom: -1px;'><i class='fa fa-angle-right'></i></button>"; //$voteLinksAndInfos["links"];

        $cpList = ( ( @$where["type"]==Survey::TYPE_SURVEY) ? $cpList : "");
        
        $createdInfo  = "<div class='text-azure lbl-info-survey '><i class='fa fa-clock-o' style='padding:0px 5px 0px 2px;'></i> ";
        $createdInfo .= (!empty( $created )) ? " ".Yii::t("rooms", "created", null, Yii::app()->controller->module->id) . " : ".$created : "";
        $createdInfo .= "</div>";

        $ends = "";
        //if( Yii::app()->session["userEmail"] == $entry["email"] ){
        if($entry["type"]==Survey::TYPE_ENTRY && (!isset($entry["dateEnd"]) || $entry["dateEnd"] > time() ) ){
          $ends  = "<div class='text-green lbl-info-survey pull-left' style='color: rgb(228, 108, 108);'><i class='fa fa-clock-o' style='padding:0px 5px 0px 2px;'></i> ";
          $ends .=  "".(!empty( $entry["dateEnd"] )) ? " ".Yii::t("rooms", "end", null, Yii::app()->controller->module->id) . " : ".date("d/m/y",$entry["dateEnd"]) : "";
          $ends .= "</div>";
        }else{
          $ends  = "<div class='text-red lbl-info-survey pull-left' style='color: rgb(228, 108, 108);'><i class='fa fa-clock-o' style='padding:0px 5px 0px 2px;'></i> ";
          $ends .=  "".(!empty( $entry["dateEnd"] )) ? " ".Yii::t("rooms", "ended", null, Yii::app()->controller->module->id) . " : ".date("d/m/y",$entry["dateEnd"]) : "";
          $ends .= "</div>";
        }
        //}

        $chartBarResult = Survey::getChartBarResult($entry);

        $boxColor = ($entry["type"]==Survey::TYPE_ENTRY ) ? "" : "bg-azure" ;
        $switchClass = ( $switchcount < 0 ) ? "" : "switch" ;
        $block = ' <div class="mix '.$boxColor.' '.$avoter.' '.$switchClass.' '.
                        $meslois.' '.
                        $followingEntry.' '.
                        $tags.' '.
                        $cpList.$isClosed.'"'.
                        
                        'data-vote="'.$ordre.'"  data-time="'.
                        $created.'" style="display:inline-blocks"">'.
                        $views.
                        $createdInfo.
                        $ends.
                        "<hr>".
                        $leftLinks.$btnRead.
                        "<hr>".
                        $link.'<br/>'.
                        $message.//'<br/>'.
                        //$info.
                        //$tags.
                        //$content.
                        '<br/>'.
                        '<div class="space1"></div>'.
                        '<div class="pull-right" >'.
                            $infoslink. 
                            $byInfo.
                        '</div>'.

                        "<hr>".
                        $chartBarResult.
                        
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
        $switchcount = -$switchcount;
        $isArchived = ( @$where["survey"]["status"] == ActionRoom::STATE_ARCHIVED ) ? true : false;
        $entryMap = buildEntryBlock($entry,$uniqueVoters,$alltags,$parentType,$parentId,$switchcount, $canParticipate, $isArchived );
        $blocks .= $entryMap["block"]; 
        $alltags = $entryMap["alltags"];
        $tagBlock .= $entryMap["tagBlock"];
        $cpBlock .= $entryMap["cpBlock"];
    }
    
    ?>
    

    <div class="panel-white" style="display:inline-block; width:100%;">
   
          <div class="col-md-4 col-sm-4 margin-bottom-15">
                <?php 
                  $this->renderPartial('../pod/fileupload', array("itemId" => (string)$where["survey"]["_id"],
                                            "type" => ActionRoom::COLLECTION,
                                            "resize" => false,
                                            "contentId" => Document::IMG_PROFIL,
                                            "editMode" => @$canParticipate,
                                            "image" => $images,
                                            "parentType" => $parentType,
                                            "parentId" => $parentId)); 
                ?>
          </div>   
                
         <?php if (count(@$list) > 0) { ?>
           <div class="controls col-md-8 col-sm-8 bar-btn-filters no-border no-padding" style="border-radius:0px;">
                <div class="pull-left">
                  <button class="filter btn btn-default fr" data-filter="all"><i class="fa fa-eye"></i> Afficher tout</button>
                  <button id="ChangeLayout" class="btn btn-default" style="margin-bottom: 6px;"><i class="fa fa-reorder"></i></button>
                  
                  <!--<button class="btn btn-default fr pull-left" onclick="toogleTags();"><i class="fa fa-filter"></i> Filtrer par tags</button>-->
                </div>    
           </div>
          
        
           <div class="col-md-8 col-sm-8 no-padding">
              <a class="filter btn bg-dark" data-filter=".closed">
                <i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'Closed', null, Yii::app()->controller->module->id)?>
              </a>
              <?php if( $logguedAndValid && $where["type"]==Survey::TYPE_ENTRY){?>
                <a class="filter btn bg-dark" data-filter=".avoter">
                  <i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'To vote', null, Yii::app()->controller->module->id)?>
                </a>
              <?php } ?>
              <a class="filter btn bg-dark" data-filter=".mesvotes">
                <i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'My votes', null, Yii::app()->controller->module->id)?>
              </a>
              <a class="filter btn bg-dark" data-filter=".myentries">
                <i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'My proposals', null, Yii::app()->controller->module->id)?>
              </a>
            </div> 
           
            <div class="col-md-8 col-sm-8 no-padding" style="display:inline-block;">
                  <?php if( $logguedAndValid && $where["type"]==Survey::TYPE_ENTRY ) { ?>
                  <button class="sort btn btn-default" data-sort="vote:asc"><i class="fa fa-caret-up"></i></button>
                  <button class="sort btn btn-default" data-sort="vote:desc"><i class="fa fa-caret-down"></i></button>
                  <label class="margin-right-15">- Participation</label>
                  <?php } ?>
                  <button class="sort btn btn-default" data-sort="time:asc"><i class="fa fa-caret-up"></i></button>
                  <button class="sort btn btn-default" data-sort="time:desc"><i class="fa fa-caret-down"></i></button>
                  <label class="margin-right-15">- Chronologie</label>
                  <!-- <label>Affichage :</label> -->
                  <br/>

                  <?php if(!isset($_GET["cp"]) && $where["type"]==Survey::TYPE_SURVEY){?> 
                  <label>Géographique : </label>
                  <?php echo $cpBlock; 
                  }?>
                  <br/>
             </div>
          
          <div class="col-md-12 col-sm-12">      
            <div id="tags-container" class="margin-bottom-15">
              <?php echo $tagBlock?>
            </div>
          </div>
        <?php } ?>

        <div class="col-md-8 col-sm-12">
           <?php if (@$canParticipate) { ?>
                 <div id="infoPodOrga" class="padding-10">
                  <?php if (count(@$list) == 0) { ?>
                  <blockquote class="padding-10"> 
                    <span class="text-extra-large text-green "><i class="fa fa-check"></i> Espace ouvert</span><br>
                    <small>Un espace de décision peut contenir plusieurs propositions.</small>
                    <br>Référencez et partagez <b>une par une</b>,
                    <br>les propositions qui concernent cet espace
                    <br><br>
                    <button class="btn btn-success" onclick='openForm("entry","sub")''>
                      <i class="fa fa-plus"></i> Ajouter une proposition
                    </button>
                  </blockquote>
                  <?php } ?>
                </div>
                <?php }else{ ?>
                  <blockquote> 
                    <span class=""><i class="fa fa-angle-right"></i> 
                    <?php 
                      if(isset(Yii::app()->session["userId"])){
                        if( $where["survey"]["parentType"] == City::COLLECTION )
                          echo Yii::t('rooms', 'Participation open to city residents only', null, Yii::app()->controller->module->id);
                        else
                          echo Yii::t('rooms', 'JOIN TO PARTICIPATE', null, Yii::app()->controller->module->id);
                      }
                      else
                        echo Yii::t('rooms', 'LOGIN TO PARTICIPATE', null, Yii::app()->controller->module->id);
                    ?> 
                    </span>
                  </blockquote>
                <?php } ?>
        </div>

        <div id="mixcontainer" class="mixcontainer col-md-12">
            <?php echo (count($list) > 0) ? $blocks : "" ?>
        </div>
      </div>

    </div>

    </section>

<?php  if( Authorisation::canParticipate(Yii::app()->session['userId'],$where["survey"]["parentType"],$where["survey"]["parentId"]) ) { ?>
<div class="modal fade" id="modal-create-proposal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-dark">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-left">
          <i class="fa fa-angle-down"></i> <i class="fa fa-plus"></i> Créer une proposition
        </h2>
      </div>
      <div class="modal-body no-padding">
        <div class="panel-body" id="form-create-proposal">
          <?php //var_dump($where["survey"]);
              $params = array(
                  "roomId"=>(string)$where["survey"]["_id"]
              );
            $this->renderPartial('../survey/editEntrySV', $params); 

          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-success"
                 onclick="saveNewProposal()">
              <i class="fa fa-save"></i> Enregistrer
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<div class="space20"></div>


<script type="text/javascript">

/* **************************************
*
*  Initialisation
*
***************************************** */

 var contextData = {
    name : "<?php echo addslashes(@$where["survey"]["name"]) ?>",
    id : "<?php echo (string)@$where["survey"]["_id"] ?>",
    type : "entry",
    controller : "survey",
    controller : "<?php echo Survey::CONTROLLER;?>",
    otags : "<?php echo addslashes(@$where["survey"]["name"]).",débat, proposition, question, vote, communecter,".addslashes(@implode(",", @$where["survey"]["tags"])) ?>",
    odesc : <?php echo json_encode( 'Propositions : '.addslashes(@$where["survey"]["name"])); ?>,
    parentType : "<?php echo @$where["survey"]["parentType"] ?>",
    parentId : "<?php echo (string)@$where["survey"]["parentId"] ?>"
  };  

var layout = 'grid', // Store the current layout as a variable
$container = $('#mixcontainer'), // Cache the MixItUp container
$changeLayout = $('#ChangeLayout'); // Cache the changeLayout button
clickedVoteObject = null;

var nbSurveyTotal = <?php echo count($list); ?>;

jQuery(document).ready(function() {
  setTitle("Décider ensemble","gavel text-red");
  $(".main-col-search").addClass("assemblyHeadSection");
  $('.tooltips').tooltip();

  if(nbSurveyTotal > 0)
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
    mylog.log(clickedVoteObject);
   });

  $('#form-create-proposal #btn-submit-form').addClass("hidden");
  $(".explainLink").click(function() {
    showDefinition( $(this).data("id") );
    return false;
  });
});


function saveNewProposal(){
  $('#form-create-proposal #btn-submit-form').off().click();
}

function toogleTags(){
  if($("#tags-container").hasClass("hidden")){
    $("#tags-container").removeClass("hidden");
  }else{
    $("#tags-container").addClass("hidden");
  }

}


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
    mylog.warn("--------------- entryDetail ---------------------",url);
    getAjax( "surveyDetails" , url , function(data){
      //$("#surveyDetails").html(data);
      mylog.dir(data);
      
      mylog.log("type", type);
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
    mylog.warn("--------------- addaction ---------------------");
    
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


  function dejaVote(){
    alert("Vous ne pouvez pas votez 2 fois, ni changer de vote.");
  }

  function moderateEntry(id,action)
    {
      mylog.warn("--------------- moderateEntry ---------------------");
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
  mylog.warn("--------------- readEntrySV ---------------------");
  mylog.dir(data);
  $("#readEntryContainer").html("<div class='col-sm-10 col-sm-offset-1 '>"+
              '<h1 class="homestead text-red center citizenAssembly-header">'+
              '<i class="fa fa-pie-chart "></i>'+
              '<br>'+
              '<small class="homestead text-dark center"> Resultats du moment </small>'+
             ' </h1>'+
              "<a href='javascript:toggleGraph()' class='pull-left' style='top: 92px; float: right !important; margin-top: -120px; margin-right: 5px;'>"+
                "<i class='fa fa-times-circle-o  text-dark fa-2x'></i>"+
              "</a>"+
              // "<h1 id='entryTitle' ></h1>"+
              //"<div class='space20'></div>"+
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

function archive(collection,id){
  mylog.warn("--------------- archive ---------------------",collection,id);
    
  bootbox.confirm("Vous êtes sûr ? ",
      function(result) {
        if (result) {
          params = { 
             "id" : id ,
             "type":collection,
             "name":"status",
             "value":"<?php echo ( @$where["survey"]["status"] != ActionRoom::STATE_ARCHIVED ) ? ActionRoom::STATE_ARCHIVED : "" ?>",
          };
          ajaxPost(null,'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/element/updatefield")?>',params,function(data){
            loadByHash(window.location.hash);
          });
      } else {
        $("."+clickedVoteObject).removeClass("faa-bounce animated");
      }
  });
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

 if(!isset($_GET["renderPartial"])){
  echo "</div>"; // ferme le id="room-container"
 }
?>


