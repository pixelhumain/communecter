<?php

class DataListController extends CommunecterController {

	protected function beforeAction($action) {
		parent::initPage();
		return parent::beforeAction($action);
	}

	public function actions() {
	    return array(
			'getlistbyname'			=> 'citizenToolKit.controllers.datalist.GetListByNameAction'
	    );
	}
}