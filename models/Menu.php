<?php
class Menu {

    public static $infoMenu = array();

	public static $sectionMenu = array();
    
    public static function person($person)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        //$mbz = array("<li id='linkBtns'><a href='javascript:;' class='tooltips ' data-placement='top' data-original-title='This Organization is disabled' ><i class='text-red fa fa-times '></i>DISABLED</a></li>");
        $id = (string)$person["_id"];
        
        //HOME
        //-----------------------------
        $onclick = "showAjaxPanel( '/person/detail/id/".$id."', 'PERSON DETAIL ','user' )";
        $active = (Yii::app()->controller->id == "person" && Yii::app()->controller->action->id == "detail" ) ? "active" : "";
        array_push( Yii::app()->controller->toolbarMBZ, array( 'tooltip' => "Person Details",
                                                                "iconClass"=>"fa fa-user",
                                                                "href"=>"<a  class='tooltips ".$active." btn btn-default' href='#' onclick=\"".$onclick."\"") );
        
        //SEND MESSAGE
        //-----------------------------
        array_push( Yii::app()->controller->toolbarMBZ , array('tooltip' => "Send a message to this Person",
                                                                "iconClass"=>"fa fa-envelope-o",
                                                                "href"=>"<a href='#' class='new-news tooltips btn btn-default' data-id='".$id."' data-type='".Person::COLLECTION."' data-name='".$person['name']."'") );
        
        
        
        //DIRECTORY
        //-----------------------------
        $active = (Yii::app()->controller->id == "person" && Yii::app()->controller->action->id == "directory" ) ? "active" : "";
        $onclick = "showAjaxPanel( '/person/directory/id/".$id."?tpl=directory2&isNotSV=1', 'DIRECTORY ','users' )";
        array_push( Yii::app()->controller->toolbarMBZ, array('tooltip' => "PUBLIC DIRECTORY",
                                                                "iconClass"=>"fa fa-users",
                                                                "href"=>"<a  class='tooltips ".$active." btn btn-default' href='#' onclick=\"".$onclick."\"") );

