<?php
class Menu {
	public static $sectionMenu = array(
        
    );
    public static function menuItems($conn=null,$type=null)
    {
        
        //$userId = Yii::app()->session["user"]["userId"];
        //$appId  = Yii::app()->session["user"]["treeId"];
        $result = json_decode('{"items":[{"menuItemId":"10001","menuId":"8000","menuItemLabelFr":"Management","menuItemLabelEn":"itemEnergyManagement","parentMenuItemId":"0","menuItemData":"","menuItemOrder":"2","menuItemIcon":"76"},{"menuItemId":"10004","menuId":"8000","menuItemLabelFr":"Configuration","menuItemLabelEn":"itemSettings","parentMenuItemId":"0","menuItemData":"","menuItemOrder":"5","menuItemIcon":"42"},{"menuItemId":"10019","menuId":"8000","menuItemLabelFr":"Evenements","menuItemLabelEn":"itemEnergyEventManager","parentMenuItemId":"10001","menuItemData":"management.energyEvents.EnergyEventsContainer","menuItemOrder":"3","menuItemIcon":""},{"menuItemId":"10020","menuId":"8000","menuItemLabelFr":"RPEE","menuItemLabelEn":"itemRPEEManager","parentMenuItemId":"10001","menuItemData":"","menuItemOrder":"4","menuItemIcon":""},{"menuItemId":"10021","menuId":"8000","menuItemLabelFr":"Audits","menuItemLabelEn":"itemAuditManager","parentMenuItemId":"10001","menuItemData":"","menuItemOrder":"5","menuItemIcon":""},{"menuItemId":"10016","menuId":"8000","menuItemLabelFr":"Management \u00e9nergie","menuItemLabelEn":"itemEnergyManagementConfig","parentMenuItemId":"10004","menuItemData":"management.energyEvents.EnergyEventsConfig","menuItemOrder":"0","menuItemIcon":""}]}');

        /*$query  = "CALL getApplicationMenuByUser({$appId},{$userId})";

        $dbresult = $conn->query($query);

        while($row = $dbresult->fetch_assoc())
        {
            array_push(
                $result["items"],
                array(
                    "menuItemId"=>$row["menu_item_id"],
                    "menuId"=>$row["menu_id"],
                    "menuItemLabelFr"=>utf8_encode($row["item_label_fr"]),
                    "menuItemLabelEn"=>utf8_encode($row["item_label_en"]),
                    "parentMenuItemId"=>$row["parent_menu_item_id"],
                    "menuItemData"=>utf8_encode($row["item_data"]),
                    "menuItemOrder"=>$row["item_order"],
                    "menuItemIcon"=>utf8_encode($row["item_icon"])
                )
            );
            
          //logFileWrite('row : '.json_encode($row));
        }*/

        $result->menuTree = TeeoApi::buildMenu( $result->items,0 );
       
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

} 
?>