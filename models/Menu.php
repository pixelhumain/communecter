<?php
class Menu {

    function __construct() {
        $cs = Yii::app()->getClientScript();
        //$cs->registerScriptFile($moduleAssetsUrl.'/js/communecter.js');
    }

    public static $infoMenu = array();

	public static $sectionMenu = array();
    
    public static function person($person)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();

		if(@$person["id"])
	        $id = $person["id"];
	    else
	    	$id = (string)$person["_id"];
        
        //HOME
        //-----------------------------
        self::entry("left", 'onclick', 
                    Yii::t("common", 'General informations'), 
                    Yii::t("common", 'Details'),
                    'user',
                    "loadByHash('#person.detail.id.".$id."')","person", "detail");
        //SEE TIMELINE
        //-----------------------------
        self::entry("left", 'onclick', 
                Yii::t( "common", 'Read all news publicated by this person'), 
                Yii::t( "common", 'Newspaper'), 
                'rss',
                "loadByHash('#news.index.type.".Person::COLLECTION.".id.".$id.".viewer.".Yii::app()->session["userId"]."')","news", "index");
        
        //DIRECTORY
        //-----------------------------
        self::entry("left", 'onclick', 
                    Yii::t("common", 'Show his directory'), 
                    Yii::t("common", 'Directory'),
                    'bookmark fa-rotate-270',
                    "loadByHash('#person.directory.id.".$id."?tpl=directory2')","person", "directory");
		//ALBUM
        //-----------------------------
        self::entry("left", 'onclick', 
                    Yii::t("common", 'See the photo gallery'), 
                    Yii::t("common", 'Album'),
                    'photo',
                    "loadByHash('#gallery.index.id.".$id.".type.".Person::COLLECTION."')","gallery", "index");

        
        //FOLLOW BUTTON
        //-----------------------------
        /*******
	    * Method for knows à approfondir and connect to method connect
	    * Link::isConnected( Yii::app()->session['userId'] , Person::COLLECTION , (string)$person["_id"] , Person::COLLECTION )
	    *********/
        if(@$person["_id"] && @Yii::app()->session["userId"] && $person["_id"] != Yii::app()->session["userId"]){
	        if (isset($person["links"]["followers"][Yii::app()->session["userId"]])){
            //Link button
            self::entry("right", 'onclick',
                        Yii::t( "common", "Unfollow this person"),
                        Yii::t( "common", "Unfollow"),
                        'fa fa-unlink disconnectBtnIcon',
                        "disconnectTo('".Person::COLLECTION."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."','followers')",null,null,"text-red"); 
            }else{
            	 self::entry("right", 'onclick',
                        Yii::t( "common", "Follow this person"),
                        Yii::t( "common", "Follow"),
                        'fa fa-link followBtn',
                        "follow('".Person::COLLECTION."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."')",null,null);
            }
        }
    }
    public static function need($need,$parentType,$parentId){
	    if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();

	    if($parentType==Organization::COLLECTION)
		    $controller = Organization::CONTROLLER;
		else
	    	$controller = Project::CONTROLLER;
	    self::entry("left", 'onclick',
        			Yii::t("common", $controller." detail"),
        			Yii::t("common","Back to ".$controller),'home',
        			"loadByHash('#".$controller.".detail.id.".$parentId."')",$controller, "detail");
    }
	public static function event($event , $hasSubEvents = false)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();

		if(@$event["id"])
			$id = $event["id"];
		else
        	$id = (string)$event["_id"];
        
        //HOME
        //-----------------------------
         self::entry("left", 'onclick', 
                    Yii::t("common", 'General informations'), 
                    Yii::t("common", 'Details'),
                    'home',
                    "loadByHash('#event.detail.id.".$id."')","event", "detail");

        //SEE TIMELINE
        //-----------------------------
        self::entry("left", 'onclick', 
                Yii::t( "common", 'Read all news publicated by this event'), 
                Yii::t( "common", 'Newspaper'), 
                'rss',
                "loadByHash('#news.index.type.".Event::COLLECTION.".id.".$id."')","news", "index");
		
        if( $hasSubEvents )
        {
            //DIRECTORY
            //-----------------------------
          /* self::entry("left", 'onclick', 
                        Yii::t("event", 'View this event as a directory', null, Yii::app()->controller->module->id), 
                        Yii::t("event", 'Visualise', null, Yii::app()->controller->module->id),
                        'connectdevelop',
                        "loadByHash('#event.directory.id.".$id."?tpl=directory2')","event", "directory");*/

            self::entry("left", 'onclick', 
                        Yii::t("event", 'View this event calendar', null, Yii::app()->controller->module->id), 
                        Yii::t("event", 'Calendar', null, Yii::app()->controller->module->id),
                        'calendar',
                        "loadByHash('#event.calendarview.id.".$id."')","event", "calendar");
        }

		//ALBUM
        //-----------------------------
        self::entry("left", 'onclick', 
                    Yii::t("common", 'See the photo gallery'), 
                    Yii::t("common", 'Album'),
                    'photo',
                    "loadByHash('#gallery.index.id.".$id.".type.".Event::COLLECTION."')","gallery", "index");
        
        if(@Yii::app()->session["userId"]){
            if( @$id && Link::isLinked($id , Event::COLLECTION , Yii::app()->session['userId']) ){
    	        self::entry("right", 'onclick',
                            Yii::t( "common", "Leave this event"),
                            Yii::t( "common", "Leave"), 
                            'fa fa-unlink disconnectBtnIcon',
                            "disconnectTo('".Event::COLLECTION."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."','attendees')",null,null,"text-red");
    		}else{
	    		 self::entry("right", 'onclick',
                        Yii::t( "common", "Participate to this event"),
                        Yii::t( "common", "Participate"),
                        'fa fa-link connectBtn',
                        "connectTo('".Event::COLLECTION."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."','attendee','".addslashes($event["name"])."')",null,null); 
    		}
        }
    }

    public static function moderate()
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        
        //Moderate One
        //-----------------------------
        self::entry("left", 'showAjaxPanel', 
                Yii::t("common","Modérer un abus"),
                Yii::t("common","Modérer un abus"),
                'file-o','/admin/moderate/one/',"Moderate","one");
        
        //Moderate All
        //-----------------------------
         self::entry("left", 'showAjaxPanel', 
                Yii::t("common","Tous les abus"),
                Yii::t("common","Tous les abus"),
                'copy','/admin/moderate/all/',"Moderate","all");

    }

    public static function statistics()
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        
        //Global
        //-----------------------------
        self::entry("left", 'showAjaxPanel', 
                Yii::t("common","Statistics global"),
                Yii::t("common","Statistics global"),
                'file-o','/stat/chartglobal/',"statistics","global");
        
        //Logs
        //-----------------------------
        self::entry("left", 'showAjaxPanel', 
            Yii::t("common","Statistics logs"),
            Yii::t("common","Statistics logs"),
    'file-o','/stat/chartLogs/',"statistics","logs");

    }

    
    
