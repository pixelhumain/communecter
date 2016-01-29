<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class SearchController extends CommunecterController {

  protected function beforeAction($action) {
      return parent::beforeAction($action);
  }

  public function actions()
  {
      return array(
          'globalautocomplete'      	=> 'citizenToolKit.controllers.search.GlobalAutoCompleteAction',
          'searchmemberautocomplete'  => 'citizenToolKit.controllers.search.SearchMembersAutoCompleteAction',
          'getshortdetailsentity'     => 'citizenToolKit.controllers.search.GetShortDetailsEntityAction',
          'searchbycriteria'          => 'citizenToolKit.controllers.search.SearchByCriteriaAction',
          'index'                     => 'citizenToolKit.controllers.search.IndexAction',
          'agenda'                    => 'citizenToolKit.controllers.search.AgendaAction',
          'news'                      => 'citizenToolKit.controllers.search.NewsAction',
          'directory'                 => 'citizenToolKit.controllers.search.DirectoryAction',
          'login'                 => 'citizenToolKit.controllers.search.LoginAction',
          'home'                 => 'citizenToolKit.controllers.search.HomeAction',
          'add'                 => 'citizenToolKit.controllers.search.AddAction',
      );
  }
  
}