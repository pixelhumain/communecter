<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class SigController extends CommunecterController {

    protected function beforeAction($action) {
		  return parent::beforeAction($action);
  	}

  	public function actions()
  	{
      return array(
          'network'          	 => 'citizenToolKit.controllers.sig.NetworkAction',
          'companies'          => 'citizenToolKit.controllers.sig.CompaniesAction',
          'state'      		     => 'citizenToolKit.controllers.sig.StateAction',
          'events'      	     => 'citizenToolKit.controllers.sig.EventsAction',
          'getmyposition'      => 'citizenToolKit.controllers.sig.GetMyPositionAction',
          'getlatlngbyinsee'   => 'citizenToolKit.controllers.sig.GetLatLngByInseeAction',
          'getinseebylatlng'   => 'citizenToolKit.controllers.sig.GetInseeByLatLngAction',
          'getcodeinseebycityname' => 'citizenToolKit.controllers.sig.GetCodeInseeByCityNameAction',
          'getcountrybylatlng' => 'citizenToolKit.controllers.sig.GetCountryByLatLngAction',
          'showmynetwork'      => 'citizenToolKit.controllers.sig.ShowMyNetworkAction',
          'ShowNetworkMapping' => 'citizenToolKit.controllers.sig.ShowNetworkMappingAction',
          'ShowLocalCompanies' => 'citizenToolKit.controllers.sig.ShowLocalCompaniesAction',
          'ShowLocalState'     => 'citizenToolKit.controllers.sig.ShowLocalStateAction',
          'ShowLocalEvents'		 => 'citizenToolKit.controllers.sig.ShowLocalEventsAction',
          'initDatanetworkmapping' => 'citizenToolKit.controllers.sig.InitDataNetworkMappingAction',
          'updateentitygeoposition' => 'citizenToolKit.controllers.sig.UpdateEntityGeopositionAction',

      );
  	}
	
}