    public static function organization($organization)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();

		if(@$organization["id"])
			$id = $organization["id"];
		else
        	$id = (string)$organization["_id"];
        
        //HOME
        //-----------------------------
        self::entry("left", 'onclick',
        			Yii::t("organization","Contact information"), 
        			Yii::t("common","Details"),'home',
        			"loadByHash('#organization.detail.id.".$id."')","organization", "detail");
//        			'/organization/detail/id/'.$id,"organization","detail");
       
        //SEE TIMELINE
        //-----------------------------
        self::entry("left", 'onclick', 
                Yii::t( "common", 'Read all news publicated by this organization'), 
                Yii::t( "common", 'Newspaper'), 
                'rss',
                "loadByHash('#news.index.type.".Organization::COLLECTION.".id.".$id."')","news", "index");

         
        $surveyLink = "#rooms";
        $surveyLink = "#rooms.index.type.organizations.id.".$id; 
		
		//COMMUNITY
		//---------------------------
		self::entry("left", 'onclick',
        			Yii::t("common","Organization community"),
        			Yii::t("common","Community") ,
        			'connectdevelop hide',
        			"loadByHash('#organization.directory.id.".$id."?tpl=directory2')","organization", "directory");
               
        //ALBUM
        //-----------------------------
       self::entry("left", 'onclick', 
                    Yii::t("common", 'See the photo gallery'), 
                    Yii::t("common", 'Album'),
                    'photo',
                    "loadByHash('#gallery.index.id.".$id.".type.".Organization::COLLECTION."')","gallery", "index");

