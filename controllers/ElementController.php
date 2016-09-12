<?php
/**
 * ElementController.php
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class ElementController extends CommunecterController {
    const moduleTitle = "Évènement";
    
  protected function beforeAction($action) {
    parent::initPage();
    return parent::beforeAction($action);
  }
  public function actions()
  {
      return array(
          'updatefield' => 'citizenToolKit.controllers.element.UpdateFieldAction',
          'save'        => 'citizenToolKit.controllers.element.SaveAction'
      );
  }
}