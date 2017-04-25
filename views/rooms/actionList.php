<?php 
$cs = Yii::app()->getClientScript();

$cssAnsScriptFilesModule = array(
  //'/survey/css/mixitup/reset.css',
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

<style type="text/css">
.connect{border-radius: 8px; opacity: 0.9;background-color: #182129; margin-bottom: 10px;border:1px solid #3399FF;width: 100%;padding: 10px }
/*button.filter,button.sort{color:#000;}*/
/*a.btn{margin:3px;}*/
.mix{border-radius: 8px;}
.home{margin-top: 0px;}

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
  background: #FFF;
  border-bottom: 1px solid #BDBDBD;
  border-top: 1px solid #fff;
}

.mixcontainer .mix{
  border-radius:0px;
  border-color: #CCC;
  height:270px;
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
  height: 120px;
  overflow-y: hidden;
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

.bar-btn-filters .btn{
  margin-bottom: 6px;
}


.home .controls {
border: 1px solid #E4E4E4;
}


@media screen and (min-width: 1400px) {
  .mixcontainer .mix, .mixcontainer .gap{
    width: 31%;
  }
}
@media screen and (max-width: 1399px) {
  .mixcontainer .mix, .mixcontainer .gap{
    width: 48%;
  }
  .assemblyHeadSection {  
    background-position: 0px 50px;
  }
}

@media screen and (max-width: 767px) {
  .assemblyHeadSection {  
    background-position: 0px 0px;
  }
}

@media screen and (max-width: 680px) {
  .mixcontainer .mix, .mixcontainer .gap{
    width: 98%;
  }
}
.byInfo{
  float: right;
    position: relative;
    bottom: 0px;
    font-size:13px;
}
.byInfo i{
  margin-left:5px;
}
</style>


<div id="surveyDetails"></div>

<section class="mt80 stepContainer">
  <div class="home">

  <?php 
  $logguedAndValid = Person::logguedAndValid();
  $alltags = array(); 
  $blocks = "";
  $tagBlock = "";
  $cpBlock = "";
  $cps = array();
  $switchcount = 1;

    /* **************************************
    *  go through the list of entries for the survey and build filters
    ***************************************** */
    function buildEntryBlock( $entry,$uniqueVoters,$alltags,$parentType,$parentId,$switchcount ){
        $logguedAndValid = Person::logguedAndValid();
        $tagBlock = "-";//<i class='fa fa-info-circle'></i> Aucun tag";
        $cpBlock = "";
        $name = $entry["name"];
        $shortMessage = empty($entry["message"]) ? "" : substr($entry["message"],0,280);
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
        
        /* **************************************
        //check if I wrote this law
        *************************************** */
        $myentries = "";//( $logguedAndValid && Yii::app()->session["userEmail"] && $entry['email'] == Yii::app()->session["userEmail"] ) ? "myentries" : "";
        
        if( @$entry["links"]["contributors"] && @$entry["links"]["contributors"][Yii::app()->session["userId"]] )
          $myentries = "myentries";
        //checks if the user is a follower of the entry
        $followingEntry = ( $logguedAndValid && Action::isUserFollowing($entry,Action::ACTION_FOLLOW) ) ? "myentries":"";

        $message = "<div class='text-dark no-border message-propostal'>".$shortMessage."</div>";
        
        /* **************************************
        Rendering Each block
        ****************************************/
        $hrefComment = "#commentsForm";
        $commentCount = 0;
        $content = ($entry["type"]==ActionRoom::TYPE_ACTION) ? "".$shortMessage:"";

       
        $moderatelink = (   @$entry["applications"][Yii::app()->controller->module->id]["cleared"]  && 
                            $isModerator && $entry["applications"][Yii::app()->controller->module->id]["cleared"] == false ) ? 
              "<a class='btn golink' href='javascript:moderateEntry(\"".$entry["_id"]."\",1)'>".
                "<i class='fa fa-plus ' ></i>".
              "</a>".
              "<a class='btn alertlink' href='javascript:moderateEntry(\"".$entry["_id"]."\",0)'>".
                "<i class='fa fa-minus ' ></i>".
              "</a>" :
              "";

        $rightLinks = (  @$entry["applications"][Yii::app()->controller->module->id]["cleared"] == false ) ? $moderatelink : $infoslink ;
        $rightLinks = ( $entry["type"] == ActionRoom::TYPE_ACTION ) ? "<div class='rightlinks'>".$rightLinks."</div>" : "";
        $created = ( @$entry["created"] ) ? date("d/m/y h:i",$entry["created"]) : ""; 
        $startDate = ( @$entry["startDate"] ) ? date("d/m/y h:i",$entry["startDate"]) : ""; 
        $endDate = ( @$entry["dateEnd"] ) ? date("d/m/y",$entry["dateEnd"]) : ""; 
        $views = ( @$entry["viewCount"] ) ? 
                "<div class='no-border pull-right text-dark' style='font-size:13px;'>".
                  "<i class='fa fa-eye'></i> ".$entry["viewCount"].
                "</div>" : ""; 

        $byInfo = ( @$entry["links"]["contributors"] && count($entry["links"]["contributors"]) > 0 ) ? 
                  " <i class='fa fa-users'></i> ".count($entry["links"]["contributors"]) : 
                  "<i class='fa fa-users text-red'></i> 0";
        
        //$infoslink bring visual detail about the entry
        $infoslink = ( @$entry["urls"] && count($entry["urls"]) > 0 ) ? " <i class='fa fa-link'></i> ".count($entry["urls"]) : "";

        $commentBtn = "";
        $commentBtn = (isset($entry["commentCount"]) && $entry["commentCount"] > 0) ? 
                      " <i class='fa fa-comment'></i>".@$entry["commentCount"] : "";
        
        //title + Link
        if ( $entry["type"] == ActionRoom::TYPE_ACTION )
          $name = '<a class="titleMix text-dark " onclick="showRoom(\'action\', \''.(string)$entry["_id"].'\')" href="javascript:;">'.
                    "<i class='fa fa-cogs'></i> ".substr($name, 0, 70).
                  '</a>' ;

        $btnRead = "";
        $leftLinks = "";

        $createdInfo  = "<div class='text-azure lbl-info-survey '>".
                          "<i class='fa fa-clock-o' style='padding:0px 5px 0px 2px;'></i> ";
        $createdInfo .= (!empty( $startDate )) ? 
                          Yii::t("rooms", "Start Date", null, Yii::app()->controller->module->id) . 
                          " : ".$startDate 
                          : "Non défini";
        $createdInfo .= "</div>";

        $ends = "";
        if($entry["type"]==ActionRoom::TYPE_ACTION && (!isset($entry["dateEnd"]) || $entry["dateEnd"] > time() ) ){
          $ends  = "<div class='text-green lbl-info-survey pull-left' style='color: rgb(228, 108, 108);'>".
                    "<i class='fa fa-clock-o' style='padding:0px 5px 0px 2px;'></i> ";
          $ends .=  (!empty( $endDate )) ? 
                      Yii::t("rooms", "end", null, Yii::app()->controller->module->id) . 
                      " : ".$endDate
                      : "Non défini";
          $ends .= "</div>";
        } else {
          $ends  = "<div class='text-red lbl-info-survey pull-left' style='color: rgb(228, 108, 108);'>".
                    "<i class='fa fa-clock-o' style='padding:0px 5px 0px 2px;'></i> ";
          $ends .=  (!empty( $endDate )) ? 
                      Yii::t("rooms", "ended", null, Yii::app()->controller->module->id) . 
                      " : ".$endDate 
                      : "Non définit";
          $ends .= "</div>";
        }
        
        $statusClass = ActionRoom::ACTION_TODO;
        $statusLbl = Yii::t("rooms", "Todo", null, Yii::app()->controller->module->id);
        $statusColor = "default";
        if( ( isset($action["startDate"]) && $action["startDate"] < time() ) || ( !@$action["startDate"] && @$action["dateEnd"] ) ){
          $statusClass = ActionRoom::ACTION_INPROGRESS;
          $statusLbl = Yii::t("rooms", "Progressing", null, Yii::app()->controller->module->id);
          $statusColor = "success";
          if( @$entry["dateEnd"] < time()  ){
            $statusClass = ActionRoom::ACTION_LATE;
            $statusLbl = Yii::t("rooms", "Late", null, Yii::app()->controller->module->id);
            $statusColor = "warning";
          }
        } 
        if ( @$entry["status"] == ActionRoom::ACTION_CLOSED  ) {
          $statusClass = ActionRoom::ACTION_CLOSED;
          $statusLbl = Yii::t("rooms", "Closed", null, Yii::app()->controller->module->id);
          $statusColor = "danger";
        }
        $status = "<div class='badge badge-".$statusColor." pull-right'>".$statusLbl."</div>";

        $unassignedClass = ( @$entry["links"]["contributors"] && count($entry["links"]["contributors"]) > 0 ) ? "" : "unassigned";

        $boxColor = ($entry["type"]==ActionRoom::TYPE_ACTION ) ? "" : "" ;
        $switchClass = ( $switchcount < 0 ) ? "" : "switch" ;

        $block = ' <div class="mix '.$boxColor.' '.$switchClass.' '.$statusClass.' '.$unassignedClass.' '.
                        $myentries.' '.
                        $followingEntry.' '.
                        $tags.'"'.
                        'data-vote=""  data-time="'.$created.'" style="display:inline-blocks"">'.
                        '<div class="actionDetail" >'.
                          $status.
                          $createdInfo.
                          $ends.
                          "<hr>".
                        '</div>'.
                        $leftLinks.$btnRead.
                        $name.
                        '<br/>'.
                        $message.
                        '<br/>'.
                        '<div class="byInfo text-dark" >'.
                            $views.$commentBtn.$infoslink.$byInfo.
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
        $switchcount = -$switchcount;
        $entryMap = buildEntryBlock( $entry, $uniqueVoters, $alltags, $room['parentType'], $room['parentId'], $switchcount );
        $blocks .= $entryMap["block"]; 
        $alltags = $entryMap["alltags"];
        $tagBlock .= $entryMap["tagBlock"];
        $cpBlock .= $entryMap["cpBlock"];
    }
    ?>
    
      <?php 
      $extraBtn = ( Authorisation::canParticipate(Yii::app()->session['userId'],$room['parentType'],$room['parentId']) ) ?  '<i class="fa fa-caret-right"></i> <a class="filter btn btn-xs btn-primary Helvetica lbh" href="#rooms.editAction.room.'.(string)$room["_id"].'"> <i class="fa fa-plus"></i> '.Yii::t( "survey", 'Add an Action', null, Yii::app()->controller->module->id).'</a>' : '';

      if(!isset($_GET["renderPartial"])){
        $this->renderPartial('../rooms/header',array(    
                  "parent" => $parent, 
                              "parentId" => $room['parentId'], 
                              "parentType" => $room['parentType'], 
                              "fromView" => "rooms.actions",
                              "faTitle" => "cogs",
                              "colorTitle" => "azure",
                              "textTitle" => "<a class='text-dark btn' href='#rooms.index.type.".$room['parentType'].".id.".$room['parentId'].".tab.3'><i class='fa fa-cogs'></i> ".Yii::t("rooms","Actions", null, Yii::app()->controller->module->id)."</a>".
                              " / ".
                              "<a class='text-dark btn' href='#rooms.actions.id.".$room["_id"]."'><i class='fa fa-cogs'></i> ".$room["name"]."</a>".$extraBtn
                             
                              )); 
        echo '<div class="col-md-12 panel-white padding-15" id="room-container">';
      }
   ?>
      
    <div class="panel-white" style="display:inline-block; width:100%;">
   
        <h1 class="text-dark" style="font-size: 25px;margin-top: 20px;">
          <i class="fa fa-caret-down"></i> <i class="fa fa-cogs"></i> <span class="homestead">Espace d'action : </span> <?php echo $room["name"]; ?>
          <div class="btn dropdown no-padding" style="padding-left:10px !important;">
            <a class="dropdown-toggle" type="button" data-toggle="dropdown" style="color:#8b91a0;">
              <i class="fa fa-cog"></i>  <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
              <?php if (ActionRoom::canAdministrate(Yii::app()->session["userId"], (string)$room["_id"])) {?>
              <li>
                <a href="javascript:;" class="actionRoomDelete" onclick="actionRoomDelete('<?php echo (string)$room["_id"] ?>', this, '<?php echo $room['parentId']; ?>')" data-id="<?php echo $room["_id"] ?>"><small><i class="fa fa-times"></i> Supprimer</small></a>
              </li>
              <?php } ?>
              <li>
                <a href="javascript:;" class="actionRoomReport" onclick="actionRoomReportAbuse('<?php echo (string)$room["_id"] ?>', this)" data-id="<?php echo $room["_id"] ?>"><small><i class="fa fa-flag"></i> Reporter au modérateur</small></a>
              </li>
            </ul>
          </div>
        </h1>

        <?php 
          Menu::actions( $room );
          $this->renderPartial('../default/panels/toolbar');
        ?>

        <div class="panel-white margin-top-15" style="display:inline-block; width:100%;">
            <div class="col-md-4 col-sm-4 margin-bottom-15">
              <?php $this->renderPartial('../pod/fileupload', array("itemId" => $room["_id"],
                                          "type" => ActionRoom::COLLECTION,
                                          "resize" => false,
                                          "contentId" => Document::IMG_PROFIL,
                                          "editMode" => Authorisation::canEditItem(Yii::app()->session['userId'],ActionRoom::COLLECTION,$room['_id'],$room['parentType'],$room['parentId']),
                                          "image" => $images,
                                          "parentType" => $room['parentType'],
                                          "parentId" => $room['parentId'])); 
              ?>
            </div>
            
            <?php if ( count(@$list) > 0 ) { ?>

              <div class="controls col-md-8 col-sm-8 bar-btn-filters no-border no-padding">
                    <button class="filter btn btn-default fr" data-filter="all"><i class="fa fa-eye"></i> Afficher tout</button>
                    <button id="ChangeLayout" class="btn btn-default" style="margin-bottom: 6px;"><i class="fa fa-reorder"></i></button>
                    <button id="reduceInfo" class="btn btn-default"  onclick="reduceInfo();"><i class="fa fa-minus-square"></i></button>
              </div>

              <div class="controls col-md-8 col-sm-8 bar-btn-filters no-border no-padding">
                    <?php if( count($alltags) && false ){?>
                      <button class="btn bg-red fr" onclick="toogleTags();"><i class="fa fa-filter"></i>  Tags</button>
                    <?php } ?>
                    <?php if( $logguedAndValid ){?>
                      <a class="filter btn bg-dark" data-filter=".myentries" id="myentriesBtn"><i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'My Todo', null, Yii::app()->controller->module->id)?></a>
                      <a class="filter btn bg-dark" data-filter=".todo" id="todoBtn"><i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'Todo', null, Yii::app()->controller->module->id)?></a>
                      <a class="filter btn bg-dark" data-filter=".inprogress" id="inprogressBtn"><i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'In Progress', null, Yii::app()->controller->module->id)?></a>
                      <a class="filter btn bg-dark" data-filter=".late" id="lateBtn"><i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'Late', null, Yii::app()->controller->module->id)?></a>
                      <a class="filter btn bg-dark" data-filter=".closed" id="closedBtn"><i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'Closed', null, Yii::app()->controller->module->id)?></a>
                      <a class="filter btn bg-dark" data-filter=".unassigned" id="unassignedBtn"><i class="fa fa-filter"></i> <?php echo Yii::t('rooms', 'Unassigned', null, Yii::app()->controller->module->id)?></a>
                    <?php } ?>
              </div>

              <div class="col-md-8 col-sm-8 no-padding">
                <?php if( $logguedAndValid ) { ?>
                  <button class="sort btn btn-default" data-sort="vote:asc"><i class="fa fa-caret-up"></i></button>
                  <button class="sort btn btn-default" data-sort="vote:desc"><i class="fa fa-caret-down"></i></button>
                  <label class="margin-right-15">- Participation</label>
                <?php } ?>
                <button class="sort btn btn-default" data-sort="time:asc"><i class="fa fa-caret-up"></i></button>
                <button class="sort btn btn-default" data-sort="time:desc"><i class="fa fa-caret-down"></i></button>
                <label class="margin-right-15">- Chronologie</label>
              </div>
            
            <?php } ?>
               
            <?php if ( count(@$list) == 0 && false ) { ?>
              <div class="col-md-8 col-sm-8">
                <blockquote> 
                  <span class=""><i class="fa fa-angle-right"></i> 
                  <?php if(isset(Yii::app()->session["userId"]))
                          echo Yii::t('rooms', 'JOIN TO PARTICIPATE', null, Yii::app()->controller->module->id);
                        else
                          echo Yii::t('rooms', 'LOGIN TO PARTICIPATE', null, Yii::app()->controller->module->id);
                  ?> 
                  </span>
                </blockquote>
              </div>
            <?php } ?>
            
            <?php if (Authorisation::canParticipate(Yii::app()->session['userId'],$room["parentType"],$room["parentId"])) { ?>
              <div id="infoPodOrga" class="col-md-8 col-sm-8 padding-10">
                <?php if (count(@$list) == 0) { ?>
                <blockquote class="padding-10"> 
                  <span class="text-extra-large text-green "><i class="fa fa-check"></i> Espace ouvert</span><br>
                  <small>Un espace d'action peut contenir plusieurs actions.</small>
                  <br>Référencez et partagez <b>une par une</b>,
                  <br>les tâches qui concernent cet espace
                  <br><br>
                  <button class="btn btn-success" onclick='elementLib.openForm("action","sub"); $(".datepicker").css("zIndex","12000");'>
                    <i class="fa fa-plus"></i> Ajouter une action
                  </button>
                </blockquote>
                <?php }; ?>
              </div>
            <?php } ?>        

        </div>

        <?php if ( count(@$list) > 0 ) { ?>
          <div class="col-md-12">      
            <div id="tags-container" class="col-md-12 margin-bottom-15">
              <?php echo $tagBlock?>
            </div>
          </div>
        <?php } ?>

        <div id="mixcontainer" class="mixcontainer col-md-12">
            <?php echo (count($list) > 0) ? $blocks : "" ?>
        </div>
      </div>

    </div> <!--home-->

  </section>