        // ADD MEMBER
        //-----------------------------
        if( Authorisation::isOrganizationAdmin(Yii::app()->session['userId'],$id) ){
	        self::entry("right", 'onclick',
            			Yii::t('common','Add a member to this organization'), 
            			Yii::t("common",'Add member'),'plus',
            			"loadByHash('#organization.addmember.id.".$id."')",null,null);
        }

               
        //FOLLOW BUTTON
        //-----------------------------
        /*
	    *   If disabled there are no interactive buttons
	    *	If not connected, hide admin btn and link join btn to login form
        */
        if( !@$organization["disabled"]){
            //Link button 
            if(@$id && @Yii::app()->session["userId"] && 
                Link::isLinked($id, Organization::COLLECTION, Yii::app()->session["userId"])){
	            
	            self::entry("right", 'onclick',
                        Yii::t( "common", "Leave this organization"),
                        Yii::t( "common", "Leave"),
                        'fa fa-unlink disconnectBtnIcon',
                        "disconnectTo('".Organization::COLLECTION."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."','members')",
                        null,
                        null,
                        "text-red"); 
                        
            } else if (@$id && @Yii::app()->session["userId"] && 
                @$organization["links"]["followers"][Yii::app()->session["userId"]]){
	            self::entry("right", 'onclick',
                        Yii::t( "common", "Unfollow this organization"),
                        Yii::t( "common", "Unfollow"),
                        'fa fa-unlink disconnectBtnIcon',
                        "disconnectTo('".Organization::COLLECTION."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."','followers')",
                        null,
                        null,
                        "text-red"); 
	        }
            //Ask Admin button
            if (! Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $id) && @Yii::app()->session["userId"] /*|| $organization["preferences"]["isOpenEdition"]==true*/) {
	            $connectAs="admin";
	            if(!@$organization["links"]["members"][Yii::app()->session["userId"]]){
		            $connectAs="member";
		            if (!@$organization["links"]["followers"][Yii::app()->session["userId"]]){
			            self::entry("right", 'onclick',
	                        Yii::t( "common", "Follow this organization"),
	                        Yii::t( "common", "Follow"),
	                        'fa fa-link followBtn',
	                        "follow('".Organization::COLLECTION."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."')",null,null);
                       }
	            }

                //Test if user has already asked to become an admin
                if(!in_array(Yii::app()->session["userId"], Authorisation::listAdmins($id, Organization::COLLECTION,true))){
                    self::entry("right", 'onclick',
                            Yii::t( "common", "Declare me as ".$connectAs." of this organization"),
                            Yii::t( "common", "Become ".$connectAs),
                            'fa fa-user-plus becomeAdminBtn',
                            "connectTo('".Organization::COLLECTION."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."','".$connectAs."','".addslashes($organization["name"])."')",null,null);
                }  
			}
        } 
    }
 public static function element($element,$type)
    {
        
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();

        $id = (string)$element["_id"];
		if( isset($type) && $type == Organization::COLLECTION && isset($element) ){
			$controllerType = Organization::CONTROLLER;
			$strongLinks = "members";
		}
		else if( isset($type) && $type == Project::COLLECTION && isset($element) ){
			$controllerType=Project::CONTROLLER;
			$strongLinks = "contributors";
		}
		else if( isset($type) && $type == Event::COLLECTION && isset($element) ){
			$controllerType=Event::CONTROLLER;
			$strongLinks = "attendees";
		}else if((isset($type) && $type == Person::COLLECTION) || (isset($element))){
            $controllerType=Person::CONTROLLER;
            $strongLinks = "members";
        }

        $controller = "element";

        //HOME
        //-----------------------------
        self::entry("left", 'onclick',
        			Yii::t($controllerType,"Contact information"), 
        			Yii::t("common","Details"),'home',
        			"showElementPad('detail')", $controller, "detail", "btn-menu-element btn-menu-element-detail");
       
        //SEE TIMELINE
        //-----------------------------
        self::entry("left", 'onclick', 
                Yii::t( "common", 'Read all news publicated by this '.$controllerType), 
                Yii::t( "common", 'News Stream'), 
                'rss',
                "showElementPad('news')","news", "index", "btn-menu-element btn-menu-element-news");

         
        
        //DIRECTORY
        //-----------------------------
        
        if(($type != Person::COLLECTION || Preference::showPreference($element, $type, "directory", Yii::app()->session["userId"])) //&& $type != Event::COLLECTION 
            ) {
            self::entry("left", 'onclick',
                    Yii::t("common","Community of ".$controllerType),
                    Yii::t("common","Community") ,
                    'connectdevelop',
                    "showElementPad('directory')", $controller, "directory","communityBtn btn-menu-element btn-menu-element-directory");
        }
        if( $type == Event::COLLECTION && @$element["links"] && @$element["links"]["subEvents"])
        {
            //DIRECTORY
            //-----------------------------
          /* self::entry("left", 'onclick', 
                        Yii::t("event", 'View this event as a directory', null, Yii::app()->controller->module->id), 
                        Yii::t("event", 'Visualise', null, Yii::app()->controller->module->id),
                        'connectdevelop',
                        "loadByHash('#event.directory.id.".$id."?tpl=directory2')","event", "directory");*/

            self::entry("left", 'onclick', 
                        Yii::t("event", 'View this event calendar', null, Yii::app()->controller->module->id), 
                        Yii::t("event", 'Calendar', null, Yii::app()->controller->module->id),
                        'calendar',
                        "showElementPad('calendarview')","event", "calendar","btn-menu-element btn-menu-element-calendar");
        }

       //ALBUM
        //-----------------------------
        self::entry("left", 'onclick', 
                    Yii::t("common", 'See the photo gallery'), 
                    Yii::t("common", 'Album'),
                    'photo',
                    "showElementPad('gallery')","gallery", "index", "btn-menu-element btn-menu-element-gallery");

        //ACTION ROOMS
        //-----------------------------
        /*$onclick = "showAjaxPanel( '/rooms/index/type/".Organization::COLLECTION."/id/".$id."', 'ORGANIZATION ACTION ROOM ','legal' )"; 
        $active = (Yii::app()->controller->id == "rooms" && Yii::app()->controller->action->id == "index" ) ? "active" : ""; 
        array_push( Yii::app()->controller->toolbarMBZ, array('tooltip' => "SURVEYS : Organization Action Room",
                                                              "iconClass"=>"fa fa-legal",
                                                              "href"=>"<a class='tooltips ".$active." btn btn-default' href='javascript:;' onclick=\"".$onclick."\"") );
        */
        // ADD MEMBER
        //-----------------------------

        if($type != Person::COLLECTION && Authorisation::canEditItem(Yii::app()->session['userId'], $type, $id)){
	        /*self::entry("right", 'onclick',
                Yii::t('common','Add '.$strongLinks.' to this '.$controllerType.''), 
                Yii::t("common",'Add '.$strongLinks),'fa fa-user-plus',
                "showElementPad('addmembers')",null,null,"btn-menu-element btn-menu-element-addmembers","data-toggle='modal' data-target='#modal-scope'");*/

				self::entry("right", 'href',
                Yii::t('common','Add '.$strongLinks.' to this '.$controllerType.''), 
                Yii::t("common",'Add '.$strongLinks),'fa fa-user-plus',
                "javascript:;",null,null,"btn-menu-element btn-menu-element-addmembers","","data-toggle='modal' data-target='#modal-scope'");
        }
        

        //SEND MESSAGE
        //-----------------------------
		//   if( Authorisation::isOrganizationMember(Yii::app()->session['userId'],$id) ){
            /*self::entry("right", 'onclick',
                        Yii::t( "common", "Send a message to this Organization"), 
                        Yii::t( "common", "Contact"),
                        'envelope-o',
                        "loadByHash( '#news.index.type.organizations.id.".$id."')",null,null);*/
		// }
        
        //FOLLOW BUTTON
        //-----------------------------
        /*
	    *   If disabled there are no interactive buttons
	    *	If not connected, hide admin btn and link join btn to login form
        */
        if( !isset( $element["disabled"] ) ){
            //Link button 
            if($type != Person::COLLECTION && isset($element["_id"]) && isset(Yii::app()->session["userId"]) && 
                Link::isLinked((string)$element["_id"], $type, Yii::app()->session["userId"])){
	            
	            self::entry("right", 'onclick',
                        Yii::t( "common", "Leave this ".$controllerType),
                        Yii::t( "common", "Leave"),
                        'fa fa-unlink disconnectBtnIcon',
                        "disconnectTo('".$type."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."','".$strongLinks."')",null,null,"text-red"); 
            } else if (isset($element["_id"]) && isset(Yii::app()->session["userId"]) && 
                isset($element["links"]["followers"][Yii::app()->session["userId"]])){
	            self::entry("right", 'onclick',
                        Yii::t( "common", "Unfollow this ".$controllerType),
                        Yii::t( "common", "Unfollow"),
                        'fa fa-unlink disconnectBtnIcon',
                        "disconnectTo('".$type."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."','followers')",null,null,"text-red"); 
            } else if(@$element["_id"] 
                        && @Yii::app()->session["userId"] 
                        && !@$element["links"]["followers"][Yii::app()->session["userId"]] 
                        && $type != Event::COLLECTION 
                        && @$element["_id"] != @Yii::app()->session["userId"]){
	                self::entry("right", 'onclick',
	                        Yii::t( "common", "Follow this ".$controllerType),
	                        Yii::t( "common", "Follow"),
	                        'fa fa-link followBtn',
	                        "follow('".$type."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."')",null,null);
            }

            // Add member , contributor, attendee
            if($type == Organization::COLLECTION)
               $connectAs="member";
            else if($type == Project::COLLECTION)
                $connectAs="contributor";
            else if($type == Event::COLLECTION)
                $connectAs="attendee";
           
            if( @Yii::app()->session["userId"] && @$connectAs && !@$element["links"][$connectAs."s"][Yii::app()->session["userId"]]){
                self::entry("right", 'onclick',
                                Yii::t( "common", "Declare me as ".$connectAs." of this ".$controllerType),
                                Yii::t( "common", "Become ".$connectAs),
                                'fa fa-user-plus becomeAdminBtn',
                                "connectTo('".$type."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."', '".$connectAs."','".addslashes($element["name"])."')",null,null);
            }else{
                //Ask Admin button
                if (    $type != Person::COLLECTION 
                    && !in_array(Yii::app()->session["userId"], Authorisation::listAdmins($id, $type,true)) 
                    && @Yii::app()->session["userId"]) {
                    $connectAs="admin";
                    //Test if user has already asked to become an admin
                    if(!in_array(Yii::app()->session["userId"], Authorisation::listAdmins($id, $type,true))){
                        self::entry("right", 'onclick',
                                Yii::t( "common", "Declare me as ".$connectAs." of this ".$controllerType),
                                Yii::t( "common", "Become ".$connectAs),
                                'fa fa-user-plus becomeAdminBtn',
                                "connectTo('".$type."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."','".$connectAs."','".addslashes($element["name"])."')",null,null);
                    }             
                }
             }
        } 
    }

    public static function city($city, $cityGlobal = false)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        //$mbz = array("<li id='linkBtns'><a href='javascript:;' class='tooltips ' data-placement='top' data-original-title='This Organization is disabled' ><i class='text-red fa fa-times '></i>DISABLED</a></li>");
        $insee = (string)$city["insee"];
        $paramsUrl = ".insee.".$insee ;
        if($cityGlobal == false){
            $cp = (string)$city["cp"];
            $paramsUrl .= ".postalCode.".$cp ;
        }
            


        
        
        //HOME
        //-----------------------------
        self::entry("left", 'onclick', 
        			Yii::t( "common", 'City Home page'),
					Yii::t( "common", 'Details'), 'university',
					"loadByHash('#city.detail".$paramsUrl."')",null,null);
        
        //SEND MESSAGE
        //-----------------------------
        /*array_push( Yii::app()->controller->toolbarMBZ , array('tooltip' => "Send a message to this City",
                                                                "iconClass"=>"fa fa-envelope-o",
                                                                "href"=>"<a href='javascript:;' class='new-news tooltips btn btn-default' data-id='".$insee."' data-type='".City::COLLECTION."' data-name='".$city['name']."'") );
        */
        
        //SEE TIMELINE
        //-----------------------------
        /*$onclick = "showAjaxPanel( '/news/index/type/".City::COLLECTION."/id/".$insee."', 'CITY ACTIVITY ','rss' )";
        $active = (Yii::app()->controller->id == "news" && Yii::app()->controller->action->id == "index" ) ? "active" : "";
        array_push( Yii::app()->controller->toolbarMBZ, array('tooltip' => "TIMELINE : City Activity",
                                                              "iconClass"=>"fa fa-rss",
                                                              "href"=>"<a  class='tooltips ".$active." btn btn-default' href='javascript:;' onclick=\"".$onclick."\"") );*/
        
        //ACTION ROOMS
        //-----------------------------
        /*$onclick = "showAjaxPanel( '/rooms/index/type/".Organization::COLLECTION."/id/".$id."', 'ORGANIZATION ACTION ROOM ','legal' )"; 
        $active = (Yii::app()->controller->id == "rooms" && Yii::app()->controller->action->id == "index" ) ? "active" : ""; 
        array_push( Yii::app()->controller->toolbarMBZ, array('tooltip' => "SURVEYS : Organization Action Room",
                                                              "iconClass"=>"fa fa-legal",
                                                              "href"=>"<a class='tooltips ".$active." btn btn-default' href='javascript:;' onclick=\"".$onclick."\"") );
        */
        //DIRECTORY
        //-----------------------------


        self::entry("left", 'onclick',
        			Yii::t( "common", 'Local network'), 
        			Yii::t( "common", 'Directory'),'bookmark fa-rotate-270',
        			"loadByHash('#city.directory".$paramsUrl.".tpl.directory2')",null,null);

        //STATISTICS
        //-----------------------------
        /*self::entry("left", 'onclick',
        			Yii::t( "common", 'Show some statistics about this city'),
        			Yii::t( "common", 'Statistics'), 'line-chart',
        			"loadByHash('#city.opendata.insee.".$insee."')",null,null);
//        			'/city/opendata/insee/'.$insee.'?isNotSV=1',"city","opendata");*/

    }

    public static function news($type=null)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();    
        self::entry("right", 'onclick', 
              Yii::t( "common", 'Understanding newspaper and news stream'),
            '', 'question-circle',
             "loadByHash('#default.view.page.modules.dir.docs?slide=news')",null,null);

    }

    public static function project($project)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        
        if(@$project["id"])
        	$id = $project["id"];
        else
        	$id = (string)$project["_id"];

        //HOME
        //-----------------------------
        self::entry("left", 'onclick',
        			Yii::t( "common", 'General information about this project'),
        			Yii::t( "common", 'Details'), 'home',
        			"loadByHash( '#project.detail.id.".$id."')","project", "detail");

        //SEE TIMELINE
        //-----------------------------
        self::entry("left",  'onclick',
        			Yii::t( "common", "Read all news publicated by this project"),
        			Yii::t( "common", 'Newspaper'), "rss",
        			"loadByHash('#news.index.type.".Project::COLLECTION.".id.".$id."')","news", "index");

        //DIRECTORY
        //-----------------------------
        self::entry("left", 'onclick',
        Yii::t( "common", "Project community"), 
        Yii::t( "common", 'Community'), 'connectdevelop',
        "loadByHash('#project.directory.id.".$id."?tpl=directory2')","project", "directory");


        $surveyLink = "#rooms";
        $surveyLink = "#rooms.index.type.projects.id.".$id; 
        
        //ALBUM
        //-----------------------------
        self::entry("left", 'onclick', 
                    Yii::t("common", 'See the photo gallery'), 
                    Yii::t("common", 'Album'),
                    'photo',
                    "loadByHash('#gallery.index.id.".$id.".type.".Project::COLLECTION."')","gallery", "index");
        
        // ADD MEMBER
        //-----------------------------
        if( Authorisation::isProjectAdmin($id,Yii::app()->session['userId']) ){
            self::entry("right", 'onclick',
            			Yii::t('common','Add a contributor to this project'), 
            			Yii::t("common",'Add contributor'),'plus',
            			"loadByHash('#project.addcontributorsv.projectId.".$id."')",null,null);
        }
		if(@$id && @Yii::app()->session["userId"] && 
                Link::isLinked($id, Project::COLLECTION, Yii::app()->session["userId"])){
	            self::entry("right", 'onclick',
                        Yii::t( "common", "Leave this project"),
                        Yii::t( "common", "Leave"),
                        'fa fa-unlink disconnectBtnIcon',
                        "disconnectTo('".Project::COLLECTION."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."','contributors')",
                        null,
                        null,
                        "text-red"
                );
        } else if (@$id && @Yii::app()->session["userId"] && 
                @$project["links"]["followers"][Yii::app()->session["userId"]]){
	            self::entry("right", 'onclick',
                        Yii::t( "common", "Unfollow this project"),
                        Yii::t( "common", "Unfollow"),
                        'fa fa-unlink disconnectBtnIcon',
                        "disconnectTo('".Project::COLLECTION."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."','followers')",null,null,"text-red"); 
        }
        if (isset(Yii::app()->session["userId"]) && (! Authorisation::isProjectAdmin($id, Yii::app()->session["userId"]) /*|| $project["preferences"]["isOpenEdition"]==true*/)) {
	         $connectAs="admin";
	            if(!@$project["links"]["contributors"][Yii::app()->session["userId"]]){
		            $connectAs="contributor";
					if (!@$project["links"]["followers"][Yii::app()->session["userId"]]){
			            self::entry("right", 'onclick',
	                        Yii::t( "common", "Follow this project"),
	                        Yii::t( "common", "Follow"),
	                        'fa fa-link followBtn',
	                        "follow('".Project::COLLECTION."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."')",null,null);
                    }
	            } 
	            if(!@$project["links"]["contributors"][Yii::app()->session["userId"]]["isAdmin"]){
                self::entry("right", 'onclick',
                        Yii::t( "common", "Declare me as ".$connectAs." of this project"),
                        Yii::t( "common", "Become ".$connectAs),
                        'fa fa-user-plus becomeAdminBtn',
                        "connectTo('".Project::COLLECTION."','".$id."','".Yii::app()->session["userId"]."','".Person::COLLECTION."','".$connectAs."','".addslashes($project["name"])."')",null,null); 
                        }
           }
    }

    public static function comments($parentType, $parentId, $context=null)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        //$mbz = array("<li id='linkBtns'><a href='javascript:;' class='tooltips ' data-placement='top' data-original-title='This Organization is disabled' ><i class='text-red fa fa-times '></i>DISABLED</a></li>");
        //$id = (string)$room["_id"];
        
        // List des survey
        //-----------------------------
        $roomLink = "#rooms";
        if( isset( $parentType ) && isset( $parentId ) ) 
            $roomLink = "#rooms.index.type.".$parentType.".id.".$parentId; 

        self::entry("left", 'onclick', 
                    Yii::t( "rooms", 'All your Rooms', null, Yii::app()->controller->module->id),
                    Yii::t( "rooms", 'Action Rooms', null, Yii::app()->controller->module->id), 'chevron-circle-left',
                    "loadByHash('".$roomLink."')",null,null);
        
        if( Yii::app()->session['userId'] && @$context["email"] == Yii::app()->session['userEmail'] )
            self::entry("right", 'onclick', 
                    Yii::t( "rooms", ( @$context["status"] != ActionRoom::STATE_ARCHIVED ) ? 'Archive' : 'Unarchive'.' this action Room',null,Yii::app()->controller->module->id),
                    Yii::t( "rooms", ( @$context["status"] != ActionRoom::STATE_ARCHIVED ) ? 'Archive' : 'Unarchive',null,Yii::app()->controller->module->id), 'archive text-red',
                    "archive('".ActionRoom::COLLECTION."','".$_GET['id']."')","archiveBtn",null);

        // Help
        //-----------------------------
        self::entry("right", 'onclick', 
                    Yii::t( "comment", 'Click and see the new comments', Yii::app()->controller->module->id),
                    Yii::t( "comment", 'New Comment(s) Click to Refresh', Yii::app()->controller->module->id), 'refresh',
                    "loadByHash(location.hash);",null,null,"refreshComments hidden text-red",null);
    }

    public static function rooms($id,$type)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        
        // Back to Parent
        //-----------------------------
        if( @$type && @$id && $type != 'cities' ){
         //$type = Element::getControlerByCollection($type);
            $ctrl = Element::getControlerByCollection($type);
         self::entry("left", 'onclick', 
                     Yii::t( "rooms", 'go back to the detail page of the parent', null, Yii::app()->controller->module->id ),
                     Yii::t( "rooms", 'Back to Parent', null, Yii::app()->controller->module->id ), 'chevron-circle-left',
                     "loadByHash('#".$ctrl.".detail.id.".$id."')",null,null);
        }
        
        // Add a proposal
        // on show the add button for the communities in  Organisations and Projects
        //-----------------------------
//         $btnLbl = "<i class='fa fa-sign-in'></i> ".Yii::t("rooms","JOIN TO PARTICPATE", null, Yii::app()->controller->module->id);
// //        $ctrl = Element::getControlerByCollection($type);
//         $btnUrl = "#".$type.".detail.id.".$id;
//         if( Authorisation::canParticipate(Yii::app()->session['userId'],$type,$id ) ){ 
//             $btnLbl = "<i class='fa fa-plus'></i> ".Yii::t("rooms","Add an Action Room", null, Yii::app()->controller->module->id);
//             $btnUrl = "#rooms.editroom.type.".$type.".id.".$id;
//         }

//         //$urlParams = ( isset( $type ) && isset($id) ) ? ".type.".$type.".id.".$id : "" ;
//         self::entry("right", 'onclick', 
//                     Yii::t( "rooms", 'Add an Action Room', null, Yii::app()->controller->module->id ),
//                     Yii::t( "rooms", 'Add an Action Room', null, Yii::app()->controller->module->id ), 'plus',
//                     "loadByHash('".$btnUrl."')","addNewRoomBtn",null);
        
        // Help
        //-----------------------------
        if(!isset($_GET['archived'])){
            self::entry("right", 'onclick', 
                        Yii::t( "common", 'Archive'),
                        "", 'download text-red',
                        "loadByHash(location.hash+'.archived.1')",null,null);
        }
        self::entry("right", 'onclick', 
                      Yii::t( "common", 'Understanding surveys and proposals'),
                    '', 'question-circle',
                     "loadByHash('#default.view.page.modules.dir.docs?slide=dda')",null,null);
    }

    public static function survey($survey)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        //$mbz = array("<li id='linkBtns'><a href='javascript:;' class='tooltips ' data-placement='top' data-original-title='This Organization is disabled' ><i class='text-red fa fa-times '></i>DISABLED</a></li>");
        $id = (string)$survey["_id"];
        
        // List des survey
        //-----------------------------
        $surveyLink = "#rooms";
        if( isset( $survey["parentType"] ) && isset( $survey["parentId"] ) ) 
            $surveyLink = "#rooms.index.type.".$survey["parentType"].".id.".$survey["parentId"]; 

        // self::entry("left", 'onclick', 
        //             Yii::t( "rooms", 'All your Rooms', null, Yii::app()->controller->module->id),
        //             Yii::t( "rooms", 'Action Rooms', null, Yii::app()->controller->module->id), 'chevron-circle-left',
        //             "loadByHash('".$surveyLink."')","roomsListBtn",null);
        
        // Add a proposal
        //-----------------------------
        if( Authorisation::canParticipate(Yii::app()->session['userId'],$survey["parentType"],$survey["parentId"]) ) {
            if( @$survey["status"] != ActionRoom::STATE_ARCHIVED )
                self::entry("left", 'onclick', 
                            Yii::t( "common", 'Create a proposal for your community'),
                            Yii::t( "common", 'Add a proposal'), 'plus',
                            //"loadByHash('#survey.editEntry.survey.".$id."')",
                            "$('#modal-create-proposal').modal('show')",
                            "addProposalBtn",null);
            self::entry("left", 'onclick', 
                        Yii::t( "rooms", ( @$survey["status"] != ActionRoom::STATE_ARCHIVED ) ? 'Archive' : 'Unarchive'.' this action Room',null,Yii::app()->controller->module->id),
                        Yii::t( "rooms", ( @$survey["status"] != ActionRoom::STATE_ARCHIVED ) ? 'Archive' : 'Unarchive',null,Yii::app()->controller->module->id), 'archive text-red',
                        "archive('".ActionRoom::COLLECTION."','".$id."')","archiveBtn",null);
        }
        // Help
        //-----------------------------
        self::entry("left", 'html', 
                    Yii::t( "common", 'Understanding surveys and proposals'),
                    '', 'question-circle',
                    '<a href="javascript:;" data-id="explainSurveys" class="tooltips btn btn-default explainLink"',null,null);
    }

    public static function proposal($survey)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();

        if(is_string($survey))
            $parentId = $survey;
        else {
            $id = (string)$survey["_id"];
            $parentId = (string)$survey["survey"];
            $organiserId = $survey['organizerId'];
        }

        // Back to  proposal
        //-----------------------------
        // self::entry("left", 'onclick', 
        //             Yii::t( "common", 'go Back'),
        //             Yii::t( "common", 'Back'), 'chevron-circle-left',
        //             "window.history.back();",null,null);

        // Back to Parent Survey
        //-----------------------------
        self::entry("left", 'onclick', 
                    Yii::t( "rooms", 'Parent Survey', null,Yii::app()->controller->module->id),
                    Yii::t( "rooms", 'Back to Parent Survey', null,Yii::app()->controller->module->id), 'chevron-circle-left',
                    "showRoom('vote', '".$parentId."')",null,null);
                    //"loadByHash('#survey.entries.id.".$parentId."')",null,null);

        
        if ( $organiserId == Yii::app()->session["userId"] ) 
        {
            // Edit proposal
            //-----------------------------
            $hasVote = (@$survey["voteUpCount"] || @$survey["voteAbstainCount"] || @$survey["voteUnclearCount"] || @$survey["voteMoreInfoCount"] || @$survey["voteDownCount"] ) ? true : false;
            if( !$hasVote && Yii::app()->controller->action->id != "editentry"  )
            {
                self::entry("right", 'onclick', 
                        Yii::t( "rooms", 'Edit this proposal', null,Yii::app()->controller->module->id),
                        Yii::t( "common", 'Edit'), 'pencil',
                        "loadByHash('#survey.editEntry.survey.".$parentId.".id.".$id."')","editProposalBtn",null);
            }

            
            // Close
            //-----------------------------
            if( Yii::app()->controller->action->id != "editentry" && !( ( @$survey["dateEnd"] && $survey["dateEnd"] < time()) )   )
            {
                self::entry("right", 'onclick', 
                        Yii::t( "rooms", 'Close this proposal', null,Yii::app()->controller->module->id),
                        Yii::t( "common", 'Close'), 'times text-red',
                        "closeEntry('".$id."')","closeProposalBtn",null);
            }
            self::entry("right", 'onclick', 
                        Yii::t( "rooms", 'Move this proposal', null,Yii::app()->controller->module->id),
                        Yii::t( "rooms", 'Move', null,Yii::app()->controller->module->id), 'share-alt text-grey',
                        "$('#modal-select-room5').modal('show')","moveProposalBtn",null);
        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
        // Help
        //-----------------------------
        self::entry("right", 'html', 
                    Yii::t( "common", 'Understanding surveys and proposals'),
                    '', 'question-circle',
                    '<a href="javascript:;" data-id="explainSurveys" class="tooltips btn btn-default explainLink"',null,null);
        
        // Standalone Version
        //-----------------------------
       /*self::entry("right", 'href', 
                Yii::t( "common", 'standalone version proposals'),
                '', 'file-o',
                Yii::app()->createUrl("/".Yii::app()->controller->module->id."/survey/entry/id/".$id),null,null);*/
   

    }
    public static function actions($room)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        //$mbz = array("<li id='linkBtns'><a href='javascript:;' class='tooltips ' data-placement='top' data-original-title='This Organization is disabled' ><i class='text-red fa fa-times '></i>DISABLED</a></li>");
        $id = (string)$room["_id"];
        
        // List des room
        //-----------------------------
        $surveyLink = "#rooms";
        if( isset( $room["parentType"] ) && isset( $room["parentId"] ) ) 
            $surveyLink = "#rooms.index.type.".$room["parentType"].".id.".$room["parentId"]; 

        // self::entry("left", 'onclick', 
        //             Yii::t( "common", 'List of all Surveys'),
        //             Yii::t( "common", 'All Surveys'), 'chevron-circle-left',
        //             "loadByHash('".$surveyLink."')","roomsListBtn",null);
        
        // Add a proposal
        //-----------------------------
        if( Authorisation::canParticipate( Yii::app()->session['userId'], $room["parentType"],$room["parentId"], $room["parentType"] ) ) {

            if( @$room["status"] != ActionRoom::STATE_ARCHIVED )
                self::entry("left", 'onclick', 
                        Yii::t( "common", 'Create an Action for your community'),
                        Yii::t( "rooms", 'Add an Action',null,Yii::app()->controller->module->id), 'plus',
                        //"loadByHash('#rooms.editAction.room.".$id."')",
                        "$('#modal-create-action').modal('show')",
                        "addActionBtn",null);

            /*if ( @$room["organizerId"] == Yii::app()->session["userId"] ) 
                self::entry("right", 'onclick', 
                        Yii::t( "common", 'Move this proposals'),
                        Yii::t( "common", 'Move'), 'share-alt text-grey',
                        "movePrompt('rooms.action', '".$id."')","moveProposalBtn",null);
            */
            self::entry("right", 'onclick', 
                        Yii::t( "rooms", ( @$room["status"] != ActionRoom::STATE_ARCHIVED ) ? 'Archive' : 'Unarchive'.' this action Room',null,Yii::app()->controller->module->id),
                        Yii::t( "rooms", ( @$room["status"] != ActionRoom::STATE_ARCHIVED ) ? 'Archive' : 'Unarchive',null,Yii::app()->controller->module->id), 'archive text-red',
                        "archive('".ActionRoom::COLLECTION."','".$id."')","archiveBtn",null);
        }
        // Help
        //-----------------------------
        self::entry("left", 'html', 
                    Yii::t( "rooms", 'Understanding action list',null,Yii::app()->controller->module->id),
                    '', 'question-circle',
                    '<a href="javascript:;" data-id="explainSurveys" class="tooltips btn btn-default explainLink"',null,null);
    }

