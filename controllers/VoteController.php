<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class VoteController extends CommunecterController {

    protected function beforeAction($action)
  	{
      parent::initPage();
		  return parent::beforeAction($action);
  	}

    public function actions()
  {
      return array(
          'savesession'  => 'citizenToolKit.controllers.survey.SaveSessionAction',
          'moderate'     => 'citizenToolKit.controllers.survey.ModerateAction',
          'delete'       => 'citizenToolKit.controllers.survey.DeleteAction',
      );
  }
  /**
   * List all the latest observations
   * @return [json Map] list
   */
	public function actionIndex() 
	{
    $where = array("type"=>SurveyType::TYPE_SURVEY);

    //check if information is Postal Code restricted 
    if(isset($_GET["cp"]))
      $where["cp"] = $_GET["cp"];
    $list = PHDB::find(PHType::TYPE_SURVEYS, $where );
    $user = ( isset( Yii::app()->session["userId"])) ? PHDB::findOne (PHType::TYPE_CITOYEN, array("_id"=>new MongoId ( Yii::app()->session["userId"] ) ) ) : null;
    $uniqueVoters = PHDB::count( PHType::TYPE_CITOYEN, array("applications.survey"=>array('$exists'=>true)) );

    $this->title = "Tous les sondages";
    $this->subTitle = "Nombres de votants inscrit : ".$uniqueVoters;
    $this->pageTitle = "Communecter - Sondages";

	  $this->render( "index", array( "list" => $list,
                                  "where"=>$where,
                                  "user"=>$user,
                                  "uniqueVoters"=>$uniqueVoters )  );
	}

  public function actionEntries($surveyId) 
  {
    $where = array( "type"=>SurveyType::TYPE_ENTRY, "survey"=>$surveyId );

    //check if is moderated in which the proper filter will be added to the where clause
    $moduleId = "pppm";//$this->moduleId
    $app = PHDB::findOne (PHType::TYPE_APPLICATIONS, array("key" => $moduleId  ) );
    $isModerator = Survey::isModerator(Yii::app()->session["userId"], $moduleId);

    if(!$isModerator && isset($app["moderation"]))
      $where['applications.'.$moduleId.'.'.SurveyType::STATUS_CLEARED] = array('$exists'=>false);

    $list = PHDB::find(PHType::TYPE_SURVEYS, $where );
    $survey = PHDB::findOne (PHType::TYPE_SURVEYS, array("_id"=>new MongoId ( $surveyId ) ) );
    $where["survey"] = $survey;

    $user = ( isset( Yii::app()->session["userId"])) ? PHDB::findOne (PHType::TYPE_CITOYEN, array("_id"=>new MongoId ( Yii::app()->session["userId"] ) ) ) : null;

    $uniqueVoters = PHDB::count( PHType::TYPE_CITOYEN, array("applications.survey"=>array('$exists'=>true)) );

    $this->title = "Sondages : ".$survey["name"] ;
    $this->subTitle = "Nombres de votants inscrit : ".$uniqueVoters;
    $this->pageTitle = "Communecter - Sondages";
    $this->toolbarMBZ = array(
      '<a href="#" class="newVoteProposal" title="proposer une loi" ><i class="fa fa-paper-plane"></i> PROPOSER</a>',
      '<a href="#voterloiDescForm" role="button" data-toggle="modal" title="lexique pour compendre" ><i class="fa fa-question-circle"></i> AIDE</a>');

    $this->render( "index", array( "list" => $list,
                                     "where"=>$where,
                                     "user"=>$user,
                                     "isModerator"=>$isModerator,
                                     "uniqueVoters"=>$uniqueVoters )  );
  }

  public function actionEntry($surveyId) 
  {
    $where = array("survey"=>$surveyId);
    $survey = PHDB::findOne (PHType::TYPE_SURVEYS, array("_id"=>new MongoId ( $surveyId ) ) );
    $where["survey"] = $survey;
    
    $this->title = "Sondages : ".$survey["name"];
    $this->subTitle = "Décision démocratiquement simple";
    $this->pageTitle = "Communecter - Sondages";

    Rest::json( array( 
      "title" => $survey["name"] ,
      "content" => $this->renderPartial( "entry", array("survey"=>$survey), true),
      "contentBrut" => $survey["message"] ) 
    );
  }

  public function actionGraph($surveyId) 
  {
    $where = array("survey"=>$surveyId);
    $survey = PHDB::findOne (PHType::TYPE_SURVEYS, array("_id"=>new MongoId ( $surveyId ) ) );
    $where["survey"] = $survey;
    $voteDownCount = (isset($survey[ActionType::ACTION_VOTE_DOWN."Count"])) ? $survey[ActionType::ACTION_VOTE_DOWN."Count"] : 0;
    $voteAbstainCount = (isset($survey[ActionType::ACTION_VOTE_ABSTAIN."Count"])) ? $survey[ActionType::ACTION_VOTE_ABSTAIN."Count"] : 0;
    $voteUnclearCount = (isset($survey[ActionType::ACTION_VOTE_UNCLEAR."Count"])) ? $survey[ActionType::ACTION_VOTE_UNCLEAR."Count"] : 0;
    $voteMoreInfoCount = (isset($survey[ActionType::ACTION_VOTE_MOREINFO."Count"])) ? $survey[ActionType::ACTION_VOTE_MOREINFO."Count"] : 0;
    $voteUpCount = (isset($survey[ActionType::ACTION_VOTE_UP."Count"])) ? $survey[ActionType::ACTION_VOTE_UP."Count"] : 0;
    $totalVotes = $voteDownCount+$voteAbstainCount+$voteUpCount+$voteUnclearCount+$voteMoreInfoCount;
    $oneVote = ($totalVotes!=0) ? 100/$totalVotes:1;
    $voteDownCount = $voteDownCount * $oneVote ;
    $voteAbstainCount = $voteAbstainCount * $oneVote;
    $voteUpCount = $voteUpCount * $oneVote;
    $voteUnclearCount = $voteUnclearCount * $oneVote;
    $voteMoreInfoCount = $voteMoreInfoCount * $oneVote;

    Rest::json( array( "title" => "Repartition de  votes : ".$survey["name"] ,
                       "content" => $this->renderPartial( "graph", array( "name" => $survey["name"],
                                                                          "voteDownCount" => $voteDownCount,
                                                                          "voteAbstainCount" => $voteAbstainCount,
                                                                          "voteUpCount" => $voteUpCount,
                                                                          "voteUnclearCount" => $voteUnclearCount,
                                                                          "voteMoreInfoCount" => $voteMoreInfoCount,
                                                                          ), 
                                                          true)));
  }
  public function actionTextarea() 
  {
    Yii::app()->theme  = "empty";
    $this->render( "textarea" );
  }
  public function actionEditList() 
  {
    Yii::app()->theme  = "empty";
    $this->render( "editList" );
  }
  public function actionMultiAdd() 
  {
    Yii::app()->theme  = "empty";
    $this->render( "multiadd" );
  }
}