<?php
/**
 * DiscuterController.php
 *
 * tous ce que propose le PH en terme d'action citoyenne
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class DiscuterController extends CommunecterController {
    const moduleTitle = "Discuter";
    
	public function actionIndex() {
	    $this->render("index");
	}
	
	/**
	 * MODULE DE BRAINSTORM
	 */
    public function actionBrainstorm($id) {
	    $this->render("brainstorm");
	}
    public function actionBrainstormForm() {
        /*
         * 
         */
	    $this->render("brainstormForm");
	}
    public function actionBrainstormSave() {
        /*
         * 
         */
	    $this->render("brainstormForm");
	}
    public function actionBrainstormIdeaAdd() {
        
	}
    public function actionBrainstormVote() {
        
	}
    /*public function actionBrainstorm($id) {
	    $this->render("brainstorm");
	}*/
}