    public static function action($action)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();

                                                           
        $id = (string)$action["_id"];
        $parentId = (string)$action["room"];
        $organiserId = $action['organizerId'];
        

        // Back to Parent Survey
        //-----------------------------
        self::entry("left", 'onclick', 
                    Yii::t( "rooms", 'Back to Action List',null,Yii::app()->controller->module->id),
                    Yii::t( "rooms", 'Action List',null,Yii::app()->controller->module->id), 'chevron-circle-left',
                    "showRoom('actions', '".$parentId."')",null,null);
        
        if ( $organiserId == Yii::app()->session["userId"] ) 
        {
            // Edit proposal
            //-----------------------------
            if( Yii::app()->controller->action->id != "editaction"  )
            {
                self::entry("right", 'onclick', 
                        Yii::t( "common", 'Edit this action'),
                        Yii::t( "common", 'Edit'), 'pencil',
                        "loadByHash('#rooms.editAction.room.".$parentId.".id.".$id."')","editActionBtn",null);
            

                //give the right to all 
                self::entry("right", 'onclick', 
                    Yii::t( "common", ( @$action["status"] == ActionRoom::ACTION_CLOSED) ? 'Re-open This Action' :'Close this action'),
                    Yii::t( "common", ( @$action["status"] == ActionRoom::ACTION_CLOSED) ? 'ReOpen' : 'Close'), 
                    ( @$action["status"] == ActionRoom::ACTION_CLOSED) ? 'circle-o' : 'times' ,
                    "closeAction('".$id."')","closeActionBtn",null);
            }
            self::entry("right", 'onclick', 
                    Yii::t( "common", 'Move this proposals'),
                    Yii::t( "common", 'Move'), 'share-alt text-grey',
                    "$('#modal-select-room5').modal('show')","moveProposalBtn",null);
        }

