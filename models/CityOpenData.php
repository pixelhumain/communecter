<?php 
class CityOpenData {

	/**
	 * get Entries from a collection and converts ID and applies a dummyData field for easy export and remove
	 * @param type $type 
	 * @param type $where 
	 * @return type
	 */
	public static function listOption($arrayOption, $chaine, $first, $name_id, $father=""){

      $i = 1 ;
      foreach ($arrayOption as $key => $value) {
          
          //if(is_array($value))
          if(empty($value["value"]) && empty($value["label"]))
          {
              //var_dump($value);
              $chaine = $chaine.'<li><strong class="btn-drop bold" >'.$key.'</strong></li>';
              $otherfather = $father .".". $key ;
              if($first == true && $i==1)
                $chaine = CityOpenData::listOption($value, $chaine, true, $name_id, $otherfather);
              else
                $chaine = CityOpenData::listOption($value, $chaine, false, $name_id, $otherfather);
          }
          else
          {
              if($first == true && $i==1)
                $list = '<li>
                            <a class="btn-drop optionBtn" data-name="'.$father .'.'. $key.'">
                                <input type="checkbox" id="'.$name_id . $father .'.'. $key.'" name="'.$name_id .'optionCheckbox" value="'.$father .'.'. $key.'" checked/>
                                <label for="'.$name_id . $father .'.'. $key.'" >'.$value["label"].'</label>
                            </a>
                          </li>';
              else
                $list = '<li>
                            <a class="btn-drop optionBtn" data-name="'.$father .'.'. $key.'">
                                <input type="checkbox" id="'.$name_id . $father .'.'. $key.'" name="'.$name_id .'optionCheckbox" value="'.$father .'.'. $key.'"/>
                                <label for="'.$name_id . $father .'.'. $key.'" >'.$value["label"].'</label>
                            </a>
                          </li>';
              $chaine = $chaine . $list ;
             // var_dump($chaine);
              $i++;
          }
      }

      return $chaine;   
  }

  public static function listOptionWithOptionChecked($arrayOption, $chaine, $name_id, $optionCheckbox , $father=""){

      $i = 1 ;
      foreach ($arrayOption as $key => $value) {
          //var_dump($value);
          if(empty($value["value"]) && empty($value["label"]))
          {
              $chaine = $chaine.'<li><strong class="btn-drop bold" >'.$key.'</strong></li>';
              $otherfather = $father .".". $key ;
              $chaine = CityOpenData::listOptionWithOptionChecked($value, $chaine, $name_id, $optionCheckbox, $otherfather);
          }
          else
          {
            $trouver = false ;
            
            foreach ($optionCheckbox as $optionKey => $optionValue){
              //var_dump($optionValue);
                if($optionValue ==  $father .'.'. $key)
                { 
                  $list = '<li>
                              <a class="btn-drop optionBtn" data-name="'.$father .'.'. $key.'">
                                  <input type="checkbox" id="'.$name_id . $father .'.'. $key.'" name="'.$name_id .'optionCheckbox" value="'.$father .'.'. $key.'" checked/>
                                  <label for="'. $father .'.'. $key.'" >'.$value["label"].'</label>
                              </a>
                            </li>';
                  $trouver = true ;
                  break;
                }
            }

            if($trouver == false)
            {   $list = '<li>
                            <a class="btn-drop optionBtn" data-name="'.$father .'.'. $key.'">
                                <input type="checkbox" id="'.$name_id . $father .'.'. $key.'" name="'.$name_id .'optionCheckbox" value="'.$father .'.'. $key.'"/>
                                <label for="'.$father .'.'. $key.'" >'.$value["label"].'</label>
                            </a>
                          </li>';
                
            }
            
            $chaine = $chaine . $list ;
            $i++;

          }
      }

      return $chaine;   

  }

  /******* NEW ***********/

  public static function listOption2($arrayOption, $chaine, $first, $name_id, $father=""){

      $i = 1 ;
      foreach ($arrayOption as $key => $value) {
          
          //if(is_array($value))
          if(empty($value["value"]) && empty($value["label"]))
          {
              //var_dump($value);
              $otherfather = $father .".". $key ;
              if($first == true && $i==1)
                $chaine = CityOpenData::listOption2($value, $chaine, true, $name_id, $otherfather);
              else
                $chaine = CityOpenData::listOption2($value, $chaine, false, $name_id, $otherfather);
          }
          else
          {
              if($first == true && $i==1)
                $list = '<option value="'.$father .'.'. $key.'" checked>'.$value["label"].'</option>';
              else
                $list = '<option value="'.$name_id .$father .'.'. $key.'">'.$value["label"].'</option>';
              $chaine = $chaine . $list ;
             // var_dump($chaine);
              $i++;
          }
      }

      return $chaine;   
  }
 
}
?>