<?php  if( Authorisation::canParticipate(Yii::app()->session['userId'],$room["parentType"],$room["parentId"]) ) { ?>
<div class="modal fade" id="modal-create-action" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-dark">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-left">
          <i class="fa fa-angle-down"></i> <i class="fa fa-plus"></i> Ajouter une action
        </h2>
      </div>
      <div class="modal-body no-padding">
        <div class="panel-body" id="form-create-action">
          <?php 
              $params = array(
                  "room"=>$room,
                  "roomId" => (string)$room["_id"],
                  "mode"=>"new",
                  //"action"=>$room,
              );
              $params["organizer"] = array(  "name" => $parent["name"],
                                             "link" => Yii::app()->createUrl('/'.Yii::app()->controller->module->id."/".$room["parentType"]."/dashboard/id/".$room["parentId"]) );

            $this->renderPartial('../rooms/editAction', $params); 
          ?>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-success"
                 onclick="saveNewAction()">
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
    name : "<?php echo addslashes(@$room["name"]) ?>",
    id : "<?php echo (string)@$room["_id"] ?>",
    type : "action",
    controller : "room",
    otags : "<?php echo addslashes(@$room["name"]).",débat, proposition, question, vote, communecter,".addslashes(@implode(",", @$room["tags"])) ?>",
    odesc : <?php echo json_encode( 'Propositions : '.addslashes(@$room["name"])); ?>,
    parentType : "<?php echo @$room["parentType"] ?>",
    parentId : "<?php echo (string)@$room["parentId"] ?>"
  };  