        //FOLLOW BUTTON
        //-----------------------------
        if(isset($person["_id"]) && isset(Yii::app()->session["userId"]) && $person["_id"] != Yii::app()->session["userId"]){
            //Link button
            if(isset($person["_id"]) && isset(Yii::app()->session["userId"]) && Link::isConnected( Yii::app()->session['userId'] , Person::COLLECTION , (string)$person["_id"] , Person::COLLECTION ))
                $htmlFollowBtn = array('tooltip' => "Unfollow this Person", 
                                       "iconClass"=>"disconnectBtnIcon fa fa-unlink",
                                        "href"=>"<a href='#' class='unfollowBtn text-red tooltips btn btn-default' data-name=\"".$person["name"]."\" data-id='".$person["_id"]."' data-type='".Person::COLLECTION."' data-ownerlink='".link::person2person."' ");
            else
                $htmlFollowBtn = array('tooltip' => "Follow this Person", 
                                        "iconClass"=>"connectBtnIcon fa fa-unlink",
                                        "href"=>"<a href='javascript:;' class='followBtn tooltips btn btn-default ' id='addKnowsRelation'  data-id='".$person["_id"]."' data-ownerlink='".link::person2person."' ");
            array_push(Yii::app()->controller->toolbarMBZ, $htmlFollowBtn);
        } 
    }

    public static function organization($organization)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        //$mbz = array("<li id='linkBtns'><a href='javascript:;' class='tooltips ' data-placement='top' data-original-title='This Organization is disabled' ><i class='text-red fa fa-times '></i>DISABLED</a></li>");
        $id = (string)$organization["_id"];
        
        //HOME
        //-----------------------------
        $onclick = "showAjaxPanel( '/organization/detail/id/".$id."', 'ORGANIZATION DETAIL ','home' )";
        $active = (Yii::app()->controller->id == "organization" && Yii::app()->controller->action->id == "detail" ) ? "active" : "";
        array_push( Yii::app()->controller->toolbarMBZ, array('tooltip' => "Details",
                                                                "iconClass"=>"fa fa-home",
                                                                "href"=>"<a  class='tooltips ".$active." btn btn-default' href='#' onclick=\"".$onclick."\"") );
        
        //SEND MESSAGE
        //-----------------------------
        if( Authorisation::isOrganizationMember(Yii::app()->session['userId'],$id) ){
            array_push( Yii::app()->controller->toolbarMBZ , array('tooltip' => "Send a message to this Organization",
                                                                    "iconClass"=>"fa fa-envelope-o",
                                                                    "href"=>"<a href='#' class='new-news tooltips btn btn-default' data-id='".$id."' data-type='".Organization::COLLECTION."' data-name='".$organization['name']."'") );
        }
        
        //SEE TIMELINE
        //-----------------------------
        $onclick = "showAjaxPanel( '/news/index/type/".Organization::COLLECTION."/id/".$id."', 'ORGANIZATION ACTIVITY ','rss' )";
        $active = (Yii::app()->controller->id == "news" && Yii::app()->controller->action->id == "index" ) ? "active" : "";
        array_push( Yii::app()->controller->toolbarMBZ, array('tooltip' => "TIMELINE : Organization Activity",
                                                              "iconClass"=>"fa fa-rss",
                                                              "href"=>"<a  class='tooltips ".$active." btn btn-default' href='#' onclick=\"".$onclick."\"") );
        
        //ACTION ROOMS
        //-----------------------------
        /*$onclick = "showAjaxPanel( '/rooms/index/type/".Organization::COLLECTION."/id/".$id."', 'ORGANIZATION ACTION ROOM ','legal' )"; 
        $active = (Yii::app()->controller->id == "rooms" && Yii::app()->controller->action->id == "index" ) ? "active" : ""; 
        array_push( Yii::app()->controller->toolbarMBZ, array('tooltip' => "SURVEYS : Organization Action Room",
                                                              "iconClass"=>"fa fa-legal",
                                                              "href"=>"<a class='tooltips ".$active." btn btn-default' href='#' onclick=\"".$onclick."\"") );
        */
        //DIRECTORY
        //-----------------------------
        $active = (Yii::app()->controller->id == "organization" && Yii::app()->controller->action->id == "directory" ) ? "active" : "";
        $onclick = "showAjaxPanel( '/organization/directory/id/".$id."?tpl=directory2&isNotSV=1', 'ORGANIZATION MEMBERS ','users' )";
        array_push( Yii::app()->controller->toolbarMBZ, array('tooltip' => "MEMBERS : Organization participants",
                                                                "iconClass"=>"fa fa-users",
                                                                "href"=>"<a  class='tooltips ".$active." btn btn-default' href='#' onclick=\"".$onclick."\"") );

        // ADD MEMBER
        //-----------------------------
        $active = (Yii::app()->controller->id == "organization" && Yii::app()->controller->action->id == "addmember" ) ? "active" : "";
        $onclick = "showAjaxPanel( '/organization/addmember/id/".$id."?isNotSV=1', 'ADD A MEMBER','plus' )";
        array_push( Yii::app()->controller->toolbarMBZ, array('tooltip' => "ADD MEMBER : Organization participants",
                                                                "iconClass"=>"fa fa-plus",
                                                                "href"=>"<a  class='tooltips ".$active." btn btn-default' href='#' onclick=\"".$onclick."\"") );

        //FOLLOW BUTTON
        //-----------------------------
        if( !isset( $organization["disabled"] ) ){
            //Link button
            if(isset($organization["_id"]) && isset(Yii::app()->session["userId"]) && Link::isLinked((string)$organization["_id"], Organization::COLLECTION , Yii::app()->session["userId"]))
                $htmlFollowBtn = array('tooltip' => "leave this Organization", 
                                       "iconClass"=>"disconnectBtnIcon fa fa-unlink",
                                        "href"=>"<a href='#' class='removeMemberBtn text-red tooltips btn btn-default' data-name='".$organization["name"]."' data-memberof-id='".$organization["_id"]."' data-member-type='".Person::COLLECTION."' data-member-id='".Yii::app()->session["userId"]."'");
            else
                $htmlFollowBtn = array('tooltip' => "join this Organization", 
                                        "iconClass"=>"connectBtnIcon fa fa-unlink",
                                        "href"=>"<a href='javascript:;' class='connectBtn tooltips btn btn-default ' id='addMeAsMemberInfo'");
            array_push(Yii::app()->controller->toolbarMBZ, $htmlFollowBtn);
            
            //Ask Admin button
            if (! Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $id)) {
                array_push(Yii::app()->controller->toolbarMBZ, array('tooltip' => "Declare me as admin of this organization",   
                                                                     "iconClass"=>"fa fa-user-plus",
                                                                     "href"=>"<a href='#' class='declare-me-admin tooltips btn btn-default' data-id='".$id."' data-type='".Organization::COLLECTION."' data-name='".$organization['name']."'") );
            }
        } 
    }

    public static function city($city)
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        //$mbz = array("<li id='linkBtns'><a href='javascript:;' class='tooltips ' data-placement='top' data-original-title='This Organization is disabled' ><i class='text-red fa fa-times '></i>DISABLED</a></li>");
        $insee = (string)$city["insee"];
        
        //HOME
        //-----------------------------
        $onclick = "showAjaxPanel( '/city/detail/insee/".$insee."', 'CITY BOX : ".$city["name"]."','university' )";
        $active = (Yii::app()->controller->id == "organization" && Yii::app()->controller->action->id == "detail" ) ? "active" : "";
        array_push( Yii::app()->controller->toolbarMBZ, array('tooltip' => "Details",
                                                                "iconClass"=>"fa fa-university",
                                                                "href"=>"<a  class='tooltips ".$active." btn btn-default' href='#' onclick=\"".$onclick."\"") );
        
        //SEND MESSAGE
        //-----------------------------
        /*array_push( Yii::app()->controller->toolbarMBZ , array('tooltip' => "Send a message to this City",
                                                                "iconClass"=>"fa fa-envelope-o",
                                                                "href"=>"<a href='#' class='new-news tooltips btn btn-default' data-id='".$insee."' data-type='".City::COLLECTION."' data-name='".$city['name']."'") );
        */
        
        //SEE TIMELINE
        //-----------------------------
        /*$onclick = "showAjaxPanel( '/news/index/type/".City::COLLECTION."/id/".$insee."', 'CITY ACTIVITY ','rss' )";
        $active = (Yii::app()->controller->id == "news" && Yii::app()->controller->action->id == "index" ) ? "active" : "";
        array_push( Yii::app()->controller->toolbarMBZ, array('tooltip' => "TIMELINE : City Activity",
                                                              "iconClass"=>"fa fa-rss",
                                                              "href"=>"<a  class='tooltips ".$active." btn btn-default' href='#' onclick=\"".$onclick."\"") );*/
        
        //ACTION ROOMS
        //-----------------------------
        /*$onclick = "showAjaxPanel( '/rooms/index/type/".Organization::COLLECTION."/id/".$id."', 'ORGANIZATION ACTION ROOM ','legal' )"; 
        $active = (Yii::app()->controller->id == "rooms" && Yii::app()->controller->action->id == "index" ) ? "active" : ""; 
        array_push( Yii::app()->controller->toolbarMBZ, array('tooltip' => "SURVEYS : Organization Action Room",
                                                              "iconClass"=>"fa fa-legal",
                                                              "href"=>"<a class='tooltips ".$active." btn btn-default' href='#' onclick=\"".$onclick."\"") );
        */
        //DIRECTORY
        //-----------------------------
        $active = (Yii::app()->controller->id == "city" && Yii::app()->controller->action->id == "directory" ) ? "active" : "";
        $onclick = "showAjaxPanel( '/city/directory/insee/".$insee."?tpl=directory2&isNotSV=1', 'CITY NETWORK ','share-alt' )";
        array_push( Yii::app()->controller->toolbarMBZ, array('tooltip' => "LOCAL NETWORK",
                                                                "iconClass"=>"fa fa-users",
                                                                "href"=>"<a  class='tooltips ".$active." btn btn-default' href='#' onclick=\"".$onclick."\"") );

        //STATISTICS
        //-----------------------------
        $onclick = "showAjaxPanel( '/city/opendata/insee/".$insee."?isNotSV=1', 'CITY DATA : ".$city["name"]."','line-chart' )";
        $active = (Yii::app()->controller->id == "city" && Yii::app()->controller->action->id == "opendata" ) ? "active" : "";
        array_push( Yii::app()->controller->toolbarMBZ , array('tooltip' => "Statistics",
                                                                "iconClass"=>"fa fa-line-chart",
                                                                "href"=>"<a  class='tooltips ".$active." btn btn-default' href='#' onclick=\"".$onclick."\"") );
        //FOLLOW BUTTON
        //-----------------------------
        /*if( !isset( $organization["disabled"] ) ){
            //Link button
            if(isset($organization["_id"]) && isset(Yii::app()->session["userId"]) && Link::isLinked((string)$organization["_id"], Organization::COLLECTION , Yii::app()->session["userId"]))
                $htmlFollowBtn = array('tooltip' => "leave this Organization", 
                                       "iconClass"=>"disconnectBtnIcon fa fa-unlink",
                                        "href"=>"<a href='#' class='removeMemberBtn text-red tooltips btn btn-default' data-name='".$organization["name"]."' data-memberof-id='".$organization["_id"]."' data-member-type='".Person::COLLECTION."' data-member-id='".Yii::app()->session["userId"]."'");
            else
                $htmlFollowBtn = array('tooltip' => "join this Organization", 
                                        "iconClass"=>"connectBtnIcon fa fa-unlink",
                                        "href"=>"<a href='javascript:;' class='connectBtn tooltips btn btn-default ' id='addMeAsMemberInfo'");
            array_push(Yii::app()->controller->toolbarMBZ, $htmlFollowBtn);
            
            //Ask Admin button
            if (! Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $id)) {
                array_push(Yii::app()->controller->toolbarMBZ, array('tooltip' => "Declare me as admin of this organization",   
                                                                     "iconClass"=>"fa fa-user-plus",
                                                                     "href"=>"<a href='#' class='declare-me-admin tooltips btn btn-default' data-id='".$id."' data-type='".Organization::COLLECTION."' data-name='".$organization['name']."'") );
            }
        } */
    }

    public static function news()
    {
        if( !is_array( Yii::app()->controller->toolbarMBZ ))
            Yii::app()->controller->toolbarMBZ = array();
        
        //SEND MESSAGE
        //-----------------------------
        array_push( Yii::app()->controller->toolbarMBZ , array('tooltip' => "Post Something",
                                                                "iconClass"=>"fa fa-envelope-o",
                                                                "href"=>"<a href='#' class='new-news tooltips btn btn-default' data-notsubview='1' ") );
        
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