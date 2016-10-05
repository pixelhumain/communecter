<?php
/**
 * ActionController.php
 *
 * @author: Sylvain Barbot <sylvain.barbot@gmail.com>
 * Date: 7/29/15
 * Time: 12:25 AM
 */
class MailmanagementController extends CommunecterController {
  

	protected function beforeAction($action) {
	    //Check hook come from mailgun
	    $mailgunCheck = true;
	    if (! $mailgunCheck) {
	    	//TODO SBAR : add notification for SuperAdmin

	    	throw new CommunecterException("It seems that the hook has been launch by someone else than mailgun");
	    }
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'droppedmail'    => 'citizenToolKit.controllers.mailmanagement.DroppedMailAction'
	    );
	}
}