        // Help
        //-----------------------------
        self::entry("right", 'html', 
                    Yii::t( "common", 'Understanding actions'),
                    '', 'question-circle',
                    '<a href="javascript:;" data-id="explainActions" class="tooltips btn btn-default explainLink"',null,null);
                      
    }
    public static function docs($previousChapter, $nextChapter)
    {
         if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        // Help
        //-----------------------------
        self::entry("left", 'onclick', 
                    Yii::t( "common", 'go to documentation Index'),
                    Yii::t( "common", 'Documentation'), 'binoculars',
                    "loadByHash('#default.view.page.index.dir.docs')","indexBtn",null);// Help
        //-----------------------------
        if($previousChapter != "")
        self::entry("right", 'onclick', 
                    Yii::t( "common", 'Previous chapter'),
                    Yii::t( "common", 'Previous'), 'chevron-circle-left',
                    "loadByHash('#default.view.page.".$previousChapter.".dir.docs')","indexBtn",null);// Help
        //-----------------------------
        if($nextChapter != "")
        self::entry("right", 'onclick', 
                    Yii::t( "common", 'Next chapter'),
                    Yii::t( "common", 'Next').' <i class="fa fa-chevron-circle-right"></i>', 'chevron-circle-right hidden-lg',
                    "loadByHash('#default.view.page.".$nextChapter.".dir.docs')","indexBtn",null);
    }

    public static function back()
    {
         if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        // Help
        //-----------------------------
        self::entry("left", 'onclick', 
                    Yii::t( "common", 'go Back'),
                    Yii::t( "common", 'Back'), 'chevron-circle-left',
                    "window.history.back();","backBtn",null);
    }

    public static function entry($position,$type,$title,$label,$icon,$url,$controllerid,$actionid,$class=null,$badge=null,$moreAttributes=null)
    {
        if( $type == 'showAjaxPanel')
        {
            $active = (Yii::app()->controller->id == $controllerid && Yii::app()->controller->action->id == $actionid ) ? "active" : "";
            $onclick = "showAjaxPanel( '".$url."', '".$title."','".$icon."' )";
            $entry = array( 'tooltip'   => $title,
                            'position'   => $position,
                            "iconClass" => "fa fa-".$icon,
                            "label"     => $label,
                            "badge"     => $badge,
                            "href"      => "<a  class='tooltips ".$active." btn btn-default' href='javascript:;' onclick=\"".$onclick."\"");
        } 
        else if( $type == 'filter')
        {
            $entry = array( 'tooltip'    => $title,
                            'position'   => $position,
                            "iconClass" => "fa fa-".$icon,
                            "label"     => $label,
                            "badge"     => $badge,
                            "href"      => "<a  class='tooltips filter btn btn-default ".$class."' href='javascript:;' data-filter=\"".$actionid."\"");
        } 
        else if( $type == 'onclick')
        { 
            $onclick = $url;
            $active = (Yii::app()->controller->id == $controllerid && Yii::app()->controller->action->id == $actionid ) ? "active" : "";
            $entry = array( 'tooltip'    => $title,
                            'position'   => $position,
                            "iconClass" => "fa fa-".$icon,
                            "label"     => $label,
                            "badge"     => $badge,
                            "href"      => "<a  class='tooltips btn btn-default ".$active." ".$class."' href='javascript:;' onclick=\"".$onclick."\"");
        }
        else if( $type == 'href')
        { 
            $onclick = $url;
            $active = (Yii::app()->controller->id == $controllerid && Yii::app()->controller->action->id == $actionid ) ? "active" : "";
            $entry = array( 'tooltip'    => $title,
                            'position'   => $position,
                            "iconClass" => "fa fa-".$icon,
                            "label"     => $label,
                            "badge"     => $badge,
                            "href"      => "<a  class='tooltips btn btn-default ".$class." ".$active."', target='_blank' href=\"".$onclick."\"".$moreAttributes);
                        

        }
        else if( $type == 'html')
        { 
            $entry = array( 'tooltip'    => $title,
                            'position'   => $position,
                            "iconClass" => "fa fa-".$icon,
                            "label"     => $label,
                            "badge"     => $badge,
                            "href"      => $url);
        }
        else 
        {
            $entry = array( 'tooltip'    => $title,
                            'position'   => $position,
                            "label"     => $label,
                            "iconClass" => "fa fa-".$icon,
                            "href"      => "<a href='javascript:;' class='".$class." coco tooltips btn btn-default' data-notsubview='1' ");
        }
        array_push( Yii::app()->controller->toolbarMBZ, $entry);
    }

    public static function add2MBZ($entry)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        
        array_push( Yii::app()->controller->toolbarMBZ , $entry );
    }

    public static function menuItems($conn=null,$type=null)
    {
        $result = array();
        return $result;
    } 

    public static function buildMenu($children,$parentId,$menu = array())
    {
        foreach ($children as $v) 
        {
            if($parentId == $v->parentMenuItemId)
            {
                $id = (isset($v->menuItemId)) ? $v->menuItemId : null;
                $lbl = (isset($v->menuItemLabelFr)) ? $v->menuItemLabelFr : null;   
                $menu[] = array( "label"=>$v->menuItemLabelFr  , "onclick"=>"bootbox.alert('".$v->menuItemLabelEn."')" , "key"=>$v->menuItemId , "children"=>TeeoApi::buildMenu($children, $id) );
            }
        }
        return $menu;
    }

    public static function buildLi2( $item )
    {
      $modal = ( @$item["isModal"]) ? 'role="button" data-toggle="modal"' : "";
      $onclick = ( @$item["onclick"]) ? 'onclick="'.$item["onclick"].'"' 
                                           : ( ( @$item["key"] && false) ? 'onclick="scrollTo(\'#block'.$item["key"].'\')"' 
                                                                      : "" );
      $href = ( @$item["href"]) ? (stripos($item["href"], "http") === false) ? Yii::app()->createUrl($item["href"]) : $item["href"] : "javascript:;";
      $class = ( @$item["class"]) ? 'class="'.$item["class"].'"' : "";
      $class .= " homestead text-extra-large";
      $icon = ( @$item["iconClass"]) ? '<i class="'.$item["iconClass"].'"></i>' : '';
      $isActive = ( isset( Menu::$sectionMenu[ @$item["key"] ] ) && in_array( Yii::app()->controller->action->id, Menu::$sectionMenu[ $item["key"] ] ) ) ? true : false;
      
      $active = ( $isActive || ( @$item["active"] && $item["active"] ) ) ? "open active" : "";
      

      //This menu can have 2 levels
      if( isset($item["children"]) ){
            echo '<li><a href="javascript:;">'.
                  '<span class="status">'.
                    '<i class="fa fa-caret-down"></i>'.
                    '<span class="badge">'.count($item["children"]).'</span>'.
                  '</span>'.
                  $item["label"].
                  '</a>';
            echo "<ul class='sub-menu'>";
              foreach( $item["children"] as $item2 )
              {
                  buildLi22($item2);
              }
            echo "</ul></li>";
          }
      else
        echo '<li><a href="'.$href.'" '.$modal.' '.$class.' '.$onclick.' >'.@$item["label"].'</a></li>';
    }

} 
?>