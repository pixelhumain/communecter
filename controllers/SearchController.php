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
          'getmemberautocomplete'      => 'citizenToolKit.controllers.search.GetMemberAutocompleteAction'
      );
  }
  
}