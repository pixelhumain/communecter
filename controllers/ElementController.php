<?php
/**
 * ElementController.php
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class ElementController extends CommunecterController {
    const moduleTitle = "Element";
    
  protected function beforeAction($action) {
    parent::initPage();
    return parent::beforeAction($action);
  }
  public function actions()
  {
      return array(
          'updatefield' 				  => 'citizenToolKit.controllers.element.UpdateFieldAction',
          'updatefields' 				  => 'citizenToolKit.controllers.element.UpdateFieldsAction',
          'updateblock'          => 'citizenToolKit.controllers.element.UpdateBlockAction',
          'updatesettings'        => 'citizenToolKit.controllers.element.UpdateSettingsAction',
          'detail'                => 'citizenToolKit.controllers.element.DetailAction',
          'getalllinks'           => 'citizenToolKit.controllers.element.GetAllLinksAction',
          'directory'             => 'citizenToolKit.controllers.element.DirectoryAction',
          'addmembers'            => 'citizenToolKit.controllers.element.AddMembersAction',
          'aroundme'              => 'citizenToolKit.controllers.element.AroundMeAction',
          'updatefield'           => 'citizenToolKit.controllers.element.UpdateFieldAction',
          'save'                  => 'citizenToolKit.controllers.element.SaveAction',
          'savecontact'           => 'citizenToolKit.controllers.element.SaveContactAction',
          'saveurl'               => 'citizenToolKit.controllers.element.SaveUrlAction',
          'delete'                => 'citizenToolKit.controllers.element.DeleteAction',
          'get'                   => 'citizenToolKit.controllers.element.GetAction',
          'notifications'         => 'citizenToolKit.controllers.element.NotificationsAction',
          'getnotifications'      => 'citizenToolKit.controllers.element.GetNotificationsAction',
      );
  }
}