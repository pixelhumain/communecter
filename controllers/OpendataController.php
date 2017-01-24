<?php
/**
 * OpenDataController.php
 *
 * @author: sylvain.barbot@gmail.com
 * Date: 10/05/15
 * Time: 12:25 AM
 */
class OpendataController extends CommunecterController {
  
	public function actions() {
	    return array(
			'getcitiesbypostalcode'			=> 'citizenToolKit.controllers.opendata.GetCitiesByPostalCodeAction',
			'getcitiesgeoposbypostalcode'	=> 'citizenToolKit.controllers.opendata.GetCitiesGeoPosByPostalCodeAction',
			'getcountries'					=> 'citizenToolKit.controllers.opendata.GetCountriesAction'
	    );
	}

}