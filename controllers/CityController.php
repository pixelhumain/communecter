<?php
/**
 * SiteController.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:25 AM
 */
class CityController extends CommunecterController {
  

	protected function beforeAction($action) {
	    parent::initPage();
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'index'       			=> 'citizenToolKit.controllers.city.IndexAction',
	        'detail'                => 'citizenToolKit.controllers.city.DetailAction',
	        'directory'    		 	=> 'citizenToolKit.controllers.city.DirectoryAction',
	        'calendar'      		=> 'citizenToolKit.controllers.city.CalendarAction',
	        'statisticpopulation' 	=> 'citizenToolKit.controllers.city.StatisticPopulationAction',
	        'getcitydata'     		=> 'citizenToolKit.controllers.city.GetCityDataAction',
	        'getcityjsondata'     	=> 'citizenToolKit.controllers.city.GetCityJsonDataAction',
	        'getcitiesdata'     	=> 'citizenToolKit.controllers.city.GetCitiesDataAction',
	        'statisticcity'			=> 'citizenToolKit.controllers.city.statisticCityAction',
	        'opendata'				=> 'citizenToolKit.controllers.city.OpenDataAction',
	        'getoptiondata'			=> 'citizenToolKit.controllers.city.GetOptionDataAction',
	        'getlistoption'			=> 'citizenToolKit.controllers.city.GetListOptionAction',
	        'getpodopendata'		=> 'citizenToolKit.controllers.city.GetPodOpenDataAction',
	        'addpodopendata'		=> 'citizenToolKit.controllers.city.AddPodOpenDataAction',
	        'getlistcities'			=> 'citizenToolKit.controllers.city.GetListCitiesAction',
	        'creategraph'			=> 'citizenToolKit.controllers.city.CreateGraphAction',
	        'graphcity'				=> 'citizenToolKit.controllers.city.GraphCityAction',
	        'updatecitiesgeoformat' => 'citizenToolKit.controllers.city.UpdateCitiesGeoFormatAction',
	        'getinfoadressbyinsee'  => 'citizenToolKit.controllers.city.GetInfoAdressByInseeAction',

	    );
	}
}