var layout = 'grid', // Store the current layout as a variable
$container = $('#mixcontainer'), // Cache the MixItUp container
$changeLayout = $('#ChangeLayout'); // Cache the changeLayout button
clickedVoteObject = null;

var nbSurveyTotal = <?php echo count($list); ?>;

jQuery(document).ready(function() {
  
  setTitle("Actions Réactions","cogs text-red");
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

  if(!$(".myentries").length)
    $("#myentriesBtn").hide();
  if(!$(".todo").length)
    $("#todoBtn").hide();
  if(!$(".inprogress").length)
    $("#inprogressBtn").hide();
  if(!$(".late").length)
    $("#lateBtn").hide();
  if(!$(".closed").length)
    $("#closedBtn").hide();
  if(!$(".unassigned").length)
    $("#unassignedBtn").hide();

  $(".explainLink").click(function() {
    showDefinition( $(this).data("id") );
    return false;
  });

  
});


function toogleTags(){
  el = "#tags-container";
  if($(el).hasClass("hidden")){
    $(el).removeClass("hidden");
  }else{
    $(el).addClass("hidden");
  }
}

function reduceInfo(){
  el = ".actionDetail";
  all = el+",.byInfo"
  if($(el).hasClass("hidden")){
    $('#reduceInfo i').removeClass("fa-plus-square").addClass("fa-minus-square");
    $(all).removeClass("hidden");
    $('.mixcontainer .mix').css("height","250px");
  }else{
    $('#reduceInfo i').removeClass("fa-minus-square").addClass("fa-plus-square");
    $(all).addClass("hidden");
    $('.mixcontainer .mix').css("height","190px");
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

  function moderateEntry(id,action)
    {
      mylog.warn("--------------- moderateEntry ---------------------");

      params = { 
        "survey" : id , 
        "action" : action , 
        "app" : "<?php echo Yii::app()->controller->module->id?>"};

      ajaxPost("moderateEntryResult",
          '<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/survey/moderateentry")?>',
          params,function(){
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
             "value":"<?php echo ( @$room["status"] != ActionRoom::STATE_ARCHIVED ) ? ActionRoom::STATE_ARCHIVED : "" ?>",
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




