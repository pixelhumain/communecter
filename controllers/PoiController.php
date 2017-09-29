<?php
/**
 * 
 *
 * @author: Raphael RIVIERE
 * Date:
 */
class PoiController extends CommunecterController {

  protected function beforeAction($action)
  {
  parent::initPage();
  return parent::beforeAction($action);
  }

  public function actions()
  {
    return array(
    // captcha action renders the CAPTCHA image displayed on the contact page
    'addlink'           => 'citizenToolKit.controllers.poi.AddLinkAction',
    "deletelink"      => 'citizenToolKit.controllers.poi.DeleteLinkAction',
    );
  } 
}