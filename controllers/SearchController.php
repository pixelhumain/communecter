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
          'globalautocompleteold'      	=> 'citizenToolKit.controllers.search.GlobalAutoCompleteOldAction',
          'globalautocomplete'        => 'citizenToolKit.controllers.search.GlobalAutoCompleteAction',
          'simplyautocomplete'        => 'citizenToolKit.controllers.search.SimplyAutoCompleteAction',
          'searchmemberautocomplete'  => 'citizenToolKit.controllers.search.SearchMembersAutoCompleteAction',
          'getshortdetailsentity'     => 'citizenToolKit.controllers.search.GetShortDetailsEntityAction',
          'searchbycriteria'          => 'citizenToolKit.controllers.search.SearchByCriteriaAction',
          'index'                     => 'citizenToolKit.controllers.search.IndexAction',
          'mainmap'                   => 'citizenToolKit.controllers.search.MainMapAction',
      );
  }
}