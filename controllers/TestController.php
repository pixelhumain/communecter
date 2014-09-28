<?php
/**
 * ActionLocaleController.php
 *
 * tous ce que propose le PH en terme de projet
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class TestController extends CommunecterController {
    const moduleTitle = "Test";
    public function actionIndex() 
    {
    	$this->title = "TEst";
      $this->subTitle = " testing 1 2 3";
      $this->pageTitle = "Test";
    	
	    $this->render("index");
	}
   
}